<?php
/**
 * The template for displaying product content with best selling number in the sidebar
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
?>

<?php
$args = array(
    'post_type' => 'product',
    'stock' => 1,
    'orderby' => 'date',
	'order' => 'DESC',
    'posts_per_page' => 10,
);
$loop = new WP_Query($args);
?>
<div class="col-md-3">
    <div class="sidebar-wrapper py-5 px-4">
        <div class="title-wrapper d-flex align-items-center justify-content-between mb-5">
            <h2>Top selling</h2>
        </div>
        <div class="row">
			<?php
				while ($loop->have_posts()) : $loop->the_post();
				global $product;
				$product_cat_info = soundboutiques_get_product_catinfo();
                $file_link = get_post_meta($product->get_id(), 'wp_custom_attachment', true);
			?>

			<div class="col-12 mb-3">
				<div class="media audio-list-item-sidebar post-<?php echo $product->get_id(); ?>">
					<div class="audio-item-img">
						<?php
							if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
		
								$regular_price  = get_post_meta( $product->get_id(), '_regular_price', true ); 
								$sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
							
								if( !empty($sale_price) ) {
						
									$amount_saved = $regular_price - $sale_price;
									$currency_symbol = get_woocommerce_currency_symbol();
									$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
									?>
									<span class="save-percentage">Save:<br /> <?php echo number_format($percentage,0, '', '').'%'; ?></span>                
									<?php        
								}
							}
							?>
						<?php echo "<a href='". get_the_permalink() ."'>"; ?>

						<?php if (has_post_thumbnail($loop->post->ID)) {
							echo get_the_post_thumbnail($loop->post->ID, 'thumbnail');
						} else {
							echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />';
						} ?>

						<?php echo "</a>"; ?>
					</div>
					<div class="media-body audio-card-details">
						<div class="audio-track">
							<a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
								<h3 class="track-title"><?php the_title(); ?></h3>
							</a>
							<a href="<?php echo $product_cat_info['product_cat_link']; ?>">
								<span class="track-category"><?php echo $product_cat_info['product_cat_name']; ?></span>
							</a>
						</div>
						<div class="audio-card-overlay d-flex">
							<div class="overlay-icons d-flex">
								<a href="<?php the_permalink(); ?>"><span class="ti-eye h-100"></span></a>
                                <a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo $product->get_sku(); ?>" aria-label="Add '<?php echo $product->get_name(); ?>' to your cart" rel="nofollow" class="product_type_simple add_to_cart_button ajax_add_to_cart"><span class="ti-shopping-cart h-100"></a>
							</div>
							<span class="overlay-pricetag"><?php echo wc_price($product->get_price()); ?></span>
						</div>
					</div>
				</div>
			</div>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

            <?php
                // Get a dynamic sidebar to show default widgets
                // dynamic_sidebar( 'primary' );
                get_sidebar('shop');
            ?>
        </div>

		<hr class="mt-4">

		<div class="title-wrapper d-flex align-items-center justify-content-between mb-5  mt-5">
			<h2>Newest uploads</h2>
		</div>
		<div class="row">
			<?php
				while ($loop->have_posts()) : $loop->the_post();
				global $product;
				$product_cat_info = soundboutiques_get_product_catinfo();
				$file_link = get_post_meta($product->get_id(), 'wp_custom_attachment', true);
			?>

			<div class="col-12 mb-3">
				<div class="media audio-list-item-sidebar post-<?php echo $product->get_id(); ?>">
					<div class="audio-item-img">
							<?php
							if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
		
								$regular_price  = get_post_meta( $product->get_id(), '_regular_price', true ); 
								$sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
							
								if( !empty($sale_price) ) {
						
									$amount_saved = $regular_price - $sale_price;
									$currency_symbol = get_woocommerce_currency_symbol();
									$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
									?>
									<span class="save-percentage">Save:<br /> <?php echo number_format($percentage,0, '', '').'%'; ?></span>                
									<?php        
								}
							}
							?>
						<?php echo "<a href='". get_the_permalink() ."'>"; ?>

						<?php if (has_post_thumbnail($loop->post->ID)) {
							echo get_the_post_thumbnail($loop->post->ID, 'thumbnail');
						} else {
							echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />';
						} ?>

						<?php echo "</a>"; ?>
					</div>
					<div class="media-body audio-card-details">
						<div class="audio-track">
							<a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
								<h3 class="track-title"><?php the_title(); ?></h3>
							</a>
							<a href="<?php echo $product_cat_info['product_cat_link']; ?>">
								<span class="track-category"><?php echo $product_cat_info['product_cat_name']; ?></span>
							</a>
						</div>
						<div class="audio-card-overlay d-flex">
							<div class="overlay-icons d-flex">
								<a href="<?php the_permalink(); ?>"><span class="ti-eye h-100"></span></a>
								<a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>" data-product_sku="<?php echo $product->get_sku(); ?>" aria-label="Add '<?php echo $product->get_name(); ?>' to your cart" rel="nofollow" class="product_type_simple add_to_cart_button ajax_add_to_cart"><span class="ti-shopping-cart h-100"></a>
							</div>
							<span class="overlay-pricetag"><?php echo wc_price($product->get_price()); ?></span>
						</div>
					</div>
				</div>
			</div>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>

			<?php
				// Get a dynamic sidebar to show default widgets
				// dynamic_sidebar( 'primary' );
				get_sidebar('shop');
			?>
		</div>
    </div>
</div>
