<?php
/*
Plugin Name: CU Blocks
Plugin URI: https://github.com/cuweb
Description: Custom blocks for cutheme 2.0
Version: 0.0.1
Author: Web Services
Author URI: https://carleton.ca/webservices
Text Domain: cu
*/

// If this file is called directly, abort. //
if (! defined('WPINC')) {
    die;
}

// Let's Initialize Everything
if (file_exists(plugin_dir_path(__FILE__) . 'core-init.php')) {
    require_once(plugin_dir_path(__FILE__) . 'core-init.php');
}
