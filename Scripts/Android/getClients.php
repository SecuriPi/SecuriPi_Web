<?php

include '../connexionBDD.php';

$id_client = $_GET['id_client'];
$sql = "SELECT * FROM Clients WHERE ID = $id_client;";
$clients = $bdd_connexion->query($sql);


while($ligne = $clients->fetchObject()) {
	$arrResultat[] = $ligne;
}

print json_encode($arrResultat);
