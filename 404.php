<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">

			<div class="featured-image">
				<img src="<?php echo get_template_directory_uri() . '/library/404.jpg'; ?>" alt="404 Error" />
			</div>

			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'This is unfortunate.', 'life' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'The page you are looking for is not in service. You might try using the search box. Additionally you can drop a note and let me know where things went wrong!', 'life' ); ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
