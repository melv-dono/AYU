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
				$salle = htmlspecialchars($_POST['salle']);
				$duree = htmlspecialchars($_POST['duree']);
				$date = htmlspecialchars($_POST['date']);
				$heure = htmlspecialchars($_POST['heure']);
				
				$this->modele->reserver($salle, $date, $heure, $duree);
			}

			function dispoSalle() {
				$this->model->listSalleDispo();
			}

			function dispoCreneaux() {
				$ok = $this->modele->creneauxDispo($date, $salle);
				if ($ok != 6)
					$this->vue->afficheCreneau($ok);
				else
					$this->vue->creanauIndispo();
			}

			function affiche_form(){
				$salles = $this->dispoSalle();
				$this->vue->affiche_form($salles);
			}
		}
?>
