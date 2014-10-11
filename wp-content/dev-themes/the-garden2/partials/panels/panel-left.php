<?php do_action('srh_leftpanel_wrapper_start'); ?>
<!-- This is only visible to small devices -->
<div class="visible-xs hidden-sm hidden-md hidden-lg">   
	<div class="media">
		<img alt="" src="images/photos/loggeduser.png" class="media-object">
			<div class="media-body">
				<h4>John Doe</h4>
				<span>"Life is so..."</span>
			</div>
		</div>
		<h5 class="sidebartitle actitle">Account</h5>
		<ul class="nav nav-pills nav-stacked nav-bracket mb30">
			<li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
			<li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
			<li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
			<li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
		</ul>
	</div>
	
	<h5 class="sidebartitle">Navigation</h5>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php
		$defaults = array(
		'theme_location'  => 'primary',
		'menu'            => 'primary',
		'container'       => 'div',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => 'nav nav-pills nav-stacked nav-bracket',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '<i class="fa fa-home"></i><span>',
		'link_after'      => '</span>',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		);
		wp_nav_menu( $defaults );
		?>			
	</nav><!-- #site-navigation -->
	
	<!-- Info Summary -->
	<?php get_template_part('partials/panels/info', 'summary'); ?>
</div>

<?php do_action('srh_leftpanel_wrapper_end'); ?>