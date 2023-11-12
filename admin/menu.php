<?php
function add_product_comparison_menu_item() {
    add_menu_page(
        'مقایسه محصولات', // عنوان آیتم
        'مقایسه محصولات', // متن نمایش داخل منو
        'manage_options', // سطح دسترسی مورد نیاز برای مشاهده این منو
        'product_comparison_page', // نام منو
        'display_product_comparison_page', // تابع نمایش صفحه منو
        'dashicons-chart-bar', // آیکون منو
        46 // ترتیب نمایش منو
    );
}
add_action('admin_menu', 'add_product_comparison_menu_item');

function display_product_comparison_page() {

    require_once('settings.php');

}

// تابع برای ایجاد taxonomy جدید
function create_product_comparison_taxonomy() {
    $labels = array(
        'name' => 'مقایسه محصولات',
        'singular_name' => 'مقایسه محصول',
        'menu_name' => 'مقایسه محصولات',
    );

    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'product-comparison' ),
    );

    register_taxonomy( 'product_comparison_cat', 'product', $args );
}
add_action( 'init', 'create_product_comparison_taxonomy' );

