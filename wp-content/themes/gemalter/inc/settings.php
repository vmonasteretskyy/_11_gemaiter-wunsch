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
            'error_title' => pll__('Error'),
            'error_message' => pll__('An error occurred. Product cannot be deleted.'),
        ]);
        wp_die();
    } else {
        $cartItems = WC()->cart->get_cart();
        $hasRelated = false;
        foreach($cartItems as $key => $item) {
            if ($key == $cart_item_key) {
                continue;
            }
            if (isset($item['attributes']['cart_discounted_hash']) && $item['attributes']['cart_discounted_hash'] == $cart_item_key) {
                $hasRelated = true;
                break;
            }
        }
        if ($hasRelated) {
            echo json_encode([
                'has_error' => true,
                'error_title' => pll__('Error'),
                'error_message' => pll__('Product cannot be deleted. This Product has discount related products.'),
            ]);
            wp_die();
        }
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
        'total' => WC()->cart->get_total(),
        'subtotal' => wc_price(WC()->cart->get_subtotal()),
        'discount' => wc_price(WC()->cart->get_discount_total()),
        'discount_main' => WC()->cart->get_discount_total(),
    );
    wp_send_json( $data );
    die();
}
add_action( 'wp_ajax_product_remove', 'ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'ajax_product_remove' );

function ajax_apply_coupon()
{
    ob_start();
    $coupon = isset($_POST['coupon']) ? trim($_POST['coupon']) : '';
    if (!$coupon) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => pll__('Gift Card is empty.'),
        ]);
        wp_die();
    } else {
        $applied = WC()->cart->apply_coupon($coupon);
        $errors = wc_print_notices(true);
        $errors = strip_tags($errors);
        if ($errors) {
            $errorWithoutCoupon = str_replace($coupon, "___", $errors);
            $errorWithoutCoupon = pll__($errorWithoutCoupon);
            $errors = str_replace("___", $coupon, $errorWithoutCoupon);
        }
        if (!$applied) {
            echo json_encode([
                'has_error' => true,
                'error_title' => pll__('Error'),
                'error_message' => $errors,
            ]);
            wp_die();
        }
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
        'subtotal' => wc_price(WC()->cart->get_subtotal()),
        'discount' => wc_price(WC()->cart->get_discount_total()),
        'discount_main' => WC()->cart->get_discount_total(),
    );
    wp_send_json( $data );
    die();
}
add_action( 'wp_ajax_apply_coupon', 'ajax_apply_coupon' );
add_action( 'wp_ajax_nopriv_apply_coupon', 'ajax_apply_coupon' );

function ajax_cancel_coupon()
{
    ob_start();
    $coupon = isset($_POST['coupon']) ? trim($_POST['coupon']) : '';
    if (!$coupon) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => pll__('Gift Card is empty.'),
        ]);
        wp_die();
    } else {
        $removed = WC()->cart->remove_coupon($coupon);
        $errors = wc_print_notices(true);
        $errors = strip_tags($errors);
        if ($errors) {
            $errorWithoutCoupon = str_replace($coupon, "___", $errors);
            $errorWithoutCoupon = pll__($errorWithoutCoupon);
            $errors = str_replace("___", $coupon, $errorWithoutCoupon);
        }
        if (!$removed) {
            echo json_encode([
                'has_error' => true,
                'error_title' => pll__('Error'),
                'error_message' => $errors,
            ]);
            wp_die();
        }
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
        'subtotal' => wc_price(WC()->cart->get_subtotal()),
        'discount' => wc_price(WC()->cart->get_discount_total()),
        'discount_main' => WC()->cart->get_discount_total(),
    );
    wp_send_json( $data );
    die();
}
add_action( 'wp_ajax_cancel_coupon', 'ajax_cancel_coupon' );
add_action( 'wp_ajax_nopriv_cancel_coupon', 'ajax_cancel_coupon' );

function set_quantity() {
    $cart_item_key = isset($_POST['cart_item_key']) ? trim($_POST['cart_item_key']) : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if (!$cart_item_key) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => pll__('An error occurred. Product not found.')
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
        'item_total_price' => wc_price($item_total_price),
        'total' => WC()->cart->get_total(),
        'subtotal' => wc_price(WC()->cart->get_subtotal()),
        'discount' => wc_price(WC()->cart->get_discount_total()),
        'discount_main' => WC()->cart->get_discount_total(),
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
    $allPricesData = getPrices();
    $site_currency = $allPricesData[$current_lang]['currency'];

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
    $product_attributes['gift_id'] = getRandString(8);
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
        //coef (usd to eur) logic
        $currency_coef = get_field('currency_usd_to_eur', 'option');
        if (isset($product_attributes['gift_currency']) && $product_attributes['gift_currency'] && $product_attributes['gift_currency'] != $site_currency) {
            if ($site_currency == 'usd') {
                $price = $price * $currency_coef;
            } else if ($site_currency == 'eur') {
                $price = $price / $currency_coef;
            }
            $price = intval($price);
        }
    }
    //there will be attributes
    $product_attributes['product_type'] = 'gift-card';
    $product_attributes['locale'] = $current_lang;
    $cart_item_data['attributes'] = $product_attributes;
    $cart_item_data['price'] = $price;

    $cart_item_key = isset($_REQUEST['cart_item_key']) ? trim($_REQUEST['cart_item_key']) : '';
    $variation_id = 0;
    $variation = wc_get_product_variation_attributes( $variation_id );

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ($cart_item_key) {
            $delete = WC()->cart->remove_cart_item($cart_item_key);
        }
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

