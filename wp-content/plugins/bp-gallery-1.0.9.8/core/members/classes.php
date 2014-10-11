<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*manage users and gallery relationship*/
Class BP_Gallery_Member {
	var $id;
	var $gallery_id;
	var $user_id;
        var $user_title;
	var $inviter_id;
	var $is_admin;
	var $is_mod;
        var $can_upload;
        var $can_view;
	var $is_banned;
	var $is_confirmed;
	var $invite_sent;
        var $date_updated;
	var $user;

	function bp_gallery_member( $user_id = false, $gallery_id = false, $id = false, $populate = true ) {
		if ( $user_id && $gallery_id && !$id ) {
			$this->user_id = $user_id;
			$this->gallery_id = $gallery_id;

			if ( $populate )
				$this->populate();
		}

		if ( $id ) {
			$this->id = $id;

			if ( $populate )
				$this->populate();
		}
	}

	function populate() {
		global $wpdb, $bp;

		if ( $this->user_id && $this->gallery_id && !$this->id )
			$sql = $wpdb->prepare( "SELECT * FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d", $this->user_id, $this->gallery_id );

		if ( $this->id )
			$sql = $wpdb->prepare( "SELECT * FROM {$bp->gallery->table_gallery_users} WHERE id = %d", $this->id );

		$member = $wpdb->get_row($sql);

		if ( $member ) {
			$this->id = $member->id;
			$this->gallery_id = $member->gallery_id;
			$this->user_id = $member->user_id;
                        $this->user_title=$member->user_title;
			$this->inviter_id = $member->inviter_id;
			$this->is_admin = $member->is_admin;
			$this->is_mod = $member->is_mod;
                        $this->can_upload=$member->can_upload;
                        $this->can_view=$member->can_view;
			$this->is_banned = $member->is_banned;
			$this->is_confirmed = $member->is_confirmed;
			$this->invite_sent = $member->invite_sent;
                        $this->date_updated = strtotime($member->date_updated);
			$this->user = new BP_Core_User( $this->user_id );//store current user info
		}
	}

	function save() {
		global $wpdb, $bp;

		$this->user_id = apply_filters( 'gallery_user_user_id_before_save', $this->user_id, $this->id );
		$this->gallery_id = apply_filters( 'gallery_user_gallery_id_before_save', $this->gallery_id, $this->id );
		$this->inviter_id = apply_filters( 'gallery_user_inviter_id_before_save', $this->inviter_id, $this->id );
		$this->user_title = apply_filters( 'gallery_user_user_title_before_save', $this->user_title, $this->id );

                $this->is_admin = apply_filters( 'gallery_user_is_admin_before_save', $this->is_admin, $this->id );
		$this->is_mod = apply_filters( 'gallery_user_is_mod_before_save', $this->is_mod, $this->id );
		$this->is_banned = apply_filters( 'gallery_user_is_banned_before_save', $this->is_banned, $this->id );
		$this->can_upload = apply_filters( 'gallery_user_can_upload_before_save', $this->can_upload, $this->id );
		$this->can_view = apply_filters( 'gallery_user_can_view_before_save', $this->can_view, $this->id );
		$this->is_confirmed = apply_filters( 'gallery_user_is_confirmed_before_save', $this->is_confirmed, $this->id );
		$this->invite_sent = apply_filters( 'gallery_user_invite_sent_before_save', $this->invite_sent, $this->id );
                $this->date_updated = apply_filters( 'gallery_user_date_updated_before_save', $this->date_updated, $this->id );
		do_action( 'gallery_user_before_save', $this );

		if ( $this->id ) {
			$sql = $wpdb->prepare( "UPDATE {$bp->gallery->table_gallery_users} SET inviter_id = %d, is_admin = %d, is_mod = %d, is_banned = %d,user_title= %s, can_upload = %d, can_view= %d, is_confirmed = %d, invite_sent = %d, date_updated = FROM_UNIXTIME(%d), WHERE id = %d", $this->inviter_id, $this->is_admin, $this->is_mod, $this->is_banned,$this->user_title, $this->can_upload,$this->can_view, $this->is_confirmed, $this->invite_sent, $this->date_updated, $this->id );
		} else {
			$sql = $wpdb->prepare( "INSERT INTO {$bp->gallery->table_gallery_users} ( user_id, gallery_id, inviter_id, is_admin, is_mod, is_banned,user_title, can_upload, can_view ,  is_confirmed,  invite_sent,date_updated ) VALUES ( %d, %d, %d, %d, %d, %d, %s, %d, %d, %d,%d, FROM_UNIXTIME(%d))", $this->user_id, $this->gallery_id, $this->inviter_id, $this->is_admin, $this->is_mod, $this->is_banned, $this->user_title,$this->can_upload,$this->can_view, $this->is_confirmed,  $this->invite_sent, $this->date_updated );
		}
     
		if ( !$wpdb->query($sql) )
			return false;

		$this->id = $wpdb->insert_id;

		do_action( 'gallery_users_after_save', $this );

		return true;
	}

	function promote( $status = 'mod' ) {
		if ( 'mod' == $status ) {
                        $this->can_upload=1;
			$this->is_admin = 0;
			$this->is_mod = 1;
			$this->user_title = __( 'Gallery Mod', 'bp-gallery' );
		}

		if ( 'admin' == $status ) {
			$this->is_admin = 1;
			$this->is_mod = 0;
                        $this->can_upload=1;
			$this->user_title = __( 'Gallery Admin', 'bp-gallery' );
		}
                if ( 'contributor' == $status ) {
                        $this->is_admin = 0;
			$this->is_mod = 1;
			$this->can_upload=1;
			$this->user_title = __( 'Gallery Contributor', 'bp-gallery' );
		}

		return $this->save();
}

function demote() {
		$this->is_mod = 0;
		$this->is_admin = 0;
                $this->can_upload=0;
		$this->user_title = false;

		return $this->save();
}

function ban() {
            if ( $this->is_admin )
                return false;

		$this->is_mod = 0;
		$this->is_banned = 1;
                return $this->save();
}

function unban() {
	if ( $this->is_admin )
		return false;

	$this->is_banned = 0;

	return $this->save();
}

function accept_invite() {
        $this->inviter_id = 0;
        $this->is_confirmed = 1;
        $this->date_updated = time();
}

function accept_request() {
        $this->is_confirmed = 1;
        $this->date_updated = time();
}

/* Static Functions */

function delete( $user_id, $gallery_id, $check_empty = true ) {
    global $wpdb, $bp;

    $delete_result = $wpdb->query( $wpdb->prepare( "DELETE FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d", $user_id, $gallery_id ) );

    return $delete_result;
}

function get_gallery_ids( $user_id, $limit = false, $page = false ) {
    global $wpdb, $bp;

    if ( $limit && $page )
	$pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );

    // If the user is logged in and viewing their own gallery, we can show hidden and private gallery
    if ( bp_is_my_profile() ) {
	$gallery_sql = $wpdb->prepare( "SELECT DISTINCT gallery_id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND inviter_id = 0 AND is_banned = 0{$pag_sql}", $user_id );
	$total_galleries = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT gallery_id) FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND inviter_id = 0 AND is_banned = 0", $user_id ) );
	}
    else {
	$gallery_sql = $wpdb->prepare( "SELECT DISTINCT m.gallery_id FROM {$bp->gallery->table_gallery_users} m, {$bp->gallery->table_galleries_data} g WHERE m.gallery_id = g.id AND g.status != 'hidden' AND m.user_id = %d AND m.inviter_id = 0 AND m.is_banned = 0{$pag_sql}", $user_id );
	$total_galleries = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT m.gallery_id) FROM {$bp->gallery->table_gallery_users} m, {$bp->gallery->table_galleries} g WHERE m.gallery_id = g.id AND g.status != 'hidden' AND m.user_id = %d AND m.inviter_id = 0 AND m.is_banned = 0", $user_id ) );
	}

    $galleries = $wpdb->get_col( $gallery_sql );
    return array( 'galleries' => $galleries, 'total' => (int) $total_galleries );
}

	

