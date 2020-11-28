<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gemalter
 */
$current_lang = pll_current_language();
global $post;
global $wp;
$data = [];
$data['page_post'] = get_category_by_slug(get_query_var('category_name'));
$uncategorized_id = get_cat_ID( 'Uncategorized' );
$catParams = [
    'hide_empty' => 0,
    'exclude' => [$uncategorized_id]
];
$data['categories'] = get_categories($catParams);

$data['posts'] = [];
$paged = get_query_var('paged');
if (!$paged) {
    $paged = 1;
}
$args = array(
    'tax_query' => array(),
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => $paged
);
query_posts( $args );
if ( have_posts() ) {
    while (have_posts()) {
        the_post();
        $data['posts'][] = $post;
    }
}
$args = array(
    'show_all'           => false,
    'current'            => $paged,
    'end_size'           => 1,
    'mid_size'           => 1,
    'prev_next'          => true,
    'prev_text'          => pll__('Prev'),
    'next_text'          => pll__('Next'),
    'add_args'           => true,
    'type'               => 'array',
);
$pagination = paginate_links( $args );

$data['posts_count'] = empty($data['posts']) ? 0 : count($data['posts']);
get_header();
?>

    <!--Start page-->
    <div class="page-wrapper page-blog">
        <!-- Start breadcrumbs -->
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="<?php the_url( (get_url_lang_prefix()) );?>" class="breadcrumbs__link"><?php pll_e('Home'); ?></a>
            </li>
            <li class="breadcrumbs__item">
                <p class="breadcrumbs__link breadcrumbs__link--active"><?php echo isset($data['page_post']->name) && $data['page_post']->post_title ? $data['page_post']->name : pll__('Blog'); ?></p>
            </li>
        </ul>
        <!-- End breadcrumbs -->
        <?php if ((isset($data['page_post']->name) && !empty($data['page_post']->name)) || isset($data['page_post']->description) && !empty($data['page_post']->description)): ?>
            <div class="container-small mx-w-1050">
                <?php if ((isset($data['page_post']->name) && !empty($data['page_post']->name))): ?>
                    <div class="title-wrap m-b-90">
                        <h2 class="">
                            <?php echo $data['page_post']->name;?>
                        </h2>
                    </div>
                <?php endif; ?>
                <?php if (isset($data['page_post']->description) && !empty($data['page_post']->description)): ?>
                    <div class="text text--center text--lite-color m-b-80 text--span-f-w-600">
                        <?php echo wpautop($data['page_post']->description);?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="container-small m-t-80 m-b-90">
            <ul class="blog-filter">
                <?php if (!empty($data['categories'])): ?>
                    <?php foreach($data['categories'] as $category):?>
                        <li class="blog-filter__item <?php if (isset($data['page_post']->term_id) && $data['page_post']->term_id && $category->term_id == $data['page_post']->term_id): ?>active<?php endif; ?>">
                            <?php
                            $category->url = get_category_link($category->term_id);
                            $category->svg_icon = get_field('svg_icon', 'category_' . $category->term_id);
                            ?>
                            <a href="<?php echo $category->url; ?>">
                                <?php echo $category->svg_icon; ?>
                                <?php echo $category->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li class="blog-filter__item">
                    <a href="<?php the_url( (get_url_lang_prefix()) . 'blog/');?>">
                        <svg width="22" height="26" viewBox="0 0 22 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.20508 14.4141C5.01092 14.4141 4.85352 14.5715 4.85352 14.7656V15.3915C4.85352 15.5857 5.01092 15.7431 5.20508 15.7431C5.39923 15.7431 5.55664 15.5857 5.55664 15.3915V14.7656C5.55664 14.5715 5.39923 14.4141 5.20508 14.4141Z" fill="#8D8D8D" stroke="#8D8D8D" stroke-width="0.3"/>
                            <path d="M11.7168 14.4141C11.5226 14.4141 11.3652 14.5715 11.3652 14.7656V15.3915C11.3652 15.5857 11.5226 15.7431 11.7168 15.7431C11.911 15.7431 12.0684 15.5857 12.0684 15.3915V14.7656C12.0684 14.5715 11.911 14.4141 11.7168 14.4141Z" fill="#8D8D8D" stroke="#8D8D8D" stroke-width="0.3"/>
                            <path d="M9.55001 15.108C9.40362 14.9805 9.18157 14.9957 9.05397 15.1421C8.90411 15.3141 8.68774 15.4127 8.4603 15.4127C8.23286 15.4127 8.01654 15.3141 7.86663 15.1421C7.73908 14.9957 7.51699 14.9805 7.3706 15.108C7.22421 15.2356 7.20897 15.4576 7.33652 15.604C7.61997 15.9293 8.02957 16.1158 8.46025 16.1158C8.89094 16.1158 9.30054 15.9293 9.58399 15.604C9.71168 15.4576 9.6964 15.2356 9.55001 15.108V15.108Z" fill="#8D8D8D" stroke="#8D8D8D" stroke-width="0.3"/>
                            <path d="M1 22.907C1 24.0611 1.93891 25 3.09297 25H13.8287C14.9829 25 15.9218 24.0611 15.9218 22.907V22.2837H16.545C17.6991 22.2837 18.638 21.3448 18.638 20.1907V19.5675H19.2612C20.4153 19.5675 21.3542 18.6286 21.3542 17.4745V3.09302C21.3543 1.93891 20.4154 1 19.2613 1H8.52555C7.37144 1 6.43253 1.93891 6.43253 3.09302V3.71627H5.80928C4.65517 3.71627 3.71627 4.65522 3.71627 5.80928V8.04203L1.10303 10.6553C1.04111 10.7172 1 10.8068 1 10.9039V22.907ZM4.41939 5.80928C4.41939 5.04292 5.04287 4.41939 5.80928 4.41939H16.5451C17.3114 4.41939 17.9349 5.04287 17.9349 5.80928V8.8218C17.9349 9.01595 18.0923 9.17336 18.2865 9.17336C18.4806 9.17336 18.638 9.01595 18.638 8.8218V5.80928C18.638 4.65522 17.6991 3.71627 16.5451 3.71627H7.13566V3.09302C7.13566 2.32661 7.75914 1.70312 8.52555 1.70312H19.2613C20.0277 1.70312 20.6512 2.32661 20.6512 3.09302V17.4745C20.6512 18.2409 20.0277 18.8643 19.2613 18.8643H18.6381V10.2089C18.6381 10.0148 18.4807 9.85736 18.2865 9.85736C18.0924 9.85736 17.935 10.0148 17.935 10.2089V19.2159V20.1907C17.935 20.9571 17.3115 21.5806 16.5451 21.5806H15.9219V18.6355C15.9219 18.4413 15.7645 18.2839 15.5703 18.2839C15.3761 18.2839 15.2187 18.4413 15.2187 18.6355V22.907C15.2187 23.6734 14.5953 24.2969 13.8288 24.2969H3.09302C2.32666 24.2969 1.70317 23.6734 1.70317 22.907V11.2554H4.32728C5.15308 11.2554 5.82292 10.5835 5.82292 9.75977V7.13566H13.8288C14.5952 7.13566 15.2187 7.75914 15.2187 8.52555V17.2371C15.2187 17.4312 15.3761 17.5886 15.5703 17.5886C15.7644 17.5886 15.9218 17.4312 15.9218 17.2371V8.52555C15.9218 7.37148 14.9829 6.43253 13.8288 6.43253H5.47136C5.38277 6.43253 5.29019 6.46802 5.22273 6.53556L4.41944 7.33886V5.80928H4.41939ZM5.1198 7.63286V9.75977C5.1198 10.1957 4.76523 10.5523 4.32723 10.5523H2.20033L5.1198 7.63286Z" fill="#8D8D8D" stroke="#8D8D8D" stroke-width="0.3"/>
                        </svg>
                        <?php pll_e('All article'); ?>
                    </a>
                </li>
            </ul>
        </div>
        <?php if (!empty($data['posts'])):?>
            <?php foreach ($data['posts'] as $key => $post): ?>
                <?php
                $post->additional_fields = get_fields($post->ID);
                $post->url = get_permalink($post->ID, false);
                $post->categories = wp_get_post_terms($post->ID, 'category', ['fields' => 'all']);
                if (!empty($post->categories)) {
                    foreach ($post->categories as $keyCat => $category) {
                        if ($category->term_id == $uncategorized_id) {
                            unset($post->categories[$keyCat]);
                            continue;
                        }
                        $category->svg_icon = get_field('svg_icon', 'category_' . $category->term_id);
                        $post->categories[$keyCat] = $category;
                    }
                }
                ?>
                <!-- Start img-text-mod section -->
                <section class="section img-text-mod <?php if ($key%2 == 1): ?>img-text-mod--revers<?php endif; ?> img-text-mod--right-gray img-text-mod--mob-gray img-text-mod--m-p" >
                    <div class="container-small">
                        <div class="img-text-mod-inner">
                            <div class="img-text-mod__left">
                                <?php if (isset($post->additional_fields['listing_vertical_title']) && $post->additional_fields['listing_vertical_title']): ?>
                                    <div class="img-text-mod-label">
                                        <p class="vertical-label"> <?php echo $post->additional_fields['listing_vertical_title']; ?></p>
                                    </div>
                                <?php endif; ?>
                                <div class="img-text-mod__picture img-text-mod-transform">
                                    <?php
                                    $image = isset($post->additional_fields['listing_image']) && $post->additional_fields['listing_image'] ? $post->additional_fields['listing_image'] : null;
                                    if (is_array($image)) {
                                        $image = $image['url'];
                                    } else {
                                        $image = wp_get_attachment_image_src($image, 'full');
                                        if (isset($image[0]) && $image[0]) {
                                            $image = $image[0];
                                        } else {
                                            $image = null;
                                        }
                                    }
                                    ?>
                                    <?php if ($image): ?>
                                        <img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="img-text-mod__right">
                                <a href="<?php echo $post->url; ?>">
                                    <h3 class="title h5">
                                        <?php echo $post->post_title; ?>
                                    </h3>
                                </a>
                                <p class="sub-title">
                                    <i>
                                        <?php echo pll__(date("M", strtotime($post->post_date))) . date(" j, Y", strtotime($post->post_date));?>
                                    </i>
                                </p>
                                <div class="text">
                                    <?php if (isset($post->additional_fields['subtitle']) && $post->additional_fields['subtitle']): ?>
                                        <?php echo nl2br(str_replace("\n", "\n\n", $post->additional_fields['subtitle'])); ?>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($post->categories)): ?>
                                    <div class="gallery-tags">
                                        <?php foreach ($post->categories as $category): ?>
                                            <div class="gallery-tag">
                                                <?php echo $category->svg_icon; ?>
                                                <p><?php echo $category->name;?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End img-text-mod section -->
            <?php endforeach; ?>
        <?php else: ?>
            <h4 class="p-50" style="text-align: center;"><?php pll_e('No records found.'); ?></h4>
        <?php endif; ?>
        <?php if (isset($pagination) && !empty($pagination)): ?>
            <!-- Start pagination -->
            <ul class="pagination m-80">
                <?php foreach ($pagination as $key => $item): ?>
                    <li>
                        <?php if (strpos($item, 'current') !== false): ?>
                            <?php echo str_replace(['class="prev', 'class="next', 'current', 'span'], ['class="btn-prev-arr', 'class="btn-next-arr', 'active', 'a'],$item); ?>
                        <?php else: ?>
                            <?php echo str_replace(['class="prev', 'class="next', 'current'], ['class="btn-prev-arr', 'class="btn-next-arr', 'active'],$item); ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- End pagination -->
        <?php endif; ?>
    </div>
    <!--End page-->
<?php
get_footer();
