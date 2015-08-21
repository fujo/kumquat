<?php

error_reporting(E_ALL); ini_set('display_errors', 0);

// disallow edition of theme files in wp-admin
define( 'DISALLOW_FILE_EDIT', true );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 */
add_action( 'after_setup_theme', 'aquarelle_setup' );
function aquatheme_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'aquarelle' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aquarelle', get_template_directory() . '/languages/' );
	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable navigations menu
	 *
	 */
	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
			'main' 		=> __( 'Main Menu' ),
			'meta' 		=> __( 'Meta Menu' ),
			'footer' 	=> __( 'Footer Menu' )
	));
	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true ); // default Post Thumbnail dimensions (cropped)
	
	// additional image sizes
	// add_image_size ( string $name, int $width, int $height, bool|array $crop = false )
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'large_thumb', 75, 75, true );
	add_image_size( 'wider_image', 200, 150 );
	// use it: 
	// - wp_get_attachment_image_src( 325, 'wider_image'); 
	// - the_post_thumbnail();

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
/**
* Register style sheetS
* @link https://codex.wordpress.org/Function_Reference/wp_register_style
*/
add_action( 'wp_enqueue_scripts', 'aquarelle_enqueue_custom_stylesheets', 11 );
function aquarelle_enqueue_custom_stylesheets() {
  wp_enqueue_style( 'aquarelle', get_template_directory_uri() . '/css/style.css' );
}
/**
 * Register stylesheets + js scripts
 * Proper way to enqueue scripts and styles
 * @link https://codex.wordpress.org/Function_Reference/wp_enqueue_script
 */
add_action( 'wp_enqueue_scripts', 'aquarelle_js_scripts', 10 );
function aquarelle_js_scripts() {
	//wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery' ), '1.0', true );
	wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array('jquery' ), '1.0', true );
	// pass Ajax Url to script.js
	wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
