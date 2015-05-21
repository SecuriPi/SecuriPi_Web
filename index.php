<?php/**
 * \file      index.php
 * \author    SécuriPi
 * \version   1.0
 * \brief     Index du site.
 *
 * \details   Ce fichier permet la redirection vers la page connexion lors de l'accès au site.
 */?>
     
<?php session_start();
header('location: connexion.php'); ?>
