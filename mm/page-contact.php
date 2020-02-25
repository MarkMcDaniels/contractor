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
		<?php
			// Sanitizes and emails contact form unless input is empty. Delivers a new form.
			
			// Success, all fields filled in.
			if(isset($_GET['contact_name']) && isset($_GET['email_input']) && $_GET['feedback'] != ''){
		
		
				// Sends email
				$name = sanitize_text_field( $_GET['contact_name'] );
				$email = sanitize_email( $_GET['email_input'] );
				$feedback = esc_textarea( $_GET['feedback'] );
				$admin_email = get_option('admin_email');

				if(wp_mail($admin_email, 'Feedback from MM', $feedback, 'From: ' . $name . "<" . $email . ">")){
					echo "<h1 class='thank-you'>Thank you for your feedback. The email was sent.</h1>"; 
				} else {
					echo "<h1 class='thank-you'>An ERROR has occurred!</h1>";
				}

			} 
			
		?>
</main><!-- #main -->

</div><!-- #primary -->
	
        
<?php

get_footer('contact');