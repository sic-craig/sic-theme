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
        'sidebar'   => __('Sidebar'),
        'mobile'    => __('Mobile'),
        'footer'    => __('Footer')
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

    wp_register_script('jquery', '//code.jquery.com/jquery-3.1.1.min.js', null, false, false);

    wp_register_script('bundle-js',              get_template_directory_uri() . '/assets/dist/js/app.min.js',                                           array('jquery'),              false, false);

    wp_enqueue_script('jquery');
    wp_enqueue_script('bundle-js');

}
add_action('wp_enqueue_scripts', 'includeScripts');

/*
|---------------------------------------------------------------------
| Register and Enqueue CSS
|---------------------------------------------------------------------
 */

function includeCss() {
    wp_register_style('bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css');
    wp_register_style('sic-styles', get_template_directory_uri() . '/assets/dist/css/style.min.css');

    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('sic-styles');
}
add_action('wp_enqueue_scripts', 'includeCss');


/*
|---------------------------------------------------------------------
| Add admin stylesheet
|---------------------------------------------------------------------
 */
function wpa_admin_stylesheet() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/assets/dist/css/sic_admin.css">';
}
add_action('admin_head','wpa_admin_stylesheet');

/*
|---------------------------------------------------------------------
| Disable WordPress backend theme/plugin editor
|---------------------------------------------------------------------
 */
define( 'DISALLOW_FILE_EDIT', true );

/*
|---------------------------------------------------------------------
| Allow localhost FTP
|---------------------------------------------------------------------
| Enables local install of plugins to be done through
| admin area
|
 */
define('FS_METHOD', 'direct');

/*
|---------------------------------------------------------------------
| Replace 'Howdy' greeting!
|---------------------------------------------------------------------
 */
function admin_bar_replace_howdy($wp_admin_bar)
{

    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Signed in as ', $account->title);
    $wp_admin_bar->add_node(
        array(
            'id'            => 'my-account',
            'title'         => $replace
        )
    );

}
add_filter('admin_bar_menu', 'admin_bar_replace_howdy', 25);

/*
|---------------------------------------------------------------------
| Import Custom Function Files
|---------------------------------------------------------------------
 */
require_once 'inc/sic-custom-post-types.php';
require_once 'inc/sic-custom-functions.php';
