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
	wp_register_script( 'remove-block-style', plugin_dir_url(__DIR__) . 'cu-blocks/js/remove-block-styles.js', [ 'wp-blocks', 'wp-edit-post' ] ); // Register the block editor script.
	register_block_type( 'remove/block-style', ['editor_script' => 'remove-block-style'] ); // register block editor script.
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


/**
 * Specify allowed core blocks
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 * @see https://rudrastyh.com/gutenberg/remove-default-blocks.html
 *
 */
function set_allowed_blocks( $allowed_blocks, $editor_context ) {
	// Register core blocks
    $core_blocks = [
        // 'core/embed',
        'core/gallery',
        'core/heading',
        'core/image',
        'core/list',
        'core/paragraph',
        'core/quote',
        'core/table',
    ];

    // Register custom blocks
    $custom_blocks = [
        'cu-block/block-one',
        'cu-block/block-two',
        'cu-block/block-three'
    ];

    // Register admin specific blocks
    $admin_blocks = [];
    if (current_user_can('administrator')) {
        $admin_blocks = ['core/html', 'core/shortcode', 'core/code'];
    }

    // Register plugin specific blocks
    $plugin_blocks = [
		// 'gravityforms/form'
	];

    // Build final blocks
    $allowed_blocks = array_merge(
        $core_blocks,
        $custom_blocks,
        $admin_blocks,
        $plugin_blocks
    );

    return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'set_allowed_blocks', 25, 2 );


/**
 * Remove code view for non-administrators
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 * @see https://developer.wordpress.org/reference/hooks/block_editor_settings_all/
 */
// function customEditorSettings($settings, $post)
// {
//     $settings['codeEditingEnabled'] = false;
//     if (current_user_can('administrator')) {
//         $settings['codeEditingEnabled'] = false;
//     }

//     return $settings;
// }
// add_filter('block_editor_settings_all', 'customEditorSettings', 10, 2);
