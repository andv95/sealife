$(document).mouseup(function (e) {
    let container = $(".my-dropdown-menu");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
    }
    let width_mobile = $('.body-sealife').width();
    if (width_mobile <= 768) {
        let container = $(".main-menu-wrapper");
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
        $('.bar-menu-main').click(function () {
            $('.main-menu-wrapper').toggle();
        });
    }

});

$(document).ready(function ($) {
    jQuery.fn.vjustify = function () {
        var e = 0;
        this.each(function () {
            this.offsetHeight > e && (e = this.offsetHeight)
        }), this.each(function () {
            jQuery(this).height(e + "px"), this.offsetHeight > e && jQuery(this).height(e - (this.offsetHeight - e) + "px")
        })
    }
    if (typeof $.fn.select2 === 'function') {
        $('.input-select2').select2({
            minimumResultsForSearch: -1
        });
        $('.input-select2-search').select2();
    }

    $('.check-availability-rate a').click(function () {
        $('html, body').animate({
            scrollTop: $("#room-slider").offset().top
        }, 1000);
    });

    //Close pre-loading.
    siteSystems.loading.close();

    $('.menu-main-icon').click(function () {
        $(this).closest('li').find('ul').toggle();
    });

    $('.my-accordion .card-header a h5').click(function () {
        $('.plus-acc').text('+');
        let showAcc = $(this).closest('.card').find('.collapse.show').length;
        if (!showAcc) {
            $(this).closest('.card-header').find('.plus-acc').text('-');
        }

    });

    $('.my-accordion-arrow .card-header a h5').click(function () {
        $('.arrow-acc').text('❮');
        let showAcc = $(this).closest('.card').find('.collapse.show').length;
        if (!showAcc) {
            $(this).closest('.card-header').find('.arrow-acc').text('❯');
        }

    });

    $('.slider-1').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        items: 1,
        dots: true,
    });

    var slider1Mobile = $('.slider-1-mobile');

    slider1Mobile.owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        items: 1,
        dots: true,
        responsive: {
            0: {
                dots: false,
            },
        }
    });

    slider1Mobile.on('changed.owl.carousel', function (event) {
        siteSystems.sliderHelper.getIndexActiveSlider($(this));
    });

    $('.owl-number-next').click(function () {
        $(this).closest('.owl-mobile-number').find('.owl-next').trigger('click');
    });

    $('.owl-number-prev').click(function () {
        $(this).closest('.owl-mobile-number').find('.owl-prev').trigger('click');
    });


    $('.special-offer-mobile').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        items: 4,
        dots: false,
        responsive: {
            0: {
                items: 1,
                stagePadding: 60,
                center: true,
                loop: true
            },
            760: {
                items: 2
            },
            1000: {
                items: 3
            },
            1200: {
                items: 4,
                nav: true,
                dots: true
            }
        }
    });

    $('.slider-4').owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 4,
        dots: false,
        responsive: {
            0: {
                items: 1,
                center: true,
                loop: true,
                stagePadding: 40
            },
            760: {
                items: 2
            },
            1000: {
                items: 3
            },
            1200: {
                items: 4,
                nav: true,
                dots: true
            }
        }
    });

    var roomList = $('.room-list');
    roomList.owlCarousel({
        loop: false,
        margin: 20,
        nav: true,
        items: 4,
        dots: false,
        responsive: {
            0: {
                items: 1,
                center: true,
                loop: true,
                stagePadding: 50
            },
            760: {
                items: 2
            },
            1000: {
                items: 3
            },
            1200: {
                items: 4,
                nav: true,
                dots: true
            }
        }
    });
    roomList.on('changed.owl.carousel', function (event) {
        siteSystems.sliderHelper.getIndexActiveSlider($(this));
    });

    $('.slider-5').owlCarousel({
        loop: false,
        margin: 15,
        nav: true,
        items: 5,
        dots: false,
        responsive: {
            0: {
                items: 1,
                stagePadding: 40,
                nav: true,
                center: true,
                loop: true,
            },
            760: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200: {
                items: 5,
                nav: true,
                dots: true
            }
        }
    });

    $('.slider-4_5').owlCarousel({
        loop: false,
        margin: 24,
        nav: true,
        items: 4,
        dots: false,
        navText: ['<img src="/site_assets/image/icons/left-arrow-in-circle-outline.png" width="40" height="40">', '<img src="/site_assets/image/icons/right-arrow-in-circle-outline.png" width="40" height="40">'],

        responsive: {
            0: {
                items: 1,
                stagePadding: 60,
                center: true,
                loop: true,
            },
            760: {
                items: 2,
                stagePadding: 50,
            },
            1000: {
                items: 3,
                stagePadding: 50,
            },
            1100: {
                items: 4,
                nav: true,
                stagePadding: 100,
            },
            1300: {
                items: 5,
                nav: true,
                stagePadding: 50,
            },
            1500: {
                items: 6,
                nav: true,
                stagePadding: 150,
            }
        }
    });

    var slider35 = $('.slider-3_5');
    slider35.owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        // navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1,
                stagePadding: 50,
                margin: 20,
                center: true,
                loop: true,
            },
            760: {
                items: 2,
                margin: 20,
            },
            1000: {
                items: 3,
                margin: 20,
            },
            1400: {
                items: 4,
                margin: 25,
            }
        }
    });
    slider35.on('changed.owl.carousel', function (event) {
        siteSystems.sliderHelper.getIndexActiveSlider($(this));
    });

    $('.owl-custom-button .owl-nav .owl-next').each(function () {
        if ($(this).hasClass('disabled')) {
            $(this).closest('.owl-custom-button').find('.custom-next').addClass('disabled');
        }
    });


    $('.custom-next').click(function () {
        const originButtonPrev = $(this).closest('.owl-custom-button').find('.owl-prev');
        const originButtonNext = $(this).closest('.owl-custom-button').find('.owl-next');

        originButtonNext.trigger('click');

        if (originButtonPrev.hasClass('disabled')) {
            $(this).siblings(".custom-back").addClass("disabled");
        } else {
            $(this).siblings(".custom-back").removeClass("disabled");
        }

        if (originButtonNext.hasClass('disabled')) {
            $(this).addClass("disabled");
        } else {
            $(this).removeClass("disabled");
        }
    });

    $('.custom-back').click(function () {
        const originButtonNext = $(this).closest('.owl-custom-button').find('.owl-next');
        const originButtonPrev = $(this).closest('.owl-custom-button').find('.owl-prev');

        originButtonPrev.trigger('click');

        if (originButtonPrev.hasClass('disabled')) {
            $(this).addClass("disabled");
        } else {
            $(this).removeClass("disabled");
        }

        if (originButtonNext.hasClass('disabled')) {
            $(this).siblings(".custom-next").addClass("disabled");
        } else {
            $(this).siblings(".custom-next").removeClass("disabled");
        }
    });

    $('body').on('click', '.my-dropdown-button', function () {
        $(this).closest('.my-dropdown').find('.dropdown-menu').toggle();
    });

    const dateStart = new Date();
    dateStart.setDate(dateStart.getDate() + 1);

    var showMonths = 1;
    if ($(window).width() >= 760) {
        showMonths = 2;
    }
    let html_lang = document.querySelector('html').getAttribute('lang');
    let flatpickr_search_date_input = {
        showMonths: showMonths,
        changeMonth: true,
        minDate: dateStart,
        disableMobile: "true"
    };
    if (html_lang === 'vi') {
        flatpickr_search_date_input['locale'] = 'vn';
    }
    // console.log(flatpickr_search_date_input);
    var searchDateInput = flatpickr('.search-date-input', flatpickr_search_date_input);

    $('.show-price').click(function () {
        $('html, body').animate({
            scrollTop: $("#search-date-package").offset().top
        }, 1000);
        setTimeout(function () {
            searchDateInput.open();
        }, 0);
    });

    var dateFormat;

    if ($('#send-inquiry-page').length) {
        dateFormat = 'D, F d, Y';
    } else {
        dateFormat = 'd-m-Y'
    }
    let flatpickr_my_date = {
        dateFormat: dateFormat,
        showMonths: showMonths,
        changeMonth: true,
        minDate: dateStart,
        disableMobile: "true",
        onChange: (selectedDates, dateStr, instance) => {
            const myDate = selectedDates[0];
            const yr = myDate.getFullYear();
            const month1 = myDate.getMonth() + 1;
            const month2 = (month1 < 10 ? '0' + month1 : month1);
            const day = (myDate.getDate() < 10 ? '0' + myDate.getDate() : myDate.getDate());

            $("input.my-date-render").val(yr + '-' + month2 + '-' + day).trigger("change");
        }
    };
    if (html_lang === 'vi') {
        flatpickr_my_date['locale'] = 'vn';
    }
    flatpickr('.my-date', flatpickr_my_date);

    function totalPassengers(className) {
        total = 0;
        $(className).each(function () {
            total = parseInt($(this).val()) + parseInt(total);
        });
        return total;
    }

    function numberPassengers() {
        let room = parseInt($('.dropdown-menu-passenger').length);
        let adult = totalPassengers('.adult-number');
        let infant = totalPassengers('.infant-number');
        let child = totalPassengers('.child-number');
        let allChild = parseInt(infant) + parseInt(child);
        let label_room = $('.translate-search').data('label_room');
        let label_child = $('.translate-search').data('label_child');
        let label_adults = $('.translate-search').data('label_adults');
        $('.dropdown-search-passengers button.my-dropdown-button').html(room + ' ' + label_room + ' - ' + adult + ' ' + label_adults + ' - ' + allChild + ' ' + label_child);
    }

    $('body').on('click', '.plus', function () {
        let number = $(this).closest('.number').find('.choose-number').val();
        $(this).closest('.number').find('.choose-number').val(parseInt(number) + 1);
        //check if people > 3 alert max is 3
        let cabin = $(this).closest('.cabin-detail-list');
        let adult = cabin.find('.adult-number').val();
        let infant = cabin.find('.infant-number').val();
        let child = cabin.find('.child-number').val();
        let cabinPeoples = parseInt(adult) + parseInt(infant) + parseInt(child);

        if (cabinPeoples > 3) {
            $(this).closest('.number').find('.choose-number').val(parseInt(number));
            alert('Maximum of cabin is 3 people.You are choosing ' + cabinPeoples + ' people for this cabin. Please choose again !!!');
        } else {
            $(this).closest('.number').find('.choose-number').val(parseInt(number) + 1);
        }
        numberPassengers();
    });

    $('body').on('click', '.minus', function () {
        let number = $(this).closest('.number').find('.choose-number').val();
        let newNumber = parseInt(number) - 1;
        if (newNumber < 0) {
            newNumber = 0;
        }
        $(this).closest('.number').find('.choose-number').val(newNumber);
        numberPassengers();
    });

    $('body').on('click', '.add-more-cabin-action', function () {
        let number_passenger = parseInt($('.dropdown-menu-passenger').length) + 1;
        let label_cabin = $('.translate-search').data('label_cabin');
        let label_adults = $('.translate-search').data('label_adults');
        let label_child = $('.translate-search').data('label_child');
        let label_infant = $('.translate-search').data('label_infant');
        let label_add_more_cabin = $('.translate-search').data('label_add_more_cabin');
        let label_done = $('.translate-search').data('label_done');
        let label_remove = $('.translate-search').data('label_remove');

        $('.add-more-cabin').hide();
        $("<div class='dropdown-menu dropdown-menu-passenger my-dropdown-menu display-block'>\n" +
            "                                                <div class='cabin-content'>\n" +
            "<div class='row cabin-search-head'>" +
            "<h4 class='col-md-6'>" + label_cabin + number_passenger + "</h4>" +
            "<div class='delete-cabin col-md-6'><span>" + label_remove + "</span></div>" +
            "</div>" +
            "                                                    <div class='cabin-detail-list'>\n" +
            "                                                        <div class='number'>\n" +
            "                                                            <span class='minus'>-</span>\n" +
            "                                                            <input type='text' readonly class='choose-number adult-number' value='2' min='0'\n" +
            "                                                                   max='999'/>\n" +
            "                                                            <span class='cabin-sub-text'>" + label_adults + " (12+ yrs)</span>\n" +
            "                                                            <span class='plus'>+</span>\n" +
            "                                                        </div>\n" +
            "                                                        <div class='number'>\n" +
            "                                                            <span class='minus'>-</span>\n" +
            "                                                            <input type='text' readonly class='choose-number child-number' value='0' min='0'\n" +
            "                                                                   max='999'/>\n" +
            "                                                            <span class='cabin-sub-text'>" + label_child + " (6-11 yrs)</span>\n" +
            "                                                            <span class='plus'>+</span>\n" +
            "                                                        </div>\n" +
            "                                                        <div class='number'>\n" +
            "                                                            <span class='minus'>-</span>\n" +
            "                                                            <input type='text' readonly class='choose-number infant-number' value='0' min='0'\n" +
            "                                                                   max='999'/>\n" +
            "                                                            <span class='cabin-sub-text'>" + label_infant + " (0-5 yrs)</span>\n" +
            "                                                            <span class='plus'>+</span>\n" +
            "                                                        </div>\n" +
            "                                                    </div>\n" +
            "                                                </div>\n" +
            "                                                <div class='add-more-cabin add-more-cabin-new'>\n" +
            "                                                    <span class='add-more-cabin-action'>+ <u>" + label_add_more_cabin + "</u></span>\n" +
            "                                                    <button class='close-search'>" + label_done + "</button>\n" +
            "                                                </div>\n" +
            "                                            </div>").insertAfter('.my-dropdown-menu-passenger  .dropdown-menu-passenger:last-child');
        numberPassengers();
    });

    $('body').on('click', '.delete-cabin', function () {
        $(this).closest('.dropdown-menu-passenger').remove();
        let cabins = parseInt($('.dropdown-menu-passenger').length);
        let cabinsBase = parseInt($('.dropdown-menu-passenger').length);
        $('.cabin-search-head h4').each(function () {
            $(this).html('Cabin ' + (cabins++ - cabinsBase + 1));
        });
        let room = parseInt($('.dropdown-menu-passenger').length);
        numberPassengers();
        if (room === 1) {
            $('.delete-cabin').hide();
            $('.add-more-cabin').show();
        }
    });

    $('body').on('click', '.close-search', function () {
        $('.dropdown-menu-passenger').hide();
    })

    $('body').on('click', '.search-duration-input', function () {
        $('.dropdown-menu-duration').toggle();
    });

    $('.dropdown-menu-destination a').click(function () {
        var count = $('.input-destination:checkbox:checked').length;
        var destination = $('.input-destination:checkbox:checked').data('destination');

        var destination_text = $(this).find('input').data('destination_text');
        if (count == 0) {
            $(this).closest('.dropdown-search').find('button').text(destination_text);
        } else if (count == 1) {
            $(this).closest('.dropdown-search').find('button').text(destination);
        } else {
            $(this).closest('.dropdown-search').find('button').text(count + ' ' + destination_text);
        }
    });

    $('body').on('click', '.dropdown-menu-duration .dropdown-item', function () {
        var textDuration = $(this).data('text-value');
        var valDuration = $(this).data('value');
        $('.search-duration-input').val(textDuration);
        $('.duration-value').val(valDuration);
        $('.dropdown-menu-duration .dropdown-item').removeClass('active-duration');
        $(this).addClass('active-duration');
        $('.dropdown-menu-duration').hide();
    });

    $('.gallery-home-main').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });


    $('.gallery-feeling').each(function () { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });

    setTimeout(function () {
        $(".item-experience-detail").height("auto").vjustify();
        $(".special-offer-top-item").height("auto").vjustify();
    }, 1e3);

    // js for mobile
    $(".container").length && $(window).width() < 600 && setTimeout(function () {
        let has_sub_menu = $('.has-sub-menu');
        has_sub_menu.append(`<i class="fa fa-chevron-down menu-down-mobile">
                    <svg class="icon-down-chevron" width="15" height="15">
                      <use xlink:href="#down-chevron"></use>
                  </svg><svg class="icon-up-chevron" width="15" height="15">
                      <use xlink:href="#up-chevron"></use>
                  </svg></i>`);

        has_sub_menu.click(function () {
            var link = $(this);
            link.find('.main-menu-page').slideToggle('slow', function () {
                if ($(this).is(':visible')) {
                    link.find('.menu-down-mobile').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    link.find('.menu-down-mobile').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
            });
        });

        $('.bar-menu-main').click(function () {
            var link = $(this);
            link.siblings('.main-menu-wrapper').slideToggle('slow', function () {
                if ($(this).is(':visible')) {
                    link.find('i').removeClass('fa-bars').addClass('fa-window-close');
                } else {
                    link.find('i').removeClass('fa-window-close').addClass('fa-bars');
                }
            });
        });

        // $('.my-dropdown-button').click(function () {
        //     var link = $(this);
        //     link.closest('.my-dropdown').find('.dropdown-menu').slideToggle('slow', function() {
        //         if ($(this).is(':visible')) {
        //             link.find('i').removeClass('fa-bars').addClass('fa-window-close');
        //         } else {
        //             link.find('i').removeClass('fa-window-close').addClass('fa-bars');
        //         }
        //     });
        // });
    });

    if ($('.new-destinations>ul>li').length >= 5) {
        $('.new-destinations>ul>li').css({'float': 'left'});
    }
    siteSystems.sliderHelper.makeSlick1();


    $(".container").length && $(window).width() <= 800 && setTimeout(function () {
        $('#page-default-content table').wrap('<div class="table-scroll">');
        $('.new-description-detail-content table').wrap('<div class="table-scroll">');


        // $('.has-sub-menu').click(function () {
        //     $(this).find('.main-menu-page').toggle();
        // })
    }, 1e3);
    if ($(".container").length && $(window).width() >= 800) {
        $('.item-package-cruise.item.owl-number-custom').addClass('col-md-3');
    }
});

