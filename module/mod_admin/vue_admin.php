<?php

class Vue_admin {
  function show($users,$salles,$tickets){
    require_once(FUNCTIONS);
    $function=new functions;
    $function->showNav("admin");
    $this->showApp($users,$salles,$tickets);
    $this->addScript("addSalle");
  }


  function addScript($script){
    echo ('<script src="resources/scripts/'.$script.'.js"></script>');
  }
  function showUsers($users){
    $str="";
    foreach ($users as $key => $value) {
      $str.='<tr><td>'.$value['userid'].'</td><td>'.$value['nomUtilisateur'].'</td><td>'.$value['role'].'</td></tr>';
    }
    return('
    <div class="caption">
      <h3>Utlisateurs</h3>
    </div>
    <table class="table table-dark table-hover">
      <thead>
        <th scope="col">ID</td>
        <th scope="col">Nom dutilisateur</td>
        <th scope="col">Role</td>
      </thead>
      <tbody>
          '.$str.'
      </tbody>
    </table>
    ');
  }

  function showSalles($salles){
    $str="";
    foreach ($salles as $key => $value) {
      $str.='<tr><td>'.$value['numerosalle'].'</td><td>'.$value['capacite'].'</td><td>'.$value['nbpostes'].'</td></tr>';
    }
    return('
    <div class="caption">
      <h3>Salles</h3>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal"><i class="bi bi-plus-square"></i></button>
    </div>
    <table class="table table-dark table-hover">
      <thead>
        <th scope="col">Numero Salle</td>
        <th scope="col">Capacité</td>
        <th scope="col">Nombre de postes</td>
      </thead>
      <tbody>
          '.$str.'
      </tbody>
    </table>
    ');
  }

  function showTickets($tickets){
    $str="";
    foreach ($tickets as $key => $value) {
      $str.='<tr><td>'.$value['idticket'].'</td><td>'.$value['objet'].'</td><td>'.$value['requete'].'</td></tr>';
    }
    return('
    <div class="caption">
      <h3>Tickets</h3>
      <i class="bi bi-plus-square"></i>
    </div>
    <table class="table table-dark table-hover">
      <thead>
        <th scope="col">ID</td>
        <th scope="col">Objet</td>
        <th scope="col">Commentaire</td>
      </thead>
      <tbody>
          '.$str.'
      </tbody>
    </table>
    ');
  }

  function showModal(){
    return('
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            '.$this->showForm().'
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="saveChange" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    ');
  }

  function showForm(){
    return('
    <form>
      <div class="mb-3">
        <label for="numeroSalle" class="form-label">Numero salle</label>
        <input type="text" class="form-control" id="numeroSalle" aria-describedby="numeroSalle">
      </div>
      <div class="mb-3">
        <label for="capacite" class="form-label">Capacité</label>
        <input type="text" class="form-control" id="capacite">
      </div>
      <div class="mb-3">
        <label for="nbPostes" class="form-label">Nombre de postes</label>
        <input type="text" class="form-control" id="nbPostes">
      </div>
    </form>
    ');
  }
  function showApp($users,$salles,$tickets){
    echo('
      <link rel="stylesheet" href="'.DIR_NAME.'styles/style.css" />
      <div class="app">
        <div class="users">'.$this->showUsers($users).'</div>
        <div class="salles">'.$this->showSalles($salles).'</div>
        <div class="tickets">'.$this->showTickets($tickets).'</div>
      </div>
      '.$this->showModal()
    );
  }
}



 ?>
