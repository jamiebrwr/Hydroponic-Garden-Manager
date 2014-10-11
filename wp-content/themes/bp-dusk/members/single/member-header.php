<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<div class="col-sm-3">
	<?php bp_member_avatar('type=full&width=297&height=329&class=thumbnail img-responsive'); ?>
	<div class="mb30"></div>
	<h5 class="subtitle">About</h5>
	<p class="mb30"><?php the_excerpt(); ?><a href="">Show More</a></p>
	<h5 class="subtitle">Connect</h5>
	<ul class="profile-social-list">
		<li><i class="fa fa-twitter"></i> <a href="">twitter.com/eileensideways</a></li>
		<li><i class="fa fa-facebook"></i> <a href="">facebook.com/eileen</a></li>
		<li><i class="fa fa-youtube"></i> <a href="">youtube.com/eileen22</a></li>
		<li><i class="fa fa-linkedin"></i> <a href="">linkedin.com/4ever-eileen</a></li>
		<li><i class="fa fa-pinterest"></i> <a href="">pinterest.com/eileen</a></li>
		<li><i class="fa fa-instagram"></i> <a href="">instagram.com/eiside</a></li>
	</ul>
	<div class="mb30"></div>
	<h5 class="subtitle">Address</h5>
	<address>
		504 Orchard Ln<br>
		St. Joseph, MO 64501<br>
		<abbr title="Phone">P:</abbr> (816) 294-8606
	</address>
</div>
<!-- col-sm-3 -->
<div class="col-sm-9">
	<?php do_action( 'bp_before_member_header' ); ?>
	<div class="profile-header">
		<h2 class="profile-name">
			<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
			<span class="user-nicename">@<?php bp_displayed_user_mentionname(); ?></span>
			<?php endif; ?>
		</h2>
		<div class="profile-location"><i class="fa fa-map-marker"></i> San Francisco, California, USA</div>
		<div class="profile-position"><i class="fa fa-briefcase"></i> Software Engineer at <a href="">Brewerj Web Design</a></div>
		<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
		<div class="mb20"></div>
		<button class="btn btn-success mr5"><i class="fa fa-user"></i> Follow</button>
		<button class="btn btn-white"><i class="fa fa-envelope-o"></i> Message</button>
	</div>
	<!-- profile-header -->
</div>