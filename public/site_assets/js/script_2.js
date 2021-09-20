//Newsletters post.
$(document).on("submit", "form.js_site_newsletter_form", function (e) {
    e.preventDefault();

    const form = $(this);
    const messageArea = form.find(".js_site_newsletter_message");

    messageArea.html("");
    messageArea.removeClass("text-success");
    messageArea.removeClass("text-danger");

    siteSystems.ajax.submitForm(form, function (data) {
        messageArea.addClass("text-success").html(data.messages[0]);
    }, function (data) {
        messageArea.addClass("text-danger").html(data.messages[0]);
    });
});

class SiteRating {
    constructor() {
        this.rate_key = 'sl_rate';
        this.rate_value = this.get_rate();
        this.wrapper = document.querySelector('.wrapper-rating');
        if (this.wrapper) {
            this.load();
        }
    }

    load() {
        let vm = this;
        if (vm.rate_value) {
            vm.wrapper.querySelector('.start-items').innerHTML = `
            <div class="star_item star_2"></div>
            <div class="star_item star_1" style="width: ${vm.wrapper.dataset.width}%"></div>`;
        } else {
            let template = `<form class="rate-form">`;
            for (let i = 1; i < 6; i++) {
                template += `<input type="radio" id="rate-value-${i}" class="rate-value-${i}" name="rate_value" value="${i}">`;
            }
            template += `
            <div class="star_item star_2"></div>
            <div class="star_item star_1"></div>
            </form>`;

            vm.wrapper.querySelector('.start-items').innerHTML = template;
            vm.wrapper.querySelectorAll('input[name="rate_value"]').forEach((ele) => {
                ele.addEventListener('click', function () {
                    vm.click(ele);
                })
            });
        }
    }

    click(ele) {
        let vm = this;
        // window.test_ele = ele;
        let post_data = {
            // '_toke': vm.wrapper.dataset.token,
            'id': vm.wrapper.dataset.id,
            'type': vm.wrapper.dataset.type,
            'locale': vm.wrapper.dataset.locale,
            'value': ele.value,
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': vm.wrapper.dataset.token
            }
        });
        siteSystems.ajax.make(vm.wrapper.dataset.route, post_data, "POST", false, (response) => {
            console.log(response);
            vm.set_rate(ele.value);
            vm.rate_value = ele.value;
            vm.load();
        });
    }

    set_rate(rate_value) {
        if (typeof localStorage == 'object') {
            localStorage.setItem(this.rate_key, rate_value);
        }
    }

    get_rate() {
        if (typeof localStorage == 'object') {
            return localStorage.getItem(this.rate_key);
        }
        return 0;
    }
}

new SiteRating();
