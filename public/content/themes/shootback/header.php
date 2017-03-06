<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- Viewports for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<![endif]-->
	<title><?php wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
  	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  	<?php $typography = ts_get_custom_fonts_css(); echo ts_var_sanitize($typography['links']); ?>
  	<?php
  		if( !function_exists('has_site_icon') || !has_site_icon() ){
  			echo ts_custom_favicon(); 
  		} 
  	?>
	<?php
	if( !is_singular() || is_front_page() || is_home() ){
		if ( fields::get_options_value('shootback_styles', 'facebook_image') !== '' ) {
			$url = fields::get_options_value('shootback_styles', 'facebook_image');
			echo '<meta property="og:image" content="'.$url.'"/>';   
		}
	}else{
		$url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
		echo '<meta property="og:image" content="'.$url.'"/>'; 
	}
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	$theme_styles = get_option('shootback_styles');
	$custom_body_class = ' shootback ';
	if($theme_styles['boxed_layout'] == 'Y'){
		$custom_body_class .= ' ts-boxed-layout ';
	}
	// Check if the image background is set
	if ( $theme_styles['theme_custom_bg'] == 'image' && $theme_styles['bg_image'] != '' ) {
		$custom_body_class .= ' ts-has-image-background ';
	}

	// Check if add to view box shadow
	if($theme_styles['box_shadow'] == 'y'){
		$custom_body_class .= ' views-has-shadow ';
	}

	wp_head();
	?>
</head>
<body <?php echo body_class($custom_body_class); ?>>
	<?php if (ts_comment_system() === 'facebook'): ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo ts_facebook_app_ID() ?>";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>	
	<?php endif ?>

	<?php theme_styles_rewrite(); ?>
	<?php if (ts_preloader()) : ?>
		<div class="ts-page-loading">
			<div class="gate_top"></div>
			<div class="gate_bottom"></div>
		</div>
	<?php endif; ?>
	<div id="ts-loading-preload">
		<div class="preloader-center"></div>
		<span><?php _e('Loading posts...','shootback'); ?></span>
	</div>
	<?php if (ts_enable_sticky_menu()): ?>
		<?php if ( fields::get_options_value('shootback_general','enable_mega_menu') === 'Y') {
			$sticky_additional_class = ' megaWrapper ';
		} else{
			$sticky_additional_class = '';
		}
		?>
		<div class="ts-behold-menu ts-sticky-menu <?php echo strip_tags($sticky_additional_class); ?>">
			<div class="container relative">
				<?php
					wp_nav_menu(array( 
						'theme_location' => 'primary', 
						'menu_class' => 'main-menu sf-menu' 
					));

				?>
			</div>
		</div>
	<?php endif ?>
	<?php
		// Set the header to show elements for all pages
		$ts_header_display = true;

		$ts_shown = get_post_meta( get_the_ID(), 'ts_header_and_footer', true);
		$disable_header = (isset($ts_shown['disable_header'])) ? $ts_shown['disable_header'] : 0;
		
		if (is_singular() && is_page() && $disable_header === 1) {
			$ts_header_display = false;
		}

		$header_position = fields::get_options_value('shootback_styles', 'header_position');
		$header_position = (isset($header_position) && ($header_position == 'left' || $header_position == 'right' || $header_position == 'top')) ? $header_position : 'top';
	?>
	<div id="wrapper" class="<?php if( $theme_styles['boxed_layout'] == 'Y' ) { echo 'container'; } ?>" data-header-align="<?php echo ts_var_sanitize($header_position); ?>">
		<?php
			if ( $ts_header_display === true ) :
		?>
		<header id="header" class="row">
			<div class="col-lg-12">
				<?php echo LayoutCompilator::build_header(); ?>
			</div>
		</header>
		<?php endif; ?>