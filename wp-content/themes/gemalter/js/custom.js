jQuery(document).ready(function ($) {
    const $document = $(document), $window = $(window);
    const currentLang = $('body').data('current-lang');
    // change status
    $document.on('click', '.gallery-filter-row .option-js', function(e){
        e.preventDefault();
        setTimeout(function(){
            let params = [];
            $('[data-gallery-filter]').each(function(){
                const element = $(this);
                if (element.val()) {
                    var item = element.attr('name') + '=' + element.val();
                    params.push(item);
                }
            });
            let baseUrl = (currentLang == 'de') ? '/de/gallery/' : '/gallery/';
            if (params.length){
                window.location = baseUrl + '?' + params.join('&');
            } else {
                window.location = baseUrl;
            }
        }, 100);

    });
});