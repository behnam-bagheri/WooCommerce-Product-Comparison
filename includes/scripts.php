<?php
function enqueue_custom_scripts() {
    // آدرس فایل JavaScript خود را تعیین کنید
    $js_url = plugin_dir_url(__FILE__) . 'js/custom-scripts.js';

    // اضافه کردن فایل JavaScript به صفحه مقایسه محصولات
    if (is_product() && is_product_comparison_page()) {
        wp_enqueue_script('custom-scripts', $js_url, array('jquery'), null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function is_product_comparison_page() {
    // این تابع را برای تعیین صفحه مقایسه محصولات ایجاد کنید
    // مثلاً با استفاده از بررسی URL صفحه
    return is_page('product-comparison');
}
