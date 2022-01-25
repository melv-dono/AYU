<?php
	require_once DIR_NAME.'modele_reservation.php';
	require_once DIR_NAME.'vue_reservation.php';

	class Controleur_reservation {
		private $modele;
		public $vue;
		private $action;

		public function __construct() {
			$this->modele = new Modele_reservation();
			$this->vue = new Vue_reservation();
		}

		function init() {
			array_key_exists("action",$_GET) ? $this->action=$_GET['action'] : $this->action='défaut';
			switch($this->action) {
				case "défaut":
					$this->display();
					break;
				case "créneaux":
					$this->dispoCreneaux();
					break;
				case "deleteReservation":
					$this->deleteReservation();
					break;
				case "réserver":
					$this->reserver();
					break;
				default:
					echo "Erreur dans le module de réservation au niveau de la réservation";
					break;
			}
		}

		function reserver() {
			$heure = htmlspecialchars($_GET['heure']);
			$date = htmlspecialchars($_GET['date2']);
			$salle = htmlspecialchars($_GET['salle2']);
			$date2 = $date . " 00:00:00";
			$heure2 = $date . " " . $heure . ":00:00";
			$this->modele->reserver($date2, $heure2, $salle);
		}

		function deleteReservation(){
			isset($_GET['deleteReservation']) ?	$this->modele->deleteReservation($_GET['deleteReservation']) : false ;
		}
		function dispoCreneaux() {
			$salle = htmlspecialchars($_POST['salle']);
			$date = htmlspecialchars($_POST['date']);
			$crenaux = $this->modele->creneauxReserve($date, $salle);
			if (count($crenaux) > 0)
				$this->vue->afficheCreneau($crenaux, $date, $salle);
			else
				$this->vue->creanauIndispo();

		}

		function display() {
			$salles = $this->modele->sallesDispo();
			$this->vue->choixSalle($salles);
		}
	}

?>
