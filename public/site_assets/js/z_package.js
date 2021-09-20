$(document).ready(function () {
    siteSystems.sliderHelper.makeSyncSlider();
    $('.owl-custom-button .owl-nav .owl-next').each(function () {
        if ($(this).hasClass('disabled')) {
            $(this).closest('.owl-custom-button').find('.custom-next').addClass('disabled');
        }
    });
    // $(document).on("click", "#sync2 .owl-item", function (e) {
    //     e.preventDefault();
    //     const number = $(this).index();
    //     $("#sync1").data('owl.carousel').to(number, 300, true);
    // });

    $(document).on("click", ".js_package_reviews_load_more > a", function (e) {
        e.preventDefault();
        const element = $(this);
        const reviewWrapper = element.closest(".js_package_reviews");
        const inputCurPage = reviewWrapper.find(".js_package_review_current_page");
        const currentPage = inputCurPage.val() ? parseInt(inputCurPage.val()) : 1;

        siteSystems.ajax.make(
            element.data("url"),
            {page: currentPage + 1, package_id: element.data("packageId")},
            "GET",
            element,
            function (data) {
                reviewWrapper.find(".js_package_reviews_content").append($(data.data.html).hide().fadeIn());
                inputCurPage.val(currentPage + 1);

                if (!data.data.hasNextPage) {
                    reviewWrapper.find(".js_package_reviews_load_more").fadeOut().remove();
                }
            }
        );
    });

    $(document).on("change", ".js_package_select_date", function () {
        const date = $(this).val();

        siteSystems.ajax.make(
            $(this).data('url'),
            {package_id: $(this).data("packageId"), date: date},
            "GET",
            null,
            function (data) {
                if (date) {
                    //Change url
                    const path = window.location.pathname;
                    const urlParams = $.param({date: date});

                    history.pushState(null, null, path + "?" + urlParams);
                }

                $(".js_package_price_render").html(data.data.price);
                $(".js_package_rooms_render").html(data.data.rooms);
                $("#js_package_input_room_id").val(data.data.roomApiId);

                siteSystems.sliderHelper.makeSyncSlider();
                siteSystems.sliderHelper.makeSlick1();
            },
            function (data) {
                $(".js_package_price_render").html("Something wrong :(");
                $(".js_package_rooms_render").html("Something wrong :(");
                $("#js_package_input_room_id").val("");
            }
        );
    });

    $(document).on("click", ".js_package_room_book_promotion", function (e) {
        e.preventDefault();

        //Change roomId
        $("#js_package_input_room_id").val($(this).data("roomId"));

        if ($(this).hasClass("js_package_room_book_flexible")) {
            $("#js_package_input_flexible_promotion").val(1);
        } else {
            $("#js_package_input_flexible_promotion").val(0);
        }

        //Submit form
        $("form#js_package_form_send_inquiry").submit();
    });
});
