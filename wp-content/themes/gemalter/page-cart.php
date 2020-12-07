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

$postItem = get_page_by_path('order',OBJECT,'page');
$fields = $postItem ? get_fields($postItem->ID) : null;
$postGift = get_page_by_path('gift-cards',OBJECT,'page');
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
    wp_redirect( $location);
    exit;
}
$cartItems = WC()->cart->get_cart();

get_header();
?>
    <!--Start page-->
    <div class="page-wrapper page-cart">
        <div class="cart-wrap">
            <div class="cart">
                <div class="cart-head">
                    <h2><?php pll_e('Cart');?></h2>
                    <div class="cart-head__amount">
                        <p><?php pll_e('Total Amount');?>: <span><?php echo $data['currency_symbol'];?></span></p>
                        <div class="cart-amount h1" data-cart-total-amount="">
                            <?php echo WC()->cart->get_cart_total();?>
                        </div>
                    </div>
                </div>
                <div class="cart-inner">
                    <div class="cards">
                        <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
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
                                    $price = number_format($cart_item['price'], 0);
                                    $basePrice = isset($cart_item['attributes']['base_price']) ? number_format($cart_item['attributes']['base_price']) : 0;
                                    $framePrice = isset($cart_item['attributes']['frame_price']) ? number_format($cart_item['attributes']['frame_price']) : 0;
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
                                    $currencySymbol = $currency == 'eur'? '€' : '$';
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
                                    <?php endif;?>
                                </div>

                                <div class="card__text card-descr">
                                    <h6 class="card-descr__title">
                                        <?php echo $productTitle; ?>
                                    </h6>
                                    <p class="text--ls-05 card-descr__person">
                                        <?php echo $subjectTitle; ?>
                                    </p>
                                    <div class="card-descr-row text--ls-05">
                                        <p><span><?php pll_e('Size');?>: </span> <?php echo $sizeTitle; ?></p>
                                    </div>
                                    <div class="card-descr-row">
                                        <p><span><?php pll_e('Background');?>: </span>
                                            <?php if ($backgroundColor):?><span class="card-bg-color" style="background-color:  <?php echo $backgroundColor;?>"></span><?php endif; ?>
                                            <?php echo $backgroundTitle;?>
                                        </p>
                                    </div>
                                    <div class="card-amount">
                                        <p>
                                          <span class="f-16">
                                            <?php echo $data['currency_symbol'];?>
                                          </span>
                                            <?php echo $price;?>
                                            <?php if ($framePrice): ?>
                                                <span class="f-16 color-gray">
                                                (
                                                <span class="f-12"><?php echo $data['currency_symbol'];?></span>
                                                <?php echo $basePrice;?> +
                                                <span class="f-12"><?php echo $data['currency_symbol'];?></span>
                                                <?php echo $framePrice;?>
                                                )
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                    </div>

                                    <div class="card-number">
                                        <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']-1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="minus" class="card-number__minus <?php if ($cart_item['quantity'] < 2):?>hide<?php endif;?>">-</button>
                                        <input type="number" class="card-number__field" readonly placeholder="<?php echo $cart_item['quantity']; ?>" value="<?php echo $cart_item['quantity']; ?>">
                                        <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']+1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="plus" class="card-number__plus">+</button>
                                    </div>
                                </div>
                                <div class="card__actions">
                                    <a href="javascript:void(0);" class="card-cross" data-delete-item="<?php echo $cart_item_key;?>">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <?php else:?>
                                <div class="card">
                                    <div class="card__picture">
                                        <?php if ($image): ?>
                                            <img src="<?php echo $image; ?>" alt="">
                                        <?php else: ?>
                                            <img src="<?php echo the_theme_path(); ?>/img/gift-card-min.jpg" alt="">
                                        <?php endif;?>
                                    </div>

                                    <div class="card__text card-descr">
                                        <h6 class="card-descr__title">
                                            <?php echo $productTitle; ?>
                                        </h6>

                                        <div class="card-descr-row text--ls-05">
                                            <p><span><?php pll_e('Sender Name');?>: </span> <?php echo $sender;?></p>
                                            <p><span><?php pll_e('Recipient Name');?>: </span> <?php echo $recipient;?></p>
                                        </div>
                                        <div class="card-descr-row">
                                            <p><span><?php pll_e('Message');?>: </span>
                                            <p><?php echo $message;?></p>
                                        </div>
                                        <?php if ($currency != $data['currency']):?>
                                        <div class="card-descr-row">
                                            <p><span><?php pll_e('Amount');?>: </span>
                                            <p><?php echo $currencySymbol . ' ' . $amount;?></p>
                                        </div>
                                        <?php endif;?>
                                        <div class="card-amount">
                                            <p>
                                              <span class="f-16">
                                                <?php echo $data['currency_symbol'];?>
                                              </span>
                                                <?php echo $price;?>
                                            </p>
                                        </div>
                                        <div class="card-number">
                                            <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']-1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="minus" class="card-number__minus <?php if ($cart_item['quantity'] < 2):?>hide<?php endif;?>">-</button>
                                            <input type="number" class="card-number__field" readonly placeholder="<?php echo $cart_item['quantity']; ?>" value="<?php echo $cart_item['quantity']; ?>">
                                            <button data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']+1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>" data-mode="plus" class="card-number__plus">+</button>
                                        </div>
                                    </div>
                                    <div class="card__actions">
                                        <a href="javascript:void(0);" class="card-cross" data-delete-item="<?php echo $cart_item_key;?>">
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
                            <?php endif;?>

                        <?php endforeach; ?>


                    </div>

                    <div class="cart__aside">
                        <div class="c-form">
                            <h6 class="c-form__title">
                                Shipping Address
                            </h6>

                            <div class="gift-card__form">
                                <p><i>Jl zril dolorum ea. Cu iusto oporteat rationibus duo.
                                        In pro debet </i></p>
                                <form action="" class="form">
                                    <div class="form-group--05">
                                        <input type="number" name="first-name" id="first-name" placeholder="First Name *" class="input-animation"
                                               required>
                                        <label for="first-name" class="form__label">First Name *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="last-name" id="last-name" class="input-animation" placeholder="Last Name *" required>
                                        <label for="last-name" class="form__label">Last Name *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="address-1" id="address-1" class="input-animation" placeholder="Address line 1 *"
                                               required>
                                        <label for="address-1" class="form__label">Address line 1 *</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="address-2" id="address-2" class="input-animation"
                                               placeholder="Address line 2 (optional)">
                                        <label for="address-2" class="form__label">Address line 2 (optional)</label>
                                    </div>
                                    <div class="form-group--05">
                                        <input type="text" name="city" id="city" class="input-animation" placeholder="City *" required>
                                        <label for="city" class="form__label">City *</label>
                                    </div>
                                    <div class="form-group--select form-group--white form-group--05">
                                        <label class="select-label select-label-js">
                                            <div class="select-label__picture">
                                            </div>
                                            <input class="input input-value-js" type="text" readonly placeholder="State *" required />

                                            <!-- Value of this input will be sent to back -->
                                            <input class="input input-key-js" name="state" readonly hidden required>
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
                                    <div class="form-group--05">
                                        <input type="text" name="postal-code" id="postal-code" class="input-animation" placeholder="Postal code *"
                                               required>
                                        <label for="postal-code" class="form__label">Postal code *</label>
                                    </div>

                                    <div class="form-group--select form-group--white form-group--05">
                                        <label class="select-label select-label-js">
                                            <div class="select-label__picture">
                                            </div>
                                            <input class="input input-value-js" type="text" readonly placeholder="Country *" required />

                                            <!-- Value of this input will be sent to back -->
                                            <input class="input input-key-js" name="country" readonly hidden required>
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
                                    <div class="c-form-country-select form-group--05">

                                        <div class="form-group form-group--select form-group--white">
                                            <label class="select-label select-label-js">
                                                <div class="select-label__picture">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M24 18.5996V19.4272C23.9987 19.8837 23.629 20.2534 23.1724 20.2547H0.827637C0.370972 20.2534 0.00128174 19.8837 0 19.4272V18.5996H24Z" fill="#E6E7E8"/>
                                                        <path d="M24 4.53076V18.5997H0V4.53076C0.00128174 4.0741 0.370972 3.70441 0.827637 3.70312H23.1724C23.629 3.70441 23.9987 4.07428 24 4.53076Z" fill="#C03A2B"/>
                                                        <path d="M0.827637 3.70312H11.5862V11.9789H0V4.53076C0 4.07373 0.370422 3.70312 0.827637 3.70312Z" fill="#1D5D9E"/>
                                                        <path d="M11.5859 5.35938H23.9998V7.01447H11.5859V5.35938Z" fill="#E6E7E8"/>
                                                        <path d="M11.5859 8.66797H23.9998V10.3232H11.5859V8.66797Z" fill="#E6E7E8"/>
                                                        <path d="M0 11.9785H24V13.6338H0V11.9785Z" fill="#E6E7E8"/>
                                                        <path d="M15.0289 16.9443H24V15.2891H0V16.9443H8.97107" fill="#E6E7E8"/>
                                                        <path d="M0.827759 4.11719L1.01965 4.50574L1.44849 4.56818L1.13812 4.87067L1.21136 5.29767L0.827759 5.09625L0.444153 5.29767L0.517395 4.87067L0.207031 4.56818L0.635681 4.50574L0.827759 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M2.48206 4.11719L2.67413 4.50574L3.10278 4.56818L2.79242 4.87067L2.86566 5.29767L2.48206 5.09625L2.09845 5.29767L2.17169 4.87067L1.86133 4.56818L2.29016 4.50574L2.48206 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M4.13831 4.11719L4.3302 4.50574L4.75885 4.56818L4.44867 4.87067L4.52191 5.29767L4.13831 5.09625L3.7547 5.29767L3.82794 4.87067L3.51758 4.56818L3.94623 4.50574L4.13831 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M5.7926 4.11719L5.98468 4.50574L6.41333 4.56818L6.10297 4.87067L6.17621 5.29767L5.7926 5.09625L5.409 5.29767L5.48224 4.87067L5.17188 4.56818L5.60052 4.50574L5.7926 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M7.44885 4.11719L7.64075 4.50574L8.0694 4.56818L7.75903 4.87067L7.83228 5.29767L7.44885 5.09625L7.06525 5.29767L7.13849 4.87067L6.82812 4.56818L7.25678 4.50574L7.44885 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M9.10315 4.11719L9.29523 4.50574L9.72388 4.56818L9.41351 4.87067L9.48676 5.29767L9.10315 5.09625L8.71954 5.29767L8.79279 4.87067L8.48242 4.56818L8.91107 4.50574L9.10315 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M10.7592 4.11719L10.9513 4.50574L11.3799 4.56818L11.0696 4.87067L11.1428 5.29767L10.7592 5.09625L10.3758 5.29767L10.449 4.87067L10.1387 4.56818L10.5673 4.50574L10.7592 4.11719Z" fill="#ECF0F1"/>
                                                        <path d="M1.75922 5.68359L1.95129 6.07214L2.37994 6.13458L2.06958 6.43707L2.14282 6.86407L1.75922 6.66229L1.37579 6.86407L1.44904 6.43707L1.13867 6.13458L1.56732 6.07214L1.75922 5.68359Z" fill="#ECF0F1"/>
                                                        <path d="M3.4137 5.68359L3.60577 6.07214L4.03442 6.13458L3.72406 6.43707L3.7973 6.86407L3.4137 6.66229L3.03009 6.86407L3.10333 6.43707L2.79297 6.13458L3.22162 6.07214L3.4137 5.68359Z" fill="#ECF0F1"/>
                                                        <path d="M5.06976 5.68359L5.26184 6.07214L5.69049 6.13458L5.38013 6.43707L5.45337 6.86407L5.06976 6.66229L4.68616 6.86407L4.7594 6.43707L4.44922 6.13458L4.87787 6.07214L5.06976 5.68359Z" fill="#ECF0F1"/>
                                                        <path d="M6.72424 5.68359L6.91614 6.07214L7.34497 6.13458L7.03461 6.43707L7.10785 6.86407L6.72424 6.66229L6.34064 6.86407L6.41388 6.43707L6.10352 6.13458L6.53217 6.07214L6.72424 5.68359Z" fill="#ECF0F1"/>
                                                        <path d="M8.37854 5.68359L8.57062 6.07214L8.99927 6.13458L8.6889 6.43707L8.76215 6.86407L8.37854 6.66229L7.99493 6.86407L8.06818 6.43707L7.75781 6.13458L8.18665 6.07214L8.37854 5.68359Z" fill="#ECF0F1"/>
                                                        <path d="M10.0348 5.68359L10.2267 6.07214L10.6553 6.13458L10.3452 6.43707L10.4184 6.86407L10.0348 6.66229L9.65118 6.86407L9.72443 6.43707L9.41406 6.13458L9.84271 6.07214L10.0348 5.68359Z" fill="#ECF0F1"/>
                                                        <path d="M0.827759 7.25L1.01965 7.63892L1.44849 7.70099L1.13812 8.00348L1.21136 8.43085L0.827759 8.22906L0.444153 8.43085L0.517395 8.00348L0.207031 7.70099L0.635681 7.63892L0.827759 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M2.48206 7.25L2.67413 7.63892L3.10278 7.70099L2.79242 8.00348L2.86566 8.43085L2.48206 8.22906L2.09845 8.43085L2.17169 8.00348L1.86133 7.70099L2.29016 7.63892L2.48206 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M4.13831 7.25L4.3302 7.63892L4.75885 7.70099L4.44867 8.00348L4.52191 8.43085L4.13831 8.22906L3.7547 8.43085L3.82794 8.00348L3.51758 7.70099L3.94623 7.63892L4.13831 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M5.7926 7.25L5.98468 7.63892L6.41333 7.70099L6.10297 8.00348L6.17621 8.43085L5.7926 8.22906L5.409 8.43085L5.48224 8.00348L5.17188 7.70099L5.60052 7.63892L5.7926 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M7.44885 7.25L7.64075 7.63892L8.0694 7.70099L7.75903 8.00348L7.83228 8.43085L7.44885 8.22906L7.06525 8.43085L7.13849 8.00348L6.82812 7.70099L7.25678 7.63892L7.44885 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M9.10315 7.25L9.29523 7.63892L9.72388 7.70099L9.41351 8.00348L9.48676 8.43085L9.10315 8.22906L8.71954 8.43085L8.79279 8.00348L8.48242 7.70099L8.91107 7.63892L9.10315 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M10.7592 7.25L10.9513 7.63892L11.3799 7.70099L11.0696 8.00348L11.1428 8.43085L10.7592 8.22906L10.3758 8.43085L10.449 8.00348L10.1387 7.70099L10.5673 7.63892L10.7592 7.25Z" fill="#ECF0F1"/>
                                                        <path d="M0.827759 10.3848L1.01965 10.7733L1.44849 10.8358L1.13812 11.1382L1.21136 11.5652L0.827759 11.3638L0.444153 11.5652L0.517395 11.1382L0.207031 10.8358L0.635681 10.7733L0.827759 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M2.48206 10.3848L2.67413 10.7733L3.10278 10.8358L2.79242 11.1382L2.86566 11.5652L2.48206 11.3638L2.09845 11.5652L2.17169 11.1382L1.86133 10.8358L2.29016 10.7733L2.48206 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M4.13831 10.3848L4.3302 10.7733L4.75885 10.8358L4.44867 11.1382L4.52191 11.5652L4.13831 11.3638L3.7547 11.5652L3.82794 11.1382L3.51758 10.8358L3.94623 10.7733L4.13831 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M5.7926 10.3848L5.98468 10.7733L6.41333 10.8358L6.10297 11.1382L6.17621 11.5652L5.7926 11.3638L5.409 11.5652L5.48224 11.1382L5.17188 10.8358L5.60052 10.7733L5.7926 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M7.44885 10.3848L7.64075 10.7733L8.0694 10.8358L7.75903 11.1382L7.83228 11.5652L7.44885 11.3638L7.06525 11.5652L7.13849 11.1382L6.82812 10.8358L7.25678 10.7733L7.44885 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M9.10315 10.3848L9.29523 10.7733L9.72388 10.8358L9.41351 11.1382L9.48676 11.5652L9.10315 11.3638L8.71954 11.5652L8.79279 11.1382L8.48242 10.8358L8.91107 10.7733L9.10315 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M10.7592 10.3848L10.9513 10.7733L11.3799 10.8358L11.0696 11.1382L11.1428 11.5652L10.7592 11.3638L10.3758 11.5652L10.449 11.1382L10.1387 10.8358L10.5673 10.7733L10.7592 10.3848Z" fill="#ECF0F1"/>
                                                        <path d="M1.75922 8.81836L1.95129 9.20691L2.37994 9.26935L2.06958 9.57184L2.14282 9.99884L1.75922 9.79742L1.37579 9.99884L1.44904 9.57184L1.13867 9.26935L1.56732 9.20691L1.75922 8.81836Z" fill="#ECF0F1"/>
                                                        <path d="M3.4137 8.81836L3.60577 9.20691L4.03442 9.26935L3.72406 9.57184L3.7973 9.99884L3.4137 9.79742L3.03009 9.99884L3.10333 9.57184L2.79297 9.26935L3.22162 9.20691L3.4137 8.81836Z" fill="#ECF0F1"/>
                                                        <path d="M5.06976 8.81836L5.26184 9.20691L5.69049 9.26935L5.38013 9.57184L5.45337 9.99884L5.06976 9.79742L4.68616 9.99884L4.7594 9.57184L4.44922 9.26935L4.87787 9.20691L5.06976 8.81836Z" fill="#ECF0F1"/>
                                                        <path d="M6.72424 8.81836L6.91614 9.20691L7.34497 9.26935L7.03461 9.57184L7.10785 9.99884L6.72424 9.79742L6.34064 9.99884L6.41388 9.57184L6.10352 9.26935L6.53217 9.20691L6.72424 8.81836Z" fill="#ECF0F1"/>
                                                        <path d="M8.37854 8.81836L8.57062 9.20691L8.99927 9.26935L8.6889 9.57184L8.76215 9.99884L8.37854 9.79742L7.99493 9.99884L8.06818 9.57184L7.75781 9.26935L8.18665 9.20691L8.37854 8.81836Z" fill="#ECF0F1"/>
                                                        <path d="M10.0348 8.81836L10.2267 9.20691L10.6553 9.26935L10.3452 9.57184L10.4184 9.99884L10.0348 9.79742L9.65118 9.99884L9.72443 9.57184L9.41406 9.26935L9.84271 9.20691L10.0348 8.81836Z" fill="#ECF0F1"/>
                                                    </svg>
                                                </div>
                                                <input class="input input-value-js" type="text" readonly placeholder="" />

                                                <!-- Value of this input will be sent to back -->
                                                <input class="input input-key-js" name="select" readonly hidden>
                                            </label>

                                            <ul class="options options-js">
                                                <li class="option option-js" data-key="USA">
                                                    <div class="option__picture">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M24 18.5996V19.4272C23.9987 19.8837 23.629 20.2534 23.1724 20.2547H0.827637C0.370972 20.2534 0.00128174 19.8837 0 19.4272V18.5996H24Z" fill="#E6E7E8"/>
                                                            <path d="M24 4.53076V18.5997H0V4.53076C0.00128174 4.0741 0.370972 3.70441 0.827637 3.70312H23.1724C23.629 3.70441 23.9987 4.07428 24 4.53076Z" fill="#C03A2B"/>
                                                            <path d="M0.827637 3.70312H11.5862V11.9789H0V4.53076C0 4.07373 0.370422 3.70312 0.827637 3.70312Z" fill="#1D5D9E"/>
                                                            <path d="M11.5859 5.35938H23.9998V7.01447H11.5859V5.35938Z" fill="#E6E7E8"/>
                                                            <path d="M11.5859 8.66797H23.9998V10.3232H11.5859V8.66797Z" fill="#E6E7E8"/>
                                                            <path d="M0 11.9785H24V13.6338H0V11.9785Z" fill="#E6E7E8"/>
                                                            <path d="M15.0289 16.9443H24V15.2891H0V16.9443H8.97107" fill="#E6E7E8"/>
                                                            <path d="M0.827759 4.11719L1.01965 4.50574L1.44849 4.56818L1.13812 4.87067L1.21136 5.29767L0.827759 5.09625L0.444153 5.29767L0.517395 4.87067L0.207031 4.56818L0.635681 4.50574L0.827759 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M2.48206 4.11719L2.67413 4.50574L3.10278 4.56818L2.79242 4.87067L2.86566 5.29767L2.48206 5.09625L2.09845 5.29767L2.17169 4.87067L1.86133 4.56818L2.29016 4.50574L2.48206 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M4.13831 4.11719L4.3302 4.50574L4.75885 4.56818L4.44867 4.87067L4.52191 5.29767L4.13831 5.09625L3.7547 5.29767L3.82794 4.87067L3.51758 4.56818L3.94623 4.50574L4.13831 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M5.7926 4.11719L5.98468 4.50574L6.41333 4.56818L6.10297 4.87067L6.17621 5.29767L5.7926 5.09625L5.409 5.29767L5.48224 4.87067L5.17188 4.56818L5.60052 4.50574L5.7926 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M7.44885 4.11719L7.64075 4.50574L8.0694 4.56818L7.75903 4.87067L7.83228 5.29767L7.44885 5.09625L7.06525 5.29767L7.13849 4.87067L6.82812 4.56818L7.25678 4.50574L7.44885 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M9.10315 4.11719L9.29523 4.50574L9.72388 4.56818L9.41351 4.87067L9.48676 5.29767L9.10315 5.09625L8.71954 5.29767L8.79279 4.87067L8.48242 4.56818L8.91107 4.50574L9.10315 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M10.7592 4.11719L10.9513 4.50574L11.3799 4.56818L11.0696 4.87067L11.1428 5.29767L10.7592 5.09625L10.3758 5.29767L10.449 4.87067L10.1387 4.56818L10.5673 4.50574L10.7592 4.11719Z" fill="#ECF0F1"/>
                                                            <path d="M1.75922 5.68359L1.95129 6.07214L2.37994 6.13458L2.06958 6.43707L2.14282 6.86407L1.75922 6.66229L1.37579 6.86407L1.44904 6.43707L1.13867 6.13458L1.56732 6.07214L1.75922 5.68359Z" fill="#ECF0F1"/>
                                                            <path d="M3.4137 5.68359L3.60577 6.07214L4.03442 6.13458L3.72406 6.43707L3.7973 6.86407L3.4137 6.66229L3.03009 6.86407L3.10333 6.43707L2.79297 6.13458L3.22162 6.07214L3.4137 5.68359Z" fill="#ECF0F1"/>
                                                            <path d="M5.06976 5.68359L5.26184 6.07214L5.69049 6.13458L5.38013 6.43707L5.45337 6.86407L5.06976 6.66229L4.68616 6.86407L4.7594 6.43707L4.44922 6.13458L4.87787 6.07214L5.06976 5.68359Z" fill="#ECF0F1"/>
                                                            <path d="M6.72424 5.68359L6.91614 6.07214L7.34497 6.13458L7.03461 6.43707L7.10785 6.86407L6.72424 6.66229L6.34064 6.86407L6.41388 6.43707L6.10352 6.13458L6.53217 6.07214L6.72424 5.68359Z" fill="#ECF0F1"/>
                                                            <path d="M8.37854 5.68359L8.57062 6.07214L8.99927 6.13458L8.6889 6.43707L8.76215 6.86407L8.37854 6.66229L7.99493 6.86407L8.06818 6.43707L7.75781 6.13458L8.18665 6.07214L8.37854 5.68359Z" fill="#ECF0F1"/>
                                                            <path d="M10.0348 5.68359L10.2267 6.07214L10.6553 6.13458L10.3452 6.43707L10.4184 6.86407L10.0348 6.66229L9.65118 6.86407L9.72443 6.43707L9.41406 6.13458L9.84271 6.07214L10.0348 5.68359Z" fill="#ECF0F1"/>
                                                            <path d="M0.827759 7.25L1.01965 7.63892L1.44849 7.70099L1.13812 8.00348L1.21136 8.43085L0.827759 8.22906L0.444153 8.43085L0.517395 8.00348L0.207031 7.70099L0.635681 7.63892L0.827759 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M2.48206 7.25L2.67413 7.63892L3.10278 7.70099L2.79242 8.00348L2.86566 8.43085L2.48206 8.22906L2.09845 8.43085L2.17169 8.00348L1.86133 7.70099L2.29016 7.63892L2.48206 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M4.13831 7.25L4.3302 7.63892L4.75885 7.70099L4.44867 8.00348L4.52191 8.43085L4.13831 8.22906L3.7547 8.43085L3.82794 8.00348L3.51758 7.70099L3.94623 7.63892L4.13831 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M5.7926 7.25L5.98468 7.63892L6.41333 7.70099L6.10297 8.00348L6.17621 8.43085L5.7926 8.22906L5.409 8.43085L5.48224 8.00348L5.17188 7.70099L5.60052 7.63892L5.7926 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M7.44885 7.25L7.64075 7.63892L8.0694 7.70099L7.75903 8.00348L7.83228 8.43085L7.44885 8.22906L7.06525 8.43085L7.13849 8.00348L6.82812 7.70099L7.25678 7.63892L7.44885 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M9.10315 7.25L9.29523 7.63892L9.72388 7.70099L9.41351 8.00348L9.48676 8.43085L9.10315 8.22906L8.71954 8.43085L8.79279 8.00348L8.48242 7.70099L8.91107 7.63892L9.10315 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M10.7592 7.25L10.9513 7.63892L11.3799 7.70099L11.0696 8.00348L11.1428 8.43085L10.7592 8.22906L10.3758 8.43085L10.449 8.00348L10.1387 7.70099L10.5673 7.63892L10.7592 7.25Z" fill="#ECF0F1"/>
                                                            <path d="M0.827759 10.3848L1.01965 10.7733L1.44849 10.8358L1.13812 11.1382L1.21136 11.5652L0.827759 11.3638L0.444153 11.5652L0.517395 11.1382L0.207031 10.8358L0.635681 10.7733L0.827759 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M2.48206 10.3848L2.67413 10.7733L3.10278 10.8358L2.79242 11.1382L2.86566 11.5652L2.48206 11.3638L2.09845 11.5652L2.17169 11.1382L1.86133 10.8358L2.29016 10.7733L2.48206 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M4.13831 10.3848L4.3302 10.7733L4.75885 10.8358L4.44867 11.1382L4.52191 11.5652L4.13831 11.3638L3.7547 11.5652L3.82794 11.1382L3.51758 10.8358L3.94623 10.7733L4.13831 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M5.7926 10.3848L5.98468 10.7733L6.41333 10.8358L6.10297 11.1382L6.17621 11.5652L5.7926 11.3638L5.409 11.5652L5.48224 11.1382L5.17188 10.8358L5.60052 10.7733L5.7926 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M7.44885 10.3848L7.64075 10.7733L8.0694 10.8358L7.75903 11.1382L7.83228 11.5652L7.44885 11.3638L7.06525 11.5652L7.13849 11.1382L6.82812 10.8358L7.25678 10.7733L7.44885 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M9.10315 10.3848L9.29523 10.7733L9.72388 10.8358L9.41351 11.1382L9.48676 11.5652L9.10315 11.3638L8.71954 11.5652L8.79279 11.1382L8.48242 10.8358L8.91107 10.7733L9.10315 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M10.7592 10.3848L10.9513 10.7733L11.3799 10.8358L11.0696 11.1382L11.1428 11.5652L10.7592 11.3638L10.3758 11.5652L10.449 11.1382L10.1387 10.8358L10.5673 10.7733L10.7592 10.3848Z" fill="#ECF0F1"/>
                                                            <path d="M1.75922 8.81836L1.95129 9.20691L2.37994 9.26935L2.06958 9.57184L2.14282 9.99884L1.75922 9.79742L1.37579 9.99884L1.44904 9.57184L1.13867 9.26935L1.56732 9.20691L1.75922 8.81836Z" fill="#ECF0F1"/>
                                                            <path d="M3.4137 8.81836L3.60577 9.20691L4.03442 9.26935L3.72406 9.57184L3.7973 9.99884L3.4137 9.79742L3.03009 9.99884L3.10333 9.57184L2.79297 9.26935L3.22162 9.20691L3.4137 8.81836Z" fill="#ECF0F1"/>
                                                            <path d="M5.06976 8.81836L5.26184 9.20691L5.69049 9.26935L5.38013 9.57184L5.45337 9.99884L5.06976 9.79742L4.68616 9.99884L4.7594 9.57184L4.44922 9.26935L4.87787 9.20691L5.06976 8.81836Z" fill="#ECF0F1"/>
                                                            <path d="M6.72424 8.81836L6.91614 9.20691L7.34497 9.26935L7.03461 9.57184L7.10785 9.99884L6.72424 9.79742L6.34064 9.99884L6.41388 9.57184L6.10352 9.26935L6.53217 9.20691L6.72424 8.81836Z" fill="#ECF0F1"/>
                                                            <path d="M8.37854 8.81836L8.57062 9.20691L8.99927 9.26935L8.6889 9.57184L8.76215 9.99884L8.37854 9.79742L7.99493 9.99884L8.06818 9.57184L7.75781 9.26935L8.18665 9.20691L8.37854 8.81836Z" fill="#ECF0F1"/>
                                                            <path d="M10.0348 8.81836L10.2267 9.20691L10.6553 9.26935L10.3452 9.57184L10.4184 9.99884L10.0348 9.79742L9.65118 9.99884L9.72443 9.57184L9.41406 9.26935L9.84271 9.20691L10.0348 8.81836Z" fill="#ECF0F1"/>
                                                        </svg>
                                                    </div>

                                                    <div class="option__text"></div>

                                                </li>
                                                <li class="option option-js" data-key="UA">
                                                    <div class="option__picture">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M24 9.41908V5.032C24 4.60441 23.6533 4.25781 23.2258 4.25781H0.774172L0.359375 5.032V9.41908L1.16113 10.4514H22.8387L24 9.41908Z" fill="#5D5360"/>
                                                            <path d="M0 5.032V9.41906L0.774188 10.1073V4.25781C0.346641 4.25781 0 4.60441 0 5.032Z" fill="#4B3F4E"/>
                                                            <path d="M0.367188 14.5811V18.6325C0.367188 19.0601 0.713829 19.4067 1.14138 19.4067H23.2266L24.0008 18.9682V14.5811L22.8397 13.5488H1.16205L0.367188 14.5811Z" fill="#FFE07D"/>
                                                            <path d="M0.774188 16.6453V13.8926L0 14.5807V18.9678C0 19.3954 0.346641 19.742 0.774188 19.742H23.2258C23.6534 19.742 24 19.3954 24 18.9678H3.0968C1.81406 18.9678 0.774188 17.928 0.774188 16.6453Z" fill="#FFD064"/>
                                                            <path d="M0.40625 13.9225L0.774172 14.5812H24V9.41992H0.774172L0.40625 10.2349V13.9225Z" fill="#E5646E"/>
                                                            <path d="M0 9.41992H0.774188V14.5812H0V9.41992Z" fill="#DB4655"/>
                                                        </svg>
                                                    </div>

                                                    <div class="option__text"></div>

                                                </li>
                                            </ul>
                                        </div>        <input type="number" name="postal-code" id="postal-code" class="phone-mask" placeholder="+xxx-xxx-xxxx" required>
                                    </div>

                                    <div class="form-group--05">
                                        <input type="email" name="postal-code" id="postal-code" class="input-animation" placeholder="Email address *"
                                               required>
                                        <label for="postal-code" class="form__label">Email address *</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Message (optional)</label>
                                        <textarea name="message" id="message" cols="10" rows="2"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>              <div class="c-form">
                            <h6 class="c-form__title">
                                Amount Detailes
                            </h6>

                            <div class="gift-card__form form">
                                <div class="c-form-accordion">
                                    <span class="jq-accordion c-form-accordion__title">I have a coupon</span>
                                    <div class="c-form-accordion__content">
                                        <div class="f-row">
                                            <input type="text" name='coupon' placeholder="Insert here">
                                            <button class="btn btn--accent-border">
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p><i>Jl zril dolorum ea. Cu iusto oporteat rationibus duo.
                                        In pro debet </i></p>

                                <div class="c-table">
                                    <div class="c-table__row">
                                        <div class="c-table-left">
                                            Sub Total
                                        </div>
                                        <div class="c-table-right f-22">
                                            <span class="f-16">$</span>
                                            2,468
                                        </div>
                                    </div>

                                    <div class="c-table__row">
                                        <div class="c-table-left">
                                            <div class="c-table-select">
                                                Shipping Country
                                                <div class="form-group form-group--select form-group--white">
                                                    <label class="select-label select-label-js">
                                                        <div class="select-label__picture">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M24 18.5996V19.4272C23.9987 19.8837 23.629 20.2534 23.1724 20.2547H0.827637C0.370972 20.2534 0.00128174 19.8837 0 19.4272V18.5996H24Z" fill="#E6E7E8"/>
                                                                <path d="M24 4.53076V18.5997H0V4.53076C0.00128174 4.0741 0.370972 3.70441 0.827637 3.70312H23.1724C23.629 3.70441 23.9987 4.07428 24 4.53076Z" fill="#C03A2B"/>
                                                                <path d="M0.827637 3.70312H11.5862V11.9789H0V4.53076C0 4.07373 0.370422 3.70312 0.827637 3.70312Z" fill="#1D5D9E"/>
                                                                <path d="M11.5859 5.35938H23.9998V7.01447H11.5859V5.35938Z" fill="#E6E7E8"/>
                                                                <path d="M11.5859 8.66797H23.9998V10.3232H11.5859V8.66797Z" fill="#E6E7E8"/>
                                                                <path d="M0 11.9785H24V13.6338H0V11.9785Z" fill="#E6E7E8"/>
                                                                <path d="M15.0289 16.9443H24V15.2891H0V16.9443H8.97107" fill="#E6E7E8"/>
                                                                <path d="M0.827759 4.11719L1.01965 4.50574L1.44849 4.56818L1.13812 4.87067L1.21136 5.29767L0.827759 5.09625L0.444153 5.29767L0.517395 4.87067L0.207031 4.56818L0.635681 4.50574L0.827759 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M2.48206 4.11719L2.67413 4.50574L3.10278 4.56818L2.79242 4.87067L2.86566 5.29767L2.48206 5.09625L2.09845 5.29767L2.17169 4.87067L1.86133 4.56818L2.29016 4.50574L2.48206 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M4.13831 4.11719L4.3302 4.50574L4.75885 4.56818L4.44867 4.87067L4.52191 5.29767L4.13831 5.09625L3.7547 5.29767L3.82794 4.87067L3.51758 4.56818L3.94623 4.50574L4.13831 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M5.7926 4.11719L5.98468 4.50574L6.41333 4.56818L6.10297 4.87067L6.17621 5.29767L5.7926 5.09625L5.409 5.29767L5.48224 4.87067L5.17188 4.56818L5.60052 4.50574L5.7926 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M7.44885 4.11719L7.64075 4.50574L8.0694 4.56818L7.75903 4.87067L7.83228 5.29767L7.44885 5.09625L7.06525 5.29767L7.13849 4.87067L6.82812 4.56818L7.25678 4.50574L7.44885 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M9.10315 4.11719L9.29523 4.50574L9.72388 4.56818L9.41351 4.87067L9.48676 5.29767L9.10315 5.09625L8.71954 5.29767L8.79279 4.87067L8.48242 4.56818L8.91107 4.50574L9.10315 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M10.7592 4.11719L10.9513 4.50574L11.3799 4.56818L11.0696 4.87067L11.1428 5.29767L10.7592 5.09625L10.3758 5.29767L10.449 4.87067L10.1387 4.56818L10.5673 4.50574L10.7592 4.11719Z" fill="#ECF0F1"/>
                                                                <path d="M1.75922 5.68359L1.95129 6.07214L2.37994 6.13458L2.06958 6.43707L2.14282 6.86407L1.75922 6.66229L1.37579 6.86407L1.44904 6.43707L1.13867 6.13458L1.56732 6.07214L1.75922 5.68359Z" fill="#ECF0F1"/>
                                                                <path d="M3.4137 5.68359L3.60577 6.07214L4.03442 6.13458L3.72406 6.43707L3.7973 6.86407L3.4137 6.66229L3.03009 6.86407L3.10333 6.43707L2.79297 6.13458L3.22162 6.07214L3.4137 5.68359Z" fill="#ECF0F1"/>
                                                                <path d="M5.06976 5.68359L5.26184 6.07214L5.69049 6.13458L5.38013 6.43707L5.45337 6.86407L5.06976 6.66229L4.68616 6.86407L4.7594 6.43707L4.44922 6.13458L4.87787 6.07214L5.06976 5.68359Z" fill="#ECF0F1"/>
                                                                <path d="M6.72424 5.68359L6.91614 6.07214L7.34497 6.13458L7.03461 6.43707L7.10785 6.86407L6.72424 6.66229L6.34064 6.86407L6.41388 6.43707L6.10352 6.13458L6.53217 6.07214L6.72424 5.68359Z" fill="#ECF0F1"/>
                                                                <path d="M8.37854 5.68359L8.57062 6.07214L8.99927 6.13458L8.6889 6.43707L8.76215 6.86407L8.37854 6.66229L7.99493 6.86407L8.06818 6.43707L7.75781 6.13458L8.18665 6.07214L8.37854 5.68359Z" fill="#ECF0F1"/>
                                                                <path d="M10.0348 5.68359L10.2267 6.07214L10.6553 6.13458L10.3452 6.43707L10.4184 6.86407L10.0348 6.66229L9.65118 6.86407L9.72443 6.43707L9.41406 6.13458L9.84271 6.07214L10.0348 5.68359Z" fill="#ECF0F1"/>
                                                                <path d="M0.827759 7.25L1.01965 7.63892L1.44849 7.70099L1.13812 8.00348L1.21136 8.43085L0.827759 8.22906L0.444153 8.43085L0.517395 8.00348L0.207031 7.70099L0.635681 7.63892L0.827759 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M2.48206 7.25L2.67413 7.63892L3.10278 7.70099L2.79242 8.00348L2.86566 8.43085L2.48206 8.22906L2.09845 8.43085L2.17169 8.00348L1.86133 7.70099L2.29016 7.63892L2.48206 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M4.13831 7.25L4.3302 7.63892L4.75885 7.70099L4.44867 8.00348L4.52191 8.43085L4.13831 8.22906L3.7547 8.43085L3.82794 8.00348L3.51758 7.70099L3.94623 7.63892L4.13831 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M5.7926 7.25L5.98468 7.63892L6.41333 7.70099L6.10297 8.00348L6.17621 8.43085L5.7926 8.22906L5.409 8.43085L5.48224 8.00348L5.17188 7.70099L5.60052 7.63892L5.7926 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M7.44885 7.25L7.64075 7.63892L8.0694 7.70099L7.75903 8.00348L7.83228 8.43085L7.44885 8.22906L7.06525 8.43085L7.13849 8.00348L6.82812 7.70099L7.25678 7.63892L7.44885 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M9.10315 7.25L9.29523 7.63892L9.72388 7.70099L9.41351 8.00348L9.48676 8.43085L9.10315 8.22906L8.71954 8.43085L8.79279 8.00348L8.48242 7.70099L8.91107 7.63892L9.10315 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M10.7592 7.25L10.9513 7.63892L11.3799 7.70099L11.0696 8.00348L11.1428 8.43085L10.7592 8.22906L10.3758 8.43085L10.449 8.00348L10.1387 7.70099L10.5673 7.63892L10.7592 7.25Z" fill="#ECF0F1"/>
                                                                <path d="M0.827759 10.3848L1.01965 10.7733L1.44849 10.8358L1.13812 11.1382L1.21136 11.5652L0.827759 11.3638L0.444153 11.5652L0.517395 11.1382L0.207031 10.8358L0.635681 10.7733L0.827759 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M2.48206 10.3848L2.67413 10.7733L3.10278 10.8358L2.79242 11.1382L2.86566 11.5652L2.48206 11.3638L2.09845 11.5652L2.17169 11.1382L1.86133 10.8358L2.29016 10.7733L2.48206 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M4.13831 10.3848L4.3302 10.7733L4.75885 10.8358L4.44867 11.1382L4.52191 11.5652L4.13831 11.3638L3.7547 11.5652L3.82794 11.1382L3.51758 10.8358L3.94623 10.7733L4.13831 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M5.7926 10.3848L5.98468 10.7733L6.41333 10.8358L6.10297 11.1382L6.17621 11.5652L5.7926 11.3638L5.409 11.5652L5.48224 11.1382L5.17188 10.8358L5.60052 10.7733L5.7926 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M7.44885 10.3848L7.64075 10.7733L8.0694 10.8358L7.75903 11.1382L7.83228 11.5652L7.44885 11.3638L7.06525 11.5652L7.13849 11.1382L6.82812 10.8358L7.25678 10.7733L7.44885 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M9.10315 10.3848L9.29523 10.7733L9.72388 10.8358L9.41351 11.1382L9.48676 11.5652L9.10315 11.3638L8.71954 11.5652L8.79279 11.1382L8.48242 10.8358L8.91107 10.7733L9.10315 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M10.7592 10.3848L10.9513 10.7733L11.3799 10.8358L11.0696 11.1382L11.1428 11.5652L10.7592 11.3638L10.3758 11.5652L10.449 11.1382L10.1387 10.8358L10.5673 10.7733L10.7592 10.3848Z" fill="#ECF0F1"/>
                                                                <path d="M1.75922 8.81836L1.95129 9.20691L2.37994 9.26935L2.06958 9.57184L2.14282 9.99884L1.75922 9.79742L1.37579 9.99884L1.44904 9.57184L1.13867 9.26935L1.56732 9.20691L1.75922 8.81836Z" fill="#ECF0F1"/>
                                                                <path d="M3.4137 8.81836L3.60577 9.20691L4.03442 9.26935L3.72406 9.57184L3.7973 9.99884L3.4137 9.79742L3.03009 9.99884L3.10333 9.57184L2.79297 9.26935L3.22162 9.20691L3.4137 8.81836Z" fill="#ECF0F1"/>
                                                                <path d="M5.06976 8.81836L5.26184 9.20691L5.69049 9.26935L5.38013 9.57184L5.45337 9.99884L5.06976 9.79742L4.68616 9.99884L4.7594 9.57184L4.44922 9.26935L4.87787 9.20691L5.06976 8.81836Z" fill="#ECF0F1"/>
                                                                <path d="M6.72424 8.81836L6.91614 9.20691L7.34497 9.26935L7.03461 9.57184L7.10785 9.99884L6.72424 9.79742L6.34064 9.99884L6.41388 9.57184L6.10352 9.26935L6.53217 9.20691L6.72424 8.81836Z" fill="#ECF0F1"/>
                                                                <path d="M8.37854 8.81836L8.57062 9.20691L8.99927 9.26935L8.6889 9.57184L8.76215 9.99884L8.37854 9.79742L7.99493 9.99884L8.06818 9.57184L7.75781 9.26935L8.18665 9.20691L8.37854 8.81836Z" fill="#ECF0F1"/>
                                                                <path d="M10.0348 8.81836L10.2267 9.20691L10.6553 9.26935L10.3452 9.57184L10.4184 9.99884L10.0348 9.79742L9.65118 9.99884L9.72443 9.57184L9.41406 9.26935L9.84271 9.20691L10.0348 8.81836Z" fill="#ECF0F1"/>
                                                            </svg>
                                                        </div>
                                                        <input class="input input-value-js" type="text" readonly placeholder="USA" />

                                                        <!-- Value of this input will be sent to back -->
                                                        <input class="input input-key-js" name="select" readonly hidden>
                                                    </label>

                                                    <ul class="options options-js">
                                                        <li class="option option-js" data-key="USA">
                                                            <div class="option__picture">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M24 18.5996V19.4272C23.9987 19.8837 23.629 20.2534 23.1724 20.2547H0.827637C0.370972 20.2534 0.00128174 19.8837 0 19.4272V18.5996H24Z" fill="#E6E7E8"/>
                                                                    <path d="M24 4.53076V18.5997H0V4.53076C0.00128174 4.0741 0.370972 3.70441 0.827637 3.70312H23.1724C23.629 3.70441 23.9987 4.07428 24 4.53076Z" fill="#C03A2B"/>
                                                                    <path d="M0.827637 3.70312H11.5862V11.9789H0V4.53076C0 4.07373 0.370422 3.70312 0.827637 3.70312Z" fill="#1D5D9E"/>
                                                                    <path d="M11.5859 5.35938H23.9998V7.01447H11.5859V5.35938Z" fill="#E6E7E8"/>
                                                                    <path d="M11.5859 8.66797H23.9998V10.3232H11.5859V8.66797Z" fill="#E6E7E8"/>
                                                                    <path d="M0 11.9785H24V13.6338H0V11.9785Z" fill="#E6E7E8"/>
                                                                    <path d="M15.0289 16.9443H24V15.2891H0V16.9443H8.97107" fill="#E6E7E8"/>
                                                                    <path d="M0.827759 4.11719L1.01965 4.50574L1.44849 4.56818L1.13812 4.87067L1.21136 5.29767L0.827759 5.09625L0.444153 5.29767L0.517395 4.87067L0.207031 4.56818L0.635681 4.50574L0.827759 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M2.48206 4.11719L2.67413 4.50574L3.10278 4.56818L2.79242 4.87067L2.86566 5.29767L2.48206 5.09625L2.09845 5.29767L2.17169 4.87067L1.86133 4.56818L2.29016 4.50574L2.48206 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M4.13831 4.11719L4.3302 4.50574L4.75885 4.56818L4.44867 4.87067L4.52191 5.29767L4.13831 5.09625L3.7547 5.29767L3.82794 4.87067L3.51758 4.56818L3.94623 4.50574L4.13831 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M5.7926 4.11719L5.98468 4.50574L6.41333 4.56818L6.10297 4.87067L6.17621 5.29767L5.7926 5.09625L5.409 5.29767L5.48224 4.87067L5.17188 4.56818L5.60052 4.50574L5.7926 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M7.44885 4.11719L7.64075 4.50574L8.0694 4.56818L7.75903 4.87067L7.83228 5.29767L7.44885 5.09625L7.06525 5.29767L7.13849 4.87067L6.82812 4.56818L7.25678 4.50574L7.44885 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M9.10315 4.11719L9.29523 4.50574L9.72388 4.56818L9.41351 4.87067L9.48676 5.29767L9.10315 5.09625L8.71954 5.29767L8.79279 4.87067L8.48242 4.56818L8.91107 4.50574L9.10315 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M10.7592 4.11719L10.9513 4.50574L11.3799 4.56818L11.0696 4.87067L11.1428 5.29767L10.7592 5.09625L10.3758 5.29767L10.449 4.87067L10.1387 4.56818L10.5673 4.50574L10.7592 4.11719Z" fill="#ECF0F1"/>
                                                                    <path d="M1.75922 5.68359L1.95129 6.07214L2.37994 6.13458L2.06958 6.43707L2.14282 6.86407L1.75922 6.66229L1.37579 6.86407L1.44904 6.43707L1.13867 6.13458L1.56732 6.07214L1.75922 5.68359Z" fill="#ECF0F1"/>
                                                                    <path d="M3.4137 5.68359L3.60577 6.07214L4.03442 6.13458L3.72406 6.43707L3.7973 6.86407L3.4137 6.66229L3.03009 6.86407L3.10333 6.43707L2.79297 6.13458L3.22162 6.07214L3.4137 5.68359Z" fill="#ECF0F1"/>
                                                                    <path d="M5.06976 5.68359L5.26184 6.07214L5.69049 6.13458L5.38013 6.43707L5.45337 6.86407L5.06976 6.66229L4.68616 6.86407L4.7594 6.43707L4.44922 6.13458L4.87787 6.07214L5.06976 5.68359Z" fill="#ECF0F1"/>
                                                                    <path d="M6.72424 5.68359L6.91614 6.07214L7.34497 6.13458L7.03461 6.43707L7.10785 6.86407L6.72424 6.66229L6.34064 6.86407L6.41388 6.43707L6.10352 6.13458L6.53217 6.07214L6.72424 5.68359Z" fill="#ECF0F1"/>
                                                                    <path d="M8.37854 5.68359L8.57062 6.07214L8.99927 6.13458L8.6889 6.43707L8.76215 6.86407L8.37854 6.66229L7.99493 6.86407L8.06818 6.43707L7.75781 6.13458L8.18665 6.07214L8.37854 5.68359Z" fill="#ECF0F1"/>
                                                                    <path d="M10.0348 5.68359L10.2267 6.07214L10.6553 6.13458L10.3452 6.43707L10.4184 6.86407L10.0348 6.66229L9.65118 6.86407L9.72443 6.43707L9.41406 6.13458L9.84271 6.07214L10.0348 5.68359Z" fill="#ECF0F1"/>
                                                                    <path d="M0.827759 7.25L1.01965 7.63892L1.44849 7.70099L1.13812 8.00348L1.21136 8.43085L0.827759 8.22906L0.444153 8.43085L0.517395 8.00348L0.207031 7.70099L0.635681 7.63892L0.827759 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M2.48206 7.25L2.67413 7.63892L3.10278 7.70099L2.79242 8.00348L2.86566 8.43085L2.48206 8.22906L2.09845 8.43085L2.17169 8.00348L1.86133 7.70099L2.29016 7.63892L2.48206 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M4.13831 7.25L4.3302 7.63892L4.75885 7.70099L4.44867 8.00348L4.52191 8.43085L4.13831 8.22906L3.7547 8.43085L3.82794 8.00348L3.51758 7.70099L3.94623 7.63892L4.13831 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M5.7926 7.25L5.98468 7.63892L6.41333 7.70099L6.10297 8.00348L6.17621 8.43085L5.7926 8.22906L5.409 8.43085L5.48224 8.00348L5.17188 7.70099L5.60052 7.63892L5.7926 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M7.44885 7.25L7.64075 7.63892L8.0694 7.70099L7.75903 8.00348L7.83228 8.43085L7.44885 8.22906L7.06525 8.43085L7.13849 8.00348L6.82812 7.70099L7.25678 7.63892L7.44885 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M9.10315 7.25L9.29523 7.63892L9.72388 7.70099L9.41351 8.00348L9.48676 8.43085L9.10315 8.22906L8.71954 8.43085L8.79279 8.00348L8.48242 7.70099L8.91107 7.63892L9.10315 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M10.7592 7.25L10.9513 7.63892L11.3799 7.70099L11.0696 8.00348L11.1428 8.43085L10.7592 8.22906L10.3758 8.43085L10.449 8.00348L10.1387 7.70099L10.5673 7.63892L10.7592 7.25Z" fill="#ECF0F1"/>
                                                                    <path d="M0.827759 10.3848L1.01965 10.7733L1.44849 10.8358L1.13812 11.1382L1.21136 11.5652L0.827759 11.3638L0.444153 11.5652L0.517395 11.1382L0.207031 10.8358L0.635681 10.7733L0.827759 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M2.48206 10.3848L2.67413 10.7733L3.10278 10.8358L2.79242 11.1382L2.86566 11.5652L2.48206 11.3638L2.09845 11.5652L2.17169 11.1382L1.86133 10.8358L2.29016 10.7733L2.48206 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M4.13831 10.3848L4.3302 10.7733L4.75885 10.8358L4.44867 11.1382L4.52191 11.5652L4.13831 11.3638L3.7547 11.5652L3.82794 11.1382L3.51758 10.8358L3.94623 10.7733L4.13831 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M5.7926 10.3848L5.98468 10.7733L6.41333 10.8358L6.10297 11.1382L6.17621 11.5652L5.7926 11.3638L5.409 11.5652L5.48224 11.1382L5.17188 10.8358L5.60052 10.7733L5.7926 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M7.44885 10.3848L7.64075 10.7733L8.0694 10.8358L7.75903 11.1382L7.83228 11.5652L7.44885 11.3638L7.06525 11.5652L7.13849 11.1382L6.82812 10.8358L7.25678 10.7733L7.44885 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M9.10315 10.3848L9.29523 10.7733L9.72388 10.8358L9.41351 11.1382L9.48676 11.5652L9.10315 11.3638L8.71954 11.5652L8.79279 11.1382L8.48242 10.8358L8.91107 10.7733L9.10315 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M10.7592 10.3848L10.9513 10.7733L11.3799 10.8358L11.0696 11.1382L11.1428 11.5652L10.7592 11.3638L10.3758 11.5652L10.449 11.1382L10.1387 10.8358L10.5673 10.7733L10.7592 10.3848Z" fill="#ECF0F1"/>
                                                                    <path d="M1.75922 8.81836L1.95129 9.20691L2.37994 9.26935L2.06958 9.57184L2.14282 9.99884L1.75922 9.79742L1.37579 9.99884L1.44904 9.57184L1.13867 9.26935L1.56732 9.20691L1.75922 8.81836Z" fill="#ECF0F1"/>
                                                                    <path d="M3.4137 8.81836L3.60577 9.20691L4.03442 9.26935L3.72406 9.57184L3.7973 9.99884L3.4137 9.79742L3.03009 9.99884L3.10333 9.57184L2.79297 9.26935L3.22162 9.20691L3.4137 8.81836Z" fill="#ECF0F1"/>
                                                                    <path d="M5.06976 8.81836L5.26184 9.20691L5.69049 9.26935L5.38013 9.57184L5.45337 9.99884L5.06976 9.79742L4.68616 9.99884L4.7594 9.57184L4.44922 9.26935L4.87787 9.20691L5.06976 8.81836Z" fill="#ECF0F1"/>
                                                                    <path d="M6.72424 8.81836L6.91614 9.20691L7.34497 9.26935L7.03461 9.57184L7.10785 9.99884L6.72424 9.79742L6.34064 9.99884L6.41388 9.57184L6.10352 9.26935L6.53217 9.20691L6.72424 8.81836Z" fill="#ECF0F1"/>
                                                                    <path d="M8.37854 8.81836L8.57062 9.20691L8.99927 9.26935L8.6889 9.57184L8.76215 9.99884L8.37854 9.79742L7.99493 9.99884L8.06818 9.57184L7.75781 9.26935L8.18665 9.20691L8.37854 8.81836Z" fill="#ECF0F1"/>
                                                                    <path d="M10.0348 8.81836L10.2267 9.20691L10.6553 9.26935L10.3452 9.57184L10.4184 9.99884L10.0348 9.79742L9.65118 9.99884L9.72443 9.57184L9.41406 9.26935L9.84271 9.20691L10.0348 8.81836Z" fill="#ECF0F1"/>
                                                                </svg>
                                                            </div>

                                                            <div class="option__text">USA</div>

                                                        </li>
                                                        <li class="option option-js" data-key="UA">
                                                            <div class="option__picture">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M24 9.41908V5.032C24 4.60441 23.6533 4.25781 23.2258 4.25781H0.774172L0.359375 5.032V9.41908L1.16113 10.4514H22.8387L24 9.41908Z" fill="#5D5360"/>
                                                                    <path d="M0 5.032V9.41906L0.774188 10.1073V4.25781C0.346641 4.25781 0 4.60441 0 5.032Z" fill="#4B3F4E"/>
                                                                    <path d="M0.367188 14.5811V18.6325C0.367188 19.0601 0.713829 19.4067 1.14138 19.4067H23.2266L24.0008 18.9682V14.5811L22.8397 13.5488H1.16205L0.367188 14.5811Z" fill="#FFE07D"/>
                                                                    <path d="M0.774188 16.6453V13.8926L0 14.5807V18.9678C0 19.3954 0.346641 19.742 0.774188 19.742H23.2258C23.6534 19.742 24 19.3954 24 18.9678H3.0968C1.81406 18.9678 0.774188 17.928 0.774188 16.6453Z" fill="#FFD064"/>
                                                                    <path d="M0.40625 13.9225L0.774172 14.5812H24V9.41992H0.774172L0.40625 10.2349V13.9225Z" fill="#E5646E"/>
                                                                    <path d="M0 9.41992H0.774188V14.5812H0V9.41992Z" fill="#DB4655"/>
                                                                </svg>
                                                            </div>

                                                            <div class="option__text">DE</div>

                                                        </li>
                                                    </ul>
                                                </div>          </div>
                                        </div>
                                        <div class="c-table-right color-accent">
                                            Free
                                        </div>
                                    </div>

                                    <div class="c-table__row">
                                        <div class="c-table-left fw-700">
                                            Total Amount
                                        </div>
                                        <div class="c-table-right f-30">
                                            <span class="f-20">$</span>
                                            2,468
                                        </div>
                                    </div>

                                    <div class="c-table__row">
                                        <div class="c-table-left fw-700">
                                            Sub Total
                                        </div>
                                        <div class="c-table-right f-30">
                                            <span class="f-20">$</span>
                                            247
                                        </div>
                                    </div>
                                </div>
                                <div class="c-form__actions">
                                    <a href="#" class="btn-back"><svg width="4" height="12" viewBox="0 0 4 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 6L0.25 11.1962L0.25 0.803848L4 6Z" fill="#F9AB97"/>
                                        </svg>
                                        Back</a>
                                    <button class="btn btn--accent">Checkout</button>
                                </div>
                            </div>
                        </div>            </div>
                </div>
            </div>
        </div>
    </div>
    <!--End page-->



    <!--Start page-->
    <?php /*<div class="page-wrapper">
        <?php get_template_part( 'template-parts/bread'); ?>
        <div class="container-small mx-w-1050">
            <div class="title-wrap m-b-90">
                <h2 class="">
                    <?php echo $post->post_title; ?>
                </h2>
            </div>
        </div>
        <div class="text">
            <div class="text-block section--gray p-150 ">
                <div class="container mx-w-1050">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>*/?>
    <!--End page-->
<?php
get_footer();
