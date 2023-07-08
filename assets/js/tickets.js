
$(document).ready(function(){
    $(".selection-1").click(function(){
        $(".first-selection").not('.selected-ticket').hide(500); 
        $(".selected-ticket").css('display', 'flex').hide().fadeIn(1000); 
    });
    
    $(".back-button").click(function(){
        $(".first-selection").fadeIn(1000);
        $(".selected-ticket").fadeOut(1000);
    });
});

$(document).ready(function(){
    $(".selection-2").click(function(){
        $(".second-selection").not('.selected-ticket-2').hide(500); 
        $(".selected-ticket-2").css('display', 'flex').hide().fadeIn(1000);
    });

    $(".back-button").click(function(){
        $(".second-selection").fadeIn(1000); 
        $(".selected-ticket-2").fadeOut(1000);
    });
});