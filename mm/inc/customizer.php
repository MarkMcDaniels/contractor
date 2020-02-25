<?php
/**
 * MM Theme Customizer
 *
 * @package MM
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mm_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	# Adding all the custom options for the theme. Colors, Parallax images, and content.
	$wp_customize->add_panel(
		'mm_theme_panel', array(
			'priority' => 100,
			'theme_supports' => '',
			'title' => __("MM Customize Panel", 'MM'),
			'description' => __("Allows you to make changes across the MM theme.")
		)
	);

	$wp_customize->add_section(
		'mm_custom_theme_changes', array(
			'title' => __('Theme options', 'MM'),
			'panel' => 'mm_theme_panel',
			'priority' => 10
		)
	);


	# Setting and controls for MM Theme.

	# Main nav background color.
	$wp_customize->add_setting(
		'header_background_color', array(
			'default' => __('#8797a7', 'MM'),
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label' => __("Header background color"),
				'section' => 'mm_custom_theme_changes',
				'settings' => 'header_background_color',
				'priority' => 10,
			)
		)
	);


	# Active link color.
	$wp_customize->add_setting(
		'active_link_color', array(
			'default' => __('#f4511e', 'MM'),
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'active_link_color',
			array(
				'label' => __('Active link color'),
				'section' => 'mm_custom_theme_changes',
				'settings' => 'active_link_color',
				'priority' => 11
			)
		)
	);

	# Hero Image
	$wp_customize->add_setting(
		'hero_image_setting', array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hero_image_setting',
			array(
				'label' => __('Hero Image'),
				'section' => 'mm_custom_theme_changes',
				'settings'=> 'hero_image_setting',
				'priority' => 12
			)
		)
	);
	
	# Pitch container background
	$wp_customize->add_setting(
		'pitch_background_color', array(
			'default' => '#d2b48c',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pitch_background_color',
			array(
				'label' => __('Pitch container background color'),
				'section' => 'mm_custom_theme_changes',
				'settings' => 'pitch_background_color',
				'priority' => 13
			)
		)
	);

	# Pitch text
	$wp_customize->add_setting(
		'pitch_text_setting', array(
			'default' => __('Dedicated to creating professional code, on time, and at a reasonble price. I use a pragmatic approach on projects, and the end result is your satisfaction.'),
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'pitch_text_setting', array(
			'label' => __('Pitch Animated Text', 'MM'),
			'type' => 'textarea',
			'section' => 'mm_custom_theme_changes',
			'priority' => 14
		)
	);

	# Services list
	$wp_customize->add_setting(
		'services_list_setting', array(
			'default' => 'ITEM(React),&#13;&#10;ITEM(Wordpress),&#13;&#10;ITEM(HTML5),&#13;&#10;ITEM(Responsive Design),&#13;&#10;ITEM(CSS),&#13;&#10;ITEM(PHP),&#13;&#10;ITEM(Python)&#13;&#10;ITEM(JQuery),&#13;&#10;ITEM(Javascript),&#13;&#10;ITEM(SQL),&#13;&#10;ITEM(SEO),&#13;&#10;',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'services_list_setting', array(
			'label' => __('Services list: To add an Item type "ITEM(your item)" or replace the text inside of the parenthesis. MAX TWELVE ITEMS.'),
			'type' => 'textarea',
			'section' => 'mm_custom_theme_changes',
			'priority' => 15
		)
	);

	// About Parallax image
	$wp_customize->add_setting(
		'about_par_setting', array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'about_par_setting',
			array(
				'label' => __('About parallax image'),
				'section' => 'mm_custom_theme_changes',
				'settings'=> 'about_par_setting',
				'priority' => 16
			)
		)
	);

	# About description
	$wp_customize->add_setting(
		'about_desc_setting', array(
			'default' => "For someone that loves to build things, and isn't mechanically inclined, software is a great outlet. I like to take abstract ideas and turn them into something real.",
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'about_desc_setting', array(
			'label' => __('About section description'),
			'type' => 'textarea',
			'section' => 'mm_custom_theme_changes',
			'priority' => 17
		)
	);

	// About Image
	$wp_customize->add_setting(
		'about_image_setting', array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'about_image_setting',
			array(
				'label' => __('About image'),
				'section' => 'mm_custom_theme_changes',
				'settings' => 'about_image_setting',
				'priority' => 18
			)
		)
	);


	// Footer color
	$wp_customize->add_setting(
		'footer_background_color', array(
			'default' => '#f4511e',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'label' => __('Footer Background Color'),
				'section' => 'mm_custom_theme_changes',
				'settings' => 'footer_background_color',
				'priority' => 19
			)
		)
	);

	// Linkedin footer link
	$wp_customize->add_setting(
		'linkedin_footer', array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'linkedin_footer', array(
			'label' => __("LinkedIn profile url"),
			'type' => 'url',
			'section' => 'mm_custom_theme_changes',
			'priority' => 20
		)
	);

	// Github footer link
	$wp_customize->add_setting(
		'github_footer', array(
			'default' => '',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'github_footer', array(
			'label' => __("Github profile url"),
			'type' => 'url',
			'section' => 'mm_custom_theme_changes',
			'priority' => 20
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'mm_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'mm_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'mm_customize_register' );



/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function mm_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function mm_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mm_customize_preview_js() {
	wp_enqueue_script( 'mm-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20201215', true );
}
add_action( 'customize_preview_init', 'mm_customize_preview_js' );



/**
 * Front-end customizer updates.
 */

function update_frontend_change() {

	?>
		<style type="text/css">
			.site-header {
				background-color: <?php echo get_theme_mod('header_background_color', '#8797a7'); ?>;
			}

			.selected {
				color: <?php 
						# Sets color for bottom border of active link
						$borderColor = get_theme_mod('active_link_color', '#dd9933' );
						echo get_theme_mod('active_link_color', '#dd9933'); 
					?>;
				border-bottom-color: <?php echo $borderColor; ?>;			
			}

			.selected a {
				color: <?php echo $borderColor ?>;
			}

			#hero {
				background-image: url(<?php echo get_theme_mod('hero_image_setting', ""); ?>);
			}

			#pitch-container {
				background-color: <?php echo get_theme_mod('pitch_background_color', '#d2b48c'); ?>;
			}


		</style>
		

	<?php

}

add_action('wp_head', 'update_frontend_change');