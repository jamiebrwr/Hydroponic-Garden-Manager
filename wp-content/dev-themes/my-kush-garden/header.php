<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package custody-agreements
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>

<!-- jQuery Progress bars -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  .ui-progressbar {
    position: relative;
  }
  #progressbar .ui-progressbar-value {
    background: #febbbb; /* Old browsers */
	background: -moz-linear-gradient(45deg,  #febbbb 0%, #fe9090 45%, #ff5c5c 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#febbbb), color-stop(45%,#fe9090), color-stop(100%,#ff5c5c)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(45deg,  #febbbb 0%,#fe9090 45%,#ff5c5c 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(45deg,  #febbbb 0%,#fe9090 45%,#ff5c5c 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(45deg,  #febbbb 0%,#fe9090 45%,#ff5c5c 100%); /* IE10+ */
	background: linear-gradient(45deg,  #febbbb 0%,#fe9090 45%,#ff5c5c 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#febbbb', endColorstr='#ff5c5c',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */


  }
  .progress-label {
    position: absolute;
    left: 50%;
    top: 4px;
    font-weight: bold;
    text-shadow: 1px 1px 0 #fff;
  }
  </style>
  <script>
  $(function() {
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" );
 
    progressbar.progressbar({
      value: false,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        progressLabel.text( "Complete!" );
      }
    });
 
    function progress() {
      var val = progressbar.progressbar( "value" ) || 0;
 
      progressbar.progressbar( "value", val + 1 );
 
      if ( val < 99 ) {
        setTimeout( progress, 100 );
      }
    }
 
    setTimeout( progress, 3000 );
  });
  </script>
<!-- END jQuery Progress bars -->


</head>



<body <?php body_class(); ?> style="overflow: visible;">



<section>

	<?php srh_page_wrapper_before(); ?>
	
	