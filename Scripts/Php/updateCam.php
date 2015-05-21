<?php
include '../connexionBDD.php';

$id = $_GET['id'];
$nom = utf8_decode($_GET['nom']);
$emplacement = utf8_decode($_GET['emplacement']);
$ip = $_GET['ip'];

$sql = "UPDATE Cameras SET Nom = '$nom', Emplacement = '$emplacement', IP = '$ip' WHERE ID = $id;";
$exec = $bdd_connexion->exec($sql);

if($exec) { echo 'edit:done'; }
?>