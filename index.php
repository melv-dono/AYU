<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="resources/scripts/jquery-3.6.0.min.js" charset="utf-8"></script>
        <link rel="icon" type="image/x-icon" href="resources/img/fav.png">
        <title>AYU</title>
</head>
<body>
<?php
session_start();
$module=isset($_GET["module"]) ? $_GET["module"] : "accueil";
require("utile/define.php");
$filePath=DIR_NAME."mod_".$module.".php";
if(file_exists($filePath)){
  require_once($filePath);
  $page=new Mod;
}
else{
  http_response_code(404);
  die();
}

 ?>

</body>
