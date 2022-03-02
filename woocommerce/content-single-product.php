<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */
defined('ABSPATH') || exit;
global $product;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');
if(post_password_required()) {
    echo get_the_password_form();
    return;
}
?>
<div class="row no-gutters">
    <div class="col-12">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
            <section class="site-banner-single">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-single-wrapper p-2 p-md-4" style="background-color: #1b262c;">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="product-single-title text-center mt-3 mt-md-0">
                                            <?php the_title(); ?>
                                            <hr class="title-hr">
                                        </h1>
                                    </div>
                                    <div class="col-md-3 product-single-thumbnail">
                                        <?php
                                            /**
                                            * Hook: woocommerce_before_single_product_summary.
                                            *
                                            * @hooked woocommerce_show_product_sale_flash - 10
                                            * @hooked woocommerce_show_product_images - 20
                                            */
                                            do_action('woocommerce_before_single_product_summary');
                                        ?>
                                        <?php
                                            do_action('woocommerce_template_single_thumbnail');
                                        ?>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="matrix-wrapper d-flex flex-column h-100">
                                            <div class="product-waveform my-2 my-md-0">
                                                <?php
                                                    $waveform_image_dynamic = get_post_meta($product->get_id(), 'soundboutiques_add_waveform_image', true);

                                                    $waveform_image_static = get_template_directory_uri() . '/assets/images/waveform.png';
                                                ?>
                                                <img src="<?php echo (isset($waveform_image_dynamic) && $waveform_image_dynamic == true) ? $waveform_image_dynamic :  $waveform_image_static; ?>" class="waveform-image" alt="Sound waveform">
                                            </div>
                                            <div class="action-buttons d-flex flex-column flex-md-row">
                                                <span class="product-price d-flex align-items-center justify-content-center btn btn-custom bg-white mb-2  mb-md-0">
                                                    <?php echo get_woocommerce_currency_symbol() . $product->get_price(); ?>
                                                </span>
                                                <a href="<?php echo $product->add_to_cart_url(); ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="ajax_add_to_cart add_to_cart_button btn custom-button" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($sku) ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"> Add to Cart </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" style="max-height: 200px; overflow: hidden;">
                                        <div class="banner-single-footer-wrapper mt-4">
                                            <?php
                                                /**
                                                 * Hook: woocommerce_single_product_summary.
                                                 *
                                                 * @hooked woocommerce_template_single_title - 5
                                                 * @hooked woocommerce_template_single_rating - 10
                                                 * @hooked woocommerce_template_single_price - 10
                                                 * @hooked woocommerce_template_single_excerpt - 20
                                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                                 * @hooked woocommerce_template_single_meta - 40
                                                 * @hooked woocommerce_template_single_sharing - 50
                                                 * @hooked WC_Structured_Data::generate_product_data() - 60
                                                 */
                                                do_action('woocommerce_single_product_summary');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="site-main-content text-white">
                <div class="container-fluid px-0">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="inner-wrapper track-single-details p-5">
                                <div class="row mb-5">
                                    <div class="col-12 col-md-6">
                                        <div class="title-wrapper d-flex align-items-center justify-content-between mb-5 mt-5 mt-md-0">
                                            <h2><?php the_title(); ?></h2>
                                        </div>
                                        <?php echo wpautop(get_the_content()); ?>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="title-wrapper d-flex align-items-center justify-content-between mb-5 mt-5 mt-md-0">
                                            <h2>Video sample</h2>
                                        </div>
                                        <div class="video_wrapper">
                                            <?php
                                                $promo_video = get_post_meta($post->ID, 'soundboutiques_yt_embed_code', true);

                                                if($promo_video) {
                                                    echo $promo_video;
                                                } else {
                                                    echo "Video sample will be uploaded soon!";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <?php
                                        /**
                                        * Hook: woocommerce_after_single_product_summary.
                                        *
                                        * @hooked woocommerce_output_product_data_tabs - 10
                                        * @hooked woocommerce_upsell_display - 15
                                        * @hooked woocommerce_output_related_products - 20
                                        */
                                        do_action('woocommerce_after_single_product_summary');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
do_action('woocommerce_after_single_product');
?>
