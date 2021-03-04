<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

?>

<div class="text">
    <div class="text-block section--gray p-50 ">
        <div class="container mx-w-1050">
            <div class="woocommerce-order">
	            <?php
                if ( $order ) :
                    do_action( 'woocommerce_before_thankyou', $order->get_id() );
                    ?>

                    <?php if ( $order->has_status( 'failed' ) ) : ?>
                        <div class="order_failed"></div>
                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                            <?php pll_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.'); ?>
                        </p>

                        <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php pll_e( 'Pay'); ?></a>
                            <?php /*if ( is_user_logged_in() ) : ?>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
                            <?php endif;*/ ?>
                        </p>

                    <?php else : ?>
                        <div class="order_success" data-order-email="<?php echo $order->get_billing_email();?>"></div>
                        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
                            <?php pll_e( 'Thank you. Your order has been received.'); ?>
                        </p>

                        <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                            <li class="woocommerce-order-overview__order order">
                                <?php pll_e( 'Order number:'); ?>
                                <strong><?php echo $order->get_order_number(); ?></strong>
                            </li>
                            <li class="woocommerce-order-overview__date date">
                                <?php pll_e( 'Date:'); ?>
                                <strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
                            </li>
                            <?php if ( $order->get_billing_email() ) : ?>
                                <li class="woocommerce-order-overview__email email">
                                    <?php pll_e( 'Email:'); ?>
                                    <strong><?php echo $order->get_billing_email(); ?></strong>
                                </li>
                            <?php endif; ?>
                            <li class="woocommerce-order-overview__total total">
                                <?php pll_e( 'Total:'); ?>
                                <strong><?php echo $order->get_formatted_order_total(); ?></strong>
                            </li>
                            <?php if ( $order->get_payment_method_title() ) : ?>
                                <li class="woocommerce-order-overview__payment-method method">
                                    <?php pll_e( 'Payment method:'); ?>
                                    <strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
                                </li>
                            <?php endif; ?>
                        </ul>

                    <?php endif; ?>

                <?php else : ?>

                    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo pll__( 'Thank you. Your order has been received.'); ?></p>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
