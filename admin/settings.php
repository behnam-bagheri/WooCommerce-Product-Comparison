<?php
// دریافت مقادیر تنظیمات از دیتابیس
$settings = get_option('product_comparison_settings');
if (!is_array($settings)) {
    $settings = array(
        'image_size' => '',
        'add_to_cart' => 0,
        'table_title' => '',
        'selected_attributes' => array(),
    );
}

// اگر فرم ارسال شده باشد
if (isset($_POST['submit'])) {
    // دریافت مقادیر ورودی از فرم
    $image_size = sanitize_text_field($_POST['image_size']);
    $add_to_cart = isset($_POST['add_to_cart']) ? 1 : 0;
    $table_title = sanitize_text_field($_POST['table_title']);
    $selected_attributes = isset($_POST['attribute']) ? $_POST['attribute'] : array();

    // اعتبارسنجی و بررسی اعتبار داده‌ها
    if (empty($table_title)) {
        // اگر فیلدهای مهم خالی باشند، نمایش پیام خطا
        ?>
        <div class="error">
            <p><?php _e('Please fill in the fields.', 'product-comparison'); ?></p>

        </div>
            <?php
    } else {
        // ذخیره مقادیر جدید در تنظیمات
        $settings = array(
            'image_size' => $image_size,
            'add_to_cart' => $add_to_cart,
            'table_title' => $table_title,
            'selected_attributes' => $selected_attributes,
        );

        update_option('product_comparison_settings', $settings);

      ?>
        <div class="updated">
            <p><?php _e('Settings saved successfully.', 'product-comparison'); ?></p>
        </div>
        <?php

    }
}
?>


<form method="post" action="">
    <?php
    // دریافت ویژگی‌های تعریف شده در ووکامرس
    $product_attributes = wc_get_attribute_taxonomies();

    if (!empty($product_attributes)) {
        echo '<label for="attribute">ویژگی‌ها:</label><br>';

        foreach ($product_attributes as $attribute) {
            $checked = is_array($settings['selected_attributes']) && in_array($attribute->attribute_name, $settings['selected_attributes']) ? 'checked' : '';
            echo '<input type="checkbox" name="attribute[]" id="' . esc_attr($attribute->attribute_name) . '" value="' . esc_attr($attribute->attribute_name) . '" ' . $checked . '>';
            echo '<label for="' . esc_attr($attribute->attribute_name) . '">' . esc_html($attribute->attribute_label) . '</label><br>';
        }
    } else {
        echo '<p>هیچ ویژگی تعریف شده‌ای در ووکامرس وجود ندارد.</p>';
    }
    ?>

    <label for="image_size">سایز تصویر:</label>
    <input type="text" name="image_size" id="image_size" required value="<?php echo esc_attr($settings['image_size']); ?>"><br>

    <label for="add_to_cart">Add To Cart:</label>
    <input type="checkbox" name="add_to_cart" id="add_to_cart" <?php echo $settings['add_to_cart'] ? 'checked' : ''; ?>><br>

    <label for="table_title">عنوان جدول:</label>
    <input type="text" name="table_title" id="table_title" required value="<?php echo esc_attr($settings['table_title']); ?>"><br>

    <input class="button button-primary button-large" type="submit" name="submit" value="ذخیره">
</form>
