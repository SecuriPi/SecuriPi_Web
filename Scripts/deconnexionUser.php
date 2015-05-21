<?php/**
 * \file          deconnexionUser.php
 * \author    S&eacute;curiPi
 * \version   1.0
 * \brief       D&eacute;connexion d'un utilisateur.
 *
 * \details    Ce fichier permet de d&eacute;connecter l'utilisateur du site.
 */?>

<?php
session_start();
$_SESSION = array();
session_destroy();
header('location: ../connexion.php');
?>