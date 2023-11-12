<?php
function compare_products($product_id_1, $product_id_2, $selected_attributes) {
    $product_1 = wc_get_product($product_id_1);
    $product_2 = wc_get_product($product_id_2);


    $comparison_result = array();

    if ($product_1 && $product_2) {
        foreach ($selected_attributes as $attribute) {
            $product_1_value = $product_1->get_attribute($attribute);
            $product_2_value = $product_2->get_attribute($attribute);

            if ($product_1_value != $product_2_value) {
                $comparison_result[$attribute] = array(
                    'product_1' => $product_1_value,
                    'product_2' => $product_2_value,
                );
            }
        }
    }

    // return $comparison_result;
}

function product_comparison_shortcode($atts) {
    $atts = shortcode_atts(array(
        'product_id_1' => 0,
        'product_id_2' => 0,
    ), $atts);

    $product_id_1 = intval($atts['product_id_1']);
    $product_id_2 = intval($atts['product_id_2']);



    $selected_attributes = get_option('product_comparison_settings', array('selected_attributes' => array()));

    if ($product_id_1 > 0 && $product_id_2 > 0) {
        //$comparison_result = compare_products($product_id_1, $product_id_2, $selected_attributes);
        if (!empty($comparison_result)) {
            ob_start();
            ?>
            <div class="comparison-results">
                <h2>نتایج مقایسه محصولات</h2>
                <ul>
                    <?php foreach ($comparison_result as $attribute => $values) : ?>
                        <li><?php echo esc_html($attribute); ?>: <?php echo esc_html($values['product_1']); ?> vs. <?php echo esc_html($values['product_2']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
            return ob_get_clean();
        } else {
            return 'محصولات به نظر معتبر برای مقایسه نمی‌آیند یا هیچ تفاوتی مشاهده نشد.';
        }
    } else {
        return 'لطفاً دو محصول برای مقایسه مشخص کنید.';
    }
}

add_shortcode('product_comparison', 'product_comparison_shortcode');
