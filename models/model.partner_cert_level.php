<?
class Model_Partner_Cert_Level {

	function run($options = array()) {
		
		global $gamo;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		$data['level'] = 'No Certification';

		$has = Core::r('users')->has_property(array(
				'user_id' => $options['user_id'],
				'values' => array('badge_id' => 15)
			)
		);

		if(isset($has['has']) && $has['has'] == 1) {

			$data['level'] = 'Affiliate';

		} else {

			$has = Core::r('users')->has_property(array(
					'user_id' => $options['user_id'],
					'values' => array('badge_id' => 16)
				)
			);

			if(isset($has['has']) && $has['has'] == 1) {

				$data['level'] = 'Affiliate Elite';

			} else {

				$has = Core::r('users')->has_property(array(
						'user_id' => $options['user_id'],
						'values' => array('badge_id' => 17)
					)
				);

				if(isset($has['has']) && $has['has'] == 1) {

					$data['level'] = 'Premier';

				} else {

					$has = Core::r('users')->has_property(array(
							'user_id' => $options['user_id'],
							'values' => array('badge_id' => 18)
						)
					);

					if(isset($has['has']) && $has['has'] == 1) {

						$data['level'] = 'Signature';

					}

				}

			}

		}

		return $data;

	}

}

?>
