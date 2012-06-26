<?php
/*
Plugin Name: Google Chrome Frame plugin for wordpress
Plugin URI: http://www.kankod.com/
Description: Enjoy the power of The Google Chrome V-8 Webkit Engine on old Internet Explorer browsers (version 6+). Google Chrome frame for Wordpress will prompt your Internet Explorer users to install the Google Chrome Frame add-on (automatically redirects back to your site when finished), this will let your old Internet Explorer users to benefit from the latest HTML5 standards as if they were running Google Chrome or other advances webkit browser.  
Version: 0.11
Author: kankod.com
*/

if( !is_admin() ) {
	add_action('wp_print_scripts', 'GCF_filter_footer');
}
add_action('admin_menu', 'GCF_config_page');

function GCF_filter_footer() {
	$enabled = get_option('GCF_EN');
	if ($enabled){
		wp_register_style( 'gcf',plugins_url('css/gcf.css', __FILE__));
		wp_enqueue_style( 'gcf' );
	
		wp_enqueue_script('GCF', 'http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js', false, false, true );
		wp_enqueue_script('gcfFuncs', plugins_url('js/GCF.js', __FILE__), false, false, true );		
	}
}

function GCF_config_page() {
	add_submenu_page('options-general.php', __('Google Chrome Frame for Wordpress'), __('Google Chrome Frame for Wordpress'), 'manage_options', 'GCF-key-config', 'GCF_config');
}

function GCF_config() {
	$GCF_enabled = get_option('GCF_EN');
	if ( isset($_POST['submit']) ) {
		if (isset($_POST['GCF_enabled']))
		{
			if ($_POST['GCF_enabled'] == 'on')
			{
				$GCF_enabled = 1;
			}
			else
			{
				$GCF_enabled = 0;
			}
		}
		else
		{
			$GCF_enabled = 0;
		}
		
		update_option('GCF_EN', $GCF_enabled);

		echo "<div id=\"updatemessage\" class=\"updated fade\"><p>Google Chrome Frame settings updated.</p></div>\n";
		echo "<script type=\"text/javascript\">setTimeout(function(){jQuery('#updatemessage').hide('slow');}, 3000);</script>";
			
	}
	?>
	<div class="wrap" style="width:99%;">
		<h2>Google Chrome Frame for WordPress Configuration</h2>
		<div class="postbox-container" style="width:100%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">
					<form action="" method="post" id="">
					<div id="" class="postbox">
						<div class="handlediv" title="Click to toggle"><br /></div>
						<h3 class="hndle"><span>Google Chrome Frame for wordpress Settings</span></h3>
						<div class="inside">
							<table class="form-table">
								<tr><th valign="top" scrope="row">Set Google Chrome Frame On/Off:</th>
								<td valign="top"><input type="checkbox" id="" name="GCF_enabled" <?php echo ($GCF_enabled ? 'checked="checked"' : ''); ?> /> <label for="enabled"></label><br/></td></tr>
							</table>
							<table>
																<tr>					<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fkankod&amp;width=292&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;border_color&amp;stream=false&amp;header=true&amp;appId=161452587293470" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;" allowTransparency="true"></iframe></tr>
							</table>
						</div>
					</div>
					<div class="submit"><input type="submit" class="button-primary" name="submit" value="Update Toolbar &raquo;" /></div>
					</form>
				</div>
			</div>
		</div>

	</div>
	<?php
} 
?>