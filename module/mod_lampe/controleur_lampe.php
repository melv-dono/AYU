<?php
		include_once DIR_NAME.'modele_lampe.php';
		include_once DIR_NAME.'vue_lampe.php';

		class Controleur_lampe {
			private $modele;
			public $vue;
			private $action;
			private $getNumSalle;

			public function __construct() {
				$this->modele = new Modele_lampe();
				$this->vue = new Vue_lampe();
			}

			function mettreMenu(){
				$this->vue->show();
			}

			function allumer(){
				$allumer=1;
				//$getNumSalle=$this->modele->getNumSalle();
				//$this->modele->allumer($getNumSalle, $allumer);
				$this->modele->allumer($allumer);
				$this->vue->show();
			}

			function eteindre(){
				$allumer=0;
				//$getNumSalle=$this->modele->getNumSalle();
				//$this->modele->allumer($getNumSalle, $allumer);
				$this->modele->allumer($allumer);
				$this->vue->show();
			}

			function setLuminosite(){
				$lum=htmlspecialchars($_GET['luminosite']);
				$this->modele->setLuminosite($lum);
			}
		}
	?>
