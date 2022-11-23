<?php
if ( ! defined( 'ABSPATH' ) )
    exit;

function php_code_install(){
    if(get_option('php_code_document_root')=='') {
        add_option('php_code_document_root',($_SERVER['DOCUMENT_ROOT'].'/'));
    }
    if(get_option('php_code_include_path')=='') {
        add_option('php_code_include_path','includes/');
    }
}

function php_code_uninstall(){
    delete_option("php_code_include_path");
    delete_option("php_code_document_root");
    }

register_activation_hook( PHP_CODE_ROOT ,'php_code_install');
register_uninstall_hook( PHP_CODE_ROOT, 'php_code_uninstall' );














/**************** for future DEV 
function xyz_ips_network_install($networkwide) {
    global $wpdb;
    if (function_exists('is_multisite') && is_multisite()) {
        // check if it is a network activation - if so, run the activation function for each blog id
        if ($networkwide) {
            $old_blog = $wpdb->blogid;
            // Get all blog ids
            $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
            foreach ($blogids as $blog_id) {
                switch_to_blog($blog_id);
                xyz_ips_install();
            }
            switch_to_blog($old_blog);
            return;
        }
    }
    xyz_ips_install();
}

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

*/