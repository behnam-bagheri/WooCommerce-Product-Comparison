<?php
function enqueue_custom_styles() {
    // آدرس فایل CSS خود را تعیین کنید
    $css_url = plugin_dir_url(__FILE__) . 'css/custom-styles.css';

    // اضافه کردن فایل CSS به صفحه محصولات
    if (is_product()) {
        wp_enqueue_style('custom-styles', $css_url);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');
