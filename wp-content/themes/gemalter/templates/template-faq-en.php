<?php

/**
 * Template Name: FAQ Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);
$data = [
    'title' => isset($fields['title']) ? $fields['title'] : null,
    'image' => isset($fields['image']) ? $fields['image'] : null,
    'vertical_title' => isset($fields['vertical_title']) ? $fields['vertical_title'] : null,
    'faq' => isset($fields['faq']) ? $fields['faq'] : null,
];
get_header();
?>

    <!--Start page-->
    <div class="page-wrapper">

        <?php get_template_part( 'template-parts/bread'); ?>

        <div class="faq">
            <section class="section faq__section section faq__section--main">
                <div class="container faq__container faq__container--main">
                    <?php if ($data['title']): ?>
                        <h1 class="faq__title h2"><?php echo $data['title'];?></h1>
                    <?php endif; ?>
                    <div class="faq__wrapper faq__wrapper--main">
                        <?php if ($data['faq']): ?>
                            <div class="faq__inner">
                                <?php foreach ($data['faq'] as $faqGroupKey => $faqGroup): ?>
                                    <details open class="faq__details">
                                        <summary class="faq__caption"><?php echo $faqGroup['title'];?></summary>
                                        <?php if (isset($faqGroup['items']) && !empty($faqGroup['items'])):?>
                                            <ul class="faq__nav-list">
                                                <?php foreach ($faqGroup['items'] as $faqItemKey => $faqItem): ?>
                                                    <li class="faq__nav-item">
                                                        <a href="#faq-group-<?php echo $faqGroupKey; ?>-item-<?php echo $faqItemKey; ?>" class="faq__nav-link scroll-to"><?php echo $faqItem['title'];?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </details>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="faq__photo">
                            <div class="faq__image-container">
                                <?php
                                $image = null;
                                if (is_array($data['image'])) {
                                    $image = $data['image']['url'];
                                } else {
                                    $image = wp_get_attachment_image_src($data['image'], 'full');
                                    if (isset($image[0]) && $image[0]) {
                                        $image = $image[0];
                                    } else {
                                        $image = null;
                                    }
                                }
                                ?>
                                <?php if ($image): ?>
                                    <img src="<?php echo $image;?>" alt="<?php echo $data['vertical_title'];?>" class="faq__image">
                                <?php endif; ?>
                            </div>
                            <?php if ($data['vertical_title']): ?>
                                <p class="faq__photo-description"><?php echo $data['vertical_title'];?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </section>

            <?php if ($data['faq']): ?>
                <?php foreach ($data['faq'] as $faqGroupKey => $faqGroup): ?>
                    <section class="section faq__section <?if ($faqGroupKey % 2 == 0): ?>faq__section--blue<?php endif; ?> <?if ($faqGroupKey == 0): ?>faq__section--order<?php endif; ?>">
                        <div class="container faq__container">
                            <h2 class="faq__subtitle">
                                <span class="faq__line"><?php echo $faqGroup['title'];?></span>
                            </h2>
                            <?php if (isset($faqGroup['items']) && !empty($faqGroup['items'])):?>
                                <?php foreach ($faqGroup['items'] as $faqItemKey => $faqItem): ?>
                                    <p class="faq__question" id="faq-group-<?php echo $faqGroupKey; ?>-item-<?php echo $faqItemKey; ?>"><?php echo $faqItem['title']; ?></p>
                                    <?php echo $faqItem['text']; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <!--End page-->

<?php get_footer(); ?>