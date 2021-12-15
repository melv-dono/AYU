<?php
		include_once 'modele_lampe.php';
		include_once 'vue_lampe.php';
		
		class Controleur_lampe {
			private $modele;
			public $vue;
			private $action;

			public function __construct() {
				$this->modele = new Modele_lampe();
				$this->vue = new Vue_lampe();
			}
	
			function menu() {
				$this->vue->menu();
			}
		}
	?>
