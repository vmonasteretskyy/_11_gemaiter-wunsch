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
                                <a <?php if (strpos($itemChild->url, "data-href") !== false): ?>data-href="<?php echo str_replace("data-href=", "", $itemChild->url);?>" href="javascript:void(0);" class="modal-event-js"<?php else:?>href="<?php echo ($itemChild->url ? (defined('WP_LOCALE_MODE') && WP_LOCALE_MODE == 'DIFF' ? (str_replace('/de/', '/', $itemChild->url)) : $itemChild->url) : '#'); ?>"<?php endif;?>>
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
                      <a class="option__text" href="<?php echo get_url_en_prefix(); ?>"><?php pll_e('English'); ?></a>
                    </li>
                    <li class="option option-js" data-key="German">
                      <a class="option__text" href="<?php echo get_url_de_prefix(); ?>"><?php pll_e('German'); ?></a>
                    </li>
                  </ul>
                </div>
              </li>
              <?php /*
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
              </li>*/ ?>
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

<?php if (is_front_page()): ?>
    <div class="popup-video__container video-with-control">
        <div class="popup-video__bg"></div>
        <div class="popup-video__close">
            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.3259 10.6895L23.7254 1.42567C24.0915 1.09952 24.0915 0.570725 23.7254 0.244614C23.3593 -0.0814963 22.7656 -0.0815381 22.3995 0.244614L12 9.50841L1.60046 0.244614C1.23432 -0.0815381 0.640697 -0.0815381 0.274605 0.244614C-0.091488 0.570767 -0.0915349 1.09956 0.274605 1.42567L10.6741 10.6894L0.274605 19.9532C-0.0915349 20.2794 -0.0915349 20.8082 0.274605 21.1343C0.457651 21.2973 0.697603 21.3788 0.937556 21.3788C1.17751 21.3788 1.41741 21.2973 1.60051 21.1343L12 11.8705L22.3995 21.1343C22.5825 21.2973 22.8225 21.3788 23.0624 21.3788C23.3024 21.3788 23.5423 21.2973 23.7254 21.1343C24.0915 20.8081 24.0915 20.2793 23.7254 19.9532L13.3259 10.6895Z" fill="#fff"/>
            </svg>
        </div>
        <?php
        global $post;
        $fields = get_fields($post->ID);
        $main_banner_2 = isset($fields['main_banner_2']) ? $fields['main_banner_2'] : '';
        $image = '';
        if ($main_banner_2) {
            if (isset($main_banner_2['background_image']['sizes']['large']) && $main_banner_2['background_image']['sizes']['large']) {
                $image = $main_banner_2['background_image']['sizes']['large'];
            }
        }
        ?>
        <video width="100%" height="100%" <?php if ($image): ?> poster="<?php echo $image; ?>" <?php endif;?> >
            <?php if (isset($main_banner_2['video']['url']) && !empty($main_banner_2['video']['url'])) : ?>
                <source src="<?php echo $main_banner_2['video']['url'];?>" type="<?php echo $main_banner_2['video']['mime_type'];?>">
            <?php endif;?>
            <?php pll_e('Your browser does not support the video tag.'); ?>
        </video>
    </div>
<?php endif; ?>

<?php
    $current_lang = pll_current_language();
    $data['header_settings'] = get_field('header_settings_' . $current_lang, 'option');
?>
    <div class="social-message__container">
        <?php if (isset($data['header_settings']['footer_facebook_messenger_link']) && $data['header_settings']['footer_facebook_messenger_link']): ?>
            <a class='social-message__facebook' href='<?php echo $data['header_settings']['footer_facebook_messenger_link'];?>'>
                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#0570E6"/>
                    <path d="M35 21C27.2685 21 21 26.803 21 33.9622C21 38.0415 23.0352 41.6798 26.2168 44.0562V49L30.9837 46.3838C32.256 46.7355 33.6035 46.9262 35 46.9262C42.7315 46.9262 49 41.1233 49 33.964C49 26.8047 42.7315 21 35 21ZM36.3913 38.4563L32.8265 34.6535L25.8702 38.4563L33.523 30.3328L37.1753 34.1355L44.044 30.3328L36.3913 38.4563Z" fill="white"/>
                </svg>
            </a>
        <?php endif; ?>
        <?php if (isset($data['header_settings']['footer_whatsapp_link']) && $data['header_settings']['footer_whatsapp_link']): ?>
            <a class='social-message__wats-app' href='<?php echo $data['header_settings']['footer_whatsapp_link'];?>'>
                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#30E08A"/>
                    <path d="M41.425 37.6915L41.4145 37.779C38.849 36.5004 38.5807 36.33 38.2493 36.827C38.0195 37.1712 37.3498 37.9517 37.148 38.1827C36.9438 38.4102 36.7408 38.4277 36.3943 38.2702C36.0443 38.0952 34.9208 37.7277 33.5908 36.5377C32.5548 35.6102 31.8595 34.4727 31.6542 34.1227C31.3123 33.5324 32.0275 33.4484 32.6785 32.2164C32.7952 31.9714 32.7357 31.7789 32.6493 31.605C32.5618 31.43 31.8653 29.715 31.5737 29.0314C31.2937 28.35 31.0055 28.4364 30.7897 28.4364C30.1177 28.378 29.6265 28.3874 29.1937 28.8377C27.3107 30.9074 27.7855 33.0424 29.3967 35.3127C32.563 39.4567 34.25 40.2197 37.3347 41.279C38.1677 41.5439 38.9272 41.5065 39.528 41.4202C40.1977 41.314 41.5895 40.579 41.88 39.7565C42.1775 38.934 42.1775 38.2515 42.09 38.094C42.0037 37.9365 41.775 37.849 41.425 37.6915Z" fill="white"/>
                    <path d="M44.94 25.0243C35.9695 16.3525 21.1237 22.642 21.1178 34.8757C21.1178 37.321 21.7583 39.7057 22.9787 41.8115L21 49.0005L28.3908 47.0732C37.6133 52.0548 48.9953 45.4398 49 34.8827C49 31.1773 47.5533 27.6902 44.9225 25.0698L44.94 25.0243ZM46.669 34.8442C46.662 43.7493 36.8865 49.3108 29.155 44.7655L28.735 44.5158L24.36 45.6533L25.5325 41.4008L25.2537 40.9633C20.4423 33.3042 25.97 23.2942 35.084 23.2942C38.1803 23.2942 41.0865 24.5017 43.2752 26.6892C45.4627 28.858 46.669 31.7642 46.669 34.8442Z" fill="white"/>
                </svg>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php wp_footer(); ?>

</body>

</html>
