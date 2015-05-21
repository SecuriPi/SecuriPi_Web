<?php/**
 * \file          Scripts.php
 * \author    S&eacute;curiPi
 * \version   1.0
 * \brief       Script de d&eacute;connexion
 *
 * \details    Ce fichier permet de renvoyer vers le fichier de d&eacute;connexion
 *             au moment du click sur le bouton \e deconnexion.
 */
?>
<script type="text/javascript">
	/**
	 * Detecte les cliques de l'intrface pour naviguer par le menu
	 */
	function oc() {
		if(document.getElementById("deconnexion").checked ==true){
			document.location.href="Scripts/deconnexionUser.php"
		} else if(document.getElementById("gestionCompte").checked ==true){
			document.location.href="gestionCompte.php"
		} else if(document.getElementById("gestionCam").checked ==true){
			document.location.href="gestionCameras.php"
		}
	}
	
	//document.oncontextmenu = new Function("return false");


	/**
	 * Affiche un message
	 * @param {String} text
	 */
	function addMessage(text) {
		document.getElementById("message").innerHTML = text;
		document.getElementById("message").style.display = "block";
		setTimeout(function(){ document.getElementById("message").style.display = "none"; }, 5000);
	}

	/**
	 * AJAX - Mise à jour du compte 'utilisateur'
	 * @param {String} login
	 * @param {String} password
	 * @param {String} confirm
	 * @param {Number} userID
	 */
	function editAccount(login, password, confirm, userID) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				switch (xmlHttp.responseText) {
					case 'login:empty':
					addMessage("L' 'Identifiant' ne peux pas être vide !");
					break;
					case 'mdp:empty':
					addMessage("Le 'Mot de passe' ne peux pas être vide !");
					break;
					case 'err:confirm':
					addMessage("Les mots de passes sont différents !");
					break;
					default:
					document.getElementById("message").innerHTML = "Le compte à été modifié !";
					document.getElementById("message").style.display = "block";
					setTimeout(function(){ returnBack(); }, 2500);
					break;
				}
				document.getElementById("password").value = null;
				document.getElementById("confirmpassword").value = null;
			}
		}

		xmlHttp.open("GET","Scripts/Php/editAccount.php?login=" + login + "&password=" + password + "&confirm=" + confirm + "&userID=" + userID, true);
		xmlHttp.send();
	}

	/**
	 * AJAX - Mise à jour de la liste d'encaissement
	 */
	function updateList() {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				document.getElementById("cameras").innerHTML = xmlHttp.responseText;
			}
		}
		
		xmlHttp.open("GET","Scripts/Php/updateList.php", true);
		xmlHttp.send();
	}

	/**
	* Supprime une caméra
	* @param {Number} id
	*/
	function deleteCam(id) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				if(xmlHttp.responseText == "suppr:done") {
					updateList();
				}
			}
		}
		
		xmlHttp.open("GET","Scripts/Php/deleteCam.php?id="+id, true);
		xmlHttp.send();
	}

	$( document ).ready(function() {
	    initPopUp();
	});

	/**
	* Affiche la pop up de moficiation de la caméra selectionée
	* @param {Number} id
	*/
	function openUpdate() {
		initPopUp();
	}

	/**
	 * Initialisation de la pop-up
	 */
	function initPopUp() {
		$('a.popLink[href^=#]').click(function() {
			var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
			var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

			var args = popURL.split("?")[1].split("&");

			var popWidth = args[0].split("=")[1];
			var cam_id = args[1].split("=")[1];

			//Faire apparaitre la pop-up et ajouter le bouton de fermeture
			$('#' + popID).fadeIn().css({
				'width': Number(popWidth)
			})

			//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
			var popMargTop = ($('#' + popID).height() + 80) / 2;
			var popMargLeft = ($('#' + popID).width() + 80) / 2;

			//On affecte le margin
			$('#' + popID).css({
				'margin-top' : -popMargTop,
				'margin-left' : -popMargLeft
			});

			//Effet fade-in du fond opaque
			$('body').append('<div id="fade" onclick="closePopUp();"></div>'); //Ajout du fond opaque noir
			//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
			$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

			setPopUpContent(cam_id);
		});
	}

	/**
	* AJAX - Modification du contenu de la pop-up selon l'id de la vente
	* @param {Number} id
	*/
	function setPopUpContent(id) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				document.getElementById("updateCam").innerHTML = xmlHttp.responseText;
				var popMargTop = ($('#updateCam').height() + 80) / 2;
				$('#updateCam').css({
					'margin-top' : -popMargTop,
				});
			}
		}

		xmlHttp.open("GET","Scripts/Php/setPopUpContent.php?id="+id, true);
		xmlHttp.send();
	}

	/**
	* Fermeture de la pop-up
	*/
	function closePopUp() {
		$('#fade , .popUpBlock').fadeOut(function() {
			$('#fade, a.close').remove();
		});
		return false;
	}

	/**
	* Met à jour les information de la caméra dans la base de données
	* @param {Number} id
	* @param {String} nom
	* @param {String} emplacement
	* @param {String} ip
	*/
	function updateCam(id, nom, emplacement, ip) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				if(xmlHttp.responseText == "edit:done") {
					updateList();
					closePopUp();
				}
			}
		}

		xmlHttp.open("GET","Scripts/Php/updateCam.php?id="+id+"&nom="+nom+"&emplacement="+emplacement+"&ip="+ip, true);
		xmlHttp.send();
	}

	/**
	* Ajoute une nouvele caméra dans la base de données
	* @param {String} nom
	* @param {String} emplacement
	* @param {String} ip
	*/
	function addCam(nom, emplacement, ip) {
		var xmlHttp;
		xmlHttp = new XMLHttpRequest();
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4) {
				if(xmlHttp.responseText == "insert:done") {
					updateList();
					closePopUp();
				}
			}
		}

		xmlHttp.open("GET","Scripts/Php/addCam.php?nom="+nom+"&emplacement="+emplacement+"&ip="+ip, true);
		xmlHttp.send();
	}

	/**
	* Retourne à la page visualisation.php
	*/
	function returnBack() {
		window.location = "visualisation.php";
	}
</script>