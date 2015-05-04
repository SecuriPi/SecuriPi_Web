<?php
include 'var_connexion.php';

$bdd_connexion = new PDO('mysql:host=172.16.81.100;dbname=SecuriPi', 'root', 'securipi');
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
