<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package custody-agreements
 */
?>
<style>
.blog-meta li {float:none;}
</style>
 <div class="col-xs-6 col-sm-4 col-md-3">
  <div class="blog-item">
    <a href="<?php the_permalink(); ?>" class="blog-img"><?php the_post_thumbnail('journaling-thumb', array('class' => 'blog-img')); ?></a>
    <div class="blog-details">
      <h4 class="blog-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <ul class="blog-meta">
      	<li><strong>Week: </strong><?php echo get_post_meta( $post->ID, 'ecpt_week', true ); ?></li>
      	<li><strong>Day: </strong><?php echo get_post_meta( $post->ID, 'ecpt_day', true ); ?></li>
      	<li><strong>Ph before: </strong><?php echo get_post_meta( $post->ID, 'ecpt_ph_reading', true ); ?></li>
      	<li><strong>Ph Adjustment: <?php echo get_post_meta( $post->ID, 'ecpt_ph_adjustment', true ); ?></li>
      	<li><strong>PPM Level: </strong><?php echo get_post_meta( $post->ID, 'ecpt_ppm_level', true ); ?></li>
      	<li><strong>PPM Adjustment: </strong><?php echo get_post_meta( $post->ID, 'ecpt_ppm_adjustment', true ); ?></li>
      	<li><strong>Temperature: </strong><?php echo get_post_meta( $post->ID, 'ecpt_temperature', true ); ?></li>
        <li><?php the_date() ?></li>
      </ul>
      <div class="blog-summary">
        <?php the_excerpt(); ?>
        <a hre="<?php the_permalink(); ?>"><button class="btn btn-sm btn-white">Read More</button></a>
      </div>
    </div>
  </div><!-- blog-item -->
</div><!-- col-xs-6 -->