$(window).on("load", function () {
    let get_price_min = function (id, url) {
        $.get(url, function (response) {
            $('.package-min-price[data-id="' + id + '"]').html(response);
        });
    };
    let package_price_min = function () {
        let packages = {}, promisedEvents = [];
        $('.package-min-price').each(function () {
            let id = $(this).data('id');
            packages[id] = $(this).data('url');
        });
        $.each(packages, function (id, url) {
            promisedEvents.push(get_price_min(id, url));
        });

        Promise.all(promisedEvents);
    };
    package_price_min();

    $(".container").length && $(window).width() >= 760 && setTimeout(function () {
        $("#main-content > .list-cruise-home .item-cruise").height("auto").vjustify();
        $(".cruise-grey .list-cruise-home .item-cruise").height("auto").vjustify();
        $(".item-cruise .cruise-destination").height("auto").vjustify();
        $(".item-cruise .special-offer-section").height("auto").vjustify();
        $(".item-room-package-detail-public").height("auto").vjustify();
        $(".special-offer-top-detaitem-cruiseil").height("auto").vjustify();
        $(".about-us-height").height("auto").vjustify();
        // $(".cruise-content").height("auto").vjustify();
        $(".special-offer-item").height("auto").vjustify();
        $(".item-cruise .cruise-head-item").height("auto").vjustify();

        if ($(".container").length && $(window).width() >= 800) {
            var container_width = $('.container').width();
            var window_width = $(window).width();
            var margin_container = (window_width - container_width) / 2;
            $('.itinerary-content').css("padding-left", margin_container);


            var map_width = $('.map-package-wrapper').width();
            var height_map = (map_width * 600) / 925;
            $('.map-package').css("height", height_map);
            $('.list-iti-slide').css("height", height_map);


        }
    }, 1e3);
})
