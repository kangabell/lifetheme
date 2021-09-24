<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		life_post_thumbnail();

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="meta">
				<?php
				life_posted_on();
				?>
			</div><!-- .meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

		if ( function_exists( 'get_field' ) ) {
			$note_sticky = get_field('note_sticky');
		}

		if ( $note_sticky ) :
			echo '<div class="note-sticky">' . $note_sticky . '</div>';
		endif;

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

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'life' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		life_entry_footer();

		if ( function_exists( 'get_field' ) ) {
			$related_posts = get_field('characters_posts');
		}

		if ( $related_posts ) :
		?>
			<div class="related-posts">

				<?php
				if ( 'life_character' === get_post_type() ) :
					echo '<h2 class="heading-alt">' . esc_html__( 'Posts with ', 'life' ) . get_the_title() . '</h2>';
				?>

					<div class="grid-container">
						<?php
						foreach( $related_posts as $post ):
							setup_postdata($post);
							get_template_part( 'template-parts/card' );
						endforeach;
						?>
					</div>

				<?php
				else :

					if ( 'life_project' === get_post_type() ) :
						echo '<h2 class="heading-alt">' . esc_html__( 'Cohorts', 'life' ) . '</h2>';
					else :
						echo '<h2 class="heading-alt">' . esc_html__( 'Cast of Characters', 'life' ) . '</h2>';
					endif;
				?>
					<div class="flex-container">
						<?php
						foreach( $related_posts as $post ):
							setup_postdata($post);
							get_template_part( 'template-parts/thumbnail' );
						endforeach;
						?>
					</div>
				<?php
				endif;
				?>

			</div> <!-- .related-posts -->

			<?php
			wp_reset_postdata();

		endif;
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
