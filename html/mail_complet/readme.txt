Formulaire de contact avec masque de saisi, recuperation données, envoi mail des données + mail confirmation de contact-----------------------------------------------------------------------------------------------------------------------
Url     : http://codes-sources.commentcamarche.net/source/45392-formulaire-de-contact-avec-masque-de-saisi-recuperation-donnees-envoi-mail-des-donnees-mail-confirmation-de-contactAuteur  : fifiriri123Date    : 04/08/2013
Licence :
=========

Ce document intitulé « Formulaire de contact avec masque de saisi, recuperation données, envoi mail des données + mail confirmation de contact » issu de CommentCaMarche
(codes-sources.commentcamarche.net) est mis à disposition sous les termes de
la licence Creative Commons. Vous pouvez copier, modifier des copies de cette
source, dans les conditions fixées par la licence, tant que cette note
apparaît clairement.

Description :
=============

C'est la 1&egrave;re fois que je poste une source. Apr&egrave;s bcp d'heures de 
W et bcp d'aide trouv&eacute; sur ce site, je vous transmets le r&eacute;sultat 
:
<br />
<br />Formulaire compl&ecirc;t comprenant : contact.htm
<br />- Menu
s d&eacute;roulants (tous les d&eacute;partements de France, tous les pays du mo
nde) avec incorporation de couleurs diff&eacute;rentes &agrave; l'int&eacute;rie
ur des options
<br />- Boutons radio, champs texte (avec ou non limite de carat
&egrave;re), cases &agrave; cocher, mail
<br />- Faire appara&icirc;tre des bou
tons radio et/ou champ texte &agrave; partir d'un bouton radio
<br />- Masque d
e saisi t&eacute;l&eacute;phone, date (adapt&eacute; de iubito. Merci &agrave; l
ui)
<br />fichier attach&eacute; : mask.js
<br />- champs obligtoires (adapt&e
acute; de bultez avec v&eacute;rification des champs et changment de couleur. Me
rci &agrave; lui)
<br />fichier attach&eacute; : conform.js
<br />- v&eacute;r
ification validit&eacute; du mail (adapt&eacute; de iubito. Merci &agrave; lui)

<br />
<br />Envoi des donn&eacute;es : envoi.php
<br />- r&eacute;cup&egrave
;re les variables de tous les champs du formulaire &agrave; partir du name ou id

<br />- v&eacute;rification des champs obligatoires (plus simple si on ne veut
 pas utiliser la solution de bultez)
<br />- envoi d'un mail HTML qui contient 
les donn&eacute;es class&eacute;es (rang&eacute;es)
<br />- envoi d'un mail de 
confirmation au client de r&eacute;ception de sa demande (contenu modifiable ave
c possible de personnaliser son contenu)
<br />
<br />Soit en tout 4 fichiers 
:
<br />contact.htm
<br />envoi.php
<br />conform.js
<br />mask.js
<br />

<br />Voici le bilan de ce travail ! J'esp&egrave;re que d'autre pourrons en pro
fiter car il a fallu un mois de travail pour r&eacute;aliser et faire marcher to
us ces &eacute;l&eacute;ments ensemble.
<br /><a name='source-exemple'></a><h2>
 Source / Exemple : </h2>
<br /><pre class='code' data-mode='basic'>
PREMIERE
 ETAPE :

fichier contact.htm : Placer le code suivant dans un page que vous n
ommez contact.htm

&lt;HTML&gt;
&lt;HEAD&gt;

&lt;TITLE&gt;&lt;/TITLE&gt;


&lt;script language=&quot;JavaScript&quot; type=&quot;text/JavaScript&quot;&gt
;
&lt;!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window
.open(theURL,winName,features);
}//--&gt;
&lt;/script&gt;

&lt;!--scipt pour
 le masque du numéro téléphone, date et mail--&gt;
&lt;script language=&quot;Ja
vaScript1.2&quot; src=&quot;masks.js&quot;&gt;&lt;/script&gt;

&lt;script lang
uage=&quot;JavaScript1.2&quot;&gt;
&lt;!--//
var bShowTests = true;
var oResu
lts = 
{
&quot;browser&quot;: 
	{
	&quot;userAgent&quot;: navigator.userAgen
t,
	&quot;appName&quot;: navigator.appName,
	&quot;appVersion&quot;: navigator
.appVersion,
	&quot;appCodeName&quot;: navigator.appCodeName
	},
&quot;string
&quot;: [],
&quot;date&quot;: [],
&quot;number&quot;: []
};
	
function writ
eOutput(v)
{
document.write(v + &quot;&lt;br /&gt;&quot;);
}
	
function upd
ateResults(m, v, e)
{
if( m.value != e )
	{
	var i = oResults[m.type].length
;
			oResults[m.type][i] = 
			{
			&quot;supplied&quot;: v,
			&quot;value&
quot;: m.value,
			&quot;expected&quot;: e,
			&quot;error&quot;: m.error.join
(&quot;|&quot;),
			&quot;mask&quot;: m.mask
			};
		}
	}
	
function postR
esults()
{
if( oResults.string.length + oResults.date.length + oResults.number
.length == 0 ) return alert(&quot;No errors to report!&quot;);
// form object

var oForm = document.frmReport;
// create serializer object
var oSerializer = 
new WddxSerializer();
// serialize WDDX packet
oForm.wddx.value = oSerializer.
serialize(oResults);
oForm.submit();
}

function stringTest(v, m, e)
{
if(
 !bShowTests ) return false;
var oMask = new Mask(m);
writeOutput(&quot;&lt;b&
gt;mask:&lt;/b&gt; &quot;  + m);
writeOutput(&quot;&lt;b&gt;string:&lt;/b&gt; &
quot; + v);
var n = oMask.format(v);
if( e != n ) document.write(&quot;&lt;fon
t color=red&gt;&quot;);
writeOutput(&quot;&lt;b&gt;result:&lt;/b&gt; &quot; + n
);
writeOutput(&quot;&lt;b&gt;expected:&lt;/b&gt; &quot; + e);
if( e != n ) do
cument.write(&quot;&lt;/font&gt;&quot;);
writeOutput(&quot;&lt;b&gt;error:&lt;/
b&gt; &quot; + ((oMask.error.length == 0) ? &quot;n/a&quot; : oMask.error.join(&
quot;&lt;br&gt;&quot;)));
writeOutput(&quot;&quot;);
updateResults(oMask, v, e
);
}

