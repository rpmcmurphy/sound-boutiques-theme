<?php
/**
* Template Name: Page Home
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
/**
 * The front-page content.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soundboutiques
 */

get_header();
?>
    <section class="site-banner-home">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex flex-column home-banner-right">
                    <form class="h-100 p-md-5" method="get" id="home-banner-searchform" role="search" action="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
                        <div class="banner-search-wrapper d-flex flex-column h-100 justify-content-center" style="padding-top: 0 !important;">
                            <h3 class="mb-3">Looking for any specific kinds of sound?</h3>
                            <?php
                                $args = array( 'type' => 'product', 'taxonomy' => 'product_cat' );
                                $soundboutiques_categories = get_categories($args);

                                $args_product_genre = array( 'type' => 'product', 'taxonomy' => 'pa_genre' );
                                $soundboutiques_genre = get_terms($args_product_genre);
                            ?>
                            <select name="soundboutiques-product-cat" class="custom-select border-none mb-2" id="select-product-cat">
                                <option selected value="">Any categories</option>
                                <?php foreach ($soundboutiques_categories as $soundboutiques_cats) { ?>
                                <option value="<?php echo $soundboutiques_cats->slug; ?>"><?php echo $soundboutiques_cats->name; ?></option>
                                <?php } ?>
                            </select>
                            <select name="soundboutiques-product-attr-genre" class="custom-select border-none mb-2" id="select-product-genre">
                                <option selected value="">Any genre</option>
                                <?php foreach ($soundboutiques_genre as $soundboutiques_genre) { ?>
                                <option value="<?php echo $soundboutiques_genre->slug; ?>"><?php echo $soundboutiques_genre->name; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="search-from-home" value="home-banner-form">
                            <input type="hidden" value="" name="s">
                            <input type="submit" id="home-banner-search-submit" value="Search" class="custom-button mb-2"/>
                        </div>
                    </form>
                </div>

                <div class="col-md-8">
                    <div class="slider-wrapper">
                        <!-- MAIN SLIDES -->
                        <?php
                            $slider_product_ids = explode(',', get_option('slider_product_ids'));
                            foreach ($slider_product_ids as $slider_product_id) {
                                $_product[] = wc_get_product(trim($slider_product_id));
                            }
                        ?>
            			<div class="slider-slick-image">
                            <?php $_index = 1; ?>
                            <?php if ($_product[0]) {
                            foreach ($_product as $key => $value):?>
                                <?php
                                    $slider_image_link = get_post_meta($value->get_id(), 'soundboutiques_add_slider_image', true); ?>
                                <div data-index="<?php echo $_index; ?>">
            					    <a href="<?php echo get_permalink($value->get_id()); ?>">
                                        <img src="<?php echo $slider_image_link; ?>"  alt="<?php echo $value->get_name(); ?>" data-id="<?php echo $value->get_id(); ?>">
                                    </a>
            				    </div>
                            <?php $_index++;
                            endforeach;
                        } else {
                            echo "<p style='margin-left: 14px;'>No product found. Please set product IDs in the Custom Settings page.</p>";
                        } ?>
            			</div>
                        <!-- END -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-main-content text-white">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-9">
                    <div class="inner-wrapper py-5 px-4">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="title-wrapper d-flex align-items-center justify-content-between">
                                    <h2>Newest uploads</h2>
                                    <div class="title-buttons d-flex flex-row">
                                        <div class="owl-navs-newest mr-3"></div>
                                        <a href="<?php echo get_site_url(); ?>/shop"/>
                                            <button type="button" class="view-all" role="presentation">View All</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-carousel owl-carousel-newest owl-theme">
                                    <div class="row item">
                                        <?php
                                            $args = array(
                                                'post_type'               => 'product',
                                                'post_status'             => 'publish',
                                                'orderby'                 => 'date',
                                                'order'                   => 'DESC',
                                                'posts_per_page'          => 16
                                            );
                                            $loop = new WP_Query($args);
                                            if ($loop->have_posts()) {
                                                $index = 0;

                                                while ($loop->have_posts()) : $loop->the_post();

                                                if ($index == 8) {
                                                    echo '</div><div class="row item">';
                                                }
                                                wc_get_template_part('woocommerce/content', 'product-frontpage');
                                                $index++;

                                                endwhile;
                                                wp_reset_postdata();
                                            } else {
                                                ?>
                                                <div class="col-12 mb-4">
                                                    <?php echo __('No products found'); ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="title-wrapper d-flex align-items-center justify-content-between">
                                    <h2>Featured Sounds</h2>
                                    <div class="title-buttons d-flex flex-row">
                                        <div class="owl-navs-featured mr-3"></div>
                                        <a href="<?php echo get_site_url(); ?>/featured-products"/>
                                            <button type="button" class="view-all" role="presentation">View All</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-carousel owl-carousel-featured owl-theme">
                                    <div class="row item">
                                        <?php
                                            $tax_query[] = array(
                                                'taxonomy' => 'product_visibility',
                                                'field'    => 'name',
                                                'terms'    => 'featured',
                                                'operator' => 'IN',
                                            );
                                            $args = array(
                                                'post_type'               => 'product',
                                                'post_status'             => 'publish',
                                                'ignore_sticky_posts'     => 1,
                                                'posts_per_page'          => 16,
                                                'tax_query'               => $tax_query
                                            );
                                            $loop = new WP_Query($args);
                                            if ($loop->have_posts()) {
                                                $index = 0;

                                                while ($loop->have_posts()) : $loop->the_post();

                                                if ($index == 8) {
                                                    echo '</div><div class="row item">';
                                                }
                                                wc_get_template_part('woocommerce/content', 'product-frontpage');
                                                $index++;

                                                endwhile;
                                                wp_reset_postdata();
                                            } else {
                                                ?>
                                                <div class="col-12 mb-4">
                                                    <?php echo __('No products found'); ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="title-wrapper d-flex align-items-center justify-content-between">
                                    <h2>Hot deals</h2>
                                    <div class="title-buttons d-flex flex-row">
                                        <div class="owl-navs-hot-deals mr-3"></div>
                                        <a href="<?php echo get_category_link(41); ?>"/>
                                            <button type="button" class="view-all" role="presentation">View All</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-carousel owl-carousel-hot-deals owl-theme">
                                    <div class="row item">
                                        <?php
                                        $args = array(
                                            'post_type' => 'rmcc_blurb',
                                            'posts_per_page' => 1
                                        );
                                            $args = array(
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                                    array(
                                                                        'taxonomy' => 'product_cat',
                                                                        'field'    => 'slug',
                                                                        'terms'    => 'hot-deals',
                                                                        'operator'      => 'IN'
                                                                    ),
                                                                ),
                                                'posts_per_page' => 16,
                                            );
                                            $loop_by_cat = new WP_Query($args);
                                            if ($loop_by_cat->have_posts()) {
                                                $index = 0;
                                                while ($loop_by_cat->have_posts()) : $loop_by_cat->the_post();

                                                if ($index == 8) {
                                                    echo '</div><div class="row item">';
                                                }
                                                wc_get_template_part('woocommerce/content', 'product-frontpage');
                                                $index++;

                                                endwhile;
                                                wp_reset_postdata();
                                            } else {
                                                ?>
                                                <div class="col-12 mb-4">
                                                    <?php echo __('No products found'); ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="title-wrapper d-flex align-items-center justify-content-between">
                                    <h2>Best sellers</h2>
                                    <div class="title-buttons d-flex flex-row">
                                        <div class="owl-navs-best-sellers mr-3"></div>
                                        <a href="<?php echo get_site_url(); ?>/shop"/>
                                            <button type="button" class="view-all" role="presentation">View All</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-carousel owl-carousel-best-sellers owl-theme">
                                    <div class="row item">
                                        <?php
                                            $args = array(
                                                'post_type' => 'product',
                                                'meta_key' => 'total_sales',
                                                'orderby' => 'meta_value_num',
                                                'posts_per_page' => 16,
                                                'order' => 'DESC',
                                                'meta_query' => array(
                                                    array(
                                                        'key' => 'total_sales',
                                                        'value' => 0,
                                                        'compare' => '>'
                                                    )
                                                )
                                            );
                                            $loop_by_cat = new WP_Query($args);
                                            if ($loop_by_cat->have_posts()) {
                                                $index = 0;
                                                while ($loop_by_cat->have_posts()) : $loop_by_cat->the_post();

                                                if ($index == 8) {
                                                    echo '</div><div class="row item">';
                                                }
                                                wc_get_template_part('woocommerce/content', 'product-frontpage');
                                                $index++;

                                                endwhile;
                                                wp_reset_postdata();
                                            } else {
                                                ?>
                                                <div class="col-12 mb-4">
                                                    <?php echo __('No products found'); ?>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php get_sidebar('shop'); ?>
            </div>
        </div>
    </section>

    <?php
        get_footer();

        ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script type="text/javascript" src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>
        <script type="text/javascript">
        $('.slider').slick({
autoplay: true,
speed: 800,
arrows: true,
dots: false,
prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
}).slickAnimation();



$('.slick-nav').on('click touch', function(e) {

e.preventDefault();

var arrow = $(this);

if(!arrow.hasClass('animate')) {
    arrow.addClass('animate');
    setTimeout(() => {
        arrow.removeClass('animate');
    }, 1600);
}

});
        </script>
