<?php
//for group gallery, change permalink for home url of gallery
add_filter("bp_get_groups_gallery_permalink", "bp_gallery_groups_gallery_permalink", 10, 2);

function bp_gallery_groups_gallery_permalink($link, $gallery) {
    global $bp;
    $group = new BP_Groups_Group($gallery->owner_object_id, false, false);
    $group_url = bp_get_group_permalink($group);
    return $group_url . BP_GALLERY_SLUG . "/" . $gallery->slug;
}

add_filter("groups_gallery_home_url", "gallery_groups_gallery_home_url");

function gallery_groups_gallery_home_url() {
    global $bp;
    $group = $bp->groups->current_group;
    $gallery_link = bp_get_group_permalink($group) . BP_GALLERY_SLUG;

    return $gallery_link;
}
/** filter the url of current group* */
add_filter("gallery_current_groups_link", "gallery_get_current_group_link");

function gallery_get_current_group_link($link) {
    //ignore the link
    global $bp, $groups_template;
    $group = ( $groups_template->group ) ? $groups_template->group : $bp->groups->current_group;
    $link = bp_get_group_permalink($group);
    return $link;
}



//owner type for groups
add_filter("gallery_owner_type", "gallery_owner_type_for_group");

function gallery_owner_type_for_group($owner_type) {
    global $bp;
    if (bp_is_group ())
        return $bp->groups->id;

    return $owner_type;
}

//owner id
add_filter("get_gallery_owner_id", "gallery_owner_id_for_group"); //won't work in ajax mode

function gallery_owner_id_for_group($owner_id) {
    global $bp;
    if (bp_is_group ())
        return $bp->groups->current_group->id;

    return $owner_id;
}



?>