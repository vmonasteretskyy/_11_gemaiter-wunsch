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

$current_lang = pll_current_language();
$allPricesData = getPrices();
$data['currency_symbol'] = $allPricesData[$current_lang]['currency_symbol'];
$data['currency'] = $allPricesData[$current_lang]['currency'];
$data['use_size'] = $allPricesData[$current_lang]['use_size'];

//TODO - check require fields and redirect to cart page if empty
?>

    <!--Start page-->
    <div class="page-wrapper">
        <div class="cart-wrap">
            <div class="cart">
                <div class="cart-head">
                    <h2><?php pll_e('Checkout'); ?></h2>
                    <div class="cart-head__amount">
                        <p><?php pll_e('Total Amount'); ?>: <span><?php echo $data['currency_symbol'];?> </span> </p>
                        <div class="cart-amount h1" data-cart-total-amount="">
                            <?php echo WC()->cart->get_cart_total();?>
                        </div>
                    </div>
                </div>
                <?php
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile; // End of the loop.
                ?>

            </div>
        </div>
    </div>
    <!--End page-->

<?php
get_footer();
