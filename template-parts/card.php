<?php
$thumbnail_url = get_the_post_thumbnail_url();

if ( 'life_bookmark' === get_post_type() ) :
	$url = get_post_meta( get_the_ID(), 'life_url', true );
else :
	$url = get_permalink();
endif;
?>

<a class="card card_default" href="<?php echo $url; ?>" <?php if ( 'life_bookmark' === get_post_type() ) { echo 'target="_blank"'; } ?>>
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
		<img src="<?php echo get_template_directory_uri() . '/library/missing.png'; ?>" alt="<?php esc_html__( 'Image Missing', 'life' ); ?>" />
	<?php
	endif;
	?>

	<div class="text">
		<?php
		the_title( '<h3>', '</h3>' );

		if ( 'life_bookmark' === get_post_type() ) :

			if (! is_front_page()) :
				$content = get_the_content();
				$content_clean = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $content);
				echo '<div class="excerpt">' . $content_clean . '</div>';
			endif;

			$domain = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
			echo '<p class="meta">' . $domain . '<span class="icon-exit"></span></p>';

		elseif ( ('life_project' === get_post_type()) && (! is_singular('life_character')) && (! is_front_page()) ) :
		?>
			<div class="excerpt"><?php the_excerpt(); ?></div>
		<?php
		else :

			the_date('F j, Y', '<p class="meta">', '</p>');

		endif;
		?>
	</div>
</a>