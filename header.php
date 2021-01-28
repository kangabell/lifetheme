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
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			?>
		</div><!-- .site-branding -->

		<nav class="desktop-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'desktop-menu',
				'depth'			  => 1,
			) );
			?>
		</nav>

		<div class="desktop-search">
			<?php
			get_search_form();
			?>
		</div>

		<nav id="site-navigation" class="main-navigation menu">
			<button class="icon-button menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="icon"></span>
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
	</header><!-- #masthead -->
