<?php
if ( ! defined( 'ABSPATH' ) )
    exit;


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


function xyz_ips_install(){
    global $wpdb;

    if(get_option('php_code_sort_order')==''){
        add_option('php_code_sort_order','asc');
    }

    if(get_option('php_code_sort_field_name')==''){
        add_option('php_code_sort_field_name','title');
    }

    if(get_option('php_code_auto_insert')==""){
        add_option('php_code_auto_insert',1);
    }

    if(get_option('php_code_auto_exception')==""){
        add_option('php_code_auto_exception',1);
    }

    $php_code_installed_date = get_option('php_code_installed_date');
    if ($php_code_installed_date=="") {
        $php_code_installed_date = time();
        update_option('php_code_installed_date', $php_code_installed_date);
    }
    add_option('php_code_limit',200);
    add_option('php_code_exception_email',"0");
    
    $charset_collate = $wpdb->get_charset_collate();
    $queryInsertPhp = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix."php_code (
`id` int NOT NULL AUTO_INCREMENT,
`title` varchar(1000) NOT NULL,
`content` longtext  NOT NULL,
`short_code` varchar(2000) NOT NULL,
`status` int NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB ".$charset_collate." AUTO_INCREMENT=1";
    $wpdb->query($queryInsertPhp);


    //preview page
    $user_ID = get_current_user_id();
  	$slug = 'xyz-ics-preview-page';
  	$title = 'Snippet Preview';
  	$content = '';
  	// Cheks if doen't exists a post with slug "wordpress-post-created-with-code".
  	if( !xyz_ips_page_exists_by_slug( $slug ) ) {
  		// Set the post ID
  		$post_id = wp_insert_post(
  									array(
  											'post_author'       =>   $user_ID,
  											'post_name'         =>   $slug,
  											'post_title'        =>   $title,
  											'post_content'      =>  $content,
  											'post_status'       =>   'draft',
  											'post_type'         =>   'page'
  									)
  		);
  	}
}
register_activation_hook( PHP_CODE_ROOT ,'xyz_ips_network_install');
?>
