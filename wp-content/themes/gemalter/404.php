<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Gemalter
 */
$current_lang = pll_current_language();
get_header();
?>

    <!--Start page-->
    <div class="page-wrapper">
        <section class="error">
            <div class="error__wrapper" style="background-image: url('<?php echo the_theme_path(); ?>/img/background.png')">
                <div class="error__inner">
                    <h1 class="error__title"><?php pll_e('Oopps... Something went wrong');?></h1>
                    <p class="error__description"><?php pll_e('We are already working to fix this error. You can return to the main page to continue working with the site.');?></p>
                    <a href="<?php the_url( (get_url_lang_prefix()) );?>" class="error__link btn btn--accent"><?php pll_e('Go to the Main Page');?></a>
                </div>
            </div>
        </section>
    </div>
    <!--End page-->

<?php
get_footer();
