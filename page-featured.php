<?php
/**
* Template Name: Page Featured
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

    <section class="site-main-content text-white">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-9">
                    <div class="inner-wrapper py-5 px-4">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="title-wrapper d-flex align-items-center justify-content-between">
                                    <h2>Featured products</h2>
                                </div>
                                <div class="row no-banner-content">
                                    <?php
                                        $args = array(
                                            'posts_per_page' => 16,
                                            'post_type'      => 'product',
                                            'post_status'    => 'publish',
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy' => 'product_visibility',
                                                    'field'    => 'name',
                                                    'terms'    => 'featured',
                                                    'operator' => 'IN',
                                                    ),
                                                )
                                        );

                                        $loop_featured = new WP_Query( $args );
                                        if ( $loop_featured->have_posts() ) {
                                            while ( $loop_featured->have_posts() ) : $loop_featured->the_post();

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
