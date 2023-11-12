<?php

function product_comparison_scripts() {
    wp_enqueue_script('product-comparison-script', plugin_dir_url(__FILE__) . '../assets/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('product-comparison-infinite-scroll', plugin_dir_url(__FILE__) . '../assets/js/infinite-scroll.js', array('jquery'), '1.0', true);
    wp_enqueue_style('product-comparison-style', plugin_dir_url(__FILE__) . '../assets/css/style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'product_comparison_scripts');
function product_comparison_shortcode()
{
    include "comparison-page.php";
}

add_shortcode('product_comparison', 'product_comparison_shortcode');


add_action('wp_enqueue_scripts', 'enqueue_custom_ajax_search_script');

function enqueue_custom_ajax_search_script() {
    wp_enqueue_script('comparison-ajax-search', plugin_dir_url(__FILE__) . '../assets/js/comparison-ajax-search.js', array('jquery'), '1.0', true);
    wp_localize_script('comparison-ajax-search', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_ajax_product_search', 'product_search');
add_action('wp_ajax_nopriv_product_search', 'product_search');

function product_search() {
    $search_keyword = sanitize_text_field($_POST['search_keyword']);
    $compare_link = sanitize_text_field($_POST['compare_link']);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $search_keyword,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // دریافت اطلاعات محصول
            $product = wc_get_product();
            $product_id = get_the_id();
            $product_title = get_the_title();
            $product_image = $product->get_image();

            $link = $compare_link . $product_id;
            // نمایش اطلاعات محصول در هر ردیف

            echo '<div class="product-search-item">';
            echo '<a href="' . $link . '">' ;
            echo $product_image;
            echo '<h3>' . $product_title . '</h3>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo 'No products found.';
    }

    wp_reset_postdata();

    wp_die();
}







add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');
function load_more_products() {
    $search_keyword = sanitize_text_field($_POST['search_keyword']);
    $compare_link = sanitize_text_field($_POST['compare_link']);

    $page = intval($_POST['page']);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 10, // تعداد محصولات در هر صفحه
        'paged' => $page,
        's' => $search_keyword,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // دریافت اطلاعات محصول
            $product = wc_get_product();
            $product_id = get_the_id();
            $product_title = get_the_title();
            $product_image = $product->get_image();

            $link = $compare_link . $product_id;

            // نمایش اطلاعات محصول در یک ردیف

            echo '<div class="product-search-item">';
            echo '<a href="' . $link . '">' ;
            echo $product_image;
            echo '<h3>' . $product_title . '</h3>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo '';
    }

    wp_reset_postdata();

    wp_die();
}

