<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Life
 */

if ( ! function_exists( 'life_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function life_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo $time_string;

	}
endif;

if ( ! function_exists( 'life_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function life_entry_footer() {

		if ( 'post' === get_post_type() ) {

			if ( function_exists( 'get_field' ) ) {
				$artist = get_field('song_artist');
				$song = get_field('song_link');

				if ( $song ):
					$song_url = $song['url'];
					$song_title = $song['title'];
					$song_target = $song['target'] ? $song['target'] : '_self';
					echo '<p class="song-link"><span class="label">' . esc_html__( 'Currently Listening', 'life' ) . ' </span><span class="icon-music" aria-hidden="true"></span><span class="content">“<a class="button" href="' . esc_url( $song_url ) . '" target="' . esc_attr( $song_target ) . '">' . esc_html( $song_title ) . '</a>” ' . $artist . '<span></p>';
				endif;
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'life' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'life' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'life_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function life_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail(); ?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'life_pagination' ) ) :
	/**
	 * Custom pagination.
	 *
	 * Displays numbered pagination along with previous/next links, with the
	 * "previous" and "next" swapped from WordPress default to be more intuitive
	 */
	function life_pagination( $args = [], $class = 'pagination' ) {

		if ($GLOBALS['wp_query']->max_num_pages <= 1) return;

		$args = wp_parse_args( $args, [
			'mid_size'           => 3,
			'prev_next'          => false,
			'prev_text'          => '<span class="nav-title">Next</span><span class="icon-arrow icon-arrow-right" aria-hidden="true"></span>',
			'next_text'          => '<span class="icon-arrow icon-arrow-left" aria-hidden="true"></span><span class="nav-title">Previous</span>',
			'screen_reader_text' => __('Posts Navigation', 'life'),
		]);

		$links     = paginate_links($args);
		$next_link = get_previous_posts_link( $args['next_text'] );
		$prev_link = get_next_posts_link( $args['prev_text'] );

		$template  = apply_filters( 'life_pagination_template', '
			<nav class="%1$s">
				<h2 class="screen-reader-text">%2$s</h2>
				<div class="nav-links"><div class="nav-next">%3$s</div><div class="pagination-numbers">%4$s</div><div class="nav-previous">%5$s</div></div>
			</nav>',
			$args,
			$class
		);

		echo sprintf($template, $class, $args['screen_reader_text'], $next_link, $links, $prev_link);
	}
endif;

if ( ! function_exists( 'life_archive_header' ) ) :
	/**
	 * Custom archive headers.
	 */
	function life_archive_header() {

		if ( 'life_project' === get_post_type() ) :
			dynamic_sidebar( 'header-projects' );
		elseif ( 'life_character' === get_post_type() ) :
			dynamic_sidebar( 'header-characters' );
		elseif ( 'life_bookmark' === get_post_type() ) :
			dynamic_sidebar( 'header-bookmarks' );
		elseif ( 'life_favorite' === get_post_type() ) :
			dynamic_sidebar( 'header-favorites' );
		elseif ( is_tag() ) :
			single_term_title( '<h1 class="page-title">', '</h1>' );
		else :
			the_archive_title( '<h1 class="page-title">', '</h1>' );
		endif;
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
