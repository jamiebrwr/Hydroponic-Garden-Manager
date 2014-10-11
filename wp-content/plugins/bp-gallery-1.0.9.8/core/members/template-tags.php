<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/***************************************************************************
 * gallery Members Template Tags Mostly Inspirde by Bp_Groups_Members template ,almost has same functionality
 * This is not(partially) used and is not tested well for gallery beta 1
 **/

class BP_Gallery_Gallery_Members_Template {
	var $current_member = -1;
	var $member_count;
	var $members;
	var $member;

	var $in_the_loop;

	var $pag_page;
	var $pag_num;
	var $pag_links;
	var $total_gallery_count;

	function bp_gallery_gallery_members_template( $gallery_id, $per_page, $max, $exclude_admins_mods, $exclude_banned ) {
		global $bp;

		$this->pag_page = isset( $_REQUEST['mlpage'] ) ? intval( $_REQUEST['mlpage'] ) : 1;
		$this->pag_num = isset( $_REQUEST['num'] ) ? intval( $_REQUEST['num'] ) : $per_page;

		$this->members = Bp_Gallery_User::get_all_for_gallery( $gallery_id, $this->pag_num, $this->pag_page, $exclude_admins_mods, $exclude_banned );

		if ( !$max || $max >= (int)$this->members['count'] )
			$this->total_member_count = (int)$this->members['count'];
		else
			$this->total_member_count = (int)$max;

		$this->members = $this->members['members'];

		if ( $max ) {
			if ( $max >= count($this->members) )
				$this->member_count = count($this->members);
			else
				$this->member_count = (int)$max;
		} else {
			$this->member_count = count($this->members);
		}

		$this->pag_links = paginate_links( array(
			'base' => add_query_arg( 'mlpage', '%#%' ),
			'format' => '',
			'total' => ceil( $this->total_member_count / $this->pag_num ),
			'current' => $this->pag_page,
			'prev_text' => '&laquo;',
			'next_text' => '&raquo;',
			'mid_size' => 1
		));
	}

	function has_members() {
		if ( $this->member_count )
			return true;

		return false;
	}

	function next_member() {
		$this->current_member++;
		$this->member = $this->members[$this->current_member];

		return $this->member;
	}

	function rewind_members() {
		$this->current_member = -1;
		if ( $this->member_count > 0 ) {
			$this->member = $this->members[0];
		}
	}

	function members() {
		if ( $this->current_member + 1 < $this->member_count ) {
			return true;
		} elseif ( $this->current_member + 1 == $this->member_count ) {
			do_action('loop_end');
			// Do some cleaning up after the loop
			$this->rewind_members();
		}

		$this->in_the_loop = false;
		return false;
	}

	function the_member() {
		global $member;

		$this->in_the_loop = true;
		$this->member = $this->next_member();

		if ( 0 == $this->current_member ) // loop has just started
			do_action('loop_start');
	}
}

function bp_gallery_has_members( $args = '' ) {
	global $bp, $gallery_members_template;

	$defaults = array(
		'gallery_id' => $bp->galleries->current_gallery->id,
		'per_page' => 10,
		'max' => false,
		'exclude_admins_mods' => 1,
		'exclude_banned' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$gallery_members_template = new BP_Gallery_Gallery_Members_Template( $gallery_id, $per_page, $max, (int)$exclude_admins_mods, (int)$exclude_banned );
	return apply_filters( 'bp_gallery_has_members', $gallery_members_template->has_members(), $gallery_members_template );
}

function bp_gallery_members() {
	global $gallery_members_template;

	return $gallery_members_template->members();
}

function bp_gallery_the_member() {
	global $gallery_members_template;

	return $gallery_members_template->the_member();
}

function bp_gallery_member_avatar() {
	echo bp_get_gallery_member_avatar();
}
	function bp_get_gallery_member_avatar() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_avatar', bp_core_fetch_avatar( array( 'item_id' => $gallery_members_template->member->user_id, 'type' => 'full' ) ) );
	}

function bp_gallery_member_avatar_thumb() {
	echo bp_get_gallery_member_avatar_thumb();
}
	function bp_get_gallery_member_avatar_thumb() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_avatar_thumb', bp_core_fetch_avatar( array( 'item_id' => $gallery_members_template->member->user_id, 'type' => 'thumb' ) ) );
	}

