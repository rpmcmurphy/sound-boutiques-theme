<?php

/**
 * The template for displaying the footer.
 *
 * Contains the social icons, site-footer, copyright
 *
 * @package soundboutiques
 */

?>
<section class="get-social text-white">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-3">
                <a href="#">
                    <span class="ti-facebook"></span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#">
                    <span class="ti-youtube"></span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#">
                    <span class="ti-soundcloud"></span>
                </a>
            </div>
            <div class="col-md-3">
                <a href="#">
                    <span class="ti-instagram"></span>
                </a>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h6 class="footer-title">About us</h6>
                <ul class="footer-list about">
                    <li class="list-group-item">
                        <a href="#" class="footer-logo">
                            <img class="" src="<?php echo get_template_directory_uri(); ?>/assets/images/soundboutiques-logo.png" alt="Sound Boutiques logo">
                        </a>
                    </li>
                    <li class="list-group-item">
                        <p>
                            <?php echo get_option('footer_about_us_text'); ?>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="footer-title">Menus</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'foot_one',
                    'container' => false,
                    'menu_class' => 'footer-list menus',
                    'add_li_class'  => 'list-group-item'
                    // 'walker' => new Picklikeapro_Walker_Nav_Primary()
                ));
                ?>
            </div>
            <div class="col-md-3">
                <h6 class="footer-title">Others</h6>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'foot_two',
                    'container' => false,
                    'menu_class' => 'footer-list menus',
                    'add_li_class'  => 'list-group-item'
                    // 'walker' => new Picklikeapro_Walker_Nav_Primary()
                ));
                ?>
            </div>
            <div class="col-md-3">
                <h6 class="footer-title">Payment options</h6>
                <ul class="footer-list payment">
                    <li class="list-group-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/payment-logos.png" alt="">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="copyright">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-12 text-center">
                <p>Copyright © 2020 Soundboutiques. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>

<div class="notification">
    <p class="message"></p>
</div>

<section class="track-player">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="player-wrapper d-flex align-items-center">
                    <div class="track-cover">
                        <img class="track-cover-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/cards/sqr/cartoon-sqr-1.png" alt="Track cover image">
                        <div href="<?php echo get_template_directory_uri(); ?>/#" class="audio-triangle">
                            <span class="ti-control-play"></span>
                        </div>
                    </div>
                    <div class="track-info ml-3 mr-3">
                        <a href="#">
                            <h3 class="track-title">Future house genie</h3>
                        </a>
                        <a href="#">
                            <span class="track-category">Sound</span>
                        </a>
                    </div>
                    <div class="track-controls">
                        <!-- <span class="ti-control-play"></span> -->
                    </div>
                    <div id="waveform" class="track-waveform d-none d-sm-block">
                        <div class="loader-wrapper">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <div class="action-buttons ml-auto">
                        <a class="cart-button" href="#">
                            <span class="price">---</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php wp_footer(); ?>
</body>

</html>