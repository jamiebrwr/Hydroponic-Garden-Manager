<?php
/**
 * The Template for displaying all single posts.
 *
 * @package custody-agreements
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="contentpanel">
      <!-- content goes here... -->
      <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">×</a>
                <a href="" class="minimize">−</a>
              </div><!-- panel-btns -->
              <h3 class="panel-title"><?php the_title(); ?></h3>
            </div>
            <div class="panel-body">
            	<?php// ft_calculator(); ?>
              <?php get_template_part( 'content', 'single' ); ?>
            </div>
          </div>
    </div>
    
<?php endwhile; ?>

	<?php// custody_agreements_paging_nav(); ?>

<?php else : ?>

	<?php// get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
   
<?php get_footer(); ?>