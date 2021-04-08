<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

		<div class="latest-content">
			<?php
			$query = new WP_Query( array(
				'post_type' => 'life_project',
				'posts_per_page' => 3,
			) );
			?>

			<?php
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post();
					get_template_part( 'template-parts/card' );
				endwhile;
			endif;
			wp_reset_query();

			echo '<nav class="navigation archive-link"><a href="' . get_post_type_archive_link( 'life_project' ) . '"><span class="nav-title">' . esc_html__( 'View Projects', 'life' ) . '</span> <span class="icon-arrow icon-arrow-right" aria-hidden="true"></span></a></nav>';
			?>
		</div> <!-- .latest-content -->

		<div class="secondary-content">
			<?php dynamic_sidebar( 'home-secondary' ); ?>
		</div>

	</main><!-- #main -->

<?php
get_footer();
