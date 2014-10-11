<?php
/**
 * Template Name: Freshbooks Dashboard
 *
 * The Blank page template displays the basic layout of a page.
 *
 * @package Underscores
 * @subpackage Template
 */
get_header();
require_once('inc/easyfreshbooks.class.php');
$freshbooks=new easyFreshBooksAPI();
$clientList=$freshbooks->clientList();
?>
<link href="<?php echo get_stylesheet_directory_uri() ?>/css/jquery.datatables.css" rel="stylesheet">
	<div class="contentpanel">
		
		
		
		
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-close">&times;</a>
			<a href="" class="minimize">&minus;</a>
		</div><!-- panel-btns -->
		<h3 class="panel-title">Data Tables</h3>
		<p>DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, which will add advanced interaction controls to any HTML table.</p>
	</div>
	
	<div class="panel-body">
		<h5 class="subtitle mb5">Basic Table</h5>
		<p class="m20">DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p>
		<br />
		<div class="table-responsive">
			<table class="table" id="table2">
				<thead>
					<tr>
						<th>Client ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$invoiceList=$freshbooks->invoiceList($filters);
					foreach($invoiceList as $invoiceitem){
					$invoices = $invoiceitem->invoice;
					if(is_array($invoices)){
					foreach($invoices as $invoice_details){ ?>
					<tr class="gradeA odd">
						<td class="center sorting_1"><?php echo $invoice_details->client_id; ?></td>
						<td class="center "><?php echo '<a href="' . $invoice_details->client_id . ' ">' . $invoice_details->first_name . '</a>'; ?></td>
						<td class="center "><?php echo $invoice_details->last_name; ?></td>
						<td class="center "><?php echo $invoice_details->amount; ?></td>
					</tr>
					<?php }
					}
					} ?>
				</tbody>
			</table>
		</div><!-- table-responsive -->
	</div><!-- panel-body -->
</div><!-- panel -->
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title">Data Tables</h3>
          <p>DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, which will add advanced interaction controls to any HTML table.</p>
        </div>
        <div class="panel-body">
          <h5 class="subtitle mb5">Basic Table</h5>
          <p class="m20">DataTables has most features enabled by default, so all you need to do to use it with one of your own tables is to call the construction function.</p>
          <br />
          <div class="table-responsive">
          <table class="table" id="table2">
              <thead>
                 <tr>
                    <th>Client ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Username</th>
                 </tr>
              </thead>
              <tbody>
                 <?php foreach($clientList as $item){
					$clients = $item->client;
					if(is_array($clients)){
						foreach($clients as $client_details){ ?>
						<tr class="gradeA odd">
							<td class="center sorting_1"><?php echo $client_details->client_id; ?></td>
							<td class="center "><?php echo '<a href="' . $client_details->client_id . ' ">' . $client_details->first_name . '</a>'; ?></td>
							<td class="center "><?php echo $client_details->last_name; ?></td>
							<td class="center "><?php echo $client_details->username; ?></td>
							<td class="center "><?php echo $client_details->username; ?></td>
						</tr>
				<?php }
					}
				 } ?>
              </tbody>
           </table>
           <div class="clearfix mb30"></div>
          </div><!-- table-responsive -->
          
        </div><!-- panel-body -->
      </div><!-- panel -->

</div>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/modernizr.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.sparkline.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/toggles.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/retina.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.cookies.js"></script>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.datatables.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/chosen.jquery.min.js"></script>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/custom.js"></script>
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
<?php get_footer(); ?>
