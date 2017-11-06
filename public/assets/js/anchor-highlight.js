$( function() {
 //s$( document ).tooltip();
    $(' a.details[href^="#"]').bind('click.smoothscroll',function (e) {
        e.preventDefault();

        var target = this.hash,
        $target = $(target);

        console.log($target);


        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 60
        }, 500, 'swing', function () {
          //$target.toggle( "puff");

          $target.css("background-color", "lightyellow");
          setTimeout(function(){$target.css("background-color", "white")}, 2000);
        });
    });
});
