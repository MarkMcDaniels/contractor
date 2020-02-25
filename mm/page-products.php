<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MM
 */
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div id="contractor">
				<h2>The Contractor's Wordpress Theme</h2>
				<div id="contractor-container">
					<div id="contractor-img" style="background-image: url('<?php echo get_stylesheet_directory_uri() . '/images/customizer300.png';?>');">
					</div>
					<ul>
						<li>Live previewing</li>
						<li>12 custom options</li>
						<li>Full control of colors and branding</li>
						<li>Responsive Design</li>
						<li>Smart Dynamic Navigation</li>
						<li>2 parallaxing sections</li>
						<li>Custom Contact Form with validation</li>
						<li>User instructions</li>
					</ul>
				</div>
			</div>
		</main><!-- #main -->

	</div><!-- #primary -->
	
        
<?php

get_footer();