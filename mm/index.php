<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MM
 */

get_header();
?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			
			<div id="hero" style="background-image: url(' <?php
			// Sets original url hero image if a user hasn't set one
			if(!get_theme_mod('hero_image_setting', '')){
				echo get_stylesheet_directory_uri(  ) . '/images/brass-gears-jay-heike.jpg'; 
			} else {
				echo get_theme_mod('hero_image_setting', '');
			}
			?>');" >
				<div id="pitch-container"> 
					<p id="pitch">
					<?php echo get_theme_mod('pitch_text_setting', 'Dedicated to creating professional code on time, and at a reasonble price. I use a pragmatic approach to projects where the end result is your satisfaction.'); ?></p>
				</div>
				
			</div>
			<div id="services">
				<h2>SERVICES</h2>
				<div id="services-container">


				<?php 
					// The Services posts
					$query_services = array(
						'category_name' => 'services',
						'posts_per_page' => -1
					);

					$query_for_services = new WP_Query($query_services);	
				?>

				<?php if($query_for_services->have_posts()) : ?>
					
					<?php while($query_for_services->have_posts()): $query_for_services->the_post(); ?>
						
						<article class="services-article">
							<div class='services-img'>
								<?php the_post_thumbnail('thumbnail'); ?>
							</div>
						
						
							<?php the_content(); ?>
							
						</article>
					<?php endwhile; ?>
				<?php endif; ?>
					
				</div><!-- services-container -->
				
			</div><!-- #services -->
			<div id="projects">
				<h2>PROJECTS</h2>
			
				<div id="projects-container">
					<?php

						// Projects posts.
						$query_projects = array(
							'category_name' => 'projects',
							'posts_per_page' => -1,
							'order' => 'ASC'
						);

						$query_for_projects = new WP_Query($query_projects);
					?>

					<?php if($query_for_projects->have_posts()): ?>
						<?php while($query_for_projects->have_posts()) : $query_for_projects->the_post(); ?>
							
							<article class="card">
								<a href ="/">
									<div class="img-container" style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium'); ?>');">

										
									</div>
								</a>
								<div class="project-details">
									
									<?php
										
										if(get_the_title( ) == "Contractors Theme"){
											echo "<div><h4>" . get_the_title() . "</h4></div>";
											echo "<div class='projects-link-container'><a class='project-links' href=" . get_post_meta(get_the_ID(), 'contractors_external_meta_key', true) . "><i style='color:#515d68;font-size:20px;' class='fa fa-link'></i></a></div>";

										} else if(get_the_title() == "React profile site"){
											
											echo "<div><h4>" . get_the_title() . "</h4></div>";
											echo "<div class='projects-link-container'><a class='project-links' href=" . get_post_meta(get_the_ID(), '_external_link_meta_key', true) . "><i style='color:#515d68;font-size:20px;' class='fa fa-link'></i></a><a href=". get_post_meta(get_the_ID(), '_github_meta_key', true) .  "><i class='fa fa-github' style='color:#515d68;font-size:20px;'></i></a></div>";
										} else if(get_the_title() == 'Hushed responsive site'){
											echo "<div><h4>" . get_the_title() . "</h4></div>";
											echo "<div class='projects-link-container'><a class='project-links' href=" . get_post_meta(get_the_ID(), '_hushedS_external_meta_key', true) . "><i style='color:#515d68;font-size:20px;' class='fa fa-link'></i></a><a href=". get_post_meta(get_the_ID(), '_hushedS_page_meta_key', true) .  "><i class='fa fa-link' style='color:#515d68;font-size:20px;'></i></a></div>";
										} else if(get_the_title() == "Hushed App"){
											echo "<div><h4>" . get_the_title() . "</h4></div>";
											echo "<div class='projects-link-container'><a class='project-links' href=" . get_post_meta(get_the_ID(), '_hushedA_external_meta_key', true) . "><i style='color:#515d68;font-size:20px;' class='fa fa-link'></i></a><a href=". get_post_meta(get_the_ID(), '_hushedA_page_meta_key', true) .  "><i class='fa fa-link' style='color:#515d68;font-size:20px;'></i></a></div>";
										} else {

											// For user created project cards. It gets the meta information and then builds output links.
											$pageName = get_post_meta(get_the_ID(), '_page_name_meta_key',true);
											$externalLink = get_post_meta(get_the_ID(), '_external_link_meta_key', true);
											$githubLink = get_post_meta(get_the_ID(), '_github_meta_key', true);

											if(get_post_meta(get_the_ID(), '_page_name_meta_key',true)){
												$pageI = "<a href=" . $pageName . "><i class='fa fa-link' style='color:#515d68;font-size:20px;'></i></a>";
											}

											if(get_post_meta(get_the_ID(), '_external_link_meta_key', true)){
												$externalI = "<a href=" . $externalLink . "><i class='fa fa-link' style='color:#515d68;font-size:20px;'></i></a>";
											}

											if(get_post_meta(get_the_ID(), '_github_meta_key', true)){
												$githubI = "<a href=" . $githubLink . "><i class='fa fa-github' style='color:#515d68;font-size:20px;'></i></a>";
											}

											echo "<div><h4>" . get_the_title() . "</h4></div>";
											echo "<div class='projects-link-container'>" . $pageI . $externalI . $githubI . "</div>";
											
										}
									?>

									
								
								</div>
							</article>
						
						<?php endwhile; ?>
					<?php endif; ?>
				
				</div><!-- projects-container -->
			</div><!-- #projects -->
			<div id="about-parallax" style="background-image: url('<?php
				// Sets original about me parallax image or get's updated version
				if(!get_theme_mod('about_par_setting')){
					echo get_template_directory_uri(  ) . "/images/dots-triangles.jpg";
				} else {
					echo get_theme_mod('about_par_setting', "");
				}
			?>');">

				<div id='about-description-container'>
					<p id="about-description">
						<?php echo get_theme_mod('about_desc_setting', "For someone that loves to build things, and isn't mechanically inclined, software is a great outlet. I like to take abstract ideas and turn them into something real."); 
						?>
					</p>
					
				</div>
				<div id="about-portrait" style="background-image: url(' <?php 
						if(!get_theme_mod('about_image_setting')){
							echo get_template_directory_uri(  ) . '/images/mark_profile.png';
						} else {
							echo get_theme_mod('about_image_setting', '');
						}
					?>');">
					</div>
			
			</div><!-- #about-parallax -->
			
			<div id="contact">
				<h2>CONTACT ME</h2>
				<div id="form-container">
					<form action="<?php echo admin_url('admin-post');?>" method="post" name="contact_form" id="contact_form">
						<label for="contact_name" id="contact-name-label">Name:</label>
						<input type='text' name="contact_name" id="contact_name"  />
						<label for="email_input" id="email-input-label">Email:</label>
						<input type="email" name="email_input" id="email_input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
						<label for="feedback" id="feedback-label">Message:</label>
						<textarea name="feedback" id="feedback"></textarea>
						<input type="submit" id="submit-button" value="Send" style="float:right;color:white;width:60px;background-color:#515d68;cursor:default;opacity:0.5" disabled />
						<input type="hidden" name="action" value="contact_form" />
						<?php wp_nonce_field( 'contact_form_nonce', 'contact_form_nonce');  ?>
					</form>
				</div>
				
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
