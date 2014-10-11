<?php
/**
 * Template Name: Blank Template
 *
 * The Blank page template displays the basic layout of a page.
 *
 * @package Underscores
 * @subpackage Template
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
            	<?php  echo $val = get_post_meta($post->ID, 'ecpt_quantity_tv_1', true); ?>
              <?php the_content(); ?>
            </div>
          </div>
    </div>
    
<?php endwhile; ?>

	<?php// custody_agreements_paging_nav(); ?>

<?php else : ?>

	<?php// get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
   
<?php get_footer(); ?>
