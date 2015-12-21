<?php
require_once('class.Social_Cron.php');

$service = Social::SV_LINKEDIN;

$social = new Social(array('services' => array($service)));

$options = array_merge(
		$social->get_connection( array('service' => $service) ),
		$social->get_game(array('service' => $service)),
		$social->get_action_names(array('service' => $service)),
		array('service' => $service)
		
		//TODO: Move actions and slugs as configurable elements per project
);

$slug_names = array(
		'linkedinFollowCompanyNetech');

Social_Cron::run_sv_cron(array('sv_slugs' => $slug_names, 'sv_options' => $options, 'social_obj' => $social));