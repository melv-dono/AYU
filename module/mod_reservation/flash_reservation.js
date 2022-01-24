// Supprime le créneaux de la vue et appelle la méthode de réservation
$('.flash').on('click', function(e) {
    e.preventDefault();
    var $a = $(this);
    var url = $a.attr('href');
    $.ajax(url, {
        success : function() {
            console.log("ok");
            $a.fadeOut();
        },
        error : function(jqxhr) { //Peut-être à supprimer
            console.log("notok");
            alert(jqxhr.responseText);
        }
    });
});

// Bloque les dates le dimanche ou une date null
$('#dateCourante').on('input change', function(e) {
    var jour = new Date($(this).val());
    if ($(this).val()== "") {
        $('#Sub').prop('disabled', true);
        alert("Choisir une date");
    }
    else{
        const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        let day = weekday[jour.getDay()];
        $('#Sub').prop('disabled', false);

        if (day == "Sunday") {
            $('#Sub').prop('disabled', true);
            alert("C'est le jour du seigneur !");
        }
        else
            $('#Sub').prop('disabled', false);
    }
});
