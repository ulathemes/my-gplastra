<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
});
// Remove Quantity Option
function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );
// Display Shortcode's Content After WooCommerce Product Summary
add_action( 'woocommerce_after_single_product_summary', 'my_content', 5 );
function my_content() {
  print do_shortcode ( '[mbv name="product-info"]' );
}
// Enable Gutenberg in WooCommerce
function activate_gutenberg_product( $can_edit, $post_type ) {

    if ( $post_type == 'product' ) {
        $can_edit = true;
    }
    return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );
// Display Shortcode's Content After Blocksy WooCommerce Product Title
add_action( 'blocksy:woocommerce:product-card:title:after', 'my_zshcontent', 5 );
function my_zshcontent() {
  print do_shortcode ( '[mbv name="shop-archive-page-at-card-info"]' );
}

add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
	add_filter( 'use_widgets_block_editor', '__return_false' );

// Turn on Option By Default 
function cs_wc_product_type_options( $product_type_options ) {
    $product_type_options['virtual']['default'] = 'yes';
    $product_type_options['downloadable']['default'] = 'yes';	

    return $product_type_options;
}
add_filter( 'product_type_options', 'cs_wc_product_type_options' );
