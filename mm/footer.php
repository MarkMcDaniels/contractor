<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MM
 */

?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div id="close">
				
				<h2 class="footer-h2">Find me @:</h2>
				<ul id="close-ul">
					<li><a href="<?php 
						if(!get_theme_mod('linkedin_footer')){
							echo 'https://www.linkedin.com/in/mark-mcdaniels-68b39789/';
						} else {
							echo get_theme_mod('linkedin_footer');
						}
					?>"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="<?php 
						if(!get_theme_mod('github_footer')){
							echo "https://github.com/MarkMcDaniels?tab=repositories";
						} else {
							echo get_theme_mod('github_footer');
						}
					?>"><i class="fa fa-github"></i></a></li>
				</ul>
				
			</div>
			<div>
				<h6 class="creator">Contractor Theme created Mark McDaniels</h6>
				
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
