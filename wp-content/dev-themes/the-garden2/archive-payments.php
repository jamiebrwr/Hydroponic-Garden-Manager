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

get_header(); ?>

<div class="mainpanel">

	<!-- Primary Menu -->
	<?php get_template_part('partials/panels/left', 'panel'); ?>
	
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
	<div class="entry-content">
		<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
			<div class="contentpanel">
				<?php query_posts( array(  'posts_per_page' => 12, 'orderby' => 'title', 'order' => 'DESC', 'post_type'=> get_post_type() ) );
					if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content/content', get_post_type() );
				endwhile; ?>
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