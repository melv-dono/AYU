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
            echo '
                <body>
                    <main>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

                        <form id="Ticket" action="/~melvyn/AYU/module/mod_tickets/controleur_tickets.php?action=envoie" method="post">
                        <div class="container-fluid">
                            <div class="col-sm-3">
                                <label for="objet" class="form-label">Objet</label><br>
                                <input type="text" id="objet" class="form-control" name="objet" required maxlength="49" size="10"><br>
                            </div>

                            <div class="col-sm-3">
                            <select id="ticketSalle" class="form-select" aria-label="Default select example" name="ticketSalle">';

                                for ($i =0; $i<count($Salle); $i++) {
                                    echo '<option value=' . $Salle[$i]['numerosalle'] . '>' . $Salle[$i]['numerosalle'] .'</option>';
                                }

                echo '            
                            </select>
                            </div>


                            <div class="row justify-content-md-center">
                                <div class="col">
                                    <label for="contenu" class="form-label">Message</label><br>
                                    <textarea placeholder="Quel est le problème ?" style="width: 280;" class="form-control" aria-label="With textarea" rows="5" cols="40" name="contenu"></textarea>
                                </div>
                            </div>

                            
                            <div class="col">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>

                        </div>
                        </form>
                    </main>
                </body>
            ';
        }
    }
?>