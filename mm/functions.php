<?php
/**
 * MM functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MM
 */

if ( ! function_exists( 'mm_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mm_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MM, use a find and replace
		 * to change 'mm' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mm', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'mm' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mm_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mm_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mm_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mm_content_width', 640 );
}
add_action( 'after_setup_theme', 'mm_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mm_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mm' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mm' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mm_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mm_scripts() {
	wp_enqueue_style( 'mm-style', get_stylesheet_uri());
	
	wp_enqueue_script( 'mm-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mm-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script('active-menu', get_template_directory_uri(  ) . '/js/active-menu.js', array('jquery'), '20200131', true);
	wp_enqueue_script('pitch-animation', get_template_directory_uri(  ) . '/js/pitch-animation.js', array('jquery'), '20191202', true);

	// font awesome.
	wp_enqueue_style( 'font-awesome-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

	// my main styles for mm.
	wp_enqueue_style( 'my-styles', get_stylesheet_directory_uri(  ) . '/my-styles.css',array(), rand(111,9999), 'all' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mm_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*
* Load Contact Form Validator
*/
require get_template_directory() . '/inc/contact-validator.php';

/**
 * Upload image changes.
 */
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

/**
 * Custom Taxonomy.
 */
function mm_create_custom_tax(){
	$services_args = array(
		'labels' => 'services',
		'hierarchical' => true
	);
	register_taxonomy( 'services', 'post', $services_args );

	$projects_args = array(
		'labels' => 'projects',
		'hierarchical' => true
	);
	register_taxonomy( 'projects', 'post', $projects_args );

}
add_action('init', 'mm_create_custom_tax');


/**
 * Initial Posts creation for: Projects, Services
 */
if(!function_exists('post_exists')){
	require_once( ABSPATH . 'wp-admin/includes/post.php');
}

if(!post_exists('My Test', 'This is a test description for creation','', '')){
	
	// Adds a post
	$user_id = get_current_user_id(  );

	$createdPost = array(
		'post_author' => $user_id,
		'post_title' => 'My Test',
		'post_content' => 'This is a test description for creation',
		'post_status' => 'draft',
		'post_type' => 'post'
	);

	$post_id = wp_insert_post( $createdPost);

	/**
	 * 	Adds images to media library for post
	 *  
	 * */ 

	$file = get_template_directory(  ) . '/images/mark_profile.png';
	$filename = basename($file);
	$upload_file = wp_upload_bits($filename, null, file_get_contents($file));
	if (!$upload_file['error']) {
		$wp_filetype = wp_check_filetype($filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_parent' => $post_id,
			'post_title' => 'Mark McDaniels profile pick',
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $post_id );
		if (!is_wp_error($attachment_id)) {
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
			wp_update_attachment_metadata( $attachment_id,  $attachment_data );
		}

		set_post_thumbnail( $post_id, $attachment_id );
	}

	
	

}

/**
 * Adds theme's starting posts and images. Checks if General Services as conditional for all starting posts creations for setup.
 */
if(!post_exists('General Services', "My building philosophy in technology is agnostic. We'll choose the best tools to accomplish your business needs. If you need a landing page, or a full fledged eCommerce site, I can create pixel perfect recreations of your designs. Responsive websites are the standard, and it's built into all my projects. Even if I'm fixing a small portion of your site, it will be responsive.", '', '')){

	// Gets user Id for to insert all posts for setup
	$user_id = get_current_user_id();

	$general_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'General Services',
		'post_content' => "My building philosophy in technology is agnostic. We'll choose the best tools to accomplish your business needs. If you need a landing page, or a full fledged eCommerce site, I can create pixel perfect recreations of your designs. Responsive websites are the standard, and it's built into all my projects. Even if I'm fixing a small portion of your site, it will be responsive.",
		'post_type' => 'post',
		'post_status' => 'publish'
	 );

	 // Creates general post
	 $general_post_id = wp_insert_post($general_post_args);

	 $file = get_template_directory(  ) . '/images/hammerGrey300.png';
	 $filename = basename($file);
	 $upload_file = wp_upload_bits($filename, null, file_get_contents($file));
	 if (!$upload_file['error']) {
		 $wp_filetype = wp_check_filetype($filename, null );
		 $attachment = array(
			 'post_mime_type' => $wp_filetype['type'],
			 'post_parent' => $general_post_id,
			 'post_title' => 'Hammer Icon',
			 'post_content' => '',
			 'post_status' => 'inherit'
		 );
		 $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $general_post_id );
		 if (!is_wp_error($attachment_id)) {
			 require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			 $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
			 wp_update_attachment_metadata( $attachment_id,  $attachment_data );
		 }
 
		 set_post_thumbnail( $general_post_id, $attachment_id );
	 }
	

	 // Services Category ID for attaching it to newly created post.
	 $services_cat_id = get_cat_ID( 'services' );

	 // Attaches services cat to general post.
	 wp_set_post_categories( $general_post_id, $services_cat_id );


	/**
	* React services post.
	*/

	$react_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'React Services',
		'post_content' => "Whether you need a component or a full Single Page Application(SPA), I can create it. I use modern Javascript techniques so your application is built for the future. If part of your site is broken, I can also troubleshoot your issues. Ultimately, we can create a user experience that businesses go to React.js to have.",
		'post_type' => 'post',
		'post_status' => 'publish'
	);

	$react_post_id = wp_insert_post($react_post_args);

	$react_file = get_template_directory() . '/images/iconfinder_React.png';

	$react_filename = basename($react_file);

	$react_upload_file = wp_upload_bits($react_filename, null, file_get_contents($react_file));
	if(!$react_upload_file['error']){
		$react_file_type = wp_check_filetype( $react_filename, null );
		$react_attachment = array(
			'post_mime_type' => $react_file_type['type'],
			'post_parent' => $react_post_id,
			'post_title' => 'React Logo',
			'post_content' => '',
			'post_status' => 'inherit'

		);
		$react_attachment_id = wp_insert_attachment( $react_attachment, $react_upload_file['file'], $react_post_id );
		if (!is_wp_error($react_attachment_id)) {
			
			$react_attachment_data = wp_generate_attachment_metadata( $react_attachment_id, $react_upload_file['file'] );
			wp_update_attachment_metadata( $react_attachment_id,  $react_attachment_data );
		}

		set_post_thumbnail( $react_post_id, $react_attachment_id );

	}
	

	// Attaches services cat to react post.
	wp_set_post_categories( $react_post_id, $services_cat_id );
	
	/**
	* WordPress services post.
	*/

	$wordpress_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'WordPress Services',
		'post_content' => "I offer an entire suite of WordPress services. Custom Theme development. Current Theme modifications. Plugin creation, and troubleshooting. Monthly maintenance which includes security updates, and support. I build code that follows WordPress' best practices. Any professional developer can work with the code base I build. This allows your site to be upgrade-able far into the future, and my work doesn't have to be remade. ",
		'post_type' => 'post',
		'post_status' => 'publish'
	);

	$wordpress_post_id = wp_insert_post($wordpress_post_args);

	$wordpress_file = get_template_directory() . '/images/wordpresslogo_300_fix.png';

	$wordpress_filename = basename($wordpress_file);

	$wordpress_upload_file = wp_upload_bits($wordpress_filename, null, file_get_contents($wordpress_file));
	if(!$wordpress_upload_file['error']){
		$wordpress_file_type = wp_check_filetype( $wordpress_filename, null );
		$wordpress_attachment = array(
			'post_mime_type' => $wordpress_file_type['type'],
			'post_parent' => $wordpress_post_id,
			'post_title' => 'Wordpress Logo',
			'post_content' => '',
			'post_status' => 'inherit'

		);

		$wordpress_attachment_id = wp_insert_attachment( $wordpress_attachment, $wordpress_upload_file['file'], $wordpress_post_id );
		if (!is_wp_error($wordpress_attachment_id)) {
			
			$wordpress_attachment_data = wp_generate_attachment_metadata( $wordpress_attachment_id, $wordpress_upload_file['file'] );
			wp_update_attachment_metadata( $wordpress_attachment_id,  $wordpress_attachment_data );
		}

		set_post_thumbnail( $wordpress_post_id, $wordpress_attachment_id );

	}
	

	// Attaches services cat to react post.
	wp_set_post_categories( $wordpress_post_id, $services_cat_id);


	/**
	 * Adds projects at setup.
	 */

	$projects_cat_id = get_cat_ID('projects');

	// Adds Contractors theme
	$contractors_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'Contractors Theme',
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'post'
	);

	
	$contractors_post_id = wp_insert_post($contractors_post_args);

	$contractors_file = get_template_directory() . '/images/customizer300.png';

	$contractors_filename = basename($contractors_file);

	$contractors_upload_file = wp_upload_bits($contractors_filename, null, file_get_contents($contractors_file));
	if(!$contractors_upload_file['error']){
		$contractors_file_type = wp_check_filetype( $contractors_filename, null );
		$contractors_attachment = array(
			'post_mime_type' => $contractors_file_type['type'],
			'post_parent' => $contractors_post_id,
			'post_title' => 'Contractors Theme',
			'post_content' => '',
			'post_status' => 'inherit'

		);

		$contractors_attachment_id = wp_insert_attachment( $contractors_attachment, $contractors_upload_file['file'], $contractors_post_id );
		if (!is_wp_error($contractors_attachment_id)) {
			
			$contractors_attachment_data = wp_generate_attachment_metadata( $contractors_attachment_id, $contractors_upload_file['file'] );
			wp_update_attachment_metadata( $contractors_attachment_id,  $contractors_attachment_data );
		}

		set_post_thumbnail( $contractors_post_id, $contractors_attachment_id );

		

	}
	

	// Attaches projects cat to contractors post.
	wp_set_post_categories( $contractors_post_id, $projects_cat_id);
	
	// Attaches post meta for contractors 
	add_post_meta($contractors_post_id, 'contractors_page_meta_key', 'contractors-theme');
	

	update_post_meta($contractors_post_id, 'contractors_external_meta_key', get_template_directory(  ) . '/contractors-theme');


	// Adds MM Deck.
	$mmDeck_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'React profile site',
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'post'
	);

	
	$mmDeck_post_id = wp_insert_post($mmDeck_post_args);

	$mmDeck_file = get_template_directory() . '/images/mmdeck.png';

	$mmDeck_filename = basename($mmDeck_file);
	
	$mmDeck_upload_file = wp_upload_bits($mmDeck_filename, null, file_get_contents($mmDeck_file));
	if(!$mmDeck_upload_file['error']){
		$mmDeck_file_type = wp_check_filetype( $mmDeck_filename, null );
		$mmDeck_attachment = array(
			'post_mime_type' => $mmDeck_file_type['type'],
			'post_parent' => $mmDeck_post_id,
			'post_title' => 'React Deck image',
			'post_content' => '',
			'post_status' => 'inherit'

		);

		$mmDeck_attachment_id = wp_insert_attachment( $mmDeck_attachment, $mmDeck_upload_file['file'], $mmDeck_post_id );
		if (!is_wp_error($mmDeck_attachment_id)) {
			
			$mmDeck_attachment_data = wp_generate_attachment_metadata( $mmDeck_attachment_id, $mmDeck_upload_file['file'] );
			wp_update_attachment_metadata( $mmDeck_attachment_id,  $mmDeck_attachment_data );
		}

		set_post_thumbnail( $mmDeck_post_id, $mmDeck_attachment_id );

	}
	

	// Attaches projects cat to mmDeck post.
	wp_set_post_categories( $mmDeck_post_id, $projects_cat_id);

	// Attaches post meta for mmDeck.
	update_post_meta( $mmDeck_post_id, '_external_link_meta_key', 'https://deck.mark-mcdaniels.com');
	
	update_post_meta( $mmDeck_post_id, '_github_meta_key', 'https://github.com/MarkMcDaniels/mm');

	// Adds Hushed site.
	$hushedS_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'Hushed responsive site',
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'post'
	);

	
	$hushedS_post_id = wp_insert_post($hushedS_post_args);

	$hushedS_file = get_template_directory() . '/images/hushedSite300.png';

	$hushedS_filename = basename($hushedS_file);

	$hushedS_upload_file = wp_upload_bits($hushedS_filename, null, file_get_contents($hushedS_file));
	if(!$hushedS_upload_file['error']){
		$hushedS_file_type = wp_check_filetype( $hushedS_filename, null );
		$hushedS_attachment = array(
			'post_mime_type' => $hushedS_file_type['type'],
			'post_parent' => $hushedS_post_id,
			'post_title' => 'Hushed site image',
			'post_content' => '',
			'post_status' => 'inherit'

		);

		$hushedS_attachment_id = wp_insert_attachment( $hushedS_attachment, $hushedS_upload_file['file'], $hushedS_post_id );
		if (!is_wp_error($husedS_attachment_id)) {
			
			$hushedS_attachment_data = wp_generate_attachment_metadata( $hushedS_attachment_id, $hushedS_upload_file['file'] );
			wp_update_attachment_metadata( $hushedS_attachment_id,  $hushedS_attachment_data );
		}

		set_post_thumbnail( $hushedS_post_id, $hushedS_attachment_id );

	}
	

	// Attaches projects cat to hushedS post.
	wp_set_post_categories( $hushedS_post_id, $projects_cat_id);

	// Attaches post meta for hushedS.
	update_post_meta( $hushedS_post_id, '_hushedS_external_meta_key', 'http://thehushedapp.com');

	update_post_meta( $hushedS_post_id, '_hushedS_page_meta_key', 'placeholder');
	
	// Adds Hushed app
	$hushedA_post_args = array(
		'post_author' => $user_id,
		'post_title' => 'Hushed App',
		'post_content' => '',
		'post_status' => 'publish',
		'post_type' => 'post'
	);

	
	$hushedA_post_id = wp_insert_post($hushedA_post_args);

	$hushedA_file = get_template_directory() . '/images/hushedAppGPS300.png';

	$hushedA_filename = basename($hushedA_file);

	$hushedA_upload_file = wp_upload_bits($hushedA_filename, null, file_get_contents($hushedA_file));
	if(!$hushedA_upload_file['error']){
		$hushedA_file_type = wp_check_filetype( $hushedA_filename, null );
		$hushedA_attachment = array(
			'post_mime_type' => $hushedA_file_type['type'],
			'post_parent' => $hushedA_post_id,
			'post_title' => 'Hushed app image',
			'post_content' => '',
			'post_status' => 'inherit'

		);

		$hushedA_attachment_id = wp_insert_attachment( $hushedA_attachment, $hushedA_upload_file['file'], $hushedA_post_id );
		if (!is_wp_error($hushedA_attachment_id)) {
			
			$hushedA_attachment_data = wp_generate_attachment_metadata( $hushedA_attachment_id, $hushedA_upload_file['file'] );
			wp_update_attachment_metadata( $hushedA_attachment_id,  $hushedA_attachment_data );
		}

		set_post_thumbnail( $hushedA_post_id, $hushedA_attachment_id );

	}
	

	// Attaches projects cat to hushed app post.
	wp_set_post_categories( $hushedA_post_id, $projects_cat_id);
	
	// Attaches hushed app meta to post.
	update_post_meta($hushedA_post_id, '_hushedA_page_meta_key', "placeholder for product link");

	update_post_meta($hushedA_post_id, '_hushedA_external_meta_key', 'https://play.google.com/store/apps/details?id=com.hushedapp.hushed&hl=en_US');

}


