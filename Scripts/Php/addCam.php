<?php
session_start();
include '../connexionBDD.php';

$id_client = $_SESSION['ID'];
$nom = utf8_decode($_GET['nom']);
$emplacement = utf8_decode($_GET['emplacement']);
$ip = $_GET['ip'];
$port = $_GET['port'];

$sql = "INSERT INTO Cameras(ID_Client, Nom, Emplacement, IP) VALUES($id_client, '$nom', '$emplacement', '$ip', '$port');";
$exec = $bdd_connexion->exec($sql);

if($exec) { echo 'insert:done'; }
?>