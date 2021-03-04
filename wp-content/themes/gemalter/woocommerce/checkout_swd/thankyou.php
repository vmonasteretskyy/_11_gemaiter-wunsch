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
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="page-wrapper page-news">
    <div class="container--fluid">
        <? 	get_template_part( 'template-parts/bread'); ?>
    </div>

    <section class="section--checkout">
        <div class="container">
            <?php if ( $order ) :
                do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>
                <?php if ( $order->has_status( 'failed' ) ) : ?>
                    <h2 class="section-title title-border"><?php esc_html_e( pll__('На жаль, ваше замовлення неможливо обробити.', 'woocommerce' )); ?></h2>
                <?php else : ?>
                    <h2 class="section-title title-border"><?php echo pll__(apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Дякуємо. Ваше замовлення отримано.', 'woocommerce' ), $order )); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
                    <div class="text">
                        <ul class="nostyle-list woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                            <li class="woocommerce-order-overview__order order">
                                <?php esc_html_e( pll__('Номер замовлення') . ':', 'woocommerce' ); ?>
                                <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                            </li>
                            <li class="woocommerce-order-overview__date date">
                                <?php esc_html_e( pll__('Дата') . ':', 'woocommerce' ); ?>
                                <strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                            </li>
                            <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                                <li class="woocommerce-order-overview__email email">
                                    <?php esc_html_e( pll__('Email') . ':', 'woocommerce' ); ?>
                                    <strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                                </li>
                            <?php endif; ?>
                            <li class="woocommerce-order-overview__total total">
                                <?php esc_html_e( pll__('Сума') . ':', 'woocommerce' ); ?>
                                <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
                            </li>
                            <?php if ( $order->get_shipping_method() ) : ?>
                                <li class="woocommerce-order-overview__payment-method method">
                                    <?php esc_html_e( pll__('Доставка') . ':', 'woocommerce' ); ?>
                                    <strong><?php echo pll__(wp_kses_post( $order->get_shipping_method() )); ?></strong>
                                </li>
                            <?php endif; ?>
                            <?php if ( $order->get_payment_method_title() ) : ?>
                                <li class="woocommerce-order-overview__payment-method method">
                                    <?php esc_html_e( pll__('Оплата') . ':', 'woocommerce' ); ?>
                                    <strong><?php echo pll__(wp_kses_post( $order->get_payment_method_title() )); ?></strong>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <h2 class="section-title title-border"><?php echo pll__(apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Дякуємо. Ваше замовлення отримано.', 'woocommerce' ), null )); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
            <?php endif; ?>
        </div>
    </section>
</div>