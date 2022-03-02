<?php
    /**
     * The main template file.
     *
     * This is the most generic template file in a WordPress theme
     * and one of the two required files for a theme (the other being style.css).
     * It is used to display a page when nothing more specific matches a query.
     * E.g., it puts together the home page when no home.php file exists.
     * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package soundboutiques
     */

     $blog_sidebar = true;

     if ( $blog_sidebar == true ) {
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
                                if ( have_posts() ) :
                                    while ( have_posts() ) :
                                    	the_post();
                                    	get_template_part( 'template-parts/content', get_post_format() );
                                    ?>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <div class="post-link-nav">
                                                    <?php the_posts_pagination( array(
                                                        'prev_text' => 'Previous',
                                                        'next_text' => 'Next',
                                                    ) ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                else :
                                    get_template_part( 'template-parts/content', 'none' );
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
