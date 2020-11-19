<?php
//redirect to general gallery page
$current_lang = pll_current_language();
$category = get_term_by('slug', get_query_var('gallery_subject'), 'gallery_subject');
$location = ($current_lang == 'de' ? '/de/' : '/') . 'gallery/';
if ($category) {
    $location .= '?gallery_subject=' . get_query_var('gallery_subject');
}
wp_redirect( $location);
exit;
