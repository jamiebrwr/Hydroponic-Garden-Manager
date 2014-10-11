<?php /*-------------------------------------------------------------------------------------------*/
/* Registered User Menu */
/*-------------------------------------------------------------------------------------------*/

if ( is_user_logged_in() ) {
		   
global $current_user;
get_currentuserinfo();
$set_current_user->ID . "\n";
$current_user->ID;

if ( $post->post_author == $current_user->ID ) {
      		echo $current_user->display_name . "\n";

	 } else {
	//Do Nothing
}} ?>