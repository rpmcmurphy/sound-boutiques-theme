<?php

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;
?>

<div class="row woocommerce-myaccount">
    <div class="col-md-3">
        <div class="myacount-sidebar-wrapper">
            <?php if (is_user_logged_in()) : ?>
                <div class="account-sidebar-head">
                    <?php $user = wp_get_current_user();
                    if ($user) : ?>
                        <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" class="avatar avatar-lg" />
                    <?php endif; ?>
                    <p class="mt-2">
                        <?php $user = wp_get_current_user();
                        echo "Hello <strong>" . $user->display_name . "</strong>"; ?>
                    </p>
                </div>
            <?php endif; ?>
            <?php /**
             * My Account navigation.
             *
             * @since 2.6.0
             */
            do_action('woocommerce_account_navigation'); ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="my-account-content-wrapper">
            <div class="woocommerce-MyAccount-content">
                <?php
                /**
                 * My Account content.
                 *
                 * @since 2.6.0
                 */
                do_action('woocommerce_account_content');
                ?>
            </div>
        </div>
    </div>
</div>