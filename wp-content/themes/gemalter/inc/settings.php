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
    //wp_enqueue_style('my-wp-admin', get_template_directory_uri() .'/wp-admin.css' );
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

/*function recalculate_product_price() {
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
add_action('wp_ajax_nopriv_recalculate_price', 'recalculate_product_price');*/

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


/*function redirect_cart_page() {
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
add_action('template_redirect', 'redirect_cart_page');*/

function woocommerce_after_checkout_validation_function( $data, $errors ){
    unset($errors->errors['shipping']);
}
add_action( 'woocommerce_after_checkout_validation', 'woocommerce_after_checkout_validation_function', 10, 2 );

add_filter('woocommerce_add_error', function ($message){
    $message = pll__($message);
    return $message;
}, 20, 3);

/*old end*/

/*gemaiter start*/
// posts per page
function modify_port_per_page( $query ) {
    if ( ! is_admin()) {
        $query->set('posts_per_page', 10);
    }
    if ( ! is_admin() && is_home() && $query->get('post_type') != 'acf-field') {
        $query->set('posts_per_page', 4);
    }
    if (! is_admin() && $query->get('post_type') == 'post') {
        $query->set( 'posts_per_page', 4);
    }
    if ( ! is_admin() && is_category()) {
        $query->set( 'posts_per_page', 4);
    }
    if (! is_admin() && $query->get('post_type') == 'gallery') {
        $query->set( 'posts_per_page', 7);
    }
    //wp_title();
}
add_action( 'pre_get_posts', 'modify_port_per_page' );

//translate title tag
function custom_theme_titles( $titleparts ) {
    $titleparts['title'] = pll__($titleparts['title']);
    return $titleparts;
}
add_filter( 'document_title_parts', 'custom_theme_titles', PHP_INT_MAX );

// setting default language on site
function set_pll_preferred_language() {
    if (!isset($_COOKIE[PLL_COOKIE])) {
        $langSlug = 'de';
        $lang = PLL()->model->get_language( $langSlug );
        PLL()->curlang = $lang;
        setcookie(
            PLL_COOKIE,
            $langSlug,
            strtotime('+1 year'),
            COOKIEPATH,
            COOKIE_DOMAIN,
            is_ssl()
        );
        wp_redirect('/?lang=' . $langSlug);
    }
}
//add_action( 'init', 'set_pll_preferred_language', 1);

function ajax_add_to_cart_gift_card() {
    $current_lang = pll_current_language();
    $productSlug = 'gift-card';
    $product = null;
    if ($productObject = get_page_by_path( 'gift-card', OBJECT, 'product' )) {
        $product = wc_get_product($productObject->ID);
    }
    $product_id = $product ? $product->get_id() : 0;
    $hasError = false;
    $errorMessage = '';
    $attributes = [
        'gift_amount',
        'gift_currency',
        'gift_sender_name',
        'gift_recipient_name',
        'gift_message',
    ];
    $product_attributes = [];
    foreach ($attributes as $attribute) {
        $product_attributes[$attribute] = isset($_REQUEST[$attribute]) ? trim($_REQUEST[$attribute]) : null;
    }
    if (!$product) {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('An error occurred. Product not found.')
        ]);
        wp_die();
    }
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    $price = 0;
    if (isset($product_attributes['gift_amount']) && $product_attributes['gift_amount']) {
        $price = $product_attributes['gift_amount'];
    }
    //there will be attributes
    $cart_item_data['attributes'] = $product_attributes;
    $cart_item_data['price'] = $price;

    $variation_id = 0;
    $variation = wc_get_product_variation_attributes( $variation_id );

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('An error occurred. The product cannot be added to the cart.')
        ]);
        wp_die();
    }

    echo json_encode([
        'has_error' => false,
        'redirect_link' => esc_url((get_url_lang_prefix()) . 'cart/'),
        'total_products' => WC()->cart->get_cart_contents_count(),
    ]);
    wp_die();
}
add_action('wp_ajax_ajax_add_to_cart_gift_card', 'ajax_add_to_cart_gift_card');
add_action('wp_ajax_nopriv_ajax_add_to_cart_gift_card', 'ajax_add_to_cart_gift_card');

/*function ajax_add_to_cart2() {
    test($_REQUEST);
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
add_action('wp_ajax_ajax_add_to_cart2', 'ajax_add_to_cart2');
add_action('wp_ajax_nopriv_ajax_add_to_cart2', 'ajax_add_to_cart2');*/


/*add filter to coupons: coupon_main_type*/
function add_coupon_main_type() {
    $screen = get_current_screen();
    if ( $screen->id != "edit-shop_coupon" ) {   // Only add to coupons page
        return;
    }
    $coupon_main_type = isset($_REQUEST['coupon_main_type']) && $_REQUEST['coupon_main_type'] ? trim($_REQUEST['coupon_main_type']) : '';
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($)
        {
            $('#posts-filter #post-query-submit').before('<select name="coupon_main_type" id="dropdown_shop_coupon_main_type">\n' +
                '\t\t\t<option value="">Show all Main types</option>\n' +
                '\t\t\t<option value="general" <?php if ($coupon_main_type == 'general'):?>selected<?php endif;?>>General</option>' +
                '\t\t\t<option value="gift_card" <?php if ($coupon_main_type == 'gift_card'):?>selected<?php endif;?>>Gift Card</option>' +
                '</select>');
        });
    </script>
    <?php
}
add_action('admin_footer', 'add_coupon_main_type');
function filter_coupon_main_type($query) {
    if (isset($_REQUEST['coupon_main_type']) && $_REQUEST['coupon_main_type']) {
        $coupon_main_type = trim($_REQUEST['coupon_main_type']);
        $query->set('meta_key', 'coupon_main_type');
        $query->set('meta_value', $coupon_main_type);
    }
}
add_action('pre_get_posts', 'filter_coupon_main_type');

/*gemaiter end*/

?>
