<?php
    class Vue_accueil{

        function display($modules, $reservations,$details) {
          echo('<link rel="stylesheet" href="./module/mod_accueil/styles/styles.css">');
          require_once(FUNCTIONS);
          $function=new Functions();
          $function->showNav("accueil");
          $this->showMain($reservations,$details);
          $this->addScript(["editReservation"]);
        }

        function options(){
          return('
            <div class="option">
              <i class="bi bi-x deleteReservation"></i>
            </div>
          ');
        }

        function oneRowReservation($reservation){
          return('
            <tr>
            <td>'.$reservation["idreserv"].'</td>
            <td>'.date('Y/m/d H:i:s',strtotime($reservation["dateD"])).'</td>
            <td>'.date('Y/m/d H:i:s',strtotime($reservation["heure"])).'</td>
            <td>'.$reservation['numeroSalle'].'</td>
            <td>'.$this->options().'</td>
            </tr>
          ');
        }

        function showReservation($reservations){
          if(!is_array($reservations))
            return ('
              <span>😭Vous n\'avez pas de reservation</span>
              <button id="addReservation" class="addReservation">👉Ajouter</button>
              <script src="resources/scripts/addReservation.js"></script>
              ');
          else{
            $tbodystr='';
            foreach ($reservations as $key => $value) {
              $tbodystr.=$this->oneRowReservation($value);
            }
            return('
              <table class="table table-dark table-hover">
                <thead>
                  <th scope="col">id</th>
                  <th scope="col">Date Debut</th>
                  <th scope="col">Date Fin </th>
                  <th scope="col">Numero de salle</th>
                  <th scope="col">options</th>
                </thead>
                <tbody>
                  '.$tbodystr.'
                </tbody>
              </table>
            ');
          }
        }

        function showMain($reservations,$details){
          echo('
            <div class="app">
            <h3>Bonjour '.$details['nomutilisateur'].' 👋</h3>
              <div class="reservation">
              '.
              $this->showReservation($reservations)
              .'
              </div>
            </div>
          </main>
          ');
        }

        function addScript($scripts){
          foreach ($scripts as $key => $value) {
            echo ('<script type=module src="resources/scripts/'.$value.'.js"></script>');
          }
        }
    }
?>
