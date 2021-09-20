$(document).ready(function () {
    prjSystems.init.documentReady();

    //Confirm when click destroy in table list.
    $(document).on("click", ".js_button_destroy", function (e) {
        return confirm(prjSystems.helpers.getMetaContent("message_confirm_destroy"));
    });

    //Ajax submit form.
    /*$(document).on("submit", 'form.js_ajax_form', function (event) {
        event.preventDefault();
        return prjSystems.core.ajaxFormSubmit($(this));
    });*/

    $(document).on("change", "#js_edit_add_change_language", function () {
        prjSystems.core.getEditAddDataWhenChangeLang($(this), $("#js_edit_content_on_change_language"));
    });

    //Disabled button submit after submit form
    $(document).on("submit", ".js_server_form", function () {
        $(this).find("[type=submit]").attr("disabled", true);
    });

    //Render slug on keypress.
    $(document).on('keyup', 'input.js_render_slug', function () {
        const text = $(this).val();

        $(".js_receive_slug").val(prjSystems.helpers.makeSlug(text));
    });

    $(document).on("click", ".js_edit_add_image_field .js_edit_add_image_browse", function (e) {
        e.preventDefault();

        inputId = $(this).find('input')[0].id;

        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
    });

    $(document).on("click", ".js_edit_add_file_browse", function (e) {
        e.preventDefault();

        inputId = $(this).find('input')[0].id;

        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
    });

    $(document).on("click", ".js_edit_add_image_field .js_edit_add_image_remove > span", function (e) {
        e.preventDefault();
        prjSystems.image.editAdd.remove($(this));
    });

    $(document).on("click", ".js_edit_add_append_view_wrapper .js_edit_add_append_view_button", function () {
        const button = $(this);
        const wrapper = button.closest(".js_edit_add_append_view_wrapper");
        const list = wrapper.find(".js_edit_add_append_view_list");
        const url = button.data("url");
        const keys = [];
        const params = (wrapper.data("params") ? wrapper.data("params") : []);

        list.find(".js_edit_add_append_view_item").each(function () {
            keys.push($(this).data('key'));
        });

        var data = {key: (keys ? (Math.max.apply(Math, keys) + 1) : 0)};

        $.each(params, function (key, value) {
            data[key] = value;
        });

        prjSystems.ajax.make(
            url,
            data,
            "GET",
            button,
            function (data) {
                list.append(data.data);
            }
        );
    });

    $(document).on("click", ".js_edit_add_append_view_wrapper .js_edit_add_append_view_item_remove", function () {
        const remove = $(this);
        const list = remove.closest(".js_edit_add_append_view_list");

        if (list.find(".js_edit_add_append_view_item").length > 1) {
            remove.closest(".js_edit_add_append_view_item").remove();

            return true;
        }

        alert("Còn mỗi một cái mà :(");

        return false;
    });
});

// input
var inputId = '';

// set file link
function fmSetLink($url) {
    const input = $("#" + inputId);

    input.val($url);
    input.siblings("label").html($url);
    input.closest(".js_edit_add_image_field")
        .find(".js_edit_add_exist_image")
        .html("<img src='" + $url + "'/>");
}
