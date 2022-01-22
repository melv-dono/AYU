<?php
    class Vue_tickets {
        
        function menu(){
            echo '
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="tickets.css">
            <main>
                <div class="obj">
                    <label for="objet">Objet</label><br>
                    <input type="text" id="objet" name="objet" required maxlength="49" size="10"><br>
                </div>

                <div class="req">
                    <label for="requete">Message</label><br>
                    <textarea id="requete" name="requete" rows="5" cols="33"></textarea><br>
                </div>

                <div class="submit">
                    <input type="submit"><br>
                </div>
            </main>
            ';
        }
    }
?>