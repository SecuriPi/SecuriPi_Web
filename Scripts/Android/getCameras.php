<?php

include '../connexionBDD.php';

$id_client = $_GET['id_client'];
$sql = "SELECT * FROM Cameras WHERE ID_Client = $id_client;";
$cameras = $bdd_connexion->query($sql);

while($ligne = $cameras->fetchObject()) {
        $arrResultat[] = $ligne;
}

print json_encode($arrResultat);
?>
