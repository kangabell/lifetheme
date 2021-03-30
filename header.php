<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Life
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'life' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="wrap">
			<div class="site-identity">
				<?php
				if ( is_front_page() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;

				$life_description = get_bloginfo( 'description', 'display' );
				if ( $life_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $life_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php
				endif;
				?>
			</div> <!-- .site-identity -->

			<?php
			$post_type = get_post_type();
			$post_type_name = get_post_type_object( $post_type )->labels->name;
			if ( ( ! is_page() ) && ( ! is_search() ) && ( ! is_404() ) ) :
				echo '<p class="breadcrumb"><a href="' . get_post_type_archive_link( $post_type ) . '">' . $post_type_name . '</a></p>';
			endif;

			$menu_desktop = wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'desktop-menu',
				'depth'			 => 1,
				'echo'           => FALSE,
				'fallback_cb'    => '__return_false'
			) );

			if ( ! empty ( $menu_desktop ) ) :
				echo '<nav class="desktop-navigation">' . $menu_desktop . '</nav>';
			endif;
			?>

			<div class="desktop-search">
				<?php
				get_search_form();
				?>
			</div>

			<nav id="site-navigation" class="main-navigation">
				<button class="icon-button menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="icon" aria-hidden="true"></span>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'life' ); ?></span>
				</button>
				<div class="main-nav-container">
					<?php
					get_search_form();
					wp_nav_menu( array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'container_class' => 'main-menu-container',
						'depth'			  => 1,
					) );
					?>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->