function ajax_get_sizes() {
    $current_lang = pll_current_language();
    $allPricesData = getPrices();
    $data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
    $data['currency'] = $allPricesData[$current_lang]['currency'];
    $data['use_size'] = $allPricesData[$current_lang]['use_size'];

    $priceType = 'regular';
    $deliveryDate = isset($_REQUEST['delivery_date']) ? trim($_REQUEST['delivery_date']) : '';
    $priceTypeSelected = isset($_REQUEST['duration_type']) ? trim($_REQUEST['duration_type']) : '';
    if ($priceTypeSelected) {
        $priceType = $priceTypeSelected;
    }

    $subjectType = 'person_1';
    $subject = isset($_REQUEST['subject']) ? trim($_REQUEST['subject']) : '';
    $subjectType = $subject;

    $chooseTech = isset($_REQUEST['choose_tech']) ? trim($_REQUEST['choose_tech']) : '';

    $cartDiscountedHash = isset($_REQUEST['cart_discounted_hash']) ? trim($_REQUEST['cart_discounted_hash']) : '';
    $cartDiscountedRecord = getCardItemRecord($cartDiscountedHash);
    if ($cartDiscountedRecord) {
        if (isset($cartDiscountedRecord['attributes']['product_type']) && $cartDiscountedRecord['attributes']['product_type'] != 'picture') {
            $cartDiscountedRecord = null;
        }
        if (isset($cartDiscountedRecord['attributes']['locale']) && $cartDiscountedRecord['attributes']['locale'] != $current_lang) {
            $cartDiscountedRecord = null;
        }
    }
    if (!$cartDiscountedRecord) {
        $cartDiscountedHash = '';
    }
    $discount = null;
    if ($cartDiscountedRecord) {
        $baseDiscountPrice = $cartDiscountedRecord['price'];
        $currency = $allPricesData[$current_lang]['currency'];
        $discount = getDiscount($baseDiscountPrice, $currency);
    }

    if ($subject == 'custom') {
        $countSubjects = 0;
        $customPersons = isset($_REQUEST['subject_custom']['persons']) ? trim($_REQUEST['subject_custom']['persons']) : 0;
        $customPets = isset($_REQUEST['subject_custom']['pets']) ? trim($_REQUEST['subject_custom']['pets']) : 0;
        $subjectCustomMaxElements = isset($_REQUEST['subject_custom_max_elements']) ? trim($_REQUEST['subject_custom_max_elements']) : 0;
        $countSubjects = $customPersons + $customPets;
        if ($countSubjects > $subjectCustomMaxElements) {
            $countSubjects = $subjectCustomMaxElements;
        }
        if ($countSubjects < 1) {
            $countSubjects = 1;
        }
        $subjectType = 'person_' . $countSubjects;

        if ($chooseTech) {
            if ($chooseTech == 'oil' && $countSubjects > 16) {
                echo json_encode([
                    'has_error' => true,
                    'error_title' => pll__('Error'),
                    'error_message' => pll__('Only 16 persons are possible for oil.')
                ]);
                wp_die();
            }
            if ($chooseTech == 'charcoal' && $countSubjects > 7) {
                echo json_encode([
                    'has_error' => true,
                    'error_title' => pll__('Error'),
                    'error_message' => pll__('Only 7 persons are possible for charcoal.')
                ]);
                wp_die();
            }
        }
    } else {
        $subjects = getSubjects();
        if (isset($subjects[$subject])) {
            $subjectType = $subjects[$subject]['price_type'];
        }
    }

    $data['sizes'] = getSizesBySubjectTechnique($current_lang, $chooseTech, $subjectType, $priceType);
    $data['default_size'] = null;
    if (!empty($data['sizes'])) {
        foreach($data['sizes'] as $sizeKey => $sizeItem) {
            if (isset($sizeItem['available']) && $sizeItem['available']) {
                $data['default_size'] = $sizeKey;
                break;
            }
        }
    }
    $size = isset($_REQUEST['size']) ? trim($_REQUEST['size']) : '';
    $hidden_size = isset($_REQUEST['hidden_size']) ? trim($_REQUEST['hidden_size']) : '';
    if ($hidden_size) {
        $size = $hidden_size;
    }
    if (!$size) {
        $size = $data['default_size'];
    }
    if (!isset($data['sizes'][$size]) || (isset($data['sizes'][$size]['available']) && !$data['sizes'][$size]['available'])) {
        $size = $data['default_size'];
    }
    $price = $data['sizes'][$size]['price'];
    $discountOutput = getDiscount($price, $data['currency']);

    $html = '';
    ob_start();
?>
    <input type="hidden" name="hidden_size" value="">
<?php
    if (!empty($data['sizes'])):
        foreach ($data['sizes'] as $keySize => $itemSize):
?>
            <div class="radio-button-wrap">
                <label class="radio-button radio-button--size r-size-card js-radio-summary">
                    <input type="radio" <?php if ($keySize == $size): ?>checked="checked"<?php endif;?>  name="size" <?php if (!$itemSize['available']):?>disabled<?php endif; ?> class="picture_input" data-w='<?php if ($data['use_size'] == 'inch'): ?><?php echo $itemSize['label_width_inch']; ?><?php else: ?><?php echo $itemSize['label_width']; ?><?php endif; ?>' data-h='<?php if ($data['use_size'] == 'inch'): ?><?php echo $itemSize['label_height_inch']; ?><?php else: ?><?php echo $itemSize['label_height']; ?><?php endif; ?>' value="<?php echo $keySize; ?>" data-summary='result-size' data-summary_text="<?php if ($data['use_size'] == 'inch'): ?><?php echo $itemSize['label_inch']; ?><?php else: ?><?php echo $itemSize['label']; ?><?php endif; ?>">
                    <span class="checkmark"></span>
                    <p class="r-size-card__size">
                        <?php if ($data['use_size'] == 'inch'): ?>
                            <?php echo $itemSize['label_inch']; ?>
                        <?php else: ?>
                            <?php echo $itemSize['label']; ?>
                        <?php endif; ?>
                        <?php if ($itemSize['available'] && isset($itemSize['price']) && $itemSize['price']):?>
                            <?php if ($discount): ?>
                                <span title="<?php pll_e('Old price');?> <?php echo $data['currency_symbol'] . ' ' . $itemSize['price']; ?>">
                                    <?php echo $data['currency_symbol'] . ' ' . ($itemSize['price'] - $discount['value']); ?>**
                                </span>
                            <?php else:?>
                                <span>
                                    <?php echo $data['currency_symbol'] . ' ' . $itemSize['price']; ?>
                                </span>
                            <?php endif;?>
                        <?php endif; ?>
                    </p>
                    <span class="r-size-card__descr">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32.8187 27.7252C32.7391 27.7119 32.6589 27.7088 32.5798 27.7161C32.4702 27.7132 28.875 27.7115 28.875 27.7115V25.4927C31.6793 23.8239 33.5625 20.7626 33.5625 17.2693V9.79744C34.0605 8.88862 34.3442 7.84641 34.3442 6.73903V0.9375C34.3442 0.419813 33.9245 0 33.4067 0H19.9531C16.3432 0 13.4062 2.93691 13.4062 6.54684V8.45316C13.4062 9.55875 13.7931 10.5753 14.4375 11.3762V17.2693C14.4375 20.7626 16.3208 23.8239 19.125 25.4927V27.7115C19.125 27.7115 15.5303 27.7132 15.4209 27.7161C15.3414 27.7087 15.2608 27.7118 15.1808 27.7253C8.72381 28.0236 3.5625 33.3696 3.5625 39.899V47.0625C3.5625 47.5802 3.98222 48 4.5 48H43.5C44.0178 48 44.4375 47.5802 44.4375 47.0625V39.899C44.4375 33.3694 39.2758 28.0233 32.8187 27.7252ZM15.2812 8.45316V6.54684C15.2812 3.97078 17.377 1.875 19.9531 1.875H32.4691V3.75H25.3594C24.8416 3.75 24.4219 4.16981 24.4219 4.6875C24.4219 5.20519 24.8416 5.625 25.3594 5.625H32.4692V6.73903C32.4692 9.22641 30.4456 11.25 27.9582 11.25H18.0781C16.5359 11.25 15.2812 9.99534 15.2812 8.45316ZM16.3125 17.2693V12.7775C16.8576 13.0009 17.4535 13.125 18.0781 13.125H27.9581C29.3495 13.125 30.6373 12.6764 31.6874 11.9181V17.2693C31.6874 21.5082 28.2388 24.9568 23.9999 24.9568C19.761 24.9568 16.3125 21.5082 16.3125 17.2693ZM27 26.3493V27.774C27 29.4282 25.6542 30.774 24 30.774C22.3458 30.774 21 29.4282 21 27.774V26.3493C21.944 26.6619 22.9524 26.8318 24 26.8318C25.0476 26.8318 26.056 26.6619 27 26.3493ZM19.4758 29.5865C20.1967 31.3793 21.9523 32.649 24 32.649C26.0477 32.649 27.8033 31.3793 28.5242 29.5865H31.0407L24 41.7813L16.9593 29.5865H19.4758ZM42.5625 46.125H39.1875V41.625C39.1875 41.1073 38.7678 40.6875 38.25 40.6875C37.7322 40.6875 37.3125 41.1073 37.3125 41.625V46.125H10.6875V38.6421C10.6875 38.1244 10.2678 37.7046 9.75 37.7046C9.23222 37.7046 8.8125 38.1244 8.8125 38.6421V46.125H5.4375V39.899C5.4375 34.5265 9.56728 30.1012 14.8188 29.6289L23.188 44.125C23.3555 44.4151 23.6649 44.5938 23.9999 44.5938C24.3349 44.5938 24.6443 44.4151 24.8118 44.125L33.181 29.6289C38.4327 30.1012 42.5625 34.5265 42.5625 39.899V46.125Z" fill="#F9AB97"/>
                            <path d="M21.4948 16.3645C21.3205 16.1902 21.0786 16.0898 20.832 16.0898C20.5855 16.0898 20.3436 16.1902 20.1692 16.3645C19.9948 16.5389 19.8945 16.7808 19.8945 17.0273C19.8945 17.2739 19.9948 17.5158 20.1692 17.6902C20.3436 17.8644 20.5855 17.9648 20.832 17.9648C21.0786 17.9648 21.3205 17.8645 21.4948 17.6902C21.6692 17.5158 21.7695 17.2739 21.7695 17.0273C21.7695 16.7808 21.6692 16.5389 21.4948 16.3645Z" fill="#F9AB97"/>
                            <path d="M27.8562 16.3645C27.6818 16.1902 27.4409 16.0898 27.1934 16.0898C26.9468 16.0898 26.7049 16.1902 26.5305 16.3645C26.3562 16.5389 26.2559 16.7808 26.2559 17.0273C26.2559 17.2739 26.3562 17.5158 26.5305 17.6902C26.7059 17.8645 26.9468 17.9648 27.1934 17.9648C27.4409 17.9648 27.6818 17.8645 27.8562 17.6902C28.0315 17.5158 28.1309 17.2739 28.1309 17.0273C28.1309 16.7808 28.0315 16.5389 27.8562 16.3645Z" fill="#F9AB97"/>
                            <path d="M22.3894 4.02469C22.215 3.85031 21.9731 3.75 21.7266 3.75C21.48 3.75 21.2381 3.85022 21.0637 4.02469C20.8894 4.19906 20.7891 4.44094 20.7891 4.6875C20.7891 4.93406 20.8894 5.17594 21.0637 5.35022C21.2381 5.52469 21.48 5.625 21.7266 5.625C21.9731 5.625 22.215 5.52469 22.3894 5.35022C22.5638 5.17594 22.6641 4.93406 22.6641 4.6875C22.6641 4.44094 22.5638 4.19906 22.3894 4.02469Z" fill="#F9AB97"/>
                            <path d="M25.4321 20.0772C25.066 19.7112 24.4724 19.7112 24.1062 20.0772C24.0228 20.1607 23.9254 20.173 23.8748 20.173C23.8242 20.173 23.7268 20.1606 23.6434 20.0772C23.2774 19.7112 22.6837 19.7112 22.3175 20.0772C21.9514 20.4433 21.9514 21.037 22.3175 21.4031C22.7469 21.8324 23.3108 22.0471 23.8748 22.0471C24.4388 22.0471 25.0027 21.8324 25.4321 21.4031C25.7982 21.037 25.7982 20.4433 25.4321 20.0772Z" fill="#F9AB97"/>
                            <path d="M38.9128 37.4173C38.7384 37.2429 38.4966 37.1426 38.25 37.1426C38.0034 37.1426 37.7616 37.2429 37.5872 37.4173C37.4128 37.5916 37.3125 37.8335 37.3125 38.0801C37.3125 38.3266 37.4128 38.5685 37.5872 38.7429C37.7616 38.9172 38.0034 39.0176 38.25 39.0176C38.4966 39.0176 38.7384 38.9173 38.9128 38.7429C39.0872 38.5685 39.1875 38.3266 39.1875 38.0801C39.1875 37.8335 39.0872 37.5916 38.9128 37.4173Z" fill="#F9AB97"/>
                        </svg>
                        <?php echo $itemSize['max_subjects']; ?> <?php pll_e('subject max'); ?>
                    </span>
                </label>
            </div>
<?php
        endforeach;
    endif;
    $htmlSizes = ob_get_contents();
    ob_end_clean();


    /*durations*/
    $data['duration_with_date'] = getDurationWithDates($chooseTech, $size);

    $deliveryHtml = '';
    ob_start();
?>
    <div class="delivery-types-wrapper">
        <p><?php pll_e('Get it on:'); ?></p>
        <?php $iter = 0;?>
        <?php foreach($data['duration_with_date']['types'] as $type => $typeData): ?>
            <?php $iter++;?>
            <label class="radio-button radio-button<?php echo $iter;?>">
                <input <?php if ($type == $priceTypeSelected):?>checked<?php endif;?> data-from="<?php echo $typeData['type_date_from']; ?>" data-calendar_class="<?php echo $typeData['type_calendar_style']; ?>" data-count="<?php echo $typeData['type_count']; ?>" type="radio"
                       name="duration_type" value="<?php echo $type; ?>"  class="select_day_radio">
                <span class="checkmark"></span>
                <p>
                    <?php echo $typeData['type_date']; ?>
                    <span class="new-text-pay"><?php echo $typeData['type_percent_label']; ?></span>
                    <br><span class="new-text-descrip"><?php echo $typeData['type_label']; ?></span>
                </p>
            </label>
        <?php endforeach; ?>
    </div>
    <div class="delivery-calendar-wrapper">
        <div class="delivery__calendar">
            <div class="datepicker-here-init" data-position="top right" data-language='<?php echo $current_lang;?>' data-orderDay='10'></div>
            <input type="hidden" name="delivery_date" data-delivery-type-related="" value="<?php echo $deliveryDate;?>" id="deliveryDate">
        </div>
    </div>
<?php

    $deliveryHtml = ob_get_contents();
    ob_end_clean();

    $customSubject = isset($_REQUEST['subject_custom']) ? $_REQUEST['subject_custom'] : [];
    $previewImgPath = getOrderPreviewImg($chooseTech, $subject, $customSubject, $size);

    echo json_encode([
        'has_error' => false,
        'html' => $htmlSizes,
        'delivery_html' => $deliveryHtml,
        'discount' => $discountOutput,
        'preview_img_path' => $previewImgPath,
    ]);
    wp_die();

}
add_action('wp_ajax_ajax_get_sizes', 'ajax_get_sizes');
add_action('wp_ajax_nopriv_ajax_get_sizes', 'ajax_get_sizes');

