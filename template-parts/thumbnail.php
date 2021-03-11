<a class="thumbnail" href="<?php echo get_permalink(); ?>">
	<?php
	if ( has_post_thumbnail() ) :
		the_post_thumbnail( 'small_square' );
	else :
	?>
		<img src="<?php echo get_template_directory_uri() . '/library/missing.png'; ?>" alt="<?php esc_html__( 'Image Missing', 'life' ); ?>" />
	<?php
	endif;
	?>
</a>