<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package soundboutiques
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<section id="comments" class="comments-area" aria-label="<?php esc_html_e( 'Post Comments', 'soundboutiques' ); ?>">

	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				printf(
					/* translators: 1: number of comments, 2: post title */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'soundboutiques' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
				// phpcs:enable
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through. ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation" aria-label="<?php esc_html_e( 'Comment Navigation Above', 'soundboutiques' ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'soundboutiques' ); ?></span>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'soundboutiques' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'soundboutiques' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'walker'			=> null,
						'max_depth' 		=> '3',
						'style'				=> 'ol',
						'callback'			=> null,
						'end-callback'		=> null,
						'type'				=> 'all',
						'reply_text'		=> 'Reply',
						'page'				=> '',
						'per_page'			=> '',
						'avatar_size'		=> 64,
						'reverse_top_level' => null,
						'reverse_children'	=> '',
						'format'			=> 'html5',
						'short_ping'		=> false,
						'echo'				=> true
					)
				);
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through. ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation" aria-label="<?php esc_html_e( 'Comment Navigation Below', 'soundboutiques' ); ?>">
			<span class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'soundboutiques' ); ?></span>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'soundboutiques' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'soundboutiques' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
			<?php
		endif; // Check for comment navigation.

	endif;

	if ( ! comments_open() && 0 !== intval( get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'soundboutiques' ); ?></p>
		<?php
	endif;

	$fields = array(
		'author' =>
			'<div class="form-fields comment-form-author"><label for="author">' . __( 'Name', 'soundboutiques' ) . '<span class="required"> *</span></label><input id="author" name="author" type="text" class="input-field author" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div>',
		'email' =>
			'<div class="form-fields comment-form-email"><label for="email">' . __( 'Email', 'soundboutiques' ) . '<span class="required"> *</span></label><input id="email" name="email" type="text" class="input-field email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" required="required" /></div>',
		'url' =>
			'<div class="form-fields comment-form-url last-field"><label for="url">' . __( 'Website', 'soundboutiques' ) . '</label><input id="url" name="url" class="input-field url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>'
	);
	$args = array(
		'class_submit' => 'button-container custom-button',
		'label_submit' => __( 'Submit Comment' ),
		'comment_field' =>
			'<div class="form-fields comment-form-textarea"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" class="comment-text" name="comment" rows="4" required="required"></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', $fields )

	);
	comment_form( $args );
	?>

</section><!-- #comments -->
