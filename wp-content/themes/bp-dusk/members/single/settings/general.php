<?php

/**
 * BuddyPress Member Settings
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

		<?php do_action( 'bp_before_member_settings_template' ); ?>
		<div class="contentpanel">
      <?php if ( have_posts() ) : ?>
	  <?php do_action( 'bp_before_member_settings_template' ); ?>
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

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
					//bp_nav_menu( $defaults ); ?>
				</div><!-- #item-nav -->

			<div id="item-body" role="main">

				<?php do_action( 'bp_before_member_body' ); ?>

				<!--
<div class="item-list-tabs no-ajax" id="subnav">
					<ul>

						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_member_plugin_options_nav' ); ?>

					</ul>
				</div><!-- .item-list-tabs -->
				
				<div class="panel panel-primary col-sm-9" style="padding-left:0;padding-right:0;">
		          <div class="panel-heading">
		              <div class="panel-btns">
		                <a href="" class="panel-close">×</a>
		                <a href="" class="minimize">−</a>
		              </div><!-- panel-btns -->
		              <h3 class="panel-title"><?php _e( 'Security', 'buddypress' ); ?></h3>
		            </div>
		            <div class="panel-body">
		             
		              

				<?php do_action( 'bp_template_content' ); ?>

				<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

					<?php if ( !is_super_admin() ) : ?>

						<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'buddypress' ); ?></label>
						<input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small form-control mt10 mb10" /> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'buddypress' ); ?>"><?php _e( 'Lost your password?', 'buddypress' ); ?></a>

					<?php endif; ?>

					<label for="email"><?php _e( 'Account Email', 'buddypress' ); ?></label>
					<input type="text" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input form-control mt10 mb10" />
					<!-- <label for="pass1"><?php _e( 'Change Password <span>(leave blank for no change)</span>', 'buddypress' ); ?></label> -->
					&nbsp;<?php _e( 'Type New Password', 'buddypress' ); ?>
					<input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small form-control mt10 mb10" />
					&nbsp;<?php _e( 'Repeat New Password', 'buddypress' ); ?>
					<input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small form-control mt10 mb10" />

					<?php do_action( 'bp_core_general_settings_before_submit' ); ?>

					<div class="submit">
						<input type="submit" name="submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?>" id="submit" class="auto btn bbtn-xs btn-block" />
					</div>

					<?php do_action( 'bp_core_general_settings_after_submit' ); ?>

					<?php wp_nonce_field( 'bp_settings_general' ); ?>

				</form>

				<?php do_action( 'bp_after_member_body' ); ?>
				
            </div><!-- panel-body -->
          </div>
		          
		         <div class="panel panel-primary col-sm-9" style="padding-left:0;padding-right:0;"> 
			        <form action="<?php echo trailingslashit( bp_displayed_user_domain() . bp_get_settings_slug() . '/profile' ); ?>" method="post" class="standard-form" id="settings-form">
			        <div class="panel-heading">
		              <div class="panel-btns">
		                <a href="" class="panel-close">×</a>
		                <a href="" class="minimize">−</a>
		              </div><!-- panel-btns -->
		              <h3 class="panel-title"><?php _e( 'Profile', 'buddypress' ); ?></h3>
		            </div>
		            <div class="panel-body">
	
						<?php if ( bp_xprofile_get_settings_fields() ) : ?>
	
							<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
	
								<?php if ( bp_profile_fields() ) : ?>
	
									<table class="profile-settings" id="xprofile-settings-<?php bp_the_profile_group_slug(); ?>">
										<thead>
											<tr>
												<th class="title field-group-name"><?php bp_the_profile_group_name(); ?></th>
												<th class="title"><?php _e( 'Visibility', 'buddypress' ); ?></th>
											</tr>
										</thead>
	
										<tbody>
	
											<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
	
												<tr <?php bp_field_css_class(); ?>>
													<td class="field-name"><?php bp_the_profile_field_name(); ?></td>
													<td class="field-visibility"><?php bp_profile_settings_visibility_select(); ?></td>
												</tr>
	
											<?php endwhile; ?>
	
										</tbody>
									</table>
	
								<?php endif; ?>
	
							<?php endwhile; ?>
	
						<?php endif; ?>
	
						<?php do_action( 'bp_core_xprofile_settings_before_submit' ); ?>
	
						<div class="submit">
							<input id="submit" type="submit" name="xprofile-settings-submit" value="<?php esc_attr_e( 'Save Settings', 'buddypress' ); ?>" class="auto" />
						</div>
	
						<?php do_action( 'bp_core_xprofile_settings_after_submit' ); ?>
	
						<?php wp_nonce_field( 'bp_xprofile_settings' ); ?>
	
						<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />
	
					</form> 
		         </div> 
		         </div><!-- #item-body -->

		<?php endwhile; ?>
		<?php do_action( 'bp_after_member_settings_template' ); ?>
	</div><!-- contentpanel -->
		<?php else : ?>

			<?php// get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

<?php get_footer(); ?>