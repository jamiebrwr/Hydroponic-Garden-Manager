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
			<div class="entry-content">
				<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
	        
			     <?php
				$args = array( 'posts_per_page' => 25, 'offset'=> 1 );
				$myposts = get_posts( $args );
				$count = 0;
				foreach ( $myposts as $post ) : setup_postdata( $post ); $count+=100;?>

				<div class="col-xs-6 col-sm-4 col-md-3" style="">
		          <div class="blog-item">
		            <a href="<?php the_permalink(); ?>" class="blog-img"><?php the_post_thumbnail('journal-thumb', array('class' => 'img-responsive')); ?></a>
		            <div class="blog-details">
		              <h4 class="blog-title"><a href="<?php echo the_permalink(); ?>"><?php// the_title(); ?></a></h4>
		              <ul class="blog-meta">
		                <li>By: <a href=""><?php echo $niceName = get_the_author_meta('user_nicename'); ?></a></li>
		                <li>Jan 03, 2014</li>
		                <li><a href="">2 Comments</a></li>
		              </ul>
		              <div class="blog-summary">
		                <?php the_excerpt(); ?>
		                <button class="btn btn-sm btn-white">Read More</button>
		              </div>
		            </div>
		          </div><!-- blog-item -->
		        </div><!-- col-xs-6 -->
	        
	      

		<?php endforeach;  ?>
		</div>
		</div><!-- .entry-content -->
		<?php wp_reset_postdata();?>
		


	
	</div><!-- mainpanel -->
	
	<?php get_template_part('partials/panels/right', 'panel'); ?>



			<?php custody_agreements_paging_nav(); ?>



			<?php// get_template_part( 'content', 'none' ); ?>


  
<?php// get_sidebar(); ?>
<?php get_footer(); ?>