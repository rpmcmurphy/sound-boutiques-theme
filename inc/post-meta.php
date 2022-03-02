<?php
	// Blog loop custom functions
	function soundboutiques_posted_meta() {
		$posted_on = human_time_diff( get_the_time('U') , current_time('timestamp') );

		$categories = get_the_category();
		$separator = ', ';
		$output = '';
		$i = 1;

		if( !empty($categories) ):
			foreach( $categories as $category ):
				if( $i > 1 ): $output .= $separator; endif;
				$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( 'View all posts in%s', $category->name ) .'">' . esc_html( $category->name ) .'</a>';
				$i++;
			endforeach;
		endif;

		return '<span class="posted-on">Posted <a href="'. esc_url( get_permalink() ) .'">' . $posted_on . '</a> ago</span> &nbsp; | &nbsp; <span class="posted-in">' . $output . '</span>';
	}

	function slider_posted_meta() {
		$posted_on = human_time_diff( get_the_time('U') , current_time('timestamp') );
		return '<span class="posted-on">Posted ' . $posted_on . ' ago</span>';
	}

	// Post Footer
	function soundboutiques_posted_footer() {
		$comments_num = get_comments_number();
		if( comments_open() ){
			if( $comments_num == 0 ){
				$comments = __('No Comments');
			} elseif ( $comments_num > 1 ){
				$comments= $comments_num . __(' Comments');
			} else {
				$comments = __('1 Comment');
			}
			$comments = '<a class="comments-link" href="' . get_comments_link() . '">'. $comments .' <span class="soundboutiques-comment"></span></a>';
		} else {
			$comments = __('Comments are closed');
		}

		return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'. get_the_tag_list('<div class="tags-list"><span class="soundboutiques-tag"></span>', ' ', '</div>') .'</div><div class="col-xs-12 col-sm-6 text-right">'. $comments .'</div></div></div>';
	}

	// Post navigation
	function soundboutiques_post_navigation() {
		$nav = '<div class="row">';
		/*$nav .= '<div class="post-navigation">';*/
		$prev = get_previous_post_link( '<div class="post-link-nav">%link</div>', '%title' );
		$nav .= '<div class="col-xs-12 col-sm-6">' . $prev . '</div>';
		$next = get_next_post_link( '<div class="post-link-nav">%link</div>', '%title' );
		$nav .= '<div class="col-xs-12 col-sm-6 text-right">' . $next . '</div>';
		/*$nav .= '</div>';*/
		$nav .= '</div>';

		return $nav;
	}

	// Comment navigation
	function soundboutiques_get_post_navigation() {
    if (get_comment_pages_count() > 1 && get_option('page_comments')):
        require get_template_directory().'/inc/templates/soundboutiques-comment-nav.php';
    endif;
	}

	// Share this
	function soundboutiques_share_this()
	{
	    if (is_single()) {

	        $content = '<div class="share-this">';

	        $title = get_the_title();
	        $permalink = get_permalink();

	        $twitterHandler = (get_option('twitter_handler') ? '&amp;via='.esc_attr(get_option('twitter_handler')) : '');

	        $twitter = 'https://twitter.com/intent/tweet?text=Hey! Read this: '.$title.'&amp;url='.$permalink.$twitterHandler.'';
	        $facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
	        $google = 'https://plus.google.com/share?url='.$permalink;

	        $content .= '<ul>';
	        $content .= '<li><a href="'.$twitter.'" class="twitter" target="_blank" rel="nofollow">Twitter</a></li>';
	        $content .= '<li><a href="'.$facebook.'" class="facebook" target="_blank" rel="nofollow">Facebook</a></li>';
	        $content .= '<li><a href="'.$google.'" class="gplus" target="_blank" rel="nofollow">GPlus</a></li>';
	        $content .= '</ul></div>';

	        return $content;
		}
	}
