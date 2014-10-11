<?php
function ft_app_cal_appearance() {
	if ( count($_POST) > 0 && isset($_POST['ft_settings']) ){
		$ft_options = array ('ft_tab_bg_1', 'ft_tab_bg_2', 'ft_hover_tab_bg_1', 'ft_hover_tab_bg_2', 'ft_hover_tab_txt_color', 'ft_tab_txt_color', 'ft_panel_border_thickness', 'ft_panel_border_color', 'ft_panel_heading_color', 'ft_panel_heading_size', 'ft_calculator_header_color', 'ft_calculator_rows_color', 'ft_calculator_result_color', 'ft_tab_txt_size', 'ft_grand_total_head_size', 'ft_grand_total_head_color', 'ft_grand_total_body_size', 'ft_grand_total_body_color', 'ft_tab_layout', 'ft_user_accordion');
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

	$content = '<div class="wrap">
	<h2>Calculator Apperance Settings</h2>';

	if(isset($_POST['ft_settings'])) {
		$content .= '<div class="updated below-h2" id="message"><p>Setting saved.</p></div>';
	}
	if(get_option('active_ft_tab_layout') == 'vertical') {
		$vertical = 'checked="checked"';
		$horizontal = '';
	} else {
		$horizontal = 'checked="checked"';
		$vertical = '';
	}
	if(get_option('active_ft_user_accordion') == 'yes') { 
		$accordion = 'checked="checked"';
	} else { 
		$accordion = '';
	}
$content .= '
<style type="text/css">
.iris-picker {
	position:absolute;
}
</style>
<form method="post" action="">
<h3>Tab layout settings</h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="blogname">Tabs Layout</label>
				</th>
				<td>
					<fieldset>
						<label><input name="ft_tab_layout" '.$vertical.' value="vertical" type="radio"> <span>Vertical</span></label><br>
						<label><input name="ft_tab_layout" '.$horizontal.' value="horizontal" type="radio"> <span>Horizontal</span></label>
					</fieldset>
				</td>
			</tr>
			<input name="ft_user_accordion" value="yes" type="hidden">
			
</tbody></table>
<hr>
<h3>Tab block apperance settings</h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="blogname">Background 1</label>
				</th>
				<td>
					<input name="ft_tab_bg_1" value="'.get_option('active_ft_tab_bg_1').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Background 2</label>
				</th>
				<td>
					<input name="ft_tab_bg_2" value="'.get_option('active_ft_tab_bg_2').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Text color</label>
				</th>
				<td>
					<input name="ft_tab_txt_color" value="'.get_option('active_ft_tab_txt_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Text Size</label>
				</th>
				<td>
					<input name="ft_tab_txt_size" value="'.get_option('active_ft_tab_txt_size').'" class="regular-text" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Active Background 1</label>
				</th>
				<td>
					<input name="ft_hover_tab_bg_1" value="'.get_option('active_ft_hover_tab_bg_1').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Active Background 2</label>
				</th>
				<td>
					<input name="ft_hover_tab_bg_2" value="'.get_option('active_ft_hover_tab_bg_2').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Active Tab Text color</label>
				</th>
				<td>
					<input name="ft_hover_tab_txt_color" value="'.get_option('active_ft_hover_tab_txt_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

</tbody></table>
<hr>
<h3>Tab Panel settings</h3>
<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="blogname">Border thickness</label>
				</th>
				<td>
					<input name="ft_panel_border_thickness" value="'.get_option('active_ft_panel_border_thickness').'" class="regular-text" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Border Color</label>
				</th>
				<td>
					<input name="ft_panel_border_color" value="'.get_option('active_ft_panel_border_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Panel Heading color</label>
				</th>
				<td>
					<input name="ft_panel_heading_color" value="'.get_option('active_ft_panel_heading_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Panel Heading Size</label>
				</th>
				<td>
					<input name="ft_panel_heading_size" value="'.get_option('active_ft_panel_heading_size').'" class="regular-text" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Calculator Header color</label>
				</th>
				<td>
					<input name="ft_calculator_header_color" value="'.get_option('active_ft_calculator_header_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Calculator Rows Color</label>
				</th>
				<td>
					<input name="ft_calculator_rows_color" value="'.get_option('active_ft_calculator_rows_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Calculator Result Color</label>
				</th>
				<td>
					<input name="ft_calculator_result_color" value="'.get_option('active_ft_calculator_result_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

</tbody></table>
<hr>
<h3>Grand Total Settings</h3>
<table class="form-table">
		<tbody>
			<tr>
				<th scope="row">
					<label for="blogname">Heading Font Size</label>
				</th>
				<td>
					<input name="ft_grand_total_head_size" value="'.get_option('active_ft_grand_total_head_size').'" class="regular-text" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Heading Color</label>
				</th>
				<td>
					<input name="ft_grand_total_head_color" value="'.get_option('active_ft_grand_total_head_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Grand Total Font Size</label>
				</th>
				<td>
					<input name="ft_grand_total_body_size" value="'.get_option('active_ft_grand_total_body_size').'" class="regular-text" type="text">
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="blogname">Grand Total Color</label>
				</th>
				<td>
					<input name="ft_grand_total_body_color" value="'.get_option('active_ft_grand_total_body_color').'" class="regular-text color-picker" type="text">
				</td>
			</tr>


</tbody></table>
	<p class="submit">
		<input type="hidden" name="ft_settings" value="save" style="display:none;" />
		<input class="button button-primary" value="Save Changes" type="submit">
	</p>
</form>
</div>';

echo $content;
}//add category function ends here.