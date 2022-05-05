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
parser_compte.add_argument('prenom', help = 'le prenom', required = True)
parser_compte.add_argument('nom', help = 'nom', required = True)
parser_compte.add_argument('email', help = 'email', required = True)
parser_compte.add_argument('numero', help = 'numero', required = True)
parser_compte.add_argument('password', help = 'mot de passe', required = True)
parser_compte.add_argument('typecompte', help = 'typecompte', required = True)
parser_compte.add_argument('solde', help = 'solde', required = True)

#parser transferer
parser_transfert = reqparse.RequestParser()
parser_transfert.add_argument('numero_fournisseur', help = 'numero_fournisseur', required = True)
parser_transfert.add_argument('numero_client', help = 'numero_client', required = True)
parser_transfert.add_argument('credit', help = 'credit', required = True)


#parser vente
parser_vente = reqparse.RequestParser()
parser_vente.add_argument('numero_fournisseur', help = 'numero_fournisseur', required = True)
parser_vente.add_argument('nom', help = 'nom', required = True)
parser_vente.add_argument('prenom', help = 'prenom', required = True)
parser_vente.add_argument('email', help = 'email', required = True)
parser_vente.add_argument('password', help = 'password', required = True)
parser_vente.add_argument('numero_revendeur', help = 'numero_revendeur', required = True)
parser_vente.add_argument('credit', help = 'credit', required = True)

#parser ajoutersolde
parser_rechargecompte = reqparse.RequestParser()
parser_rechargecompte.add_argument('numero_fournisseur', help = 'numero_fournisseur', required = True)
parser_rechargecompte.add_argument('credit', help = 'credit', required = True)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://berenger:Passer123/@localhost/transaction'

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
    numero = db.Column(db.String(50))
    password = db.Column(db.String(50))
    typecompte = db.Column(db.String(50))
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
                    'numero':x.numero,
                    'typecompte':x.typecompte,
                    'solde': x.solde
                }
        return {'comptes': list(map(lambda x: to_json(x), Compte.query.all()))}



@api.route('/Utilisateurs')
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


@api.route('/Compte')
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
                    numero = data['numero'],
                    password = data['password'],
                    typecompte = data['typecompte'],
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
                        'numero' : data['numero'],
                        'password': data['password'],
                        'typecompte' : data['typecompte'],
                        'solde': data['solde']
                     }
            }
        except:
            return {'message': 'something went wrong'}




def return_one(id_user):
    compte=Compte.query.filter_by(numero=id_user).first()
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




#pour consulter notre solde

@api.route('/ConsulterSolde/<int:numero>')
class ConsulterSolde(Resource):
    def get(self,numero):
        return return_one(numero)



#pour supprimer un compte

@api.route('/SupprimerCompte/<int:id>')
class SupprimerSolde(Resource):
    def delete(self,id):
        return delete_one(id)

#pour afficher les comptes

@api.route('/AfficheComptes')
class AllCompte(Resource):
    def get(self):
        return Compte.return_all()


#pour la methode transferer

def transfert(numero_fournisseur,numero_client,credit):
    compte_fournisseur=Compte.query.filter_by(numero=numero_fournisseur).first()
    if compte_fournisseur == None:
        return {'message':'le numero fournisseur n existe pas'}
    elif (float(compte_fournisseur.solde) > float(credit)):
        solde_init = compte_fournisseur.solde
        nouveau_solde_fournisseur = float(solde_init) - float(credit)
        compte_client = Compte.query.filter_by(numero=numero_fournisseur).first()
        if compte_fournisseur == None:
            return {'message': 'le numero du client n existe pas'}
        else:
            solde_init_client=compte_client.solde
            nouveau_solde_client = float(solde_init_client) + float(credit)
            compte_fournisseur.solde=nouveau_solde_fournisseur
            compte_client.solde=nouveau_solde_client
            db.session.commit()
            return {'message':'votre transfert est effectué avec succés donc votre nouveau solde est maintenant :{} FCFA'.format(compte_fournisseur.solde)}
    else:
        return {'message':'votre credit est inferieur'}




#pour la ressource  transfert_client

@api.route('/Transfert_Client')
class Transfert(Resource):
    @api.doc(parser=parser_transfert)
    def put(self):
        data = parser_transfert.parse_args()
        return transfert(data['numero_fournisseur'],data['numero_client'],data['credit'])



#pour la methode ventes
def vente(nom,prenom,email,password,numero_fournisseur,numero_revendeur,credit):
    compte_fournisseur=Compte.query.filter_by(numero=numero_fournisseur).first()
    if compte_fournisseur == None:
        return {'message':'le fournisseur n existe pas'}
    elif (float(compte_fournisseur.solde) > float(credit)):
        solde_init = compte_fournisseur.solde
        nouveau_solde_fournisseur = float(solde_init) - float(credit)
        compte_revendeur = Compte.query.filter_by(numero=numero_revendeur).first()
        if compte_revendeur == None:
            return {'message': 'le client n existe pas'}
        else:
            solde_init_revendeur=compte_revendeur.solde
            nouveau_solde_revendeur = float(solde_init_revendeur) + float(credit)
            compte_fournisseur.solde=nouveau_solde_fournisseur
            compte_revendeur.solde=nouveau_solde_revendeur
            db.session.commit()
            return {'message':'vous avez effectué un achat donc il vous reste maintenant :{} FCFA'.format(compte_fournisseur.solde)}
    else:
        return {'message':'votre credit inferieur'}


#pour la ressource  ventes
@api.route('/Vente_Credit')
class Vente(Resource):
    @api.doc(parser=parser_vente)
    def put(self):
        data = parser_vente.parse_args()
        return vente(data['nom'],data['prenom'],data['email'],data['password'],data['numero_fournisseur'],data['numero_revendeur'],data['credit'])



#pour la methode ajout de credit pour l administrateur

def rechargecompte(numero_fournisseur,credit):
    compte_fournisseur=Compte.query.filter_by(numero=numero_fournisseur).first()
    if (numero_fournisseur == "1000"):
        solde_init_fournisseur=compte_fournisseur.solde
        nouveau_solde_fournisseur = float(solde_init_fournisseur) + float(credit)
        compte_fournisseur.solde=nouveau_solde_fournisseur
        db.session.commit()
        return {'message':'vous avez recharger votre compte et le nouveau solde est maintenant :{} FCFA'.format(compte_fournisseur.solde)}

    else:
        return {'message': 'tu n es pas fournisseur'}
    
@api.route('/RechargeCompte')
class Rechargecompte(Resource):
    @api.doc(parser=parser_rechargecompte)
    def put(self):
        data = parser_rechargecompte.parse_args()
        return rechargecompte(data['numero_fournisseur'],data['credit'])



if __name__ == '__main__':
    app.run(port= 8080, debug = True, host='0.0.0.0')
