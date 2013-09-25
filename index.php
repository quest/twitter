<?php
require_once 'twitteroauth.php';
require_once 'config.php';
require_once 'functions.php';

$connection = new TwitterOAuth(
	CONSUMER_KEY, 
	CONSUMER_SECRET, 
	ACCESS_TOKEN, 
	ACCESS_TOKEN_SECRET
);
$connection->decode_json = false;

/**
 * Services availables
 */
$services = array('search', 'profile');

if (empty($_GET['service'])) {
	error('No service provider');
}

if (!in_array($_GET['service'], $services)) {
	error('Service not exists');	
}

/**
 * Search service
 * +info https://dev.twitter.com/docs/api/1.1/get/search/tweets
 */
if ($_GET['service'] == 'search') {
	if (empty($_GET['q'])) {
		error('"q" parameter is required');
	}

	unset($_GET['service']);
	json_header();
	echo $connection->get('search/tweets', $_GET);
}

/**
 * Profile view service
 * +info https://dev.twitter.com/docs/api/1.1/get/users/show
 */
else if ($_GET['service'] == 'profile') {
	if (empty($_GET['user_id']) && empty($_GET['screen_name'])) {
		error('"user_id" or "screen_name" parameter is required');
	}

	unset($_GET['service']);
	json_header();
	echo $connection->get('users/show', $_GET);
}

die();