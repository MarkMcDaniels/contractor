/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Nav Header color
	wp.customize('header_background_color', function (value){
		value.bind(function(newVal){
			$('.site-header').css('background-color', newVal);
		});
	
	});

	// Active link color
	wp.customize('active_link_color', (value) => {


		$('#menu-item-8').addClass('selected');		

		value.bind((newVal) => {
			$('.selected').css({
				'color': newVal,
				'border-bottom-color': newVal
			});
			
			$(".selected a").css("color", newVal);

		});

		// Removes selected, and then adds it to the home button
		$('#primary-menu ul li').each(function(index){
			$(this).removeClass('selected');
			$(this + " a").css('color', 'white');
		});
	});

	// Hero image set
	wp.customize('hero_image_setting', function(value){
		value.bind(function(newVal){
			$('#hero').css('background-image', 'url('+ newVal + ')');
		});
	});

	// Pitch container background color
	wp.customize('pitch_background_color', function(value){
		value.bind(function(newVal){
			$('#pitch-container').css('background-color', newVal);
		});
	});

	// Pitch Animated text
	wp.customize('pitch_text_setting', function(value){
		
		value.bind(function(newVal){
		
			$('#pitch').html(newVal);
		});
	});

	// Services list
	wp.customize('services_list_setting', function(value){
		value.bind(function(newVal){
			
		});
	});

	// About parallax image set
	wp.customize('about_par_setting', function(value){
		value.bind(function(newVal){
			$('#about-parallax').css('background-image', 'url(' + newVal + ')');
		});
	});

	// About description
	wp.customize('about_desc_setting', function(value){
		value.bind(function(newVal){
			$('#about-description').html(newVal);
		});
	});

	// About portrait
	wp.customize('about_image_setting', function(value){
		value.bind(function(newVal){
			
		});
	});

	// Footer background color
	wp.customize('footer_background_color', function (value){
		value.bind(function(newVal){
			$('.site-footer').css('background-color', newVal);
		});
	
	});
} )( jQuery );