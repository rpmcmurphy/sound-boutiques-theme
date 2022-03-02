<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package soundboutiques
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <title>SoundBoutiques</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0 shrink-to-fit=no">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">

    <?php wp_head(); ?>
</head>
<?php
if (is_front_page()) {
    $class_woocommerce = 'woocommerce';
}
?>

<body <?php body_class('woocommerce'); ?>>

    <div class="site-topbar">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <!-- Contact? -->
                </div>
                <div class="col-md-8">
                    <ul class="nav-topbar-right d-flex">
                        <?php if (is_user_logged_in()) { ?>
                            <li class="nav-item">
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'soundboutiques'); ?>" class="nav-link"><?php _e('My Account', 'soundboutiques'); ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Register', 'soundboutiques'); ?>" class="nav-link"><?php _e('Register', 'soundboutiques'); ?></a>
                            </li>
                            <li class="nav-item login-nav">
                                <a href="#" title="<?php _e('Login', 'soundboutiques'); ?>" class="nav-link login-nav-link"><?php _e('Login', 'soundboutiques'); ?></a>
                                <div class="login-form-wrapper d-none">
                                    <h2 class="inner-title"><?php esc_html_e('Login', 'woocommerce'); ?></h2>

                                    <form class="woocommerce-form woocommerce-form-login login" method="post">

                                        <?php do_action('woocommerce_login_form_start'); ?>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                                                                        ?>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                            <input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" autocomplete="current-password" />
                                        </p>

                                        <?php do_action('woocommerce_login_form'); ?>

                                        <p class="form-row">
                                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme pl-0 d-flex align-items-center">
                                                <input class="woocommerce-form__input woocommerce-form__input-checkbox custom-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span class="ml-2"><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                                            </label>
                                        </p>

                                        <p class="form-row">
                                            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit custom-button d-block w-100" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
                                        </p>
                                        <p class="woocommerce-LostPassword lost_password mt-3 text-center">
                                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">
                                                <?php esc_html_e('Forgot password?', 'woocommerce'); ?>
                                            </a>
                                        </p>

                                        <?php do_action('woocommerce_login_form_end'); ?>
                                    </form>
                                </div>
                            </li>
                        <?php } ?>
                        <?php if (is_user_logged_in()) : ?>
                            <li class="nav-item">
                                <a href="<?php echo wp_logout_url(home_url()); ?>" class="nav-link">Logout</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item d-lg-none">
                            <a href="<?php echo wc_get_cart_url(); ?>" title="Cart">
                                <span class="ti-shopping-cart"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link topbar-cart cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View shopping cart'); ?>">
                                <span class="ti-shopping-cart"></span>
                                <span class="amount">
                                    <?php echo sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count()); ?> - <?php echo WC()->cart->get_cart_total(); ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <header class="site-header">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-12">
                    <nav class="navbar-top navbar navbar-expand-lg">

                        <!-- Icons -->
                        <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                            <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/images/soundboutiques-logo.png" alt="Sound Boutiques logo">
                        </a>

                        <!-- Mobile button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navToggler" aria-controls="navToggler" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                        </button>

                        <div class="nav-wrapper collapse navbar-collapse" id="navToggler">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'nav-top-left navbar-nav',
                                // 'walker' => new Picklikeapro_Walker_Nav_Primary()
                            ));
                            ?>
                        </div>

                        <!-- Other buttons -->
                        <ul class="nav-menubar-search nav-top-right navbar-nav ml-auto text-center">
                            <li class="nav-item d-flex align-items-center">
                                <form role="search" method="get" class="searchform" action="<?php echo home_url('/shop'); ?>">
                                    <input type="search" class="top-search" placeholder="<?php echo esc_attr_x('Search term...', 'woocommerce') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
                                    <button class="top-search-submit" type="submit">
                                        <span class="ti-search"></span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                        <ul class="menubar-cart nav-top-right navbar-nav ml-auto text-center d-none d-lg-flex">
                            <li class="nav-item">
                                <a href="<?php echo wc_get_cart_url(); ?>" title="Cart">
                                    <span class="ti-shopping-cart"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo wc_get_checkout_url(); ?>" title="Checkout">
                                    <span class="ti-share"></span>
                                </a>
                            </li>
                        </ul>

                        <!-- The mega menu -->
                        <div class="sb-mega-menu">
                            <div class="sb-mega-menu-wrapper">
                                <div class="sb-mega-menu-item-wrapper d-flex" data-id="sounds">
                                    <div class="nav flex-column nav-pills sb-mega-menu-side">
                                        <a class="nav-link sb-mega-menu-side-iitem active" id="v-pills-sounds-by-cat-tab" data-toggle="pill" href="#v-pills-sounds-by-cat"><span class="ti-music-alt"></span> Categories</a>
                                        <a class="nav-link sb-mega-menu-side-iitem" id="v-pills-sounds-by-genre-tab" data-toggle="pill" href="#v-pills-sounds-by-genre"><span class="ti-pulse"></span> Genre</a>
                                    </div>
                                    <div class="tab-content sb-mega-menu-content">
                                        <div class="tab-pane fade show active" id="v-pills-sounds-by-cat">
                                            <div class="sb-mega-menu-content-item">
                                                <?php
                                                    $product_cat_list = get_terms('product_cat', array('hide_empty' => false));

                                                    foreach ($product_cat_list as $product_cat) {
                                                        $product_cat_link = get_term_link($product_cat->term_id, 'product_cat');
                                                        echo "<a href=\"{$product_cat_link}\" title=\"{$product_cat->name}\">{$product_cat->name}</a>";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-sounds-by-genre">
                                            <div class="sb-mega-menu-content-item">
                                                <?php
                                                $genre_list = get_terms('pa_genre', array('hide_empty' => false));

                                                foreach ($genre_list as $genre) {
                                                    $product_genre_link = get_term_link($genre->term_id, 'pa_genre');
                                                    echo "<a href=\"{$product_genre_link}\" title=\"{$genre->name}\">{$genre->name}</a>";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>