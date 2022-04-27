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
	define( 'LIFE_VERSION', '1.5.7' );
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
	* Enable support for Post Thumbnails on posts and pages
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support( 'post-thumbnails' );

	/*
	* Add custom image size for Post Thumbnails
	*
	* @link https://developer.wordpress.org/reference/functions/add_image_size/
	*/
	add_image_size( 'medium_square', 570, 570, true );
	add_image_size( 'small_square', 345, 345, true );

	/*
	* Add theme support for wide alignment blocks
	*
	* @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#wide-alignment
	*/
	add_theme_support( 'align-wide' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'life' ),
			'menu-2' => esc_html__( 'Secondary', 'life' ),
			'menu-3' => esc_html__( 'Footer', 'life' ),
			'menu-projects' => esc_html__( 'Projects Submenu', 'life' ),
			'menu-bookmarks' => esc_html__( 'Links Submenu', 'life' ),
			'menu-favorites' => esc_html__( 'Favorites Submenu', 'life' ),
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function life_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Secondary Content', 'life' ),
		'id'            => 'home-secondary',
		'description'   => esc_html__( 'Add blocks to the bottom of the homepage.', 'life' ),
		'before_title'  => '',
		'after_title'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Posts Header', 'life' ),
		'id'            => 'header-posts',
		'description'   => esc_html__( 'Add blocks to the top of the blog page.', 'life' ),
		'before_title'  => '<h1 class="page-title">',
		'after_title'   => '</h1>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Posts Secondary Content', 'life' ),
		'id'            => 'post-secondary',
		'description'   => esc_html__( 'Add blocks to the bottom of the Posts page.', 'life' ),
		'before_title'  => '',
		'after_title'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Projects Header', 'life' ),
		'id'            => 'header-projects',
		'description'   => esc_html__( 'Add blocks to the top of the Projects page.', 'life' ),
		'before_title'  => '<h1 class="page-title">',
		'after_title'   => '</h1>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Characters Header', 'life' ),
		'id'            => 'header-characters',
		'description'   => esc_html__( 'Add blocks to the top of the Characters page.', 'life' ),
		'before_title'  => '<h1 class="page-title">',
		'after_title'   => '</h1>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Links Header', 'life' ),
		'id'            => 'header-bookmarks',
		'description'   => esc_html__( 'Add blocks to the top of the Links page.', 'life' ),
		'before_title'  => '<h1 class="page-title">',
		'after_title'   => '</h1>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Favorites Header', 'life' ),
		'id'            => 'header-favorites',
		'description'   => esc_html__( 'Add blocks to the top of the Favorites page.', 'life' ),
		'before_title'  => '<h1 class="page-title">',
		'after_title'   => '</h1>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
}
add_action( 'widgets_init', 'life_widgets_init' );


