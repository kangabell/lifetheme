<?php
/**
 * The template for displaying the Bookmark archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				life_archive_header();
				life_archive_submenu();
				?>
			</header><!-- .page-header -->

			<div class="narrow-container">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/card-landscape' );
				endwhile;
				?>

			</div>

			<?php

			life_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
