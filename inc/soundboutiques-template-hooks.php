<?php
/**********************************
 Global hooks and filters
 **********************************/
// Change the Number of WooCommerce Products Displayed Per Page
add_filter( 'loop_shop_per_page', 'soundboutiques_loop_shop_per_page', 30 );

// Remove shop loop elements
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Remove product item elements
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// Remove single product page elements
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

// Remove cart hook elements
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);

// Remove checkout hook elements
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

// Shop page elements hook
add_filter('woocommerce_show_page_title', 'soundboutiques_shop_page_title_filter');
add_action('woocommerce_shop_loop_item_title', 'soundboutiques_woocommerce_template_loop_product_title', 10);
add_action('woocommerce_before_shop_loop_item_title', 'soundboutiques_woocommerce_template_loop_product_thumbnail', 10);

// Single product page hook element
add_action('woocommerce_template_single_thumbnail', 'soundboutiques_woocommerce_get_product_thumbnail', 10);
// add_action('woocommerce_single_product_summary', 'soundboutiques_woocommerce_template_single_title', 5);
// add_action('woocommerce_single_product_summary', 'woocommerce_template_single_attributes', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_attributes_sectioned', 40);
// add_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 12);
add_action( 'woocommerce_after_single_product_summary', 'comments_template', 10 );
add_filter( 'woocommerce_product_tabs', 'soundboutiques_woocommerce_remove_reviews_tab', 98 );

// Cart hook elements


// Checkout hook elements
add_filter( 'woocommerce_checkout_fields', 'soundboutiques_remove_checkout_fields' );
add_filter('woocommerce_checkout_fields', 'soundboutiques_checkout_form_add_class' );
add_filter( 'woocommerce_form_field', 'soundboutiques_add_checkout_fields_wrapper', 10, 4 );

// Minicart
add_filter( 'woocommerce_add_to_cart_fragments', 'soundboutiques_topbar_add_to_cart_fragment' );