function bp_gallery_member_avatar_mini( $width = 30, $height = 30 ) {
	echo bp_get_gallery_member_avatar_mini( $width, $height );
}
	function bp_get_gallery_member_avatar_mini( $width = 30, $height = 30 ) {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_avatar_mini', bp_core_fetch_avatar( array( 'item_id' => $gallery_members_template->member->user_id, 'type' => 'thumb', 'width' => $width, 'height' => $height ) ) );
	}

function bp_gallery_member_name() {
	echo bp_get_gallery_member_name();
}
	function bp_get_gallery_member_name() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_name', bp_core_get_user_displayname( $gallery_members_template->member->user_id ) );
	}

function bp_gallery_member_url() {
	echo bp_get_gallery_member_url();
}
	function bp_get_gallery_member_url() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_url', bp_core_get_userlink( $gallery_members_template->member->user_id, false, true ) );
	}

function bp_gallery_member_link() {
	echo bp_get_gallery_member_link();
}
	function bp_get_gallery_member_link() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_link', bp_core_get_userlink( $gallery_members_template->member->user_id ) );
	}

function bp_gallery_member_is_banned() {
	echo bp_get_gallery_member_is_banned();
}
	function bp_get_gallery_member_is_banned() {
		global $gallery_members_template, $galleries_template;

		return apply_filters( 'bp_get_gallery_member_is_banned', galleries_is_user_banned( $gallery_members_template->member->user_id, $galleries_template->gallery->id ) );
	}

function bp_gallery_member_joined_since() {
	echo bp_get_gallery_member_joined_since();
}
	function bp_get_gallery_member_joined_since() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_joined_since', bp_core_get_last_activity( strtotime( $gallery_members_template->member->date_modified ), __( 'joined %s ago', 'buddypress') ) );
	}

function bp_gallery_member_id() {
	echo bp_get_gallery_member_id();
}
	function bp_get_gallery_member_id() {
		global $gallery_members_template;

		return apply_filters( 'bp_get_gallery_member_id', $gallery_members_template->member->user_id );
	}

function bp_gallery_member_needs_pagination() {
	global $gallery_members_template;

	if ( $gallery_members_template->total_member_count > $gallery_members_template->pag_num )
		return true;

	return false;
}

function bp_gallery_pag_id() {
	echo bp_get_gallery_pag_id();
}
	function bp_get_gallery_pag_id() {
		global $bp;

		return apply_filters( 'bp_get_gallery_pag_id', 'pag' );
	}

function bp_gallery_member_pagination() {
	echo bp_get_gallery_member_pagination();
	wp_nonce_field( 'Bp_Gallery_User_list', '_member_pag_nonce' );
}
	function bp_get_gallery_member_pagination() {
		global $gallery_members_template;
		return apply_filters( 'bp_get_gallery_member_pagination', $gallery_members_template->pag_links );
	}

function bp_gallery_member_pagination_count() {
	echo bp_get_gallery_member_pagination_count();
}
	function bp_get_gallery_member_pagination_count() {
		global $gallery_members_template;

		$from_num = intval( ( $gallery_members_template->pag_page - 1 ) * $gallery_members_template->pag_num ) + 1;
		$to_num = ( $from_num + ( $gallery_members_template->pag_num - 1 ) > $gallery_members_template->total_member_count ) ? $gallery_members_template->total_member_count : $from_num + ( $gallery_members_template->pag_num - 1 );

		return apply_filters( 'bp_get_gallery_member_pagination_count', sprintf( __( 'Viewing members %d to %d (of %d members)', 'buddypress' ), $from_num, $to_num, $gallery_members_template->total_member_count ) );
	}

function bp_gallery_member_admin_pagination() {
	echo bp_get_gallery_member_admin_pagination();
	wp_nonce_field( 'Bp_Gallery_User_admin_list', '_member_admin_pag_nonce' );
}
	function bp_get_gallery_member_admin_pagination() {
		global $gallery_members_template;

		return $gallery_members_template->pag_links;
	}
function gallery_get_loggedin_user_first_name(){
 global $bp;
 if(!is_user_logged_in())
 return '';
 
 $name = $bp->loggedin_user->fullname;

$fullname = (array)explode( ' ', $name );

return apply_filters( 'gallery_get_user_firstname', $fullname[0], $fullname );
 
}
?>