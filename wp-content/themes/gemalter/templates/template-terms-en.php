<?php

/**
 * Template Name: Term Page
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
$current_lang = pll_current_language();
global $post;
$fields = get_fields($post->ID);
$data = [
    'title' => isset($fields['title']) ? $fields['title'] : null,
    'sections' => isset($fields['sections']) ? $fields['sections'] : null,
];
?>

    <!--Start page-->
    <div class="page-wrapper">
        <?php get_template_part( 'template-parts/bread'); ?>
        <?php if ($fields['title']): ?>
            <div class="container-small mx-w-1050">
                <div class="title-wrap m-b-90">
                    <h2 class="">
                        <?php echo $fields['title']; ?>
                    </h2>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($fields['sections']): ?>
            <div class="text">
                <?php foreach ($fields['sections'] as $section): ?>
                    <div class="text-block <?php echo $section['bg_color']; ?> <?php echo $section['padding']; ?>">
                        <div class="container mx-w-1050">
                            <h5>
                                <?php echo $section['title']; ?>
                            </h5>
                            <?php echo wpautop($section['text']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <!--End page-->


<?php get_footer(); ?>