function myFunction() {
    if (document.getElementById('Ticket').style.display=='none') {
        document.getElementById('Ticket').style.display='block';
    }
    else {
        document.getElementById('Ticket').style.display='none';
    }
}

// $('#ticketSalle').on('input change', function(e) {
//     var $a = $(this);
//     var url = "/~melvyn/AYU/module/mod_tickets/controleur_tickets.php?action=equipements";
//     $.ajax(url, {
//         data : $('#ticketSalle').serialize(),
//         success : function() {
//             console.log("ok");
//             if (document.getElementById('ticketEquipement').style.display =='none')
//                 document.getElementById('ticketEquipement').style.display='block';
//         },
//         error : function(jqxhr) {
//             console.log("notok");
//             document.getElementById('ticketEquipement').style.display='none';
//         }
//     });
// });