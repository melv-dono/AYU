<?php
    class Vue_lampe {

        function show(){
          require_once(FUNCTIONS);
          $function->showNav("lampe");
          $this->menu();
        }
        function menu(){
            echo '
            <link rel="stylesheet" href="'.DIR_NAME.'lampe.css">
            <div class="app">
                <div class="gauche" style="text-align:center">
                    <a href="mod_lampe.php?module=lampe&action=allumer">Allumer<br></a>
                    <a href="mod_lampe.php?module=lampe&action=eteindre">Eteindre<br></a>
                </div>

                <div class="droite" style="text-align:center">
                    <div class="lumi">
                        <input type="range" class="form-range" id="luminosite" name="luminosite" min="0" max="100" value="100"><br>
                        <label for="luminosite" class="form-label">Luminosité</label><br>
                    </div>
                </div>
                <script src='.DIR_NAME."lampe.js".'>

                </script>
            </div>
            ';
        }
    }
?>
