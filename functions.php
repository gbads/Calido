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

}
add_action('after_setup_theme', 'storefront_child_setup');

function calido_enqueues() {
  wp_enqueue_script( 'jquery-masonry' );
  if(is_page('33')){
    wp_enqueue_script( 'calido-scripts', get_theme_file_uri('js/calido-scripts.js'), '', '', true );
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
    if ($title == 'Homepage' || $title == 'About') {
      remove_post_type_support('page', 'editor');
    }
  }
}, 10);

/* WooCommerce Action Overwrites */
function calido_woo_overwrites(){
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
  remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
  remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
  remove_action( 'woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30 );
  remove_action( 'storefront_header', 'storefront_header_cart', 60 );
}
add_action('init', 'calido_woo_overwrites');

/**
 * Replaces the Add To Cart button with a new button with custom text and a custom URL link
 * This will affect all products site-wide
 * You can change the style of the button by using CSS on p.zpd-wc-reserve-item-button{}
 *
 * @author Wil Brown zeropointdevelopment.com
 */
function calido_replace_add_to_cart_button() {
	global $product;

	// This adds some URL query variables that may be useful to input into a contact form - remove if not needed
	$product_link_params = sprintf( '?wc_id=%s&wc_price=%s&wc_title=%s&wc_product_link=%s',
		$product->get_id(),
		$product->get_display_price(),
		$product->get_title(),
		$product->get_permalink()
	);
	$button_text = 'Inquire Now';
	$link = 'mailto:email@email.com';


	echo '<p class="calido-product-button">';
	echo do_shortcode('<a  href="'.$link.'" class="button addtocartbutton">' . $button_text . '</a>');
	echo '</p>';
}
add_action( 'woocommerce_after_shop_loop_item','calido_replace_add_to_cart_button' );



//   add_action( 'wp', 'bbloomer_remove_default_sorting_storefront' );
  
//   function bbloomer_remove_default_sorting_storefront() {
//     remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
//     remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
//   }
//   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//   remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//   remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );

  // add_filter( 'woocommerce_product_tabs', 'my_remove_all_product_tabs', 98 );
 
//   function my_remove_all_product_tabs( $tabs ) {
//     // unset( $tabs['description'] );        // Remove the description tab
//     unset( $tabs['reviews'] );       // Remove the reviews tab
//     unset( $tabs['additional_information'] );    // Remove the additional information tab
//     return $tabs;
//   }

 // Move the Price below the excerpt on single Product posts
//   remove_action(
//     'woocommerce_single_product_summary', // value in do_action()
//     'woocommerce_template_single_price', // function name
//     10 // priority 
//   );
//   add_action(
//     'woocommerce_single_product_summary', // do_action() value
//     'woocommerce_template_single_price', // function name
//     21 // priority 
//   );
