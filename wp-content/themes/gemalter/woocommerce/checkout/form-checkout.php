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
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}


$current_lang = pll_current_language();
$allPricesData = getPrices();
$data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
$data['currency'] = $allPricesData[$current_lang]['currency'];
$data['use_size'] = $allPricesData[$current_lang]['use_size'];

session_start();
$shippingFields = isset($_SESSION['shipping_fields']) ? $_SESSION['shipping_fields'] : [];
$allFields = [
    'first_name',
    'last_name',
    'address',
    'address2',
    'city',
    'state',
    'postal_code',
    'country',
    'phone',
    'email',
    'message',
];
foreach ($allFields as $field) {
    if (!isset($shippingFields[$field])) {
        $shippingFields[$field] = '';
    }
}
WC()->customer->set_billing_first_name($shippingFields['first_name']);


?>

    <form name="checkout" method="post" class=" checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <div class="cart-inner">
            <div class="cards">
                <h6 class="c-payment__title">
                    <?php pll_e('Payment Method'); ?>
                </h6>
                <p>
                    <i>
                        <?php pll_e('All transaction are secure and encripted. Credit card information is never stored.'); ?>
                    </i>
                </p>
                <div class="c-payment-inner">
                    <div class="c-payment__acc">
                        <label class="radio-button ">
                            <input type="radio"
                                   name="payment">
                            <span class="checkmark"></span>
                            <img src="<?php echo the_theme_path(); ?>/img/pay-paypal-min.png" alt="">
                        </label>
                    </div>
                    <div class="c-payment__acc">
                        <label class="radio-button ">
                            <input type="radio"
                                   name="payment">
                            <span class="checkmark"></span>
                            <img src="<?php echo the_theme_path(); ?>/img/pay-visa-min.png" alt="">
                        </label>
                    </div>
                </div>
            </div>

            <div class="cart__aside">
                <div class="c-form">
                    <h6 class="c-form__title">
                        <?php pll_e('Cart Details'); ?>
                    </h6>
                    <div class="c-order-summary">
                        <div class="small-card">
                            <div class="small-card__picture">
                                <img src="img/chose-3-min.jpg" alt="">
                                <div class="small-card__label">
                                    1
                                </div>
                            </div>
                            <div class="small-card__text">
                                <h6 class="text--ls-05">
                                    Oil Portrait ( + Black frame )
                                </h6>
                                <div class="small-card__descr">
                                    <p>1 person;</p>
                                    <p>120x180 cm;</p>
                                    <p>
                                        <span class="card-bg-color" style="background-color:  #B1C4CA;"></span>
                                        Blue Bronze
                                    </p>

                                </div>
                            </div>

                            <div class="small-card__price f-22">
                              <span class="f-16">
                                $
                              </span>
                                            1,468
                                            <span class="f-16 color-gray">
                                (
                                <span class="f-12">$</span>
                                1,289 +
                                <span class="f-12">$</span>
                                179
                                )
                              </span>
                            </div>
                        </div>
                        <div class="small-card">
                            <div class="small-card__picture">
                                <img src="img/gift-card-min.jpg" alt="">
                                <div class="small-card__label">
                                    2
                                </div>
                            </div>
                            <div class="small-card__text">
                                <h6 class="text--ls-05">
                                    Gift Card
                                </h6>
                                <div class="small-card__descr">

                                    <p>From: <span>John Snow</span></p>
                                    <p>To: <span>Daenerys</span></p>
                                    <span>Stormborn of House Targaryen</span>
                                </div>
                            </div>

                            <div class="small-card__price f-22">
                              <span class="f-16">
                                $
                              </span>
                                1,468
                            </div>
                        </div>  </div>


                    <h6 class="c-form__title">
                        <?php pll_e('Amount Details');?>
                    </h6>

                    <div class="gift-card__form form">
                        <?php
                        $appliedCoupon = WC()->cart->get_applied_coupons();
                        if (!empty($appliedCoupon)) {
                            $appliedCoupon = reset($appliedCoupon);
                        } else {
                            $appliedCoupon = null;
                        }
                        ?>
                        <div <?php if ($appliedCoupon):?> style="display: none;" <?php endif;?> class="c-form-accordion" apply-coupon-wrapper="">
                            <span class="jq-accordion c-form-accordion__title"><?php pll_e('I have a gift card');?></span>
                            <div class="c-form-accordion__content">
                                <div class="f-row">
                                    <input type="text" name='coupon' placeholder="<?php pll_e('Insert here');?>">
                                    <button data-apply-coupon="" class="btn btn--accent-border">
                                        <?php pll_e('Apply');?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div <?php if (!$appliedCoupon):?> style="display: none;" <?php endif;?> class="f-row c-form-coupon" cancel-coupon-wrapper="">
                            <p>
                                <?php pll_e('Gift Card');?>
                                <span class="fw-700" data-coupon-val="<?php echo $appliedCoupon; ?>">(<?php echo $appliedCoupon; ?>)</span>
                                <?php pll_e('was applied');?>
                            </p>
                            <button data-cancel-coupon="" class="btn btn--accent-border">
                                <?php pll_e('Cancel');?>
                            </button>
                        </div>
                        <p><i><?php pll_e('Amount Details Text');?></i></p>

                        <div class="c-table">
                            <div class="c-table__row">
                                <div class="c-table-left">
                                    <?php pll_e('Sub Total');?>
                                </div>
                                <div class="c-table-right f-22">
                                    <span class="f-16"><?php echo $data['currency_symbol'];?></span>
                                    <span data-cart-subtotal-amount="">
                                                <?php echo wc_price(WC()->cart->get_subtotal());?>
                                            </span>
                                </div>
                            </div>

                            <div class="c-table__row">
                                <div class="c-table-left">
                                    <div class="c-table-select">
                                        <?php pll_e('Shipping Country');?>
                                        <div class="form-group form-group--select form-group--white">
                                            <label class="select-label select-label-js readonly">
                                                <div class="select-label__picture">
                                                </div>
                                                <input class="input input-value-js" data-amount-shipping-country="" type="text" readonly placeholder="" value="<?php echo $shippingFields['country'];?>" />
                                                <!-- Value of this input will be sent to back -->
                                                <input class="input input-key-js" name="select" readonly hidden value="<?php echo $shippingFields['country'];?>">
                                            </label>
                                            <ul class="options options-js hide">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-table-right color-accent">
                                    <?php pll_e('Free');?>
                                </div>
                            </div>

                            <div class="c-table__row" <?php if (!WC()->cart->get_discount_total()):?>style="display: none;" <?php endif;?>>
                                <div class="c-table-left fw-700">
                                    <?php pll_e('Gift Card Discount');?>
                                </div>
                                <div class="c-table-right f-30">
                                    <span class="f-20"><?php echo $data['currency_symbol'];?></span>
                                    <span data-cart-discount-amount="">
                                                <?php echo wc_price(WC()->cart->get_discount_total());?>
                                            </span>
                                </div>
                            </div>

                            <div class="c-table__row">
                                <div class="c-table-left fw-700">
                                    <?php pll_e('Total Amount');?>
                                </div>
                                <div class="c-table-right f-30">
                                    <span class="f-20"><?php echo $data['currency_symbol'];?></span>
                                    <span data-cart-total-amount="">
                                                <?php echo WC()->cart->get_cart_total();?>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="c-form__actions">
                            <a href="<?php echo (get_url_lang_prefix()) . 'cart/'; ?>" class="btn-back">
                                <svg width="4" height="12" viewBox="0 0 4 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6L0.25 11.1962L0.25 0.803848L4 6Z" fill="#F9AB97"/>
                                </svg>
                                <?php pll_e('Back');?>
                            </a>
                            <button data-create-order="" class="btn btn--accent"><?php pll_e('Checkout');?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