/**
 * Creates Meta Boxes for posts and pages for project links: github, link.
 */

function add_page_name_box(){
	$types = ['post', 'page'];
	foreach ( $types as $type){
		add_meta_box(
			'page_name_id',
			'Project Page Name',
			'project_page_html',
			$type
		);
	}
}
add_action('add_meta_boxes', 'add_page_name_box');

function project_page_html($post){
	$project_meta = get_post_meta($post->ID, '_page_name_meta_key');
	?>
		<label for="page_name_input">Your project page name:</label>
		<input name="page_name_input" value="<?php echo $project_meta[0]; ?>" type="text" class="postbox" />
		
	<?php
}

function save_page_name($post_id){
	if(array_key_exists('page_name_input', $_POST)){
		update_post_meta(
			$post_id,
			'_page_name_meta_key',
			_(esc_html($_POST['page_name_input']))
		);
	}
}
add_action('save_post', 'save_page_name');

function add_external_link_box(){
	$types = ['post', 'page'];
	foreach($types as $type){
		add_meta_box(
			'external_id',
			'External Project Link URL',
			'external_link_html',
			$type
		);
	}
}
add_action('add_meta_boxes', 'add_external_link_box');

function external_link_html($post){
	$external_meta = get_post_meta( $post->ID, '_external_link_meta_key');
	?>
		<label for="external_link_input">Url for your project:</label>
		<input name="external_link_input" value="<?php echo $external_meta[0]; ?>" type="text" class="postbox" />
	<?php
}

