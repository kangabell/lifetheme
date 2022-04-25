<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			$post_type = get_post_type();
			$post_type_name = get_post_type_object( $post_type )->labels->name;

			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			if ( $post_type == 'post') :
			?>
				<div class="secondary-content">
					<?php dynamic_sidebar( 'post-secondary' ); ?>
				</div>
			<?php
			endif;

			/* 'Previous' and 'Next' are swapped, to be more intuitive */
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-title">%title</span> <span class="icon-arrow icon-arrow-right" aria-hidden="true"></span>',
					'next_text' => '<span class="icon-arrow icon-arrow-left" aria-hidden="true"></span> <span class="nav-title">%title</span>',
				)
			);

			echo '<nav class="navigation return-link"><a href="' . get_post_type_archive_link( $post_type ) . '"><span class="icon-arrow icon-arrow-left-double" aria-hidden="true"></span> <span class="nav-title">' . esc_html__( 'View All ', 'life' ) . $post_type_name . '</span></a></nav>';

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
