<?php
/*

Registering CPT

*/
add_action('init', 'create_post_type_location'); 
function create_post_type_location() {

    $labels = array(
        'name'               => 'Locations',
        'singular_name'      => 'Location',
        'menu_name'          => 'Locations',
        'name_admin_bar'     => 'Location',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Location',
        'new_item'           => 'New Location',
        'edit_item'          => 'Edit Location',
        'view_item'          => 'View Location',
        'all_items'          => 'All Locations',
        'search_items'       => 'Search Locations',
        'parent_item_colon'  => 'Parent Location',
        'not_found'          => 'No Locations Found',
        'not_found_in_trash' => 'No Locations Found in Trash'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 100,
        'menu_icon'           => 'dashicons-location-alt',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title', 'thumbnail'),
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'locations' ),
        'query_var'           => true
    );

    register_post_type( 'aqua_location', $args );

};