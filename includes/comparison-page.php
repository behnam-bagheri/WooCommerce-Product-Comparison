<?php
if (isset($_GET['product_id'])) {
    if (isset($_GET['product_id'])) {
        $product1_id = $_GET['product_id'];

    }
    if (isset($_GET['product_id2'])) {
        $product2_id = $_GET['product_id2'];

    }
}
if (isset($product1_id)) {
    $product_1 = wc_get_product($product1_id);
}
if (isset($product_1) && $product_1) {


    $product1_id = $product_1->get_id();
    $product1_name = $product_1->get_name();
    $product1_image = $product_1->get_image();
    $product1_add_to_cart_button = do_shortcode('[add_to_cart id="' . $product1_id . '" class="add-to-cart-comparison"]');
    $product1_link = get_permalink($product1_id);

}
if (isset($product2_id)) {
    $product_2 = wc_get_product($product2_id);
}
if (isset($product_2) && $product_2) {
    $product2_id = $product_2->get_id();
    $product2_name = $product_2->get_name();
    $product2_image = $product_2->get_image();
    $product2_add_to_cart_button = do_shortcode('[add_to_cart id="' . $product2_id . '" class="add-to-cart-comparison"]');
    $product2_link = get_permalink($product2_id);

}


$selected_attributes = get_option('product_comparison_settings');
$attributes = $selected_attributes ["selected_attributes"];


?>

<div class="product-comparison-wrapper">
    <div class="container">
        <div class="header-comparison">
            <div class="comparison-product">

                <?php
                if (isset($product_1) && $product_1) {
                    ?>
                    <div class="product-box">
                        <div class="remove-product-box">
                                <span class="remove-product" data-id="<?php echo $product1_id; ?>">
                           حذف محصول x
                            </span>
                        </div>
                        <a href="<?php echo $product1_link; ?>">
                            <?php echo $product1_image; ?>
                            <h3 class="product-title">
                                <?php echo $product1_name; ?>
                            </h3>
                        </a>
                        <?php
                        if ($selected_attributes["add_to_cart"] == 1) {
                            echo $product1_add_to_cart_button;
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="add-to-comparison">
                        افزودن کالا
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="comparison-product">

                <?php
                if (isset($product_2) && $product_2) {
                    ?>
                    <div class="product-box">
                        <div class="remove-product-box">
                            <span class="remove-product" data-id="<?php echo $product2_id; ?>">
                                 حذف محصول x
                            </span>
                        </div>
                        <a href="<?php echo $product2_link; ?>">
                            <?php echo $product2_image; ?>
                            <h3 class="product-title">
                                <?php echo $product2_name; ?>
                            </h3>
                        </a>
                        <?php
                        if ($selected_attributes["add_to_cart"] == 1) {
                            echo $product2_add_to_cart_button;
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="add-to-comparison">
                        افزودن کالا
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        if ((isset($product_2) && $product_2) || (isset($product_1) && $product_1)) {
            ?>

            <div class="comparison-items">
                <?php
                foreach ($attributes as $value) {

                    $label_name = wc_attribute_label('pa_' . $value);
                    if (isset($product_1) && $product_1) {

                        $product_1_value = $product_1->get_attribute('pa_' . $value);

                    }
                    if (isset($product_2) && $product_2) {
                        $product_2_value = $product_2->get_attribute('pa_' . $value);

                    }
                    ?>
                    <div class="comparison-item">
                        <p class="comparison-title">
                            <?php echo $label_name; ?>
                        </p>
                        <div class="comparison-item-element">
                            <div class="comparison-product-attr">
                                <p>
                                    <?php
                                    if (isset($product_1) && $product_1) {
                                        echo $product_1_value;
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="comparison-product-attr">
                                <p>
                                    <?php
                                    if (isset($product_2) && $product_2) {
                                        echo $product_2_value;
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>

        <div class="product-comparison-search-box">
            <div class="product-comparison-search-title">
                <h3>
                    انتخاب کالا برای مقایسه

                </h3>
                <span class="close">X</span>
            </div>
            <div class="product-comparison-search-body">

                <input type="text" id="product-search-input" placeholder="جستجو در کالاها...">
                <div id="search-results" class="product-comparison-search-result"></div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>