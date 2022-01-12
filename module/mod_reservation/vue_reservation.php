<?php
    class Vue_reservation {
        public function __construct() {
            
        }

        // Faire un tableau via le mondèle que l'on passe en param de la fonciton pour afficher les dates possible
        function affiche_form($salles, $dates, $durees){
            echo '
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
              <main>
                <h2>Espace Réservation</h2>
                <form action="/controleur_reservation.php?reservation=resrever" id="formResa" method="post">
                 <label for="cars">Choisir une salle :</label>
                <select name="cars" id="salle" form="formResa">
                  <option value="A1-01">Salle A1-01</option>
                  <option value="A1-02">Salle A1-02</option>
                  <option value="A1-03">Salle A1-03</option>
                </select> 
        
                 <label for="date">Date:</label>
                 <input type="text" name="" id="date">
        
                 <label for="cars">Durée:</label>
                 <select name="cars" id="duree" form="formResa">
                  <option value="30">30 minutes</option>
                  <option value="60">1 heure</option>
                  <option value="90">1 heure 30 minutes</option>
                  <option value="120">2 heures</option>
                </select> 
                </form>
              </main>
            ';
        }
    }
?>