<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------

TABLE OF CONTENTS

- Theme Setup
- Load style.css in the <head>
- Load responsive <meta> tags in the <head>
- Add custom styling to HEAD
- Add custom typography to HEAD
- Add layout to body_class output
- srh_feedburner_link
- Optionally load top navigation.
- Optionally load custom logo.
- Add custom CSS class to the <body> tag if the lightbox option is enabled.
- Load PrettyPhoto JavaScript and CSS if the lightbox option is enabled.
- Customise the default search form
- Load responsive IE scripts

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Theme Setup */
/*-----------------------------------------------------------------------------------*/
/**
 * Theme Setup
 *
 * This is the general theme setup, where we add_theme_support(), create global variables
 * and setup default generic filters and actions to be used across our theme.
 *
 * @package srhFramework
 * @subpackage Logic
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */

/*-----------------------------------------------------------------------------------*/
/* Optionally load top navigation. */
/*-----------------------------------------------------------------------------------*/

/*if ( ! function_exists( 'srh_page_wrapper' ) ) {
	function srh_page_wrapper_before () { ?>
		<div class="leftpanel">
			<div class="logopanel">
		        <h1><span>[</span> bracket <span>]</span></h1>
		    </div><!-- logopanel -->
	<?php } // End srh_page_wrapper_before()
} */

//add_action( 'srh_page_wrapper_before', 'srh_page_wrapper' );