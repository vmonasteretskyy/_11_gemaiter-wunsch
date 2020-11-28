<?php
//redirect from shop page to general order page
$current_lang = pll_current_language();
$location = (get_url_lang_prefix()) . 'order/';
wp_redirect( $location);
exit;
