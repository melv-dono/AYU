<?php
    class Vue_lampe {
        
        function menu(){
            //echo '<a href="mod_lampe.php?module=lampe&action=listeLampes">Liste des Lampes<br></a>';
            echo '<a href="mod_lampe.php?module=lampe&action=allumer">Allumer<br></a>';
            echo '<a href="mod_lampe.php?module=lampe&action=eteindre">Eteindre<br></a>';
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <main>
                <div style="text-align:center">
                    <input type="range" id="luminosite" name="luminosite" min="0" max="100" value="100"><br>
                    <label for="luminosite">Luminosité</label><br>
                    <input type="color" id="couleur" name="couleur"><br>
                    <label for="couleur">Couleur</label><br>
                </div>
                <script>
                    const selectLumi = document.getElementById("luminosite");
                    selectLumi.addEventListener("mouseup", (event)=>{
                        
                    });
                </script>
            </main>
            ';
        }
    }
?>