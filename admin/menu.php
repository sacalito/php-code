<?php
if ( ! defined( 'ABSPATH' ) )
	 exit;

	 if(isset($_GET['page']) && $_GET['page']=='php-code-manage' ){
	     ob_start();
	 }
add_action('admin_menu', 'xyz_ips_menu');

function xyz_ips_menu(){

		$phpCodeIcon = 'data:image/svg+xml;base64,PHN2ZyBjbGFzcz0id3Bjb2RlLWljb24gd3Bjb2RlLWljb24tbG9nbyIgd2lkdGg9IjM2IiBoZWlnaHQ9IjM0IiB2aWV3Qm94PSItMTAgLTYgODAgODAiIGZpbGw9IiNhN2FhYWQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik01Ny41NzA2IDY0SDYuNTY3MzJDMi44OTk4NSA2NCAwIDYxLjEwNjQgMCA1Ny40NDY4VjYuNTUzMTlDMCAyLjg5MzYyIDIuODk5ODUgMCA2LjU2NzMyIDBINTcuNTcwNkM2MS4yMzgxIDAgNjQuMTM3OSAyLjg5MzYyIDY0LjEzNzkgNi41NTMxOVY1Ny40NDY4QzY0LjEzNzkgNjEuMTA2NCA2MS4yMzgxIDY0IDU3LjU3MDYgNjRaTTE1Ljg2MyA1Mi4wODU1QzE1LjUyMTkgNTIuMDg1NSAxNS4wOTU0IDUyLjAwMDQgMTQuNzU0MyA1MS45MTUzQzEzLjIxOTEgNTEuMzE5NiAxMi40NTE1IDQ5LjYxNzUgMTMuMDQ4NSA0OC4wODU1TDI2LjQzOSAxMy43ODc3QzI3LjAzNiAxMi4yNTU4IDI4Ljc0MTggMTEuNDg5OCAzMC4yNzcgMTIuMDg1NUMzMS44MTIyIDEyLjY4MTMgMzIuNTc5OCAxNC4zODM0IDMxLjk4MjggMTUuOTE1M0wxOC42Nzc2IDUwLjIxMzJDMTguMjUxMiA1MS40MDQ3IDE3LjA1NzEgNTIuMDg1NSAxNS44NjMgNTIuMDg1NVpNMzUuMDUzNCA0Ny43NDQ1QzM1LjY1MDQgNDguMzQwMyAzNi40MTggNDguNTk1NiAzNy4xODU2IDQ4LjU5NTZDMzcuOTUzMiA0OC41OTU2IDM4LjcyMDggNDguMzQwMyAzOS4zMTc5IDQ3Ljc0NDVMNDkuODA4NSAzNy4zNjE2QzUxLjY4NDkgMzUuNDg5MiA1MS42ODQ5IDMyLjM0MDMgNDkuODA4NSAzMC40NjhMMzkuMzE3OSAxOS45OTk5QzM4LjIwOTEgMTguODA4NCAzNi4zMzI3IDE4LjgwODQgMzUuMTM4NiAxOS45OTk5QzMzLjk0NDYgMjEuMTA2MyAzMy45NDQ2IDIyLjk3ODYgMzUuMTM4NiAyNC4xNzAxTDQ0Ljc3NjQgMzMuODcyMkwzNS4wNTM0IDQzLjU3NDNDMzMuODU5MyA0NC42ODA3IDMzLjg1OTMgNDYuNTUzMSAzNS4wNTM0IDQ3Ljc0NDVaIiBmaWxsPSIjYTdhYWFkIi8+PC9zdmc+';
	
	add_menu_page('php-code', 'PHP Code', 'manage_options', 'php-code-manage','php_code_snippets', $phpCodeIcon);
		add_submenu_page('php-code-manage', 'PHPCode - Add', 'Add PHP', 'manage_options', 'php-code-add' ,'php_code_add');
		add_submenu_page('php-code-manage', 'PHPCode - Manage settings', 'Settings', 'manage_options', 'php-code-settings' ,'php_code_settings');	
}

function php_code_snippets(){
	$formflag = 0;
	if(isset($_GET['action']) && $_GET['action']=='snippet-delete' )
	{
		include(dirname( __FILE__ ) . '/snippet-delete.php');
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-edit' )
	{
		include(dirname( __FILE__ ) . '/snippet-edit.php');
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-add' )
	{	
		require( dirname( __FILE__ ) . '/snippet-add.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-status' )
	{
		require( dirname( __FILE__ ) . '/snippet-status.php' );
		$formflag=1;
	}
	if($formflag == 0){
		require( dirname( __FILE__ ) . '/snippets.php' );
	}
}

function php_code_settings()
{
	require( dirname( __FILE__ ) . '/settings.php' );
	
}

function php_code_add()
{
	?> <script>
		document.location.href="<?php echo admin_url('admin.php?page=php-code-manage&action=snippet-add');?>"
	</script> <?php
	
}

function xyz_ips_add_style_script(){

	wp_enqueue_script('jquery');
	
	wp_register_script( 'xyz_notice_script', plugins_url ('js/notice.js' , PHP_CODE_ROOT ));
	wp_enqueue_script( 'xyz_notice_script' );
	
	// Register stylesheets
	wp_register_style('xyz_ips_style', plugins_url('css/xyz_ips_styles.css', PHP_CODE_ROOT));
	wp_enqueue_style('xyz_ips_style');
}
add_action('admin_enqueue_scripts', 'xyz_ips_add_style_script');

?>