function ajax_add_to_cart_main_product() {
    $current_lang = pll_current_language();
    $productSlug = 'picture';
    $product = null;
    if ($productObject = get_page_by_path( $productSlug, OBJECT, 'product' )) {
        $product = wc_get_product($productObject->ID);
    }
    $product_id = $product ? $product->get_id() : 0;
    $hasError = false;
    $errorMessage = '';
    if (!$product) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => pll__('An error occurred. Product not found.')
        ]);
        wp_die();
    }
    $attributes = [
        'cart_discounted_hash',
        'subject',
        'subject_custom',
        'subject_custom_max_elements',
        'choose_tech',
        'size',
        'background_type',
        'color',
        //second step
        'photos',
        'photos_count',
        'photos_info',
        'second_option_to_send_photo',
        'artist_advice',
        'upload_comment',
        'frame',
        'frame_selected',
        //third step
        'duration_type',
        'delivery_date',
    ];
    $product_attributes = [];
    foreach ($attributes as $attribute) {
        $boolAttributes = [
            'second_option_to_send_photo',
            'artist_advice',
        ];
        $arrayAttributes = [
            'subject_custom'
        ];
        if (in_array($attribute, $boolAttributes)) {
            $product_attributes[$attribute] = isset($_REQUEST[$attribute]) && $_REQUEST[$attribute] ? true : false;
        } else if (in_array($attribute, $arrayAttributes)) {
            $product_attributes[$attribute] = isset($_REQUEST[$attribute]) ? $_REQUEST[$attribute] : [];
        } else {
            $product_attributes[$attribute] = isset($_REQUEST[$attribute]) ? trim($_REQUEST[$attribute]) : null;
        }
    }

    $product_attributes['subject_price_type'] = 'person_1';
    if (!$product_attributes['subject']) {
        $hasError = true;
        $errorMessage .= pll__('Number of subject is empty.') . '<br>';
    } else {
        if ($product_attributes['subject'] == 'custom') {
            $countSubjects = 0;
            $customPersons = isset($_REQUEST['subject_custom']['persons']) ? trim($_REQUEST['subject_custom']['persons']) : 0;
            $customPets = isset($_REQUEST['subject_custom']['pets']) ? trim($_REQUEST['subject_custom']['pets']) : 0;
            $subjectCustomMaxElements = isset($_REQUEST['subject_custom_max_elements']) ? trim($_REQUEST['subject_custom_max_elements']) : 0;
            $countSubjects = $customPersons + $customPets;
            if ($countSubjects > $subjectCustomMaxElements) {
                $countSubjects = $subjectCustomMaxElements;
            }
            if ($countSubjects < 1) {
                $countSubjects = 1;
            }
            $subjectType = 'person_' . $countSubjects;
            $product_attributes['subject_price_type'] = $subjectType;
            if ($product_attributes['choose_tech'] == 'oil' && $countSubjects > 16) {
                $hasError = true;
                $errorMessage .= pll__('You choose too many number of subjects. Please change number of subjects.') . '<br>';
            } else if ($product_attributes['choose_tech'] == 'charcoal' && $countSubjects > 7) {
                $hasError = true;
                $errorMessage .= pll__('You choose too many number of subjects. Please change number of subjects.') . '<br>';
            }
        } else {
            $subjects = getSubjects();
            if (isset($subjects[$product_attributes['subject']])) {
                $subjectType = $subjects[$product_attributes['subject']]['price_type'];
                $product_attributes['subject_price_type'] = $subjectType;
            }
        }
    }
    if (!$product_attributes['choose_tech']) {
        $hasError = true;
        $errorMessage .= pll__('Painting Technique is empty.') . '<br>';
    }
    if (!$product_attributes['size']) {
        $hasError = true;
        $errorMessage .= pll__('Size is empty.') . '<br>';
    }
    if (!$product_attributes['background_type']) {
        $hasError = true;
        $errorMessage .= pll__('Background is empty.');
    } else if ($product_attributes['background_type'] != 'background_color') {
        $product_attributes['color'] = null;
    }


    if ($product_attributes['second_option_to_send_photo']) {
        $product_attributes['photos'] = null;
        $product_attributes['photos_count'] = null;
        $product_attributes['photos_info'] = null;
    } else {
        if (!intval($product_attributes['photos_count'])) {
            $hasError = true;
            $errorMessage .= pll__("Photos are missing.") . '<br>';
        }
    }

    if ($product_attributes['frame'] == 'not_need_frame') {
        $product_attributes['frame_selected'] = null;
    }
    if (!$product_attributes['duration_type']) {
        $hasError = true;
        $errorMessage .= pll__('Delivery Type is empty.') . '<br>';
    }
    if (!$product_attributes['delivery_date']) {
        $hasError = true;
        $errorMessage .= pll__('Delivery Date is empty.') . '<br>';
    }
    if ($hasError) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => $errorMessage
        ]);
        wp_die();
    }

    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && 'publish' === $product_status) {
        //upload photos
        if (!$product_attributes['second_option_to_send_photo']) {
            $photosInfo = json_decode(str_replace('\"', '"', $product_attributes['photos_info']), 1);
            $photosCount = $product_attributes['photos_count'];
            $photos = [];
            $photosPrevElement = isset($_REQUEST['photos_prev_info']) ? json_decode(str_replace('\"', '"', $_REQUEST['photos_prev_info']), 1) : '';
            if (!empty($_FILES) && $_FILES['photos']['name']) {
                foreach ($_FILES['photos']['name'] as $f => $name) {
                    foreach ($photosInfo as $item) {
                        if ($name == $item['name']) {
                            $upload = wp_upload_bits($name, null, @file_get_contents($_FILES['photos']['tmp_name'][$f]));
                            if (!isset($upload['url']) || !$upload['url']) {
                                $hasError = true;
                                $errorMessage .= pll__("An error occurred while uploading image.") . ' (' . $name . ')' . '<br>';
                            } else {
                                $photos[] = [
                                    'name'=> $name,
                                    'path' => $upload['url'],
                                ];
                            }
                            break;
                        }
                    }
                    $count = !empty(count($photos)) ? $photos : 0;
                    if ($photosCount == $count) {
                        break;
                    }
                }
            } elseif ($photosPrevElement) {
                $photos = $photosPrevElement;
            }
            if (empty($photos)) {
                $hasError = true;
                $errorMessage .= pll__("Photos are missing.") . '<br>';
            }
            $product_attributes['photos'] = json_encode($photos);
        }
    }
    
    if ($hasError) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => $errorMessage
        ]);
        wp_die();
    }

    $price = 0;
    $basePrice = 0;
    $baseDiscountPrice = 0;
    $framePrice = 0;
    if (isset($product_attributes['subject_price_type']) && $product_attributes['subject_price_type'] && isset($product_attributes['choose_tech']) && $product_attributes['choose_tech'] && isset($product_attributes['size']) && $product_attributes['size'] && isset($product_attributes['duration_type']) && $product_attributes['duration_type']) {
        //calculate price
        $basePrice = getPriceByTechniqueSubjectSizeDuration($current_lang, $product_attributes['choose_tech'], $product_attributes['subject_price_type'], $product_attributes['size'], $product_attributes['duration_type']);
        //logic for discounted hash
        $baseDiscountPrice = 0;
        if (isset($product_attributes['cart_discounted_hash']) && $product_attributes['cart_discounted_hash']) {
            $cartDiscountedHash = $product_attributes['cart_discounted_hash'];
            $cartDiscountedRecord = getCardItemRecord($cartDiscountedHash);
            if (isset($cartDiscountedRecord['attributes']['product_type']) && $cartDiscountedRecord['attributes']['product_type'] != 'picture') {
                $cartDiscountedRecord = null;
            }
            if (isset($cartDiscountedRecord['attributes']['locale']) && $cartDiscountedRecord['attributes']['locale'] != $current_lang) {
                $cartDiscountedRecord = null;
            }
            if (!$cartDiscountedRecord) {
                $cartDiscountedHash = '';
            }
            $discount = null;
            if ($cartDiscountedRecord) {
                $baseDiscountPriceItem = $cartDiscountedRecord['price'];
                $allPricesData = getPrices();
                $currency = $allPricesData[$current_lang]['currency'];
                $discount = getDiscount($baseDiscountPriceItem, $currency);
                if ($discount) {
                    $baseDiscountPrice = $discount['value'];
                }
            }
        }
        $price += $basePrice;
        $price -= $baseDiscountPrice;
    }
    if ($product_attributes['frame_selected']) {
        $frame = get_term_by('slug', $product_attributes['frame_selected'], 'pa_frames');
        if ($frame) {
            $framePrice = get_field('frame_price', $frame->taxonomy . '_' . $frame->term_id);
            $price += $framePrice;
        }

    }
    //there will be attributes
    $product_attributes['product_type'] = 'picture';
    $product_attributes['locale'] = $current_lang;
    $product_attributes['base_price'] = $basePrice;
    $product_attributes['frame_price'] = $framePrice;
    $product_attributes['base_discount_price'] = $baseDiscountPrice;
    $cart_item_data['attributes'] = $product_attributes;
    $cart_item_data['price'] = $price;

    $cart_item_key = isset($_REQUEST['cart_item_key']) ? trim($_REQUEST['cart_item_key']) : '';
    $variation_id = 0;
    $variation = wc_get_product_variation_attributes( $variation_id );

    $cart_item_key_new = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data);
    if ($passed_validation && $cart_item_key_new && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ($cart_item_key) {
            $delete = WC()->cart->remove_cart_item($cart_item_key);
        }
    } else {
        echo json_encode([
            'has_error' => true,
            'error_message' => pll__('An error occurred. The product cannot be added to the cart.')
        ]);
        wp_die();
    }
    $mode = isset($_REQUEST['mode']) ? trim($_REQUEST['mode']) : 'cart';

    echo json_encode([
        'has_error' => false,
        'redirect_link' => esc_url((get_url_lang_prefix()) . $mode . '/' . ($mode == 'order' && $cart_item_key_new ? ('?discount_hash=' . $cart_item_key_new) : '')),
        'total_products' => WC()->cart->get_cart_contents_count(),
    ]);
    wp_die();
}
add_action('wp_ajax_ajax_add_to_cart_main_product', 'ajax_add_to_cart_main_product');
add_action('wp_ajax_nopriv_ajax_add_to_cart_main_product', 'ajax_add_to_cart_main_product');

