<?php
// Disable Gutenberg in Widgets
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
	add_filter( 'use_widgets_block_editor', '__return_false' );

// Disable Jetpack Blocks in Gutenberg 
add_filter( 'jetpack_gutenberg', '__return_false' );
