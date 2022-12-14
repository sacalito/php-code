<?php
if ( ! defined( 'ABSPATH' ) )
    exit;


if($_POST){
    if (! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'php-code-psetting_' )) {
        wp_nonce_ays( 'php-code-psetting_' );
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
    <div style='background: white; padding:15px; margin: 10px; border-radius:20px; margin-top:40px;'>
        <span style='color:red;'>Document Root: </span> <input type="text" value="<?php echo $_SERVER['DOCUMENT_ROOT'].'/'; ?>" readonly>
    </div>

    <form method="post">
        <?php wp_nonce_field('php-code-psetting_');?>
        <div style="float: left;width: 98%">
            <fieldset style=" width:100%; border:3px solid black; padding:10px 0px 15px 10px;">
                <legend ><h2 style='color:blue;'>Settings</h2></legend>

                <div style='background: white; padding:15px; margin: 10px; border-radius:20px;'>
                    <label for="xyz_ihs_sort">PHP Code Include Path: </label>
                    <input style='width: 300px;' name="php_code_include_path" type="text" id="php_code_include_path" value="<?php print(get_option('php_code_include_path')); ?>" />
                    <input style="margin:10px 0 20px 0;" id="submit" class="button-primary xyz_ips_bottonWidth" type="submit" value=" Update Settings " />
                </div>

            </fieldset>
        </div>
    </form>
</div>
<br style='clear:both;'>

<?php

