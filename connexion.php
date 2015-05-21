<!DOCTYPE HTML>

<?php 
/**
 * \file          connexion.php
 * \author    SécuriPi
 * \version   1.0
 * \brief       Permet de réaliser la connexion a la base de donnée.
 *
 * \details    Ce fichier permet de se connecter a la base dans le but de
 *                  s'authentifier.
 */

session_start();
if(isset($_SESSION['ID']) and $_SESSION['IP'] == $_SERVER['REMOTE_ADDR']) /** Vérifie l'identifiant et l'IP par rapport au serveur */
{
	header('location: visualisation.php');
} else { ?>

<html>
	<head><?php include 'Includes/Head.php'; ?></head>
	<body>
		<div id="Contenu">
			<span id="Titre">SécuriPi</span>
			<div id="login">
				<form id="connexion" method="post" action="Scripts/connexionUser.php">
					<?php if(isset($_POST['erreur_connexion']) and $_POST['erreur_connexion'] == "erreur"){ ?>
						<p id="erreur">Erreur d'authentification !</p>
					<?php } ?>
					<input type="text" placeholder="Identifiant" name="identifiant"  id="identifiant" required>
					<input type="password" placeholder="Mot de passe" name="password" id="password" required>
					<input type="submit" value="Connexion" />
				</form>
			</div>
		</div>
	
		<?php include 'Includes/Pied.php'; ?>
	</body>
</html>
<?php } ?>