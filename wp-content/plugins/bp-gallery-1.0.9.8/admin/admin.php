<?php
/* 
 * BP Gallery Admin functions base file
 * 
 */

/*for gallery settings in the backend*/
/*********** Gallery Admin backend settings*********/
//improve //move to gallery-admin.php
function gallery_admin_settings(){

if(isset($_POST["gallery-settings-save"]))
    {

        //for allowed type
        $allowed_type=array();
        if(!empty($_POST["gallery_media_buttons"]["photo"]))
            $allowed_type["photo"]=__("Photo","bp-gallery");
        if(!empty($_POST["gallery_media_buttons"]["video"]))
            $allowed_type["video"]=__("Video","bp-gallery");
        if(!empty($_POST["gallery_media_buttons"]["audio"]))
            $allowed_type["audio"]=__("Audio","bp-gallery");
       //  print_r($allowed_type);
        update_site_option("gallery_allowed_type",$allowed_type);

        $media_settings=gallery_get_media_size_settings();
            if(!empty($_POST["gallery_thumb_size_w"]))
                $media_settings["thumb"]['width']=$_POST["gallery_thumb_size_w"];
            if(!empty($_POST["gallery_thumb_size_h"]))
                $media_settings["thumb"]['height']=$_POST["gallery_thumb_size_h"];

          if(!empty($_POST["gallery_medium_size_w"]))
                $media_settings["mid"]['width']=$_POST["gallery_medium_size_w"];

          if(!empty($_POST["gallery_medium_size_h"]))
                $media_settings["mid"]['height']=$_POST["gallery_medium_size_h"];

   if(!empty($_POST["gallery_large_size_w"]))
                $media_settings["larger"]['width']=$_POST["gallery_large_size_w"];

          if(!empty($_POST["gallery_large_size_h"]))
                $media_settings["larger"]['height']=$_POST["gallery_large_size_h"];

  //for upload space
  if(!empty($_POST['gallery_upload_space']))
    update_site_option('gallery_upload_space',$_POST['gallery_upload_space']);
if(!empty($_POST['gallery_upload_space_groups']))
    update_site_option('gallery_upload_space_groups',$_POST['gallery_upload_space_groups']);
    //max upload size
    if(!empty($_POST['gallery_fileupload_maxk']))
    update_site_option('gallery_fileupload_maxk',$_POST['gallery_fileupload_maxk']);


    //enable/disable directory nav
   // if(!empty ($_POST["gallery_enable_directory_link"]))
       // update_site_option("gallery_enable_directory_link", $_POST["gallery_enable_directory_link"]);
    if(!empty ($_POST["gallery_debug_mode"]))
        update_site_option("gallery_debug_mode", $_POST["gallery_debug_mode"]);
    if(!empty ($_POST["gallery_enable_flash_uploader"]))
        update_site_option("gallery_enable_flash_uploader", $_POST["gallery_enable_flash_uploader"]);
    
    if(!empty ($_POST["show_upload_quota"]))
        update_site_option("show_upload_quota", $_POST["show_upload_quota"]);
    if(!empty($_POST["enable_activity_upload"]))
            update_site_option("enable_activity_upload", $_POST["enable_activity_upload"]);

update_site_option("gallery_media_size",$media_settings);
//activity publishing settings
$activity_settings=bp_gallery_get_activity_publishing_settings();

$activity_settings['is_batch']=$_POST['gallery_enable_bulk_publishing']=='y'?true:false;
$activity_settings['is_automatic']=$_POST['gallery_enable_automatic_publishing']=='y'?true:false;
if(!empty($_POST['gallery_max_media_count_activity']))
    $activity_settings['max_media_count']=$_POST['gallery_max_media_count_activity'];
update_site_option("gallery_publishing_settings",$activity_settings);
$message=__("Settings Updated.","bp-gallery");
 }

?>
    <?php if ( isset( $message ) ) { ?>
        <div id="message" class="updated fade">
            <p><?php echo $message ?></p>
	</div>
    <?php }
    $activity_settings=bp_gallery_get_activity_publishing_settings();
    ?>

    <div class="wrap" style="position: relative">
	<h2><?php _e( 'Gallery Settings', 'bp-gallery' ) ?></h2>
        <form action="" method="post">
        <h3><?php _e("General Settings",'bp-gallery');?></h3>
        <table class="form-table">
            <tr valign="top">
		<th scope="row"><?php _e('Allowed Gallery Types','bp-gallery') ?></th>
		<?php $gallery_allowed_media = gallery_get_allowed_gallery_types();?>
                <td><label><input type='checkbox' id="gallery_media_buttons_photo" name="gallery_media_buttons[photo]" value='1' <?php if( $gallery_allowed_media[ 'photo' ] ) { echo 'checked=checked '; } ?>/> <?php _e( 'Photo','bp-gallery' ); ?></label><br />
		    <label><input type='checkbox' id="gallery_media_buttons_video" name="gallery_media_buttons[video]" value='1' <?php if( $gallery_allowed_media[ 'video' ] ) { echo 'checked=checked '; } ?>/> <?php _e( 'Videos','bp-gallery' ); ?></label><br />
		    <label><input type='checkbox' id="gallery_media_buttons_audio" name="gallery_media_buttons[audio]" value='1' <?php if( $gallery_allowed_media[ 'audio' ] ) { echo 'checked=checked '; } ?>/> <?php _e( 'Audio','bp-gallery' ); ?></label><br />
		    <p><?php _e("Use this to enable/disable a gallery type.eg. uncheck audio to disable audio gallery creation.",'bp-gallery');?></p>
                </td>
            </tr>

	    <tr valign="top">
                    <th scope="row"><?php _e('Maximum upload space per User','bp-gallery') ?></th>
                    <td><input name="gallery_upload_space" type="text" id="gallery_upload_space" value="<?php echo gallery_get_space_allowed(null,'user'); ?>" size="3" /> MB</td>
            </tr>
            <tr valign="top">
                    <th scope="row"><?php _e('Maximum upload space per Group','bp-gallery') ?></th>
                    <td><input name="gallery_upload_space_groups" type="text" id="gallery_upload_space_groups" value="<?php echo gallery_get_space_allowed(null,'groups'); ?>" size="3" /> MB</td>
            </tr>

            <tr valign="top">
		<th scope="row"><?php _e('Max upload file size for media','bp-gallery') ?></th>
		<td><input name="gallery_fileupload_maxk" type="text" id="gallery_fileupload_maxk" value="<?php echo gallery_get_max_media_size(false); ?>" size="5" /> KB</td>
	     </tr>

            
             <tr valign="top">
		<th scope="row"><?php _e('Enable Uploads from Activity Stream.','bp-gallery') ?></th>
		<td>
                        <label><input name="enable_activity_upload" type="radio" value="y" <?php if(gallery_is_activity_stream_upload_enabled()) echo 'checked="checked"';?> /> <?php _e("Yes","bp-gallery");?></label>
                        <label><input name="enable_activity_upload" type="radio" value="n" <?php if(!gallery_is_activity_stream_upload_enabled()) echo 'checked="checked"';?> /> <?php _e("No","bp-gallery");?></label>

                </td>
	     </tr>
             <tr valign="top">
		<th scope="row"><?php _e('Automatic Publishing to activity settings','bp-gallery') ?></th>
		<td>
                        <label><input name="gallery_enable_automatic_publishing" type="radio" value="y" <?php if($activity_settings['is_automatic']) echo 'checked="checked"';?> /> <?php _e("Yes","bp-gallery");?></label>
                        <label><input name="gallery_enable_automatic_publishing" type="radio" value="n" <?php if(!$activity_settings['is_automatic']) echo 'checked="checked"';?> /> <?php _e("No","bp-gallery");?></label>

                </td>
	     </tr>
             <tr valign="top">
		<th scope="row"><?php _e('Activity publishing(bulk publishing or individual media publishing)','bp-gallery') ?></th>
		<td>
                        <label><input name="gallery_enable_bulk_publishing" type="radio" value="y" <?php if($activity_settings['is_batch']) echo 'checked="checked"';?> /> <?php _e("Yes","bp-gallery");?></label>
                        <label><input name="gallery_enable_bulk_publishing" type="radio" value="n" <?php if(!$activity_settings['is_batch']) echo 'checked="checked"';?> /> <?php _e("No","bp-gallery");?></label>

                </td>
	     </tr>
             <tr valign="top">
		<th scope="row"><?php _e('How many items to be published to activity(If bulk publishing is enabled)','bp-gallery') ?></th>
		<td><input name="gallery_max_media_count_activity" type="text" id="gallery_max_media_count_activity" value="<?php echo $activity_settings['max_media_count']; ?>" size="5" /></td>
	     </tr>
             
             <tr valign="top">
		<th scope="row"><?php _e('Enable Debug Mode','bp-gallery') ?></th>
		<td>
                        <label><input name="gallery_debug_mode" type="radio" value="y" <?php if(bp_gallery_is_debug_mode()) echo 'checked="checked"';?> /> <?php _e("Yes","bp-gallery");?></label>
                        <label><input name="gallery_debug_mode" type="radio" value="n" <?php if(!bp_gallery_is_debug_mode()) echo 'checked="checked"';?> /> <?php _e("No","bp-gallery");?></label>

                </td>
	     </tr>
             <tr valign="top">
		<th scope="row"><?php _e('Enable Flash Uploader','bp-gallery') ?></th>
		<td>
                        <label><input name="gallery_enable_flash_uploader" type="radio" value="y" <?php if(bp_gallery_is_flash_uploader_enabled()) echo 'checked="checked"';?> /> <?php _e("Yes","bp-gallery");?></label>
                        <label><input name="gallery_enable_flash_uploader" type="radio" value="n" <?php if(!bp_gallery_is_flash_uploader_enabled()) echo 'checked="checked"';?> /> <?php _e("No","bp-gallery");?></label>

                </td>
	     </tr>
             <tr valign="top">
		<th scope="row"><?php _e('Show Available upload space to Users','bp-gallery') ?></th>
		<td>
                        <label><input name="show_upload_quota" type="radio" value="y" <?php if(bp_gallery_show_upload_quota()) echo 'checked="checked"';?> /> <?php _e("Yes","bp-gallery");?></label>
                        <label><input name="show_upload_quota" type="radio" value="n" <?php if(!bp_gallery_show_upload_quota()) echo 'checked="checked"';?> /> <?php _e("No","bp-gallery");?></label>

                </td>
	     </tr>

       </table>


        <h3><?php _e('Image sizes','bp-gallery') ?></h3>
        <p><?php _e('The sizes listed below determine the maximum dimensions in pixels to use to resize images when uploading Image to gallery.','bp-gallery'); ?></p>
        <?php $settings=gallery_get_media_size_settings();//returns array of aary ;?>
        <table class="form-table">
            <tr valign="top">
                 <th scope="row"><?php _e('Thumbnail size','bp-gallery') ?></th>
                 <td>
                    <label for="gallery_thumb_size_w"><?php _e('Width','bp-gallery'); ?></label>
                    <input name="gallery_thumb_size_w" type="text" id="gallery_thumb_size_w" value="<?php echo $settings['thumb']['width']; ?>" class="small-text" />
                    <label for="gallery_thumb_size_h"><?php _e('Height','bp-gallery'); ?></label>
                    <input name="gallery_thumb_size_h" type="text" id="gallery_thumb_size_h" value="<?php echo $settings['thumb']['height']; ?>" class="small-text" /><br />
                  </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Medium size','bp-gallery') ?></th>
                <td><fieldset><legend class="screen-reader-text"><span><?php _e('Medium size'); ?></span></legend>
                    <label for="gallery_medium_size_w"><?php _e('Max Width','bp-gallery'); ?></label>
                    <input name="gallery_medium_size_w" type="text" id="gallery_medium_size_w" value="<?php echo $settings['mid']['width']; ?>" class="small-text" />
                    <label for="gallery_medium_size_h"><?php _e('Max Height','bp-gallery'); ?></label>
                    <input name="gallery_medium_size_h" type="text" id="gallery_medium_size_h" value="<?php echo $settings['mid']['height']; ?>" class="small-text" />
                    </fieldset>
               </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Large size') ?></th>
                <td><fieldset><legend class="screen-reader-text"><span><?php _e('Large size','bp-gallery'); ?></span></legend>
                    <label for="gallery_large_size_w"><?php _e('Max Width','bp-gallery'); ?></label>
                    <input name="gallery_large_size_w" type="text" id="gallery_large_size_w" value="<?php echo $settings['larger']['width']; ?>" class="small-text" />
                    <label for="gallery_large_size_h"><?php _e('Max Height','bp-gallery'); ?></label>
                    <input name="gallery_large_size_h" type="text" id="gallery_large_size_h" value="<?php echo $settings['larger']['height']; ?>" class="small-text" />
                    </fieldset>
                </td>
            </tr>

<?php do_settings_fields('gallery', 'default'); ?>
</table>

<?php do_settings_sections('gallery'); ?>
    <p class="submit">
        <input type="submit" name="gallery-settings-save" class="button-primary" value="<?php esc_attr_e('Save Settings','bp-gallery') ?>" />
    </p>
</form>
</div>
<?php

}

?>