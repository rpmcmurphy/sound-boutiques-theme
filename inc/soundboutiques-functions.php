<?php

if ( ! function_exists( 'soundboutiques_is_woocommerce_activated' ) ) {
   /**
    * Query WooCommerce activation
    */
   function soundboutiques_is_woocommerce_activated() {
       return class_exists( 'WooCommerce' ) ? true : false;
   }
}

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function soundboutiques_do_shortcode( $tag, array $atts = array(), $content = null ) {
   global $shortcode_tags;

   if ( ! isset( $shortcode_tags[ $tag ] ) ) {
       return false;
   }

   return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

/**
 * Get the category info inside the product loop or single page.
 *
 * @return array The product category info in an array with keys.
 */
function soundboutiques_get_product_catinfo() {
    global $product;
    $terms = get_the_terms( $product->get_id(), 'product_cat' );
    foreach ($terms  as $term  ) {
        $product_cat_id = $term->term_id;
        $term_link = get_term_link( $term );
        $product_cat_name = $term->name;
        break;
    }
    return ["product_cat_id" => $product_cat_id, "product_cat_link" => $term_link, "product_cat_name" => $product_cat_name];
}

/**
 * Get the product label and return the formatted html
 *
 * @return string The html formatted product label info
 */
function soundboutiques_get_product_label_name($attribute_name) {
    global $post;

	$taxonomy = get_taxonomy( $attribute_name );
	if ( $taxonomy && ! is_wp_error( $taxonomy ) ) {
		$terms = wp_get_post_terms( $post->ID, $attribute_name );
		$terms_array = array();

        if ( ! empty( $terms ) ) {
	        foreach ( $terms as $term ) {
		       $archive_link = get_term_link( $term->slug, $attribute_name );

               if($taxonomy->publicly_queryable == true) {
                   $full_line = '<a href="' . $archive_link . '">'. $term->name . '</a>';
               } else {
                   $full_line = $term->name;
               }
		       array_push( $terms_array, $full_line );
	        }
	        echo implode( '', $terms_array );
        }
	}
}

/* Check if WooCommerce is active */
function soundboutiques_wc_active() {
	return class_exists( 'woocommerce' );
}

/*Check if it's a WooCommerce page*/
function soundboutiques_is_woocommerce() {
	if (!soundboutiques_wc_active()) {
		return false;
	}

	$woocommerce = false;

	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		$woocommerce = true;
	}

	return $woocommerce;

}
