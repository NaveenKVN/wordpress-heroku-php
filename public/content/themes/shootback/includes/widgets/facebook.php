<?php
class widget_touchsize_facebook extends WP_Widget
{
  function widget_touchsize_facebook()
  {
    $widget_ops = array('classname' => 'widget_touchsize_facebook', 'description' => 'This is a Facebook like box and posts widget.' );
    parent::__construct('widget_touchsize_facebook', 'Facebook Like & Feed', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
	$showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
	$showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
	//$showheader = isset( $instance['showheader'] ) ? esc_attr( $instance['showheader'] ) : '';
	$likebox_width = isset( $instance['likebox_width'] ) ? esc_attr( $instance['likebox_width'] ) : '';						
	$likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';						
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	 <?php _e('Title:','shootback');?>  
	  <input class="upcoming" id="<?php echo $this->get_field_id('title'); ?>" size='40' name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p> 
  <p>
  <label for="<?php echo $this->get_field_id('pageurl'); ?>">
	  <?php _e('Page URL:','shootback');?> 
	  <input class="upcoming" id="<?php echo $this->get_field_id('pageurl'); ?>" size='40' name="<?php echo $this->get_field_name('pageurl'); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />
	<br />
      <small><?php _e('Please enter your page url. Example: https://www.facebook.com/touchsize','shootback');?>
	</small><br />
  </label>
  </p> 
  <p>
  <label for="<?php echo $this->get_field_id('showfaces'); ?>">
	  <?php _e('Show Faces:','shootback');?>
	  <select id="<?php echo $this->get_field_id('showfaces'); ?>" name="<?php echo $this->get_field_name('showfaces'); ?>" style="width:225px">
			<option <?php if($showfaces == 'true'){echo 'selected';}?> value="true"><?php _e('Yes','shootback');?></option>
			<option <?php if($showfaces == 'false'){echo 'selected';}?> value="false"><?php _e('No','shootback');?></option>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('showstream'); ?>">
	  <?php _e('Show Stream:','shootback');?> 
	   <select id="<?php echo $this->get_field_id('showstream'); ?>" name="<?php echo $this->get_field_name('showstream'); ?>" style="width:225px">
			<option <?php if($showstream == 'true'){echo 'selected';}?> value="true"><?php _e('Yes','shootback');?></option>
			<option <?php if($showstream == 'false'){echo 'selected';}?> value="false"><?php _e('No','shootback');?></option>
      </select>
  </label>
  </p> 
  <p>
  <label for="<?php echo $this->get_field_id('likebox_width'); ?>">
	  <?php _e('Like Box Width:','shootback');?>
	  <input class="upcoming" id="<?php echo $this->get_field_id('likebox_width'); ?>" size='2' name="<?php echo $this->get_field_name('likebox_width'); ?>" type="text" value="<?php echo esc_attr($likebox_width); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('likebox_height'); ?>">
	  <?php _e('Like Box Height:','shootback');?>
	  <input class="upcoming" id="<?php echo $this->get_field_id('likebox_height'); ?>" size='2' name="<?php echo $this->get_field_name('likebox_height'); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['pageurl'] = $new_instance['pageurl'];
	$instance['showfaces'] = $new_instance['showfaces'];	
	$instance['showstream'] = $new_instance['showstream'];
	$instance['showheader'] = $new_instance['showheader'];	
	$instance['likebox_width'] = $new_instance['likebox_width'];	
	$instance['likebox_height'] = $new_instance['likebox_height'];			
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
		$showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
		$showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
		$showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
		$likebox_width = empty($instance['likebox_width']) ? ' ' : apply_filters('widget_title', $instance['likebox_width']);													
		$likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);													
		
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo $title;
			echo $after_title;
			global $wpdb, $post;?>
			<?php	
			if($likebox_width == ' ' || $likebox_width == ''){$likebox_width = '300';}
			if($likebox_height == ' ' || $likebox_height == ''){$likebox_height = '315';}
			?>         

			<div class="fb-like-box" data-href="<?php echo $pageurl;?>" data-width="<?php echo $likebox_width;?>" data-height="<?php echo $likebox_height;?>"  data-show-faces="<?php echo $showfaces;?>" data-header="false" data-stream="<?php echo $showstream;?>" data-show-border="false"></div>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	<?php echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("widget_touchsize_facebook");') );?>