function get_is_admin_of( $user_id, $limit = false, $page = false, $filter = false ) {
    global $wpdb, $bp;

    if ( $limit && $page )
	$pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );

    if ( $filter ) {
	$filter = like_escape( $wpdb->escape( $filter ) );
        $filter_sql = " AND ( g.name LIKE '{$filter}%%' OR g.description LIKE '{$filter}%%' )";
	}

    if ( !bp_is_my_profile() )
        $hidden_sql = " AND g.status != 'hidden'";

    $paged_galleries = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT m.gallery_id FROM {$bp->gallery->table_gallery_users} m, {$bp->gallery->table_galleries_data} g WHERE m.gallery_id = g.id{$hidden_sql}{$filter_sql} AND m.user_id = %d AND m.inviter_id = 0 AND m.is_banned = 0 AND m.is_admin = 1 ORDER BY date_updated ASC {$pag_sql}", $user_id ) );
    $total_galleries = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT m.gallery_id) FROM {$bp->gallery->table_gallery_users} m, {$bp->gallery->table_galleries_data} g WHERE m.gallery_id = g.id{$hidden_sql}{$filter_sql} AND m.user_id = %d AND m.inviter_id = 0 AND m.is_banned = 0 AND m.is_admin = 1 ORDER BY date_updated ASC", $user_id ) );
    return array( 'galleries' => $paged_galleries, 'total' => $total_galleries );
}

