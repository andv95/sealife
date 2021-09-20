const zBanner = {
    changeTypeModelOptions: function () {
        const url = $("select#type").data("url");

        $("select#type_model_id").select2("data", null);

        const data = {
            type: $("select#type").val(),
            selected_id: $("select#type_model_id").data("selected-id")
        };

        prjSystems.ajax.make(url, data, "GET", null, function (data) {
            $('select#type_model_id').empty().trigger('change');

            if (data.data.length > 0) {
                $.each(data.data, function (key, item) {
                    $('select#type_model_id')
                        .append(new Option(item.text, item.id, false, item.selected))
                        .trigger('change');
                });
            }
        });
    }
};

$(document).ready(function () {
    zBanner.changeTypeModelOptions();
});

$(document).on("change", "select#type", function () {
    zBanner.changeTypeModelOptions();
});
