<?php
/**
 * The Template for displaying all single posts.
 *
 * @package custody-agreements
 */

get_header(); ?>

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
	      <?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content/content', 'single-journaling' ); ?>

			<?php// custody_agreements_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				/*if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;*/
			?>

		<?php endwhile; // end of the loop. ?>
	    </div>
	    
	  </div><!-- mainpanel -->
	  
	 

<?php// get_sidebar(); ?>
<?php get_footer(); ?>