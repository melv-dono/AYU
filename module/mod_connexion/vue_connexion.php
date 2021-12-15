<?php
Class Vue_connexion{
  function __construct(){

  }
  function affiche_form(){
    echo '
      <body>
        <link rel="stylesheet" href="./module/mod_connexion/styles/style.css">
        <main>
          <h2>Log in</h2>
          <form class="login_form" action="index.php?action=" method="post">
            <label for="login_input">Login</label>
            <input type="text" name="email_input" required value="">
            <label for="password_input">Password</label>
            <input type="password" name="password_input" required value="">
            <button class="submit">lesss goooo</button>
          </form>
        </main>
      </body>
    ';
  }
}
?>
