<?php/**
 * \file          index.php
 * \author    S&eacute;curiPi
 * \version   1.0
 * \brief       Index du site.
 *
 * \details    Ce fichier permet la redirection vers la page connexion lors de
 *             l'acc&eacute;s au site.
 */?>
     
<?php session_start();
header('location: connexion.php'); ?>