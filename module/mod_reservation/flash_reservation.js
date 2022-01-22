(function($){
    $('.flash').on('click', function(e) {
        e.preventDefault();
        var $a = $(this);
        var url = $a.attr('href');
        $.ajax(url, {
            success : function() {
                console.log("ok");
                $a.fadeOut();
            },
            error : function(jqxhr) {
                console.log("notok");
                alert(jqxhr.responseText);
            }
        });
    });
})(jQuery);