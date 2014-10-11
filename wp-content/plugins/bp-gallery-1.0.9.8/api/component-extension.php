<?php
/* 
 * Extend Bp gallery
 * allow to add to other components(other than group&profile)
 */
//is gallery enabled for component
//$component_type:component_id eg(groups,xprofile,events etc) defined by bp->The component->id
function bp_is_gallery_enabled_for($component_type){
    //if($component_type=="groups")
      //  return false;
       return apply_filters("is_gallery_enabled_for_".$component_type,1);//hook to is_gallery_enabled_for_groups
      
}
function gallery_is_enabled_for_current_item(){
  global $bp;
  $ret=true;//assume it is enabled

  if(bp_is_active("groups")&&bp_is_group()){
      if(bp_is_gallery_enabled_for("groups")&&!bp_gallery_is_disabled_for_group())
        $ret= true;
      else
          $ret=false;
  }
  
  return apply_filters("gallery_is_enabled_for_current_item",$ret);//handle other case using filter
  
}
function bp_gallery_add_to_component($component_id){

 add_filter("is_gallery_enabled_for_".$component_id,  create_function('', 'return 1'));//enable for the component
 
 //fix te template tags to list appropriate media, may be linked etc
 
}

/**
 * @desc allow developers to hook gallery with their component, check whether current component has gallery allowed or not
 * @global <type> $bp
 * @return <type>
 * This will not work when the slug for component is changed, so leaving it for 1.1
 */
function bp_component_has_gallery_allowed(){
     global $bp;
          if(in_array($bp->current_component,bp_gallery_get_allowed_components()))
             return true;
   return false;

}
/**
 * @desc allow developers to extend and associate gallery with their component
 * @return <array mixed> array of the component slugs
 */
function bp_gallery_get_allowed_components(){
        $allowed_components=array(BP_GROUPS_SLUG);//currently only group
        return apply_filters("gallery_get_allowed_components", $allowed_components);
}
/**
 * @desc Get the current owner object Id for gallery, can be $group id or displayed user id or event id or current gallery Id in case of single standalone gallery
 * @global <type> $bp
 * @param <type> $component
 * @param <type> $current
 * @return <type>
 */
function gallery_get_current_object_id($component_id=null){/** component Id: $bp->groups->id="groups"/"user"/etc etc */
  global $bp;
  $owner_id=$bp->loggedin_user->id;
   /* let the hook do the magic*, other components use this hook for providing ids*/
  return apply_filters("get_gallery_owner_id",$owner_id);//context sensitive dd

}
/**
 * @desc Return the type of current component, USER/GALLERY/GROUP
 * @global <type> $bp
 * @param <type> $owner_type
 * @return <type>
 */
function gallery_get_current_object_type(){
   return strtolower(apply_filters("gallery_owner_type","user"));//context sensitive
}


function gallery_total_gallery_for_owner( $owner_type=null,$owner_id = null ,$access=false) {
	global $bp;

	if(!$owner_type)
            $owner_type=gallery_get_current_object_type();//context sensitive dd
        if(!$owner_id)
            $owner_id=gallery_get_current_object_id();//context sensitive dd

$access=gallery_get_current_user_access($owner_type,$owner_id);
 if(empty($access))
     $access=array("public");//only public galleries

 return BP_Gallery_Gallery::total_gallery_count($owner_type, $owner_id,$access );
}
function bp_gallery_is_method_enabled($method,$gallery){
 return apply_filters("bp_gallery_is_method_enabled",true,$method,$gallery);
}

?>