function ajax_get_edit_order_form_html() {
    $current_lang = pll_current_language();
    $allPricesData = getPrices();
    $data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
    $data['use_size'] = $allPricesData[$current_lang]['use_size'];

    $priceType = 'regular';
    $deliveryDate = isset($_REQUEST['delivery_date']) ? trim($_REQUEST['delivery_date']) : '';
    $priceTypeSelected = isset($_REQUEST['duration_type']) ? trim($_REQUEST['duration_type']) : '';
    if ($priceTypeSelected) {
        $priceType = $priceTypeSelected;
    }

    $subjectType = 'person_1';
    $subject = isset($_REQUEST['subject']) ? trim($_REQUEST['subject']) : '';
    $subjectType = $subject;
    if ($subject == 'custom') {
        $countSubjects = 0;
        $customPersons = isset($_REQUEST['subject_custom']['persons']) ? trim($_REQUEST['subject_custom']['persons']) : 0;
        $customPets = isset($_REQUEST['subject_custom']['pets']) ? trim($_REQUEST['subject_custom']['pets']) : 0;
        $subjectCustomMaxElements = isset($_REQUEST['subject_custom_max_elements']) ? trim($_REQUEST['subject_custom_max_elements']) : 0;
        $countSubjects = $customPersons + $customPets;
        if ($countSubjects > $subjectCustomMaxElements) {
            $countSubjects = $subjectCustomMaxElements;
        }
        if ($countSubjects < 1) {
            $countSubjects = 1;
        }
        $subjectType = 'person_' . $countSubjects;
        $subjects = getSubjects();
    } else {
        $subjects = getSubjects();
        if (isset($subjects[$subject])) {
            $subjectType = $subjects[$subject]['price_type'];
        }
    }
    $postItem = get_page_by_path('order',OBJECT,'page');
    $fields = $postItem ? get_fields($postItem->ID) : null;
    $data['painting_techniques'] = [
        'charcoal' => isset($fields['choose_1']) ? $fields['choose_1'] : null,
        'oil' => isset($fields['choose_2']) ? $fields['choose_2'] : null,
    ];
    $chooseTech = isset($_REQUEST['choose_tech']) ? trim($_REQUEST['choose_tech']) : '';

    $data['sizes'] = getSizesBySubjectTechnique($current_lang, $chooseTech, $subjectType, $priceType);
    $data['default_size'] = null;
    if (!empty($data['sizes'])) {
        foreach($data['sizes'] as $sizeKey => $sizeItem) {
            if (isset($sizeItem['available']) && $sizeItem['available']) {
                $data['default_size'] = $sizeKey;
                break;
            }
        }
    }
    $size = isset($_REQUEST['size']) ? trim($_REQUEST['size']) : '';
    if (!$size) {
        $size = $data['default_size'];
    }
    if (!isset($data['sizes'][$size]) || (isset($data['sizes'][$size]['available']) && !$data['sizes'][$size]['available'])) {
        $size = $data['default_size'];
    }

    $data['default_background_type'] = 'background_artist';
    $backgroundType = isset($_REQUEST['background_type']) ? trim($_REQUEST['background_type']) : '';
    if (!$backgroundType) {
        $backgroundType = $data['default_background_type'];
    }
    $data['background_colors'] = getBackgroundColorsSettings();
    $data['default_background_color'] = '';
    $backgroundColor = isset($_REQUEST['color']) ? trim($_REQUEST['color']) : '';
    if (!$backgroundColor) {
        $backgroundColor = $data['default_background_color'];
    }

    //start preapare data for edit
    $editSizeOptions = [];
    if ($data['sizes']) {
        foreach($data['sizes'] as $sizeKey => $sizeItem) {
            if ($sizeItem['available']) {
                $editSizeOptions[$chooseTech][$sizeKey] = $data['use_size'] == 'inch' ? $sizeItem['label_inch'] : $sizeItem['label'];
            }
        }
    }
    $secondChooseTech = $chooseTech == 'charcoal' ? 'oil' : 'charcoal';
    $secondSizes = getSizesBySubjectTechnique($current_lang, $secondChooseTech, $subjectType, $priceType);
    if ($secondSizes) {
        foreach($secondSizes as $sizeKey => $sizeItem) {
            if ($sizeItem['available']) {
                $editSizeOptions[$secondChooseTech][$sizeKey] = $data['use_size'] == 'inch' ? $sizeItem['label_inch'] : $sizeItem['label'];
            }
        }
    }
    $backgroundTitle = '';
    if ($backgroundColor && $backgroundType == 'background_color') {
        $backgroundTitle = $data['background_colors'][$backgroundColor]['label'];
    } else if ($backgroundType) {
        if ($backgroundType == 'background_artist') {
            $backgroundTitle = pll__('Artist to choose background (popular)');
        } elseif ($backgroundType == 'background_photo') {
            $backgroundTitle = pll__('Photo background');
        }
    }
    $editBackgroundOptions = [
        'background_artist' => [
            'type' => 'type',
            'label' => pll__('Artist to choose background (popular)'),
        ],
        'background_photo' => [
            'type' => 'type',
            'label' => pll__('Photo background'),
        ]
    ];
    if ($data['background_colors']) {
        foreach($data['background_colors'] as $key => $item) {
            $editBackgroundOptions[$key] = [
                'type' => 'color',
                'label' => $item['label'],
            ];
        }
    }
    //data fields
    $dataFields = [
        'edit_subject' => $subject,
        'edit_subject_text' => $subjects[$subject]['label'],
        'edit_choose_tech' => $chooseTech,
        'edit_choose_tech_text' => $data['painting_techniques'][$chooseTech]['title'],
        'edit_choose_tech_options' => [
            'charcoal' => $data['painting_techniques']['charcoal']['title'],
            'oil' => $data['painting_techniques']['oil']['title'],
        ],
        'edit_size' => $size,
        'edit_size_text' => isset($data['sizes'][$size]) ? ($data['use_size'] == 'inch' ? $data['sizes'][$size]['label_inch'] : $data['sizes'][$size]['label']) : null,
        'edit_size_options' => $editSizeOptions,
        'edit_background' => $backgroundColor ? $backgroundColor : $backgroundType,
        'edit_background_text' => $backgroundTitle,
        'edit_background_options' => $editBackgroundOptions,
    ];

    $html = '';
    ob_start();
    ?>
        <div class="form-group--select form-group--white form-group--05">
            <label class="select-label select-label-js readonly">
                <div class="select-label__picture"></div>
                <input class="input input-value-js" type="text" name="edit_subject_text" value="<?php echo $dataFields['edit_subject_text']; ?>" readonly placeholder="<?php pll_e('Subject'); ?>" value="<?php  ?>" required />
                <!-- Value of this input will be sent to back -->
                <input class="input input-key-js" name="edit_subject" value="<?php echo $dataFields['edit_subject']; ?>" readonly hidden required>
                <div class="select-label__bottom">
                    <?php pll_e('Person / Pets');?>
                </div>
            </label>
            <ul class="options options-js hide">
                <li class="option option-js" data-key="option 1">
                    <div class="option__text">option 1</div>
                </li>
            </ul>
        </div>
        <div class="form-group--select form-group--white form-group--05">
            <label class="select-label select-label-js">
                <div class="select-label__picture">
                </div>
                <input class="input input-value-js" type="text" name="edit_choose_tech_text" value="<?php echo $dataFields['edit_choose_tech_text']; ?>" readonly placeholder="<?php pll_e('Style'); ?>" required />
                <!-- Value of this input will be sent to back -->
                <input class="input input-key-js" name="edit_choose_tech" value="<?php echo $dataFields['edit_choose_tech']; ?>" readonly hidden required>
                <div class="select-label__bottom">
                    <?php pll_e('Style');?>
                </div>
            </label>

            <ul class="options options-js" data-list="choose_tech">
                <?php foreach($dataFields['edit_choose_tech_options'] as $key => $item):?>
                    <li class="option option-js" data-key="<?php echo $key;?>">
                        <div class="option__text"><?php echo $item;?></div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="form-group--select form-group--white form-group--05">
            <label class="select-label select-label-js">
                <div class="select-label__picture">
                </div>
                <input class="input input-value-js" type="text" name="edit_size_text" value="<?php echo $dataFields['edit_size_text'];?>" readonly placeholder="<?php pll_e('Size'); ?>" required />
                <!-- Value of this input will be sent to back -->
                <input class="input input-key-js" name="edit_size" value="<?php echo $dataFields['edit_size'];?>" readonly hidden required>
                <div class="select-label__bottom">
                    <?php pll_e('Size');?>
                </div>
            </label>

            <ul class="options options-js" data-list="size">
                <?php foreach($dataFields['edit_size_options'] as $type => $typeItems):?>
                    <?php foreach($typeItems as $key => $item):?>
                        <li class="option option-js" <?php if ($dataFields['edit_choose_tech'] != $type):?>style="display: none;" <?php endif;?> data-type="<?php echo $type;?>" data-key="<?php echo $key;?>">
                            <div class="option__text"><?php echo $item;?></div>
                        </li>
                    <?php endforeach;?>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="form-group--select form-group--white form-group--05 background-wrapper">
            <label class="select-label select-label-js">
                <div class="select-label__picture">
                </div>
                <input class="input input-value-js" type="text" name="edit_background_text" value="<?php echo $dataFields['edit_background_text'];?>" readonly placeholder="<?php pll_e('Background');?>" required />

                <!-- Value of this input will be sent to back -->
                <input class="input input-key-js" name="edit_background" value="<?php echo $dataFields['edit_background'];?>" readonly hidden required>
                <div class="select-label__bottom">
                    <?php pll_e('Background');?>
                </div>
            </label>

            <ul class="options options-js" data-list="background">
                <?php foreach($dataFields['edit_background_options'] as $key => $item):?>
                    <li class="option option-js" <?php if ($dataFields['edit_choose_tech'] != 'oil' && $item['type'] == 'color'):?>style="display: none;" <?php endif;?> data-type="<?php echo $item['type'];?>" data-key="<?php echo $key;?>">
                        <div class="option__text"><?php echo $item['label'];?></div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    echo json_encode([
        'has_error' => false,
        'html' => $html,
    ]);
    wp_die();

}
add_action('wp_ajax_ajax_get_edit_order_form_html', 'ajax_get_edit_order_form_html');
add_action('wp_ajax_nopriv_ajax_get_edit_order_form_html', 'ajax_get_edit_order_form_html');

