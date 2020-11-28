<?php
//redirect to general gallery page
$current_lang = pll_current_language();
$category = get_term_by('slug', get_query_var('gallery_style'), 'gallery_style');
$location = (get_url_lang_prefix()) . 'gallery/';
if ($category) {
    $location .= '?gallery_style=' . get_query_var('gallery_style');
}
wp_redirect( $location);
exit;
