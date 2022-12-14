<?php 
/*
Plugin Name: Sacalito's PHP Code 
Plugin URI: https://sacalito.com
Description: Insert PHP code from local files.     
Version: 2.0.0
Author: Sacalito
Author URI: https://sacalito.com
Text Domain: php-code
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) )
	 exit;

define('PHP_CODE_ROOT',__FILE__);

require( dirname( __FILE__ ) . '/install.php' );

require( dirname( __FILE__ ) . '/php-code-functions.php' );

require( dirname( __FILE__ ) . '/shortcode-handler.php' );

require( dirname( __FILE__ ) . '/menu.php' );

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'php_code_settings_link');
function php_code_settings_link( $links ) {
	$links[] = '<a href="'.admin_url( 'admin.php?page=php-code-manage' ).'">'. __('Settings').'</a>';
	return $links;
}