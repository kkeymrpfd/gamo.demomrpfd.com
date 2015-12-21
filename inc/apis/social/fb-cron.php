<?php
require_once('class.Social_Cron.php');

$service = Social::SV_FACEBOOK;

$social = new Social(array('services' => array($service)));

$options = array_merge(
		$social->get_connection( array('service' => $service) ),
		$social->get_game(array('service' => $service)),
		$social->get_action_names(array('service' => $service)),
		array('service' => $service)
);

$slug_names = array( 'facebookLikePageEmccorp' );



Social_Cron::run_sv_cron(array('sv_slugs' => $slug_names, 'sv_options' => $options, 'social_obj' => $social));