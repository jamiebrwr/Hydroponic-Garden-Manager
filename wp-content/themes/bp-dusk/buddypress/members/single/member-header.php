<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div class="row">
       
        
        <?php do_action( 'bp_before_member_header_meta' ); ?>
        
        <div class="col-sm-9">
          
          <div class="profile-header">
          	<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
				<h2 class="user-nicename profile-name">@<?php bp_displayed_user_mentionname(); ?></h2>
			<?php endif; ?>
			<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
            <div class="profile-location"><i class="fa fa-map-marker"></i> San Francisco, California, USA</div>
            <div class="profile-position"><i class="fa fa-briefcase"></i> Software Engineer at <a href="">SomeCompany, Inc.</a></div>
            
            <div class="mb20"></div>
            
            <button class="btn btn-success mr5"><i class="fa fa-user"></i> Follow</button>
            <button class="btn btn-white"><i class="fa fa-envelope-o"></i> Message</button>
          </div><!-- profile-header -->
          
          <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-profile">
          <li class="active"><a href="#activities" data-toggle="tab"><strong>Activities</strong></a></li>
          <li><a href="#followers" data-toggle="tab"><strong>Followers</strong></a></li>
          <li><a href="#following" data-toggle="tab"><strong>Following</strong></a></li>
          <li><a href="#events" data-toggle="tab"><strong>My Events</strong></a></li>
        </ul>
        
        <!-- Tab panes -->
       
          
        </div><!-- col-sm-9 -->
      </div><!-- row -->

<?php do_action( 'bp_after_member_header' ); ?>

<?php do_action( 'template_notices' ); ?>