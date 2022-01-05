<?php
/**
 * The template for displaying attachments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#attachment
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'attachment' );

			// Links to associated post
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-title">%title</span> <span class="icon-arrow icon-arrow-right" aria-hidden="true"></span>',
				)
			);

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
