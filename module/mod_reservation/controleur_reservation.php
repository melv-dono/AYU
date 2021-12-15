<?php
		include_once 'modele_reservation.php';
		include_once 'vue_accueil.php';
		
		class Controleur_reservation {
			private $modele;
			public $vue;
			private $action;

			public function __construct() {
				$this->modele = new Modele_reservation();
				$this->vue = new Vue_reservation();
			}
	
			function menu() {
				$this->vue->menu();
			}
		}
?>
