<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_review_order_after_order_total', 'woocommerce_checkout_payment', 20 );

//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

?>

<!--Start page-->
<div class="page-wrapper page-news">
    <div class="container--fluid">
        <? 	get_template_part( 'template-parts/bread'); ?>
    </div>

    <section class="section--checkout">
        <div class="container">
            <h2 class="section-title title-border"><?php the_title(); ?></h2>

            <div class="checkout-custom">


                <form id="checkout-form" name="checkout" method="post" class="checkout woocommerce-checkout form checkout__form woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
                    <?php if ( $checkout->get_checkout_fields() ) : ?>
                        <div class="form__section">
                            <div class="form__label">
                                <span class="number">1</span>
                                <span class="title"><?php echo pll__('Особисті дані'); ?></span>
                            </div>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            <input name="shipping_country" value="UA" type="hidden" style="display: none;">
                        </div>


                        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                            <div class="form__section">
                                <div class="form__label">
                                    <span class="number">2</span>
                                    <span class="title"><?php echo pll__('Доставка'); ?></span>
                                </div>
                                <div class="delivery">
                                    <!-- Radio buttons -->
                                    <div class="radio-wrapper ">
                                        <?php
                                        $packages           = WC()->shipping()->get_packages();
                                        $first              = true;

                                        foreach ( $packages as $i => $package ) {
                                            $chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
                                            $product_names = array();

                                            if ( count( $packages ) > 1 ) {
                                                foreach ( $package['contents'] as $item_id => $values ) {
                                                    $product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
                                                }
                                                $product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
                                            }
                                            $available_methods = $package['rates'];
                                            $show_package_details = count( $packages ) > 1;
                                            $show_shipping_calculator = is_cart() && apply_filters( 'woocommerce_shipping_show_shipping_calculator', $first, $i, $package );
                                            $package_details =  implode( ', ', $product_names );
                                            $package_name =  apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'woocommerce' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'woocommerce' ), $i, $package );
                                            $index =  $i;
                                            $formatted_destination =  WC()->countries->get_formatted_address( $package['destination'], ', ' );
                                            $has_calculated_shipping =  WC()->customer->has_calculated_shipping();

                                            ?>
                                            <?php foreach ( $available_methods as $method ) : ?>

                                                <?php
                                                printf( '<label class="form-group form-group--radio" for="shipping_method_%1$s_%2$s">', $index, pll__(esc_attr( sanitize_title( $method->id ) )), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                                                printf( '<span class="form-radio"><input hidden type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="blueact shipping_method radio-js" %4$s /><span class="radio"></span></span>', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
                                                printf( '<span class="label"><span class="label-text">%1$s</span></span></label>',  wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
                                                do_action( 'woocommerce_after_shipping_rate', $method, $index );
                                                ?>
                                            <?php endforeach; ?>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <div class="form__section">
                        <div class="form__label">
                            <span class="number">3</span>
                            <span class="title"><?php echo pll__('Оплата'); ?></span>
                        </div>
                        <!-- Radio buttons -->
                        <div class="radio-wrapper ">
                            <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
                        </div>
                    </div>
                    <noscript>
                        <?php
                        printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
                        ?>
                        <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
                    </noscript>
                    <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn btn--medium btn--lines" name="woocommerce_checkout_place_order" id="place_order" value="' .  pll__('Оформити замовлення') . '" data-value="' .  pll__('Оформити замовлення') . '"><span>' .  pll__('Оформити замовлення') . '</span></button>' ); // @codingStandardsIgnoreLine ?>
                    <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
                    <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                </form>

                <div class="checkout__cart">

                    <div class="cart">
                        <div class="cart__products">
                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):

                            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_slug = '#';
                            $parent_product = null;
                            if ($_product) {
                                $parent_id = $_product->get_parent_id();
                                if ($parent_id) {
                                    $parent_product = wc_get_product($parent_id);
                                    $product_slug = $parent_product->get_slug();
                                } else {
                                    $product_slug = $_product->get_slug();
                                }
                            }
                            $product_slug = esc_url((get_url_lang_prefix()) .  '/product/' . $product_slug);
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                            $attributes = isset($cart_item['attributes']) ? $cart_item['attributes'] : [];
                            $descAttributes = ['pa_size' => '', 'pa_size2' => ''];
                            if (isset($attributes['pa_size'])) {
                                $product_slug .= '?attribute_pa_size=' . $attributes['pa_size'];
                            } else if (isset($attributes['pa_size2'])) {
                                $product_slug .= '?attribute_pa_size2=' . $attributes['pa_size2'];
                            }

                            $descData = [];
                            if (!empty($attributes)) {
                                foreach($descAttributes as $descAttribute => $descAttributeLabel) {
                                    if (isset($attributes[$descAttribute]) && $attributes[$descAttribute]) {
                                        $term_obj = get_term_by('slug', $attributes[$descAttribute], $descAttribute);
                                        if ($term_obj) {
                                            $descData[] = pll__($term_obj->name) . ' ' . $descAttributeLabel;
                                        }
                                    }
                                }
                            }
                            $descData = !empty($descData) ? implode(', ', $descData) : '';

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ):
                            ?>

                            <div class="cart__product">
                                <a href="##" class="remove" data-remove-cart-item="" data-cart-item-key="<?php echo $cart_item_key; ?>">
                                    <svg>
                                        <use xlink:href="#icon-x"></use>
                                    </svg>
                                </a>

                                <div class="image">
                                    <?php echo $_product->get_image('orig'); ?>
                                </div>
                                <div class="info">
                                    <a href="<?php echo $product_slug; ?>"><div class="title"><?php echo ($parent_product ? $parent_product->get_name() : $_product->get_name()); ?></a>
                                    <?php if($descData): ?><br><?php echo $descData; ?><?php endif; ?>
                                </div>
                                <div class="numbers">
                                    <div class="price skew skew--more"><span><?php echo wc_price($_product->get_price()); ?></span></div>

                                    <div class="count">
                                        <a data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']-1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="minus" class="minus skew skew--more <?php if($cart_item['quantity'] < 2): ?>hidden<?php endif;?>"><span>&ndash;</span></a>
                                        <div class="current skew skew--more"><span><?php echo $cart_item['quantity']; ?></span></div>
                                        <a data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']+1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="plus" class="plus skew skew--more"><span>+</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="total">
                                <span class="total-title"><?php pll_e('Сума');?></span>
                                <span class="total-number"><?php echo wc_price($_product->get_price() * $cart_item['quantity']); ?></span>
                            </div>
                        </div>
                        <?php
                        endif;
                        endforeach;
                        ?>
                    </div>
                    <div class="total">
                        <div class="total__title"><?php pll_e('Разом до оплати');?></div>
                        <div class="total__number"><?php echo WC()->cart->get_total(); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        /*var checkoutForm = document.querySelector('#checkout-form');

        checkoutForm.addEventListener('submit', function(event) {
            event.preventDefault();
            document.dispatchEvent(new Event('modal-open#modal-thanks'));
        });*/
    </script>
</div>
<!--End page-->
