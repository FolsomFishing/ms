<?php
/*
  Plugin Name: ZWoom - WooCommerce Product Image Zoom
  Plugin URI:  http://wordpress.org/extend/plugins/zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs/
  Description: Woocommerce Zoom Product image extension allows users to zoom product image on hover.
  Author: WisdmLabs, Thane, India
  Author URI:http://wisdmlabs.com
  License: GPLv2 or later
  Version: 1.0.7
  Network: true
 */
/**
 * The plugin methods will not be changed until a new release of wordpress.
 * @api
 * @author WisdmLabs, Thane, India
 * @copyright 2012-2013 WisdmLabs
 * @license GPL
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
add_action('woocommerce_after_single_product', 'enqueuezoomscript');

add_action('wp_ajax_get_ids_of_all_attachments', 'get_ids_of_all_attachments_callback');
add_action('wp_ajax_nopriv_get_ids_of_all_attachments', 'get_ids_of_all_attachments_callback');

function change_values_in_array(&$item, $key)
{
   $item = "'".$item."'";
}
function get_ids_of_all_attachments_callback()
{
      global $wpdb;
      $extract_all_urls = explode(':::::', $_POST['all_links']);
      $extract_all_urls = array_unique(array_filter($extract_all_urls));
      $copy_of_extract_all_urls = $extract_all_urls;
      $abc = array_walk($extract_all_urls, 'change_values_in_array');
      $the_single_url = join(', ', $extract_all_urls);
      $get_new_urls = array();
      $query_to_be_run = "SELECT DISTINCT ID from $wpdb->posts WHERE guid IN ($the_single_url)";
      $postids = $wpdb->get_col($query_to_be_run);
      if ($postids)
      {
         $temp_counter = 0;
         foreach ($postids as $single_post_id)
         {
            $image_attributes = wp_get_attachment_image_src( $single_post_id, 'shop_single');
            $get_new_urls[] = $image_attributes[0] . '|||||' . $copy_of_extract_all_urls[$temp_counter];
            $temp_counter++;
         }
      }
      echo join(':::::', $get_new_urls);
      die(); // this is required to return a proper result
}

 function enqueuezoomscript()
 {
   global $woocommerce_settings;
    if(!is_admin())
    {
      global $post;
      $original_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'shop_thumbnail');
      $orginal_image_src_for_zoom = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'full');
      $original_image_single_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'shop_single');
      wp_register_script( 'original_zoom', plugins_url('/jquery.zoom_.js', __FILE__), array('jquery'), false, true );
     wp_enqueue_script('original_zoom');
     wp_register_script( 'bxsliderjs', plugins_url('/jquery.bxSlider_2.js', __FILE__), array('jquery'), false, true );
     wp_enqueue_script('bxsliderjs');
                wp_register_script( 'enqueuezoomjs', plugins_url('/swap_images.js', __FILE__), array('jquery'), false, true );
     wp_enqueue_script('enqueuezoomjs');
     wp_register_style( 'bxslidercss', plugins_url('/jquery.bxslider.css', __FILE__) );
     wp_enqueue_style('bxslidercss');
     $array_to_be_sent = array('sourceimageurl' => $original_image_src[0] , 'previous_image' => plugins_url('/images/prev.png', __FILE__), 'next_image' => plugins_url('/images/next.png', __FILE__), 'thumbnail_image_height' => get_option('woocommerce_thumbnail_image_height'), 'thumbnail_image_width' => get_option('woocommerce_thumbnail_image_width'), 'single_image_width' => get_option('woocommerce_single_image_width') , 'single_image_height' => get_option('woocommerce_single_image_height'), 'admin_ajax_url' => admin_url('admin-ajax.php'), 'sourceimageurlforzoom' => $orginal_image_src_for_zoom[0], 'sourceimagesinglesrc' => $original_image_single_src[0], 'zoomleveloption' => get_option('woocommerce_zoom_option'));
     wp_localize_script( 'enqueuezoomjs', 'object_name', $array_to_be_sent );
    }
}

add_filter('woocommerce_catalog_settings' , 'wisdm_add_new_setting', 10, 1);


function wisdm_add_new_setting($tab)
{
   $count_of_available_setting = array_search(array(
		'name' => __( 'Single Product Image', 'woocommerce' ),
		'desc' 		=> __('This is the size used by the main image on the product page.', 'woocommerce'),
		'id' 		=> 'woocommerce_single_image',
		'css' 		=> '',
		'type' 		=> 'image_width',
		'std' 		=> '300',
		'desc_tip'	=>  true,
	), $tab);
   
   $object = array(
                     'name' => __( 'Zoom Level', 'woocommerce' ), 
                     'type' => 'text',
                     'desc' => __('Set the on hover zoom level for Single Product Image. Default value is 2. If value inserted is non numeric, it will consider the default value. To disable zooming, set this value to 1'),
                     'id' => 'woocommerce_zoom_option',
                     'std' => '2',
                     'css' => 'width:30px;',
                     'desc_tip'=>  true
               );
   $tab = array_merge( array_slice($tab, 0, ((int)$count_of_available_setting + 1)), array($object) ,array_slice($tab, ((int)$count_of_available_setting + 1)));
   return $tab;
}

add_action('admin_menu', 'wisdm_add_new_submenu_page');

function wisdm_add_new_submenu_page ()
{
   add_options_page( 'Zoom Extension Settings', 'Zoom Extension', 'manage_woocommerce_products', 'zoom-extension-plugin', 'zoom_extension_plugin_options_page');
}

if ((isset($_GET['page']) && $_GET['page'] == 'zoom-extension-plugin'))
    {
        add_action('admin_print_scripts', 'wdm_zoom_extension_scripts');
        add_action('admin_print_styles', 'wdm_zoom_extension_styles');
    }

function wdm_zoom_extension_styles()
{
   wp_register_style('tip-tip-style' , plugins_url("tipTip.css" , __FILE__));
   wp_enqueue_style('tip-tip-style');
}

function wdm_zoom_extension_scripts()
{
   wp_enqueue_script('jquery');
   wp_register_script('tip-tip-script' , plugins_url("jquery.tipTip.js" , __FILE__), array('jquery'));
   wp_enqueue_script('tip-tip-script');
}

function wp_mail_content_type_function(){
	return "text/html";
}

function zoom_extension_plugin_options_page()
{
   /*** Showing Settins Saved Message ***/
   if ($_POST && $_POST['submit_zoom_level_option'] == 'Submit' && !empty($_POST['zoom_level_option']) && (filter_var($_POST['zoom_level_option'], FILTER_VALIDATE_INT) !== FALSE))
   {
      update_option('woocommerce_zoom_option', $_POST['zoom_level_option']);
      ?>
      <div class="updated fade"><p style="font-weight:bold">Settings Saved.</p></div>
   <?php }
   elseif($_POST && $_POST['submit_zoom_level_option'] == 'Submit' && empty($_POST['zoom_level_option']))
   {?>
      <div class="error"><p style="font-weight:bold">Empty value can not be saved. Setting Zoom level to default value.</p></div>
   <?php }
   elseif($_POST && $_POST['submit_zoom_level_option'] == 'Submit' && filter_var($_POST['zoom_level_option'], FILTER_VALIDATE_INT) === FALSE)
   {?>
      <div class="error"><p style="font-weight:bold">Error while saving settings. Filter value must be an integer.</p></div>
   <?php }
   
   /*** Emailing Enhancement form ***/
   if ($_REQUEST['requirement_button'] == 'Send Requirement' && !empty($_REQUEST['enhancement_details']) && !empty($_REQUEST['customer_name']) && !empty($_REQUEST['customer_email']) && filter_var($_REQUEST['customer_email'],FILTER_VALIDATE_EMAIL))
	    {
		add_filter('wp_mail_content_type','wp_mail_content_type_function');
		apply_filters( 'wp_mail_charset', 'UTF-8' );
		$headers[] = "From: {$_REQUEST['customer_name']} <{$_REQUEST['customer_email']}>";
		$headers[] = 'Cc: WisdmLabs <info@wisdmlabs.com>';
		$website_name = get_bloginfo('name');
		$website_url = get_bloginfo('url');
		$subject = "Requirement from {$_REQUEST['customer_name']} : Website - {$website_name}";
		$message = "<b><a href='mailto:{$_REQUEST['customer_email']}' target='_blank'>{$_REQUEST['customer_name']}</a></b> ({$_SERVER["REMOTE_ADDR"]}) is contacting via Woocommerce Zoom Extension plugin enhancement form.
			   <br /><br />
			   Website - <a target=\"_blank\" href=\"$website_url\">{$website_name}</a>
			   <br /><br />
			   Email address - <a href='mailto:{$_REQUEST['customer_email']}' target='_blank'>{$_REQUEST['customer_email']}</a>
			   <br /><br />" .  $_REQUEST['enhancement_details'];
		if(wp_mail('sumit@wisdmlabs.com', $subject, $message, $headers))
		{
		echo '<div class="updated fade"><p style="font-weight:bold">Thank you for Sending us details. WisdmLabs will contact you soon. :-)</p></div>';
		}
		else
		{
	       echo '<div class="error"><p style="font-weight:bold">Error while sending a mail. Please check if your SMTP settings are correct and you are allowed to send emails.</p></div>';
		}
		remove_filter('wp_mail_content_type', 'wp_mail_content_type_function');
	    }
   
   elseif ($_REQUEST['requirement_button'] == 'Send Requirement' && !empty($_REQUEST['customer_email']) && !filter_var($_REQUEST['customer_email'],FILTER_VALIDATE_EMAIL))
   { ?>
      <div class="error"><p style="font-weight:bold">Mail Can not be sent. Please check the email address provided.</p></div>
   <?php }
   elseif($_REQUEST['requirement_button'] == 'Send Requirement' && (empty($_REQUEST['customer_email']) || empty($_REQUEST['enhancement_details']) || !empty($_REQUEST['customer_name'])))
	  {?>
	    <div class="error"><p style="font-weight:bold">Mail Can not be sent. Please check if all fields are filled.</p></div>
	  <?php }
   if ($_REQUEST['requirement_button'] != 'Send Requirement' || empty($_REQUEST['enhancement_details']) || empty($_REQUEST['customer_name']) || empty($_REQUEST['customer_email']) || !filter_var($_REQUEST['customer_email'],FILTER_VALIDATE_EMAIL))
   { ?>
   <script type="text/javascript">
      jQuery(document).ready(function(){
         document.getElementById('customer_name').value = "<?php echo $_REQUEST['customer_name']?>";
	 document.getElementById('customer_email').value = "<?php echo $_REQUEST['customer_email']?>";
	 document.getElementById('enhancement_details').value = "<?php echo $_REQUEST['enhancement_details']?>";
      });
   </script>
      
   <?php }
   ?>
   <script type="text/javascript">
      jQuery(document).ready(function(){
	 jQuery("#wisdmlabs-logo").load(function(){
	    jQuery(".inside").height(jQuery("#wisdmlabs_enhancement_form").height()+60);
	 })
         jQuery(".tiptobeshown").tipTip();
      });
   </script>
   <style type="text/css">
      .error, .updated {
	 margin-left: 0 !important;
      }
   </style>
   <div class="wrap">
      <div id="poststuff" class="metabox-holder">
			<div class="postbox">
				<h3 class="hndle" style="cursor: default"><span>Zoom Extension Settings Page</span>
				<form action='https://www.paypal.com/cgi-bin/webscr' method='post' style="float: right; margin-top: -2px;">
				       <input type='hidden' name='cmd' value='_donations'>
				       <input type='hidden' name='business' value='info@wisdmlabs.com'>
				       <input type='hidden' name='lc' value='IN'>
				       <input type='hidden' name='item_name' value='WisdmLabs'>
				       <input type='hidden' name='no_note' value=''>
				       <input type='hidden' name='currency_code' value='USD'>
				       <input type='hidden' name='bn' value='PP-DonationsBF:btn_donate_SM.gif:NonHostedGuest'>
				       <input type='image' src='https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif' border='0' name='submit' style="margin-top: 0px; margin-bottom: 0px; width: 67px; padding-top: 0px; padding-bottom: 0px;" alt='PayPal The safer, easier way to pay online.'>
				       <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1' />
				 </form>
				</h3>
				<div class="inside">
                                <div id="left-side" style="float: left; margin-top: 17px;">
                                 <form action="" method="POST">
                                    <label for="edit-zoom-level">
                                    Zoom Level <img src="<?php echo plugins_url("help.png" , __FILE__)?>" class="tiptobeshown" title="Set the on hover zoom level for Single Product Image. Default value is 2. If value inserted is non numeric, it will consider the default value. To disable zooming, set this value to 1" style="width: 11px; height: 11px;"/>
                                    :</label>
                                       <input id="edit-zoom-level" name="zoom_level_option" type="text" value="<?php echo get_option('	woocommerce_zoom_option', '2')?>">
                                    <input type="submit" class="button" name="submit_zoom_level_option" value="Submit" onclick="var numberregex = /\D/i; if(document.getElementById('edit-zoom-level').value.match(numberregex)) {alert(document.getElementById('edit-zoom-level').value + ' is not a valid number. Please enter only natural number in Zoom Level field'); return false} if(document.getElementById('edit-zoom-level').value == '') {alert('Zoom Level field can not be left empty. Please fill value in this field'); return false}"/>
                                 </form>
                                </div>
                                <div style="float: right; border-top-left-radius:10px; border-bottom-right-radius:10px;width:28%;float:right;border: 3px solid #CCCCCC;margin-top:10px;padding:10px;padding-top:4px;" id="wisdmlabs_enhancement_form">
                                    <div style="text-align: center">
				    <a target="_blank" href="http://wisdmlabs.com"><img id="wisdmlabs-logo" src="<?php echo plugins_url('images/wisdmlabs_logo.png' , __FILE__ ) ?>" style="width:175px" /></a>
				    </div>
				    <span style="color:maroon; text-align: center">Rate this plugin <a href="http://wordpress.org/support/view/plugin-reviews/zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs" target="_blank">here</a></span><br /><br />
				    Need support for this plugin? Feel free to open a ticket <a href="http://wordpress.org/support/plugin/zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs" target="_blank">here</a>.
				    <br /><br />
				    <b>New Requirement Form: </b>
                                    <br />
                                    Have suggestions for plugin enhancement or a new requirement? Please submit the exact details in the form below.<br />
                                    <form autocomplete="on" method="post" id="enhancement-form" action="">
                                    <input type="text" class="required" id="customer_name" name="customer_name" style="width:100%" placeholder="Your Name Here" />
                                    <input type="text" class="email required" id="customer_email" name="customer_email" style="width:100%" placeholder="Your Email ID Here" />
                                    <textarea name="enhancement_details" id="enhancement_details" cols="35" rows="15" class="required" style="width:100%" placeholder="Your Requirements Here" class="required"></textarea>
                                    <input style="margin-top:10px" type="submit" class="button-primary" value="Send Requirement" name="requirement_button" />
                                    </div>
				</div>
				
			</div>
		</div>
   </div>
<?php } ?>