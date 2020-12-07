<?php

/**
 * Template Name: Gift Card Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);

$cartItemID = isset($_REQUEST['cart_item_id']) ? trim($_REQUEST['cart_item_id']) : '';
$cartRecord = getCardItemRecord($cartItemID);
if ($cartRecord) {
    if (isset($cartRecord['attributes']['gift_amount']) && $cartRecord['attributes']['gift_amount']){
        $cartRecord['attributes']['product_type'] = 'gift-card';
    }
    if (isset($cartRecord['attributes']['product_type']) && $cartRecord['attributes']['product_type'] != 'gift-card') {
        $cartRecord = null;
    }
    if (isset($cartRecord['attributes']['locale']) && $cartRecord['attributes']['locale'] != $current_lang) {
        $cartRecord = null;
    }
} elseif ($cartItemID) {
    $location = (get_url_lang_prefix()) . 'gift-cards/';
    wp_redirect( $location);
    exit;
}
$cartRecord['fields']['gift_amount'] = $cartRecord && isset($cartRecord['attributes']['gift_amount']) ? $cartRecord['attributes']['gift_amount'] : '';
$cartRecord['fields']['gift_currency'] = $cartRecord && isset($cartRecord['attributes']['gift_currency']) ? $cartRecord['attributes']['gift_currency'] : '';
$cartRecord['fields']['gift_sender_name'] = $cartRecord && isset($cartRecord['attributes']['gift_sender_name']) ? $cartRecord['attributes']['gift_sender_name'] : '';
$cartRecord['fields']['gift_recipient_name'] = $cartRecord && isset($cartRecord['attributes']['gift_recipient_name']) ? $cartRecord['attributes']['gift_recipient_name'] : '';
$cartRecord['fields']['gift_message'] = $cartRecord && isset($cartRecord['attributes']['gift_message']) ? $cartRecord['attributes']['gift_message'] : '';
$cartRecord['fields']['key'] = $cartItemID;

get_header();
?>

    <!--Start page-->
    <div class="page-wrapper page-blog">
        <?php get_template_part( 'template-parts/bread'); ?>
        <div class="container-small mx-w-1050">
            <div class="title-wrap m-b-90">
                <?php if ($post->post_title): ?>
                    <h2 class="page-blog__title">
                        <svg width="63" height="45" viewBox="0 0 63 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M57.4629 0H5.53711C2.48395 0 0 2.48395 0 5.53711V38.7598C0 41.8129 2.48395 44.2969 5.53711 44.2969H57.4629C60.5161 44.2969 63 41.8129 63 38.7598V5.53711C63 2.48395 60.5161 0 57.4629 0ZM18.457 40.6055H5.53711C4.51939 40.6055 3.69141 39.7775 3.69141 38.7598V18.457H7.68489C8.60578 21.2066 11.429 22.8628 14.2905 22.3022L11.3842 26.6618C10.8188 27.51 11.048 28.6559 11.8962 29.2213C12.7442 29.7866 13.8903 29.5575 14.4557 28.7093L18.457 22.7073V40.6055ZM11.0742 16.6087C11.0742 14.9284 12.9431 13.9229 14.3454 14.858L16.9753 16.6113L14.3454 18.3646C12.9479 19.2963 11.0742 18.3017 11.0742 16.6087ZM18.457 13.1626L16.393 11.7865C13.2065 9.66213 8.89174 11.1632 7.68551 14.7655H3.69141V5.53699C3.69141 4.51939 4.51939 3.69141 5.53711 3.69141H18.457V13.1626ZM59.3086 38.7599C59.3086 39.7775 58.4806 40.6055 57.4629 40.6055H22.1484V22.7073L26.1498 28.7094C26.7159 29.5586 27.8622 29.7862 28.7093 29.2214C29.5575 28.6559 29.7867 27.51 29.2213 26.6619L26.3149 22.3024C29.1635 22.8603 31.9949 21.2198 32.92 18.4572H59.3086V38.7599ZM23.6302 16.6113L26.26 14.858C27.6577 13.9262 29.5312 14.9209 29.5312 16.6138C29.5312 18.2969 27.6598 19.2979 26.26 18.3645L23.6302 16.6113ZM59.3086 14.7656H32.9206C31.7141 11.1637 27.3993 9.66201 24.2124 11.7867L22.1484 13.1626V3.69141H57.4629C58.4806 3.69141 59.3086 4.51939 59.3086 5.53711V14.7656Z" fill="#F9AB97"/>
                            <path d="M53.7715 25.8398H38.7598C37.7404 25.8398 36.9141 26.6662 36.9141 27.6855C36.9141 28.7049 37.7404 29.5312 38.7598 29.5312H53.7715C54.7908 29.5312 55.6172 28.7049 55.6172 27.6855C55.6172 26.6662 54.7908 25.8398 53.7715 25.8398Z" fill="#F9AB97"/>
                            <path d="M53.7715 33.2227H38.7598C37.7404 33.2227 36.9141 34.049 36.9141 35.0684C36.9141 36.0877 37.7404 36.9141 38.7598 36.9141H53.7715C54.7908 36.9141 55.6172 36.0877 55.6172 35.0684C55.6172 34.049 54.7908 33.2227 53.7715 33.2227Z" fill="#F9AB97"/>
                        </svg>
                        <?php echo $post->post_title; ?>
                    </h2>
                <?php endif; ?>
            </div>
            <div class="text text--center text--lite-color m-b-80 text--span-f-w-600">
                <?php if ($post->post_content): ?>
                    <?php echo wpautop($post->post_content); ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Start img-text-mod section -->
        <section class="section img-text-mod img-text-mod--right-gray p-0 m-t-120" >
            <div class="container-small">
                <div class="img-text-mod-inner">
                    <div class="img-text-mod__left">
                        <?php if (isset($fields['form_vertical_text'])): ?>
                            <div class="img-text-mod-label">
                                <p class="vertical-label"> <?php echo $fields['form_vertical_text']; ?> </p>
                            </div>
                        <?php endif; ?>
                        <?php
                        if (is_array($fields['form_image'])) {
                            $image = $fields['form_image']['url'];
                        } else {
                            $image = wp_get_attachment_image_src($fields['form_image'], 'full');
                            if (isset($image[0]) && $image[0]) {
                                $image = $image[0];
                            } else {
                                $image = null;
                            }
                        }
                        $giftSettings = giftCardSettings();
                        $cartRecord['fields']['gift_currency_value'] = $cartRecord['fields']['gift_currency'] ? $giftSettings['fields']['currency']['options'][$cartRecord['fields']['gift_currency']] : '';
                        $cartRecord['fields']['gift_amount_value'] = $cartRecord['fields']['gift_amount'] ? $giftSettings['fields']['amount']['options'][$cartRecord['fields']['gift_amount']] : '';
                        ?>
                        <div class="img-text-mod__picture img-text-mod-transform">
                            <?php if ($image): ?>
                                <img src="<?php echo $image; ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="img-text-mod__right">
                        <div class="gift-card__form">
                            <?php if (isset($fields['form_text'])): ?>
                                <p><i><?php echo $fields['form_text']; ?></i></p>
                            <?php endif; ?>
                            <div class="form-errors-wrapper">
                                <div class="error-text error-required-field"><?php pll_e("Fill in the required fields of the form.");?></div>
                                <div class="error-text error-some-error"><?php pll_e("An error has occurred, please try again or contact us.");?></div>
                            </div>
                            <form data-gift-form="" action="" class="form">
                                <?php if ($cartRecord['fields']['key']): ?>
                                    <input type="hidden" name="cart_item_key" value="<?php echo $cartRecord['fields']['key']; ?>">
                                <?php endif; ?>
                                <?php if (isset($giftSettings['fields']['amount'])): ?>
                                    <div class="form-group--select form-group--white form-group--05">
                                        <label class="select-label select-label-js">
                                            <div class="select-label__picture">
                                            </div>
                                            <input class="input input-value-js" type="text" readonly placeholder="<?php echo $giftSettings['fields']['amount']['label']; ?>*" value="<?php if ($cartRecord['fields']['gift_amount_value']):?><?php echo $cartRecord['fields']['gift_amount_value']; ?><?php else:?><?php endif;?>" required />
                                            <!-- Value of this input will be sent to back -->
                                            <input class="input input-key-js" name="<?php echo $giftSettings['fields']['amount']['name']; ?>" value="<?php if ($cartRecord['fields']['gift_amount']):?><?php echo $cartRecord['fields']['gift_amount']; ?><?php else:?><?php endif;?>" readonly hidden required>
                                        </label>
                                        <?php if (!empty($giftSettings['fields']['amount']['options'])): ?>
                                            <ul class="options options-js">
                                                <?php foreach ($giftSettings['fields']['amount']['options'] as $key => $item): ?>
                                                    <li class="option option-js" data-key="<?php echo $key; ?>">
                                                        <div class="option__text"><?php echo $item; ?></div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($giftSettings['fields']['currency'])): ?>
                                    <div class="new-droptcart">
                                        <div class="form-group--select form-group--white ">
                                            <label class="select-label select-label-js">
                                                <div class="select-label__picture">
                                                </div>
                                                <input class="input input-value-js" type="text" readonly placeholder="<?php echo $giftSettings['fields']['currency']['label']; ?> *" value="<?php if ($cartRecord['fields']['gift_currency_value']):?><?php echo $cartRecord['fields']['gift_currency_value']; ?><?php else:?><?php endif;?>" required />
                                                <!-- Value of this input will be sent to back -->
                                                <input class="input input-key-js" name="<?php echo $giftSettings['fields']['currency']['name']; ?>" value="<?php if ($cartRecord['fields']['gift_currency']):?><?php echo $cartRecord['fields']['gift_currency']; ?><?php else:?><?php endif;?>" readonly hidden required>
                                            </label>

                                            <?php if (!empty($giftSettings['fields']['currency']['options'])): ?>
                                                <ul class="options options-js">
                                                    <?php foreach ($giftSettings['fields']['currency']['options'] as $key => $item): ?>
                                                        <li class="option option-js" data-key="<?php echo $key; ?>">
                                                            <div class="option__text"><?php echo $item; ?></div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($giftSettings['fields']['sender'])): ?>
                                    <div class="form-group--05">
                                        <input type="text" name="<?php echo $giftSettings['fields']['sender']['name']; ?>" value="<?php echo $cartRecord['fields']['gift_sender_name'];?>" id="sender" class="input-animation" placeholder="<?php echo $giftSettings['fields']['sender']['label']; ?> *" required>
                                        <label for="sender" class="form__label"><?php echo $giftSettings['fields']['sender']['label']; ?> *</label>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($giftSettings['fields']['recipient'])): ?>
                                    <div class="form-group--05">
                                        <input type="text" name="<?php echo $giftSettings['fields']['recipient']['name']; ?>" value="<?php echo $cartRecord['fields']['gift_recipient_name'];?>" id="recipient" class="input-animation" placeholder="<?php echo $giftSettings['fields']['recipient']['label']; ?> *" required>
                                        <label for="recipient" class="form__label"><?php echo $giftSettings['fields']['recipient']['label']; ?> *</label>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($giftSettings['fields']['message'])): ?>
                                    <div class="form-group">
                                        <label for="message"><?php echo $giftSettings['fields']['message']['label']; ?></label>
                                        <textarea name="<?php echo $giftSettings['fields']['message']['name']; ?>" id="message" cols="10" rows="2"><?php echo $cartRecord['fields']['gift_message'];?></textarea>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn--accent-border">
                                    <?php pll_e('Order Now'); ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- End img-text-mod section -->
    </div>
    <!--End page-->

<?php get_footer(); ?>