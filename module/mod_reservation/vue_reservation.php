<?php
  class Vue_reservation {

      function afficheCreneau($creneaux, $date, $salle) {
        for ($i =0; $i<count($creneaux); $i++) {
          $output = $creneaux[$i] . ": 00-" . ($creneaux[$i] + 1) . ":00";
          echo '<a class="flash" href="index?module=reservation&action=réserver&date2=' . $date . '&salle2=' . $salle . '&heure=' . $creneaux[$i] . '"><button type="button" name="" value="">' . $output . '</button></a> ';
        }
        echo '
          <script type="text/javascript" src="'.DIR_NAME.'flash_reservation.js"></script>
        ';
      }

      function choixSalle($salles) {
        require_once(FUNCTIONS);
        $function=new Functions;
        $function->showNav("reservation");
        echo '
        <link rel="stylesheet" href="'.DIR_NAME.'style.css">
        <main class="app">
          <h2>Espace Réservation</h2>
          <form action="index.php?module=reservation&action=créneaux" method="post" id="choixSalle">
            <div class="row justify-content-md-center">
              <div class="col-sm">
                <label for="date">Choisir une salle:</label>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSalle" aria-expanded="false" aria-controls="collapseSalle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                  </svg>
                </button>

                <div class="collapse" id="collapseSalle">
                  <select name="salle">';

                    for ($i=0; $i<count($salles); $i++) {
                      echo '<option value=' . $salles[$i]['numerosalle'] . '>Salle ' . $salles[$i]['numerosalle'] . '</option>';
                    }

        echo    '
                  </select>
                </div>
              </div>

              <div class="col-sm">
                <label for="date">Sélectionner la date:</label>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDate" aria-expanded="false" aria-controls="collapseDate">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                  </svg>
                </button>
                <div class="collapse" id="collapseDate">
                  <input id="dateCourante" type="date" name="date" min=' . date("Y-m-d") . ' max="2023-01-01" >
                </div>
              </div>
            </div>
            <div class="row justify-content-md-center">
              <div class="col-md-auto">
                <button type="submit" id="Sub" class="btn btn-primary">Rechercher</button>
              </div>
            </div>
          </form>
          <script type="text/javascript" src="'.DIR_NAME.'flash_reservation.js"></script>



        </main>
      ';
      }
  }
?>
