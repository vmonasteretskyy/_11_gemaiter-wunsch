<?php

remove_action('wp_head', 'wp_generator');

function allow_new_mime_type($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('mime_types', 'allow_new_mime_type');
//test(get_allowed_mime_types());

if(function_exists('acf_add_options_page')){
    acf_add_options_page(array(
        'page_title' 	=> 'Theme Options',
        'menu_title'	=> 'Theme Options',
        'menu_slug' 	=> 'theme-options',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}


add_action('admin_enqueue_scripts', 'my_admin_css', 99);
function my_admin_css(){
    wp_enqueue_style('my-wp-admin', get_template_directory_uri() .'/wp-admin.css' );
}

function custom_find_matching_product_variation( $product, $match_attributes = array() ) {
    global $wpdb;
    $meta_attribute_names = array();
    // Get attributes to match in meta.
    foreach ( $product->get_attributes() as $attribute ) {
        if ( ! $attribute->get_variation() ) {
            continue;
        }
        $meta_attribute_names[] = 'attribute_' . sanitize_title( $attribute->get_name() );
    }
    // Get the attributes of the variations.
    $query = $wpdb->prepare(
        "
			SELECT postmeta.post_id, postmeta.meta_key, postmeta.meta_value, posts.menu_order FROM {$wpdb->postmeta} as postmeta
			LEFT JOIN {$wpdb->posts} as posts ON postmeta.post_id=posts.ID
			WHERE postmeta.post_id IN (
				SELECT ID FROM {$wpdb->posts}
				WHERE {$wpdb->posts}.post_parent = %d
				AND {$wpdb->posts}.post_status = 'publish'
				AND {$wpdb->posts}.post_type = 'product_variation'
			)
			",
        $product->get_id()
    );
    $query .= ' AND postmeta.meta_key IN ( "' . implode( '","', array_map( 'esc_sql', $meta_attribute_names ) ) . '" )';
    $query.=' ORDER BY posts.menu_order ASC, postmeta.post_id ASC;';
    $attributes = $wpdb->get_results( $query ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
    if ( ! $attributes ) {
        return 0;
    }
    $sorted_meta = array();
    foreach ( $attributes as $m ) {
        $sorted_meta[ $m->post_id ][ $m->meta_key ] = $m->meta_value; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
    }
    /**
     * Check each variation to find the one that matches the $match_attributes.
     *
     * Note: Not all meta fields will be set which is why we check existance.
     */
    foreach ( $sorted_meta as $variation_id => $variation ) {
        $match = false;
        // Loop over the variation meta keys and values i.e. what is saved to the products. Note: $attribute_value is empty when 'any' is in use.
        foreach ( $variation as $attribute_key => $attribute_value ) {
            if ( array_key_exists( $attribute_key, $match_attributes ) && $match_attributes[ $attribute_key ] == $attribute_value ) {
                $match = true; // match
            }
        }
        if ( true === $match ) {
            return $variation_id;
        }
    }
    return 0;
}

function recalculate_product_price() {
    $hasError = false;
    $errorMessage = '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
    $product_attributes = isset($_POST['product_attribute']) ? $_POST['product_attribute'] : [];
    $attributes = [];

    $title = $image = $is_on_sale = '';
    if ($product_id) {
        if (isset($product_attributes['pa_size'])) {
            $attributes['attribute_pa_size'] = $product_attributes['pa_size'];
        } else if (isset($product_attributes['pa_size2'])) {
            $attributes['attribute_pa_size2'] = $product_attributes['pa_size2'];
        }
        $var = custom_find_matching_product_variation(new \WC_Product($product_id), $attributes);
        if ($var) {
            //if exist variant used it
            $variant = wc_get_product($var);
            $product = wc_get_product($product_id);
        } else {
            //if not exist variant then used original troduct
            $variant = wc_get_product($product_id);
            $product = wc_get_product($product_id);
        }
        $title = $variant->get_name();
        $is_on_sale = $variant->is_on_sale();
        if ( $variant->get_image_id() ) {
            $image = wp_get_attachment_image($variant->get_image_id(), 'orig');
        } else if ( $product->get_image_id() ) {
            $image = wp_get_attachment_image($product->get_image_id(), 'orig');
        }
        $price = $variant->get_price_html();
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не знайдено.')
        ]);
        wp_die();
    }
    echo json_encode([
        'has_error' => false,
        //'price' => wc_price($price),
        'price' => $price,
        'product_id' => $variant->get_id(),
        'variant_id' => isset($var) && $var ? $var : 0,
        'title' => $title,
        'image' => $image,
        'is_on_sale' => $is_on_sale,
    ]);
    wp_die();
}
add_action('wp_ajax_recalculate_price', 'recalculate_product_price');
add_action('wp_ajax_nopriv_recalculate_price', 'recalculate_product_price');


function ajax_add_to_cart() {
    $hasError = false;
    $errorMessage = '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
    $product_attributes = isset($_POST['product_attribute']) ? $_POST['product_attribute'] : [];
    $attributes = [];
    if ($product_id) {
        if (isset($product_attributes['pa_size']) && $product_attributes['pa_size']) {
            $attributes['attribute_pa_size'] = $product_attributes['pa_size'];
        } else if (isset($product_attributes['pa_size2']) && $product_attributes['pa_size2']) {
            $attributes['attribute_pa_size2'] = $product_attributes['pa_size2'];
        }
        $variation_id = custom_find_matching_product_variation(new \WC_Product($product_id), $attributes);
        if ($variation_id) {
            //if exist variant used it
            $variant = wc_get_product($variation_id);
            $product = wc_get_product($product_id);
        } else {
            //if not exist variant then used original troduct
            $variant = wc_get_product($product_id);
            $product = wc_get_product($product_id);
        }
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не знайдено.')
        ]);
        wp_die();
    }
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    //there will be attributes
    $cart_item_data['attributes'] = $product_attributes;
    $cart_item_data['price'] = $variant->get_price();

    $variation = wc_get_product_variation_attributes( $variation_id );
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не може бути доданий в корзину.')
        ]);
        wp_die();
    }
    $args = [
        'prod_id' => $product_id,
        'var_id' => $variation_id,

    ];
    $html = wc_get_template_html('single-product/cart_popup.php', $args, "", get_template_directory_uri() . "/woocommerce/");

    echo json_encode([
        'has_error' => false,
        'redirect_link' => esc_url(get_url_lang_prefix() . '/checkout/'),
        'html' => $html,
        'total_products' => WC()->cart->get_cart_contents_count(),
    ]);
    wp_die();
}
add_action('wp_ajax_ajax_add_to_cart', 'ajax_add_to_cart');
add_action('wp_ajax_nopriv_ajax_add_to_cart', 'ajax_add_to_cart');

