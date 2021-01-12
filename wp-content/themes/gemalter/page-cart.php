<?php
/**
 * The template for displaying cart page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gemalter
 */
global $post;

$postItem = get_page_by_path('order', OBJECT, 'page');
$fields = $postItem ? get_fields($postItem->ID) : null;
$postGift = get_page_by_path('gift-cards', OBJECT, 'page');
$fields2 = get_fields($postGift->ID);

$current_lang = pll_current_language();
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

if (WC()->cart->is_empty()) {
    $location = (get_url_lang_prefix()) . 'order/';
    wp_redirect($location);
    exit;
}
$cartItems = WC()->cart->get_cart();

session_start();
$shippingFields = getShippingFieldsFromSession();

//WC()->cart->calculate_totals();
//WC()->cart->maybe_set_cart_cookies();

get_header();
?>
    <!--Start page-->
    <div class="page-wrapper page-cart">
        <div class="cart-wrap">
            <div class="cart">
                <div class="cart-head">
                    <h2><?php pll_e('Cart'); ?></h2>
                    <div class="cart-head__amount">
                        <p><?php pll_e('Total Amount'); ?>: <span><?php echo $data['currency_symbol']; ?></span></p>
                        <div class="cart-amount h1" data-cart-total-amount="">
                            <?php echo WC()->cart->get_cart_total(); ?>
                        </div>
                    </div>
                </div>
                <div class="cart-inner">
                    <div class="cards">
                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                            $cartItemType = isset($cart_item['attributes']['product_type']) ? $cart_item['attributes']['product_type'] : '';
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
                                    //$pets
                                    $persons = $cart_item['attributes']['subject_custom']['persons'];
                                    $pets = $cart_item['attributes']['subject_custom']['pets'];
                                    $subjectTitle .= ': ' . ($persons ? $persons . ' ' . pll__('Persons') : '') . ($persons && $pets ? ", " : "") . ($pets ? $pets . ' ' . pll__('Pets') : '');
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
                                $price = number_format($cart_item['price'], 0);
                                $basePrice = isset($cart_item['attributes']['base_price']) ? number_format($cart_item['attributes']['base_price']) : 0;
                                $framePrice = isset($cart_item['attributes']['frame_price']) ? number_format($cart_item['attributes']['frame_price']) : 0;
                                $baseDiscountPrice = isset($cart_item['attributes']['base_discount_price']) ? number_format($cart_item['attributes']['base_discount_price']) : 0;
                            } else {
                                $productTitle = pll__("Gift Card");
                                $price = number_format($cart_item['price'], 0);
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
                                $currencySymbol = $currency == 'eur' ? '€' : '$';
                                $amount = isset($cart_item['attributes']['gift_amount']) ? $cart_item['attributes']['gift_amount'] : '';
                            }
                            ?>
                            <?php if ($cartItemType == 'picture'): ?>
                            <div class="card">
                                <div class="card__picture">
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image; ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo the_theme_path(); ?>/img/chose-3-min.jpg" alt="">
                                    <?php endif; ?>
                                </div>

                                <div class="card__text card-descr">
                                    <h6 class="card-descr__title">
                                        <?php echo $productTitle; ?>
                                    </h6>
                                    <p class="text--ls-05 card-descr__person">
                                        <?php echo $subjectTitle; ?>
                                    </p>
                                    <div class="card-descr-row text--ls-05">
                                        <p><span><?php pll_e('Size'); ?>: </span> <?php echo $sizeTitle; ?></p>
                                    </div>
                                    <div class="card-descr-row">
                                        <p><span><?php pll_e('Background'); ?>: </span>
                                            <?php if ($backgroundColor): ?><span class="card-bg-color" style="background-color:  <?php echo $backgroundColor; ?>"></span><?php endif; ?>
                                            <?php echo $backgroundTitle; ?>
                                        </p>
                                    </div>
                                    <div class="card-amount">
                                        <p>
                                          <span class="f-16">
                                            <?php echo $data['currency_symbol']; ?>
                                          </span>
                                            <?php echo $price; ?>
                                            <?php if ($framePrice || $baseDiscountPrice): ?>
                                                <span class="f-16 color-gray">
                                                (
                                                <span class="f-12"><?php echo $data['currency_symbol']; ?></span>
                                                <?php echo $basePrice; ?>
                                                    <?php if ($framePrice): ?>
                                                        +
                                                        <span class="f-12"><?php echo $data['currency_symbol']; ?></span>
                                                        <?php echo $framePrice; ?>
                                                    <?php endif; ?>
                                                    <?php if ($baseDiscountPrice): ?>
                                                        -
                                                        <span class="f-12"><?php echo $data['currency_symbol']; ?></span>
                                                        <?php echo $baseDiscountPrice; ?>
                                                    <?php endif; ?>
                                                )
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                    </div>

                                    <div class="card-number">
                                        <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity'] - 1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="minus" class="card-number__minus <?php if ($cart_item['quantity'] < 2): ?>hide<?php endif; ?>">-</button>
                                        <input type="number" class="card-number__field" readonly placeholder="<?php echo $cart_item['quantity']; ?>" value="<?php echo $cart_item['quantity']; ?>">
                                        <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity'] + 1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="plus" class="card-number__plus">+</button>
                                    </div>
                                </div>
                                <div class="card__actions">
                                    <a href="javascript:void(0);" class="card-cross"
                                       data-delete-item="<?php echo $cart_item_key; ?>">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.8811 12.5L24.714 1.66715C25.0954 1.28575 25.0954 0.667394 24.714 0.286047C24.3326 -0.0953001 23.7142 -0.0953489 23.3329 0.286047L12.5 11.1189L1.66715 0.286047C1.28575 -0.0953489 0.667394 -0.0953489 0.286047 0.286047C-0.0953001 0.667442 -0.0953489 1.2858 0.286047 1.66715L11.1189 12.5L0.286047 23.3329C-0.0953489 23.7143 -0.0953489 24.3326 0.286047 24.714C0.47672 24.9046 0.726671 25 0.976622 25C1.22657 25 1.47647 24.9046 1.6672 24.714L12.5 13.8811L23.3328 24.714C23.5235 24.9046 23.7735 25 24.0234 25C24.2734 25 24.5233 24.9046 24.714 24.714C25.0954 24.3326 25.0954 23.7142 24.714 23.3329L13.8811 12.5Z" fill="#545454"/>
                                        </svg>
                                    </a>

                                    <a href="<?php echo (get_url_lang_prefix()) . 'order/?cart_item_id=' . $cart_item_key; ?>">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.2829 15.2178C23.921 15.2178 23.6276 15.5111 23.6276 15.8731V21.6912C23.6263 22.7762 22.7471 23.6557 21.6619 23.657H3.27625C2.19099 23.6557 1.31178 22.7762 1.3105 21.6912V4.61609C1.31178 3.53083 2.19099 2.65162 3.27625 2.65034H9.09414C9.45607 2.65034 9.74939 2.35702 9.74939 1.99509C9.74939 1.63317 9.45607 1.33984 9.09414 1.33984H3.27625C1.46766 1.34189 0.00204765 2.8075 0 4.61609V21.6912C0.00204765 23.4998 1.46766 24.9654 3.27625 24.9675H21.6619C23.4705 24.9654 24.9361 23.4998 24.9381 21.6912V15.8733C24.9381 15.5114 24.6448 15.2178 24.2829 15.2178Z" fill="#545454"/>
                                            <path d="M10.2461 11.7688L19.8135 2.20117L22.8991 5.28673L13.3317 14.8544L10.2461 11.7688Z" fill="#545454"/>
                                            <path d="M8.68555 16.4157L12.0954 15.4712L9.63003 13.0059L8.68555 16.4157Z" fill="#545454"/>
                                            <path d="M23.7518 0.580522C23.1117 -0.0580905 22.0753 -0.0580905 21.4352 0.580522L20.7402 1.27544L23.8258 4.361L24.5207 3.66608C25.1596 3.02593 25.1596 1.98956 24.5207 1.34942L23.7518 0.580522Z" fill="#545454"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card">
                                <div class="card__picture">
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image; ?>" alt="">
                                    <?php else: ?>
                                        <img src="<?php echo the_theme_path(); ?>/img/gift-card-min.jpg" alt="">
                                    <?php endif; ?>
                                </div>

                                <div class="card__text card-descr">
                                    <h6 class="card-descr__title">
                                        <?php echo $productTitle; ?>
                                    </h6>

                                    <div class="card-descr-row text--ls-05">
                                        <p><span><?php pll_e('Sender Name'); ?>: </span> <?php echo $sender; ?></p>
                                        <p><span><?php pll_e('Recipient Name'); ?>: </span> <?php echo $recipient; ?>
                                        </p>
                                    </div>
                                    <div class="card-descr-row">
                                        <p><span><?php pll_e('Message'); ?>: </span>
                                        <p><?php echo $message; ?></p>
                                    </div>
                                    <?php if ($currency != $data['currency']): ?>
                                        <div class="card-descr-row">
                                            <p><span><?php pll_e('Amount'); ?>: </span>
                                            <p><?php echo $currencySymbol . ' ' . $amount; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-amount">
                                        <p>
                                              <span class="f-16">
                                                <?php echo $data['currency_symbol']; ?>
                                              </span>
                                            <?php echo $price; ?>
                                        </p>
                                    </div>
                                    <div class="card-number">
                                        <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity'] - 1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="minus" class="card-number__minus <?php if ($cart_item['quantity'] < 2): ?>hide<?php endif; ?>">-</button>
                                        <input type="number" class="card-number__field" readonly placeholder="<?php echo $cart_item['quantity']; ?>" value="<?php echo $cart_item['quantity']; ?>">
                                        <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity'] + 1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="plus" class="card-number__plus">+</button>
                                    </div>
                                </div>
                                <div class="card__actions">
                                    <a href="javascript:void(0);" class="card-cross"
                                       data-delete-item="<?php echo $cart_item_key; ?>">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.8811 12.5L24.714 1.66715C25.0954 1.28575 25.0954 0.667394 24.714 0.286047C24.3326 -0.0953001 23.7142 -0.0953489 23.3329 0.286047L12.5 11.1189L1.66715 0.286047C1.28575 -0.0953489 0.667394 -0.0953489 0.286047 0.286047C-0.0953001 0.667442 -0.0953489 1.2858 0.286047 1.66715L11.1189 12.5L0.286047 23.3329C-0.0953489 23.7143 -0.0953489 24.3326 0.286047 24.714C0.47672 24.9046 0.726671 25 0.976622 25C1.22657 25 1.47647 24.9046 1.6672 24.714L12.5 13.8811L23.3328 24.714C23.5235 24.9046 23.7735 25 24.0234 25C24.2734 25 24.5233 24.9046 24.714 24.714C25.0954 24.3326 25.0954 23.7142 24.714 23.3329L13.8811 12.5Z" fill="#545454"/>
                                        </svg>
                                    </a>
                                    <a href="<?php echo (get_url_lang_prefix()) . 'gift-cards/?cart_item_id=' . $cart_item_key; ?>">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M24.2829 15.2178C23.921 15.2178 23.6276 15.5111 23.6276 15.8731V21.6912C23.6263 22.7762 22.7471 23.6557 21.6619 23.657H3.27625C2.19099 23.6557 1.31178 22.7762 1.3105 21.6912V4.61609C1.31178 3.53083 2.19099 2.65162 3.27625 2.65034H9.09414C9.45607 2.65034 9.74939 2.35702 9.74939 1.99509C9.74939 1.63317 9.45607 1.33984 9.09414 1.33984H3.27625C1.46766 1.34189 0.00204765 2.8075 0 4.61609V21.6912C0.00204765 23.4998 1.46766 24.9654 3.27625 24.9675H21.6619C23.4705 24.9654 24.9361 23.4998 24.9381 21.6912V15.8733C24.9381 15.5114 24.6448 15.2178 24.2829 15.2178Z" fill="#545454"/>
                                            <path d="M10.2461 11.7688L19.8135 2.20117L22.8991 5.28673L13.3317 14.8544L10.2461 11.7688Z" fill="#545454"/>
                                            <path d="M8.68555 16.4157L12.0954 15.4712L9.63003 13.0059L8.68555 16.4157Z" fill="#545454"/>
                                            <path d="M23.7518 0.580522C23.1117 -0.0580905 22.0753 -0.0580905 21.4352 0.580522L20.7402 1.27544L23.8258 4.361L24.5207 3.66608C25.1596 3.02593 25.1596 1.98956 24.5207 1.34942L23.7518 0.580522Z" fill="#545454"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart__aside">
                        <div class="c-form">
                            <h6 class="c-form__title">
                                <?php pll_e('Shipping Address'); ?>
                            </h6>
                            <?php
                            $countries = getCountries(true);
                            ?>
                            <script>var countriesList = <?php echo json_encode($countries); ?>;</script>
                            <div class="gift-card__form">
                                <p><i><?php pll_e('Shipping Address Text'); ?></i></p>
                                <form data-shipping-cart-form="" action="" class="form">
                                    <div class="form-group--05">
                                        <input type="text" name="first_name" id="first-name" placeholder="<?php pll_e('First Name'); ?> *" class="input-animation" required value="<?php echo $shippingFields['first_name']; ?>">
                                        <label for="first-name" class="form__label"><?php pll_e('First Name'); ?> *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="last_name" id="last-name" class="input-animation" placeholder="<?php pll_e('Last Name'); ?> *" required value="<?php echo $shippingFields['last_name']; ?>">
                                        <label for="last-name" class="form__label"><?php pll_e('Last Name'); ?> *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="address" id="address-1" class="input-animation" placeholder="<?php pll_e('Address line 1'); ?> *" required value="<?php echo $shippingFields['address']; ?>">
                                        <label for="address-1" class="form__label"><?php pll_e('Address line 1'); ?> *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="address2" id="address-2" class="input-animation" placeholder="<?php pll_e('Address line 2 (optional)'); ?>" value="<?php echo $shippingFields['address2']; ?>">
                                        <label for="address-2" class="form__label"><?php pll_e('Address line 2 (optional)'); ?></label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="city" id="city" class="input-animation" placeholder="<?php pll_e('City'); ?> *" required value="<?php echo $shippingFields['city']; ?>">
                                        <label for="city" class="form__label"><?php pll_e('City'); ?> *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="state" id="state" class="input-animation" placeholder="<?php pll_e('State'); ?> *" required value="<?php echo $shippingFields['state']; ?>">
                                        <label for="city" class="form__label"><?php pll_e('State'); ?> *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="postal_code" id="postal-code" class="input-animation" placeholder="<?php pll_e('Postal code'); ?> *" required value="<?php echo $shippingFields['postal_code']; ?>">
                                        <label for="postal-code" class="form__label"><?php pll_e('Postal code'); ?> *</label>
                                    </div>
                                    <div class="form-group--select form-group--white form-group--05">
                                        <label class="select-label select-label-js">
                                            <div class="select-label__picture">
                                            </div>
                                            <input class="input input-value-js" type="text" readonly placeholder="<?php pll_e('Country'); ?> *" required value="<?php echo pll__(getCountryByCode($shippingFields['country']));?>"/>
                                            <!-- Value of this input will be sent to back -->
                                            <input class="input input-key-js" name="country" readonly hidden required value="<?php echo $shippingFields['country']; ?>">
                                            
                                        </label>
                                        <?php if ($countries): ?>
                                            <ul class="options options-js">
                                                <?php foreach ($countries as $code => $country): ?>
                                                    <li class="option option-js" data-key="<?php echo $code; ?>">
                                                        <div class="option__text"><?php pll_e($country); ?></div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>

                                    <div class="c-form-country-select form-group--05">
                                        <span class="wpcf7-form-control-wrap phone">
                                            <input type="tel" name="phone-cf7it-national" value="<?php echo $shippingFields['phone']; ?>" class="phone-mask wpcf7-form-control wpcf7-intl-tel wpcf7-intl_tel wpcf7-validates-as-required" aria-required="true" aria-invalid="false" data-initialcountry="us" data-preferredcountries="us-de"/>
                                            <input type="hidden" name="phone" value="<?php echo $shippingFields['phone']; ?>" class="wpcf7-intl-tel-full"/>
                                            <input type="hidden" name="phone-cf7it-country-name" class="wpcf7-intl-tel-country-name"/>
                                            <input type="hidden" name="phone-cf7it-country-code" class="wpcf7-intl-tel-country-code"/>
                                            <input type="hidden" name="phone-cf7it-country-iso2" class="wpcf7-intl-tel-country-iso2"/>
                                        </span>
                                        <!--<input type="number" name="postal-code" id="postal-code" class="phone-mask" placeholder="+xxx-xxx-xxxx" required>-->

                                    </div>
                                    <div class="form-group--05">
                                        <input type="email" name="email" id="email" class="input-animation" placeholder="<?php pll_e('Email address'); ?> *" required value="<?php echo $shippingFields['email']; ?>">
                                        <label for="email" class="form__label"><?php pll_e('Email address'); ?>*</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="message"><?php pll_e('Message (optional)'); ?></label>
                                        <textarea name="message" id="message" cols="10" rows="2"><?php echo $shippingFields['message']; ?></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="c-form">
                            <h6 class="c-form__title">
                                <?php pll_e('Amount Details'); ?>
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
                                <div <?php if ($appliedCoupon): ?> style="display: none;" <?php endif; ?> class="c-form-accordion" apply-coupon-wrapper="">
                                    <span class="jq-accordion c-form-accordion__title"><?php pll_e('I have a gift card'); ?></span>
                                    <div class="c-form-accordion__content">
                                        <div class="f-row">
                                            <input type="text" name='coupon' placeholder="<?php pll_e('Insert here'); ?>">
                                            <button data-apply-coupon="" class="btn btn--accent-border">
                                                <?php pll_e('Apply'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div <?php if (!$appliedCoupon): ?> style="display: none;" <?php endif; ?> class="f-row c-form-coupon" cancel-coupon-wrapper="">
                                    <p>
                                        <?php pll_e('Gift Card'); ?>
                                        <span class="fw-700" data-coupon-val="<?php echo $appliedCoupon; ?>">(<?php echo $appliedCoupon; ?>)</span>
                                        <?php pll_e('was applied'); ?>
                                    </p>
                                    <button data-cancel-coupon="" class="btn btn--accent-border">
                                        <?php pll_e('Cancel'); ?>
                                    </button>
                                </div>
                                <p><i><?php pll_e('Amount Details Text'); ?></i></p>

                                <div class="c-table">
                                    <div class="c-table__row">
                                        <div class="c-table-left">
                                            <?php pll_e('Sub Total'); ?>
                                        </div>
                                        <div class="c-table-right f-22">
                                            <span class="f-16"><?php echo $data['currency_symbol']; ?></span>
                                            <span data-cart-subtotal-amount="">
                                                <?php echo wc_price(WC()->cart->get_subtotal()); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="c-table__row">
                                        <div class="c-table-left">
                                            <div class="c-table-select">
                                                <?php pll_e('Shipping Country'); ?>
                                                <div class="form-group form-group--select form-group--white">
                                                    <label class="select-label select-label-js readonly">
                                                        <div class="select-label__picture">
                                                        </div>
                                                        <input class="input input-value-js" data-amount-shipping-country="" type="text" readonly placeholder="" value="<?php echo pll__(getCountryByCode($shippingFields['country'])); ?>"/>
                                                        <!-- Value of this input will be sent to back -->
                                                        <input class="input input-key-js" name="select" readonly hidden value="<?php echo pll__(getCountryByCode($shippingFields['country'])); ?>">
                                                    </label>
                                                    <ul class="options options-js hide">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-table-right color-accent">
                                            <?php pll_e('Free'); ?>
                                        </div>
                                    </div>

                                    <div class="c-table__row"
                                         <?php if (!WC()->cart->get_discount_total()): ?>style="display: none;" <?php endif; ?>>
                                        <div class="c-table-left fw-700">
                                            <?php pll_e('Gift Card Discount'); ?>
                                        </div>
                                        <div class="c-table-right f-30">
                                            <span class="f-20"><?php echo $data['currency_symbol']; ?></span>
                                            <span data-cart-discount-amount="">
                                                <?php echo wc_price(WC()->cart->get_discount_total()); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="c-table__row">
                                        <div class="c-table-left fw-700">
                                            <?php pll_e('Total Amount'); ?>
                                        </div>
                                        <div class="c-table-right f-30">
                                            <span class="f-20"><?php echo $data['currency_symbol']; ?></span>
                                            <span data-cart-total-amount="">
                                                <?php echo WC()->cart->get_cart_total(); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-form__actions">
                                    <a href="<?php echo (get_url_lang_prefix()) . 'order/'; ?>" class="btn-back">
                                        <svg width="4" height="12" viewBox="0 0 4 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 6L0.25 11.1962L0.25 0.803848L4 6Z" fill="#F9AB97"/>
                                        </svg>
                                        <?php pll_e('Back'); ?>
                                    </a>
                                    <button data-proceed-to-checkout="" class="btn btn--accent"><?php pll_e('Checkout'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End page-->

<?php
get_footer();
