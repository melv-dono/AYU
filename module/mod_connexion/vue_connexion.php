<?php
Class Vue_connexion{
  function signin_form(){
    echo ('
    <link rel="stylesheet" href="./module/mod_connexion/styles/style.css">
    <form action="index?action=signin" methode="POST">  
        <div class="mb-3">
          <label for="input_username" class="form-label">Username</label>
          <input type="text" class="form-control" id="input_username" name="username" />
        </div>
        <div class="mb-3">
          <label for="input_firstname" class="form-label">Firstname</label>
          <input type="text" class="form-control" id="input_firstname" name="firstname"/>
        </div>
        <div class="mb-3">
          <label for="input_lastname" class="form-label">Lastname</label>
          <input type="text" class="form-control" id="input_lastname" name="lastname" />
        </div>
        <div class="mb-3">
          <label for="input_password" class="form-label">Password</label>
          <input type="password" class="form-control" id="input_password" name="password" />
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    ');
  }
  function login_form(){
    echo '
      <link rel="stylesheet" href="./module/mod_connexion/styles/style.css">
      <main>
        <h2>Login</h2>
        <form action="./index.php?action=login">
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
