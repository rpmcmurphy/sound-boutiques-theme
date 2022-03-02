<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package soundboutiques
 */

get_header();

$blog_sidebar = false;

if ($blog_sidebar == true && is_active_sidebar('primary')) {
    $sidebar = true;
    $content = 'col-md-9';
    $classes[] = 'blog-sidebar-active';
} else {
    $sidebar = false;
    $content = 'col-md-12';
    $classes[] = 'blog-sidebar-disabled';
}

$class = (is_page('cart') || is_cart() || is_page('checkout') || is_checkout()) ? 'no-sidebar' : '';
?>

<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

        <?php if (soundboutiques_is_woocommerce()) { ?>

            <section class="site-main-content text-white">
                <div class="container-fluid px-0">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="inner-wrapper py-5 px-4">

                                <!-- If my accounts pages -->
                                <?php if (is_account_page()) : ?>
                                    <div class="accounts-page-header d-flex">
                                        <div class="header-content d-flex flex-column align-items-center justify-content-center">
                                            <div class="header-thumb mb-3">
                                                <?php $user = wp_get_current_user(); ?>
                                                <?php if ($user) : ?>
                                                    <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="User thumb" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="bottom-info">
                                                <p>SOUNDS . TEMPLATES . PRESETS</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif (is_checkout()) : ?>
                                    <div class="accounts-page-header d-flex">
                                        <div class="header-content d-flex flex-column align-items-center justify-content-center">
                                            <div class="header-thumb mb-3">
                                                <?php $user = wp_get_current_user(); ?>
                                                <?php if ($user) : ?>
                                                    <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="User thumb" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="bottom-info">
                                                <p>SOUNDS . TEMPLATES . PRESETS</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="title-wrapper d-flex align-items-center justify-content-between">
                                        <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-12">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php } else { ?>

            <section class="site-main-content text-white <?php echo esc_attr(implode(' ', $classes)); ?>">
                <div class="container-fluid px-0">
                    <div class="row no-gutters">
                        <div class="<?php echo $content; ?>">
                            <div class="inner-wrapper py-5 px-4">
                                <div class="row">
                                    <div class="<?php echo $content; ?>">
                                        <?php
                                        get_template_part('template-parts/content', 'page');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($blog_sidebar == true) {
                            get_sidebar();
                        }
                        ?>
                    </div>
                </div>
            </section>

        <?php } ?>
<?php endwhile;
endif; ?>

<?php

get_footer();
