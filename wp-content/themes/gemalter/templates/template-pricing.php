<?php

/**
 * Template Name: Pricing Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);

$prices = [
    'currency_symbol' => getPrices()[$current_lang]['currency_symbol'],
    'use_size' => getPrices()[$current_lang]['use_size'],
    'oil' => getPricesByTechniqueSubject($current_lang, 'oil'),
    'charcoal' => getPricesByTechniqueSubject($current_lang, 'charcoal'),
];
$duration = getDuration();

get_header();
//test($prices);
?>

    <!--Start page-->
    <div class="page-wrapper">

        <div class="container-small mx-w-1050">
            <?php if (isset($fields['title']) && $fields['title']): ?>
                <div class="title-wrap m-b-90 p-t-65">
                    <h2 class="">
                        <?php echo $fields['title']; ?>
                    </h2>
                </div>
            <?php endif; ?>
            <?php if (isset($fields['description']) && $fields['description']): ?>
                <div class="text text--center text--lite-color m-b-70 text--span-f-w-600">
                    <?php echo $fields['description']; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="container mx-w-1050">
            <div class="choose-cards choose-cards--full">
                <div class="choose-card choose__card choose-card--big-img">
                    <div class="choose-card__label">
                        <?php if (isset($fields['choose_1']['text_above_image']) && $fields['choose_1']['text_above_image']): ?>
                            <p><?php echo $fields['choose_1']['text_above_image'];?></p>
                        <?php endif; ?>
                    </div>
                    <div class="choose-card__picture">
                        <?php if (isset($fields['choose_1']['image']) && $fields['choose_1']['image']): ?>
                            <?php
                            if (is_array($fields['choose_1']['image'])) {
                                $image = $fields['choose_1']['image']['url'];
                            } else {
                                $image = wp_get_attachment_image_src($fields['choose_1']['image'], 'full');
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
                    <div class="choose-card__actions">
                        <?php if (isset($fields['choose_1']['title']) && $fields['choose_1']['title']): ?>
                            <div class="h6 choose-card-title"><?php echo $fields['choose_1']['title'];?></div>
                        <?php endif; ?>
                    </div>
                    <div class="card-table m-t-65">
                        <h6 class="card-table__head">
                            <?php pll_e('Our prices starts at'); ?>
                        </h6>
                        <div class="new-txt-size">
                            <div class=""><?php pll_e('size'); ?></div>
                            <div class=""><?php pll_e('price'); ?></div>
                        </div>
                        <?php foreach ($prices['oil']['sizes'] as $sizeKey => $size): ?>
                            <?php if ($size['available']): ?>
                                <div class="card-table__row js-size-options">
                                    <div>
                                        <?php
                                        if ($prices['use_size'] == 'inch') {
                                            $sizeInfo = $size['label_inch'];
                                            $sizeInfo = str_replace(['x', '"', ' '], ["-", '', ''], $sizeInfo);
                                            $sizeInfo = explode('-', $sizeInfo);
                                        } else {
                                            $sizeInfo = explode('-', $sizeKey);
                                        }
                                        $sizeInfo['width'] = isset($sizeInfo[0]) ? $sizeInfo[0] : 0;
                                        $sizeInfo['height'] = isset($sizeInfo[1]) ? $sizeInfo[1] : 0;
                                        ?>
                                        <span style="display: none;" class="width"><?php echo $sizeInfo['width']; ?></span>
                                        <span style="display: none;" class="height"><?php echo $sizeInfo['height']; ?></span>
                                        <?php echo ($prices['use_size'] == 'inch' ? $size['label_inch'] : $size['label']); ?>
                                    </div>
                                    <div class="price-wrapper">
                                        <?php if ($size['regular']['old_price'] != $size['regular']['price']):?>
                                            <span class="old_price"><?php echo $prices['currency_symbol']; ?> <?php echo $size['regular']['old_price']; ?></span>
                                        <?php endif; ?>
                                        <?php echo $prices['currency_symbol']; ?> <span class="price"><?php echo $size['regular']['price']; ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="card-table__row custom-size-action">
                            <div><?php pll_e('Custom size'); ?></div>
                            <button class="js-show-custom"><?php pll_e('Click Here'); ?>
                                <svg width="4" height="12" viewBox="0 0 4 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6L0.25 11.1962L0.25 0.803848L4 6Z" fill="#F9AB97"/>
                                </svg>
                            </button>
                        </div>
                        <div class="card-table__row custom-size js-custom-size">
                            <div class="custom-size__fields">
                                <input type="number" class="js-size-width" data-min='<?php if ($prices['use_size'] == 'inch'):?>10<?php else: ?>25<?php endif;?>' data-max='<?php if ($prices['use_size'] == 'inch'):?>47<?php else: ?>120<?php endif;?>' placeholder="width">
                                <span>
                                      x
                                  </span>
                                <input type="number" class="js-size-height" data-min='<?php if ($prices['use_size'] == 'inch'):?>14<?php else: ?>35<?php endif;?>' data-max='<?php if ($prices['use_size'] == 'inch'):?>71<?php else: ?>180<?php endif;?>' placeholder="height">
                            </div>
                            <div>
                                <input type="text" class="js-size-result custom-size__result" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-massage">
                    </div>
                </div>

                <?php if (((isset($fields['choose_1']['title']) && $fields['choose_1']['title']) || (isset($fields['choose_1']['image']) && $fields['choose_1']['image'])) && ((isset($fields['choose_2']['title']) && $fields['choose_2']['title']) || (isset($fields['choose_2']['image']) && $fields['choose_2']['image']))):?>
                    <div class="choose__or"><?php pll_e('or');?></div>
                <?php endif; ?>

                <div class="choose-card choose__card choose-card--big-img">
                    <div class="choose-card__label">
                        <?php if (isset($fields['choose_2']['text_above_image']) && $fields['choose_2']['text_above_image']): ?>
                            <p><?php echo $fields['choose_2']['text_above_image'];?></p>
                        <?php endif; ?>
                    </div>
                    <div class="choose-card__picture">
                        <?php if (isset($fields['choose_2']['image']) && $fields['choose_2']['image']): ?>
                            <?php
                            if (is_array($fields['choose_2']['image'])) {
                                $image = $fields['choose_2']['image']['url'];
                            } else {
                                $image = wp_get_attachment_image_src($fields['choose_2']['image'], 'full');
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

                    <div class="choose-card__actions">
                        <?php if (isset($fields['choose_2']['title']) && $fields['choose_2']['title']): ?>
                            <div class="h6 choose-card-title"><?php echo $fields['choose_2']['title'];?></div>
                        <?php endif; ?>
                    </div>
                    <?php if ($prices['charcoal']): ?>
                        <div class="card-table m-t-65">
                            <h6 class="card-table__head">
                                <?php pll_e('Our prices starts at'); ?>
                            </h6>
                            <div class="row new-txt-size">
                                <div class="col-6"><?php pll_e('size'); ?></div>
                                <div class="col-6"><?php pll_e('price'); ?></div>
                            </div>
                            <?php foreach ($prices['charcoal']['sizes'] as $sizeKey => $size): ?>
                                <?php if ($size['available']): ?>
                                <div class="card-table__row js-size-options">
                                    <div class="widen-label">
                                        <?php
                                            if ($prices['use_size'] == 'inch') {
                                                $sizeInfo = $size['label_inch'];
                                                $sizeInfo = str_replace(['x', '"', ' '], ["-", '', ''], $sizeInfo);
                                                $sizeInfo = explode('-', $sizeInfo);
                                            } else {
                                                $sizeInfo = explode('-', $sizeKey);
                                            }
                                            $sizeInfo['width'] = isset($sizeInfo[0]) ? $sizeInfo[0] : 0;
                                            $sizeInfo['height'] = isset($sizeInfo[1]) ? $sizeInfo[1] : 0;
                                        ?>
                                        <span style="display: none;" class="width"><?php echo $sizeInfo['width']; ?></span>
                                        <span style="display: none;" class="height"><?php echo $sizeInfo['height']; ?></span>
                                        <?php echo ($prices['use_size'] == 'inch' ? $size['label_inch'] : $size['label']); ?>
                                    </div>
                                    <div class="price-wrapper">
                                        <?php if ($size['regular']['old_price'] != $size['regular']['price']):?>
                                            <span class="old_price"><?php echo $prices['currency_symbol']; ?> <?php echo $size['regular']['old_price']; ?></span>
                                        <?php endif; ?>
                                        <?php echo $prices['currency_symbol']; ?> <span class="price"><?php echo $size['regular']['price']; ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div class="card-table__row custom-size-action">
                                <div><?php pll_e('Custom size'); ?></div>
                                <button class="js-show-custom"><?php pll_e('Click Here'); ?>
                                    <svg width="4" height="12" viewBox="0 0 4 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 6L0.25 11.1962L0.25 0.803848L4 6Z" fill="#F9AB97"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="card-table__row custom-size js-custom-size">
                                <div class="custom-size__fields">
                                    <input type="number" class="js-size-width" data-min='<?php if ($prices['use_size'] == 'inch'):?>6<?php else: ?>14.8<?php endif;?>' data-max='<?php if ($prices['use_size'] == 'inch'):?>28<?php else: ?>70<?php endif;?>' placeholder="width">
                                    <span>
                                          x
                                      </span>
                                    <input type="number" class="js-size-height" data-min='<?php if ($prices['use_size'] == 'inch'):?>8<?php else: ?>21<?php endif;?>' data-max='<?php if ($prices['use_size'] == 'inch'):?>39<?php else: ?>100<?php endif;?>' placeholder="height">
                                </div>
                                <div>
                                    <input type="text" class="js-size-result custom-size__result" readonly>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card-massage">
                    </div>
                </div>
                <div class="new-title new-title-price">
                    <h4><?php pll_e('Pricing'); ?></h4>
                    <hr>
                </div>
            </div>
        </div>

        <?php if (!empty($duration)): ?>
            <div>
                <div class="new-title">
                    <h4 ><?php pll_e('Duration'); ?></h4>
                    <hr>
                </div>
                <table class="new-table-3">
                    <tr>
                        <td class="new-type-table"></td>
                        <?php foreach ($duration['all_locales']['durations']['painting_technique'] as $item): ?>
                            <td class="new-title-table"><?php echo $item['label'];?><br> (<?php echo $item['sub_label'];?>)</td>
                        <?php endforeach; ?>
                    </tr>
                    <tr id="new-table-collapse">
                        <td><?php pll_e('delivery type'); ?></td>
                        <td><?php pll_e('duration'); ?></td>
                        <td><?php pll_e('duration'); ?></td>
                        <td><?php pll_e('duration'); ?></td>
                    </tr>
                    <?php foreach ($duration['all_locales']['durations']['types'] as $type => $typeTitle): ?>
                        <tr>
                            <td><?php echo $typeTitle;?></td>
                            <?php foreach ($duration['all_locales']['durations']['painting_technique'] as $item): ?>
                                <td><?php echo  $item[$type]['label'];?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>

        <?php if (isset($fields['image']) && $fields['image']): ?>
            <?php
            if (is_array($fields['image'])) {
                $image = $fields['image']['url'];
            } else {
                $image = wp_get_attachment_image_src($fields['image'], 'full');
                if (isset($image[0]) && $image[0]) {
                    $image = $image[0];
                } else {
                    $image = null;
                }
            }
            ?>
            <?php if ($image):?>
                <!-- Start pricing-exp section -->
                <section class="section pricing-exp " style="background-image: url(<?php echo $image; ?>);">
                </section>
                <!-- End pricing-exp section -->
            <?php endif; ?>
        <?php endif; ?>
        <!-- Start name section -->
        <section class="section benefits benefits--gallery p-120" >
            <div class="benefits-inner benefits-inner--small">
                <?php if (isset($fields['benefits_for_you']['vertical_title']) && $fields['benefits_for_you']['vertical_title']): ?>
                    <div class="benefits__label">
                        <p class="vertical-label"><?php echo $fields['benefits_for_you']['vertical_title']; ?></p>
                    </div>
                <?php endif; ?>
                <?php if (isset($fields['benefits_for_you']['title']) && $fields['benefits_for_you']['title']): ?>
                    <h2 class="title benefits__title">
                        <?php echo $fields['benefits_for_you']['title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (isset($fields['benefits_for_you']['benefits']) && !empty($fields['benefits_for_you']['benefits'])): ?>
                    <ul class="benefits__list">
                        <?php foreach ($fields['benefits_for_you']['benefits'] as $promise): ?>
                            <?php if (isset($promise['title']) && $promise['title']): ?>
                                <li class="benefit-card">
                                    <?php if (isset($promise['svg_icon']) && $promise['svg_icon']): ?>
                                        <?php echo $promise['svg_icon']; ?>
                                    <?php endif; ?>
                                    <p class="h6 benefit-card__descr"><?php echo $promise['title']; ?></p>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="benefits__actions">
                    <a href="<?php the_url( (get_url_lang_prefix()) . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now');?></a>
                </div>
            </div>
        </section>
        <!-- End name section -->
    </div>
    <!--End page-->

<?php get_footer(); ?>