function numberTest(v, m, e)
{
if( !bShowTests ) return false;
var o
Mask = new Mask(m, &quot;number&quot;);
writeOutput(&quot;&lt;b&gt;mask:&lt;/b&
gt; &quot;  + m);
writeOutput(&quot;&lt;b&gt;string:&lt;/b&gt; &quot; + v);
va
r n = oMask.format(v);
if( e != n ) document.write(&quot;&lt;font color=red&gt;
&quot;);
writeOutput(&quot;&lt;b&gt;result:&lt;/b&gt; &quot; + n);
writeOutput
(&quot;&lt;b&gt;expected:&lt;/b&gt; &quot; + e);
if( e != n ) document.write(&q
uot;&lt;/font&gt;&quot;);
writeOutput(&quot;&lt;b&gt;error:&lt;/b&gt; &quot; + 
((oMask.error.length == 0) ? &quot;n/a&quot; : oMask.error.join(&quot;&lt;br&gt;
&quot;)));
writeOutput(&quot;&quot;);
updateResults(oMask, v, e);
}

functi
on dateTest(v, m, e)
{
if( !bShowTests ) return false;
var oMask = new Mask(m
, &quot;date&quot;);
writeOutput(&quot;&lt;b&gt;mask:&lt;/b&gt; &quot;  + m);

writeOutput(&quot;&lt;b&gt;string:&lt;/b&gt; &quot; + v);
var n = oMask.format(
v);
if( e != n ) document.write(&quot;&lt;font color=red&gt;&quot;);
writeOutp
ut(&quot;&lt;b&gt;result:&lt;/b&gt; &quot; + n);
writeOutput(&quot;&lt;b&gt;exp
ected:&lt;/b&gt; &quot; + e);
if( e != n ) document.write(&quot;&lt;/font&gt;&q
uot;);
writeOutput(&quot;&lt;b&gt;error:&lt;/b&gt; &quot; + ((oMask.error.lengt
h == 0) ? &quot;n/a&quot; : oMask.error.join(&quot;&lt;br&gt;&quot;)));
writeOu
tput(&quot;&quot;);
updateResults(oMask, v, e);
}

