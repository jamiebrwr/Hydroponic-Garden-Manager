<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header(); ?>
	
			<div class="contentpanel">
	
				<?php do_action( 'bp_before_member_home_content' ); ?>
	
				<div id="item-header" role="complementary">

					<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>
	
				</div><!-- #item-header -->
	
				<div id="item-nav">
					<?php
					$defaults = array( 
					 	'after'           => '', 
					 	'before'          => '', 
					 	'container'       => 'div', 
					 	'container_class' => 'col-sm-9', 
					 	'container_id'    => '', 
					 	'depth'           => 1, 
					 	'echo'            => true, 
					 	'fallback_cb'     => false, 
					 	'items_wrap'      => '<ul id="%1$s" class="%2$s nav nav-tabs nav-justified nav-profile">%3$s</ul>', 
					 	'link_after'      => '', 
					 	'link_before'     => '', 
					 	'menu_class'      => 'menu', 
					 	'menu_id'         => '', 
					 	'walker'          => '', 
					);
					bp_nav_menu( $defaults ); ?>
				</div><!-- #item-nav -->
	
				<?php do_action( 'bp_before_member_body' );
	
				if ( bp_is_user_activity() || !bp_current_component() ) :
					locate_template( array( 'members/single/activity.php'  ), true );
	
				 elseif ( bp_is_user_blogs() ) :
					locate_template( array( 'members/single/blogs.php'     ), true );
	
				elseif ( bp_is_user_friends() ) :
					locate_template( array( 'members/single/friends.php'   ), true );
	
				elseif ( bp_is_user_groups() ) :
					locate_template( array( 'members/single/groups.php'    ), true );
	
				elseif ( bp_is_user_messages() ) :
					locate_template( array( 'members/single/messages.php'  ), true );
	
				elseif ( bp_is_user_profile() ) :
					locate_template( array( 'members/single/profile.php'   ), true );
	
				elseif ( bp_is_user_forums() ) :
					locate_template( array( 'members/single/forums.php'    ), true );
	
				elseif ( bp_is_user_settings() ) :
					locate_template( array( 'members/single/settings.php'  ), true );
	
				elseif ( bp_is_user_notifications() ) :
					locate_template( array( 'members/single/notifications.php' ), true );
	
				// If nothing sticks, load a generic template
				else :
					locate_template( array( 'members/single/plugins.php'   ), true );
	
				endif;
	
				do_action( 'bp_after_member_body' ); ?>
	
				<?php do_action( 'bp_after_member_home_content' ); ?>
				
			</div>
		</div>
		<!-- mainpanel -->
	<?php get_template_part('partials/panels/right', 'panel'); ?>
<?php get_footer(); ?>