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
 */
function remove_block_style()
{
    wp_register_script(
        'block-config',
        plugin_dir_url(__FILE__) . '/src/script.js',
        [ 'wp-blocks', 'wp-edit-post' ]
    );
    register_block_type('remove/block-style', ['editor_script' => 'block-config']); // register block editor script.
}
add_action('init', 'remove_block_style');

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_test_block_init()
{
    register_block_type(__DIR__ . '/build/feature-card');
    register_block_type(__DIR__ . '/build/hero-image');
}
add_action('init', 'create_block_test_block_init');

/**
 * Add a block category for listings
 *
 * @param array $categories Array of block categories.
 *
 * @return array
 */
function gwg_block_categories($categories)
{
    $category_slugs = wp_list_pluck($categories, 'slug');
    return in_array('gwg', $category_slugs, true) ? $categories : array_merge(
        $categories,
        array(
            array(
                'slug'  => 'listings',
                'title' => 'Listings',
                'icon'  => null,
            ),
        )
    );
}
add_filter('block_categories', 'gwg_block_categories');

/**
 * Set allowed blocks
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 */
function set_allowed_blocks($final_blocks, $post)
{
    // Register core blocks
    $core_blocks = [
        'core/block',
        'core/button',
        'core/buttons',
        'core/column',
        'core/columns',
        'core/cover',
        'core/embed',
        'core/gallery',
        'core/heading',
        'core/image',
        'core/latest-posts',
        'core/list',
        'core/list-item',
        'core/media-text',
        'core/paragraph',
        'core/quote',
        'core/table',
        // All below are needed for query loop
        // 'core/query',
        // 'core/post-title',
        // 'core/post-date',
        // 'core/post-template',
        // 'core/query-pagination',
        // 'core/query-pagination-previous',
        // 'core/query-pagination-numbers',
        // 'core/query-pagination-next',
        // 'core/query-no-results',
        // 'core/missing',
    ];

    // Register custom blocks
    $custom_blocks = [
        'starter-block/feature-card',
        'starter-block/hero-image'
    ];

    // Register admin specific blocks
    $admin_blocks = [];
    if (current_user_can('administrator')) {
        $admin_blocks = [
            'core/html',
            'core/shortcode'
        ];
    }

    // Register plugin specific blocks
    $plugin_blocks = [
        'gravityforms/form'
    ];

    $all_blocks = array_merge(
        $core_blocks,
        $custom_blocks,
        $admin_blocks,
        $plugin_blocks
    );

    // Specify block groupings available on specific post types
    switch ($post->post->post_type) {
        case 'cu_accordion':
            $final_blocks = array_merge($core_blocks);
            break;
        default:
            $final_blocks = $all_blocks;
    }

    $final_blocks = array_merge(
        $core_blocks,
        $custom_blocks,
        $admin_blocks,
        $plugin_blocks
    );

    return $final_blocks;
}
add_filter('allowed_block_types_all', 'set_allowed_blocks', 10, 2);
