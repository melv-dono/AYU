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
				$this->vue->menu();
			}

			function afficherListeLampesSalle($numSalle) {
				$this->modele->getListeLampesSalle($numSalle);
			}

			function allumer($numSalle){
				$allumer=1;
				$this->modele->allumer($numSalle, $allumer);
			}

			function eteindre($numSalle){
				$allumer=0;
				$this->modele->allumer($numSalle, $allumer);
			}
		}
	?>
