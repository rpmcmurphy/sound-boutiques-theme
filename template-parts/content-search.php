<?php
/**
 * Template used to display searched items
 *
 * @package soundboutiques
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-articles'); ?>>
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
