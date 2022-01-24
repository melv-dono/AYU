<?php

	require_once DIR_NAME.'modele_tickets.php';
	require_once DIR_NAME.'vue_tickets.php';
		
	class Controleur_tickets {
		private $modele;
		public $vue;
		private $action;

		function init() {
			$this->action=htmlspecialchars($_GET['action']);
			if(!isset($_GET['action'])){
                $this->action='index';
            }
            switch($this->action){
                case 'index':
                    $this->mettreMenu();
                    break;
                case 'envoie':
                    $this->enovieTicket();
                    break;
				default:
					echo "Erreur switch ticket";
					break;
            }
		}

		function __construct() {
			$this->modele = new Modele_tickets();
			$this->vue = new Vue_tickets();
		}

		function enovieTicket() {
			$requete = htmlspecialchars($_POST['contenu']);
			$salle = htmlspecialchars($_POST['ticketSalle']);
			$objet = htmlspecialchars($_POST['objet']);
			$bool = $this->modele->envoyer($objet, $salle, $requete);

			if ($bool > 0) 
				$this->vue->validation();
			else
				$this->vue->erreurEnvoie();
		}
		
		function mettreMenu(){
			$Salle = $this->modele->sallesDispo();
			if (!isset($Salle))
				echo "rien";
			$this->vue->menu($Salle);
		}
	}

?>
