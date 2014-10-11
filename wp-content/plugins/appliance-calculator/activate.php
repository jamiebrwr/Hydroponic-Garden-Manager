<?php
//Installation of plugin starts here.
function ft_appliance_calculator_install() {
	//Installs default values on activation.
	if(get_option('active_ft_user_accordion') == '') { 
		add_option('active_ft_user_accordion', 'yes');
	}
	
	if(get_option('active_ft_tab_layout') == '') { 
		add_option('active_ft_tab_layout', 'vertical');
	}
	
	if(get_option('active_electric_rate_kwh') == '') { 
		add_option('active_electric_rate_kwh', '0.085');
	}
	
	if(get_option('active_ft_tab_bg_1') == '') { 
		add_option('active_ft_tab_bg_1', '#4b0101');
	}
	
	if(get_option('active_ft_tab_bg_2') == '') { 
		add_option('active_ft_tab_bg_2', '#7e0505');
	}
	
	if(get_option('active_ft_tab_txt_color') == '') { 
		add_option('active_ft_tab_txt_color', '#FFFFFF');
	}
	
	if(get_option('active_ft_hover_tab_bg_1') == '') { 
		add_option('active_ft_hover_tab_bg_1', '#c296f2');
	}
	
	if(get_option('active_ft_hover_tab_bg_2') == '') { 
		add_option('active_ft_hover_tab_bg_2', '#b5b1e6');
	}
	
	if(get_option('active_ft_hover_tab_txt_color') == '') { 
		add_option('active_ft_hover_tab_txt_color', '#FFFFFF');
	}
	
	if(get_option('active_ft_tab_txt_size') == '') { 
		add_option('active_ft_tab_txt_size', '13px');
	}
	
	if(get_option('active_ft_panel_border_thickness') == '') { 
		add_option('active_ft_panel_border_thickness', '5px');
	}
	
	if(get_option('active_ft_panel_border_color') == '') { 
		add_option('active_ft_panel_border_color', '#666666');
	}
	
	if(get_option('active_ft_panel_heading_color') == '') { 
		add_option('active_ft_panel_heading_color', '#CCCCCC');
	}
	
	if(get_option('active_ft_panel_heading_size') == '') { 
		add_option('active_ft_panel_heading_size', '16px');
	}
	
	if(get_option('active_ft_calculator_header_color') == '') { 
		add_option('active_ft_calculator_header_color', '#CCCCCC');
	}
	
	if(get_option('active_ft_calculator_rows_color') == '') { 
		add_option('active_ft_calculator_rows_color', '#666666');
	}
	
	if(get_option('active_ft_calculator_result_color') == '') { 
		add_option('active_ft_calculator_result_color', '#8DC63F');
	}
	
	if(get_option('active_ft_tab_txt_size') == '') { 
		add_option('active_ft_calculator_result_color', '14px');
	}
	
	if(get_option('active_ft_grand_total_head_size') == '') { 
		add_option('active_ft_grand_total_head_size', '16px');
	}
	
	if(get_option('active_ft_grand_total_head_color') == '') { 
		add_option('active_ft_grand_total_head_color', '#666666');
	}
	
	if(get_option('active_ft_grand_total_body_size') == '') { 
		add_option('active_ft_grand_total_body_size', '14px');
	}
	
	if(get_option('active_ft_grand_total_body_color') == '') { 
		add_option('active_ft_grand_total_body_color', '#000000');
	}
}//end of function wc_restaurant_install()