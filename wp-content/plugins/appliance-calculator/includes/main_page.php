<?php
function ft_appliance_calculator() {
    echo "<h2>" . __( 'Appliance Calculator Options', 'menu-test' ) . "</h2>";
	 //must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
	?>
    <div class="wrap">
		<p>This plugin is generated to create a calculator on wordpress sites for appliances electricity cost and KWH calculations.</p>
        
        <p>To change color and apperance you can go to apperance under this plugin's menu. To add calculator on a page please using following shortcode in post/page or add php code in your theme template.</p>
        
        <h2>Shortcodes</h2>
        <p>Use following shortcode to add calculator in post/page.</p>
    	<pre>
        //Shortcode
        [ft_calculator]
        
        //PHP function for template.
        &lt;?ft_calculator(); ?&gt;
        </pre>
    </div>
<?php }