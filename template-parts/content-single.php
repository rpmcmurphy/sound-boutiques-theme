<?php
	/*
		Standard Post Format for Single Page
		@package soundboutiques
	*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('main-articles'); ?>>
	<?php
		if( has_post_thumbnail() ):
		$featured_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	?>
		<div class="standard-featured background-image" style="background-image: url(<?php echo $featured_image; ?>);"></div>
	<?php endif; ?>
	<div class="full-body">
		<header class="entry-header">
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			<div class="entry-meta">
				<?php echo soundboutiques_posted_meta(); ?>
			</div>
			<?php echo soundboutiques_share_this(); ?>
		</header>
		<div class="entry-content">
			<div class="entry-content-body">
				<?php the_content(); ?>
			</div>
		</div>
		<?php // echo soundboutiques_share_this(); ?>
		<hr>
		<div class="entry-footer">
			<?php echo soundboutiques_posted_footer(); ?>
		</div>
	</div>
</article>
