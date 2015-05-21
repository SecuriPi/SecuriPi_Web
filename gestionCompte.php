<!DOCTYPE HTML>

<?php session_start();
if(isset($_SESSION['ID']) and $_SESSION['IP'] == $_SERVER['REMOTE_ADDR']) { ?>
<html>
	<head><?php include 'Includes/Head.php'; ?> <link rel="stylesheet" href="StyleSheet/gestionCompte.css"> </head>
	<body>
		<?php include 'Scripts/JavaScript/Scripts.php';
		include 'Scripts/connexionBDD.php';
		
		$maxID_Client = $bdd_connexion->query('SELECT MAX(ID) FROM Connexions WHERE ID_Client = '. $_SESSION['ID'] .';');
		$maxID_Client = $maxID_Client->fetch();
		$maxID_Client = $maxID_Client[0]; ?>
							
		<p class="infos">Connecté en tant que <?php echo $_SESSION['Prenom'] ." ". $_SESSION['Nom'] ." (". $_SESSION['IP'] .")"; ?>
		
		<?php if($maxID_Client > 1) {
			$infosConnect = $bdd_connexion->query('SELECT * FROM Connexions WHERE ID = '. ($maxID_Client - 1) .' AND ID_Client = '. $_SESSION['ID'] .';');
			$infosConnect = $infosConnect->fetch(); ?>
			
			<br> Dernière connexion le <?php echo date("d/m/Y", strtotime($infosConnect[2])) ." à ". $infosConnect[3] ." (". $infosConnect[4] .")"; ?></p>
		<?php }

		$userID = $_SESSION['ID'];
        $sql = "SELECT * FROM Clients WHERE ID = $userID;";
        $user = $bdd_connexion->query($sql);
        $user = $user->fetch(); ?>
        <div id="editAccount">
            <h3>Modifier mon compte</h3>

            <form id="editAccountForm">
                <p id="message"></p>
                <label for="login">Nom d'utilisateur</label><input type="text" name="login" id="login" value="<?php echo $user[3]; ?>" required><br>
                <label for="password">Mot de passe</label><input type="password" name="password" id="password" required><br>
                <label for="confirmpassword">Conformation</label><input type="password" name="confirmpassword" id="confirmpassword" required><br>
                <input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['ID']; ?>"><br>
                <input type="button" value="Valider" onclick="editAccount(login.value, password.value, confirmpassword.value, userID.value);" id="editAccountButton"><br>
                <input type="button" value="Retour" onclick="returnBack();" id="returnButton" style="margin-top: -40px !important">
            </form>
        </div>
	</body>
</html>
<?php } else { header('location: connexion.php'); } ?>