/**
 * Register custom taxonomies
 *
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 */
function life_custom_taxonomies() {

	register_taxonomy( 'life_collection', 'life_project', array(
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
		'rewrite'		=> array( 'slug' => 'projects/collection'),
		'hierarchical' => true,
		'show_in_rest' => true,
	) );

	register_taxonomy( 'life_favorite_type', 'life_favorite', array(
		'labels'        => array(
			'name'              => _x( 'Favorite Types', 'taxonomy general name', 'life' ),
			'singular_name'     => _x( 'Type', 'taxonomy singular name', 'life' ),
			'search_items'      => __( 'Search Types', 'life' ),
			'all_items'         => __( 'All Types', 'life' ),
			'view_item'         => __( 'View Type', 'life' ),
			'parent_item'       => __( 'Parent Type', 'life' ),
			'parent_item_colon' => __( 'Parent Type:', 'life' ),
			'edit_item'         => __( 'Edit Type', 'life' ),
			'update_item'       => __( 'Update Type', 'life' ),
			'add_new_item'      => __( 'Add New Type', 'life' ),
			'new_item_name'     => __( 'New Type Name', 'life' ),
			'not_found'         => __( 'No Types Found', 'life' ),
			'back_to_items'     => __( 'Back to Types', 'life' ),
			'menu_name'         => __( 'Types', 'life' ),
		),
		'rewrite'		=> array( 'slug' => 'favorites/type'),
		'hierarchical' => true,
		'show_in_rest' => true,
	) );

	register_taxonomy( 'life_bookmark_type', 'life_bookmark', array(
		'labels'        => array(
			'name'              => _x( 'Link Types', 'taxonomy general name', 'life' ),
			'singular_name'     => _x( 'Type', 'taxonomy singular name', 'life' ),
			'search_items'      => __( 'Search Types', 'life' ),
			'all_items'         => __( 'All Types', 'life' ),
			'view_item'         => __( 'View Type', 'life' ),
			'parent_item'       => __( 'Parent Type', 'life' ),
			'parent_item_colon' => __( 'Parent Type:', 'life' ),
			'edit_item'         => __( 'Edit Type', 'life' ),
			'update_item'       => __( 'Update Type', 'life' ),
			'add_new_item'      => __( 'Add New Type', 'life' ),
			'new_item_name'     => __( 'New Type Name', 'life' ),
			'not_found'         => __( 'No Types Found', 'life' ),
			'back_to_items'     => __( 'Back to Types', 'life' ),
			'menu_name'         => __( 'Types', 'life' ),
		),
		'rewrite'		=> array( 'slug' => 'links/type'),
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

	register_post_type('life_project',
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
				'all_items'             => __( 'All Projects', 'life' ),
				'search_items'          => __( 'Search Projects', 'life' ),
				'parent_item_colon'     => __( 'Parent Projects:', 'life' ),
				'not_found'             => __( 'No projects found.', 'life' ),
				'not_found_in_trash'    => __( 'No projects found in Trash.', 'life' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'		=> array( 'slug' => 'projects'),
			'menu_position' => 4,
			'menu_icon'     => 'dashicons-hammer',
			'supports'	    => array( 'title', 'editor', 'revisions', 'excerpt', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);

	register_post_type('life_character',
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
				'all_items'             => __( 'All Characters', 'life' ),
				'search_items'          => __( 'Search Characters', 'life' ),
				'parent_item_colon'     => __( 'Parent Characters:', 'life' ),
				'not_found'             => __( 'No characters found.', 'life' ),
				'not_found_in_trash'    => __( 'No characters found in Trash.', 'life' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'		=> array( 'slug' => 'characters'),
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-smiley',
			'supports'	    => array( 'title', 'editor', 'revisions', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);

	register_post_type('life_favorite',
		array(
			'labels'        => array(
				'name'                  => _x( 'Favorites', 'Post type general name', 'life' ),
				'singular_name'         => _x( 'Favorite', 'Post type singular name', 'life' ),
				'menu_name'             => _x( 'Favorites', 'Admin Menu text', 'life' ),
				'name_admin_bar'        => _x( 'Favorite', 'Add New on Toolbar', 'life' ),
				'add_new'               => __( 'Add New', 'life' ),
				'add_new_item'          => __( 'Add New Favorite', 'life' ),
				'new_item'              => __( 'New Favorite', 'life' ),
				'edit_item'             => __( 'Edit Favorite', 'life' ),
				'view_item'             => __( 'View Favorite', 'life' ),
				'all_items'             => __( 'All Favorites', 'life' ),
				'search_items'          => __( 'Search Favorites', 'life' ),
				'parent_item_colon'     => __( 'Parent Favorites:', 'life' ),
				'not_found'             => __( 'No favorites found.', 'life' ),
				'not_found_in_trash'    => __( 'No favorites found in Trash.', 'life' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'		=> array( 'slug' => 'favorites'),
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-star-filled',
			'supports'	    => array( 'title', 'editor', 'revisions', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);

	register_post_type('life_bookmark',
		array(
			'labels'        => array(
				'name'                  => _x( 'Links', 'Post type general name', 'life' ),
				'singular_name'         => _x( 'Link', 'Post type singular name', 'life' ),
				'menu_name'             => _x( 'Links', 'Admin Menu text', 'life' ),
				'name_admin_bar'        => _x( 'Link', 'Add New on Toolbar', 'life' ),
				'add_new'               => __( 'Add New', 'life' ),
				'add_new_item'          => __( 'Add New Link', 'life' ),
				'new_item'              => __( 'New Link', 'life' ),
				'edit_item'             => __( 'Edit Link', 'life' ),
				'view_item'             => __( 'View Link', 'life' ),
				'all_items'             => __( 'All Links', 'life' ),
				'search_items'          => __( 'Search Links', 'life' ),
				'parent_item_colon'     => __( 'Parent Links:', 'life' ),
				'not_found'             => __( 'No links found.', 'life' ),
				'not_found_in_trash'    => __( 'No links found in Trash.', 'life' ),
			),
			'public'        => true,
			'has_archive'   => true,
			'rewrite'		=> array( 'slug' => 'links'),
			'menu_position' => 7,
			'menu_icon'     => 'dashicons-external',
			'supports'	    => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'show_in_rest'  => true,
		)
	);
}
add_action('init', 'life_custom_post_types');

/**
 * Meta box for Bookmark/Link post type.
 */
require get_template_directory() . '/inc/bookmarks-meta.php';

/**
 * Enqueue scripts and styles.
 */
function life_scripts() {
	wp_enqueue_style( 'life-style', get_template_directory_uri() . '/library/css/style.css', array(), LIFE_VERSION );
	wp_style_add_data( 'life-style', 'rtl', 'replace' );

	wp_enqueue_script( 'life-navigation', get_template_directory_uri() . '/library/js/navigation.js', array( 'jquery' ), LIFE_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'life_scripts' );

/**
 * Add block editor scripts and styles
 */
function life_gutenberg_scripts() {

	wp_enqueue_style( 'life-editor-style', get_template_directory_uri() . '/library/css/editor.css' );

	wp_enqueue_script(
		'life-editor-script',
		get_template_directory_uri() . '/library/js/editor.js',
		array( 'wp-blocks', 'wp-dom' ),
		filemtime( get_template_directory() . '/library/js/editor.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'life_gutenberg_scripts' );

/**
 * Show only 12 posts for the blog page
 */
function life_home_pagesize( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_home() ) {
		$query->set( 'posts_per_page', 12 );
		return;
	}
}
add_action( 'pre_get_posts', 'life_home_pagesize', 1 );

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

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
