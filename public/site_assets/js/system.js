var siteSystems = {
    ajax: {
        make: function (url, data, method, button, success, error, successShowArea, ErrorShowArea) {
            if (!url) {
                return false;
            }

            $.ajax({
                url: url,
                type: (method ? method : "GET"),
                data: data ? data : {},
                beforeSend: function () {
                    if (button) {
                        button.attr("disabled", true);
                    }

                    siteSystems.loading.open();
                },
                success: function (data) {
                    if (data.isSuccess) {
                        if (success) {
                            success(data);
                        }
                    } else {
                        if (error) {
                            error(data);
                        } else {
                            console.log(data);
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                },
                complete: function () {
                    if (button) {
                        button.attr("disabled", false);
                    }

                    siteSystems.loading.close();
                }
            })
        },
        submitForm: function (form, success, error) {
            const data = {};

            $.each(form.serializeArray(), function (key, item) {
                data[item.name] = item.value;
            });

            siteSystems.ajax.make(form.attr("action"), data, form.attr('method'), form.find("[type=submit]"), success, error);
        }
    },
    form: {
        renderValidate: function (form, dataMessages) {
            $.each(dataMessages, function (inputName, messages) {
                const formInput = form.find("[name=" + inputName + "]");
                const formGroup = formInput.closest(".form-group");

                if (formGroup) {
                    formGroup.addClass("has-error");
                    formGroup.append("<span class='help-block'>" + messages.join(", ") + "</span>")
                }
            });
        },
        removeValidate: function (form) {
            const hasError = form.find(".has-error");

            hasError.find(".help-block").remove();
            hasError.removeClass("has-error");
        }
    },
    loading: {
        open: function () {
            $('#loading-page').addClass('loading');
            $('#loader-wrapper').fadeIn();
        },
        close: function () {
            $('#loader-wrapper').fadeOut('slow', function () {
                $('#loading-page').removeClass('loading');
            });
        }
    },
    sliderHelper: {
        makeSyncSlider: function () {

            if ($(".container").length && $(window).width() <= 800) {
                $('.js_package_rooms_render .show-on-desktop').remove();
            } else {
                $('.js_package_rooms_render .show-on-mobile').remove();

            }
            const sync1 = $("#sync1");
            const sync2 = $("#sync2");
            const slidesPerPage = 4;

            if ($(".container").length && $(window).width() <= 800) {
                sync1.owlCarousel({
                    items: 1,
                    nav: false,
                    autoplay: false,
                    dots: false,
                    loop: false,
                    touchDrag: false,
                    mouseDrag: false,
                    responsiveRefreshRate: 200,
                    margin: 0,
                    navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
                    //}).on('changed.owl.carousel', siteSystems.sliderHelper.syncPosition);
                });
            } else {
                sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: false,
                    // autoplay: true,
                    dots: false,
                    loop: false,
                    touchDrag: false,
                    mouseDrag: false,
                    responsiveRefreshRate: 200,
                    margin: 0,
                    navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
                });
            }

            $('body').on('click', '.item-package-cruise', function () {
                $('.item-package-cruise').removeClass('current');
                $(this).addClass('current');

                const sync1 = $("#sync1");
                const syncedSecondary = true;

                if (syncedSecondary) {
                    const number = $('.item-package-cruise').index(this);
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            });
            sync2
                // .on('initialized.owl.carousel', function () {
                //     sync2.find(".owl-item").eq(0).addClass("current");
                // })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    margin: 30,
                    nav: true,
                    // smartSpeed: 200,
                    // slideSpeed: 500,
                    slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                    responsiveRefreshRate: 100,
                    touchDrag: true,
                    mouseDrag: false,
                    loop: false,
                    autoplay: false,
                    responsive: {
                        0: {
                            items: 1,
                            slideBy: 1,
                            stagePadding: 40,
                            margin: 20
                        },
                        760: {
                            items: 2,
                            stagePadding: 70,
                            slideBy: 2
                        },
                        1000: {
                            items: 3,
                            slideBy: 3
                        },
                        1200: {
                            items: slidesPerPage,
                        }
                    }
                }).on('changed.owl.carousel', function (event) {
                siteSystems.sliderHelper.getIndexActiveSlider($(this));
            }).on('changed.owl.carousel', siteSystems.sliderHelper.syncPosition2);

        },
        syncPosition: function (el) {
            const sync2 = $("#sync2");
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }

            if (current == count && current == 1) {
                current = 0;
            }
            if (current > count) {
                current = count;
            }

            console.log('current' + current + 'count' + count);
            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");

            const onscreen = sync2.find('.owl-item.active').length - 1;
            const start = sync2.find('.owl-item.active').first().index();
            const end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        },

        syncPosition2: function (el) {
            const sync1 = $("#sync1");
            const syncedSecondary = true;

            // $('#sync2 .owl-item').removeClass('current');

            if (syncedSecondary) {
                const number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        },
        makeSlick1: function () {
            if (typeof $.fn.slick === 'function') {
                $('.slick-1').slick({
                    arrows: false,
                    dots: true
                });
            }
        },
        getIndexActiveSlider: function (elSlider) {
            setTimeout(function () {
                var numberIndexActive = parseInt(elSlider.find(".active.owl-item .owl-number-custom").attr('data-index-number'));

                if (numberIndexActive < 10) {
                    numberIndexActive = "0" + numberIndexActive;
                }

                elSlider.closest('.owl-mobile-number').find('.owl-number-item-active').html(numberIndexActive);

                $('.owl-mobile-number .owl-nav button').click(function () {
                    var owlMobile = $(this).closest(elSlider);
                    siteSystems.sliderHelper.getIndexActiveSlider(owlMobile);
                })
            }, 10);
        },

    },
    helper: {
        numberFormat: function (nStr, thousand, dot) {
            nStr += '';
            thousand = thousand ? thousand : ".";
            dot = dot ? dot : ",";

            const x = nStr.split(dot);
            var x1 = x[0];
            const x2 = x.length > 1 ? dot + x[1] : '';
            const rgx = /(\d+)(\d{3})/;

            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + thousand + '$2');
            }

            return x1 + x2;
        }
    }
};

