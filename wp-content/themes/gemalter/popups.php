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

            <div class="btn btn--accent-border"><?php pll_e('Back'); ?></div>
        </div>
    </div>
</div>
<div id="modal-edit" class="modal">
    <div class="modal__window">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label">close</div>
        </div>
      </span>

        <div class="modal__content ">
            <h2 class="modal-title text--center h5"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M41 25C40.3905 25 40 26.3873 40 27V36C39.9978 37.8368 37.8278 39.9978 36 40H6C4.17225 39.9978 2.00216 37.8368 2 36V8C2.00216 6.16273 4.17225 4.00217 6 4H15C15.6095 4 16 3.61271 16 3C16 2.38729 15.6095 2 15 2H6C2.95403 2.00347 0.00344859 4.93818 0 8V36C0.00344859 39.0618 2.95403 41.9965 6 42H36C39.046 41.9965 41.9966 39.0618 42 36V27C42 26.3873 41.6095 25 41 25Z" fill="#F9AB97"/>
                    <path d="M18 19L34 3L39 8L23 24L18 19Z" fill="#F9AB97"/>
                    <path d="M15 27L21 25L17 21L15 27Z" fill="#F9AB97"/>
                    <path d="M40 1.00002C38.948 -0.0494845 37.052 -0.0494845 36 1.00002L35 2.00002L40 7.00002L41 6.00002C42.0499 4.94799 42.0499 3.05204 41 2.00002L40 1.00002Z" fill="#F9AB97"/>
                </svg>
                Order Editing</h2>
            <p class="text--center"><i>
                    Jl zril dolorum ea. Cu iusto oporteat rationibus duo.
                    In pro debet </i></p>
            <div class="modal-bg">

                <div class="form ">
                    <div class="form-group--select form-group--white form-group--05">
                        <label class="select-label select-label-js">
                            <div class="select-label__picture">
                            </div>
                            <input class="input input-value-js" type="text" readonly placeholder="1 person" required />

                            <!-- Value of this input will be sent to back -->
                            <input class="input input-key-js" name="form-person" readonly hidden required>
                            <div class="select-label__bottom">
                                Person / Pets
                            </div>
                        </label>

                        <ul class="options options-js">
                            <li class="option option-js" data-key="option 1">
                                <div class="option__text">option 1</div>
                            </li>
                            <li class="option option-js" data-key="option 2">
                                <div class="option__text">option 2</div>
                            </li>
                            <li class="option option-js" data-key="option 3">
                                <div class="option__text">option 3</div>
                            </li>
                            <li class="option option-js" data-key="option 4">
                                <div class="option__text">option4</div>
                            </li>
                            <li class="option option-js" data-key="option 5">
                                <div class="option__text">option 5</div>
                            </li>
                            <li class="option option-js" data-key="option 6">
                                <div class="option__text">option 6</div>
                            </li>
                            <li class="option option-js" data-key="option 7">
                                <div class="option__text">option 7</div>
                            </li>
                            <li class="option option-js" data-key="option 8">
                                <div class="option__text">option 8</div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group--select form-group--white form-group--05">
                        <label class="select-label select-label-js">
                            <div class="select-label__picture">
                            </div>
                            <input class="input input-value-js" type="text" readonly placeholder="Oil Portrait" required />

                            <!-- Value of this input will be sent to back -->
                            <input class="input input-key-js" name="form-style" readonly hidden required>
                            <div class="select-label__bottom">
                                Style
                            </div>
                        </label>

                        <ul class="options options-js">
                            <li class="option option-js" data-key="option 1">
                                <div class="option__text">option 1</div>
                            </li>
                            <li class="option option-js" data-key="option 2">
                                <div class="option__text">option 2</div>
                            </li>
                            <li class="option option-js" data-key="option 3">
                                <div class="option__text">option 3</div>
                            </li>
                            <li class="option option-js" data-key="option 4">
                                <div class="option__text">option4</div>
                            </li>
                            <li class="option option-js" data-key="option 5">
                                <div class="option__text">option 5</div>
                            </li>
                            <li class="option option-js" data-key="option 6">
                                <div class="option__text">option 6</div>
                            </li>
                            <li class="option option-js" data-key="option 7">
                                <div class="option__text">option 7</div>
                            </li>
                            <li class="option option-js" data-key="option 8">
                                <div class="option__text">option 8</div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group--select form-group--white form-group--05">
                        <label class="select-label select-label-js">
                            <div class="select-label__picture">
                            </div>
                            <input class="input input-value-js" type="text" readonly placeholder="90x120 cm" required />

                            <!-- Value of this input will be sent to back -->
                            <input class="input input-key-js" name="form-size" readonly hidden required>
                            <div class="select-label__bottom">
                                Size
                            </div>
                        </label>

                        <ul class="options options-js">
                            <li class="option option-js" data-key="option 1">
                                <div class="option__text">option 1</div>
                            </li>
                            <li class="option option-js" data-key="option 2">
                                <div class="option__text">option 2</div>
                            </li>
                            <li class="option option-js" data-key="option 3">
                                <div class="option__text">option 3</div>
                            </li>
                            <li class="option option-js" data-key="option 4">
                                <div class="option__text">option4</div>
                            </li>
                            <li class="option option-js" data-key="option 5">
                                <div class="option__text">option 5</div>
                            </li>
                            <li class="option option-js" data-key="option 6">
                                <div class="option__text">option 6</div>
                            </li>
                            <li class="option option-js" data-key="option 7">
                                <div class="option__text">option 7</div>
                            </li>
                            <li class="option option-js" data-key="option 8">
                                <div class="option__text">option 8</div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group--select form-group--white form-group--05">
                        <label class="select-label select-label-js">
                            <div class="select-label__picture">
                            </div>
                            <input class="input input-value-js" type="text" readonly placeholder="Blue Bronze" required />

                            <!-- Value of this input will be sent to back -->
                            <input class="input input-key-js" name="modal-bg" readonly hidden required>
                            <div class="select-label__bottom">
                                Background
                            </div>
                        </label>

                        <ul class="options options-js">
                            <li class="option option-js" data-key="option 1">
                                <div class="option__text">option 1</div>
                            </li>
                            <li class="option option-js" data-key="option 2">
                                <div class="option__text">option 2</div>
                            </li>
                            <li class="option option-js" data-key="option 3">
                                <div class="option__text">option 3</div>
                            </li>
                            <li class="option option-js" data-key="option 4">
                                <div class="option__text">option4</div>
                            </li>
                            <li class="option option-js" data-key="option 5">
                                <div class="option__text">option 5</div>
                            </li>
                            <li class="option option-js" data-key="option 6">
                                <div class="option__text">option 6</div>
                            </li>
                            <li class="option option-js" data-key="option 7">
                                <div class="option__text">option 7</div>
                            </li>
                            <li class="option option-js" data-key="option 8">
                                <div class="option__text">option 8</div>
                            </li>
                        </ul>
                    </div>        </div>


            </div>

            <div class="modal-action">
                <div class="btn btn--accent-border">Save</div>
            </div>
        </div>

        <div class="modal-bg-icon">
            <svg width="221" height="221" viewBox="0 0 221 221" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 157L150 28L192 70L63 199L21 157Z" fill="#FAE8E5"/>
                <path d="M0 221L46 208L13 175L0 221Z" fill="#FAE8E5"/>
                <path d="M204 7.00041C195.284 -1.69545 180.716 -1.69545 172 7.00041L163 16.0004L205 58.0004L214 49.0004C222.699 40.2836 222.699 25.7172 214 17.0004L204 7.00041Z" fill="#FAE8E5"/>
            </svg>
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

