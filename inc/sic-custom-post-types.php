<?php
/*
|---------------------------------------------------------------------
| Clinic
|---------------------------------------------------------------------
 */
function register_clinic_post_type() {

    $args = array(
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'post-formats'),
        'hierarchical' => true,
        'public'    => true,
        'has_archive' => true,
        'capability_type' => 'page',
        'rewrite'   => array('slug' => 'clinics'),
        'taxonomies' => array('category'),
        'menu_icon'  => 'dashicons-building'
    );

    $labels = array(
        'name'                  => 'Clinics',
        'singular_name'         => 'Clinic',
        'add_new'               => 'Add Clinics',
        'add_new_item'          => 'Add New Clinic',
        'edit'                  => 'Edit Clinics',
        'edit_item'             => 'Edit Clinic',
        'new_item'              => 'New Clinic',
        'view'                  => 'View Clinics',
        'view_item'             => 'View Clinic',
        'search_items'          => 'Search Clinics',
        'not_found'             => 'No Clinics found',
        'not_found_in_trash'    => 'No Clinics found in trash',
        'parent'                => __( 'Parent Clinic' ),
        'parent_item_colon'     => '',
    );

    $args['labels'] = $labels;

    register_post_type('clinic', $args);

}
add_action('init', 'register_clinic_post_type');

/*
|---------------------------------------------------------------------
| Homepage Hero
|---------------------------------------------------------------------
 */
function register_homepage_hero_post_type() {

    $args = array(
        'supports' => array('title', 'thumbnail'),
        'public'    => true,
        'exclude_from_search' => true,
        'menu_icon' => 'dashicons-format-image'
    );

    $labels = array(
        'name'                  => 'Homepage Heros',
        'singular_name'         => 'Homepage Hero',
        'add_new'               => 'Add Homepage Heros',
        'add_new_item'          => 'Add New Homepage Hero',
        'edit'                  => 'Edit Homepage Heros',
        'edit_item'             => 'Edit Homepage Hero',
        'new_item'              => 'New Homepage Hero',
        'view'                  => 'View Homepage Heros',
        'view_item'             => 'View Homepage Hero',
        'search_items'          => 'Search Homepage Heros',
        'not_found'             => 'No Homepage Heros found',
        'not_found_in_trash'    => 'No Homepage Heros found in trash',
        'parent'                => __( 'Parent Homepage Hero' ),
        'parent_item_colon'     => '',
    );

    $args['labels'] = $labels;

    register_post_type('homepage_hero', $args);

}
add_action('init', 'register_homepage_hero_post_type');