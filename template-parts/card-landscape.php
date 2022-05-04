<?php
/**
 * Alternate card style, used for Links
 */

$thumbnail_url = get_the_post_thumbnail_url();
$url = get_post_meta( get_the_ID(), 'life_url', true );

?>

<div class="card card_landscape">

	<div class="text">
		<a class="link" href="<?php echo $url; ?>" target="_blank"><?php the_title( '<h3>', '</h3>' ); ?> </a>
		<?php
		echo '<div class="excerpt">' . get_the_content() . '</div>';

		$domain = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
		echo '<p class="meta">' . $domain . '<span class="icon-exit"></span></p>';
		?>
	</div>

	<?php
	if ( $thumbnail_url ) :

		// don't resize gif's, so we retain their animations
		if ( str_ends_with( $thumbnail_url, '.gif' ) ) {
			the_post_thumbnail( 'full' );
		} else {
			the_post_thumbnail( 'medium_square' );
		}
	else :
	?>
		<img src="<?php echo get_stylesheet_directory_uri() . '/library/missing-small_square.png'; ?>" alt="<?php esc_html__( 'Image Missing', 'life' ); ?>" class="wp-post-image" />
	<?php
	endif;
	?>
</div>