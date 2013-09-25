<?php
function json_header() {
	header('Cache-Control: no-cache, must-revalidate');
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Content-type: application/json');
}
function error($msg = 'Error') {
	json_header();
	die(json_encode(array('errors' => array('code' => 404, 'message' => $msg))));
}