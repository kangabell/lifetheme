<?php
if ( 'pinboard-bookmark' === get_post_type() ) :
	$url = get_post_meta( get_the_ID(), 'url', true );
else :
	$url = get_permalink();
endif;
?>

<a class="card" href="<?php echo $url; ?>" <?php if ( 'pinboard-bookmark' === get_post_type() ) { echo 'target="_blank"'; } ?>>
	<?php
	if ( has_post_thumbnail() ) :
		the_post_thumbnail( 'medium_square', array( 'alt' => get_the_title() ) );
	else :
	?>
		<img src="<?php echo get_template_directory_uri() . '/library/missing.png'; ?>" alt="<?php esc_html__( 'Image Missing', 'life' ); ?>" />
	<?php
	endif;
	?>

	<div class="text">
		<?php
		the_title( '<h3>', '</h3>' );

		if ( 'life_project' === get_post_type() ) :

			the_excerpt();

		elseif ( 'pinboard-bookmark' === get_post_type() ) :

			$content = get_the_content();
			$content_clean = preg_replace('#<a.*?>(.*?)</a>#i', '\1', $content);
			echo $content_clean;

			$domain = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));
			echo '<p class="meta">' . $domain . '</p>';

		else :

			the_date('F j, Y', '<p class="meta">', '</p>');

		endif;
		?>
	</div>
</a>