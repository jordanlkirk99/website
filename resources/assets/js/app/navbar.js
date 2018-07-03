$(window).on('scroll', function() {
    $('#menu-wrapper').toggleClass('slim', $(document).scrollTop() > $('#menu-wrapper').height());
});