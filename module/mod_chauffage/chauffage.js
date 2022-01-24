$('#temperature').on('mouseup', function(e) {
    console.log("ici");
    var url = 'http://localhost/public_html/AYU/index.php?module=chauffage&action=temperature';
    $.ajax(url, {
        success : function() {
            console.log("ok");
        }
    });
});