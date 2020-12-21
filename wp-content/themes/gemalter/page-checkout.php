<?php
/**
 * The template for displaying checkout page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gemalter
 */
global $post;

$current_lang = pll_current_language();
$allPricesData = getPrices();
$data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
$data['currency'] = $allPricesData[$current_lang]['currency'];
$data['use_size'] = $allPricesData[$current_lang]['use_size'];


session_start();
$shippingFields = getShippingFieldsFromSession();
$hasRequireFields = true;
if (!$shippingFields['first_name'] || !$shippingFields['last_name'] || !$shippingFields['address'] || !$shippingFields['city'] || !$shippingFields['state'] || !$shippingFields['postal_code'] || !$shippingFields['country'] || !$shippingFields['phone'] || !$shippingFields['email']) {
    $hasRequireFields = false;
}
if (!$hasRequireFields) {
    $location = (get_url_lang_prefix()) . 'cart/';
    wp_redirect($location);
    exit;
}

WC()->cart->calculate_totals();
WC()->cart->maybe_set_cart_cookies();

get_header();
?>

    <!--Start page-->
    <div class="page-wrapper">
        <div class="cart-wrap">
            <div class="cart">
                <?php if (is_wc_endpoint_url('order-pay')):?>
                    <div class="title-wrap m-b-50">
                        <h2><?php pll_e('Order pay'); ?></h2>
                    </div>
                <?php elseif (is_wc_endpoint_url('order-received')):?>
                    <div class="title-wrap m-b-50">
                        <h2><?php pll_e('Order received'); ?></h2>
                    </div>
                <?php else: ?>
                    <div class="cart-head">
                        <h2><?php pll_e('Checkout'); ?></h2>
                        <div class="cart-head__amount">
                            <p><?php pll_e('Total Amount'); ?>: <span><?php echo $data['currency_symbol'];?> </span> </p>
                            <div class="cart-amount h1" data-cart-total-amount="">
                                <?php echo WC()->cart->get_cart_total();?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile; // End of the loop.
                ?>

            </div>
        </div>
    </div>
    <!--End page-->

<?php
get_footer();
