from flask import Flask
from flask import jsonify
from apitrans import Compte, transfert, vente
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

#parser transferer
parser_transfert = reqparse.RequestParser()
parser_transfert.add_argument('numero_revendeur', help = 'numero_revendeur', required = True)
parser_transfert.add_argument('numero_client', help = 'numero_client', required = True)
parser_transfert.add_argument('credit', help = 'credit', required = True)

#parser vente
parser_reventes = reqparse.RequestParser()
parser_reventes.add_argument('numero_revendeur', help = 'numero_revendeur', required = True)
parser_reventes.add_argument('numero_client', help = 'numero_client', required = True)
parser_reventes.add_argument('credit', help = 'credit', required = True)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://berenger:Passer123/@localhost/transaction'

app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
app.config['SECRET_KEY'] = 'passersecret'
app.config['JWT_AUTH_USERNAME_KEY'] = 'email'
app.config['JWT_SECRET_KEY'] = 'passerjwtsecret'
db = SQLAlchemy(app)
def return_one(id_user):
    compte=Compte.query.filter_by(numero=id_user).first()
    if compte == None:
        return {'message':'Compte n existe pas'}
    else:
        return {'message': ' {} '.format(compte.solde)}

#pour consulter notre solde

@api.route('/ConsulterSolde/<int:numero>')
class ConsulterSolde(Resource):
    def get(self,numero):
        return return_one(numero)


#pour la ressource  transferer
def transfert(numero_revendeur,numero_client,credit):
    compte_revendeur=Compte.query.filter_by(numero=numero_revendeur).first()
    if compte_revendeur == None:
        return {'message':'le numero revendeur n existe pas'}
    elif (float(compte_revendeur.solde) > float(credit)):
        solde_init = compte_revendeur.solde
        nouveau_solde_revendeur = float(solde_init) - float(credit)
        compte_client = Compte.query.filter_by(numero=numero_revendeur).first()
        if compte_revendeur == None:
            return {'message': 'le numero du client n existe pas'}
        else:
            solde_init_client=compte_client.solde
            nouveau_solde_client = float(solde_init_client) + float(credit)
            compte_revendeur.solde=nouveau_solde_revendeur
            compte_client.solde=nouveau_solde_client
            db.session.commit()
            return {'message':'votre transfere est effectué avec succés donc votre nouveau solde est maintenant :{} FCFA'.format(compte_revendeur.solde)}
    else:
        return {'message':'votre credit est inferieur'}




#pour la ressource  transfert_client

@api.route('/Transfert_Client')
class Transfert(Resource):
    @api.doc(parser=parser_transfert)
    def put(self):
        data = parser_transfert.parse_args()
        return transfert(data['numero_revendeur'],data['numero_client'],data['credit'])

#pour la methode achats

def reventes(numero_revendeur,numero_client,credit):
    compte_revendeur=Compte.query.filter_by(numero=numero_revendeur).first()
    if compte_revendeur == None:
        return {'message':'le revendeur n existe pas'}
    elif (float(compte_revendeur.solde) > float(credit)):
        solde_init = compte_revendeur.solde
        nouveau_solde_revendeur = float(solde_init) - float(credit)
        compte_client = Compte.query.filter_by(numero=numero_client).first()
        if compte_client == None:
            return {'message': 'le client n existe pas'}
        else:
            solde_init_client=compte_client.solde
            nouveau_solde_client = float(solde_init_client) + float(credit)
            compte_revendeur.solde=nouveau_solde_revendeur
            compte_client.solde=nouveau_solde_client
            db.session.commit()
            return {'message':'vous avez effectué un transfert donc il vous reste maintenant :{} FCFA'.format(compte_revendeur.solde)}
    else:
        return {'message':'votre credit est inferieur'}





#pour la ressource  ventes

@api.route('/Reventes')
class Reventes(Resource):
    @api.doc(parser=parser_reventes)
    def put(self):
        data = parser_reventes.parse_args()
        return reventes(data['numero_revendeur'],data['numero_client'],data['credit'])


if __name__ == '__main__':
    app.run(port= 8080, debug = True, host='0.0.0.0')
