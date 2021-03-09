<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( (is_home()) && (! is_paged()) ) :
				?>
				<header class="page-header">
					<?php
					dynamic_sidebar( 'header-posts' );
					?>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation( array(
				'prev_text' => __( '<span class="icon-arrow icon-arrow-left" aria-hidden="true"></span><span class="screen-reader-text">Older Posts</span>' ),
				'next_text' => __( '<span class="screen-reader-text">Newer Posts</span><span class="icon-arrow" aria-hidden="true"></span>' ),
			));

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- .site-main -->

<?php
get_footer();
