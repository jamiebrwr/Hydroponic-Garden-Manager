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
$query = new WP_Query();
get_all_journaling_posts( $query );
?>

<div class="mainpanel">
	
	<!-- Primary Menu -->
	<?php get_template_part('partials/panels/panel', 'left'); ?>
	
	<?php get_template_part('partials/header', 'bar'); ?>
    
    <div class="pageheader">
      <h2><i class="fa fa-file-text"></i> Blog List <span>Read our latest news...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li><a href="index.html">Pages</a></li>
          <li class="active">Blog List</li>
        </ol>
      </div>

	
	
	<div class="contentpanel">
		<div class="entry-content">
			<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
								get_template_part( 'content/content', get_post_type() );
							endwhile; ?>
						</div>
					</div><!-- .entry-content -->
					<?php// edit_post_link( __( 'Edit', 'custody-agreements' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
				</article><!-- #post-## -->
			</div>
		</div>
	</div>
			
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