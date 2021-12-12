<?php
Class Vue_connexion{
  function __construct(){
    
  }
  function affiche_form(){
    echo '
    <!DOCTYPE html>
    <html lang="fr" dir="ltr">
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./module/mod_connexion/styles/style.css">
        <title></title>
      </head>
      <body>
        <main>
          <h2>Log in</h2>
          <form class="login_form" action="index.html" method="post">
            <label for="email_input">Email</label>
            <input type="email" name="email_input" required value="">
            <label for="password_input">Password</label>
            <input type="password" name="password_input" required value="">
            <button class="submit">lesss goooo</button>
          </form>
        </main>
      </body>
    </html>

    ';
  }
}
?>
