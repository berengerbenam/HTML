from flask import Flask
from flask import jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_restx import Api, fields, Resource, reqparse
from flask_jwt_extended import JWTManager
from flask_jwt_extended import create_access_token, create_refresh_token, jwt_required, get_jwt_identity



app = Flask(__name__)
api = Api(app)

jwt = JWTManager(app)



parser = reqparse.RequestParser()
parser.add_argument('prenom', help = 'le prenom du user', required = True)
parser.add_argument('nom', help = 'nom', required = True)
parser.add_argument('email', help = 'email', required = True)
parser.add_argument('password', help = 'mot de passe', required = True)



parser_compte = reqparse.RequestParser()
parser_compte.add_argument('prenom', help = 'le prenom du user', required = True)
parser_compte.add_argument('nom', help = 'nom', required = True)
parser_compte.add_argument('email', help = 'email', required = True)
parser_compte.add_argument('password', help ='mot de passe', required = True)
parser_compte.add_argument('solde', help ='votre solde', required = True)


parser_login = reqparse.RequestParser()
parser_login.add_argument('email', help = 'email', required = True)
parser_login.add_argument('password', help = 'mot de passe', required = True)

parser_versement = reqparse.RequestParser()
parser_versement.add_argument('email', help = 'email', required = True)
parser_versement.add_argument('montant', help = 'montant', required = True)

#parser_virement
parser_virement = reqparse.RequestParser()
parser_virement.add_argument('email_expeditaire', help = 'email_expeditaire', required = True)
parser_virement.add_argument('email_destinataire', help = 'email_destinataire', required = True)
parser_virement.add_argument('montant', help = 'montant', required = True)
#fin_virement

#parser_retrait

parser_retrait = reqparse.RequestParser()
parser_retrait.add_argument('email', help = 'email', required = True)
parser_retrait.add_argument('montant', help = 'montant', required = True)

#fin_retrait

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://berenger:Passer123/@localhost/banquedb1'

app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'Passersecret'
app.config['JWT_SECRET_KEY'] = 'passerjwzsecret'


db = SQLAlchemy(app)

