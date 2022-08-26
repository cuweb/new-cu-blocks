<?php
/**
 * Specify allowed core blocks
 *
 * @package Blocks
 * @category Gutenberg Supports
 * @version 1.0
 * @see other uses for this function: https://rudrastyh.com/gutenberg/remove-default-blocks.html
 * @see a list of core blocks: https://wpdevelopment.courses/a-list-of-all-default-gutenberg-blocks-in-wordpress-5-0/
 * @see set available core blocks https://github.com/WordPress/gutenberg/tree/master/packages/block-library/src
 *
 */
function set_allowed_blocks($final_blocks, $post)
{
    // Register core blocks
    $core_blocks = [
        'core/embed',
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
       // 'cutheme-blocks/blockName',
    ];

    // Register admin specific blocks
    $admin_blocks = [];

    if (current_user_can('administrator')) {
        $admin_blocks = ['core/html', 'core/shortcode', 'core/code'];
    }

    // Register plugin specific blocks
    $plugin_blocks = ['gravityforms/form'];

    // Build final blocks
    $final_blocks = array_merge(
        $core_blocks,
        $custom_blocks,
        $admin_blocks,
        $plugin_blocks
    );

    return $final_blocks;
}
add_filter('allowed_block_types_all', 'set_allowed_blocks', 10, 2);

/**
 * Apply block template for multiple post types
 *
 * @package Block Templates
 * @category Gutenberg Templates
 * @version 1.0
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-templates/
 */
// function register_block_template()
// {
//     $post_types = [
//         'post',
//         'news',
//         'page',
//         'cu_accordion',
//         'cu_event',
//         'cu_facility',
//         'cu_file',
//         'cu_people',
//         'cu_project',
//         'cu_story',
//         'cu_video',
//     ];

//     foreach ($post_types as $post_type) {
//         if (post_type_exists($post_type)) {
//             get_post_type_object($post_type)->template = [
//                 ['cutheme-blocks/banner'],
//                 ['cutheme-blocks/shareoptions'],
//             ];
//         }
//     }
// }
// add_action('wp_loaded', 'register_block_template');

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
//         $settings['codeEditingEnabled'] = true;
//     }

//     return $settings;
// }
// add_filter('block_editor_settings_all', 'customEditorSettings', 10, 2);
