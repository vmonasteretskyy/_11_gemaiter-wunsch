<?php

add_action( 'init', 'custom_taxonomies' );

function custom_taxonomies() {
}

function custom_post_types() {
    /*
    register_post_type('contact', array(
        'labels' => array(
            'name' => _x('Контакти', 'Post Type General Name'),
            'singular_name' => _x('Контакт', 'Post Type Singular Name'),
            'menu_name' => __('Контакти'),
            'parent_item_colon' => __('Батьківський контакт'),
            'all_items' => __('Всі контакти'),
            'view_item' => __('Переглянути контакт'),
            'add_new_item' => __('Додати новий контакт'),
            'add_new' => __('Додати новий'),
            'edit_item' => __('Змінити контакт'),
            'update_item' => __('Оновити контакт'),
            'search_items' => __('Пошук контактів'),
            'not_found' => __('Не знайдено'),
            'not_found_in_trash' => __('Не знайдено в корзині')
        ),
        'public' => true,
        'query_var' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        "publicly_queryable" => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-location',
        'supports' => array('title', 'editor'),
        'exclude_from_search' => true,
        //'capability_type' => ['contact', 'contacts'],
        //'capabilities' => [],
        //'map_meta_cap' => false,
        'rewrite' => array('slug' => 'contacts', 'with_front' => false)
    ));
    */
}
add_action('init', 'custom_post_types');
?>