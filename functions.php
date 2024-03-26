<?php

/**
 * wpstd functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wpstd
 */
require get_template_directory() . '/inc/metaboxes.php';
require get_template_directory() . '/inc/widget-about.php';
function wpstd_enqueue_scripts()
{
	wp_enqueue_style('wpstd-general', get_template_directory_uri() . '/assets/css/general.css', array(), '1.0.1', 'all');
	wp_enqueue_style('wpstd-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.1', 'all');
	wp_enqueue_style('wpstd-form', get_template_directory_uri() . '/assets/css/form.css', array(), '1.0.1', 'all');

	wp_enqueue_script('wpstd-app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), '1.0.1', true);
	// wp_enqueue_style('wpstd-general');
	// wp_enqueue_script('wpstd-app'); можно подключать скрипти в любом месте функцией register регистрируем enqueue обьявляем
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}


add_action('wp_enqueue_scripts', 'wpstd_enqueue_scripts');

//metabox for posttype



// field data from user profile page

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="birthday">Birthday</label></th>

			<td>
				<input type="date" name="birthday" id="birthday" value="<?php echo esc_attr( get_the_author_meta( 'birthday', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Birthday</span>
			</td>
		</tr>

	</table>
<?php }

//save field data from user profile page
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'birthday', $_POST['birthday'] );
}





// добавление параметров в head посредством хуков
function wpstd_show_meta()
{
	echo "<meta name='author' content='vadimadmin'>";
}

function wpstd_show_meta2()
{
	echo "<meta name='author' content='vadimadmin2'>";
}

add_action('wp_head', 'wpstd_show_meta'); //третій параметр передає приорітет в ієрархії
add_action('wp_head', 'wpstd_show_meta2');

//Хук для добавления класов

function wpstd_body_class($classes)
{
	if (is_front_page()) {
		$classes[] = 'wpstd_body';
	} elseif (is_singular()) {
		$classes[] = 'extra_class';
	}

	return $classes;
}

add_filter('body_class', 'wpstd_body_class');
add_filter('use_block_editor_for_post', '__return_false', 10);

function wpstd_theme_init()
{
	register_nav_menus(array(
		'header_nav' => 'Header navigation',
		'footer_nav' => 'Footer navigation',
		'sidebar_nav' => 'Sidebar navigation'
	));

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


	load_theme_textdomain('wpstd', get_template_directory() . '/lang');

	add_theme_support('post-thumbnails');
	add_theme_support(
		'post-formats',
		array(
			'video',
			'image',
			'quote',
			'gallery'
		)
	);
	add_post_type_support('news', 'post-formats');
}

add_action('after_setup_theme', 'wpstd_theme_init', 0);


//Category post type

