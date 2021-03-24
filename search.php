<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					the_search_query();
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="grid-container">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :

					the_post();

					get_template_part( 'template-parts/card' );

				endwhile;
				?>
			</div>

			<?php
			/* 'Previous' and 'Next' are swapped, to be more intuitive */
			the_posts_navigation( array(
				'prev_text' => __( '<span class="nav-title">Next</span><span class="icon-arrow icon-arrow-right" aria-hidden="true"></span>' ),
				'next_text' => __( '<span class="icon-arrow icon-arrow-left" aria-hidden="true"></span><span class="nav-title">Previous</span>' ),
			));

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
