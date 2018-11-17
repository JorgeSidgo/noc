$(function() {

    setTimeout(function() {
        $(".cuadro").css('transform', 'translateY(0)');
    }, 50);

    setTimeout(function() {
        $(".cuadro").css('filter', 'opacity(100%)');
        $("body").css('overflow', 'show');
        
    }, 50);

    setTimeout(function() {
        $("#dashboard-card").css('transform', 'translateY(0)');
    }, 50);

    setTimeout(function() {
        $("#dashboard-card").css('filter', 'opacity(100%)');
        $("body").css('overflow', 'show');
        
    }, 50);

});