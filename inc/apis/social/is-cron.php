<?php
require_once('class.Social_Cron.php');


//TODO: All social code relies on same configuration settings. We should put non path related settings
//into DB so we can use any method to save there(furture CMS and then read from there and configure the main cron job
//TODO: Main cron job will choose which services will run and call corresponding jobs
//TODO: For each cron job based on the actions we are trucking, initiate the paths for those actions
//TODO: Need a test that if the service is enabled, it has the required configuration

$service = Social::SV_INSTAGRAM;

$social = new Social(array('services' => array($service)));

$options = array_merge(
		$social->get_connection( array('service' => $service) ),
		$social->get_game(array('service' => $service)),
		$social->get_action_names(array('service' => $service)),
		array('service' => $service)
);

$slug_names = array('instagramTagPhotoEmc');

Social_Cron::run_sv_cron(array('sv_slugs' => $slug_names, 'sv_options' => $options, 'social_obj' => $social));


