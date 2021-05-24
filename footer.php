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
			<div class="buttons">
				<button type="button" data-action="aria-switch" aria-label="Toggle Dark Mode" aria-checked="false" role="switch" class="toggle-mode">
					<span class="icon-sun"></span>
					<span class="icon-moon"></span>
				</button>
				<a class="back-to-top" href="#page">
					<span class="icon-arrow icon-arrow-up" aria-hidden="true"></span>
					<?php esc_html_e( 'Up', 'life' ); ?>
				</a>
			</div>
		</div>
		<div class="site-info">
			<?php echo wp_kses_post( get_theme_mod('life_subfooter') ); ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
