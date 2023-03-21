<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

get_header();

if ( is_tax( 'life_bookmark_type' ) ) :
	$container_class = 'narrow-container';
else :
	$container_class = 'grid-container';
endif;
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				if ( is_category() ) :
				?>
					<div class="widget">
						<?php
						life_archive_header();
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</div>
				<?php
				else :
					life_archive_header();
					life_archive_submenu();
				endif;
				?>
			</header><!-- .page-header -->

			<div class="<?php echo $container_class; ?>">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					if ( is_home() ) :
						get_template_part( 'template-parts/content' );
					elseif ( ( 'life_character' === get_post_type() ) || ( 'life_favorite' === get_post_type() ) ) :

						// create a new .grid-container every 15 items
						if ( ( 0 !== $wp_query->current_post ) && ( 0 === $wp_query->current_post % 15 ) ) :
							echo '</div><div class="' . $container_class . '">';
						endif;

						get_template_part( 'template-parts/thumbnail' );
					elseif ( is_tax( 'life_bookmark_type' ) ) :
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

		if ( is_tax( 'life_bookmark_type' ) ) :
		?>
			<div class="secondary-content">
				<?php dynamic_sidebar( 'bookmarks-secondary' ); ?>
			</div>
		<?php
		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
