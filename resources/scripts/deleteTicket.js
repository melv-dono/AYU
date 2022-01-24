$('#deleteTicket').on('click', function(e) {
    const row = document.getElementById('deleteTicket').parentNode();
    const id = row.childre[0].value();
    url = "index.php?module=ticket&=action=suppTicket"
    $.ajax(url, {
        success : function() {
            console.log("ok");
            window.location.href=url;
        },
        error : function(jqxhr) {
            console.log("notok");
            alert(jqxhr.responseText);
        }
    });
});