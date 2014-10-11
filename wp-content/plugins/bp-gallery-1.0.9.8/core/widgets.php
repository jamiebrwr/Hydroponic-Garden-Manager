<?php
/* 
 * BP Gallery Widgets
 * 
 */
//register it
 function bp_gallery_register_widgets() {
	add_action('widgets_init', create_function('', 'return register_widget("BP_Gallery_Sitewide_Gallery_Widget");') );
	add_action('widgets_init', create_function('', 'return register_widget("BP_Gallery_Sitewide_Media_Widget");') );
	}
add_action( 'bp_loaded', 'bp_gallery_register_widgets' );

/**
 * Random gallery sitewide widgets
 */
class BP_Gallery_Sitewide_Gallery_Widget extends WP_Widget{
  
 	function __construct() {
		parent::__construct( false, $name = __( 'Sitewide Galleries', 'bp-gallery' ) );
	}

	function widget($args, $instance) {
		extract( $args );

		 echo $before_widget;
		echo $before_title
			. $instance['title']
			. $after_title;
			echo "<div id='sitewide-galleries-sitewide' class='sitewide-galleries-sitewide'>";
                        bp_gallery_list_galleries(array('max'=>$instance['count'],
                                                        'show_thumb'=>$instance['show_thumb'],
                                                        'type'=>$instance['type'],
                                                        'sort_order'=>$instance['sort_order'],
                                                        'orderby'=>$instance['orderby'],
                                                        'sitewide'=>true));
			echo "</div>";

		 echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = absint($new_instance['count'] ) ;//how many galleries
		$instance['type'] = $new_instance['type']  ;//how many galleries
		$instance['orderby'] = $new_instance['orderby']  ;//how many galleries
		$instance['sort_order'] = $new_instance['sort_order']  ;//how many galleries
		$instance['show_thumb'] = $new_instance['show_thumb'] ;//show thumbnail

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Sitewide Galleries','bp-gallery'), 'count' => 5,'show_thumb'=>true,'type'=>'','orderby'=>'date' ) );
		$title = strip_tags( $instance['title'] );
		$count = absint( $instance['count'] );
		$show_thumb =  $instance['show_thumb'] ;
		$orderby =  $instance['orderby'] ;
		$sort_order =  $instance['sort_order'] ;
	    $type= $instance['type'];
        ?>
		<p><label for="bpgallery-widget-sitewide-galleries-title"><?php _e('Title:', 'bp-gallery'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $title ) ); ?>" /></label></p>
			<p>
				<label for="bpgallery-widget-sitewide-galleries-count"><?php _e( 'How Many Galleries' , 'bp-gallery'); ?>
					<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" class="widefat" value="<?php echo attribute_escape( absint( $count ) ); ?>" />
				</label>
			</p>
                        <p>
				<label for="bpgallery-widget-sitewide-galleries-type"><?php _e( 'Filter Type' , 'bp-gallery'); ?>
					<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
                                            <option value=""><?php _e("All Types","bp-gallery");?></option>
                                            <option value="audio" <?php if($type=="audio") echo "selected='selected'";?>><?php _e("Audio Galleries Only",'bp-gallery');?></option>
                                            <option value="video" <?php if($type=="video") echo "selected='selected'";?>><?php _e("Video Galleries Only",'bp-gallery');?></option>
                                            <option value="photo" <?php if($type=="photo") echo "selected='selected'";?>><?php _e("Photo Galleries Only",'bp-gallery');?></option>
                                        </select>
                                </label>
			</p>
                        <p><label for="bpgallery-widget-sitewide-galleries-orderby"><?php _e( 'Order By' , 'bp-gallery'); ?>
                             <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
                                            <option value="date" <?php if($orderby=="date") echo "selected='selected'";?>><?php _e("Upload date","bp-gallery");?></option>
                                            <option value="alphabet" <?php if($orderby=="alphabet") echo "selected='selected'";?>><?php _e("Gallery Title",'bp-gallery');?></option>
                                            <option value="random" <?php if($orderby=="random") echo "selected='selected'";?>><?php _e("Random",'bp-gallery');?></option>
                                             </select>
                            </label>
                        </p>
                        <p><label for="bpgallery-widget-sitewide-galleries-sort_order"><?php _e( 'Sort Order' , 'bp-gallery'); ?>
                             <select id="<?php echo $this->get_field_id( 'sort_order' ); ?>" name="<?php echo $this->get_field_name( 'sort_order' ); ?>" class="widefat">
                                                <option value="ASC" <?php if($sort_order=="ASC") echo "selected='selected'";?>><?php _e("Ascending","bp-gallery");?></option>
                                                <option value="DESC" <?php if($sort_order=="DESC") echo "selected='selected'";?>><?php _e("Descending",'bp-gallery');?></option>
                              </select>
                            </label>
                        </p>

