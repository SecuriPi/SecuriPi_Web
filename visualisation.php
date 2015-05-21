<!DOCTYPE HTML>
<?php 
/**
 * \file      visualisation.php
 * \author    SécuriPi
 * \version   1.0
 * \brief     Permet de visualiser les images transmises.
 *
 * \details   Ce fichier permet de visualiser les images transmises par les cameras.
 */

session_start();
if(isset($_SESSION['ID']) and $_SESSION['IP'] == $_SERVER['REMOTE_ADDR'])
{ ?>
<html>
	<head><?php include 'Includes/Head.php'; ?></head>
	<body onClick="oc()">
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
		
		<div class="night-tabs night-tabs-color-default night-tabs-animation-slide-right night-tabs-position-vleft">				
			<?php $cameras = $bdd_connexion->query('SELECT * FROM Cameras WHERE ID_Client = '. $_SESSION['ID'] .';');
				
			$firstCam = true;
			while ($row = $cameras->fetch()) {
				if($firstCam == true) {?>
					<input type="radio" name="night-tabs" id="<?php echo "tab". $row[0]; ?>" class="<?php echo "content". $row[0]; ?>" checked="">
					<label for="<?php echo "tab". $row[0]; ?>"><span><span><?php echo utf8_encode($row[2]); ?></span></span></label>
				<?php $firstCam = false; } else { ?>
					<input type="radio" name="night-tabs" id="<?php echo "tab". $row[0]; ?>" class="<?php echo "content". $row[0]; ?>">
					<label for="<?php echo "tab". $row[0]; ?>"><span><span><?php echo utf8_encode($row[2]); ?></span></span></label>
				<?php }
			} ?>
			
			<input type="radio" name="vide" id="vide" class="vide" checked="">
			<label for="vide"><span><span></span></span></label>
			<input type="radio" name="gestionCam" value="gestionCam" id="gestionCam">
			<label for="gestionCam"><span><span>Mes caméras</span></span></label>
			<input type="radio" name="gestionCompte" value="gestionCompte" id="gestionCompte">
			<label for="gestionCompte"><span><span>Mon compte</span></span></label>
			<input type="radio" name="deconnexion" value="deconnexion" id="deconnexion">
			<label for="deconnexion"><span><span>Déconnexion</span></span></label>
			
			<?php $cameras = $bdd_connexion->query('SELECT * FROM Cameras WHERE ID_Client = '. $_SESSION['ID'] .';'); ?>
				
			<ul class="night-tabs-content">
				<?php while ($row = $cameras->fetch()) { ?>
		           <li class="<?php echo "content". $row[0]; ?>">
		               <div class="<?php echo "content-". $row[0] ."-content"; ?>">
			                <h1><?php echo utf8_encode($row[2]); ?></h1>
			                <h2><?php echo utf8_encode($row[3]); ?></h2>
			                <?php require_once './Classes/ServerPing.php';
			                $serverPing = new ServerPing();
			                $serverPing->send($row[4], 1);
			                if ($serverPing->isAlive()) { ?>
			                	<img src="<?php echo "http://". $row[4]; ?>" >
			                <?php } else { ?>
			                	<h2 style="margin-top: 50px;">Caméra désactivée</h2>
			                <?php } ?>
		                </div>
		           </li>
		        <?php } ?>
		    </ul>
		</div>
	</body>
</html>
<?php } else { ?>
<form method="post" action="../connexion.php" id="err">
	<input type="hidden" name="erreur_connexion" value="erreur">
	<input style="height: 0px; border: none; background-color: rgba(255,255,255,0);" type="submit">
</form>

<script type="text/javascript">
	document.getElementById('err').submit();
</script>
<?php }?>
