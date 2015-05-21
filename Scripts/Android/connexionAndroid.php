<?php/**
 * \file          connexionAndroid.php
 * \author    S&eacute;curiPi
 * \version   1.0
 * \brief       Permet de r&eacute;aliser la connexion &agrave; la base de donn&eacute;e.
 *
 * \details    Ce fichier permet de se connecter &agrave; la base dans le but de
 *                  s'authentifier via l'application Android.
 */
?>
<?php
include 'var_connexion.php';

$bdd_connexion = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
$clients = $bdd_connexion->query('SELECT * FROM Clients');

$connect = false;
	
while ($row = $clients->fetch()) {
	if(strtolower($_POST['username']) == strtolower($row[3]) and md5($_POST['password']) == $row[4]){
		$ID = $row[0];
		$nom = $row[1];
		$prenom = $row[2];
		$login = $row[3];
		$password = $row[4];
			
		$connect = true;
	}
}

if($connect == true)
	echo "true";
else
	echo "false";
?>
