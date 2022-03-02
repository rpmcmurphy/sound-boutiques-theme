<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package soundboutiques
 */

get_header(); ?>

<section class="site-main-content text-white">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-9">
                <div class="inner-wrapper py-5">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="title-wrapper d-flex align-items-center justify-content-between mb-5">
                                <h2><?php esc_html_e( 'Oops!', 'soundboutiques' ); ?></h2>
                            </div>
                        </div>
						<div class="col-12">
							<div class="not-found-mesage mb-4">
								<p><?php esc_html_e( 'Nothing was found at this location. Try searching, or check out the products below.', 'soundboutiques' ); ?></p>

								<?php
									if ( soundboutiques_is_woocommerce_activated() ) {
										the_widget( 'WC_Widget_Product_Search' );
									} else {
										get_search_form();
									}
								?>
							</div>
                            <?php
    							if ( soundboutiques_is_woocommerce_activated() ) {

    								soundboutiques_promoted_products();

    								soundboutiques_best_selling_products(array(
    					                'limit'   => 4,
    					                'columns' => 4,
    					                'orderby' => 'popularity',
    					                'order'   => 'desc',
    					                'title'   => esc_attr__( 'Best Sellers', 'soundboutiques' ),
    					            ));

    								$shortcode_content = soundboutiques_do_shortcode(
    									'best_selling_products',
    									array(
    										'per_page' => 4,
    										'columns'  => 4,
    									)
    								);
    								echo $shortcode_content;
    							}
							?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
