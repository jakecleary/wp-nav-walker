<?php

class custom_nav_walker extends Walker_Nav_menu {
    function start_el( &$output, $item, $depth, $args)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat('',$depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $current_indicators = array('current-menu-item','current-menu-parent','current_page_item','current_page_parent');
        $newClasses = array();
        foreach($classes as $el) {
            if(in_array($el,$current_indicators)) {
                array_push($newClasses,$el);
            }
        }
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $newClasses ), $item ) );
        if ( $class_names != '' ) {
            $class_names = ' active';
        }

        // Check if the item has children
        if ( in_array( 'menu-item-has-children', $classes ) ) {
            $class_names .= ' has_children';
        }

        if ( $class_names != '') {
            $class_names = ' class="' . $class_names . '"';
        }

        $itemID = strtolower($item->title);
        $menu_name = 'main-menu';
        $output .= $indent . '<li' . $value . $class_names . '>';

        //
        // Item attributes
        //

        echo $item->children;

        $attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';

        //
        // Item output
        //

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters('the_title',$item->title, $item->ID);
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);
    }
}