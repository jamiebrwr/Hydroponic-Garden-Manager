<?php
/* 
 * All The Installation/basic files gores here
 * and open the template in the editor.
 */


function bp_gallery_install() {
	global $wpdb, $bp;

	if ( !empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

	$sql[] = "CREATE TABLE {$bp->gallery->table_galleries_data} (
	  		`id` bigint(20) NOT NULL auto_increment,
          `parent_id` bigint(20) NOT NULL,
          `creator_id` bigint(20) NOT NULL,
          `title` varchar(255) character set utf8 NOT NULL,
          `slug` varchar(100) character set utf8 NOT NULL,
          `description` mediumtext character set utf8 NOT NULL,
          `cover_mini` varchar(255) character set utf8 NOT NULL,
          `cover_mid` varchar(255) NOT NULL,
          `cover_orig` varchar(255) NOT NULL,
          `status` varchar(32) character set utf8 NOT NULL,
          `owner_object_type` varchar(64) character set utf8 NOT NULL,
          `owner_object_id` bigint(20) NOT NULL,
          `sort_order` bigint(20) NOT NULL,
          `gallery_type` varchar(32) character set utf8 NOT NULL,
          `date_created` datetime NOT NULL,
          `date_updated` timestamp NOT NULL default CURRENT_TIMESTAMP,
          PRIMARY KEY  (`id`)
	 	   ) {$charset_collate};";
//for media table too

	$sql[] = "CREATE TABLE {$bp->gallery->table_gallery_users} (
					`id` bigint(20) NOT NULL auto_increment,
					`gallery_id` bigint(20) NOT NULL,
					`user_id` bigint(20) NOT NULL,
					`user_title` varchar(100) character set utf8 NOT NULL,
					`inviter_id` bigint(20) NOT NULL,
					`is_admin` tinyint(1) NOT NULL,
					`is_mod` tinyint(1) NOT NULL default '0',
					`can_upload` tinyint(1) NOT NULL default '0',
					`can_view` tinyint(1) NOT NULL default '1',
					`is_confirmed` tinyint(1) NOT NULL default '0',
					`is_banned` tinyint(1) NOT NULL default '0',
					`invite_sent` tinyint(1) NOT NULL default '0',
					`date_updated` datetime NOT NULL,
					PRIMARY KEY  (`id`),
					KEY gallery_id (`gallery_id`),
					KEY is_admin (`is_admin`),
					KEY is_mod (`is_mod`),
					KEY user_id (`user_id`),
					KEY inviter_id (`inviter_id`),
					KEY is_confirmed (`is_confirmed`),
					KEY can_upload (`can_upload`)
	 	   ) {$charset_collate};";

	$sql[] = "CREATE TABLE {$bp->gallery->table_media_data} (
			`id` bigint(20) NOT NULL auto_increment,
              `gallery_id` bigint(20) NOT NULL,
              `title` varchar(255) NOT NULL,
              `slug` varchar(100) NOT NULL,
              `description` mediumtext NOT NULL,
              `type` varchar(32) NOT NULL,
              `user_id` bigint(20) NOT NULL,
              `is_remote` tinyint(3) NOT NULL default '0',
              `status` varchar(32) NOT NULL default 'public',
              `sort_order` bigint(20) NOT NULL,
              `enable_wire` tinyint(3) NOT NULL default '1',
              `remote_url` varchar(255) NOT NULL,
              `local_orig_path` varchar(255) NOT NULL,
              `local_mid_path` varchar(255) NOT NULL,
              `local_thumb_path` varchar(255) NOT NULL,
              `date_updated` datetime NOT NULL,
              PRIMARY KEY  (`id`)
		   ) {$charset_collate};";

          //meta data
          $sql[] = "CREATE TABLE {$bp->gallery->table_gallery_meta} (
			`id` bigint(20) NOT NULL auto_increment,
                        `gallery_id` bigint(20) NOT NULL,
                        `meta_key` varchar(255) NOT NULL,
                        `meta_value` mediumtext NOT NULL,
                         PRIMARY KEY  (`id`)
		   ) {$charset_collate};";
          //meta data
          $sql[] = "CREATE TABLE {$bp->gallery->table_media_meta} (
			`id` bigint(20) NOT NULL auto_increment,
                        `media_id` bigint(20) NOT NULL,
                        `meta_key` varchar(255) NOT NULL,
                        `meta_value` mediumtext NOT NULL,
                         PRIMARY KEY  (`id`)
		   ) {$charset_collate};";
	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	dbDelta($sql);

	

	update_site_option( 'bp-gallery-db-version', BP_GALLERY_DB_VERSION );
}



function gallery_check_installed() {
	global $wpdb, $bp;

	//require ( BP_GALLERY_PLUGIN_DIR . '/bp-gallery/bp-gallery-admin.php' );

	/* Need to check db tables exist, activate hook no-worky in mu-plugins folder. */
	if ( get_site_option('bp-gallery-db-version') < BP_GALLERY_DB_VERSION )
            bp_gallery_install();
}
add_action( is_multisite() ? 'network_admin_menu' : 'admin_menu', 'gallery_check_installed' );//support for bp 1.2.8+wp 3.1

?>