<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'storefront_before_site' ); ?>
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'calido' ); ?></a>


<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
		<section class="nav-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
					if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
					<p class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
				$calido_description = get_bloginfo( 'description', 'display' );
					if ( $calido_description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $calido_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
			</div>
			<div class="calido-header-menu">
				<?php
					wp_nav_menu(
						array(
						'theme_location' => 'header-menu',
						'menu_id'        => 'desktop-menu',
						)
					);
				?>
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Menu
					</button>
					<div class="cta-menu">
						<?php
						wp_nav_menu(array('theme_location' => 'cta-menu'));
						?>
					</div>
					<div id="navigation-list" class="navigation-list">
					<?php
					wp_nav_menu(
						array(
						'theme_location' => 'header-menu'
						)
					);
					?>
					</div>
				
				</nav>
			</div>
		</section>

	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		do_action( 'storefront_content_top' );
