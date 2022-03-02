<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<!-- <header class="woocommerce-products-header"> -->
	<?php // if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<!-- <h1 class="woocommerce-products-header__title page-title"><?php // woocommerce_page_title(); ?></h1> -->
	<?php // endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	// do_action( 'woocommerce_archive_description' );
	?>
<!-- </header> -->

<?php
if ( woocommerce_product_loop() ) {

	woocommerce_product_loop_start();

?>

<div class="col-md-9">
	<div class="inner-wrapper py-5 px-4">
		<div class="row mb-5">
			<div class="col-12">
				<div class="title-wrapper d-flex align-items-center justify-content-between">
				    <h2>All sounds</h2>
				</div>
				<div class="filter-bar">
				    <div class="row">
				        <div class="col-md-12">
							<?php
                                $args_product_cats = array( 'type' => 'product', 'taxonomy' => 'product_cat' );
                                $soundboutiques_categories = get_terms($args_product_cats);

								$args_product_genre = array( 'type' => 'product', 'taxonomy' => 'pa_genre' );
                                $soundboutiques_genre = get_terms($args_product_genre);
                            ?>

				            <form class="" method="get" id="product-archive-searchform" role="search" action="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
				                <div class="banner-search-wrapper">
									<div class="form-row no-gutters d-flex p-0">
										<div class="col-md-4 pl-0 pr-0 pr-md-2">
											<select name="soundboutiques-product-cat" class="custom-select category-select" id="select-product-cat">
				                                <option selected value="">Any categories</option>
				                                <?php foreach ($soundboutiques_categories as $soundboutiques_cats) { ?>
				                                <option value="<?php echo $soundboutiques_cats->slug; ?>"><?php echo $soundboutiques_cats->name; ?></option>
				                                <?php } ?>
				                            </select>
										</div>
										<div class="col-md-4 px-0 px-md-2">
											<select name="soundboutiques-product-attr-genre" class="custom-select genre-select" id="select-product-genre">
				                                <option selected value="">Any genre</option>
												<?php foreach ($soundboutiques_genre as $soundboutiques_genre) { ?>
				                                <option value="<?php echo $soundboutiques_genre->slug; ?>"><?php echo $soundboutiques_genre->name; ?></option>
				                                <?php } ?>
				                            </select>
										</div>
										<div class="col-md-4 px-0 pl-md-2 pr-md-0">
											<input type="hidden" name="search-from-product-archive" value="product-archive-searchform">
				                            <input type="hidden" value="" name="s">
				                            <input type="submit" id="product-archive-search-submit" value="Search" class="custom-button w-100 h-100"/>
										</div>
									</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
				<?php
					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>
				<div class="row mb-4">

				<?php
					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}
				?>

				</div><!-- /.row mb-5 -->
			</div><!-- /.col-12 -->
		</div><!-- /.row mb-5 -->
		<?php echo woocommerce_pagination(); ?>
	</div><!-- /.inner-wrapper py-5 px-4 -->
</div>

	<?php
	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */

	get_sidebar( 'shop' );
	// do_action( 'woocommerce_sidebar' );
	?>
	<?php

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else { ?>

	<div class="row no-gutters">
		<div class="col-md-9">
			<div class="inner-wrapper py-5 px-4">
				<div class="row mb-5">
					<div class="col-12">
						<?php
							/**
							 * Hook: woocommerce_no_products_found.
							 *
							 * @hooked wc_no_products_found - 10
							 */
							do_action( 'woocommerce_no_products_found' );
						?>
					</div>
					<div class="col-12 mb-4">
						<p class="woocommerce-info">You are welcome to check out the products below.</p>
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

		<?php
		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */

		get_sidebar( 'shop' );
		// do_action( 'woocommerce_sidebar' );
		?>

	</div>
<?php }

woocommerce_product_loop_end();

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
