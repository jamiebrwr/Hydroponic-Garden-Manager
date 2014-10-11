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
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<?php if ( current_theme_supports( 'bp-default-responsive' ) ) : ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php endif; ?>
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/bootstrap-override.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/jquery-ui-1.10.3.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/animate.min.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/animate.delay.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/toggles.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/chosen.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/lato.css">
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/roboto.css">
	
	<link rel="stylesheet" href="http://app.jamiebrewer.com/wp-content/themes/bp-dusk/css/style.default.css">
	
	<?php bp_head(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="overflow: visible;" id="bp-default">
	
	<!-- Page Preloader Animation -->
	<?php srh_preloader(); ?>

	<?php do_action( 'bp_before_container' ); ?>

	<section>

		<!-- Primary Menu -->
		<?php get_template_part('partials/panels/left', 'panel'); ?>

		<div class="mainpanel">
		
			<?php get_template_part('partials/header', 'bar'); ?>
		
			<?php get_template_part('partials/header', 'page'); ?>