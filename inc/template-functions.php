<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Life
 */

/**
 * Remove prefix from some archive titles
 */
function life_remove_title_prefixes($title) {
	if ( is_year() ) {
		$title  = get_the_date( _x( 'Y', 'yearly archives date format' ) );
		$prefix = '';
	} elseif ( is_month() ) {
		$title  = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
		$prefix = '';
	} elseif ( is_day() ) {
		$title  = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
		$prefix = '';
	}
  return $title;
}
add_filter( 'get_the_archive_title', 'life_remove_title_prefixes' );

/**
 * Shorten the length of the excerpt.
 */
function life_shorten_excerpt( $length ) {
	return 36;
}
add_filter( 'excerpt_length', 'life_shorten_excerpt', 999 );

/**
 * Change "[...]more>>" to "...".
 */
function life_excerpt_more($more) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'life_excerpt_more');

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
 * Add featured image and "currently listening" to RSS feed content or excerpt
 */
function life_rss_feed_excerpt( $content ) {

	global $post, $wp_query;

	$prepend = null;
	$append = null;

	$email = wp_kses_post( get_theme_mod('life_rss_email') );

	if ( $email ) {
		$append = '<hr/><p><a href="mailto:' . $email . '?subject=Reply%3A%20' . esc_attr( get_the_title() ) . '">' . esc_html__( 'Reply via email ', 'life' ) . '</a></p>';
	}

	if ( ! $wp_query->is_comment_feed() ) {

		if ( has_post_thumbnail( $post->ID ) ) {

			$prepend = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 16px;' ) ) . '</div>';
		}

		if ( function_exists( 'get_field' ) ) {
			$song = get_field('song_link');

			if ( $song ):
				$artist = get_field('song_artist');
				$song_url = $song['url'];
				$song_title = $song['title'];
				$song_target = $song['target'] ? $song['target'] : '_self';
				$content .= '<p class="song-link"><span class="label">' . esc_html__( 'Currently Listening: ', 'life' ) . $artist . ' “<a class="button" href="' . esc_url( $song_url ) . '" target="' . esc_attr( $song_target ) . '">' . esc_html( $song_title ) . '</a>”</p>';
			endif;
		}

		$content = $prepend . $content . $append;

	}

	return $content;

}
add_filter('the_content_feed', 'life_rss_feed_excerpt');
add_filter('the_excerpt_rss', 'life_rss_feed_excerpt');


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