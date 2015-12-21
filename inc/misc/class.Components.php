<?
class Components {

	function board_summary($options = array()) {

		/*
		arguments:
			title:
			info:
			link:
			id:
			width:

		returns:
		{
			html: the generated html
		}
		*/

		global $view_output;

		Core::ensure_defaults(array(
				'title' => '',
				'info' => '',
				'link' => '',
				'id' => '',
				'width' => 250,
				'subinfo' => '',
				'html' => ''
			)
		, $options);

		$id = ($options['id'] == '') ? '' : ' id="' . $options['id'] . '"';
		$subinfo = ($options['subinfo'] == '') ? '' : '<div style="font-size:12px;color:#999;margin-top:10px">' . $options['subinfo'] . '</div>';
		if($options['html'] != '') { $options['html'] = ' ' . $options['html']; }

		$html = '<div class="board board-hover" style="width:' . $options['width'] . 'px;margin:13px;display:inline-block"' . $id . '' . $options['html'] . '>
			<div style="font-size:16px;color:#555;padding:5px">' . $options['title'] . '</div>
			<div style="height:1px;width:100%;background-color:#ddd"></div>
			<div style="height:1px;width:100%;background-color:#fff"></div>
			<div style="font-size:20px;font-weight:bold;margin:20px"><div style="display:block">' . $options['info'] . '</div>' . $subinfo . '</div>
		</div>';

		$view_output .= $html;

		return $html;
		
	}

	function points($options) {

		Core::ensure_defaults(array(
			'points' => 0,
			'text' =>'',
			'html' =>'',
			'extra_class' => '',
			'front' =>1
		), $options);

		if($options['html'] != '') { $options['html'] = ' ' . $options['html']; }
		if($options['extra_class'] != '') { $options['extra_class'] = ' ' . $options['extra_class']; }

		$use_class = '';
		$front = '';

		if($options['points'] > 0) {

			$use_class = 'points-up';
			$front = '+';

		} else if($options['points'] < 0) {

			$use_class = 'points-down';

		} else {

			$use_class = 'points-none';

		}

		if($options['front'] == 0) { $front = ''; }

		return '<div class="' . $use_class . '' . $options['extra_class'] . '"' . $options['html'] .'>' . $front . $options['points'] . $options['text'] . '</div>';

	}

}

$comps = new Components();
?>