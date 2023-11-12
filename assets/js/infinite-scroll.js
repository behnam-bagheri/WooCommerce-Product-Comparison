var page = 2; // شماره صفحه برای بارگذاری بعدی
var canLoadMore = true; // آیا می‌توان بیشتر بارگذاری کرد؟

jQuery(document).ready(function ($) {
    $(window).scroll(function () {
        if (canLoadMore && $(window).scrollTop() + $(window).height() > $('#search-results').height() - 100) {
            canLoadMore = false;
            loadNextPage();
        }
    });
    var query = window.location;
    var queryParams = window.location.search;
    var urlParams = new URLSearchParams(queryParams);
    var product_id1 = urlParams.get("product_id");
    var product_id2 = urlParams.get("product_id2");
    var link;
    if (product_id1 == null){
        link = query+"?product_id="
    }else{
        link = query+"&product_id2="
    }
    function loadNextPage() {
        var searchKeyword = $('#product-search-input').val();

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_products',
                page: page,
                search_keyword: searchKeyword,
                compare_link : link
            },
            success: function (response) {
                if (response) {
                    $('#search-results').append(response);
                    page++;
                    canLoadMore = true;
                }
            }
        });
    }
});
