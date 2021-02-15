<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Life
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="wrap">
			<nav class="footer-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-3',
					'menu_id'        => 'footer-menu',
					'depth'			  => 1,
				) );
				?>
			</nav>
			<a class="back-to-top" href="#page">
				<span class="icon-arrow"></span>	
				<?php esc_html_e( 'Up', 'life' ); ?>
			</a>
			<div class="site-info">
				<?php
				echo '&copy;' . date('Y') . ' ';
				bloginfo( 'name' );
				?>
				<span class="sep"> / </span>
				<a href="https://kangabell.co/" target="_blank">Kay Belardinelli</a>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
