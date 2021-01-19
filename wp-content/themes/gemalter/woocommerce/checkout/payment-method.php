<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$gID = $gateway->id;

?>
<li>
    <div class="c-payment__acc">
        <label class="radio-button " for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
            <input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo pll__(esc_attr( $gateway->order_button_text )); ?>">
            <span class="checkmark"></span>
            <?php if ($gID == 'paypal'): ?>
                <img src="<?php echo the_theme_path(); ?>/img/pay-paypal-min.png" alt="paypal">
            <?php elseif ($gID == 'stripe_sofort'): ?>
                <img src="<?php echo the_theme_path(); ?>/img/pay-sofort-min.png" alt="sofort">
            <?php elseif ($gID == 'stripe'): ?>
                <?php echo pll__($gateway->get_title());?>
                <div class="stripe-source-errors"></div>
            <?php elseif ($gID == 'klarna_payments_pay_later'): ?>
                <?php echo pll__($gateway->get_title());?> <?php echo $gateway->get_icon();?>
            <?php else: ?>
                <?php echo pll__($gateway->get_title());?>
            <?php endif;?>
        </label>
    </div>
    <?php if ($gID == 'stripe'): ?>
        <?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
            <div class="stripe_extra_fields" <?php if(!$gateway->chosen): ?> style="display: none;" <?php endif; ?>>
                <div class="credit-card form">
                    <div class="credit-card__picture">
                        <svg width="415" height="257" viewBox="0 0 415 257" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g class="svg-cvv">
                                <rect y="36" width="415" height="42" fill="#DCDCDC"/>
                                <rect x="0.5" y="0.5" width="414" height="256" rx="19.5" stroke="#CDCFD6"/>
                                <rect x="281" y="116" width="41" height="11" rx="4" fill="#DCDCDC"/>
                                <rect x="262.5" y="95.5" width="82" height="51" rx="5.5" fill="#F9AB97" fill-opacity="0.2" stroke="#F9AB97"/>
                            </g>
                            <g class="svg-card-front">
                                <path d="M10 256.5C222.185 231.6 310.504 179.17 411.26 22.8424C412.344 21.1604 415 21.8693 415 23.8703V237.68C415 237.892 414.966 238.106 414.899 238.308C411.192 249.452 407.163 253.822 395.757 256.907C395.589 256.952 395.412 256.976 395.237 256.976L10 256.5Z" fill="#FCFCFC"/>
                                <rect x="0.5" y="0.5" width="414" height="256" rx="19.5" stroke="#CDCFD6"/>
                                <rect x="36.873" y="22.9297" width="34.4704" height="7.66008" rx="2" fill="#DCDCDC"/>
                                <rect x="79.0039" y="22.9297" width="53.6206" height="7.66008" rx="2" fill="#DCDCDC"/>
                                <rect x="38.1504" y="136.555" width="61.2806" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="114.75" y="136.555" width="66.3874" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="196.459" y="136.555" width="63.834" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="228" y="214" width="40.8538" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="38.1504" y="214.432" width="40.8538" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="87.9414" y="214.432" width="61.2806" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="278.166" y="136.555" width="63.834" height="11.4901" rx="4" fill="#DCDCDC"/>
                                <rect x="38.1504" y="66.3359" width="49.7905" height="42.1304" rx="6" fill="#DCDCDC"/>
                                <rect class="svg-holder " x="19.5" y="193.229" width="148.372" height="51.3439" rx="5.5" fill="#F9AB97" fill-opacity="0.2" stroke="#F9AB97"/>
                                <rect class="svg-date" x="214.5" y="193.5" width="68" height="51" rx="5.5" fill="#F9AB97" fill-opacity="0.2" stroke="#F9AB97"/>
                                <rect class="svg-number" x="19.5" y="116.5" width="340" height="51" rx="5.5" fill="#F9AB97" fill-opacity="0.2" stroke="#F9AB97"/>
                                <path d="M364.628 229.723C364.74 229.895 364.931 229.998 365.137 229.998H369.496C369.748 229.998 369.975 229.842 370.064 229.606C370.6 228.193 370.944 227.292 371.057 227.001C371.347 227.001 372.686 227.003 374.121 227.005H374.202C375.852 227.007 377.604 227.01 378.024 227.01C378.147 227.539 378.454 228.942 378.581 229.52C378.642 229.799 378.889 229.998 379.174 229.998H382.976C383.16 229.998 383.334 229.914 383.449 229.771C383.564 229.627 383.608 229.439 383.569 229.26L379.435 210.531C379.373 210.253 379.127 210.055 378.842 210.055H375.128C373.643 210.055 372.791 210.55 372.279 211.71L364.581 229.145C364.498 229.333 364.516 229.55 364.628 229.723ZM375.515 215.435L375.882 217.158L377.141 222.917H372.623H372.623L375.515 215.435Z" fill="#B2B2B2"/>
                                <path d="M349.832 229.083C351.267 229.586 353.27 229.899 355.19 229.92C355.192 229.92 355.194 229.92 355.196 229.92C360.702 229.919 364.286 227.338 364.325 223.346C364.346 221.15 362.945 219.49 359.935 218.128C358.092 217.233 356.963 216.638 356.973 215.728C356.973 214.909 358.006 214.081 359.989 214.08C360.037 214.08 360.094 214.079 360.149 214.079C361.797 214.079 362.96 214.453 363.692 214.734C363.862 214.799 364.052 214.784 364.21 214.694C364.369 214.604 364.478 214.448 364.509 214.268L365 211.377C365.051 211.079 364.875 210.789 364.586 210.696C363.682 210.407 362.221 210.062 360.39 210.062C355.2 210.062 351.555 212.673 351.526 216.409C351.494 219.176 354.132 220.719 356.121 221.639C358.161 222.58 358.846 223.182 358.837 224.025C358.823 225.316 357.202 225.903 355.701 225.903C353.566 225.903 352.416 225.581 350.788 224.904C350.617 224.833 350.423 224.844 350.261 224.933C350.099 225.022 349.987 225.181 349.956 225.363L349.435 228.407C349.384 228.7 349.552 228.985 349.832 229.083Z" fill="#B2B2B2"/>
                                <path d="M319.402 211.179C322.882 212.431 325.729 214.419 327.635 216.927C327.752 217.082 327.933 217.167 328.119 217.167C328.204 217.167 328.29 217.149 328.371 217.112C328.63 216.993 328.772 216.712 328.713 216.434L327.7 211.645C327.698 211.635 327.696 211.625 327.693 211.614C327.329 210.247 326.176 210.044 325.34 210.01C325.332 210.01 325.324 210.009 325.317 210.009L319.609 210C319.608 210 319.608 210 319.608 210C319.313 210 319.06 210.212 319.009 210.503C318.958 210.793 319.124 211.079 319.402 211.179Z" fill="#F0F0F0"/>
                                <path d="M340.471 229.775C340.587 229.912 340.757 229.99 340.936 229.99H345.141C345.437 229.99 345.69 229.777 345.74 229.485L348.936 210.745C348.966 210.568 348.917 210.388 348.801 210.251C348.686 210.114 348.516 210.035 348.337 210.035H344.128C343.832 210.035 343.579 210.249 343.53 210.541L340.337 229.281C340.307 229.457 340.356 229.639 340.471 229.775Z" fill="#B2B2B2"/>
                                <path d="M323.667 214.35C323.458 214.19 323.171 214.182 322.954 214.33C322.737 214.479 322.64 214.75 322.714 215.002L326.968 229.538C327.044 229.797 327.282 229.975 327.551 229.975C327.552 229.975 327.552 229.975 327.552 229.975L332.452 229.968C332.694 229.968 332.913 229.823 333.009 229.601L341.051 210.898C341.132 210.711 341.113 210.495 341 210.324C340.888 210.153 340.697 210.051 340.493 210.051H340.492L336.068 210.053C335.819 210.053 335.594 210.206 335.503 210.439L330.327 223.661L329.771 221.646C329.763 221.619 329.754 221.593 329.743 221.567C328.926 219.671 326.73 216.704 323.667 214.35Z" fill="#B2B2B2"/>
                            </g>
                        </svg>
                    </div>
                    <?php /*
                    <div class="credit-card__number">
                        <input type="text" name="postal-code" id="card-number"  data-target='svg-number' class="input-animation card-number-field" placeholder="Card Number">
                        <label for="card-number" class="form__label">Card Number</label>
                    </div>*/?>
                    <div class="credit-card__row">
                        <?php /*
                        <div class="credit-card__holder active">
                            <input type="text" name="postal-code" id="card-holder" data-target='svg-holder' class="input-animation" placeholder="Card Holder">
                            <label for="card-holder" class="form__label">Card Holder</label>
                        </div>
                        <div class="credit-card__date">
                            <input type="text" name="postal-code" id="card-date" data-target='svg-date' class="input-animation card-date-field" placeholder="Exp. Date">
                            <label for="card-date" class="form__label">Exp. Date</label>
                        </div>
                        <div class="credit-card__cvv">
                            <input type="number" name="postal-code" id="card-cvv" data-target='svg-cvv' class="input-animation" placeholder="CVV">
                            <label for="card-cvv" class="form__label">CVV</label>
                        </div>*/?>

                        <div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif;  ?>>
                            <?php /*$gateway->payment_fields();*/ ?>
                            <div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif;  ?>>
                                <fieldset id="wc-<?php echo esc_attr( $gateway->id ); ?>-cc-form" class="wc-credit-card-form wc-payment-form" style="background:transparent;">
                                    <?php do_action( 'woocommerce_credit_card_form_start', $gateway->id ); ?>

                                    <?php if ( $gateway->inline_cc_form ) { ?>
                                        <label for="card-element">
                                            <?php pll_e( 'Credit or debit card'); ?>
                                        </label>

                                        <div id="stripe-card-element" class="wc-stripe-elements-field" data-target='svg-number'>
                                            <!-- a Stripe Element will be inserted here. -->
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-row form-row-wide">
                                            <label for="stripe-card-element"><?php pll_e( 'Card Number'); ?> <span class="required">*</span></label>
                                            <div class="stripe-card-group">
                                                <div id="stripe-card-element" class="credit-card__number wc-stripe-elements-field" data-target='svg-number'>
                                                    <!-- a Stripe Element will be inserted here. -->
                                                </div>

                                                <i class="stripe-credit-card-brand stripe-card-brand" alt="Credit Card"></i>
                                            </div>
                                        </div>

                                        <div class="form-row form-row-wide2">
                                            <div class="form-row form-row-first">
                                                <label for="stripe-exp-element"><?php pll_e( 'Expiry Date'); ?> <span class="required">*</span></label>

                                                <div id="stripe-exp-element" class="wc-stripe-elements-field" data-target='svg-date'>
                                                    <!-- a Stripe Element will be inserted here. -->
                                                </div>
                                            </div>

                                            <div class="form-row form-row-last">
                                                <label for="stripe-cvc-element"><?php pll_e( 'Card Code (CVC)'); ?> <span class="required">*</span></label>
                                                <div id="stripe-cvc-element" class="wc-stripe-elements-field" data-target='svg-cvv'>
                                                    <!-- a Stripe Element will be inserted here. -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    <?php } ?>

                                    <!-- Used to display form errors -->
                                    <div class="stripe-source-errors" role="alert"></div>
                                    <br />
                                    <?php do_action( 'woocommerce_credit_card_form_end', $gateway->id ); ?>
                                    <div class="clear"></div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    <?php endif;?>
    <?php if ($gID == 'klarna_payments_pay_later'): ?>
        <?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
            <div <?php if (!$gateway->chosen):?>  <?php endif;?>  class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif;  ?>>
                <?php $gateway->payment_fields(); ?>
            </div>
        <?php endif; ?>
    <?php endif;?>
</li>

<?php  /*?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
		<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon();?>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif;  ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>

<?php */ ?>
