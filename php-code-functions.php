<?php
if ( ! defined( 'ABSPATH' ) )
	 exit;
	 
if (!function_exists('pretty')) {
	function pretty($result){
		print("<pre>".print_r($result,true)."</pre>");
		}
}

function scanDirs($dir) {
    $result = [];
    foreach(scandir($dir) as $filename) {
      if ($filename[0] === '.') continue;
      $filePath = $dir . '/' . $filename;
      if (is_dir($filePath)) {
        foreach (scanDirs($filePath) as $childFilename) {
          $result[] = $filename . '/' . str_replace(".php", "", $childFilename);
        }
      } else {
        $result[] = str_replace(".php", "", $filename);
      }
    }
    return $result;
}

if(!function_exists('php_code_trim_deep'))
{

	function php_code_trim_deep($value) {
		if ( is_array($value) ) {
			$value = array_map('php_code_trim_deep', $value);
		} elseif ( is_object($value) ) {
			$vars = get_object_vars( $value );
			foreach ($vars as $key=>$data) {
				$value->{$key} = php_code_trim_deep( $data );
			}
		} else {
			$value = trim($value);
		}

		return $value;
	}

}

/***********  Styles and Scripts **************/

function php_code_add_style_script(){

	wp_enqueue_script('jquery');
	
	wp_register_script( 'php_code_notice_script', plugins_url ('js/notice.js' , PHP_CODE_ROOT ));
	wp_enqueue_script( 'php_code_notice_script' );
	
	// Register stylesheets
	wp_register_style('php_code_style', plugins_url('css/php_code_styles.css', PHP_CODE_ROOT));
	wp_enqueue_style('php_code_style');
}
add_action('admin_enqueue_scripts', 'php_code_add_style_script');

/* ********************* Start Tiny MCE Button **************/

function php_code_tinymce_button() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		
		if ( get_user_option('rich_editing') == 'true') {
			
			add_filter( 'mce_buttons', function($b){array_push( $b, 'php_code_button');return $b;} );
			add_filter( 'mce_external_plugins', function($a){$a['php_code_buttons'] = get_site_url() . '/?wp_php_code';return $a;} );
		}
	}
}

function php_code_plugin_parse_request($wp) {
	if (array_key_exists('wp_php_code', $wp->query_vars)) {
		require( dirname( __FILE__ ) . '/js/tiny-mce-button.js' );
		die;
	}	
}

add_action('admin_init', 'php_code_tinymce_button');
add_filter('query_vars', function($v){$v[] = 'wp_php_code';return $v;});
add_action('parse_request', 'php_code_plugin_parse_request');