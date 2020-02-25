<?php
/**
 * MM Theme Contact Form validator
 *
 * @package MM
 */


 function contact_form_scripts(){
    // Contact validator script and stylesheet
    wp_enqueue_script( 'contact-validator', get_stylesheet_directory_uri(  ) . '/js/contact-validator.js', array('jquery'), '20200120', true );
    wp_enqueue_style( 'contact-styles', get_stylesheet_directory_uri() . '/contact-validator.css', array(), rand(111,9999), 'all' );
 }
 add_action('wp_enqueue_scripts', 'contact_form_scripts');