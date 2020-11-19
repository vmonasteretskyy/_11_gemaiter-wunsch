<?php

/**
 * Template Name: Procedure Page
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

    <!--Start page-->
    <div class="page-wrapper">
        <?php
        $screen1Data = [
            'title' => isset($fields['title']) ? $fields['title'] : null,
            'text' => isset($fields['text']) ? $fields['text'] : null,
            'our_steps' => isset($fields['our_steps']) ? $fields['our_steps'] : null,
            'our_steps_title' => isset($fields['our_steps_title']) ? $fields['our_steps_title'] : null,
        ];
        ?>

        <?php
        $screen2Data = [
            'title' => isset($fields['screen2_title']) ? $fields['screen2_title'] : null,
            'section_1_text' => isset($fields['screen2_section_1_text']) ? $fields['screen2_section_1_text'] : null,
            'section_1_image' => isset($fields['screen2_section_1_image']) ? $fields['screen2_section_1_image'] : null,
            'section_1_vertical_title' => isset($fields['screen2_section_1_vertical_title']) ? $fields['screen2_section_1_vertical_title'] : null,
            'section_2_text' => isset($fields['screen2_section_2_text']) ? $fields['screen2_section_2_text'] : null,
            'section_2_image' => isset($fields['screen2_section_2_image']) ? $fields['screen2_section_2_image'] : null,
            'section_2_vertical_title' => isset($fields['screen2_section_2_vertical_title']) ? $fields['screen2_section_2_vertical_title'] : null,
            'text' => isset($fields['screen2_text']) ? $fields['screen2_text'] : null,
        ];
        ?>

        <?php if ($screen1Data['title'] || !empty($screen1Data['text'])): ?>
            <div class="container-small mx-w-1050">
                <?php if ($screen1Data['title']): ?>
                    <div class="title-wrap m-b-90 p-t-65">
                        <h1 class="title h2">
                            <?php echo $screen1Data['title'];?>
                        </h1>
                    </div>
                <?php endif; ?>
                <?php if ($screen1Data['text']): ?>
                    <div class="text text--center text--lite-color m-b-90">
                        <p>
                            <?php echo $screen1Data['text'];?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($screen1Data['our_steps'])): ?>
            <!-- Start procedure section -->
            <section class="section procedure " >
                <div class="container-small mx-w-1050">
                    <?php if ($screen1Data['our_steps_title']): ?>
                        <h2 class="title title--under-line h5">
                            <?php echo $screen1Data['our_steps_title'];?>
                        </h2>
                    <?php endif; ?>
                    <div class="procedure-inner">
                        <?php foreach ($screen1Data['our_steps'] as $key => $step): ?>
                            <div class="p-step <?php if ($key % 2 == 1): ?>p-step--revers<?php endif; ?>">
                                <div class="p-step__picture">
                                    <?php
                                    $image = null;
                                    if (is_array($step['image'])) {
                                        $image = $step['image']['url'];
                                    } else {
                                        $image = wp_get_attachment_image_src($step['image'], 'full');
                                        if (isset($image[0]) && $image[0]) {
                                            $image = $image[0];
                                        } else {
                                            $image = null;
                                        }
                                    }
                                    ?>
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image;?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="p-step__label">
                                    <div class="num">
                                        <p>
                                            <?php echo ($key + 1); ?>
                                        </p>
                                    </div>
                                    <span><?php pll_e('step'); ?></span>
                                </div>
                                <?php if ((isset($step['title']) && $step['title']) || (isset($step['text']) && $step['text'])): ?>
                                    <div class="p-step__descr">
                                        <?php if ($step['title']): ?>
                                            <h3 class="h5 title">
                                                <?php echo $step['title'];?>
                                            </h3>
                                        <?php endif; ?>
                                        <?php if ($step['text']): ?>
                                            <p>
                                                <?php echo nl2br($step['text']);?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- End procedure section -->
        <?php endif; ?>

        <?php if ($screen2Data['title'] || $screen2Data['section_1_text'] || $screen2Data['section_1_image']): ?>
            <!-- Start img-text-mod section -->
            <section class="section img-text-mod img-text-mod--right-gray img-text-mod--revers" >
                <?php if ($screen2Data['title']): ?>
                    <h5 class="h5 title--under-line img-text-mod__title">
                        <?php echo $screen2Data['title']; ?>
                    </h5>
                <?php endif; ?>
                <?php if ($screen2Data['section_1_text'] || $screen2Data['section_1_image']): ?>
                    <div class="container-small">
                        <div class="img-text-mod-inner">
                            <div class="img-text-mod__left">
                                <?php if ($screen2Data['section_1_vertical_title']): ?>
                                    <div class="img-text-mod-label">
                                        <p class="vertical-label"> <?php echo $screen2Data['section_1_vertical_title']; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="img-text-mod__picture img-text-mod-transform ">
                                    <?php
                                    $image = null;
                                    if (is_array($screen2Data['section_1_image'])) {
                                        $image = $screen2Data['section_1_image']['url'];
                                    } else {
                                        $image = wp_get_attachment_image_src($screen2Data['section_1_image'], 'full');
                                        if (isset($image[0]) && $image[0]) {
                                            $image = $image[0];
                                        } else {
                                            $image = null;
                                        }
                                    }
                                    ?>
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image;?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="img-text-mod__right">
                                <?php if ($screen2Data['section_1_text']): ?>
                                    <div class="text">
                                        <?php echo wpautop($screen2Data['section_1_text']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </section>
            <!-- End img-text-mod section -->
        <?php endif; ?>

        <?php if ($screen2Data['text'] || $screen2Data['section_2_text'] || $screen2Data['section_2_image']): ?>
            <!-- Start img-text-mod section -->
            <section class="section img-text-mod img-text-mod--gray p-t-120" >
                <div class="container-small">
                    <div class="img-text-mod-inner">
                        <div class="img-text-mod__left">
                            <?php if ($screen2Data['section_2_vertical_title']): ?>
                                <div class="img-text-mod-label">
                                    <p class="vertical-label"> <?php echo $screen2Data['section_2_vertical_title']; ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="img-text-mod__picture img-text-mod-transform ">
                                <?php
                                $image = null;
                                if (is_array($screen2Data['section_1_image'])) {
                                    $image = $screen2Data['section_1_image']['url'];
                                } else {
                                    $image = wp_get_attachment_image_src($screen2Data['section_1_image'], 'full');
                                    if (isset($image[0]) && $image[0]) {
                                        $image = $image[0];
                                    } else {
                                        $image = null;
                                    }
                                }
                                ?>
                                <?php if ($image): ?>
                                    <img src="<?php echo $image;?>" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="img-text-mod__right">
                            <?php if ($screen2Data['section_1_text']): ?>
                                <div class="text">
                                    <?php echo wpautop($screen2Data['section_1_text']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if ($screen2Data['text']): ?>
                    <div class="container mx-w-1050 img-text-mod__quote m-t-120 text--center">
                        <p>
                            <i><?php echo wpautop($screen2Data['text']); ?></i>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="img-text-mod__action">
                    <a href="<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . 'order/');?>" class="btn btn--accent-border"><?php pll_e('Order Now'); ?></a>
                </div>
            </section>
            <!-- End img-text-mod section -->
        <?php endif; ?>

    </div>
    <!--End page-->

<?php get_footer(); ?>