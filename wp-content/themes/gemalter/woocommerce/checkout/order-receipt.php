<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="text">
    <div class="text-block section--gray p-50 ">
        <div class="container mx-w-1050">
            <div class="woocommerce-order">
                <ul class="order_details">
                    <li class="order">
                        <?php pll_e( 'Order number:'); ?>
                        <strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
                    </li>
                    <li class="date">
                        <?php pll_e( 'Date:'); ?>
                        <strong><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
                    </li>
                    <li class="total">
                        <?php pll_e( 'Total:'); ?>
                        <strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
                    </li>
                    <?php if ( $order->get_payment_method_title() ) : ?>
                    <li class="method">
                        <?php pll_e( 'Payment method:'); ?>
                        <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>

<div class="clear"></div>
