<?php
include '../connexionBDD.php';

$json = json_decode($_POST['jsonString']);
$obj = $json[0];

$sql = "UPDATE Clients SET Login = '".$obj->Login."', Password = '".$obj->Password."' WHERE ID = ".$obj->ID.";";
$bdd_connexion->exec($sql);
?>
