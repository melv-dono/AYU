<?php
		include_once 'modele_accueil.php';
		include_once 'vue_accueil.php';
		
		class Controleur_accueil {
			private $modele;
			public $vue;
			private $action;

			public function __construct() {
				$this->modele = new Modele_accueil();
				$this->vue = new Vue_accueil();
			}
	
			function menu() {
				$this->vue->menu();
			}
		}
	?>
