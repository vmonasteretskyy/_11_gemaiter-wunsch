<?php
/**
 * Pay for order form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-pay.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$totals = $order->get_order_item_totals();
?>
<form id="order_review" method="post">

    <div class="c-form">
        <h6 class="c-form__title">
            <?php pll_e('Cart Items');?>
        </h6>
        <?php if ( count( $order->get_items() ) > 0 ) : ?>
            <div class="gift-card__form form">
                <div class="c-table">
                    <div class="c-table__row">
                        <div class="c-table-left fw-700">
                            <?php pll_e( 'Product'); ?>
                        </div>
                        <div class="c-table-right fw-700">
                            <?php pll_e( 'Price'); ?>
                        </div>
                    </div>
                    <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                        <div class="c-table__row">
                            <div class="c-table-left">
                                <?php
                                    echo apply_filters( 'woocommerce_order_item_name', esc_html( $item->get_name() ), $item, false ); // @codingStandardsIgnoreLine
                                    do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );
                                    /*$margin_side = $text_align = 'left';
                                    wc_display_item_meta_custom(
                                        $item,
                                        array(
                                            'label_before' => '<strong class="wc-item-meta-label" style="float: ' . esc_attr( $text_align ) . '; margin-' . esc_attr( $margin_side ) . ': .25em; clear: both">',
                                        )
                                    );*/
                                    do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                                ?>
                            </div>
                            <div class="c-table-right">
                                <?php echo $order->get_formatted_line_subtotal( $item ); ?>
                                <?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <span class="product-quantity">' . sprintf( '&times;&nbsp;%s', esc_html( $item->get_quantity() ) ) . '</span>', $item ); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div id="payment">
        <?php if ( $order->needs_payment() ) : ?>
            <ul class="wc_payment_methods payment_methods methods">
                <?php
                if ( ! empty( $available_gateways ) ) {
                    foreach ( $available_gateways as $gateway ) {
                        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                    }
                } else {
                    echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . pll__('Sorry, it seems that there are no available payment methods for your country. Please contact us if you require assistance or wish to make alternate arrangements.') . '</li>';
                }
                ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="c-form">
        <h6 class="c-form__title">
            <?php pll_e('Amount Details');?>
        </h6>
        <div class="gift-card__form form">
            <div class="c-table">
                <?php if ( $totals ) : ?>
                    <?php foreach ( $totals as $key => $total ) : ?>
                        <div class="c-table__row">
                            <div class="c-table-left fw-700">
                                <?php echo pll__($total['label']); ?>
                            </div>
                            <div class="c-table-right <?php if ($key != 'payment_method'):?>f-30<?php endif;?>">
                                <span data-cart-discount-amount="">
                                    <?php echo $total['value']; ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="c-form__actions">
                <input type="hidden" name="woocommerce_pay" value="1" />
                <?php echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="btn btn--accent" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . pll__( $order_button_text ) . '</button>' ); ?>
                <?php do_action( 'woocommerce_pay_order_after_submit' ); ?>
                <?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
            </div>
        </div>
    </div>
</form>
