<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>
 <div class="contentpanel">
<?php do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>
	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-dir-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
	<?php do_action( 'bp_before_directory_members_list' ); ?>      
      
      <ul class="letter-list">
        <li><a href="">a</a></li>
        <li><a href="">b</a></li>
        <li><a href="">c</a></li>
        <li><a href="">d</a></li>
        <li><a href="">e</a></li>
        <li><a href="">f</a></li>
        <li><a href="">g</a></li>
        <li><a href="">h</a></li>
        <li><a href="">i</a></li>
        <li><a href="">j</a></li>
        <li><a href="">k</a></li>
        <li><a href="">l</a></li>
        <li><a href="">m</a></li>
        <li><a href="">n</a></li>
        <li><a href="">o</a></li>
        <li><a href="">p</a></li>
        <li><a href="">q</a></li>
        <li><a href="">r</a></li>
        <li><a href="">s</a></li>
        <li><a href="">t</a></li>
        <li><a href="">u</a></li>
        <li><a href="">v</a></li>
        <li><a href="">w</a></li>
        <li><a href="">x</a></li>
        <li><a href="">y</a></li>
        <li><a href="">z</a></li>
      </ul>
      
      <div class="mb30"></div>
      
      <div class="people-list">
        <div class="row">
          
          <?php while ( bp_members() ) : bp_the_member(); ?>
          
          <div class="col-md-6">
            <div class="people-item">
              <div class="media">
              	<a class="pull-left" href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=110&height=110&class=media-object'); ?></a>
                <div class="media-body">
                  <h4 class="person-name"><a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a></h4>
                  <?php if ( bp_get_member_latest_update() ) : ?>

						<span class="update"> <?php bp_member_latest_update(); ?></span>
	
					<?php endif; ?>
					<div class="item-meta"><span class="activity"><?php bp_member_last_active(); ?></span></div>
                  <div class="text-muted"><i class="fa fa-map-marker"></i> Cebu City, Philippines</div>
                  <div class="text-muted"><i class="fa fa-briefcase"></i> Software Engineer at <a href="">SomeCompany, Inc.</a></div>
                  <ul class="social-list">
                    <li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="Email"><i class="fa fa-envelope-o"></i></a></li>
                    <li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="" class="tooltips" data-toggle="tooltip" data-placement="top" title="Skype"><i class="fa fa-skype"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div><!-- col-md-6 -->
          

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


			


	<?php endwhile; ?>

	</ul>
</div><!-- row -->
      </div><!-- people-list -->
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

<?php do_action( 'bp_after_members_loop' ); ?>
