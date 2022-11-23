<?php 
if ( ! defined( 'ABSPATH' ) ) 
	exit;

function xyz_ips_network_uninstall($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				xyz_ips_uninstall();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	xyz_ips_uninstall();
}

function xyz_ips_uninstall(){

global $wpdb;
delete_option("php_code_sort_order");
delete_option("php_code_sort_field_name");
delete_option("php_code_limit");
delete_option("php_code_installed_date");
delete_option("php_code_exception_email");
delete_option("php_code_auto_insert");
delete_option("php_code_auto_exception");
/* table delete*/
//$wpdb->query("DROP TABLE ".$wpdb->prefix."php_code");


}

register_uninstall_hook( PHP_CODE_ROOT, 'xyz_ips_network_uninstall' );
?>
