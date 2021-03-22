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
		<div class="wrap">

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

					echo '<nav class="navigation archive-link"><a href="' . get_post_type_archive_link( 'post' ) . '"><span class="nav-title">' . esc_html__( 'View Posts', 'life' ) . '</span> <span class="icon-arrow" aria-hidden="true"></span></a></nav>';
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

					echo '<nav class="navigation archive-link"><a href="' . get_post_type_archive_link( 'pinboard-bookmark' ) . '"><span class="nav-title">' . esc_html__( 'View Links', 'life' ) . '</span> <span class="icon-arrow" aria-hidden="true"></span></a></nav>';
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

					echo '<nav class="navigation archive-link"><a href="' . get_post_type_archive_link( 'life_favorite' ) . '"><span class="nav-title">' . esc_html__( 'View Favorites', 'life' ) . '</span> <span class="icon-arrow" aria-hidden="true"></span></a></nav>';
					?>
				</div>
			</div> <!-- .latest-content -->

			<div class="secondary-content">
				<?php dynamic_sidebar( 'home-secondary' ); ?>
			</div>

		</div>
	</main><!-- #main -->

<?php
get_footer();
