<?php
    class Vue_chauffage {
        
        function menu(){
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
            <main>
            <div style="text-align:center">
                <br>
                <input type="range" id="temperature" name="temperature" min="15" max="25" step="0.5"><br>
                <output></output>

                <script>
                    
                </script>
                <label for="temperature">Temperature</label><br>
            </div>
            </main>
            ';
        }
    }
?>