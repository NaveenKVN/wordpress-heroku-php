<?php
function shootback_admin_enqueue_scripts($hook) {

	if ( 'upload.php' === $hook ) {
	        return;
	}
	
	global $wp_scripts;


	$page_get = '';

	if ( isset($_GET['page']) ) {
		$page_get = $_GET['page'];
	}

	$page_post = '';

	if ( isset($_POST['page']) ) {
		$page_post = $_POST['page'];
	}
	$page_tab = '';

	if ( isset($_GET['tab']) ) {
		$page_tab = $_GET['tab'];
	}

	// News from TouchSize
	if (ts_update_redarea() === true) {
		wp_enqueue_script(
			'red-area',
			get_template_directory_uri() . '/admin/js/red.js',
			array('jquery'),
			SHOOTBACK_VERSION,
			true
		);
			
		$data = array('token' => wp_create_nonce("save_touchsize_news"));
		wp_localize_script( 'red-area', 'RedArea', $data );
	}

	wp_enqueue_script(
		'googlemap_api-js',
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyBigTQD4E05c8Tk7XgGvJkyP8L9qnzN3ro&sensor=false&amp;libraries=places',
		array('jquery'),
		SHOOTBACK_VERSION,
		false
	);

	// JS for theme settings
	$data = array(
		'LikeGenerate' => wp_create_nonce('like-generate'),
		'Nonce'        => wp_create_nonce('feature_nonce')
	);

	//if(!isset($_GET['mode']) && $_GET['mode'] === 'list'){
		wp_enqueue_script(
			'shootback-custom',
			get_template_directory_uri() . '/admin/js/touchsize.js',
			array('jquery', 'farbtastic'),
			SHOOTBACK_VERSION,
			true
		);
		wp_localize_script( 'shootback-custom', 'ShootbackAdmin', $data );

		wp_enqueue_media();
	//}

	
	if (@$page_get == 'shootback' || @$page_get == 'templates') {
	
		// color picker
		wp_enqueue_style( 'farbtastic' );
	}
	
	if ( @$page_get === 'shootback' && ( @$page_tab === 'typography' || @$page_tab === 'styles' ) ) {
		
		wp_enqueue_script(
			'shootback-google-fonts',
			get_template_directory_uri() . '/admin/js/google-fonts.js',
			array(),
			SHOOTBACK_VERSION,
			false
		);

		$t = get_option('shootback_typography');

		$data = array(
			'google_fonts_key' => @$t['google_fonts_key']
		);

		wp_localize_script( 'shootback-google-fonts', 'Shootback', $data );
	}


	wp_enqueue_script(
		'bootrastrap-js',
		get_template_directory_uri() . '/admin/js/modal.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		false
	);

	wp_enqueue_style(
		'bootstrap-css',
		get_template_directory_uri() . '/admin/css/modal.css',
		array(),
		SHOOTBACK_VERSION
	);

	wp_enqueue_script(
		'select2-js',
		get_template_directory_uri() . '/admin/js/select2.min.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		false
	);

	wp_enqueue_script(
		'ui-js',
		get_template_directory_uri() . '/admin/js/jquery-ui.min.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		false
	);

	wp_enqueue_style(
		'select2-css',
		get_template_directory_uri() . '/admin/css/select2.css',
		array(),
		SHOOTBACK_VERSION
	);
	
	wp_enqueue_style(
		'pips-css',
		get_template_directory_uri() . '/admin/css/jquery-ui.min.css',
		array(),
		SHOOTBACK_VERSION
	);
	
	
	// Theme settings
	wp_enqueue_style(
		'shootback-admin-css',
		get_template_directory_uri().  '/admin/css/touchsize-admin.css'
	);

	// Tickbox
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_style( 'thickbox' );

	// Layout builder
	if (@$page_get === 'shootback_header' ||
		@$page_post === 'shootback_header' ||
		@$page_get === 'shootback_footer' ||
		@$page_post === 'shootback_footer' ) {

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

		wp_enqueue_script('farbtastic');
		// color picker
		wp_enqueue_style( 'farbtastic' );

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

function shootback_enqueue_scripts()
{
	global $wp_version;

	wp_enqueue_script('jquery');

	wp_enqueue_script(
		'googlemap-js',
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyBigTQD4E05c8Tk7XgGvJkyP8L9qnzN3ro&sensor=false&amp;libraries=places',
		array('jquery'),
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'jquery.html5',
		get_template_directory_uri() . '/js/html5.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'izotope',
		get_template_directory_uri() . '/js/jquery.isotope.min.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		true
	);
	
	wp_enqueue_script(
		'easypiechart',
		get_template_directory_uri() . '/js/jquery.easypiechart.min.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	
	wp_enqueue_script(
		'lazyload',
		get_template_directory_uri() . '/js/jquery.lazyload.min.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	wp_enqueue_script(
		'modernizr',
		get_template_directory_uri() . '/js/modernizr.custom.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	wp_enqueue_script(
		'bootstrap',
		get_template_directory_uri() . '/js/bootstrap.min.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	wp_enqueue_script(
		'modernizr2',
		get_template_directory_uri() . '/js/modernizr.custom2.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'jquery.easing',
		get_template_directory_uri() . '/js/jquery.easing.1.3.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'jquery.cookie',
		get_template_directory_uri() . '/js/jquery.cookie.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
        'jquery.flexslider',
        get_template_directory_uri() . '/js/jquery.flexslider-min.js',
        false,
        SHOOTBACK_VERSION,
        true
    );

	wp_enqueue_script(
        'jquery.slyjs',
        get_template_directory_uri() . '/js/sly.min.js',
        false,
        SHOOTBACK_VERSION,
        true
    );

	if ( fields::get_options_value('shootback_optimization', 'include_parallax') == 'y' ) {
	    wp_enqueue_script(
	        'parallaxSlider',
	        get_template_directory_uri() . '/js/parallax.slider.js',
	        false,
	        SHOOTBACK_VERSION,
	        true
	    );
	}

	if ( fields::get_options_value('shootback_optimization', 'include_parallax_background') == 'y' ) {
	    wp_enqueue_script(
	        'parallaxBackground',
	        get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js',
	        false,
	        SHOOTBACK_VERSION,
	        true
	    );
	}

    if ( fields::get_options_value('shootback_general','onepage_website') == 'Y' ) {
    	wp_enqueue_script(
	        'jquery.scrollTo',
	        get_template_directory_uri() . '/js/jquery.scrollTo-min.js',
	        false,
	        SHOOTBACK_VERSION,
	        true
	    );
    }

	wp_enqueue_script(
		'scripting',
		get_template_directory_uri() . '/js/scripting.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	if ( fields::get_options_value('shootback_optimization', 'include_chart') == 'y' ) {
		wp_enqueue_script(
			'ts-chart',
			get_template_directory_uri() . '/js/Chart.min.js',
			false,
			SHOOTBACK_VERSION,
			true
		);
	}
	
	
	wp_enqueue_script(
		'fancybox',
		get_template_directory_uri() . '/js/jquery.fancybox.pack.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'fancyboxHelper',
		get_template_directory_uri() . '/js/jquery.fancybox-thumbs.js',
		array('jquery'),
		SHOOTBACK_VERSION,
		true
	);
	
	wp_enqueue_script(
		'fotorama',
		get_template_directory_uri() . '/js/fotorama.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	
	wp_enqueue_script(
		'flickity',
		get_template_directory_uri() . '/js/flickity.pkgd.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	
	wp_enqueue_script(
		'rowGrid',
		get_template_directory_uri() . '/js/jquery.row-grid.min.js',
		false,
		SHOOTBACK_VERSION,
		true
	);
	
	wp_enqueue_script(
		'nprogress',
		get_template_directory_uri() . '/js/nprogress.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	// Javascript localization
	$contact_form_gen_token = wp_create_nonce("submit-contact-form");
	$tsStylesOptions = get_option('shootback_styles');
	$tsLogoStyle = (isset($tsStylesOptions['logo'])) ? $tsStylesOptions['logo'] : '';
	
	if( $tsLogoStyle['type'] == 'image' ){
		if ( $tsLogoStyle['image_url'] != '' ) {
			$ts_logo_content = esc_url($tsLogoStyle['image_url']);
		} else{
			$ts_logo_content = get_template_directory_uri() . '/images/logo.png';
		}
		$ts_logo_content_styles = '';
		if ( $tsLogoStyle['retina_logo'] == 'Y' ) {
			$ts_logo_content_width = $tsLogoStyle['retina_width'] / 2;
			$ts_logo_content_height = $tsLogoStyle['retina_height'] / 2;
			$ts_logo_content_styles = 'style="width: ' . $ts_logo_content_width . 'px;height: auto;"';
		}
		$ts_logo_content = '<a href="' . home_url() . '"><img src="' . $ts_logo_content . '" ' . $ts_logo_content_styles . ' alt="Logo" /></a>';
	}else{
		$ts_logo_content = 	'<a href="' . home_url() . '" class="logo">
								' . ts_get_logo() . '
							</a>';
	}

	if ( fields::get_options_value('shootback_general', 'onepage_website') == 'Y' ) {
		$ts_onepage_layout = 'yes';
	} else{
		$ts_onepage_layout = 'no';
	}

	$data = array(
		'contact_form_token' => $contact_form_gen_token,
		'contact_form_success' => __('Sent successfully', 'shootback'),
		'contact_form_error' => __('Error!' , 'shootback'),
		'ajaxurl' => admin_url('admin-ajax.php'),
		'main_color' => fields::get_options_value('shootback_colors', 'primary_color'),
		'ts_enable_imagesloaded' => fields::get_options_value('shootback_general', 'enable_imagesloaded'),
		'ts_logo_content' => $ts_logo_content,
		'ts_onepage_layout' => $ts_onepage_layout,
		'video_nonce' => wp_create_nonce("video_nonce"),
		'ts_security' => wp_create_nonce( 'security' )
	);

	wp_localize_script( 'scripting', 'Shootback', $data );

	wp_enqueue_script(
		'slicebox',
		get_template_directory_uri() . '/js/jquery.slicebox.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'bxslider',
		get_template_directory_uri() . '/js/jquery.bxslider.min.js',
		false,
		SHOOTBACK_VERSION,
		true
	);

	wp_enqueue_script(
		'mCustomScrollbar',
		get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js',
		array( 'jquery' ),
		SHOOTBACK_VERSION,
		true
	);


	// Enqueue styles:

	wp_enqueue_style(
		'shootback.webfont',
		get_template_directory_uri() . '/css/redfont.css',
		array(),
		SHOOTBACK_VERSION
	);

	wp_enqueue_style(
		'shootback.widgets',
		get_template_directory_uri() . '/css/widgets.css',
		array(),
		SHOOTBACK_VERSION
	);

	wp_enqueue_style(
		'shootback.bootstrap',
		get_template_directory_uri() . '/css/bootstrap.css',
		array(),
		SHOOTBACK_VERSION
	);

	wp_enqueue_style(
		'bxslider',
		get_template_directory_uri() . '/css/jquery.bxslider.css',
		array( ),
		SHOOTBACK_VERSION
	);

	wp_enqueue_style(
		'shootback.style',
		get_template_directory_uri() . '/css/style.css',
		array( 'shootback.bootstrap' ),
		SHOOTBACK_VERSION
	);
	
}

add_action( 'admin_enqueue_scripts', 'shootback_admin_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'shootback_enqueue_scripts' );
