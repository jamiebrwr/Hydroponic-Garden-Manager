<?php

function bp_get_group_media_upload_link($gallery_id=null) {
    global $bp, $groups_template;
    $group = ( $groups_template->group ) ? $groups_template->group : $bp->groups->current_group;
    $link = bp_get_group_permalink($group) . $bp->gallery->slug . "/upload?_wpnonce=" . wp_create_nonce('upload-media-form');
    if ($gallery_id)
        $link.="&gallery_id=" . $gallery_id;
    return apply_filters("bp_get_media_upload_link", $link);
}

/**
 * @desc the gallery admin tabs for group gallery
 */
function bp_group_gallery_admin_tabs($group = false) {
    global $bp, $groups_template;

    if (!$group)
        $group = ( $groups_template->group ) ? $groups_template->group : $bp->groups->current_group;
    $current_tab =  bp_action_variable(0);
    $group_url = bp_get_group_permalink($group);
   
?>

    <li<?php if ('galleries' == $current_tab || empty($current_tab)) : ?> class="current"<?php endif; ?>><a href="<?php echo $group_url; ?>gallery/"><?php _e('Galleries', 'bp-gallery') ?></a></li>
<?php if (user_can_create_gallery("groups", $group->id)): ?>
            <li<?php if ('create' == $current_tab) : ?> class="current"<?php endif; ?>><a id="gallery_create" href="<?php echo bp_get_gallery_create_link('groups'); ?>"><?php _e('Create Gallery', 'bp-gallery') ?></a></li>
<?php endif; ?>

<?php if (gallery_is_valid_gallery_type("photo")): ?>
                    <li<?php if ('photo' == $current_tab) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url(); ?>/photo"> <?php _e("Photo", "bp-gallery"); ?></a></li>
<?php endif; ?>

<?php if (gallery_is_valid_gallery_type("video")): ?>
                            <li<?php if ('video' == $current_tab) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url(); ?>/video"> <?php _e("Video", "bp-gallery"); ?></a></li>
<?php endif; ?>

<?php if (gallery_is_valid_gallery_type("audio")): ?>
                                    <li<?php if ('audio' == $current_tab) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url(); ?>/audio"> <?php _e("Audio", "bp-gallery"); ?></a></li>
<?php endif; ?>

<?php do_action('groups_gallery_admin_tabs', $current_tab, $group->slug) ?>
<?php
         }


?>