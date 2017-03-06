<?php

/**
 * Gallery
 */
add_action( 'init', 'ts_create_gallery' );

function ts_create_gallery() {
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_gallery'])) ? $slug['slug_gallery'] : 'gallery';

    $labels = array(
        'name'               => __('Gallery', 'shootback'),
        'singular_name'      => __('Gallery', 'shootback'),
        'add_new'            => __('Add New', 'shootback'),
        'add_new_item'       => __('Add New Gallery', 'shootback'),
        'edit_item'          => __('Edit Gallery', 'shootback'),
        'new_item'           => __('New Gallery', 'shootback'),
        'all_items'          => __('All Galleries', 'shootback'),
        'view_item'          => __('View Gallery', 'shootback'),
        'search_items'       => __('Search Galleries', 'shootback'),
        'not_found'          => __('No galleries found', 'shootback'),
        'not_found_in_trash' => __('No galleries found in Trash', 'shootback'), 
        'parent_item_colon'  => '',
        'menu_name'          => __('Galleries', 'shootback'),
    );

    $args = array(
        'labels'   => $labels,
        'public'   => true,
        'supports' => array('title', 'thumbnail', 'author', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
        'menu_icon' => get_template_directory_uri() . '/includes/images/custom.gallery.png',
        'taxonomies' => array('post_tag', 'gallery_categories'),
        'rewrite' => array('slug' => $slug)
    );

    register_post_type( 'ts-gallery', $args );
}

add_action( 'init', 'ts_create_taxonomy_gallery', 0 );
function ts_create_taxonomy_gallery(){
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_gallery_taxonomy'])) ? $slug['slug_gallery_taxonomy'] : 'gallery-category';

    $labels = array(
        'name' => __( 'Category', 'shootback' ),
        'singular_name' => __( 'Gallery', 'shootback' ),
        'search_items' =>  __( 'Search Galleries', 'shootback' ),
        'popular_items' => __( 'Popular Galleries', 'shootback' ),
        'all_items' => __( 'All Galleries', 'shootback' ),
        'parent_item' => __( 'Parent Galleries', 'shootback' ),
        'parent_item_colon' => __( 'Parent Galleries:', 'shootback' ),
        'edit_item' => __( 'Edit Gallery', 'shootback' ),
        'update_item' => __( 'Update Gallery', 'shootback' ),
        'add_new_item' => __( 'Add New Galleries', 'shootback' ),
        'new_item_name' => __( 'New Gallery Name', 'shootback' ),
      );
      register_taxonomy('gallery_categories', array('gallery_categories'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $slug ),

      ));
}