			<p>
				<label for="bpgallery-widget-sitewide-galleries_show_thumb"><?php _e( 'Show Thumbnail' , 'bp-gallery'); ?>
					<input type="checkbox" id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" class="widefat" value="1" <?php if( $show_thumb==true) echo "checked='checked'" ?>/>
				</label>
			</p>
	<?php
	}


}//end of class

class BP_Gallery_Sitewide_Media_Widget extends WP_Widget{

 	function __construct() {
		parent::__construct( false, $name = __( 'Sitewide Media', 'bp-gallery' ) );
	}

	function widget($args, $instance) {
		extract( $args );

		 echo $before_widget;
		echo $before_title
			. $instance['title']
			. $after_title;
			echo "<ul id='sitewide-media-sitewide'>";
                        bp_gallery_list_medias(array('per_page'=>$instance['count'],
                                                     'type'=>$instance['type'],
                                                     'orderby'=>$instance['orderby'],
                                                     'sort_order'=>$instance['sort_order'],
                                                     'show_thumb'=>$instance['show_thumb'],
                                                     'sitewide'=>true));
			echo "</ul>";

		 echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = absint($new_instance['count'] ) ;//how many galleries
		$instance['type'] = $new_instance['type']  ;//how many galleries
		$instance['orderby'] = $new_instance['orderby']  ;//how many galleries
		$instance['sort_order'] = $new_instance['sort_order']  ;//how many galleries
		$instance['show_thumb'] = $new_instance['show_thumb'] ;//show thumbnail

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __('Sitewide Media','bp-gallery'), 'count' => 5,'type'=>'','orderby'=>'date','sort_order'=>'DESC', 'show_thumb'=>true ) );
		$title = strip_tags( $instance['title'] );
		$count = absint( $instance['count'] );
		$type =  $instance['type'] ;
		$orderby =  $instance['orderby'] ;
		$sort_order = $instance['sort_order'] ;
		$show_thumb =  $instance['show_thumb'] ;
	?>
		<p><label for="bpgallery-widget-sitewide-medias-title"><?php _e('Title:', 'bp-gallery'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $title ) ); ?>" /></label></p>
			<p>
				<label for="bpgallery-widget-sitewide-media-count"><?php _e( 'How Many' , 'bp-gallery'); ?>
					<input type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" class="widefat" value="<?php echo attribute_escape( absint( $count ) ); ?>" />
				</label>
			</p>
                        <p>
				<label for="bpgallery-widget-sitewide-media-type"><?php _e( 'Filter Type' , 'bp-gallery'); ?>
					<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
                                            <option value=""><?php _e("All Types","bp-gallery");?></option>
                                            <option value="audio" <?php if($type=="audio") echo "selected='selected'";?>><?php _e("Only Audio",'bp-gallery');?></option>
                                            <option value="video" <?php if($type=="video") echo "selected='selected'";?>><?php _e("Only Video",'bp-gallery');?></option>
                                            <option value="photo" <?php if($type=="photo") echo "selected='selected'";?>><?php _e("Only Photo",'bp-gallery');?></option>
                                        </select>
                                </label>
			</p>
                        <p><label for="bpgallery-widget-sitewide-media-orderby"><?php _e( 'Order By' , 'bp-gallery'); ?>
                             <select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>" class="widefat">
                                            <option value="date" <?php if($orderby=="date") echo "selected='selected'";?>><?php _e("Upload date","bp-gallery");?></option>
                                            <option value="alphabet" <?php if($orderby=="alphabet") echo "selected='selected'";?>><?php _e("Media Title",'bp-gallery');?></option>
                                            <option value="random" <?php if($orderby=="random") echo "selected='selected'";?>><?php _e("Random",'bp-gallery');?></option>
                                             </select>
                            </label>
                        </p>
                        <p><label for="bpgallery-widget-sitewide-galleries-sort_order"><?php _e( 'Sort Order' , 'bp-gallery'); ?>
                             <select id="<?php echo $this->get_field_id( 'sort_order' ); ?>" name="<?php echo $this->get_field_name( 'sort_order' ); ?>" class="widefat">
                                                <option value="ASC" <?php if($sort_order=="ASC") echo "selected='selected'";?>><?php _e("Ascending","bp-gallery");?></option>
                                                <option value="DESC" <?php if($sort_order=="DESC") echo "selected='selected'";?>><?php _e("Descending",'bp-gallery');?></option>
                              </select>
                            </label>
                        </p>
                        
			<p>
				<label for="bpgallery-widget-sitewide-media_show_thumb"><?php _e( 'Show Thumbnail' , 'bp-gallery'); ?>
					<input type="checkbox" id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" class="widefat" value="1" <?php if( $show_thumb==true) echo "checked='checked'" ?>/>
				</label>
			</p>
	<?php
	}


}//end of class



?>