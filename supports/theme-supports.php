<?php
/**
 * Remove / Customize Block Inspector Elements
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
 */
// add_theme_support('disable-custom-font-sizes'); // Disable manually entered font sizes
// add_theme_support( 'editor-font-sizes', [] );
// add_theme_support('disable-custom-colors'); // Disable custom color options
// add_theme_support('editor-color-palette'); // Remove color picker

/**
 * Disable gutenberg front end styles
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 */
// function dequeue_gutenberg_library()
// {
//     wp_dequeue_style('wp-block-library'); // Wordpress core
//     wp_dequeue_style('wp-block-library-theme'); // Wordpress core
//     wp_dequeue_style('wc-block-style'); // WooCommerce
//     wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
// }
// add_action('wp_print_styles', 'dequeue_gutenberg_library', 100);

/**
 * Remove core block patterns
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 * @see https://wpblockz.com/tutorial/remove-default-block-patterns-from-wordpress/
 */
// function my_remove_patterns() {
//    remove_theme_support( 'core-block-patterns' );
// }
// add_action( 'after_setup_theme', 'my_remove_patterns' );
