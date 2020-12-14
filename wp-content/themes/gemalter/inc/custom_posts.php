<?php

add_action( 'init', 'custom_taxonomies' );

function custom_taxonomies() {
    //taxonomy for gallery subjects
    register_taxonomy(
        'gallery_subject',
        'gallery',
        array(
            'public' => true,
            'labels' => array(
                'name'		=> 'Gallery Subjects',
                'singular_name'	=> 'Subject',
                'menu_name'	=> 'Subjects',
                'search_items'	=> 'Search Subjects',
                'popular_items' => 'Popular Items',
                'all_items'	=> 'All Items',
                'edit_item'	=> 'Edit Item',
                'update_item'	=> 'Update Item',
                'add_new_item'	=> 'Add New Item',
                'new_item_name'	=> 'New Item',
            ),
            'update_count_callback' => '_update_post_term_count',
        )
    );
    //taxonomy for gallery styles
    register_taxonomy(
        'gallery_style',
        'gallery',
        array(
            'public' => true,
            'labels' => array(
                'name'		=> 'Gallery Styles',
                'singular_name'	=> 'Style',
                'menu_name'	=> 'Styles',
                'search_items'	=> 'Search Styles',
                'popular_items' => 'Popular Items',
                'all_items'	=> 'All Items',
                'edit_item'	=> 'Edit Item',
                'update_item'	=> 'Update Item',
                'add_new_item'	=> 'Add New Item',
                'new_item_name'	=> 'New Item',
            ),
            'update_count_callback' => '_update_post_term_count',
        )
    );
}

function custom_post_types() {
    //ctp for gallery
    register_post_type('gallery', array(
        'labels' => array(
            'name' => _x('Gallery', 'Post Type General Name'),
            'singular_name'=> _x('Gallery', 'Post Type Singular Name'),
            'menu_name' => __('Gallery'),
            'parent_item_colon' => __('Parent Gallery'),
            'all_items' => __('All Items'),
            'view_item' => __('View Item'),
            'add_new_item' => __('Add New Item'),
            'add_new' => __('Add New'),
            'edit_item' => __('Edit Item'),
            'update_item' => __('Update Item'),
            'search_items' => __('Search'),
            'not_found' => __('Not Found'),
            'not_found_in_trash' => __('Not Found In Trash')
        ),
        'public' => true,
        "publicly_queryable" => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports'=> array('title', 'editor', 'thumbnail', 'revisions'),
        'exclude_from_search' => true,
        'rewrite' => array('slug' => 'gallery', 'with_front' => false)
    ));
    flush_rewrite_rules();
}
add_action('init', 'custom_post_types');
?>
