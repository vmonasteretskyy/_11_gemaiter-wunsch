<div style="display: none;">
    <button data-href="#modal-thank" class=" modal-event-js btn btn--accent">Thank you</button>
    <button data-href="#modal-oops" class="btn btn--accent modal-event-js">Oops</button>
    <button data-href="#modal-edit" class="btn btn--accent modal-event-js">Edit</button>
    <button data-href="#modal-contact" class="btn btn--accent modal-event-js">Contact Us</button>
    <button data-href="#modal-money" class="btn btn--accent modal-event-js">Monet refund</button>
    <button data-href="#modal-order" class="btn btn--accent modal-event-js">Order</button>

    <div style="display: none;">
        <?php
        echo do_shortcode('[contact-form-7 id="420" title="Contact form"]');
        ?>
    </div>
</div>
<!-- Class notation: "modal-event-js" class will listen to document.dispatchEvent -->
<div id="modal-info" class="modal modal--small">
    <div class="modal__window modal-icon-line">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label"><?php pll_e('close'); ?></div>
        </div>
      </span>
        <div class="modal__content text--center">
            <h2 class="modal-title" data-title=""></h2>
            <div class="modal-bg">
                <p>
                    <i data-description="">
                    </i>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="modal-info-btn" class="modal modal--small">
    <div class="modal__window modal-icon-line">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label"><?php pll_e('close'); ?></div>
        </div>
      </span>
        <div class="modal__content text--center">
            <h2 class="modal-title" data-title=""></h2>
            <div class="modal-bg">
                <p>
                    <i data-description="">
                    </i>
                </p>
            </div>
            <div class="btn btn--accent-border" data-btn=""></div>
        </div>
    </div>
</div>
<div id="modal-thank" class="modal modal--small">
    <div class="modal__window modal-icon-line">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label"><?php pll_e('close'); ?></div>
        </div>
      </span>
        <div class="modal__content text--center">
            <h2 class="modal-title "><?php pll_e('Congrats!'); ?></h2>
            <div class="modal-bg">
                <p>
                    <i>
                        <?php pll_e("Your order has been placed successfully!");?> <br>
                        <?php pll_e("View details in your email <a href='mailto:EMAIL'>EMAIL</a>");?>
                    </i>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="modal-oops" class="modal modal--small">
    <div class="modal__window">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label"><?php pll_e('close'); ?></div>
        </div>
      </span>
        <div class="modal__content text--center">
            <h2 class="modal-title "><?php pll_e('Something went wrong...'); ?></h2>
            <div class="modal-bg">
                <p><i><?php pll_e('Apparently the payment was unsuccessful. <br>Take a step back and try again.'); ?> </i></p>
            </div>
            <a href="<?php the_url( (get_url_lang_prefix()) . 'checkout/');?>" class="btn btn--accent-border"><?php pll_e('Back'); ?></a>
        </div>
    </div>
</div>

