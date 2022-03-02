<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
	 <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Enter term...', 'woocommerce' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	 <button class="search-submit custom-button mt-3 w-100" type="submit">GO</button>
</form>
