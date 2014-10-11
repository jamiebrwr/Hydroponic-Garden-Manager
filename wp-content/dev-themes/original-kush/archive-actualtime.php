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

<!-- Primary Menu -->
<?php get_template_part('partials/panels/panel', 'left'); ?>

<div class="mainpanel">
	
	<?php get_template_part('partials/header', 'bar'); ?>
	
	<?php get_template_part('partials/page', 'header'); ?>
	
	<div class="entry-content">
		<div class="contentpanel">
			<div class="row" style="position: relative; height: 1494.078125px;">
		        <div class="col-sm-8 col-md-9">
		          <div class="panel panel-default">
		            <div class="panel-body">
						<div class="table-responsive">
					<div id="table2_wrapper" class="dataTables_wrapper" role="grid">
						<div id="table2_length" class="dataTables_length">
					
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
							</table>
							<?php query_posts( array(  'posts_per_page' => 24, 'orderby' => 'title', 'order' => 'DESC', 'post_type'=> get_post_type() ) );
								if ( have_posts() ) : while ( have_posts() ) : the_post();
								get_template_part( 'content/content', get_post_type() );
							endwhile; ?>
						</div>
				</div><!-- #table2_wrapper -->
			</div><!-- .table-responsive -->
		            </div>
		          </div>
		        </div>
			</div>
		</div>
	</div><!-- .entry-content -->
			
	<?php custody_agreements_paging_nav(); ?>
	
	<?php else : ?>
	
	<?php get_template_part( 'content/content', 'none' ); ?>
	
	<?php endif; ?>
	<?php wp_reset_postdata();?>

</div><!-- mainpanel -->
	
	<?php get_template_part('partials/panels/right', 'panel'); ?>

	<?php custody_agreements_paging_nav(); ?>
	
<?php// get_sidebar(); ?>
<?php get_footer(); ?>