<div id="modal-contact" class="modal">
    <div class="modal__window modal-icon-line">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label"><?php pll_e('close'); ?></div>
        </div>
      </span>

        <div class="modal__content ">
            <h2 class="modal-title text--center"><?php pll_e('Contact Us'); ?></h2>
            <p class="text--center"><i>
                    <?php pll_e('Leave your phone number or email and we will contact you'); ?> </i></p>
            <div class="modal-bg">

                <div class="error-text error-required-field"><?php pll_e("Fill in the required fields of the form.");?></div>
                <div class="error-text error-some-error"><?php pll_e("An error has occurred, please try again or contact us.");?></div>
                <div class="success-text"><?php pll_e("Your request has been sent successfully.");?></div>

                <form class="form form-visible">
                    <div class="c-form-country-select form-group--05">
                        <span class="wpcf7-form-control-wrap phone">
                            <input type="tel" name="phone-cf7it-national" value="" class="phone-mask wpcf7-form-control wpcf7-intl-tel wpcf7-intl_tel wpcf7-validates-as-required" aria-required="true" aria-invalid="false" data-initialcountry="us" data-preferredcountries="us-de" />
                            <input type="hidden" name="phone" class="wpcf7-intl-tel-full" />
                            <input type="hidden" name="phone-cf7it-country-name" class="wpcf7-intl-tel-country-name" />
                            <input type="hidden" name="phone-cf7it-country-code" class="wpcf7-intl-tel-country-code" />
                            <input type="hidden" name="phone-cf7it-country-iso2" class="wpcf7-intl-tel-country-iso2" />
                        </span>
                        <!--<input type="number" name="contact-phone" id="contact-phone-code" class="phone-mask" placeholder="+xxx-xxx-xxxx*">-->
                    </div>

                    <div class="form-group--05">
                        <input type="email" name="contact-email" id="contact-email" class="input-animation"
                               placeholder="Email address *">
                        <label for="contact-email" class="form__label"><?php pll_e('Email address'); ?> *</label>
                    </div>

                    <div class="form-group modal-massage">
                        <label for="contact-message"><?php pll_e('Message (optional)'); ?></label>
                        <textarea name="contact-message" id="contact-message" cols="10" rows="2"></textarea>
                    </div>
                </form>

            </div>

            <div class="modal-action">
                <div data-contact-form_submit="" class="btn btn--accent-border"><?php pll_e('Send'); ?></div>
            </div>
        </div>

    </div>
</div>

<?php
    $countries = getCountries();
    $refundReasons = getRefundReasons();
