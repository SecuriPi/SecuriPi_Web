<?php

/**
 * \file      connexionAndroid.php
 * \author    SécuriPi
 * \version   1.0
 * \brief     Permet de réaliser la connexion à la base de donnée.
 *
 * \details   Ce fichier permet de se connecter à la base dans le but de s'authentifier via l'application Android.
 */

include '../connexionBDD.php';

$clients = $bdd_connexion->query('SELECT * FROM Clients');

$connect = false;

while ($row = $clients->fetch()) {
	if(strtolower($_POST['login']) == strtolower($row[3]) and md5($_POST['password']) == $row[4]){
		$ID = $row[0];

		$connect = true;
	}
}

if($connect == true)
	echo $ID;
else
	echo "false";
?>
