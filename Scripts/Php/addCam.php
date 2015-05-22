<?php
session_start();
include '../connexionBDD.php';

$id_client = $_SESSION['ID'];

$sql_get_max_ID_cam = "SELECT MAX(ID) FROM Cameras WHERE ID_Client = $id_client AND ID >= 1;";
$get_max_ID_cam = $bdd_connexion->query($sql_get_max_ID_cam);
$max_ID_cam = $get_max_ID_cam->fetch();
$max_ID_cam = $max_ID_cam[0] + 1;

$nom = utf8_decode($_GET['nom']);
$emplacement = utf8_decode($_GET['emplacement']);
$ip = $_GET['ip'];
$complement = $_GET['complement'];
$port = $_GET['port'];

if($port == NULL) {
	if($complement == NULL) {
		$sql = "INSERT INTO Cameras(ID, ID_Client, Nom, Emplacement, IP) VALUES($max_ID_cam, $id_client, '$nom', '$emplacement', '$ip');";
	} else {
		$sql = "INSERT INTO Cameras(ID, ID_Client, Nom, Emplacement, IP, Complement) VALUES($max_ID_cam, $id_client, '$nom', '$emplacement', '$ip', '$complement');";
	}
} else {
	if($complement == NULL) {
		$sql = "INSERT INTO Cameras(ID, ID_Client, Nom, Emplacement, IP, Port) VALUES($max_ID_cam, $id_client, '$nom', '$emplacement', '$ip', $port);";
	} else {
		$sql = "INSERT INTO Cameras(ID, ID_Client, Nom, Emplacement, IP, Complement, Port) VALUES($max_ID_cam, $id_client, '$nom', '$emplacement', '$ip', '$complement', $port);";
	}
}
$exec = $bdd_connexion->exec($sql);

if($exec) { echo 'insert:done'; }
?>