<?php

/*
|---------------------------------------------------------------------
| Update 'Editor' role
|---------------------------------------------------------------------
| Allow 'Editor' to edit theme options - needed to
| use Theme Options (Option Tree)
|
 */
$editor = get_role('editor');
$editor->add_cap('edit_theme_options');

/*
|---------------------------------------------------------------------
| Post Thumbnails
|---------------------------------------------------------------------
 */
add_theme_support('post-thumbnails');

/*
|---------------------------------------------------------------------
|  Nav Menus
|---------------------------------------------------------------------
 */

register_nav_menus(
    array(
        'primary' => __('Top Navbar'),
        'footer' => __('Footer Left'),
        'footer_right'   => __('Footer Right')
    )
);

/*
|---------------------------------------------------------------------
| Register and Enqueue Scripts
|---------------------------------------------------------------------
 */

function includeScripts() {
    // Remove WordPress jQuery version
    wp_deregister_script('jquery');

    wp_register_script('bundle-js',              get_template_directory_uri() . '/assets/js/bundles.js',                                           array('jquery'),              false, false);

    wp_enqueue_script('bundle-js');

}
add_action('wp_enqueue_scripts', 'includeScripts');

/*
|---------------------------------------------------------------------
| Register and Enqueue CSS
|---------------------------------------------------------------------
 */

function includeCss() {

}
add_action('wp_enqueue_scripts', 'includeCss');

/*
|---------------------------------------------------------------------
| Import Custom Function Files
|---------------------------------------------------------------------
 */
require_once 'inc/sic-custom-post-types.php';
require_once 'inc/sic-custom-functions.php';
