<?php
/**
* Template Name: Page Templates
*
* @package sound-boutiques
*/

get_header();
?>
    <section class="track-promo-video">
        <div class="container-fluid px-0">
            <div class="row no-gutters">

                <div class="col-md-7">
                    <section class="video-demo" onclick="stopVideo()" style="background-image: url('<?php echo get_option('templates_page_video_background_image_url'); ?>');">
                        <div class="container-fluid h-100">
                            <div class="row h-100">
                                <div class="col-12 h-100 align-items-center justify-content-center d-flex">
                                    <div class="video-btn-wrapper">
                                        <span class="video-button launch-modal" id="open-vid" data-toggle="modal" data-target="#modal-video"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL -->
                            <div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="modal-video-label" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-video">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe src="https://www.youtube.com/embed/<?php echo get_option('templates_page_video_url'); ?>?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" controls="1" width="560" height="315" frameborder="0"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-5">
                    <div class="promo-video-text h-100 p-3 d-flex flex-column align-items-center justify-content-center">
                        <h6 class="video-text-title text-white"><?php echo get_option('templates_page_banner_title'); ?></h6>
                        <p class="video-text-subtitle"><?php echo get_option('templates_page_banner_subtitle'); ?></p>
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
                                    <h2>Templates</h2>
                                    <div class="title-buttons d-flex flex-row">
                                        <div class="owl-navs-templates mr-3"></div>
                                        <a href="<?php echo get_category_link(44); ?>"/>
                                            <button type="button" class="view-all" role="presentation">View All</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-carousel owl-carousel-templates owl-theme">
                                    <div class="row item">
                                        <?php
                                            $args = array(
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                                    array(
                                                                        'taxonomy' => 'product_cat',
                                                                        'field'    => 'slug',
                                                                        'terms'    => 'templates',
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
                    </div>
                </div>
                <?php get_sidebar('shop'); ?>
            </div>
        </div>
    </section>

    <?php
        get_footer();
