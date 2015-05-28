<?php

include '../connexionBDD.php';

$id_client = $_GET['id_client'];
$sql = "SELECT * FROM Connexions WHERE ID_Client = $id_client;";
$connexions = $bdd_connexion->query($sql);

while($ligne = $connexions->fetchObject()) {
        $arrResultat[] = $ligne;
}

print json_encode($arrResultat);
?>
