<?php
if ( ! defined( 'ABSPATH' ) )
	 exit;
	
if(!function_exists('xyz_ips_plugin_get_version'))
{
	function xyz_ips_plugin_get_version() 
	{
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( PHP_CODE_ROOT ) ) );
		return $plugin_folder['insert-php-code-snippet.php']['Version'];
	}
}

if(!function_exists('xyz_trim_deep'))
{

	function xyz_trim_deep($value) {
		if ( is_array($value) ) {
			$value = array_map('xyz_trim_deep', $value);
		} elseif ( is_object($value) ) {
			$vars = get_object_vars( $value );
			foreach ($vars as $key=>$data) {
				$value->{$key} = xyz_trim_deep( $data );
			}
		} else {
			$value = trim($value);
		}

		return $value;
	}

}

if(!function_exists('xyz_ips_page_exists_by_slug'))
{
function xyz_ips_page_exists_by_slug( $post_slug ) {
    $args_posts = array(
        'post_type'      => 'page',
        'post_status'    => 'any',
        'name'           => $post_slug,
        'posts_per_page' => 1,
    );
    $loop_posts = new WP_Query( $args_posts );
    if ( ! $loop_posts->have_posts() ) {
        return false;
    } else {
        $loop_posts->the_post();
        return $loop_posts->post->ID;
    }
}
}
if(!function_exists('xyz_ips_get_link_by_slug'))
{

function xyz_ips_get_link_by_slug($slug, $type = 'page'){
  $post = get_page_by_path($slug, OBJECT, $type);
  return get_permalink($post->ID);
}
}

function xyz_ips_preview_page( $content ) {
    if ( strcmp( 'xyz-ics-preview-page', get_post_field( 'post_name' ) ) === 0 ) {

			$xyz_ips_snippetId="";
			if(isset($_GET['snippetId']))
			$xyz_ips_snippetId=intval($_GET['snippetId']);

			if($xyz_ips_snippetId!="" && is_numeric($xyz_ips_snippetId))
			{
				global $wpdb;
				
					$snippetDetails = $wpdb->get_results($wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'php_code WHERE id=%d LIMIT 0,1',$xyz_ips_snippetId )) ;
					if(!empty($snippetDetails)) {
					$snippetDetails = $snippetDetails[0];

	      	$content = do_shortcode( '[php-code snippet="'.esc_html($snippetDetails->title).'"]' );
				}
			}
    }

    return $content;
}

add_filter( 'the_content', 'xyz_ips_preview_page' );

//Direct Call

function php_code_plugin_query_vars($vars) {
	$vars[] = 'wp_php_code';
	return $vars;
}
add_filter('query_vars', 'php_code_plugin_query_vars');


function php_code_plugin_parse_request($wp) {
	/*confirmation*/
	if (array_key_exists('wp_php_code', $wp->query_vars) && $wp->query_vars['wp_php_code'] == 'editor_plugin_js') {
		require( dirname( __FILE__ ) . '/editor_plugin.js.php' );
		die;
	}
	
}
add_action('parse_request', 'php_code_plugin_parse_request');

?>
