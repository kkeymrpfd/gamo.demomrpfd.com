<?
$data['logo'] = substr(Core::get_input('logo', 'get'), 0, 20);

$generated = Core::r('demandgen')->generate_html(array(
		'email_template' => $data['email_template'],
		'params' => array(
			'logo' => 'http://' . URL . '/demandgen_img.php?image=' . $data['logo'],
			'hash' => '',
			'url' => URL
		)
	)
);

?>
/start_view
' . $generated['html'] . '
/end_view