function save_external_link($post_id){
	if(array_key_exists('external_link_input', $_POST)){
		update_post_meta(
			$post_id,
			'_external_link_meta_key',
			_(esc_html($_POST['external_link_input']))
		);
	}
}
add_action('save_post', 'save_external_link');

function add_github_link_box(){
	$types = ['post', 'page'];
	foreach($types as $type){
		add_meta_box(
			'github_id',
			'Github Project Repo URL',
			'github_link_html',
			$type
		);
	}
}
add_action('add_meta_boxes', 'add_github_link_box');

function github_link_html($post){
	$github_meta = get_post_meta($post->ID, '_github_meta_key', true);
	?>
		<label for="github_link_input">The repo url:</label>
		<input name="github_link_input" value="<?php echo $github_meta; ?>" type="text" class="postbox" />
	<?php
}

function save_github_link($post_id){
	if(array_key_exists('github_link_input', $_POST)){
		update_post_meta(
			$post_id,
			'_github_meta_key',
			_(esc_html($_POST['github_link_input']))
		);
	}
}
add_action('save_post', 'save_github_link');

function add_contact_page(){

	// Creates contact page
	if(!post_exists('Contact Success Page')){
	$title = "Contact Success Page";
	$slug = 'contact';
	wp_insert_post(array(
		'post_title' => $title,
		'post_name' => $slug,
		'post_status' => 'publish',
		'post_type' => 'page',
		'page_template' => 'page-contact.php'
	));

	}




}
add_action('after_setup_theme', 'add_contact_page');

