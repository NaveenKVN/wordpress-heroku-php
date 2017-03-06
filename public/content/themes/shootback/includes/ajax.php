<?php

function edit_template_element()
{
	require_once get_template_directory() . '/includes/layout-builder/views/elements/elements-editor.php';
	die();
}

add_action('wp_ajax_edit_template_element', 'edit_template_element');

function edit_template_row()
{

	require_once get_template_directory() . '/includes/layout-builder/views/elements/edit-template-row.php';
	die();
}

add_action('wp_ajax_edit_template_row', 'edit_template_row');

function edit_template_column()
{

	require_once get_template_directory() . '/includes/layout-builder/views/elements/edit-template-column.php';
	die();
}
add_action('wp_ajax_edit_template_column', 'edit_template_column');

function save_touchsize_news()
{
	check_ajax_referer( 'save_touchsize_news', 'token' );

	header('Content-Type: application/json');

	$last_update = time();
	$options = get_option('shootback_red_area', array());

	$news = @$_POST['news'];
	$parsed_news = array();
	$allowed_html = array('a', 'br', 'em', 'strong', 'img');

	if ( is_array($news) && ! empty($news) ) {
		foreach ($news as $news_id => $n) {
			$parsed_news[] = '<li><a href="' . esc_url($n['url']) . '" target="_blank">' . wp_kses($n['title'], $allowed_html) . '</a><em>' .   $n['date'] . '</em>
				<img src="' . esc_url($n['image']) . '" /><p>' . wp_kses($n['excerpt'], $allowed_html) . '</p>
			</li>';
		}
	}

	if ( ! empty( $parsed_news ) ) {
		$parsed_news = '<ul>' . implode( "\n", $parsed_news ) . '</ul>';
	}

	$alerts = @$_POST['alerts'];

	if ( is_array( $alerts ) && ! empty( $alerts ) ) {
		if ( isset($alerts['id']) && isset($alerts['message']) ) {
			$parsed_alerts['id'] = $alerts['id'];
			$parsed_alerts['message'] = stripslashes($alerts['message']);
		} else {
			$parsed_alerts['id'] = 0;
			$parsed_alerts['message'] = '';
		}
	}

	$options['news']  = $parsed_news;
	$options['alert'] = $parsed_alerts;
	$options['time']  = time();

	if ( ! isset($options['hidden_alerts']) ) {
		$options['hidden_alerts'] = array();
	}

	update_option('shootback_red_area', $options);

	$data = array(
		'status'  => 'ok',
		'message' => __( 'Saved', 'shootback')
	);

	echo json_encode($data);
	die();
}

add_action('wp_ajax_save_touchsize_news', 'save_touchsize_news');

function shootback_hide_touchsize_alert()
{
	check_ajax_referer( 'remove-shootback-alert', 'token' );

	header('Content-Type: application/json');

	$options = get_option('shootback_red_area', array(
		'news' => '',
		'alert' => array(
			'id' => 0,
			'message' => ''
		),
		'hidden_alerts' => array(),
		'time' => time()
	));

	$alert_id = sanitize_text_field( $_POST['alertID'] );

	if ( ! in_array( $alert_id, $options['hidden_alerts'], true ) ) {

		array_push( $options['hidden_alerts'], $alert_id );
	}

	update_option('shootback_red_area', $options);

	$data = array(
		'status'  => 'ok',
		'message' => __( 'Saved', 'shootback')
	);

	echo json_encode($data);
	die();
}

add_action('wp_ajax_shootback_hide_touchsize_alert', 'shootback_hide_touchsize_alert');

function shootback_contact_me()
{

	check_ajax_referer( 'submit-contact-form', 'token' );

	header('Content-Type: application/json');

	$data = array(
		'status'  => 'ok',
		'message' => ''
	);

	$options = get_option( 'shootback_social', array('email' => ''));

	$from    	  = @$_POST['from'];
	$subject 	  = @$_POST['subject'];
	$message 	  = @$_POST['message'];
	$name    	  = @$_POST['name'];
	$custom_field = (isset($_POST['custom_field']) && is_array($_POST['custom_field']) && !empty($_POST['custom_field'])) ? $_POST['custom_field'] : NULL;

	if ( $subject === '' ) {
		$subject = bloginfo('name') . __('Message from ', 'shootback') . wp_kses( $name, array());
	}

	if ( is_email($options['email']) && is_email($from) ){

		if( isset($custom_field) ){
			foreach($custom_field as $value){

				$message .= $value['title'] . ':'."\r\n" . $value['value'] . "\r\n";

				if( $value['require'] == 'y' && $value['value'] == '' ){
					$error_require = 'Mail not sent. This field "' . $value['title'] . '" is required';
					$data = array(
						'status'  => 'error',
						'message' => $error_require,
						'token' => wp_create_nonce("submit-contact-form")
					);
					echo json_encode($data);
					die();
				}
			}
		}

		$headers = 'From: '. esc_attr($name) .' <'. $from .'>'."\r\n";
		$sent = wp_mail($options['email'], $subject, $message, $headers);

		if ( $sent ) {
			$data = array(
				'status'  => 'ok',
				'message' => __('Mail sent.', 'shootback'),
				'token' => wp_create_nonce("submit-contact-form")
			);
		} else {
			$data = array(
				'status'  => 'error',
				'message' => __('Error. Mail not sent.', 'shootback'),
				'token' => wp_create_nonce("submit-contact-form")
			);
		}
	} else {
		$data = array(
			'status'  => 'error',
			'message' => __('Invalid email adress', 'shootback'),
			'token' => wp_create_nonce("submit-contact-form")
		);
	}
	echo json_encode($data);
	die();
}

