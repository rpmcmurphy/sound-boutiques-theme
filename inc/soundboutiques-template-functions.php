<?php

if ( ! function_exists( 'soundboutiques_promoted_products' ) ) {
   function soundboutiques_promoted_products( $per_page = '4', $columns = '4', $recent_fallback = true ) {
       if ( soundboutiques_is_woocommerce_activated() ) {

           if ( wc_get_featured_product_ids() ) {

               echo '<div class="title-wrapper d-flex align-items-center justify-content-between"><h2>' . esc_html__( 'Featured Products', 'soundboutiques' ) . '</h2></div>';

               echo soundboutiques_do_shortcode(
                   'featured_products',
                   array(
                       'per_page' => $per_page,
                       'columns'  => $columns,
                   )
               );
           } elseif ( wc_get_product_ids_on_sale() ) {

              echo '<div class="title-wrapper d-flex align-items-center justify-content-between"><h2>' . esc_html__( 'On sale now', 'soundboutiques' ) . '</h2></div>';

               echo soundboutiques_do_shortcode(
                   'sale_products',
                   array(
                       'per_page' => $per_page,
                       'columns'  => $columns,
                   )
               );
           } elseif ( $recent_fallback ) {

              echo '<div class="title-wrapper d-flex align-items-center justify-content-between"><h2>' . esc_html__( 'New in store', 'soundboutiques' ) . '</h2></div>';

               echo soundboutiques_do_shortcode(
                   'recent_products',
                   array(
                       'per_page' => $per_page,
                       'columns'  => $columns,
                   )
               );
           }
       }
   }
}

if ( ! function_exists( 'soundboutiques_best_selling_products' ) ) {
   function soundboutiques_best_selling_products( $args ) {
       $args = apply_filters(
           'soundboutiques_best_selling_products_args',
           array(
               'limit'   => 4,
               'columns' => 4,
               'orderby' => 'popularity',
               'order'   => 'desc',
               'title'   => '<div class="title-wrapper d-flex align-items-center justify-content-between"><h2>' . esc_html__( 'Best sellers', 'soundboutiques' ) . '</h2></div>',
           )
       );

       $shortcode_content = soundboutiques_do_shortcode(
           'products',
           apply_filters(
               'soundboutiques_best_selling_products_shortcode_args',
               array(
                   'per_page' => intval( $args['limit'] ),
                   'columns'  => intval( $args['columns'] ),
                   'orderby'  => esc_attr( $args['orderby'] ),
                   'order'    => esc_attr( $args['order'] ),
               )
           )
       );

       /**
        * Only display the section if the shortcode returns products
        */
       if ( false !== strpos( $shortcode_content, 'product' ) ) {

           echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';
           echo $shortcode_content;

       }
   }
}
