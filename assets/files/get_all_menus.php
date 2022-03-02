function menu_hirechy_creater($location) {

    $menu_locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($menu_locations[$location]);

    $menu_items = wp_get_nav_menu_items($menu->term_id);


    $new_menu_array = array();
    foreach ((array) $menu_items as $key => $menu_item) {
        $new_menu_array[$menu_item->menu_item_parent][] = $menu_item;
    }

    $new_menu_array1 = array();
    foreach ((array) $menu_items as $key => $menu_item) {
        if (isset($new_menu_array[$menu_item->ID])) {
            $menu_item->sub = $new_menu_array[$menu_item->ID];
            if($menu_item->menu_item_parent == 0) {
                $new_menu_array1[] = $menu_item;
            }
        }
    }

    $menu_tree = array_splice($new_menu_array[0],0,15,$new_menu_array1);
    return $menu_tree;
}