/**
 * Register widget area.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
add_action( 'widgets_init', 'aquarelle_widgets_init' );
function aquarelle_widgets_init() {

	register_sidebar(array(
		'name' => 'Footer Left',
		'id'   => 'footer_left',
		'description'   => 'This is the widgetized footer.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

	register_sidebar(array(
		'name' => 'Footer Center',
		'id'   => 'footer_center',
		'description'   => 'This is the widgetized footer.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

	register_sidebar(array(
		'name' => 'Footer Right',
		'id'   => 'footer_right',
		'description'   => 'This is the widgetized footer.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

	register_sidebar(array(
		'name' => 'Header',
		'id'   => 'header',
		'description'   => 'This is the widgetized header.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

	register_sidebar(array(
		'name' => 'Sidebar',
		'id'   => 'sidebar',
		'description'   => 'This is the widgetized sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
	));

}
/*
*
*	Tiny MCE setup
*
*	https://codex.wordpress.org/TinyMCE_Custom_Styles
*	http://www.tinymce.com/wiki.php/TinyMCE3x:Buttons/controls
*
*/
add_filter('tiny_mce_before_init', 'aquarelle_make_mce_awesome');
function aquarelle_make_mce_awesome($in) {
    $in['block_formats'] = 'h2=h2';
    $in['theme_advanced_styles'] = '.lead=lead';
    $in['toolbar1']='formatselect,|,bold,italic,|,bullist,numlist,blockquote,|,link,unlink,|,pastetext,undo,redo,|,cleanup';
    //$in['toolbar1']='bold,italic,|,bullist,numlist,blockquote,|,link,unlink,|,pastetext,undo,redo';
    $in['toolbar2']='';
    $in['toolbar3']='';
    $in['toolbar4']='';
    return $in;
}
/*

Add class to edit button

*/
function custom_edit_post_link($output) {
 $output = str_replace('class="post-edit-link"', 'class="post-edit-link btn icn edit"', $output);
 return $output;
}
add_filter('edit_post_link', 'custom_edit_post_link');
/*

Add Excerpts to Your Pages in WordPress

*/
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
/*

Add Excerpts to Your Pages in WordPress

*/
add_filter( "the_excerpt", "add_class_to_excerpt" );
function add_class_to_excerpt( $excerpt ) {
    return str_replace('<p', '<p class="excerpt"', $excerpt);
}
/*

Excerpts length

*/
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
	return 20;
}
/*

Get the perfect title provides the perfect title for your page
Source : https://digwp.com/demo/Digging-Into-WordPress_DEMO.pdf

*/
function get_perfect_title() {
	if (function_exists('is_tag') && is_tag()) {
		single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
	} elseif (is_archive()) {
		wp_title(''); echo ' Archive - ';
	} elseif (is_search()) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
	} elseif (!(is_404()) && (is_single()) || (is_page())) {
		wp_title(''); echo ' - ';
	} elseif (is_404()) {
		echo 'Not Found - ';
	}
	if (is_home()) {
		bloginfo('name'); echo ' - '; bloginfo('description');
	} else {
		bloginfo('name');
	}
	if ($paged > 1) {
		echo ' - page '. $paged;
	} 
}
/**
 * Global Custom Fields
 * A value that you can access from anywhere that returns a value you can use. 
 * Posts and Pages can have custom fields as well.
 * get the value: <?php echo get_option('myname'); ?>
 * @link https://digwp.com/demo/Digging-Into-WordPress_DEMO.pdf
*/
add_action('admin_menu', 'add_gcf_interface');
function add_gcf_interface() {
	add_options_page(
		'Global Custom Fields', 	// page title
		'Global Custom Fields', 	// menu title
		'8', 						// capability ??
		'functions',				// menu slug ??
		'editglobalcustomfields'	// function callback
	);
}
function editglobalcustomfields() { ?>
<!-- functions.php -->
<div class='wrap'>
	<h1>Global Custom Fields</h1>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>
	<table class="form-table">
		<tbody>
			<!--- e.g.
			<tr>
				<th scope="row">
					<label for="myname">My Name</label>
				</th>
				<td>
					<input type="text" name="myname" size="45" value="<?php echo get_option('myname'); ?>" />
					<textarea name="aqua_longitude"  cols="80%" rows="7"><?php echo get_option('aqua_longitude'); ?></textarea>
					<p class="description">Your name...</p>
				</td>
			</tr>
			-->
			<tr>
				<th scope="row">
					<label for="aqua_gatrackid">Google Analytics Tracking ID</label>
				</th>
				<td>
					<input type="text" name="aqua_gatrackid" size="45" value="<?php echo get_option('aqua_gatrackid'); ?>" />
					<p class="description">UA-XXXXXXXX-X</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="aqua_latitude">Latitude</label>
				</th>
				<td>
					<input type="text" name="aqua_latitude" size="45" value="<?php echo get_option('aqua_latitude'); ?>" />
					<p class="description">eg: 38.792763</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="aqua_longitude">Longitude</label>
				</th>
				<td>
					<input type="text" name="aqua_longitude" size="45" value="<?php echo get_option('aqua_longitude'); ?>" />
					<p class="description">eg: 15.218296</p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit"><input class="button button-primary" type="submit" name="Submit" value="Update Options" /></p>
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="aqua_gatrackid,aqua_welcometext,aqua_latitude,aqua_longitude" />
	</form>
</div>

<?php } 
/**
*
* Roles and Capabilities
*
*/
add_role( 'chef', 'Chef', array());
add_role( 'scout', 'Scout', array());
add_action( 'admin_init', 'add_capability');
function add_capability() {
    // gets the author role
    $role = get_role( 'chef' );
    // This only works, because it accesses the class instance.
    $role->add_cap( 'do_cheesecake' ); 
}
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

/**
*
* Remove Admin Menu Item
*
*/
add_action( 'admin_menu', 'aquarelle_remove_menus' );
function aquarelle_remove_menus(){
  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  //remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
}
/**
 * Inc files
 */
require get_template_directory() . '/inc/CPT_location.php';
require get_template_directory() . '/inc/CPT_people.php';