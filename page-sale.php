<?php
/**
* Template Name: Page Sale
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
    <section class="site-banner-sale py-4">
        <div class="container">
            <div class="row no-gutters">
                <?php
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 1,
                    'meta_query'     => array(
                        'relation' => 'OR',
                        array( // Simple products type
                            'key'           => '_sale_price',
                            'value'         => 0,
                            'compare'       => '>',
                            'type'          => 'numeric'
                        ),
                        array( // Variable products type
                            'key'           => '_min_variation_sale_price',
                            'value'         => 0,
                            'compare'       => '>',
                            'type'          => 'numeric'
                        )
                    )
                );
                $loop_sale = new WP_Query( $args );

                if ( $loop_sale->have_posts() ) {
                    $index = 0;
                    while ( $loop_sale->have_posts() ) : $loop_sale->the_post();
                    $product_cat_info = soundboutiques_get_product_catinfo();

                    ?>

                    <div class="col-md-4">
                        <div class="the-thumbnail h-100" style="background-image: url('<?php echo soundboutiques_woocommerce_get_product_thumbnail('large', 'link'); ?>')">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="banner-text-wrapper d-flex flex-column align-items-center justify-content-center h-100">
                            <h2 class="deal-text">Deal of the day</h2>
                            <a class="track-link" href="<?php echo get_the_permalink(); ?>">
                                <h1 class="track-title"><?php the_title(); ?></h1>
                            </a>
                            <h6 class="track-subtitle">
                                <a href="<?php echo $product_cat_info['product_cat_link']; ?>">
                                    <?php echo $product_cat_info['product_cat_name']; ?>
                                </a>
                            </h6>
                            <div class="track-button">
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <button class="custom-button">Buy now</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php break; endwhile;
                    wp_reset_postdata();
                }
                ?>
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
                                    <h2>On Sale</h2>
                                </div>
                                <div class="row no-banner-content">
                                    <?php
                                        $args = array(
                                            'post_type'      => 'product',
                                            'posts_per_page' => 16,
                                            'offset' => 1,
                                            'meta_query'     => array(
                                                'relation' => 'OR',
                                                array( // Simple products type
                                                    'key'           => '_sale_price',
                                                    'value'         => 0,
                                                    'compare'       => '>',
                                                    'type'          => 'numeric'
                                                ),
                                                array( // Variable products type
                                                    'key'           => '_min_variation_sale_price',
                                                    'value'         => 0,
                                                    'compare'       => '>',
                                                    'type'          => 'numeric'
                                                )
                                            )
                                        );
                                        $loop = new WP_Query( $args );
                                        if ( $loop->have_posts() ) {
                                            while ( $loop->have_posts() ) : $loop->the_post();

                                                wc_get_template_part( 'woocommerce/content', 'product' );

                                            endwhile;
                                            wp_reset_postdata();
                                        } else {
                                            echo "<div class='col-12'>No products found.</div>";
                                        }
                                    ?>
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
