<?php
session_start();
include '../connexionBDD.php';

$id_client = $_SESSION['ID'];
$nom = utf8_decode($_GET['nom']);
$emplacement = utf8_decode($_GET['emplacement']);
$ip = $_GET['ip'];
$complement = $_GET['complement'];
$port = $_GET['port'];

if($port == NULL) {
	if($complement == NULL) {
		$sql = "INSERT INTO Cameras(ID_Client, Nom, Emplacement, IP) VALUES($id_client, '$nom', '$emplacement', '$ip');";
	} else {
		$sql = "INSERT INTO Cameras(ID_Client, Nom, Emplacement, IP, Complement) VALUES($id_client, '$nom', '$emplacement', '$ip', '$complement');";
	}
} else {
	if($complement == NULL) {
		$sql = "INSERT INTO Cameras(ID_Client, Nom, Emplacement, IP, Port) VALUES($id_client, '$nom', '$emplacement', '$ip', $port);";
	} else {
		$sql = "INSERT INTO Cameras(ID_Client, Nom, Emplacement, IP, Complement, Port) VALUES($id_client, '$nom', '$emplacement', '$ip', '$complement', $port);";
	}
}
$exec = $bdd_connexion->exec($sql);

if($exec) { echo 'insert:done'; }
?>