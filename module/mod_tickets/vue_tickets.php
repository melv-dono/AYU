<?php
    class Vue_tickets {
        
        function validation() {
            echo '
            <div>
                <p>Votre ticket a bien été envoyé !</p>
                <a href="http://localhost/~melvyn/AYU/module/mod_tickets/controleur_tickets.php" ><button type="button">Quitter</button></a>
            </div>';
        }

        function erreurEnvoie() {
            echo '
            <div>
                <p>Votre ticket n\'a pas pu être envoyé !</p>
                <a href="http://localhost/~melvyn/AYU/module/mod_tickets/controleur_tickets.php" ><button type="button">Quitter</button></a>
            </div>
            ';
        }

        function menu($Salle){
            // echo '
            // <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            // <link rel="stylesheet" href="tickets.css">
            // <main>
            //     <div class="obj">
            //         <label for="objet">Objet</label><br>
            //         <input type="text" id="objet" name="objet" required maxlength="49" size="10"><br>
            //     </div>

            //     <div class="req">
            //         <label for="requete">Message</label><br>
            //         <textarea id="requete" name="requete" rows="5" cols="33"></textarea><br>
            //     </div>

            //     <div class="submit">
            //         <input type="submit"><br>
            //     </div>
            // </main>
            // ';
            echo '
                <link rel="stylesheet" href="tickets.css">
                <main>
                    <!-- formulaire ticket -->
                    <form id="Ticket" class="ticket" style= "display :none;" action="/~melvyn/AYU/module/mod_tickets/controleur_tickets.php?action=envoie" method="post">

                        <label for="objet">Objet</label><br>
                        <input type="text" id="objet" name="objet" required maxlength="49" size="10"><br>

                        <select id="ticketSalle" class="item_num" name="ticketSalle">';

                            for ($i =0; $i<count($Salle); $i++) {
                                echo '<option value=' . $Salle[$i]['numerosalle'] . '>' . $Salle[$i]['numerosalle'] .'</option>';
                            }

            echo '            
                        </select>
            
                        <label for="contenu">Message</label><br>
                        <textarea placeholder="Quel est le problème ?" style="width: 280;" class="requete" rows="5" cols="40" name="contenu"></textarea>
                        <button type="submit" class="item_num">Envoyer</button>
                    </form>

                    <button class="bot_button" onclick="myFunction()">
                            <img class="bot" src="../../resources/img/fav.png" alt="helper">
                    </button>

                    <script src="../../resources/scripts/jquery-3.6.0.min.js"></script>
                    <script src="tickets.js"></script>
                <main>
            ';
        }

    //     function menuAvecEquipement($Salle, $Equipement){
    //         echo '
    //             <link rel="stylesheet" href="tickets.css">
    //             <main>
    //                 <!-- formulaire ticket -->
    //                 <form id="Ticket" class="ticket">

    //                     <label for="objet">Objet</label><br>
    //                     <input type="text" id="objet" name="objet" required maxlength="49" size="10"><br>

    //                     <select id="ticketSalle" class="item_num" name="ticketSalle">';

    //                         for ($i =0; $i<count($Salle); $i++) {
    //                             echo '<option value=' . $Salle[$i]['numerosalle'] . '>' . $Salle[$i]['numerosalle'] .'</option>';
    //                         }

    //         echo '            
    //                     </select>

    //                     <select id="ticketEquipement" class="item_num" name="Numéro materiel">';
                        
    //                     for ($i =0; $i<count($Equipement); $i++) {
    //                         echo '<option value=' . $Equipement[$i]['nom'] . '>' . $Equipement[$i]['nom'] .'</option>';
    //                     }

    //         echo '      </select>
            
    //                     <label for="contenu">Message</label><br>
    //                     <textarea placeholder="Quel est le problème ?" style="width: 280;" class="requete" rows="5" cols="40" name="contenu"></textarea>
    //                     <button type="submit" class="item_num">Envoyer</button>
    //                 </form>

    //                 <button class="bot_button" onclick="myFunction()">
    //                         <img class="bot" src="../../resources/img/fav.png" alt="helper">
    //                 </button>

    //                 <script src="../../resources/scripts/jquery-3.6.0.min.js"></script>
    //                 <script src="tickets.js"></script>
    //             <main>
    //         ';
    //     }
    }
?>