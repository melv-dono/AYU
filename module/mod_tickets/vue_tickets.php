<?php
    class Vue_tickets {

        function validation() {
            require_once(FUNCTIONS);
            $function = new Functions();
            $function->showNav('tickets');
            echo '
            <main class="app">
            <div>
                <p>Votre ticket a bien été envoyé !</p>
                <a href="index.php?module=tickets" ><button type="button">Quitter</button></a>
            </div>
            <link href="' . DIR_NAME . 'tickets.css" rel="stylesheet">
            <main>
            ';
        }

        function erreurEnvoie() {
            require_once(FUNCTIONS);
            $function = new Functions();
            $function->showNav('tickets');
            echo '
            <main class="app">
            <div>
                <p>Votre ticket n\'a pas pu être envoyé !</p>
                <a href="index.php?module=tickets" ><button type="button">Quitter</button></a>
            </div>
            <main>
            <link href="' . DIR_NAME . 'tickets.css" rel="stylesheet">
            ';
        }

        function menu($Salle){
            require_once(FUNCTIONS);
            $function = new Functions();
            $function->showNav('tickets');

            echo '
                    <main class="app">
                        <link href="' . DIR_NAME . 'tickets.css" rel="stylesheet">

                        <form id="Ticket" action="index.php?module=tickets&action=envoie" method="post">
                        <div class="container-fluid">
                        <div class="row justify-content-md-center">

                            <div class="col-md-6">
                                <label for="objet" class="form-label">Objet</label><br>
                                <input type="text" id="objet" class="form-control" name="objet" required maxlength="49" size="10"><br>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                            <select id="ticketSalle" class="form-select" aria-label="Default select example" name="ticketSalle">';

                                for ($i =0; $i<count($Salle); $i++) {
                                    echo '<option value=' . $Salle[$i]['numerosalle'] . '>' . $Salle[$i]['numerosalle'] .'</option>';
                                }

                echo '
                            </select>
                            </div>
                        </div>



                            <div class="row justify-content-md-center">
                                <div class="col">
                                    <label for="contenu" class="form-label">Message</label><br>
                                    <textarea placeholder="Quel est le problème ?" style="width: 500px;" class="form-control" aria-label="With textarea" rows="5" cols="40" name="contenu"></textarea>
                                </div>
                            </div>


                            <div class="col">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>

                        </div>
                        </form>
                    </main>
            ';
        }
    }
?>
