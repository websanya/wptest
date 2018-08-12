<?php
/**
 * Enqueue parent style.
 */
add_action( 'wp_enqueue_scripts', 'wptest_child_scripts' );
function wptest_child_scripts() {
	wp_enqueue_style( 'wptest-child-style', get_template_directory_uri() . '/style.css' );
}

/**
 * Function to add text shortcode to posts and pages
 */
add_shortcode('wptest_hello', 'wptest_text_shortcode');
function wptest_text_shortcode(){
	return '<div class="test-shortcode">Hello World!</div>';
}