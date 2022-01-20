<?php
    class Vue_accueil {

        function display($modules, $reservations) {
          echo('<link rel="stylesheet" href="./module/mod_accueil/styles/styles.css">');
          $this->shownav($modules);
          $this->showMain($reservations);
        }

        function shownav($modules){
          $str="";
          foreach ($modules as $key => $value) {
            $str.='<li class="list-group-item"><a href="">'.$value.'</a></li>';
          }
          echo('
          <nav>
            <img src="resources\img\image.png" width="120px"></img>
            <ul id="nav" class="list-group">
              '.
                $str
              .'
            </ul>
          </nav>
          ');
        }

        function showReservationDetails($reservation){
          $str="";
          foreach ($reservation as $key => $value) {
          $str.='<p>'.$key.' : '.$value.'</p>';
          }
          return('
            <div>
              '.
              $str
              .'
            </div>
          ');
        }
        function showReservation($reservations){
          $str='<li class="list-group-item">Vous n\'avez pas de reservations</li>';
          if(is_array($reservations)){
            $str='';
            foreach ($reservations as $key => $reservation) {
              $str.='<li class="list-group-item" id="reservation'.$key.'">'.$this->showReservationDetails($reservation).'</li>';
            }
          }
          return('
            <ul class="list-group">
              '.
                $str
              .'
            </ul>
            <button type="button" class="btn btn-outline-primary">ADD RESERVATION</button>
          ');
        }
        function showMain($reservations){
          echo('
          <main>
            <div class="head"></div>
            <div class="app">
              <div class="profile">
                <img id="profilePicture"src="image.jpg" width="150px" height="150px"></img>
                <div class="description">
                  <p id="username">Username : T1masv</p>
                  <p id="firstname">Firstname : Timotei</p>
                  <p id="lastname">Lastname :Gerante</p>
                  <p id="role">Role : ADMIN</p>
                </div>
              </div>
              <div class="reservation">
              '.
              $this->showReservation($reservations)
              .'
              </div>
              <div class="inProgress"></div>
            </div>
          </main>
          ');
        }
    }
?>
