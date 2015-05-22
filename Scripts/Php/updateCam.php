<?php
include '../connexionBDD.php';

session_start();
$ID_Client = $_SESSION['ID'];

$id = $_GET['id'];
$nom = utf8_decode($_GET['nom']);
$emplacement = utf8_decode($_GET['emplacement']);
$ip = $_GET['ip'];
$complement = $_GET['complement'];
$port = $_GET['port'];

if($port == NULL) {
	if($complement == NULL) {
		$sql = "UPDATE Cameras SET Nom = '$nom', Emplacement = '$emplacement', IP = '$ip', Complement = NULL, Port = NULL WHERE ID = $id AND ID_Client = $ID_Client;";
	} else {
		$sql = "UPDATE Cameras SET Nom = '$nom', Emplacement = '$emplacement', IP = '$ip', Complement = '$complement', Port = NULL WHERE ID = $id AND ID_Client = $ID_Client;";
	}
} else {
	if($complement == NULL) {
		$sql = "UPDATE Cameras SET Nom = '$nom', Emplacement = '$emplacement', IP = '$ip', Complement = NULL, Port = $port WHERE ID = $id AND ID_Client = $ID_Client;";
	} else {
		$sql = "UPDATE Cameras SET Nom = '$nom', Emplacement = '$emplacement', IP = '$ip', Complement = '$complement', Port = $port WHERE ID = $id AND ID_Client = $ID_Client;";
	}
}

$exec = $bdd_connexion->exec($sql);

if($exec) { echo 'edit:done'; }
?>