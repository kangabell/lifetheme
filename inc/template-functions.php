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
 * Add featured image and "currently listening" to RSS feed content
 */
function life_rss_feed_content( $content ) {

	global $post;

	$prepend = null;
	$append = null;

	if ( is_feed() ) {

		if ( has_post_thumbnail( $post->ID ) ) {

			$prepend = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 1rem;' ) ) . '</div>';
		}

		if ( function_exists( 'get_field' ) ) {
			$artist = get_field('song_artist');
			$song = get_field('song_link');

			if ( $song ):
				$song_url = $song['url'];
				$song_title = $song['title'];
				$song_target = $song['target'] ? $song['target'] : '_self';
				$append = '<p class="song-link"><span class="label">' . esc_html__( 'Currently Listening: ', 'life' ) . '“<a class="button" href="' . esc_url( $song_url ) . '" target="' . esc_attr( $song_target ) . '">' . esc_html( $song_title ) . '</a>” ' . $artist . '</p>';
			endif;
		}

		$content = $prepend . $content . $append;

	}

	return $content;

}
add_filter('the_content', 'life_rss_feed_content');


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


/**
 * Make attachment page image larger
 */
function modify_attachment_link($markup) {
    return preg_replace('/^<a([^>]+)>(.*)$/', '<a\\1 target="_blank">\\2', $markup);
}
add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 6 );