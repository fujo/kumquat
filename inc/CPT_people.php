<?php
/**
*
* Registering CPT
*
*/
add_action('init', 'create_post_type_people'); 
function create_post_type_people() {

    $labels = array(
        'name'               => 'Peoples',
        'singular_name'      => 'People',
        'menu_name'          => 'Peoples',
        'name_admin_bar'     => 'People',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New People',
        'new_item'           => 'New People',
        'edit_item'          => 'Edit People',
        'view_item'          => 'View People',
        'all_items'          => 'All Peoples',
        'search_items'       => 'Search Peoples',
        'parent_item_colon'  => 'Parent People',
        'not_found'          => 'No Peoples Found',
        'not_found_in_trash' => 'No Peoples Found in Trash'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 100,
        'menu_icon'           => 'dashicons-businessman', // https://developer.wordpress.org/resource/dashicons/
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array( 'title', 'thumbnail'),
        'has_archive'         => true,
        'rewrite'             => array( 'slug' => 'peoples' ),
        'query_var'           => true,
        'register_meta_box_cb'=> 'add_events_metaboxes'
    );

    register_post_type( 'aqua_people', $args );

};

// Redirection to prevent single view
add_action( 'template_redirect', 'redirect_people' );
function redirect_people() {

    if ( ! is_singular( 'peoples' ) ) return;
    wp_redirect( get_post_type_archive_link( 'peoples' ), 301 );
    exit;

};
/**
*
* Meta boxes
* @link http://wptheming.com/2010/08/custom-metabox-for-post-type/
*
*/
// Add the Events Meta Boxes
function add_events_metaboxes() {
    
    add_meta_box(
        'wpt_events_date',      // id
        'Event Date',           // title
        'wpt_events_date',      // callback
        'events',               // page
        'side',                 // context
        'default'               // priority
    );

};

// The Event Location Metabox

function wpt_events_date() {
    
    global $post;
    
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    
    // Get the location data if its already been entered
    $location = get_post_meta($post->ID, '_location', true);
    
    // Echo out the field
    echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';

}


/**
*
* Registering Taxo
*
*/
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_people_taxonomies', 0 );
// create two taxonomies, genres and writers for the post type "people"
function create_people_taxonomies() {

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Genres' ),
        'all_items'         => __( 'All Genres' ),
        'parent_item'       => __( 'Parent Genre' ),
        'parent_item_colon' => __( 'Parent Genre:' ),
        'edit_item'         => __( 'Edit Genre' ),
        'update_item'       => __( 'Update Genre' ),
        'add_new_item'      => __( 'Add New Genre' ),
        'new_item_name'     => __( 'New Genre Name' ),
        'menu_name'         => __( 'Genre' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'peoples' ),
    );

    register_taxonomy( 'aqua_genre', array( 'aqua_people' ), $args );

};