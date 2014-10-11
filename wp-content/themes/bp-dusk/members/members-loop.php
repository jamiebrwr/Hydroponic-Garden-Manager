<?php
/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header(); ?>

		<!-- Primary Menu -->
		<?php get_template_part('partials/panels/left', 'panel'); ?>
</div>
	<div class="mainpanel">
	
		<?php get_template_part('partials/header', 'bar'); ?>
	
		<div class="pageheader">
      <h2><i class="fa fa-home"></i> <?php the_title(); ?> <span>Welcome to your live <?php the_title(); ?> <strong><a href="/your-profile/"><?php get_template_part('partials/metadata', 'users'); ?></a></strong>...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html"><?php echo bloginfo('name'); ?></a></li>
          <li class="active"><?php the_title(); ?></li>
        </ol>
      </div>
    </div>
	<div class="contentpanel">
		<?php do_action( 'bp_before_members_loop' ); ?>
		<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>
		<?php do_action( 'bp_before_directory_members_list' ); ?>
			<?php while ( bp_members() ) : bp_the_member(); ?>
				<div class="col-md-6">
					<div class="people-item">
						<div class="media">
							<a href="<?php bp_member_permalink(); ?>" class="pull-left">
								<div class="item-avatar">
									<?php bp_member_avatar(); ?>
								</div>
							</a>
							<div class="media-body">
								<?php if ( bp_get_member_latest_update() ) : ?>
								<span class="update"> <?php bp_member_latest_update(); ?></span>
								<?php endif; ?>
								<div class="item-meta"><span class="activity"><?php bp_member_last_active(); ?></span></div>
								<h4 class="person-name"><a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a></h4>
								<div class="text-muted"><i class="fa fa-map-marker"></i> Cebu City, Philippines</div>
								<div class="text-muted"><i class="fa fa-briefcase"></i> Software Engineer at <a href="">SomeCompany, Inc.</a></div>
								<ul class="social-list">
									<li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email"><i class="fa fa-envelope-o"></i></a></li>
									<li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<?php do_action( 'bp_directory_members_item' ); ?>
					<?php
						/***
						 * If you want to show specific profile fields here you can,
						 * but it'll add an extra query for each member in the loop
						 * (only one regardless of the number of fields you show):
						 *
						 * bp_member_profile_data( 'field=the field name' );
						 */
						?>
				</div>
				<div class="action">
					<?php do_action( 'bp_directory_members_actions' ); ?>
				</div>
				<div class="clear"></div>
			<?php endwhile; ?>
		<?php do_action( 'bp_after_directory_members_list' ); ?>
		<?php bp_member_hidden_fields(); ?>
		<div id="pag-bottom" class="pagination">
			<div class="pag-count" id="member-dir-count-bottom">
				<?php bp_members_pagination_count(); ?>
			</div>
			<div class="pagination-links" id="member-dir-pag-bottom">
				<?php bp_members_pagination_links(); ?>
			</div>
		</div>
		<?php else: ?>
		<div id="message" class="info">
			<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
		</div>
		<?php endif; ?>
		<?php get_template_part('partials/panels/right', 'panel'); ?>
<?php get_footer(); ?>