class Users(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    prenom = db.Column(db.String(50))
    nom = db.Column(db.String(50))
    email = db.Column(db.String(50))
    password = db.Column(db.String(50))
    berenger = db.Column(db.String(50))


    def save_to_db(self):
        db.session.add(self)
        db.session.commit()
    
    @classmethod
    def find_by_email(cls,email):
        return cls.query.filter_by(email = email).first()


    @classmethod
    def return_all(cls):
        def to_json(x):
            return {
                    'id': x.id,
                    'prenom': x.prenom,
                    'nom': x.nom,
                    'email': x.email
                 
             }
        return {'users': list(map(lambda x: to_json(x), Users.query.all()))}
    @classmethod
    def delete_all(cls):
        try:
            num_rows_deleted = db.session.query(cls).delete()
            db.session.commit()
            return {'message': '{} row(s) deleted' .format(num_rows_deleted)}
        except:
            return {'message': 'Something went wrong'}


class Compte(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    prenom = db.Column(db.String(50))
    nom = db.Column(db.String(50))
    email = db.Column(db.String(50))
    password = db.Column(db.String(50))
    solde = db.Column(db.String(50))


    def save_to_db(self):
        db.session.add(self)
        db.session.commit()

    @classmethod
    def find_by_email(cls,email):
        return cls.query.filter_by(email = email).first()


    @classmethod
    def return_all(cls):
        def to_json(x):
            return {
                    'id': x.id,
                    'prenom': x.prenom,
                    'nom': x.nom,
                    'email': x.email,
                    'solde': x.solde

             }
        return {'comptes': list(map(lambda x: to_json(x), Compte.query.all()))}


def versement(email,montant):
    compte=Compte.query.filter_by(email=email).first()
    if compte == None:
        return {'message':'Compte n existe pas' }
    else:
        somme_init = compte.solde
        nouveau_solde = float(somme_init) + float(montant)
        compte.solde = nouveau_solde
        db.session.commit()
        return {'message': 'Le nouveau solde est : {} '.format(compte.solde)}

#fonction_virement
def virement(email_expeditaire,email_destinataire,montant):
    compte_expeditaire=Compte.query.filter_by(email=email_expeditaire).first()
    if compte_expeditaire == None:
        return {'message':'L expeditaire n existe pas' }
    elif (compte_expeditaire.solde > montant):
            solde_init = compte_expeditaire.solde
            nouveau_solde_expeditaire = float(solde_init) - float(montant)
            compte_destinataire = Compte.query.filter_by(email=email_destinataire).first()
            if compte_destinataire == None:
                return {'message': 'Le destinataire n existe pas'}
            else:
                solde_init_destinataire=compte_destinataire.solde
                nouveau_solde_destinataire=float(solde_init_destinataire) + float(montant)
                compte_expeditaire.solde=nouveau_solde_expeditaire
                compte_destinataire.solde=nouveau_solde_destinataire
                db.session.commit()
                return {'message':'Votre nouveau solde est {}'.format(compte_expeditaire.solde)}
    else:
        return {'message':'Montant inferieur'}

#fin_virement

#retrait
def retrait(email,montant):
    compte=Compte.query.filter_by(email=email).first()
    if compte == None:
        return {'message':'Compte n existe pas' }
    else:
         somme_init = compte.solde
         nouveau_solde = float(somme_init)  - float(montant)
         compte.solde = nouveau_solde
         db.session.commit()
         return {'message':'le nouveau solde est {}'.format(compte.solde)}



@api.route('/register')
class UserRegistration(Resource):
    @api.doc(parser=parser)
    def post(self):
        data = parser.parser_args()
        if Users.find_by_email(data['email']):
            return {'message': 'Users {} already exists'.format(data['email'])}
        new_user = Users(
                prenom = data['prenom'],
                nom = data['prenom'],
                email = data['email'],
                password = data['password'],
                admin = False
        )
        try:
           new_user.save_to_db()
           access_token = create_access_token(identity = data['email'])
           return {
                'message': 'User {} was created '.format( data['prenom']),
                'access_token': access_token
            }
        except:
           return {'message': 'Soemthing went wrong'}

           
@api.route('/users', methods=['GET'])
class DelUsers(Resource):
    def get(self):
        return Users.return_all()

@api.route('/delusers')
class DelUsers(Resource):
    def delete(self):
        return Users.delete_all()


@api.route('/consulter/<int:id>')
class ConsulterSolde(Resource):
    def get(self, id):
        return return_one(id)


@api.route('/supprimer/<int:id>')
class Supprimer(Resource):
    def delete(self, id):
        return delete_one(id)


@api.route('/affichecomptes')
class AllCompte(Resource):
    def get(self):
        return Compte.return_all()


@api.route('/versement')
class VersementCompte(Resource):
    @api.doc(parser=parser_versement)
    def put(self):
        data = parser_versement.parse_args()
        return versement(data['email'],data['montant'])
#virement
@api.route('/virement')
class VirementCompte(Resource):
    @api.doc(parser=parser_virement)
    def post(self):
        data = parser_virement.parse_args()
        return virement(data['email_expeditaire'],data['email_destinataire'],data['montant'])

#fin virement

#ressource login
@api.route('/login')
class UserLogin(Resource):
    @api.doc(parser=parser_login)
    def post(self):
        data = parser_login.parse_args()
        current_user = Users.find_by_email(data['email'])

        if not current_user:
            return {'message': 'User {} doesn\'t exist'.format(data['email'])}
        if data['password']==current_user.password:
            access_token = create_access_token(identify = data['email'])
            return {
                    'token':{
                        'message': 'Logged in as {}'.format(current_user.nom),
                        'access_token': access_token
                        }
                    }
        else:
            return {'message': 'Wrong credentials'}






#fin ressoure login

def return_one(id_user):
    compte=Compte.query.filter_by(id=id_user).first()
    if compte == None:
        return {'message':'Compte n existe pas'}
    else:
        return {'message': '{} '.format(compte.solde)}

def delete_one(id_user):
    compte=Compte.query.filter_by(id=id_user).first()
    if compte == None:
        return {'message':'Compte n existe pas'}
    else:
        db.session.delete(compte)
        db.session.commit()
        return {'message': 'Compte {} '.format(compte.id)}
#new

#ressource retrait
@api.route('/retrait')
class RetraitArgent(Resource):
    @api.doc(parser=parser_retrait)
    def put(self):
#        """ressource retrait """
        data = parser_retrait.parse_args()
        return retrait(data['email'],data['montant'])

@api.route('/compte')
class CompteAjout(Resource):
    @api.doc(parser=parser_compte)
    def post(self):
        """ressource pour créer un compte """
        data = parser_compte.parse_args()
        if Compte.find_by_email(data['email']):
            return {'message': 'Compte {} already exists'.format(data['email'])}
        else:
            new_compte = Compte(
                prenom = data['prenom'],
                nom = data['nom'],
                email = data['email'],
                password = data['password'],
                solde = data['solde']
            )
            try:
                new_compte.save_to_db()
                return {
                    'compte': {
                            'id': '',
                            'prenom': data['prenom'],
                            'nom': data['nom'],
                            'email': data['email'],
                            'password': data['password'],
                            'solde': data['solde']
                    }
                }
            except:
                return {'message': 'Something went wrong'}



if __name__ == '__main__':
    app.run(port= 8080, debug = True, host='0.0.0.0')
