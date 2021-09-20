//Newsletters post.
$(document).on("submit", "form.js_contact_form", function (e) {
    e.preventDefault();

    const form = $(this);
    const messageArea = $("#js_form_contact_message");

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
