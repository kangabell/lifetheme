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
			<div>
				<h2 class="heading-alt"><?php esc_html_e( 'Recent Snapshot', 'life' ); ?></h2>
				<?php
				$query = new WP_Query( array(
					'post_type' => 'post',
					'posts_per_page' => 1,
				) );
				?>

				<?php
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
						get_template_part( 'template-parts/card' );
					endwhile;
				endif;
				wp_reset_query();
				?>
			</div>
			<div>
				<h2 class="heading-alt"><?php esc_html_e( 'Latest Link', 'life' ); ?></h2>
				<?php
				$query = new WP_Query( array(
					'post_type' => 'pinboard-bookmark',
					'posts_per_page' => 1,
				) );
				?>

				<?php
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
						get_template_part( 'template-parts/card' );
					endwhile;
				endif;
				wp_reset_query();
				?>
			</div>
			<div>
				<h2 class="heading-alt"><?php esc_html_e( 'Currently Digging', 'life' ); ?></h2>
				<?php
				$query = new WP_Query( array(
					'post_type' => 'life_favorite',
					'posts_per_page' => 1,
				) );
				?>

				<?php
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
						get_template_part( 'template-parts/card' );
					endwhile;
				endif;
				wp_reset_query();
				?>
			</div>
		</div> <!-- .latest-content -->

		<div class="secondary-content">
			<?php dynamic_sidebar( 'home-secondary' ); ?>
		</div>

	</main><!-- #main -->

<?php
get_footer();
