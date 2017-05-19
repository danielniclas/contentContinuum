<?php

/**
 * Custom WP_NAV_MENU function for top navigation
 */
if (!class_exists('AtonQodefStickyNavigationWalker')) {
	class AtonQodefStickyNavigationWalker extends Walker_Nav_Menu {

		// add classes to ul sub-menus
		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
		{
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {

			$indent = str_repeat("\t", $depth);
			if($depth == 0){
				$out_div = '<div class="second"><div class="inner">';
			}else{
				$out_div = '';
			}

			// build html
			$output .= "\n" . $indent . $out_div  .'<ul>' . "\n";
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);

			if($depth == 0){
				$out_div_close = '</div></div>';
			}else{
				$out_div_close = '';
			}

			$output .= "$indent</ul>". $out_div_close ."\n";
		}

		// add main/sub classes to li's and links
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $aton_qodef_options;

			$sub = "";
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
			if($depth==0 && $args->has_children) :
				$sub = ' has_sub';
			endif;
			if($depth==1 && $args->has_children) :
				$sub = 'sub';
			endif;

			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

            //menu type class
            $wide_background = '';
            if($aton_qodef_options['enable_wide_menu_background'] == "yes" ){
                $wide_background = 'true';
            }

			//menu type class
			$menu_type = "";
			if($depth==0){
				if($item->type_menu == "wide"){
					$menu_type = " wide";
                    if($wide_background == 'true'){
                        $menu_type = " wide wide_background";
                    }

				}elseif($item->type_menu == "wide_icons"){
					$menu_type = " wide icons";
                    if($wide_background == 'true'){
                        $menu_type = " wide icons wide_background";
                    }
				}else{
					$menu_type = " narrow";
				}
			}

			//wide menu position class
			$wide_menu_position = "";
			if($depth==0){
				if($item->wide_position == "right"){
					$wide_menu_position = " right_position";
				}elseif($item->wide_position == "left"){
					$wide_menu_position = " left_position";
				}else{
					$wide_menu_position = "";
				}
			}

			$anchor = '';
			if($item->anchor != ""){
				$anchor = '#'.esc_attr($item->anchor);
				$class_names .= ' anchor-item';
			}

			$active = "";
			// depth dependent classes
			if ($item->anchor == "" && (($item->current && $depth == 0) || ($item->current_item_ancestor && $depth == 0))):
				$active = 'qodef-active-item';
			endif;

			// build html
			$output .= $indent . '<li id="sticky-nav-menu-item-'. $item->ID . '" class="' . $class_names . ' '. $active . $sub . $menu_type . $wide_menu_position .'">';

			$current_a = "";
			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ' href="'   . esc_attr( $item->url        ) .$anchor.'"';
			if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
				$current_a .= ' current ';
			endif;

			$no_link_class = '';
			if($item->nolink != '') {
				$no_link_class = ' no_link';
			}

            $no_icon_class = '';
            if($item->icon_pack != "" && $item->icon != "") {
                $no_icon_class = ' has_icon';
            }

			$attributes .= ' class="'.$current_a.$no_link_class.$no_icon_class.'"';
			$item_output = $args->before;
			if($item->hide == ""){
				if($item->nolink == ""){
					$item_output .= '<a'. $attributes .'><span class="item_outer">';
				} else{
					$item_output .= '<a'. $attributes .' style="cursor: default;" onclick="JavaScript: return false;"><span class="item_outer">';
				}
				if($item->icon != ""){$icon = $item->icon; } else{ $icon = "blank"; }

				$angle_icon   = '';
				if($depth == 1) {
					$angle_icon = 'ion-arrow-right-c';
				}

				$item_output .= '<span class="item_inner">';

                if($item->icon_pack == 'font_awesome') {
                    $icon .= ' fa';
                }

                if($item->icon_pack != "" && $item->icon != "") {
                    $item_output .= '<span class="menu_icon_wrapper"><i class="menu_icon '.$icon.'"></i></span>';
                }
				$item_output .= '<span class="item_text">';
				$item_output .= apply_filters('the_title', $item->title, $item->ID);
				$item_output .= '</span>'; //close span.item_text
                if($item->featured_icon !== "" && $item->featured_icon == "fa-star"){
                    $item_output .= '<span class=" qodef-featured-icon fa '. $item->featured_icon .'" aria-hidden="true"></span>';
                } else if ($item->featured_icon !== "" && $item->featured_icon == "New") {
                    $item_output .= '<span class="qodef-featured-icon text" aria-hidden="true">' . esc_html__('New', 'aton') . '</span>';
                }
				$item_output .= '</span>'; //close span.item_inner
				$item_output .= '<span class="plus"></span>';

				//append arrow for dropdown

				if($args->has_children && $angle_icon != "") {
					$item_output .= '<i class="qodef-menu-arrow '.$angle_icon.'"></i>';
				}

				$item_output .= '</span></a>';
			}

			if($item->sidebar != "" && $depth > 0){
				ob_start();
				dynamic_sidebar($item->sidebar);
				$sidebar_content = ob_get_contents();
				ob_end_clean();
				$item_output .= $sidebar_content;
			}

			$item_output .= $args->after;

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}