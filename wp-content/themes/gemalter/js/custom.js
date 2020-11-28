jQuery(document).ready(function ($) {
    const $document = $(document), $window = $(window);
    const currentLang = $('body').data('current-lang');

    /*our gallery filters start*/
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
    /*our gallery filters start*/

    /*contact form start*/
    var contactFormId = 420;
    $document.on('click', '[data-contact-form_submit]', function(e){
        e.preventDefault();
        $('#modal-contact form.form').submit();
    });
    $document.on('submit', '#modal-contact form', function(e){
        e.preventDefault();
        let form = $(this);
        let popup = form.closest('.modal__content');
        //get user data from popup
        let phone = $('#modal-contact form.form input[name="phone"]').val();//*
        let email = $('#modal-contact form.form input[name="contact-email"]').val();//*
        let message = $('#modal-contact form.form [name="contact-message"]').val();

        if (popup.data("busy")) return;
        popup.data("busy", true).addClass("busy");
        popup.find('.error-text').hide();
        //send data to admin when user put data
        if (phone && email) {
            cf7CalculatorSubmit(contactFormId, args = {
                'phone': phone,
                'email': email,
                'message': message,
            }, function(response) {
                if (response.status == 'mail_sent') {
                    popup.find('.form').hide();
                    popup.find('[data-contact-form_submit]').hide();
                    popup.find('.success-text').show();
                    setTimeout(function(){
                        window.location = window.location;
                    }, 3000);
                } else {
                    popup.find('.error-some-error').show();
                }
                popup.data("busy", false).removeClass("busy");
            });
        } else {
            popup.find('.error-required-field').show();
            popup.data("busy", false).removeClass("busy");
        }
    });
    /*contact form end*/

    /*refund form start*/
    var refundFormId = 424;
    $document.on('click', '[data-refund-form_submit]', function(e){
        e.preventDefault();
        $('#modal-money form.form').submit();
    });
    $document.on('submit', '#modal-money form', function(e){
        e.preventDefault();
        let form = $(this);
        let popup = form.closest('.modal__content');
        //get user data from popup
        let first_name = $('#modal-money form.form input[name="first_name"]').val();//*
        let last_name = $('#modal-money form.form input[name="last_name"]').val();//*
        let address = $('#modal-money form.form input[name="address"]').val();//*
        let address2 = $('#modal-money form.form input[name="address2"]').val();
        let city = $('#modal-money form.form input[name="city"]').val();//*
        let state = $('#modal-money form.form input[name="state"]').val();//*
        let postal_code = $('#modal-money form.form input[name="postal_code"]').val();//*
        let country = $('#modal-money form.form input[name="country"]').val();//*
        let phone = $('#modal-money form.form input[name="phone"]').val();//*
        let email = $('#modal-money form.form input[name="email"]').val();//*
        let refund_reason = $('#modal-money form.form input[name="refund_reason"]').val();//*
        let other_refund_reason = $('#modal-money form.form [name="other_refund_reason"]').val();

        if (popup.data("busy")) return;
        popup.data("busy", true).addClass("busy");
        popup.find('.error-text').hide();
        //send data to admin when user put data
        if (first_name && last_name && address && city && state && postal_code && country && phone && email && refund_reason) {
            cf7CalculatorSubmit(refundFormId, args = {
                'first_name': first_name,
                'last_name': last_name,
                'address': address,
                'address2': address2,
                'city': city,
                'state': state,
                'postal_code': postal_code,
                'country': country,
                'phone': phone,
                'email': email,
                'refund_reason': refund_reason,
                'other_refund_reason': other_refund_reason,
            }, function(response) {
                if (response.status == 'mail_sent') {
                    popup.find('.form').hide();
                    popup.find('[data-refund-form_submit]').hide();
                    popup.find('.success-text').show();
                    setTimeout(function(){
                        window.location = window.location;
                    }, 3000);
                } else {
                    popup.find('.error-some-error').show();
                }
                popup.data("busy", false).removeClass("busy");
            });
        } else {
            popup.find('.error-required-field').show();
            popup.data("busy", false).removeClass("busy");
        }
    });
    /*refund form end*/

    /*gift cards form end*/
    $document.on('submit', '[data-gift-form]', function(e){
        e.preventDefault();
        let form = $(this);
        let formMessageWrapper = $('.form-errors-wrapper');
        //get user data from popup
        let data = {
            gift_amount: form.find('[name="gift_amount"]').val(),
            gift_currency: form.find('[name="gift_currency"]').val(),
            gift_sender_name: form.find('[name="gift_sender_name"]').val(),
            gift_recipient_name: form.find('[name="gift_recipient_name"]').val(),
            gift_message: form.find('[name="gift_message"]').val(),
            action: 'ajax_add_to_cart_gift_card',
        }
        if (form.data("busy")) return;
        form.data("busy", true).addClass("busy");
        formMessageWrapper.find('.error-text').hide();
        //send data to admin when user put data
        if (data.gift_amount && data.gift_currency && data.gift_sender_name && data.gift_recipient_name) {
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                type: "post",
                dataType: "json",
                data: data,
                beforeSend: function() {
                },
                success: function(data) {
                    formMessageWrapper.find('.error-response').remove();
                    if (data.has_error) {
                        formMessageWrapper.prepend('<div class="error-text error-response">' + data.error_message + '</div>');
                    } else if (data.html != undefined) {
                        console.log(data);
                        //show html popup
                        //$('body').prepend(data.html);
                    } else {
                        //redirect to checkout;
                        window.location = data.redirect_link;
                    }
                },
                complete: function(){
                    form.data("busy", false).removeClass("busy");
                }, 
                error: function(){
                    formMessageWrapper.find('.error-some-error').show();
                    form.data("busy", false).removeClass("busy");
                }
            });
        } else {
            formMessageWrapper.find('.error-required-field').show();
            form.data("busy", false).removeClass("busy");
        }
    });

    function cf7CalculatorSubmit($formId , $args, callback) {
        var url = '/wp-json/contact-form-7/v1/contact-forms/' + $formId + '/feedback';
        $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: args,
                success: function (response) {
                    if (callback && typeof (callback) === "function") {
                        callback(response);
                    }
                },
            }
        );
    }

    /*show info start*/
    function showInfoPopup(title, description) {
        title = title || '';
        description = description || '';
        $('#modal-info [data-title]').html(title);
        $('#modal-info [data-description]').html(description);
        document.dispatchEvent(new Event('modal-open#modal-info'));
    }

    function showInfoPopupWithButton(title, description, btnText, btnCallback) {
        title = title || '';
        description = description || '';
        btnText = btnText || '';
        $('#modal-info-btn [data-title]').html(title);
        $('#modal-info-btn [data-description]').html(description);
        $('#modal-info-btn [data-btn]').html(btnText);
        $document.on('click', '#modal-info-btn [data-btn]', function(e){
            e.preventDefault();
            if (btnCallback && typeof (btnCallback) === "function") {
                btnCallback();
            } else {
                document.dispatchEvent(new Event('modal-close#modal-info-btn'));
            }
        });
        document.dispatchEvent(new Event('modal-open#modal-info-btn'));
    }
    /*show info end*/

});




function setCookie(c_name,value,expiredays,domain){var exdate=new Date();exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+"="+escape(value)+((typeof expiredays == "undefined") ? "" : "; expires="+exdate.toGMTString())+(domain?"; path="+domain:"");}
function getCookie(c_name){if(document.cookie.length>0){c_start=document.cookie.indexOf(c_name + "=");
    if(c_start!=-1){c_start=c_start + c_name.length+1;c_end=document.cookie.indexOf(";",c_start);
        if(c_end==-1) c_end=document.cookie.length;return unescape(document.cookie.substring(c_start,c_end).replace(/\+/g, " "));}}return"";}