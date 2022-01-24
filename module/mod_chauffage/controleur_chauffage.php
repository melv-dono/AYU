<?php
		include_once 'modele_chauffage.php';
		include_once 'vue_chauffage.php';

		class Controleur_chauffage {
			private $modele;
			public $vue;
			private $action;
			private $getNumSalle;

			public function __construct() {
				$this->modele = new Modele_chauffage();
				$this->vue = new Vue_chauffage();
			}

			function mettreMenu(){
				$this->vue->menu();
			}

			function setTemperature(){
				$tempe=htmlspecialchars($_GET['temperature']);
				$this->modele->setLuminosite($tempe);
			}
		}
	?>
