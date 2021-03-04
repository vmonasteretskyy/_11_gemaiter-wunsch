<!-- Start breadcrumbs -->
<ul class="breadcrumbs">
    <?php if( function_exists('kama_breadcrumbs') ){
        $l10n = array(
            'home'       => pll__('Home'),
            'paged'      => pll__('Page %d'),
            '_404'       => pll__('404'),
            'search'     => pll__('Search results for query - <b>%s</b>'),
            'author'     => pll__('Author\'s archive: <b>%s</b>'),
            'year'       => pll__('Archive for <b>%d</b> year'),
            'month'      => pll__('Archive for: <b>%s</b>'),
            'day'        => pll__(''),
            'attachment' => pll__('Media: %s'),
            'tag'        => pll__('Records by tag: <b>%s</b>'),
            'tax_tag'    => pll__('%1$s from %2$s by tag: <b>%3$s</b>'),
        );
        kama_breadcrumbs('', $l10n );
    }?>
</ul>
<!-- End breadcrumbs -->
