<?php

class Navigasi {

   public function create_menu() {
      //$arr_menu = $_SESSION['user_menu'];
      $arr_menu = [];
      $menu = '';
      $menu = '
			<li class="nav-item pcoded-menu-caption">
				<span>Menu</span>
			</li>
			<li class="nav-item" title="Dashboard">
				<a href="' . base_url('admin/dashboard') . '" class="nav-link">
					<span class="pcoded-micon">
						<i class="feather icon-home"></i>
					</span>
					<span class="pcoded-mtext">Dashboard</span>
				</a>
			</li>

			<li class="nav-item" title="Dashboard">
				<a href="' . base_url('admin/menu/show') . '" class="nav-link">
					<span class="pcoded-micon">
						<i class="feather icon-home"></i>
					</span>
					<span class="pcoded-mtext">Menu</span>
				</a>
			</li>
      ';
      $menu .= $this->render_nav($arr_menu, '0');
      // $menu .= '
		// 	<li class="nav-item" title="Logout">
		// 		<a href="' . base_url( 'logout' ) . '" class="nav-link">
		// 			<span class="pcoded-micon">
		// 				<i class="fa fa-power-off"></i>
		// 			</span>
		// 			<span class="pcoded-mtext">Log Out</span>
		// 		</a>
		// 	</li>
		// ';
      return $menu;
   }

   public function render_nav($arr_menu= [], $parent_id = '0') {
      $generate_menu = '';
      if( array_key_exists($parent_id, $arr_menu) ) {
         foreach ($arr_menu[$parent_id] as $rootmenu_sort => $rootmenu_value) {
            $have_child = array_key_exists($rootmenu_value->menu_id, $arr_menu);
            if( $have_child ) {
               $rootmenu_link = 'javascript:;';
            } else {
               if( $rootmenu_value->menu_url == '#' ) {
                  $rootmenu_link = '#';
               } else {
                  $rootmenu_link = base_url() . $rootmenu_value->menu_url;
               }
            }
            $generate_menu = '
                  <li class="nav-item ' . ( ( $have_child ) ? 'pcoded-hasmenu' : ''). '"title ="' .$rootmenu_value->menu_description . '">
                     <a href="' .$rootmenu_link. '" class="nav-link">
                        <span class="pcoded-micon">
                           <i class="' .((!empty($rootmenu_value->menu_class)) ? $rootmenu_value->menu_class : 'far fa-circle nav-icon') .'"></i>
                        </span>
                        <span class="pcoded-micon">
                        ' .$rootmenu_value->menu_name. '
                        </span>
                     </a>
            ';
            if( $have_child ) {
               $generate_menu = '<ul class="pcoded-submenu p-2">';
               $generate_menu = $this->render_nav($arr_menu, $rootmenu_value->menu_id);
               $generate_menu = '</ul>';
            }
            $generate_menu = '</li>';
         }
      }
      return $generate_menu;
   }
}
$nav = new Navigasi();
echo $nav->create_menu();
