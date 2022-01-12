<?php
    class Vue_reservation {
        public function __construct() {
            
        }

        // Faire un tableau via le mondèle que l'on passe en param de la fonciton pour afficher les dates possible
        function affiche_form(){ // $salles, $dates, $durees
            echo '
              <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
              <main>
                <h2>Espace Réservation</h2>
                
                <form action="/~mnzengatayou/AYU/module/mod_reservation/vue_reservation.php" method="post">
                <select name="cars" id="salle" form="formResa">
                  <option value="A1-01">Salle A1-01</option>
                  <option value="A1-02">Salle A1-02</option>
                  <option value="A1-03">Salle A1-03</option>
                </select> 
          
                 <label for="date">Sélectionner la date:</label>
                 <input type="date" name="date" min= "2022-01-01" max="2023-01-01" >
          
                 <label for="heure">Choisir une heure:</label>
                 <input type="time" name="heure ">
          
                <label for="duree">Déterminer une durée:</label>
                <select name="duree">
                  <option value="30">30 minutes</option>
                  <option value="60">1 heure</option>
                  <option value="90">1 heure 30 minutes</option>
                  <option value="120">2 heures</option>
                </select> 

               <input type="submit">
                </form>
              </main>
            ';
        }
    }

    $a = new Vue_reservation();
    $a->affiche_form();

    $tes = htmlspecialchars($_POST['date']);
    //echo $tes . "il y a un espace";
    if (!isset($tes)||$tes=="")
    echo "Please select a date";
    else
      
      echo $tes;
?>