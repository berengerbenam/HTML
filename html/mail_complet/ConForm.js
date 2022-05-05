

   /*==================================================================================|
	|		Attention : Remplacer les "monform" par le nom de votre formulaire		|
	|   _______   ___                      ____                                         |
    |	ConForm : CONtrole des champs d'un FORMulaire   		   						|
	|   �������   ���                      ����                                         |
	|																					|
	| 							   ~\\|//												|
    |                        (@ ~)														|
    |     ������������oOOO����(_)����OOOo����������										|
    |     | M'�crire : http://mas.keo.in?Code=Bul |										|
    |     | Mon Site : http://bul.fr.nf           |										|
    |     |              .oooO   Oooo.            |										|
    |     ���������������(   )���(   )�������������										|
    |                     \ (     ) /													|
    |                      \_)   (_/													|
	|																					|
	|===================================================================================|
	|											|										|
	|	     lang="								|										|
	|��������������������������������������������|��������������������������������������|
	|			  nom:nom de la zone;					| par d�faut : n� champ 		|
	|��������������������������������������������|��������������������������������������|
	|			  erreur:libell� de l'erreur;			| par d�faut : invalide 		|
	|��������������������������������������������|��������������������������������������|
	|             type:obligatoire;				 | doit �tre renseign�					|
	|				   date;					 | d�pend de "format:"					|
	|				   cocher;					 | cases � cocher (checkbox)			|
	|				   liste;					 | select o� choisir des lignes			|
	|				   radio;					 | radio � cocher ( au moins 1 )		|
	|				   mail;					 | adresse Mail ( ab.cd@ef.gh )			|
	|				   nombre;					 | valeur								|
	|				   specifique;				 | test � faire (dans format:)			|
	|				   accepter					 | 1 checkbox/radio qui doit �tre coch�	|
	|��������������������������������������������|��������������������������������������|
	|             format:de la date;			 | si type:date  jjmmaaaa 				|
	|											 |               jj/mm/aaaa ( d�faut ) 	|
	|					 test particulier;		 | if ( test particulier )				|	   
	|��������������������������������������������|��������������������������������������|
	|			  separateur:?;					 | entre jj,mm et aaaa					|
	|											 | par d�faut : n'importe   			|
	|��������������������������������������������|��������������������������������������|
	|			  mini:valeur;					 | � valeur mini de nombre   		   	|
	|											 | � nombre de cases mini � cocher		|
	|											 |  si select multiple, par d�faut=1	|
	|                                            | � nbr caract�res mini � saisir       |
	|                                            |    si type:obligatoire               |
	|                                            |    1 par d�faut                      |
	|��������������������������������������������|��������������������������������������|
	|			  maxi:valeur;					 | � valeur maxi de nombre				|
	|											 | � nbr cases maxi � cocher si 		|
	|											 |   select multiple, par d�faut=mini	|
	|                                            | � nbr caract�res maxi � saisir       |
	|                                            |    si type:obligatoire               |
	|                                            |    pas de maxi par d�faut            |
	|��������������������������������������������|��������������������������������������|
	|			  bonfond:couleur;				 | couleur fond si contr�les bons		|
	|��������������������������������������������|��������������������������������������|
	|			  bontexte:couleur;				 | couleur texte si contr�les bons		|  
	|��������������������������������������������|��������������������������������������|
	|			  erreurfond:couleur;			 | couleur fond si contr�les faux		|
	|��������������������������������������������|��������������������������������������|
	|			  erreurtexte:couleur;			 | couleur texte si contr�les faux		|  
	|��������������������������������������������|��������������������������������������|
	|	          "						   		 |										|
	|											 |										|
	|===================================================================================|
	|																					|
	| 			Si vous ajoutez/modifier des contr�les, ce serait    					|
	|			sympa de me les faire parvenir  : merci d'avance. 						|
	|			Si vous voulez que j'en ajoute  : contactez-moi.						|
	|																					|
	|==================================================================================*/

