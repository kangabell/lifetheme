<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Life
 */

/**
 * Shorten the length of the excerpt.
 */
function life_shorten_excerpt( $length ) {
	return 36;
}
add_filter( 'excerpt_length', 'life_shorten_excerpt', 999 );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function life_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'life_pingback_header' );


/**
 * Prepend WordPress RSS feed content with the featured image
 */
function life_rss_feed_img( $content ) {

	global $post;

	if ( is_feed() ) {
		if ( has_post_thumbnail( $post->ID ) ) {
			$prepend = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 1rem;' ) ) . '</div>';
			$content = $prepend . $content;
		}
	}

	return $content;

}
add_filter('the_content', 'life_rss_feed_img');


/**
 * Bookmarks/Links in RSS feed link directly to the referenced URL
 */
function life_rss_bookmark_url($post_permalink) {
	if ( 'life_bookmark' === get_post_type() ) {
		return get_post_meta( get_the_ID(), 'life_url', true );
	} else {
		return $post_permalink;
	}
};
add_filter('the_permalink_rss', 'life_rss_bookmark_url');