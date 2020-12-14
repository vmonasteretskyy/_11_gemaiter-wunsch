<?php

/**
 * Template Name: About Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);

get_header();
?>

    <!--Start page-->
    <div class="page-wrapper">
        <?php
        $screen1Data = [
            'screen_1_title' => isset($fields['hero_title']) ? $fields['hero_title'] : null,
            'screen_1_subtitle' => isset($fields['hero_subtitle']) ? $fields['hero_subtitle'] : null,
            'screen_1_images' => isset($fields['hero_images']) ? $fields['hero_images'] : null,
        ];
        ?>
        <?php if ($screen1Data['screen_1_title'] || !empty($screen1Data['screen_1_subtitle'])|| !empty($screen1Data['screen_1_images'])): ?>
            <!-- Start about-intro section -->
            <section class="section about-intro " >
                <div class="container-small">
                    <div class="about-intro-inner">
                        <div class="about-intro__left">
                            <?php if ($screen1Data['screen_1_title']): ?>
                                <h2 class="about-intro__title">
                                    <?php echo $screen1Data['screen_1_title']; ?>
                                </h2>
                            <?php endif; ?>
                            <?php if ($screen1Data['screen_1_subtitle']): ?>
                                <p>
                                    <?php echo $screen1Data['screen_1_subtitle']; ?>
                                </p>
                            <?php endif; ?>
                            <a href="<?php the_url( (get_url_lang_prefix()) . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now'); ?></a>
                        </div>
                        <?php if (!empty($screen1Data['screen_1_images'])): ?>
                        <div class="about-intro__right">
                            <!-- Slider main container -->
                            <div class="swiper-container a-inner-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <?php
                                        $imagesSlides = array_chunk($screen1Data['screen_1_images'], 4);
                                    ?>
                                    <?php foreach ($imagesSlides as $slide): ?>
                                        <div class="swiper-slide">
                                            <div class="a-inner-slider__item">
                                                <?php foreach ($slide as $item): ?>
                                                    <?php
                                                    if (is_array($item['image'])) {
                                                        $image = $item['image']['url'];
                                                    } else {
                                                        $image = wp_get_attachment_image_src($item['image'], 'full');
                                                        if (isset($image[0]) && $image[0]) {
                                                            $image = $image[0];
                                                        } else {
                                                            $image = null;
                                                        }
                                                    }
                                                    ?>
                                                    <?php if ($image): ?>
                                                        <div class="picture">
                                                            <img src="<?php echo $image; ?>" alt="">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination a-inner-slider__pagination"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!-- End about-intro section -->
        <?php endif; ?>
        <?php
        $screen2Data = [
            'screen_2_title' => isset($fields['our_story_title']) ? $fields['our_story_title'] : null,
            'screen_2_vertical_title' => isset($fields['our_story_vertical_title']) ? $fields['our_story_vertical_title'] : null,
            'screen_2_history' => isset($fields['our_story_history']) ? $fields['our_story_history'] : null,
            'screen_2_description' => isset($fields['our_story_description']) ? $fields['our_story_description'] : null,
        ];
        ?>
        <?php if ($screen2Data['screen_2_title'] || !empty($screen2Data['screen_2_description'])|| !empty($screen2Data['screen_2_history'])): ?>
            <!-- Start img-text-mod section -->
            <section class="section img-text-mod our-story-bg" >
                <?php if ($screen2Data['screen_2_title']): ?>
                    <h5 class="h5 title--under-line img-text-mod__title">
                        <?php echo $screen2Data['screen_2_title']; ?>
                    </h5>
                <?php endif; ?>
                <div class="container-small">
                    <div class="img-text-mod-inner">
                        <div class="img-text-mod__left">
                            <?php if ($screen2Data['screen_2_vertical_title']): ?>
                                <div class="img-text-mod-label">
                                    <p class="vertical-label"><?php echo $screen2Data['screen_2_vertical_title']; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($screen2Data['screen_2_history'])): ?>
                                <div class="our-history img-text-mod-transform">
                                    <?php foreach ($screen2Data['screen_2_history'] as $item): ?>
                                        <?php if (isset($item['year']) && $item['year'] && isset($item['title']) && $item['title']): ?>
                                            <div class="our-history__item">
                                                <span>
                                                    <?php echo $item['year']; ?>
                                                </span>
                                                <p><?php echo $item['title']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="img-text-mod__right">
                            <?php if ($screen2Data['screen_2_description']): ?>
                                <div class="text">
                                    <?php echo $screen2Data['screen_2_description']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End img-text-mod section -->
        <?php endif; ?>
        <?php
        $screen3Data = [
            'screen_3_title' => isset($fields['our_mission_title']) ? $fields['our_mission_title'] : null,
            'screen_3_vertical_title' => isset($fields['our_mission_vertical_title']) ? $fields['our_mission_vertical_title'] : null,
            'screen_3_description' => isset($fields['our_mission_description']) ? $fields['our_mission_description'] : null,
            'screen_3_image' => isset($fields['our_mission_image']) ? $fields['our_mission_image'] : null,
        ];
        ?>
        <?php if ($screen3Data['screen_3_title'] || !empty($screen3Data['screen_3_description'])): ?>
            <!-- Start img-text-mod section -->
            <section class="section img-text-mod img-text-mod--revers img-text-mod--right-gray p-t-120" >
                <?php if ($screen3Data['screen_3_title']): ?>
                    <h5 class="h5 title--under-line img-text-mod__title">
                        <?php echo $screen3Data['screen_3_title']; ?>
                    </h5>
                <?php endif; ?>
                <div class="container-small">
                    <div class="img-text-mod-inner">
                        <div class="img-text-mod__left">
                            <?php if ($screen3Data['screen_3_vertical_title']): ?>
                                <div class="img-text-mod-label">
                                    <p class="vertical-label"><?php echo $screen3Data['screen_3_vertical_title']; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if ($screen3Data['screen_3_image']): ?>
                                <?php
                                if (is_array($screen3Data['screen_3_image'])) {
                                    $image = $screen3Data['screen_3_image']['url'];
                                } else {
                                    $image = wp_get_attachment_image_src($screen3Data['screen_3_image'], 'full');
                                    if (isset($image[0]) && $image[0]) {
                                        $image = $image[0];
                                    } else {
                                        $image = null;
                                    }
                                }
                                ?>
                                <?php if ($image):?>
                                    <div class="img-text-mod__picture img-text-mod-transform">
                                        <img src="<?php echo $image;?>" alt="">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="img-text-mod__right">
                            <?php if ($screen3Data['screen_3_description']): ?>
                                <div class="text">
                                    <?php echo $screen3Data['screen_3_description']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End img-text-mod section -->
        <?php endif; ?>
        <?php
        $screen4Data = [
            'screen_4_title' => isset($fields['our_plans_title']) ? $fields['our_plans_title'] : null,
            'screen_4_vertical_title' => isset($fields['our_plans_vertical_title']) ? $fields['our_plans_vertical_title'] : null,
            'screen_4_description' => isset($fields['our_plans_description']) ? $fields['our_plans_description'] : null,
            'screen_4_image' => isset($fields['our_plans_image']) ? $fields['our_plans_image'] : null,
        ];
        ?>
        <?php if ($screen4Data['screen_4_title'] || !empty($screen4Data['screen_4_description'])): ?>
            <!-- Start img-text-mod section -->
            <section class="section img-text-mod img-text-mod img-text-mod--gray p-t-120 p-b-65" >
                <?php if ($screen4Data['screen_4_title']): ?>
                    <h5 class="h5 title--under-line img-text-mod__title">
                        <?php echo $screen4Data['screen_4_title']; ?>
                    </h5>
                <?php endif; ?>
                <div class="container-small">
                    <div class="img-text-mod-inner">
                        <div class="img-text-mod__left">
                            <?php if ($screen4Data['screen_4_vertical_title']): ?>
                                <div class="img-text-mod-label">
                                    <p class="vertical-label"><?php echo $screen4Data['screen_4_vertical_title']; ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if ($screen4Data['screen_4_image']): ?>
                                <?php
                                if (is_array($screen4Data['screen_4_image'])) {
                                    $image = $screen4Data['screen_4_image']['url'];
                                } else {
                                    $image = wp_get_attachment_image_src($screen4Data['screen_4_image'], 'full');
                                    if (isset($image[0]) && $image[0]) {
                                        $image = $image[0];
                                    } else {
                                        $image = null;
                                    }
                                }
                                ?>
                                <?php if ($image):?>
                                    <div class="img-text-mod__picture img-text-mod-transform">
                                        <img src="<?php echo $image;?>" alt="">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="img-text-mod__right">
                            <?php if ($screen4Data['screen_4_description']): ?>
                                <div class="text">
                                    <?php echo $screen4Data['screen_4_description']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="img-text-mod__action">
                    <a href="<?php the_url( (get_url_lang_prefix()) . 'order/');?>" class="btn btn--accent-border"><?php pll_e('I Want It'); ?></a>
                </div>
            </section>
            <!-- End img-text-mod section -->
        <?php endif; ?>
        <?php
        $ourArtistsSettings = get_field('our_artist_settings_' . $current_lang, 'option');
        $screen5Data = [
            'screen_5_title' => isset($ourArtistsSettings['title']) ? $ourArtistsSettings['title'] : null,
            'screen_5_artists' => isset($ourArtistsSettings['artists']) ? $ourArtistsSettings['artists'] : null,
            'screen_5_vertical_title' => isset($ourArtistsSettings['vertical_title']) ? $ourArtistsSettings['vertical_title'] : null,
        ];
        ?>
        <?php if ($screen5Data['screen_5_title'] || !empty($screen5Data['screen_5_artists'])): ?>
            <!-- Start team section -->
            <section class="section team m-t-90" >
                <div class="section-inner team-inner">
                    <?php if ($screen5Data['screen_5_vertical_title']): ?>
                        <div class="team__label">
                            <p class="vertical-label"><?php echo $screen5Data['screen_5_vertical_title']; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($screen5Data['screen_5_title']): ?>
                        <h2 class="team__title">
                            <?php echo $screen5Data['screen_5_title']; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if (!empty($screen5Data['screen_5_artists'])): ?>
                        <!-- Swiper -->
                        <div class="team-slider-wrap">
                            <div class="team__picture-slider-wrap">
                                <div class="swiper-container team__picture-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($screen5Data['screen_5_artists'] as $artist): ?>
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
    </div>
    <!--End page-->

<?php get_footer(); ?>