?>
<div id="modal-money" class="modal">
    <div class="modal__window">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label"><?php pll_e('close'); ?></div>
        </div>
      </span>

        <div class="modal__content  modal-icon-money">
            <h2 class="modal-title text--center"><?php pll_e('Money Refund'); ?></h2>
            <p class="text--center"><i>
                    <?php pll_e('Please fill out this form to get a refund'); ?>
                </i></p>
            <div class="modal-bg">

                <div class="error-text error-required-field"><?php pll_e("Fill in the required fields of the form.");?></div>
                <div class="error-text error-some-error"><?php pll_e("An error has occurred, please try again or contact us.");?></div>
                <div class="success-text"><?php pll_e("Your request has been sent successfully.");?></div>

                <form class="form ">
                    <div class="form-group--05">
                        <input type="text" name="first_name" id="first-name" placeholder="<?php pll_e('First Name'); ?> *" class="input-animation"
                               required>
                        <label for="first-name" class="form__label"><?php pll_e('First Name'); ?> *</label>
                    </div>
                    <div class="form-group--05">
                        <input type="text" name="last_name" id="last-name" class="input-animation" placeholder="<?php pll_e('Last Name'); ?> *"
                               required>
                        <label for="last-name" class="form__label"><?php pll_e('Last Name'); ?> *</label>
                    </div>
                    <div class="form-group--05">
                        <input type="text" name="address" id="address-1" class="input-animation" placeholder="<?php pll_e('Address line 1'); ?> *"
                               required>
                        <label for="address-1" class="form__label"><?php pll_e('Address line 1'); ?> *</label>
                    </div>
                    <div class="form-group--05">
                        <input type="text" name="address2" id="address-2" class="input-animation"
                               placeholder="<?php pll_e('Address line 2 (optional)'); ?>">
                        <label for="address-2" class="form__label"><?php pll_e('Address line 2 (optional)'); ?></label>
                    </div>
                    <div class="form-group--05">
                        <input type="text" name="city" id="city" class="input-animation" placeholder="<?php pll_e('City'); ?> *" required>
                        <label for="city" class="form__label"><?php pll_e('City'); ?> *</label>
                    </div>
                    <div class="form-group--05">
                        <input type="text" name="state" id="state" class="input-animation" placeholder="<?php pll_e('State'); ?> *" required>
                        <label for="city" class="form__label"><?php pll_e('State'); ?> *</label>
                    </div>
                    <div class="form-group--05">
                        <input type="text" name="postal_code" id="postal-code" class="input-animation" placeholder="<?php pll_e('Postal code'); ?> *"
                               required>
                        <label for="postal-code" class="form__label"><?php pll_e('Postal code'); ?> *</label>
                    </div>
                    <div class="form-group--select form-group--white form-group--05">
                        <label class="select-label select-label-js">
                            <div class="select-label__picture">
                            </div>
                            <input class="input input-value-js" type="text" readonly placeholder="<?php pll_e('Country'); ?> *" required />
                            <!-- Value of this input will be sent to back -->
                            <input class="input input-key-js" name="country" readonly hidden required>
                        </label>
                        <?php if ($countries): ?>
                            <ul class="options options-js">
                                <?php foreach ($countries as $code => $country): ?>
                                    <li class="option option-js" data-key="<?php echo $country; ?>">
                                        <div class="option__text"><?php pll_e($country); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="c-form-country-select form-group--05">
                        <span class="wpcf7-form-control-wrap phone">
                            <input type="tel" name="phone-cf7it-national" value="" class="phone-mask wpcf7-form-control wpcf7-intl-tel wpcf7-intl_tel wpcf7-validates-as-required" aria-required="true" aria-invalid="false" data-initialcountry="us" data-preferredcountries="us-de"/>
                            <input type="hidden" name="phone" class="wpcf7-intl-tel-full" />
                            <input type="hidden" name="phone-cf7it-country-name" class="wpcf7-intl-tel-country-name" />
                            <input type="hidden" name="phone-cf7it-country-code" class="wpcf7-intl-tel-country-code" />
                            <input type="hidden" name="phone-cf7it-country-iso2" class="wpcf7-intl-tel-country-iso2" />
                        </span>
                        <!--<input type="number" name="postal-code" id="postal-code" class="phone-mask" placeholder="+xxx-xxx-xxxx" required>-->

                    </div>
                    <div class="form-group--05">
                        <input type="email" name="email" id="email" class="input-animation"
                               placeholder="<?php pll_e('Email address'); ?> *" required>
                        <label for="email" class="form__label"><?php pll_e('Email address'); ?> *</label>
                    </div>
                    <div class="form-group--select form-group--white modal-money-refund">
                        <label class="select-label select-label-js">
                            <div class="select-label__picture">
                            </div>
                            <input class="input input-value-js" type="text" readonly placeholder="<?php pll_e('Choose a reason for refund'); ?>" required />
                            <!-- Value of this input will be sent to back -->
                            <input class="input input-key-js" name="refund_reason" readonly hidden required>
                        </label>
                        <?php if ($refundReasons): ?>
                            <ul class="options options-js">
                                <?php foreach ($refundReasons as $code => $refundReason): ?>
                                    <li class="option option-js" data-key="<?php echo $refundReason; ?>">
                                        <div class="option__text"><?php pll_e($refundReason); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="form-group modal-massage">
                        <label for="other_refund_reason"><?php pll_e('Other reason'); ?></label>
                        <textarea name="other_refund_reason" id="other_refund_reason" cols="10" rows="2"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-action">
                <div class="btn btn--accent-border" data-refund-form_submit=""><?php pll_e('Send'); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Trigger example -->
<!-- Open without trigger example -->
<!--<script>-->
<!--	var submitBtn = document.querySelector('.checkout button');-->

<!--	submitBtn && submitBtn.addEventListener('click', function() {-->
<!--		document.dispatchEvent(new Event('modal-open#modal-id'));-->
<!--	});-->
<!--</script>-->
<!-- Open without trigger example -->
<!--<script>-->
<!--	var checkoutForm = document.querySelector('#checkout-form');-->

<!--	checkoutForm && checkoutForm.addEventListener('submit', function(event) {-->
<!--		event.preventDefault();-->
<!--		document.dispatchEvent(new Event('modal-open#modal-id'));-->
<!--	});-->
<!-- Close without trigger example -->
<!--    document.dispatchEvent(new Event('modal-close#modal-id'));-->
<!--</script>-->