function wpstd_register_post_type()
{
	$args = array(
		'hierarchical' => false,
		'labels' => array(
			'name'              =>  esc_html_x('Genres', 'wpstd'),
			'singular_name'     => 'Genre',
			'search_items'      => 'Search Genres',
			'all_items'         => 'All Genres',
			'view_item '        => 'View Genre',
			'parent_item'       => 'Parent Genre',
			'parent_item_colon' => 'Parent Genre:',
			'edit_item'         => 'Edit Genre',
			'update_item'       => 'Update Genre',
			'add_new_item'      => 'Add New Genre',
			'new_item_name'     => 'New Genre Name',
			'menu_name'         => 'Genre',
			'back_to_items'     => '← Back to Genre',
		)

	);

	register_taxonomy('Catnews', array('news'), $args);

	unset($args);

	$args = array(
		'hierarchical' => false,
		'labels' => array(
			'name'              =>  esc_html_x('Years', 'wpstd'),
			'singular_name'     => 'Year',
			'search_items'      => 'Search Years',
			'all_items'         => 'All Years',
			'view_item '        => 'View Year',
			'parent_item'       => 'Parent Year',
			'parent_item_colon' => 'Parent Year:',
			'edit_item'         => 'Edit Year',
			'update_item'       => 'Update Year',
			'add_new_item'      => 'Add New Year',
			'new_item_name'     => 'New Year Name',
			'menu_name'         => 'Year',
			'back_to_items'     => '← Back to Year',
		)

	);

	register_taxonomy('Catyear', array('news'), $args);

	unset($args);

	$args = array(
		'label' => esc_html__('News', 'wpstd'),
		'labels' => array(
			'name'                  => esc_html_x('News', 'Post type general name', 'wpstd'),
			'singular_name'         => esc_html_x('New', 'Post type singular name', 'wpstd'),
			'menu_name'             => esc_html_x('News', 'Admin Menu text', 'wpstd'),
			'name_admin_bar'        => esc_html_x('News', 'Add New on Toolbar', 'wpstd'),
			'add_new'               => esc_html__('Add New', 'wpstd'),
			'add_new_item'          => esc_html__('Add New News', 'wpstd'),
			'new_item'              => esc_html__('New News', 'wpstd'),
			'edit_item'             => esc_html__('Edit News', 'wpstd'),
			'view_item'             => esc_html__('View News', 'wpstd'),
			'all_items'             => esc_html__('All News', 'wpstd'),
			'search_items'          => esc_html__('Search News', 'wpstd'),
			'parent_item_colon'     => esc_html__('Parent News:', 'wpstd'),
			'not_found'             => esc_html__('No News found.', 'wpstd'),
			'not_found_in_trash'    => esc_html__('No News found in Trash.', 'wpstd'),
			'featured_image'        => esc_html_x('News Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'wpstd'),
			'set_featured_image'    => esc_html_x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'wpstd'),
			'remove_featured_image' => esc_html_x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'wpstd'),
			'use_featured_image'    => esc_html_x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'wpstd'),
			'archives'              => esc_html_x('News archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'wpstd'),
			'insert_into_item'      => esc_html_x('Insert into News', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'wpstd'),
			'uploaded_to_this_item' => esc_html_x('Uploaded to this News', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'wpstd'),
			'filter_items_list'     => esc_html_x('Filter News list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'wpstd'),
			'items_list_navigation' => esc_html_x('News list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'wpstd'),
			'items_list'            => esc_html_x('News list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'wpstd'),
		),

		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'custom-fields', 'post-formats'),

		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'news'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'menu_position'      => null,
		'hierarchical'       => true,
		'exclude_from_search' => false,
		'show_in_rest' => true,
	);

	register_post_type('news', $args);
}
add_action('init', 'wpstd_register_post_type');


// function wpstd_register_post_type()
// {
// 	$labels = array(
// 		'name'                  => esc_html_x('News', 'Post type general name', 'wpstd'),
// 		'singular_name'         => esc_html_x('New', 'Post type singular name', 'wpstd'),
// 		'menu_name'             => esc_html_x('News', 'Admin Menu text', 'wpstd'),
// 		'name_admin_bar'        => esc_html_x('New', 'Add New on Toolbar', 'wpstd'),
// 	);

// 	$args = array(
// 		'labels'             => $labels,
// 		'public'             => true,
// 		'query_var'          => true,
// 		'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes', 'post-formats'),
// 		'has_archive' => true,
// 		'rewrite' => array('slug' => 'news'),
// 		'capability_type' => 'post',
// 	);

// 	register_post_type('News', $args);
// }

// add_action('init', 'wpstd_register_post_type');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpstd_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('News Sidebar', 'wpstd'),
			'id'            => 'newsidebar',
			'description'   => esc_html__('Add widgets news pages sidebar.', 'wpstd'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'wpstd'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'wpstd'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_widget('wpstd_about_widget');
}
add_action('widgets_init', 'wpstd_widgets_init');


function wpstd_rewrite_rules()
{
	wpstd_register_post_type();
	flush_rewrite_rules();
}
add_action('after_switch_theme', 'wpstd_rewrite_rules');
// function wpstd_custom_search()
// {
// 	$form = "html for form";
// 	return $form;
// }

// add_filter('get_search_form', 'wpstd_custom_search');


if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpstd_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wpstd, use a find and replace
		* to change 'wpstd' to the name of your theme in all the template files.
		*/
	// load_theme_wpstd('wpstd', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus(
	// 	array(
	// 		'menu-1' => esc_html__('Primary', 'wpstd'),
	// 	)
	// );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/


	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'wpstd_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'wpstd_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wpstd_content_width()
{
	$GLOBALS['content_width'] = apply_filters('wpstd_content_width', 640);
}
add_action('after_setup_theme', 'wpstd_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
function wpstd_scripts()
{
	// wp_enqueue_style('wpstd-style', get_stylesheet_uri(), array(), _S_VERSION); //підключає стандартний style.css
	// wp_style_add_data('wpstd-style', 'rtl', 'replace');

	// wp_enqueue_script('wpstd-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);


	add_action('wp_enqueue_scripts', 'wpstd_scripts');

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
	if (defined('JETPACK__VERSION')) {
		require get_template_directory() . '/inc/jetpack.php';
	}
}