function ajax_add_shipping_data() {
    // save field to session
    $shippingFields = [];
    $shippingFields['first_name'] = isset($_REQUEST['first_name']) ? trim($_REQUEST['first_name']) : '';
    $shippingFields['last_name'] = isset($_REQUEST['last_name']) ? trim($_REQUEST['last_name']) : '';
    $shippingFields['address'] = isset($_REQUEST['address']) ? trim($_REQUEST['address']) : '';
    $shippingFields['address2'] = isset($_REQUEST['address2']) ? trim($_REQUEST['address2']) : '';
    $shippingFields['city'] = isset($_REQUEST['city']) ? trim($_REQUEST['city']) : '';
    $shippingFields['state'] = isset($_REQUEST['state']) ? trim($_REQUEST['state']) : '';
    $shippingFields['postal_code'] = isset($_REQUEST['postal_code']) ? trim($_REQUEST['postal_code']) : '';
    $shippingFields['country'] = isset($_REQUEST['country']) ? trim($_REQUEST['country']) : '';
    $shippingFields['phone'] = isset($_REQUEST['phone']) ? trim($_REQUEST['phone']) : ''; // check this field
    $shippingFields['email'] = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
    $shippingFields['message'] = isset($_REQUEST['message']) ? trim($_REQUEST['message']) : '';
    
    $hasError = false;
    $errorMessage = '';
    if (!$shippingFields['first_name']) {
        $hasError = true;
        $errorMessage .= pll__("First Name is missing.") . "<br>";
    }
    if (!$shippingFields['last_name']) {
        $hasError = true;
        $errorMessage .= pll__("Last Name is missing.") . "<br>";
    }
    if (!$shippingFields['address']) {
        $hasError = true;
        $errorMessage .= pll__("Address is missing.") . "<br>";
    }
    if (!$shippingFields['city']) {
        $hasError = true;
        $errorMessage .= pll__("City is missing.") . "<br>";
    }
    if (!$shippingFields['state']) {
        $hasError = true;
        $errorMessage .= pll__("State is missing.") . "<br>";
    }
    if (!$shippingFields['postal_code']) {
        $hasError = true;
        $errorMessage .= pll__("Postal Code is missing.") . "<br>";
    }
    if (!$shippingFields['country']) {
        $hasError = true;
        $errorMessage .= pll__("Country is missing.") . "<br>";
    }
    if (!$shippingFields['phone']) {
        $hasError = true;
        $errorMessage .= pll__("Phone is missing.") . "<br>";
    }
    if (!$shippingFields['email']) {
        $hasError = true;
        $errorMessage .= pll__("Email is missing.") . "<br>";
    }
    
    if ($hasError) {
        echo json_encode([
            'has_error' => true,
            'error_title' => pll__('Error'),
            'error_message' => $errorMessage
        ]);
        wp_die();
    }
    session_start();
    $_SESSION['shipping_fields'] = $shippingFields;
    
    echo json_encode([
        'has_error' => false,
        'redirect_link' => esc_url((get_url_lang_prefix()) . 'checkout/'),
    ]);
    wp_die();
}
add_action('wp_ajax_ajax_add_shipping_data', 'ajax_add_shipping_data');
add_action('wp_ajax_nopriv_ajax_add_shipping_data', 'ajax_add_shipping_data');

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

