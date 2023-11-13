<?php 

function storefront_child_setup() {
  /*
  * - Support alignwide images.
  * - Custom image crop. 
  * - Enable support for Post Thumbnails on posts and pages.
  */
  add_theme_support( 'alignwide' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'custom-logo',
  array(
    'height'      => 300,
    'width'       => 200,
    'flex-width'  => true,
    'flex-height' => true,
  ));
  
  // Custom Image Crops
  add_image_size( 'thumbnail-icon', 100, 100, true );

  // Custom Menus
  register_nav_menus(
		array(
			'header-menu' => esc_html__( 'Header Menu', 'calido' ),
			'cta-menu' => esc_html__( 'CTA Menu', 'calido' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'calido' ),
			'socials-menu' => esc_html__( 'Socials Menu', 'calido' ),
		)
	);


}
add_action('after_setup_theme', 'storefront_child_setup');

function calido_enqueues() {
 
  wp_enqueue_style( 'calido-font', '<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">' ); 

  if(is_page('33')){
    wp_enqueue_script( 'calido-home', get_theme_file_uri('js/calido-home.js'), '', '', true );
  }
}
add_action('wp_enqueue_scripts', 'calido_enqueues');

// Disable WooCommerce search bar 
function wc_disable_search() {
  if ( function_exists( 'WC' ) && ! is_admin() && is_search() && 
  isset( $_GET['post_type'] ) &&  $_GET['post_type'] == 'product' ) {
    wp_redirect( home_url() );
    exit;
  }
}
add_action( 'template_redirect', 'wc_disable_search' );

// Disables Gutenberg on speficic pages:
add_action('admin_init', function () {
  if (array_key_exists('post', $_GET) || array_key_exists('post_ID', $_GET)) {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if (!isset($post_id)) {
      return;
    }
    $title = get_the_title($post_id);
    if ($title == 'Homepage') {
      remove_post_type_support('page', 'editor');
    }
  }
}, 10);

/* WooCommerce Action Overwrites */
function calido_woo_overwrites(){
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
  remove_action( 'woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30 );
  remove_action( 'storefront_header', 'storefront_header_cart', 60 );
  remove_action( 'storefront_header', 'storefront_product_search', 40);
  add_filter( 'woocommerce_is_purchasable', '__return_false');
  remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
  
  // Remove Breadcrumbs if not in the shop page
  remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );

  // Remove product sorting
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );

  // Hide SKU on product details
  add_filter( 'wc_product_sku_enabled', '__return_false' );
   
}
add_action('init', 'calido_woo_overwrites');

/* Replace Add to Cart text on product CTA */
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single' ); 
function woocommerce_add_to_cart_button_text_single() {
    return __( 'See Details', 'woocommerce' ); 
}

add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );  

function woocommerce_add_to_cart_button_text_archives() {
    return __( 'See Details', 'woocommerce' );
}

// Customise available blocks on specific pages
function calido_allowed_post_type_blocks( $allowed_block_types, $editor_context ) {
	if ( 'page' === $editor_context->post->post_type){ 
    if('2' == $_GET['post'] ) {
      return array(
        'core/paragraph',
        'core/heading',
        'core/media-text',
        'core/image',
        'core/buttons',
        'core/spacer',
      );
    }
    if('150' == $_GET['post'] ) {
      return array(
        'core/paragraph',
        'core/heading',
        'core/shortcode',
        'core/image',
        'core/media-text',
        'core/buttons',
        'core/spacer',
      );
    }

}

	return $allowed_block_types;
}

add_filter( 'allowed_block_types_all', 'calido_allowed_post_type_blocks', 10, 2 );

// Remove Footer Handheld Menu
function calido_remove_handheld_footer_links( $links ) {
	unset( $links['my-account'] );
	unset( $links['search'] );
	unset( $links['cart'] );

	return $links;
}
add_filter( 'storefront_handheld_footer_bar_links', 'calido_remove_handheld_footer_links' );


// Rename "home" in breadcrumb
function wcc_change_breadcrumb_home_text( $defaults ) {
	$defaults['home'] = 'Calido Home';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text', 20 );
