<?php
/*
Plugin Name: Single Post CTA
Description: Plugin that adds sidebar (widget area) to single posts
Plugin URI: https://profiles.wordpress.org/aliviacarruth/
Author: Alivia Carruth
Version: 1.0
Text Domain: spc
Domain Path: /languages
License: GPL v2+
License URI: https://www.gnu.org/licenses/gpl-2.0.txt
*/

// exit if file is called directly
if (!defined('ABSPATH')) {

    exit;
}


// Load stylesheet
function spc_load_stylesheet()
{
    if (apply_filters('spc_load_styles', true)) {
        if (is_single()) {
            wp_enqueue_style('spc_stylesheet', plugin_dir_url(__FILE__) . 'spc-styles.css');
        }
    }
}

// Uncomment to disable stylesheet
// add_filter( 'spc_load_styles', __return_false );

// Hook stylesheet
add_action('wp_enqueue_scripts', 'spc_load_stylesheet');


//Register a custom sidebar
function spc_register_sidebar()
{
    register_sidebar(array(
        'name'           => __('Single Post CTA', 'spc'),
        'id'             => 'spc-sidebar',
        'description'    => __('Displays widget area on single posts', 'spc'),
        'before_widget'  => '<div class="widget spc">',
        'after_widget'   => '</div>',
        'before_title'   => '<h2 class="widgettitle spc-title">',
        'after_title'    => '</h2>',
    ));
}
// Hook sidebar
add_action('widgets_init', 'spc_register_sidebar');

// Display sidebar
function spc_display_sidebar($content)
{
    if (is_single()) {
        dynamic_sidebar('spc-sidebar');
    }

    return $content;
}
// Add dynamic sidebar
add_filter('the_content', 'spc_display_sidebar');
