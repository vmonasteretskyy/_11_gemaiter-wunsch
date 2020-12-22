jQuery(document).ready(function ($) {
    const $document = $(document), $window = $(window);
    const currentLang = $('body').data('current-lang');
    const currentLocaleMode = $('body').data('locale-mode');
    /*TODO: can be changes with baseUrl(+ window.location) on live*/

    /*our gallery filters start*/
    $document.on('click', '.gallery-filter-row .option-js', function (e) {
        e.preventDefault();
        setTimeout(function () {
            let params = [];
            $('[data-gallery-filter]').each(function () {
                const element = $(this);
                if (element.val()) {
                    let item = element.attr('name') + '=' + element.val();
                    params.push(item);
                }
            });
            let baseUrl = '/gallery/';
            if (currentLocaleMode != 'DIFF') {
                baseUrl = (currentLang == 'de') ? '/de/gallery/' : '/gallery/';
            }
            if (params.length) {
                window.location = baseUrl + '?' + params.join('&');
            } else {
                window.location = baseUrl;
            }
        }, 100);
    });
    /*our gallery filters start*/

    /*contact form start*/
    const contactFormId = 420;
    $document.on('click', '[data-contact-form_submit]', function (e) {
        e.preventDefault();
        $('#modal-contact form.form').submit();
    });
    $document.on('submit', '#modal-contact form', function (e) {
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
            cf7Submit(contactFormId, args = {
                'phone': phone,
                'email': email,
                'message': message,
            }, function (response) {
                if (response.status == 'mail_sent') {
                    popup.find('.form').hide();
                    popup.find('[data-contact-form_submit]').hide();
                    popup.find('.success-text').show();
                    setTimeout(function () {
                        document.location.reload()
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
    const refundFormId = 424;
    $document.on('click', '[data-refund-form_submit]', function (e) {
        e.preventDefault();
        $('#modal-money form.form').submit();
    });
    $document.on('submit', '#modal-money form', function (e) {
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
            cf7Submit(refundFormId, args = {
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
            }, function (response) {
                if (response.status == 'mail_sent') {
                    popup.find('.form').hide();
                    popup.find('[data-refund-form_submit]').hide();
                    popup.find('.success-text').show();
                    setTimeout(function () {
                        document.location.reload()
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

    /*gift cards form start*/
    $document.on('submit', '[data-gift-form]', function (e) {
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
            cart_item_key: form.find('[name="cart_item_key"]').length ? form.find('[name="cart_item_key"]').val() : '',
            action: 'ajax_add_to_cart_gift_card',
            lang: currentLang,
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
                beforeSend: function () {
                },
                success: function (data) {
                    formMessageWrapper.find('.error-response').remove();
                    if (data.has_error) {
                        formMessageWrapper.prepend('<div class="error-text error-response">' + data.error_message + '</div>');
                    } else if (data.html != undefined) {
                        console.log(data);
                        //show html popup
                        //$('body').prepend(data.html);
                    } else {
                        //redirect to checkout(cart page);
                        //let baseUrl = (currentLang == 'de') ? '/de' : '';
                        let baseUrl = '';
                        window.location = baseUrl + data.redirect_link;
                    }
                },
                complete: function () {
                    form.data("busy", false).removeClass("busy");
                },
                error: function () {
                    formMessageWrapper.find('.error-some-error').show();
                    form.data("busy", false).removeClass("busy");
                }
            });
        } else {
            formMessageWrapper.find('.error-required-field').show();
            form.data("busy", false).removeClass("busy");
        }
    });
    /*gift cards form end*/

    /*send cf7 form*/
    function cf7Submit($formId, $args, callback) {
        const url = '/wp-json/contact-form-7/v1/contact-forms/' + $formId + '/feedback';
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

    /*show info with popup*/
    function showInfoPopupWithButton(title, description, btnText, btnCallback) {
        title = title || '';
        description = description || '';
        btnText = btnText || '';
        $('#modal-info-btn [data-title]').html(title);
        $('#modal-info-btn [data-description]').html(description);
        $('#modal-info-btn [data-btn]').html(btnText);
        $document.on('click', '#modal-info-btn [data-btn]', function (e) {
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

    /*order page start*/
    $document.on('click', '[data-custom-subject-select] .option-js', function (e) {
        let max_items = 16;
        let item = $(this).closest('[data-custom-subject-select]').find('.input-key-js');
        $('[name="subject"][value="custom"]').prop('checked', true).trigger('change');
        item.trigger('change');

        let val = parseInt(item.val());
        let subject_type = item.data('custom-subject-type-value');
        let subjectTypes = ['persons', 'pets'];
        $.each(subjectTypes, function (key, type) {
            if (type != subject_type) {
                let max_type_items = max_items - val;
                let type_options = $('.option-js[data-subject="' + type + '"]');
                type_options.each(function (item) {
                    let item_val = parseInt($(this).data('key'));
                    if (item_val <= max_type_items) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                })
            }
        });
    });

    /*update delivery section when size changed*/
    $document.on('change', '[name="size"]', function (e) {
        let form = $(this).closest('form');

        if (form.data("busy")) return;
        form.data("busy", true).addClass("busy");
        form.find('.error-text').hide();

        let data = form.serialize() + '&action=ajax_get_sizes';
        //send data to admin when user put data
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {
            },
            success: function (data) {
                form.find('.error-response').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else if (data.delivery_html != undefined) {
                    $('[data-deliveries]').html(data.delivery_html);
                    document.dispatchEvent(new Event('initCalendar'));
                    initSummary();
                    if (data.discount != undefined) {
                        $('[data-discount]').html(data.discount.label);
                    }
                    if (data.preview_img_path != undefined) {
                        $('[data-size-preview]').css('background-image', 'url(' + data.preview_img_path + ')');
                    }
                }
            },
            complete: function () {
                form.data("busy", false).removeClass("busy");
            },
            error: function () {
                form.find('.error-some-error').show();
                form.data("busy", false).removeClass("busy");
            }
        });
    });

    /*update sizes section when delivery date&type changed*/
    $document.on('change', '#deliveryDate', function (e) {
        let form = $(this).closest('form');

        if (form.data("busy")) return;
        form.data("busy", true).addClass("busy");
        form.find('.error-text').hide();

        let data = form.serialize() + '&action=ajax_get_sizes';
        //send data to admin when user put data
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {
            },
            success: function (data) {
                form.find('.error-response').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else if (data.html != undefined) {
                    $('[data-sizes]').html(data.html);
                    if (data.discount != undefined) {
                        $('[data-discount]').html(data.discount.label);
                    }
                    PictureLoad();
                    if (data.preview_img_path != undefined) {
                        $('[data-size-preview]').css('background-image', 'url(' + data.preview_img_path + ')');
                    }
                    initSummary();
                }
            },
            complete: function () {
                form.data("busy", false).removeClass("busy");
            },
            error: function () {
                form.find('.error-some-error').show();
                form.data("busy", false).removeClass("busy");
            }
        });
    });

    /*update sizes & delivery sections when changed subject and painting technique*/
    $document.on('change', '[data-size-related]', function (e) {
        let form = $(this).closest('form');

        if (form.data("busy")) return;
        form.data("busy", true).addClass("busy");
        form.find('.error-text').hide();

        let data = form.serialize() + '&action=ajax_get_sizes';
        //send data to admin when user put data
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {
            },
            success: function (data) {
                form.find('.error-response').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else if (data.html != undefined) {
                    $('[data-sizes]').html(data.html);
                    PictureLoad();
                    if (data.delivery_html != undefined) {
                        $('[data-deliveries]').html(data.delivery_html);
                        document.dispatchEvent(new Event('initCalendar'));
                    }
                    if (data.discount != undefined) {
                        $('[data-discount]').html(data.discount.label);
                    }
                    if (data.preview_img_path != undefined) {
                        $('[data-size-preview]').css('background-image', 'url(' + data.preview_img_path + ')');
                    }
                    initSummary();
                }
            },
            complete: function () {
                form.data("busy", false).removeClass("busy");
            },
            error: function () {
                form.find('.error-some-error').show();
                form.data("busy", false).removeClass("busy");
            }
        });
    });

    /*PictureLoad start*/
    let widthEl = document.querySelector('.size-preview__picture .js-size-pre__width');
    let heightEl = document.querySelector('.size-line--horizontal .js-size-pre__width');
    let pictureEl = document.querySelector('.js-size-preview__picture.size-preview__picture');
    let sizePreviewBg = document.querySelector('.size-preview');
    let coef = 1.5;
    let initPictureEvent = (el) => {

        if (!widthEl ||
            !heightEl ||
            !pictureEl) return;

        return (e) => {
            let w = (+el.dataset.w) * coef;
            let h = (+el.dataset.h) * coef;
            widthEl.innerText = el.dataset.w;
            heightEl.innerText = el.dataset.h;

            pictureEl.style.width = w + 'px';
            pictureEl.style.height = h + 'px';

            pictureEl.style.padding = (el.dataset.w / 10) + 'px';

            // if (el.dataset.w >= 70) {
            //     widthEl.classList.remove('green');
            //     heightEl.classList.remove('green');
            //     sizePreviewBg.style.backgroundImage = 'url(/wp-content/themes/gemalter/img/order_bg/bg_grey.jpg)';
            // } else {
            //     widthEl.classList.add('green');
            //     heightEl.classList.add('green');
            //     sizePreviewBg.style.backgroundImage = 'url(/wp-content/themes/gemalter/img/order_bg/bg_green.jpg)';
            // }
        }
    }

    const PictureLoad = () => {
        let pics = document.querySelectorAll('.picture_input');

        pics.forEach(el => {
            if (el.checked) initPictureEvent(el)(window.event);
            el.addEventListener('change', initPictureEvent(el));
        });
    };
    PictureLoad();
    /*PictureLoad end*/

    /*add picture product to cart*/
    $document.on('change click', '[data-add-picture-product-to-cart]', function (e) {
        let form = $(this).closest('form');
        let mode = $(this).data('add-picture-product-to-cart');
        let action = 'ajax_add_to_cart_main_product';
        if (form.data("busy")) return;
        form.data("busy", true).addClass("busy");
        form.find('.error-text').hide();

        let formData = new FormData(form[0]);
        formData.append('mode', mode);
        formData.append('action', action);
        formData.append('lang', currentLang);
        //let files = form.find('[name="photos"]')[0].files;
        if (allFiles.length) {
            $.each(allFiles, function (key, file) {
                formData.append('photos[]', file);
            });
        }
        //send data to admin when user put data
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function () {
            },
            success: function (data) {
                form.find('.error-response').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                    //form.find('.error-wrapper').append('<div class="error-text error-response">' + data.error_message + '</div>');
                } else if (data.html != undefined) {
                    console.log(data);
                    //show html popup
                } else {
                    //redirect to checkout (cart page);
                    //let baseUrl = (currentLang == 'de') ? '/de' : '';
                    let baseUrl = '';
                    window.location = baseUrl + data.redirect_link;
                }
            },
            complete: function () {
                form.data("busy", false).removeClass("busy");
            },
            error: function () {
                form.find('.error-some-error').show();
                form.data("busy", false).removeClass("busy");
            }
        });
    });

    /*clear photos on change input*/
    $document.on('change', '[name="photos"]', function (e) {
        let fileElemInfoPrev = $("#fileElemInfoPrev");
        if (fileElemInfoPrev.length && fileElemInfoPrev.val()) {
            fileElemInfoPrev.remove();
            $('.gallery .gallery__image').remove();
        }
        setTimeout(function(){
            $('.gallery .gallery__image').each(function (index, item){
                const element = $(this);
                if (index > 2) {
                    element.remove();
                }
            });
        }, 500);

    });

    /*update subject in edit order popup*/
    $document.on('change', '[name="subject"]', function (e) {
        let val = $(this).val();
        let labelObject = $(this).closest('label');
        let text = labelObject.find(' > p').text();
        $('[data-edit-order-form] [name="edit_subject"]').val(val);
        $('[data-edit-order-form] [name="edit_subject_text"]').val(text);
    });
    /*update hidden popup*/
    $document.on('change', '[name="size"]', function (e) {
        $('[name="hidden_size"]').val('');
    });

    /*change result image based on paint technique*/
    $document.on('change', '[name="choose_tech"]', function (e) {
        let val = $(this).val();
        //image
        let imgSrc = $(this).closest('label').find('.choose-card__picture img').attr('src');
        $('.result__picture img').attr('src', imgSrc);

        //edit popup
        let text = $(this).closest('.radio-wrap').find('p').text();
        $('[data-edit-order-form] [name="edit_choose_tech"]').val(val);
        $('[data-edit-order-form] [name="edit_choose_tech_text"]').val(text);
    });

    /*update options in order edit popup*/
    $document.on('click', '[data-edit-order-form] .option-js', function (e) {
        let max_items = 16;
        let item = $(this).closest('.form-group--select').find('.input-key-js');
        item.trigger('change');

        let val = item.val();
        let name = item.attr('name');
        if (name == 'edit_choose_tech') {
            //sizes
            $('[data-edit-order-form] [name="edit_size"]').val('');
            $('[data-edit-order-form] [name="edit_size_text"]').val('');
            $('[data-edit-order-form] [data-list="size"] [data-key]').hide();
            $('[data-edit-order-form] [data-list="size"] [data-type="' + val + '"]').show();
            //backgrounds
            $('[data-edit-order-form] [name="edit_background"]').val('');
            $('[data-edit-order-form] [name="edit_background_text"]').val('');
            if (val == 'oil') {
                $('[data-edit-order-form] [data-list="background"] [data-type="color"]').show();
            } else {
                $('[data-edit-order-form] [data-list="background"] [data-type="color"]').hide();
            }
        }
        console.log(name);
    });

    /*open edit order form*/
    $document.on('click', '[data-edit-order-btn]', function (e) {
        e.preventDefault();
        let form = $(this).closest('form');

        let formPopup = $('[data-edit-order-form]');
        let popup = formPopup.closest('.modal__content');

        if (popup.data("busy")) return;
        popup.data("busy", true).addClass("busy");
        popup.find('.error-text').hide();

        let data = form.serialize() + '&action=ajax_get_edit_order_form_html';
        //send data to admin when user put data
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {
            },
            success: function (data) {
                formPopup.find('.error-response').remove();
                if (data.has_error) {
                    formPopup.prepend('<div class="error-text error-response">' + data.error_message + '</div>');
                } else if (data.html != undefined) {
                    formPopup.html(data.html);
                    document.dispatchEvent(new Event('initCustomSelect'));
                }
            },
            complete: function () {
                popup.data("busy", false).removeClass("busy");
            },
            error: function () {
                popup.find('.error-some-error').show();
                popup.data("busy", false).removeClass("busy");
            }
        });


    });

    /*submit edit order form btn click*/
    $document.on('click', '[data-submit-edit-form]', function (e) {
        e.preventDefault();
        console.log('click_edit');
        $('[data-edit-order-form]').submit();
    });

    /*submit edit order form*/
    $document.on('submit', '[data-edit-order-form]', function (e) {
        e.preventDefault();
        console.log('submit_edit');
        let form = $(this);

        let choose_tech = form.find('[name="edit_choose_tech"]').val();

        let size = form.find('[name="edit_size"]').val();
        if (size) {
            $('[name="hidden_size"]').val(size).change();
        }
        if (choose_tech) {
            $('[name="choose_tech"][value="' + choose_tech + '"]').prop('checked', true).trigger('change');
            $('[name="choose_tech"][value="' + choose_tech + '"]')[0].dispatchEvent(new Event('change'));
        }
        if (size) {
            console.log(size);
            $('[name="hidden_size"]').val(size).change();
            $('[name="size"][value="' + size + '"]').prop('checked', true).trigger('change');
            $('[name="size"][value="' + size + '"]')[0].dispatchEvent(new Event('change'));
        }
        let background = form.find('[name="edit_background"]').val();
        if (background) {
            if (background == 'background_artist' || background == 'background_photo') {
                $('[name="background_type"][value="' + background + '"]').prop('checked', true).change().trigger("change");
            } else {
                $('[name="background_type"][value="background_color"]').prop('checked', true).trigger("change");
                $('[name="color"][value="' + background + '"]').prop('checked', true).change().trigger('change');
                $('[name="color"][value="' + background + '"]').closest('.order-bg-slider').find('label').removeClass('active');
                $('[name="color"][value="' + background + '"]').closest("label").addClass('active');
            }
        }
        initSummary();
        document.dispatchEvent(new Event('modal-close#modal-edit'));
    });

    /*init summary*/
    function initSummary() {
        let summaryListeners = document.querySelectorAll('.js-radio-summary input');
        let summaryTable = document.querySelector('.result');
        summaryListeners.forEach(function (input) {
            setSummary(input);
            input.addEventListener('change', function () {
                return setSummary(input);
            });
        });

        function setSummary(input) {
            if (input.checked) {
                let summaryRow = summaryTable.querySelector("#" + input.dataset.summary);
                summaryRow.textContent = input.dataset.summary_text;
            }
        }
    }

    /*order page end*/

    /*cart page start*/
    /*change quantity*/
    $(document).on('click', '.card-number [data-quantity-cart-item]', function (e) {
        let btn = $(this);
        let cart_item_key = btn.data('cart-item-key');
        let quantity = parseInt(btn.data('quantity-cart-item'));
        let mode = btn.data('mode');
        let wrapper = $('.cart-wrap');
        if (quantity < 1) return;

        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");

        data = {
            action: 'set_quantity',
            cart_item_key: cart_item_key,
            quantity: quantity,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {

            },
            success: function (data) {
                wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else {
                    wrapper.find('[data-cart-total-amount]').html(data.total);
                    wrapper.find('[data-cart-subtotal-amount]').html(data.subtotal);
                    wrapper.find('[data-cart-discount-amount]').html(data.discount);
                    if (data.discount_main) {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").show();
                    } else {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").hide();
                    }
                    //update prices in right section too

                    //update quantities
                    quantity = parseInt(quantity);
                    btn.closest('.card-number').find('[data-mode="minus"]').data('quantity-cart-item', (quantity - 1)).attr('data-quantity-cart-item', (quantity - 1));
                    btn.closest('.card-number').find('[data-mode="plus"]').data('quantity-cart-item', (quantity + 1)).attr('data-quantity-cart-item', (quantity + 1));
                    btn.closest('.card-number').find('.card-number__field').val(quantity);
                    if (quantity < 2) {
                        btn.closest('.card-number').find('[data-mode="minus"]').addClass('hide');
                    } else {
                        btn.closest('.card-number').find('[data-mode="minus"]').removeClass('hide');
                    }
                }
            },
            complete: function () {
                wrapper.data("busy", false).removeClass("busy");
            }
        });
    });

    /*delete cart item*/
    $(document).on('click', '.cards .card [data-delete-item]', function (e) {
        let btn = $(this);
        let line = btn.closest('.card');
        let cart_item_key = btn.data('delete-item');
        let wrapper = $('.cart-wrap');
        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");
        data = {
            action: 'product_remove',
            cart_item_key: cart_item_key,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {

            },
            success: function (data) {
                wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else {
                    wrapper.find('[data-cart-total-amount]').html(data.total);
                    wrapper.find('[data-cart-subtotal-amount]').html(data.subtotal);
                    wrapper.find('[data-cart-discount-amount]').html(data.discount);
                    if (data.discount_main) {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").show();
                    } else {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").hide();
                    }
                    //update prices in right section too

                    line.remove();
                    if (data.total_products < 1) {
                        document.location.reload();
                    }
                }
            },
            complete: function () {
                wrapper.data("busy", false).removeClass("busy");
            }
        });
    });

    /*apply coupon*/
    $(document).on('click', '[data-apply-coupon]', function (e) {
        e.preventDefault();
        let btn = $(this);
        let coupon = btn.parent().find('[name="coupon"]').val();
        let wrapper = $('.cart-wrap');
        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");
        data = {
            action: 'apply_coupon',
            coupon: coupon,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {

            },
            success: function (data) {
                wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else {
                    wrapper.find('[data-cart-total-amount]').html(data.total);
                    wrapper.find('[data-cart-subtotal-amount]').html(data.subtotal);
                    wrapper.find('[data-cart-discount-amount]').html(data.discount);
                    if (data.discount_main) {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").show();
                    } else {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").hide();
                    }
                    //update prices in right section too
                    $('[cancel-coupon-wrapper] [data-coupon-val]').text('(' + coupon + ')');
                    $('[cancel-coupon-wrapper] [data-coupon-val]').data('coupon-val', coupon);
                    $('[cancel-coupon-wrapper]').show();
                    $('[apply-coupon-wrapper]').hide();
                    if ($('form.woocommerce-checkout').length && $('form.woocommerce-checkout #payment_types').length && typeof (data.fragments['.woocommerce-checkout-payment']) != 'undefined') {
                        $('form.woocommerce-checkout #payment_types').html(data.fragments['.woocommerce-checkout-payment']);
                    }
                }
            },
            complete: function () {
                wrapper.data("busy", false).removeClass("busy");
            }
        });
    });

    /*cancel coupon*/
    $(document).on('click', '[data-cancel-coupon]', function (e) {
        e.preventDefault();
        let btn = $(this);
        let coupon = btn.closest('.c-form-coupon').find('[data-coupon-val]').data('coupon-val');
        let wrapper = $('.cart-wrap');
        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");
        data = {
            action: 'cancel_coupon',
            coupon: coupon,
        };
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {

            },
            success: function (data) {
                wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else {
                    wrapper.find('[data-cart-total-amount]').html(data.total);
                    wrapper.find('[data-cart-subtotal-amount]').html(data.subtotal);
                    wrapper.find('[data-cart-discount-amount]').html(data.discount);
                    if (data.discount_main) {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").show();
                    } else {
                        wrapper.find('[data-cart-discount-amount]').closest(".c-table__row").hide();
                    }
                    //update prices in right section too
                    $('[cancel-coupon-wrapper] [data-coupon-val]').text('(' + '' + ')');
                    $('[cancel-coupon-wrapper] [data-coupon-val]').data('coupon-val', '');
                    $('[cancel-coupon-wrapper]').hide();
                    $('[apply-coupon-wrapper]').show();
                    if ($('form.woocommerce-checkout').length && $('form.woocommerce-checkout #payment_types').length && typeof (data.fragments['.woocommerce-checkout-payment']) != 'undefined') {
                        $('form.woocommerce-checkout #payment_types').html(data.fragments['.woocommerce-checkout-payment']);
                    }
                }
            },
            complete: function () {
                wrapper.data("busy", false).removeClass("busy");
            }
        });
    });

    /*btn click for proceed-to-checkout*/
    $document.on('click change', '[data-proceed-to-checkout]', function (e) {
        e.preventDefault();
        $('[data-shipping-cart-form]').submit();
    });

    /*send shipping fields and redirect to checkout*/
    $document.on('submit', '[data-shipping-cart-form]', function (e) {
        e.preventDefault();
        let form = $(this);
        let wrapper = $('.cart-wrap');

        if (wrapper.data("busy")) return;
        wrapper.data("busy", true).addClass("busy");
        //get user data from form
        let first_name = $('[data-shipping-cart-form] input[name="first_name"]').val();//*
        let last_name = $('[data-shipping-cart-form] input[name="last_name"]').val();//*
        let address = $('[data-shipping-cart-form] input[name="address"]').val();//*
        let address2 = $('[data-shipping-cart-form] input[name="address2"]').val();
        let city = $('[data-shipping-cart-form] input[name="city"]').val();//*
        let state = $('[data-shipping-cart-form] input[name="state"]').val();//*
        let postal_code = $('[data-shipping-cart-form] input[name="postal_code"]').val();//*
        let country = $('[data-shipping-cart-form] input[name="country"]').val();//*
        let phone = $('[data-shipping-cart-form] input[name="phone"]').val();//*
        let email = $('[data-shipping-cart-form] input[name="email"]').val();//*
        let message = $('[data-shipping-cart-form] [name="message"]').val();

        let data = {
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
            'message': message,
            'action': 'ajax_add_shipping_data',
            'lang': currentLang
        };
        //send data to admin when user put data
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "post",
            dataType: "json",
            data: data,
            beforeSend: function () {
            },
            success: function (data) {
                wrapper.find('.woocommerce-NoticeGroup-checkout').remove();
                if (data.has_error) {
                    showInfoPopup(data.error_title, data.error_message);
                } else {
                    //redirect to checkout;
                    //let baseUrl = (currentLang == 'de') ? '/de' : '';
                    let baseUrl = '';
                    window.location = baseUrl + data.redirect_link;
                }
            },
            complete: function () {
                wrapper.data("busy", false).removeClass("busy");
            }
        });

    });
    //update data-amount-shipping-country
    $document.on('click', '[data-shipping-cart-form] .option-js', function (e) {
        let item = $(this).closest('.form-group--select').find('.input-key-js');
        item.trigger('change');
    });
    $document.on('change', '[data-shipping-cart-form] [name="country"]', function (e) {
        let val = $(this).val();
        $('[data-amount-shipping-country]').val(val);
    });
    /*cart page end*/

    /*checkout page start*/
    /*check for woocommerce errors in woocommerce-NoticeGroup-checkout. If present then show custom error popup*/
    if ($('form.woocommerce-checkout').length) {
        const CHECK_INTERVAL = 500;

        function checkErrors() {
            if ($('form.woocommerce-checkout .woocommerce-NoticeGroup-checkout').length) {
                let html = $('form.woocommerce-checkout .woocommerce-NoticeGroup-checkout').html();
                $('form.woocommerce-checkout .woocommerce-NoticeGroup-checkout').remove();
                showInfoPopup(errorTitle, html);
            }
        }

        let checkInterval = setInterval(function () {
            checkErrors();
        }, CHECK_INTERVAL);
    }

    /*show failed popup*/
    $(window).load(function () {
        if ($('.woocommerce-order-received .order_failed').length) {
            setTimeout(function () {
                document.dispatchEvent(new Event('modal-open#modal-oops'));
            }, 1000);
        }
    });
    /*show success popup*/
    $(window).load(function () {
        if ($('.woocommerce-order-received .order_success').length) {
            setTimeout(function () {
                let email = $('.woocommerce-order-received .order_success').data('order-email');
                let html = $('#modal-thank .modal-bg i').html();
                html = html.replace(/EMAIL/gi, email);
                $('#modal-thank .modal-bg i').html(html);
                document.dispatchEvent(new Event('modal-open#modal-thank'));
            }, 1000);
        }
    });
    /*checkout page end*/

});

function setCookie(c_name, value, expiredays, domain) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" + escape(value) + ((typeof expiredays == "undefined") ? "" : "; expires=" + exdate.toGMTString()) + (domain ? "; path=" + domain : "");
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        var c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) c_end = document.cookie.length;
            return unescape(document.cookie.substring(c_start, c_end).replace(/\+/g, " "));
        }
    }
    return "";
}
