<?php

include '../connexionBDD.php';

session_start();
$ID_Client = $_SESSION['ID'];

$sql_get_cameras = "SELECT * FROM Cameras WHERE ID_Client = $ID_Client;";
$get_cameras = $bdd_connexion->query($sql_get_cameras);

$str_out = '';
while($cameras = $get_cameras->fetch()) {
	$str_out .= '<tr>
		<td>'.utf8_encode($cameras['Nom']).'</td>
		<td class="align-left">'.utf8_encode($cameras['Emplacement']).'</td>
		<td>'.$cameras['IP'].'</td>
		<td>'.$cameras['Complement'].'</td>
		<td>'.$cameras['Port'].'</td>
		<td><a href="#?w=900&id='.$cameras['ID'].'" rel="updateCam" class="popLink"><img src="System/Images/modify_icon.png" onclick="openUpdate();"></a><img src="System/Images/delete_icon.png" onclick="deleteCam('.$cameras['ID'].');"></td>
		</tr>';
}
if($str_out == '') {
	$str_out .= '<tr><td colspan="6">Aucune caméras trouvée</td></tr>';
}

echo $str_out;
?>