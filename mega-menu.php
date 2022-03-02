<?php
/*
 * One very important fact all the tutorial miss is that the topmost wrapper, be it <ul> or <div>, is 
 * set from the original menu call function itself. So, when I will start here, it will just get the me first menu item with start_el. Remember, the first MENU ITEM (LI ELEM). Now, when I will add a wrapper around with the start_lvl + end_lvl, it will add that warpper inside the original wrapper passed down bu the menu function call in the HTML. REMEMBER, he is giving th fist child element of the top level wp_nav_menu <ul>. He is giving me the <li> one by one. And in the start_lvl, depth is 0. And, the lvl will iterate once over every depth level and elem will iterate over every item once (refer to the drag-drop menu UI to understand better). ITERATE OVER ELEMS FIRST, THEN IF A NEW LEVEL, DO THE LEVEL STUFF AND MOVE OVER TO ELEMS UNDER IT. Starts with the ELEM FIRST!!! 
 */
class Mega_Menu_Walker_nav extends Walker_Nav_Menu {

    /**
     * Unique id for dropdowns
     */
    public $submenu_unique_id = '';
    public $item_count = 0;

    /**
     * Starts the list before the elements are added.
     * @see Walker::start_lvl()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {

        // has_children = true in $args
        // menu_class = ...

        // if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        //     $t = '';
        //     $n = '';
        // } else {
        //     $t = "\t";
        //     $n = "\n";
        // }
        // $indent = str_repeat( $t, $depth );
        
        // $before_start_lvl = '<div class="megamenu">';
        
        // if($depth==0){
        //     $output .= "{$n}{$indent}{$before_start_lvl}<ul id=\"$this->submenu_unique_id\" class=\"container megamenu-background sub-menu dropdown-content\">{$n}";
        // } else {
        //     $output .= "{$n}{$indent}<ul id=\"$this->submenu_unique_id\" class=\"sub-menu dropdown-content\">{$n}";
        // }

        // If top level (here depth is 0 for the very first <li>), add the <div><ul> after the first <li>'s <a> tag, else add only <ul>. So, if depth==0, html will be <li><a> + mega-menu <div>
        $mega_menu_wrapper_start = '<div class="sb-mega-menu">';

        if($depth == 0) {
            $output .= "{$mega_menu_wrapper_start}<ul depth={$depth} id=\"mega-menu-one\" class=\"mega-menu-content-parent drop-down\">";
        } else {
            $output .= "<ul depth={$depth} id=\"mega-menu-one-drop\" class=\"sub-menu drop-down-content\">";
        }

        
    }
    
    /**
     * Ends the list of after the elements are added.
     * @see Walker::end_lvl()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        // if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            //     $t = '';
            //     $n = '';
            // } else {
                //     $t = "\t";
                //     $n = "\n";
        // }
        // $indent = str_repeat( $t, $depth );
        // $after_end_lvl = '</div>';
        
        // if($depth==0){
            //     $output .= "$indent</ul>{$after_end_lvl}{$n}";
            // }
            // else{
                //     $output .= "$indent</ul>{$n}";
                // }
                
        $mega_menu_wrapper_end = "</ul></div>";
        
        if($depth == 0) {
            $output .= $mega_menu_wrapper_end;
        } else {
            $output .= "</ul>";
        }
    }
    
    /**
     * @see Walker::start_el()
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        // $item e-> title, target, attr_title, url, description, classes, current-> false, current_item_ancestor-> is it's a sub-item
        // $args e-> before, after, link_before, link_after, menu_class, items_wrap-><ul id="%1$s" class="%2$s">%3$s</ul>, title, name, term_id etc.
        // $output-> is faka as I'll have to build it here

        
        // if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        //     $t = '';
        //     $n = '';
        // } else {
        //     $t = "\t";
        //     $n = "\n";
        // }
        // $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
        
        // Adding a custom class to the item
        // $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        // $classes[] = 'menu-item-' . $item->ID;
        
        // Add .active to the current item
        // // set active class for current nav menu item
        // if( $item->current == 1 ) {
        //     $classes[] = 'active';
        // }
        
        // Add .active to the parent of current nav 
        // // set active class for current nav menu item parent
        // if( in_array( 'current-menu-parent',  $classes ) ) {
        //     $classes[] = 'active';
        // }
        
        // /**
        //  * Filters the arguments for a single nav menu item.
        //  */
        // $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
        
        // // add a divider in dropdown menus
        // if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
        //     $output .= $indent . '<li class="divider">';
        // } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
        //     $output .= $indent . '<li class="divider">';
        // } else {
        //     $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
            
        //     //adding col-md-3 class to column
        //     if( in_array('menu-item-has-children', $classes ) ) {
        //         if( $depth === 1 ) {                    
        //             $class_names = $class_names ? ' class="col-md-3 mega-menucolumn '.esc_attr( $class_names ) . '"' : '';
        //         } else {
        //             $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        //         }
        //     }else{
        //         $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        //     }
            
        //     $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        //     $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
            
        //     $output .= $indent . '<li' . $id . $class_names .'>';
            
        //     $atts = array();
        //     $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        //     $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        //     $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            
        //     if( in_array('menu-item-has-children', $classes ) ) {
        //         $atts['href']   = ' ';
        //         $this->submenu_unique_id = 'dropdown-'.$item->ID;
        //     } else {
        //         $atts['href']   = ! empty( $item->url ) ? $item->url  : '';
        //         $atts['class'] = '';
        //     }
            
        //     // $atts['class'] .= ' menu-item-link-class ';
            
        //     $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
            
        //     $attributes = '';
        //     foreach ( $atts as $attr => $value ) {
        //         if ( ! empty( $value ) ) {
        //             $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
        //             $attributes .= ' ' . $attr . '="' . $value . '"';
        //         }
        //     }
            
        //     $title = apply_filters( 'the_title', $item->title, $item->ID );
        //     $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        //     $item_output = $args->before;
        //     $item_output .= '<a'. $attributes . '>';
            
        //     // set icon on left side
        //     if( !empty( $classes ) ) {
        //         foreach ($classes as $class_name) {
        //             if( strpos( $class_name , 'fa' ) !== FALSE ) {
        //                 $icon_name = explode( '-' , $class_name );
        //                 if( isset( $icon_name[1] ) && !empty( $icon_name[1] ) ) {
        //                     $item_output .= '<i class="fa fa-'.$icon_name[1].'" aria-hidden="true"></i> ';
        //                 }
        //             }
        //         }
        //     }
            
        //     $item_output .= $args->link_before . $title . $args->link_after;
            
        //     if( in_array('menu-item-has-children', $classes) ){
        //         if( $depth == 0 ) {
        //             $item_output .= ' <i class="fa fa-bolt" aria-hidden="true"></i>';
        //         }
        //     }
            
        //     $item_output .= '</a>';
        //     $item_output .= $args->after;
            
        //     $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        // }

        // the <li>
        $output .= "<li depth={$depth}>";
        
        // the <a>
        $output .= "<a>";
        $output .= $item->title;
        $output .= "</a>";
    }

    /**
     * Ends the element output, if needed.
     *
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        // if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        //     $t = '';
        //     $n = '';
        // } else {
        //     $t = "\t";
        //     $n = "\n";
        // }
        // $output .= "</li>{$n}";

        $output .= "</li>";
    }
}
