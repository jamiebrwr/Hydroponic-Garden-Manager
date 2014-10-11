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
	
	<?php
	$monetary_value_max = get_post_meta($post->ID, 'ecpt_total_amount_of_expense', true);
	$partial_amount_spent = get_post_meta($post->ID, 'ecpt_expense_partial_amount_spent', true);
	?>
	
	<div class="entry-content">
		<div class="contentpanel">
			<div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="http://custodyagreements.co/app/images/is-money.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Today's Earnings</small>
                    <h1><?php echo $gh = get_post_meta($post->ID, 'ecpt_expense_partial_amount_spent', true) ?></h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last Week</small>
                    <h4>$32,322</h4>
                  </div>
                  
                  <div class="col-xs-6">
                    <small class="stat-label">Last Month</small>
                    <h4>$503,000</h4>
                  </div>
                </div><!-- row -->
                  
                 
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
	        </div>
	        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="http://custodyagreements.co/app/images/is-money.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Today's Earnings</small>
                    <h1>$655</h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last Week</small>
                    <h4>$32,322</h4>
                  </div>
                  
                  <div class="col-xs-6">
                    <small class="stat-label">Last Month</small>
                    <h4>$503,000</h4>
                  </div>
                </div><!-- row -->
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-dark panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="http://custodyagreements.co/app/images/is-money.png" alt="">
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Today's Earnings</small>
                    <h1>$655</h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>
                
                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">Last Week</small>
                    <h4>$32,322</h4>
                  </div>
                  
                  <div class="col-xs-6">
                    <small class="stat-label">Last Month</small>
                    <h4>$503,000</h4>
                  </div>
                </div><!-- row -->
                  
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div>
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
													<th class="sorting" role="columnheader" tabindex="0" aria-controls="table2" rowspan="1" colspan="1" aria-sort="ascending" ri-label="Rendering engine: activte to sort column descending">Amount</th>
												</tr>
											</thead>
											<?php query_posts( array(  'posts_per_page' => 24, 'order' => 'DESC', 'post_type'=> get_post_type() ) );
											if ( have_posts() ) : while ( have_posts() ) : the_post();
											get_template_part( 'content/content', get_post_type() );
											endwhile; ?>
										</table>
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