add_action('wp_ajax_shootback_contact_me', 'shootback_contact_me');
add_action( 'wp_ajax_nopriv_shootback_contact_me', 'shootback_contact_me' );

//========================================================================
// Save/Edit templates ===================================================
// =======================================================================

// Load template
function shootback_load_template()
{
	$template_id     = @$_GET['template_id'];
	$location        = @$_GET['location'];

	$result = Template::load_template($location, $template_id);

	wp_send_json( $result );
}

add_action('wp_ajax_shootback_load_template', 'shootback_load_template');

// Save blank template
function shootback_save_layout()
{
	// if not administrator, kill WordPress execution and provide a message
	if ( ! is_admin() ) {
		return false;
	}

	$location    = @$_POST['location'];
	$mode		 = @$_POST['mode'];

	if ( isset( $_POST['post_id'] ) ) {

		update_post_meta( $_POST['post_id'], 'ts_use_template', 1 );

	}

	$data = array( 'status' => 'ok', 'message' => '' );

	$response = Template::save( $mode, $location );

	if ( ! $response ) {
		$data['status'] = 'error';
		$data['message'] = __( 'Cannot save this template', 'shootback' );
	}

	wp_send_json( $data );
}

add_action('wp_ajax_shootback_save_layout', 'shootback_save_layout');

// Remove template
function shootback_remove_template()
{
	// if not administrator, kill WordPress execution and provide a message
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	header('Content-Type: application/json');
	// check_ajax_referer( 'remove-shootback-alert', 'token' );

	$template_id = @$_POST['template_id'];
	$location    = @$_POST['location'];

	$result = Template::delete( $location, $template_id );

	if ( $result ) {

		$data = array(
			'status' => 'removed',
			'message' => ''
		);

	} else {

		$data = array(
			'status' => 'error',
			'message' => __("Cannot delete this template", 'shootback')
		);
	}

	echo json_encode($data);
	die();
}

add_action('wp_ajax_shootback_remove_template', 'shootback_remove_template');

function shootback_load_all_templates()
{
	$location = @$_POST['location'];
	$templates = Template::get_all_templates($location);

	$edit = '';
	if ( $templates ) {
		foreach ($templates as $template_id => $template) {

			$remove_template = '';

			if ( $template_id !== 'default' ) {
				$remove_template = '<a href="#" data-template-id="'.esc_attr($template_id) .'" data-location="'.esc_attr($location).'" class="ts-remove-template icon-delete">' . __('remove', 'shootback') . '</a>';
			}

			$edit .= '<tr>
				<td><input type="radio" name="template_id" value="'.esc_attr($template_id).'" id="'.esc_attr($template_id).'"/></td>
				<td>
					<label for="'.$template_id . '">' . $template['name'] . '
					</label>
				</td>
				<td>
					' . $remove_template . '
				</td>
			</tr>';
		}
	}

	echo $edit;
	die();
}

add_action('wp_ajax_shootback_load_all_templates', 'shootback_load_all_templates');

function shootback_toggle_layout_builder()
{
	// if not administrator, kill WordPress execution and provide a message
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	$post_id = @$_POST['post_id'];
	$state  = @$_POST['state'];

	$valid_states = array(
		'enable' => 1,
		'disable' => 0
	);

	if ( array_key_exists($state, $valid_states) ) {
		update_post_meta((int)$post_id, 'ts_use_template', $valid_states[$state]);
	}

	die();
}

add_action('wp_ajax_shootback_toggle_layout_builder', 'shootback_toggle_layout_builder');

function ts_updateFeatures(){
    $nonce = $_POST['nonce_featured'];

    if ( !wp_verify_nonce( $nonce, 'feature_nonce' ) ) return false;
    if ( !current_user_can( 'manage_options' ) ) return false;

    $id_post = (isset($_POST['value_checkbox']) && (int)$_POST['value_checkbox'] !== 0) ? (int)$_POST['value_checkbox'] : NULL;
    $value_checkbox = (isset($_POST['checked']) && $_POST['checked'] !== '' && ($_POST['checked'] == 'yes' || $_POST['checked'] == 'no')) ? $_POST['checked'] : 'no';

    if( isset($id_post) ){
       update_post_meta($id_post, 'featured', $value_checkbox);
    }

    die();
}

if( is_admin() ) {
    add_action('wp_ajax_ts_updateFeatures', 'ts_updateFeatures');
    add_action('wp_ajax_nopriv_ts_updateFeatures', 'ts_updateFeatures');
}

