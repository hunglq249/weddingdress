$(document).ready(function(){
    
    // Expand Nav
    
    var navStatus = 0;
    
    $('#btn-nav-expand').click(function(){
        if(navStatus == 0){
            $('header .nav-item.nav-main ul').addClass('active');
            $('#btn-nav-expand').addClass('active');
            navStatus = 1;
        }
        
        else{
            $('header .nav-item.nav-main ul').removeClass('active');
            $('#btn-nav-expand').removeClass('active');
            navStatus = 0;
        }
    });
    
    // Active Header on Scroll
    
    $(window).scroll(function () {
        //if you hard code, then use console
        //.log to determine when you want the
        //nav bar to stick.
        'use strict';
        if ($(window).scrollTop() > 0) {
            $('header').addClass('active');
        }
        if ($(window).scrollTop() === 0) {
            $('header').removeClass('active');
        }
    });
    
});