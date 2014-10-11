<?php
/* media helper functions
 *
 * */



/******************* Upload space etc**********************************/
/**** Stats and space related functions*/
/*
  Determines if the available space defined by the admin has been exceeded by the user
 * args:
 * @owner_type: the Owner Object type of gallery can be USER,GALLERY/GROUP or custom extendable by plugins
 * @owner_id: ID of the Owner object of this gallery
 */
function gallery_check_available_space($owner_type,$owner_id) {
	$spaceAllowed = gallery_get_space_allowed($owner_id,$owner_type);//how much
	$size = gallery_get_used_space($owner_type,$owner_id);
        if( ($spaceAllowed - $size) <= 0 )
		return false;

    return true;
}

/**
 * get how much space is allowed to the user,user specific settings are stored in usermeta if any
 * retun <int> space in MB( e.g 10 means 10 MB)
 */
function gallery_get_space_allowed($owner_id=null,$owner_type=null) {
    
    if(!empty($owner_id)){
        if($owner_type=="user")
            $space_allowed=get_user_meta($owner_id,"gallery_upload_space",true);
        else if($owner_type=="groups")
            $space_allowed=groups_get_groupmeta ($owner_id,"gallery_group_space");
    }

    if(empty($owner_id)||empty($space_allowed)){
        //if owner id is empty
        //get the gallery/group space
        if($owner_type=="user")
          $space_allowed = get_site_option("gallery_upload_space");
        else if($owner_type=="groups")
             $space_allowed = get_site_option("gallery_upload_space_groups");
    }
   
//we should have some value by now
    
    //if( empty($space_allowed))
     ///   $space_allowed = get_option("gallery_upload_space");//currently let us deal with blog space gallery will have it's own limit later
    if( empty($space_allowed ) )
            $space_allowed = get_site_option("gallery_upload_space");
	if( empty($space_allowed) || !is_numeric($space_allowed) )
		$space_allowed = 10;//by default

	return apply_filters("gallery_allowed_space",$space_allowed,$owner_type,$owner_id);//allow to override for specific users/groups
}



/**
 * get How much space is used by the owner
 * @param <string> $owner_type:user/groups/componentname
 * @param <int> $owner_id :user_id,group_id or so on
 * @return <float> size in MB
 */
function gallery_get_used_space($owner_type,$owner_id){
     $dirName = trailingslashit(bp_gallery_get_owner_base_dir($owner_type,$owner_id));//base gallery directory for owner
    if (!(is_dir($dirName) && is_readable($dirName)))
		return;
    $dir = dir($dirName);
        $size = 0;

    while($file = $dir->read()) {
        if ($file != '.' && $file != '..') {
		if (is_dir( $dirName . $file)) {
				$size += get_dirsize($dirName . $file);
			} else {
				$size += filesize($dirName . $file);
			}
		}
	}
    $dir->close();
    $size = $size / 1024 / 1024;
return $size;
}

/**
 *  display a message for how much space has been used by the gallery owner
 */

function gallery_display_space_usage($owner_type=null,$owner_id=null) {
   global $bp;
    if(!(bp_is_my_profile()||$bp->is_item_admin)||!bp_gallery_show_upload_quota())
            return false;


        if(!$owner_type)
            $owner_type=gallery_get_current_object_type();
        if(!$owner_id)
            $owner_id=gallery_get_current_object_id();
        
        $space =gallery_get_space_allowed($owner_id,$owner_type);
        $dir=bp_gallery_get_owner_base_dir($owner_type,$owner_id);


        $used = gallery_get_used_space($owner_type,$owner_id);
        //    echo $used;
	if ($used > $space) $percentused = '100';
	else $percentused = ( $used / $space ) * 100;

	if( $space > 1000 ) {
		$space = number_format( $space / 1024 );
		$space .= __('GB');
	} else {
		$space .= __('MB');
	}
	?>
	<strong><?php printf(__('You have <span> %1s%%</span> of your %2s space left','bp-gallery'), number_format(100-$percentused), $space );?></strong>
	<?php
}




/*
 * Not used in gallery currently
 */
// Display File upload quota on Gallery dashboard,Orig code:Donncha, modified for gallery by @sbrajesh
function gallery_dashboard_quota($owner_type=null,$owner_id=null) {
   global $bp;
	$quota = gallery_get_space_allowed($owner_id,$owner_type);
	$used = gallery_get_used_space($owner_type,$owner_id);

	if ($used > $quota) $percentused = '100';
	else $percentused = ( $used / $quota ) * 100;
	$percentused = number_format($percentused);
	$used = round($used,2);
	$used_color = ($used < 70) ? (($used >= 40) ? 'waiting' : 'approved') : 'spam';
	?>

	<div class="table space-stats">
    <p class="sub musub"><?php _e("Storage Space"); ?></p>
	<table>
		<tr class="first">
			<td class="first"><?php  echo $quota . __('MB'); ?></td>
			<td class="t posts"><?php _e('Space Allowed'); ?></td>
          </tr>
          <tr>
			<td class="b b-comments"><?php echo $used .'MB '. $percentused .'%'; ?></td>
			<td class="used <?php echo $used_color;?>"><?php _e('Space Used');?></td>
		</tr>
	</table>
	</div>
	<?php
}

?>