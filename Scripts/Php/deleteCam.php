<?php
include '../connexionBDD.php';
session_start();
$ID_Client = $_SESSION['ID'];

$id = $_GET['id'];

if($id != '') {
	$sql = "DELETE FROM Cameras WHERE ID = $id AND ID_Client = $ID_Client;";
	$exec = $bdd_connexion->exec($sql);

	$sql_reindent = "UPDATE Cameras SET ID = ID - 1 WHERE ID > $id AND ID_Client = $ID_Client;";
	$exec_reindent = $bdd_connexion->exec($sql_reindent);
	if($exec) { echo 'suppr:done'; }
}
?>