<?php
include '../connexionBDD.php';

$json = json_decode($_POST['jsonString']);
$id_client = $json[0]->ID_Client;

$sql = "SELECT ID  FROM Cameras WHERE ID_Client = ".$id_client.";";
$ID_cams = $bdd_connexion->query($sql);
$ID_cams = $ID_cams->fetchAll(PDO::FETCH_COLUMN, 0);

$id_sqlite = array();
foreach($json as $obj) {
	array_push($id_sqlite, $obj->ID);

	if(in_array($obj->ID, $ID_cams)) {
		if($obj->Port == 0) {
                        if($obj->Complement == '') {
				$sql = "UPDATE Cameras SET Nom = '".$obj->Nom."', Emplacement = '".$obj->Emplacement."', IP = '".$obj->IP."', Complement = NULL, Port = NULL WHERE ID = ".$obj->ID." AND ID_Client = ".$obj->ID_Client.";";
                        } else {
				$sql = "UPDATE Cameras SET Nom = '".$obj->Nom."', Emplacement = '".$obj->Emplacement."', IP = '".$obj->IP."', Complement = '".$obj->Complement."', Port = NULL WHERE ID = ".$obj->ID." AND ID_Client = ".$obj->ID_Client.";";
                        }
                } else {
                        if($obj->Complement == '') {
				$sql = "UPDATE Cameras SET Nom = '".$obj->Nom."', Emplacement = '".$obj->Emplacement."', IP = '".$obj->IP."', Complement = NULL, Port = ".$obj->Port." WHERE ID = ".$obj->ID." AND ID_Client = ".$obj->ID_Client.";";
                        } else {
				$sql = "UPDATE Cameras SET Nom = '".$obj->Nom."', Emplacement = '".$obj->Emplacement."', IP = '".$obj->IP."', Complement = '".$obj->Complement."', Port = ".$obj->Port." WHERE ID = ".$obj->ID." AND ID_Client = ".$obj->ID_Client.";";
                        }
                }

	} else if(!in_array($obj->ID, $ID_cams)) {
		if($obj->Port == 0) {
			if($obj->Complement == '') {
				$sql = "INSERT INTO Cameras VALUES(".$obj->ID.", ".$obj->ID_Client.", '".$obj->Nom."', '".$obj->Emplacement."', '".$obj->IP."', NULL, NULL);";
			} else {
				$sql = "INSERT INTO Cameras VALUES(".$obj->ID.", ".$obj->ID_Client.", '".$obj->Nom."', '".$obj->Emplacement."', '".$obj->IP."', '".$obj->Complement."', NULL);";
			}
		} else {
			if($obj->Complement == '') {
				$sql = "INSERT INTO Cameras VALUES(".$obj->ID.", ".$obj->ID_Client.", '".$obj->Nom."', '".$obj->Emplacement."', '".$obj->IP."', NULL, ".$obj->Port.");";
			} else {
				$sql = "INSERT INTO Cameras VALUES(".$obj->ID.", ".$obj->ID_Client.", '".$obj->Nom."', '".$obj->Emplacement."', '".$obj->IP."', '".$obj->Complement."', ".$obj->Port.");";
			}
		}
	}
	echo $sql.'<br>';
	$bdd_connexion->exec($sql);
}

foreach($ID_cams as $id_cam) {
	if(!in_array($id_cam, $id_sqlite)) {
		$sql = "DELETE FROM Cameras WHERE ID = ".$id_cam." AND ID_Client = ".$id_client.";";
		$bdd_connexion->exec($sql);
	}
}

?>