function add_products_page(){
	if(!post_exists('Products page')){
		$title = "Products page";
		$slug = 'products';
		wp_insert_post(array(
			'post_title' => $title,
			'post_name' => $slug,
			'post_status' => 'publish',
			'post_type' => 'page',
			'page_template' => 'products.php'
		));
	}
}
add_action('after_setup_theme', 'add_products_page');

/*--------------------------------------------------------------
	Contact admin post handler with redirect for contact.php
	Doing it this way lets me validate, and mail with wp_mail()
-----------------------------------------------------------------*/
function contactFormSubmit () {
	// Sets args for passing to contact form
	// if(empty($_POST)){

	// 	wp_redirect( get_site_url() );
	// 	die;

	// } else {
		
		$post_args = array(
			'contact_name' => $_POST['contact_name'],
			'email_input' => $_POST['email_input'],
			'feedback' => $_POST['feedback']
		);
		

		wp_redirect(add_query_arg($post_args, get_site_url() . '/contact' ));
		die;
	//}
	
}
add_action('admin_post_nopriv_contact_form', 'contactFormSubmit');
add_action('admin_post_contact_form', 'contactFormSubmit');


/**
 * 	Hides archives and date page access
 * 
 */
function redirect_to_home($query){
	if(is_date()){
		wp_redirect(home_url());
		die;
	}

	if(is_archive()){
		wp_redirect(home_url());
		die;
	}
}
add_action('parse_query', 'redirect_to_home');
