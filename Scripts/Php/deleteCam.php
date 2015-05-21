<?php
include '../connexionBDD.php';

$id = $_GET['id'];

if($id != '') {
	$sql = "DELETE FROM Cameras WHERE ID = $id;";
	$exec = $bdd_connexion->exec($sql);
	if($exec) { echo 'suppr:done'; }
}
?>