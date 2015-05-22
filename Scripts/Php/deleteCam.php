<?php
include '../connexionBDD.php';

$id = $_GET['id'];

if($id != '') {
	$sql = "DELETE FROM Cameras WHERE ID = $id;";
	$exec = $bdd_connexion->exec($sql);

	$sql_reindent = "UPDATE Cameras SET ID = ID - 1 WHERE ID > $id;";
	$exec_reindent = $bdd_connexion->exec($sql_reindent);
	if($exec) { echo 'suppr:done'; }
}
?>