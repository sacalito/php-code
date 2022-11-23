<?php
if ( ! defined( 'ABSPATH' ) )
    exit;

global $wpdb;
// Load the options
if(!$_POST && isset($_GET['ips_notice'])&& $_GET['ips_notice'] == 'hide'){
    if (! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'],'ips-shw')){
        wp_nonce_ays( 'ips-shw');
        exit;
    }
    update_option('xyz_ips_dnt_shw_notice', "hide");
?>
<style type='text/css'>
    #ips_notice_td{
        display:none !important;
    }
</style>
<?php
}

if($_POST){
    if (! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'ips-psetting_' )) {
        wp_nonce_ays( 'ips-psetting_' );
        exit;
    }
    else{
        $_POST=xyz_trim_deep($_POST);
        $_POST = stripslashes_deep($_POST);

        $xyz_ips_pre_ads = intval($_POST['xyz_ips_pre_ads']);
        $php_code_limit = abs(intval($_POST['php_code_limit']));

        if($php_code_limit==0)$php_code_limit=200;

        $php_code_auto_insert = intval($_POST['php_code_auto_insert']);
        update_option('php_code_auto_insert',$php_code_auto_insert);

        $php_code_auto_exception = intval($_POST['php_code_auto_exception']);
        update_option('php_code_auto_exception',$php_code_auto_exception);

        $php_code_exception_email=sanitize_text_field($_POST['php_code_exception_email']);
        update_option('php_code_exception_email',$php_code_exception_email);

        $xyz_ips_sortfield=sanitize_text_field($_POST['xyz_ips_sort_by_field']);

        if(($xyz_ips_sortfield=="id")||($xyz_ips_sortfield=="title"))
            update_option('php_code_sort_field_name',$xyz_ips_sortfield);

        $xyz_ips_sortorder=sanitize_text_field($_POST['xyz_ips_sort_by_order']);

        if(($xyz_ips_sortorder=="asc")||($xyz_ips_sortorder=="desc"))
            update_option('php_code_sort_order',$xyz_ips_sortorder);

        update_option('php_code_limit',$php_code_limit);
?>
<div class="xyz_system_notice_area_style1" id="xyz_system_notice_area">
    Settings updated successfully. &nbsp;&nbsp;&nbsp;
    <span id="xyz_system_notice_area_dismiss">Dismiss</span>
</div>
<?php
    }
}
?>
<script type="text/javascript">

	jQuery(document).ready(function() {
		changeAutoException();

	});

	if(typeof changeAutoException == 'undefined')
	{
		function changeAutoException()
		{
			var auto_exception=jQuery("#php_code_auto_exception").val();

			if(auto_exception==1) {
				jQuery("#php_code_exception_email_tr").show();
			}
			else {
				jQuery("#php_code_exception_email_tr").hide();
			}
		}

	}
</script>
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
                            <label for="xyz_ihs_sort">Sorting of snippets</label>
                        </td>
                        <td>
                            <select id="xyz_ips_sort_by_field" name="xyz_ips_sort_by_field"  >
                                <option value="id" <?php if(isset($_POST['xyz_ips_sort_by_field']) && $_POST['xyz_ips_sort_by_field']=='id'){echo 'selected';} else if(get_option('php_code_sort_field_name')=="id"){echo 'selected';} ?>>Based on create time</option>
                                <option value="title" <?php if(isset($_POST['xyz_ips_sort_by_field']) && $_POST['xyz_ips_sort_by_field']=='title'){ echo 'selected';}else if(get_option('php_code_sort_field_name')=="title"){echo 'selected';} ?>>Based on name</option>
                            </select>
                            &nbsp;
                            <select id="xyz_ips_sort_by_order" name="xyz_ips_sort_by_order"  >
                                <option value="desc" <?php if(isset($_POST['xyz_ips_sort_by_order']) && $_POST['xyz_ips_sort_by_order']=='desc'){echo 'selected';} else if(get_option('php_code_sort_order')=="desc"){echo 'selected';} ?>>Descending</option>
                                <option value="asc" <?php if(isset($_POST['xyz_ips_sort_by_order']) && $_POST['xyz_ips_sort_by_order']=='asc'){ echo 'selected';}else if(get_option('php_code_sort_order')=="asc"){echo 'selected';} ?>>Ascending</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td scope="row" class="settingInput" id="">
                            <label for="php_code_limit">Pagination limit</label>
                        </td>
                        <td id="">
                            <input  name="php_code_limit" type="text"
                            id="php_code_limit" value="<?php if(isset($_POST['php_code_limit']) ){echo abs(intval($_POST['php_code_limit']));}else{print(get_option('php_code_limit'));} ?>" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <td scope="row">
                            <label for="php_code_auto_insert">Autoinsert PHP opening tags</label>
                        </td>
                        <td>
                            <select name="php_code_auto_insert" id="php_code_auto_insert">
                                <option value="0" <?php selected(get_option('php_code_auto_insert'),0);?>>Disable</option>
                                <option value="1" <?php selected(get_option('php_code_auto_insert'),1);?>>Enable</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td scope="row">
                            <label for="php_code_auto_exception">Enabling automatic exception handling for PHP snippets</label>
                        </td>
                        <td>
                            <select name="php_code_auto_exception" id="php_code_auto_exception">
                                <option value="0" <?php selected(get_option('php_code_auto_exception'),0);?>>Disable</option>
                                <option value="1" <?php selected(get_option('php_code_auto_exception'),1);?>>Enable</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top" id="php_code_exception_email_tr" style="display:none;">
                                        <td scope="row">
                                            <label for="php_code_exception_email">Email address for sending exception report</label>
                                        </td>
                                        <td>
                                          <input  name="php_code_exception_email" type="text" id="php_code_exception_email" value="<?php if(isset($_POST['php_code_exception_email']) ){echo esc_attr($_POST['php_code_exception_email']);}else{if(get_option('php_code_exception_email')!="0"){echo esc_attr(get_option('php_code_exception_email'));}} ?>" />

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
