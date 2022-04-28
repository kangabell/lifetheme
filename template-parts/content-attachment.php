<?php
/**
 * Template part for displaying attachment content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php

		$attachment_id = get_the_ID();

		if ( wp_attachment_is_image( $attachment_id ) ) {

			// use large image size
			$attachment_image = wp_get_attachment_image($attachment_id, '', '', array('class' => 'post-thumbnail', 'size' => 'large', 'alt' => the_title_attribute(array('post'=>$attachment_id,'echo'=>0)) ) );

			echo '<div class="alignfull">' . $attachment_image . '</div>';

			the_title( '<h1 class="entry-title">', '</h1>' );

			echo '<div class="caption">' . get_the_excerpt() . '</div>';

		} else {

			the_title( '<h1 class="entry-title">', '</h1>' );

			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'life' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'life' ),
				'after'  => '</div>',
			)
		);

		?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
