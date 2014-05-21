<?php
/*
Plugin Name: S3 Streams 
Plugin URI: 
Description: 
Version: 0.1
Author: Adam Backstrom
Author URI: http://sixohthree.com/
License: GPL2
*/

if( !function_exists('add_filter') ) {
	function add_filter() {}
}

ini_set('include_path', ini_get('include_path') . ':' . __DIR__);

require_once 'Zend/Service/Amazon/S3.php';

call_user_func(function() {
	$s3 = new Zend_Service_Amazon_S3('PRIVATE', 'PRIVATE');
	$s3->registerStreamWrapper('s3');
});

define('S3_BUCKET', 'wps3');

function s3_upload_path( $path ) {
	return 's3://wps3/wp-content/uploads';
}
add_filter( 'pre_option_upload_path', 's3_upload_path' );

function s3_upload_url_path( $path ) {
	return 'http://s3.amazonaws.com/wps3/wp-content/uploads';
}
add_filter( 'pre_option_upload_url_path', 's3_upload_url_path' );

function s3_upload_dir( $uploads ) {
	$uploads['path'] = substr( $uploads['path'], strlen(ABSPATH) );
	$uploads['basedir'] = substr( $uploads['basedir'], strlen(ABSPATH) );

	return $uploads;
}
add_filter( 'upload_dir', 's3_upload_dir' );

?>
