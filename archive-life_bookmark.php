<?php
/**
 * The template for displaying the Bookmark archive page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query = new WP_Query( array(
	'post_type' => 'life_bookmark',
	'posts_per_page' => 20,
	'paged' => $paged,
) );

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( $query->have_posts() ) : ?>

			<header class="page-header">
				<?php
				life_archive_header();
				life_archive_submenu();
				?>
			</header><!-- .page-header -->

			<div class="narrow-container">

				<?php
				while ( $query->have_posts() ) : $query->the_post();
					get_template_part( 'template-parts/card-landscape' );
				endwhile;
				?>

			</div>

			<?php

			life_pagination();

			wp_reset_query();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
