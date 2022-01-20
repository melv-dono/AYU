<?php

	require_once("./module/mod_accueil/modele_acceuil.php");
	require_once("./module/mod_accueil/vue_acceuil.php");
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
