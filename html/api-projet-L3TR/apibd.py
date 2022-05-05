from flask import Flask
from flask import jsonify
from flask_sqlalchemy import SQLAlchemy
from flask_restx import Api,fields,Resource,reqparse
from flask_jwt_extended import JWTManager
from flask_jwt_extended import create_access_token, create_refresh_token, jwt_required, get_jwt_identity

#c est l etape de declaration de notre application (api)
app = Flask(__name__)
api = Api(app)

jwt = JWTManager(app)

#c est la partie ou on declare les parametre des decoration  qui vont decorer nos methodes(nos ressources)
parser = reqparse.RequestParser()
parser.add_argument('prenom', help = 'le prenom du user', required = True)
parser.add_argument('nom', help = 'nom', required = True)
parser.add_argument('email', help = 'email', required = True)
parser.add_argument('password', help = 'mot de passe', required = True)

#parser compte
parser_compte = reqparse.RequestParser()
parser_compte.add_argument('prenom', help = 'le prenom du user', required = True)
parser_compte.add_argument('nom', help = 'nom', required = True)
parser_compte.add_argument('email', help = 'email', required = True)
parser_compte.add_argument('password', help = 'mot de passe', required = True)
parser_compte.add_argument('solde', help = 'solde', required = True)

#parser login
parser_login = reqparse.RequestParser()
parser_login.add_argument('email', help = 'email', required = True)
parser_login.add_argument('password', help = 'mot de passe', required = True)

#parser versement
parser_versement = reqparse.RequestParser()
parser_versement.add_argument('email', help = 'email', required = True)
parser_versement.add_argument('montant', help = 'montant', required = True)

#parser virement
parser_virement = reqparse.RequestParser()
parser_virement.add_argument('email_exp', help = 'email_exp', required = True)
parser_virement.add_argument('email_dest', help = 'email_dest', required = True)
parser_virement.add_argument('montant', help = 'montant', required = True)

#parser retrait
parser_retrait = reqparse.RequestParser()
parser_retrait.add_argument('email', help = 'email', required = True)
parser_retrait.add_argument('montant', help = 'montant', required = True)




app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://toto:passer123_@localhost/banquedb'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'passersecret'
app.config['JWT_AUTH_USERNAME_KEY'] = 'email'
app.config['JWT_SECRET_KEY'] = 'passerjwtsecret'

db = SQLAlchemy(app)
class Users(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    prenom = db.Column(db.String(50))
    nom = db.Column(db.String(50))
    email = db.Column(db.String(50))
    password = db.Column(db.String(50))
    admin = db.Column(db.Boolean)
    
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
                }
            return {'users': list(map(lambda x: to_json(x), Users.query.all()))}
#@classmed est un decorateur,ça permet de decorer , et un decorateur est toujours proceder d un @
    @classmethod
    def delete_all(cls):
        try:
            num_roxws_deleted = db.session.query(cls).delete()
            db.session.commit()
            return {'message': '{} row(s) deleted'.format(num_rows_deleted)}
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
            access_token = create_access_token(identity = data['email'])
            return {
                'token':{
                    'message': 'logged in as {}'.format(current_user.nom),

                    'access_token': access_token
                }
            }
        else:
            return {'message': 'Wrong credentials'}




@api.route('/register')
class UserRegistration(Resource):
    @api.doc(parser=parser)
    def post(self):
        data = parser.parse_args()
        if Users.find_by_email(data['email']):
            return {'message': 'user {} already exists'.format(data['email'])}
        new_user = Users(
                prenom = data['prenom'],
                nom = data['nom'],
                email = data['email'],
                password = data['password'],
                admin = False
            )
        try:
            new_user.save_to_db()
            access_token = create_access_token(identity = data['email'])
            return {
                'message': 'User {} was created '.format( data['prenom']),
                'access_token':access_token
            }
        except:
            return {'message': 'something went wrong'}


