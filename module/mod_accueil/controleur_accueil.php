<?php

	require_once("module/mod_accueil/modele_accueil.php");
	require_once("module/mod_accueil/vue_accueil.php");
		class Controleur_accueil {
			private $modele;
			public $vue;
			private $action;

			public function __construct() {
				$this->modele = new Modele_accueil();
				$this->vue = new Vue_accueil();
			}

			function init() {
				$modules=$this->modele->getAvailableModules();
				$reservations=$this->modele->getReservation();
				$this->vue->display($modules,$reservations);
			}
		}
	?>
