jQuery(document).ready(function ($) {

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

    $('#product-search-input').on('input', function () {
    var searchKeyword = $(this).val();

    $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
            action: 'product_search',
            search_keyword: searchKeyword,
            compare_link : link
        },
        success: function (response) {
            $('#search-results').html(response);
        }
    });
});
});