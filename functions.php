<?php
/**
 * Life functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Life
 */

if ( ! defined( 'LIFE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'LIFE_VERSION', '0.1' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function life_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
	load_theme_textdomain( 'life', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'life' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'life_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'life_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function life_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'life_content_width', 640 );
}
add_action( 'after_setup_theme', 'life_content_width', 0 );


/**
 * Register custom taxonomies
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 */
function life_custom_taxonomies() {

	register_taxonomy( 'collection', 'project', array(
		'labels'        => array(
			'name'              => _x( 'Collections', 'taxonomy general name', 'life' ),
			'singular_name'     => _x( 'Collection', 'taxonomy singular name', 'life' ),
			'search_items'      => __( 'Search Collections', 'life' ),
			'all_items'         => __( 'All Collections', 'life' ),
			'view_item'         => __( 'View Collection', 'life' ),
			'parent_item'       => __( 'Parent Collection', 'life' ),
			'parent_item_colon' => __( 'Parent Collection:', 'life' ),
			'edit_item'         => __( 'Edit Collection', 'life' ),
			'update_item'       => __( 'Update Collection', 'life' ),
			'add_new_item'      => __( 'Add New Collection', 'life' ),
			'new_item_name'     => __( 'New Collection Name', 'life' ),
			'not_found'         => __( 'No Collections Found', 'life' ),
			'back_to_items'     => __( 'Back to Collections', 'life' ),
			'menu_name'         => __( 'Collections', 'life' ),
		),
		'hierarchical' => true,
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'life_custom_taxonomies', 0 );

/**
 * Register custom post types
 *
 * @link https://developer.wordpress.org/plugins/post-types/registering-custom-post-types
 */
function life_custom_post_types() {

	register_post_type('project',
		array(
			'labels'        => array(
				'name'                  => _x( 'Projects', 'Post type general name', 'life' ),
				'singular_name'         => _x( 'Project', 'Post type singular name', 'life' ),
				'menu_name'             => _x( 'Projects', 'Admin Menu text', 'life' ),
				'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'life' ),
				'add_new'               => __( 'Add New', 'life' ),
				'add_new_item'          => __( 'Add New Project', 'life' ),
				'new_item'              => __( 'New Project', 'life' ),
				'edit_item'             => __( 'Edit Project', 'life' ),
				'view_item'             => __( 'View Project', 'life' ),
				'all_items'             => __( 'All Project', 'life' ),
				'search_items'          => __( 'Search Projects', 'life' ),
				'parent_item_colon'     => __( 'Parent Projects:', 'life' ),
				'not_found'             => __( 'No projects found.', 'life' ),
				'not_found_in_trash'    => __( 'No projects found in Trash.', 'life' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_position' => 4,
			'menu_icon'     => 'dashicons-hammer',
			'supports'	    => array( 'title', 'editor', 'revisions', 'excerpt', 'thumbnail' ),
			'show_in_rest'  => true,
			'taxonomies'    => 'collection',
		)
	);

	register_post_type('character',
		array(
			'labels'        => array(
				'name'                  => _x( 'Characters', 'Post type general name', 'life' ),
				'singular_name'         => _x( 'Character', 'Post type singular name', 'life' ),
				'menu_name'             => _x( 'Characters', 'Admin Menu text', 'life' ),
				'name_admin_bar'        => _x( 'Character', 'Add New on Toolbar', 'life' ),
				'add_new'               => __( 'Add New', 'life' ),
				'add_new_item'          => __( 'Add New Character', 'life' ),
				'new_item'              => __( 'New Character', 'life' ),
				'edit_item'             => __( 'Edit Character', 'life' ),
				'view_item'             => __( 'View Character', 'life' ),
				'all_items'             => __( 'All Character', 'life' ),
				'search_items'          => __( 'Search Characters', 'life' ),
				'parent_item_colon'     => __( 'Parent Characters:', 'life' ),
				'not_found'             => __( 'No characters found.', 'life' ),
				'not_found_in_trash'    => __( 'No characters found in Trash.', 'life' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-smiley',
			'supports'	    => array( 'title', 'editor', 'revisions', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);
}
add_action('init', 'life_custom_post_types');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function life_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'life' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'life' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'life_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function life_scripts() {
	wp_enqueue_style( 'life-style', get_template_directory_uri() . '/library/css/style.css', array(), LIFE_VERSION );
	wp_style_add_data( 'life-style', 'rtl', 'replace' );

	wp_enqueue_script( 'life-navigation', get_template_directory_uri() . '/library/js/navigation.js', array(), LIFE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'life_scripts' );

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
