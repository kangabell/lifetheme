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
				if ( 'life_project' === get_post_type() ) :
					dynamic_sidebar( 'header-projects' );
				elseif ( 'life_character' === get_post_type() ) :
					dynamic_sidebar( 'header-characters' );
				elseif ( 'pinboard-bookmark' === get_post_type() ) :
					dynamic_sidebar( 'header-pins' );
				elseif ( 'life_favorite' === get_post_type() ) :
					dynamic_sidebar( 'header-favorites' );
				endif;
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				if ( 'post' === get_post_type() ) :
					get_template_part( 'template-parts/content' );
				elseif ( 'life_character' || 'life_favorite' === get_post_type() ) :
					get_template_part( 'template-parts/thumbnail' );
				else :
					get_template_part( 'template-parts/card' );
				endif;

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
