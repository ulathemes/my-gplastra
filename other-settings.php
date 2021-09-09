<?php
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
