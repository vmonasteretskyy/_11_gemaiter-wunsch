<?php

/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);
//test($fields);
get_header();
?>

<!-- Start preloader -->
<div class="preloader">
    <ul class="preloader__quote">
        <li><?php pll_e('We can'); ?></li>
        <li><?php pll_e('paint'); ?></li>
        <li><?php pll_e('your Desire'); ?></li>
    </ul>
    <div class="preloader__logo">
        <img src="<?php echo the_theme_path(); ?>/img/logo.png" alt="logo">
    </div>
</div> <!-- End preloader -->

<div id="fullpage">
    <!-- Start introduction section -->
    <section class="section first-section introduction ">
        <div class="section-inner introduction-inner">
            <div class="introduction__item">
                <?php
                $main_banner_1 = isset($fields['main_banner']) ? $fields['main_banner'] : '';
                $image = '';
                if ($main_banner_1) {
                    if (isset($main_banner_1['background_image']['sizes']['large']) && $main_banner_1['background_image']['sizes']['large']) {
                        $image = $main_banner_1['background_image']['sizes']['large'];
                    }
                }

                ?>
                <div class="item-bg" <?php if ($image): ?> style="background-image: url('<?php echo $image; ?>');" <?php endif;?> >
                </div>
                <div class="introduction-descr">
                    <div class="introduction-descr_img">
                        <img src="<?php echo the_theme_path(); ?>/img/logo_main_home.svg">
                    </div>
                    <?php if (isset($main_banner_1['list']) && !empty($main_banner_1['list'])): ?>
                    <ul class="introduction-descr__list">
                        <?php foreach ($main_banner_1['list'] as $item): ?>
                            <?php if (isset($item['text']) && !empty($item['text'])): ?>
                                <li><?php echo $item['text']; ?></li>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </ul>
                    <?php endif; ?>
                    <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border introduction-descr__btn"><?php pll_e('Order Now');?></a>
                </div>
            </div>
            <div class="introduction__item video-with-control">
                <?php
                $main_banner_2 = isset($fields['main_banner_2']) ? $fields['main_banner_2'] : '';
                $image = '';
                if ($main_banner_2) {
                    if (isset($main_banner_2['background_image']['sizes']['large']) && $main_banner_2['background_image']['sizes']['large']) {
                        $image = $main_banner_2['background_image']['sizes']['large'];
                    }
                }

                ?>
                <video width="100%" height="100%" <?php if ($image): ?> poster="<?php echo $image; ?>" <?php endif;?> >
                    <?php if (isset($main_banner_2['video']['url']) && !empty($main_banner_2['video']['url'])) : ?>
                        <source src="<?php echo $main_banner_2['video']['url'];?>" type="<?php echo $main_banner_2['video']['mime_type'];?>">
                    <?php endif;?>
                    <?php pll_e('Your browser does not support the video tag.'); ?>
                </video>
                <div class="video-control"></div>
            </div>
            <div class="introduction__item">
                <div class="item-descr">
                    <?php if (isset($main_banner_1['intro_title_mobile']) && !empty($main_banner_1['intro_title_mobile'])): ?>
                        <h2 class="item-descr__title h5">
                            <?php echo $main_banner_1['intro_title_mobile'];?>
                        </h2>
                    <?php endif;?>
                    <?php if (isset($main_banner_1['intro_subtitle_mobile']) && !empty($main_banner_1['intro_subtitle_mobile'])): ?>
                        <p>
                            <?php echo $main_banner_1['intro_subtitle_mobile'];?>
                        </p>
                    <?php endif;?>
                    <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now');?></a>
                </div>
            </div>
            <div class="introduction__item">
                <?php
                $main_banner_3 = isset($fields['main_banner_3']) ? $fields['main_banner_3'] : '';;
                $image = '';
                if ($main_banner_3) {
                    if (isset($main_banner_3['background_image']['sizes']['large']) && $main_banner_3['background_image']['sizes']['large']) {
                        $image = $main_banner_3['background_image']['sizes']['large'];
                    }
                }
                ?>
                <?php if ($image):?>
                    <img src="<?php echo $image; ?>" alt="">
                <?php endif;?>
            </div>
        </div>

        <div class="introduction__scroll">
            <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="10" height="17" rx="3.5" stroke="#333333" />
                <ellipse cx="5.5" cy="6" rx="1.5" ry="2" fill="#333333" />
            </svg>
            <?php pll_e('Scroll down to see more'); ?>
        </div>
    </section>
    <!-- End introduction section -->
    <?php
        $screen2Data = [
            'title' => isset($fields['screen_2_title']) ? $fields['screen_2_title'] : null,
            'screen_2_subtitle' => isset($fields['screen_2_subtitle']) ? $fields['screen_2_subtitle'] : null,
            'screen_2_subtitle_text' => isset($fields['screen_2_subtitle_text']) ? $fields['screen_2_subtitle_text'] : null,
            'screen_2_slider_title' => isset($fields['screen_2_subtitle_main']) ? $fields['screen_2_subtitle_main'] : null,
            'screen_2_slider' => isset($fields['screen_2_slider']) ? $fields['screen_2_slider'] : null,
            'screen_2_vertical_title' => isset($fields['screen_2_vertical_title']) ? $fields['screen_2_vertical_title'] : null,
        ];
    ?>
    <?php if ($screen2Data['title'] || $screen2Data['screen_2_subtitle'] || $screen2Data['screen_2_subtitle_text'] || !empty($screen2Data['screen_2_slider'])): ?>
        <!-- Start our-gallery section -->
        <section class="section our-gallery ">
            <div class="section-inner">
                <div class="our-gallery-inner">
                    <?php if($screen2Data['title']): ?>
                        <h1 class="h2 title title--with-icon our-gallery__title">
                            <?php echo $screen2Data['title']; ?>
                            <!-- Our Gallery -->
                        </h1>
                    <?php endif; ?>
                    <?php if($screen2Data['screen_2_subtitle'] || $screen2Data['screen_2_subtitle_text']): ?>
                        <div class="our-gallery__descr">
                            <?php if($screen2Data['screen_2_subtitle']): ?>
                                <p><?php echo $screen2Data['screen_2_subtitle']; ?></p>
                            <?php endif; ?>
                            <?php if($screen2Data['screen_2_subtitle_text']): ?>
                                <p><?php echo $screen2Data['screen_2_subtitle_text']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if($screen2Data['screen_2_slider_title'] || !empty($screen2Data['screen_2_slider'])): ?>
                        <div class="gallery-slider our-gallery__slider">
                            <?php if($screen2Data['screen_2_slider_title']): ?>
                                <h3 class="h5 gallery-slider__title">
                                    <?php echo $screen2Data['screen_2_slider_title']; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if(!empty($screen2Data['screen_2_slider'])): ?>
                                <div class="gallery-slider__inner">
                                    <div class="swiper-container">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                                            <?php if ($screen2Data['screen_2_vertical_title']): ?>
                                                <div class="swiper-slide gallery-slider__item--small">
                                                    <p class="vertical-label"> <?php echo $screen2Data['screen_2_vertical_title']; ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php foreach($screen2Data['screen_2_slider'] as $slide): ?>
                                                <a href="<?php if (isset($slide['url']) && $slide['url']): ?><?php echo $slide['url']; ?><?php else:?>#<?php endif;?>" class="swiper-slide gallery-slider__item" style="background-image: url('<?php if ($slide['image']){echo $slide['image']['sizes']['slider'];} ?>');">
                                                    <?php if (isset($slide['text']) && $slide['text']): ?>
                                                        <h4 class="h5 title"><?php echo $slide['text']; ?></h4>
                                                    <?php endif; ?>
                                                    <div class="btn btn--card-link btn--accent"></div>
                                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="317" height="413" fill="none" />
                                                    </svg>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="slider-progressbar-line">
                                        <div class="slider_progress_wrap">
                                            <div class="slider_progress">
                                                <div class="slider_progress_pointer"></div>
                                            </div>
                                        </div>
                                        <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now');?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <!-- End our-gallery section -->
    <?php endif; ?>
    <?php
        $screen3Data = [
            'screen_3_slider_title' => isset($fields['screen_3_subtitle']) ? $fields['screen_3_subtitle'] : null,
            'screen_3_slider' => isset($fields['screen_3_slider']) ? $fields['screen_3_slider'] : null,
            'screen_3_vertical_title' => isset($fields['screen_3_vertical_title']) ? $fields['screen_3_vertical_title'] : null,
        ];
    ?>
    <?php if ($screen3Data['screen_3_slider_title'] || !empty($screen2Data['screen_3_slider'])): ?>
        <!-- Start our-gallery section -->
        <section class="section our-gallery our-gallery--big-padding">
            <div class="section-inner">
                <div class="our-gallery-inner">
                    <div class="gallery-slider our-gallery__slider">
                        <?php if($screen3Data['screen_3_slider_title']): ?>
                            <h3 class="h5 gallery-slider__title">
                                <?php echo $screen3Data['screen_3_slider_title']; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if(!empty($screen3Data['screen_3_slider'])): ?>
                            <div class="gallery-slider__inner">
                                <div class="swiper-container">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <?php if ($screen3Data['screen_3_vertical_title']): ?>
                                            <div class="swiper-slide gallery-slider__item--small">
                                                <p class="vertical-label"> <?php echo $screen3Data['screen_3_vertical_title']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php foreach($screen3Data['screen_3_slider'] as $slide): ?>
                                            <a href="<?php if (isset($slide['url']) && $slide['url']): ?><?php echo $slide['url']; ?><?php else:?>#<?php endif;?>" class="swiper-slide gallery-slider__item" style="background-image: url('<?php if ($slide['image']){echo $slide['image']['sizes']['slider'];} ?>');">
                                                <?php if (isset($slide['text']) && $slide['text']): ?>
                                                    <h4 class="h5 title"><?php echo $slide['text']; ?></h4>
                                                <?php endif; ?>
                                                <div class="btn btn--card-link btn--accent"></div>
                                                <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="317" height="413" fill="none" />
                                                </svg>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="slider-progressbar-line">
                                    <div class="slider_progress_wrap">
                                        <div class="slider_progress">
                                            <div class="slider_progress_pointer"></div>
                                        </div>
                                    </div>
                                    <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now');?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End our-gallery section -->
    <?php endif; ?>
    <?php
    $screen4Data = [
        'screen_4_title' => isset($fields['screen_4_title']) ? $fields['screen_4_title'] : null,
        'screen_4_subtitle' => isset($fields['screen_4_subtitle']) ? $fields['screen_4_subtitle'] : null,
        'screen_4_vertical_title' => isset($fields['screen_4_vertical_title']) ? $fields['screen_4_vertical_title'] : null,
        'screen_4_choose_1_title' => isset($fields['screen_4_choose_1_title']) ? $fields['screen_4_choose_1_title'] : null,
        'screen_4_choose_1_text_above_image' => isset($fields['screen_4_choose_1_text_above_image']) ? $fields['screen_4_choose_1_text_above_image'] : null,
        'screen_4_choose_1_image' => isset($fields['screen_4_choose_1_image']) ? $fields['screen_4_choose_1_image'] : null,
        'screen_4_choose_1_URL' => isset($fields['screen_4_choose_1_URL']) ? $fields['screen_4_choose_1_URL'] : null,
        'screen_4_choose_2_title' => isset($fields['screen_4_choose_2_title']) ? $fields['screen_4_choose_2_title'] : null,
        'screen_4_choose_2_text_above_image' => isset($fields['screen_4_choose_2_text_above_image']) ? $fields['screen_4_choose_2_text_above_image'] : null,
        'screen_4_choose_2_image' => isset($fields['screen_4_choose_2_image']) ? $fields['screen_4_choose_2_image'] : null,
        'screen_4_choose_2_URL' => isset($fields['screen_4_choose_2_URL']) ? $fields['screen_4_choose_2_URL'] : null,
    ];
    ?>
    <?php if ($screen4Data['screen_4_title'] || $screen4Data['screen_4_subtitle'] || $screen4Data['screen_4_choose_1_title'] || $screen4Data['screen_4_choose_1_image']|| $screen4Data['screen_4_choose_2_title'] || $screen4Data['screen_4_choose_2_image']): ?>
        <!-- Start choose section -->
        <section class="section choose ">
            <div class="section-inner">
                <div class="choose-inner">
                    <?php if ($screen4Data['screen_4_vertical_title']): ?>
                        <div class="choose__label">
                            <p class="vertical-label"><?php echo $screen4Data['screen_4_vertical_title']; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($screen4Data['screen_4_title'] || $screen4Data['screen_4_subtitle']): ?>
                        <div class="choose__text">
                            <?php if ($screen4Data['screen_4_title']): ?>
                                <h2 class="title ">
                                    <?php echo $screen4Data['screen_4_title']; ?>
                                </h2>
                            <?php endif; ?>
                            <?php if ($screen4Data['screen_4_subtitle']): ?>
                                <p><?php echo $screen4Data['screen_4_subtitle']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="choose-cards">
                        <?php if ($screen4Data['screen_4_choose_1_title'] || $screen4Data['screen_4_choose_1_image']):?>
                            <a href="<?php if ($screen4Data['screen_4_choose_1_URL']): ?><?php echo $screen4Data['screen_4_choose_1_URL'];?><?php else:?>#<?php endif;?>" class="choose-card choose__card">
                                <div class="choose-card__label">
                                    <?php if ($screen4Data['screen_4_choose_1_text_above_image']): ?>
                                        <p><?php echo $screen4Data['screen_4_choose_1_text_above_image'];?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="choose-card-props">
                                    <div class="choose-card__prop"><?php pll_e('Classic');?></div>
                                    <div class="choose-card__prop"><?php pll_e('Emphasize All Colours');?></div>
                                    <div class="choose-card__prop"><?php pll_e('High Effort');?></div>
                                </div>
                                <div class="choose-card__picture">
                                    <?php if ($screen4Data['screen_4_choose_1_image']): ?>
                                        <img src="<?php echo $screen4Data['screen_4_choose_1_image']['url']; ?>" alt="<?php echo $screen4Data['screen_4_choose_1_title'];?>">
                                    <?php endif; ?>
                                </div>
                                <div class="choose-card__actions">
                                    <?php if ($screen4Data['screen_4_choose_1_title']): ?>
                                        <div class="h6 choose-card-title"><?php echo $screen4Data['screen_4_choose_1_title'];?></div>
                                    <?php endif; ?>
                                    <div class="choose-card-more">
                                        <?php pll_e('See More');?>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (($screen4Data['screen_4_choose_1_title'] || $screen4Data['screen_4_choose_1_image']) && ($screen4Data['screen_4_choose_2_title'] || $screen4Data['screen_4_choose_2_image'])):?>
                            <div class="choose__or"><?php pll_e('or');?></div>
                        <?php endif; ?>
                        <?php if ($screen4Data['screen_4_choose_2_title'] || $screen4Data['screen_4_choose_2_image']):?>
                            <a href="<?php if ($screen4Data['screen_4_choose_2_URL']): ?><?php echo $screen4Data['screen_4_choose_2_URL'];?><?php else:?>#<?php endif;?>" class="choose-card choose__card choose-card--tb-90 choose-card--pr-120">
                                <div class="choose-card__label">
                                    <?php if ($screen4Data['screen_4_choose_2_text_above_image']): ?>
                                        <p><?php echo $screen4Data['screen_4_choose_2_text_above_image'];?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="choose-card-props">
                                    <div class="choose-card__prop"><?php pll_e('Classic');?></div>
                                    <div class="choose-card__prop"><?php pll_e('Emphasize All Colours');?></div>
                                    <div class="choose-card__prop"><?php pll_e('High Effort');?></div>
                                </div>
                                <div class="choose-card__picture">
                                    <?php if ($screen4Data['screen_4_choose_2_image']): ?>
                                        <img src="<?php echo $screen4Data['screen_4_choose_2_image']['url']; ?>" alt="<?php echo $screen4Data['screen_4_choose_2_title'];?>">
                                    <?php endif; ?>
                                </div>
                                <div class="choose-card__actions">
                                    <?php if ($screen4Data['screen_4_choose_2_title']): ?>
                                        <div class="h6 choose-card-title"><?php echo $screen4Data['screen_4_choose_2_title'];?></div>
                                    <?php endif; ?>
                                    <div class="choose-card-more">
                                        <?php pll_e('See More');?>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End choose section -->
    <?php endif; ?>
    <?php
    $screen5Data = [
        'screen_5_title' => isset($fields['screen_5_title']) ? $fields['screen_5_title'] : null,
        'screen_5_promises' => isset($fields['screen_5_promises']) ? $fields['screen_5_promises'] : null,
        'screen_5_vertical_title' => isset($fields['screen_5_vertical_title']) ? $fields['screen_5_vertical_title'] : null,
    ];
    ?>
    <?php if ($screen5Data['screen_5_title'] || !empty($screen5Data['screen_5_promises'])): ?>
        <!-- Start name section -->
        <section class="section benefits ">
            <div class="benefits-inner">
                <?php if ($screen5Data['screen_5_vertical_title']): ?>
                    <div class="benefits__label">
                        <p class="vertical-label"><?php echo $screen5Data['screen_5_vertical_title']; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ($screen5Data['screen_5_title']): ?>
                    <h2 class="title benefits__title">
                        <?php echo $screen5Data['screen_5_title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($screen5Data['screen_5_promises'])): ?>
                    <ul class="benefits__list">
                        <?php foreach ($screen5Data['screen_5_promises'] as $promise): ?>
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
                    <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now');?></a>
                </div>
            </div>
        </section>
        <!-- End name section -->
    <?php endif; ?>

    <?php
    $ourArtistsSettings = get_field('our_artist_settings_' . $current_lang, 'option');
    $screen6Data = [
        'screen_6_title' => isset($ourArtistsSettings['title']) ? $ourArtistsSettings['title'] : null,
        'screen_6_artists' => isset($ourArtistsSettings['artists']) ? $ourArtistsSettings['artists'] : null,
        'screen_6_vertical_title' => isset($ourArtistsSettings['vertical_title']) ? $ourArtistsSettings['vertical_title'] : null,
    ];
    ?>
    <?php if ($screen6Data['screen_6_title'] || !empty($screen6Data['screen_6_artists'])): ?>
        <!-- Start team section -->
        <section class="section team ">
            <div class="section-inner team-inner">
                <?php if ($screen6Data['screen_6_vertical_title']): ?>
                    <div class="team__label">
                        <p class="vertical-label"><?php echo $screen6Data['screen_6_vertical_title']; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ($screen6Data['screen_6_title']): ?>
                    <h2 class="team__title">
                        <?php echo $screen6Data['screen_6_title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($screen6Data['screen_6_artists'])): ?>
                    <!-- Swiper -->
                    <div class="team-slider-wrap">
                        <div class="team__picture-slider-wrap">
                            <div class="swiper-container team__picture-slider">
                                <div class="swiper-wrapper">
                                    <?php foreach ($screen6Data['screen_6_artists'] as $artist): ?>
                                        <?php if ((isset($artist['name']) && $artist['name']) || (isset($artist['quote']) && $artist['quote']) || (isset($artist['text']) && $artist['text']) || (isset($artist['image']) && $artist['image'])): ?>
                                            <div class="swiper-slide member__photo">
                                                <div class="member__img_wrap">
                                                    <?php if ((isset($artist['image']) && $artist['image'])): ?>
                                                        <?php
                                                            if (is_array($artist['image'])) {
                                                                $image = $artist['image']['url'];
                                                            } else {
                                                                $image = wp_get_attachment_image_src($artist['image'], 'full');
                                                                if (isset($image[0]) && $image[0]) {
                                                                    $image = $image[0];
                                                                } else {
                                                                    $image = null;
                                                                }
                                                            }
                                                        ?>
                                                        <?php if ($image):?>
                                                            <img src="<?php echo $image;?>" alt="<?php echo $artist['name']; ?>">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="member__text_wrap">
                                                    <div class="member__dectp_description">
                                                        <?php if ((isset($artist['name']) && $artist['name'])): ?>
                                                            <h3 class="h5 member__title">
                                                                <?php echo $artist['name']; ?>
                                                            </h3>
                                                        <?php endif; ?>
                                                        <?php if ((isset($artist['name']) && $artist['name'])): ?>
                                                            <div class="member__quote">
                                                                <i><?php echo $artist['quote']; ?></i>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if ((isset($artist['text']) && $artist['text'])): ?>
                                                        <p>
                                                            <?php echo $artist['text']; ?>
                                                        </p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                <?php endif; ?>
            </div>
        </section>
        <!-- End team section -->
    <?php endif; ?>
    <?php
    $screen7Data = [
        'screen_7_title' => isset($fields['screen_7_title']) ? $fields['screen_7_title'] : null,
        'screen_7_customers' => isset($fields['screen_7_customers']) ? $fields['screen_7_customers'] : null,
        'screen_7_vertical_title' => isset($fields['screen_7_vertical_title']) ? $fields['screen_7_vertical_title'] : null,
    ];
    ?>
    <?php if ($screen7Data['screen_7_title'] || !empty($screen7Data['screen_7_customers'])): ?>
        <!-- Start name section -->
        <section class="section img-text ">
        <div class="section-inner">

            <div class="img-text-inner">
                <?php if ($screen7Data['screen_7_vertical_title']): ?>
                    <div class="img-text__label">
                        <p class="vertical-label"><?php echo $screen7Data['screen_7_vertical_title']; ?></p>
                    </div>
                <?php endif; ?>
                <?php if ($screen7Data['screen_7_title']): ?>
                    <h2 class="title img-text__title">
                        <?php echo $screen7Data['screen_7_title']; ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($screen7Data['screen_7_customers'])): ?>
                <!-- Swiper -->
                    <div class="swiper-container img-text-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($screen7Data['screen_7_customers'] as $customer): ?>
                                <?php if ((isset($customer['title']) && $customer['title']) || (isset($customer['subtitle']) && $customer['subtitle']) || (isset($customer['text']) && $customer['text']) || (isset($customer['image']) && $customer['image'])): ?>
                                    <div class="swiper-slide img-text-item">
                                        <div class="img-text-row">
                                            <?php if ((isset($customer['image']) && $customer['image'])): ?>
                                                <img src="<?php echo $customer['image']['url']; ?>" alt="<?php echo $customer['title']; ?>">
                                            <?php endif; ?>
                                            <div class="img-text__descr">
                                                <?php if ((isset($customer['title']) && $customer['title'])): ?>
                                                    <h3 class="title h5">
                                                        <?php echo $customer['title']; ?>
                                                    </h3>
                                                <?php endif; ?>
                                                <?php if ((isset($customer['subtitle']) && $customer['subtitle'])): ?>
                                                    <p class="sub-title">
                                                        <?php echo $customer['subtitle']; ?>
                                                    </p>
                                                <?php endif; ?>
                                                <?php if ((isset($customer['text']) && $customer['text'])): ?>
                                                    <?php
                                                        $textParts = explode("---", $customer['text']);
                                                        $customer['text_first_part'] = isset($textParts[0]) ? $textParts[0] : '';
                                                        $customer['text_second_part'] = isset($textParts[1]) ? $textParts[1] : '';
                                                    ?>
                                                    <p>
                                                        <?php echo $customer['text_first_part']; ?>
                                                        <?php if ((isset($customer['text_second_part']) && $customer['text_second_part'])): ?>
                                                            <span class="more_text">
                                                                <?php echo $customer['text_second_part']; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <button id="toggle"><?php pll_e('Read More');?></button>
                    <div class="img-text-slider__pagination"></div>
                <?php endif; ?>

                <div class="img-text__actions">
                    <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now');?></a>
                </div>
            </div>
        </div>

    </section>
<?php endif; ?>

<?php get_footer(); ?>