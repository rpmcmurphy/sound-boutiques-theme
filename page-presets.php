<?php
/**
* Template Name: Page Presets
*
* @package sound-boutiques
*/

get_header();
?>

    <section class="site-banner-presets">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="slider-wrapper">
                        <!-- MAIN SLIDES -->
                        <?php
                            $presets_taxonomy_id = get_term_by('name', 'Presets', 'product_cat');
                            $presets_subcategories = get_terms(array(
                                'taxonomy' => 'product_cat',
                                'child_of' => $presets_taxonomy_id->term_id,
                                'hide_empty' => false
                            ));
                        ?>
                        <div class="slider-slick-image">
                            <?php $_index = 1; ?>
                            <?php
                                if (! empty($presets_subcategories)) :
                                    foreach ($presets_subcategories as $presets_subcategory) : ?>
                                        <?php if ($presets_subcategory->parent == $presets_taxonomy_id->term_id) :
                                            $thumbnail_id = get_term_meta($presets_subcategory->term_id, 'thumbnail_id', true);
                                            // get the image URL for parent category
                                            $image = wp_get_attachment_url($thumbnail_id); ?>
                                            <div data-index="<?php echo $_index; ?>">
                                                <div href="" style="position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 480px; background-image: url('<?php echo $image; ?>'); background-size: cover; background-position: center center;">
                                                        <h4 style="font-size: 48px;text-transform: uppercase;color: #fff;font-weight: 700;text-shadow: 1px 1px 7px #1f202070;"><?php echo $presets_subcategory->name; ?></h4>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php $_index++;
                                    endforeach;
                                else :
                                    echo "<p style='margin-left: 14px;'>No presets subcategory found. Please add some subcategories under presets.</p>";
                                endif;
                            ?>
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
                                    <h2>Presets</h2>
                                    <div class="title-buttons d-flex flex-row">
                                        <div class="owl-navs-presets mr-3"></div>
                                        <a href="<?php echo get_category_link(47); ?>"/>
                                            <button type="button" class="view-all" role="presentation">View All</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="owl-carousel owl-carousel-presets owl-theme">
                                    <div class="row item">
                                        <?php
                                            $args = array(
                                                'post_type' => 'product',
                                                'tax_query' => array(
                                                                    array(
                                                                        'taxonomy' => 'product_cat',
                                                                        'field'    => 'slug',
                                                                        'terms'    => 'presets',
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