//function generate random likes for all posts
function ts_generate_like_callback(){

    check_ajax_referer( 'like-generate', 'nonce' );
    if ( !current_user_can( 'manage_options' ) ) return false;

    global $wpdb;

    $ts_post_type = 'shootback';
    $sql = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_type != %s", $ts_post_type);
    $posts = $wpdb->get_results($sql, ARRAY_N);

    if( isset($posts) && is_array($posts) && !empty($posts) ){
        foreach($posts as $id){
            $rand_likes = rand(50, 100);
        	$rand_view  = rand(2, 5);
            update_post_meta($id[0], '_touchsize_likes', $rand_likes);
            update_post_meta($id[0], 'ts_article_views', $rand_likes * $rand_view);
        }
        echo '1';
    }
    die();
}

add_action('wp_ajax_ts_generate_like', 'ts_generate_like_callback');

//function generate the pagination read more
function ts_pagination_callback(){

    if( isset($_POST, $_POST['action'], $_POST['args'], $_POST['paginationNonce'], $_POST['loop']) ){

        check_ajax_referer('pagination-read-more', 'paginationNonce');
        $args = ts_base_64($_POST['args'], 'decode');
        $loop = (is_numeric($_POST['loop'])) ? (int)$_POST['loop'] : '';

        if( is_array($args) ){

            if(isset($args['options']) && is_array($args['options'])){
                $options = $args['options'];
                $options['loop'] = $loop;
                unset($args['options']);
            }

            if( isset($options) && is_array($options) ){

                $offset = (isset($args['offset'])) ? (int)$args['offset'] : 0;

                if( isset($args['posts_per_page']) ){
                    if( $args['posts_per_page'] == 0 ){
                        $args['posts_per_page'] = get_option('posts_per_page');
                    }

                    if( $loop > 0 ){
                        $args['offset'] = $offset + ((int)$args['posts_per_page'] * $loop);
                    }

                    if( $loop == 0){
                        $args['offset'] = $offset + (int)$args['posts_per_page'];
                    }

                }

            	$args['post_status'] = 'publish';

                if( isset($args['post_type']) && $args['post_type'] === 'video' ){
                    $options['ajax-load-more'] = true;
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) {
                        echo LayoutCompilator::list_videos_element($options, $query);
                    }else{
                        return false;
                    }
                }

                if( isset($args['post_type']) && $args['post_type'] === 'post' ){
                    $options['ajax-load-more'] = true;
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) {
                        echo LayoutCompilator::last_posts_element($options, $query);
                    }else{
                        return false;
                    }
                }

                if( isset($args['post_type']) && $args['post_type'] === 'event' ){
                    $options['ajax-load-more'] = true;
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) {
                        echo LayoutCompilator::events_element($options, $query);
                    }else{
                        return false;
                    }
                }

                if( isset($args['post_type']) && $args['post_type'] === 'ts-gallery' ){
                    $options['ajax-load-more'] = true;
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) {
                        echo LayoutCompilator::list_galleries_element($options, $query);
                    }else{
                        return false;
                    }
                }

                if( isset($args['post_type']) && $args['post_type'] !== 'event' && $args['post_type'] !== 'video' && $args['post_type'] !== 'post' && $args['post_type'] !== 'ts-gallery' ){
                    $options['ajax-load-more'] = true;
                    $query = new WP_Query($args);
                    if ( $query->have_posts() ) {
                        echo LayoutCompilator::latest_custom_posts_element($options, $query);
                    }else{
                        return false;
                    }
                }
            }
        }
    }
    die();
}
add_action('wp_ajax_ts_pagination', 'ts_pagination_callback');
add_action('wp_ajax_nopriv_ts_pagination', 'ts_pagination_callback');

function ts_set_share_callback(){

	check_ajax_referer( 'security', 'ts_security' );

	if( isset($_POST['postId'], $_POST['social']) ){

		$post_id = ((int)$_POST['postId'] !== 0) ? (int)$_POST['postId'] : '';
		$all_social = array('facebook', 'twitter', 'gplus', 'linkedin', 'tumblr', 'pinterest');
		$social = (in_array($_POST['social'], $all_social)) ? $_POST['social'] : '';

		if( isset($_COOKIE['ts-social-' . $social . '-id-' . $post_id]) ){
			echo '-1';
		}else{
			$count_social = get_post_meta($post_id, 'ts-social-' . $social, true);
			if( isset($count_social) && (int)$count_social > 0 ){
				$count_total = (int)$count_social + 1;
				update_post_meta($post_id, 'ts-social-' . $social, $count_total);
			}else{
				update_post_meta($post_id, 'ts-social-' . $social, 	1);
			}
			setcookie('ts-social-' . $social . '-id-' . $post_id, 1, time() + 86400 * 7);
			echo (int)$count_social + 1;
		}
	}

    die();
}
add_action('wp_ajax_ts_set_share', 'ts_set_share_callback');
add_action('wp_ajax_nopriv_ts_set_share', 'ts_set_share_callback');

?>
