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
