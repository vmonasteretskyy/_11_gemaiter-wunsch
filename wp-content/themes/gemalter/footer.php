<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gemalter
 */

$current_lang = pll_current_language();
$current_url = str_replace([$current_lang . '/'], '',$wp->request);
if ($current_url == $current_lang) {
    $current_url = '';
}
if ($current_url) {
    $current_url .= '/';
}

?>

<footer class="section last-section-wrap">
  <div class="section-inner">
    <div class="last-section">
      <div class="last-section__logo">
        <img src="<?php echo the_theme_path(); ?>/img/footer-icon-min.png" alt="">
      </div>
      <div class="footer">
        <a href="#" class="btn btn--card-link btn--accent footer__up"></a>
        <div class="footer__inner">
            <?php $menuItems = get_nav_menu_items("menu-2");?>
            <?php if ($menuItems):?>
              <?php foreach ($menuItems as $menu): ?>
                  <div class="footer-col">
                    <h6 class="footer-title">
                      <?php echo $menu->title;?>
                    </h6>
                    <?php if (isset($menu->children) && $menu->children) : ?>
                        <ul>
                          <?php foreach ($menu->children as $itemChild) : ?>
                            <li class="footer-line">
                                <a <?php if (strpos($itemChild->url, "data-href") !== false): ?>data-href="<?php echo str_replace("data-href=", "", $itemChild->url);?>" href="javascript:void(0);" class="modal-event-js"<?php else:?>href="<?php echo ($itemChild->url ? $itemChild->url : '#'); ?>"<?php endif;?>>
                                    <?php $itemChild->icon = get_field('icon', $itemChild->ID); ?>
                                    <?php if ($itemChild->icon): ?>
                                        <span>
                                            <?php echo $itemChild->icon; ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php echo $itemChild->title; ?>
                                </a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
                  </div>
              <?php endforeach; ?>

          <?php endif;?>
          <div class="footer-col">
            <h6 class="footer-title">
              <?php pll_e('Localization Settings'); ?>
            </h6>
            <ul>
              <li class="footer-line footer-line--select">
                <div class="form-group form-group--select">
                  <label class="select-label select-label-js">
                    <div class="select-label__picture"></div>
                    <input class="input input-value-js" type="text" readonly placeholder="<?php if($current_lang == 'de'):?><?php pll_e('German');?><?php else: ?><?php pll_e('English');?><?php endif; ?>" />
                    <!-- Value of this input will be sent to back -->
                    <input class="input input-key-js" name="select" readonly hidden>
                  </label>

                  <ul class="options options-js">
                    <li class="option option-js" data-key="English">
                      <a class="option__text" href="<?php echo  '/' . $current_url;?>"><?php pll_e('English'); ?></a>
                    </li>
                    <li class="option option-js" data-key="German">
                      <a class="option__text" href="<?php the_url( '/de/' . $current_url);?>"><?php pll_e('German'); ?></a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="footer-line footer-line--select">
                <div class="form-group form-group--select">
                  <label class="select-label select-label-js">
                    <div class="select-label__picture">
                    </div>
                    <input class="input input-value-js" type="text" readonly placeholder="$ USD" />

                    <!-- Value of this input will be sent to back -->
                    <input class="input input-key-js" name="select" readonly hidden>
                  </label>

                  <ul class="options options-js">
                    <li class="option option-js" data-key="USA">
                      <div class="option__text">$ USD</div>
                    </li>
                    <li class="option option-js" data-key="UA">
                      <div class="option__text">€ EURO</div>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="footer__inner footer__inner--center">
          <p>GemalterWunsch <?php echo date("Y");?>. <?php pll_e('All rights reserved'); ?></p>
        </div>
      </div>
    </div>
  </div>
</footer> <!-- End footer -->
</div>

<?php get_template_part("popups"); ?>
</div>

<?php wp_footer(); ?>

</body>

</html>