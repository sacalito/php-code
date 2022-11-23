<?php
if ( ! defined( 'ABSPATH' ) )
    exit;


if($_POST){
    if (! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'ips-psetting_' )) {
        wp_nonce_ays( 'ips-psetting_' );
        exit;
    }
    else{
        $_POST = php_code_trim_deep($_POST);
        $_POST = stripslashes_deep($_POST);

        $php_code_include_path=sanitize_text_field($_POST['php_code_include_path']);
        update_option('php_code_include_path',$php_code_include_path);

        $php_code_document_root=sanitize_text_field($_POST['php_code_document_root']);
        update_option('php_code_document_root',$php_code_document_root);

?>
<div class="xyz_system_notice_area_style1" id="xyz_system_notice_area">
    Settings updated successfully. &nbsp;&nbsp;&nbsp;
    <span id="xyz_system_notice_area_dismiss">Dismiss</span>
</div>
<?php
    }
}
?>

<div>
    <form method="post">
        <?php wp_nonce_field('ips-psetting_');?>
        <div style="float: left;width: 98%">
            <fieldset style=" width:100%; border:1px solid #F7F7F7; padding:10px 0px 15px 10px;">
                <legend >
                	<h3>Settings</h3>
                </legend>
                <table class="widefat"  style="width:99%;">
                    <tr valign="top">
                        <td scope="row" >
                            <label for="xyz_ihs_sort">PHP Code Document Root</label>
                        </td>
                        <td>
                            <input  name="php_code_document_root" type="text" id="php_code_document_root" value="<?php print(get_option('php_code_document_root')); ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <td scope="row" >
                            <label for="xyz_ihs_sort">PHP Code Include Path</label>
                        </td>
                        <td>
                            <input  name="php_code_include_path" type="text" id="php_code_include_path" value="<?php print(get_option('php_code_include_path')); ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <td scope="row" class=" settingInput" id="xyz_ips_bottomBorderNone">
                        </td>
                        <td id="xyz_ips_bottomBorderNone">
                            <input style="margin:10px 0 20px 0;" id="submit" class="button-primary xyz_ips_bottonWidth" type="submit" value=" Update Settings " />
                        </td>
                    </tr>
                </table>
            </fieldset>
        </div>
    </form>
</div>
<br style='clear:both;'>

<?php

$dir = get_option('php_code_document_root').get_option('php_code_include_path');


//$r = scanDirs("$dir");

//pretty($r);