function woocommerce_currency($currency){
    $current_lang = pll_current_language();
    if (!$current_lang) {
        $current_lang = 'en';
    }
    $allPricesData = getPrices();
    $currency = strtoupper($allPricesData[$current_lang]['currency']);
    return $currency;
}
add_filter('woocommerce_currency', 'woocommerce_currency');

function woocommerce_cart_item_removed_callback($cart_item_key, $cartObject) {
    //???????
    $cartContents = $cartObject->get_cart_contents();
    if ($cartContents) {
        foreach ($cartContents as $key => $item) {
            // update price and base_discount_price
            if (isset($item['attributes']['cart_discounted_hash']) && $item['attributes']['cart_discounted_hash'] == $cart_item_key) {
                $cartContents[$key]['attributes']['cart_discounted_hash'] = '';
                $cartContents[$key]['attributes']['base_discount_price'] = 0;
                $cartContents[$key]['price'] = $cartContents[$key]['attributes']['base_price'] + $cartContents[$key]['attributes']['frame_price'];
            }
        }
    }
    $cartObject->set_cart_contents($cartContents);
}
//add_action('woocommerce_cart_item_removed', 'woocommerce_cart_item_removed_callback', 10, 2);
//add_action('woocommerce_remove_cart_item', 'woocommerce_cart_item_removed_callback', 10, 2);


