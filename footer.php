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
		<nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'desktop-menu',
				)
			);
			?>
		</nav>
		<a href="#masthead"><?php esc_html_e( 'Up', 'life' ); ?></a>
		<div class="site-info">
			<?php
			echo '&copy;' . date('Y') . ' ';
			bloginfo( 'name' );
			?>
			<span class="sep"> / </span>
			<a href="https://kangabell.co/" target="_blank">Kay Belardinelli</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
