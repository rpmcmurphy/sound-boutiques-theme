<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package storefront
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
		</header>
		<div class="entry-content">
			<div class="entry-excerpt">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</article>
