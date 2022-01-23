$('#luminosite').on('mouseup', function(e) {
    console.log("ici");
    var url = 'http://localhost/public_html/AYU/index.php?module=lampe&action=luminosite';
    $.ajax(url, {
        success : function() {
            console.log("ok");
        }
    });
});