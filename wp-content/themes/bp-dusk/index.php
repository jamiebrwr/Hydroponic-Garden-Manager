<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package custody-agreements
 */

get_header(); ?>

		<!-- Primary Menu -->
		<?php get_template_part('partials/panels/left', 'panel'); ?>
	
		<div class="mainpanel">
		
			<?php get_template_part('partials/header', 'bar'); ?>
			<?php get_template_part('partials/page', 'header'); ?>
	
		<div class="contentpanel">
      <?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<div class="entry-content">
					<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
			        
			        <div class="col-xs-6 col-sm-4 col-md-3" style="position: absolute; left: 0px; top: 0px;">
			          <div class="blog-item">
			            <a href="<?php the_permalink(); ?>" class="blog-img"><?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?></a>
			            <div class="blog-details">
			              <h4 class="blog-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
			              <ul class="blog-meta">
			                <li>By: <a href=""><?php get_the_author_meta('user_nicename'); ?></a></li>
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
			        
			      </div>
				</div><!-- .entry-content -->
				<?php// edit_post_link( __( 'Edit', 'custody-agreements' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
			</article><!-- #post-## -->
		</div>
	
	</div><!-- mainpanel -->
	
	<?php get_template_part('partials/panels/right', 'panel'); ?>

		<?php endwhile; ?>

			<?php custody_agreements_paging_nav(); ?>

		<?php else : ?>

			<?php// get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
  
<?php// get_sidebar(); ?>
<?php get_footer(); ?>