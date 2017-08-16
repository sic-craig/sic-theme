<?php
/*
|---------------------------------------------------------------------
| Product (example)
|---------------------------------------------------------------------
 */
function register_product_post_type() {

    $args = array(
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'post-formats'),
        'hierarchical' => true,
        'public'    => true,
        'has_archive' => true,
        'capability_type' => 'page',
        'rewrite'   => array('slug' => 'products'),
        'taxonomies' => array('category'),
        'menu_icon'  => 'dashicons-cart'
    );

    $labels = array(
        'name'                  => 'Products',
        'singular_name'         => 'Product',
        'add_new'               => 'Add Products',
        'add_new_item'          => 'Add New Product',
        'edit'                  => 'Edit Products',
        'edit_item'             => 'Edit Product',
        'new_item'              => 'New Product',
        'view'                  => 'View Products',
        'view_item'             => 'View Product',
        'search_items'          => 'Search Products',
        'not_found'             => 'No Products found',
        'not_found_in_trash'    => 'No Products found in trash',
        'parent'                => __( 'Parent Product' ),
        'parent_item_colon'     => '',
    );

    $args['labels'] = $labels;

    register_post_type('product', $args);

}
add_action('init', 'register_product_post_type');

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