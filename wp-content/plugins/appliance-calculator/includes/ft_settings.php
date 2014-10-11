<?php
function ft_app_cal_settings() {
	if ( count($_POST) > 0 && isset($_POST['ft_settings_2']) ){
		$ft_options = array ('electric_rate_kwh');
		foreach ($ft_options as $opt) {
			if(is_numeric($_POST['electric_rate_kwh'])) { 
				delete_option('active_'.$opt, $_POST[$opt]);
				add_option('active_'.$opt, $_POST[$opt]);
			} else { 
				$error = 1;
			}
				
		}
	}
 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	
	$content = '<div class="wrap">
	<h2>Calculator General Settings</h2>';
	
	if(isset($_POST['ft_settings_2'])) { 
		if(isset($error) && $error == 1) { 
			$content .= '<div class="updated below-h2" id="message"><p>Electric rate should be a number.</p></div>';
		} else { 
			$content .= '<div class="updated below-h2" id="message"><p>Setting saved.</p></div>';
		}
		
	}
	
$content .= '	
<form method="post" action="">
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="blogname">Electric Rate per kWh $</label>
				</th>
				<td>
					<input name="electric_rate_kwh" value="'.get_option('active_electric_rate_kwh').'" class="regular-text" type="text">
				</td>
			</tr>
</tbody></table>

	<p class="submit">
		<input type="hidden" name="ft_settings_2" value="save" style="display:none;" />
		<input class="button button-primary" value="Save Changes" type="submit">
	</p>
</form>
</div>';

echo $content;
}//add category function ends here.