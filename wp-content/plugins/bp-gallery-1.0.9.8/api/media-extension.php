<?php
/* 
 * Extend media capability, allow to add new type of media
 * 
 */
function bp_gallery_add_media_type($args){
 //we need
 //type
 //extension
 //slug
$media_type=new BP_Gallery_Media_Type();
 //label=>array('single_name'=>'PDF','plurals'=>'PDF Documents');
 add_filter("gallery_allowed_type",array(&$media_type,"extend_types"));//extend types
 add_filetr("gallery_allowed_type_plurals",array(&$media_type,"extend_plurals"));
 
 //developer will have to handle privacy themself...
}
?>