<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Gemalter
 */
$current_lang = pll_current_language();
global $post;
global $wp;
$fields = get_fields($post->ID);
get_header();
?>

    <!--Start page-->
    <div class="page-wrapper">
        <?php get_template_part( 'template-parts/bread'); ?>

        <article class="article">
            <div class="article__container">
                <div class="article__box container">
                    <?php if ($post->post_content): ?>
                        <h1 class="article__title"><?php echo $post->post_title; ?></h1>
                    <?php endif; ?>
                    <?php if (isset($fields['subtitle']) && $fields['subtitle']): ?>
                        <p class="article__description">
                            <?php echo nl2br($fields['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                    <div class="article__wrapper">
                        <div class="article__inner">
                            <p class="article__datetime" datetime="2020-08-20T08:23:11+07:00">
                                <time class="article__time"><?php echo pll__(date("M", strtotime($post->post_date))) . date(" j, Y", strtotime($post->post_date));?></time>
                            </p>
                            <p class="article__socials-title"><?php pll_e('Share an article with:'); ?></p>
                            <ul class="article__socials">
                                <li class="article__socials-item article__socials-item--twitter"
                                    aria-label="twitter">
                                    <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . $wp->request . '/'); ?>" class="article__socials-link">
                                        <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.1367 4.59375C16.1602 4.6875 16.1719 4.83984 16.1719 5.05078C16.1719 6.29297 15.9375 7.53516 15.4688 8.77734C15 9.99609 14.332 11.1211 13.4648 12.1523C12.6211 13.1602 11.5195 13.9805 10.1602 14.6133C8.80078 15.2461 7.30078 15.5625 5.66016 15.5625C3.59766 15.5625 1.71094 15.0117 0 13.9102C0.257812 13.9336 0.550781 13.9453 0.878906 13.9453C2.58984 13.9453 4.125 13.418 5.48438 12.3633C4.66406 12.3633 3.9375 12.1289 3.30469 11.6602C2.69531 11.168 2.27344 10.5586 2.03906 9.83203C2.27344 9.85547 2.49609 9.86719 2.70703 9.86719C3.03516 9.86719 3.36328 9.83203 3.69141 9.76172C3.12891 9.64453 2.625 9.41016 2.17969 9.05859C1.73438 8.70703 1.38281 8.28516 1.125 7.79297C0.867188 7.27734 0.738281 6.72656 0.738281 6.14062V6.07031C1.25391 6.375 1.80469 6.53906 2.39062 6.5625C1.28906 5.8125 0.738281 4.78125 0.738281 3.46875C0.738281 2.8125 0.914062 2.19141 1.26562 1.60547C2.17969 2.75391 3.29297 3.66797 4.60547 4.34766C5.94141 5.02734 7.35938 5.40234 8.85938 5.47266C8.8125 5.19141 8.78906 4.91016 8.78906 4.62891C8.78906 3.62109 9.14062 2.75391 9.84375 2.02734C10.5703 1.30078 11.4375 0.9375 12.4453 0.9375C13.5234 0.9375 14.4258 1.32422 15.1523 2.09766C15.9961 1.93359 16.7812 1.64062 17.5078 1.21875C17.2266 2.08594 16.6875 2.76562 15.8906 3.25781C16.5938 3.16406 17.2969 2.96484 18 2.66016C17.4844 3.41016 16.8633 4.05469 16.1367 4.59375Z" fill="#8C8C8C"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="article__socials-item article__socials-item--facebook"
                                    aria-label="facebook">
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_url( ($current_lang == 'de' ? '/de/' : '/') . $wp->request . '/'); ?>" class="article__socials-link">
                                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.07983 9H5.73608V16H2.61108V9H0.079834V6.09375H2.61108V3.90625C2.61108 3.07292 2.76733 2.36458 3.07983 1.78125C3.39233 1.19792 3.82983 0.760417 4.39233 0.46875C4.97567 0.15625 5.64233 0 6.39233 0C6.72567 0 7.07983 0.0208333 7.45483 0.0625C7.82983 0.0833333 8.1215 0.114583 8.32983 0.15625L8.64233 0.1875V2.65625H7.39233C6.809 2.65625 6.38192 2.8125 6.11108 3.125C5.86108 3.41667 5.73608 3.78125 5.73608 4.21875V6.09375H8.51733L8.07983 9Z" fill="#929292"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php $post->image = get_the_post_thumbnail_url($post->ID, 'orig');?>
                        <?php if ($post->image): ?>
                            <div class="article__photo">
                                <img src="<?php echo $post->image; ?>" alt="<?php echo $post->post_title; ?>" class="article__image">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="article__description-box text">
                    <?php if ($post->post_content): ?>
                        <div class="article__box container">
                            <?php echo wpautop($post->post_content); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>

    </div>
    <!--End page-->

<?php
get_footer();
