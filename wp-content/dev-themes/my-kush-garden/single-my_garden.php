<?php
/**
 * Template Name: Journal
 *
 * The blog page template displays the "blog-style" template on a sub-page.
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header(); ?>

		<!-- Primary Menu -->
		<?php get_template_part('partials/panels/left', 'panel'); ?>
		
		<!-- Info Summary -->
		<?php get_template_part('partials/panels/info', 'summary'); ?>
		
		</div><!-- leftpanelinner -->
	</div><!-- leftpanel -->

	<div class="mainpanel">
	
		<?php get_template_part('partials/header', 'bar'); ?>
	
		<div class="pageheader">
      <h2><i class="fa fa-home"></i> <?php the_title(); ?> <span>Expected Harvest Date: July 26th (4 weeks)</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html"><?php echo bloginfo('name'); ?></a></li>
          <li class="active"><?php the_title(); ?></li>
        </ol>
      </div>
    </div>
	
		<div class="contentpanel">
			<div class="entry-content">
				<?php while ( have_posts() ) : the_post(); ?>
				
				
				
				
      
      
      
				<h2>Feeding Regiment</h2>
				<div class="table-responsive">
		          <table class="table mb30">
		            <thead>
		              <tr>
		                <th>Water</th>
		                
		                <th>Big Bloom</th>
		                <th>Grow Big</th>
		                <th>Tiger Bloom</th>
		                
		                <th>Kangaroots</th>
		                <th>Micro Brew</th>
		                
		                <th>Open Sesame</th>
		                <th>Beastie Bloomz</th>
		                <th>ChaChing</th>
		              </tr>
		            </thead>
		            <tbody>
		              <tr class="table-striped">
		                <td class="center">&nbsp;</td>
		                
		                <td class="center">3 <sup>tsp</sup></td>
		                <td class="center">2 <sup>tsp</sup></td>
		                <td class="center">2 <sup>tsp</sup></td>
		                
		                <td class="center"> - </td>
		                <td class="center">0.5 <sup>tsp</sup></td>
		                
		                <td class="center">0.25 <sup>tsp</sup></td>
		                <td class="center"> - </td>
		                <td class="center"> - </td>
		              </tr>
		              <tr>
		                <td class="center">8 Gallons</td>
		                
		                <td class="center">24 <sup>tsp</sup></td>
		                <td class="center">16 <sup>tsp</sup></td>
		                <td class="center">16 <sup>tsp</sup></td>
		                
		                <td class="center"> - </td>
		                <td class="center">4 <sup>tsp</sup></td>
		                
		                <td class="center"> - </td>
		                <td class="center"> - </td>
		                <td class="center"> - </td>
		              </tr>
		            </tbody>
		          </table>
		          </div>

	          <?php

				$am_ph_level = get_post_meta($post->ID, 'ecpt_am_ph_level', true);
				$am_ph_adjustment = get_post_meta($post->ID, 'ecpt_am_ph_adjustment', true);
				$am_tds_level = get_post_meta($post->ID, 'ecpt_am_tds_level', true);
				$am_tds_adjustment = get_post_meta($post->ID, 'ecpt_am_tds_adjustment', true);
				
				$pm_ph_level = get_post_meta($post->ID, 'ecpt_pm_ph_level', true);
				$pm_ph_adjustment = get_post_meta($post->ID, 'ecpt_pm_ph_adjustment', true);
				$pm_tds_level = get_post_meta($post->ID, 'ecpt_pm_tds_level', true);
				$pm_tds_adjustment = get_post_meta($post->ID, 'ecpt_pm_tds_adjustment', true);
				
				$height_measurement = get_post_meta($post->ID, 'ecpt_height_measurement', true);
				$daily_notes = get_post_meta($post->ID, 'ecpt_daily_notes', true);
				?>
				<h2>Recorded Measurements</h2>
				<div class="table-responsive">
		          <table class="table mb30">
		            <thead>
		              <tr>
		                <th>Time</th>
		                <th>Height</th>
		                <th>Ph Reading</th>
		                <th>Ph Adjustment</th>
		                <th>TDS Reading</th>
		                <th>TDS Adjustment</th>
		                <th>TDS Goal</th>
		                <th>TDS in Range</th>
		              </tr>
		            </thead>
		            <tbody>
		              <tr class="table-striped">
		                <td class="center">AM</td>
		                <td class="center"><?php echo $height_measurement; ?>"</td>
		                <td class="center"><?php echo $am_ph_level; ?></td>
		                <td class="center"><?php echo $am_ph_adjustment; ?></td>
		                <td class="center"><?php echo $am_tds_level; ?></td>
		                <td class="center"><?php echo $am_tds_adjustment; ?></td>
		                <td class="center">&nbsp;</td>
		                <td class="center">&nbsp;</td>
		              </tr>
		              <tr>
		                <td class="center">PM</td>
		                <td class="center">&nbsp;</td>
		                <td class="center"><?php echo $pm_ph_level; ?></td>
		                <td class="center"><?php echo $pm_ph_adjustment; ?></td>
		                <td class="center"><?php echo $pm_tds_level; ?></sup></td>
		                <td class="center"><?php echo $pm_tds_adjustment; ?></td>
		                <td class="center"><strong><em>1960-2100</em></strong></td>
		                <td class="center" style="color:red;">-90 <sup>ppm</sup></td>
		              </tr>
		            </tbody>
		          </table>
		          </div>
		          
		          
		          
		          			      
			      
		         
		         <h2>Notes</h2>
		         <?php the_post_thumbnail('medium', array('style' => 'float:right;margin:0 20px 20px 20px;')); ?>
		         
		         <?php echo $daily_notes; ?>
		         
		         <p>&nbsp;</p>
		         
		         <h2>Sparkline</h2>
				<div class="panel panel-default col-md-6">
        
			        <div class="panel-body">
			              
			          <div class="tinystat mr10">
			            <div id="sparkline2" class="chart mt5"><canvas width="50" height="33" style="display: inline-block; width: 50px; height: 33px; vertical-align: top;"></canvas></div>
			            <div class="datainfo">
			              <span class="text-muted">Avg Height Gain</span>
			              <h4>$106,850</h4>
			            </div>
			          </div><!-- tinystat -->
			              
			          <div class="tinystat mr10">
			            <div id="sparkline3" class="chart mt5"><canvas width="33" height="33" style="display: inline-block; width: 33px; height: 33px; vertical-align: top;"></canvas></div>
			            <div class="datainfo">
			              <span class="text-muted">Avg Order</span>
			              <h4>23,001,090</h4>
			            </div>
			          </div><!-- tinystat -->
			        
			        </div><!-- panel-body -->
			      </div>
			      
			      <div style="clear:both;"></div>


			<?php custody_agreements_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				/*if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;*/
			?>

		<?php endwhile; // end of the loop. ?>
		</div><!-- .entry-content -->
		<?php// wp_reset_postdata();?>
		


	
	</div><!-- mainpanel -->
	
	<?php get_template_part('partials/panels/right', 'panel'); ?>



			<?php custody_agreements_paging_nav(); ?>



			<?php// get_template_part( 'content', 'none' ); ?>


  
<?php// get_sidebar(); ?>
<?php get_footer(); ?>