function get_is_mod_of( $user_id, $limit = false, $page = false, $filter = false ) {
    global $wpdb, $bp;
    if ( $limit && $page )
	$pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );

    if ( $filter ) {
	$filter = like_escape( $wpdb->escape( $filter ) );
	$filter_sql = " AND ( g.name LIKE '{$filter}%%' OR g.description LIKE '{$filter}%%' )";
	}

    if ( !bp_is_my_profile() )
	$hidden_sql = " AND g.status != 'hidden'";
	$paged_galleries = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT m.gallery_id FROM {$bp->gallery->table_gallery_users} m, {$bp->gallery->table_galleries_data} g WHERE m.gallery_id = g.id{$hidden_sql}{$filter_sql} AND m.user_id = %d AND m.inviter_id = 0 AND m.is_banned = 0 AND m.is_mod = 1 ORDER BY date_updated ASC {$pag_sql}", $user_id ) );
	$total_galleries = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT m.gallery_id) FROM {$bp->gallery->table_gallery_users} m, {$bp->gallery->table_galleries_data} g WHERE m.gallery_id = g.id{$hidden_sql}{$filter_sql} AND m.user_id = %d AND m.inviter_id = 0 AND m.is_banned = 0 AND m.is_mod = 1 ORDER BY date_updated ASC", $user_id ) );
	return array( 'galleries' => $paged_galleries, 'total' => $total_galleries);
}

function total_gallery_count( $user_id = false ) {
    global $bp, $wpdb;

    if ( !$user_id )
    $user_id = $bp->displayed_user->id;
    if ( bp_is_my_profile() ) {
	return $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT id) FROM {$bp->gallery->table_galleries_data} WHERE owner_object_id = %d and owner_object_type='user'", $user_id ) );
	}
    else {
	return $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT id) FROM {$bp->gallery->table_galleries_data}  WHERE status = 'public' AND WHERE owner_object_id = %d owner_object_type='user'", $user_id ) );
    }

}

function get_invites( $user_id ) {
    global $wpdb, $bp;

    $gallery_ids = $wpdb->get_results( $wpdb->prepare( "SELECT gallery_id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d and is_confirmed = 0 AND inviter_id != 0 AND invite_sent = 1", $user_id ) );
    return $gallery_ids;
}

function check_has_invite( $user_id, $gallery_id ) {
    global $wpdb, $bp;

    if ( !$user_id )
	return false;

return $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d AND is_confirmed = 0 AND inviter_id != 0 AND invite_sent = 1", $user_id, $gallery_id ) );
}

function delete_invite( $user_id, $gallery_id ) {
    global $wpdb, $bp;

    if ( !$user_id )
	return false;

    return $wpdb->query( $wpdb->prepare( "DELETE FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d AND is_confirmed = 0 AND inviter_id != 0 AND invite_sent = 1", $user_id, $gallery_id ) );
}

