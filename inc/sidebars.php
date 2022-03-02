<?php
add_action( 'widgets_init', 'soundboutiques_widgets_init' );
function soundboutiques_widgets_init() {
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'Primary dynamic sidebar' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    // register_sidebar(
    //     array(
    //         'id'            => 'top-selling',
    //         'name'          => __( 'Top Selling Sidebar' ),
    //         'description'   => __( 'Top selling products.' ),
    //         'before_widget' => '<div id="%1$s" class="widget %2$s">',
    //         'after_widget'  => '</div>',
    //         'before_title'  => '<h3 class="widget-title">',
    //         'after_title'   => '</h3>',
    //     )
    // );
    //
    // register_sidebar(
    //     array(
    //         'id'            => 'shop',
    //         'name'          => __( 'Shop' ),
    //         'description'   => __( 'Shop sidebar' ),
    //         'before_widget' => '<div id="%1$s" class="widget %2$s">',
    //         'after_widget'  => '</div>',
    //         'before_title'  => '<h3 class="widget-title">',
    //         'after_title'   => '</h3>',
    //     )
    // );
}
?>