function add_order_item_custom_meta($item, $cart_item_key, $cart_item, $order) {
    if (isset($cart_item['price'])) {
        $item->update_meta_data( '_product_price', $cart_item['price'] );
    }
    if (isset($cart_item['attributes'])) {
        $item->update_meta_data( '_product_attributes', $cart_item['attributes'] );
        foreach($cart_item['attributes'] as $key => $attribute) {
            $item->update_meta_data( '_product_attribute_' . $key,  $attribute);
        }
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'add_order_item_custom_meta', 10, 4 );

function change_order_item_meta_title( $key, $meta, $item ) {

    // By using $meta-key we are sure we have the correct one.
    // gift
    if ( '_product_price' == $key ) { $key = 'Price'; }
    if ( '_product_gift_amount' == $key ) { $key = 'Amount'; }
    if ( '_product_gift_currency' == $key ) { $key = 'Currency'; }
    if ( '_product_gift_sender_name' == $key ) { $key = 'Sender Name'; }
    if ( '_product_gift_recipient_name' == $key ) { $key = 'Recipient Name'; }
    if ( '_product_gift_message' == $key ) { $key = 'Message'; }
    if ( '_product_gift_id' == $key ) { $key = 'Gift Card ID'; }
    // picture
    if ( '_product_subject' == $key ) { $key = 'Subject'; }
    if ( '_product_choose_tech' == $key ) { $key = 'Painting technique'; }
    if ( '_product_size' == $key ) { $key = 'Size'; }
    if ( '_product_background_type' == $key ) { $key = 'Background type'; }
    if ( '_product_color' == $key ) { $key = 'Background Color'; }
    if ( '_product_photos' == $key ) { $key = 'Photos'; }
    if ( '_product_photos_count' == $key ) { $key = 'Photos count'; }
    if ( '_product_frame' == $key ) { $key = 'Frame'; }
    if ( '_product_frame_selected' == $key ) { $key = 'Frame selected'; }
    if ( '_product_second_option_to_send_photo' == $key ) { $key = 'Second option to send us the photo'; }
    if ( '_product_artist_advice' == $key ) { $key = 'Artist advice'; }
    if ( '_product_upload_comment' == $key ) { $key = 'Comment'; }
    if ( '_product_duration_type' == $key ) { $key = 'Duration type'; }
    if ( '_product_delivery_date' == $key ) { $key = 'Delivery date'; }
    //_product_subject_price_type
    if ( '_product_base_price' == $key ) { $key = 'Base price'; }
    if ( '_product_frame_price' == $key ) { $key = 'Frame price'; }
    if ( '_product_base_discount_price' == $key ) { $key = 'Discount price'; }

    return $key;
}
add_filter( 'woocommerce_order_item_display_meta_key', 'change_order_item_meta_title', 20, 3 );

function change_order_item_meta_value( $value, $meta, $item ) {
    // By using $meta-key we are sure we have the correct one.
    if ( '_product_attribute_width' === $meta->key ) { $value = $value . ' мм'; }
    if ( '_product_attribute_height' === $meta->key ) { $value = $value . ' мм'; }
    return $value;
}
//add_filter( 'woocommerce_order_item_display_meta_value', 'change_order_item_meta_value', 20, 3 );

function hide_my_item_meta( $hidden_meta ) {
    $hidden_meta[] = '_product_price';
    $hidden_meta[] = '_product_locale';
    $hidden_meta[] = '_product_product_type';
    $hidden_meta[] = '_product_photos_info';
    return $hidden_meta;
}
//add_filter( 'woocommerce_hidden_order_itemmeta', 'hide_my_item_meta' );

add_filter('woocommerce_order_item_get_formatted_meta_data', function ($formatted_meta, $instance){
    $item_id = $instance->get_id();
    $hidden_meta = [];
    $hidden_meta[] = '_product_price';
    $hidden_meta[] = '_product_attribute_locale';
    $hidden_meta[] = '_product_attribute_product_type';
    $hidden_meta[] = '_product_attribute_photos_info';
    $hidden_meta[] = '_product_attribute_subject_custom_max_elements';
    $hidden_meta[] = '_product_attribute_subject_price_type';
    $hidden_meta[] = '_product_attribute_cart_discounted_hash';
    $attributes = [];
    if (!empty($formatted_meta)) {
        foreach($formatted_meta as $key => $item) {
            $attrKey = $formatted_meta[$key]->key;
            $attrKeyKey = str_replace("_product_attribute_","", $attrKey);
            $attrKeyKey = str_replace("_product_","", $attrKey);
            $attributes[$attrKeyKey] = $formatted_meta[$key]->value;
        }
    }
    $attributes['attribute_subject_custom'] = wc_get_order_item_meta( $item_id, '_product_attribute_subject_custom', true );
    
    $locale = isset($attributes['attribute_locale']) ? $attributes['attribute_locale'] : 'en';
    $type = isset($attributes['attributetype']) ? $attributes['attributetype'] : '';
    $new_formatted_meta = [];
    
    $allPrices = getPrices();
    $allSubjects = getSubjects();
    $allDurations = getDuration();
    if (!empty($formatted_meta)) {
        foreach($formatted_meta as $key => $item) {
            $attrKey = $formatted_meta[$key]->key;
            if (in_array($attrKey, $hidden_meta)) {
                continue;
            }
            $skipMetadata = false;
            $metaValue = $item->value;
            if ($type == 'gift-card') {
                if ($attrKey) {
                    switch ($attrKey) {
                        case "_product_attribute_gift_currency":
                            $metaValue = strtoupper($metaValue);
                            break;
                        default:
                            break;
                    }
                }
            } else if ($type == 'picture') {
                if ($attrKey) {
                    /*_product_attribute_subject +
                    _product_attribute_subject_custom +
                    _product_attribute_choose_tech +
                    _product_attribute_size +
                    _product_attribute_background_type +
                    _product_attribute_photos +
                    _product_attribute_photos_count +
                    _product_attribute_frame +
                    _product_attribute_frame_selected +
                    _product_attribute_duration_type +
                    _product_attribute_delivery_date +
                    _product_attribute_base_price +
                    _product_attribute_frame_price +
                    _product_attribute_base_discount_price +*/
                    switch ($attrKey) {
                        case "_product_attribute_subject":
                            if ($metaValue == 'custom') {
                                $metaValue = isset($allSubjects[$metaValue]['label']) ? $allSubjects[$metaValue]['label'] : $metaValue;
                                $persons = isset($attributes['attribute_subject_custom']['persons']) ? $attributes['attribute_subject_custom']['persons'] : 1;
                                $pets = isset($attributes['attribute_subject_custom']['pets']) ? $attributes['attribute_subject_custom']['pets'] : 0;
                                if ($persons || $pets) {
                                    $metaValue .= ': ';
                                    if ($persons) {
                                        $metaValue .= $persons . ' Persons';
                                    }
                                    if ($persons && $pets) {
                                        $metaValue .= ' / ';
                                    }
                                    if ($pets) {
                                        $metaValue .= $pets . ' Pets';
                                    }
                                }
                            } else {
                                $metaValue = isset($allSubjects[$metaValue]['label']) ? $allSubjects[$metaValue]['label'] : $metaValue;
                            }
                            break;
                        case "_product_attribute_choose_tech":
                            $metaValue = $metaValue == 'oil' ? "Oil" : "Charcoal";
                            break;
                        case "_product_attribute_size":
                            $choose_tech = isset($attributes['attribute_choose_tech']) ? $attributes['attribute_choose_tech'] : '';
                            $size = isset($allPrices[$locale]['sizes'][$choose_tech][$metaValue]) ? $allPrices[$locale]['sizes'][$choose_tech][$metaValue] : null;
                            if ($size) {
                                $use_size = $allPrices[$locale]['use_size'];
                                $size = $use_size == 'inch' ? $size['label_inch'] : $size['label'];
                            }
                            $metaValue = $size ? $size : $metaValue;
                            break;
                        case "_product_attribute_background_type":
                            if ($metaValue == 'background_artist') {
                                $metaValue = 'Artist to choose background (popular)';
                            } else if ($metaValue == 'background_photo') {
                                $metaValue = 'Photo background';
                            }  else if ($metaValue == 'background_color') {
                                $metaValue = 'Background colour';
                            }
                            break;
                        case "_product_attribute_color":
                            $metaValue = ucfirst(str_replace(['_', '-'], ' ', $metaValue));
                            break;
                        case "_product_attribute_photos":
                            $photos = json_decode(str_replace('\"', '"', $metaValue), 1);
                            if ($photos) {
                                $html = '';
                                foreach($photos as $photo) {
                                    $html .= '<a style="margin: 5px;" href="' . $photo['path'] . '" target="_blank"><img style="width: 100px;" src="' . $photo['path'] . '"></a>';
                                }
                                $metaValue = $html;
                            } else {
                                $metaValue = '-';
                            }
                            break;
                        case "_product_attribute_second_option_to_send_photo":
                        case "_product_attribute_artist_advice":
                            $metaValue = $metaValue ? "Yes" : "No";
                            break;
                        case "_product_attribute_frame":
                            if ($metaValue == 'need_frame') {
                                $metaValue = 'Yes, I need a frame for My Portrait';
                            } else if ($metaValue == 'not_need_frame') {
                                $metaValue = 'I buy myself a picture frame';
                            }
                            break;
                        case "_product_attribute_frame_selected":
                            $metaValue = ucfirst(str_replace(['_', '-'], ' ', $metaValue));
                            break;
                        case "_product_attribute_duration_type":
                            $metaValue = isset($allDurations['all_locales']['durations']['types'][$metaValue]) ? $allDurations['all_locales']['durations']['types'][$metaValue] : ucfirst(str_replace('_', ' ', $metaValue));
                            break;
                        case "_product_attribute_base_price":
                        case "_product_attribute_frame_price":
                        case "_product_attribute_base_discount_price":
                            $currencySymbol = $allPrices[$locale]['currency_symbol'];
                            $metaValue = $currencySymbol . number_format($metaValue);
                            break;
                        default:
                            break;
                    }
                }
            }
            if (!$skipMetadata) {
                $item->display_value = $metaValue;
                $new_formatted_meta[$key] = $item;
            }
        }
    }
    // update fields
    return $new_formatted_meta;
}, 20, 3);

//https://wp-kama.ru/plugin/woocommerce/function/WC_Order_Item::get_formatted_meta_data ???
//woocommerce_order_item_get_formatted_meta_data

add_filter('woocommerce_add_error', function ($message){
    /*if ($message == 'Укажите отделение Новой Почты') {
        $currentLanguage = wp_doing_ajax() ? $_COOKIE['pll_language'] : pll_current_language();
        if ($currentLanguage === 'uk') {
            $message = 'Вкажіть відділення Нової Пошти';
        }
    }*/
    return $message;
}, 20, 3);

//used for email
function wc_display_item_meta_custom( $item, $args = array() ) {
    $strings = array();
    $html    = '';
    $args    = wp_parse_args(
        $args,
        array(
            'before'       => '<ul class="wc-item-meta"><li>',
            'after'        => '</li></ul>',
            'separator'    => '</li><li>',
            'echo'         => true,
            'autop'        => false,
            'label_before' => '<strong class="wc-item-meta-label">',
            'label_after'  => ':</strong> ',
        )
    );
    $skipKeys = ['_product_price', '_product_attribute_pa_kolory-modeli'];
    foreach ( $item->get_formatted_meta_data("", true) as $meta_id => $meta ) {
        if (in_array($meta->key, $skipKeys)) continue;
        $meta->display_value = trim($meta->display_value);
        $meta->display_value = '<p2>' . pll__(strip_tags($meta->display_value)) . '</p2>';
        $meta->display_key = pll__($meta->display_key);
        $value     = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( $meta->display_value ) ) );
        $strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'] . $value;
    }
    if ( $strings ) {
        $html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
    }

    $html = apply_filters( 'woocommerce_display_item_meta', $html, $item, $args );

    if ( $args['echo'] ) {
        echo $html; // WPCS: XSS ok.
    } else {
        return $html;
    }
}

