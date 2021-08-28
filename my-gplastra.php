<?php
/**
 * Plugin Name: My GPLAstra
 * Plugin URI: https://www.gplastra.com
 * Description: A Special & Custom Plugin for GPLAstra to add custom snippets, codes or functions.
 * Version: 1.0
 * Author: GPLAstra
 * Author URI: https://www.gplastra.com
 */

// Display Shortcode Content After WooCommerce Short Description

add_filter('woocommerce_short_description', function ($description) {
	if (! is_product()) { return; }   
	return $description.do_shortcode('[mbv name="product-info"]');
});

// Enable Gutenberg in WooCommerce
function activate_gutenberg_product( $can_edit, $post_type ) {

    if ( $post_type == 'product' ) {
        $can_edit = true;
    }
    return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );
