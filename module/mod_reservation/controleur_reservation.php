<?php
	require_once 'modele_reservation.php';
	require_once 'vue_reservation.php';
    require_once 'temp_Connexion.php';
	
	class Controleur_reservation {
		private $modele;
		public $vue;
		private $action;
		private $salle;
		private $heure;
		private $date;

				public function __construct() {
			$this->modele = new Modele_reservation();
			$this->vue = new Vue_reservation();
		}

		function init() {

			$this->action = htmlspecialchars($_GET['action']);
			if (!isset($_GET['action'])) {
				$this->action = "défaut";
			}

			switch($this->action) {
				case "défaut":
					$this->display();
					break;
				case "créneaux":
					$this->dispoCreneaux();
					break;
				case "réserver":
					$this->reserver();
					break;
				default:
					echo "Erreur dans le module de réservation au niveau de la réservation";
					break;
			}
		}

		// Surement à supprimer
		function reserver() {
			$heure = htmlspecialchars($_POST['heure']);
			$date = $this->date . " 00:00:00";
			for ($i = 0; $i < count($heure); $i++) {
				$heure2 = $this->date . " " . $heure[$i] . ":00:00";
				echo $heure2;
				// $this->modele->reserver($date, $heure2, $this->salle);
			}
			
		}

		function dispoSalle() {
			$this->model->salleDispo();
		}

		function dispoCreneaux() {	
			$this->salle = htmlspecialchars($_POST['salle']);
			$this->date = htmlspecialchars($_POST['date']);

			if (!isset($this->date)) {
				// La vue dois afficher une erreure ou jsp
				echo "choisir une date \n";
			}
			else {
				$crenaux = $this->modele->creneauxReserve($this->date, $this->salle);
				if (count($crenaux) > 0)
					$this->vue->afficheCreneau($crenaux);
				else
					$this->vue->creanauIndispo();
			}
		}

		// Surement à supprimer
		function affiche_form(){
			$salles = $this->dispoSalle();
			$this->vue->affiche_form($salles);
		}

		// Nom à changer
		function display() {
			$salles = $this->modele->sallesDispo();
			$this->vue->choixSalle($salles);
		}
	}
	Connexion::initConnexion();
	$ctl = new Controleur_reservation();
	$ctl->init();
?>
