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
              
              <form action="/~melvyn/AYU/module/mod_reservation/vue_reservation.php" method="post">
              <select name="cars" id="salle" form="formResa">
                <option value="B112">Salle B1-12</option>
                <option value="B112">Salle B1-12</option>
                <option value="B112">Salle B1-12</option>
              </select> 
        
                <label for="date">Sélectionner la date:</label>
                <input type="date" name="date" min= "2022-01-01" max="2023-01-01" >

                <label for="date">Sélectionner la date:</label>
                <input type="datetime-local" name="dateTime">
                
        
                <label for="heure">Choisir une heure:</label>
                <input type="time" name="heure ">
        
              <label for="duree">Déterminer une durée:</label>
              <select name="duree">
                <option value="30">30 minutes</option>
                <option value="60">1 heure</option>
                <option value="90">1 heure 30 minutes</option>
                <option value="120">2 heures</option>
              </select> 

              <input type="submit" value="here" name="Sub">
              </form>
            </main>
          ';
      }

      function afficheCreneau($creneaux, $date, $salle) {
        // echo '<form action="/~melvyn/AYU/module/mod_reservation/controleur_reservation.php?module=mod_reservation&action=réserver&date2=' . $date . '&salle2=' . $salle . '" method="post">';
        
        // Bientôt utiliser la var global pour la limite
        // Attention nous somme dans le cas ou $creneaux est la liste des créneaux déjà réserver 
        // Plus simple serait de prendre la liste inverse pour enlever cette partie de la vue
        for ($i =0; $i<count($creneaux); $i++) {
          $output = $creneaux[$i] . ": 00-" . ($creneaux[$i] + 1) . ":00";
          echo '<a class="flash" href="/~melvyn/AYU/module/mod_reservation/controleur_reservation.php?module=mod_reservation&action=réserver&date2=' . $date . '&salle2=' . $salle . '&heure=' . $creneaux[$i] . '"><button type="button" name="" value="">' . $output . '</button></a> ';
          // $currentCreneau = new Datetime();
          // $currentCreneau->setTime($i+9);
          // if ($creneaux[$i] != $currentCreneau) {
          //   if ($i % 3 == 0 && $i != 0)
          //   echo '
          //     <input type="checkbox" name="heure' . $i . '" value="' . $currentCreneau .'">
          //     <br></br>
          //   ';
          //   else
          //     echo '<input type="radio" name="heure' . $i . '" value="' . $currentCreneau .'">';
          // }
        }
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
        echo '<script type="text/javascript" src="flash_reservation.js"></script>';
    
        // echo '
        //   <input type="submit" value="ici">
        //   </form>
        // ';
      }

      function creanauIndispo() {
        //TODO
      }

      function choixSalle($salles) {
        echo '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <main>
          <h2>Espace Réservation</h2>
          
          <form action="/~melvyn/AYU/module/mod_reservation/controleur_reservation.php?module=mod_reservation&action=créneaux" method="post">
            <label for="date">Choisir une salle:</label>
            <select name="salle">';
        
        foreach ($salles as $salle) {
          echo '<option value=' . $salle . '>Salle ' . $salle . '</option>';
        }

        echo    '</select> 
    
            <label for="date">Sélectionner la date:</label>
            <input type="date" name="date" min=' . date("Y-m-d") . ' max="2023-01-01" >

            <input type="submit" value="here" name="Sub">
          </form>
        </main>
      ';
      }
  }

  // $tab = array('A1-01', 'A1-02', 'A1-03', 'A1-04', 'A1-05', 'B1-09', 'B1-10', 'B1-12');
  // $a = new Vue_reservation();
  // $a->choixSalle($tab);
  // echo "\n";
  // $tab2 = array(9,12,15,18);
  // $a->afficheCreneau($tab2);

  // $tes = htmlspecialchars($_POST['dateTime']);
  // $sb = htmlspecialchars($_POST['Sub']);

  // //echo $tes . "il y a un espace";
  // // if (isset($sb))
  // if (!isset($tes)||$tes=="")
  // echo "Please select a date";
  // else
  //   echo $tes . "\n";
  //   $d=strtotime($tes);
  //   $date = new Datetime();       
  //   $date->setTimestamp($d);
  //   echo $date->format(' Y-m-d H:i:s') . "\n";


  // echo '<form action="/~melvyn/AYU/module/mod_reservation/vue_reservation.php" method="post">';

  // for ($i =0; $i<10; $i++) {
  //   if ($i % 3 == 0 && $i != 0)
  //     echo '
  //       <input type="checkbox" name="heure' . $i . '" value="' . $i .'">
  //       <br></br>
  //     ';
  //   else
  //     echo '<input type="radio" name="heure' . $i . '" value="' . $i .'">';
  // }

  // echo '
  //   <input type="submit" name="sub">
  //   </form>
  // ';

  // $valid = htmlspecialchars($_POST['sub']);
  // if (isset($valid)) { 
  //   for ($j = 0; $j<10; $j++) {
  //     $id = 'heure' . $j;
  //     $myVar = htmlspecialchars($_POST[$id]);
  //     if (isset($myVar))
  //       echo $myVar;
  //   }
  // }

?>