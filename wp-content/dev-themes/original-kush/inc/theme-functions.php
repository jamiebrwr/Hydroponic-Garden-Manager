<?php
/*-----------------------------------------------------------------------------------*/
/* Breadcrumb display */
/*-----------------------------------------------------------------------------------*/
function srh_leftpanel_wrapper_start() {
    do_action('srh_leftpanel_wrapper_start');
}
function srh_leftpanel_wrapper_end() {
    do_action('srh_leftpanel_wrapper_end');
}

/*-------------------------------------------------------------------------------------------*/
/* srh_leftpanel_wrapper_start */
/*-------------------------------------------------------------------------------------------*/
add_action( 'srh_leftpanel_wrapper_start','srh_leftpanel_wrapper_before',10 );
if ( ! function_exists( 'srh_leftpanel_wrapper_before' ) ) {
	function srh_leftpanel_wrapper_before () {
		echo '<div class="leftpanel">';
			echo '<div class="logopanel">';
		        echo '<h1><span>[</span> bracket <span>]</span></h1>';
		    echo '</div><!-- logopanel -->';
		    echo '<div class="leftpanelinner">'; ?>
	<?php } // End srh_page_wrapper_before()
} // End IF Statement


/*-------------------------------------------------------------------------------------------*/
/* srh_leftpanel_wrapper_end */
/*-------------------------------------------------------------------------------------------*/
add_action( 'srh_leftpanel_wrapper_end', 'srh_leftpanel_wrapper_after', 20 );
if ( ! function_exists( 'srh_leftpanel_wrapper_after' ) ) {
	function srh_leftpanel_wrapper_after () {
		echo '</div><!-- leftpanelinner -->';
	echo '</div><!-- leftpanel -->'; ?>
	<?php } // End srh_page_wrapper_before()
} // End IF Statement