<?php
Class Vue_connexion{
  function __construct(){

  }
  function affiche_form(){
    echo '
      <link rel="stylesheet" href="./module/mod_connexion/styles/style.css">
      <main>
        <h2>Login</h2>
        <form>
          <div class="mb-3">
            <label for="username_input" class="form-label">Username</label>
            <input type="text" class="form-control" id="username_input">
          </div>
          <div class="mb-3">
            <label for="password_input" class="form-label">Password</label>
            <input type="password" class="form-control" id="password_input">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </main>
    ';
  }
}
?>
