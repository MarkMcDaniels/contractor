
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
            if(isset($_POST['contact_name']) && isset($_POST['email_input']) && isset($_POST['message'])){
                
                
                // Sends email
                $name = sanitize_text_field( $_POST['contact_name'] );
                $email = sanitize_email( $_POST['email_input'] );
                $message = esc_textarea( $_POST['message'] );
                $admin_email = get_option('admin_email');

                if(wp_mail($admin_email, 'Feedback from MM', $message, 'From: ' . $name . "<" . $email . ">")){
                    echo "<h1 class='thank-you'>Thank you for your feedback. The email was sent.</h1>"; 
                } else {
                    echo "<h1 class='thank-you'>An ERROR has occurred!</h1>";
                }

            } else {

                // An empty field regenerates form with required declaration.
                $nameReq = '';
                $emailReq = "";
                $messageReq = '';

                if(!isset($_POST['contact_name'])){
                    $nameReq = '<b style="color:red"> * name is required!</b>';
                }

                if(!isset($_POST['email_input'])){
                    $emailReq = '<b style="color:red"> * email is required!</b>';
                }

                if(!isset($_POST['message'])){
                    $messageReq = '<b style="color:red"> * a message is required!</b>';
                }

                echo '<h1 class="contact-us">Contact Me</h1><div id="contact-page-container"><form class="contact-form-req" action=' . get_template_directory_uri(  ) . '/contact.php' . '" type="post">
                        <label for="contact_name">Name:' . $nameReq . '</label>
                        <input type="text" name="contact_name" value="' . $_POST['contact_name'] . '"/>
                        <label for="email_input">Email:'. $emailReq . '</label>
                        <input type="email" name="email_input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="' . $_POST['email_input'] . '"/>
                        <label for="message">Message:' . $messageReq . '</label>
                        <textarea value="' . $_POST['message'] . '"></textarea>
                        <input id="send-button" type="submit" name="message" value="Send" />
                    </form></div>';
            }


            

		?>
            </main><!-- #main -->
            
        </div><!-- #primary -->
            
    </div><!-- end of content -->

    </div><!-- end of page -->
    <footer class="contact-footer"></footer>
</body>
</html>




