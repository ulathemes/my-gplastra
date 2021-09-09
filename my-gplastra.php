<?php
/**
 * Plugin Name: My GPLAstra
 * Plugin URI: https://www.gplastra.com
 * Description: A Special & Custom Plugin for GPLAstra to add custom snippets, codes or functions.
 * Version: 1.0
 * Author: GPLAstra
 * Author URI: https://www.gplastra.com
 */
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

// Disable Jetpack Blocks in Gutenberg 
add_filter( 'jetpack_gutenberg', '__return_false' );
// Turn on Option By Default 
function cs_wc_product_type_options( $product_type_options ) {
    $product_type_options['virtual']['default'] = 'yes';
    $product_type_options['downloadable']['default'] = 'yes'; 

    return $product_type_options;
}
add_filter( 'product_type_options', 'cs_wc_product_type_options' );
// Show Details on Updates Page
add_action( 'blocksy:loop:card:end', 'my_zsshcontent', 5 );
function my_zsshcontent() {
 if (is_page('updates')) {
  print do_shortcode ( '[mbv name="shop-archive-page-at-card-info"]' );
}
}
//Show Custom Taxonomies Via Shortcode
// First we create a function
function list_terms_custom_taxonomy( $atts ) {
 
// Inside the function we extract custom taxonomy parameter of our shortcode
 
    extract( shortcode_atts( array(
        'custom_taxonomy' => '',
    ), $atts ) );
 
// arguments for function wp_list_categories
$args = array( 
taxonomy => $custom_taxonomy,
title_li => ''
);
 
// We wrap it in unordered list 
echo '<ol>'; 
echo wp_list_categories($args);
echo '</ol>';
}
 
// Add a shortcode that executes our function
add_shortcode( 'ct_terms', 'list_terms_custom_taxonomy' );
 
//Allow Text widgets to execute shortcodes
 
add_filter('widget_text', 'do_shortcode');

// New