add_filter( 'woocommerce_add_cart_item', function( $cart_item )
{
    if ( isset( $cart_item['price'] ) )
    {
        $product = $cart_item['data'];
        $product->set_price( $cart_item['price'] );
        $product->set_regular_price( $cart_item['price'] );
        $cart_item['data'] = $product;
        /*$product->set_sale_price( $cart_item['new_price'] );*/
    }
    return $cart_item;
}, 11, 1 );

add_filter( 'woocommerce_get_cart_item_from_session', function( $cart_item, $values )
{
    if ( isset( $cart_item['price'] ) )
    {
        $product = $cart_item['data'];
        $product->set_price( $cart_item['price'] );
        $product->set_regular_price( $cart_item['price'] );
        $cart_item['data'] = $product;
        /*$product->set_sale_price( $cart_item['new_price'] );*/
    }
    return $cart_item;

}, 11, 2 );

function ajax_product_remove()
{
    ob_start();
    $cart_item_key = isset($_POST['cart_item_key']) ? trim($_POST['cart_item_key']) : '';
    if (!$cart_item_key) {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Продукт не може бути видалений.')
        ]);
        wp_die();
    }
    $delete = WC()->cart->remove_cart_item($cart_item_key);

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    // Get order review fragment.
    ob_start();
    woocommerce_order_review();
    $woocommerce_order_review = ob_get_clean();
    // Get checkout payment fragment.
    ob_start();
    woocommerce_checkout_payment();
    $woocommerce_checkout_payment = ob_get_clean();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters(
            'woocommerce_update_order_review_fragments',
            array(
                '.woocommerce-checkout-review-order-table' => $woocommerce_order_review,
                '.woocommerce-checkout-payment' => $woocommerce_checkout_payment,
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
        'total_products' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_total()
    );
    wp_send_json( $data );
    die();
}
add_action( 'wp_ajax_product_remove', 'ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'ajax_product_remove' );

function set_quantity() {
    $cart_item_key = isset($_POST['cart_item_key']) ? trim($_POST['cart_item_key']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if (!$cart_item_key) {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('Сталась помилка. Неможливо змінити кількість.')
        ]);
        wp_die();
    }

    $item_total_price = 0;
    WC()->cart->set_quantity($cart_item_key, $quantity);

    $cart_item = WC()->cart->get_cart_item( $cart_item_key );
    if ($cart_item) {
        $item_total_price = $cart_item['line_total'];
    }


    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();
    // Get order review fragment.
    ob_start();
    woocommerce_order_review();
    $woocommerce_order_review = ob_get_clean();
    // Get checkout payment fragment.
    ob_start();
    woocommerce_checkout_payment();
    $woocommerce_checkout_payment = ob_get_clean();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters(
            'woocommerce_update_order_review_fragments',
            array(
                '.woocommerce-checkout-review-order-table' => $woocommerce_order_review,
                '.woocommerce-checkout-payment' => $woocommerce_checkout_payment,
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
        'total_products' => WC()->cart->get_cart_contents_count(),
        'total' => WC()->cart->get_total(),
        'item_total_price' => wc_price($item_total_price),
    );
    wp_send_json( $data );
    die();
}
add_action('wp_ajax_set_quantity', 'set_quantity');
add_action('wp_ajax_nopriv_set_quantity', 'set_quantity');


function redirect_cart_page() {
    if (is_checkout() && !is_wc_endpoint_url( 'order-received' )) {
        $totalCartItems = WC()->cart->get_cart_contents_count();
        if (!$totalCartItems) {
            wp_redirect((get_url_lang_prefix()) . '/');
        }
    }
    if (is_cart()) {
        $totalCartItems = WC()->cart->get_cart_contents_count();
        if ($totalCartItems) {
            wp_redirect(esc_url((get_url_lang_prefix()) . '/checkout/'));
        } else {
            wp_redirect((get_url_lang_prefix()) . '/');
        }
    }
    if (is_checkout() && !is_wc_endpoint_url( 'order-received' )) {
        wc_setcookie('pll_current_lang_custom', pll_current_language(), time() + 60*10);
    }

    if (is_wc_endpoint_url( 'order-received')) {
        $pll_current_lang_custom = array_key_exists('pll_current_lang_custom', $_COOKIE) ? trim($_COOKIE['pll_current_lang_custom']) : null;
        $pll_current_lang = pll_current_language();
        if ($pll_current_lang_custom && $pll_current_lang_custom != $pll_current_lang) {
            $url = $_SERVER['REQUEST_URI'];
            if ($pll_current_lang_custom == 'ru') {
                $url = '/ru' . $url;
            } else {
                $url = str_replace('/ru/', '/', $url);
            }
            wc_setcookie('pll_current_lang_custom', pll_current_language(), time() - 60*100);
            wp_redirect($url);
        }

    }
}
add_action('template_redirect', 'redirect_cart_page');


function modify_port_per_page( $query ) {
    if ( ! is_admin()) {
        $query->set('posts_per_page', 9);
    }
    if ( ! is_admin() && in_array ( $query->get('post_type'), array('product') ) ) {
        $query->set( 'posts_per_page', 9 );
    }
    if ( ! is_admin() && is_category() ) {
        $query->set( 'posts_per_page', 9 );
    }
    if ( ! is_admin() && is_search() ) {
        $query->set( 'posts_per_page', 9 );
    }
    if ( is_post_type_archive( "contact" )) {
        $query->set( 'posts_per_page', 100 );
    }
}
add_action( 'pre_get_posts', 'modify_port_per_page' );

function add_postmeta_ordering_args( $sort_args ) {
    $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    switch( $orderby_value ) {
        // Name your sortby key whatever you'd like; must correspond to the $sortby in the next function
        case 'is_new':
            $sort_args['orderby']  = 'meta_value_num';
            // Sort by meta_value because we're using alphabetic sorting
            $sort_args['order']    = 'desc';
            $sort_args['meta_key'] = 'is_new';
            // use the meta key you've set for your custom field, i.e., something like "location" or "_wholesale_price"
            break;

        case 'is_promo':
            $sort_args['orderby'] = 'meta_value_num';
            // We use meta_value_num here because points are a number and we want to sort in numerical order
            $sort_args['order'] = 'desc';
            $sort_args['meta_key'] = 'is_promo';
            break;

    }

    return $sort_args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'add_postmeta_ordering_args' );


/* NOT sure if this is needed
// Add these new sorting arguments to the sortby options on the frontend
function add_new_postmeta_orderby( $sortby ) {

    // Adjust the text as desired
    $sortby['location'] = __( 'Sort by location', 'woocommerce' );
    $sortby['points_awarded'] = __( 'Sort by points for purchase', 'woocommerce' );

    return $sortby;
}
add_filter( 'woocommerce_default_catalog_orderby_options', 'add_new_postmeta_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'add_new_postmeta_orderby' );
*/

function woocommerce_after_checkout_validation_function( $data, $errors ){
    unset($errors->errors['shipping']);
}
add_action( 'woocommerce_after_checkout_validation', 'woocommerce_after_checkout_validation_function', 10, 2 );

add_filter('woocommerce_add_error', function ($message){
    $message = pll__($message);
    return $message;
}, 20, 3);

/*Export orders to xlsx start */
function export_products_to_xml_btn() {
    $screen = get_current_screen();

    if ( $screen->id != "edit-product" )   // Only add to products page
        return;
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($)
        {
            $('#wpbody-content .wp-header-end').before('<form action="#" style="display:inline-block;" method="POST" target="_blank"><input type="hidden" id="swd_products_export_xml" name="download" value="1" /><input type="hidden" id="swd_products_export_xml" name="swd_products_export_xml" value="1" /><input class="page-title-action" style="" type="submit" value="<?php esc_attr_e('Експорт XML', 'mytheme');?>" /></form>');
        });
    </script>
    <?php
}
add_action('admin_footer', 'export_products_to_xml_btn');

