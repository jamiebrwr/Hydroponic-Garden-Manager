<?php
// action function for above hook
function ft_ad_pages() {
    // main_sub Menu Page
    add_menu_page(__('Appliance Calculator','root'), __('Appliance Calculator','root'), 'manage_options', 'ft-top-level-handle', 'ft_appliance_calculator');

    // Locations Page sub menu
    add_submenu_page('ft-top-level-handle', __('Appearance','root'), __('Appearance','root'), 'manage_options', 'ft_app_cal_appearance', 'ft_app_cal_appearance');
	
	// Locations Page sub menu
    add_submenu_page('ft-top-level-handle', __('Content Controls','root'), __('Content Controls','root'), 'manage_options', 'ft_content_controls', 'ft_content_controls');
	
	// Locations Page sub menu
    add_submenu_page('ft-top-level-handle', __('Settings','root'), __('Settings','root'), 'manage_options', 'ft_app_cal_settings', 'ft_app_cal_settings');
	
}