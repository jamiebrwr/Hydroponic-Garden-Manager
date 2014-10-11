<?php
/*
 * These functions are used when a gallery is associated with group
 *
 */

if (bp_is_gallery_enabled_for("groups")){
    //load extension files
  
    require ( BP_GALLERY_PLUGIN_DIR . 'ext/groups/filters.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'ext/groups/permissions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'ext/groups/template-tags.php' );
    //hook it to system
    //inconsistency in name in bp 1.5 beta, should be fixed in beta 2, till then, I will add 2 actions to solve the issue here
    //this action if for bp 1.5 beta 1(Inconsistent naming)
    add_action("bp_groupssetup_nav", "gallery_nav_for_group", 11); //delay this to make sure gallery is configured
    
    //should work with bp 1.5 beta 2
    add_action("bp_groups_setup_nav", "gallery_nav_for_group", 11); //delay this to make sure gallery is configured
    add_action('bp_screens', 'setup_gallery_for_group',1);
    add_action('bp_screens', 'gallery_handle_group_gallery_actions',4);
  
}

function gallery_nav_for_group() {
    global $bp;
    
    $access=isset($bp->groups->current_group->user_has_access)?$bp->groups->current_group->user_has_access:true;

    
    $component_link =trailingslashit( bp_get_root_domain() . '/' . $bp->groups->root_slug . '/' . $bp->groups->current_group->slug );//; bp_get_group_permalink($bp->groups->current_group);
    $component_slug = $bp->groups->slug;
    
 
       bp_core_new_subnav_item( array( 'name' => __( 'Group Galleries', 'bp-gallery' ), 'slug' => 'group-galleries', 'parent_url' => $bp->loggedin_user->domain . $bp->groups->slug . '/', 'parent_slug' => $bp->groups->slug, 'screen_function' => 'gallery_screen_my_group_galleries', 'position' => 40, 'user_has_access' => bp_is_my_profile() ) );
if(bp_is_group ()&&!bp_gallery_is_disabled_for_group())
    bp_core_new_subnav_item(array('name' => sprintf(__('Gallery <span>%d</span>', 'bp-gallery'), gallery_total_gallery_for_owner()), 'slug' => $bp->gallery->slug, 'parent_url' => $component_link, 'parent_slug' => $bp->groups->current_group->slug, 'screen_function' => 'gallery_screen_group_gallery_home', 'user_has_access' => $access, 'position' => 25, 'item_css_id' => 'associated-gallery-home'));
}

/* * setup variables for group gallery */

function setup_gallery_for_group() {
   
    global $bp, $groups_template;
if(bp_gallery_is_disabled_for_group())
    return false;

    $group = isset( $groups_template->group ) ? $groups_template->group : $bp->groups->current_group;

    if (bp_is_groups_component() && $bp->current_action == $bp->gallery->slug) {
        
        
        $bp->gallery->is_associated_gallery = true;
        $bp->gallery->is_group_gallery = true;
       
        //now check whether we are at group gallery home/ other page
        if (empty($bp->action_variables) || gallery_is_valid_gallery_type($bp->action_variables[0]))
            $bp->gallery->is_home = true;
        else {
            /** * setup conditional variables* */
            //check for the first action variable
            $current_action = $bp->action_variables[0]; //we are sure thgis can not be empty
          
            
            if ($current_action == "upload")
                $bp->gallery->is_upload_screen = true;

            else if ($current_action == "create" && user_can_create_gallery($bp->groups->id, $group->id))
                $bp->gallery->is_create_screen = true;
            //don't worry about others those were handled by gallery_setup_nav
        }
    }
}
function gallery_screen_my_group_galleries(){
  //for my group galleries
  global $bp;

   $bp->gallery->is_my_group_gallery = true;
    bp_core_load_template(apply_filters('gallery_template_group_my_galleries', 'gallery/index'));
}
function gallery_handle_group_gallery_actions() {
    global $bp, $groups_template;
    if (bp_is_groups_component() && $bp->current_action == $bp->gallery->slug) {
        if (empty($bp->action_variables))
            return;
        $group = ( $groups_template->group ) ? $groups_template->group : $bp->groups->current_group;

        if ($bp->action_variables[0] == "create")
            gallery_action_create_gallery("groups", $group->id);

        else if ($bp->action_variables[0] == "upload")
            gallery_action_upload_media("groups", $group->id);
    }
}

/* * ********************* Screen functions************************* */
/* * ************ Group Gallery Screen function********* */

function gallery_screen_group_gallery_home() {
    global $bp;
    bp_core_load_template(apply_filters('gallery_template_group_gallery_home', 'gallery/index'));
}


add_action("groups_delete_group", "gallery_delete_galleries_for_group"); //group id

function gallery_delete_galleries_for_group($group_id) {
    BP_Gallery_Gallery::delete_gallery_for_group($group_id);
}


/*** allow admins to activate/deactivate gallery for a group**/


add_action("bp_before_group_settings_admin","bp_gallery_group_disable_form");
add_action("bp_before_group_settings_creation_step","bp_gallery_group_disable_form");
//check if the group yt is enabled
function bp_gallery_group_disable_form(){
    if(!bp_is_gallery_enabled_for("groups"))
        return;//do not show if gallery is not enabled for group component
    ?>
    <div class="checkbox">
	<label><input type="checkbox" name="group-disable-gallery" id="group-disable-gallery" value="1" <?php if(bp_gallery_is_disabled_for_group()):?> checked="checked"<?php endif;?>/> <?php _e( 'Disable Gallery', 'bp-gallery' ) ?></label>
    </div>
<?php

}

add_action("groups_group_settings_edited","bp_gallery_save_group_prefs");
add_action("groups_create_group","bp_gallery_save_group_prefs");
add_action("groups_update_group","bp_gallery_save_group_prefs");

function bp_gallery_save_group_prefs($group_id){
      $disable=$_POST["group-disable-gallery"];
      groups_update_groupmeta($group_id, "bp_gallery_disabled", $disable);
}
//save the group admin settings

function bp_gallery_is_disabled_for_group($group_id=null){
    global $bp;
    if(empty($group_id))
        $group_id=$bp->groups->current_group->id;
    return groups_get_groupmeta($group_id,"bp_gallery_disabled");//is disabled
    
}

?>