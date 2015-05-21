<!DOCTYPE HTML>

<?php session_start();
if(isset($_SESSION['ID']) and $_SESSION['IP'] == $_SERVER['REMOTE_ADDR']) { ?>
<html>
	<head><?php include 'Includes/Head.php'; ?> <link rel="stylesheet" href="StyleSheet/gestionCameras.css"> </head>
	<body onLoad="updateList();" >
		<?php include 'Scripts/JavaScript/Scripts.php';
		include 'Scripts/connexionBDD.php';
		
		$maxID_Client = $bdd_connexion->query('SELECT MAX(ID) FROM Connexions WHERE ID_Client = '. $_SESSION['ID'] .';');
		$maxID_Client = $maxID_Client->fetch();
		$maxID_Client = $maxID_Client[0]; ?>
							
		<p class="infos">Connecté en tant que <?php echo $_SESSION['Prenom'] ." ". $_SESSION['Nom'] ." (". $_SESSION['IP'] .")"; ?>
		
		<?php if($maxID_Client > 1) {
			$infosConnect = $bdd_connexion->query('SELECT * FROM Connexions WHERE ID = '. ($maxID_Client - 1) .' AND ID_Client = '. $_SESSION['ID'] .';');
			$infosConnect = $infosConnect->fetch(); ?>
			
			<br> Dernière connexion le <?php echo date("d/m/Y", strtotime($infosConnect[2])) ." à ". $infosConnect[3] ." (". $infosConnect[4] .")"; ?></p>
		<?php } ?>

		<div id="gestionCam">
			<h3>Modifier mon compte</h3>
            <div id="listing">
                <table>
                    <thead>
                        <tr>
                            <th class="vingt">Nom</th>
                            <th class="quarante align-left">Emplacement</th>
                            <th class="vingt">IP</th>
                            <th class="vingt">Gestion</th>
                        </tr>
                    </thead>
                    <tbody id="cameras">
                    </tbody>
                </table>
            </div>
            <br><br><a href="#?w=900&id=new" rel="updateCam" class="popLink" id="addCamButton">Ajouter une caméra</a><br><br>
            <input type="button" value="Retour" onclick="returnBack();" id="returnButton" style="margin-top: -40px !important">

            <div id="updateCam" class="popUpBlock">
            </div>
        </div>
	</body>
</html>
<?php } else { header('location: connexion.php'); } ?>