function woocommerce_method_create_order($order) {
    //set order currency
    $current_lang = pll_current_language();
    $allPricesData = getPrices();
    $site_currency = strtoupper($allPricesData[$current_lang]['currency']);
    $order->set_currency($site_currency);
}
add_action('woocommerce_checkout_create_order', 'woocommerce_method_create_order', 10, 2);
function woocommerce_method_order_created($order) {
    //create coupons from gift cards
    $orderID = $order->get_id();
    $giftIDS = [];
    $items = $order->get_items();
    if ($items) {
        foreach ($items as $item) {
            $attr = $item->get_meta_data();
            $giftID = '';
            $amount = 0;
            foreach ($attr as $itemattr) {
                if ($itemattr->key == '_product_attribute_gift_id') {
                    $giftID = $itemattr->value;
                }
                if ($itemattr->key == '_product_price') {
                    $amount = $itemattr->value;
                }
            }
            if ($giftID && $amount) {
                $giftIDS[$giftID] = $amount;
            }
        }
    }
    if (!empty($giftIDS)) {
        foreach ($giftIDS as $giftID => $amount) {
            createCouponGiftCardID($giftID, $amount, $orderID);
        }
    }
}
add_action('woocommerce_checkout_order_created', 'woocommerce_method_order_created', 10, 2);

function createCouponGiftCardID($giftID = '', $amount = 0, $orderID = '') {
    if (!$giftID || !$amount) {
        return;
    }

    /**
     * Create a coupon programatically
     */
    $coupon_code = $giftID; // Code
    $discount_type = 'fixed_cart'; // Type: fixed_cart, percent, fixed_product, percent_product

    $coupon = array(
        'post_title' => $coupon_code,
        'post_name' => $coupon_code,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'shop_coupon');

    $new_coupon_id = wp_insert_post( $coupon );

    // Add meta
    update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
    update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
    update_post_meta( $new_coupon_id, 'individual_use', 'no' );
    update_post_meta( $new_coupon_id, 'product_ids', '' );
    update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
    update_post_meta( $new_coupon_id, 'usage_limit', '1' );
    update_post_meta( $new_coupon_id, 'usage_limit_per_user', '0' );
    update_post_meta( $new_coupon_id, 'limit_usage_to_x_items', '0' );
    update_post_meta( $new_coupon_id, 'usage_count', '0' );
    update_post_meta( $new_coupon_id, 'date_expires', null );
    update_post_meta( $new_coupon_id, 'free_shipping', 'yes' );
    update_post_meta( $new_coupon_id, 'exclude_sale_items', 'no' );

    update_field('coupon_main_type', 'gift_card', $new_coupon_id);
    update_field('order_id', $orderID, $new_coupon_id);
}

add_filter( 'woocommerce_currency', 'filter_function_name_8288' );
function filter_function_name_8288($option) {
    if ( ! is_admin()) {
        $current_lang = pll_current_language();
        $allPricesData = getPrices();
        $site_currency = strtoupper($allPricesData[$current_lang]['currency']);
        $option = $site_currency;
    }
    return $option;
}

//function test_init() {
//    $current_lang = pll_current_language();
//    $allPricesData = getPrices();
//    $site_currency = strtoupper($allPricesData[$current_lang]['currency']);
//    test([$site_currency, get_woocommerce_currency()]);
//}
//add_action( 'init', 'test_init', 1);


/*gemaiter end*/

?>
