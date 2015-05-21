<?php/**
 * \file          connexionUser.php
 * \author    S&eacute;curiPi
 * \version   1.0
 * \brief       Authentification d'un utilisateur.
 *
 * \details    Ce fichier permet l'authentification d'un utilisateur aupr&egrave;s de
 *             la base de donn&eacute;e.
 */?>

<?php
if(isset($_SESSION['id']) == false and isset($_POST['identifiant']) and isset($_POST['password'])) {
	session_start();
	$connect = false;
	
	include 'connexionBDD.php';
	
	$clients = $bdd_connexion->query('SELECT * FROM Clients');
	
	while ($row = $clients->fetch()) {
		if($_POST['identifiant'] == $row[3] and md5($_POST['password']) == $row[4]){
			$_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['ID'] = $row[0];
			$_SESSION['Nom'] = $row[1];
			$_SESSION['Prenom'] = $row[2];
			$_SESSION['Login'] = $row[3];
			$_SESSION['Password'] = $row[4];
			
			$connect = true;
			break;
		}
	}
	if($connect == true){
		$maxID_Client = $bdd_connexion->query('SELECT MAX(ID) FROM Connexions WHERE ID_Client = '. $_SESSION['ID'] .';');
		$maxID_Client = $maxID_Client->fetch();
		$maxID_Client = $maxID_Client[0] + 1;
		
		if($maxID_Client == null) {
			$maxID_Client = 1;
		}
		
		$date = date("Y-m-d");
		$heure = date("H:i:s");
		
		$bdd_connexion->exec("INSERT INTO Connexions VALUES(". $maxID_Client .", ". $_SESSION['ID'] .", '". $date ."', '". $heure ."', '". $_SESSION['IP'] ."');");
		
		header('location: ../visualisation.php');
	}
	else{ ?>
	
	<form method="post" action="../connexion.php" id="err">
		<input type="hidden" name="erreur_connexion" value="erreur">
		<input style="height: 0px; border: none; background-color: rgba(255,255,255,0);" type="submit">
	</form>
	
	<script type="text/javascript">
		document.getElementById('err').submit();
	</script>
	
	<?php } 
} ?>