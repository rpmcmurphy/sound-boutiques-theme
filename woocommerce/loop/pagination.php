<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="row">
	<div class="col-12">
		<nav class="woocommerce-pagination" aria-label="pagination">
			<?php
				global $wp_query;
				$big = 999999999;
				$pages = paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'type'  => 'array',
						'prev_next'   => true,
						'prev_text'    => '&larr;',
						'next_text'    => '&rarr;',
					)
				);

				if( is_array( $pages ) ) {
					$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
					$pagination = '<ul class="pagination pagination-circular justify-content-center">';
					foreach ( $pages as $page ) {
						$page = str_replace("page-numbers","page-numbers page-link", $page);
						$pagination .= "<li class='page-item'>$page</li>";
					}
					$pagination .= '</ul>';
					echo $pagination;
				}
			?>
		</nav>
	</div>
</div>
