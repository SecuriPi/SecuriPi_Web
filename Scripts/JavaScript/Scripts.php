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
    * \brief       Renvoi vers le fichier de déconnexion
    * \details    Cette fonction permet de déconnecter l'utilisateur en le 
    *             renvoyant vers le fichier \e deconnexionUser.php
    */
	function oc() {
		if(document.getElementById("deconnexion").checked ==true){
			document.location.href="Scripts/deconnexionUser.php"
		}
	}
	
	//document.oncontextmenu = new Function("return false");
</script>
