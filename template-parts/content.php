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

	<?php life_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				life_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
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

		$related_posts = get_field('characters_posts');

		if ( $related_posts ) :

			if ( 'life_project' === get_post_type() ) :
				echo '<h2>' . esc_html__( 'Cohorts', 'life' ) . '</h2>';

			elseif ( 'life_character' === get_post_type() ) :
				echo '<h2>' . esc_html__( 'Posts with ', 'life' ) . get_the_title() . '</h2>';

			else :
				echo '<h2>' . esc_html__( 'Cast of Characters', 'life' ) . '</h2>';
			endif;
			?>

			<div class="grid-container">
				<?php
				foreach( $related_posts as $post ):
					setup_postdata($post);

					if ( is_singular( 'life_character' ) ) :
						get_template_part( 'template-parts/card' );
					else :
						get_template_part( 'template-parts/thumbnail' );
					endif;
				endforeach;
				?>
			</div>

			<?php
			wp_reset_postdata();

		endif;
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
