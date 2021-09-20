const specialOffers = {
    reloadPackages: function () {
        const specialOfferId = $(".js_special_offer_wrapper .js_special_offer_item.js_filter_item_active").data("id");
        const destinationIds = [];
        const durationIds = [];

        $(".js_special_offer_filter_wrapper .js_special_offer_filter_item").each(function () {
            if ($(this).hasClass("js_filter_item_active")) {
                if ($(this).hasClass("js_filter_destination")) {
                    destinationIds.push($(this).data("id"));
                } else if ($(this).hasClass("js_filter_duration")) {
                    durationIds.push($(this).data("id"));
                }
            }
        });

        let params = {
            destinations: destinationIds,
            durations: durationIds
        };

        if (specialOfferId) {
            params["special_offer"] = specialOfferId;
        }

        if ($("#js_stored_date").val()) {
            params["date"] = $("#js_stored_date").val();
        }

        siteSystems.ajax.make(
            $("#js_filter_url").val(),
            params,
            "GET",
            null,
            function (data) {
                $(".js_special_offer_package_render").html(data.data);

                //Change url
                const path = window.location.pathname;
                const urlParams = $.param(params);

                history.pushState(null, null, path + "?" + urlParams);
            }
        )
    },
    border: function () {
        var positionSpecial = $('.special-active').data('position');
        if (positionSpecial == 1) {
            $('.special-offer-top-detail').css({'border-right': 'unset'});
            $('.special-offer-top-item-2 .special-offer-top-detail').css({'border-right': '1px solid #adadad'});
        } else if (positionSpecial == 2) {
            $('.special-offer-top-detail').css({'border-right': 'unset'});
        } else if (positionSpecial == 3) {
            $('.special-offer-top-detail').css({'border-right': 'unset'});
            $('.special-offer-top-item-1 .special-offer-top-detail').css({'border-right': '1px solid #adadad'});
        } else {
            $('.special-offer-top-detail').css({'border-right': '1px solid #adadad'});
        }
    }
};

$(function () {
    specialOffers.border();

    $(document).on("click", ".js_special_offer_item", function (e) {
        e.preventDefault();

        if ($(this).hasClass("js_filter_item_active")) {
            $(this).removeClass("special-active").removeClass("js_filter_item_active");
        } else {
            $(".js_special_offer_item").removeClass("special-active").removeClass("js_filter_item_active");
            $(this).toggleClass("special-active").toggleClass("js_filter_item_active");
        }
        specialOffers.border();
        specialOffers.reloadPackages();
    });

    $(document).on("click", ".js_special_offer_filter_item", function (e) {
        e.preventDefault();

        $(this).toggleClass("filter-active").toggleClass("js_filter_item_active");

        specialOffers.reloadPackages();
    });
});

