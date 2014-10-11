<?php

function ecpt_bonus_fields_help_menu() {
	add_submenu_page('easy-content-types/easy-content-types.php', 'Bonus Fields Help', 'Bonus Fields Help', 'manage_options', 'ecpt-bonus-fiends-help', 'ecpt_bonus_fields_help_page');
}
add_action('admin_menu', 'ecpt_bonus_fields_help_menu');

function ecpt_bonus_fields_help_page() {
	?>
	<div class="wrap">
		<div id="ecpt-wrap" class="ecpt-help-page">
			<h2><?php _e('ECPT Bonus Fields Help', 'ecpt'); ?></h2>
			<p><?php _e('Index', 'ecpt');?></p>
			<ul>
				<li><a href="#bonus-fields"><?php _e('Bonus Fields', 'ecpt'); ?></a>
					<ul>
						<li><a href="#reqs"><?php _e('Requirements', 'ecpt'); ?></a></li>
						<li><a href="#field-types"><?php _e('Field Types - Basic', 'ecpt'); ?></a></li>
					</ul>
				</li>		
				<li><a href="#field-types-usage"><?php _e('Field Types - Usage', 'ecpt'); ?></a>
					<ul>
						<li><a href="#taxonomy"><?php _e('Taxonomy Field Usage', 'ecpt'); ?></a></li>
						<li><a href="#menu-field"><?php _e('Menu Field Usage', 'ecpt'); ?></a></li>
						<li><a href="#color-field"><?php _e('Color Picker Field Usage', 'ecpt'); ?></a></li>
						<li><a href="#map-field"><?php _e('Map Field Usage', 'ecpt'); ?></a></li>
						<li><a href="#header-field"><?php _e('Header Field Usage', 'ecpt'); ?></a></li>
						<li><a href="#sep-field"><?php _e('Separator Field Usage', 'ecpt'); ?></a></li>
					</ul>
				</li>
			</ul>
			
				<h3 id="bonus-fields"><?php _e('Bonus Fields', 'ecpt'); ?></h3>
				
				<p id="reqs" class="ecpt_title"><strong><?php _e('Requirements', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>In order to use the bonus fields provided by this add-on plugin, it is required that you have Easy Content Types Version 2.3.3 or later installed and activated. If you are running a version of Easy Content Types less than 2.3.3, please download and install the latest version. It can be downloaded from your personal Downloads page on Code Canyon.</p>
				</div>
				
				<p id="field-types" class="ecpt_title"><strong><?php _e('Field Types - Basic', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>There are six additional meta field types provided by this add-on plugin.</p>
					<ol>
						<li>Taxonomy - This field type will allow you to choose a taxonomy from a list of all available taxonomies</li>
						<li>Menu - This field type will allow you to choose a menu from all custom 3.0 nav menus you have created</li>
						<li>Color Picker - This field type will provide a color picker that you can use to choose any color from an easy to use color wheel</li>
						<li>Map - This field type will allow you to enter and address and have it rendered as a google map</li>
						<li>Header - This field type will provide a header with description you can use to create sections in your meta box</li>
						<li>Separator - This field type will provide a separator that you can use to divide your meta box fields</li>
					</ol>
				</div>
				
				<h3 id="field-types-usage"><?php _e('Field Usage', 'ecpt'); ?></h3>
				
				<p id="taxonomy" class="ecpt_title"><strong><?php _e('Taxonomy Field Usage', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					<p>The taxonomy field is designed to provide an easy way for you to choose a taxonomy on a page by page (or post by post) basis. When using this field, all of the registered taxonomies available in your WordPress install will be listed in a drop down select menu inside of the meta box you placed the field.</p>
					<p>Once you have selected a taxonomy from the list (when in the post editor), you can then use this taxonomy name to render a variety of things. For example, you could use the taxonomy name selected in the meta field to display a list of terms belonging to that taxonomy by passing it to a function such as get_terms() in your template files</p>
					<p>This field is primarily for advanced users who are familiar with WordPress template tags and who are not afraid to touch a bit of code. However, if you are not an advanced user, you can still leverage the power of this field by using the included short code.</p>
					<p><strong>The Taxonomy Short Code</strong> - There is a unique short code included with this bonus fields plugin that allows you to display a list of terms (like post tags or categories) from any taxonomy. This short code is especially useful if you want to display a list of taxonomy term archives on a WordPress post or page.</p>
					
					<p>When used with a post (or page or custom post type) that has a taxonomy field value saved, this short code will output an unordered list of taxonomy terms from the chosen taxonomy. So the output will look something like this:</p>
					
					<ul>
						<li><a>Term 1</a></li>
						<li><a>Term 2</a></li>
						<li><a>Term 3</a></li>
						<li><a>Term 4</a></li>
						<li><a>Term 5</a></li>
					</ul>
					<p>Each of the terms are linked to their respective archive pages</p>
					
					<p>The short code looks like this:</p>
					
					<pre>[ecpt_taxonomy id="field_name" attached="true"]</pre>
					
					<p>The <strong>id</strong> parameter is the name of the taxonomy field you have created. So if you have created a taxonomy field called "archives", you would use id="archives".</p>
					<p>The <strong>attached</strong> parameter determines whether to display all non-empty terms from the taxonomy, or only those terms which are attached to the current post. If attached=true, then only those terms attached (selected/entered in the post editor sidebar) to the current post will be displayed. If attached=false, then all terms that have at least one post filed in them will be displayed.</p>
					
					<p>The exact short code you need to use for each taxonomy field you create can be found in the "Shortcode" column of the Meta Box Fields editor.</p>
					
				</div>
				
				
				<p id="menu-field" class="ecpt_title"><strong><?php _e('Menu Field Usage', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					
					<p>The menu field is designed to provide an easy way for you to choose a menu from a list of all available custom 3.0 nav menus available on your Wordpress site. When using this field, all of the registered menus available in your WordPress install will be listed in a drop down select menu inside of the meta box you placed the field.</p>
					
					<p>Once you have selected a menu from the list (when in the post editor), you can then use this menu name to render a the chosen menu on the front end of the site. You can display the menu manually by using the wp_nav_menu() function in your WordPress theme or by using the included short code (recommended for non-advanced users).</p>
					
					<p><strong>The Menu Field Short Code</strong> - There is a unique short code included with this bonus fields plugin that allows you to display a nav menu in a post/page/custom post type or text widget. The nav menu displayed is based upon the nav menu name chosen from the menu meta field.</p>
					
					<p>When used with a post (or page or custom post type) that has a menu field value saved, this short code will output an unordered list of links from the chosen nav menu. So the output will look something like this:</p>
					
					<ul>
						<li><a>Link 1</a></li>
						<li><a>Link 2</a></li>
						<li><a>Link 3</a>
							<ul>
								<li><a>Sublink 1</a></li>
								<li><a>Sublink 2</a></li>
							</ul>
						</li>
						<li><a>Link 4</a></li>
						<li><a>Link 5</a></li>
					</ul>
					<p>The order of the links will directly mirror the order you have placed them in in the WordPress Menus page.</p>
					
					<p>The short code looks like this:</p>
					
					<pre>[ecpt_menu id="field_name"]</pre>
					
					<p>The <strong>id</strong> parameter is the name of the menu field you have created. So if you have created a menu field called "menu", you would use id="menu".</p>
					
				</div>
				
				<p id="color-field" class="ecpt_title"><strong><?php _e('Color Picker Field Usage', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					
					<p>The color picker field is designed to provide you an easy way to customize the colors of your theme on a post-by-post basis. This field is primarily for advanced users who are able to edit their theme's template files.</p>
					
					<p>This field will allow you to "pick" a color from a pop-up color wheel. The hexadecimal color code is automatically entered into the field input. The field's background color also changes to the selected color.</p>
					
					<p>A realistic usage of this field would be to control the colors of certain elements of your post layout. For example, you could easily use this field to control the border color for every image in the post.</p>
					
					<p>There are a variety of methods you can use to incorporate color control into your theme, but here is a simple method. Let's assume that your post content is wrapped with a DIV with a class of "entry", and you want to change the border color of every image in the post. To do this, you could put this just above the opening DIV.entry tag:</p>
					
					<p>
						&lt;style type="text/css"&gt;<br/>
						&nbsp;&nbsp;div.entry img { border-color: &lt;?php echo get_post_meta($post-&gt;ID, 'ecpt_colorfield', true); ?&gt; }<br/>
						&lt;/style&gt;
					</p>
					<p>This is just a minimal example and there are countless other ways that you could use this field to enrich your publishing experience.</p>
				</div>
				
				<p id="map-field" class="ecpt_title"><strong><?php _e('Map Field Usage', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					
					<p>The map field is designed to to provide you a really easy way to display a google map of any address you wish. The field acts like a regular text field, but when displayed with the short code or template tag, a google map of the inputted address is rendered.</p>
					
					<p>To display a map in a post or page, you have two options: a shortcode or a template tag.</p>
					
					<p>The short code looks like this:</p>
					
					<pre>[ecpt_map id="field_name"]</pre>
				
					<p>The <strong>id</strong> parameter is the name of the map field you created. So if you have a map field called "address", you would use id="address".</p>
					
					<p>Note, there are a number of additional parameters available for this shortcode:</p>
					<ul>
						<li>id="" - the map field name</li>
						<li>height="400px" - the height of the map in pixels to show</li>
						<li>lat="" - the latitude of the the area to show on the map</li>
						<li>lng="" - the longitude of the the area to show on the map</li>
						<li>description="" - the text to show in the speech bubble over the specified point</li>
						<li>zoom="17" - the zoom level of the map, between 1 and 20</li>
						<li>fullscreen=false - whether to enable full screen mode</li>
						<li>type="ROADMAP" - the type of map to display: roadmap, satellite, hybrid, terrain</li>
						<li>disable_cache=false - whether to disable caching for the map</li>
					</ul>
					
				</div>
				
				<p id="header-field" class="ecpt_title"><strong><?php _e('Header Field Usage', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					
					<p>This field allows you to place header text in your meta box. When used in conjunction with the separator field, you can easily create "sections" in your meta box. The header field will display the name of the field on the left, and the description of the field on the right. </p>
					
				</div>
				
				<p id="sep-field" class="ecpt_title"><strong><?php _e('Separator Field Usage', 'ecpt'); ?></strong> - <a href="#ecpt-wrap"><?php _e('Back To Top', 'ecpt'); ?></a></p>
				<div class="ecpt_section">
					
					<p>This field is designed to give you a way to separate fields in your meta boxes. Simply place it between the fields you would like to separate. It will cause a horizontal line to be rendered wherever you place the field.</p>
					
				</div>
	
		</div>
	</div>
	<?php
}