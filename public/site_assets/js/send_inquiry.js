const sendInquiry = {
    refreshNumberOfCustomer: function () {
        const adult = $("#js_inquiry_number_of_adult").val();
        const children = $("#js_inquiry_number_of_children").val();
        const infant = $("#js_inquiry_number_of_infant").val();

        $(".js_inquiry_num_of_adult_render").html(
            sendInquiry.addZeroToNumber(
                adult,
                $(".js_inquiry_num_of_adult_render").data("label") + ',',
                $(".js_inquiry_num_of_adult_render").data("labels") + ','
            )
        );

        $(".js_inquiry_num_of_children_render").html(
            sendInquiry.addZeroToNumber(
                children,
                $(".js_inquiry_num_of_children_render").data("label") + ',',
                $(".js_inquiry_num_of_children_render").data("labels") + ','
            )
        );
        $(".js_inquiry_num_of_infant_render").html(
            sendInquiry.addZeroToNumber(
                infant,
                $(".js_inquiry_num_of_infant_render").data('label'),
                $(".js_inquiry_num_of_infant_render").data('labels')
            )
        );
    },
    addZeroToNumber(number, singularLabel, pluralLabel) {
        number = parseInt(number);

        const label = number > 1 ? pluralLabel : singularLabel;

        if (number < 10) {
            return "0" + number + (label !== undefined ? " " + label : "");
        }

        return number + (label !== undefined ? " " + label : "");
    },
};

$(function () {
    sendInquiry.refreshNumberOfCustomer();

    $(document).on("change", ".js_inquiry_number_of_customer", function () {
        sendInquiry.refreshNumberOfCustomer();
    });

    $(document).on("submit", "form.js_send_inquiry_form", function (e) {
        e.preventDefault();

        const form = $(this);
        const messageArea = $("#js_form_send_inquiry_message");

        messageArea.html("");
        messageArea.removeClass("text-success");
        messageArea.removeClass("text-danger");

        siteSystems.form.removeValidate(form);

        siteSystems.ajax.submitForm(form, function (data) {
            if (data.data.redirectUrl) {
                window.location.href = data.data.redirectUrl;
            } else {
                messageArea.addClass("text-success").html(data.messagesHtml);
                $('html, body').animate({scrollTop: messageArea.offset().top}, 'slow');
            }
        }, function (data) {
            const statusCode = data.statusCode;

            if (statusCode === 422) {
                siteSystems.form.renderValidate(form, data.messages);
            } else {
                messageArea.addClass("text-success").html(data.messagesHtml);
                $('html, body').animate({scrollTop: messageArea.offset().top}, 'slow');
            }
        });
    });

    //Refresh
    $(document).on("change", ".js_inquiry_refresh_url_select", function () {
        const params = {
            start_date: $("#js_inquiry_input_start_date").val(),
            z_package_id: $("#js_inquiry_input_package_id").val(),
            z_room_api_id: $("#js_inquiry_input_z_room_id_id").val(),
            number_of_room: $("#js_inquiry_input_number_of_room").val(),
            is_flexible_promotion: $("#js_inquiry_input_is_flexible_promotion").val(),
        };

        siteSystems.ajax.make(
            $(".js_inquiry_refresh_url").data("refreshUrl"),
            params,
            "GET",
            null,
            function (data) {
                $(".js_inquiry_promotion_text_render").html(data.data.promotionText);
                $(".js_inquiry_promotion_price_render").html(data.data.promotionPrice);
                $("#js_inquiry_input_is_flexible_promotion").val(data.data.isFlexiblePromotion);
                $(".js_inquiry_room_name_render").html(data.data.roomName);
                $(".js_inquiry_date_format_render").html(data.data.dateFormat);

                $("#js_inquiry_input_number_of_room").attr("data-price-per-room", data.data.price);

                $(".js_inquiry_return_date_format_render").each(function () {
                    if ($(this).is("input")) {
                        $(this).val(data.data.returnDateFormat);
                    } else {
                        $(this).html(data.data.returnDateFormat);
                    }
                });

                //Change url
                const path = window.location.pathname;
                const urlParams = $.param({
                    package_id: params.z_package_id,
                    room_id: params.z_room_api_id,
                    is_flexible_promotion: data.data.isFlexiblePromotion,
                    date: params.start_date,
                    number_of_room: params.number_of_room
                });

                history.pushState(null, null, path + "?" + urlParams);
            },
            function (data) {
                const messageArea = $("#js_form_send_inquiry_message");

                messageArea.html("");
                messageArea.removeClass("text-success");
                messageArea.removeClass("text-danger");
                messageArea.addClass("text-success").html(data.messagesHtml);

                $('html, body').animate({scrollTop: messageArea.offset().top}, 'slow');
            }
        );
    });

    $(document).on("click", ".js_inquiry_button_change_number_of_room", function () {
        const numberOfRoomInput = $("#js_inquiry_input_number_of_room");
        const numberOfRoomVal = parseInt(numberOfRoomInput.val());

        if (numberOfRoomVal < 1) {
            numberOfRoomInput.val("01");

            return false;
        }

        //Update price
        const pricePerRoom = parseInt(numberOfRoomInput.attr("data-price-per-room"));
        const totalPrice = numberOfRoomVal * pricePerRoom;

        $(".js_inquiry_promotion_price_render").find("span:nth-child(2)").html(siteSystems.helper.numberFormat(totalPrice));
        numberOfRoomInput.val(sendInquiry.addZeroToNumber(numberOfRoomVal));
    });
});