function check_is_admin( $user_id, $gallery_id) {
    global $wpdb, $bp;

    if ( !$user_id )
	return false;

    $q= $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d AND is_admin = 1 AND is_banned = 0 ", $user_id, $gallery_id ) ;
    return $wpdb->get_var($q);
}

function check_is_mod( $user_id, $gallery_id ) {
    global $wpdb, $bp;
    if ( !$user_id )
	return false;

    return $wpdb->query( $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d AND is_mod = 1 AND is_banned = 0", $user_id, $gallery_id ) );
}

function check_is_member( $user_id, $gallery_id ) {
    global $wpdb, $bp;
    if ( !$user_id )
	return false;
    return $wpdb->query( $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d AND is_confirmed = 1 AND is_banned = 0", $user_id, $gallery_id ) );
}

function check_is_contributor( $user_id, $gallery_id ) {
    global $wpdb, $bp;

    if ( !$user_id )
	return false;

    return $wpdb->get_var( $wpdb->prepare( "SELECT can_upload FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d", $user_id, $gallery_id ) );
}

function check_is_banned( $user_id, $gallery_id ) {
    global $wpdb, $bp;

    if ( !$user_id )
    	return false;

    return $wpdb->get_var( $wpdb->prepare( "SELECT is_banned FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d", $user_id, $gallery_id ) );
}

function check_for_membership_request( $user_id, $gallery_id ) {
    global $wpdb, $bp;
    if ( !$user_id )
	return false;
    return $wpdb->query( $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d AND gallery_id = %d AND is_confirmed = 0 AND is_banned = 0 AND inviter_id = 0", $user_id, $gallery_id ) );
}

	

function get_gallery_administrator_ids( $gallery_id ) {
    global $bp, $wpdb;
    return $wpdb->get_results( $wpdb->prepare( "SELECT user_id, date_updated FROM {$bp->gallery->table_gallery_users} WHERE gallery_id = %d AND is_admin = 1 AND is_banned = 0", $gallery_id ) );
}

function get_gallery_moderator_ids( $gallery_id ) {
	global $bp, $wpdb;

    return $wpdb->get_results( $wpdb->prepare( "SELECT user_id, date_updated FROM {$bp->gallery->table_gallery_users} WHERE gallery_id = %d AND is_mod = 1 AND is_banned = 0", $gallery_id) );
}

function get_all_membership_request_user_ids( $gallery_id ) {
    global $bp, $wpdb;
    return $wpdb->get_col( $wpdb->prepare( "SELECT user_id FROM {$bp->gallery->table_gallery_users} WHERE gallery_id = %d AND is_confirmed = 0 AND inviter_id = 0", $gallery_id ) );
}

function get_all_for_gallery( $gallery_id, $limit = false, $page = false, $exclude_admins_mods = true, $exclude_banned = true ) {
    global $bp, $wpdb;
    if ( $limit && $page )
        $pag_sql = $wpdb->prepare( "LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );
    if ( $exclude_admins_mods )
    	$exclude_sql = $wpdb->prepare( "AND is_admin = 0 AND is_mod = 0" );

    if ( $exclude_banned )
	$banned_sql = $wpdb->prepare( " AND is_banned = 0" );

    $members = $wpdb->get_results( $wpdb->prepare( "SELECT user_id, date_updated FROM {$bp->gallery->table_gallery_users} WHERE gallery_id = %d AND is_confirmed = 1 {$banned_sql} {$exclude_sql} {$pag_sql}", $gallery_id ) );

    if ( !$members )
	return false;

    if ( !isset($pag_sql) )
	$total_member_count = count($members);
    else
	$total_member_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(user_id) FROM {$bp->gallery->table_gallery_users} WHERE gallery_id = %d AND is_confirmed = 1 {$banned_sql} {$exclude_sql}", $gallery_id ) );

    return array( 'members' => $members, 'count' => $total_member_count );
}

function delete_all_for_user( $user_id ) {
    global $wpdb, $bp;
    return $wpdb->query( $wpdb->prepare( "DELETE FROM {$bp->gallery->table_gallery_users} WHERE user_id = %d", $user_id ) );
    //also, if the gallery of which user is owner, de;lete thoe gallery

    }
}//end of class BP_Gallery_Members



?>