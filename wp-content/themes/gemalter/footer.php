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
            <a class='social-message__icon social-message__facebook' href='<?php echo $data['header_settings']['footer_facebook_messenger_link'];?>'>
                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#0570E6"/>
                    <path d="M35 21C27.2685 21 21 26.803 21 33.9622C21 38.0415 23.0352 41.6798 26.2168 44.0562V49L30.9837 46.3838C32.256 46.7355 33.6035 46.9262 35 46.9262C42.7315 46.9262 49 41.1233 49 33.964C49 26.8047 42.7315 21 35 21ZM36.3913 38.4563L32.8265 34.6535L25.8702 38.4563L33.523 30.3328L37.1753 34.1355L44.044 30.3328L36.3913 38.4563Z" fill="white"/>
                </svg>
            </a>
        <?php endif; ?>
        <?php if (isset($data['header_settings']['footer_whatsapp_link']) && $data['header_settings']['footer_whatsapp_link']): ?>
            <a class='social-message__wats-up social-message__icon' href='<?php echo $data['header_settings']['footer_whatsapp_link'];?>'>
                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="35" cy="35" r="35" fill="#30E08A"/>
                    <path d="M41.425 37.6915L41.4145 37.779C38.849 36.5004 38.5807 36.33 38.2493 36.827C38.0195 37.1712 37.3498 37.9517 37.148 38.1827C36.9438 38.4102 36.7408 38.4277 36.3943 38.2702C36.0443 38.0952 34.9208 37.7277 33.5908 36.5377C32.5548 35.6102 31.8595 34.4727 31.6542 34.1227C31.3123 33.5324 32.0275 33.4484 32.6785 32.2164C32.7952 31.9714 32.7357 31.7789 32.6493 31.605C32.5618 31.43 31.8653 29.715 31.5737 29.0314C31.2937 28.35 31.0055 28.4364 30.7897 28.4364C30.1177 28.378 29.6265 28.3874 29.1937 28.8377C27.3107 30.9074 27.7855 33.0424 29.3967 35.3127C32.563 39.4567 34.25 40.2197 37.3347 41.279C38.1677 41.5439 38.9272 41.5065 39.528 41.4202C40.1977 41.314 41.5895 40.579 41.88 39.7565C42.1775 38.934 42.1775 38.2515 42.09 38.094C42.0037 37.9365 41.775 37.849 41.425 37.6915Z" fill="white"/>
                    <path d="M44.94 25.0243C35.9695 16.3525 21.1237 22.642 21.1178 34.8757C21.1178 37.321 21.7583 39.7057 22.9787 41.8115L21 49.0005L28.3908 47.0732C37.6133 52.0548 48.9953 45.4398 49 34.8827C49 31.1773 47.5533 27.6902 44.9225 25.0698L44.94 25.0243ZM46.669 34.8442C46.662 43.7493 36.8865 49.3108 29.155 44.7655L28.735 44.5158L24.36 45.6533L25.5325 41.4008L25.2537 40.9633C20.4423 33.3042 25.97 23.2942 35.084 23.2942C38.1803 23.2942 41.0865 24.5017 43.2752 26.6892C45.4627 28.858 46.669 31.7642 46.669 34.8442Z" fill="white"/>
                </svg>
            </a>
        <?php endif; ?>
        <a class='social-message__chat social-message__icon' href='javascript:void(0);'>
            <svg width="69" height="69" viewBox="0 0 69 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="69" height="69" rx="34.5" fill="#FFB947"/>
                <path d="M23.9843 28.9005V20.7031H22.2549V30.5456H27.0636V28.9005H23.9843ZM28.7799 30.5456H30.5093V20.7031H28.7799V30.5456ZM34.5715 30.5456H36.4135L38.7897 20.7031H36.99L35.9635 25.7087C35.8089 26.4961 35.6401 27.5928 35.5136 28.3943H35.4574C35.3449 27.5928 35.1761 26.4961 35.0215 25.7087L33.9951 20.7031H32.1953L34.5715 30.5456ZM42.2137 28.9145V26.3414H45.1664V24.7666H42.2137V22.3342H45.4335V20.7031H40.4842V30.5456H45.5741V28.9145H42.2137ZM23.0191 48.29C24.9173 48.29 26.0281 47.1933 26.0984 45.1967H24.369C24.2986 46.1809 23.8768 46.6168 23.0191 46.6168C22.288 46.6168 21.8521 46.1528 21.8521 45.1686V41.2316C21.8521 40.2192 22.288 39.7552 23.0051 39.7552C23.8487 39.7552 24.2705 40.1911 24.3268 41.2035H26.0562C25.9719 39.1928 24.9033 38.082 23.0191 38.082C21.1772 38.082 20.0664 39.1928 20.0664 41.2316V45.1686C20.0664 47.1933 21.1913 48.29 23.0191 48.29ZM32.1592 38.2789V42.3283H29.7829V38.2789H28.0535V48.1213H29.7829V43.9734H32.1592V48.1213H33.9027V38.2789H32.1592ZM40.495 48.1213H42.2948L39.8763 38.2789H38.0203L35.6019 48.1213H37.4017L37.7954 46.3356H40.1013L40.495 48.1213ZM38.1469 44.6905L38.5406 42.8626C38.6812 42.1877 38.8359 41.1051 38.9202 40.4442H38.9624C39.0608 41.1051 39.2155 42.1877 39.3561 42.8626L39.7498 44.6905H38.1469ZM48.4715 38.2789H42.7348V39.924H44.7173V48.1213H46.489V39.924H48.4715V38.2789Z" fill="white"/>
            </svg>
        </a>
        <p class="social-message__main">
            <span class="social-message__main--close">
                <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                    <path d="M25.2712 18.3766C27.648 16.6499 29.0001 14.1607 29.0001 11.4795C29.0001 6.48062 24.2574 2.41699 18.4272 2.41699C13.7219 2.41699 9.65469 5.01006 8.30376 8.87193C8.23851 9.05799 8.35694 9.26099 8.47294 9.42174C8.58894 9.58005 8.85476 9.65855 9.06263 9.66705C14.7261 9.66705 19.3334 13.4612 19.3334 18.1254C19.3334 18.6474 19.2706 19.1839 19.1449 19.7192C19.1003 19.9101 19.151 20.1119 19.2815 20.2581C19.412 20.4043 19.6041 20.4804 19.8011 20.4563C20.7351 20.35 21.6353 20.1445 22.4811 19.8437L25.6784 21.6707C25.7726 21.7239 25.8753 21.7504 25.9781 21.7504C26.1291 21.7504 26.2789 21.6936 26.3938 21.5849C26.5871 21.4024 26.6378 21.1136 26.5194 20.8755L25.2712 18.3766Z"
                    fill="white"/>
                    <path d="M9.0625 10.875C4.06481 10.875 0 14.1254 0 18.125C0 20.2794 1.21681 22.3312 3.28062 23.7027L2.45894 25.7556C2.36588 25.9876 2.42631 26.2547 2.61119 26.4251C2.72475 26.5278 2.87219 26.5834 3.01962 26.5834C3.11144 26.5834 3.2045 26.5628 3.29031 26.5193L6.28575 25.021C7.19319 25.2554 8.12606 25.3751 9.06131 25.3751C14.059 25.3751 18.1238 22.1234 18.1238 18.1251C18.1238 14.1267 14.0602 10.875 9.0625 10.875Z"
                    fill="white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0">
                    <rect width="29" height="29" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </span>
            
            <span class="social-message__main--open">
                <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.8811 11.5001L24.714 1.53378C25.0953 1.18289 25.0953 0.614003 24.714 0.263163C24.3326 -0.0876762 23.7142 -0.0877211 23.3329 0.263163L12.5 10.2294L1.66715 0.263163C1.28575 -0.0877211 0.667393 -0.0877211 0.286047 0.263163C-0.0953 0.614048 -0.0953488 1.18294 0.286047 1.53378L11.1189 11.5L0.286047 21.4663C-0.0953488 21.8172 -0.0953488 22.3861 0.286047 22.7369C0.47672 22.9123 0.72667 23 0.976621 23C1.22657 23 1.47647 22.9123 1.66719 22.7369L12.5 12.7707L23.3328 22.7369C23.5235 22.9123 23.7734 23 24.0234 23C24.2733 23 24.5232 22.9123 24.714 22.7369C25.0953 22.386 25.0953 21.8171 24.714 21.4663L13.8811 11.5001Z"
                    fill="#F9AB97"/>
                </svg>
            </span>
        </p>
    </div>
</div>

<?php wp_footer(); ?>

</body>

</html>