function ts_gallery_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['ts_gallery'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Gallery updated. <a href="%s">View gallery</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Gallery updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Gallery published. <a href="%s">View gallery</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Gallery saved.', 'shootback'),
    8 => sprintf( __('Gallery submitted. <a target="_blank" href="%s">Preview gallery</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>', 'Gallery'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Gallery draft updated. <a target="_blank" href="%s">Preview gallery</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_gallery_updated_messages' );


/**
 * Event
 */
add_action( 'init', 'ts_create_event' );

function ts_create_event() {
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_event'])) ? $slug['slug_event'] : 'event';

    $labels = array(
        'name'               => __('Events', 'shootback'),
        'singular_name'      => __('Event', 'shootback'),
        'add_new'            => __('Add New', 'shootback'),
        'add_new_item'       => __('Add New Event', 'shootback'),
        'edit_item'          => __('Edit Event', 'shootback'),
        'new_item'           => __('New Event', 'shootback'),
        'all_items'          => __('All Events', 'shootback'),
        'view_item'          => __('View Event', 'shootback'),
        'search_items'       => __('Search Events', 'shootback'),
        'not_found'          => __('No events found', 'shootback'),
        'not_found_in_trash' => __('No events found in Trash', 'shootback'), 
        'parent_item_colon'  => '',
        'menu_name'          => __('Events', 'shootback'),
    );

    $args = array(
        'labels'   => $labels,
        'public'   => true,
        'supports' => array('title', 'thumbnail', 'author', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
        'menu_icon' => get_template_directory_uri() . '/includes/images/custom.event.png',
        'taxonomies' => array('post_tag', 'event_categories'),
        'rewrite' => array('slug' => $slug)
    );

    register_post_type( 'event', $args );
}

add_action( 'init', 'ts_create_taxonomy_events', 0 );
function ts_create_taxonomy_events(){
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_event_taxonomy'])) ? $slug['slug_event_taxonomy'] : 'event-taxonomy';

    $labels = array(
        'name' => __( 'Category', 'shootback' ),
        'singular_name' => __( 'Event', 'shootback' ),
        'search_items' =>  __( 'Search Events', 'shootback' ),
        'popular_items' => __( 'Popular Events', 'shootback' ),
        'all_items' => __( 'All Events', 'shootback' ),
        'parent_item' => __( 'Parent Events', 'shootback' ),
        'parent_item_colon' => __( 'Parent Events:', 'shootback' ),
        'edit_item' => __( 'Edit Event', 'shootback' ),
        'update_item' => __( 'Update Event', 'shootback' ),
        'add_new_item' => __( 'Add New Events', 'shootback' ),
        'new_item_name' => __( 'New Event Name', 'shootback' ),
      );
      register_taxonomy('event_categories', array('event_categories'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $slug ),

      ));
}

function ts_event_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['ts_event'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View event</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Event updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View event</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.', 'shootback'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>', 'event'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_event_updated_messages' );

add_action( 'add_meta_boxes', 'ts_event_add_custom_box' );
add_action( 'save_post', 'ts_event_save_post' );

function ts_event_add_custom_box()
{
    add_meta_box( 
        'event',
        __('Settings event', 'shootback'),
        'ts_event_options_custom_box',
        'event' 
    );
}

function ts_event_options_custom_box($post)
{
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ts_event_nonce' );     
    $event = get_post_meta($post->ID, 'event', TRUE);
    $day = get_post_meta($post->ID, 'day', TRUE);
  
    if( !$day ){
        $day = '';
    }else{
        if( !empty($day) ){
            $day = date('Y-m-d', $day);
        }
    }
   
    if ( !$event ) {
        $event = array();
        $event['start-time'] = '';
        $event['end-time'] = '';
        $event['event-days'] = '';
        $event['event-repeat'] = '';
        $event['event-enable-repeat'] = 'n';
        $event['forever'] = 'n';
        $event['event-end'] = '';
        $event['theme'] = '';
        $event['person'] = '';
        $event['map'] = '';
        $event['free-paid'] = '';
        $event['ticket-url'] = '';
        $event['price'] = '';
        $event['venue'] = '';
    }

    echo '<table>
            <tr valign="top">
                <td>' . __('Start day', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($day) .'" name="day" />
                </td>
            </tr>
            <tr>
                <td>' . __('End day', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['event-end']) .'" name="event[event-end]" />
                </td>
            </tr>
            <tr>
                <td>' . __('Start time', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['start-time']) .'" name="event[start-time]" />
                </td>
            </tr>
            <tr>
                <td>' . __('End time', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['end-time']) .'" name="event[end-time]" />
                </td>
            </tr>
            <tr>
                <td>' . __('Repeat event', 'shootback') . '</td>
                <td>
                    <select name="event[event-enable-repeat]">
                    	<option ' . selected($event['event-enable-repeat'], 'y', false) . ' value="y">' . __('Yes', 'shootback') . '</option>
                    	<option ' . selected($event['event-enable-repeat'], 'n', false) . ' value="n">' . __('No', 'shootback') . '</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td>' . __('Change event repeat', 'shootback') . '</td>
            	<td>
            		<select name="event[event-repeat]">
                    	<option ' . selected($event['event-repeat'], '1', false) . ' value="1">' . __('Weekly', 'shootback') . '</option>
                    	<option ' . selected($event['event-repeat'], '2', false) . ' value="2">' . __('Monthly', 'shootback') . '</option>
                    	<option ' . selected($event['event-repeat'], '3', false) . ' value="3">' . __('Yearly', 'shootback') . '</option>
                    </select>
            	</td>
            </tr>
            <tr>
                <td>' . __('Add theme here', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['theme']) .'" name="event[theme]" />
                </td>
            </tr>
            <tr>
                <td>' . __('Person', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['person']) .'" name="event[person]" />
                </td>
            </tr>
            <tr>
                <td>' . __('Map', 'shootback') . '</td>
                <td>
                    <textarea name="event[map]" cols="60" rows="5">' . $event['map'] . '</textarea>
                </td>
            </tr>
            <tr>
                <td>' . __('Free or paid', 'shootback') . '</td>
                <td>
                    <select class="ts-free-paid" name="event[free-paid]">
                        <option ' . selected($event['free-paid'], 'paid', false) . ' value="paid">' . __('Paid', 'shootback') . '</option>
                        <option ' . selected($event['free-paid'], 'free', false) . ' value="free">' . __('Free', 'shootback') . '</option>
                    </select>
                </td>
            </tr>
            <tr class="ts-event-price-url">
                <td>' . __('Price', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['price']) .'" name="event[price]" />
                </td>
            </tr>
            <tr class="ts-event-price-url">
                <td>' . __('Ticket buy URL', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['ticket-url']) .'" name="event[ticket-url]" />
                </td>
            </tr>
            <tr>
                <td>' . __('Venue', 'shootback') . '</td>
                <td>
                    <input size="60" type="text" value="'. esc_attr($event['venue']) .'" name="event[venue]" />
                </td>
            </tr>
        </table>
        <script>
            jQuery(document).ready(function(){
                jQuery(".ts-free-paid").change(function(){
                    if( jQuery(this).val() == "free" ){
                        jQuery(".ts-event-price-url").css("display", "none");
                    }else{
                        jQuery(".ts-event-price-url").css("display", "");
                    }
                });
                
                if( jQuery(".ts-free-paid").val() == "free" ){
                    jQuery(".ts-event-price-url").css("display", "none");
                }else{
                    jQuery(".ts-event-price-url").css("display", "");
                }
            });
        </script>
        ';

}

function ts_event_save_post($post_id)
{
    global $post;

    if ( isset($post->post_type) && @$post->post_type != 'event' ) {
        return;
    }
    
    if (!isset( $_POST['ts_event_nonce'] ) ||
        !wp_verify_nonce( $_POST['ts_event_nonce'], plugin_basename( __FILE__ ) ) 
    ) return;

    if( !current_user_can( 'edit_post', $post_id ) ) return;
    
    // array containing filtred slides
    $event = array();

    if( isset( $_POST['day'] ) ){
        $day = $_POST['day'];
    }else{
        $day = '';
    }
    
    if ( isset( $_POST['event'] ) && is_array( $_POST['event'] ) && !empty( $_POST['event'] )  ) {
        $t = $_POST['event'];
        $event['day'] = isset($day) ? esc_attr($day) : '';
        $event['start-time'] = isset($t['start-time']) ? esc_attr($t['start-time']) : '';
        $event['end-time'] = isset($t['end-time']) ? esc_attr($t['end-time']) : '';
        $event['event-enable-repeat'] = (isset($t['event-enable-repeat']) && ($t['event-enable-repeat'] == 'y' || $t['event-enable-repeat'] == 'n')) ? $t['event-enable-repeat'] : 'n';
        $event['event-end'] = isset($t['event-end']) ? $t['event-end'] : '';
        $event['event-repeat'] = (isset($t['event-repeat']) && ($t['event-repeat'] == '1' || $t['event-repeat'] == '2' || $t['event-repeat'] == '3')) ? $t['event-repeat'] : '';
        $event['theme'] = isset($t['theme']) ? esc_attr($t['theme']) : '';
        $event['person'] = isset($t['person']) ? esc_attr($t['person']) : '';
        $event['map'] = isset($t['map']) ? $t['map'] : '';
        $event['free-paid'] = (isset($t['free-paid']) && ($t['free-paid'] == 'free' || $t['free-paid'] == 'paid')) ? $t['free-paid'] : '';
        $event['ticket-url'] = isset($t['ticket-url']) ? esc_attr($t['ticket-url']) : '';
        $event['price'] = isset($t['price']) ? esc_attr($t['price']) : '';
        $event['venue'] = isset($t['venue']) ? esc_attr($t['venue']) : '';
        
    } else {
        $event['day'] = '';
        $event['start-time'] = '';
        $event['end-time'] = '';
        $event['event-days'] = '';
        $event['event-repeat'] = '';
        $event['event-enable-repeat'] = 'n';
        $event['forever'] = 'n';
        $event['event-end'] = 'n';
        $event['theme'] = '';
        $event['person'] = '';
        $event['map'] = '';
        $event['price'] = '';
        $event['ticket-url'] = '';
        $event['free-paid'] = '';
        $event['venue'] = '';

    }

    update_post_meta($post_id, 'event', $event);
    update_post_meta($post_id, 'day', strtotime($day));
}

/**
 * Sliders
 */
add_action( 'init', 'ts_create_slider' );

function ts_create_slider() {
	$labels = array(
		'name'               => __('Sliders', 'shootback'),
		'singular_name'      => __('Slider', 'shootback'),
		'add_new'            => __('Add New', 'shootback'),
		'add_new_item'       => __('Add New Slider', 'shootback'),
		'edit_item'          => __('Edit Slider', 'shootback'),
		'new_item'           => __('New Slider', 'shootback'),
		'all_items'          => __('All Sliders', 'shootback'),
		'view_item'          => __('View Slider', 'shootback'),
		'search_items'       => __('Search Sliders', 'shootback'),
		'not_found'          => __('No sliders found', 'shootback'),
		'not_found_in_trash' => __('No sliders found in Trash', 'shootback'), 
		'parent_item_colon'  => '',
		'menu_name'          => __('Sliders', 'shootback'),
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'supports'     => array('title'),
		'menu_icon'    => get_template_directory_uri() . '/includes/images/custom.slideshow.png'
	);

	register_post_type( 'ts_slider', $args );
}

function ts_slider_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['ts_slider'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Slider updated. <a href="%s">View slider</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Slider updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Slider restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Slider published. <a href="%s">View slider</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Slider saved.', 'shootback'),
    8 => sprintf( __('Slider submitted. <a target="_blank" href="%s">Preview slider</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Slider scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slider</a>', 'slider'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Slider draft updated. <a target="_blank" href="%s">Preview slider</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_slider_updated_messages' );
add_action( 'add_meta_boxes', 'ts_slider_add_custom_box' );
add_action( 'save_post', 'ts_slider_save_postdata' );

function ts_slider_add_custom_box()
{
	add_meta_box( 
        'ts_slider_options',
        'Slider Options',
        'ts_slider_options_custom_box',
        'ts_slider' 
    );

	add_meta_box( 
        'ts_slides',
        'Slides',
        'ts_slider_custom_box',
        'ts_slider' 
    );
}

function ts_slider_options_custom_box($post) {
	
    $slider_type = get_post_meta($post->ID, 'slider_type', TRUE);
	$slider_source = get_post_meta($post->ID, 'slider-source', TRUE);
    $slider_size = get_post_meta($post->ID, 'slider-size', TRUE);

    if( $slider_size ){
          $slider_width = $slider_size['width'];
          $slider_height = $slider_size['height'];
    }else{
        $slider_size = get_option('shootback_image_sizes');
        $slider_width = $slider_size['slider']['width'];
        $slider_height = $slider_size['slider']['height'];
    }

    if( $slider_source ){
        $slider_source = ($slider_source == 'latest-posts' || $slider_source == 'latest-videos' || $slider_source == 'latest-galleries' || $slider_source == 'custom-slides' || $slider_source == 'latest-featured-posts' || $slider_source == 'latest-featured-videos' || $slider_source == 'latest-featured-galleries') ? $slider_source : 'custom-slides';
    }else{
        $slider_source = 'custom-slides';
    }

	if ($slider_type) {
		$is_flexslider = ( $slider_type == 'flexslider' ) ? 'selected="selected"' : '';
        $is_slicebox = ( $slider_type == 'slicebox' ) ? 'selected="selected"' : '';
        $is_bxslider = ( $slider_type == 'bxslider' ) ? 'selected="selected"' : '';
        $is_paraslider = ( $slider_type == 'parallax' ) ? 'selected="selected"' : '';
		$is_streamslider = ( $slider_type == 'stream' ) ? 'selected="selected"' : '';
	} else {
		$is_flexslider = 'flexslider';
        $is_slicebox = '';
        $is_bxslider = '';
        $is_paraslider = '';
		$is_streamslider = '';
	}

	echo '
	<table>
        <tr>
            <td>' . __('Slider source', 'shootback') . '</td>
            <td>
                <select name="slider-source" id="ts-slider-source">
                    <option ' . selected($slider_source, 'latest-posts', false) . ' value="latest-posts">' . __('Latest posts', 'shootback') . '</option>
                    <option ' . selected($slider_source, 'latest-videos', false) . ' value="latest-videos">' . __('Latest videos', 'shootback') . '</option>
                    <option ' . selected($slider_source, 'latest-galleries', false) . ' value="latest-galleries">' . __('Latest galleries', 'shootback') . '</option>
                    <option ' . selected($slider_source, 'custom-slides', false) . ' value="custom-slides">' . __('Custom slides', 'shootback') . '</option>
                    <option ' . selected($slider_source, 'latest-featured-posts', false) . ' value="latest-featured-posts">' . __('Latest featured posts', 'shootback') . '</option>
                    <option ' . selected($slider_source, 'latest-featured-galleries', false) . ' value="latest-featured-galleries">' . __('Latest featured galleries', 'shootback') . '</option>
                    <option ' . selected($slider_source, 'latest-featured-videos', false) . ' value="latest-featured-videos">' . __('Latest featured videos', 'shootback') . '</option>
                </select>
            </td>
        </tr>
        <script>
            jQuery(document).ready(function(){
                jQuery("#ts-slider-source").change(function(){
                    if( jQuery(this).val() == "custom-slides" ){
                        jQuery("#ts_slides").css("display", "");
                    }else{
                        jQuery("#ts_slides").css("display", "none");
                    }
                });

                if( jQuery("#ts-slider-source").val() == "custom-slides" ){
                    jQuery("#ts_slides").css("display", "");
                }else{
                    jQuery("#ts_slides").css("display", "none");
                }
            });
        </script>
		<tr>
            <td>' . __('Slider type', 'shootback') . '</td>
            <td>
                <select name="slider_type">
                    <option value="flexslider" ' . $is_flexslider . '>' . __('Flex Slider', 'shootback') . '</option>
                    <option value="slicebox" ' . $is_slicebox . '>' . __('Slicebox', 'shootback') . '</option>
                    <option value="bxslider" ' . $is_bxslider . '>' . __('bxSlider', 'shootback') . '</option>
                    <option ' . disabled(fields::get_options_value('shootback_optimization', 'include_parallax'), 'n', true) . ' value="parallax" ' . $is_paraslider . '>' . __('Parallax slider', 'shootback') . '</option>
                    <option value="stream" ' . $is_streamslider . '>' . __('Stream slider', 'shootback') . '</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>' . __('Slider image width', 'shootback') . '</td>
            <td>
                <input type="text" name="slider-size[width]" value="' . absint($slider_width) . '" />px
            </td>
        </tr>
        <tr>
			<td>' . __('Slider image height', 'shootback') . '</td>
			<td>
				<input type="text" name="slider-size[height]" value="' . absint($slider_height) . '" />px
			</td>
		</tr>
	</table>';
}

function ts_slider_custom_box( $post )
{

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_slider_nonce' ); 
	$slides = get_post_meta($post->ID, 'ts_slides', TRUE);

	echo '<input type="button" class="button" id="add-slide" value="' .__('Add New Slide', 'shootback'). '" /><br/><br/>';
	echo '<ul id="ts-slides">';

	$slides_editor = '';
	
	if ( ! empty( $slides ) ) {
		$index = 0;
		foreach ( $slides as $slide_id => $slide ) {
			$index++;
			$slide_title = ($slide["slide_title"]) ? $slide["slide_title"] : 'Slide ' . $index;
			$slides_editor .= '
			<li class="ts-slide">
			<div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="slide-tab">'.$slide_title.'</span>
			</div>
			<table class="hidden">
				<tr>
					<td>' . __( 'Slide title', 'shootback' ) . '</td>
					<td>
						<input type="text" class="slide_title" name="ts_slider['.$slide_id.'][slide_title]" value="'.$slide["slide_title"].'" style="width: 100%" />
					</td>
				</tr>
				<tr>
					<td valign="top">' . __( 'Slide description', 'shootback' ) . '</td>
					<td>
						<textarea class="slide_description" name="ts_slider['.$slide_id.'][slide_description]" cols="60" rows="5">'.$slide["slide_description"].'</textarea>
					</td>
				</tr>
				<tr valign="top">
					<td>' . __( 'Slide URL', 'shootback' ) . '</td>
					<td>
						<input type="text" class="slide_url" name="ts_slider['.$slide_id.'][slide_url]" value="'.$slide["slide_url"].'" />
						<input type="hidden" class="slide_media_id" name="ts_slider['.$slide_id.'][slide_media_id]" value="'.$slide['slide_media_id'].'" />
						<input type="button" id="upload-'.$slide_id.'" class="button ts-upload-slide" value="' .__( 'Upload', 'shootback' ). '" /> <br />
						<div class="slide_preview"><img src="'.$slide["slide_url"].'" style="width: 400px" /></div>
					</td>
				</tr>
				<tr>
					<td>' . __( 'Redirect to URL', 'shootback' ) . '</td>
					<td>
						<input type="text" class="redirect_to_url" name="ts_slider['.$slide_id.'][redirect_to_url]" value="'.$slide['redirect_to_url'].'" style="width: 100%" />
					</td>
				</tr>
				<tr>
					<td>' . __( 'Select caption position', 'shootback' ) . '</td>
					<td>
						<select name="ts_slider['.$slide_id.'][slide_position]" class="slide_position">
							<option value="left" ' . selected($slide['slide_position'], 'left', false) . '>Left</option>
							<option value="center" ' . selected($slide['slide_position'], 'center', false) . '>Center</option>
							<option value="right" ' . selected($slide['slide_position'], 'right', false) . '>Right</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td><td><input type="button" class="button button-primary remove-slide" value="'.__('Remove', 'shootback').'" /></td>
				</tr>
			</table></li>';
		}
	}
	echo $slides_editor;
	echo '</ul>';
	echo '<script id="ts-add-slider" type="text/template">';
	echo '<li class="ts-slide">
	<div class="sortable-meta-element"><span class="tab-arrow icon-down"></span><span class="slide-tab">Slide {{slide-number}}</span>
	</div>
	<table>
		<tr>
			<td>' . __( 'Slide title', 'shootback' ) . '</td>
			<td>
				<input type="text" class="slide_title" name="ts_slider[slide-{{slide-id}}][slide_title]" value="" style="width: 100%" />
			</td>
		</tr>
		<tr>
			<td valign="top">' . __( 'Slide description', 'shootback' ) . '</td>
			<td>
				<textarea class="slide_description" name="ts_slider[slide-{{slide-id}}][slide_description]" cols="60" rows="5"></textarea>
			</td>
		</tr>
		<tr>
			<td>' . __( 'Slide URL', 'shootback' ) . '</td>
			<td>
				<input type="text" class="slide_url" name="ts_slider[slide-{{slide-id}}][slide_url]" value="" />
				<input type="hidden" class="slide_media_id" name="ts_slider[slide-{{slide-id}}][slide_media_id]" value="" />
				<input type="button" id="upload-{{slide-id}}" class="button ts-upload-slide" value="' .__( 'Upload', 'shootback' ). '" /> 
				<div class="slide_preview"></div>
			</td>
		</tr>
		<tr>
			<td>' . __( 'Redirect to URL', 'shootback' ) . '</td>
			<td>
				<input type="text" class="redirect_to_url" name="ts_slider[slide-{{slide-id}}][redirect_to_url]" value="" style="width: 100%" />
			</td>
		</tr>
        <tr>
            <td>' . __( 'Select caption position','hologram' ) . '</td>
            <td>
                <select name="ts_slider[slide-{{slide-id}}][slide_position]" class="slide_position">
                    <option value="left">' . __('Left', 'touchsize') . '</option>
                    <option value="center">' . __('Center', 'touchsize') . '</option>
                    <option value="right">' . __('Right', 'touchsize') . '</option>
                </select>
            </td>
        </tr>
		<tr>
			<td></td><td><input type="button" class="button button-primary remove-slide" value="'.__('Remove', 'shootback').'" /></td>
		</tr>
	</table></li>';
	echo '</script>';
?>
	<script>
	jQuery(document).ready(function($) {
		var slides_count = $("#ts-slides > li").length;
		// sortable portfolio items
		$("#ts-slides").sortable();

		$(document).on('change', '.slide_title', function(event) {
			event.preventDefault();
			var _this = $(this);
			_this.closest('.ts-slide').find('.slide-tab').text(_this.val());
		});

		var slides = $('#ts-slides'),
			slideTempalte = $('#ts-add-slider').html(),
			custom_uploader = {};
		  	
		if (typeof wp.media.frames.file_frame == 'undefined') {
		    wp.media.frames.file_frame = {};
		}


		$(document).on('click', '#add-slide', function(event) {
			event.preventDefault();

			slides_count++;
			var id = new Date().getTime();
			var slide_id = new RegExp('{{slide-id}}', 'g');
			var slide_number = new RegExp('{{slide-number}}', 'g');

			var template = slideTempalte.replace(slide_id, id).replace(slide_number, slides_count);
			slides.append(template);
		});


		$(document).on('click', '.remove-slide', function(event) {
			event.preventDefault();
			$(this).closest('li').remove();
			slides_count--;
		});

		
		$(document).on('click', '.ts-upload-slide', function(e) {
			e.preventDefault();
			
			var _this     = $(this),
				target_id = _this.attr('id'),
				media_id  = _this.closest('li').find('.slide_media_id').val();

			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader[target_id]) {
				custom_uploader[target_id].open();
				return;
			}

			//Extend the wp.media object
			custom_uploader[target_id] = wp.media.frames.file_frame[target_id] = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				library: {
					type: 'image'
				},
				multiple: false,
				selection: [media_id]
			});

			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader[target_id].on('select', function() {
				var attachment = custom_uploader[target_id].state().get('selection').first().toJSON();
				var slide = _this.closest('table');
				slide.find('.slide_url').val(attachment.url);
				slide.find('.slide_media_id').val(attachment.id);
				var img = $("<img>").attr('src', attachment.url).attr('style', 'width:400px');
				slide.find('.slide_preview').html(img);
			});

			//Open the uploader dialog
			custom_uploader[target_id].open();
		});
	});
	</script>
<?php
}

// saving slider
function ts_slider_save_postdata( $post_id )
{
	global $post;

    if ( isset($post->post_type) && @$post->post_type != 'ts_slider' ) {
        return;
    }
	
	if (!isset( $_POST['ts_slider_nonce'] ) ||
		!wp_verify_nonce( $_POST['ts_slider_nonce'], plugin_basename( __FILE__ ) ) 
	) return;

	if( !current_user_can( 'edit_post', $post_id ) ) return;
	
    if ( isset( $_POST['slider_type'] ) ) {
    	switch ($_POST['slider_type']) {
    		case 'flexslider':
    			$slider_type = 'flexslider';
    			break;

            case 'slicebox':
                $slider_type = 'slicebox';
                break;

    		case 'bxslider':
                $slider_type = 'bxslider';
                break;

            case 'parallax':
                $slider_type = 'parallax';
                break;

            case 'stream':
    			$slider_type = 'stream';
    			break;

    		default:
    			$slider_type = 'flexslider';
    			break;
    	}
    } else {
    	$slider_type = 'flexslider';
    }

	update_post_meta( $post_id, 'slider_type', $slider_type );

    if( isset($_POST['slider-source']) ){
        $slider_source = ($_POST['slider-source'] == 'latest-posts' || $_POST['slider-source'] == 'latest-videos' || $_POST['slider-source'] == 'latest-galleries' || $_POST['slider-source'] == 'custom-slides' || $_POST['slider-source'] == 'latest-featured-galleries' || $_POST['slider-source'] == 'latest-featured-videos' || $_POST['slider-source'] == 'latest-featured-posts') ? $_POST['slider-source'] : 'custom-slides';
    }else{
        $slider_source = 'custom-slides';
    }
    update_post_meta( $post_id, 'slider-source', $slider_source );

    if( isset($_POST['slider-size']) && is_array($_POST['slider-size']) && !empty($_POST['slider-size']) ){
        if( isset($_POST['slider-size']['height']) ) $slider_size['height'] = absint($_POST['slider-size']['height']);
        if( isset($_POST['slider-size']['width']) ) $slider_size['width'] = absint($_POST['slider-size']['width']);   
    }else{
        $slider_size = get_option('shootback_image_sizes');
        if( isset($slider_size['slider']['height']) ) $slider_size['height'] = absint($slider_size['slider']['height']);
        if( isset($slider_size['slider']['width']) ) $slider_size['width'] = absint($slider_size['slider']['width']);  
    }
    update_post_meta( $post_id, 'slider-size', $slider_size );

	// array containing filtred slides
    $slider = array();
    
    if ( isset( $_POST['ts_slider'] ) ) {
    	if ( is_array( $_POST['ts_slider'] ) && !empty( $_POST['ts_slider'] ) ) {
    		foreach ( $_POST['ts_slider'] as $slide_id => $slide ) {
				$s['slide_id']          = $slide_id;
				$s['slide_title']       = isset($slide['slide_title']) ? esc_attr($slide['slide_title']) : ''; 
				$s['slide_description'] = isset($slide['slide_description']) ?
											esc_textarea($slide['slide_description']) : ''; 
				$s['slide_url']         = isset($slide['slide_url']) ? esc_url($slide['slide_url']) : ''; 
				$s['slide_media_id']    = isset($slide['slide_media_id']) ? esc_attr($slide['slide_media_id']) : ''; 
				$s['redirect_to_url']   = isset($slide['redirect_to_url']) ? esc_url($slide['redirect_to_url']) : '';
				$s['slide_position']   = isset($slide['slide_position']) ? esc_attr($slide['slide_position']) : '';
    			$slider[] = $s; 
    		}
    	}
    }

    update_post_meta( $post_id, 'ts_slides', $slider );
}

/**
 * Video
 */
add_action( 'init', 'ts_create_taxonomy_videos', 0 );
function ts_create_taxonomy_videos(){
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_video_taxonomy'])) ? $slug['slug_video_taxonomy'] : 'videos_categories';

	$labels = array(
	    'name' => __( 'Category', 'shootback' ),
	    'singular_name' => __( 'Video', 'shootback' ),
	    'search_items' =>  __( 'Search Videos', 'shootback' ),
	    'popular_items' => __( 'Popular Videos', 'shootback' ),
	    'all_items' => __( 'All Videos', 'shootback' ),
	    'parent_item' => __( 'Parent Videos', 'shootback' ),
	    'parent_item_colon' => __( 'Parent Videos:', 'shootback' ),
	    'edit_item' => __( 'Edit Videos', 'shootback' ),
	    'update_item' => __( 'Update Videos', 'shootback' ),
	    'add_new_item' => __( 'Add New Videos', 'shootback' ),
	    'new_item_name' => __( 'New Videos Name', 'shootback' ),
	  );
	  register_taxonomy('videos_categories', array('videos_categories'), array(
	    'hierarchical' => true,
	    'labels' => $labels,
	    'show_ui' => true,
	    'query_var' => true,
	    'rewrite' => array( 'slug' => $slug ),
	  ));
}

add_action( 'init', 'ts_create_videos' );

function ts_create_videos()
{
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_video'])) ? $slug['slug_video'] : 'video';

	$labels = array(
		'name'               => __('Videos', 'shootback'),
		'singular_name'      => __('Video', 'shootback'),
		'add_new'            => __('New Video', 'shootback'),
		'add_new_item'       => __('Add New Video', 'shootback'),
		'edit_item'          => __('Edit Video', 'shootback'),
		'new_item'           => __('New Video', 'shootback'),
		'all_items'          => __('All Videos', 'shootback'),
		'view_item'          => __('View Video', 'shootback'),
		'search_items'       => __('Search Videos', 'shootback'),
		'not_found'          => __('No video found', 'shootback'),
		'not_found_in_trash' => __('No video found in Trash', 'shootback'), 
		'parent_item_colon'  => '',
		'menu_name'          => __('Videos', 'shootback')
	);

	$args = array(
		'labels'   => $labels,
		'map_meta_cap' => true,
		'public'   => true,
		'supports' => array('title', 'thumbnail', 'author', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.video.png',
		'taxonomies' => array('videos_categories', 'post_tag'),
        'rewrite' => array( 'slug' => $slug ),
	);

	register_post_type( 'video', $args );
}

function ts_videos_updated_messages( $messages )
{
  global $post, $post_ID;

  $messages['video'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Information about video updated. <a href="%s">View video</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Video updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Videos restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Video published. <a href="%s">View video</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Video saved.', 'shootback'),
    8 => sprintf( __('Video submitted. <a target="_blank" href="%s">Preview Video</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Video scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview video</a>', 'shootback'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Video draft updated. <a target="_blank" href="%s">Preview video</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_videos_updated_messages' );

add_action( 'add_meta_boxes', 'ts_videos_add_custom_box' );
add_action( 'save_post', 'ts_videos_save_post' );

function ts_videos_add_custom_box()
{
	add_meta_box( 
        'video',
        __('Insert Video', 'shootback'),
        'ts_videos_options_custom_box',
        'video' 
    );
}

function ts_videos_options_custom_box($post)
{
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_videos_nonce' ); 	
	$videos = get_post_meta($post->ID, 'video', TRUE);

	if (!$videos) {
		$videos = array();
		$videos['extern_url'] = '';
		$videos['your_url'] = '';
	}

	echo '<table>
			<tr valign="top">
				<td>' . __('Insert video url here:', 'shootback') . '</td>
				<td>
					<textarea name="video[extern_url]" cols="60" rows="5">'.esc_url($videos['extern_url']).'</textarea>
				</td>
			</tr>
			<tr>
				<td>' . __('Insert your video here:', 'shootback') . '</td>
				<td>
					<input type="text" value="'. esc_url($videos['your_url']) .'" name="video[your_url]"  id="custom-type-upload-videos"/>
	                <input type="button" class="button" id="select-custom-type-video" value="Upload" />
	                <input type="hidden" value="" id="select-custom_media_id" />
				</td>
			</tr>
		</table>';

}

function ts_videos_save_post($post_id)
{
	global $post;

    if ( isset($post->post_type) && @$post->post_type != 'video' ) {
        return;
    }
	
	if (!isset( $_POST['ts_videos_nonce'] ) ||
		!wp_verify_nonce( $_POST['ts_videos_nonce'], plugin_basename( __FILE__ ) ) 
	) return;

	if( !current_user_can( 'edit_post', $post_id ) ) return;
	
	// array containing filtred slides
    $videos = array();
    
    if ( isset( $_POST['video'] ) && is_array( $_POST['video'] ) && !empty( $_POST['video'] )  ) {
		$t = $_POST['video'];
		$videos['extern_url'] = isset($t['extern_url']) ? esc_url($t['extern_url']) : '';
		$videos['your_url'] = isset($t['your_url']) ? esc_url($t['your_url']) : '';
	
    } else {
		$videos['extern_url'] = '';
		$videos['your_url'] = '';

    }

    update_post_meta( $post_id, 'video', $videos );
}

/**
 * Teams
 */
add_action( 'init', 'ts_create_teams' );

function ts_create_teams()
{
	$labels = array(
		'name'               => __('Teams', 'shootback'),
		'singular_name'      => __('Teams', 'shootback'),
		'add_new'            => __('New Member', 'shootback'),
		'add_new_item'       => __('Add New Member', 'shootback'),
		'edit_item'          => __('Edit Member', 'shootback'),
		'new_item'           => __('New Member', 'shootback'),
		'all_items'          => __('All Members', 'shootback'),
		'view_item'          => __('View Member', 'shootback'),
		'search_items'       => __('Search Members', 'shootback'),
		'not_found'          =>  __('No members found', 'shootback'),
		'not_found_in_trash' => __('No members found in Trash', 'shootback'), 
		'parent_item_colon'  => '',
		'menu_name'          => __('Teams', 'shootback')
	);

	$args = array(
		'labels'   => $labels,
		'public'   => true,
		'supports' => array('title', 'thumbnail', 'editor'),
		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.team.png'
	);

	register_post_type( 'ts_teams', $args );
}

function ts_teams_updated_messages( $messages )
{
  global $post, $post_ID;

  $messages['ts_teams'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Information about team member updated. <a href="%s">View member</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Member updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Member restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Member published. <a href="%s">View member</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Member saved.', 'shootback'),
    8 => sprintf( __('Member submitted. <a target="_blank" href="%s">Preview member</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview member</a>', 'shootback'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Member draft updated. <a target="_blank" href="%s">Preview member</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_teams_updated_messages' );
add_action( 'init', 'create_teams_tax' );

function create_teams_tax() 
{
   register_taxonomy(
      'teams',
      'ts_teams',
      array(
         'label' => __( 'Teams', 'shootback' ),
         'rewrite' => array( 'slug' => 'teams' ),
         'hierarchical' => true
      )
   );
}

add_action( 'add_meta_boxes', 'ts_teams_add_custom_box' );
add_action( 'save_post', 'ts_teams_save_post' );

function ts_teams_add_custom_box()
{
	add_meta_box( 
        'ts_member',
        __('About Team Member', 'shootback'),
        'ts_teams_options_custom_box',
        'ts_teams' 
    );

    add_meta_box( 
        'ts_member_networks',
        __('Social Networks', 'shootback'),
        'ts_teams_social_networks_custom_box',
        'ts_teams' 
    );
}

function ts_teams_options_custom_box($post)
{
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_teams_nonce' ); 	
	$teams = get_post_meta($post->ID, 'ts_member', TRUE);
    
	if (!$teams) {
		$teams = array();
		$teams['about_member'] = '';
        $teams['position'] = '';
		$teams['team-user'] = '';
	}

    $args = array(
        'blog_id'      => $GLOBALS['blog_id'],
        'role'         => '',
        'meta_key'     => '',
        'meta_value'   => '',
        'meta_compare' => '',
        'meta_query'   => array(),
        'include'      => array(),
        'exclude'      => array(),
        'orderby'      => 'login',
        'order'        => 'ASC',
        'offset'       => '',
        'search'       => '',
        'number'       => '',
        'count_total'  => false,
        'fields'       => 'all',
        'who'          => ''
    );
    $users = get_users($args);
    $html = '';

    if( isset($users) && is_array($users) && count($users) > 0 ){
        $none = ($teams['team-user'] == 'none' || $teams['team-user'] == '') ? ' selected="selected"' : '';
        $html .= '<select name="teams[team-user]">
                    <option' . $none . ' value="none">' . __('None', 'shootback') . '</option>';
        foreach($users as $user){
            if( is_object($user) && isset($user->ID, $user->user_login) ){
                if( $teams['team-user'] == $user->ID ) $selected = ' selected="selected"';
                else $selected = '';
                $html .= '<option' . $selected . ' value="' . $user->ID . '">' . $user->user_login . '</option>';
            }
        }   
        $html .= '</select>';
    }

	echo '<table>
		<tr valign="top">
			<td>' . __('Short information', 'shootback') . '</td>
			<td>
				<textarea name="teams[about_member]" cols="60" rows="5">'.esc_attr($teams['about_member']).'</textarea>
			</td>
		</tr>
		<tr>
            <td>' . __('Title', 'shootback') . '</td>
            <td>
                <input type="text" name="teams[position]" value="'.esc_attr($teams['position']).'" />
            </td>
        </tr>
        <tr>
			<td>' . __('Link team member to a user', 'shootback') . '</td>
			<td>
				' . balanceTags($html, true) . '
			</td>
		</tr>
		</table>';

}

function ts_teams_social_networks_custom_box($post)
{
	$teams = get_post_meta($post->ID, 'ts_member', TRUE);
	
	if (!$teams) {
		$teams = array();
		$teams['facebook'] = '';
		$teams['twitter'] = '';
		$teams['linkedin'] = '';
		$teams['gplus'] = '';
	}

	echo '<table class="socials-admin">
		<tr>
			<td><i alt="Facebook" class="icon-facebook"></i></td>
			<td>
				<input type="text" name="teams[facebook]" value="'.$teams['facebook'].'" />
			</td>
		</tr>
		<tr>
			<td><i alt="Twitter" class=" icon-twitter"></i></td>
			<td>
				<input type="text" name="teams[twitter]" value="'.$teams['twitter'].'" />
			</td>
		</tr>
		<tr>
			<td><i alt="LinkedIn" class="icon-linkedin"></i></td>
			<td>
				<input type="text" name="teams[linkedin]" value="'.$teams['linkedin'].'" />
			</td>
		</tr>
		<tr>
			<td><i alt="Google+" class="icon-gplus"></i></td>
			<td>
				<input type="text" name="teams[gplus]" value="'.$teams['gplus'].'" />
			</td>
		</tr>
	</table>';
}

function ts_teams_save_post($post_id)
{
	global $post;

    if ( isset($post->post_type) && @$post->post_type != 'ts_teams' ) {
        return;
    }
	
	if (!isset( $_POST['ts_teams_nonce'] ) ||
		!wp_verify_nonce( $_POST['ts_teams_nonce'], plugin_basename( __FILE__ ) ) 
	) return;

	if( !current_user_can( 'edit_post', $post_id ) ) return;
	
	// array containing filtred slides
    $teams = array();
    
    if ( isset( $_POST['teams'] ) && is_array( $_POST['teams'] ) && !empty( $_POST['teams'] )  ) {
		$t = $_POST['teams'];
		$teams['about_member'] = isset($t['about_member']) ? wp_kses_post($t['about_member']) : '';
		$teams['position']     = isset($t['position']) ? sanitize_text_field($t['position']) : '';
		$teams['linkedin']     = isset($t['linkedin']) ? esc_url_raw($t['linkedin']) : '';
		$teams['gplus']        = isset($t['gplus']) ? esc_url_raw($t['gplus']) : '';
		$teams['twitter']      = isset($t['twitter']) ? esc_url_raw($t['twitter']) : '';
        $teams['facebook']     = isset($t['facebook']) ? esc_url_raw($t['facebook']) : '';
		$teams['team-user']    = isset($t['team-user']) ? sanitize_text_field($t['team-user']) : '';
    } else {
		$teams['about_member'] = '';
		$teams['position']     = '';
		$teams['linkedin']     = '';
		$teams['twitter']      = '';
		$teams['gplus']        = '';
        $teams['facebook']     = '';
		$teams['team-user']    = '';
    }

    update_post_meta( $post_id, 'ts_member', $teams );
}

/**
 * Testimonials
 */
// add_action( 'init', 'ts_testimonials' );
// function ts_testimonials() {
// 	$labels = array(
// 		'name'               => __('Testimonials', 'shootback'),
// 		'singular_name'      => __('Testimonial', 'shootback'),
// 		'add_new'            => __('Add New', 'shootback'),
// 		'add_new_item'       => __('Add New Testimonial', 'shootback'),
// 		'edit_item'          => __('Edit Testimonial', 'shootback'),
// 		'new_item'           => __('New Testimonial', 'shootback'),
// 		'all_items'          => __('All Testimonials', 'shootback'),
// 		'view_item'          => __('View Testimonial', 'shootback'),
// 		'search_items'       => __('Search Testimonials', 'shootback'),
// 		'not_found'          =>  __('No Testimonials found', 'shootback'),
// 		'not_found_in_trash' => __('No Testimonials found in Trash', 'shootback'), 
// 		'parent_item_colon'  => '',
// 		'menu_name'          => __('Testimonials', 'shootback')
// 	);

// 	$args = array(
// 		'labels'   => $labels,
// 		'public'   => true,
// 		'supports' => array('title', 'thumbnail', 'editor'),
// 		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.testimonial.png'
// 	);

// 	register_post_type( 'ts_testimonials', $args );
// }

// function ts_testimonials_updated_messages( $messages ) {
//   global $post, $post_ID;

//   $messages['ts_testimonials'] = array(
//     0 => '', // Unused. Messages start at index 1.
//     1 => sprintf( __('Testimonial updated. <a href="%s">View testimonial</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
//     2 => __('Custom field updated.', 'shootback'),
//     3 => __('Custom field deleted.', 'shootback'),
//     4 => __('Testimonial updated.', 'shootback'),
//     /* translators: %s: date and time of the revision */
//     5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
//     6 => sprintf( __('Testimonial published. <a href="%s">View Testimonial</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
//     7 => __('Testimonial saved.', 'shootback'),
//     8 => sprintf( __('Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
//     9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>', 'shootback'),
//       // translators: Publish box date format, see http://php.net/date
//       date_i18n( __( 'M j, Y @ G:i', 'touchsize ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
//     10 => sprintf( __('Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
//   );

//   return $messages;
// }

// add_filter( 'post_updated_messages', 'ts_testimonials_updated_messages' );
// add_action( 'add_meta_boxes', 'ts_testimonials_add_custom_box' );
// add_action( 'save_post', 'ts_testimonials_save_post' );

// add_action( 'init', 'create_testimonials_tax' );

// function create_testimonials_tax() 
// {
//    register_taxonomy(
//       'testimonials',
//       'ts_testimonials',
//       array(
//          'label' => __( 'Testimonials', 'shootback' ),
//          'rewrite' => array( 'slug' => 'testimonials' ),
//          'hierarchical' => true
//       )
//    );
// }

// function ts_testimonials_add_custom_box()
// {
// 	add_meta_box( 
//         'ts_testimonial_info',
//         'About The Person',
//         'ts_testimonials_options_custom_box',
//         'ts_testimonials' 
//     );
// }

// function ts_testimonials_save_post($post_id)
// {
// 	global $post;

//     if ( isset($post->post_type) && @$post->post_type != 'ts_testimonials' ) {
//         return;
//     }
	
// 	if ( ! isset( $_POST['ts_testimonials_nonce'] ) ||
// 		 ! wp_verify_nonce( $_POST['ts_testimonials_nonce'], plugin_basename( __FILE__ ) ) 
// 	) return;

// 	if( ! current_user_can( 'edit_post', $post_id ) ) return;
	
//     $testimonial_info = array();

//     if ( isset( $_POST['testimonials_info'] ) &&
//     	is_array( $_POST['testimonials_info'] ) &&
//     	! empty( $_POST['testimonials_info'] ) 
//     ) {
//     	$ti = $_POST['testimonials_info'];
// 		$testimonial_info['person_name'] = isset($ti['person_name']) ? esc_attr($ti['person_name']) : '';
// 		$testimonial_info['company'] = isset($ti['company']) ? esc_attr($ti['company']) : '';
// 		$testimonial_info['site_url'] = isset($ti['site_url']) ? esc_attr($ti['site_url']) : '';
//     } else {
// 		$testimonial_info['person_name'] = '';
// 		$testimonial_info['company'] = '';
// 		$testimonial_info['site_url'] = '';
//     }

//     update_post_meta( $post_id, 'testimonial_info', $testimonial_info );
// }

// function ts_testimonials_options_custom_box($post)
// {
// 	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_testimonials_nonce' );

// 	$ti = get_post_meta($post->ID, 'testimonial_info', TRUE);
	
// 	if ( ! $ti) {
// 		$ti['person_name'] = '';
// 		$ti['company'] = '';
// 		$ti['site_url'] = '';
// 		$ti['photo_url'] = '';
// 	}

// 	echo '
// 	<table>
// 		<tr>
// 			<td>Person name</td>
// 			<td><input type="text" name="testimonials_info[person_name]" value="'.$ti['person_name'].'" /></td>
// 		</tr>
// 		<tr>
// 			<td>Company</td>
// 			<td><input type="text" name="testimonials_info[company]" value="'.$ti['company'].'" /></td>
// 		</tr>
// 		<tr>
// 			<td>Site URL</td>
// 			<td><input type="text" name="testimonials_info[site_url]" value="'.$ti['site_url'].'" /></td>
// 		</tr>
// 	</table>';

// }


// /**
//  * Blockquotes
//  */
// add_action( 'init', 'ts_blockquotes' );
// function ts_blockquotes() {
// 	$labels = array(
// 		'name'               => __('Blockquotes'),
// 		'singular_name'      => __('Blockquote', 'shootback'),
// 		'add_new'            => __('Add New', 'shootback'),
// 		'add_new_item'       => __('Add New Blockquote', 'shootback'),
// 		'edit_item'          => __('Edit Blockquote', 'shootback'),
// 		'new_item'           => __('New Blockquote', 'shootback'),
// 		'all_items'          => __('All Blockquotes', 'shootback'),
// 		'view_item'          => __('View Blockquote', 'shootback'),
// 		'search_items'       => __('Search Blockquotes', 'shootback'),
// 		'not_found'          => __('No Blockquotes found', 'shootback'),
// 		'not_found_in_trash' => __('No Blockquotes found in Trash', 'shootback'), 
// 		'parent_item_colon'  => '',
// 		'menu_name'          => 'Blockquotes'
// 	);

// 	$args = array(
// 		'labels'   => $labels,
// 		'public'   => true,
// 		'supports' => array('title', 'editor'),
// 		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.blockquote.png'
// 	);

// 	register_post_type( 'blockquotes', $args );
// }

// function ts_blockquotes_updated_messages( $messages ) {
//   global $post, $post_ID;

//   $messages['blockquotes'] = array(
//     0 => '', // Unused. Messages start at index 1.
//     1 => sprintf( __('Blockquote updated. <a href="%s">View blockquote</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
//     2 => __('Custom field updated.', 'shootback'),
//     3 => __('Custom field deleted.', 'shootback'),
//     4 => __('Blockquote updated.', 'shootback'),
//     /* translators: %s: date and time of the revision */
//     5 => isset($_GET['revision']) ? sprintf( __('Blockquote restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
//     6 => sprintf( __('Blockquote published. <a href="%s">View Blockquote</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
//     7 => __('Blockquote saved.', 'shootback'),
//     8 => sprintf( __('Blockquote submitted. <a target="_blank" href="%s">Preview blockquote</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
//     9 => sprintf( __('Blockquote scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview blockquote</a>', 'blockquote'),
//       // translators: Publish box date format, see http://php.net/date
//       date_i18n( __( 'M j, Y @ G:i', 'touchsize ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
//     10 => sprintf( __('Blockquote draft updated. <a target="_blank" href="%s">Preview blockquote</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
//   );

//   return $messages;
// }

// add_filter( 'post_updated_messages', 'ts_blockquotes_updated_messages' );
// add_action( 'add_meta_boxes', 'ts_blockquotes_add_custom_box' );
// add_action( 'save_post', 'ts_blockquotes_save_post' );

// function ts_blockquotes_add_custom_box()
// {
// 	add_meta_box( 
//         'ts_blockquote',
//         __('Aditional Info'),
//         'ts_blockquotes_options_custom_box',
//         'blockquotes' 
//     );
// }

// function ts_blockquotes_save_post($post_id)
// {
// 	global $post;

//     if ( @$post->post_type != 'blockquotes' ) {
//         return;
//     }
	
// 	if (!isset( $_POST['ts_blockquote_nonce'] ) ||
// 		!wp_verify_nonce( $_POST['ts_blockquote_nonce'], plugin_basename( __FILE__ ) ) 
// 	) return;

// 	if( !current_user_can( 'edit_post', $post_id ) ) return;
	
//     $blockquote = array();

//     if ( isset( $_POST['blockquote'] ) &&
//     	is_array( $_POST['blockquote'] ) &&
//     	! empty( $_POST['blockquote'] ) 
//     ) {
//     	$b = $_POST['blockquote'];
// 		$blockquote['author'] = isset($b['author']) ? esc_attr($b['author']) : '';
// 		$blockquote['author_position'] = isset($b['author_position']) ? esc_attr($b['author_position']) : '';
//     } else {
// 		$blockquote['author'] = '';
// 		$blockquote['author_position'] = '';
//     }

//     update_post_meta( $post_id, 'blockquote', $blockquote );
// }

// function ts_blockquotes_options_custom_box($post)
// {
// 	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_blockquote_nonce' );

// 	$b = get_post_meta($post->ID, 'blockquote', TRUE);
	
// 	if ( ! $b) {
// 		$b['author'] = '';
// 		$b['author_position'] = '';
// 	}

// 	echo '
// 	<table>
// 		<tr>
// 			<td>'.__('Author', 'shootback') .'</td>
// 			<td><input type="text" name="blockquote[author]" value="'.$b['author'].'" /></td>
// 		</tr>
// 		<tr>
// 			<td>'.__('Author title', 'shootback').'</td>
// 			<td><input type="text" name="blockquote[author_position]" value="'.$b['author_position'].'" /></td>
// 		</tr>
// 	</table>';
// }

/**
 * Feature blocks
 */
// add_action( 'init', 'ts_feature_blocks' );
// add_action( 'save_post', 'ts_feature_block_save_post' );

// function ts_feature_blocks() {
// 	$labels = array(
// 		'name'               => __('Feature Blocks', 'shootback'),
// 		'singular_name'      => __('Feature Blocks', 'shootback'),
// 		'add_new'            => __('Add New', 'shootback'),
// 		'add_new_item'       => __('Add New Feature Blocks', 'shootback'),
// 		'edit_item'          => __('Edit Feature Blocks', 'shootback'),
// 		'new_item'           => __('New Feature Blocks', 'shootback'),
// 		'all_items'          => __('All Feature Blocks', 'shootback'),
// 		'view_item'          => __('View Feature Blocks', 'shootback'),
// 		'search_items'       => __('Search Feature Blocks', 'shootback'),
// 		'not_found'          => __('No Feature Blocks found', 'shootback'),
// 		'not_found_in_trash' => __('No Feature Blocks found in Trash', 'shootback'), 
// 		'parent_item_colon'  => '',
// 		'menu_name'          => __('Feature Blocks', 'shootback')
// 	);

// 	$args = array(
// 		'labels'   => $labels,
// 		'public'   => true,
// 		'supports' => array('title', 'editor', 'thumbnail'),
// 		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.feature.png'
// 	);

// 	register_post_type( 'feature-blocks', $args );
// }

// function ts_feature_blocks_updated_messages( $messages ) {
//   global $post, $post_ID;

//   $messages['feature-blocks'] = array(
//     0 => '', // Unused. Messages start at index 1.
//     1 => sprintf( __('Feature Blocks updated. <a href="%s">View Feature Blocks</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
//     2 => __('Custom field updated.', 'shootback'),
//     3 => __('Custom field deleted.', 'shootback'),
//     4 => __('Feature Blocks updated.', 'shootback'),
//     /* translators: %s: date and time of the revision */
//     5 => isset($_GET['revision']) ? sprintf( __('Feature Blocks restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
//     6 => sprintf( __('Feature Blocks published. <a href="%s">View Feature Blocks</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
//     7 => __('Feature Blocks saved.', 'shootback'),
//     8 => sprintf( __('Feature Blocks submitted. <a target="_blank" href="%s">Preview Feature Blocks</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
//     9 => sprintf( __('Feature Blocks scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Feature Blocks</a>', 'Feature Blocks'),
//       // translators: Publish box date format, see http://php.net/date
//       date_i18n( __( 'M j, Y @ G:i', 'touchsize ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
//     10 => sprintf( __('Feature Blocks draft updated. <a target="_blank" href="%s">Preview Feature Blocks</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
//   );

//   return $messages;
// }

// add_filter( 'post_updated_messages', 'ts_feature_blocks_updated_messages' );

// add_action( 'init', 'create_feature_blocks_tax' );

// function create_feature_blocks_tax() 
// {
// 	register_taxonomy(
// 		'feature-blocks-categories',
// 		'feature-blocks',
// 		array(
// 			'label' => __( 'Categories', 'shootback' ),
// 			'hierarchical' => true
// 		)
// 	);
// }

// add_action( 'add_meta_boxes', 'ts_feature_block_add_custom_box' );

// function ts_feature_block_add_custom_box()
// {
// 	add_meta_box(
// 		'ts_feature_block',
// 		__( 'Feature block options', 'shootback' ),
// 		'ts_feature_block_url_custom_box',
// 		'feature-blocks'
// 	);
// }

// function ts_feature_block_url_custom_box($post)
// {
// 	// Use nonce for verification
// 	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_feature_block_nonce' ); 
// 	$feature_block = get_post_meta($post->ID, 'ts_feature_block', TRUE);

// 	$url = empty( $feature_block['url'] ) ? '' : esc_url($feature_block['url']);
// 	$bg_color = empty( $feature_block['background_color'] ) ? '#f2836b' : esc_attr($feature_block['background_color']);
// 	$font_color = empty( $feature_block['font_color'] ) ? '#000000' : esc_attr($feature_block['font_color']);

// 	echo '
// 	<table>
// 		<tr>
// 			<td  valign="top">'.__('Feature block URL', 'shootback') .'</td>
// 			<td><input type="text" name="ts_feature_block[url]" value="'. $url . '" /></td>
// 		</tr>
// 		<tr>
// 			<td valign="top">
// 				<label for="feature-blocks-background-color">'.__( 'Background/Border color', 'shootback' ) .':</label>
// 			</td>
// 			<td>
// 				<input type="text" id="feature-blocks-background-color" name="ts_feature_block[background_color]" value="'.$bg_color.'"/>  
// 				<div id="feature-blocks-background-color-picker"></div>
// 			</td>
// 		</tr>
// 		<tr>
// 			<td valign="top">
// 				<label for="feature-blocks-font-color">' . __( 'Font color', 'shootback' ) .':</label>
// 			</td>
// 			<td>
// 				<input type="text" id="feature-blocks-font-color" name="ts_feature_block[font_color]" value="'.$font_color.'" />
// 				<div id="feature-blocks-font-color-picker"></div>
// 			</td>
// 		</tr>
// 	</table>';

// 	echo "<script>
// 	jQuery(document).ready(function($) {
// 		if ($('#feature-blocks-background-color-picker').length) {
// 			$('#feature-blocks-background-color-picker').hide();
// 			$('#feature-blocks-background-color-picker').farbtastic('#feature-blocks-background-color');
// 			$(document).on('click', '#feature-blocks-background-color', function(event) {
// 				event.stopPropagation();
// 				$('#feature-blocks-background-color-picker').show();
// 			});

// 			$(document).on('click', function() {
// 				$('#feature-blocks-background-color').val($.farbtastic('#feature-blocks-background-color-picker').color);
// 				$('#feature-blocks-background-color-picker').hide();
// 			});
// 		};

// 		if ($('#feature-blocks-font-color-picker').length) {
// 			$('#feature-blocks-font-color-picker').hide();
// 			$('#feature-blocks-font-color-picker').farbtastic('#feature-blocks-font-color');
// 			$(document).on('click', '#feature-blocks-font-color', function(event) {
// 				event.stopPropagation();
// 				$('#feature-blocks-font-color-picker').show();
// 			});

// 			$(document).on('click', function() {
// 				$('#feature-blocks-font-color').val($.farbtastic('#feature-blocks-font-color-picker').color);
// 				$('#feature-blocks-font-color-picker').hide();
// 			});
// 		};
// 	});
// 	</script>";

// }

// function ts_feature_block_save_post() {
	
// 	global $post;

// 	if ( @$post->post_type != 'feature-blocks' ) {
// 		return;
// 	}

// 	if ( ! isset( $_POST['ts_feature_block'] ) ||
// 		 ! wp_verify_nonce( $_POST['ts_feature_block_nonce'], plugin_basename( __FILE__ ) ) 
// 	) return;

// 	if( !current_user_can( 'edit_post', $post->ID ) ) return;
	
// 	if (isset($_POST['ts_feature_block']['url'])) {
// 		$_POST['ts_feature_block']['url'] = esc_url($_POST['ts_feature_block']['url']);
// 	} else {
// 		$_POST['ts_feature_block']['url'] = '';
// 	}

// 	$_POST['ts_feature_block']['font_color'] = isset($_POST['ts_feature_block']['font_color'] ) ?
// 											$_POST['ts_feature_block']['font_color']  : '#ffffff';

// 	$_POST['ts_feature_block']['font_color']  = preg_match('/^#[a-f0-9]{3,6}$/i', $_POST['ts_feature_block']['font_color'] ) ?$_POST['ts_feature_block']['font_color']  : '#ffffff';
	
// 	$_POST['ts_feature_block']['background_color'] = isset($_POST['ts_feature_block']['background_color']) ? 
// 													$_POST['ts_feature_block']['background_color']: '#f2836b';

// 	$_POST['ts_feature_block']['background_color'] = preg_match('/^#[a-f0-9]{3,6}$/i', $_POST['ts_feature_block']['background_color']) ? $_POST['ts_feature_block']['background_color'] : '#f2836b';

//     update_post_meta( $post->ID, 'ts_feature_block', $_POST['ts_feature_block'] );
// }

/**
 * Portfolio
 */
add_action( 'init', 'ts_create_portfolio' );
function ts_create_portfolio() {
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_portfolio'])) ? $slug['slug_portfolio'] : 'portfolio';

	$labels = array(
		'name'               => __('Portfolio', 'shootback'),
		'singular_name'      => __('Portfolio', 'shootback'),
		'add_new'            => __('Add New Item', 'shootback'),
		'add_new_item'       => __('Add New Item', 'shootback'),
		'edit_item'          => __('Edit Item', 'shootback'),
		'new_item'           => __('New Item', 'shootback'),
		'all_items'          => __('All Items', 'shootback'),
		'view_item'          => __('View Item', 'shootback'),
		'search_items'       => __('Search items', 'shootback'),
		'not_found'          =>  __('No items found', 'shootback'),
		'not_found_in_trash' => __('No items found in Trash', 'shootback'), 
		'parent_item_colon'  => '',
		'menu_name'          => __('Portfolio', 'shootback')
	);

	$args = array(
		'labels'   => $labels,
		'public'   => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.portfolio.png',
		'menu_position' => 4,
        'rewrite' => array('slug' => $slug)
	);

	register_post_type( 'portfolio', $args );
}

function ts_portfolio_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['portfolio'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Portfolio Item updated. <a href="%s">View Portfolio Item</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Portfolio Item updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Slider restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Portfolio Item published. <a href="%s">View Portfolio Item</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Portfolio Item saved.', 'shootback'),
    8 => sprintf( __('Portfolio Item submitted. <a target="_blank" href="%s">Preview Portfolio Item</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Portfolio Item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio Item</a>', 'slider'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Portfolio Item draft updated. <a target="_blank" href="%s">Preview Portfolio Item</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_portfolio_updated_messages' );
add_action( 'add_meta_boxes', 'ts_portfolio_add_custom_box' );
add_action( 'save_post', 'ts_portfolio_save_postdata' );

function ts_portfolio_add_custom_box()
{
	add_meta_box( 
        'ts_portfolio',
        'Portfolio',
        'ts_portfolio_custom_box',
        'portfolio' 
    );
}

function ts_portfolio_custom_box( $post )
{
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_portfolio_nonce' ); 
	$portfolio_items = get_post_meta($post->ID, 'ts_portfolio', TRUE);
	$portfolio_details = get_post_meta($post->ID, 'ts_portfolio_details', TRUE);

	echo '
	<h4>' . __( 'Portfolio details', 'shootback' ) . '</h4>
	<table width="450"><tr class="portfolio-client">
				<td>' . __( 'Client', 'shootback' ) . '</td>
				<td>
					<input type="text" class="client" name="portfolio_details[client]" value="'.@$portfolio_details['client'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="portfolio-services">
				<td>' . __( 'Services', 'shootback' ) . '</td>
				<td>
					<input type="text" class="services" name="portfolio_details[services]" value="'.@$portfolio_details['services'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="portfolio-client-url">
				<td>' . __( 'Project URL', 'shootback' ) . '</td>
				<td>
					<input type="text" class="client_url" name="portfolio_details[project_url]" value="'.@$portfolio_details['project_url'].'" style="width: 100%" />
				</td>
			</tr></table><br><br>';
	echo '<input type="button" class="button" id="add-item" value="' .__('Add New Portfolio Item', 'shootback'). '" /><br/>';
	echo '<ul id="portfolio-items">';
	
	$portfolio_editor = '';

	if (!empty($portfolio_items)) {
		$index = 0;
		foreach ($portfolio_items as $portfolio_item_id => $portfolio_item) {
			$index++;
			$is_image = ($portfolio_item['item_type'] == 'i') ? 'checked="checked"' : ''; 
			$is_video = ($portfolio_item['item_type'] == 'v') ? 'checked="checked"' : ''; 

			$portfolio_editor .= '
			<li class="portfolio-item">
			<div class="sortable-meta-element"><span class="tab-arrow icon-up"></span> <span class="portfolio-item-tab">'.($portfolio_item['slide_title'] ? $portfolio_item['slide_title'] : 'Slide ' . $index).'</span></div>
			<table class="hidden">
			<tr>
				<td>' . __( 'Item type', 'shootback' ) . '</td>
				<td>
					<label for="item-type-image-'.$portfolio_item_id.'">
						<input type="radio" class="item-type-image" name="portfolio['.$portfolio_item_id.'][item_type]" value="i" checked="checked" id="item-type-image-'.$portfolio_item_id.'" '.$is_image.'/> Image
					</label> 
					<label for="item-type-video-'.$portfolio_item_id.'">
						<input type="radio" class="item-type-video" name="portfolio['.$portfolio_item_id.'][item_type]" value="v" id="item-type-video-'.$portfolio_item_id.'" '.$is_video.'/> Video
					</label>
				</td>
			</tr>
			<tr>
				<td>' . __( 'Title', 'shootback' ) . '</td>
				<td>
					<input type="text" class="slide_title" name="portfolio['.$portfolio_item_id.'][slide_title]" value="'.$portfolio_item['slide_title'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="portfolio-embed '.( $is_image ? 'hidden' : '' ).'">
				<td valign="top">' . __( 'Embed/Video URL<br/>(<a href="http://codex.wordpress.org/Embeds#Can_I_Use_Any_URL_With_This.3F" target="_blank">supported sites</a>)', 'shootback' ) . '</td>
				<td>
					<textarea name="portfolio['.$portfolio_item_id.'][embed]" cols="60" rows="5">'.$portfolio_item['embed'].'</textarea>
				</td>
			</tr>
			<tr class="portfolio-description '.( $is_video ? 'hidden' : '' ).'">
				<td valign="top">' . __( 'Description', 'shootback' ) . '</td>
				<td>
					<textarea class="slide_description" name="portfolio['.$portfolio_item_id.'][description]" cols="60" rows="5">'.$portfolio_item['description'].'</textarea>
				</td>
			</tr>
			<tr class="portfolio-image-url '.( $is_video ? 'hidden' : '' ).'">
				<td>' . __( 'Image URL', 'shootback' ) . '</td>
				<td>
					<input type="text" class="slide_url" name="portfolio['.$portfolio_item_id.'][item_url]" value="'.$portfolio_item['item_url'].'" />
					<input type="hidden" class="slide_media_id" name="portfolio['.$portfolio_item_id.'][media_id]" value="'.$portfolio_item['media_id'].'" />
					<input type="button" id="upload-'.$portfolio_item_id.'" class="button ts-upload-slide" value="' .__( 'Upload', 'shootback' ). '" /> 
				</td>
			</tr>
			<tr class="portfolio-redirect-url '.( $is_video ? 'hidden' : '' ).'">
				<td>' . __( 'Redirect to URL', 'shootback' ) . '</td>
				<td>
					<input type="text" class="redirect_to_url" name="portfolio['.$portfolio_item_id.'][redirect_to_url]" value="'.$portfolio_item['redirect_to_url'].'" style="width: 100%" />
				</td>
			</tr>
			<tr>
				<td></td><td><input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" /></td>
			</tr>
			</table>

			</li>';
		}
	}

	echo $portfolio_editor;
	
	echo '</ul>';

	echo '<script id="portfolio-items-template" type="text/template">';
	echo '<li class="portfolio-item">
	<div class="sortable-meta-element"><span class="tab-arrow icon-up"></span> <span class="portfolio-item-tab">Slide {{slide-number}}</span></div>
	<table>
		<tr>
			<td>' . __( 'Item type', 'shootback' ) . '</td>
			<td>
				<label for="item-type-image-{{item-id}}">
					<input type="radio" class="item-type-image" name="portfolio[{{item-id}}][item_type]" value="i" checked="checked" id="item-type-image-{{item-id}}"/> Image
				</label> 
				<label for="item-type-video-{{item-id}}">
					<input type="radio" class="item-type-video" name="portfolio[{{item-id}}][item_type]" value="v" id="item-type-video-{{item-id}}" /> Video
				</label>
			</td>
		</tr>
		<tr>
			<td>' . __( 'Title', 'shootback' ) . '</td>
			<td>
				<input type="text" class="slide_title" name="portfolio[{{item-id}}][slide_title]" value="" style="width: 100%" />
			</td>
		</tr>
		<tr class="portfolio-embed hidden">
			<td valign="top">' . __( 'Embed/Video URL<br/>(<a href="http://codex.wordpress.org/Embeds#Can_I_Use_Any_URL_With_This.3F" target="_blank">supported sites</a>)', 'shootback' ) . '</td>
			<td>
				<textarea name="portfolio[{{item-id}}][embed]" cols="60" rows="5"></textarea>
			</td>
		</tr>
		<tr class="portfolio-description">
			<td valign="top">' . __( 'Description', 'shootback' ) . '</td>
			<td>
				<textarea class="slide_description" name="portfolio[{{item-id}}][description]" cols="60" rows="5"></textarea>
			</td>
		</tr>
		<tr class="portfolio-image-url">
			<td>' . __( 'Image URL', 'shootback' ) . '</td>
			<td>
				<input type="text" class="slide_url" name="portfolio[{{item-id}}][item_url]" value="" />
				<input type="hidden" class="slide_media_id" name="portfolio[{{item-id}}][media_id]" value="" />
				<input type="button" id="upload-{{item-id}}" class="button ts-upload-slide" value="' .__( 'Upload', 'shootback' ). '" /> 
			</td>
		</tr>
		<tr class="portfolio-redirect-url">
			<td>' . __( 'Redirect to URL', 'shootback' ) . '</td>
			<td>
				<input type="text" class="redirect_to_url" name="portfolio[{{item-id}}][redirect_to_url]" value="" style="width: 100%" />
			</td>
		</tr>
		<tr>
			<td></td><td><input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" /></td>
		</tr>
	</table></li>';
	
	echo '</script>';
?>
	<script>
	jQuery(document).ready(function($) {
		var portfolio_items = $("#portfolio-items > li").length;

		// sortable portfolio items
		$("#portfolio-items").sortable();
		//$("#portfolio-items").disableSelection();

		$(document).on('change', '.slide_title', function(event) {
			event.preventDefault();
			var _this = $(this);
			_this.closest('.portfolio-item').find('.portfolio-item-tab').text(_this.val());
		});

		// Content type switcher
		$(document).on('click', '.item-type-image', function(event) {
			var _this = $(this);
			_this.closest('table').find('.portfolio-embed').hide();
			_this.closest('table').find('.portfolio-description').show();
			_this.closest('table').find('.portfolio-image-url').show();
			_this.closest('table').find('.portfolio-redirect-url').show();
		});

		$(document).on('click', '.item-type-video', function(event) {
			var _this = $(this);
			_this.closest('table').find('.portfolio-embed').show();
			_this.closest('table').find('.portfolio-description').hide();
			_this.closest('table').find('.portfolio-image-url').hide();
			_this.closest('table').find('.portfolio-redirect-url').hide();
		});

		// Media uploader
		var items = $('#portfolio-items'),
			slideTempalte = $('#portfolio-items-template').html(),
			custom_uploader = {};
		  	
		if (typeof wp.media.frames.file_frame == 'undefined') {
		    wp.media.frames.file_frame = {};
		}

		$(document).on('click', '#add-item', function(event) {
			event.preventDefault();
			portfolio_items++;
			var sufix = new Date().getTime();
			var item_id = new RegExp('{{item-id}}', 'g');
			var item_number = new RegExp('{{slide-number}}', 'g');

			var template = slideTempalte.replace(item_id, sufix).replace(item_number, portfolio_items);
			items.append(template);
		});

		$(document).on('click', '.remove-item', function(event) {
			event.preventDefault();
			$(this).closest('li').remove();
			portfolio_items--;
		});

		
		$(document).on('click', '.ts-upload-slide', function(e) {
			e.preventDefault();
			
			var _this     = $(this),
				target_id = _this.attr('id'),
				media_id  = _this.closest('li').find('.slide_media_id').val();
			
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader[target_id]) {
				custom_uploader[target_id].open();
				return;
			}

			//Extend the wp.media object
			custom_uploader[target_id] = wp.media.frames.file_frame[target_id] = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				library: {
					type: 'image'
				},
				multiple: false,
				selection: [media_id]
			});

			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader[target_id].on('select', function() {
				var attachment = custom_uploader[target_id].state().get('selection').first().toJSON();
				var item = _this.closest('table');
				
				item.find('.slide_url').val(attachment.url);
				item.find('.slide_media_id').val(attachment.id);
			});

			//Open the uploader dialog
			custom_uploader[target_id].open();
		});
	});
	</script>
<?php
}

// saving slider
function ts_portfolio_save_postdata( $post_id )
{
	global $post;

	if ( isset($post->post_type) && @$post->post_type != 'portfolio' ) {
		return;
	}

	if ( ! isset( $_POST['ts_portfolio_nonce'] ) ||
		 ! wp_verify_nonce( $_POST['ts_portfolio_nonce'], plugin_basename( __FILE__ ) ) 
	) return;

	if( !current_user_can( 'edit_post', $post_id ) ) return;

	// array containing filtred items
	$portfolio_items = array();

	if ( isset( $_POST['portfolio'] ) ) {
		if ( is_array( $_POST['portfolio'] ) && !empty( $_POST['portfolio'] ) ) {
			foreach ( $_POST['portfolio'] as $item_id => $portfolio_item ) {

				$p = array();
				$p['item_id']	= $item_id;

				$p['item_type'] = isset($portfolio_item['item_type']) ?
								esc_attr($portfolio_item['item_type']) : '';

				$p['item_type'] = isset($portfolio_item['item_type']) && 
								( $portfolio_item['item_type'] === 'i' || $portfolio_item['item_type'] === 'v' ) ?
								$portfolio_item['item_type'] : 'i';

				$p['slide_title'] = isset($portfolio_item['slide_title']) ?
								esc_textarea($portfolio_item['slide_title']) : ''; 

				$p['embed']	= isset($portfolio_item['embed']) ?
							esc_textarea($portfolio_item['embed']) : ''; 

				$p['description'] = isset($portfolio_item['description']) ?
								esc_textarea($portfolio_item['description']) : ''; 

				$p['item_url'] = isset($portfolio_item['item_url']) ?
								esc_url($portfolio_item['item_url']) : '';

				$p['media_id'] = isset($portfolio_item['media_id']) ?
								esc_attr($portfolio_item['media_id']) : '';

				$p['redirect_to_url'] = isset($portfolio_item['redirect_to_url']) ?
									esc_url($portfolio_item['redirect_to_url']) : '';

				$portfolio_items[] = $p; 
			}
		}
	}
	if(isset($_POST['portfolio_details'])){
		$portfolio_details = $_POST['portfolio_details'];
	}

    update_post_meta( $post_id, 'ts_portfolio', $portfolio_items );
    update_post_meta( $post_id, 'ts_portfolio_details', $portfolio_details );
}

add_action( 'init', 'create_portfolio_tax' );

function create_portfolio_tax() 
{
    $slug = get_option('shootback_general');
    $slug = (isset($slug['slug_portfolio_taxonomy'])) ? $slug['slug_portfolio_taxonomy'] : 'portfolio-categories';

    register_taxonomy(
        'portfolio_register_post_type',
        'portfolio',
        array(
            'label' => __( 'Categories', 'shootback' ),
            'rewrite' => array( 'slug' => $slug ),
            'hierarchical' => true
        )
    );
}

/**
// Pricing tables custom post
*/


/**
 * Pricing table
 */
add_action( 'init', 'ts_create_ts_pricing_table' );
function ts_create_ts_pricing_table() {
	$labels = array(
		'name'               => __('Pricing table', 'shootback'),
		'singular_name'      => __('Pricing table', 'shootback'),
		'add_new'            => __('Add New Item', 'shootback'),
		'add_new_item'       => __('Add New Item', 'shootback'),
		'edit_item'          => __('Edit Item', 'shootback'),
		'new_item'           => __('New Item', 'shootback'),
		'all_items'          => __('All Items', 'shootback'),
		'view_item'          => __('View Item', 'shootback'),
		'search_items'       => __('Search items', 'shootback'),
		'not_found'          =>  __('No items found', 'shootback'),
		'not_found_in_trash' => __('No items found in Trash', 'shootback'), 
		'parent_item_colon'  => '',
		'menu_name'          => __('Pricing table', 'shootback')
	);

	$args = array(
		'labels'   => $labels,
		'public'   => true,
		'supports' => array('title'),
		'menu_icon' => get_template_directory_uri() . '/includes/images/custom.pricing.png',
		'menu_position' => 25
	);

	register_post_type( 'ts_pricing_table', $args );
}

function ts_pricing_table_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['ts_pricing_table'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Pricing table Item updated. <a href="%s">View Pricing table Item</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'shootback'),
    3 => __('Custom field deleted.', 'shootback'),
    4 => __('Pricing table Item updated.', 'shootback'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Slider restored to revision from %s', 'shootback'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Pricing table Item published. <a href="%s">View Pricing table Item</a>', 'shootback'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Pricing table Item saved.', 'shootback'),
    8 => sprintf( __('Pricing table Item submitted. <a target="_blank" href="%s">Preview Pricing table Item</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
    9 => sprintf( __('Pricing table Item scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Pricing table Item</a>', 'slider'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i', 'shootback' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Pricing table Item draft updated. <a target="_blank" href="%s">Preview Pricing table Item</a>', 'shootback'), esc_url( add_query_arg( 'preview', 'true', esc_url(get_permalink($post_ID)) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'ts_pricing_table_updated_messages' );
add_action( 'add_meta_boxes', 'ts_pricing_table_add_custom_box' );
add_action( 'save_post', 'ts_pricing_table_save_postdata' );

function ts_pricing_table_add_custom_box()
{
	add_meta_box( 
        'ts_pricing_table',
        'Pricing table',
        'ts_pricing_table_custom_box',
        'ts_pricing_table' 
    );
}

function ts_pricing_table_custom_box( $post )
{
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_pricing_table_nonce' ); 
	$ts_pricing_table_items = get_post_meta($post->ID, 'ts_pricing_table', TRUE);
	$ts_pricing_table_details = get_post_meta($post->ID, 'ts_pricing_table_details', TRUE);

	echo '
	<h4>' . __( 'Pricing table details', 'shootback' ) . '</h4>
	<table width="450"><tr class="ts_pricing_table-price">
				<td>' . __( 'Price', 'shootback' ) . '</td>
				<td>
					<input type="text" class="price" name="ts_pricing_table_details[price]" value="'.@$ts_pricing_table_details['price'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="ts_pricing_table-details">
				<td>' . __( 'Description', 'shootback' ) . '</td>
				<td>
					<input type="text" class="description" name="ts_pricing_table_details[description]" value="'.@$ts_pricing_table_details['description'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="ts_pricing_table-currency">
				<td>' . __( 'Currency', 'shootback' ) . '</td>
				<td>
					<input type="text" class="currency" name="ts_pricing_table_details[currency]" value="'.@$ts_pricing_table_details['currency'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="ts_pricing_table-period">
				<td>' . __( 'Period', 'shootback' ) . '</td>
				<td>
					<input type="text" class="pricing-period" name="ts_pricing_table_details[period]" value="'.@$ts_pricing_table_details['period'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="ts_pricing_table-url">
				<td>' . __( 'Button URL', 'shootback' ) . '</td>
				<td>
					<input type="text" class="pricing-url" name="ts_pricing_table_details[url]" value="'.@$ts_pricing_table_details['url'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="ts_pricing_table-button-text">
				<td>' . __( 'Button Text', 'shootback' ) . '</td>
				<td>
					<input type="text" class="pricing-text" name="ts_pricing_table_details[button_text]" value="'.@$ts_pricing_table_details['button_text'].'" style="width: 100%" />
				</td>
			</tr>
			<tr class="ts_pricing_table-button-text">
				<td>' . __( 'Set as featured', 'shootback' ) . '</td>
				<td>
					<input type="radio" class="pricing-featured" name="ts_pricing_table_details[featured]" value="yes"'.  checked(@$ts_pricing_table_details['featured'], 'yes', false). ' /> Yes
					<input type="radio" class="pricing-featured" name="ts_pricing_table_details[featured]" value="no" '. checked(@$ts_pricing_table_details['featured'], 'no', false) . checked(@$ts_pricing_table_details['featured'], '', false) . ' /> No
				</td>
			</tr></table><br><br>';
	echo '<input type="button" class="button" id="add-item" value="' .__('Add New Pricing table Item', 'shootback'). '" /><br/>';
	echo '<ul id="ts_pricing_table-items">';
	
	$ts_pricing_table_editor = '';

	if (!empty($ts_pricing_table_items)) {
		$index = 0;
		foreach ($ts_pricing_table_items as $ts_pricing_table_item_id => $ts_pricing_table_item) {
			$index++;

			$ts_pricing_table_editor .= '
			<li class="ts_pricing_table-item">
			<div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="ts_pricing_table-item-tab ts-multiple-item-tab">'.($ts_pricing_table_item['item_title'] ? $ts_pricing_table_item['item_title'] : 'Item ' . $index).'</span></div>
			<table class="hidden">
			<tr>
				<td>' . __( 'Title', 'shootback' ) . '</td>
				<td>
					<input type="text" class="item_title" name="ts_pricing_table['.$ts_pricing_table_item_id.'][item_title]" value="'.$ts_pricing_table_item['item_title'].'" style="width: 100%" />
				</td>
			</tr>
			<tr>
				<td></td><td><input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" /></td>
			</tr>
			</table>

			</li>';
		}
	}

	echo $ts_pricing_table_editor;
	
	echo '</ul>';

	echo '<script id="ts_pricing_table-items-template" type="text/template">';
	echo '<li class="ts_pricing_table-item">
	<div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="ts_pricing_table-item-tab ts-multiple-item-tab">Pricing table {{slide-number}}</span></div>
	<table>
		<tr>
			<td>' . __( 'Title', 'shootback' ) . '</td>
			<td>
				<input type="text" class="item_title" name="ts_pricing_table[{{item-id}}][item_title]" value="" style="width: 100%" />
			</td>
		</tr>
		<tr>
			<td></td><td><input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" /></td>
		</tr>
	</table></li>';
	
	echo '</script>';
?>
	<script>
	jQuery(document).ready(function($) {
		var ts_pricing_table_items = $("#ts_pricing_table-items > li").length;

		// sortable ts_pricing_table items
		$("#ts_pricing_table-items").sortable();
		//$("#ts_pricing_table-items").disableSelection();

		$(document).on('change', '.item_title', function(event) {
			event.preventDefault();
			var _this = $(this);
			_this.closest('.ts_pricing_table-item').find('.ts_pricing_table-item-tab').text(_this.val());
		});

		// Media uploader
		var items = $('#ts_pricing_table-items');
			slideTempalte = $('#ts_pricing_table-items-template').html();

		// Remove item
		$(document).on('click', '.remove-item', function(event) {
			event.preventDefault();
			$(this).closest('li').remove();
			ts_pricing_table_items--;
		});

		$(document).on('click', '#add-item', function(event) {
			event.preventDefault();
			ts_pricing_table_items++;
			var sufix = new Date().getTime();
			var item_id = new RegExp('{{item-id}}', 'g');
			var item_number = new RegExp('{{slide-number}}', 'g');

			var template = slideTempalte.replace(item_id, sufix).replace(item_number, ts_pricing_table_items);
			items.append(template);
		});
	});
	</script>
<?php
}

// saving slider
function ts_pricing_table_save_postdata( $post_id )
{
	global $post;

	if ( isset($post->post_type) && @$post->post_type != 'ts_pricing_table' ) {
		return;
	}

	if ( ! isset( $_POST['ts_pricing_table_nonce'] ) ||
		 ! wp_verify_nonce( $_POST['ts_pricing_table_nonce'], plugin_basename( __FILE__ ) ) 
	) return;

	if( !current_user_can( 'edit_post', $post_id ) ) return;

	// array containing filtred items
	$ts_pricing_table_items = array();

	if ( isset( $_POST['ts_pricing_table'] ) ) {
		if ( is_array( $_POST['ts_pricing_table'] ) && !empty( $_POST['ts_pricing_table'] ) ) {
			foreach ( $_POST['ts_pricing_table'] as $item_id => $ts_pricing_table_item ) {

				$p = array();
				$p['item_id']	= $item_id;


				$p['item_title'] = isset($ts_pricing_table_item['item_title']) ?
								esc_textarea($ts_pricing_table_item['item_title']) : '';

				$ts_pricing_table_items[] = $p; 
			}
		}
	}
	if(isset($_POST['ts_pricing_table_details'])){
		$ts_pricing_table_details = $_POST['ts_pricing_table_details'];
	}

    update_post_meta( $post_id, 'ts_pricing_table', $ts_pricing_table_items );
    update_post_meta( $post_id, 'ts_pricing_table_details', $ts_pricing_table_details );
}

add_action( 'init', 'create_ts_pricing_table_tax' );

function create_ts_pricing_table_tax() 
{
   register_taxonomy(
      'ts_pricing_table_categories',
      'ts_pricing_table',
      array(
         'label' => __( 'Categories', 'shootback' ),
         'rewrite' => array( 'slug' => 'ts_pricing_table-categories' ),
         'hierarchical' => true
      )
   );
}

/**
// Create boxes for video post format
*/
add_action( 'add_meta_boxes', 'ts_video_post_add_custom_box' );
function ts_video_post_add_custom_box()
{
	add_meta_box( 
        'video_embed',
        __('Video embed', 'shootback'),
        'ts_video_post_options_custom_box',
        'post' 
    );
}

function ts_video_post_options_custom_box($post)
{
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_video_nonce' ); 	
	$video_post = get_post_meta($post->ID, 'video_embed' , TRUE);

	if (!$video_post) {
		$video_post = '';
	}

	echo '<table>
		<tr valign="top">
			<td>' . __('Video embed code', 'shootback') . '</td>
			<td>
				<textarea name="video_embed" cols="60" rows="5">'.esc_attr(@$video_post).'</textarea>
			</td>
		</tr>
		</table>';

}
// saving video embed data
function ts_video_post_postdata( $post_id )
{
	global $post;

    if ( isset($post->post_type) && @$post->post_type != 'post' ) {
        return;
    }
	
	if (!isset( $_POST['ts_video_nonce'] ) ||
		!wp_verify_nonce( $_POST['ts_video_nonce'], plugin_basename( __FILE__ ) ) 
	) return;


	// array containing filtred slides

    $video_embed_code = $_POST['video_embed'];
    update_post_meta( $post_id, 'video_embed', $video_embed_code );
}
add_action( 'save_post', 'ts_video_post_postdata' );


// Create boxes for audio post format

add_action( 'add_meta_boxes', 'ts_audio_post_add_custom_box' );
function ts_audio_post_add_custom_box()
{
	add_meta_box( 
        'audio_embed',
        __('Audio embed', 'shootback'),
        'ts_audio_post_options_custom_box',
        'post' 
    );
}

function ts_audio_post_options_custom_box($post)
{
	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'ts_audio_nonce' ); 	
	$audio_post = get_post_meta($post->ID, 'audio_embed' , TRUE);

	if (!$audio_post) {
		$audio_post = '';
	}

	echo '<table>
		<tr valign="top">
			<td>' . __('Audio embed code', 'shootback') . '</td>
			<td>
				<textarea name="audio_embed" cols="60" rows="5">'.esc_attr(@$audio_post).'</textarea>
			</td>
		</tr>
		</table>';

}
// saving audio post embed data
function ts_audio_post_postdata( $post_id )
{
	global $post;

    if ( isset($post->post_type) && @$post->post_type != 'post' ) {
        return;
    }
	
	if (!isset( $_POST['ts_audio_nonce'] ) ||
		!wp_verify_nonce( $_POST['ts_audio_nonce'], plugin_basename( __FILE__ ) ) 
	) return;


	// array containing filtred slides

    $audio_embed_code = $_POST['audio_embed'];
    update_post_meta( $post_id, 'audio_embed', $audio_embed_code );
}
add_action( 'save_post', 'ts_audio_post_postdata' );


/**************************************************************************
 ************** Select layouts for posts and pages ************************
 *************************************************************************/

add_action( 'add_meta_boxes', 'ts_layout_custom_boxes' );
add_action( 'save_post', 'ts_layout_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function ts_layout_custom_boxes() {
    $screens = array( 'page' );
    foreach ($screens as $screen) {
        add_meta_box(
            'ts_layout_id',
            __( 'Custom Layout', 'shootback' ),
            'ts_layout_selector_custom_box',
            $screen
        );
    }
    // Add the header and footer meta box
    add_meta_box(
        'ts_header_and_footer',
        __( 'Header & Footer', 'shootback' ),
        'ts_header_and_footer_custom_box',
        'page',
        'normal',
        'high'
    );
    // Add the page options meta box
    add_meta_box(
        'ts_page_options',
        __( 'Page options', 'shootback' ),
        'ts_page_options_custom_box',
        'page',
        'normal',
        'high'
    );
    // Add the post options meta box
    add_meta_box(
        'ts_post_options',
        __( 'Post options', 'shootback' ),
        'ts_post_options_custom_box',
        'post',
        'normal',
        'high'
    ); 
    // Add the post type gallery options meta box
    add_meta_box(
        'ts_post_options',
        __( 'Post options', 'shootback' ),
        'ts_post_options_custom_box',
       'ts-gallery',
        'normal',
        'high'
    );

    $sidebar_screens = array( 'page', 'post', 'portfolio', 'product', 'video', 'event', 'ts-gallery' );

    foreach ($sidebar_screens as $screen) {
        add_meta_box(
            'ts_sidebar',
            __( 'Layout', 'shootback' ),
            'ts_sidebar_custom_box',
            $screen,
            'side',
            'low'
        );
    }

    if (is_admin()) {

        wp_enqueue_style( 'farbtastic' );
        wp_enqueue_script( 'farbtastic' );
        
        // Layout builder styles
        wp_enqueue_style(
            'jquery-ui-custom',
            get_template_directory_uri() . '/admin/css/layout-builder.css',
            array(),
            SHOOTBACK_VERSION
        );

        // Layout builder
        wp_enqueue_script(
            'handlebars',
            get_template_directory_uri() . '/admin/js/handlebars.js',
            array('jquery','jquery-ui-core', 'jquery-ui-sortable'),
            SHOOTBACK_VERSION,
            true
        );
        // Layout builder
        wp_enqueue_script(
            'layout-builder',
            get_template_directory_uri() . '/admin/js/layout-builder.js',
            array('handlebars'),
            SHOOTBACK_VERSION,
            true
        );
        
        // Noty
        wp_enqueue_script(
            'noty',
            get_template_directory_uri() . '/admin/js/noty/jquery.noty.js',
            array('jquery'),
            SHOOTBACK_VERSION,
            true
        );

        // Noty layouts
        wp_enqueue_script(
            'noty-top',
            get_template_directory_uri() . '/admin/js/noty/layouts/bottomCenter.js',
            array('jquery', 'noty'),
            SHOOTBACK_VERSION,
            true
        );

        // Noty theme
        wp_enqueue_script(
            'noty-theme',
            get_template_directory_uri() . '/admin/js/noty/themes/default.js',
            array('jquery', 'noty', 'noty-top'),
            SHOOTBACK_VERSION,
            true
        );
    }
}

/* Prints the box content */
function ts_layout_selector_custom_box( $post ) {
                    
    $template_id = Template::get_template_info('page', 'id');
    $template_name = Template::get_template_info('page', 'name');     

    echo shootback_template_modals( 'page', $template_id, $template_name );
    ts_layout_wrapper(Template::edit($post->ID));
}

function ts_page_options_custom_box( $post )
{
  fields::logicMetaRadio('page_settings', 'hide_title', fields::get_value($post->ID, 'page_settings', 'hide_title', true), 'Hide title for this post', __('If set to yes, this option will hide the title of the post on this specific post','shootback') );
  fields::logicMetaRadio('page_settings', 'hide_meta', fields::get_value($post->ID, 'page_settings', 'hide_meta', true), 'Hide meta for this post', __('If set to yes, this option will hide the meta of the post on this specific post','shootback') );
  fields::logicMetaRadio('page_settings', 'hide_social_sharing', fields::get_value($post->ID, 'page_settings', 'hide_social_sharing', true), 'Hide social sharing for this post', __('If set to yes, this option will hide the social sharing buttons of the post on this specific post','shootback') );
  fields::logicMetaRadio('page_settings', 'hide_featimg', fields::get_value($post->ID, 'page_settings', 'hide_featimg', true), 'Hide featured image for this post', __('If set to yes, this option will hide the featured image of the post on this specific post','shootback') );
  fields::logicMetaRadio('page_settings', 'hide_author_box', fields::get_value($post->ID, 'page_settings', 'hide_author_box', true), 'Hide author box for this post', __('If set to yes, this option will hide the author box of the post on this specific post','shootback') );

}

function ts_post_options_custom_box( $post )
{
    fields::textareaText('post_settings', 'subtitle', fields::get_options_value($post->ID, 'post_settings', 'subtitle', true), 'Add subtitle', __('Add subtitle to post','shootback') );
    fields::logicMetaRadio('post_settings', 'hide_title', fields::get_value($post->ID, 'post_settings', 'hide_title', true), 'Hide title for this post', __('If set to yes, this option will hide the title of the post on this specific post','shootback') );
    fields::logicMetaRadio('post_settings', 'hide_related', fields::get_value($post->ID, 'post_settings', 'hide_related', true), 'Hide related articles for this post', __('If set to yes, this option will hide the related articles of the post on this specific post','shootback') );
    fields::logicMetaRadio('post_settings', 'hide_meta', fields::get_value($post->ID, 'post_settings', 'hide_meta', true), 'Hide meta for this post', __('If set to yes, this option will hide the meta of the post on this specific post','shootback') );
    fields::logicMetaRadio('post_settings', 'hide_social_sharing', fields::get_value($post->ID, 'post_settings', 'hide_social_sharing', true), 'Hide social sharing for this post', __('If set to yes, this option will hide the social sharing buttons of the post on this specific post','shootback') );

    if( $post->post_type == 'post' ){
        fields::logicMetaRadio('post_settings', 'hide_featimg', fields::get_value($post->ID, 'post_settings', 'hide_featimg', true), 'Hide featured image for this post', __('If set to yes, this option will hide the featured image of the post on this specific post','shootback') );
    }

    fields::logicMetaRadio('post_settings', 'hide_author_box', fields::get_value($post->ID, 'post_settings', 'hide_author_box', true), 'Hide author box for this post', __('If set to yes, this option will hide the author box of the post on this specific post','shootback') );

    if( $post->post_type == 'ts-gallery' ){
        $galleryStyles = array(
            'gallery-horizontal'       => get_template_directory_uri() . '/images/options/gallery-horizontal.png',
            'gallery-justified'        => get_template_directory_uri() . '/images/options/gallery-justified.png',
            'gallery-thumbnails-below' => get_template_directory_uri() . '/images/options/gallery-thumbnails-below.png',
            'gallery-vertical-slider'  => get_template_directory_uri() . '/images/options/gallery-vertical-slider.png',
            'gallery-masonry-layout'   => get_template_directory_uri() . '/images/options/gallery-masonry-layout.png',
            'gallery-horizontal-scroll'       => get_template_directory_uri() . '/images/options/gallery-horizontal-scroll.png'
        );
        fields::radioImageMeta('post_settings', 'single_layout', $galleryStyles , 2, 'gallery-horizontal', 'Single layout style', __('Select the single layout you want to use.','shootback') );

        $galleryTitlePosition = array(
            'above' => get_template_directory_uri() . '/images/options/title-above.png',
            'below' => get_template_directory_uri() . '/images/options/title-below.png',
        );

        fields::radioImageMeta('post_settings', 'gallery_title_position', $galleryTitlePosition , 2, 'above', 'Title position', __('Select title position','shootback') );

    }
}

function ts_header_and_footer_custom_box( $post )
{
    $header_footer = get_post_meta( $post->ID, 'ts_header_and_footer', true );
    $breadcrumbs = get_option('shootback_single_post', array('breadcrumbs' => 'y'));
    $breadcrumbs_clean = (isset($breadcrumbs['breadcrumbs']) && $breadcrumbs['breadcrumbs'] === 'y' ) ? 0 : 1;
    
    if( isset($header_footer['breadcrumbs']) ){
    	$disable_breadcrumbs = ( $header_footer['breadcrumbs'] === 1 ) ? 'checked="checked"' : '';
    }else{
        $disable_breadcrumbs = ($breadcrumbs_clean === 1) ? 'checked="checked"' : '';
    }

    if ( $header_footer ) {
        $disable_header = ( $header_footer['disable_header'] === 1 ) ? 'checked="checked"' : '';
        $disable_footer = ( $header_footer['disable_footer'] === 1 ) ? 'checked="checked"' : '';
        
    } else {
        $disable_header = '';
        $disable_footer = '';
    }

    echo '<p>
            <label class="switch" for="ts-disable-header">
              <input id="ts-disable-header" class="switch-input" name="ts_header_footer[disable_header]" type="checkbox" value="1" '.$disable_header.'>
              <span class="switch-label" data-on="'. __("Yes","shootback") . '" data-off="' . __("No","shootback") . '"></span>
              <span class="switch-handle"></span>
            </label>
            '.__('Disable header', 'shootback').'
            <div class="ts-option-description">
				'.__('This options will disable the default global header. You can use it if you want to create a custom header for this page using the layout builder. Global (default) header options are in a tab in the theme options panel. (in the menu on the left, last icon).', 'shootback').'
            </div>
        </p>
        <p>
            <label class="switch" for="ts-disable-footer">
              <input id="ts-disable-footer" class="switch-input" type="checkbox" name="ts_header_footer[disable_footer]" value="1" '.$disable_footer.'>
              <span class="switch-label" data-on="'. __("Yes","shootback") . '" data-off="' . __("No","shootback") . '"></span>
              <span class="switch-handle"></span>
            </label>
            '.__('Disable footer', 'shootback').'
            <div class="ts-option-description">
				'.__('This options will disable the default global footer. You can use it if you want to create a custom footer for this page using the layout builder. Global (default) footer options are in a tab in the theme options panel. (in the menu on the left, last icon).', 'shootback').'
            </div>
        </p>
        <p>
            <label class="switch" for="ts-disable-breadcrumbs">
              <input id="ts-disable-breadcrumbs" class="switch-input" type="checkbox" name="ts_header_footer[breadcrumbs]" value="1" '.$disable_breadcrumbs.'>
              <span class="switch-label" data-on="'. __("Yes","shootback") . '" data-off="' . __("No","shootback") . '"></span>
              <span class="switch-handle"></span>
            </label>
            '.__('Disable breadcrumbs', 'shootback').'
            <div class="ts-option-description">
				'.__('Hide the breadcrumbs in this page', 'shootback').'
            </div>
        </p>';
       

}

/* When the post is saved, saves our custom data */
function ts_layout_save_postdata( $post_id ) {

	$post_types = array( 'page', 'post', 'portfolio', 'product', 'video', 'event', 'ts-gallery' );

	// First we need to check if the current user is authorised to do this action. 
	if ( in_array(get_post_type($post_id), $post_types) ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
		
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// Secondly we need to check if the user intended to change this value.
		if ( ! isset( $_POST['ts_layout_nonce'] ) || ! wp_verify_nonce( @$_POST['ts_layout_nonce'], plugin_basename( __FILE__ ) ) ) return $post_id;
		
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

		// Thirdly we can save the value to the database
		$post_ID = @$_POST['post_ID'];
		$sidebar = @$_POST['ts_sidebar'];
       
		$new_sidebar_options = array(
			'position' => '',
			'size' => ''
		);
		
		if ( is_array( $sidebar ) &&
			 isset( $sidebar['position'] ) &&
			 isset( $sidebar['size'] ) &&
             isset( $sidebar['id'] )
			) {

			$valid_positions = array( 'none', 'left', 'right' );
			$valid_sizes = array( '1-3', '1-4' );

			if ( in_array( $sidebar['position'], $valid_positions ) ) {
				$new_sidebar_options['position'] = $sidebar['position'];
			} else {
				$new_sidebar_options['position'] = 'none';
			}

			if ( in_array( $sidebar['size'], $valid_sizes ) ) {
				$new_sidebar_options['size'] = $sidebar['size'];
			} else {
				$new_sidebar_options['size'] = '1-4';
			}
            
            $sidebars = ts_get_sidebars();
            
            if ( array_key_exists( $sidebar['id'], $sidebars ) || $sidebar['id'] == 'main' ) {
                $new_sidebar_options['id'] = $sidebar['id'];
            } else {
                $new_sidebar_options['id'] = 0;
            }
  
			update_post_meta( $post_ID, 'ts_sidebar', $new_sidebar_options );
		}

		// Get and save header meta box options
        $header_footer = @$_POST['ts_header_footer'];

        $header_footer_options = array(
            'disable_header' => 0,
            'disable_footer' => 0,
            'breadcrumbs' => 0
        );

        if ( isset($header_footer['disable_header']) ) {
            $header_footer_options['disable_header'] = 1;
        }

        if ( isset($header_footer['disable_footer']) ) {
            $header_footer_options['disable_footer'] = 1;
        }

        if ( isset($header_footer['breadcrumbs']) ) {
            $header_footer_options['breadcrumbs'] = 1;
        }

        update_post_meta( $post_ID, 'ts_header_and_footer', $header_footer_options );


		// Get and save page options meta box options
        $page_settings = @$_POST['page_settings'];

        update_post_meta( $post_ID, 'page_settings', $page_settings );

        // Get and save page options meta box options
        $post_settings = @$_POST['post_settings'];
        
        update_post_meta( $post_ID, 'post_settings', $post_settings );
	}
}

function get_layout_type( $postID = 0 )
{
	$layout_type = get_post_meta( $postID, 'ts_layout_id', true );
}

function ts_sidebar_custom_box( $post ) {

	$sidebar = get_post_meta( $post->ID, 'ts_sidebar', true );
  
	// IF there are not settings for this specific post, get those from layout settings.
	if ( !isset( $sidebar ) || $sidebar == '' ) {
		if ( get_post_type($post->ID) == 'page' ) {
			$sidebar = fields::get_options_value('shootback_layout', 'page_layout');
		} elseif( get_post_type($post->ID) != 'page' && get_post_type($post->ID) == 'product' ){
			$sidebar = fields::get_options_value('shootback_layout', 'product_layout');
		} else{
			$sidebar = fields::get_options_value('shootback_layout', 'single_layout');
		}
		$sidebar = $sidebar['sidebar'];
	}

	$positions = array(
		'none'  => __( 'None', 'shootback' ),
		'left'  => __( 'Left', 'shootback' ),
		'right' => __( 'Right', 'shootback' )
	);

	$positions_options = '';

	if ( array_key_exists(@$sidebar['position'], $positions) ) {
		foreach ($positions as $option_id => $option) {
			if ( $option_id === $sidebar['position'] ) {
				$positions_options .= '<option value="' . $option_id . '" selected="selected">' . $option.'</option>';
			} else {
				$positions_options .= '<option value="'.$option_id .'">'.$option.'</option>';
			}
		}
	} else {
		foreach ($positions as $option_id => $option) {
			$positions_options .= '<option value="'.$option_id .'">'.$option.'</option>';
		}
	}

	$sizes = array(
		'1-3'  => '1/3',
		'1-4'  => '1/4'
	);

	$size_options = '';

	if ( array_key_exists(@$sidebar['size'], $sizes) ) {
		foreach ($sizes as $size_id => $size) {
			if ( $size_id === $sidebar['size'] ) {
				$size_options .= '<option value="'.$size_id .'" selected="selected">'.$size.'</option>';
			} else {
				$size_options .= '<option value="'.$size_id .'">'.$size.'</option>';
			}
		}
	} else {
		foreach ($sizes as $size_id => $size) {
			$size_options .= '<option value="'.$size_id .'">'.$size.'</option>';
		}
	}
    
    wp_nonce_field( plugin_basename( __FILE__ ), 'ts_layout_nonce' );

    if ( isset( $sidebar['id'] ) ) {
        $sidebar_id = $sidebar['id'];
    } else {
        $sidebar_id = 0;
    }
	
    echo '<div id="ts_sidebar_position"><p><strong>'.__( 'Sidebar position', 'shootback' ).'</strong></p>
		    <ul id="page-sidebar-position-selector" data-selector="#page-sidebar-position" class="imageRadioMetaUl perRow-3 ts-custom-selector">
		       <li><img src="'.get_template_directory_uri() . '/images/options/none.png'.'" data-option="none" class="image-radio-input"></li>
		       <li><img src="'.get_template_directory_uri() . '/images/options/left_sidebar.png'.'" data-option="left" class="image-radio-input"></li>
		       <li><img src="'.get_template_directory_uri() . '/images/options/right_sidebar.png'.'" data-option="right" class="image-radio-input"></li>
		    </ul>
			<select name="ts_sidebar[position]" id="page-sidebar-position" class="hidden">
			' . $positions_options . '
			</select></div>
			<div id="ts_sidebar_size">
			<p><strong>'.__( 'Sidebar size', 'shootback' ).'</strong></p>
			<select id="ts_sidebar_size" name="ts_sidebar[size]">
			' . $size_options . '
			</select>
			</div><div id="ts_sidebar_sidebars">
            <p><strong>'.__('Sidebar name', 'shootback').'</strong></p>
            '.ts_sidebars_drop_down($sidebar_id, '', 'ts_sidebar[id]') . '</div>';

}//end function ts_sidebar_custom_box


// Custom boxes defaults
$global_hide_author = get_option('shootback_single_post', array('display_author_box' => 'y'));
$global_hide_author_box = (isset($global_hide_author['display_author_box']) && $global_hide_author['display_author_box'] === 'y') ? 'yes' : 'no';

$post_custom_box_defaults = array(
		'hide_title' => 'no',
		'hide_meta' => 'no',
		'hide_related' => 'no',
		'hide_social_sharing' => 'no',
		'hide_featimg' => 'no',
		'hide_author_box' => $global_hide_author_box,
		'background_img' => '',
		'background_position' => 'left',
        'single_layout' => 'gallery-horizontal',
		'subtitle' => '',
        'gallery_title_position' => 'above'
	);
$page_custom_box_defaults = array(
		'hide_title' => 'no',
		'hide_meta' => 'yes',
		'hide_social_sharing' => 'no',
		'hide_featimg' => 'no',
		'hide_author_box' => $global_hide_author_box,
		'background_img' => '',
		'background_position' => 'left'
	);

if( false === get_option( 'post_settings_defaults' ) && false === get_option( 'page_settings_defaults' ) ) {
    //delete_option('post_settings_defaults');
	add_option( 'post_settings_defaults', $post_custom_box_defaults);
	add_option( 'page_settings_defaults', $page_custom_box_defaults);

} // end custom boxes default
// Function for setting defaults for existing posts
function setMetaForExistingPosts($post){
	$global_hide_author = get_option('shootback_single_post', array('display_author_box' => 'y'));
	$global_hide_author_box = (isset($global_hide_author['display_author_box']) && $global_hide_author['display_author_box'] === 'y') ? 'yes' : 'no';

	$post_custom_box_defaults = array(
			'hide_title' => 'no',
			'hide_meta' => 'no',
			'hide_related' => 'no',
			'hide_social_sharing' => 'no',
			'hide_featimg' => 'no',
			'hide_author_box' => $global_hide_author_box,
			'background_img' => '',
			'background_position' => 'left',
            'title_position' => 'below',
			'subtitle' => '',
            'single_layout' => 'gallery-horizontal',
            'gallery_title_position' => 'above'
		);
	$page_custom_box_defaults = array(
			'hide_title' => 'no',
			'hide_meta' => 'yes',
			'hide_social_sharing' => 'no',
			'hide_featimg' => 'yes',
			'hide_author_box' => $global_hide_author_box,
			'background_img' => '',
			'background_position' => 'left'
		);

	if( is_object($post) ) {
		$the_ID = get_the_ID();
		$post_type = get_post_type( get_the_ID() );
		$meta_settings = get_post_meta( $the_ID, $post_type . '_settings' );

		if ( $post_type == 'page' ) {
			$meta_to_add = $page_custom_box_defaults;
		}else {
            $meta_to_add = $post_custom_box_defaults;
            $post_type = 'post';
        }
		
		if ( empty($meta_settings) ) {
			update_post_meta( get_the_ID() , $post_type . '_settings', $meta_to_add);
		}
	}
	
}
add_action('pre_post_update', 'setMetaForExistingPosts');

//Add the box import/export to page

function ts_custom_box_import_export() {
	
	add_meta_box( 'ts-import-export', 'Import/Export options', 'ts_html_custom_box_import_export', 'page' );

}
add_action('add_meta_boxes', 'ts_custom_box_import_export'); 

/***********/

function ts_html_custom_box_import_export($post) {
	
	$settings = get_post_meta( $post->ID, 'ts_template', true );
	$settings = json_encode($settings);
	$settings = ts_base_64($settings, 'encode');

	echo '<table>
			<tr>
				<td><h4>' . __('Export options', 'shootback') . '</h4>
					<div class="ts-option-description">
						' . __('This is the export data. Copy this into another page import field and you should get the same builder elements and arrangement.', 'shootback') . '
					</div>

					<textarea name="export_options" cols="60" rows="5">' . $settings . '</textarea>
				</td>
			</tr>
			<tr>
				<td><h4>' . __('Import options', 'shootback') . '</h4>
					<div class="ts-option-description">
						' . __('This is the import data field. <b style="color: #Ff0000;">BE CAUTIONS, changing anythig here will result in breaking all your page elements and arrangement. Please save your previous data before proceding.</b>', 'shootback') . '
					</div>
					<textarea name="import_options" cols="60" rows="5"></textarea>
				</td>
			</tr>
		</table>';
				
}

function ts_import_export_save_postdata( $post_id ) {
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	if ( 'page' == get_post_type($post_id) && ! current_user_can( 'edit_page', $post_id ) ) {
		  return $post_id;
	} elseif( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if( isset($_POST['import_options']) && $_POST['import_options'] != '' ){
		
		$import_export = ts_base_64($_POST['import_options'], 'decode');
		$import_export = json_decode($import_export, true);

		update_post_meta( $post_id, 'ts_template', $import_export );
	}

}
add_action( 'save_post', 'ts_import_export_save_postdata' );

// Custom mega menu saving
if(!function_exists('ts_ajax_switch_menu_walker'))
{
	function ts_ajax_switch_menu_walker()
	{	
		if ( ! current_user_can('edit_theme_options') )
		die('-1');
		
		check_ajax_referer('add-menu_item', 'menu-settings-column-nonce');
	
		require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
	
		$item_ids = wp_save_nav_menu_items(0, $_POST['menu-item']);
		if ( is_wp_error($item_ids) )
			die('-1');
	
		foreach ( (array)$item_ids as $menu_item_id ) {

			$menu_obj = get_post($menu_item_id);

			if ( !empty($menu_obj->ID) ) {
				$menu_obj = wp_setup_nav_menu_item($menu_obj);
				$menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
				$menu_items[] = $menu_obj;
			}
		}
	
		if ( !empty($menu_items) ) {
			$args = array(
				'after' => '',
				'before' => '',
				'link_after' => '',
				'link_before' => '',
				'walker' => new ts_backend_walker
			);
			echo walk_nav_menu_tree($menu_items, 0, (object)$args);
		}
		
		die('end');
	}
	
	//hook into wordpress admin.php
	add_action('wp_ajax_ts_ajax_switch_menu_walker', 'ts_ajax_switch_menu_walker');
}

// Adding the post rating box here
add_action( 'add_meta_boxes', 'ts_post_rating_add_custom_box' );
add_action( 'save_post', 'ts_post_rating_save_postdata' );

function ts_post_rating_add_custom_box()
{
    add_meta_box( 
        'ts_post_rating',
        'Post rating',
        'ts_post_rating_custom_box',
        'post'
    );
}

function ts_post_rating_custom_box( $post )
{
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ts_post_rating_nonce' ); 
    $rating_items = get_post_meta($post->ID, 'ts_post_rating', TRUE);

    echo '<br/><input type="button" class="button button-primary" id="add-item" value="' .__('Add New rating Item', 'shootback'). '" /><br/><br/>';
    echo '<ul id="rating-items">';
    
    $rating_editor = '';

    if (!empty($rating_items)) {
        $index = 0;
        foreach ($rating_items as $rating_item_id => $rating_item) {
            $index++;
            
            $rating_editor .= '
            <li class="rating-item">
            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span><span class="rating-item-tab ts-multiple-item-tab">'.($rating_item['rating_title'] ? $rating_item['rating_title'] : 'Rating ' . $index).'</span></div>
                <table class="hidden">
                    <tr>
                        <td>
                            Rating name<br>
                            <input type="text" class="rating_title" name="rating['.$rating_item_id.'][rating_title]" value="'.$rating_item['rating_title'].'" style="width: 100%" />
                        </td>
                        <td>
                            Rating score<br>
                            <select name="rating['.$rating_item_id.'][rating_score] " id="rating_score">
                                <option value="1" ' . selected( $rating_item['rating_score'] , 1 , false) . ' >1</option>
                                <option value="2" ' . selected( $rating_item['rating_score'] , 2  , false) . '>2</option>
                                <option value="3" ' . selected( $rating_item['rating_score'] , 3  , false) . '>3</option>
                                <option value="4" ' . selected( $rating_item['rating_score'] , 4  , false) . '>4</option>
                                <option value="5" ' . selected( $rating_item['rating_score'] , 5  , false) . '>5</option>
                                <option value="6" ' . selected( $rating_item['rating_score'] , 6  , false) . '>6</option>
                                <option value="7" ' . selected( $rating_item['rating_score'] , 7  , false) . '>7</option>
                                <option value="8" ' . selected( $rating_item['rating_score'] , 8  , false) . '>8</option>
                                <option value="9" ' . selected( $rating_item['rating_score'] , 9  , false) . '>9</option>
                                <option value="10" ' . selected( $rating_item['rating_score'] , 10 , false) . '>10</option>
                            </select>
                        </td>
                        <td>&nbsp;<br><input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" /></td>
                    </tr>
                </table>
            </li>';
        }
    } else{
        echo __('Sorry, no rating items were found. Please add some.', 'shootback');
    }

    echo $rating_editor;
    
    echo '</ul>';
    echo '<br/><input type="button" class="button button-primary" id="add-item" value="' .__('Add New rating Item', 'shootback'). '" /><br/><br/>';
    echo '<script id="rating-items-template" type="text/template">';
    echo '<li class="rating-item ts-multiple-add-list-element">
    <div class="sortable-meta-element"><span class="tab-arrow icon-up"></span><span class="rating-item-tab ts-multiple-item-tab">' . __('Rating', 'shootback') . ' {{slide-number}}</span></div>
        <table>
            <tr>
                <td>
                    ' . __('Rating name', 'shootback') . '<br>
                    <input type="text" class="rating_title" name="rating[{{item-id}}][rating_title]" value="" style="width: 100%" />
                </td>
                <td>
                    ' . __('Rating score', 'shootback') . '<br>
                    <select name="rating[{{item-id}}][rating_score]" id="rating_score">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </td>
                <td>&nbsp;<br><input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" /></td>
            </tr>
        </table>       
    </li>';
    echo '</script>';
?>
    <script>
    jQuery(document).ready(function($) {
        var rating_items = $("#rating-items > li").length;

        // sortable rating items
        $("#rating-items").sortable();
        //$("#rating-items").disableSelection();

        $(document).on('change', '.slide_title', function(event) {
            event.preventDefault();
            var _this = $(this);
            _this.closest('.rating-item').find('.rating-item-tab').text(_this.val());
        });

        // Media uploader
        var items = $('#rating-items'),
            slideTempalte = $('#rating-items-template').html();
            
        $(document).on('click', '#add-item', function(event) {
            event.preventDefault();
            rating_items++;
            var sufix = new Date().getTime();
            var item_id = new RegExp('{{item-id}}', 'g');
            var item_number = new RegExp('{{slide-number}}', 'g');

            var template = slideTempalte.replace(item_id, sufix).replace(item_number, rating_items);
            items.append(template);
        });

        $(document).on('click', '.remove-item', function(event) {
            event.preventDefault();
            $(this).closest('li').remove();
            rating_items--;
        });

    });
    </script>
<?php
}

// saving slider
function ts_post_rating_save_postdata( $post_id )
{
    global $post;

    if ( is_object($post) && @$post->post_type != 'post' ) {
        return;
    }

    if ( ! isset( $_POST['ts_post_rating_nonce'] ) ||
         ! wp_verify_nonce( $_POST['ts_post_rating_nonce'], plugin_basename( __FILE__ ) ) 
    ) return;

    if( !current_user_can( 'edit_post', $post_id ) ) return;

    // array containing filtred items
    $rating_items = array();

    if ( isset( $_POST['rating'] ) ) {
        if ( is_array( $_POST['rating'] ) && !empty( $_POST['rating'] ) ) {
            foreach ( $_POST['rating'] as $item_id => $rating_item ) {

                $p = array();
                $p['item_id']   = $item_id;


                $p['rating_title'] = isset($rating_item['rating_title']) ?
                                esc_textarea($rating_item['rating_title']) : ''; 

                $p['rating_score'] = isset($rating_item['rating_score']) ?
                            esc_textarea($rating_item['rating_score']) : ''; 

                $rating_items[] = $p; 
            }
        }
    }

    update_post_meta( $post_id, 'ts_post_rating', $rating_items );
}
?>
