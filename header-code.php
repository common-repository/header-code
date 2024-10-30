<?php
/*
Plugin Name: Header Code
Text Domain: header-code
Description: Simplest plugin that injects any code into wp_head().
Version: 1.2
Author: Gaiaz Iusipov
License: MIT
*/

defined('ABSPATH') or exit;

if (is_admin()) {
    require __DIR__ . '/options.php';
}

add_action('wp_head', function() {
    echo get_option('header_code');
});
