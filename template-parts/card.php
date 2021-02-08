<a class="card" href="<?php echo get_permalink(); ?>">
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
		the_date('F j, Y', '<p>', '</p>');
		?>
	</div>
</a>