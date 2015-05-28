<?php
include '../connexionBDD.php';

$json = json_decode($_POST['jsonString']);

$sql = "SELECT ID FROM Connexions;";
$IDs = $bdd_connexion->query($sql);
$IDs = $IDs->fetchAll(PDO::FETCH_COLUMN, 0);

foreach($json as $obj) {
	if(!in_array($obj->ID, $IDs)) {
		$sql_insert = "INSERT INTO Connexions VALUES(".$obj->ID.",".$obj->ID_Client.",'".$obj->Date."','".$obj->Heure."','".$obj->IP."');";
		$bdd_connexion->exec($sql_insert);
	}
}
?>
