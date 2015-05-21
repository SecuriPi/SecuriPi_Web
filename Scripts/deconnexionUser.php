<?php

/**
 * \file      deconnexionUser.php
 * \author    SécuriPi
 * \version   1.0
 * \brief     Déconnexion d'un utilisateur.
 *
 * \details   Ce fichier permet de déconnecter l'utilisateur du site.
 */

session_start();
$_SESSION = array();
session_destroy();
header('location: ../connexion.php');
?>
