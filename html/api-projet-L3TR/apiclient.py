from flask import Flask
from flask import jsonify
from flask_sqlalchemy import SQLAlchemy
from apitrans import Compte, transfert
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
parser_transfere = reqparse.RequestParser()
parser_transfere.add_argument('numero_client', help = 'numero_client', required = True)
parser_transfere.add_argument('numero_dest', help = 'numero_dest', required = True)
parser_transfere.add_argument('credit', help = 'credit', required = True)


#parser achat
parser_achat = reqparse.RequestParser()
parser_achat.add_argument('numero_fournisseur', help = 'numero_fournisseur', required = True)
parser_achat.add_argument('nom', help = 'nom', required = True)
parser_achat.add_argument('prenom', help = 'prenom', required = True)
parser_achat.add_argument('email', help = 'email', required = True)
parser_achat.add_argument('password', help = 'password', required = True)
parser_achat.add_argument('numero_revendeur', help = 'numero_revendeur', required = True)
parser_achat.add_argument('credit', help = 'credit', required = True)

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


def transferer(numero_client,numero_dest,credit):
    compte_client=Compte.query.filter_by(numero=numero_client).first()
    if compte_client == None:
        return {'message':'le numero client n existe pas'}
    elif (float(compte_client.solde) > float(credit)):
        solde_init = compte_client.solde
        nouveau_solde_client = float(solde_init) - float(credit)
        compte_dest = Compte.query.filter_by(numero=numero_client).first()
        if compte_client == None:
            return {'message': 'le numero du destinateur n existe pas'}
        else:
            solde_init_dest=compte_dest.solde
            nouveau_solde_dest = float(solde_init_dest) + float(credit)
            compte_client.solde=nouveau_solde_client
            compte_client.solde=nouveau_solde_dest
            db.session.commit()
            return {'message':'votre transfert est effectué avec succés donc votre nouveau solde est maintenant :{} FCFA'.format(compte_client.solde)}
    else:
        return {'message':'votre credit est inferieur'}



#pour la ressource  transferer

@api.route('/Transferer_Destinateur')
class Transfere(Resource):
    @api.doc(parser=parser_transfere)
    def put(self):
        data = parser_transfere.parse_args()
        return transferer(data['numero_client'],data['numero_dest'],data['credit'])

if __name__ == '__main__':
    app.run(port= 8080, debug = True, host='0.0.0.0')