@api.route('/compte')
class CompteAjout(Resource):
    @api.doc(parser=parser_compte)
    def post(self):
        """ressource pour creer un compte"""
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
                        'id':'',
                        'prenom': data['prenom'],
                        'nom': data['nom'],
                        'email': data['email'],
                        'password': data['password'],
                        'solde': data['solde']
                     }
            }
        except:
            return {'message': 'something went wrong'}







def return_one(id_user):
    compte=Compte.query.filter_by(id=id_user).first()
    if compte == None:
        return {'message':'Compte n existe pas'}
    else:
        return {'message': ' {} '.format(compte.solde)}


def delete_one(id_user):
    compte=Compte.query.filter_by(id=id_user).first()
    if compte == None:
        return {'message':'Compte n existe pas' }
    else:
        db.session.delete(compte)
        db.session.commit()
        return {'message': 'Compte {} '.format(compte.id)}



#les resources


@api.route('/users', methods=['GET'])
class AllUsers(Resource):
    def get(self):
        return Users.return_all()






@api.route('/delusers')
class DelUsers(Resource):
    def delete(self):
        return Users.delete_all()




#pour consulter notre solde

@api.route('/consulter/<int:id>')
class ConsulterSolde(Resource):
    def get(self,id):
        return return_one(id)


#pour supprimer le solde
@api.route('/supprimer/<int:id>')
class SupprimerSolde(Resource):
    def delete(self,id):
        return delete_one(id)

#pour afficher les comptes

@api.route('/affichecomptes')
class AllCompte(Resource):
    def get(self):
        return Compte.return_all()





#methode versement

def versement(email,montant):
    compte=Compte.query.filter_by(email=email).first()
    if compte == None:
        return {'message':'Compte n existe pas'}
    else:
        somme_init = compte.solde
        nouveau_solde = float(somme_init) + float(montant)
        compte.solde = nouveau_solde
        db.session.commit()
        return {'message': 'le nouveau solde est : {}'.format(compte.solde)}



#methode retrait

def retrait(email,montant):
    compte=Compte.query.filter_by(email=email).first()
    if compte == None:
        return {'message':'Compte n existe pas'}
    else:
        somme_init = compte.solde
        nouveau_solde = float(somme_init) - float(montant)
        compte.solde = nouveau_solde
        db.session.commit()
        return {'message': 'le nouveau solde est : {}'.format(compte.solde)}




#pour la methode virement

def virement(email_exp,email_dest,montant):
    compte_exp=Compte.query.filter_by(email=email_exp).first()
    if compte_exp == None:
        return {'message':'l expeditaire n existe pas'}
    elif (float(compte_exp.solde) > float(montant)):
        solde_init = compte_exp.solde
        nouveau_solde_exp = float(solde_init) - float(montant)
        compte_dest = Compte.query.filter_by(email=email_dest).first()
        if compte_dest == None:
            return {'message': 'le destinataire n existe pas'}
        else:
            solde_init_dest=compte_dest.solde
            nouveau_solde_dest = float(solde_init_dest) + float(montant)
            compte_exp.solde=nouveau_solde_exp
            compte_dest.solde=nouveau_solde_dest
            db.session.commit()
            return {'message':'votre nouveau solde est maintenant :{}'.format(compte_exp.solde)}
    else:
        return {'message':'montant inferieur'}





@api.route('/register')
class UserRegistration(Resource):
    @api.doc(parser=parser)
    def post(self):
        data = parser.parse_args()


#pour la ressource versement

@api.route('/versement')
class VersementCompte(Resource):
    @api.doc(parser=parser_versement)
    def put(self):
        data = parser_versement.parse_args()
        return versement(data['email'],data['montant'])



#pour la ressource  virement

@api.route('/virement')
class VirementCompte(Resource):
    @api.doc(parser=parser_virement)
    def put(self):
        data = parser_virement.parse_args()
        return virement(data['email_exp'],data['email_dest'],data['montant'])



#pour la ressource  retrait

@api.route('/retrait')
class RetraitArgent(Resource):
    @api.doc(parser=parser_retrait)
    def put(self):
        data = parser_retrait.parse_args()
        return retrait(data['email'],data['montant'])



if __name__ == '__main__':
    app.run(port= 8080, debug = True, host='0.0.0.0')




