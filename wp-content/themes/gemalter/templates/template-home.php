<?php

/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>



<!-- Start preloader -->
<div class="preloader">
    <ul class="preloader__quote">
        <li>We can</li>
        <li>paint</li>
        <li>your Desire</li>
    </ul>
    <div class="preloader__logo">
        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="logo">
    </div>
</div> <!-- End preloader -->



<div id="fullpage">
    <!-- Start introduction section -->
    <!-- Start introduction section -->
    <section class="section first-section introduction ">
        <div class="section-inner introduction-inner">
            <div class="introduction__item">
                <?php

                $main_banner_1 = get_field('main_banner');
                $image = '';

                if ($main_banner_1) {
                    $tmp_image = $main_banner_1['background_image'];

                    if ($tmp_image) {
                        $image = $tmp_image['sizes']['large'];
                    }
                }

                ?>
                <div class="item-bg" style="background-image: url('<?php echo $image; ?>');">
                </div>
                <div class="introduction-descr">
                    <div class="introduction-descr_img">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo_main_home.svg">
                    </div>
                    <ul class="introduction-descr__list">
                        <?php

                        if ($main_banner_1) {
                            $rows = get_sub_field('list');
                            if ($test['list']) {
                                foreach ($test['list'] as $row) {
                                    echo '<li>';
                                    echo $row['text'];
                                    echo '</li>';
                                }
                            }
                        }

                        ?>
                    </ul>
                    <a href="#" class="btn btn--accent-border introduction-descr__btn">Order Now</a>
                </div>
            </div>
            <div class="introduction__item video-with-control">

                <?php

                $main_banner_2 = get_field('main_banner_2');

                $image2 = '';

                if ($main_banner_2) {
                    $tmp_image = $main_banner_2['background_image'];

                    if ($tmp_image) {
                        $image2 = $tmp_image['sizes']['large'];
                    }
                }

                ?>
                <video width="100%" height="100%" poster="<?php echo $image2; ?>">
                    <source src="video/intro-v-3.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="video-control"></div>
            </div>
            <div class="introduction__item">
                <div class="item-descr">
                    <h2 class="item-descr__title h5">
                        Transform Your Photo Into an Awesome Portrait
                    </h2>
                    <p>
                        Handmade Portraits by the Best Artists in the World
                    </p>
                    <a href="#" class="btn btn--accent-border">Order Now</a>
                </div>
            </div>
            <div class="introduction__item">
                <?php

                $main_banner_3 = get_field('main_banner_3');

                $image3 = '';

                if ($main_banner_3) {
                    $tmp_image = $main_banner_3['background_image'];

                    if ($tmp_image) {
                        $image3 = $tmp_image['sizes']['large'];
                    }
                }

                ?>
                <img src="<?php echo $image3; ?>" alt="">
            </div>

        </div>

        <div class="introduction__scroll">
            <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="10" height="17" rx="3.5" stroke="#333333" />
                <ellipse cx="5.5" cy="6" rx="1.5" ry="2" fill="#333333" />
            </svg>
            Scroll down to see more
        </div>
    </section>
    <!-- End introduction section -->
    <!-- End introduction section -->
    <!-- Start our-gallery section -->
    <section class="section our-gallery ">
        <div class="section-inner">

            <div class="our-gallery-inner">

                <h1 class="h2 title title--with-icon our-gallery__title">

                    <?php echo get_field('screen_2_title'); ?>
                    <!-- Our Gallery -->
                </h1>

                <div class="our-gallery__descr">
                    <p>
                        <?php
                        echo get_field('screen_2_subtitle');
                        ?>
                    </p>
                    <p>
                        <?php
                        echo get_field('screen_2_subtitle_text');
                        ?>
                    </p>
                </div>

                <div class="gallery-slider our-gallery__slider">
                    <h3 class="h5 gallery-slider__title">
                        Oil Portraits
                    </h3>


                    <div class="gallery-slider__inner">
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide gallery-slider__item--small">
                                    <p class="vertical-label"> take a look</p>
                                </div>
                                <?php
                                $rows = get_field('oil_slider');
                                if ($rows) {
                                    foreach ($rows as $row) {
                                ?>
                                        <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php if ($row['image']) echo wp_get_attachment_image_src($row['image']['ID'], 'slider')[0]; ?>);">
                                            <h4 class="h5 title"><?php echo $row['text']; ?></h4>
                                            <div class="btn btn--card-link btn--accent"></div>

                                            <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="317" height="413" fill="none" />
                                            </svg>
                                        </a>
                                <?php
                                    }
                                }
                                ?>
                                <!-- <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-1-min.jpg);">
                                    <h4 class="h5 title">Individuales</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-2-min.jpg);">
                                    <h4 class="h5 title">Families</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a> <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-3-min.jpg);">
                                    <h4 class="h5 title">Animals, Dogs, Cats</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-4-min.jpg);">
                                    <h4 class="h5 title">Children</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-5-min.jpg);">
                                    <h4 class="h5 title">Couples</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-6-min.jpg);">
                                    <h4 class="h5 title">Abstract</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-7-min.jpg);">
                                    <h4 class="h5 title">Weddings</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-c-8-min.jpg);">
                                    <h4 class="h5 title">Houses</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a> -->
                            </div>
                        </div>
                        <div class="slider-progressbar-line">
                            <div class="slider_progress_wrap">
                                <div class="slider_progress">
                                    <div class="slider_progress_pointer"></div>
                                </div>
                            </div>
                            <a href="#" class="btn btn--accent-border">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End our-gallery section -->
    <!-- Start our-gallery section -->
    <section class="section our-gallery our-gallery--big-padding">
        <div class="section-inner">

            <div class="our-gallery-inner">

                <div class="gallery-slider our-gallery__slider">
                    <h3 class="h5 gallery-slider__title">
                        Charcoal Portrait
                    </h3>
                    <div class="gallery-slider__inner">
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide gallery-slider__item--small">
                                    <p class="vertical-label"> take a look</p>
                                </div>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-1-min.jpg);">
                                    <h4 class="h5 title">Individuales</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-2-min.jpg);">
                                    <h4 class="h5 title">Families</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-3-min.jpg);">
                                    <h4 class="h5 title">Animals, Dogs, Cats</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-4-min.jpg);">
                                    <h4 class="h5 title">Children</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-5-min.jpg);">
                                    <h4 class="h5 title">Couples</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-6-min.jpg);">
                                    <h4 class="h5 title">Abstract</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-7-min.jpg);">
                                    <h4 class="h5 title">Weddings</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                                <a href="#" class="swiper-slide gallery-slider__item" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/g-b-8-min.jpg);">
                                    <h4 class="h5 title">Houses</h4>
                                    <div class="btn btn--card-link btn--accent"></div>

                                    <svg viewBox="0 0 317 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="317" height="413" fill="none" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="slider-progressbar-line">
                            <div class="slider_progress_wrap">
                                <div class="slider_progress">
                                    <div class="slider_progress_pointer"></div>
                                </div>
                            </div>
                            <a href="#" class="btn btn--accent-border">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End our-gallery section -->
    <!-- Start choose section -->
    <section class="section choose ">
        <div class="section-inner">
            <div class="choose-inner">
                <div class="choose__label">
                    <p class="vertical-label">we offer</p>
                </div>

                <div class="choose__text">
                    <h2 class="title ">
                        Choose Now
                    </h2>
                    <p>Choose between an oil portrait and a charcoal drawing to immortalize your memories and significant
                        moments
                    </p>
                </div>

                <div class="choose-cards">
                    <a href="#" class="choose-card choose__card">
                        <div class="choose-card__label"></div>

                        <div class="choose-card-props">
                            <div class="choose-card__prop">Classic</div>
                            <div class="choose-card__prop">Emphasize All Colours</div>
                            <div class="choose-card__prop">High Effort</div>
                        </div>
                        <div class="choose-card__picture">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/chose-2-min.jpg" alt="">
                        </div>

                        <div class="choose-card__actions">
                            <div class="h6 choose-card-title">Charcoal Portrait</div>

                            <div class="choose-card-more">
                                See More
                            </div>

                        </div>
                    </a>

                    <div class="choose__or">or</div>

                    <a href="#" class="choose-card choose__card choose-card--tb-90 choose-card--pr-120">
                        <div class="choose-card__label">
                            <p>Popular</p>

                        </div>

                        <div class="choose-card-props">
                            <div class="choose-card__prop">Classic</div>
                            <div class="choose-card__prop">Emphasize All Colours</div>
                            <div class="choose-card__prop">High Effort</div>
                        </div>
                        <div class="choose-card__picture">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/chose-1-min.jpg" alt="">
                        </div>

                        <div class="choose-card__actions">
                            <div class="h6 choose-card-title">Oil Portrait</div>

                            <div class="choose-card-more">
                                See More
                            </div>

                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End choose section -->
    <!-- Start name section -->
    <section class="section benefits ">
        <div class="benefits-inner">
            <div class="benefits__label">
                <p class="vertical-label">our commitments</p>
            </div>
            <h2 class="title benefits__title">
                Our Promises for You
            </h2>
            <ul class="benefits__list">
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38.3533 16.712L37.8388 16.3272C37.1979 15.8474 36.9705 14.9984 37.2855 14.2627L37.5388 13.6721C38.0533 12.4707 37.9736 11.1325 37.3203 10.0009C36.6666 8.86902 35.5478 8.1308 34.2499 7.97608L33.6121 7.89979C32.8171 7.80488 32.1955 7.18324 32.1006 6.38857L32.0246 5.75045C31.8696 4.45285 31.1313 3.33378 29.9998 2.6804C28.8679 2.02672 27.5297 1.94707 26.3285 2.4619L25.7377 2.71489C25.0019 3.03013 24.1529 2.80247 23.6732 2.16161L23.2884 1.64739C22.5053 0.600948 21.3069 0.000976562 19.9998 0.000976562C18.6928 0.000976562 17.4944 0.600948 16.7113 1.64739L16.3262 2.16161C15.8464 2.80278 14.9977 3.03013 14.2617 2.71489L13.6712 2.4619C12.4697 1.94737 11.1315 2.02672 9.99992 2.6804C8.86803 3.33378 8.12982 4.45285 7.9751 5.75045L7.8988 6.38826C7.80389 7.18324 7.18226 7.80488 6.38728 7.89979L5.74947 7.97608C4.45187 8.1308 3.3328 8.86902 2.67942 10.0009C2.02574 11.1325 1.9464 12.4707 2.46092 13.6721L2.71391 14.2627C3.02915 14.9984 2.80149 15.8474 2.16063 16.3272L1.64641 16.712C0.600276 17.4951 0 18.6938 0 20.0005C0 21.3076 0.600276 22.5063 1.64641 23.2894L2.16093 23.6742C2.8018 24.1539 3.02915 25.0029 2.71421 25.7387L2.46092 26.3292C1.9464 27.5307 2.02605 28.8689 2.67942 30.0005C3.3331 31.1323 4.45187 31.8706 5.74977 32.0253L6.38758 32.1016C7.18256 32.1965 7.8042 32.8181 7.89911 33.6128L7.9751 34.2509C8.13012 35.5485 8.86834 36.6676 9.99992 37.321C11.1318 37.9743 12.47 38.054 13.6712 37.5395L14.262 37.2865C14.9977 36.9712 15.8467 37.1989 16.3265 37.8398L16.7113 38.354C17.4944 39.4004 18.6931 40.0007 20.0001 40.0007C21.3069 40.0007 22.5056 39.4004 23.2887 38.354L23.6735 37.8398C24.1533 37.1989 25.0019 36.9712 25.7383 37.2868L26.3288 37.5395C27.53 38.054 28.8682 37.9746 30.0001 37.3213C31.1317 36.6676 31.8699 35.5485 32.0249 34.2509L32.1009 33.6131C32.1958 32.8181 32.8174 32.1965 33.6124 32.1016L34.2502 32.0256C35.5478 31.8706 36.6672 31.1323 37.3206 30.0008C37.9739 28.8689 38.0536 27.5307 37.5388 26.3292L37.2861 25.739C36.9708 25.0029 37.1982 24.1539 37.8394 23.6742L38.3536 23.2894C39.4 22.5063 40 21.3076 40 20.0008C39.9997 18.6938 39.3994 17.4951 38.3533 16.712ZM37.417 22.0385L36.9028 22.4233C35.6824 23.3364 35.2491 24.9529 35.8496 26.3542L36.1023 26.9445C36.4212 27.6888 36.3718 28.5179 35.9671 29.2192C35.5622 29.9208 34.8688 30.378 34.0647 30.4741L33.4269 30.5501C31.9132 30.7307 30.73 31.9142 30.5494 33.4279L30.4731 34.0657C30.377 34.8698 29.9198 35.5632 29.2185 35.9681C28.5172 36.3728 27.6881 36.4222 26.9438 36.1033L26.3532 35.8503C24.9519 35.2501 23.3357 35.6834 22.4223 36.9038L22.0375 37.418C21.5523 38.0662 20.8095 38.4382 19.9998 38.4382C19.1899 38.4382 18.4471 38.0662 17.9619 37.418L17.5771 36.9038C16.939 36.0508 15.9575 35.5824 14.9462 35.5824C14.5101 35.5824 14.0685 35.6697 13.6464 35.8503L13.0559 36.1033C12.3113 36.4222 11.4825 36.3728 10.7809 35.9681C10.0796 35.5632 9.62242 34.8698 9.52629 34.0657L9.4503 33.4279C9.26934 31.9142 8.08618 30.731 6.57252 30.5504L5.93471 30.4741C5.13058 30.378 4.43722 29.9208 4.03226 29.2195C3.6276 28.5182 3.57816 27.6891 3.89706 26.9448L4.15005 26.3542C4.75033 24.9532 4.31698 23.3367 3.0969 22.4233L2.58238 22.0385C1.93419 21.5533 1.56249 20.8105 1.56249 20.0005C1.56249 19.1909 1.93419 18.4481 2.58268 17.9629L3.0969 17.5781C4.31729 16.6647 4.75063 15.0482 4.15005 13.6471L3.89737 13.0566C3.57846 12.3123 3.6279 11.4831 4.03256 10.7818C4.43753 10.0806 5.13088 9.62341 5.93501 9.52728L6.57282 9.45098C8.08648 9.27032 9.26964 8.08716 9.4503 6.5735L9.5266 5.93569C9.62273 5.13156 10.0799 4.4382 10.7812 4.03324C11.4825 3.62827 12.3116 3.57914 13.0559 3.89804L13.6464 4.15073C15.0475 4.751 16.664 4.31796 17.5774 3.09757L17.9622 2.58336C18.4474 1.93517 19.1902 1.56316 19.9998 1.56316C20.8095 1.56316 21.5523 1.93517 22.0375 2.58336L22.4226 3.09788C23.3357 4.31827 24.9525 4.75131 26.3532 4.15103L26.9438 3.89804C27.6881 3.57914 28.5172 3.62858 29.2185 4.03324C29.9198 4.4382 30.3773 5.13156 30.4731 5.93569L30.5494 6.5735C30.73 8.08716 31.9135 9.27032 33.4269 9.45098L34.0647 9.52728C34.8688 9.62341 35.5622 10.0806 35.9671 10.7818C36.3721 11.4831 36.4212 12.3123 36.1026 13.0566L35.8496 13.6471C35.2494 15.0485 35.6824 16.6647 36.9028 17.5781L37.417 17.9629C38.0655 18.4481 38.4372 19.1909 38.4372 20.0008C38.4372 20.8105 38.0655 21.5533 37.417 22.0385Z" fill="#F9AB97" />
                        <path d="M19.9999 4.54004C17.6431 4.54004 15.3799 5.057 13.2736 6.07659C12.8851 6.26457 12.7228 6.73179 12.9105 7.11997C13.0984 7.50846 13.566 7.67081 13.9542 7.48283C15.8465 6.567 17.8805 6.10253 19.9999 6.10253C27.6625 6.10253 33.8966 12.3366 33.8966 19.9995C33.8966 27.6621 27.6625 33.8962 19.9999 33.8962C12.337 33.8962 6.10295 27.6621 6.10295 19.9995C6.10295 16.8608 7.12376 13.8994 9.0552 11.4351C9.32131 11.0955 9.2618 10.6044 8.92215 10.338C8.58249 10.0719 8.09146 10.1317 7.82535 10.4711C5.67663 13.2134 4.54077 16.508 4.54077 19.9995C4.54077 28.5236 11.4758 35.4587 19.9999 35.4587C28.524 35.4587 35.4591 28.5236 35.4591 19.9995C35.4591 11.4751 28.524 4.54004 19.9999 4.54004Z" fill="#F9AB97" />
                        <path d="M8.57727 16.0227L7.98217 16.7814C7.71575 17.121 7.77526 17.6121 8.11462 17.8782C8.45428 18.1446 8.94531 18.0854 9.21142 17.7457L9.53827 17.3295V22.4964H9.0152C8.58368 22.4964 8.23394 22.8461 8.23394 23.2776C8.23394 23.7092 8.58368 24.0589 9.0152 24.0589H11.597C12.0282 24.0589 12.3782 23.7092 12.3782 23.2776C12.3782 22.8461 12.0282 22.4964 11.597 22.4964H11.1008V16.5049C11.1008 16.0734 10.7507 15.7236 10.3195 15.7236H9.19189C8.95202 15.7236 8.72528 15.8338 8.57727 16.0227Z" fill="#F9AB97" />
                        <path d="M14.8552 24.0586H15.261C16.5513 24.0586 17.6008 23.0091 17.6008 21.7188V17.9319C17.6008 16.6416 16.551 15.5918 15.261 15.5918H14.8552C13.5649 15.5918 12.5154 16.6416 12.5154 17.9319V21.7188C12.5154 23.0091 13.5649 24.0586 14.8552 24.0586ZM14.0779 17.9319C14.0779 17.5031 14.4267 17.1543 14.8552 17.1543H15.261C15.6895 17.1543 16.0383 17.5031 16.0383 17.9319V21.7188C16.0383 22.1473 15.6895 22.4961 15.261 22.4961H14.8552C14.4267 22.4961 14.0779 22.1473 14.0779 21.7188V17.9319Z" fill="#F9AB97" />
                        <path d="M21.1514 24.0586C22.4417 24.0586 23.4912 23.0091 23.4912 21.7188V17.9319C23.4912 16.6416 22.4414 15.5918 21.1514 15.5918H20.7455C19.4553 15.5918 18.4058 16.6416 18.4058 17.9319V21.7188C18.4058 23.0091 19.4553 24.0586 20.7455 24.0586H21.1514ZM19.9683 21.7188V17.9319C19.9683 17.5031 20.3171 17.1543 20.7455 17.1543H21.1514C21.5799 17.1543 21.9287 17.5031 21.9287 17.9319V21.7188C21.9287 22.1473 21.5799 22.4961 21.1514 22.4961H20.7455C20.3171 22.4961 19.9683 22.1476 19.9683 21.7188Z" fill="#F9AB97" />
                        <path d="M31.4686 15.497C31.1198 15.2434 30.6312 15.3206 30.3773 15.6694L25.4133 22.4959C25.1594 22.845 25.2366 23.3336 25.5858 23.5872C25.7243 23.6879 25.8851 23.7367 26.0444 23.7367C26.2858 23.7367 26.5242 23.625 26.6771 23.4148L31.6411 16.5883C31.895 16.2395 31.8175 15.7509 31.4686 15.497Z" fill="#F9AB97" />
                        <path d="M12.9632 12.522C13.1454 12.522 13.3285 12.4585 13.4765 12.3294C15.2825 10.7523 17.5991 9.88378 19.9999 9.88378C22.246 9.88378 24.3642 10.6156 26.1257 11.9999C26.465 12.2666 26.956 12.2077 27.2228 11.8683C27.4892 11.5293 27.4303 11.0379 27.0912 10.7715C25.0515 9.16845 22.5994 8.32129 19.9999 8.32129C17.2213 8.32129 14.5395 9.32684 12.449 11.1524C12.124 11.4362 12.0904 11.9297 12.3742 12.2547C12.5287 12.4317 12.7453 12.522 12.9632 12.522Z" fill="#F9AB97" />
                        <path d="M12.8194 28.8418C14.8586 30.4446 17.3109 31.2917 19.9104 31.2917C21.714 31.2917 23.4406 30.8852 25.0428 30.0839C25.4285 29.891 25.5848 29.4216 25.3919 29.0356C25.1987 28.6498 24.7297 28.4936 24.3436 28.6865C22.9606 29.3786 21.4689 29.7292 19.9104 29.7292C17.6646 29.7292 15.5461 28.9977 13.7846 27.6132C13.4456 27.3467 12.9543 27.4056 12.6879 27.7447C12.4211 28.0841 12.48 28.5751 12.8194 28.8418Z" fill="#F9AB97" />
                        <path d="M27.6717 27.5058C27.4989 27.247 27.1754 27.1127 26.87 27.1738C26.5459 27.2388 26.2907 27.5098 26.2477 27.8378C26.2056 28.1564 26.371 28.4772 26.6542 28.6286C26.9386 28.7808 27.2963 28.739 27.5389 28.5263C27.8307 28.2697 27.8825 27.8284 27.6717 27.5058Z" fill="#F9AB97" />
                        <path d="M26.3453 15.3477C25.3315 15.3477 24.5066 16.1722 24.5066 17.186C24.5066 18.1998 25.3315 19.0247 26.3453 19.0247C27.3588 19.0247 28.1837 18.1998 28.1837 17.186C28.1837 16.1722 27.3588 15.3477 26.3453 15.3477ZM26.3453 17.4622C26.193 17.4622 26.0691 17.3383 26.0691 17.186C26.0691 17.0338 26.193 16.9099 26.3453 16.9099C26.4976 16.9099 26.6212 17.0338 26.6212 17.186C26.6212 17.3383 26.4976 17.4622 26.3453 17.4622Z" fill="#F9AB97" />
                        <path d="M28.8429 21.9471C28.8429 22.9609 29.6678 23.7858 30.6813 23.7858C31.6951 23.7858 32.52 22.9609 32.52 21.9471C32.52 20.9333 31.6951 20.1084 30.6813 20.1084C29.6678 20.1084 28.8429 20.9333 28.8429 21.9471ZM30.9575 21.9471C30.9575 22.0994 30.8339 22.2233 30.6816 22.2233C30.5293 22.2233 30.4054 22.0994 30.4054 21.9471C30.4054 21.7948 30.5293 21.6709 30.6816 21.6709C30.8339 21.6709 30.9575 21.7948 30.9575 21.9471Z" fill="#F9AB97" />
                        <path d="M10.1151 8.86378C10.2408 9.1656 10.5478 9.3603 10.8743 9.34504C11.1966 9.32978 11.4798 9.10944 11.5793 8.80366C11.6797 8.49482 11.5704 8.14204 11.3116 7.9452C11.0477 7.7444 10.679 7.7328 10.4025 7.9156C10.0943 8.11915 9.97589 8.52412 10.1151 8.86378Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">100% Detailed Portrait Guarantee</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="34" viewBox="0 0 40 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M38.6333 22.4999H38.5259V2.32848C38.5259 1.35957 37.7376 0.571289 36.7687 0.571289H26.6181C26.2946 0.571289 26.0324 0.833477 26.0324 1.15699C26.0324 1.48051 26.2947 1.7427 26.6181 1.7427H36.7688C37.0917 1.7427 37.3545 2.00543 37.3545 2.3284V22.4998H35.157C33.7416 21.2284 31.9157 20.5285 30.0129 20.5285C28.1101 20.5285 26.284 21.2286 24.8688 22.4998H15.8817V2.32848C15.8817 2.00551 16.1445 1.74277 16.4674 1.74277H23.7415C24.065 1.74277 24.3272 1.48059 24.3272 1.15707C24.3272 0.833555 24.0649 0.571367 23.7415 0.571367H16.4674C15.4985 0.571367 14.7102 1.35965 14.7102 2.32855V4.9823H9.12109C8.16094 4.9823 7.24859 5.39754 6.61805 6.12168L4.67391 8.3541C4.46148 8.59809 4.48695 8.96801 4.73094 9.18051C4.84188 9.27715 4.97891 9.32449 5.11539 9.32449C5.27883 9.32449 5.44156 9.25637 5.55734 9.12348L7.50148 6.89098C7.90953 6.42238 8.49984 6.15371 9.12109 6.15371H11.6388V14.5155H2.74258V13.4521C2.74258 12.7451 2.99828 12.0621 3.46266 11.5289L3.73109 11.2207C3.94352 10.9767 3.91797 10.6068 3.67398 10.3943C3.43008 10.1818 3.06008 10.2074 2.84758 10.4513L2.57922 10.7595C1.92914 11.506 1.57109 12.4623 1.57109 13.4521V22.4999H1.36664C0.613125 22.4999 0 23.1129 0 23.8665V27.4498C0 28.2034 0.613125 28.8165 1.36672 28.8165H4.29266C4.58469 31.4081 6.78883 33.4291 9.45703 33.4291C12.1252 33.4291 14.3294 31.4081 14.6214 28.8165H15.1988C15.5223 28.8165 15.7845 28.5543 15.7845 28.2308C15.7845 27.9073 15.5222 27.6451 15.1988 27.6451H14.6214C14.3294 25.0536 12.1252 23.0325 9.45703 23.0325C6.78883 23.0325 4.58469 25.0536 4.29266 27.6451H1.36672C1.25906 27.6451 1.17148 27.5575 1.17148 27.4499V23.8666C1.17148 23.7589 1.25906 23.6714 1.36672 23.6714H4.32812C4.60867 23.6714 4.87648 23.5692 5.08234 23.3834C6.2843 22.2979 7.83781 21.7 9.45703 21.7C11.0761 21.7 12.6298 22.2979 13.8318 23.3836C14.0374 23.5692 14.3052 23.6714 14.5859 23.6714H24.8841C25.1647 23.6714 25.4325 23.5692 25.6384 23.3834C26.8402 22.2979 28.3939 21.7 30.013 21.7C31.6322 21.7 33.1858 22.2979 34.3878 23.3836C34.5934 23.5692 34.8612 23.6714 35.142 23.6714H38.6335C38.7412 23.6714 38.8288 23.7589 38.8288 23.8666V27.4499C38.8288 27.5575 38.7412 27.6451 38.6335 27.6451H35.1775C34.8855 25.0536 32.6813 23.0325 30.0131 23.0325C27.3449 23.0325 25.1408 25.0536 24.8487 27.6451H17.9228C17.5993 27.6451 17.3371 27.9073 17.3371 28.2308C17.3371 28.5543 17.5994 28.8165 17.9228 28.8165H24.8487C25.1408 31.4081 27.3449 33.4291 30.0131 33.4291C32.6813 33.4291 34.8855 31.4081 35.1775 28.8165H38.6335C39.3871 28.8165 40.0002 28.2034 40.0002 27.4498V23.8665C40 23.1129 39.3869 22.4999 38.6333 22.4999ZM9.45695 24.2039C11.6773 24.2039 13.4838 26.0104 13.4838 28.2308C13.4838 30.4513 11.6774 32.2577 9.45695 32.2577C7.23648 32.2577 5.43008 30.4513 5.43008 28.2308C5.43008 26.0104 7.23656 24.2039 9.45695 24.2039ZM2.74258 18.11H4.69016C4.9993 18.11 5.25078 18.3615 5.25078 18.6706V18.9156C5.25078 19.2247 4.9993 19.4761 4.69016 19.4761H2.74258V18.11ZM9.45695 20.5286C7.55414 20.5286 5.72805 21.2286 4.31281 22.4999H2.7425V20.6476H4.69008C5.64516 20.6476 6.42211 19.8706 6.42211 18.9156V18.6706C6.42211 17.7155 5.64508 16.9385 4.69008 16.9385H2.74258V15.6869H11.834C12.3723 15.6869 12.8102 15.249 12.8102 14.7107V6.15371H14.7102V22.4999H14.601C13.1857 21.2284 11.3598 20.5286 9.45695 20.5286ZM30.0129 32.2576C27.7925 32.2576 25.986 30.4512 25.986 28.2307C25.986 26.0103 27.7924 24.2039 30.0129 24.2039C32.2334 24.2039 34.0398 26.0103 34.0398 28.2307C34.0398 30.4512 32.2333 32.2576 30.0129 32.2576Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M9.45692 30.4641C10.6883 30.4641 11.69 29.4624 11.69 28.2311C11.69 26.9998 10.6883 25.998 9.45692 25.998C8.2256 25.998 7.22388 26.9998 7.22388 28.2311C7.22388 29.4624 8.22567 30.4641 9.45692 30.4641ZM9.45692 27.1695C10.0423 27.1695 10.5186 27.6456 10.5186 28.2311C10.5186 28.8166 10.0423 29.2927 9.45692 29.2927C8.87153 29.2927 8.39528 28.8166 8.39528 28.2311C8.39528 27.6456 8.87161 27.1695 9.45692 27.1695Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M30.0128 25.998C28.7815 25.998 27.7798 26.9998 27.7798 28.2311C27.7798 29.4624 28.7815 30.4641 30.0128 30.4641C31.2442 30.4641 32.2459 29.4624 32.2459 28.2311C32.2459 26.9998 31.2442 25.998 30.0128 25.998ZM30.0128 29.2927C29.4274 29.2927 28.9512 28.8166 28.9512 28.2311C28.9512 27.6456 29.4274 27.1695 30.0128 27.1695C30.5982 27.1695 31.0745 27.6456 31.0745 28.2311C31.0745 28.8166 30.5982 29.2927 30.0128 29.2927Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M9.83965 16.9873H8.32411C8.00059 16.9873 7.7384 17.2495 7.7384 17.573C7.7384 17.8965 8.00067 18.1587 8.32411 18.1587H9.83965C10.1632 18.1587 10.4254 17.8965 10.4254 17.573C10.4254 17.2495 10.1631 16.9873 9.83965 16.9873Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M20.3873 10.3491C20.7108 10.3491 20.973 10.087 20.973 9.76344C20.973 9.43992 20.7108 9.17773 20.3873 9.17773H18.4036C18.0801 9.17773 17.8179 9.43992 17.8179 9.76344V14.6579C17.8179 14.9814 18.0801 15.2436 18.4036 15.2436C18.7271 15.2436 18.9893 14.9814 18.9893 14.6579V12.75H20.2297C20.5533 12.75 20.8154 12.4878 20.8154 12.1643C20.8154 11.8408 20.5532 11.5786 20.2297 11.5786H18.9893V10.3492H20.3873V10.3491Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M30.2404 10.3579C30.5639 10.3579 30.8261 10.0957 30.8261 9.77223C30.8261 9.44871 30.5638 9.18652 30.2404 9.18652H28.1818C27.8583 9.18652 27.5961 9.44871 27.5961 9.77223V14.6578C27.5961 14.9813 27.8583 15.2435 28.1818 15.2435H30.2404C30.5639 15.2435 30.8261 14.9813 30.8261 14.6578C30.8261 14.3343 30.5638 14.0721 30.2404 14.0721H28.7676V12.8007H30.0886C30.4122 12.8007 30.6744 12.5386 30.6744 12.215C30.6744 11.8915 30.4121 11.6293 30.0886 11.6293H28.7676V10.3581H30.2404V10.3579Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M34.8242 10.3579C35.1477 10.3579 35.4099 10.0957 35.4099 9.77223C35.4099 9.44871 35.1477 9.18652 34.8242 9.18652H32.7656C32.4421 9.18652 32.1799 9.44871 32.1799 9.77223V14.6578C32.1799 14.9813 32.4422 15.2435 32.7656 15.2435H34.8242C35.1477 15.2435 35.4099 14.9813 35.4099 14.6578C35.4099 14.3343 35.1477 14.0721 34.8242 14.0721H33.3514V12.8007H34.6725C34.996 12.8007 35.2582 12.5386 35.2582 12.215C35.2582 11.8915 34.9959 11.6293 34.6725 11.6293H33.3514V10.3581H34.8242V10.3579Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                        <path d="M26.2028 11.0311C26.2028 10.0016 25.3327 9.16406 24.2632 9.16406H22.953C22.9528 9.16406 22.9524 9.16406 22.9522 9.16406C22.952 9.16406 22.9517 9.16406 22.9514 9.16406C22.6279 9.16406 22.3657 9.42625 22.3657 9.74977V14.6803C22.3657 15.0038 22.628 15.266 22.9514 15.266C23.2749 15.266 23.5371 15.0038 23.5371 14.6803V13.2035L25.1774 15.0673C25.2932 15.1988 25.4549 15.266 25.6174 15.266C25.7548 15.266 25.8928 15.2179 26.0041 15.12C26.2469 14.9063 26.2705 14.5362 26.0568 14.2934L24.7713 12.8328C25.5951 12.6172 26.2028 11.8913 26.2028 11.0311ZM24.2631 11.7268C24.0959 11.7268 23.8075 11.728 23.5444 11.7292C23.5431 11.4722 23.5411 10.6047 23.5404 10.3355H24.2631C24.6795 10.3355 25.0313 10.6541 25.0313 11.0311C25.0313 11.4082 24.6795 11.7268 24.2631 11.7268Z" fill="#F9AB97" stroke="#F9AB97" stroke-width="0.3" />
                    </svg>
                    <p class="h6 benefit-card__descr">FREE shipping</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.57 20.9238C37.2746 20.9238 36.9784 20.9761 36.6993 21.0788C36.6323 19.5125 35.4455 18.6939 34.2726 18.6939C33.9278 18.6939 33.582 18.7649 33.2637 18.9045C32.9087 17.8414 31.9376 17.2898 30.9752 17.2898C30.6809 17.2898 30.3859 17.3418 30.1077 17.4437V15.7448V2.14102C30.1077 0.960469 29.1473 0 27.9668 0H10.0048C8.8243 0 7.86383 0.960469 7.86383 2.14102V8.92453H0.78125C0.349844 8.92453 0 9.27437 0 9.70586V21.3144C0 21.7459 0.349844 22.0957 0.78125 22.0957H7.86375V32.7634C7.86375 33.944 8.82422 34.9045 10.0047 34.9045H24.8234C25.7853 36.0884 25.7859 37.1176 25.7859 38.4016C25.7859 39.283 26.503 40.0001 27.3843 40.0001H28.7595C29.1909 40.0001 29.5408 39.6502 29.5408 39.2188C29.5408 38.7873 29.1909 38.4374 28.7595 38.4374H27.3844C27.3662 38.4374 27.3484 38.4196 27.3484 38.4016C27.3484 36.912 27.3484 35.3717 25.8094 33.6527C25.4447 33.2455 24.9909 32.9143 24.5521 32.5939C23.7222 31.9882 23.2184 31.5823 23.2184 31.0553L23.2162 28.5978V25.3563C23.2207 25.1341 23.2698 24.9704 23.348 24.9177C23.4503 24.8487 23.7167 24.8418 24.0812 24.9821C24.7899 25.2546 25.248 25.9246 25.248 26.6888V29.1758C25.248 29.6073 25.5978 29.9571 26.0292 29.9571C26.4606 29.9571 26.8105 29.6073 26.8105 29.1758V26.6888V15.7448C26.8105 14.8278 27.5326 14.7813 27.6773 14.7813C27.9063 14.7813 28.1245 14.863 28.276 15.0055C28.4548 15.1736 28.5454 15.4223 28.5454 15.7448V24.7712C28.5454 25.2027 28.8952 25.5525 29.3266 25.5525C29.758 25.5525 30.1079 25.2027 30.1079 24.7712V19.8151C30.1079 18.8988 30.8305 18.8524 30.9754 18.8524C31.2043 18.8524 31.4224 18.9341 31.5738 19.0763C31.7523 19.2442 31.8428 19.4927 31.8428 19.8151V25.5994C31.8428 26.0309 32.1927 26.3807 32.6241 26.3807C33.0555 26.3807 33.4053 26.0309 33.4053 25.5994V21.219C33.4053 20.3028 34.1279 20.2564 34.2728 20.2564C34.5017 20.2564 34.7198 20.338 34.8712 20.4802C35.0497 20.6482 35.1402 20.8966 35.1402 21.219V26.4253C35.1402 26.8568 35.4901 27.2066 35.9215 27.2066C36.3529 27.2066 36.7027 26.8568 36.7027 26.4253V23.449C36.7027 22.5327 37.4253 22.4863 37.5702 22.4863C37.7991 22.4863 38.0173 22.568 38.1686 22.7102C38.3471 22.8781 38.4377 23.1266 38.4377 23.449V31.3227C38.3123 32.4323 38.0528 32.9362 37.802 33.4239C37.5005 34.0099 37.1886 34.616 37.1886 35.8747V38.4015C37.1886 38.4186 37.1698 38.4373 37.1527 38.4373H35.7773C35.3459 38.4373 34.9961 38.7872 34.9961 39.2187C34.9961 39.6502 35.3459 40 35.7773 40H37.1527C38.034 40 38.751 39.283 38.751 38.4016V35.8748C38.751 34.9945 38.9261 34.6541 39.1912 34.1389C39.4805 33.5766 39.8405 32.877 39.9955 31.4504C39.9985 31.4224 40.0001 31.3941 40.0001 31.366V23.4491C40 21.7913 38.7776 20.9238 37.57 20.9238ZM14.4488 1.56258H23.5227V2.39789C23.5227 2.86094 23.1469 3.23766 22.6851 3.23766H15.2864C14.8246 3.23766 14.4488 2.86094 14.4488 2.39789V1.56258ZM1.5625 10.4871H3.7475C3.46883 11.5641 2.62844 12.4139 1.5625 12.6977V10.4871ZM1.5625 20.533V18.3224C2.62844 18.6062 3.46883 19.4561 3.7475 20.533H1.5625ZM1.5625 16.7253V14.2948C3.49086 13.9634 5.01531 12.4281 5.34273 10.487H16.62V20.533H5.34273C5.01531 18.592 3.49086 17.0568 1.5625 16.7253ZM10.0048 33.3419C9.68578 33.3419 9.42633 33.0824 9.42633 32.7634V30.9648H21.6558L21.6559 31.056C21.6559 32.0768 22.2743 32.7819 22.955 33.3418H10.0048V33.3419ZM28.5452 13.3727C28.267 13.2707 27.9716 13.2188 27.6772 13.2188C27.0456 13.2188 26.453 13.449 26.0087 13.8671C25.6617 14.1937 25.2479 14.7846 25.2479 15.7448V23.8286C25.0594 23.7091 24.8571 23.6066 24.6421 23.5238C23.8118 23.2043 23.042 23.2394 22.4743 23.6223C22.1089 23.8688 21.67 24.3663 21.6537 25.3362C21.6537 25.3405 21.6537 25.3448 21.6537 25.3492V28.5986L21.6544 29.4023H9.42625V22.0957H16.62V23.2322C16.62 23.6637 16.9698 24.0135 17.4012 24.0135C17.8327 24.0135 18.1825 23.6637 18.1825 23.2322V7.78805C18.1825 7.35656 17.8327 7.00672 17.4012 7.00672C16.9698 7.00672 16.62 7.35656 16.62 7.78805V8.92453H9.42625V2.14102C9.42625 1.82211 9.6857 1.56258 10.0047 1.56258H12.8863V2.39789C12.8863 3.7225 13.963 4.80023 15.2864 4.80023H22.6851C24.0084 4.80023 25.0852 3.7225 25.0852 2.39789V1.56258H27.9668C28.2858 1.56258 28.5452 1.82203 28.5452 2.14102V13.3727Z" fill="#F9AB97" />
                        <path d="M14.1763 15.5095C14.1763 13.6342 12.6596 12.1084 10.7953 12.1084C8.93098 12.1084 7.41418 13.6341 7.41418 15.5095C7.41418 17.3849 8.93098 18.9106 10.7953 18.9106C12.6596 18.9106 14.1763 17.3848 14.1763 15.5095ZM8.97661 15.5095C8.97661 14.4957 9.79239 13.671 10.7952 13.671C11.7979 13.671 12.6137 14.4957 12.6137 15.5095C12.6137 16.5233 11.7979 17.348 10.7952 17.348C9.79247 17.3479 8.97661 16.5232 8.97661 15.5095Z" fill="#F9AB97" />
                        <path d="M32.2717 40.0002H32.2695C31.8381 40.0002 31.4883 39.6503 31.4883 39.2188C31.4883 38.7873 31.8381 38.4375 32.2695 38.4375C32.7009 38.4375 33.052 38.7873 33.052 39.2188C33.052 39.6503 32.7032 40.0002 32.2717 40.0002Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">Only 10 % Advance Payment</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.1724 32.3737C37.4434 31.8549 37.5976 31.2658 37.5976 30.6409V29.15C37.5976 27.5285 36.5647 26.1438 35.1223 25.6188C34.8318 24.0195 33.9095 22.6206 32.5589 21.7177C32.8296 21.199 32.9837 20.61 32.9837 19.9855V18.4946C32.9837 16.4234 31.2986 14.7383 29.2274 14.7383C27.1562 14.7383 25.4711 16.4234 25.4711 18.4946V19.9855C25.4711 20.6101 25.6252 21.1991 25.896 21.7179C25.4088 22.0436 24.9776 22.4344 24.6112 22.8757C24.2426 22.4305 23.8119 22.0419 23.3307 21.7191C23.602 21.2 23.7563 20.6106 23.7563 19.9855V18.4946C23.7563 16.4234 22.0712 14.7383 19.9999 14.7383C17.9287 14.7383 16.2436 16.4234 16.2436 18.4946V19.9855C16.2436 20.6106 16.3979 21.2001 16.6693 21.7191C16.1854 22.0436 15.7526 22.4351 15.3825 22.8836C15.0155 22.4392 14.5854 22.0453 14.103 21.7196C14.3744 21.2004 14.5289 20.6108 14.5289 19.9855V18.4946C14.5289 16.4234 12.8438 14.7383 10.7725 14.7383C8.70126 14.7383 7.01616 16.4234 7.01616 18.4946V19.9855C7.01616 20.6101 7.17026 21.1991 7.44112 21.7179C6.09157 22.6204 5.16836 24.0196 4.8776 25.6189C3.43523 26.1438 2.4024 27.5285 2.4024 29.15V30.6409C2.4024 31.2657 2.55658 31.8549 2.82759 32.3737C1.16929 33.4815 0.166138 35.3259 0.166138 37.3496V39.2251C0.166138 39.653 0.512997 39.9998 0.940896 39.9998H10.1684H19.3959H29.8316H39.0592C39.487 39.9998 39.8339 39.653 39.8339 39.2251V37.3496C39.8338 35.3259 38.8308 33.4814 37.1724 32.3737ZM36.0481 29.15V30.6409C36.0481 31.8577 35.0582 32.8477 33.8413 32.8477C32.6245 32.8477 31.6345 31.8577 31.6345 30.6409V29.15C31.6345 27.9331 32.6245 26.9432 33.8413 26.9432C35.0582 26.9432 36.0481 27.9332 36.0481 29.15ZM33.4787 25.4115C31.5769 25.5946 30.0849 27.2011 30.0849 29.15V30.6409C30.0849 31.2661 30.2393 31.8556 30.5106 32.3747C30.0304 32.697 29.6003 33.0857 29.2317 33.5305C28.8657 33.0902 28.4335 32.7002 27.9449 32.3737C28.2159 31.8549 28.3701 31.2657 28.3701 30.6409V29.15C28.3701 27.2012 26.8781 25.5947 24.9765 25.4115C25.2905 24.3908 25.9738 23.4953 26.8891 22.9221C27.5313 23.4345 28.3439 23.7418 29.2274 23.7418C30.1109 23.7418 30.9234 23.4345 31.5656 22.9221C32.4816 23.4955 33.1646 24.3906 33.4787 25.4115ZM22.4068 30.6409V29.15C22.4068 27.9332 23.3968 26.9432 24.6136 26.9432C25.8305 26.9432 26.8205 27.9332 26.8205 29.15V30.6409C26.8205 31.8577 25.8305 32.8477 24.6136 32.8477C23.3968 32.8477 22.4068 31.8577 22.4068 30.6409ZM27.0206 18.4946C27.0206 17.2777 28.0106 16.2878 29.2274 16.2878C30.4442 16.2878 31.4342 17.2778 31.4342 18.4946V19.9855C31.4342 21.2023 30.4442 22.1923 29.2274 22.1923C28.0106 22.1923 27.0206 21.2023 27.0206 19.9855V18.4946ZM17.7931 18.4946C17.7931 17.2777 18.783 16.2878 19.9999 16.2878C21.2167 16.2878 22.2067 17.2778 22.2067 18.4946V19.9855C22.2067 21.2023 21.2167 22.1923 19.9999 22.1923C18.783 22.1923 17.793 21.2023 17.793 19.9855V18.4946H17.7931ZM17.6617 22.9221C18.3039 23.4345 19.1165 23.7418 19.9999 23.7418C20.8834 23.7418 21.696 23.4345 22.3381 22.9222C22.8999 23.2719 23.375 23.7394 23.7348 24.2975C23.5518 24.7168 23.416 25.1596 23.3325 25.6189C21.8901 26.1438 20.8573 27.5285 20.8573 29.15V30.6409C20.8573 31.2657 21.0115 31.8548 21.2825 32.3737C20.794 32.6999 20.3619 33.0896 19.9962 33.5295C19.6278 33.085 19.1976 32.6969 18.717 32.3745C18.9883 31.8554 19.1426 31.266 19.1426 30.6408V29.15C19.1426 27.5281 18.1092 26.1432 16.6664 25.6185C16.5823 25.1647 16.4452 24.724 16.2603 24.305C16.6207 23.7435 17.0976 23.2733 17.6617 22.9221ZM13.1793 30.6409V29.15C13.1793 27.9331 14.1693 26.9432 15.3862 26.9432C16.6031 26.9432 17.5931 27.9332 17.5931 29.15V30.6409C17.5931 31.8577 16.6031 32.8477 15.3862 32.8477C14.1693 32.8477 13.1793 31.8577 13.1793 30.6409ZM8.56553 18.4946C8.56553 17.2777 9.55551 16.2878 10.7723 16.2878C11.9893 16.2878 12.9792 17.2778 12.9792 18.4946V19.9855C12.9792 21.2023 11.9893 22.1923 10.7724 22.1923C9.55551 22.1923 8.56553 21.2023 8.56553 19.9855V18.4946ZM8.43413 22.9221C9.07632 23.4345 9.88889 23.7418 10.7724 23.7418C11.6559 23.7418 12.4685 23.4345 13.1106 22.9221C14.0268 23.4955 14.7096 24.3905 15.0235 25.4115C13.1218 25.5946 11.6298 27.2011 11.6298 29.15V30.6409C11.6298 31.2657 11.7839 31.8549 12.055 32.3737C11.5666 32.6999 11.1347 33.0895 10.7689 33.5292C10.4006 33.0847 9.97024 32.6969 9.48942 32.3745C9.76067 31.8554 9.915 31.2661 9.915 30.6409V29.15C9.915 27.2012 8.42305 25.5947 6.5214 25.4115C6.83557 24.3908 7.51883 23.4953 8.43413 22.9221ZM3.95184 29.15C3.95184 27.9331 4.94183 26.9432 6.15874 26.9432C7.37557 26.9432 8.36556 27.9332 8.36556 29.15V30.6409C8.36556 31.8577 7.37557 32.8477 6.15874 32.8477C4.94183 32.8477 3.95184 31.8577 3.95184 30.6409V29.15ZM1.71558 37.3496C1.71558 35.7984 2.51234 34.3885 3.82005 33.5773C4.46225 34.0898 5.27505 34.3973 6.15866 34.3973C7.04212 34.3973 7.85468 34.09 8.49688 33.5776C9.05819 33.927 9.53281 34.3935 9.8923 34.9509C9.56853 35.6924 9.39359 36.5053 9.39359 37.3496V38.4503H1.71558V37.3496ZM10.9431 37.3496C10.9431 35.7984 11.7398 34.3885 13.0475 33.5773C13.6897 34.0898 14.5025 34.3973 15.3861 34.3973C16.2696 34.3973 17.0821 34.09 17.7243 33.5777C18.2853 33.9269 18.76 34.3938 19.1197 34.9512C18.796 35.6927 18.621 36.5055 18.621 37.3496V38.4504H10.943V37.3496H10.9431ZM20.1706 37.3496C20.1706 35.7984 20.9673 34.3885 22.275 33.5773C22.9172 34.0898 23.73 34.3973 24.6136 34.3973C25.4972 34.3973 26.31 34.0899 26.9522 33.5773C28.2599 34.3886 29.0568 35.7989 29.0568 37.3496V38.4503H20.1706V37.3496ZM38.2843 38.4503H30.6063V37.3495C30.6063 36.5056 30.4314 35.6928 30.1076 34.9513C30.4674 34.3939 30.9426 33.9266 31.503 33.5776C32.1451 34.0899 32.9577 34.3972 33.8412 34.3972C34.7248 34.3972 35.5376 34.0898 36.1798 33.5772C37.4876 34.3883 38.2842 35.7983 38.2842 37.3494V38.4503H38.2843Z" fill="#F9AB97" />
                        <path d="M13.7434 6.58636C14.1458 6.44101 14.3543 5.99692 14.209 5.59451C13.7218 4.2455 13.8978 3.17819 14.747 2.33169C15.7945 1.2874 17.4991 1.2874 18.5468 2.33169C19.3617 3.14395 20.6384 3.14403 21.4533 2.33169C22.501 1.2874 24.2055 1.2874 25.2532 2.33169C26.0137 3.08979 26.2329 4.02129 25.923 5.17932C25.1467 8.08117 21.5459 11.0445 20.0007 11.6289C19.5585 11.4603 18.9417 11.0918 18.2981 10.6079C17.956 10.3507 17.4702 10.4196 17.2133 10.7616C16.9561 11.1037 17.0249 11.5894 17.367 11.8464C18.2917 12.5416 19.1558 13.0193 19.8002 13.1913C19.8656 13.2088 19.9329 13.2176 20.0001 13.2176C20.0674 13.2176 20.1346 13.2088 20.2001 13.1913C21.2313 12.9159 22.8012 11.8604 24.1997 10.5024C25.1601 9.5698 26.8554 7.69023 27.42 5.57971C27.8727 3.88764 27.5018 2.385 26.3471 1.23425C24.6963 -0.411416 22.0102 -0.411416 20.3595 1.23425C20.1236 1.46931 19.8193 1.41221 19.6408 1.23425C17.9899 -0.411339 15.3039 -0.411184 13.6531 1.23425C12.3706 2.51268 12.0588 4.20243 12.7516 6.12073C12.8969 6.52321 13.3409 6.73147 13.7434 6.58636Z" fill="#F9AB97" />
                        <path d="M15.2983 8.05762C14.8704 8.05762 14.5238 8.40448 14.5238 8.83237C14.5238 9.26027 14.8709 9.60713 15.2988 9.60713C15.7267 9.60713 16.0736 9.26027 16.0736 8.83237C16.0736 8.40448 15.7267 8.05762 15.2988 8.05762H15.2983Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">+1000 Satisfield Costumers</p>
                </li>
                <li class="benefit-card">
                    <svg width="30" height="40" viewBox="0 0 30 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M29.448 8.19172C29.4497 8.01109 29.3842 7.83609 29.2646 7.7007C29.2633 7.6993 29.2626 7.69844 29.2624 7.6982L22.9666 0.275859L22.9569 0.264063C22.8198 0.096875 22.6151 0 22.3988 0H22.3708H2.82255C1.56856 0 0.552002 1.01656 0.552002 2.27055V37.7295C0.552002 38.9835 1.56856 40.0001 2.82255 40.0001H27.1774C28.4314 40.0001 29.4479 38.9835 29.4479 37.7295V8.20367C29.4479 8.20352 29.4479 8.19922 29.448 8.19172ZM23.1521 2.91008L26.9796 7.42242H23.1521V2.91008ZM24.5697 38.4375H5.4302V27.097H24.5697V38.4375ZM27.8854 37.7295C27.8854 38.1199 27.5679 38.4376 27.1774 38.4376H26.1322V26.3157C26.1322 25.8842 25.7824 25.5345 25.351 25.5345H4.64895C4.21755 25.5345 3.8677 25.8842 3.8677 26.3157V38.4375H2.82255C2.43216 38.4375 2.1145 38.1199 2.1145 37.7295V2.27055C2.1145 1.88016 2.43208 1.5625 2.82255 1.5625H21.5896V8.20367C21.5896 8.63516 21.9394 8.98492 22.3708 8.98492H27.8854V37.7295Z" fill="#F9AB97" />
                        <path d="M23.7061 22.0498H6.2937C5.86229 22.0498 5.51245 22.3996 5.51245 22.8311C5.51245 23.2625 5.86229 23.6123 6.2937 23.6123H23.7061C24.1375 23.6123 24.4874 23.2625 24.4874 22.8311C24.4874 22.3996 24.1375 22.0498 23.7061 22.0498Z" fill="#F9AB97" />
                        <path d="M5.51245 16.4707C5.51245 16.9022 5.86229 17.252 6.2937 17.252H23.7061C24.1375 17.252 24.4874 16.9022 24.4874 16.4707C24.4874 16.0392 24.1375 15.6895 23.7061 15.6895H6.2937C5.86222 15.6895 5.51245 16.0392 5.51245 16.4707Z" fill="#F9AB97" />
                        <path d="M5.51245 9.78125C5.51245 10.2127 5.86229 10.5625 6.2937 10.5625H23.7061C24.1375 10.5625 24.4874 10.2127 24.4874 9.78125C24.4874 9.34977 24.1375 9 23.7061 9H6.2937C5.86222 9 5.51245 9.34977 5.51245 9.78125Z" fill="#F9AB97" />
                        <path d="M8.05322 35.6261C8.48471 35.6261 8.83447 35.2763 8.83447 34.8448V33.4981H9.62111C10.0525 33.4981 10.4024 33.1484 10.4024 32.7169C10.4024 32.2854 10.0525 31.9356 9.62111 31.9356H8.83447V31.4492H9.7565C10.1879 31.4492 10.5378 31.0995 10.5378 30.668C10.5378 30.2365 10.1879 29.8867 9.7565 29.8867H8.05322C7.62182 29.8867 7.27197 30.2365 7.27197 30.668V34.8448C7.27197 35.2763 7.62182 35.6261 8.05322 35.6261Z" fill="#F9AB97" />
                        <path d="M20.1791 35.6223H21.9466C22.378 35.6223 22.7278 35.2726 22.7278 34.8411C22.7278 34.4096 22.378 34.0598 21.9466 34.0598H20.9603V33.5377H21.8162C22.2476 33.5377 22.5974 33.188 22.5974 32.7565C22.5974 32.325 22.2476 31.9752 21.8162 31.9752H20.9603V31.4531H21.9466C22.378 31.4531 22.7278 31.1034 22.7278 30.6719C22.7278 30.2404 22.378 29.8906 21.9466 29.8906H20.1791C19.7477 29.8906 19.3978 30.2404 19.3978 30.6719V34.8411C19.3978 35.2726 19.7477 35.6223 20.1791 35.6223Z" fill="#F9AB97" />
                        <path d="M16.1265 35.6223H17.894C18.3254 35.6223 18.6752 35.2726 18.6752 34.8411C18.6752 34.4096 18.3254 34.0598 17.894 34.0598H16.9077V33.5377H17.7637C18.1951 33.5377 18.5449 33.188 18.5449 32.7565C18.5449 32.325 18.1951 31.9752 17.7637 31.9752H16.9077V31.4531H17.894C18.3254 31.4531 18.6752 31.1034 18.6752 30.6719C18.6752 30.2404 18.3254 29.8906 17.894 29.8906H16.1265C15.6951 29.8906 15.3452 30.2404 15.3452 30.6719V34.8411C15.3452 35.2726 15.6951 35.6223 16.1265 35.6223Z" fill="#F9AB97" />
                        <path d="M11.8131 35.6422C12.2445 35.6422 12.5943 35.2925 12.5943 34.861V34.3368L13.5171 35.3789C13.6714 35.5532 13.8863 35.6422 14.1022 35.6422C14.2863 35.6422 14.4712 35.5775 14.6198 35.4459C14.9429 35.1599 14.9729 34.6661 14.6867 34.3431L13.8528 33.4014C14.4654 33.0854 14.8831 32.4623 14.8831 31.7468C14.8831 30.7131 14.0111 29.8721 12.9393 29.8721H11.8144C11.8142 29.8721 11.8139 29.8721 11.8137 29.8721C11.8135 29.8721 11.8132 29.8721 11.813 29.8721C11.3815 29.8721 11.0317 30.2218 11.0317 30.6533V34.861C11.0318 35.2925 11.3817 35.6422 11.8131 35.6422ZM12.9394 31.4346C13.1425 31.4346 13.3206 31.5805 13.3206 31.7468C13.3206 31.9132 13.1425 32.0591 12.9394 32.0591C12.8539 32.0591 12.7319 32.0594 12.5993 32.06C12.5988 31.9375 12.5985 31.8257 12.5985 31.7468C12.5985 31.6778 12.5982 31.5636 12.5979 31.4345H12.9394V31.4346Z" fill="#F9AB97" />
                        <path d="M23.7062 18.8701H18.5317C18.1003 18.8701 17.7505 19.2199 17.7505 19.6514C17.7505 20.0828 18.1003 20.4326 18.5317 20.4326H23.7062C24.1376 20.4326 24.4874 20.0828 24.4874 19.6514C24.4874 19.2199 24.1376 18.8701 23.7062 18.8701Z" fill="#F9AB97" />
                        <path d="M23.7062 12.1807H18.5317C18.1003 12.1807 17.7505 12.5304 17.7505 12.9619C17.7505 13.3934 18.1003 13.7431 18.5317 13.7431H23.7062C24.1376 13.7431 24.4874 13.3934 24.4874 12.9619C24.4874 12.5304 24.1376 12.1807 23.7062 12.1807Z" fill="#F9AB97" />
                        <path d="M6.2937 20.4326H11.4682C11.8996 20.4326 12.2494 20.0828 12.2494 19.6514C12.2494 19.2199 11.8996 18.8701 11.4682 18.8701H6.2937C5.86229 18.8701 5.51245 19.2199 5.51245 19.6514C5.51245 20.0828 5.86222 20.4326 6.2937 20.4326Z" fill="#F9AB97" />
                        <path d="M6.2937 13.7431H11.4682C11.8996 13.7431 12.2494 13.3934 12.2494 12.9619C12.2494 12.5304 11.8996 12.1807 11.4682 12.1807H6.2937C5.86229 12.1807 5.51245 12.5304 5.51245 12.9619C5.51245 13.3934 5.86222 13.7431 6.2937 13.7431Z" fill="#F9AB97" />
                        <path d="M14.3648 20.0848C14.5452 20.3559 14.8883 20.4886 15.2041 20.4083C15.5167 20.3287 15.7523 20.061 15.7905 19.7404C15.8292 19.4165 15.6511 19.0945 15.3595 18.9504C15.0624 18.8035 14.6959 18.8651 14.4616 19.0988C14.2012 19.3587 14.161 19.7793 14.3648 20.0848Z" fill="#F9AB97" />
                        <path d="M14.3648 13.3954C14.5452 13.6665 14.8883 13.7991 15.2041 13.7188C15.5167 13.6393 15.7523 13.3715 15.7905 13.0509C15.8292 12.727 15.6511 12.405 15.3595 12.2609C15.0624 12.114 14.6959 12.1757 14.4616 12.4093C14.2012 12.6693 14.161 13.0898 14.3648 13.3954Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">Unlimited FREE Revisions</p>
                </li>

                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.6566 16.4707H17.6559C17.2244 16.4707 16.875 16.8204 16.875 17.252C16.875 17.6832 17.225 18.0332 17.6566 18.0332C18.0878 18.0332 18.4378 17.6832 18.4378 17.252C18.4378 16.8204 18.0878 16.4707 17.6566 16.4707Z" fill="#F9AB97" />
                        <path d="M22.3441 16.4707H22.3434C21.9119 16.4707 21.5625 16.8204 21.5625 17.252C21.5625 17.6832 21.9125 18.0332 22.3441 18.0332C22.7756 18.0332 23.1253 17.6832 23.1253 17.252C23.1253 16.8204 22.7756 16.4707 22.3441 16.4707Z" fill="#F9AB97" />
                        <path d="M20.3706 19.8505C20.2681 19.9402 20.1363 19.9896 19.9999 19.9896C19.8634 19.9896 19.7316 19.9402 19.6291 19.8505C19.304 19.5664 18.8106 19.5993 18.5268 19.9243C18.2426 20.249 18.2759 20.7428 18.6006 21.0266C18.9882 21.3654 19.485 21.5521 19.9999 21.5521C20.5147 21.5521 21.0115 21.3657 21.3988 21.0269C21.7238 20.7428 21.7571 20.2493 21.4729 19.9243C21.1888 19.5996 20.6953 19.5667 20.3706 19.8505Z" fill="#F9AB97" />
                        <path d="M37.1875 0H2.8125C2.38098 0 2.03125 0.349731 2.03125 0.78125V39.2188C2.03125 39.6503 2.38098 40 2.8125 40H37.1875C37.6187 40 37.9688 39.6503 37.9688 39.2188V0.78125C37.9688 0.349731 37.6187 0 37.1875 0ZM3.59375 2.66754L5.15625 4.23004V35.7703L3.59375 37.3325V2.66754ZM33.7387 3.125H14.5312C14.0997 3.125 13.75 3.47473 13.75 3.90625C13.75 4.33777 14.0997 4.6875 14.5312 4.6875H33.2812V35.3125H30.5948V30.5051C30.5948 29.1672 29.8624 28.0188 28.7289 27.579L27.6651 27.1661C28.8086 26.5384 29.61 25.4318 30.0262 23.8776C30.08 23.6774 30.0519 23.4644 29.9484 23.2849C29.3481 22.2452 29.0228 21.4053 29.0228 19.9472V15.3119C29.0228 10.3152 24.975 6.25 20 6.25C15.0247 6.25 10.9769 10.3152 10.9769 15.3119V19.9472C10.9769 21.4053 10.6516 22.2452 10.0516 23.2849C9.94781 23.4644 9.91974 23.6774 9.97345 23.8776C10.3897 25.4318 11.1911 26.5384 12.3346 27.1661L11.2708 27.579C10.1373 28.0188 9.40491 29.1672 9.40491 30.5051V35.3125H6.71875V4.6875H7.5C7.93152 4.6875 8.28125 4.33777 8.28125 3.90625C8.28125 3.47473 7.93152 3.125 7.5 3.125H6.26129L4.69879 1.5625H35.3012L33.7387 3.125ZM10.9677 35.3125V30.5051C10.9677 29.9576 11.1957 29.2841 11.8362 29.0356L14.2636 28.0936C14.4855 29.2673 15.0616 30.3418 15.9418 31.1923C16.0934 31.3388 16.2891 31.4117 16.4847 31.4117C16.6888 31.4117 16.893 31.3321 17.0462 31.1734C17.3462 30.863 17.3376 30.3687 17.0276 30.0687C16.3126 29.3774 15.8716 28.4848 15.7547 27.5146L16.7453 27.1304C16.9904 27.0352 17.2076 26.9067 17.399 26.7575L19.6313 27.9523C19.7467 28.0139 19.8734 28.0444 20 28.0444C20.1419 28.0444 20.2838 28.006 20.4089 27.9291L22.4799 26.6571C22.6987 26.85 22.9562 27.0145 23.2547 27.1304L24.2453 27.5146C24.1284 28.4848 23.6877 29.3771 22.9727 30.0681C22.6627 30.368 22.6544 30.8627 22.9541 31.1728C23.2541 31.4832 23.7488 31.4914 24.0588 31.1914C24.9387 30.3412 25.5145 29.267 25.7364 28.0936L28.1638 29.0356C28.804 29.2841 29.0323 29.9576 29.0323 30.5051V35.3125H10.9677ZM11.5707 23.7708C12.1732 22.6666 12.5394 21.5942 12.5394 19.9475V15.3119C12.5394 11.1768 15.8862 7.8125 20 7.8125C24.1135 7.8125 27.4603 11.1768 27.4603 15.3119V19.9475C27.4603 21.5942 27.8265 22.6669 28.4293 23.7708C27.9105 25.3671 26.8506 26.1667 25.1999 26.2094L23.8199 25.6738C23.3688 25.4987 23.1735 25.0522 23.1735 24.863V23.1552C23.432 22.9749 23.685 22.7783 23.9273 22.5668C25.4248 21.2592 26.2497 19.6722 26.2497 18.0978V15.2731C26.2497 14.8416 25.9 14.4919 25.4684 14.4919C23.8879 14.4919 21.2732 14.0524 19.92 12.9202C19.9118 12.9123 19.9033 12.9044 19.8947 12.8964C19.877 12.8806 19.8587 12.8656 19.8404 12.8516C19.624 12.6587 19.4437 12.4466 19.3103 12.2144C19.0952 11.8402 18.6179 11.7114 18.2434 11.9263C17.8696 12.1411 17.7405 12.6187 17.9553 12.9929C18.0469 13.1519 18.1494 13.3029 18.262 13.447C17.3056 14.2038 15.9851 14.6277 14.5312 14.6277C14.1 14.6277 13.75 14.9774 13.75 15.4089V18.0978C13.75 19.6722 14.5749 21.2592 16.0727 22.5668C16.315 22.7783 16.5677 22.9749 16.8262 23.1552V24.863C16.8262 25.0522 16.6312 25.4987 16.1801 25.6738L14.8001 26.2094C13.1491 26.1667 12.0892 25.3671 11.5707 23.7708ZM22.8998 21.3895C21.8311 22.3227 20.632 22.8107 20 22.8107C19.368 22.8107 18.1689 22.3227 17.1002 21.3895C16.4325 20.8066 15.3125 19.6042 15.3125 18.0975V16.1554C16.9119 16.0129 18.3578 15.4333 19.4345 14.5038C20.9708 15.5157 23.1018 15.9277 24.6872 16.0284V18.0975C24.6872 19.6042 23.5672 20.8066 22.8998 21.3895ZM18.3887 24.863V24.0118C18.9645 24.2438 19.5197 24.3732 20 24.3732C20.48 24.3732 21.0352 24.2438 21.6113 24.0118V24.863C21.6113 25.0104 21.6306 25.1651 21.6675 25.3226L19.9731 26.3629L18.2935 25.4642C18.356 25.2585 18.3887 25.0543 18.3887 24.863ZM6.26099 36.875H33.7387L35.3012 38.4375H4.69849L6.26099 36.875ZM34.8438 35.77V4.23004L36.4062 2.66754V37.3325L34.8438 35.77Z" fill="#F9AB97" />
                        <path d="M11.0159 3.125H11.0153C10.5838 3.125 10.2344 3.47473 10.2344 3.90625C10.2344 4.33777 10.5844 4.6875 11.0159 4.6875C11.4474 4.6875 11.7972 4.33777 11.7972 3.90625C11.7972 3.47473 11.4474 3.125 11.0159 3.125Z" fill="#F9AB97" />
                        <path d="M20.0005 31.2705H19.9999C19.5684 31.2705 19.219 31.6205 19.219 32.0518C19.219 32.4833 19.569 32.833 20.0005 32.833C20.4321 32.833 20.7818 32.4833 20.7818 32.0518C20.7818 31.6205 20.4318 31.2705 20.0005 31.2705Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">Paint Your Personal Portrait</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.3867 6.68788C18.3358 6.68788 18.2851 6.68239 18.2341 6.67232C18.1844 6.66194 18.1349 6.6473 18.0883 6.62776C18.0413 6.60823 17.9961 6.58382 17.9531 6.55574C17.9109 6.52767 17.8704 6.49501 17.8344 6.459C17.6891 6.31374 17.6055 6.11202 17.6055 5.90663C17.6055 5.85567 17.611 5.8044 17.621 5.75343C17.6311 5.70339 17.6461 5.65425 17.6656 5.60725C17.6851 5.56056 17.7092 5.51509 17.7373 5.47237C17.7657 5.42995 17.7983 5.39027 17.8344 5.35335C17.8704 5.31764 17.9109 5.2856 17.9531 5.25661C17.9961 5.22853 18.0413 5.20412 18.0883 5.18459C18.1353 5.16505 18.1844 5.15041 18.2341 5.14034C18.3351 5.11989 18.4389 5.11989 18.5396 5.14034C18.5897 5.15041 18.6388 5.16505 18.6858 5.18459C18.7328 5.20412 18.778 5.22853 18.821 5.25661C18.8631 5.2856 18.9031 5.31764 18.9397 5.35335C18.9757 5.39027 19.0077 5.42995 19.0367 5.47237C19.0648 5.51509 19.0889 5.56056 19.1085 5.60725C19.128 5.65425 19.1429 5.70339 19.153 5.75343C19.1631 5.8044 19.1686 5.85567 19.1686 5.90663C19.1686 6.11202 19.085 6.31374 18.9397 6.459C18.9031 6.49501 18.8631 6.52767 18.821 6.55574C18.778 6.58382 18.7328 6.60823 18.6858 6.62776C18.6388 6.6473 18.5897 6.66194 18.5396 6.67232C18.489 6.68239 18.4383 6.68788 18.3867 6.68788Z" fill="#F9AB97" />
                        <path d="M14.0836 20.683C13.6362 20.683 13.1891 20.5131 12.8489 20.1725C12.5437 19.8676 12.5437 19.3729 12.8489 19.0677C13.1537 18.7626 13.6484 18.7626 13.9536 19.0677C14.0253 19.1395 14.1419 19.1395 14.2136 19.0677C14.5185 18.7626 15.0132 18.7626 15.3184 19.0677C15.6235 19.3729 15.6235 19.8676 15.3184 20.1725C14.9778 20.5131 14.5307 20.683 14.0836 20.683Z" fill="#F9AB97" />
                        <path d="M17.2583 16.8005C16.8112 16.8005 16.3641 16.6302 16.0236 16.29C15.7184 15.9848 15.7184 15.4901 16.0236 15.1849C16.3287 14.8798 16.8234 14.8798 17.1283 15.1849C17.2 15.2567 17.3166 15.2567 17.3883 15.1849C17.6935 14.8798 18.1882 14.8798 18.4934 15.1849C18.7982 15.4901 18.7982 15.9848 18.4934 16.29C18.1528 16.6302 17.7057 16.8005 17.2583 16.8005Z" fill="#F9AB97" />
                        <path d="M10.9086 16.8005C10.4612 16.8005 10.0141 16.6302 9.67383 16.29C9.36865 15.9848 9.36865 15.4901 9.67383 15.1849C9.9787 14.8798 10.4734 14.8798 10.7786 15.1849C10.8503 15.2567 10.9669 15.2567 11.0386 15.1849C11.3434 14.8798 11.8381 14.8798 12.1433 15.1849C12.4485 15.4901 12.4485 15.9848 12.1433 16.29C11.8027 16.6302 11.3557 16.8005 10.9086 16.8005Z" fill="#F9AB97" />
                        <path d="M25.5429 18.1973V12.3969C25.5429 6.07819 20.4022 0.9375 14.0836 0.9375C7.7649 0.9375 2.62421 6.07819 2.62421 12.3969V18.1973C1.0141 19.0689 0 20.7486 0 22.6102C0 23.7576 0.397339 24.8798 1.11847 25.7697C1.5863 26.3468 2.17713 26.8118 2.83905 27.132C2.36237 27.8223 2.08313 28.6585 2.08313 29.559V38.3518C2.08313 38.7833 2.43286 39.133 2.86408 39.133H25.3024C25.734 39.133 26.0837 38.7833 26.0837 38.3518V29.559C26.0837 28.6585 25.8045 27.8223 25.3278 27.132C25.9891 26.8118 26.5799 26.3474 27.0474 25.7706C27.7695 24.8807 28.1668 23.7583 28.1668 22.6105C28.1668 20.7486 27.1527 19.0692 25.5429 18.1973ZM12.2165 21.9293C10.011 21.2744 8.27698 19.4867 7.69165 17.2632C7.61292 16.9644 7.36573 16.7401 7.06086 16.691C6.66108 16.6263 6.37085 16.2845 6.37085 15.8783C6.37085 15.5216 6.59851 15.2069 6.93756 15.0958C7.25861 14.9909 7.4759 14.6915 7.4759 14.3536V14.2352C8.36701 14.1003 9.84772 13.7051 10.9873 12.5452C11.4374 12.0868 11.7905 11.5576 12.0453 10.9604C13.8275 13.1354 17.4771 14.3048 20.2112 14.3048H20.6912V14.3536C20.6912 14.6915 20.9082 14.9909 21.2293 15.0961C21.5683 15.2069 21.7963 15.5216 21.7963 15.8783C21.7963 16.2845 21.5061 16.6263 21.1063 16.691C20.8014 16.7401 20.5539 16.9644 20.4755 17.2632C19.8898 19.4867 18.1561 21.2747 15.9503 21.9293C15.5881 22.0371 15.3546 22.3886 15.3961 22.7643L15.7697 26.1447C15.8133 26.5405 16.1478 26.8402 16.546 26.8402H21.8024C23.234 26.8402 24.4104 27.9523 24.5139 29.3579H3.65296C3.75611 27.9523 4.93286 26.8402 6.36475 26.8402H11.6208C12.019 26.8402 12.3535 26.5405 12.3975 26.1447L12.7707 22.7643C12.8122 22.3883 12.5787 22.0371 12.2165 21.9293ZM3.64563 34.6991H6.13983V37.5705H3.64563V34.6991ZM7.70234 37.5708V33.9179C7.70234 33.4863 7.3526 33.1366 6.92109 33.1366H3.64563V30.9201H24.5212V33.1366H21.2457C20.8142 33.1366 20.4645 33.4863 20.4645 33.9179V37.5708H7.70234ZM22.027 37.5708V34.6991H24.5212V37.5708H22.027ZM24.0866 25.939C23.4253 25.5203 22.6416 25.2774 21.8024 25.2774H17.2458L17.0178 23.2141C19.3042 22.3267 21.1008 20.4315 21.8588 18.0951C22.7521 17.7417 23.3588 16.8771 23.3588 15.8783C23.3588 15.0467 22.9318 14.2947 22.2537 13.8648V11.9888C22.2537 11.9678 22.2528 11.9467 22.2513 11.926V11.8979C22.2513 10.4642 21.8735 9.05427 21.1591 7.81983C20.943 7.4466 20.4651 7.31903 20.0916 7.5351C19.718 7.75147 19.5908 8.22937 19.8068 8.6026C20.3839 9.59931 20.6888 10.7388 20.6888 11.8979V12.7423H20.2112C17.1152 12.7423 12.587 10.9576 12.5378 8.16102C12.5302 7.7298 12.1722 7.38709 11.7429 7.3938C11.3113 7.40143 10.968 7.75727 10.9757 8.18879C11.0001 9.57764 10.632 10.672 9.8819 11.441C9.14063 12.2006 8.15583 12.5171 7.47834 12.6486V11.8988C7.48291 8.266 10.4401 5.31037 14.0711 5.31037H14.1013C14.5535 5.31037 15.0052 5.35614 15.4437 5.44678C15.8661 5.53467 16.2796 5.26276 16.3669 4.84009C16.4542 4.41742 16.1826 4.00421 15.7599 3.91693C15.2176 3.80463 14.6597 3.74787 14.1013 3.74787H14.0711C9.60419 3.74787 5.96131 7.36359 5.91645 11.8243C5.91462 11.8466 5.91339 11.8692 5.91339 11.8918V13.8648C5.23529 14.2947 4.80835 15.0467 4.80835 15.8783C4.80835 16.8771 5.41535 17.7414 6.30829 18.0951C7.06635 20.4315 8.86322 22.3267 11.1493 23.2141L10.9213 25.2774H6.36475C5.52552 25.2774 4.74182 25.52 4.0802 25.939C2.61078 25.524 1.5625 24.1528 1.5625 22.6102C1.5625 21.2036 2.40265 19.9481 3.70301 19.4119C3.99567 19.2911 4.1864 19.0061 4.1864 18.6896V12.3969C4.1864 6.9397 8.6261 2.4997 14.0836 2.4997C19.5407 2.4997 23.9804 6.9397 23.9804 12.3969V18.6896C23.9804 19.0061 24.1715 19.2911 24.4638 19.4119C25.7642 19.9481 26.6043 21.2036 26.6043 22.6102C26.6046 24.1532 25.5564 25.524 24.0866 25.939Z" fill="#F9AB97" />
                        <path d="M33.5945 14.4826C32.9301 14.4826 32.2548 14.3782 31.5904 14.1585C30.6282 13.8402 29.7557 13.2982 29.0483 12.5823L26.4583 12.4331C26.1799 12.4169 25.9309 12.2533 25.8055 12.004C25.6801 11.755 25.6971 11.4574 25.8507 11.2243L27.2749 9.05598C27.122 8.06141 27.2072 7.03754 27.5255 6.07563C28.6332 2.72663 32.2587 0.902896 35.6083 2.01069C37.2307 2.54718 38.5472 3.68335 39.3147 5.21015C40.0825 6.73695 40.2098 8.47095 39.6733 10.0936C38.7852 12.7779 36.2791 14.4826 33.5945 14.4826ZM27.8993 10.9511L29.4496 11.0405C29.6568 11.0524 29.8506 11.1464 29.9885 11.3015C30.5498 11.9329 31.2736 12.408 32.0811 12.6751C34.6123 13.5125 37.3527 12.134 38.1898 9.60285C38.5954 8.37666 38.4993 7.06592 37.9188 5.91205C37.3387 4.75818 36.3438 3.89942 35.1176 3.49384C32.5865 2.65674 29.846 4.03492 29.0089 6.56635C28.7416 7.37385 28.6915 8.2378 28.8637 9.06513C28.9061 9.26838 28.8658 9.47987 28.752 9.65321L27.8993 10.9511Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">We Fulfill All Client’s Desires</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.3012 17.1053C22.5266 16.7152 22.6562 16.2632 22.6562 15.7812C22.6562 14.9528 22.2748 14.2119 21.6786 13.7244L28.8714 8.9193C29.0884 8.77437 29.2187 8.53055 29.2187 8.26969V0.78125C29.2187 0.349844 28.8688 0 28.4374 0H11.5625C11.1311 0 10.7812 0.349844 10.7812 0.78125V8.26977C10.7812 8.5307 10.9116 8.77445 11.1285 8.91937L18.3213 13.7245C17.7252 14.2119 17.3438 14.9528 17.3438 15.7812C17.3438 16.2632 17.4734 16.7152 17.6988 17.1053C12.4219 18.1752 8.4375 22.8497 8.4375 28.4375C8.4375 34.813 13.6245 40 20 40C26.3755 40 31.5625 34.813 31.5625 28.4375C31.5625 22.8497 27.5781 18.1752 22.3012 17.1053ZM24.2188 1.5625H27.6562V7.85211L24.2188 10.1484V1.5625ZM12.3438 7.85211V1.5625H15.7812V5.8725C15.7812 6.30391 16.1311 6.65375 16.5625 6.65375C16.9939 6.65375 17.3438 6.30391 17.3438 5.8725V1.5625H22.6562V11.1923L20 12.9667L12.3438 7.85211ZM21.0938 15.7812C21.0938 16.3844 20.6031 16.875 20 16.875C19.3969 16.875 18.9062 16.3844 18.9062 15.7812C18.9062 15.1781 19.3969 14.6875 20 14.6875C20.6031 14.6875 21.0938 15.1781 21.0938 15.7812ZM20 38.4375C14.486 38.4375 10 33.9515 10 28.4375C10 22.9235 14.486 18.4375 20 18.4375C25.514 18.4375 30 22.9235 30 28.4375C30 33.9515 25.514 38.4375 20 38.4375Z" fill="#F9AB97" />
                        <path d="M25.4482 21.9475L25.4424 21.9416C25.1372 21.6366 24.6427 21.6366 24.3374 21.9416C24.0324 22.2467 24.0324 22.7414 24.3374 23.0466L24.3434 23.0524C24.496 23.2049 24.6959 23.2812 24.8958 23.2812C25.0957 23.2812 25.2956 23.2049 25.4482 23.0524C25.7533 22.7473 25.7533 22.2527 25.4482 21.9475Z" fill="#F9AB97" />
                        <path d="M27.4861 24.5423C27.2866 24.1597 26.8148 24.0113 26.4322 24.2107C26.0496 24.4102 25.9011 24.882 26.1006 25.2646C26.6145 26.2503 26.875 27.3179 26.875 28.4379C26.875 32.2288 23.7909 35.3129 20 35.3129C19.5686 35.3129 19.2188 35.6628 19.2188 36.0942C19.2188 36.5256 19.5686 36.8754 20 36.8754C24.6525 36.8754 28.4375 33.0904 28.4375 28.4379C28.4375 27.0832 28.1085 25.7362 27.4861 24.5423Z" fill="#F9AB97" />
                        <path d="M15.1375 33.297L15.1325 33.292C14.8274 32.987 14.3353 32.9895 14.0302 33.2945C13.7251 33.5995 13.7276 34.0968 14.0327 34.4019C14.1853 34.5544 14.3852 34.6307 14.5851 34.6307C14.785 34.6307 14.9849 34.5544 15.1375 34.4019C15.4426 34.0968 15.4426 33.6021 15.1375 33.297Z" fill="#F9AB97" />
                        <path d="M20 20C15.3475 20 11.5625 23.785 11.5625 28.4375C11.5625 29.6547 11.8162 30.8295 12.3168 31.9292C12.4478 32.217 12.7315 32.387 13.0283 32.387C13.1366 32.387 13.2466 32.3644 13.3515 32.3166C13.7442 32.138 13.9177 31.6748 13.7389 31.282C13.3316 30.3869 13.125 29.4298 13.125 28.4375C13.125 24.6466 16.2091 21.5625 20 21.5625C20.4314 21.5625 20.7812 21.2127 20.7812 20.7813C20.7812 20.3498 20.4314 20 20 20Z" fill="#F9AB97" />
                        <path d="M21.6944 30.7952H20.7936V25.2978C20.7936 24.9818 20.6032 24.697 20.3113 24.576C20.0194 24.4552 19.6834 24.522 19.4599 24.7454L17.5789 26.6264C17.2738 26.9315 17.2738 27.4262 17.5789 27.7313C17.8841 28.0363 18.3786 28.0363 18.6838 27.7313L19.2312 27.184V30.7953H18.3304C17.899 30.7953 17.5491 31.1452 17.5491 31.5766C17.5491 32.008 17.899 32.3578 18.3304 32.3578H21.6944V32.3578C22.1258 32.3578 22.4756 32.0079 22.4756 31.5765C22.4756 31.1451 22.1258 30.7952 21.6944 30.7952Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">We Work Only With The Best Artists</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M39.2163 7H9.82151C9.38877 7 9.03782 7.36053 9.03782 7.80507V12.802L6.11485 17.4045L0.556389 19.1354C0.307061 19.2131 0.111748 19.4128 0.0348442 19.6686C-0.04206 19.9244 0.010125 20.2028 0.173699 20.411L3.81902 25.0559L3.70397 31.0215C3.69878 31.2889 3.8236 31.5416 4.03661 31.6958C4.17058 31.7924 4.32836 31.8422 4.48766 31.8422C4.58165 31.8422 4.67626 31.825 4.76689 31.7896L10.1935 29.6631L15.6806 31.619C15.9269 31.7068 16.1994 31.6632 16.4078 31.5027C16.6162 31.3419 16.7334 31.0854 16.7203 30.8183L16.543 27.1927H25.4465L35.444 32.8987C35.5634 32.9668 35.6943 33 35.8246 33C36.0111 33 36.196 32.9317 36.3425 32.799C36.5915 32.5739 36.6754 32.2122 36.5521 31.8958L34.7205 27.1927H39.2163C39.649 27.1927 40 26.8322 40 26.3879V7.80507C40 7.36053 39.6494 7 39.2163 7ZM10.4377 28.046C10.2637 27.984 10.0739 27.9868 9.90177 28.0542L5.29424 29.8596L5.39189 24.7947C5.39556 24.6053 5.33421 24.421 5.21825 24.2737L2.12316 20.3298L6.84239 18.8601C7.01878 18.8052 7.17076 18.6883 7.27147 18.5297L9.96617 14.287L12.7851 18.4438C12.8904 18.599 13.0457 18.7112 13.2236 18.7607L17.984 20.0821L15.0071 24.121C14.8957 24.2718 14.8398 24.458 14.849 24.6474L15.0968 29.7067L10.4377 28.046ZM38.4326 25.5825H33.5632C33.3032 25.5825 33.06 25.7151 32.9141 25.9365C32.7686 26.1575 32.739 26.4387 32.8357 26.6867L34.2783 30.3913L26.03 25.6841C25.9137 25.6176 25.7828 25.5825 25.6494 25.5825H16.464L16.4286 24.859L19.935 20.1025C20.0922 19.889 20.1361 19.6094 20.0519 19.3561C19.9677 19.1028 19.7663 18.909 19.5148 18.8394L13.9078 17.2829L10.6049 12.4126V8.61015H38.4326V25.5825Z" fill="#F9AB97" />
                        <path d="M18.3328 13.8972H29.1479C29.5806 13.8972 29.9316 13.5462 29.9316 13.1138C29.9316 12.681 29.5806 12.3301 29.1479 12.3301H18.3328C17.9 12.3301 17.5491 12.681 17.5491 13.1138C17.5491 13.5462 17.9 13.8972 18.3328 13.8972Z" fill="#F9AB97" />
                        <path d="M18.3328 17.5664H33.9499C34.3826 17.5664 34.7332 17.2154 34.7332 16.7827C34.7332 16.35 34.3826 15.999 33.9499 15.999H18.3328C17.9 15.999 17.5491 16.35 17.5491 16.7827C17.5491 17.2154 17.9 17.5664 18.3328 17.5664Z" fill="#F9AB97" />
                        <path d="M26.141 19.9551C25.7083 19.9551 25.3573 20.3057 25.3573 20.7385C25.3573 21.1712 25.7083 21.5222 26.141 21.5222H34.2654C34.6984 21.5222 35.0491 21.1712 35.0491 20.7385C35.0491 20.3057 34.6984 19.9551 34.2654 19.9551H26.141Z" fill="#F9AB97" />
                        <path d="M22.9568 19.9551C22.7508 19.9551 22.5485 20.039 22.4029 20.1846C22.257 20.3304 22.1731 20.5328 22.1731 20.7388C22.1731 20.9448 22.257 21.1471 22.4029 21.2927C22.5485 21.4385 22.7508 21.5225 22.9568 21.5225C23.1628 21.5225 23.3651 21.4385 23.511 21.2927C23.6565 21.1471 23.7405 20.9448 23.7405 20.7388C23.7405 20.5328 23.6565 20.3304 23.511 20.1846C23.3651 20.039 23.1628 19.9551 22.9568 19.9551Z" fill="#F9AB97" />
                        <path d="M12.0007 23.667C11.7941 23.667 11.5917 23.7509 11.4459 23.8968C11.3003 24.0424 11.2173 24.2447 11.2173 24.4507C11.2173 24.6576 11.3003 24.8596 11.4459 25.0046C11.5917 25.1511 11.7941 25.2344 12.0007 25.2344C12.207 25.2344 12.4084 25.1511 12.5549 25.0046C12.7007 24.859 12.7844 24.6576 12.7844 24.4507C12.7844 24.2447 12.7007 24.0424 12.5549 23.8968C12.409 23.7509 12.207 23.667 12.0007 23.667Z" fill="#F9AB97" />
                        <path d="M12.7842 21.2905C12.7842 20.8578 12.4332 20.5068 12.0005 20.5068H7.64258C7.20984 20.5068 6.85889 20.8578 6.85889 21.2905C6.85889 21.7233 7.20984 22.0739 7.64258 22.0739H12.0005C12.4332 22.0739 12.7842 21.7233 12.7842 21.2905Z" fill="#F9AB97" />
                        <path d="M8.64386 23.7041H7.64258C7.20984 23.7041 6.85889 24.0551 6.85889 24.4878C6.85889 24.9205 7.20984 25.2715 7.64258 25.2715H8.64386C9.0766 25.2715 9.42755 24.9205 9.42755 24.4878C9.42755 24.0551 9.0766 23.7041 8.64386 23.7041Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">Best Rating on Proven Expert.com</p>
                </li>
                <li class="benefit-card">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.2594 33.1072C35.1704 27.671 29.6123 26.0649 25.5539 24.8921C25.0803 24.7553 24.6249 24.6237 24.1982 24.4923V22.2497C25.0279 21.7296 25.7549 21.0603 26.3414 20.2796H28.8136C30.0234 20.2796 31.0077 19.2953 31.0077 18.0855V15.4296C31.1543 15.0877 31.2358 14.7115 31.2358 14.3164V13.4904C31.2358 13.0957 31.1543 12.7197 31.0077 12.378V11.0079C31.0077 4.93814 26.0697 0 20.0001 0C13.9316 0 8.99465 4.93814 8.99465 11.0079V12.3389C8.99465 12.3493 8.99582 12.3594 8.99621 12.3698C8.8473 12.7137 8.76433 13.0925 8.76433 13.4904V14.3165C8.76433 15.878 10.0337 17.1483 11.594 17.1483H12.2396C12.6868 19.2927 14.0033 21.1216 15.8019 22.2493V24.4923C15.3751 24.6237 14.9198 24.7553 14.4463 24.8921C10.3879 26.0649 4.82971 27.671 4.7408 33.1072C4.74072 33.1115 4.74072 33.1157 4.74072 33.12V39.2187C4.74072 39.6502 5.09057 40 5.52198 40H7.83823C8.26964 40 8.61949 39.6502 8.61949 39.2187C8.61949 38.7873 8.26964 38.4375 7.83823 38.4375H6.30315V33.1265C6.33604 31.2298 7.20729 29.808 9.04488 28.6521C10.2575 27.8894 11.7399 27.346 13.2011 26.8914L15.0887 30.569C15.2991 30.979 15.8378 31.1182 16.2206 30.86L17.0623 30.2922L17.7848 33.0081L16.5468 38.4374H14.8537C14.4222 38.4374 14.0724 38.7872 14.0724 39.2187C14.0724 39.6502 14.4222 39.9999 14.8537 39.9999H34.4782C34.9096 39.9999 35.2594 39.6502 35.2594 39.2187V33.1199C35.2594 33.1157 35.2594 33.1115 35.2594 33.1072ZM25.1201 26.3932C25.1716 26.408 25.2239 26.4232 25.2758 26.4382L23.9252 29.0721L21.3978 27.3678L23.5393 25.9234C24.0368 26.0799 24.5659 26.233 25.1201 26.3932ZM20.0006 28.3103L21.5672 29.3667L20.8101 32.2125H19.1901L18.4332 29.3675L20.0006 28.3103ZM20.0005 26.4257L17.3644 24.6481V23.0034C18.1894 23.2952 19.0762 23.4552 20 23.4552C20.9237 23.4552 21.8106 23.2957 22.6356 23.0039V24.6481L20.0005 26.4257ZM26.3649 11.1508C26.3542 11.144 26.3435 11.1372 26.3328 11.1304C24.7298 10.11 23.3452 9.22863 21.1759 9.84934C21.1557 9.85512 21.1357 9.86168 21.1161 9.86902C20.6562 10.0418 20.238 10.2028 19.8334 10.3585C17.3629 11.3095 16.014 11.8289 13.6352 11.762V11.1364C13.6352 7.62667 16.4905 4.77135 20 4.77135C23.5095 4.77135 26.3648 7.62667 26.3648 11.1364V11.1508H26.3649ZM29.4452 18.0855C29.4452 18.4338 29.1619 18.7171 28.8136 18.7171H27.2567C27.4766 18.2187 27.6469 17.6938 27.7607 17.1483H28.4063C28.7731 17.1483 29.1233 17.0773 29.4453 16.9496V18.0855H29.4452ZM29.6733 14.3164C29.6733 15.0163 29.105 15.5858 28.4062 15.5858H27.9267C27.9268 15.5664 27.9275 12.2232 27.9275 12.2232H28.4063C29.105 12.2232 29.6734 12.7916 29.6734 13.4904V14.3164H29.6733ZM11.594 15.5858C10.8953 15.5858 10.3268 15.0164 10.3268 14.3165V13.4904C10.3268 12.7917 10.8952 12.2233 11.594 12.2233H12.0728C12.0728 12.2233 12.0734 15.5665 12.0736 15.5858H11.594ZM12.0874 10.6607H11.5939C11.2286 10.6607 10.8798 10.731 10.559 10.8575C10.6397 5.71846 14.8435 1.56251 20.0001 1.56251C25.1581 1.56251 29.3631 5.71893 29.4432 10.8584C29.1219 10.7313 28.7722 10.6607 28.4062 10.6607H27.9127C27.6658 6.51003 24.2114 3.20884 20.0001 3.20884C15.7887 3.20884 12.3343 6.5101 12.0874 10.6607ZM13.6822 16.2878C13.6822 16.287 13.682 16.2862 13.6819 16.2855C13.6523 16.0368 13.6353 15.7843 13.6353 15.5278V13.3244C16.3082 13.3896 17.9026 12.7761 20.3948 11.8168C20.7873 11.6657 21.193 11.5095 21.6349 11.3433C23.1107 10.9314 23.9599 11.4721 25.4938 12.4486C25.7599 12.618 26.0519 12.8037 26.3649 12.9944V15.5278C26.3649 16.6896 26.0505 17.7787 25.5046 18.7172H20.0001C19.5687 18.7172 19.2188 19.0669 19.2188 19.4984C19.2188 19.9299 19.5687 20.2797 20.0001 20.2797H24.2285C23.1034 21.2821 21.622 21.8928 20.0001 21.8928C16.7478 21.8927 14.0592 19.4402 13.6822 16.2878ZM16.0768 29.0722L14.7247 26.4381C14.7765 26.4232 14.8287 26.408 14.8801 26.3932C15.4343 26.233 15.9633 26.0799 16.461 25.9233L18.6034 27.368L16.0768 29.0722ZM18.1494 38.4375L19.2127 33.775H20.7877L21.8526 38.4375H18.1494ZM33.6969 38.4375H23.4553L22.2153 33.008L22.9382 30.2911L23.7819 30.86C24.1649 31.1182 24.7035 30.9789 24.9138 30.5688L26.7993 26.8915C28.2605 27.3461 29.7429 27.8895 30.9554 28.6521C32.7929 29.8079 33.6642 31.2298 33.6971 33.1265V38.4375H33.6969Z" fill="#F9AB97" />
                        <path d="M30.6118 34.5303H26.6746C26.2432 34.5303 25.8933 34.88 25.8933 35.3115C25.8933 35.743 26.2432 36.0928 26.6746 36.0928H30.6118C31.0432 36.0928 31.3931 35.743 31.3931 35.3115C31.3931 34.88 31.0433 34.5303 30.6118 34.5303Z" fill="#F9AB97" />
                        <path d="M11.3459 38.4375C10.9145 38.4375 10.5647 38.7873 10.5647 39.2188C10.5647 39.6502 10.9145 40 11.3459 40H11.3481C11.7795 40 12.1282 39.6502 12.1282 39.2188C12.1282 38.7873 11.7774 38.4375 11.3459 38.4375Z" fill="#F9AB97" />
                    </svg>
                    <p class="h6 benefit-card__descr">Excellent Customer Service</p>
                </li>

            </ul>
            <div class="benefits__actions">
                <a href="#" class="btn btn--accent-border">Order Now</a>
            </div>
        </div>
    </section>
    <!-- End name section -->
    <!-- Start team section -->
    <section class="section team ">
        <div class="section-inner team-inner">
            <div class="team__label">
                <p class="vertical-label"> оur pride</p>
            </div>
            <h2 class="team__title">
                Our Artist who Paint Your Portrait
            </h2>
            <!-- Swiper -->
            <div class="team-slider-wrap">
                <div class="team__picture-slider-wrap">
                    <div class="swiper-container team__picture-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide member__photo">
                                <div class="member__img_wrap">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/teams/artist1.jpg" alt="">
                                </div>
                                <div class="member__text_wrap">

                                    <div class="member__dectp_description">
                                        <h3 class="h5 member__title">
                                            Anna Saturday
                                        </h3>
                                        <div class="member__quote">
                                            <i> If you are looking for a person who can’t see their life without creating a masterpiece,
                                                Anna Saturday is exactly
                                                who you need!</i>
                                        </div>
                                        <p>
                                            All his works are a piece of art that might look like photography at first, but each
                                            portrait is actually created
                                            using oil paint. Anna Saturday captures every detail of the artist’s subjects, such as their
                                            soft skin, strands of
                                            hair, and textured clothing.
                                        </p>
                                        <p>
                                            Order a detailed portrait that emphasizes all the beauty and natural body lines. This guy
                                            will create whatever
                                            your
                                            heart desires!
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="swiper-slide member__photo">
                                <div class="member__img_wrap">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/teams/artist2.jpg" alt="">
                                </div>
                                <div class="member__text_wrap">

                                    <div class="member__dectp_description">
                                        <h3 class="h5 member__title">
                                            Anna Saturday
                                        </h3>
                                        <div class="member__quote">
                                            <i> If you are looking for a person who can’t see their life without creating a masterpiece,
                                                Anna Saturday is exactly
                                                who you need!</i>
                                        </div>
                                        <p>
                                            All his works are a piece of art that might look like photography at first, but each
                                            portrait is actually created
                                            using oil paint. Anna Saturday captures every detail of the artist’s subjects, such as their
                                            soft skin, strands of
                                            hair, and textured clothing.
                                        </p>
                                        <p>
                                            Order a detailed portrait that emphasizes all the beauty and natural body lines. This guy
                                            will create whatever
                                            your
                                            heart desires!
                                        </p>
                                    </div>
                                </div>


                            </div>
                            <div class="swiper-slide member__photo">
                                <div class="member__img_wrap">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/teams/artist3.jpg" alt="">
                                </div>
                                <div class="member__text_wrap">

                                    <div class="member__dectp_description">
                                        <h3 class="h5 member__title">
                                            Anna Saturday
                                        </h3>
                                        <div class="member__quote">
                                            <i> If you are looking for a person who can’t see their life without creating a masterpiece,
                                                Anna Saturday is exactly
                                                who you need!</i>
                                        </div>
                                        <p>
                                            All his works are a piece of art that might look like photography at first, but each
                                            portrait is actually created
                                            using oil paint. Anna Saturday captures every detail of the artist’s subjects, such as their
                                            soft skin, strands of
                                            hair, and textured clothing.
                                        </p>
                                        <p>
                                            Order a detailed portrait that emphasizes all the beauty and natural body lines. This guy
                                            will create whatever
                                            your
                                            heart desires!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide member__photo">
                                <div class="member__img_wrap">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/teams/artist4.jpg" alt="">
                                </div>
                                <div class="member__text_wrap">

                                    <div class="member__dectp_description">
                                        <h3 class="h5 member__title">
                                            Anna Saturday
                                        </h3>
                                        <div class="member__quote">
                                            <i> If you are looking for a person who can’t see their life without creating a masterpiece,
                                                Anna Saturday is exactly
                                                who you need!</i>
                                        </div>
                                        <p>
                                            All his works are a piece of art that might look like photography at first, but each
                                            portrait is actually created
                                            using oil paint. Anna Saturday captures every detail of the artist’s subjects, such as their
                                            soft skin, strands of
                                            hair, and textured clothing.
                                        </p>
                                        <p>
                                            Order a detailed portrait that emphasizes all the beauty and natural body lines. This guy
                                            will create whatever
                                            your
                                            heart desires!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide member__photo">
                                <div class="member__img_wrap">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/teams/artist5.jpg" alt="">
                                </div>
                                <div class="member__text_wrap">

                                    <div class="member__dectp_description">
                                        <h3 class="h5 member__title">
                                            Anna Saturday
                                        </h3>
                                        <div class="member__quote">
                                            <i> If you are looking for a person who can’t see their life without creating a masterpiece,
                                                Anna Saturday is exactly
                                                who you need!</i>
                                        </div>
                                        <p>
                                            All his works are a piece of art that might look like photography at first, but each
                                            portrait is actually created
                                            using oil paint. Anna Saturday captures every detail of the artist’s subjects, such as their
                                            soft skin, strands of
                                            hair, and textured clothing.
                                        </p>
                                        <p>
                                            Order a detailed portrait that emphasizes all the beauty and natural body lines. This guy
                                            will create whatever
                                            your
                                            heart desires!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- End team section -->
    <!-- Start name section -->
    <section class="section img-text ">
        <div class="section-inner">

            <div class="img-text-inner">
                <div class="img-text__label">
                    <p class="vertical-label">your sharing</p>
                </div>

                <h2 class="title img-text__title">
                    Our Costumers
                </h2>

                <!-- Swiper -->
                <div class="swiper-container img-text-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide img-text-item">
                            <div class="img-text-row">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/img-text-min.jpg" alt="">
                                <div class="img-text__descr">
                                    <h3 class="title h5">
                                        Luciana
                                    </h3>
                                    <p class="sub-title">
                                        Columbia
                                    </p>
                                    <p>We had a strong desire to perpetuate the most important day of our life. We got married 2
                                        years ago,
                                        and that day was absolutely magnificent.
                                        <span class="more_text">The idea to get a handmade portrait occurred to us when we saw a
                                            similar oil portrait in our
                                            friends’ house. It looked amazing! This is how we found Pained Desire and ordered there our
                                            own
                                            first painting. The job was done perfectly and within the timelines. I honestly recommend
                                            this
                                            company. <br>Thank you a lot!</span></p>


                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide img-text-item">
                            <div class="img-text-row">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/g-c-4-min.jpg" alt="">
                                <div class="img-text__descr">
                                    <h3 class="title h5">
                                        Luciana
                                    </h3>
                                    <p class="sub-title">
                                        Columbia
                                    </p>
                                    <p>We had a strong desire to perpetuate the most important day of our life. We got married 2
                                        years ago,
                                        and that day was absolutely magnificent.
                                        <span class="more_text">The idea to get a handmade portrait occurred to us when we saw a
                                            similar oil portrait in our
                                            friends’ house. It looked amazing! This is how we found Pained Desire and ordered there our
                                            own
                                            first painting. The job was done perfectly and within the timelines. I honestly recommend
                                            this
                                            company. <br>Thank you a lot!</span></p>


                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide img-text-item">
                            <div class="img-text-row">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/test-1x.png" alt="">
                                <div class="img-text__descr">
                                    <h3 class="title h5">
                                        Luciana
                                    </h3>
                                    <p class="sub-title">
                                        Columbia
                                    </p>
                                    <p>We had a strong desire to perpetuate the most important day of our life. We got married 2
                                        years ago,
                                        and that day was absolutely magnificent.
                                        <span class="more_text">The idea to get a handmade portrait occurred to us when we saw a
                                            similar oil portrait in our
                                            friends’ house. It looked amazing! This is how we found Pained Desire and ordered there our
                                            own
                                            first painting. The job was done perfectly and within the timelines. I honestly recommend
                                            this
                                            company. <br>Thank you a lot!
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Add Pagination -->
                <button id="toggle">Read More</button>
                <div class="img-text-slider__pagination"></div>

                <div class="img-text__actions">

                    <a href="#" class="btn btn--accent-border">Order Now</a>

                </div>
            </div>
        </div>

    </section>

<?php get_footer(); ?>