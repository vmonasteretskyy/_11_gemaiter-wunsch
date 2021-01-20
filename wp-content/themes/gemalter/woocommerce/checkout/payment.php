<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */

defined('ABSPATH') || exit;

if (!is_ajax()) {
    do_action('woocommerce_review_order_before_payment');
}
?>
<?php if (WC()->cart->needs_payment()) : ?>
    <?php
    if (!empty($available_gateways)) {
        echo '<ul class="wc_payment_methods payment_methods methods">';
        foreach ($available_gateways as $gateway) {
            wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
        }
        echo '</ul>';
    } else {
        echo '<ul class="wc_payment_methods payment_methods methods">';
        echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . pll_e('Sorry, it seems that there are no available payment methods for your country. Please contact us if you require assistance or wish to make alternate arrangements.') . '</li>'; // @codingStandardsIgnoreLine
        echo '</ul>';
    }
    ?>
<?php else: ?>
    <?php
    echo '<ul class="wc_payment_methods payment_methods methods">';
    echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . pll_e('Payments is not required. You can continue without paying.') . '</li>'; // @codingStandardsIgnoreLine
    echo '</ul>';
    ?>
<?php endif; ?>
<?php
if (!is_ajax()) {
    do_action('woocommerce_review_order_after_payment');
}
