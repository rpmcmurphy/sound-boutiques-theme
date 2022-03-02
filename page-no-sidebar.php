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

get_header(); ?>

<section class="site-main-content text-white">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="inner-wrapper no-sidebar p-5">
                    <div class="row mb-5">
                        <div class="col-12">

							<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', 'page' );

							endwhile;
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


		<!-- </main>
	</div> -->

<?php
// do_action( 'storefront_sidebar' );
get_footer();
