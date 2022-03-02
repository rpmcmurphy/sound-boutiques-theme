<?php
    // Paths
    define( 'SOUNDBOUTIQUES_ASSET_CSS', SOUNDBOUTIQUES_THEME_URI . '/assets/css' );
    define( 'SOUNDBOUTIQUES_ASSET_JS', SOUNDBOUTIQUES_THEME_URI . '/assets/js' );
    define( 'SOUNDBOUTIQUES_ASSET_ICONS', SOUNDBOUTIQUES_THEME_URI . '/assets/icons' );


    // Main Styles
    function soundboutiques_enqueue_styles() {

        //Vendor css
        wp_enqueue_style( 'soundboutiques-icons-css', SOUNDBOUTIQUES_ASSET_ICONS . '/themify-icons/themify-icons.css', array(), SOUNDBOUTIQUES_THEME_VERSION, 'all' );
        wp_enqueue_style( 'soundboutiques-bs-css', SOUNDBOUTIQUES_ASSET_CSS . '/vendor/bootstrap.min.css', array(), SOUNDBOUTIQUES_THEME_VERSION, 'all' );
        wp_enqueue_style( 'soundboutiques-owl-css', SOUNDBOUTIQUES_ASSET_JS . '/vendor/assets/owl.carousel.min.css', array(), SOUNDBOUTIQUES_THEME_VERSION, 'all' );
        wp_enqueue_style( 'soundboutiques-owl-theme-css', SOUNDBOUTIQUES_ASSET_JS . '/vendor/assets/owl.theme.default.min.css', array('soundboutiques-owl-css'), SOUNDBOUTIQUES_THEME_VERSION, 'all' );
        wp_enqueue_style( 'soundboutiques-slick-css', SOUNDBOUTIQUES_ASSET_CSS . '/vendor/slick.css', array(), SOUNDBOUTIQUES_THEME_VERSION, 'all' );

        // Main theme css
        wp_enqueue_style( 'soundboutiques-main-css', SOUNDBOUTIQUES_ASSET_CSS . '/main.min.css', array('woocommerce-general', 'woocommerce-smallscreen', 'woocommerce-layout'), SOUNDBOUTIQUES_THEME_VERSION, 'all' );

    }

    add_action('wp_enqueue_scripts', 'soundboutiques_enqueue_styles', 30);

    function soundboutiques_enqueue_scripts() {
		if (!is_admin()) {

            // Vendor js
            wp_deregister_script('jquery');
            wp_enqueue_script( 'jquery',  SOUNDBOUTIQUES_ASSET_JS . '/vendor/jquery.min.js', array(), '3.4.1', TRUE);
			wp_enqueue_script( 'soundboutiques-bs-js',  SOUNDBOUTIQUES_ASSET_JS . '/vendor/bootstrap.bundle.min.js', array( 'jquery' ), '4.0.0', TRUE);
			wp_enqueue_script( 'soundboutiques-wavesurfer',  SOUNDBOUTIQUES_ASSET_JS . '/vendor/wavesurfer.js', array( 'jquery' ), '4.2.0', TRUE);
			wp_enqueue_script( 'soundboutiques-owl-js',  SOUNDBOUTIQUES_ASSET_JS . '/vendor/owl.carousel.min.js', array( 'jquery' ), '2.3.4', TRUE);
			wp_enqueue_script( 'soundboutiques-slick-js',  SOUNDBOUTIQUES_ASSET_JS . '/vendor/slick.min.js', array( 'jquery' ), '1.4.1', TRUE);

			// Main custom js
			wp_enqueue_script('soundboutiques-main-js', SOUNDBOUTIQUES_ASSET_JS . '/main.js', array('jquery'), SOUNDBOUTIQUES_THEME_VERSION, TRUE);

			// Theme variables
			wp_localize_script( 'goya-app', 'theme_vars', array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'test' => array (
					'test_icons' => 'test-string'
				)
			) );
		}
	}
	add_action('wp_enqueue_scripts', 'soundboutiques_enqueue_scripts', 30);
?>
