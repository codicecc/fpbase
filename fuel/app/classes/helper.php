<?php
class Helper {
	static function build_menu(array $menu_array, $is_sub=FALSE){
		 $ul_attrs = $is_sub ? 'class="dropdown-menu"' : 'class="nav navbar-nav"';
		 $menu = "<ul $ul_attrs>";

		 foreach($menu_array as $id => $attrs) {

				if(Auth::has_access($attrs['rights'])): // Check Access to Menu Item
					$activeCssClass="";
					if(Request::active()->controller.'.'.Request::active()->action==$attrs['rights'])$activeCssClass="*";

					$sub = isset($attrs['sub'])
						 ? self::build_menu($attrs['sub'], TRUE)
						 : null;
					$li_attrs = $sub ? 'class="dropdown"' : null;
					$a_attrs  = $sub ? 'class="dropdown-toggle" data-toggle="dropdown"' : null;
					$carat    = $sub ? '<span class="caret"></span>' : null;

					$menu .= "<li ".$li_attrs." >";
					$menu .= "<a href='".$id."' ".$a_attrs.">".__('admin.'.$attrs['text'])." ".$carat." ".$activeCssClass."</a>".$sub;
					$menu .= "</li>";
				endif;
		 }
		 return $menu . "</ul>";
	}
}
?>
