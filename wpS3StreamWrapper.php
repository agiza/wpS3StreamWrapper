<?php
/*
Plugin Name: wpS3StreamWrapper 
Plugin URI: https://github.com/foglerek/wpS3StreamWrapper
Description: Enables use of s3:// stream, allowing you to set a AWS S3 bucket as the upload_dir and upload_dir_url.
Version: 0.1
Author: Alexander Wesolowski
Author URI: http://github.com/foglerek
License: MIT
*/

if (!class_exists('WpS3StreamWrapper')) {
	require_once( plugin_dir_path(__FILE__) . 'lib/WpS3StreamWrapper.php' );

	$WpS3StreamWrapper = new WpS3StreamWrapper();
}

if (is_admin()) {
	$WpS3StreamWrapper->setupAdminPage();
}

register_activation_hook(__FILE__, array($WpS3StreamWrapper, 'activate'));
register_deactivation_hook(__FILE__, array($WpS3StreamWrapper, 'deactivate'));

?>
