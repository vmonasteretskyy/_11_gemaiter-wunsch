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

add_action( 'woocommerce_review_order_after_order_total', 'woocommerce_checkout_payment', 20 );


$current_lang = pll_current_language();

$postItem = get_page_by_path('order',OBJECT,'page');
$fields = $postItem ? get_fields($postItem->ID) : null;
$postGift = get_page_by_path('gift-cards',OBJECT,'page');
$fields2 = get_fields($postGift->ID);

$allPricesData = getPrices();
$data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
$data['currency'] = $allPricesData[$current_lang]['currency'];
$data['use_size'] = $allPricesData[$current_lang]['use_size'];

$data['subjects'] = getSubjects();
$data['painting_techniques'] = [
    'charcoal' => isset($fields['choose_1']) ? $fields['choose_1'] : null,
    'oil' => isset($fields['choose_2']) ? $fields['choose_2'] : null,
];
$data['background_colors'] = getBackgroundColorsSettings();

$shippingFields = getShippingFieldsFromSession();
WC()->customer->set_billing_first_name($shippingFields['first_name']);
WC()->customer->set_billing_last_name($shippingFields['last_name']);
WC()->customer->set_billing_address_1($shippingFields['address']);
WC()->customer->set_billing_address_2($shippingFields['address2']);
WC()->customer->set_billing_city($shippingFields['city']);
WC()->customer->set_billing_state($shippingFields['state']);
WC()->customer->set_billing_postcode($shippingFields['postal_code']);
WC()->customer->set_billing_country($shippingFields['country']);
WC()->customer->set_billing_phone($shippingFields['phone']);
WC()->customer->set_billing_email($shippingFields['email']);
WC()->customer->set_shipping_first_name($shippingFields['first_name']);
WC()->customer->set_shipping_last_name($shippingFields['last_name']);
WC()->customer->set_shipping_address_1($shippingFields['address']);
WC()->customer->set_shipping_address_2($shippingFields['address2']);
WC()->customer->set_shipping_city($shippingFields['city']);
WC()->customer->set_shipping_state($shippingFields['state']);
WC()->customer->set_shipping_postcode($shippingFields['postal_code']);
WC()->customer->set_shipping_country($shippingFields['country']);
//message inserts in form-shipping.php file
//WC()->customer->set_billing_email('');
?>

    <form name="checkout" method="post" class=" checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <input type="hidden" name="lang" value="<?php echo $current_lang; ?>">
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
                    <?php if ( $checkout->get_checkout_fields() ) : ?>
                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                    <?php endif; ?>
                    <div id="payment_types">
                        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
                    </div>
                </div>
            </div>

            <div class="cart__aside">
                <div class="c-form">
                    <h6 class="c-form__title">
                        <?php pll_e('Cart Details'); ?>
                    </h6>
                    <div class="c-order-summary">
                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
                        $cartItemType = isset($cart_item['attributes']['product_type']) ? $cart_item['attributes']['product_type'] : '';
                        $quantity = $cart_item['quantity'];
                        if ($cartItemType == 'picture') {
                            $frame_selected = isset($cart_item['attributes']['frame_selected']) ? $cart_item['attributes']['frame_selected'] : '';
                            $frame = get_term_by('slug', $frame_selected, 'pa_frames');
                            $choose_tech = isset($cart_item['attributes']['choose_tech']) ? $cart_item['attributes']['choose_tech'] : '';

                            $productTitle = $data['painting_techniques'][$choose_tech]['title'];
                            if ($frame) {
                                $productTitle .= ' ( +' . $frame->name . ')';
                            }
                            $subject = isset($cart_item['attributes']['subject']) ? $cart_item['attributes']['subject'] : '';
                            $subjectTitle = $data['subjects'][$subject]['label'];
                            if ($subject == 'custom') {
                                $persons = $cart_item['attributes']['subject_custom']['persons'];
                                $pets = $cart_item['attributes']['subject_custom']['pets'];
                                $subjectTitle .= ': ' . ($persons ?  $persons . ' ' .  pll__('Persons') : '') . ($persons && $pets ? ", " : "") . ($pets ?  $pets . ' ' .  pll__('Pets') : '');
                            }
                            $backgroundTitle = '';
                            $backgroundColor = '';
                            $backgroud = isset($cart_item['attributes']['background_type']) ? $cart_item['attributes']['background_type'] : '';
                            if ($backgroud == 'background_color') {
                                $color = isset($cart_item['attributes']['color']) ? $cart_item['attributes']['color'] : '';
                                if (isset($data['background_colors'][$color])) {
                                    $backgroundTitle = $data['background_colors'][$color]['label'];
                                    $backgroundColor = $data['background_colors'][$color]['hex_color'];
                                } else {
                                    $backgroundTitle = pll__('Background colour (pick yours next)');
                                }
                            } else if ($backgroud == 'background_artist') {
                                $backgroundTitle = pll__('Artist to choose background (popular)');
                            } else if ($backgroud == 'background_photo') {
                                $backgroundTitle = pll__('Photo background');
                            }
                            $image = $data['painting_techniques'][$choose_tech]['image'];
                            if ($image) {
                                $image = $image['url'];
                            } else {
                                $image = wp_get_attachment_image_src($image, 'full');
                                if (isset($image[0]) && $image[0]) {
                                    $image = $image[0];
                                } else {
                                    $image = null;
                                }
                            }
                            $size = isset($cart_item['attributes']['size']) ? $cart_item['attributes']['size'] : '';
                            $sizeTitle = isset($allPricesData[$current_lang]['sizes'][$choose_tech][$size]) ? ($data['use_size'] == 'inch' ? $allPricesData[$current_lang]['sizes'][$choose_tech][$size]['label_inch'] : $allPricesData[$current_lang]['sizes'][$choose_tech][$size]['label']) : "-";
                            $price = number_format($quantity * $cart_item['price'], 0);
                            $basePrice = isset($cart_item['attributes']['base_price']) ? number_format($quantity * $cart_item['attributes']['base_price']) : 0;
                            $framePrice = isset($cart_item['attributes']['frame_price']) ? number_format($quantity * $cart_item['attributes']['frame_price']) : 0;
                            $baseDiscountPrice = isset($cart_item['attributes']['base_discount_price']) ? number_format($quantity * $cart_item['attributes']['base_discount_price']) : 0;
                        } else {
                            $productTitle = pll__("Gift Card");
                            $price = number_format($quantity * $cart_item['price'], 0);
                            $image = $fields2['form_image'];
                            if ($image) {
                                $image = $image['url'];
                            } else {
                                $image = wp_get_attachment_image_src($image, 'full');
                                if (isset($image[0]) && $image[0]) {
                                    $image = $image[0];
                                } else {
                                    $image = null;
                                }
                            }
                            $sender = isset($cart_item['attributes']['gift_sender_name']) ? $cart_item['attributes']['gift_sender_name'] : '';
                            $recipient = isset($cart_item['attributes']['gift_recipient_name']) ? $cart_item['attributes']['gift_recipient_name'] : '';
                            $message = isset($cart_item['attributes']['gift_message']) ? $cart_item['attributes']['gift_message'] : '';

                            $currency = isset($cart_item['attributes']['gift_currency']) ? $cart_item['attributes']['gift_currency'] : '';
                            $currencySymbol = $currency == 'eur'? '€' : '$';
                            $amount = isset($cart_item['attributes']['gift_amount']) ? $cart_item['attributes']['gift_amount'] : '';
                        }
                        $iteration = !isset($iteration) ? 1 : $iteration+1;
                        ?>
                        <?php if ($cartItemType == 'picture'): ?>
                            <div class="small-card">
                                <div class="small-card__picture">
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image; ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo the_theme_path(); ?>/img/chose-3-min.jpg" alt="">
                                    <?php endif;?>
                                    <div class="small-card__label">
                                        <?php echo $iteration; ?>
                                    </div>
                                </div>
                                <div class="small-card__text">
                                    <h6 class="text--ls-05">
                                        <?php echo $productTitle; ?>
                                    </h6>
                                    <div class="small-card__descr">
                                        <p><?php echo $sizeTitle; ?>;</p>
                                        <p><?php echo $sizeTitle; ?>;</p>
                                        <p>
                                            <?php if ($backgroundColor):?><span class="card-bg-color" style="background-color:  <?php echo $backgroundColor;?>"></span><?php endif; ?>
                                            <?php echo $backgroundTitle;?>
                                        </p>
                                    </div>
                                </div>

                                <div class="small-card__price f-22">
                                    <span class="f-16">
                                    <?php echo $data['currency_symbol'];?>
                                    </span>
                                    <?php echo $price;?>
                                    <?php if ($framePrice || $baseDiscountPrice): ?>
                                        <span class="f-16 color-gray">
                                            (
                                            <span class="f-12"><?php echo $data['currency_symbol'];?></span>
                                            <?php echo $basePrice;?>
                                            <?php if ($framePrice): ?>
                                                +
                                                <span class="f-12"><?php echo $data['currency_symbol'];?></span>
                                                <?php echo $framePrice;?>
                                            <?php endif; ?>
                                            <?php if ($baseDiscountPrice): ?>
                                                -
                                                <span class="f-12"><?php echo $data['currency_symbol'];?></span>
                                                <?php echo $baseDiscountPrice;?>
                                            <?php endif; ?>
                                            )
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="small-card">
                                <div class="small-card__picture">
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image; ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo the_theme_path(); ?>/img/gift-card-min.jpg" alt="">
                                    <?php endif;?>
                                    <div class="small-card__label">
                                        <?php echo $iteration; ?>
                                    </div>
                                </div>
                                <div class="small-card__text">
                                    <h6 class="text--ls-05">
                                        <?php echo $productTitle; ?>
                                    </h6>
                                    <div class="small-card__descr">
                                        <p><?php pll_e('From');?>: <span><?php echo $sender;?></span></p>
                                        <p><?php pll_e('To');?>: <span><?php echo $recipient;?></span></p>
                                        <span><?php pll_e('Message');?>: <?php echo $message;?></span>
                                    </div>
                                </div>

                                <div class="small-card__price f-22">
                                    <span class="f-16">
                                    <?php echo $data['currency_symbol'];?>
                                    </span>
                                    <?php echo $price;?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

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

                            <?php if (WC()->cart->get_taxes_total()): ?>
                                <div class="c-table__row">
                                    <div class="c-table-left">
                                        <?php pll_e('Tax Total'); ?>
                                    </div>
                                    <div class="c-table-right f-22">
                                        <span class="f-16"><?php echo $data['currency_symbol']; ?></span>
                                        <span data-cart-tax-amount="">
                                            <?php echo wc_price(WC()->cart->get_taxes_total()); ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="c-table__row">
                                <div class="c-table-left">
                                    <div class="c-table-select">
                                        <?php pll_e('Shipping Country');?>
                                        <div class="form-group form-group--select form-group--white">
                                            <label class="select-label select-label-js readonly">
                                                <div class="select-label__picture">
                                                </div>
                                                <input class="input input-value-js" data-amount-shipping-country="" type="text" readonly placeholder="" value="<?php echo pll__(getCountryByCode($shippingFields['country']));?>" />
                                                <!-- Value of this input will be sent to back -->
                                                <input class="input input-key-js" name="select" readonly hidden value="<?php echo pll__(getCountryByCode($shippingFields['country']));?>">
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
                                        <?php echo WC()->cart->get_total();?>
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
                            <noscript>
                                <?php
                                printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
                                ?>
                                <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Checkout', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
                            </noscript>
                            <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="btn btn--accent" name="woocommerce_checkout_place_order" id="place_order" value="' .  pll__('Checkout') . '" data-value="' .  pll__('Checkout') . '"><span>' .  pll__('Checkout') . '</span></button>' ); // @codingStandardsIgnoreLine ?>
                            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>
                            <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                            <!--<button data-create-order="" class="btn btn--accent"><?php pll_e('Checkout');?></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


<?php /*
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
*/ ?>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
