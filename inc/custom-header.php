<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Life
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses life_header_style()
 */
function life_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'life_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'life_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'life_custom_header_setup' );

if ( ! function_exists( 'life_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see life_custom_header_setup().
	 */
	function life_header_style() {
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php endif; ?>
		</style>
		<?php
	}
endif;

/**
 * Styles the link text color
 *
 * @see life_customize_register().
 */
function life_custom_colors() {
	$link_color = get_option('link_color');
	$link_color_dark = get_option('link_color_dark');
	?>

	<style type="text/css">

		:root {
			--color__link: <?php echo esc_attr( $link_color ); ?>;
		}

		.dark {
			--color__link: <?php echo esc_attr( $link_color_dark ); ?>;
		}

		@media (prefers-color-scheme: dark) {

			html:not(.light) {
				--color__link: <?php echo esc_attr( $link_color_dark ); ?>;
			}
		}

	</style>

	<?php
}
add_action('wp_head', 'life_custom_colors');