function export_products_to_xml() {
    if ((isset($_POST['swd_products_export_xml']) && !empty($_POST['swd_products_export_xml'])) || isset($_GET['export_products_xml'])) {
        $records = [];
        $args = array(
            'paginate' => false,
            'limit' => -1,
        );

        $xml = '';
        $xml .= "<?xml version='1.0' encoding='utf-8'?>\n";
        $xml .= "<rss version='2.0' xmlns:g='http://base.google.com/ns/1.0'>\n";
	    $xml .= "\t<channel>\n";
        $xml .= "\t\t<title>swd products XML</title>\n";
        $xml .= "\t\t<link>" . get_url('/') . "</link>\n";
		$xml .= "\t\t<description>swd products XML</description>\n";

        $products = wc_get_products($args);
        if (!empty($products)) {
            foreach ($products as $product) {
                if (!$product) continue;
                //simple, variable, external, grouped
                $product_type = $product->get_type();
                $product_status = $product->get_status();
                if ($product_status != 'publish') continue;
                if (!$product_type) continue;

                $image = get_the_post_thumbnail_url($product->get_id(), 'orig');
                $product_slug = $product->get_slug();
                $product_slug = get_url((get_url_lang_prefix()) .  '/product/' . $product_slug . '/');
                $benefits = get_field('benefits', $product->get_id());
                $specifications = get_field('specifications', $product->get_id());
                $other_specifications = get_field('other_specifications', $product->get_id());
                switch ($product_type) {
                    case 'simple':
                        /*
                        $xml .= "\t\t<item>\n";
                        $xml .= "\t\t\t<g:id>" . $product->get_id() . "</g:id>\n";
                        $xml .= "\t\t\t<sku>" . $product->get_sku() . "</sku>\n";
                        $xml .= "\t\t\t<title>" . $product->get_name() . "</title>\n";
                        $xml .= "\t\t\t<g:product_type>" . $product->get_type() . "</g:product_type>\n";
                        if ($product->get_description()) {
                            $xml .= "\t\t\t<description>" . $product->get_description() . "</description>\n";
                        }
                        if ($product_slug) {
                            $xml .= "\t\t\t<link>" . $product_slug . "</link>\n";
                        }
                        if ($image) {
                            $xml .= "\t\t\t<g:image_link>" . $image . "</g:image_link>\n";
                        }
                        if ($product->get_price()) {
                            $xml .= "\t\t\t<g:price>" . $product->get_price() . "</g:price>\n";
                        }
                        if ($product->get_sale_price()) {
                            $xml .= "\t\t\t<g:sale_price>" . $product->get_sale_price() . "</g:sale_price>\n";
                        }
                        if ($product->get_categories()) {
                            $xml .= "\t\t\t<g:google_product_category>" . strip_tags($product->get_categories()) . "</g:google_product_category>\n";
                        }
                        if ($product->get_parent_id()) {
                            $xml .= "\t\t\t<g:item_group_id>" . $product->get_parent_id() . "</g:item_group_id>\n";
                        }
                        */
                        $xml .= "\t\t<item>\n";
                        $xml .= "\t\t\t<id>" . $product->get_id() . "</id>\n";
                        $xml .= "\t\t\t<sku>" . $product->get_sku() . "</sku>\n";
                        $xml .= "\t\t\t<title>" . $product->get_name() . "</title>\n";
                        $xml .= "\t\t\t<product_type>" . $product->get_type() . "</product_type>\n";

                        if ($product->get_description()) {
                            $xml .= "\t\t\t<description>" . $product->get_description() . "</description>\n";
                        }
                        if ($product_slug) {
                            $xml .= "\t\t\t<link>" . $product_slug . "</link>\n";
                        }
                        if ($image) {
                            $xml .= "\t\t\t<image_link>" . $image . "</image_link>\n";
                        }
                        if ($product->get_price()) {
                            $xml .= "\t\t\t<price>" . $product->get_price() . "</price>\n";
                        }
                        if ($product->get_sale_price()) {
                            $xml .= "\t\t\t<sale_price>" . $product->get_sale_price() . "</sale_price>\n";
                        }
                        /*if ($product->get_categories()) {
                            $xml .= "\t\t\t<categories>" . strip_tags($product->get_categories()) . "</categories>\n";
                        }*/
                        if ($product->get_category_ids() && !empty($product->get_category_ids())) {
                            $xml .= "\t\t\t<category_ids>" . implode(',', $product->get_category_ids()) . "</category_ids>\n";
                            $categories = $product->get_category_ids();
                            if ($categories) {
                                $xml .= "\t\t\t<categories>";
                                foreach ($categories as $categoryID) {
                                    $category = get_term_by('id', $categoryID, 'product_cat');
                                    if ($category) {
                                        $xml .= "\t\t\t\t<category>\n";
                                        $xml .= "\t\t\t\t\t<category_id>" . $category->term_id . "</category_id>\n";
                                        $xml .= "\t\t\t\t\t<category_title>" . $category->name . "</category_title>\n";
                                        $xml .= "\t\t\t\t\t<category_link>" . get_url((get_url_lang_prefix()) .  '/product-category/' . $category->slug . '/') . "</category_link>\n";
                                        $xml .= "\t\t\t\t</category>\n";
                                    }
                                }
                                $xml .= "\t\t\t</categories>\n";
                            }
                        }
                        if ($product->get_parent_id()) {
                            $xml .= "\t\t\t<group_id>" . $product->get_parent_id() . "</group_id>\n";
                        }
                        $xml .= "\t\t\t<product_detail>\n";
                        if ($benefits) {
                            $xml .= "\t\t\t\t<benefits>";
                            foreach ($benefits as $benefit) {
                                if ($benefit['title']) {
                                    $xml .= "\t\t\t\t\t<benefit>\n";
                                    $xml .= "\t\t\t\t\t\t<benefit_title>" . $benefit['title'] . "</benefit_title>\n";
                                    $xml .= "\t\t\t\t\t</benefit>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</benefits>\n";
                        }
                        if ($specifications) {
                            $xml .= "\t\t\t\t<specifications>";
                            foreach ($specifications as $specification) {
                                if ($specification['title']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['title'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</specifications>\n";
                        }
                        if ($other_specifications) {
                            $xml .= "\t\t\t\t<other_specifications>";
                            foreach ($other_specifications as $specification) {
                                if ($specification['name']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['name'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_units>" . $specification['units'] . "</specification_units>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_indicators>" . $specification['indicators'] . "</specification_indicators>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_standard>" . $specification['standart'] . "</specification_standard>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</other_specifications>\n";
                        }
                        $xml .= "\t\t\t</product_detail>\n";
                        $xml .= "\t\t</item>\n";
                        break;
                    case 'variable':
                        $xml .= "\t\t<item>\n";
                        $xml .= "\t\t\t<id>" . $product->get_id() . "</id>\n";
                        $xml .= "\t\t\t<sku>" . $product->get_sku() . "</sku>\n";
                        $xml .= "\t\t\t<title>" . $product->get_name() . "</title>\n";
                        $xml .= "\t\t\t<product_type>" . $product->get_type() . "</product_type>\n";
                        if ($product->get_description()) {
                            $xml .= "\t\t\t<description>" . $product->get_description() . "</description>\n";
                        }
                        if ($product_slug) {
                            $xml .= "\t\t\t<link>" . $product_slug . "</link>\n";
                        }
                        if ($image) {
                            $xml .= "\t\t\t<image_link>" . $image . "</image_link>\n";
                        }
                        if ($product->get_price()) {
                            $xml .= "\t\t\t<price>" . $product->get_price() . "</price>\n";
                        }
                        if ($product->get_sale_price()) {
                            $xml .= "\t\t\t<sale_price>" . $product->get_sale_price() . "</sale_price>\n";
                        }
                        /*if ($product->get_categories()) {
                            $xml .= "\t\t\t<categories>" . strip_tags($product->get_categories()) . "</categories>\n";
                        }*/
                        if ($product->get_category_ids() && !empty($product->get_category_ids())) {
                            $xml .= "\t\t\t<category_ids>" . implode(',', $product->get_category_ids()) . "</category_ids>\n";
                            $categories = $product->get_category_ids();
                            if ($categories) {
                                $xml .= "\t\t\t<categories>";
                                foreach ($categories as $categoryID) {
                                    $category = get_term_by('id', $categoryID, 'product_cat');
                                    if ($category) {
                                        $xml .= "\t\t\t\t<category>\n";
                                        $xml .= "\t\t\t\t\t<category_id>" . $category->term_id . "</category_id>\n";
                                        $xml .= "\t\t\t\t\t<category_title>" . $category->name . "</category_title>\n";
                                        $xml .= "\t\t\t\t\t<category_link>" . get_url((get_url_lang_prefix()) .  '/product-category/' . $category->slug . '/') . "</category_link>\n";
                                        $xml .= "\t\t\t\t</category>\n";
                                    }
                                }
                                $xml .= "\t\t\t</categories>\n";
                            }
                        }
                        if ($product->get_parent_id()) {
                            $xml .= "\t\t\t<group_id>" . $product->get_parent_id() . "</group_id>\n";
                        }
                        $xml .= "\t\t\t<product_detail>\n";
                        if ($benefits) {
                            $xml .= "\t\t\t\t<benefits>";
                            foreach ($benefits as $benefit) {
                                if ($benefit['title']) {
                                    $xml .= "\t\t\t\t\t<benefit>\n";
                                    $xml .= "\t\t\t\t\t\t<benefit_title>" . $benefit['title'] . "</benefit_title>\n";
                                    $xml .= "\t\t\t\t\t</benefit>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</benefits>\n";
                        }
                        if ($specifications) {
                            $xml .= "\t\t\t\t<specifications>";
                            foreach ($specifications as $specification) {
                                if ($specification['title']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['title'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</specifications>\n";
                        }
                        if ($other_specifications) {
                            $xml .= "\t\t\t\t<other_specifications>";
                            foreach ($other_specifications as $specification) {
                                if ($specification['name']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['name'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_units>" . $specification['units'] . "</specification_units>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_indicators>" . $specification['indicators'] . "</specification_indicators>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_standard>" . $specification['standart'] . "</specification_standard>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</other_specifications>\n";
                        }
                        $xml .= "\t\t\t</product_detail>\n";
                        $xml .= "\t\t</item>\n";

                        $child_products = $product->get_children();
                        if ($child_products) {
                            foreach ($child_products as $child_product_id) {
                                $child_product = wc_get_product($child_product_id);
                                $child_image = get_the_post_thumbnail_url($child_product->get_id(), 'orig');
                                if (isset($child_product->get_attributes()['pa_size'])) {
                                    $child_product_slug = $product_slug . '?attribute_pa_size=' . $child_product->get_attributes()['pa_size'];
                                }else if (isset($child_product->get_attributes()['pa_size2'])) {
                                    $child_product_slug = $product_slug . '?attribute_pa_size2=' . $child_product->get_attributes()['pa_size2'];
                                } else {
                                    $child_product_slug = $product_slug;
                                }

                                $xml .= "\t\t<item>\n";
                                $xml .= "\t\t\t<id>" . $child_product->get_id() . "</id>\n";
                                $xml .= "\t\t\t<sku>" . $child_product->get_sku() . "</sku>\n";
                                $xml .= "\t\t\t<title>" . $child_product->get_name() . "</title>\n";
                                $xml .= "\t\t\t<product_type>" . $child_product->get_type() . "</product_type>\n";
                                if ($child_product->get_description()) {
                                    $xml .= "\t\t\t<description>" . $child_product->get_description() . "</description>\n";
                                }
                                if ($child_product_slug) {
                                    $xml .= "\t\t\t<link>" . $child_product_slug . "</link>\n";
                                }
                                if ($child_image) {
                                    $xml .= "\t\t\t<image_link>" . $child_image . "</image_link>\n";
                                }
                                if ($child_product->get_price()) {
                                    $xml .= "\t\t\t<price>" . $child_product->get_price() . "</price>\n";
                                }
                                if ($child_product->get_sale_price()) {
                                    $xml .= "\t\t\t<sale_price>" . $child_product->get_sale_price() . "</sale_price>\n";
                                }
                                /*if ($child_product->get_categories()) {
                                    $xml .= "\t\t\t<categories>" . strip_tags($child_product->get_categories()) . "</categories>\n";
                                }*/
                                if ($child_product->get_category_ids() && !empty($child_product->get_category_ids())) {
                                    $xml .= "\t\t\t<category_ids>" . implode(',', $child_product->get_category_ids()) . "</category_ids>\n";
                                    $categories = $child_product->get_category_ids();
                                    if ($categories) {
                                        $xml .= "\t\t\t<categories>";
                                        foreach ($categories as $categoryID) {
                                            $category = get_term_by('id', $categoryID, 'product_cat');
                                            if ($category) {
                                                $xml .= "\t\t\t\t<category>\n";
                                                $xml .= "\t\t\t\t\t<category_id>" . $category->term_id . "</category_id>\n";
                                                $xml .= "\t\t\t\t\t<category_title>" . $category->name . "</category_title>\n";
                                                $xml .= "\t\t\t\t\t<category_link>" . get_url((get_url_lang_prefix()) .  '/product-category/' . $category->slug . '/') . "</category_link>\n";
                                                $xml .= "\t\t\t\t</category>\n";
                                            }
                                        }
                                        $xml .= "\t\t\t</categories>\n";
                                    }
                                }
                                if ($child_product->get_parent_id()) {
                                    $xml .= "\t\t\t<group_id>" . $child_product->get_parent_id() . "</group_id>\n";
                                }
                                $xml .= "\t\t\t<product_detail>\n";
                                if ($benefits) {
                                    $xml .= "\t\t\t\t<benefits>";
                                    foreach ($benefits as $benefit) {
                                        if ($benefit['title']) {
                                            $xml .= "\t\t\t\t\t<benefit>\n";
                                            $xml .= "\t\t\t\t\t\t<benefit_title>" . $benefit['title'] . "</benefit_title>\n";
                                            $xml .= "\t\t\t\t\t</benefit>\n";
                                        }
                                    }
                                    $xml .= "\t\t\t\t</benefits>\n";
                                }
                                if ($specifications) {
                                    $xml .= "\t\t\t\t<specifications>";
                                    foreach ($specifications as $specification) {
                                        if ($specification['title']) {
                                            $xml .= "\t\t\t\t\t<specification>";
                                            $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['title'] . "</specification_title>\n";
                                            $xml .= "\t\t\t\t\t</specification>\n";
                                        }
                                    }
                                    $xml .= "\t\t\t\t</specifications>\n";
                                }
                                if ($other_specifications) {
                                    $xml .= "\t\t\t\t<other_specifications>";
                                    foreach ($other_specifications as $specification) {
                                        if ($specification['name']) {
                                            $xml .= "\t\t\t\t\t<specification>";
                                            $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['name'] . "</specification_title>\n";
                                            $xml .= "\t\t\t\t\t\t<specification_units>" . $specification['units'] . "</specification_units>\n";
                                            $xml .= "\t\t\t\t\t\t<specification_indicators>" . $specification['indicators'] . "</specification_indicators>\n";
                                            $xml .= "\t\t\t\t\t\t<specification_standard>" . $specification['standart'] . "</specification_standard>\n";
                                            $xml .= "\t\t\t\t\t</specification>\n";
                                        }
                                    }
                                    $xml .= "\t\t\t\t</other_specifications>\n";
                                }
                                $xml .= "\t\t\t</product_detail>\n";
                                $xml .= "\t\t</item>\n";
                            }
                        }
                        //get_children
                        //get_available_variation
                        break;
                    case 'external':
                        $xml .= "\t\t<item>\n";
                        $xml .= "\t\t\t<id>" . $product->get_id() . "</id>\n";
                        $xml .= "\t\t\t<sku>" . $product->get_sku() . "</sku>\n";
                        $xml .= "\t\t\t<title>" . $product->get_name() . "</title>\n";
                        $xml .= "\t\t\t<product_type>" . $product->get_type() . "</product_type>\n";
                        if ($product->get_description()) {
                            $xml .= "\t\t\t<description>" . $product->get_description() . "</description>\n";
                        }
                        if ($product_slug) {
                            $xml .= "\t\t\t<link>" . $product_slug . "</link>\n";
                        }
                        if ($image) {
                            $xml .= "\t\t\t<image_link>" . $image . "</image_link>\n";
                        }
                        if ($product->get_price()) {
                            $xml .= "\t\t\t<price>" . $product->get_price() . "</price>\n";
                        }
                        if ($product->get_sale_price()) {
                            $xml .= "\t\t\t<sale_price>" . $product->get_sale_price() . "</sale_price>\n";
                        }
                        /*if ($product->get_categories()) {
                            $xml .= "\t\t\t<categories>" . strip_tags($product->get_categories()) . "</categories>\n";
                        }*/
                        if ($product->get_category_ids() && !empty($product->get_category_ids())) {
                            $xml .= "\t\t\t<category_ids>" . implode(',', $product->get_category_ids()) . "</category_ids>\n";
                            $categories = $product->get_category_ids();
                            if ($categories) {
                                $xml .= "\t\t\t<categories>";
                                foreach ($categories as $categoryID) {
                                    $category = get_term_by('id', $categoryID, 'product_cat');
                                    if ($category) {
                                        $xml .= "\t\t\t\t<category>\n";
                                        $xml .= "\t\t\t\t\t<category_id>" . $category->term_id . "</category_id>\n";
                                        $xml .= "\t\t\t\t\t<category_title>" . $category->name . "</category_title>\n";
                                        $xml .= "\t\t\t\t\t<category_link>" . get_url((get_url_lang_prefix()) .  '/product-category/' . $category->slug . '/') . "</category_link>\n";
                                        $xml .= "\t\t\t\t</category>\n";
                                    }
                                }
                                $xml .= "\t\t\t</categories>\n";
                            }
                        }
                        if ($product->get_parent_id()) {
                            $xml .= "\t\t\t<group_id>" . $product->get_parent_id() . "</group_id>\n";
                        }
                        if ($product->get_product_url()) {
                            $xml .= "\t\t\t<product_url>" . $product->get_product_url() . "</product_url>\n";
                        }
                        if ($product->get_button_text()) {
                            $xml .= "\t\t\t<button_text>" . $product->get_button_text() . "</button_text>\n";
                        }
                        $xml .= "\t\t\t<product_detail>\n";
                        if ($benefits) {
                            $xml .= "\t\t\t\t<benefits>";
                            foreach ($benefits as $benefit) {
                                if ($benefit['title']) {
                                    $xml .= "\t\t\t\t\t<benefit>\n";
                                    $xml .= "\t\t\t\t\t\t<benefit_title>" . $benefit['title'] . "</benefit_title>\n";
                                    $xml .= "\t\t\t\t\t</benefit>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</benefits>\n";
                        }
                        if ($specifications) {
                            $xml .= "\t\t\t\t<specifications>";
                            foreach ($specifications as $specification) {
                                if ($specification['title']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['title'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</specifications>\n";
                        }
                        if ($other_specifications) {
                            $xml .= "\t\t\t\t<other_specifications>";
                            foreach ($other_specifications as $specification) {
                                if ($specification['name']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['name'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_units>" . $specification['units'] . "</specification_units>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_indicators>" . $specification['indicators'] . "</specification_indicators>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_standard>" . $specification['standart'] . "</specification_standard>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</other_specifications>\n";
                        }
                        $xml .= "\t\t\t</product_detail>\n";
                        $xml .= "\t\t</item>\n";
                        //get_product_url
                        //get_button_text
                        break;
                    case 'grouped':
                        $xml .= "\t\t<item>\n";
                        $xml .= "\t\t\t<id>" . $product->get_id() . "</id>\n";
                        $xml .= "\t\t\t<sku>" . $product->get_sku() . "</sku>\n";
                        $xml .= "\t\t\t<title>" . $product->get_name() . "</title>\n";
                        $xml .= "\t\t\t<product_type>" . $product->get_type() . "</product_type>\n";
                        if ($product->get_description()) {
                            $xml .= "\t\t\t<description>" . $product->get_description() . "</description>\n";
                        }
                        if ($product_slug) {
                            $xml .= "\t\t\t<link>" . $product_slug . "</link>\n";
                        }
                        if ($image) {
                            $xml .= "\t\t\t<image_link>" . $image . "</image_link>\n";
                        }
                        if ($product->get_price()) {
                            $xml .= "\t\t\t<price>" . $product->get_price() . "</price>\n";
                        }
                        if ($product->get_sale_price()) {
                            $xml .= "\t\t\t<sale_price>" . $product->get_sale_price() . "</sale_price>\n";
                        }
                        /*if ($product->get_categories()) {
                            $xml .= "\t\t\t<categories>" . strip_tags($product->get_categories()) . "</categories>\n";
                        }*/
                        if ($product->get_category_ids() && !empty($product->get_category_ids())) {
                            $xml .= "\t\t\t<category_ids>" . implode(',', $product->get_category_ids()) . "</category_ids>\n";
                            $categories = $product->get_category_ids();
                            if ($categories) {
                                $xml .= "\t\t\t<categories>";
                                foreach ($categories as $categoryID) {
                                    $category = get_term_by('id', $categoryID, 'product_cat');
                                    if ($category) {
                                        $xml .= "\t\t\t\t<category>\n";
                                        $xml .= "\t\t\t\t\t<category_id>" . $category->term_id . "</category_id>\n";
                                        $xml .= "\t\t\t\t\t<category_title>" . $category->name . "</category_title>\n";
                                        $xml .= "\t\t\t\t\t<category_link>" . get_url((get_url_lang_prefix()) .  '/product-category/' . $category->slug . '/') . "</category_link>\n";
                                        $xml .= "\t\t\t\t</category>\n";
                                    }
                                }
                                $xml .= "\t\t\t</categories>\n";
                            }
                        }
                        if ($product->get_parent_id()) {
                            $xml .= "\t\t\t<group_id>" . $product->get_parent_id() . "</group_id>\n";
                        }
                        $xml .= "\t\t\t<product_detail>\n";
                        if ($benefits) {
                            $xml .= "\t\t\t\t<benefits>";
                            foreach ($benefits as $benefit) {
                                if ($benefit['title']) {
                                    $xml .= "\t\t\t\t\t<benefit>\n";
                                    $xml .= "\t\t\t\t\t\t<benefit_title>" . $benefit['title'] . "</benefit_title>\n";
                                    $xml .= "\t\t\t\t\t</benefit>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</benefits>\n";
                        }
                        if ($specifications) {
                            $xml .= "\t\t\t\t<specifications>";
                            foreach ($specifications as $specification) {
                                if ($specification['title']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['title'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</specifications>\n";
                        }
                        if ($other_specifications) {
                            $xml .= "\t\t\t\t<other_specifications>";
                            foreach ($other_specifications as $specification) {
                                if ($specification['name']) {
                                    $xml .= "\t\t\t\t\t<specification>";
                                    $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['name'] . "</specification_title>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_units>" . $specification['units'] . "</specification_units>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_indicators>" . $specification['indicators'] . "</specification_indicators>\n";
                                    $xml .= "\t\t\t\t\t\t<specification_standard>" . $specification['standart'] . "</specification_standard>\n";
                                    $xml .= "\t\t\t\t\t</specification>\n";
                                }
                            }
                            $xml .= "\t\t\t\t</other_specifications>\n";
                        }
                        $xml .= "\t\t\t</product_detail>\n";
                        $xml .= "\t\t</item>\n";

                        $child_products = $product->get_children();
                        if ($child_products) {
                            foreach ($child_products as $child_product_id) {
                                $child_product = wc_get_product($child_product_id);
                                if (!$child_product) continue;
                                $child_product_status = $child_product->get_status();
                                if ($child_product_status != 'publish') continue;
                                $child_image = get_the_post_thumbnail_url($child_product->get_id(), 'orig');
                                $child_product_slug = $child_product->get_slug();
                                $child_product_slug = get_url((get_url_lang_prefix()) .  '/product/' . $product_slug . '/');

                                $child_benefits = get_field('benefits', $child_product->get_id());
                                $child_specifications = get_field('specifications', $child_product->get_id());
                                $child_other_specifications = get_field('other_specifications', $child_product->get_id());

                                $xml .= "\t\t<item>\n";
                                $xml .= "\t\t\t<id>" . $child_product->get_id() . "</id>\n";
                                $xml .= "\t\t\t<sku>" . $child_product->get_sku() . "</sku>\n";
                                $xml .= "\t\t\t<title>" . $child_product->get_name() . "</title>\n";
                                $xml .= "\t\t\t<product_type>" . $child_product->get_type() . "</product_type>\n";
                                if ($child_product->get_description()) {
                                    $xml .= "\t\t\t<description>" . $child_product->get_description() . "</description>\n";
                                }
                                if ($child_product_slug) {
                                    $xml .= "\t\t\t<link>" . $child_product_slug . "</link>\n";
                                }
                                if ($child_image) {
                                    $xml .= "\t\t\t<image_link>" . $child_image . "</image_link>\n";
                                }
                                if ($child_product->get_price()) {
                                    $xml .= "\t\t\t<price>" . $child_product->get_price() . "</price>\n";
                                }
                                if ($child_product->get_sale_price()) {
                                    $xml .= "\t\t\t<sale_price>" . $child_product->get_sale_price() . "</sale_price>\n";
                                }
                                /*if ($child_product->get_categories()) {
                                    $xml .= "\t\t\t<categories>" . strip_tags($child_product->get_categories()) . "</categories>\n";
                                }*/
                                if ($child_product->get_category_ids() && !empty($child_product->get_category_ids())) {
                                    $xml .= "\t\t\t<category_ids>" . implode(',', $child_product->get_category_ids()) . "</category_ids>\n";
                                    $categories = $child_product->get_category_ids();
                                    if ($categories) {
                                        $xml .= "\t\t\t<categories>";
                                        foreach ($categories as $categoryID) {
                                            $category = get_term_by('id', $categoryID, 'product_cat');
                                            if ($category) {
                                                $xml .= "\t\t\t\t<category>\n";
                                                $xml .= "\t\t\t\t\t<category_id>" . $category->term_id . "</category_id>\n";
                                                $xml .= "\t\t\t\t\t<category_title>" . $category->name . "</category_title>\n";
                                                $xml .= "\t\t\t\t\t<category_link>" . get_url((get_url_lang_prefix()) .  '/product-category/' . $category->slug . '/') . "</category_link>\n";
                                                $xml .= "\t\t\t\t</category>\n";
                                            }
                                        }
                                        $xml .= "\t\t\t</categories>\n";
                                    }
                                }
                                if ($child_product->get_parent_id()) {
                                    $xml .= "\t\t\t<group_id>" . $child_product->get_parent_id() . "</group_id>\n";
                                }
                                $xml .= "\t\t\t<product_detail>\n";
                                if ($child_benefits) {
                                    $xml .= "\t\t\t\t<benefits>";
                                    foreach ($child_benefits as $benefit) {
                                        if ($benefit['title']) {
                                            $xml .= "\t\t\t\t\t<benefit>\n";
                                            $xml .= "\t\t\t\t\t\t<benefit_title>" . $benefit['title'] . "</benefit_title>\n";
                                            $xml .= "\t\t\t\t\t</benefit>\n";
                                        }
                                    }
                                    $xml .= "\t\t\t\t</benefits>\n";
                                }
                                if ($child_specifications) {
                                    $xml .= "\t\t\t\t<specifications>";
                                    foreach ($child_specifications as $specification) {
                                        if ($specification['title']) {
                                            $xml .= "\t\t\t\t\t<specification>";
                                            $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['title'] . "</specification_title>\n";
                                            $xml .= "\t\t\t\t\t</specification>\n";
                                        }
                                    }
                                    $xml .= "\t\t\t\t</specifications>\n";
                                }
                                if ($child_other_specifications) {
                                    $xml .= "\t\t\t\t<other_specifications>";
                                    foreach ($child_other_specifications as $specification) {
                                        if ($specification['name']) {
                                            $xml .= "\t\t\t\t\t<specification>";
                                            $xml .= "\t\t\t\t\t\t<specification_title>" . $specification['name'] . "</specification_title>\n";
                                            $xml .= "\t\t\t\t\t\t<specification_units>" . $specification['units'] . "</specification_units>\n";
                                            $xml .= "\t\t\t\t\t\t<specification_indicators>" . $specification['indicators'] . "</specification_indicators>\n";
                                            $xml .= "\t\t\t\t\t\t<specification_standard>" . $specification['standart'] . "</specification_standard>\n";
                                            $xml .= "\t\t\t\t\t</specification>\n";
                                        }
                                    }
                                    $xml .= "\t\t\t\t</other_specifications>\n";
                                }
                                $xml .= "\t\t\t</product_detail>\n";
                                $xml .= "\t\t</item>\n";
                            }
                        }
                        //get_children
                        break;
                }
                if ($product) {

                }
            }
        }
        $xml .= "\t</channel>\n";
        $xml .= "</rss>";

        header("Content-type: text/xml; charset=utf-8");
        $saveFile = isset($_REQUEST['download']) && $_REQUEST['download'] ? true : false;
        if ($saveFile) {
            header('Content-Disposition: attachment; filename="products-' . date("YmdHis") . '.xml"');
            header('Cache-Control: max-age=0');// If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: no-cache, public'); // HTTP/1.0
        }
        echo $xml;
        exit;
    }
}
add_action('init', 'export_products_to_xml');

?>
