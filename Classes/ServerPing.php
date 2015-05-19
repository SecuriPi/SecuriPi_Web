/**
 * \file          ServerPing.php
 * \author    SécuriPi
 * \version   1.0
 * \brief       Permet de réaliser un ping sur un IP.
 *
 * \details    Cette classe permet de vérifier que la caméra est toujours 
 *             en ligne en réalisant un ping sur son adresse.
 */

<?php
/**
 * Executer un ping sur un IP ou un domaine
 */
class ServerPing {
	/** Buffer de sortie */
	private $output=array();
	private $avg=0;
	private $min=0;
	private $max=0;

	/**
	 * Envoyer la commande ping
	 * @param string $server nom de domaine ou ip
	 * @param int $repeat nombre de test
	 */
	public function send($server, $repeat) {
		if ($repeat==0) {
			throw new Exception("repeat cant be 0 !!!");
		}

		/**
		 * Lancer le ping sur le serveur
		 */
		$cmd='ping -c '.$repeat.' '.$server;
		exec($cmd, $this->output);
		/**
		 * Extraire les temps de rÃ©ponse
		 */
		if (count($this->output)>2) {
			$toparse=$this->output[count($this->output)-1];
			//example rtt min/avg/max/mdev = 8.198/8.291/8.351/0.127 ms
			if (strpos($toparse, 'rtt min/avg/max/mdev =')!==false) {
				$str=trim(substr($toparse, 23));
				$vals=explode("/",$str);

				if (count($vals)>=4) {
					$this->min=$vals[0];
					$this->max=$vals[2];
					$this->avg=$vals[1];
				}
			}
		}
	}

	/**
	 * Afficher le dÃ©tail du ping
	 * @return string rÃ©sultat du ping
	 */
	public function getOutput() {
		return implode("\\n", $this->output);
	}

	/**
	 * Connaitre l'Ã©tat du serveur
	 * @return boolean rÃ©ponse du serveur
	 */
	public function isAlive() {
		if ($this->avg==0) {
			return false;
		}  else {
			return true;
		}
	}
	/**
	 * @return int temps min. de rÃ©ponse
	 */
	public function getMin() {
		return $this->min;
	}
	/**
	 * @return int temps max. de rÃ©ponse
	 */
	public function getMax() {
		return $this->max;
	}

	/**
	 * @return int temps moyen de rÃ©ponse
	 */
	public function getAverage() {
		return $this->avg;
	}
}
?>