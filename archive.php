<?php
/**
 * The template for displaying archive pages
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

			<div class="grid-container">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					if ( is_home() ) :
						get_template_part( 'template-parts/content' );
					elseif ( ( 'life_character' === get_post_type() ) || ( 'life_favorite' === get_post_type() ) ) :

						// create a new .grid-container every 15 items
						if ( ( 0 !== $wp_query->current_post ) && ( 0 === $wp_query->current_post % 15 ) ) :
							echo '</div><div class="grid-container">';
						endif;

						get_template_part( 'template-parts/thumbnail' );
					elseif ( 'life_bookmark' === get_post_type() ) :
						get_template_part( 'template-parts/card-landscape' );
					else :
						get_template_part( 'template-parts/card' );
					endif;

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
