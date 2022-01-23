<?php
    class Vue_accueil{

        function display($modules, $reservations,$details) {
          echo('<link rel="stylesheet" href="./module/mod_accueil/styles/styles.css">');
          require_once(FUNCTIONS);
          $function=new Functions();
          $function->showNav("accueil");
          $this->showMain($reservations,$details);
          $this->addScript(["logout"]);
        }

        function shownav($modules,$details){
          $str="";
          foreach ($modules as $key => $value) {
            if($value==="Home")
              $str.='<li class="selected"><a href="">'.$value.'</a></li>';
            else
              $str.='<li class=""><a href="">'.$value.'</a></li>';
          }
          echo('
          <nav id="navBar">
            <button id="ham">HAM</button>
            <div class="profile">
              <img src="resources/img/image.png" alt="profilePiciture" class="profilePicture" />
              <p class="username">'.$details["nomutilisateur"].'</p>
            </div>
            <ul>
              '.
              $str
              .'
            </ul>
            <button class="logout" id="logout">Logout</button>
          </nav>
          ');
        }

        function oneRowReservation($reservation){
          return('
            <tr><td>'.date('Y/m/d',strtotime($reservation["dateD"])).'</td><td>'.date('H:i:s',strtotime($reservation["heure"])).'</td><td>'.$reservation['numeroSalle'].'</td></tr>
          ');
        }

        function showReservation($reservations){
          if(!is_array($reservations))
            return ('
              <span>😭Vous n\'avez pas de reservation</span>
              <button class="addReservation">👉Ajouter</button>
              ');
          else{
            $tbodystr='';
            foreach ($reservations as $key => $value) {
              $tbodystr.=$this->oneRowReservation($value);
            }
            return('
              <table class="table table-dark table-hover">
                <thead>
                  <th scope="col">Date</th>
                  <th scope="col">Heure</th>
                  <th scope="col">Numero de salle</th>
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
