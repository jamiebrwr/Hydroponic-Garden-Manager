<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package custody-agreements
 */
?>

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
