<?php
/**
 * This file initializes all CU Core components
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

// If this file is called directly, abort. //
if (! defined('WPINC')) {
    die;
}

// Define Our Constants
define('CU_CORE_INC', dirname(__FILE__).'/assets/inc/');
define('CU_CORE_IMG', plugins_url('assets/img/', __FILE__));
define('CU_CORE_CSS', plugins_url('assets/css/', __FILE__));
define('CU_CORE_JS', plugins_url('assets/js/', __FILE__));
define('CU_CORE_BLOCKS', dirname(__FILE__).'/build/');

// Register CSS
function cu_register_core_css()
{
    wp_enqueue_style('cu-core', CU_CORE_CSS . 'cu-core.css', null, time(), 'all');
};
add_action('wp_enqueue_scripts', 'cu_register_core_css');

// Register Javascript
function enqueue_scripts_styles()
{
    wp_register_script(
        'block-config',
        CU_CORE_JS . 'cu-core.js',
        [ 'wp-blocks', 'wp-edit-post' ]
    );
    register_block_type('remove/block-style', ['editor_script' => 'block-config']); // register block editor script.
}
add_action('init', 'enqueue_scripts_styles');

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_test_block_init()
{
    register_block_type(CU_CORE_BLOCKS . 'feature-card');
    register_block_type(CU_CORE_BLOCKS . 'hero-image');
}
add_action('init', 'create_block_test_block_init');

// Load the Functions
if (file_exists(CU_CORE_INC . 'cu-core-functions.php')) {
    require_once CU_CORE_INC . 'cu-core-functions.php';
}
