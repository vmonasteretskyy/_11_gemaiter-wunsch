<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
    <?php
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_slug = '#';
        if ($_product) {
            $parent_id = $_product->get_parent_id();
            if ($parent_id) {
                $parent_product = wc_get_product($parent_id);
                $product_slug = $parent_product->get_slug();
            } else {
                $product_slug = $_product->get_slug();
            }
        }
        $product_slug = esc_url((pll_current_language() == 'uk' ? '' : '/ru') .  '/product/' . $product_slug);
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        $attributes = isset($cart_item['attributes']) ? $cart_item['attributes'] : [];
        $descAttributes = ['pa_storona-upravlinnya' => pll__('сторона управління'), 'pa_kolory-systemy' => pll__('колір системи')];

        $descData = [];
        if (!empty($attributes)) {
            foreach($descAttributes as $descAttribute => $descAttributeLabel) {
                if (isset($attributes[$descAttribute]) && $attributes[$descAttribute]) {
                    $term_obj = get_term_by('slug', $attributes[$descAttribute], $descAttribute);
                    if ($term_obj) {
                        $descData[] = pll__($term_obj->name) . ' ' . $descAttributeLabel;
                    }
                }
            }
        }
        $descData = !empty($descData) ? implode(', ', $descData) : '';
        $width = isset($attributes['width']) ? $attributes['width'] : 0;
        $height = isset($attributes['height']) ? $attributes['height'] : 0;

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ):

            ?>
          <div class="incard__row">
            <div class="incard__pic">
              <a href="<?php echo $product_slug; ?>"><?php echo $_product->get_image(); ?></a>
            </div>
            <div class="incard__text">
              <a href="<?php echo $product_slug; ?>"> <p class="title"><?php echo $_product->get_name(); ?></p></a>
                <?php if($width && $height): ?><p class="size"><?php echo $width; ?> х <?php echo $height; ?> мм</p> <?php endif; ?>
                <?php if($descData): ?><p class="descr"><?php echo $descData; ?></p><?php endif; ?>
            </div>
            <div class="incard__num">
              <div class="input-group">
                  <?php if($cart_item['quantity'] > 1): ?>
                    <input type="button" value="" class="button-minus" data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']-1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
                  <?php endif;?>
                <input type="text" readonly step="1" max="" value="<?php echo $cart_item['quantity']; ?>" name="quantity"
                       class="quantity-field">
                <input type="button" value="" class="button-plus" data-field="quantity" data-quantity-cart-item="<?php echo $cart_item['quantity']+1; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
              </div>
            </div>
            <div class="incard__price"><?php echo wc_price($_product->get_price()); ?></div>
            <div class="incard__remove" data-remove-cart-item="" data-cart-item-key="<?php echo $cart_item_key; ?>"><img src="<? echo get_template_directory_uri() . '/assets/' ?>image/icon/remove-icon.svg" alt="remove"></div>
          </div>
        <?php
        endif;
    endforeach;
    ?>
    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
      <div class="incard__bottsect cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
        <span class="lefttext"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
        <span class="lefttext"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
      </div>
    <?php endforeach; ?>

  <div class="incard__bottsect">
    <span class="lefttext"><?php echo pll__('До оплати');?></span>
    <span class="allprice"><?php wc_cart_totals_order_total_html(); ?></span>
  </div>
</div>