function init()
{
docum
ent.monform.reset();
// Création du masque de téléphone ##.##.##.##.##
oString
Mask = new Mask(&quot;##.##.##.##.##&quot;, &quot;string&quot;);
	
// Associer
 la fonction oStringMask aux 2 champs &quot;portable&quot; et &quot;fixe&quot;

oStringMask.attach(document.monform.portable);
oStringMask.attach(document.monf
orm.fixe);
		
// Création du masque de date jj/mm/aaaa
oDateMask = new Mask(&
quot;dd/mm/yyyy&quot;, &quot;date&quot;);
		
// Associer la fonction oDateMask
 au champs &quot;date&quot;
oDateMask.attach(document.monform.date);
		
// Cr
éation du masque number &quot;$#,###.00&quot;
oNumberMask = new Mask(&quot;$#,#
##.00&quot;, &quot;number&quot;);
		
// Associer la fonction oNumberMask au ch
amps &quot;number&quot;
oNumberMask.attach(document.monform.number);
}
//--&g
t;
&lt;/script&gt;
	
&lt;script	type=&quot;text/javascript&quot;src=&quot;Con
Form.js&quot;&gt;
			
&lt;script type=&quot;text/javascript&quot;&gt;
functio
n ok()
{ 
alert (&quot;tous les contrôles sont bons&quot;); 
}
&lt;/script&g
t;

&lt;!--script boutons actif/masqué--&gt;
&lt;script language=&quot;Javasc
ript&quot;&gt;
// ==================
//	Activations - Désactivations
// =====
=============
function GereControle(Controleur, Controle, Masquer) 
{
var obj
Controleur = document.getElementById(Controleur);
var objControle = document.ge
tElementById(Controle);
if (Masquer=='1')
objControle.style.visibility=(objCon
troleur.checked==true)?'visible':'hidden';
else
objControle.disabled=(objContr
oleur.checked==true)?false:true;
return true;
}
&lt;/script&gt;

&lt;script
 language=&quot;JavaScript&quot;&gt;
&lt;!--
//PLF-<a href='http://www.jejavas
cript.net/' target='_blank'>http://www.jejavascript.net/</a>

function valider
() 
{
var form_err = &quot; &quot;
//Remplacer partout dans ce script monform
 par le nom de votre formulaire
if ( document.monform.mail.value.length &lt; 1)
 
     {
     form_err = &quot;Email invalide ! - &quot;;
     }
if ( docume
nt.monform.mail.value == &quot;votrenom@mail.com&quot;) 
     {
     form_err 
= &quot;Email invalide ! - &quot;;
     }
var verim = 0;
for (i=1; i&lt;docum
ent.monform.mail.value.length -4; i++) 
     {
if ( document.monform.mail.valu
e.charAt(i) == &quot;@&quot;) 
          {
           verim = 1;
          }

     } 
if ( verim == 0) 
     {
     form_err = &quot;Email invalide ! - \n
&quot;;
     } 
if ( document.monform.nom.value.length &lt; 1) 
     {
     
form_err += &quot;Veuillez entrer votre Nom. - \n&quot;;
     }
if ( document.
monform.prenom.value.length &lt; 1) 
     {
     form_err += &quot;Veuillez en
trer votre Prenom. - \n&quot;;
     } 
if ( document.monform.ville_actuelle.va
lue.length &lt; 1) 
     {
form_err += &quot;Veuillez entrer votre ville. - \n
&quot;;
     } 
//--&gt; if(!form.case_a_cocher.checked) alert('Vous devez coc
her la case !');
} 
if ( form_err != &quot; &quot;) 
{
alert(form_err);
ret
urn false;
}
return true 
}
//--&gt;
&lt;/script&gt;

&lt;/head&gt;

&l
t;!-- initialise le script pour les masques telephone, date, mail et nombre et p
our le controle d'affichage des champs--&gt;

&lt;body onLoad=&quot;GereContro
le('derniere_classe','totalite','1'); GereControle('derniere_classe','arret','1'
); GereControle('derniere_classe','derniere','1'); init(); &quot;&gt;   
 
&lt
;p align=&quot;center&quot;&gt;&amp;nbsp;FICHE CONTACT&lt;/p&gt;

&lt;form act
ion=&quot;envoi.php&quot; method=&quot;post&quot; name=&quot;monform&quot; onSub
mit=&quot;return (ConForm(this));&quot;&gt;

&lt;table width=&quot;599&quot; b
order=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;
&lt
;tbody&gt;&lt;tr bordercolor=&quot;1&quot;&gt;&lt;td align=&quot;center&quot;&gt
;* Champs Obligatoires&lt;/td&gt;
&lt;td bgcolor=&quot;#FFCACA&quot; align=&quo
t;center&quot;&gt;&lt;strong&gt; Votre identité : &lt;/strong&gt;&lt;/td&gt;&lt;
/tr&gt;
		
&lt;tr&gt;&lt;td align=&quot;right&quot; height=&quot;22&quot; bgco
lor=&quot;#E8E8E8&quot;&gt;*&lt;/td&gt;
&lt;td width=&quot;433&quot; colspan=&q
uot;2&quot;&gt;
&lt;input type=radio name=&quot;civil&quot; lang=&quot;type:rad
io;erreur:- Merci de renseigner votre situation familiale;erreurfond:red;&quot; 
value=&quot;Mme&quot;/&gt;Mme
&lt;input type=radio name=&quot;civil&quot; value
=&quot;Mlle&quot;/&gt;Mlle
&lt;input type=radio name=&quot;civil&quot; value=&q
uot;Mr&quot;/&gt;Mr&lt;/tr&gt;
	  
&lt;tr&gt;&lt;td width=&quot;166&quot; alig
n=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt; *Nom :&lt;/td&gt;
&lt;td co
lspan=&quot;2&quot;&gt;
&lt;input size=&quot;30&quot; name=&quot;nom&quot; lang
=&quot;erreurfond:#FF0000;mini:2;maxi:30;type:obligatoire;erreur:- Merci de mett
re votre Nom&quot; /&gt;&lt;/tr&gt;
      
&lt;tr&gt;&lt;td width=&quot;166&qu
ot; align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt; *Prénom :&lt;/td&gt;

&lt;td&gt;
&lt;input size=&quot;30&quot; name=&quot;prenom&quot; lang=&quot;n
om:;erreurfond:#FF0000;mini:2;	maxi:30;type:obligatoire;erreur:- Merci de mettre
 votre Prénom&quot;/&gt;&lt;/tr&gt;

&lt;tr&gt;&lt;td align=&quot;right&quot; 
bgcolor=&quot;#E8E8E8&quot;&gt; *Date de naissance :&lt;/td&gt;        
&lt;td&
gt;
&lt;select name=&quot;jour_naissance&quot; lang=&quot;erreurfond:#FF0000;ty
pe:liste;erreur:- Renseigner votre jour de naissance&quot; size=&quot;1&quot;&gt
;
&lt;!-- option vide permet de laisser un champ vide en premier --&gt; 
&lt;o
ption&gt;
&lt;option&gt;01&lt;option&gt;02&lt;option&gt;03&lt;option&gt;04&lt;o
ption&gt;05&lt;option&gt;06&lt;option&gt;07&lt;option&gt;08&lt;option&gt;09&lt;o
ption&gt;10&lt;option&gt;11
&lt;option&gt;12&lt;option&gt;13&lt;option&gt;14&lt
;option&gt;15&lt;option&gt;16&lt;option&gt;17&lt;option&gt;18&lt;option&gt;19&lt
;option&gt;20&lt;option&gt;21&lt;option&gt;22
&lt;option&gt;23&lt;option&gt;24&
lt;option&gt;25&lt;option&gt;26&lt;option&gt;27&lt;option&gt;28&lt;option&gt;29&
lt;option&gt;30&lt;option&gt;31
&lt;/option&gt;&lt;/select&gt;
		
&lt;select 
name=&quot;mois_naissance&quot; lang=&quot;erreurfond:#FF0000;type:liste;erreur:
- Renseigner votre mois de naissance&quot; size=&quot;1&quot;&gt;
&lt;!-- optio
n vide permet de laisser un champ vide en premier --&gt; 
&lt;option&gt;  
&lt
;option&gt;Janvier&lt;option&gt;Février&lt;option&gt;Mars&lt;option&gt;Avril&lt;
option&gt;Mai&lt;option&gt;Juin&lt;option&gt;Juillet&lt;option&gt;Aout
&lt;opti
on&gt;Septembre&lt;option&gt;Octobre&lt;option&gt;Novembre&lt;option&gt;Décembre

&lt;/option&gt;&lt;/select&gt;
			
&lt;select name=&quot;annee_naissance&quo
t; lang=&quot;erreurfond:#FF0000;type:liste;erreur:- Renseigner votre année de n
aissance&quot; size=&quot;1&quot;&gt;
&lt;!-- option vide permet de laisser un 
champ vide en premier --&gt; 
&lt;option&gt;
&lt;option&gt;1960&lt;option&gt;1
961&lt;option&gt;1962&lt;option&gt;1963&lt;option&gt;1964&lt;option&gt;1965&lt;o
ption&gt;1966&lt;option&gt;1967&lt;option&gt;1968
&lt;option&gt;1969&lt;option&
gt;1970&lt;option&gt;1971&lt;option&gt;1972&lt;option&gt;1973&lt;option&gt;1974&
lt;option&gt;1975&lt;option&gt;1976&lt;option&gt;1977
&lt;option&gt;1978&lt;opt
ion&gt;1979&lt;option&gt;1980&lt;option&gt;1981&lt;option&gt;1982&lt;option&gt;1
983&lt;option&gt;1984&lt;option&gt;1985&lt;option&gt;1986
&lt;option&gt;1987&lt
;option&gt;1988&lt;option&gt;1989&lt;option&gt;1990&lt;option&gt;1991&lt;option&
gt;1992&lt;option&gt;1993&lt;option&gt;1994&lt;option&gt;1995
&lt;/option&gt;&l
t;/select&gt;&lt;/tr&gt;

&lt;tr bordercolor=&quot;1&quot;&gt;&lt;td align=&qu
ot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt;Ville de naissance :&lt;/td&gt;
&
lt;td&gt;&lt;input name=&quot;ville_naissance&quot; value=&quot;&quot; size=&quo
t;50&quot; maxlength=&quot;50&quot; /&gt;&lt;/tr&gt;

&lt;tr bordercolor=&quot
;1&quot;&gt;&lt;td align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt;Départ
ement de naissance :&lt;/td&gt;&lt;td&gt;&lt;p&gt;
&lt;select name=&quot;depart
ement_naissance&quot; size=&quot;1&quot;&gt;
&lt;option selected&gt;Département
&lt;option&gt;01 - Ain&lt;option&gt; 02 - Aisne&lt;option&gt; 03 - Allier
&lt;o
ption&gt; 04 - Alpes de Haute Provence&lt;option&gt; 05 - Hautes Alpes&lt;option
&gt; 06 - Alpes Maritimes
&lt;option&gt; 07 - Ardeche&lt;option&gt; 08 - Ardenn
es&lt;option&gt; 09 - Ariege&lt;option&gt; 10 - Aube&lt;option&gt; 11 - Aude
&l
t;option&gt; 12 - Aveyron&lt;option&gt; 13 - Bouches du Rhone&lt;option&gt; 14 -
 Calvados&lt;option&gt; 15 - Cantal
&lt;option&gt; 16 - Charente&lt;option&gt; 
17 - Charente Maritime&lt;option&gt; 18 - Cher&lt;option&gt; 19 - Correze
&lt;o
ption&gt; 20 - Corse&lt;option&gt; 21 - Cote d'Or&lt;option&gt; 22 - Cotes d'Arm
or&lt;option&gt; 23 - Creuse
&lt;option&gt; 24 - Dordogne&lt;option&gt; 25 - Do
ubs&lt;option&gt; 26 - Drome&lt;option&gt; 27 - Eure&lt;option&gt; 28 - Eure et 
Loir
&lt;option&gt; 29 - Finistere&lt;option&gt; 30 - Gard&lt;option&gt; 31 - H
aute Garonne&lt;option&gt; 32 - Gers&lt;option&gt; 33 - Gironde
&lt;option&gt; 
34 - Herault&lt;option&gt; 35 - Ille et Vilaine&lt;option&gt; 36 - Indre&lt;opti
on&gt; 37 - Indre et Loire
&lt;option&gt; 38 - Isere&lt;option&gt; 39 - Jura&lt
;option&gt; 40 - Landes&lt;option&gt; 41 - Loir et Cher&lt;option&gt; 46 - Lot

&lt;option&gt; 47 - Lot et Garonne&lt;option&gt; 48 - Lozere&lt;option&gt; 49 - 
Maine et Loire&lt;option&gt; 50 - Manche
&lt;option&gt; 51 - Marne&lt;option&gt
; 52 - Haute Marne&lt;option&gt; 53 - Mayenne&lt;option&gt; 54 - Meurthe et Mose
lle
&lt;option&gt; 55 - Meuse&lt;option&gt; 56 - Morbihan&lt;option&gt; 57 - Mo
selle&lt;option&gt; 58 - Nievre&lt;option&gt; 59 - Nord
&lt;option&gt; 60 - Ois
e&lt;option&gt; 61 - Orne&lt;option&gt; 62 - Pas de Calais&lt;option&gt; 63 - Pu
y de Dome
&lt;option&gt; 64 - Pyrenees Atlantiques&lt;option&gt; 65 - Hautes Py
renees&lt;option&gt; 66 - Pyrenees Orientales
&lt;option&gt; 67 - Bas Rhin&lt;o
ption&gt; 68 - Haut Rhin&lt;option&gt; 69 - Rhone&lt;option&gt; 70 - Haute Saone

&lt;option&gt; 71 - Saone et Loire&lt;option&gt; 72 - Sarthe&lt;option&gt; 73 
- Savoie&lt;option&gt; 74 - Haute Savoie
&lt;option&gt; 75 - Paris&lt;option&gt
; 76 - Seine Maritime&lt;option&gt; 77 - Seine et Marne&lt;option&gt; 78 - Yveli
nes
&lt;option&gt; 79 - Deux Sevres&lt;option&gt; 80 - Somme&lt;option&gt; 81 -
 Tarn&lt;option&gt; 82 - Tarn et Garonne&lt;option&gt;83 - Var
&lt;option&gt; 8
4 - Vaucluse&lt;option&gt; 85 - Vendee&lt;option&gt; 86 - Vienne&lt;option&gt; 8
7 - Haute Vienne&lt;option&gt; 88 - Vosges
&lt;option&gt; 89 - Yonne&lt;option&
gt; 90 - Territoire de Belfort&lt;option&gt; 91 - Essonne&lt;option&gt; 92 - Hau
ts de Seine
&lt;option&gt; 93 - Seine Saint denis&lt;option&gt; 94 - Val de Mar
ne&lt;option&gt; 95 - Val d'Oise&lt;/option&gt;
&lt;/select&gt;&lt;/p&gt;&lt;/t
r&gt;

&lt;tr bordercolor=&quot;1&quot;&gt;&lt;td height=&quot;24&quot; align=
&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt; Pays de naissance :&lt;/td&gt;

&lt;td&gt;&lt;select name=&quot;pays_naissance&quot; size=&quot;1&quot;&gt;
&
lt;option selected&gt;Pays&lt;option&gt;France&lt;option&gt;Afghanistan&lt;optio
n&gt;Afrique du Sud&lt;option&gt;Albanie&lt;option&gt;Algérie
&lt;option&gt;All
emagne&lt;option&gt; Andorre&lt;option&gt;Angola&lt;option&gt;Anguilla&lt;option
&gt;Antarctique&lt;option&gt;Antigua-et-Barbuda
&lt;option&gt;Antilles néerland
aises&lt;option&gt; Arabie saoudite&lt;option&gt;Argentine&lt;option&gt;Arménie&
lt;option&gt;Aruba&lt;option&gt;Australie
&lt;option&gt;Autriche&lt;option&gt;A
zerbaïdjan&lt;option&gt; Bénin&lt;option&gt;Bahamas&lt;option&gt;Bahreïn&lt;opti
on&gt;Bangladesh&lt;option&gt;Barbade
&lt;option&gt;Belau&lt;option&gt;Belgique
&lt;option&gt;Belize&lt;option&gt;Bermudes&lt;option&gt;Bhoutan&lt;option&gt;Bié
lorussie&lt;option&gt;Birmanie
&lt;option&gt;Bolivie	&lt;option&gt; Bosnie-Herz
égovine&lt;option&gt;Botswana&lt;option&gt;Brésil&lt;option&gt;Brunei&lt;option&
gt;Bulgarie
&lt;option&gt;Burkina Faso&lt;option&gt;Burundi&lt;option&gt;Côte d
'Ivoire&lt;option&gt;Cambodge&lt;option&gt; Cameroun&lt;option&gt;Canada&lt;opti
on&gt;Cap-Vert
&lt;option&gt;Chili&lt;option&gt;Chine&lt;option&gt;Chypre&lt;op
tion&gt;Colombie&lt;option&gt;Comores&lt;option&gt;Congo&lt;option&gt; Corée du 
Nord&lt;option&gt;Corée du Sud
&lt;option&gt;Costa Rica&lt;option&gt;Croatie&lt
;option&gt;Cuba&lt;option&gt;Danemark&lt;option&gt;Djibouti&lt;option&gt;Dominiq
ue&lt;option&gt;Égypte
&lt;option&gt;Émirats arabes unis&lt;option&gt;Équateur&
lt;option&gt;Érythrée&lt;option&gt;Espagne&lt;option&gt;Estonie&lt;option&gt;Éta
ts-Unis&lt;option&gt;Éthiopie
&lt;option&gt;Finlande&lt;option&gt;France&lt;opt
ion&gt;Géorgie&lt;option&gt;Gabon&lt;option&gt;Gambie&lt;option&gt;Ghana&lt;opti
on&gt;Gibraltar&lt;option&gt;Grèce&lt;option&gt;Grenade
&lt;option&gt;Groenland
&lt;option&gt;Guadeloupe&lt;option&gt;Guam&lt;option&gt;Guatemala&lt;option&gt;G
uinée&lt;option&gt;Guinée équatoriale&lt;option&gt;Guinée-Bissao
&lt;option&gt;
Guyana&lt;option&gt;Guyane française&lt;option&gt;Haïti&lt;option&gt;Honduras&lt
;option&gt;Hong Kong&lt;option&gt;Hongrie&lt;option&gt;Ile Bouvet
&lt;option&gt
;Ile Christmas&lt;option&gt;Ile Norfolk&lt;option&gt;Iles Cayman&lt;option&gt;Il
es Cook&lt;option&gt;Iles Féroé&lt;option&gt;Iles Falkland
&lt;option&gt;Iles F
idji&lt;option&gt;Iles Géorgie du Sud et Sandwich du Sud&lt;option&gt;Iles Heard
 et McDonald&lt;option&gt;Iles Marshall
&lt;option&gt;Iles Pitcairn&lt;option&g
t;Iles Salomon&lt;option&gt;Iles Svalbard et Jan Mayen&lt;option&gt;Iles Turks-e
t-Caicos
&lt;option&gt;Iles Vierges américaines&lt;option&gt; Iles Vierges brit
anniques&lt;option&gt;Iles des Cocos (Keeling)
&lt;option&gt;Iles mineures éloi
gnées des États-Unis&lt;option&gt;Inde&lt;option&gt;Indonésie&lt;option&gt;Iran&
lt;option&gt;Iraq&lt;option&gt;Irlande&lt;option&gt;Islande
&lt;option&gt;Israë
l&lt;option&gt;Italie&lt;option&gt;Jamaïque&lt;option&gt;Japon&lt;option&gt;Jord
anie&lt;option&gt;Kazakhstan&lt;option&gt;Kenya&lt;option&gt;Kirghizistan
&lt;o
ption&gt;Kiribati&lt;option&gt;Koweït&lt;option&gt;Laos&lt;option&gt;Lesotho&lt;
option&gt;Lettonie&lt;option&gt;Liban&lt;option&gt;Liberia&lt;option&gt;Libye
&
lt;option&gt;Liechtenstein&lt;option&gt;Lituanie&lt;option&gt;Luxembourg&lt;opti
on&gt;Macao&lt;option&gt;Madagascar&lt;option&gt;Malaisie&lt;option&gt;Malawi&lt
;option&gt;Maldives
&lt;option&gt;Mali&lt;option&gt;Malte&lt;option&gt;Marianne
s du Nord&lt;option&gt;Maroc&lt;option&gt;Martinique&lt;option&gt;Maurice&lt;opt
ion&gt;Mauritanie&lt;option&gt;Mayotte
&lt;option&gt;Mexique&lt;option&gt;Micro
nésie&lt;option&gt;Moldavie&lt;option&gt;Monaco&lt;option&gt;Mongolie&lt;option&
gt;Montserrat&lt;option&gt;Mozambique&lt;option&gt;Népal
&lt;option&gt;Namibie&
lt;option&gt;Nauru&lt;option&gt;Nicaragua&lt;option&gt;Niger&lt;option&gt;Nigeri
a&lt;option&gt;Nioué&lt;option&gt;Norvège&lt;option&gt;Nouvelle-Calédonie
&lt;o
ption&gt;Nouvelle-Zélande&lt;option&gt;Oman&lt;option&gt;Ouganda&lt;option&gt;Ou
zbékistan&lt;option&gt;Pérou&lt;option&gt;Pakistan&lt;option&gt;Panama
&lt;opti
on&gt;Papouasie-Nouvelle-Guinée Paraguay&lt;option&gt;Pays-Bas&lt;option&gt;Phil
ippines&lt;option&gt;Pologne&lt;option&gt;Polynésie française
&lt;option&gt;Por
to Rico&lt;option&gt;Portugal&lt;option&gt; Qatar&lt;option&gt;République centra
fricaine&lt;option&gt;République démocratique du Congo
&lt;option&gt;République
 dominicaine&lt;option&gt;République tchèque&lt;option&gt;Réunion&lt;option&gt;R
oumanie&lt;option&gt;Royaume-Uni&lt;option&gt;Russie
&lt;option&gt;Rwanda&lt;op
tion&gt;Sénégal&lt;option&gt;Sahara occidental &lt;option&gt;Saint-Christophe-et
-Niévès&lt;option&gt;Saint-Marin
&lt;option&gt;Saint-Pierre-et-Miquelon&lt;opti
on&gt;Saint-Siège&lt;option&gt;Saint-Vincent-et-les-Grenadines&lt;option&gt;Sain
te-Hélène&lt;option&gt;Sainte-Lucie
&lt;option&gt;Salvador&lt;option&gt;Samoa&l
t;option&gt;Samoa américaines&lt;option&gt;Sao Tomé-et-Principe&lt;option&gt;Sey
chelles&lt;option&gt;Sierra Leone
&lt;option&gt;Singapour&lt;option&gt;Slovénie
&lt;option&gt;Slovaquie&lt;option&gt;Somalie&lt;option&gt;Soudan&lt;option&gt;Sr
i Lanka&lt;option&gt;Suède&lt;option&gt;Suisse
&lt;option&gt;Suriname&lt;option
&gt;Swaziland&lt;option&gt;Syrie&lt;option&gt;Taïwan&lt;option&gt;Tadjikistan&lt
;option&gt;Tanzanie&lt;option&gt;Tchad
&lt;option&gt;Terres australes française
s&lt;option&gt;Territoire britannique de l'Océan Indien&lt;option&gt;Thaïlande&l
t;option&gt;Timor Oriental
&lt;option&gt;Togo&lt;option&gt;Tokélaou&lt;option&g
t;Tonga&lt;option&gt;Trinité-et-Tobago&lt;option&gt;Tunisie&lt;option&gt;Turkmén
istan&lt;option&gt;Turquie&lt;option&gt;Tuvalu
&lt;option&gt;Ukraine&lt;option&
gt;Uruguay&lt;option&gt;Vanuatu&lt;option&gt;Venezuela&lt;option&gt;Viêt Nam&lt;
option&gt;Wallis-et-Futuna&lt;option&gt;Yémen
&lt;option&gt;Yougoslavie&lt;opti
on&gt;Zambie&lt;option&gt;Zimbabwe&lt;option&gt;ex-République yougoslave de Macé
doine
&lt;/option&gt;&lt;/select&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;
	 
 
&lt;table width=&quot;597&quot; border=&quot;0&quot; cellspacing=&quot;0&quot
;&gt;&lt;tbody&gt;&lt;tr&gt;
&lt;td align=&quot;center&quot;&gt;* Champs Obliga
toires&lt;/td&gt;
&lt;td bgcolor=&quot;#FFCACA&quot; align=&quot;center&quot;&g
t;&lt;b&gt; Vos coordonnées : &lt;/b&gt;&lt;/td&gt;&lt;/tr&gt;

&lt;tr&gt;&lt;
td width=&quot;166&quot; align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt;
*Numéro :&lt;/td&gt;
&lt;td width=&quot;431&quot; colspan=&quot;2&quot; &gt;&lt
;input size=&quot;3&quot; name=&quot;numero&quot; lang=&quot;nom:;erreurfond:#FF
0000;mini:1;	maxi:3;type:obligatoire;erreur:- Merci de mettre le numéro de votre
 voie&quot; maxlength=&quot;3&quot;/&gt;

<ul><li>Type Voie :</li></ul>
&lt;s
elect name=&quot;voie&quot; lang=&quot;erreurfond:#FF0000;type:liste;erreur:- Re
nseigner le type de voie&quot; size=&quot;1&quot; &gt;
&lt;option&gt;  
&lt;op
tion&gt;Avenue&lt;option&gt;Boulevard&lt;option&gt;Chemin&lt;option&gt;Faubourg&
lt;option&gt;Impasse&lt;option&gt;Hameau&lt;option&gt;Lieu-dit
&lt;option&gt;Lo
tissement&lt;option&gt;Place&lt;option&gt;Quai&lt;option&gt;Route&lt;option&gt;R
ue&lt;option&gt;Square
&lt;/option&gt;&lt;/select&gt;&lt;/tr&gt;

&lt;tr&gt;&
lt;td width=&quot;166&quot; align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&
gt; *Adresse :&lt;/td&gt;&lt;td&gt;&lt;p&gt;
&lt;input name=&quot;adresse&quot;
 value=&quot;&quot; lang=&quot;nom:;erreurfond:#FF0000;mini:1;	maxi:50;type:obli
gatoire;erreur:- Merci de mettre votre adresse&quot; size=&quot;50&quot; maxleng
th=&quot;50&quot;/&gt;&lt;/p&gt;&lt;/tr&gt;

&lt;tr&gt;&lt;td width=&quot;166&
quot; align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt; *Code Postal :&lt;
/td&gt;&lt;td&gt;&lt;p&gt;
&lt;input size=&quot;5&quot; name=&quot;code_postal&
quot; lang=&quot;nom:;erreurfond:#FF0000;mini:1;maxi:5;type:obligatoire;erreur:-
 Merci de mettre votre code postal&quot; maxlength=&quot;5&quot; /&gt;&lt;/p&gt;
&lt;/tr&gt;

&lt;tr&gt;&lt;td align=&quot;right&quot; bgcolor=&quot;#E8E8E8&qu
ot;&gt;*Ville :&lt;/td&gt;&lt;td&gt;
&lt;input name=&quot;ville_actuelle&quot; 
value=&quot;&quot; size=&quot;50&quot; lang=&quot;nom:;erreurfond:#FF0000;mini:1
;	maxi:50;type:obligatoire;erreur:- Merci de mettre votre ville&quot; maxlength=
&quot;50&quot;/&gt;&lt;/tr&gt;

&lt;tr&gt;&lt;td align=&quot;right&quot; bgcol
or=&quot;#E8E8E8&quot;&gt; Téléphone Fixe : &lt;/td&gt;&lt;td&gt;&lt;p&gt;
&lt;
input type=&quot;text&quot; name=&quot;fixe&quot; value=&quot;&quot; /&gt;&lt;/p
&gt;&lt;/tr&gt;

&lt;tr&gt;&lt;td align=&quot;right&quot; bgcolor=&quot;#E8E8E
8&quot;&gt; Téléphone Portable : &lt;/td&gt;&lt;td&gt;&lt;p&gt;
&lt;input type=
&quot;text&quot; name=&quot;portable&quot; value=&quot;&quot; /&gt;
&lt;/p&gt;&
lt;/tr&gt;

&lt;tr&gt;&lt;td align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quo
t;&gt; Adresse Mail :&lt;/td&gt;&lt;td&gt;&lt;p&gt;
&lt;input name=&quot;mail&q
uot; value=&quot;&quot; lang=&quot;type:mail;erreur:- Merci de mettre une adress
e mail valide&quot; size=&quot;50&quot; maxlength=&quot;50&quot;/&gt;
&lt;/p&gt
;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;

&lt;table width=&quot;597&quot; bord
er=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;&gt;&lt;tbod
y&gt;
&lt;tr&gt;&lt;td align=&quot;center&quot;&gt;* Champs Obligatoires

&lt
;td bgcolor=&quot;#FFCACA&quot; align=&quot;center&quot;&gt;&lt;b&gt; Votre scol
arité actuelle : &lt;/b&gt;&lt;/td&gt;&lt;/tr&gt;
&lt;tr&gt;&lt;td width=&quot;
163&quot; height=&quot;28&quot; bgcolor=&quot;#E8E8E8&quot; align=&quot;right&qu
ot;&gt;*Classe fréquentée : &lt;/td&gt;
&lt;td&gt;
&lt;input type=&quot;radio&
quot; id=&quot;classe_actuelle&quot; name=&quot;scolarite&quot; value=&quot;Clas
se fréquentée actuellement&quot;
onClick=&quot;GereControle('derniere_classe','
totalite','1');GereControle('derniere_classe','arret','1');GereControle('dernier
e_classe','derniere','1');&quot; lang=&quot;type:radio;erreur:- Merci de renseig
ner votre scolarité actuelle;erreurfond:red;&quot;/&gt;
          
Classe fréq
uentée actuellement 
&lt;br&gt;
&lt;input type=&quot;radio&quot; id=&quot;dern
iere_classe&quot; name=&quot;scolarite&quot; value=&quot;Dernière Classe fréquen
tée&quot;
onClick=&quot;GereControle('derniere_classe','totalite','1');GereCont
role('derniere_classe','arret','1');GereControle('derniere_classe','derniere','1
');&quot; /&gt;

Dernière classe fréquentée&lt;/td&gt;&lt;/br&gt;
&lt;tr&gt;&
lt;td width=&quot;163&quot; height=&quot;50&quot; bgcolor=&quot;#E8E8E8&quot;&gt
;&lt;/td&gt;
&lt;td&gt;&lt;p align=&quot;center&quot;&gt;
&lt;select id=&quot;
origine_scolaire&quot; name=&quot;origine_scolaire&quot; lang=&quot;erreurfond:#
FF0000;type:liste;erreur:- Mettre votre classe fréquentée&quot;&gt;
&lt;option&
gt;&lt;/option&gt;
&lt;option style=&quot;color:#990000;background-color:#FFFFC
1&quot;&gt;CLASSES COLLEGE&lt;/option&gt;
&lt;option&gt;... 6ème&lt;/option&gt;
&lt;option&gt;... 5ème&lt;/option&gt;&lt;option&gt;... 4ème&lt;/option&gt;&lt;op
tion&gt;... 3ème&lt;/option&gt;
&lt;option style=&quot;color:#990000;background
-color:#FFFFC1&quot;&gt;CLASSES LYCEE GENERAL/TECHNO&lt;/option&gt;
&lt;option&
gt;... Seconde&lt;/option&gt;&lt;option&gt;... 1ère&lt;/option&gt;&lt;option&gt;
... Terminale&lt;/option&gt;
&lt;option style=&quot;color:#990000;background-co
lor:#FFFFC1&quot;&gt;CLASSES PROFESSIONNELLES&lt;/option&gt;
&lt;option&gt;... 
1ère année CAP&lt;/option&gt;&lt;option&gt;... 1ère année BEP&lt;/option&gt;
&l
t;option&gt;.. Terminale CAP&lt;/option&gt;&lt;option&gt;.. Terminale BEP&lt;/op
tion&gt;&lt;option&gt;... Bac Professionnel&lt;/option&gt;&lt;option&gt;Autres

&lt;/option&gt;&lt;/select&gt;
&lt;/p&gt;
&lt;p&gt;Si Autres, Précisez :
&lt;
input type=&quot;text&quot; name=&quot;autres&quot; maxlength=&quot;50&quot; siz
e=&quot;50&quot; /&gt;&lt;/p&gt;&lt;/tr&gt;
&lt;tr&gt;&lt;td width=&quot;163&qu
ot; height=&quot;66&quot; bgcolor=&quot;#E8E8E8&quot;&gt;&lt;/td&gt;

&lt;td&g
t;&lt;p&gt;&lt;span id=&quot;derniere&quot; &gt;Année
&lt;input type=&quot;text
&quot; name=&quot;derniere_annee&quot; maxlength=&quot;4&quot; size=&quot;4&quot
; &gt;&lt;br&gt;&lt;/span&gt;
&lt;span id=&quot;totalite&quot;&gt;&lt;input typ
e=&quot;radio&quot;  id=&quot;totalite&quot; name=&quot;scolarite_actuelle&quot;
 value=&quot;en totalité en&quot;&gt;

Classe fréquentée en totalité &lt;br /&
gt;
&lt;input type=&quot;radio&quot; id=&quot;arret&quot; name=&quot;scolarite_
actuelle&quot; value=&quot;arrêtée en cours d'année en&quot;&gt;

Arrêt de la 
scolarité en cours d'année &amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;/tr&gt
;&lt;/tbody&gt;&lt;/table&gt;

&lt;table width=&quot;597&quot; height=&quot;13
2&quot; border=&quot;0&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot;
&gt;
&lt;tbody&gt;&lt;tr&gt;&lt;td height=&quot;19&quot; align=&quot;right&quot
;&gt;
&lt;td bgcolor=&quot;#FFCACA&quot; align=&quot;center&quot;&gt;&lt;b&gt; 
Votre Demande : &lt;/b&gt;&lt;/td&gt;&lt;/tr&gt;

&lt;tr&gt;&lt;td width=&quot
;166&quot; height=&quot;63&quot; align=&quot;right&quot; bgcolor=&quot;#E8E8E8&q
uot;&gt; Documentation : &lt;/td&gt;
&lt;td&gt;&lt;input	type=&quot;checkbox&qu
ot; name=&quot;documentation&quot; value=&quot;demande de documentation&quot;/&g
t;

Une demande de documentation
&lt;br&gt;
&lt;input type=&quot;checkbox&qu
ot; name=&quot;documentation_deux&quot; value=&quot;demande de liste de maîtres 
d'apprentissage&quot;/&gt;
Vous souhaitez que l'on vous envoie une liste de maî
tres d'apprentissage&lt;/td&gt;
&lt;tr&gt;&lt;td height=&quot;24&quot; align=&q
uot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt;&lt;/td&gt;
&lt;td&gt;&lt;p&gt; 
Votre demande conserne quelle année scolaire ?
&lt;select id=&quot;annee_scolai
re&quot; name=&quot;annee_scolaire&quot;&gt;
&lt;option&gt;2007/2008&lt;/option
&gt;&lt;option&gt;2008/2009&lt;/option&gt;&lt;option&gt;2009/2010
&lt;/option&g
t;&lt;/select&gt;
&lt;/p&gt;&lt;/tr&gt;&lt;/br&gt;

&lt;tr&gt;&lt;td height=&
quot;7&quot; align=&quot;right&quot; bgcolor=&quot;#E8E8E8&quot;&gt; Formations 
souhaitées : &lt;/td&gt;
&lt;td&gt;
&lt;select name=&quot;choix_un&quot;&gt;

&lt;option&gt;&lt;/option&gt;
&lt;option style=&quot;color:#990000;background-c
olor:#FFFFC1&quot;&gt;BOUCHER&lt;/option&gt;
&lt;option&gt;...CAP Boucher&lt;/o
ption&gt;&lt;option&gt;...BEP Boucher&lt;/option&gt;

&lt;option style=&quot;c
olor:#990000;background-color:#FFFFC1&quot;&gt;COIFFURE&lt;/option&gt;
&lt;opti
on&gt;...CAP Coiffure&lt;/option&gt;&lt;option&gt;...MC Coiffure&lt;/option&gt;&
lt;option&gt;....BP Coiffure&lt;/option&gt;

&lt;/select&gt;&lt;/tr&gt;&lt;/tb
ody&gt;&lt;/table&gt;

&lt;p align=&quot;center&quot;&gt;Observations ou Remar
ques :&lt;br&gt;
&lt;textarea name=&quot;observations&quot; cols=&quot;50&quot;
 rows=&quot;5&quot;&gt;&lt;/textarea&gt;&lt;/p&gt;
&lt;p align=&quot;center&quo
t;&gt;&lt;/br&gt;
&lt;br&gt;
&lt;input name=&quot;submit&quot; type=&quot;subm
it&quot; value=&quot; Envoyer &quot;/&gt;
&lt;input name=&quot;reset&quot; type
=&quot;reset&quot; value=&quot; Annuler &quot;/&gt;&lt;/p&gt;&lt;/br&gt;

&lt;
/form&gt;

&lt;/BODY&gt;&lt;/HTML&gt;

DEUXIEME ETAPE : Fichier envoi.php 


Code suivant à placer dans une page que vous appellerez envoi.php :

&lt;?ph
p
// Information qui apparaittra si les champs obligatoires ne sont pas remplis

$msg_erreur = &quot;Erreur. Les champs suivants doivent être obligatoirement r
emplis :&lt;br/&gt;&lt;br/&gt;&quot;;

// Information qui apparaittra si les 2
 messages ont bien été envoyé
$msg_ok = &quot;Votre demande a bien été prise en
 compte. Elle sera traitée dans les meilleurs délais.\nUn mail de confirmation v
ous a été envoyé.&quot;;
$message = $msg_erreur;
define('MAIL_DESTINATAIRE','v
otremail@votredomaine.com'); // remplacer par votre email
define('MAIL_SUJET','
Objet du mail'); // remplacer l'objet du mail qui sera envoyé

// vérification
 des champs obligatoires (doublon avec le script si des champs obligatoires inco
rporés dans le formulaire)
if (empty($_POST['nom'])) 
$message .= &quot;Votre 
nom&lt;br/&gt;&quot;;
if (empty($_POST['prenom'])) 
$message .= &quot;Votre pr
enom&lt;br/&gt;&quot;;
if (strlen($message) &gt; strlen($msg_erreur)) {
  echo
 $message;
// sinon c'est ok 
} else {
foreach($_POST as $index =&gt; $valeur
) {
$$index = stripslashes(trim($valeur));
}

//Préparation de l'entête du m
ail:
$mail_entete = &quot;MIME-Version: 1.0\r\n&quot;;
$mail_entete .= &quot;F
rom: {$_POST['nom']} &quot;
             .&quot;&lt;{$_POST['mail']}&gt;\r\n&qu
ot;;
$mail_entete .= 'Reply-To: '.$_POST['mail'].&quot;\r\n&quot;;
$mail_entet
e .= 'Content-Type: text/plain; charset=&quot;iso-8859-1&quot;';
$mail_entete .
= &quot;\r\nContent-Transfer-Encoding: 8bit\r\n&quot;;
$mail_entete .= 'X-Maile
r:PHP/' . phpversion().&quot;\r\n&quot;;

// Préparation du corps du mail 


// Remplacer le nom des variables suivantes par les noms de vos variables (name 
ou id) du formulaire
// Utiliser \n pour aller à la ligne 
$mail_corps = &quot
;Demande de : $civil $nom $prenom\n&quot;;
$mail_corps .= &quot;Date de naissan
ce : $jour_naissance/$mois_naissance/$annee_naissance\n&quot;;
$mail_corps .= &
quot;Ville de naissance : $ville_naissance\n&quot;;
$mail_corps .= &quot;Départ
ement de naissance : $departement_naissance\n&quot;;
$mail_corps .= &quot;Pays 
de naissance : $pays_naissance\n\n&quot;;

$mail_corps .= &quot;Renseigements 
sur l'adresse de $nom $prenom : \n&quot;;
$mail_corps .= &quot;Adresse : $numer
o $voie $adresse $code_postal $ville_actuelle\n&quot;;
$mail_corps .= &quot;Tél
éphone Fixe : $fixe\n&quot;;
$mail_corps .= &quot;Téléphone Portable : $portabl
e\n&quot;;
$mail_corps .= &quot;Mail : $mail\n\n&quot;;

$mail_corps .= &quot
;Renseigements sur la scolarité : \n&quot;;
// Ligne suivante, besoin de mettre
 le nom de &quot;id&quot; et du &quot;name&quot; pour afficher correctement les 
&quot;value&quot; des boutons radio 
$mail_corps .= &quot;Scolarité effectuée :
 $scolarite $classe_actuelle $scolarite_actuelle $totalite $arret $derniere_anne
e\n&quot;; 
$mail_corps .= &quot;Origine scolaire : $origine_scolaire $autres\n
\n&quot;;

$mail_corps .= &quot;Renseigements sur la ou les formation(s) souha
itée(s) au CFA :\n&quot;;
$mail_corps .= &quot;Demande faite pour l'année scola
ire : $annee_scolaire\n&quot;;
$mail_corps .= &quot;1er souhait de formation : 
$choix_un\n&quot;;
$mail_corps .= &quot;2eme souhait de formation : $choix_deux
\n&quot;;
$mail_corps .= &quot;3eme souhait de formation : $choix_trois\n&quot;
;

$mail_corps .= &quot;Documentation(s) souhaitée(s) : $documentation  $docum
entation_deux\n\n&quot;;

$mail_corps .= &quot;Observation : $observations\n\n
&quot;;

// envoi du mail
if (mail(MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$
mail_entete)) {
  //Le mail est bien expédié
  echo $msg_ok;
} else {
  //Le
 mail n'a pas été expédié
  echo 'Une erreur est survenue lors de l\'envoi du f
ormulaire par email';
}

}
// Message de confirmation de reception de demand
e
// ---------------------------
 
/* Objet */ // Mettre votre nom de domaine

$subject = &quot;Confirmation de votre demande sur www.domaine.com&quot;;
 

/* additional header pieces for errors, From cc's, bcc's, etc */
// Adresse mai
l (variable du formulaire contact)
$headers = &quot;From: $mail &lt;$mail&gt;\n
&quot;;

// Remplacer le mail suivant par votre mail
$headers .= &quot;X-Send
er: &lt;votremail@votredomaine.com&gt;\n&quot;;
$headers .= &quot;X-Mailer: PHP
\n&quot;; // mailer
$headers .= &quot;X-Priority: 1\n&quot;; // Urgent message!


// Remplacer le mail suivant par votre mail
$headers .= &quot;Return-Path: 
Sales &lt;votremail@votredomaine.com&gt;\n&quot;;  // Return errors
 
/* recip
ients */
$recipient = $mail;
 
/* message */
// Remplacer le contenu du mess
age suivant par celui qui vous convient
// Vous pouvez à l'intérieur de celui-c
i rappeller les variables en mettant $nom etc...
$message = &quot;Bonjour $pren
om $nom

Merci pour votre message.
Nous traiterons votre demande dans les plu
s bref delais.
Cordialement.
 
Rappel de vos informations personnelles:
----
--------------------------
Votre nom: $nom
Votre addresse: $prenom
Votre vill
e de residence : $ville
votre Email: $mail
Votre message: $observations
 
Si
 vous recevez ce mail par erreur, merci de nous contactez au plus vite
par emai
l : votremail@votredomaine.com

A tres bientot <a href='http://www.votredomain
e.com' target='_blank'>http://www.votredomaine.com</a>
------------------------
-------
&quot;; 

mail($recipient, $subject, $message, $headers);
?&gt;

S
i vous souhaitez conserver que envoi.php modifiez bien tous les variables pour q
u'ils correspondent aux votres.

Volontairement, je ne transmettrais pas les s
ources des fichiers marsk.js et conform.js (sauf dans le ZIP) car il suffit de f
aire une recherche sur ce site <a href='http://www.javascriptfr.com' target='_bl
ank'>http://www.javascriptfr.com</a> pour les retrouver facilement avec les coor
données de leur auteur.
</pre>
<br /><a name='conclusion'></a><h2> Conclusion 
: </h2>
<br />Je ne suis pas d&eacute;veloppeur mais gr&agrave;ce aux croissem
ents de pleins de codes (merci &agrave; leurs auteurs) et &agrave; mes cr&eacute
;ations, ce formulaire existe.
<br />
<br />Bon courage &agrave; vous.
<br />

<br />En conclusion, je dirais qu'on peut vraiment faire des choses &eacute;to
nnantes avec les languages html, javascript et php quand on les combinne (et qu'
on arrive &agrave; les faire vivre ensemble... :-).
