<?php
/**
 * The template for displaying checkout page
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
global $post;
get_header();
?>
    <!--Start page-->
    <div class="page-wrapper">
        <?php get_template_part( 'template-parts/bread'); ?>
        <div class="container-small mx-w-1050">
            <div class="title-wrap m-b-90">
                <h2 class="">
                    <?php echo $post->post_title; ?>
                </h2>
            </div>
        </div>
        <?php the_content(); ?>
    </div>
    <!--End page-->
<?php
get_footer();
