// ---------------------------------------------------
//  product-comparison-script
// ---------------------------------------------------

var pagePath = window.location.pathname;
var queryParams = window.location.search;
var urlParams = new URLSearchParams(queryParams);
var product_id1 = urlParams.get("product_id");
var product_id2 = urlParams.get("product_id2");

console.log("آدرس صفحه بدون پارامترهای URL: " + pagePath);
console.log("مقدار پارامتر 'product_id1': " + product_id1);
console.log("مقدار پارامتر 'product_id2': " + product_id2);
console.log("مقدار پارامتر 'queryParams': " + window.location);


jQuery(document).ready(function ($) {

    let overlay = $('.overlay');
    let close = $('.close');
    let comparison_search = $('.product-comparison-search-box');
    let add_to_comparison = $('.add-to-comparison');
    let remove_product = $('.remove-product');

    overlay.click(function (){
        overlay.hide();
        comparison_search.hide();
    });
    close.click(function (){
        overlay.hide();
        comparison_search.hide();
    });

    add_to_comparison.click(function (){
        overlay.show();
        comparison_search.show();
    });

    remove_product.click(function (){
        let id = $(this).attr('data-id');
        if (id === product_id1){
            var desiredURL = pagePath + "?product_id="+product_id2;
            window.location.href = desiredURL;

        }
        if (id === product_id2){
            var desiredURL = pagePath + "?product_id="+product_id1;
            window.location.href = desiredURL;
        }
    });

})