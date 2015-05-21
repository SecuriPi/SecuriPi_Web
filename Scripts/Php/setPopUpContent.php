<?php

$id = $_GET['id'];

$str_out = '<a href="javascript:closePopUp();" class="close"><img src="System/Images/popup_close_icon.png" class="buttonClose" title="Fermer" alt="Fermer"/></a>';

if($id == 'new') {
		$str_out .= '<h3>Ajouter une caméra</h3>
	<form>
	<input type="text" name="nom" placeholder="Nom"><br>
	<input type="text" name="emplacement" placeholder="Emplacement"><br>
	<input type="text" name="ip" placeholder="IP"><br><br>
	<input type="button" onclick="addCam(nom.value, emplacement.value, ip.value);" value="Ajouter">
	</form>';
} else {
	include '../connexionBDD.php';

	$sql_get_cameras = "SELECT * FROM Cameras WHERE ID = $id;";
	$get_cameras = $bdd_connexion->query($sql_get_cameras);
	$cameras = $get_cameras->fetch(PDO::FETCH_ASSOC);

	$str_out .= '<h3>Modifier une caméra</h3>
	<form>
	<input type="hidden" name="id_cam" value="'.$id.'">
	<input type="text" name="nom" value="'.utf8_encode($cameras['Nom']).'"><br>
	<input type="text" name="emplacement" value="'.utf8_encode($cameras['Emplacement']).'"><br>
	<input type="text" name="ip" value="'.$cameras['IP'].'"><br><br>
	<input type="button" onclick="updateCam(id_cam.value, nom.value, emplacement.value, ip.value);" value="Enregistrer">
	</form>';
}

echo $str_out;
?>