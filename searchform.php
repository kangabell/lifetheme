<form class="search-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<label class="screen-reader-text" for="s"><?php echo _x( 'Search for:', 'label' ) ?></label>
	<input type="search" class="search-field" value="<?php echo get_search_query() ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search', 'label' ) ?>" />
	<button type="submit" class="icon-button">
		<span class="icon-search"></span>
		<span class="screen-reader-text">Submit</span>
	</button>
</form>