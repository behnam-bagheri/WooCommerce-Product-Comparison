<?php
defined( 'ABSPATH' ) || exit( 'No direct script access allowed' );

/**
* Plugin Name: Product Comparison
* Description: Product Comparison Plugin.
* Version: 1.0
* Author: Behnam Bagheri
* Author URI: https://bbagheri.ir/
**/


// Load the text domain for translation.
add_action('plugins_loaded', 'product_comparison_load_textdomain');
function product_comparison_load_textdomain() {
    load_plugin_textdomain('product-comparison', false, dirname(plugin_basename(__FILE__)) . '/languages/');

}
// وابستگی به ووکامرس
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    // WooCommerce is active, continue with the plugin
    require_once('admin/admin.php');
    require_once('admin/menu.php');
    require_once('includes/functions.php');


} else {
    // WooCommerce is not active, display an error message and prevent the plugin activation
    add_action('admin_notices', 'product_comparison_woocommerce_missing_notice');

    function product_comparison_woocommerce_missing_notice() {
        ?>
        <div class="error">
            <p><?php _e('Product Comparison requires WooCommerce to be installed and active. Please install and activate WooCommerce to use this plugin.', 'product-comparison'); ?></p>

        </div>
        <?php
    }

    add_action('admin_init', 'product_comparison_deactivate');

    function product_comparison_deactivate() {
        deactivate_plugins(plugin_basename(__FILE__));
    }
}

//function create_product_comparison_table() {
//    global $wpdb;
//    $table_name = $wpdb->prefix . 'product_comparison_table';
//
//    $charset_collate = $wpdb->get_charset_collate();
//
//    $sql = "CREATE TABLE $table_name (
//        id mediumint(9) NOT NULL AUTO_INCREMENT,
//        attribute varchar(255) NOT NULL,
//        image_size text NOT NULL,
//        add_to_cart tinyint(1) NOT NULL,
//        table_title text NOT NULL,
//        created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
//        PRIMARY KEY  (id)
//    ) $charset_collate;";
//
//    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//    dbDelta( $sql );
//}
//register_activation_hook( __FILE__, 'create_product_comparison_table' );