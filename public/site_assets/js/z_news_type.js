$(function () {
    $(document).on("click", ".js_news_type_posts_load_more > a", function (e) {
        e.preventDefault();
        const element = $(this);
        const postsWrapper = element.closest(".js_news_type_posts");
        const inputCurPage = postsWrapper.find(".js_news_type_posts_current_page");
        const currentPage = inputCurPage.val() ? parseInt(inputCurPage.val()) : 1;

        siteSystems.ajax.make(
            element.data("url"),
            {page: currentPage + 1, news_type_id: element.data("newsTypeId")},
            "GET",
            element,
            function (data) {
                postsWrapper.find(".js_news_type_posts_content").append($(data.data.html).hide().fadeIn());
                inputCurPage.val(currentPage + 1);

                if (!data.data.hasNextPage) {
                    postsWrapper.find(".js_news_type_posts_load_more").remove();
                }
            }
        )
    })
});