//######################################################################
function RLtrim(zone)	//## supprimer les espaces en d�but et en fin ##
//######################################################################
{	
	return zone.replace(/(^\s*)|(\s*$)/g,"");
}
//###########################################################
function SignalErreur(z1,monform,z2)	//## signaler les erreurs ##
//###########################################################
{	
	if ( z1["erreurfond"] )
	{ 
		monform.elements[z2].style.backgroundColor=z1["erreurfond"] ; 
	}
	if ( z1["erreurtexte"] )
	{ 
		monform.elements[z2].style.color=z1["erreurtexte"] ; 
	}
	return "\r\n"+z1["erreur"];
}
//#####################################################################
function ConForm(formulaire)	//## contr�le des champs du formulaire ##
//#####################################################################
{	
	var retour="",tester;
	for (	no_element=0;
			no_element<formulaire.elements.length;
			no_element++)	// pour toutes les champs d'un formulaire
	{	
	//	tester=formulaire.elements[no_element].controle;	//#### non trait� par moteurs Gecko
	//	tester=formulaire.elements[no_element].alt;			//#### non valable pour textarea
		tester=formulaire.elements[no_element].lang;			//	version actuelle
		if (tester)
		{	//~~~~~~~~ il y a un alt="contr�le � faire" ~~~~~~~~
			var zones=RLtrim(tester).split(";");
			// format : alt="id1:valeur1;id2:valeur2...."
			var	valeur=new Array();
			for (	var z=0;
					z<zones.length;
					z++ )	// pour toutes les zones du controle
			{	// valeur["id#"]=valeur#
				trv=RLtrim(zones[z]).split(":");	// id#:valeur#
				if (trv.length==2)
				{	    
					valeur[RLtrim(trv[0].toLowerCase())]=RLtrim(trv[1].toLowerCase());	
				}
			}	
			if ( !valeur["nom"] )
			{
				valeur["nom"]="Champ("+(no_element+1)+")";	// valeurs par d�faut
			}
			if ( !valeur["erreur"] )
			{	
				valeur["erreur"]=valeur["nom"]+" invalide";	// valeurs par d�faut
			}
			if ( valeur["bonfond"] )
			{ 
				formulaire.elements[no_element].style.backgroundColor=valeur["bonfond"] ; 
			}
			if ( valeur["bontexte"] )
			{ 
				formulaire.elements[no_element].style.color=valeur["bontexte"] ; 
			}
			switch ( valeur["type"] )	
			{								
			//-_-_-_-_ traitements possibles actuellement -_-_-_-_
			
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ le checkbox
				case "accepter":	//~~ accepter une obligation ~~~~~~~~~~~~~~~~~~~~~ ou le radio Unique
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ doit �tre coch�
					if ( !formulaire.elements[no_element].checked )
					{	
						retour+=SignalErreur(valeur,formulaire,no_element);
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ si un contr�le
				case "specifique":	//~~ test dans format: ~~~~~~~~~~~~~~~~~~~ par trop particulier
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ est n�cessaire
					try			{	
									if ( eval(valeur["format"]) )	
									{ 	
										retour+=SignalErreur(valeur,formulaire,no_element);	
									}	
								}	
					catch(e)	{ 
								}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 1 radio
				case "radio":	//~~ Radio ~~~~~~~~~~~~~~~~~~~~~ doit �tre
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ coch�
					var nom=formulaire.elements[no_element].name;
					var err=true;
					for ( var n=0;n<formulaire[nom].length;n++ )
					{ 
						if ( formulaire[nom][n].checked ) 
						{	
							err=false;
							n=formulaire[nom].length;
						}	
					}
					if ( err )
					{ 	
						retour+=SignalErreur(valeur,formulaire,no_element);	
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ n �l�ments de la liste doivent coch�s
	 			case "liste":	//~~ select ~~~~~~~~~~~~~~~~~~~~~ entre mini et maxi si liste multiple
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 1 au moins sinon
					switch ( formulaire.elements[no_element].multiple ) 
					{
						case true:	//.... select multiple ....
							if ( !valeur["mini"] ) valeur["mini"]=1;
							if ( !valeur["maxi"] ) valeur["maxi"]=valeur["mini"];
							break;	
						case false:	//.... select unique ....
							valeur["mini"]=1;
							valeur["maxi"]=valeur["mini"];
							break;	
					}
					var nbr=0;
					var nom=formulaire.elements[no_element];
					for ( var n=0;n<nom.length;n++)
					{ 
						if ( nom[n].selected )
						{ 
							nbr++; 
						} 
					}
					if ( nbr < valeur["mini"] || nbr > valeur["maxi"] )
					{ 	
						retour+=SignalErreur(valeur,formulaire,no_element);   
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ diff�rents format
				case "date":	//~~ date ~~~~~~~~~~~~~~~~~~~~~ possible d'une date
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ "adaptable facilement"
					var j,m,a,la,s;
					switch ( valeur["format"] ) 
					{
						case "jjmmaaaa":
							la=4;
							j=0;
							m=2;
							a=4;
							s=new Array();
							break;
						default:	
							//~~ jj/mm/aaaa par d�faut
						case "jj/mm/aaaa":
							la=4;
							j=0;
							m=3;
							a=6;
							s=new Array(2,5);
							break;	
					}
					if ( formulaire.elements[no_element].value.length  != (la+s.length+4) )
					{	
						retour+=SignalErreur(valeur,formulaire,no_element);
						break;	
					}
					if ( valeur["separateur"] )
					{	
						for ( var n=0; n<s.length; n++ )
						{	
							if (formulaire.elements[no_element].value.charAt(s[n])!=valeur["separateur"] )
							{	
								retour+=SignalErreur(valeur,formulaire,no_element);
								break;	
							}	
						}	
					}
					j=Number(formulaire.elements[no_element].value.substring(j,2));
					m=Number(formulaire.elements[no_element].value.substring(m,m+2));
					a=Number(formulaire.elements[no_element].value.substring(a,a+la));
					if ( isNaN(j) || isNaN(m) || isNaN(a) || j<1 ||  m<1 || m>12 )
					{	
						retour+=SignalErreur(valeur,formulaire,no_element);
						break;	
					}
					var fm;
					switch (m)	
					{
						case 4:
						case 6:
						case 9:
						case 11:
							fm=30;
							break;
						case 2:
							if ( (a%4)==0 && ((a%100)!=0 || (a%400)==0) )
									{
										fm=29;
									}
							else	{
										fm=28;
									}
							break;
						default:
							fm=31;
							break;	
					}
					if ( j>fm )
					{	
						retour+=SignalErreur(valeur,formulaire,no_element);
						break;	
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ n checkbox doivent 
				case "cocher":	//~~ checkbox ~~~~~~~~~~~~~~~~~~~~~   �tre coch�s
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ >= mini et <= maxi
					var nom=formulaire.elements[no_element].name;
					var nbc=0;
					for ( var n=0;n<formulaire[nom].length;n++ )
					{ 
						if ( formulaire[nom][n].checked ) 
						{
							nbc++;
						}
					}
					if ( nbc<valeur["mini"] || nbc>valeur["maxi"] )
					{ 	
						retour+=SignalErreur(valeur,formulaire,no_element);
						break;	
					}	
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ format ( minimaliste )
				case "mail":	//~~ mail ~~~~~~~~~~~~~~~~~~~~~ du 
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ mail
					if ( !formulaire.elements[no_element].value.match
								("[-\./w]*@[/w]*\.[/w]*") )	// pas terrible �a !
					{
						retour+=SignalErreur(valeur,formulaire,no_element);
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ une 
				case "nombre":	//~~ nombre ~~~~~~~~~~~~~~~~~~~~~ valeur
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ >= mini et <= maxi
					if (isNaN(formulaire.elements[no_element].value))
					{ 	
						retour+=SignalErreur(valeur,formulaire,no_element);
						break;	
					}
					if (valeur["mini"])
					{	
						if (Number(formulaire.elements[no_element].value)<Number(valeur["mini"]))
						{ 	
							retour+=SignalErreur(valeur,formulaire,no_element);
							break;	
						}	
					}
					if (valeur["maxi"])
					{	
						if (Number(formulaire.elements[no_element].value)>Number(valeur["maxi"]))
						{ 	
							retour+=SignalErreur(valeur,formulaire,no_element);
							break;	
						}	
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ champ non vide
				case "obligatoire":	//~~ obligatoire ~~~~~~~~~~~~~~~~~~~ et/ou longueur
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ saisie contr�l�e
					if (   formulaire.elements[no_element].value.length<1 
						|| ( valeur["mini"] && formulaire.elements[no_element].value.length<Number(valeur["mini"]) )
						|| ( valeur["maxi"] && formulaire.elements[no_element].value.length>Number(valeur["maxi"]) ) ) 
					{	
						retour+=SignalErreur(valeur,formulaire,no_element);
					}
					break;
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ controle
				default:	//~~ pas de contr�le alors ? ~~~~~~~~~~~~~~~~~~~~~~~ non trait�.
				//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ enfin pour le moment
					break;	
			}	
		}	
	}
	if (retour.length>0)
			{	
				alert ( retour );
				return false;	
			}
	else	{	
				return true;	
			}	
}
