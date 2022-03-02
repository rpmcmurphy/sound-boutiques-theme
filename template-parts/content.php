<?php
/**
 * Template used to display post snippets/card.
 *
 * @package soundboutiques
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
			<?php the_title('<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>'); ?>
			<div class="entry-meta">
				<?php echo soundboutiques_posted_meta(); ?>
			</div>
		</header>
		<div class="entry-content">
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
			<div class="button-container">
				<a href="<?php the_permalink(); ?>" class="custom-button"><?php _e('Read More'); ?></a>
			</div>
		</div>
		<hr>
		<div class="entry-footer">
			<?php echo soundboutiques_posted_footer(); ?>
		</div>
	</div>
</article>
