<?php
/**
 * \file      Pied.php
 * \author    SécuriPi
 * \version   1.0
 * \brief     Pied de page.
 *
 * \details   Ce fichier permet contient les balises présentes en pied de chaque page.
 */

if(isset($_SESSION['ID']) and $_SESSION['IP'] == $_SERVER['REMOTE_ADDR']) { ?>
	<form id="deconnexion" method="post" action="Scripts/deconnexionUser.php">
		<input type="submit" value="D<?php echo utf8_decode("é"); ?>connexion" />
	</form>
<?php } ?>
