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

			<?php /* Start the Loop */ ?>
			<div class="entry-content">
				<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<div id="bloglist" class="row" style="position: relative; height: 1494.078125px;">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
									get_template_part( 'content', 'journaling' );
								endwhile; ?>
							</div>
						</div><!-- .entry-content -->
						<?php// edit_post_link( __( 'Edit', 'custody-agreements' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
					</article><!-- #post-## -->
				</div>
			</div>
    </div>
	
	</div><!-- mainpanel -->
	
	<?php get_template_part('partials/panels/right', 'panel'); ?>

			<?php custody_agreements_paging_nav(); ?>

		<?php else : ?>

			<?php// get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
  
<?php// get_sidebar(); ?>
<?php get_footer(); ?>