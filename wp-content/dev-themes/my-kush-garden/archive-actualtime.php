<?php
/**
* The template for displaying all pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
*
* @package custody-agreements
*/

get_header(); ?>

<?php

$chart_value = get_post_meta($post->ID, 'ecpt_allottedhours', true);
$pickup_hour = get_post_meta($post->ID, 'ecpt_hour', true);
$drop_off_hour = get_post_meta($post->ID, 'ecpt_dropoffhour', true);
$pickup_minute = get_post_meta($post->ID, 'ecpt_minute', true);
$drop_off_minute = get_post_meta($post->ID, 'ecpt_dropoffminute', true);

$time_evaulation = new srhTime($chart_value,$pickup_hour,$pickup_minute, $drop_off_hour, $drop_off_minute,'','','','','','','');
?>

			<!-- Primary Menu -->
			<?php get_template_part('partials/panels/left', 'panel'); ?>
			
			<!-- Info Summary -->
			<?php get_template_part('partials/panels/info', 'summary'); ?>
		
		
	
	
	<div class="mainpanel">
		<div class="panel panel-default">
		<?php get_template_part('partials/header', 'bar'); ?>
		

	
		
		<div class="entry-content">
			<div class="table-responsive">
				<div id="table2_wrapper" class="dataTables_wrapper" role="grid">
					<div id="table2_length" class="dataTables_length">
						
					</div>
					
					
					<div class="dataTables_filter" id="table2_filter">
						<label>Search: <input type="text" aria-controls="table2"></label>
					</div>
					<table class="table dataTable" id="table2" aria-describedby="table2_info">
						<thead>
							<tr role="row">
							<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-sort="ascending" ri-label="Rendering engine: activte to sort column descending">Date</th>
							<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-label="Browser: activte to sort column ascending" style="width: 320px;">Day</th>
							<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-label="Pltform(s): activte to sort column ascending" style="width: 292px;">Allotted Time</th>
							<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-label="Engine version: ctivte to sort column ascending" style="width: 173px;">Pickup TIme</th>
							<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-label="CSS grade: activte to sort column ascending" style="width: 125px;">Dropoff Time</th>
							<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-label="CSS grade: activte to sort column ascending" style="width: 125px;">% of Time Used</th>
							</tr>
						</thead>
					
					
					<?php if ( have_posts() ) : ?>
						<tbody role="alert" aria-live="polite" aria-relevant="all">
							<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'time-tracking' ); ?>
							<?php endwhile; ?>
						</tbody>
					</table>
					
					
					<div class="dataTables_info" id="table2_info">Showing 1 to 10 of 57 entries</div>
					<div class="dataTables_paginate paging_full_numbers" id="table2_paginate">
						<a tabindex="0" class="first paginate_button paginate_button_disabled" id="table2_first">First</a>
						<a tabindex="0" class="previous paginate_button paginate_button_disabled" id="table2_previous">Previous</a>
						<span>
							<a tabindex="0" class="paginate_active">1</a><a tabindex="0" class="paginate_button">2</a>
							<a tabindex="0" class="paginate_button">3</a><a tabindex="0" class="paginate_button">4</a>
							<a tabindex="0" class="paginate_button">5</a></span><a tabindex="0" class="next paginate_button" id="table2_next">Next</a>
							<a tabindex="0" class="last paginate_button" id="table2_last">Last</a>
						</div>
				</div><!-- #table2_wrapper -->
			</div><!-- .table-responsive -->
		</div><!-- .entry-content -->
	</article><!-- article -->

		</div><!-- contentpanel -->
	
	<?php// get_template_part('partials/panels/right', 'panel'); ?>

	<?php custody_agreements_paging_nav(); ?>

	</div><!-- END .panel-default -->
	
</div><!-- END .mainpanel -->

<?php else : ?>

	<?php// get_template_part( 'content', 'none' ); ?>

<?php endif; ?>

<?php// get_sidebar(); ?>
<?php get_footer(); ?>