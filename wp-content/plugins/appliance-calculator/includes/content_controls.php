<?php
function ft_content_controls() {
	if ( count($_POST) > 0 && isset($_POST['ft_control_settings']) ){
		$ft_options = array ('ft_instructions', 'ft_result_top', 'ft_review', 'ft_terms');
		foreach ($ft_options as $opt) {
			delete_option('active_'.$opt, $_POST[$opt]);
			add_option('active_'.$opt, $_POST[$opt]);	
		}
	}
 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	
	echo '<div class="wrap">
	<style type="text/css">
		#wpfooter { 
			display:none;
		}
	</style>
	<h2>Content Controls</h2>';
	
	if(isset($_POST['ft_control_settings'])) { 
		echo '<div class="updated below-h2" id="message"><p>Setting saved.</p></div>';
	}

echo '	
<form method="post" action="">
	<table class="form-table">
		<tbody>
			<tr>
				<td>
					<h3>Instructions</h3>
				';
		    $args = array("textarea_rows" => 5, "ft_instructions" => "ft_instructions", "editor_class" => "my_editor_custom", "media_buttons" => false);
 	if(get_option('active_ft_instructions') != '') { 
		wp_editor(stripslashes(get_option('active_ft_instructions')), "ft_instructions", $args);
	} else { 
		wp_editor('', "ft_instructions", $args);
	}
echo '</td>
			</tr>
			
			<tr>
				<td>
				<h3>Result</h3>
				';
		    $args = array("textarea_rows" => 5, "ft_result_top" => "ft_result_top", "editor_class" => "my_editor_custom", "media_buttons" => false);
 	if(get_option('active_ft_result_top') != '') { 
		wp_editor(stripslashes(get_option('active_ft_result_top')), "ft_result_top", $args);
	} else { 
		wp_editor('', "ft_result_top", $args);
	}
echo '</td>
			</tr>
			
			<tr>
				<td>
					<h3>Review</h3>
				';
		    $args = array("textarea_rows" => 5, "ft_review" => "ft_review", "editor_class" => "my_editor_custom", "media_buttons" => false);
 	if(get_option('active_ft_review') != '') { 
		wp_editor(stripslashes(get_option('active_ft_review')), "ft_review", $args);
	} else { 
		wp_editor('', "ft_review", $args);
	}
echo '</td>
			</tr>
			
			<tr>
				<td>
				<h3>Terms of use</h3>
				';
		    $args = array("textarea_rows" => 5, "ft_terms" => "ft_terms", "editor_class" => "my_editor_custom", "media_buttons" => false);
 	if(get_option('active_ft_terms') != '') { 
		wp_editor(stripslashes(get_option('active_ft_terms')), "ft_terms", $args);
	} else { 
		wp_editor('', "ft_terms", $args);
	}
echo '</td>
			</tr>
</tbody></table>
	<p class="submit">
		<input type="hidden" name="ft_control_settings" value="save" style="display:none;" />
		<input class="button button-primary" value="Save Changes" type="submit">
	</p>
</form>
<div style="clear:both;"></div>
</div></div></div>';

}//add category function ends here.