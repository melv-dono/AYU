<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>AYU</title>
</head>
<body>
<?php
    session_start();
    require_once("./module/mod_connexion/mod_connexion.php");
    $modConnexion = new Mod_connexion();
    $modConnexion->display();
?>

</body>
