<?php
/**
 * The template for displaying all single posts.
 *
 * @package storefront
 */
 $blog_sidebar = false;

 if ( $blog_sidebar == true && is_active_sidebar( 'primary' ) ) {
    $sidebar = true;
    $content = 'col-md-9';
    $classes[] = 'blog-sidebar-active';
 } else {
    $sidebar = false;
    $content = 'col-md-12';
    $classes[] = 'blog-sidebar-disabled';
 }

get_header();
?>

<section class="site-main-content text-white <?php echo esc_attr(implode(' ', $classes)); ?>">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="<?php echo $content; ?>">
                <div class="inner-wrapper py-5 px-4">
                    <div class="row">
                        <div class="col-12">
                            <?php
                                if( have_posts() ):
                                    while( have_posts() ): the_post();
                                        get_template_part( 'template-parts/content', 'single' );
                                        echo soundboutiques_post_navigation();
                                        if ( comments_open() ):
                                            comments_template();
                                        endif;
                                    endwhile;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                if($blog_sidebar == true) {
                    get_sidebar();
                }
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
