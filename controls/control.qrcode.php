<?
// Controller for QR Codes
// @depend core/class.Core.php
class Control_Qrcode {

	function run() {

		global $data, $page_settings, $models, $session, $gamo;
		
		$page_settings['allow_json'] = 0;

		$pages = array(
			'scan',
			'question',
			'response',
		);

		$data['page'] = $page_settings['page'];
		if (!in_array($page_settings['page'], $pages)) {
            header('Location: /?a=profile');
		}
        
        $data['partner'] = 'Acme Technologies';
        
        switch($data['page']) {
            case 'scan' :
                $data['points'] = 100;
                break;
            case 'question' :
                $data['question'] = array(
                    'question' => 'What was our revenue in 2013?',
                    'number' => 1,
                    'options' => array(
                        '500 Million',
                        '12 Million',
                        '900 Million',
                        '200 Million',
                    ),
                );
                break;
            case 'response' :
                $data['response'] = (isset($_GET['response'])) ? (bool)$_GET['response'] : false;
                if ($data['response']) {
                    $data['points'] = 100;
                } else {
                    $data['correct_option'] = 'Answer #1';
                }
                break;
        }

		return $data;

	}

}
