<?php
	include_once 'modele_tickets.php';
	include_once 'vue_tickets.php';
		
	class Controleur_tickets {
		private $modele;
		public $vue;
		private $action;
		private $getNumSalle;

		public function __construct() {
			$this->modele = new Modele_tickets();
			$this->vue = new Vue_tickets();
		}

		function mettreMenu(){
			$this->vue->menu();
		}
	}
?>
