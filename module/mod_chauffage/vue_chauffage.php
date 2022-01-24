<?php
    class Vue_chauffage {
        
        function menu(){
            echo '
            <link rel="stylesheet" href="chauffage.css">
            <main>
                <div style="text-align:center">
                    <br>
                    <input type="range" id="temperature" name="temperature" min="15" max="25" step="1"><br>
                    <output></output>
                    <label for="temperature">Temperature</label><br>
                </div>

                <script src='.DIR_NAME."chauffage.js".'>

                </script>
            </main>
            ';
        }
    }
?>