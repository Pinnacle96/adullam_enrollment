$(document).ready(function(){
    //Hero Slider
    $('#hero-slider').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        items:1,
        dots:false,
        smartSpeed:1000,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        navText: ['PREV', 'NEXT'],
        responsive:{
            0:{
               nav:false, 
            },
            768:{
                nav:true,
            },
           
        }
    }),
     //Hero Slider
     $('#project-slider').owlCarousel({
        loop:true,
        margin:0,
        nav:false,
        dots:true,
        smartSpeed:1000,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        navText: ['PREV', 'NEXT'],
        margin:24,
        responsive:{
            0:{
               items:1,
               margin:0,
               nav:false,
            },
            768:{
                
            },
            1140:{
                items:2,
                center:true,
            },
           
        }
    }),
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        dots:true,
        items:1,
        smartSpeed:800,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        
    })
})