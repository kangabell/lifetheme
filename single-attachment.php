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

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
