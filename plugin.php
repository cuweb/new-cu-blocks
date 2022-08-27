<?php
/**
 * Plugin Name:       CU Blocks
 * Description:       Example static block scaffolded with Create Block tool.
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       _test
 *
 * @package           create-block
 */


/**
 * Add script to the block editor.
 * https://soderlind.no/hide-block-styles-in-gutenberg/
 */
function remove_block_style() {
	wp_register_script( 'block-config', plugin_dir_url(__DIR__) . 'cu-blocks/js/block-config.js', [ 'wp-blocks', 'wp-edit-post' ] ); // Register the block editor script.
	register_block_type( 'remove/block-style', ['editor_script' => 'block-config'] ); // register block editor script.
}
add_action( 'init', 'remove_block_style' );


/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_test_block_init() {
	register_block_type( __DIR__ . '/build/block-one' );
	register_block_type( __DIR__ . '/build/block-two' );
	register_block_type( __DIR__ . '/build/block-three' );
}
add_action( 'init', 'create_block_test_block_init' );
