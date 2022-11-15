<?php
/**
 * This file initializes all CU Core components
 */

// If this file is called directly, abort. //
if (! defined('WPINC')) {
    die;
}

// Define Our Constants
define('CU_CORE_INC', dirname(__FILE__).'/assets/inc/');
define('CU_CORE_IMG', plugins_url('assets/img/', __FILE__));
define('CU_CORE_CSS', plugins_url('assets/css/', __FILE__));
define('CU_BLOCK_JS', plugins_url('src/', __FILE__));
define('CU_BLOCKS_PATH', dirname(__FILE__).'/build/');

// Load the Enqueues
if (file_exists(CU_CORE_INC . 'cu-block-enqueues.php')) {
    require_once CU_CORE_INC . 'cu-block-enqueues.php';
}

// Load the Functions
if (file_exists(CU_CORE_INC . 'cu-block-functions.php')) {
    require_once CU_CORE_INC . 'cu-block-functions.php';
}
