/**
 * 
 * File: active-menu.js
 * 
 * It manages the underline for the main nav based on current
 * active link.
 * 
 * 
 */

(function($){

    // Adds selected css to the home link
    $('#menu-item-8').addClass('selected');

    // Sets selected menu
    const setSelected = (id) => {
        $('#primary-menu li').each(function(index){
            $(this).removeClass('selected');
            $(this).css('color', 'white');
        });

        $("#" + id).addClass('selected');
    }

    // On menu click it strips all links and adds selected css to clicked link
    $('#primary-menu').click(function(event){
    
        const clicked  = event.target.parentNode.id;

        //setSelected(clicked);
        
        // $('#primary-menu li').each(function(index){
        //     $(this).removeClass('selected');
        //     $(this).css('color', 'white');
        // });

        // $("#" + clicked).addClass('selected');
        
    });

    // Gets elements y coords to change active menu based on page position
    const services = $('#services').offset().top;
    const projects = $('#projects').offset().top;
    const about = $('#about-parallax').offset().top;
    const contact = $('#contact').offset().top;
    

    $(window).on('scroll', function(){

      

        if($(window).scrollTop() < services - 200){
            $('#primary-menu li').each(function (index, element) {
                if(index === 0){
                    setSelected(element.id);
                }
            });

            
        }

        if($(window).scrollTop() < projects - 200 && $(window).scrollTop() > services - 200){
            $('#primary-menu li').each(function (index, element){
                if(index === 1){
                    setSelected(element.id);
                }
            });
                
        }

        if($(window).scrollTop() < about - 200 && $(window).scrollTop() > projects - 200){
            $('#primary-menu li').each(function (index, element){
                if(index === 2){
                    setSelected(element.id);
                }
            });
        }

        if($(window).scrollTop() < contact - 200 && $(window).scrollTop() > about - 200){
            $('#primary-menu li').each(function (index, element){
                if(index === 3){
                    setSelected(element.id);
                }
            });
        }

        if($(window).scrollTop() > about + 250){
            $('#primary-menu li').each(function (index, element){
                
                if(index === 4){
                    setSelected(element.id);
                    
                }
            });
        }

        
    });



})(jQuery);