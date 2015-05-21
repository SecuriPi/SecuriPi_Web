<?php
include '../connexionBDD.php';

$login = $_GET['login'];
$password = $_GET['password'];
$confirm = $_GET['confirm'];
$userID = $_GET['userID'];

$md5password = MD5($password);
$md5confirm = MD5($confirm);

if($login != NULL) {
	if($password == $confirm AND $password != NULL) {
		$sql = "UPDATE Clients SET Login = '$login' WHERE ID = $userID;";
		$exec = $bdd_connexion->exec($sql);

		$sql = "UPDATE Clients SET Password = '$md5password' WHERE ID = $userID;";
		$exec2 = $bdd_connexion->exec($sql);
	} else if($password == NULL AND $confirm == NULL) { echo 'mdp:empty'; }
	else if($password != $confirm AND $password != NULL) { echo 'err:confirm'; }
} else { echo 'login:empty'; }

if($exec AND $exec2) { echo 'done'; }
?>