$('#temperature').on('mouseup', function(e) {
    console.log("ici");
    const valeur = document.getElementById('temperature').value;
    var url = `index.php?module=chauffage&action=temperature&temperature=${valeur}`;
    $.ajax(url, {
        success : function() {
            console.log("ok");
        }
    });
});
