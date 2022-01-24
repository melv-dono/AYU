<?php
    class Vue_chauffage {

        function menu(){
            echo '
            <link rel="stylesheet" href="'.DIR_NAME.'chauffage.css">
            <main>
                <div style="text-align:center">
                    <input type="range" id="temperature" name="temperature" min="15" max="25" step="1">
                    <label for="temperature">Temperature</label><br>
                </div>
                <script src='.DIR_NAME."chauffage.js".'></script>
            </main>
            ';
        }
    }
?>
