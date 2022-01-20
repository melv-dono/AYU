<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
         <link rel="icon" type="image/x-icon" href="resources\img\fav.png">
        <title>AYU</title>
</head>
<body>
<?php
    session_start();
    if(isset($_SESSION["access_token"])){
      require_once("./module/mod_accueil/mod_accueil.php");
      $mod_acceuil=new Mod_accueil();
      $mod_acceuil->show();
    }
    else {
      require_once("module\mod_connexion\mod_connexion.php");
      $mod_connexion=new Mod_connexion();
      $mod_connexion->display();
    }

?>

</body>
