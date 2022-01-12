<?php
		include_once 'modele_reservation.php';
		include_once 'vue_reservation.php';
		
		class Controleur_reservation {
			private $modele;
			public $vue;
			private $action;

			function init() {
				$this->reservation = htmlspecialchars($_POST['reservation']);
				if (!isset($_POST['reservation'])) {
					$this->reservation = "affiche_form";
				}

				switch($this->reservation) {
					case "affiche_form":
						$this->ctrl->affiche_form();
						break;
					case "reserver":
						$this->ctrl->reserver();
						break;
					default:
						echo "Erreur dans le module de réservation au niveau de la réservation";
						break;
				}
			}

			public function __construct() {
				$this->modele = new Modele_reservation();
				$this->vue = new Vue_reservation();
			}
	
			function menu() {
				$this->vue->menu();
			}

			function reserver() {
				$this->salle = htmlspecialchars($_GET['salle']);
				$this->debut = htmlspecialchars($_GET['debut']);
				$this->fin = htmlspecialchars($_GET['fin']);
				
				$this->modele->reserver($this->salle, $this->debut, $this->fin);
			}

			function dispoSalle() {
				$this->model->listSalleDispo();
			}


			function affiche_form(){
				$salles = $this->dispoSalle();
				$this->vue->affiche_form($salles);
			}
		}
?>