<div id="modal-order" class="modal modal--big">
    <div class="modal__window">
      <span class="modal__cross modal-close-js">
        <div class="close cursor modal-lightbox-close">
          <span></span>
          <span></span>
          <div class="label">close</div>
        </div>
      </span>

        <div class="modal__content">
            <h2 class="h5 title--under-line">Oil portrait</h2>
            <!-- Start img-text-mod section -->
            <section class="section img-text-mod img-text-mod--right-gray img-text-mod--mob-gray " >

                <div class="container-small">
                    <div class="img-text-mod-inner">

                        <div class="img-text-mod__left">
                            <div class="img-text-mod-label">
                                <p class="vertical-label"> your choice</p>
                            </div>
                            <div class="img-text-mod__picture img-text-mod-transform "
                            >
                                <img src="img/about-img-text-3-min.jpg" alt="">
                            </div>
                        </div>
                        <div class="img-text-mod__right">










                            <h3 class="title h5">
                                Characteristics:
                            </h3>

                            <div class="text">

                                <p>
                                    Oil portraits emphasize the bright tones and are characterized by the depth of colors. Oils allow artists to
                                    create a wide range of tonal transitions and shades which makes your portrait richer in colors and full of
                                    emotions. They will decorate your home for ages.
                                </p>
                            </div>

                            <h3 class="title h5">
                                Material & Framing:
                            </h3>
                            <p class="text">
                                Oil portraits are painted on canvas and don’t need any protective glass.
                            </p>


                        </div>
                    </div>
                </div>

            </section>
            <!-- End img-text-mod section -->    </div>
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

