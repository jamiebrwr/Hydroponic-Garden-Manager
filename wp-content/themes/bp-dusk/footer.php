<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package custody-agreements
 */
//echo get_page_template();
?>


		</div><!-- mainpanel -->

		<?php get_template_part('partials/panels/right', 'panel'); ?>

	</section>

	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-1.10.2.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-migrate-1.2.1.min.js"></script>
	<!-- <script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-ui-1.10.3.min.js"></script> -->
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/modernizr.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.sparkline.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/toggles.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/retina.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.cookies.js"></script>
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/flot/flot.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/flot/flot.resize.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/morris.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/raphael-2.1.0.min.js"></script>
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.datatables.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/chosen.jquery.min.js"></script>
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/custom.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/dashboard.js"></script>

	<?php get_footer( 'buddypress' ); ?>
	<?php wp_footer(); ?>
	<script>
  jQuery(document).ready(function() {
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Chosen Select
    jQuery("select").chosen({
      'min-width': '100px',
      'white-space': 'nowrap',
      disable_search_threshold: 10
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });
  
  
  });
</script>

	</body>
</html>
