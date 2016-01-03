<?
class Model_Game_Nav {

	function run( $options = array() ) {

		global $page_settings, $has_menu;
		
		$menu_assets = 
			array(
				'home' => array('href' => '/?p=whatsnew', 'img' => '/img/Sidebar_General_', 'img_suf' => 'Unselected.png', 'name' => 'Home', 'addClass' => 'navhider'),
				'about' => array('href' => '/?p=about', 'img' => '/img/Sidebar_General_', 'img_suf' => 'Unselected.png', 'name' => 'About', 'addClass' => 'navhider'),
				'rewards' => array('href' => '/?p=badges', 'img' => '/img/Sidebar_General_', 'img_suf' => 'Unselected.png', 'name' => 'Rewards', 'addClass' => 'navhider'),
				'whatsnew' => array('href' => '/?p=whatsnew', 'img' => '/img/Sidebar_WhatsNew_', 'img_suf' => 'Unselected.png', 'name' => 'What&#39;s New?', 'addClass' => ''),
				'training' => array('href' => '/?p=training', 'img' => '/img/Sidebar_Training_', 'img_suf' => 'Unselected.png', 'name' => 'Sales Resources', 'addClass' => ''),
				'demandgen' => array('href' => '/?p=demandgen', 'img' => '/img/Sidebar_DemandGen_', 'img_suf' => 'Unselected.png', 'name' => 'Demand Gen', 'addClass' => ''),
				'meetings' => array('href' => '/?p=meetings', 'img' => '/img/Sidebar_Meeting_', 'img_suf' => 'Unselected.png', 'name' => 'Opportunities / Deal Reg', 'addClass' => ''),
				'mdf' => array('href' => '/?p=mdf', 'img' => '/img/Sidebar_Meeting_', 'img_suf' => 'Unselected.png', 'name' => 'MDF', 'addClass' => ''),
				'logout' => array('href' => '/?a=logout', 'img' => '/img/Sidebar_General_', 'img_suf' => 'Unselected.png', 'name' => 'Logout', 'addClass' => 'navhider')
			);
		
		switch($page_settings['page']){
			
			case 'whatsnew':
				$menu_assets['whatsnew']['current'] = true;
				$menu_assets['whatsnew']['img_suf'] = 'Selected.png';
				break;
			case 'training':
				$menu_assets['training']['current'] = true;
				$menu_assets['training']['img_suf'] = 'Selected.png';
				break;
			case 'demandgen':
				$menu_assets['demandgen']['current'] = true;
				$menu_assets['demandgen']['img_suf'] = 'Selected.png';
				break;
			case 'meetings':
				$menu_assets['meetings']['current'] = true;
				$menu_assets['meetings']['img_suf'] = 'Selected.png';
				break;
			case 'mdf':
				$menu_assets['mdf']['current'] = true;
				$menu_assets['mdf']['img_suf'] = 'Selected.png';
				break;
			case 'mdf_activities':
				$menu_assets['mdf']['current'] = true;
				$menu_assets['mdf']['img_suf'] = 'Selected.png';
				break;
			default:
				$menu_assets['whatsnew']['current'] = true;
				$menu_assets['whatsnew']['img_suf'] = 'Selected.png';
				break;
		}

		return array('gamo_nav' => $menu_assets);

	}

}

?>
