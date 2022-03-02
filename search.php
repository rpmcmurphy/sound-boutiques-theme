<?php
	/*
		@package picklikeapro
	*/
?>
<?php get_header(); ?>

<section class="site-main-content text-white">
	<div class="container-fluid">
		<div class="row">
			<div class="col-9">
				<div class="inner-wrapper py-5">
					<div class="row">
						<div class="col-12">
							<?php

								if( have_posts() ):
									while( have_posts() ): the_post();
										get_template_part( 'template-parts/content', 'search' );
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
										echo "Nothing found. Change the term and try again please.";
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
