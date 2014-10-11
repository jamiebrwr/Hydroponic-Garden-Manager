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
      <?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
	
			<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );
			?>
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