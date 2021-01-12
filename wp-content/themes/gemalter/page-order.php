<?php
/**
 * The template for displaying order page
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
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);

$cartItemID = isset($_REQUEST['cart_item_id']) ? trim($_REQUEST['cart_item_id']) : '';
$cartDiscountedHash = isset($_REQUEST['discount_hash']) ? trim($_REQUEST['discount_hash']) : '';
$cartRecord = getCardItemRecord($cartItemID);
if ($cartRecord) {
    if (isset($cartRecord['attributes']['product_type']) && $cartRecord['attributes']['product_type'] != 'picture') {
        $cartRecord = null;
    }
    if (isset($cartRecord['attributes']['locale']) && $cartRecord['attributes']['locale'] != $current_lang) {
        $cartRecord = null;
    }
} elseif ($cartItemID) {
    $location = (get_url_lang_prefix()) . 'order/';
    wp_redirect( $location);
    exit;
}

$orderFieldsFromCookie = getOrderFieldsFromCookie();
$activeStep = isset($orderFieldsFromCookie['activeStep']) ? intval($orderFieldsFromCookie['activeStep']) : 0;

$allPricesData = getPrices();

$cartDiscountedRecord = getCardItemRecord($cartDiscountedHash);
if ($cartDiscountedRecord) {
    if (isset($cartDiscountedRecord['attributes']['product_type']) && $cartDiscountedRecord['attributes']['product_type'] != 'picture') {
        $cartDiscountedRecord = null;
    }
    if (isset($cartDiscountedRecord['attributes']['locale']) && $cartDiscountedRecord['attributes']['locale'] != $current_lang) {
        $cartDiscountedRecord = null;
    }
}
if (!$cartDiscountedRecord) {
    $cartDiscountedHash = '';
}
$discount = null;
if ($cartDiscountedRecord) {
    $baseDiscountPrice = $cartDiscountedRecord['price'];
    $currency = $allPricesData[$current_lang]['currency'];
    $discount = getDiscount($baseDiscountPrice, $currency);
}

$data = [];
$data['subjects'] = getSubjects();
$data['default_subject'] = 'person_1';
$subject = $data['default_subject'];
$subjectPriceType = $data['default_subject'];
if ($cartRecord && isset($cartRecord['attributes']['subject']) && $cartRecord['attributes']['subject']) {
    $subject = $cartRecord['attributes']['subject'];
    if ($subject == 'custom') {
        // logic for custom items
        $data['subjects']['custom']['items']['persons']['default'] = isset($cartRecord['attributes']['subject_custom']['persons']) ? $cartRecord['attributes']['subject_custom']['persons'] : $data['subjects']['custom']['items']['persons']['default'];
        $data['subjects']['custom']['items']['pets']['default'] = isset($cartRecord['attributes']['subject_custom']['pets']) ? $cartRecord['attributes']['subject_custom']['pets'] : $data['subjects']['custom']['items']['pets']['default'];
    }
} else if (isset($orderFieldsFromCookie['subject']) && $orderFieldsFromCookie['subject']) {
    $subject = $orderFieldsFromCookie['subject'];
    if ($subject == 'custom') {
        // logic for custom items
        $data['subjects']['custom']['items']['persons']['default'] = isset($orderFieldsFromCookie['subject_custom[persons]']) ? $orderFieldsFromCookie['subject_custom[persons]'] : $data['subjects']['custom']['items']['persons']['default'];
        $data['subjects']['custom']['items']['pets']['default'] = isset($orderFieldsFromCookie['subject_custom[pets]']) ? $orderFieldsFromCookie['subject_custom[pets]'] : $data['subjects']['custom']['items']['pets']['default'];
    }
}
if ($cartRecord && isset($cartRecord['attributes']['subject_price_type']) && $cartRecord['attributes']['subject_price_type']) {
    $subjectPriceType = $cartRecord['attributes']['subject_price_type'];
} else if (isset($orderFieldsFromCookie['subject']) && $orderFieldsFromCookie['subject']) {
    $subjectTMP = $orderFieldsFromCookie['subject'];
    if ($subjectTMP == 'custom') {
        $countSubjects = 0;
        $customPersons = isset($orderFieldsFromCookie['subject_custom[persons]']) ? $orderFieldsFromCookie['subject_custom[persons]'] : $data['subjects']['custom']['items']['persons']['default'];
        $customPets = isset($orderFieldsFromCookie['subject_custom[pets]']) ? $orderFieldsFromCookie['subject_custom[pets]'] : $data['subjects']['custom']['items']['pets']['default'];
        $subjectCustomMaxElements = isset($orderFieldsFromCookie['subject_custom_max_elements']) ? trim($orderFieldsFromCookie['subject_custom_max_elements']) : 0;
        $countSubjects = $customPersons + $customPets;
        if ($countSubjects > $subjectCustomMaxElements) {
            $countSubjects = $subjectCustomMaxElements;
        }
        if ($countSubjects < 1) {
            $countSubjects = 1;
        }
        $subjectPriceType = 'person_' . $countSubjects;
    } else {
        $subjects = getSubjects();
        if (isset($subjects[$subjectTMP])) {
            $subjectPriceType = $subjects[$subjectTMP]['price_type'];
        } else {
            $subjectPriceType = 'person_1';
        }
    }
}

$data['painting_techniques'] = [
    'charcoal' => isset($fields['choose_1']) ? $fields['choose_1'] : null,
    'oil' => isset($fields['choose_2']) ? $fields['choose_2'] : null,
];
$data['default_painting_technique'] = 'charcoal';
$paintingTechnique = $data['default_painting_technique'];
if ($cartRecord && isset($cartRecord['attributes']['choose_tech']) && $cartRecord['attributes']['choose_tech']) {
    $paintingTechnique = $cartRecord['attributes']['choose_tech'];
} else if (isset($orderFieldsFromCookie['choose_tech']) && $orderFieldsFromCookie['choose_tech']) {
    $paintingTechnique = $orderFieldsFromCookie['choose_tech'];
}

$data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
$data['use_size'] = $allPricesData[$current_lang]['use_size'];
$data['sizes'] = $allPricesData[$current_lang]['sizes'][$paintingTechnique];
$data['default_price_type'] = 'regular';
$priceType = $data['default_price_type'];
$priceTypeSelected = 'regular';
if ($cartRecord && isset($cartRecord['attributes']['duration_type']) && $cartRecord['attributes']['duration_type']) {
    $priceTypeSelected = $cartRecord['attributes']['duration_type'];
} else if (isset($orderFieldsFromCookie['duration_type']) && $orderFieldsFromCookie['duration_type']) {
    $priceTypeSelected = $orderFieldsFromCookie['duration_type'];
}
$data['sizes'] = getSizesBySubjectTechnique($current_lang, $paintingTechnique, $subjectPriceType, $priceType);
$data['default_size'] = null;
if (!empty($data['sizes'])) {
    foreach($data['sizes'] as $sizeKey => $sizeItem) {
        if (isset($sizeItem['available']) && $sizeItem['available']) {
            $data['default_size'] = $sizeKey;
            break;
        }
    }
}
$size = $data['default_size'];
if ($cartRecord && isset($cartRecord['attributes']['size']) && $cartRecord['attributes']['size']) {
    $size = $cartRecord['attributes']['size'];
} else if (isset($orderFieldsFromCookie['size']) && $orderFieldsFromCookie['size']) {
    $size = $orderFieldsFromCookie['size'];
}
$data['default_background_type'] = 'background_artist';
$backgroundType = $data['default_background_type'];
if ($cartRecord && isset($cartRecord['attributes']['background_type']) && $cartRecord['attributes']['background_type']) {
    $backgroundType = $cartRecord['attributes']['background_type'];
} else if (isset($orderFieldsFromCookie['background_type']) && $orderFieldsFromCookie['background_type']) {
    $backgroundType = $orderFieldsFromCookie['background_type'];
}
$data['background_colors'] = getBackgroundColorsSettings();
$data['default_background_color'] = '';
$backgroundColor = $data['default_background_color'];
if ($cartRecord && isset($cartRecord['attributes']['color']) && $cartRecord['attributes']['color']) {
    $backgroundColor = $cartRecord['attributes']['color'];
} else if (isset($orderFieldsFromCookie['color']) && $orderFieldsFromCookie['color']) {
    $backgroundColor = $orderFieldsFromCookie['color'];
}

$data['duration'] = getDuration();
$data['duration_with_date'] = getDurationWithDates($paintingTechnique, $size);
$deliveryDate = '';
if ($cartRecord && isset($cartRecord['attributes']['delivery_date']) && $cartRecord['attributes']['delivery_date']) {
    $deliveryDate = $cartRecord['attributes']['delivery_date'];
} else if (isset($orderFieldsFromCookie['delivery_date']) && $orderFieldsFromCookie['delivery_date']) {
    $deliveryDate = $orderFieldsFromCookie['delivery_date'];
}

$secondOptionToSendPhoto = false;
if ($cartRecord && isset($cartRecord['attributes']['second_option_to_send_photo']) && $cartRecord['attributes']['second_option_to_send_photo']) {
    $secondOptionToSendPhoto = $cartRecord['attributes']['second_option_to_send_photo'];
} else if (isset($orderFieldsFromCookie['second_option_to_send_photo']) && $orderFieldsFromCookie['second_option_to_send_photo']) {
    $secondOptionToSendPhoto = $orderFieldsFromCookie['second_option_to_send_photo'];
}
$artistAdvice = false;
if ($cartRecord && isset($cartRecord['attributes']['artist_advice']) && $cartRecord['attributes']['artist_advice']) {
    $artistAdvice = $cartRecord['attributes']['artist_advice'];
} else if (isset($orderFieldsFromCookie['artist_advice']) && $orderFieldsFromCookie['artist_advice']) {
    $artistAdvice = $orderFieldsFromCookie['artist_advice'];
}
$uploadComment = '';
if ($cartRecord && isset($cartRecord['attributes']['upload_comment']) && $cartRecord['attributes']['upload_comment']) {
    $uploadComment = $cartRecord['attributes']['upload_comment'];
} else if (isset($orderFieldsFromCookie['upload_comment']) && $orderFieldsFromCookie['upload_comment']) {
    $uploadComment = $orderFieldsFromCookie['upload_comment'];
}

$data['frames'] = get_terms(array(
    'taxonomy'      => 'pa_frames', // название таксономии с WP 4.5
    'orderby'       => 'id',
    'hide_empty'    => false,
    'order'         => 'ASC',
));
if (!empty($data['frames'])) {
    foreach ($data['frames'] as $key => $frame) {
        $data['frames'][$key]->image = get_field('frame_image', $frame->taxonomy . '_' . $frame->term_id);
        $data['frames'][$key]->price = get_field('frame_price', $frame->taxonomy . '_' . $frame->term_id);
        $data['frames'][$key]->is_popular = get_field('frame_is_popular', $frame->taxonomy . '_' . $frame->term_id);
    }
}
$frameType = "need_frame";
if ($cartRecord && isset($cartRecord['attributes']['frame']) && $cartRecord['attributes']['frame']) {
    $frameType = $cartRecord['attributes']['frame'];
} else if (isset($orderFieldsFromCookie['frame']) && $orderFieldsFromCookie['frame']) {
    $frameType = $orderFieldsFromCookie['frame'];
}
$frameSelected = '';
if ($cartRecord && isset($cartRecord['attributes']['frame_selected']) && $cartRecord['attributes']['frame_selected']) {
    $frameSelected = $cartRecord['attributes']['frame_selected'];
} else if (isset($orderFieldsFromCookie['frame_selected']) && $orderFieldsFromCookie['frame_selected']) {
    $frameSelected = $orderFieldsFromCookie['frame_selected'];
}

$customSubject = isset($cartRecord['attributes']['subject_custom']) ? $cartRecord['attributes']['subject_custom'] : [];
$previewImgPath = getOrderPreviewImg($paintingTechnique, $subject, $customSubject, $size);

get_header();
?>
    <script>var allFiles = []; activeStep = <?php echo $activeStep;?>;</script>
    <!--Start page-->
    <form id="order_form" class="page-wrapper page-order" onsubmit="return false;">
        <?php if ($cartItemID):?>
            <input type="hidden" name="cart_item_key" value="<?php echo $cartItemID; ?>">
        <?php endif;?>
        <?php if ($cartDiscountedHash):?>
            <input type="hidden" name="cart_discounted_hash" value="<?php echo $cartDiscountedHash; ?>">
        <?php endif;?>
        
        <div class="container-small">
            <div class="title-wrap m-b-90 p-t-65">
                <h2 class="js-order-title text--center">
                    <?php pll_e('Order Your Portrait in 3 Steps'); ?>
                </h2>
            </div>
            <ul class=" order-steps m-b-120">
                <li class="step active">
                    <div class="step__label">
                        <div class="num">
                            <span>1</span>
                        </div>
                    </div>
                    <div class="step__text">
                        <p><?php pll_e('Portrait Characteristic'); ?></p>
                    </div>
                </li>
                <li class="step ">
                    <div class="step__label">
                        <div class="num">
                            <span>2</span>
                        </div>
                    </div>
                    <div class="step__text">
                        <p><?php pll_e('Upload Portrait'); ?></p>
                    </div>
                </li>
                <li class="step ">
                    <div class="step__label">
                        <div class="num">
                            <span>3</span>
                        </div>
                    </div>
                    <div class="step__text">
                        <p><?php pll_e('Checkout'); ?></p>
                    </div>
                </li>
            </ul>
            <div class="error-wrapper"></div>
        </div>

        <div class="js-active-section js-active">
            <div class="choose-subject order-section-p">
                <div class="container-small">
                    <div class="order-tip">
                        <p><?php pll_e('Choose number of subjects'); ?></p>
                        <span title="<?php pll_e('Choose number of subjects'); ?>">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="10.5" transform="rotate(90 11 11)" stroke="#545454"/>
                            <path d="M12.136 5.2C12.136 5.424 12.0533 5.61867 11.888 5.784C11.728 5.94933 11.5333 6.032 11.304 6.032C11.0747 6.032 10.8773 5.94933 10.712 5.784C10.552 5.61867 10.472 5.424 10.472 5.2C10.472 4.96533 10.552 4.768 10.712 4.608C10.872 4.448 11.0693 4.368 11.304 4.368C11.5333 4.368 11.728 4.448 11.888 4.608C12.0533 4.768 12.136 4.96533 12.136 5.2ZM13.256 14.872C13.256 15.0213 13.2133 15.096 13.128 15.096C12.9093 15.096 12.6293 15.08 12.288 15.048C11.904 15.016 11.5813 15 11.32 15C11.0533 15 10.7333 15.016 10.36 15.048C10.024 15.08 9.74667 15.096 9.528 15.096C9.44267 15.096 9.4 15.0213 9.4 14.872C9.4 14.7387 9.44267 14.6667 9.528 14.656C9.98133 14.5973 10.272 14.488 10.4 14.328C10.5333 14.168 10.6 13.8267 10.6 13.304V10.344C10.6 9.91733 10.544 9.63733 10.432 9.504C10.3253 9.37067 10.088 9.28267 9.72 9.24C9.63467 9.24 9.592 9.17067 9.592 9.032C9.592 8.904 9.63467 8.84 9.72 8.84C10.28 8.696 10.7387 8.544 11.096 8.384C11.4533 8.21867 11.6773 8.08267 11.768 7.976C11.8213 7.912 11.88 7.88 11.944 7.88C12.0933 7.88 12.168 7.92267 12.168 8.008C12.0827 9.20267 12.04 10.1307 12.04 10.792V13.304C12.04 13.8267 12.104 14.168 12.232 14.328C12.3653 14.488 12.664 14.5973 13.128 14.656C13.2133 14.6667 13.256 14.7387 13.256 14.872Z" fill="#545454"/>
                            </svg>
                        </span>
                    </div>
                    <div class="choose-subject-inner js-radio-parent ">
                        <?php foreach ($data['subjects'] as $itemKey => $item): ?>
                            <?php if ($itemKey == 'custom'): ?>
                                <div class="radio-button-wrap">
                                    <label for="subject-custom" class="js-radio-label js-radio-summary radio-button radio-button--subject <?php if ($itemKey == $subject): ?>active<?php endif; ?>">
                                        <?php if (isset($item['items']) && !empty($item['items'])): ?>
                                            <?php foreach ($item['items'] as $itemItemKey => $itemItem): ?>
                                                <div class="radio-button__select">
                                                    <p><?php echo $itemItem['label']; ?></p>
                                                    <div class="form-group form-group--select " data-custom-subject-select>
                                                        <label class="select-label select-label-js">
                                                            <div class="select-label__picture">
                                                            </div>
                                                            <input class="input input-value-js" type="text" readonly placeholder="<?php echo $itemItem['default']; ?>"  />
                                                            <!-- Value of this input will be sent to back -->
                                                            <input class="input input-key-js" data-size-related="" name="subject_custom[<?php echo $itemItemKey; ?>]" readonly hidden value="<?php echo $itemItem['default']; ?>" data-custom-subject-type-value="<?php echo $itemItemKey; ?>">
                                                        </label>
                                                        <ul class="options options-js">
                                                            <?php for ($i = $itemItem['from']; $i <= $itemItem['to']; $i++): ?>
                                                                <li class="option option-js" data-subject="<?php echo $itemItemKey; ?>" data-key="<?php echo $i; ?>">
                                                                    <div class="option__text"><?php echo $i; ?></div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <input class="radio_btn_subject" id="subject-custom" data-size-related="" type="radio" name="subject" <?php if ($itemKey == $subject): ?> checked='checked' <?php endif; ?> data-summary='result-person' data-summary_text="<?php echo $item['label']; ?>" value="<?php echo $itemKey; ?>">
                                        <input class="radio_btn_subject" id="subject-custom" data-size-related="" type="hidden" name="subject_custom_max_elements" value="<?php echo $item['max_items']; ?>">
                                        <span class="checkmark"></span>
                                        <p><?php echo $item['label']; ?></p>
                                    </label>
                                </div>
                            <?php else: ?>
                                <div class="radio-button-wrap">
                                    <label class="js-radio-label js-radio-summary radio-button radio-button--subject <?php if ($itemKey == $subject): ?>active<?php endif; ?>">
                                        <div class="radio-button__icon">
                                            <?php echo $item['icon']; ?>
                                        </div>
                                        <input class="radio_btn_subject" data-size-related="" type="radio" name="subject" <?php if ($itemKey == $subject): ?> checked='checked' <?php endif; ?> data-summary='result-person' data-summary_text="<?php echo $item['label']; ?>" value="<?php echo $itemKey; ?>">
                                        <span class="checkmark"></span>
                                        <p><?php echo $item['label']; ?></p>
                                    </label>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="choose-tech order-section-p">
                <div class="container mx-w-1050">
                    <h3 class="h5 choose-tech__title title--under-line"><?php pll_e('Choose your Painting Technique'); ?></h3>

                    <div class="choose-cards choose-cards--full">
                        <?php if (!empty($data['painting_techniques']['charcoal'])): ?>
                            <label class="choose-card choose__card radio-button radio-button--tech js-radio-summary">
                                <div class="choose-card__label">
                                    <?php if (isset($data['painting_techniques']['charcoal']['text_above_image']) && $data['painting_techniques']['charcoal']['text_above_image']): ?>
                                        <p><?php echo $data['painting_techniques']['charcoal']['text_above_image'];?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="stop-propagation-click">
                                    <div data-href="#modal-order-charcoal" class="new-modal-open modal-event-js" title="<?php pll_e("Read More");?>">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11" cy="11" r="10.5" transform="rotate(90 11 11)" stroke="#545454"/>
                                            <path d="M12.136 5.2C12.136 5.424 12.0533 5.61867 11.888 5.784C11.728 5.94933 11.5333 6.032 11.304 6.032C11.0747 6.032 10.8773 5.94933 10.712 5.784C10.552 5.61867 10.472 5.424 10.472 5.2C10.472 4.96533 10.552 4.768 10.712 4.608C10.872 4.448 11.0693 4.368 11.304 4.368C11.5333 4.368 11.728 4.448 11.888 4.608C12.0533 4.768 12.136 4.96533 12.136 5.2ZM13.256 14.872C13.256 15.0213 13.2133 15.096 13.128 15.096C12.9093 15.096 12.6293 15.08 12.288 15.048C11.904 15.016 11.5813 15 11.32 15C11.0533 15 10.7333 15.016 10.36 15.048C10.024 15.08 9.74667 15.096 9.528 15.096C9.44267 15.096 9.4 15.0213 9.4 14.872C9.4 14.7387 9.44267 14.6667 9.528 14.656C9.98133 14.5973 10.272 14.488 10.4 14.328C10.5333 14.168 10.6 13.8267 10.6 13.304V10.344C10.6 9.91733 10.544 9.63733 10.432 9.504C10.3253 9.37067 10.088 9.28267 9.72 9.24C9.63467 9.24 9.592 9.17067 9.592 9.032C9.592 8.904 9.63467 8.84 9.72 8.84C10.28 8.696 10.7387 8.544 11.096 8.384C11.4533 8.21867 11.6773 8.08267 11.768 7.976C11.8213 7.912 11.88 7.88 11.944 7.88C12.0933 7.88 12.168 7.92267 12.168 8.008C12.0827 9.20267 12.04 10.1307 12.04 10.792V13.304C12.04 13.8267 12.104 14.168 12.232 14.328C12.3653 14.488 12.664 14.5973 13.128 14.656C13.2133 14.6667 13.256 14.7387 13.256 14.872Z" fill="#545454"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="choose-card__picture">
                                    <?php if (isset($data['painting_techniques']['charcoal']['image']) && $data['painting_techniques']['charcoal']['image']): ?>
                                        <?php
                                        if (is_array($data['painting_techniques']['charcoal']['image'])) {
                                            $image = $data['painting_techniques']['charcoal']['image']['url'];
                                        } else {
                                            $image = wp_get_attachment_image_src($data['painting_techniques']['charcoal']['image'], 'full');
                                            if (isset($image[0]) && $image[0]) {
                                                $image = $image[0];
                                            } else {
                                                $image = null;
                                            }
                                        }
                                        ?>
                                        <?php if ($image):?>
                                            <img src="<?php echo $image;?>" alt="">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="radio-wrap">
                                    <input class="chose_tech_radio" data-size-related="" type="radio" id="choose__card_charcoal" <?php if ($paintingTechnique == 'charcoal'): ?>checked="checked"<?php endif; ?> name="choose_tech" value="charcoal" data-summary="result-style" data-summary_text="<?php echo $data['painting_techniques']['charcoal']['title'];?>">
                                    <span class="checkmark"></span>
                                    <?php if (isset($data['painting_techniques']['charcoal']['title']) && $data['painting_techniques']['charcoal']['title']): ?>
                                        <p><?php echo $data['painting_techniques']['charcoal']['title'];?></p>
                                    <?php endif; ?>
                                </div>
                            </label>
                        <?php endif; ?>

                        <div class="choose__or"><?php pll_e('or'); ?></div>

                        <label class="choose-card choose__card choose-card--tb-90 radio-button radio-button--tech js-radio-summary">
                            <div class="choose-card__label">
                                <?php if (isset($data['painting_techniques']['oil']['text_above_image']) && $data['painting_techniques']['oil']['text_above_image']): ?>
                                    <p><?php echo $data['painting_techniques']['oil']['text_above_image'];?></p>
                                <?php endif; ?>
                            </div>

                            <div class="stop-propagation-click">
                                <div data-href="#modal-order-oil" class="new-modal-open modal-event-js" title="<?php pll_e("Read More");?>">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="11" cy="11" r="10.5" transform="rotate(90 11 11)" stroke="#545454"/>
                                        <path d="M12.136 5.2C12.136 5.424 12.0533 5.61867 11.888 5.784C11.728 5.94933 11.5333 6.032 11.304 6.032C11.0747 6.032 10.8773 5.94933 10.712 5.784C10.552 5.61867 10.472 5.424 10.472 5.2C10.472 4.96533 10.552 4.768 10.712 4.608C10.872 4.448 11.0693 4.368 11.304 4.368C11.5333 4.368 11.728 4.448 11.888 4.608C12.0533 4.768 12.136 4.96533 12.136 5.2ZM13.256 14.872C13.256 15.0213 13.2133 15.096 13.128 15.096C12.9093 15.096 12.6293 15.08 12.288 15.048C11.904 15.016 11.5813 15 11.32 15C11.0533 15 10.7333 15.016 10.36 15.048C10.024 15.08 9.74667 15.096 9.528 15.096C9.44267 15.096 9.4 15.0213 9.4 14.872C9.4 14.7387 9.44267 14.6667 9.528 14.656C9.98133 14.5973 10.272 14.488 10.4 14.328C10.5333 14.168 10.6 13.8267 10.6 13.304V10.344C10.6 9.91733 10.544 9.63733 10.432 9.504C10.3253 9.37067 10.088 9.28267 9.72 9.24C9.63467 9.24 9.592 9.17067 9.592 9.032C9.592 8.904 9.63467 8.84 9.72 8.84C10.28 8.696 10.7387 8.544 11.096 8.384C11.4533 8.21867 11.6773 8.08267 11.768 7.976C11.8213 7.912 11.88 7.88 11.944 7.88C12.0933 7.88 12.168 7.92267 12.168 8.008C12.0827 9.20267 12.04 10.1307 12.04 10.792V13.304C12.04 13.8267 12.104 14.168 12.232 14.328C12.3653 14.488 12.664 14.5973 13.128 14.656C13.2133 14.6667 13.256 14.7387 13.256 14.872Z" fill="#545454"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="choose-card__picture">
                                <?php if (isset($data['painting_techniques']['oil']['image']) && $data['painting_techniques']['oil']['image']): ?>
                                    <?php
                                    if (is_array($data['painting_techniques']['oil']['image'])) {
                                        $image = $data['painting_techniques']['oil']['image']['url'];
                                    } else {
                                        $image = wp_get_attachment_image_src($data['painting_techniques']['oil']['image'], 'full');
                                        if (isset($image[0]) && $image[0]) {
                                            $image = $image[0];
                                        } else {
                                            $image = null;
                                        }
                                    }
                                    ?>
                                    <?php if ($image):?>
                                        <img src="<?php echo $image;?>" alt="">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="radio-wrap">
                                <input class="chose_tech_radio" data-size-related="" type="radio" <?php if ($paintingTechnique == 'oil'): ?>checked="checked"<?php endif; ?> name="choose_tech" value="oil" data-summary="result-style" data-summary_text="<?php echo $data['painting_techniques']['oil']['title'];?>">
                                <span class="checkmark"></span>
                                <?php if (isset($data['painting_techniques']['oil']['title']) && $data['painting_techniques']['oil']['title']): ?>
                                    <p><?php echo $data['painting_techniques']['oil']['title'];?></p>
                                <?php endif; ?>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <div class="choose-size">
                <div class="container-small">
                    <h3 class="h5 choose-size__title title--under-line">
                        <?php pll_e("Choose your size"); ?>
                    </h3>
                    <div data-sizes="" class="choose-size-inner js-require">
                        <input type="hidden" name="hidden_size" value="">
                        <?php if (!empty($data['sizes'])):?>
                            <?php foreach ($data['sizes'] as $keySize => $itemSize): ?>
                                <div class="radio-button-wrap">
                                    <label class="radio-button radio-button--size r-size-card js-radio-summary">
                                        <input type="radio" <?php if ($keySize == $size): ?>checked="checked"<?php endif;?>  name="size" <?php if (!$itemSize['available']):?>disabled<?php endif; ?> class="picture_input" data-w='<?php if ($data['use_size'] == 'inch'): ?><?php echo $itemSize['label_width_inch']; ?><?php else: ?><?php echo $itemSize['label_width']; ?><?php endif; ?>' data-h='<?php if ($data['use_size'] == 'inch'): ?><?php echo $itemSize['label_height_inch']; ?><?php else: ?><?php echo $itemSize['label_height']; ?><?php endif; ?>' value="<?php echo $keySize; ?>" data-summary='result-size' data-summary_text="<?php if ($data['use_size'] == 'inch'): ?><?php echo $itemSize['label_inch']; ?><?php else: ?><?php echo $itemSize['label']; ?><?php endif; ?>">
                                        <span class="checkmark"></span>
                                        <p class="r-size-card__size">
                                            <?php if ($data['use_size'] == 'inch'): ?>
                                                <?php echo $itemSize['label_inch']; ?>
                                            <?php else: ?>
                                                <?php echo $itemSize['label']; ?>
                                            <?php endif; ?>
                                            <?php if ($itemSize['available'] && isset($itemSize['price']) && $itemSize['price']):?>
                                                <?php if ($discount): ?>
                                                    <span title="<?php pll_e('Old price');?> <?php echo $data['currency_symbol'] . ' ' . $itemSize['price']; ?>">
                                                        <?php echo $data['currency_symbol'] . ' ' . ($itemSize['price'] - $discount['value']); ?>**
                                                    </span>
                                                <?php else:?>
                                                    <span>
                                                        <?php echo $data['currency_symbol'] . ' ' . $itemSize['price']; ?>
                                                    </span>
                                                <?php endif;?>
                                            <?php endif; ?>
                                        </p>
                                        <span class="r-size-card__descr">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.8187 27.7252C32.7391 27.7119 32.6589 27.7088 32.5798 27.7161C32.4702 27.7132 28.875 27.7115 28.875 27.7115V25.4927C31.6793 23.8239 33.5625 20.7626 33.5625 17.2693V9.79744C34.0605 8.88862 34.3442 7.84641 34.3442 6.73903V0.9375C34.3442 0.419813 33.9245 0 33.4067 0H19.9531C16.3432 0 13.4062 2.93691 13.4062 6.54684V8.45316C13.4062 9.55875 13.7931 10.5753 14.4375 11.3762V17.2693C14.4375 20.7626 16.3208 23.8239 19.125 25.4927V27.7115C19.125 27.7115 15.5303 27.7132 15.4209 27.7161C15.3414 27.7087 15.2608 27.7118 15.1808 27.7253C8.72381 28.0236 3.5625 33.3696 3.5625 39.899V47.0625C3.5625 47.5802 3.98222 48 4.5 48H43.5C44.0178 48 44.4375 47.5802 44.4375 47.0625V39.899C44.4375 33.3694 39.2758 28.0233 32.8187 27.7252ZM15.2812 8.45316V6.54684C15.2812 3.97078 17.377 1.875 19.9531 1.875H32.4691V3.75H25.3594C24.8416 3.75 24.4219 4.16981 24.4219 4.6875C24.4219 5.20519 24.8416 5.625 25.3594 5.625H32.4692V6.73903C32.4692 9.22641 30.4456 11.25 27.9582 11.25H18.0781C16.5359 11.25 15.2812 9.99534 15.2812 8.45316ZM16.3125 17.2693V12.7775C16.8576 13.0009 17.4535 13.125 18.0781 13.125H27.9581C29.3495 13.125 30.6373 12.6764 31.6874 11.9181V17.2693C31.6874 21.5082 28.2388 24.9568 23.9999 24.9568C19.761 24.9568 16.3125 21.5082 16.3125 17.2693ZM27 26.3493V27.774C27 29.4282 25.6542 30.774 24 30.774C22.3458 30.774 21 29.4282 21 27.774V26.3493C21.944 26.6619 22.9524 26.8318 24 26.8318C25.0476 26.8318 26.056 26.6619 27 26.3493ZM19.4758 29.5865C20.1967 31.3793 21.9523 32.649 24 32.649C26.0477 32.649 27.8033 31.3793 28.5242 29.5865H31.0407L24 41.7813L16.9593 29.5865H19.4758ZM42.5625 46.125H39.1875V41.625C39.1875 41.1073 38.7678 40.6875 38.25 40.6875C37.7322 40.6875 37.3125 41.1073 37.3125 41.625V46.125H10.6875V38.6421C10.6875 38.1244 10.2678 37.7046 9.75 37.7046C9.23222 37.7046 8.8125 38.1244 8.8125 38.6421V46.125H5.4375V39.899C5.4375 34.5265 9.56728 30.1012 14.8188 29.6289L23.188 44.125C23.3555 44.4151 23.6649 44.5938 23.9999 44.5938C24.3349 44.5938 24.6443 44.4151 24.8118 44.125L33.181 29.6289C38.4327 30.1012 42.5625 34.5265 42.5625 39.899V46.125Z" fill="#F9AB97"/>
                                            <path d="M21.4948 16.3645C21.3205 16.1902 21.0786 16.0898 20.832 16.0898C20.5855 16.0898 20.3436 16.1902 20.1692 16.3645C19.9948 16.5389 19.8945 16.7808 19.8945 17.0273C19.8945 17.2739 19.9948 17.5158 20.1692 17.6902C20.3436 17.8644 20.5855 17.9648 20.832 17.9648C21.0786 17.9648 21.3205 17.8645 21.4948 17.6902C21.6692 17.5158 21.7695 17.2739 21.7695 17.0273C21.7695 16.7808 21.6692 16.5389 21.4948 16.3645Z" fill="#F9AB97"/>
                                            <path d="M27.8562 16.3645C27.6818 16.1902 27.4409 16.0898 27.1934 16.0898C26.9468 16.0898 26.7049 16.1902 26.5305 16.3645C26.3562 16.5389 26.2559 16.7808 26.2559 17.0273C26.2559 17.2739 26.3562 17.5158 26.5305 17.6902C26.7059 17.8645 26.9468 17.9648 27.1934 17.9648C27.4409 17.9648 27.6818 17.8645 27.8562 17.6902C28.0315 17.5158 28.1309 17.2739 28.1309 17.0273C28.1309 16.7808 28.0315 16.5389 27.8562 16.3645Z" fill="#F9AB97"/>
                                            <path d="M22.3894 4.02469C22.215 3.85031 21.9731 3.75 21.7266 3.75C21.48 3.75 21.2381 3.85022 21.0637 4.02469C20.8894 4.19906 20.7891 4.44094 20.7891 4.6875C20.7891 4.93406 20.8894 5.17594 21.0637 5.35022C21.2381 5.52469 21.48 5.625 21.7266 5.625C21.9731 5.625 22.215 5.52469 22.3894 5.35022C22.5638 5.17594 22.6641 4.93406 22.6641 4.6875C22.6641 4.44094 22.5638 4.19906 22.3894 4.02469Z" fill="#F9AB97"/>
                                            <path d="M25.4321 20.0772C25.066 19.7112 24.4724 19.7112 24.1062 20.0772C24.0228 20.1607 23.9254 20.173 23.8748 20.173C23.8242 20.173 23.7268 20.1606 23.6434 20.0772C23.2774 19.7112 22.6837 19.7112 22.3175 20.0772C21.9514 20.4433 21.9514 21.037 22.3175 21.4031C22.7469 21.8324 23.3108 22.0471 23.8748 22.0471C24.4388 22.0471 25.0027 21.8324 25.4321 21.4031C25.7982 21.037 25.7982 20.4433 25.4321 20.0772Z" fill="#F9AB97"/>
                                            <path d="M38.9128 37.4173C38.7384 37.2429 38.4966 37.1426 38.25 37.1426C38.0034 37.1426 37.7616 37.2429 37.5872 37.4173C37.4128 37.5916 37.3125 37.8335 37.3125 38.0801C37.3125 38.3266 37.4128 38.5685 37.5872 38.7429C37.7616 38.9172 38.0034 39.0176 38.25 39.0176C38.4966 39.0176 38.7384 38.9173 38.9128 38.7429C39.0872 38.5685 39.1875 38.3266 39.1875 38.0801C39.1875 37.8335 39.0872 37.5916 38.9128 37.4173Z" fill="#F9AB97"/>
                                        </svg>
                                        <?php echo $itemSize['max_subjects']; ?> <?php pll_e('subject max'); ?>
                                    </span>
                                    </label>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div data-size-preview="" class="size-preview" style="background-image: url(<?php if ($previewImgPath):?><?php echo $previewImgPath; ?><?php else:?><?php echo the_theme_path(); ?>/img/order-preview-bg-min.jpg<?php endif;?>);">
                <div class="js-size-preview__picture size-preview__picture hide">
                    <div class="size-preview__width size-line">
                      <span class="js-size-pre__width">
                        90
                      </span>
                    </div>
                    <div class="size-preview__width size-line size-line--horizontal">
                      <span class="js-size-pre__width">
                        120
                      </span>
                    </div>
                    <div class="img-border">
                        <div class="img" style="background-image: url(<?php echo the_theme_path(); ?>/img/tech-oil-person-min.jpg);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="choose-bg">
                <div class="container-small">
                    <h3 class="h5 choose-size__title title--under-line">
                        <?php pll_e('Background'); ?>
                    </h3>
                </div>
                <div class="choose-bg-gray">
                    <div class="container-small">
                        <div class="choose-bg-inner">
                            <div class="order-tip fz-18 text--w-500">
                                <p><?php pll_e('Choose a background'); ?></p>
                                <span title="<?php pll_e('Choose a background'); ?>">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11" cy="11" r="10.5" transform="rotate(90 11 11)" stroke="#545454"/>
                                    <path d="M12.136 5.2C12.136 5.424 12.0533 5.61867 11.888 5.784C11.728 5.94933 11.5333 6.032 11.304 6.032C11.0747 6.032 10.8773 5.94933 10.712 5.784C10.552 5.61867 10.472 5.424 10.472 5.2C10.472 4.96533 10.552 4.768 10.712 4.608C10.872 4.448 11.0693 4.368 11.304 4.368C11.5333 4.368 11.728 4.448 11.888 4.608C12.0533 4.768 12.136 4.96533 12.136 5.2ZM13.256 14.872C13.256 15.0213 13.2133 15.096 13.128 15.096C12.9093 15.096 12.6293 15.08 12.288 15.048C11.904 15.016 11.5813 15 11.32 15C11.0533 15 10.7333 15.016 10.36 15.048C10.024 15.08 9.74667 15.096 9.528 15.096C9.44267 15.096 9.4 15.0213 9.4 14.872C9.4 14.7387 9.44267 14.6667 9.528 14.656C9.98133 14.5973 10.272 14.488 10.4 14.328C10.5333 14.168 10.6 13.8267 10.6 13.304V10.344C10.6 9.91733 10.544 9.63733 10.432 9.504C10.3253 9.37067 10.088 9.28267 9.72 9.24C9.63467 9.24 9.592 9.17067 9.592 9.032C9.592 8.904 9.63467 8.84 9.72 8.84C10.28 8.696 10.7387 8.544 11.096 8.384C11.4533 8.21867 11.6773 8.08267 11.768 7.976C11.8213 7.912 11.88 7.88 11.944 7.88C12.0933 7.88 12.168 7.92267 12.168 8.008C12.0827 9.20267 12.04 10.1307 12.04 10.792V13.304C12.04 13.8267 12.104 14.168 12.232 14.328C12.3653 14.488 12.664 14.5973 13.128 14.656C13.2133 14.6667 13.256 14.7387 13.256 14.872Z" fill="#545454"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="choose-bg-row text--ls-05">
                                <label class="radio-button js-radio-summary">
                                    <input type="radio" <?php if($backgroundType == 'background_artist'): ?> checked="checked" <?php endif;?> name="background_type" value="background_artist" data-summary="result-bg" data-summary_text="<?php pll_e('Artist to choose background (popular)'); ?>">
                                    <span class="checkmark"></span>
                                    <p>
                                        <?php pll_e('Artist to choose background (popular)'); ?>
                                    </p>
                                </label>
                                <label class="radio-button js-radio-summary">
                                    <input type="radio" <?php if($backgroundType == 'background_photo'): ?> checked="checked" <?php endif;?> name="background_type" value="background_photo" data-summary="result-bg" data-summary_text="<?php pll_e('Photo background'); ?>">
                                    <span class="checkmark"></span>
                                    <p>
                                        <?php pll_e('Photo background'); ?>
                                    </p>
                                </label>
                                <?php if (!empty($data['background_colors'])):?>
                                <label class="radio-button ">
                                    <input type="radio" <?php if($backgroundType == 'background_color'): ?> checked="checked" <?php endif;?>  id="choose-bg__color_input" name="background_type" value="background_color" data-content='#choose-bg__color' >
                                    <span class="checkmark"></span>
                                    <p>
                                        <?php pll_e('Background colour (pick yours next)'); ?>
                                    </p>
                                </label>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($data['background_colors'])):?>
                                <div class="choose-bg__color" id="choose-bg__color">
                                    <div class="order-tip ">
                                        <p><?php pll_e('Choose a background color'); ?></p>
                                        <span title="<?php pll_e('Choose a background color'); ?>">
                                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11" cy="11" r="10.5" transform="rotate(90 11 11)" stroke="#545454"/>
                                                <path d="M12.136 5.2C12.136 5.424 12.0533 5.61867 11.888 5.784C11.728 5.94933 11.5333 6.032 11.304 6.032C11.0747 6.032 10.8773 5.94933 10.712 5.784C10.552 5.61867 10.472 5.424 10.472 5.2C10.472 4.96533 10.552 4.768 10.712 4.608C10.872 4.448 11.0693 4.368 11.304 4.368C11.5333 4.368 11.728 4.448 11.888 4.608C12.0533 4.768 12.136 4.96533 12.136 5.2ZM13.256 14.872C13.256 15.0213 13.2133 15.096 13.128 15.096C12.9093 15.096 12.6293 15.08 12.288 15.048C11.904 15.016 11.5813 15 11.32 15C11.0533 15 10.7333 15.016 10.36 15.048C10.024 15.08 9.74667 15.096 9.528 15.096C9.44267 15.096 9.4 15.0213 9.4 14.872C9.4 14.7387 9.44267 14.6667 9.528 14.656C9.98133 14.5973 10.272 14.488 10.4 14.328C10.5333 14.168 10.6 13.8267 10.6 13.304V10.344C10.6 9.91733 10.544 9.63733 10.432 9.504C10.3253 9.37067 10.088 9.28267 9.72 9.24C9.63467 9.24 9.592 9.17067 9.592 9.032C9.592 8.904 9.63467 8.84 9.72 8.84C10.28 8.696 10.7387 8.544 11.096 8.384C11.4533 8.21867 11.6773 8.08267 11.768 7.976C11.8213 7.912 11.88 7.88 11.944 7.88C12.0933 7.88 12.168 7.92267 12.168 8.008C12.0827 9.20267 12.04 10.1307 12.04 10.792V13.304C12.04 13.8267 12.104 14.168 12.232 14.328C12.3653 14.488 12.664 14.5973 13.128 14.656C13.2133 14.6667 13.256 14.7387 13.256 14.872Z" fill="#545454"/>
                                                </svg>
                                            </span>
                                    </div>
                                    <div class="container-small">
                                        <div class="order-bg-slider">
                                            <div class="swiper-container">
                                                <!-- Additional required wrapper -->
                                                <div class="swiper-wrapper js-radio-parent">
                                                    <!-- Slides -->
                                                    <?php foreach($data['background_colors'] as $background_color_key => $background_color):?>
                                                        <div class="swiper-slide bg-color-card-wrap">
                                                            <label class="bg-color-card js-radio-label js-radio-summary <?php if ($background_color_key == $backgroundColor):?>active<?php endif;?>" style="background-image: url(<?php echo the_theme_path(); ?>/img/photo-example-min.jpg);">
                                                                <input <?php if ($background_color_key == $backgroundColor):?>checked="checked"<?php endif;?> type="radio" name="color" hidden data-summary="result-bg" data-summary_text="<?php echo $background_color['label'];?>" value="<?php echo $background_color_key;?>">
                                                                <div class="bg-color-card__label" style="background: <?php echo $background_color['hex_color'];?>;">
                                                                    <p>
                                                                        <?php echo $background_color['label'];?>
                                                                    </p>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="slider-progressbar-line">
                                                <div class="slider_progress_wrap">
                                                    <div class="slider_progress">
                                                        <div class="slider_progress_pointer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="js-active-section hidden">
            <div class="upload order-section-p">
                <div class="container-small">
                    <h3 class="h5 choose-size__title title--under-line">
                        <?php pll_e('Upload one or more photos');?>
                    </h3>
                    <div class="upload-inner">
                        <div class="order-tip fz-18 text--w-500">
                            <p><?php pll_e('Add the Photo(s) You would like Painted');?></p>
                            <span title="<?php pll_e('Max 3 files can be uploaded.');?>">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11" cy="11" r="10.5" transform="rotate(90 11 11)" stroke="#545454"></circle>
                                <path d="M12.136 5.2C12.136 5.424 12.0533 5.61867 11.888 5.784C11.728 5.94933 11.5333 6.032 11.304 6.032C11.0747 6.032 10.8773 5.94933 10.712 5.784C10.552 5.61867 10.472 5.424 10.472 5.2C10.472 4.96533 10.552 4.768 10.712 4.608C10.872 4.448 11.0693 4.368 11.304 4.368C11.5333 4.368 11.728 4.448 11.888 4.608C12.0533 4.768 12.136 4.96533 12.136 5.2ZM13.256 14.872C13.256 15.0213 13.2133 15.096 13.128 15.096C12.9093 15.096 12.6293 15.08 12.288 15.048C11.904 15.016 11.5813 15 11.32 15C11.0533 15 10.7333 15.016 10.36 15.048C10.024 15.08 9.74667 15.096 9.528 15.096C9.44267 15.096 9.4 15.0213 9.4 14.872C9.4 14.7387 9.44267 14.6667 9.528 14.656C9.98133 14.5973 10.272 14.488 10.4 14.328C10.5333 14.168 10.6 13.8267 10.6 13.304V10.344C10.6 9.91733 10.544 9.63733 10.432 9.504C10.3253 9.37067 10.088 9.28267 9.72 9.24C9.63467 9.24 9.592 9.17067 9.592 9.032C9.592 8.904 9.63467 8.84 9.72 8.84C10.28 8.696 10.7387 8.544 11.096 8.384C11.4533 8.21867 11.6773 8.08267 11.768 7.976C11.8213 7.912 11.88 7.88 11.944 7.88C12.0933 7.88 12.168 7.92267 12.168 8.008C12.0827 9.20267 12.04 10.1307 12.04 10.792V13.304C12.04 13.8267 12.104 14.168 12.232 14.328C12.3653 14.488 12.664 14.5973 13.128 14.656C13.2133 14.6667 13.256 14.7387 13.256 14.872Z" fill="#545454"></path>
                                </svg>
                            </span>
                        </div>
                        <div id="drop-area">
                            <p><?php pll_e('Drag the Photo here');?></p>
                            <p><?php pll_e('or');?></p>
                            <input type="file" id="fileElem" multiple accept="image/*" name="photos">
                            <input type="hidden" id="fileElemCount" name="photos_count" value="0">
                            <input type="hidden" id="fileElemInfo" name="photos_info" value="">
                            <label class="btn btn--accent-border" for="fileElem"><?php pll_e('Upload Photo');?></label>
                            <div class="gallery">
                                <?php if ($cartRecord && isset($cartRecord['attributes']['photos']) && $cartRecord['attributes']['photos']):?>
                                    <input type="hidden" id="fileElemInfoPrev" name="photos_prev_info" value='<?php echo json_encode($cartRecord['attributes']['photos']); ?>'>
                                    <?php foreach($cartRecord['attributes']['photos'] as $photo): ?>
                                        <div class="gallery__image">
                                            <img src="<?php echo $photo['path']; ?>">
                                            <div class="gallery__name"><?php echo $photo['name']; ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <label class="checkbox-button fz-18 text--w-500 js-upload-accordion">
                            <input type="checkbox" <?php if ($secondOptionToSendPhoto):?>checked="checked"<?php endif;?> name="second_option_to_send_photo" value="1">
                            <p><?php pll_e('Second option to send us the Photo');?></p>
                            <span class="checkmark-checkbox"></span>
                        </label>

                        <ul class="upload-accordion text--ls-05 <?php if ($secondOptionToSendPhoto):?>active<?php endif;?>" <?php if ($secondOptionToSendPhoto):?>style="display: block;"<?php endif;?>>
                            <?php
                                $send_us_photo_settings = isset($fields['send_us_photo_settings']) ? $fields['send_us_photo_settings'] : '';
                            ?>
                            <?php if (isset($send_us_photo_settings['phone']) && $send_us_photo_settings['phone']): ?>
                                <li>
                                    <a class="" href="tel:<?php echo $send_us_photo_settings['phone'];?>">
                                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.5005 1.0957C5.76304 1.0957 1.0957 5.76304 1.0957 11.5005C1.0957 13.4578 1.63955 15.3578 2.67122 17.0078C2.26024 18.4476 1.5179 21.1713 1.50989 21.1997C1.47148 21.3406 1.51269 21.491 1.61794 21.5923C1.72319 21.6935 1.87526 21.7295 2.01372 21.6871L6.13801 20.4185C7.75355 21.3918 9.6036 21.9052 11.5005 21.9052C17.2379 21.9052 21.9052 17.2379 21.9052 11.5005C21.9052 5.76304 17.2379 1.0957 11.5005 1.0957ZM11.5005 21.1049C9.69204 21.1049 7.93043 20.5994 6.40573 19.6438C6.3413 19.6034 6.26727 19.583 6.19324 19.583C6.15362 19.583 6.114 19.589 6.07558 19.6006L2.47433 20.7091C2.73886 19.7434 3.21427 18.0162 3.49 17.0554C3.52201 16.9442 3.50401 16.8241 3.44118 16.7269C2.43031 15.1713 1.89607 13.3641 1.89607 11.5005C1.89607 6.20484 6.20484 1.89607 11.5005 1.89607C16.7961 1.89607 21.1049 6.20484 21.1049 11.5005C21.1049 16.7961 16.7961 21.1049 11.5005 21.1049Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.7"/>
                                            <path d="M18.2974 13.9521C17.5587 13.5419 16.9296 13.1305 16.4706 12.8304C16.12 12.6014 15.8667 12.4362 15.681 12.3429C15.162 12.084 14.7686 12.2669 14.6189 12.4182C14.6001 12.437 14.5833 12.4574 14.5689 12.479C14.0299 13.2878 13.3259 14.0613 13.1198 14.1029C12.8817 14.0657 11.7672 13.4322 10.6595 12.5098C9.5286 11.5674 8.81708 10.665 8.71263 10.0503C9.43816 9.30354 9.69948 8.83372 9.69948 8.29908C9.69948 7.74803 8.41409 5.44737 8.18159 5.21487C7.94828 4.98196 7.42284 4.94554 6.61967 5.10562C6.54244 5.12122 6.4712 5.15924 6.41518 5.21487C6.31793 5.31211 4.04249 7.63197 5.12379 10.4437C6.31073 13.5295 9.35732 17.1163 13.2415 17.699C13.6829 17.765 14.0967 17.7978 14.4841 17.7978C16.7691 17.7978 18.1177 16.6481 18.4975 14.3675C18.5259 14.2006 18.4455 14.0341 18.2974 13.9521ZM13.3604 16.9074C9.25288 16.2915 6.66569 12.2221 5.87093 10.1563C5.08257 8.10739 6.53643 6.28055 6.9014 5.86757C7.19834 5.81714 7.51088 5.79593 7.64134 5.81634C7.91386 6.19532 8.85749 7.97813 8.89911 8.29908C8.89911 8.50917 8.83068 8.80171 8.01591 9.61688C7.94068 9.69172 7.89866 9.79336 7.89866 9.89981C7.89866 11.9952 12.3183 14.9021 13.101 14.9021C13.7817 14.9021 14.6694 13.758 15.1748 13.0124C15.204 13.0136 15.2532 13.0236 15.3233 13.0589C15.4673 13.1313 15.717 13.2942 16.0328 13.5007C16.4498 13.7732 17.0036 14.1349 17.6575 14.5099C17.3606 15.9386 16.5306 17.3836 13.3604 16.9074Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.7"/>
                                        </svg>
                                        <?php echo $send_us_photo_settings['phone'];?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (isset($send_us_photo_settings['email']) && $send_us_photo_settings['email']): ?>
                                <li>
                                    <a class="" href="mailto:<?php echo $send_us_photo_settings['email'];?>">
                                        <svg width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.1543 0.501953H1.8457C0.829254 0.501953 0 1.3303 0 2.34766V14.6523C0 15.6663 0.825563 16.498 1.8457 16.498H19.1543C20.1682 16.498 21 15.6725 21 14.6523V2.34766C21 1.33375 20.1744 0.501953 19.1543 0.501953ZM18.8994 1.73242L10.5391 10.0928L2.10652 1.73242H18.8994ZM1.23047 14.3976V2.59658L7.15637 8.47166L1.23047 14.3976ZM2.10053 15.2676L8.03016 9.33795L10.1079 11.3978C10.3484 11.6363 10.7365 11.6355 10.9761 11.3959L13.002 9.37006L18.8995 15.2676H2.10053ZM19.7695 14.3975L13.872 8.5L19.7695 2.60245V14.3975Z" fill="#F9AB97"/>
                                        </svg>
                                        <?php echo $send_us_photo_settings['email'];?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (isset($send_us_photo_settings['address']) && $send_us_photo_settings['address']): ?>
                                <li>
                                    <a class="" href="https://www.google.com/maps/place/<?php echo $send_us_photo_settings['address'];?>">
                                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5 0C6.15694 0 2.625 3.53194 2.625 7.875C2.625 13.3337 9.7335 20.5052 10.0354 20.8084C10.164 20.9357 10.332 21 10.5 21C10.668 21 10.836 20.9357 10.9646 20.8084C11.2665 20.5052 18.375 13.3337 18.375 7.875C18.375 3.53194 14.8431 0 10.5 0ZM10.5 19.3948C8.93288 17.7174 3.9375 12.0448 3.9375 7.875C3.9375 4.25644 6.88144 1.3125 10.5 1.3125C14.1186 1.3125 17.0625 4.25644 17.0625 7.875C17.0625 12.0409 12.0671 17.7174 10.5 19.3948Z" fill="#F9AB97"/>
                                            <path d="M10.5 3.9375C8.32912 3.9375 6.5625 5.70412 6.5625 7.875C6.5625 10.0459 8.32912 11.8125 10.5 11.8125C12.6709 11.8125 14.4375 10.0459 14.4375 7.875C14.4375 5.70412 12.6709 3.9375 10.5 3.9375ZM10.5 10.5C9.05231 10.5 7.875 9.32269 7.875 7.875C7.875 6.42731 9.05231 5.25 10.5 5.25C11.9477 5.25 13.125 6.42731 13.125 7.875C13.125 9.32269 11.9477 10.5 10.5 10.5Z" fill="#F9AB97"/>
                                        </svg>
                                        <?php pll_e('Mail your hardcopy photo(s) to:');?>
                                        <?php echo $send_us_photo_settings['address'];?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <label class="checkbox-button fz-18 text--w-500">
                            <input type="checkbox" <?php if ($artistAdvice):?>checked="checked"<?php endif;?> name="artist_advice" value="1" >
                            <p><?php pll_e('Get the artistis advice on which Photos will be Best for my Painting');?></p>
                            <span class="checkmark-checkbox"></span>
                        </label>
                        <textarea name="upload_comment" id="upload-comment" cols="30" rows="5" placeholder="<?php pll_e('Comments e.g. Which Person where? Which Position?');?>"><?php echo $uploadComment;?></textarea>
                    </div>
                </div>
            </div>
            <div class="frames">
                <h3 class="h5 choose-size__title title--under-line">
                    <?php pll_e('Frames');?>
                </h3>
                <div class="upload-inner">
                    <div class="container-small">
                        <label class="radio-button fz-18 text--w-500 js-radio-accordion">
                            <input type="radio"  <?php if ($frameType== "need_frame"):?> checked="checked" <?php endif;?>
                                   name="frame" value="need_frame"  data-content='#choose-frame-content' >
                            <span class="checkmark"></span>
                            <p>
                                <?php pll_e('Yes, I need a frame for My Portrait');?>
                            </p>
                        </label>
                    </div>
                    <div class="section--gray" id='choose-frame-content'>
                        <?php if (!empty($data['frames'])): ?>
                            <div class="container-small">
                                <div class="frames-slider">
                                    <div class="swiper-container">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                                            <?php foreach($data['frames'] as $frame): ?>
                                                <div class="swiper-slide">
                                                    <label class="radio-button frames-item">
                                                        <div class="frames-item__picture">
                                                            <?php if ($frame->image): ?>
                                                                <?php
                                                                if (is_array($frame->image)) {
                                                                    $image = $frame->image['url'];
                                                                } else {
                                                                    $image = wp_get_attachment_image_src($frame->image, 'full');
                                                                    if (isset($image[0]) && $image[0]) {
                                                                        $image = $image[0];
                                                                    } else {
                                                                        $image = null;
                                                                    }
                                                                }
                                                                ?>
                                                                <?php if ($image):?>
                                                                    <img src="<?php echo $image;?>" alt="">
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if ($frame->is_popular): ?>
                                                            <p class="frames-item__label">
                                                                <?php pll_e('popular'); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                        <input type="radio" <?php if($frameSelected == $frame->slug):?>checked="checked"<?php endif;?> name="frame_selected" value="<?php echo $frame->slug;?>">
                                                        <span class="checkmark"></span>
                                                        <div class="frames-item__descr">
                                                            <p>
                                                                <?php echo $frame->name;?>
                                                            </p>
                                                            <span>
                                                              <?php echo $data['currency_symbol'] . $frame->price;?>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="slider-progressbar-line">
                                        <div class="slider_progress_wrap">
                                            <div class="slider_progress">
                                                <div class="slider_progress_pointer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="container-small">
                        <label class="radio-button fz-18 text--w-500 js-radio-accordion">
                            <input type="radio" name="frame" <?php if ($frameType== "not_need_frame"):?> checked="checked" <?php endif;?> value="not_need_frame">
                            <span class="checkmark"></span>
                            <p>
                                <?php pll_e('I buy myself a picture frame');?>
                            </p>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="js-active-section hidden">
            <div class="result">
                <div class="container-small">

                    <h3 class="h5 gallery-filter__title title--under-line">
                        <?php pll_e('Your Portrait'); ?>
                    </h3>

                    <div class="result-inner">
                        <div class="result-row">

                            <div class="result__picture">
                                <?php if (isset($data['painting_techniques'][$paintingTechnique]['image']) && $data['painting_techniques'][$paintingTechnique]['image']): ?>
                                    <?php
                                    if (is_array($data['painting_techniques'][$paintingTechnique]['image'])) {
                                        $image = $data['painting_techniques'][$paintingTechnique]['image']['url'];
                                    } else {
                                        $image = wp_get_attachment_image_src($data['painting_techniques'][$paintingTechnique]['image'], 'full');
                                        if (isset($image[0]) && $image[0]) {
                                            $image = $image[0];
                                        } else {
                                            $image = null;
                                        }
                                    }
                                    ?>
                                    <?php if ($image):?>
                                        <img src="<?php echo $image;?>" alt="result photo">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="<?php echo the_theme_path(); ?>/img/chose-3-min.jpg" alt="result photo">
                                <?php endif; ?>

                            </div>
                            <div class="result__descr">
                                <div class="card-table">
                                    <div class="card-table__row">
                                        <div><?php pll_e('Style'); ?></div>
                                        <div id="result-style">XXX</div>
                                    </div>
                                    <div class="card-table__row">
                                        <div><?php pll_e('Person / Pets'); ?></div>
                                        <div id="result-person">XXX</div>
                                    </div>
                                    <div class="card-table__row">
                                        <div><?php pll_e('Size'); ?></div>
                                        <div id="result-size">XXX</div>
                                    </div>
                                    <div class="card-table__row">
                                        <div><?php pll_e('Background'); ?></div>
                                        <div id="result-bg">XXX</div>
                                    </div>

                                </div>

                                <div data-edit-order-btn="" class="result-edit modal-event-js" data-href="#modal-edit">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.3976 12.7825C20.0936 12.7825 19.8472 13.0289 19.8472 13.3329V18.2202C19.8461 19.1316 19.1076 19.8703 18.196 19.8714H2.75205C1.84043 19.8703 1.10189 19.1316 1.10082 18.2202V3.87705C1.10189 2.96543 1.84043 2.22689 2.75205 2.22582H7.63908C7.9431 2.22582 8.18949 1.97942 8.18949 1.67541C8.18949 1.37139 7.9431 1.125 7.63908 1.125H2.75205C1.23283 1.12672 0.00172003 2.35783 0 3.87705V18.2202C0.00172003 19.7394 1.23283 20.9705 2.75205 20.9722H18.196C19.7152 20.9705 20.9463 19.7394 20.948 18.2202V13.3331C20.948 13.0291 20.7016 12.7825 20.3976 12.7825Z" fill="#F9AB97"/>
                                        <path d="M8.60547 9.88449L16.6421 1.84766L19.234 4.43953L11.1973 12.4764L8.60547 9.88449Z" fill="#F9AB97"/>
                                        <path d="M7.29492 13.7901L10.1592 12.9967L8.08829 10.9258L7.29492 13.7901Z" fill="#F9AB97"/>
                                        <path d="M19.9516 0.48631C19.4139 -0.0501242 18.5433 -0.0501242 18.0056 0.48631L17.4219 1.07004L20.0138 3.66191L20.5975 3.07818C21.1341 2.54046 21.1341 1.66991 20.5975 1.13218L19.9516 0.48631Z" fill="#F9AB97"/>
                                    </svg>
                                    <p><?php pll_e('Edit your order');?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="result-bottom">
                        <p><?php pll_e('Add an additional Painting to your order and get');?> <a href="javascript:void(0);"><span data-discount="" id="result-discount">20$</span> <?php pll_e('Discount');?>!</a></p>
                        <button data-add-picture-product-to-cart="order" class="btn btn--accent-border">+ <?php pll_e('Add an extra photo'); ?></button>
                    </div>
                </div>
            </div>

            <?php if(isset($data['duration_with_date']['types']) && !empty($data['duration_with_date']['types'])): ?>
                <div class="delivery">
                    <div class="container-small">
                        <h3 class="h5 gallery-filter__title title--under-line">
                            <?php pll_e('Delivery at your Door'); ?>
                        </h3>

                        <div data-deliveries="" class="delivery-inner">
                            <div class="delivery-types-wrapper">
                                <p><?php pll_e('Get it on:'); ?></p>
                                <?php $iter = 0;?>
                                <?php foreach($data['duration_with_date']['types'] as $type => $typeData): ?>
                                    <?php $iter++;?>
                                    <label class="radio-button radio-button<?php echo $iter;?>">
                                        <input <?php if ($type == $priceTypeSelected):?>checked<?php endif;?> data-from="<?php echo $typeData['type_date_from']; ?>" data-calendar_class="<?php echo $typeData['type_calendar_style']; ?>" data-count="<?php echo $typeData['type_count']; ?>" type="radio"
                                               name="duration_type" value="<?php echo $type; ?>"  class="select_day_radio">
                                        <span class="checkmark"></span>
                                        <p>
                                            <?php echo $typeData['type_date']; ?>
                                            <span class="new-text-pay"><?php echo $typeData['type_percent_label']; ?></span>
                                            <br><span class="new-text-descrip"><?php echo $typeData['type_label']; ?></span>
                                        </p>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <div class="delivery-calendar-wrapper">
                                <div class="delivery__calendar">
                                    <div class="datepicker-here-init" data-position="top right" data-language='<?php echo $current_lang;?>' data-orderDay='10'></div>
                                    <input type="hidden" name="delivery_date" data-delivery-type-related="" value="<?php echo $deliveryDate;?>" id="deliveryDate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <style>
                .calendar_style_1 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_1 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_1 .datepicker--cell-day:not(.-disabled-) {
                    color: #FFF;
                    background-color: #368498;
                }
                .calendar_style_1 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_1 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_1 .datepicker--cell-day.-disabled-weekend-.-disabled- {
                    color: #FFF !important;
                    background-color: rgba(54, 132, 152, 0.5) !important;
                }

                .calendar_style_2 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_2 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_2 .datepicker--cell-day:not(.-disabled-) {
                    color: #FFF;
                    background-color: #facbbf;
                }
                .calendar_style_2 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_2 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_2 .datepicker--cell-day.-disabled-weekend-.-disabled- {
                    color: #FFF !important;
                    background-color: rgba(250, 203, 191, 0.5) !important;
                }

                .calendar_style_3 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_3 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_3 .datepicker--cell-day:not(.-disabled-) {
                    color: #FFF;
                    background-color:  #91c4d1;
                }
                .calendar_style_3 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_3 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_3 .datepicker--cell-day.-disabled-weekend-.-disabled- {
                    color: #FFF !important;
                    background-color: rgba(145, 196, 209, 0.5) !important;
                }

                .calendar_style_4 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_4 .datepicker--cell-day:not(.-disabled-),
                .calendar_style_4 .datepicker--cell-day:not(.-disabled-) {
                    color: #FFF;
                    background-color: #F9AB97;
                }
                .calendar_style_4 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_4 .datepicker--cell-day.-disabled-weekend-.-disabled-,
                .calendar_style_4 .datepicker--cell-day.-disabled-weekend-.-disabled- {
                    color: #FFF !important;
                    background-color: rgba(249, 171, 151, 0.5) !important;
                }

                .radio-button1 .checkmark:after{
                    background: #368498;
                }
                .radio-button2 .checkmark:after {
                    background: #facbbf;
                }
                .radio-button3 .checkmark:after {
                    background: #91c4d1;
                }
                .radio-button4 .checkmark:after {
                    background: #F9AB97;
                }
            </style>
        </div>

        <div class="order-actions">
            <button class="order-actions__back js-controls__back <?php if (!$activeStep):?>hidden<?php endif; ?>"><?php pll_e('Back'); ?></button>

            <button type="submit" class="btn btn--accent-border controls__next"><?php pll_e('Continue');?></button>

            <button data-add-picture-product-to-cart="cart" type="submit" class="btn btn--accent-border controls__add hidden">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.8356 14.1641C14.4605 14.1641 13.3418 15.2828 13.3418 16.6578C13.3418 18.0329 14.4605 19.1516 15.8356 19.1516C17.2106 19.1516 18.3293 18.0329 18.3293 16.6578C18.3293 15.2828 17.2106 14.1641 15.8356 14.1641ZM15.8356 17.6553C15.2854 17.6553 14.8381 17.2079 14.8381 16.6578C14.8381 16.1077 15.2854 15.6603 15.8356 15.6603C16.3857 15.6603 16.8331 16.1077 16.8331 16.6578C16.8331 17.2079 16.3857 17.6553 15.8356 17.6553Z" fill="#F9AB97"/>
                    <path d="M19.841 4.52619C19.6994 4.3449 19.4821 4.23916 19.252 4.23916H4.618L3.94467 1.42196C3.86412 1.08531 3.56311 0.847656 3.21697 0.847656H0.748129C0.334924 0.847617 0 1.18254 0 1.59575C0 2.00895 0.334924 2.34388 0.748129 2.34388H2.62646L5.05788 12.5175C5.13843 12.8544 5.43945 13.0918 5.78558 13.0918H17.4315C17.7755 13.0918 18.0752 12.8574 18.1577 12.5237L19.9782 5.16706C20.0333 4.94366 19.9827 4.70748 19.841 4.52619ZM16.8462 11.5956H6.37609L4.97558 5.73542H18.2961L16.8462 11.5956Z" fill="#F9AB97"/>
                    <path d="M6.78283 14.1641C5.40774 14.1641 4.28906 15.2828 4.28906 16.6578C4.28906 18.0329 5.40778 19.1516 6.78283 19.1516C8.15787 19.1516 9.27659 18.0329 9.27659 16.6578C9.27659 15.2828 8.15787 14.1641 6.78283 14.1641ZM6.78283 17.6553C6.23271 17.6553 5.78532 17.2079 5.78532 16.6578C5.78532 16.1077 6.23271 15.6603 6.78283 15.6603C7.33295 15.6603 7.78033 16.1077 7.78033 16.6578C7.78033 17.2079 7.33295 17.6553 6.78283 17.6553Z" fill="#F9AB97"/>
                </svg>
                <?php pll_e('Add to Cart');?>
            </button>

        </div>
    </form>
    <!--End page-->



    <div id="modal-edit" class="modal">
        <div class="modal__window">
            <span class="modal__cross modal-close-js">
                <div class="close cursor modal-lightbox-close">
                    <span></span>
                    <span></span>
                    <div class="label"><?php pll_e('close');?></div>
                </div>
            </span>
            <div class="modal__content ">
                <h2 class="modal-title text--center h5">
                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M41 25C40.3905 25 40 26.3873 40 27V36C39.9978 37.8368 37.8278 39.9978 36 40H6C4.17225 39.9978 2.00216 37.8368 2 36V8C2.00216 6.16273 4.17225 4.00217 6 4H15C15.6095 4 16 3.61271 16 3C16 2.38729 15.6095 2 15 2H6C2.95403 2.00347 0.00344859 4.93818 0 8V36C0.00344859 39.0618 2.95403 41.9965 6 42H36C39.046 41.9965 41.9966 39.0618 42 36V27C42 26.3873 41.6095 25 41 25Z" fill="#F9AB97"/>
                        <path d="M18 19L34 3L39 8L23 24L18 19Z" fill="#F9AB97"/>
                        <path d="M15 27L21 25L17 21L15 27Z" fill="#F9AB97"/>
                        <path d="M40 1.00002C38.948 -0.0494845 37.052 -0.0494845 36 1.00002L35 2.00002L40 7.00002L41 6.00002C42.0499 4.94799 42.0499 3.05204 41 2.00002L40 1.00002Z" fill="#F9AB97"/>
                    </svg>
                    <?php pll_e('Order Editing');?>
                </h2>
                <p class="text--center">
                    <i>
                        <?php pll_e('Order Editing Text');?>
                    </i>
                </p>
                <div class="modal-bg">
                    <form class="form" data-edit-order-form="">
                        <div class="form-group--select form-group--white form-group--05">
                            <label class="select-label select-label-js readonly">
                                <div class="select-label__picture"></div>
                                <input class="input input-value-js" type="text" name="edit_subject_text" value="<?php echo $data['subjects'][$subject]['label']; ?>" readonly placeholder="<?php pll_e('Subject'); ?>" value="<?php  ?>" required />
                                <!-- Value of this input will be sent to back -->
                                <input class="input input-key-js" name="edit_subject" value="<?php echo $subject; ?>" readonly hidden required>
                                <div class="select-label__bottom">
                                <?php pll_e('Person / Pets');?>
                                </div>
                            </label>
                            <ul class="options options-js hide">
                                <li class="option option-js" data-key="option 1">
                                    <div class="option__text">option 1</div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group--select form-group--white form-group--05">
                            <label class="select-label select-label-js">
                                <div class="select-label__picture">
                                </div>
                                <input class="input input-value-js" type="text" name="edit_choose_tech_text" value="<?php echo $data['painting_techniques'][$paintingTechnique]['title'];?>" readonly placeholder="<?php pll_e('Style'); ?>" required />
                                <!-- Value of this input will be sent to back -->
                                <input class="input input-key-js" name="edit_choose_tech" value="<?php echo $paintingTechnique;?>" readonly hidden required>
                                <div class="select-label__bottom">
                                    <?php pll_e('Style');?>
                                </div>
                            </label>

                            <ul class="options options-js" data-list="choose_tech">
                                <li class="option option-js" data-key="charcoal">
                                    <div class="option__text"><?php echo $data['painting_techniques']['charcoal']['title'];?></div>
                                </li>
                                <li class="option option-js" data-key="oil">
                                    <div class="option__text"><?php echo $data['painting_techniques']['oil']['title'];?></div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group--select form-group--white form-group--05">
                            <label class="select-label select-label-js">
                                <div class="select-label__picture">
                                </div>
                                <input class="input input-value-js" type="text" name="edit_size_text" readonly placeholder="<?php pll_e('Size'); ?>" required />
                                <!-- Value of this input will be sent to back -->
                                <input class="input input-key-js" name="edit_size" readonly hidden required>
                                <div class="select-label__bottom">
                                    <?php pll_e('Size');?>
                                </div>
                            </label>

                            <ul class="options options-js" data-list="size">
                                <li class="option option-js" data-key="option 1">
                                    <div class="option__text">option 1</div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-group--select form-group--white form-group--05 background-wrapper">
                            <label class="select-label select-label-js">
                                <div class="select-label__picture">
                                </div>
                                <input class="input input-value-js" type="text" name="edit_background_text" readonly placeholder="<?php pll_e('Background');?>" required />

                                <!-- Value of this input will be sent to back -->
                                <input class="input input-key-js" name="edit_background" readonly hidden required>
                                <div class="select-label__bottom">
                                    <?php pll_e('Background');?>
                                </div>
                            </label>

                            <ul class="options options-js" data-list="background">
                                <li class="option option-js" data-key="background_artist">
                                    <div class="option__text"><?php pll_e('Artist to choose background (popular)'); ?></div>
                                </li>
                                <li class="option option-js" data-key="background_photo">
                                    <div class="option__text"><?php pll_e('Photo background'); ?></div>
                                </li>
                                <?php if (!empty($data['background_colors'])):?>
                                    <?php foreach($data['background_colors'] as $background_color_key => $background_color):?>
                                        <li class="option option-js" data-type="color" data-key="<?php echo $background_color_key;?>">
                                            <div class="option__text"><?php echo $background_color['label'];?></div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="modal-action">
                    <div data-submit-edit-form="" class="btn btn--accent-border"><?php pll_e('Save');?></div>
                </div>
            </div>

            <!--<div class="modal-bg-icon">
                <svg width="221" height="221" viewBox="0 0 221 221" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 157L150 28L192 70L63 199L21 157Z" fill="#FAE8E5"/>
                    <path d="M0 221L46 208L13 175L0 221Z" fill="#FAE8E5"/>
                    <path d="M204 7.00041C195.284 -1.69545 180.716 -1.69545 172 7.00041L163 16.0004L205 58.0004L214 49.0004C222.699 40.2836 222.699 25.7172 214 17.0004L204 7.00041Z" fill="#FAE8E5"/>
                </svg>
            </div>-->
        </div>
    </div>

<?php if (isset($data['painting_techniques']['charcoal']['popup_settings']) && $data['painting_techniques']['charcoal']['popup_settings']): ?>
    <div id="modal-order-charcoal" class="modal modal--big">
        <div class="modal__window">
            <span class="modal__cross modal-close-js">
                <div class="close cursor modal-lightbox-close">
                    <span></span>
                    <span></span>
                    <div class="label"><?php pll_e('close'); ?></div>
                </div>
            </span>
            <div class="modal__content">
                <?php if (isset($data['painting_techniques']['charcoal']['title'])): ?>
                    <h2 class="h5 title--under-line"><?php echo $data['painting_techniques']['charcoal']['title']; ?></h2>
                <?php endif; ?>
                <!-- Start img-text-mod section -->
                <section class="section img-text-mod img-text-mod--right-gray img-text-mod--mob-gray " >
                    <div class="container-small">
                        <div class="img-text-mod-inner">
                            <div class="img-text-mod__left">
                                <div class="img-text-mod-label">
                                    <?php if (isset($data['painting_techniques']['charcoal']['popup_settings']['vertical_title'])): ?>
                                        <p class="vertical-label"><?php echo $data['painting_techniques']['charcoal']['popup_settings']['vertical_title']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="img-text-mod__picture img-text-mod-transform">
                                    <?php if (isset($data['painting_techniques']['charcoal']['popup_settings']['image']) && $data['painting_techniques']['charcoal']['popup_settings']['image']): ?>
                                        <?php
                                        if (is_array($data['painting_techniques']['charcoal']['popup_settings']['image'])) {
                                            $image = $data['painting_techniques']['charcoal']['popup_settings']['image']['url'];
                                        } else {
                                            $image = wp_get_attachment_image_src($data['painting_techniques']['charcoal']['popup_settings']['image'], 'full');
                                            if (isset($image[0]) && $image[0]) {
                                                $image = $image[0];
                                            } else {
                                                $image = null;
                                            }
                                        }
                                        ?>
                                        <?php if ($image):?>
                                            <img src="<?php echo $image;?>" alt="">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="img-text-mod__right">
                                <?php if (isset($data['painting_techniques']['charcoal']['popup_settings']['characteristics']) && $data['painting_techniques']['charcoal']['popup_settings']['characteristics']): ?>
                                    <h3 class="title h5">
                                        <?php pll_e('Characteristics'); ?>:
                                    </h3>
                                    <div class="text">
                                        <p>
                                            <?php echo $data['painting_techniques']['charcoal']['popup_settings']['characteristics']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($data['painting_techniques']['charcoal']['popup_settings']['material_and_framing']) && $data['painting_techniques']['charcoal']['popup_settings']['material_and_framing']): ?>
                                    <h3 class="title h5">
                                        <?php pll_e('Material & Framing'); ?>:
                                    </h3>
                                    <p class="text">
                                        <?php echo $data['painting_techniques']['charcoal']['popup_settings']['material_and_framing']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End img-text-mod section -->
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($data['painting_techniques']['oil']['popup_settings']) && $data['painting_techniques']['oil']['popup_settings']): ?>
    <div id="modal-order-oil" class="modal modal--big">
        <div class="modal__window">
            <span class="modal__cross modal-close-js">
                <div class="close cursor modal-lightbox-close">
                    <span></span>
                    <span></span>
                    <div class="label"><?php pll_e('close'); ?></div>
                </div>
            </span>
            <div class="modal__content">
                <?php if (isset($data['painting_techniques']['oil']['title'])): ?>
                    <h2 class="h5 title--under-line"><?php echo $data['painting_techniques']['oil']['title']; ?></h2>
                <?php endif; ?>
                <!-- Start img-text-mod section -->
                <section class="section img-text-mod img-text-mod--right-gray img-text-mod--mob-gray " >
                    <div class="container-small">
                        <div class="img-text-mod-inner">
                            <div class="img-text-mod__left">
                                <div class="img-text-mod-label">
                                    <?php if (isset($data['painting_techniques']['oil']['popup_settings']['vertical_title'])): ?>
                                        <p class="vertical-label"><?php echo $data['painting_techniques']['oil']['popup_settings']['vertical_title']; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="img-text-mod__picture img-text-mod-transform">
                                    <?php if (isset($data['painting_techniques']['oil']['popup_settings']['image']) && $data['painting_techniques']['oil']['popup_settings']['image']): ?>
                                        <?php
                                        if (is_array($data['painting_techniques']['oil']['popup_settings']['image'])) {
                                            $image = $data['painting_techniques']['oil']['popup_settings']['image']['url'];
                                        } else {
                                            $image = wp_get_attachment_image_src($data['painting_techniques']['oil']['popup_settings']['image'], 'full');
                                            if (isset($image[0]) && $image[0]) {
                                                $image = $image[0];
                                            } else {
                                                $image = null;
                                            }
                                        }
                                        ?>
                                        <?php if ($image):?>
                                            <img src="<?php echo $image;?>" alt="">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="img-text-mod__right">
                                <?php if (isset($data['painting_techniques']['oil']['popup_settings']['characteristics']) && $data['painting_techniques']['oil']['popup_settings']['characteristics']): ?>
                                    <h3 class="title h5">
                                        <?php pll_e('Characteristics'); ?>:
                                    </h3>
                                    <div class="text">
                                        <p>
                                            <?php echo $data['painting_techniques']['oil']['popup_settings']['characteristics']; ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($data['painting_techniques']['oil']['popup_settings']['material_and_framing']) && $data['painting_techniques']['charcoal']['popup_settings']['material_and_framing']): ?>
                                    <h3 class="title h5">
                                        <?php pll_e('Material & Framing'); ?>:
                                    </h3>
                                    <p class="text">
                                        <?php echo $data['painting_techniques']['oil']['popup_settings']['material_and_framing']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End img-text-mod section -->
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
get_footer();
