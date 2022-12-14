<?php
if ( ! defined( 'ABSPATH' ) )
    exit;

function php_code_display_content($php_code_short_code){

    if(is_array($php_code_short_code)){
        if(isset($php_code_short_code['include'])){
            
            $php_code_include_file = $php_code_short_code['include'].".php";
            $php_code_include_path = get_option('php_code_include_path');
            $php_code_file_to_include = $php_code_include_path.$php_code_include_file;

            if(file_exists($php_code_file_to_include)){
                include_once $php_code_file_to_include;
            }else {
                ?>Sorry i could not find File: <?php echo $php_code_file_to_include; ?><?php
            }
        }else {
            ?>Missing include Parameter for PHP Code Short Code<?php
            print("<pre>".print_r($php_code_short_code,true)."</pre>");
        }
    }
}

add_shortcode('php-code','php_code_display_content');
add_filter('widget_text', 'do_shortcode');
