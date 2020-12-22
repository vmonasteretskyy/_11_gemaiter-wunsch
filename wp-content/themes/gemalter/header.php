<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gemalter
 */

global $wp;
global $woocommerce;
global $post;
$current_lang = pll_current_language();
$current_url = str_replace([$current_lang . '/'], '',$wp->request);
if ($current_url == $current_lang) {
    $current_url = '';
}
if ($current_url) {
    $current_url .= '/';
}
$data['header_settings'] = get_field('header_settings_' . $current_lang, 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO meta tags -->
    <meta property="og:url" content="<?php the_url( (get_url_lang_prefix()) . $wp->request . '/'); ?>" />
    <meta property="og:type" content="website" />
    <?php if (isset($post->post_title) && $post->post_title): ?>
        <meta property="og:title" content="<?php echo $post->post_title;?>" />
    <?php endif; ?>
    <?php if (isset($post->post_content) && $post->post_content): ?>
        <meta property="og:description" content="<?php echo wp_trim_words($post->post_content);?>"/>
    <?php endif; ?>
    <?php $image = isset($post->ID) && $post->ID ? get_the_post_thumbnail_url($post->ID, 'post-thumbnail') : null;?>
    <?php if ($image): ?>
        <meta property="og:image" content="<?php echo $image; ?>" />
    <?php endif; ?>
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
    <meta name="twitter:card" content=summary />
    <?php if (isset($post->post_content) && $post->post_content): ?>
        <meta name="twitter:description" content="<?php echo wp_trim_words($post->post_content);?>"/>
    <?php endif; ?>
    <?php if (isset($post->post_title) && $post->post_title): ?>
        <meta name="twitter:title" content="<?php echo $post->post_title;?>" />
    <?php endif; ?>
    <!--End SEO meta tags -->
	<?php wp_head(); ?>

  <!-- Template Basic Images Start -->
  <link rel="icon" href="<?php echo the_theme_path(); ?>/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo the_theme_path(); ?>/img/logo.png" />
  <!-- Template Basic Images End -->

  <!-- Custom Browsers Color Start -->
  <meta name="theme-color" content="#000" />
  <!-- Custom Browsers Color End -->


  <script>
      var errorTitle = '<?php pll_e("Error");?>';
  </script>
  <style>
    body {
      /* opacity: 0; */
    }

    .modal {
      opacity: 1;
      opacity: 0;
    }

    .preloader {
        opacity: 1;
    }

    .dropdown-menu {
      opacity: 0;
      visibility: hidden;
    }

    .header {
      background-color: white;
    }

    @media screen and (max-width: 991px) {

      .header nav {
        transform: translate3d(100%, 0, 0);
        visibility: hidden;
      }

      /*header mega menu */
      .header.header-mega-menu nav {
        transform: translate3d(100%, 0, 0);
        visibility: hidden;
      }
    }
  </style>
</head>

<body data-locale-mode="<?php echo WP_LOCALE_MODE; ?>" data-current-lang="<?php echo $current_lang;?>" <?php body_class('fixed-header'); ?>>
<?php wp_body_open(); ?>
    <!-- Start site wrapper -->
    <div class="site-wrapper">
        <!-- Start header -->
        <header class="header">
            <div class="header-top">
                <?php if (isset($data['header_settings']['header_title']) && $data['header_settings']['header_title']): ?>
                    <div class="header-top__left">
                        <p><?php echo $data['header_settings']['header_title'];?></p>
                    </div>
                <?php endif;?>
                <div class="header-top__center">
                    <p>
                        <?php if (isset($data['header_settings']['header_phone']) && $data['header_settings']['header_phone']): ?>
                            <? pll_e('Need Help? Contact Us!'); ?>
                            <a href="tel:<?php echo $data['header_settings']['header_phone'];?>"><?php echo $data['header_settings']['header_phone'];?></a>
                        <?php endif;?>
                        <?php if (isset($data['header_settings']['header_email']) && $data['header_settings']['header_email']): ?>
                            <? pll_e('Email:'); ?>
                            <a href="mailto:<?php echo $data['header_settings']['header_email'];?>"><?php echo $data['header_settings']['header_email'];?></a>
                        <?php endif;?>
                    </p>
                    <ul>
                        <?php if (isset($data['header_settings']['header_pinterest_link']) && $data['header_settings']['header_pinterest_link']): ?>
                            <li>
                                <a href="<?php echo $data['header_settings']['header_pinterest_link'];?>" class="header-social-link">
                                    <svg version="1.1" width="17" height="17" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         viewBox="6 4 44 46" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:none;}
                                    </style>
                                    <g>
                                        <rect x="-0.2" y="0.1" class="st0" width="53.8" height="53.4"/>
                                        <path d="M45.2,15.5c1.9,3.3,2.9,6.9,2.9,10.8s-1,7.5-2.9,10.8c-1.9,3.3-4.5,5.9-7.8,7.8c-3.3,1.9-6.9,2.9-10.8,2.9
                                            c-2.1,0-4.1-0.3-6.1-0.9c1.1-1.7,1.8-3.3,2.2-4.6c0.2-0.6,0.7-2.6,1.5-5.9c0.4,0.7,1.1,1.4,2,1.9c1,0.5,2,0.8,3.2,0.8
                                            c2.3,0,4.3-0.6,6-1.9c1.8-1.3,3.1-3,4.1-5.3c1-2.2,1.5-4.7,1.5-7.5c0-2.1-0.6-4.1-1.7-6c-1.1-1.9-2.7-3.4-4.8-4.5S30.1,12,27.5,12
                                            c-2,0-3.8,0.3-5.5,0.8c-1.7,0.5-3.1,1.3-4.3,2.1c-1.2,0.9-2.2,1.9-3,3.1c-0.8,1.2-1.5,2.4-1.9,3.6c-0.4,1.2-0.6,2.5-0.6,3.7
                                            c0,1.9,0.4,3.6,1.1,5.1c0.7,1.5,1.8,2.5,3.3,3.1c0.6,0.2,0.9,0,1.1-0.6c0-0.1,0.1-0.4,0.2-0.9c0.1-0.4,0.2-0.7,0.2-0.8
                                            c0.1-0.4,0-0.8-0.3-1.2c-0.9-1.1-1.4-2.5-1.4-4.2c0-2.8,1-5.2,2.9-7.2c1.9-2,4.5-3,7.6-3c2.8,0,5,0.8,6.6,2.3
                                            c1.6,1.5,2.4,3.5,2.4,5.9c0,3.2-0.6,5.9-1.9,8.1c-1.3,2.2-2.9,3.3-4.9,3.3c-1.1,0-2-0.4-2.7-1.2c-0.7-0.8-0.9-1.8-0.6-2.9
                                            c0.1-0.7,0.4-1.5,0.7-2.6c0.3-1.1,0.6-2,0.8-2.9c0.2-0.8,0.3-1.5,0.3-2.1c0-0.9-0.3-1.7-0.8-2.3c-0.5-0.6-1.2-0.9-2.1-0.9
                                            c-1.2,0-2.1,0.5-2.9,1.6c-0.8,1.1-1.2,2.4-1.2,4c0,1.4,0.2,2.5,0.7,3.4L18.4,41c-0.3,1.3-0.4,2.9-0.4,4.9c-3.8-1.7-6.9-4.3-9.3-7.8
                                            s-3.5-7.5-3.5-11.8c0-3.9,1-7.5,2.9-10.8c1.9-3.3,4.5-5.9,7.8-7.8c3.3-1.9,6.9-2.9,10.8-2.9c3.9,0,7.5,1,10.8,2.9
                                            S43.3,12.2,45.2,15.5z" fill="#929292" />
                                    </g>
                                    </svg>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if (isset($data['header_settings']['header_instagram_link']) && $data['header_settings']['header_instagram_link']): ?>
                            <li>
                                <a href="<?php echo $data['header_settings']['header_instagram_link'];?>" class="header-social-link">
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.71875 4.46875C5.42708 3.76042 6.28125 3.40625 7.28125 3.40625C8.28125 3.40625 9.125 3.76042 9.8125 4.46875C10.5208 5.15625 10.875 6 10.875 7C10.875 8 10.5208 8.85417 9.8125 9.5625C9.125 10.25 8.28125 10.5938 7.28125 10.5938C6.28125 10.5938 5.42708 10.25 4.71875 9.5625C4.03125 8.85417 3.6875 8 3.6875 7C3.6875 6 4.03125 5.15625 4.71875 4.46875ZM5.625 8.65625C6.08333 9.11458 6.63542 9.34375 7.28125 9.34375C7.92708 9.34375 8.47917 9.11458 8.9375 8.65625C9.39583 8.19792 9.625 7.64583 9.625 7C9.625 6.35417 9.39583 5.80208 8.9375 5.34375C8.47917 4.88542 7.92708 4.65625 7.28125 4.65625C6.63542 4.65625 6.08333 4.88542 5.625 5.34375C5.16667 5.80208 4.9375 6.35417 4.9375 7C4.9375 7.64583 5.16667 8.19792 5.625 8.65625ZM11.5938 2.6875C11.7604 2.83333 11.8438 3.02083 11.8438 3.25C11.8438 3.47917 11.7604 3.67708 11.5938 3.84375C11.4479 4.01042 11.2604 4.09375 11.0312 4.09375C10.8021 4.09375 10.6042 4.01042 10.4375 3.84375C10.2708 3.67708 10.1875 3.47917 10.1875 3.25C10.1875 3.02083 10.2708 2.83333 10.4375 2.6875C10.6042 2.52083 10.8021 2.4375 11.0312 2.4375C11.2604 2.4375 11.4479 2.52083 11.5938 2.6875ZM14.25 4.125C14.2708 4.6875 14.2812 5.64583 14.2812 7C14.2812 8.35417 14.2708 9.3125 14.25 9.875C14.1875 11.1458 13.8021 12.1354 13.0938 12.8438C12.4062 13.5312 11.4271 13.8958 10.1562 13.9375C9.59375 13.9792 8.63542 14 7.28125 14C5.92708 14 4.96875 13.9792 4.40625 13.9375C3.13542 13.875 2.15625 13.5 1.46875 12.8125C1.19792 12.5625 0.979167 12.2708 0.8125 11.9375C0.645833 11.6042 0.520833 11.2812 0.4375 10.9688C0.375 10.6562 0.34375 10.2917 0.34375 9.875C0.302083 9.3125 0.28125 8.35417 0.28125 7C0.28125 5.64583 0.302083 4.67708 0.34375 4.09375C0.40625 2.84375 0.78125 1.875 1.46875 1.1875C2.15625 0.479167 3.13542 0.09375 4.40625 0.03125C4.96875 0.0104167 5.92708 0 7.28125 0C8.63542 0 9.59375 0.0104167 10.1562 0.03125C11.4271 0.09375 12.4062 0.479167 13.0938 1.1875C13.8021 1.875 14.1875 2.85417 14.25 4.125ZM12.75 11.125C12.8125 10.9583 12.8646 10.75 12.9062 10.5C12.9479 10.2292 12.9792 9.91667 13 9.5625C13.0208 9.1875 13.0312 8.88542 13.0312 8.65625C13.0312 8.42708 13.0312 8.10417 13.0312 7.6875C13.0312 7.27083 13.0312 7.04167 13.0312 7C13.0312 6.9375 13.0312 6.70833 13.0312 6.3125C13.0312 5.89583 13.0312 5.57292 13.0312 5.34375C13.0312 5.11458 13.0208 4.82292 13 4.46875C12.9792 4.09375 12.9479 3.78125 12.9062 3.53125C12.8646 3.26042 12.8125 3.04167 12.75 2.875C12.5 2.22917 12.0521 1.78125 11.4062 1.53125C11.2396 1.46875 11.0208 1.41667 10.75 1.375C10.5 1.33333 10.1875 1.30208 9.8125 1.28125C9.45833 1.26042 9.16667 1.25 8.9375 1.25C8.72917 1.25 8.40625 1.25 7.96875 1.25C7.55208 1.25 7.32292 1.25 7.28125 1.25C7.23958 1.25 7.01042 1.25 6.59375 1.25C6.17708 1.25 5.85417 1.25 5.625 1.25C5.39583 1.25 5.09375 1.26042 4.71875 1.28125C4.36458 1.30208 4.05208 1.33333 3.78125 1.375C3.53125 1.41667 3.32292 1.46875 3.15625 1.53125C2.51042 1.78125 2.0625 2.22917 1.8125 2.875C1.75 3.04167 1.69792 3.26042 1.65625 3.53125C1.61458 3.78125 1.58333 4.09375 1.5625 4.46875C1.54167 4.82292 1.53125 5.11458 1.53125 5.34375C1.53125 5.55208 1.53125 5.875 1.53125 6.3125C1.53125 6.72917 1.53125 6.95833 1.53125 7C1.53125 7.08333 1.53125 7.28125 1.53125 7.59375C1.53125 7.88542 1.53125 8.13542 1.53125 8.34375C1.53125 8.53125 1.53125 8.78125 1.53125 9.09375C1.55208 9.40625 1.57292 9.67708 1.59375 9.90625C1.61458 10.1146 1.64583 10.3333 1.6875 10.5625C1.72917 10.7917 1.77083 10.9792 1.8125 11.125C2.08333 11.7708 2.53125 12.2188 3.15625 12.4688C3.32292 12.5312 3.53125 12.5833 3.78125 12.625C4.05208 12.6667 4.36458 12.6979 4.71875 12.7188C5.09375 12.7396 5.38542 12.75 5.59375 12.75C5.82292 12.75 6.14583 12.75 6.5625 12.75C7 12.75 7.23958 12.75 7.28125 12.75C7.34375 12.75 7.57292 12.75 7.96875 12.75C8.38542 12.75 8.70833 12.75 8.9375 12.75C9.16667 12.75 9.45833 12.7396 9.8125 12.7188C10.1875 12.6979 10.5 12.6667 10.75 12.625C11.0208 12.5833 11.2396 12.5312 11.4062 12.4688C12.0521 12.1979 12.5 11.75 12.75 11.125Z" fill="#929292"/>
                                    </svg>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if (isset($data['header_settings']['header_facebook_link']) && $data['header_settings']['header_facebook_link']): ?>
                            <li>
                                <a href="<?php echo $data['header_settings']['header_facebook_link'];?>" class="header-social-link">
                                    <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.07983 9H5.73608V16H2.61108V9H0.079834V6.09375H2.61108V3.90625C2.61108 3.07292 2.76733 2.36458 3.07983 1.78125C3.39233 1.19792 3.82983 0.760417 4.39233 0.46875C4.97567 0.15625 5.64233 0 6.39233 0C6.72567 0 7.07983 0.0208333 7.45483 0.0625C7.82983 0.0833333 8.1215 0.114583 8.32983 0.15625L8.64233 0.1875V2.65625H7.39233C6.809 2.65625 6.38192 2.8125 6.11108 3.125C5.86108 3.41667 5.73608 3.78125 5.73608 4.21875V6.09375H8.51733L8.07983 9Z" fill="#929292"/>
                                    </svg>
                                </a>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="header-top__right">
                    <!--Change language and flag after click-->
                    <div class="header__langs_wrap">
                        <?php /*pll_the_languages();*/?>
                        <a href="<?php echo get_url_en_prefix() . $current_url;?>" class="header__langs_a <?php if ($current_lang == 'en'):?>active<?php endif;?>">EN</a>
                        <a href="<?php echo get_url_de_prefix() . $current_url; ?>" class="header__langs_a <?php if ($current_lang == 'de'):?>active<?php endif;?>">DE</a>
                    </div>
                </div>
            </div>
            <div class="header__row">
        
                <div class="burger hidden-on-desktop">
                    <span>&nbsp;</span>
                    <span>&nbsp;</span>
                    <span>&nbsp;</span>
                    <div class="burger__label"><? pll_e('close'); ?></div>
                </div>
        
                <a href="<?php the_url( (get_url_lang_prefix()));?>" class="logo">
                    <img src="<?php echo the_theme_path(); ?>/img/logo.png" alt="logo">
                </a>
                <menu>
                    <nav class="nav">
                        <div class="nav-wrap">
                            <div class="header-contact">
                                <?php if (isset($data['header_settings']['header_phone']) && $data['header_settings']['header_phone']): ?>
                                    <p> <? pll_e('Need Help? Contact Us!'); ?>
                                        <a href="tel:<?php echo $data['header_settings']['header_phone'];?>"><?php echo $data['header_settings']['header_phone'];?></a>
                                    </p>
                                <?php endif; ?>
                                <?php if (isset($data['header_settings']['header_email']) && $data['header_settings']['header_email']): ?>
                                    <p>
                                        <? pll_e('Email:'); ?>
                                        <a href="mailto:<?php echo $data['header_settings']['header_email'];?>"><?php echo $data['header_settings']['header_email'];?></a>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <?php $menuItems = get_nav_menu_items("menu-1");?>
                            <?php if($menuItems): ?>
                                <ul class="nav__menu">
                                    <?php foreach($menuItems as $item): ?>
                                        <li>
                                            <a href="<?php echo ($item->url ? (defined('WP_LOCALE_MODE') && WP_LOCALE_MODE == 'DIFF' ? (str_replace('/de/', '/', $item->url)) : $item->url) : '#'); ?>"><?php echo $item->title; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php if($woocommerce->cart->cart_contents_count): ?>
                                        <li>
                                            <a href="<?php the_url( (get_url_lang_prefix()) . 'cart/'); ?>" class="header-cart">
                                                <svg>
                                                    <use xlink:href="#icon-cart"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a href="<?php the_url( (get_url_lang_prefix()) . 'order/');?>" class="btn btn--accent header-btn"><?php pll_e('Paint my Desire'); ?>
                                            <svg>
                                                <use xlink:href="#icon-btn-brush"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            <?php endif; ?>
                            <ul class="nav__social-list">
                                <?php if (isset($data['header_settings']['header_pinterest_link']) && $data['header_settings']['header_pinterest_link']): ?>
                                    <li class="header-social-link">
                                        <a href="<?php echo $data['header_settings']['header_pinterest_link'];?>">
                                            <svg version="1.1" width="17" height="17" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 viewBox="6 4 44 46" style="enable-background:new 0 0 54 54;" xml:space="preserve">
                                            <style type="text/css">
                                                .st0{fill:none;}
                                            </style>
                                            <g>
                                                <rect x="-0.2" y="0.1" class="st0" width="53.8" height="53.4"/>
                                                <path d="M45.2,15.5c1.9,3.3,2.9,6.9,2.9,10.8s-1,7.5-2.9,10.8c-1.9,3.3-4.5,5.9-7.8,7.8c-3.3,1.9-6.9,2.9-10.8,2.9
                                                    c-2.1,0-4.1-0.3-6.1-0.9c1.1-1.7,1.8-3.3,2.2-4.6c0.2-0.6,0.7-2.6,1.5-5.9c0.4,0.7,1.1,1.4,2,1.9c1,0.5,2,0.8,3.2,0.8
                                                    c2.3,0,4.3-0.6,6-1.9c1.8-1.3,3.1-3,4.1-5.3c1-2.2,1.5-4.7,1.5-7.5c0-2.1-0.6-4.1-1.7-6c-1.1-1.9-2.7-3.4-4.8-4.5S30.1,12,27.5,12
                                                    c-2,0-3.8,0.3-5.5,0.8c-1.7,0.5-3.1,1.3-4.3,2.1c-1.2,0.9-2.2,1.9-3,3.1c-0.8,1.2-1.5,2.4-1.9,3.6c-0.4,1.2-0.6,2.5-0.6,3.7
                                                    c0,1.9,0.4,3.6,1.1,5.1c0.7,1.5,1.8,2.5,3.3,3.1c0.6,0.2,0.9,0,1.1-0.6c0-0.1,0.1-0.4,0.2-0.9c0.1-0.4,0.2-0.7,0.2-0.8
                                                    c0.1-0.4,0-0.8-0.3-1.2c-0.9-1.1-1.4-2.5-1.4-4.2c0-2.8,1-5.2,2.9-7.2c1.9-2,4.5-3,7.6-3c2.8,0,5,0.8,6.6,2.3
                                                    c1.6,1.5,2.4,3.5,2.4,5.9c0,3.2-0.6,5.9-1.9,8.1c-1.3,2.2-2.9,3.3-4.9,3.3c-1.1,0-2-0.4-2.7-1.2c-0.7-0.8-0.9-1.8-0.6-2.9
                                                    c0.1-0.7,0.4-1.5,0.7-2.6c0.3-1.1,0.6-2,0.8-2.9c0.2-0.8,0.3-1.5,0.3-2.1c0-0.9-0.3-1.7-0.8-2.3c-0.5-0.6-1.2-0.9-2.1-0.9
                                                    c-1.2,0-2.1,0.5-2.9,1.6c-0.8,1.1-1.2,2.4-1.2,4c0,1.4,0.2,2.5,0.7,3.4L18.4,41c-0.3,1.3-0.4,2.9-0.4,4.9c-3.8-1.7-6.9-4.3-9.3-7.8
                                                    s-3.5-7.5-3.5-11.8c0-3.9,1-7.5,2.9-10.8c1.9-3.3,4.5-5.9,7.8-7.8c3.3-1.9,6.9-2.9,10.8-2.9c3.9,0,7.5,1,10.8,2.9
                                                    S43.3,12.2,45.2,15.5z" fill="#929292" />
                                            </g>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif;?>
                                <?php if (isset($data['header_settings']['header_instagram_link']) && $data['header_settings']['header_instagram_link']): ?>
                                    <li class="header-social-link">
                                        <a href="<?php echo $data['header_settings']['header_instagram_link'];?>">
                                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.71875 4.46875C5.42708 3.76042 6.28125 3.40625 7.28125 3.40625C8.28125 3.40625 9.125 3.76042 9.8125 4.46875C10.5208 5.15625 10.875 6 10.875 7C10.875 8 10.5208 8.85417 9.8125 9.5625C9.125 10.25 8.28125 10.5938 7.28125 10.5938C6.28125 10.5938 5.42708 10.25 4.71875 9.5625C4.03125 8.85417 3.6875 8 3.6875 7C3.6875 6 4.03125 5.15625 4.71875 4.46875ZM5.625 8.65625C6.08333 9.11458 6.63542 9.34375 7.28125 9.34375C7.92708 9.34375 8.47917 9.11458 8.9375 8.65625C9.39583 8.19792 9.625 7.64583 9.625 7C9.625 6.35417 9.39583 5.80208 8.9375 5.34375C8.47917 4.88542 7.92708 4.65625 7.28125 4.65625C6.63542 4.65625 6.08333 4.88542 5.625 5.34375C5.16667 5.80208 4.9375 6.35417 4.9375 7C4.9375 7.64583 5.16667 8.19792 5.625 8.65625ZM11.5938 2.6875C11.7604 2.83333 11.8438 3.02083 11.8438 3.25C11.8438 3.47917 11.7604 3.67708 11.5938 3.84375C11.4479 4.01042 11.2604 4.09375 11.0312 4.09375C10.8021 4.09375 10.6042 4.01042 10.4375 3.84375C10.2708 3.67708 10.1875 3.47917 10.1875 3.25C10.1875 3.02083 10.2708 2.83333 10.4375 2.6875C10.6042 2.52083 10.8021 2.4375 11.0312 2.4375C11.2604 2.4375 11.4479 2.52083 11.5938 2.6875ZM14.25 4.125C14.2708 4.6875 14.2812 5.64583 14.2812 7C14.2812 8.35417 14.2708 9.3125 14.25 9.875C14.1875 11.1458 13.8021 12.1354 13.0938 12.8438C12.4062 13.5312 11.4271 13.8958 10.1562 13.9375C9.59375 13.9792 8.63542 14 7.28125 14C5.92708 14 4.96875 13.9792 4.40625 13.9375C3.13542 13.875 2.15625 13.5 1.46875 12.8125C1.19792 12.5625 0.979167 12.2708 0.8125 11.9375C0.645833 11.6042 0.520833 11.2812 0.4375 10.9688C0.375 10.6562 0.34375 10.2917 0.34375 9.875C0.302083 9.3125 0.28125 8.35417 0.28125 7C0.28125 5.64583 0.302083 4.67708 0.34375 4.09375C0.40625 2.84375 0.78125 1.875 1.46875 1.1875C2.15625 0.479167 3.13542 0.09375 4.40625 0.03125C4.96875 0.0104167 5.92708 0 7.28125 0C8.63542 0 9.59375 0.0104167 10.1562 0.03125C11.4271 0.09375 12.4062 0.479167 13.0938 1.1875C13.8021 1.875 14.1875 2.85417 14.25 4.125ZM12.75 11.125C12.8125 10.9583 12.8646 10.75 12.9062 10.5C12.9479 10.2292 12.9792 9.91667 13 9.5625C13.0208 9.1875 13.0312 8.88542 13.0312 8.65625C13.0312 8.42708 13.0312 8.10417 13.0312 7.6875C13.0312 7.27083 13.0312 7.04167 13.0312 7C13.0312 6.9375 13.0312 6.70833 13.0312 6.3125C13.0312 5.89583 13.0312 5.57292 13.0312 5.34375C13.0312 5.11458 13.0208 4.82292 13 4.46875C12.9792 4.09375 12.9479 3.78125 12.9062 3.53125C12.8646 3.26042 12.8125 3.04167 12.75 2.875C12.5 2.22917 12.0521 1.78125 11.4062 1.53125C11.2396 1.46875 11.0208 1.41667 10.75 1.375C10.5 1.33333 10.1875 1.30208 9.8125 1.28125C9.45833 1.26042 9.16667 1.25 8.9375 1.25C8.72917 1.25 8.40625 1.25 7.96875 1.25C7.55208 1.25 7.32292 1.25 7.28125 1.25C7.23958 1.25 7.01042 1.25 6.59375 1.25C6.17708 1.25 5.85417 1.25 5.625 1.25C5.39583 1.25 5.09375 1.26042 4.71875 1.28125C4.36458 1.30208 4.05208 1.33333 3.78125 1.375C3.53125 1.41667 3.32292 1.46875 3.15625 1.53125C2.51042 1.78125 2.0625 2.22917 1.8125 2.875C1.75 3.04167 1.69792 3.26042 1.65625 3.53125C1.61458 3.78125 1.58333 4.09375 1.5625 4.46875C1.54167 4.82292 1.53125 5.11458 1.53125 5.34375C1.53125 5.55208 1.53125 5.875 1.53125 6.3125C1.53125 6.72917 1.53125 6.95833 1.53125 7C1.53125 7.08333 1.53125 7.28125 1.53125 7.59375C1.53125 7.88542 1.53125 8.13542 1.53125 8.34375C1.53125 8.53125 1.53125 8.78125 1.53125 9.09375C1.55208 9.40625 1.57292 9.67708 1.59375 9.90625C1.61458 10.1146 1.64583 10.3333 1.6875 10.5625C1.72917 10.7917 1.77083 10.9792 1.8125 11.125C2.08333 11.7708 2.53125 12.2188 3.15625 12.4688C3.32292 12.5312 3.53125 12.5833 3.78125 12.625C4.05208 12.6667 4.36458 12.6979 4.71875 12.7188C5.09375 12.7396 5.38542 12.75 5.59375 12.75C5.82292 12.75 6.14583 12.75 6.5625 12.75C7 12.75 7.23958 12.75 7.28125 12.75C7.34375 12.75 7.57292 12.75 7.96875 12.75C8.38542 12.75 8.70833 12.75 8.9375 12.75C9.16667 12.75 9.45833 12.7396 9.8125 12.7188C10.1875 12.6979 10.5 12.6667 10.75 12.625C11.0208 12.5833 11.2396 12.5312 11.4062 12.4688C12.0521 12.1979 12.5 11.75 12.75 11.125Z" fill="#929292"/>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif;?>
                                <?php if (isset($data['header_settings']['header_facebook_link']) && $data['header_settings']['header_facebook_link']): ?>
                                    <li class="header-social-link">
                                        <a href="<?php echo $data['header_settings']['header_facebook_link'];?>">
                                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.07983 9H5.73608V16H2.61108V9H0.079834V6.09375H2.61108V3.90625C2.61108 3.07292 2.76733 2.36458 3.07983 1.78125C3.39233 1.19792 3.82983 0.760417 4.39233 0.46875C4.97567 0.15625 5.64233 0 6.39233 0C6.72567 0 7.07983 0.0208333 7.45483 0.0625C7.82983 0.0833333 8.1215 0.114583 8.32983 0.15625L8.64233 0.1875V2.65625H7.39233C6.809 2.65625 6.38192 2.8125 6.11108 3.125C5.86108 3.41667 5.73608 3.78125 5.73608 4.21875V6.09375H8.51733L8.07983 9Z" fill="#929292"/>
                                            </svg>
                                        </a>
                                    </li>
                                <?php endif;?>
                            </ul>
                            <div class="nav__flag">
                                <div class="header__langs_wrap">
                                    <?php /*pll_the_languages();*/?>
                                    <a href="<?php echo get_url_en_prefix() . $current_url;?>" class="header__langs_a <?php if ($current_lang == 'en'):?>active<?php endif;?>">EN</a>
                                    <a href="<?php the_url( get_url_de_prefix() . $current_url);?>" class="header__langs_a <?php if ($current_lang == 'de'):?>active<?php endif;?>">DE</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <?php if($woocommerce->cart->cart_contents_count): ?>
                        <a href="<?php the_url( (get_url_lang_prefix()) . 'cart/'); ?>" class="header-cart">
                            <svg>
                                <use xlink:href="#icon-cart"></use>
                            </svg>
                        </a>
                    <?php endif; ?>
                </menu>
            </div>
        </header>
        <!-- End header -->
