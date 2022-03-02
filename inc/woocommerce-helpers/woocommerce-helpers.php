<?php

// Chnage the default number of products per page for pagination
function soundboutiques_loop_shop_per_page($number_of_items_per_page) {
    $number_of_items_per_page = 20;
    return $number_of_items_per_page;
}

// Remove shop page title
function soundboutiques_shop_page_title_filter() {
    return;
}

// Add custom product title
function soundboutiques_woocommerce_template_loop_product_title() {
    $product_cat_info = soundboutiques_get_product_catinfo();
    echo "<div class='audio-track card-footer'><a href=" . get_the_permalink() . "><h3 class='track-title'>" . get_the_title() . "</h3></a><a href='" . $product_cat_info['product_cat_link'] . "'><span class='track-category'>" . $product_cat_info['product_cat_name'] . "</span></a></div>";
}

// Remove thumbnails and add image plus links
function soundboutiques_woocommerce_template_loop_product_thumbnail() {
    global $product;

    $file_link = get_post_meta($product->get_id(), 'wp_custom_attachment', true);
    $product_cat_info = soundboutiques_get_product_catinfo();
    ?>

    <div class="card-body">
        <?php echo ($product->get_price() < 1) ? '<span class="free-badge"></span>' : '';?>
        <a class="product-thumbnail position-relative" href="<?php the_permalink(); ?>">
            <?php woocommerce_template_loop_product_thumbnail(); ?>
        </a>
        <div class="audio-card-overlay card-img-overlay d-flex">
            <div class="overlay-icons d-flex">
                <a href="<?php the_permalink(); ?>"><span class="ti-eye h-100"></span></a>
                <a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo $product->get_sku(); ?>" aria-label="Add '<?php echo $product->get_name(); ?>' to your cart" rel="nofollow" class="product_type_simple add_to_cart_button ajax_add_to_cart"><span class="ti-shopping-cart h-100"></a>
            </div>
            <span class="overlay-pricetag"><?php echo wc_price($product->get_price()); ?></span>
        </div>
        <div class="audio-card-play">
            <a href="<?php the_permalink(); ?>" class="overlay-audio-icon d-flex align-items-center justify-content-center"></a>
            <a href="<?php if(strlen($file_link)) { echo $file_link; } ?>" class="audio-triangle" data-action="play" data-price="<?php echo $product->get_price(); ?>" data-thumbnail="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" data-title="<?php echo $product->get_title(); ?>" data-category="<?php echo $product_cat_info['product_cat_name']; ?>" data-url="<?php echo the_permalink(); ?>"  data-currency="<?php echo get_woocommerce_currency_symbol(); ?>">
                <span class="play-icon"></span>
            </a>
        </div>
    </div>
<?php }

// Get product thumbnail with size set
function soundboutiques_woocommerce_get_product_thumbnail( $size = 'woocommerce_single', $return_type = '' ) {
    global $post;

    if ( has_post_thumbnail() ) {
        $output = get_the_post_thumbnail( $post->ID, $size );
    } else {
         $output = wc_placeholder_img( $size );
    }
    if($return_type == 'link') {
        echo get_the_post_thumbnail_url($post->ID, $size);
    } else {
        echo $output;
    }
}

// Single product title
function soundboutiques_woocommerce_template_single_title() { ?>
    <h1 itemprop="name" class="product_title entry-title track-title"><?php the_title(); ?></h1>
    <h6 class="track-subtitle">
        <?php
            $product_cat_info = soundboutiques_get_product_catinfo();
            echo "<a href='" . $product_cat_info['product_cat_link'] . "'>" . $product_cat_info['product_cat_name'] . "</a>";
        ?>
    </h6>
<?php }

// Single product attributes
function woocommerce_template_single_attributes() {
    global $product;
?>
    <div class="audio-info">
        <ul class="info-list">
            <li class="info-item">
    			<span class="sku_wrapper">
    				<?php esc_html_e( 'SKU:', 'woocommerce' ); ?>
    			</span>
    			<?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?>
    		</li>
        </ul>
        <ul class="info-list d-flex">
            <li class="info-item">
                <span>Label:</span>
                <?php soundboutiques_get_product_label_name('pa_label'); ?>
            </li>
            <li class="info-item">
                <span>Genre:</span>
                <?php soundboutiques_get_product_label_name('pa_genre'); ?>
            </li>
            <li class="info-item">
                <span>Type:</span>
                <?php soundboutiques_get_product_label_name('pa_file-type'); ?>
            </li>
        </ul>
        <ul class="info-list">
            <li class="info-item">
                <span>Instrument:</span>
                <?php soundboutiques_get_product_label_name('pa_instrument'); ?>
            </li>
        </ul>
    </div>
<?php }

// Single product attributes
function woocommerce_template_single_attributes_sectioned() {
    global $product;
?>
    <div class="banner-single-meta d-none d-lg-flex">
        <div class="meta-item d-flex flex-column">
            <div class="meta-title text-uppercase">
                <h6>
                    <?php esc_html_e( 'BPM', 'woocommerce' ); ?>
                </h6>
            </div>
            <div class="meta-info">
                <?php soundboutiques_get_product_label_name('pa_bpm'); ?>
            </div>
        </div>
        <div class="meta-item d-flex flex-column">
            <div class="meta-title text-uppercase">
                <h6>
                    <?php esc_html_e( 'Genre', 'woocommerce' ); ?>
                </h6>
            </div>
            <div class="meta-info">
                <?php soundboutiques_get_product_label_name('pa_genre'); ?>
            </div>
        </div>
        <div class="meta-item d-flex flex-column">
            <div class="meta-title text-uppercase">
                <h6>
                    <?php esc_html_e( 'Length', 'woocommerce' ); ?>
                </h6>
            </div>
            <div class="meta-info">
                <?php soundboutiques_get_product_label_name('pa_length'); ?>
            </div>
        </div>
        <div class="meta-item d-flex flex-column">
        <div class="meta-title text-uppercase">
            <h6>
                <?php esc_html_e( 'Plugins', 'woocommerce' ); ?>
            </h6>
        </div>
        <div class="meta-info">
            <?php soundboutiques_get_product_label_name('pa_plugins'); ?>
        </div>
    </div>
    </div>
<?php }

// Remove excerpt from single product page
function woocommerce_template_single_excerpt() {
    return;
}

// Remove table in single page
function soundboutiques_woocommerce_remove_reviews_tab($tabs) {
    unset( $tabs['description'] );
    unset( $tabs['reviews'] );
    unset( $tabs['additional_information'] );
    return $tabs;
}

// Remove checkout fields
function soundboutiques_remove_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_phone']);
    return $fields;
}

// Add custom class to checkout input field
function soundboutiques_checkout_form_add_class($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}

// Add custom class to form-row <p> tag
function soundboutiques_add_checkout_fields_wrapper( $field, $key, $args, $value ) {

    // $field =  preg_replace('/form-row(?!-)/', 'form-row input-wrapper mb-4 ', $field);
    $field =  preg_replace('/input-text(?![a-zA-Z])/', 'input-text form-control', $field);
    return $field;
}

// The topbar minicart
function soundboutiques_topbar_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
    <?php

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}
