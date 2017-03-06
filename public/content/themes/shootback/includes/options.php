<?php
/**
 * Export/Import Theme options
 */
function shootback_impots_options()
{
	//if not administrator, kill WordPress execution and provide a message
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	parse_str($_SERVER['QUERY_STRING'], $params);

	if (preg_match("/^.*\/wp-admin\/admin.php$/i", $_SERVER['SCRIPT_NAME'], $matches)) {
		if (array_key_exists('page', $params) && array_key_exists('tab', $params) ) {
			if ($params['page'] === 'shootback' && $params['tab'] === 'save_options') {
				if (isset($_POST['encoded_options'])) {

					$import = shootback_impots_decoded_options($_POST['encoded_options']);

					if ($import) {
						$status = '&updated=true';
					} else {
						$status = '&updated=false';
					}

					wp_redirect( admin_url('admin.php?page=shootback&tab=impots_options' . $status) );
				}
			}
		}
	}
}

add_action('admin_init', 'shootback_impots_options');

function shootback_load_patterns()
{
	//if not administrator, kill WordPress execution and provide a message
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	parse_str($_SERVER['QUERY_STRING'], $params);

	if (preg_match("/^.*\/wp-admin\/admin.php$/i", $_SERVER['SCRIPT_NAME'], $matches)) {
		if (array_key_exists('page', $params) && array_key_exists('tab', $params) ) {
			if ($params['page'] === 'shootback' && $params['tab'] === 'load_patterns') {
				require_once(get_template_directory() .'/includes/patterns.php');
				die();
			}
		}
	}
}

add_action('admin_init', 'shootback_load_patterns');

function shootback_impots_decoded_options($encoded) {

	$options = ts_base_64($encoded, 'decode');
	$options = json_decode($options, true);

	if ($options === null) {
		return false;
	} else {
		if ($options) {
			foreach ($options as $option_name => $params) {
				delete_option($option_name);
				add_option($option_name, $params);
			}
		}

		return true;
	}
}

function shootback_exports_options() {

	$export = array();

	$expots_options = array(
		'shootback_general',
		'shootback_image_sizes',
		'shootback_layout',
		'shootback_colors',
		'shootback_styles',
		'shootback_typography',
		'shootback_single_post',
		'shootback_page',
		'shootback_social',
		'shootback_css',
		'shootback_sidebars',
		'shootback_header',
		'shootback_header_templates',
		'shootback_header_template_id',
		'shootback_footer',
		'shootback_footer_templates',
		'shootback_footer_template_id',
		'shootback_footer_template_id',
		'shootback_page_template_id',
		'shootback_theme_advertising',
		'shootback_theme_update',
		'shootback_optimization'
	);

	foreach ($expots_options as $option) {
		$export[$option] = get_option($option, array());
	}

	$export = json_encode($export);

	return ts_base_64($export, 'encode');
}

function register_my_menu() {

  register_nav_menu('primary', __( 'Primary Menu', 'shootback' ));
}

add_action( 'init', 'register_my_menu' );

/**
 * Generate menu for Shootback Theme
 */
function shootback_create_menu()
{
	add_menu_page(
		'Shootback Options',
		'Shootback',
		'administrator',
		'shootback',
		'shootback_display_menu_page',
		get_template_directory_uri() . '/includes/images/touchicon.png'
	);

	add_submenu_page('shootback', __('Header', 'shootback'), __('Header', 'shootback'), 'administrator', 'shootback_header', 'shootback_header');
	add_submenu_page('shootback', __('Footer', 'shootback'), __('Footer', 'shootback'), 'administrator', 'shootback_footer', 'shootback_footer');
	add_submenu_page('shootback', '--------------------------', '--------------------------', 'administrator', 'shootback&tab=general', 'shootback&tab=general');
	add_submenu_page('shootback', __('General', 'shootback'), __('General', 'shootback'), 'administrator', 'shootback&tab=general', 'shootback&tab=general');
	add_submenu_page('shootback', __('Styles', 'shootback'), __('Styles', 'shootback'), 'administrator', 'shootback&tab=styles', 'shootback&tab=styles');
	add_submenu_page('shootback', __('Colors', 'shootback'), __('Colors', 'shootback'), 'administrator', 'shootback&tab=colors', 'shootback&tab=colors');
	add_submenu_page('shootback', __('Image sizes', 'shootback'), __('Image sizes', 'shootback'), 'administrator', 'shootback&tab=image_sizes', 'shootback&tab=image_sizes');
	add_submenu_page('shootback', __('Layout', 'shootback'), __('Layout', 'shootback'), 'administrator', 'shootback&tab=layout', 'shootback&tab=layout');
	add_submenu_page('shootback', __('Typography', 'shootback'), __('Typography', 'shootback'), 'administrator', 'shootback&tab=typography', 'shootback&tab=typography');
	add_submenu_page('shootback', __('Single post', 'shootback'), __('Single post', 'shootback'), 'administrator', 'shootback&tab=single', 'shootback&tab=single');
	add_submenu_page('shootback', __('Page settings', 'shootback'), __('Page settings', 'shootback'), 'administrator', 'shootback&tab=page_settings', 'shootback&tab=page_settings');
	add_submenu_page('shootback', __('Social', 'shootback'), __('Social', 'shootback'), 'administrator', 'shootback&tab=social', 'shootback&tab=social');
	add_submenu_page('shootback', __('Custom CSS', 'shootback'), __('Custom CSS', 'shootback'), 'administrator', 'shootback&tab=custom_css', 'shootback&tab=custom_css');
	add_submenu_page('shootback', __('Sidebars', 'shootback'), __('Sidebars', 'shootback'), 'administrator', 'shootback&tab=sidebars', 'shootback&tab=sidebars');
	add_submenu_page('shootback', __('Import options', 'shootback'), __('Import options', 'shootback'), 'administrator', 'shootback&tab=impots_options', 'shootback&tab=impots_options');
	add_submenu_page('shootback', __('Advertising', 'shootback'), __('Advertising', 'shootback'), 'administrator', 'shootback&tab=theme_advertising', 'shootback&tab=theme_advertising');
	add_submenu_page('shootback', __('Red Area', 'shootback'), __('Red Area', 'shootback'), 'administrator', 'shootback&tab=red_area', 'shootback&tab=red_area');
	add_submenu_page('shootback', __('Theme update', 'shootback'), __('Theme update', 'shootback'), 'administrator', 'shootback&tab=theme_update', 'shootback&tab=theme_update');
	add_submenu_page('shootback', __('Support', 'shootback'), __('Support', 'shootback'), 'administrator', 'shootback&tab=support', 'shootback&tab=support');
	add_submenu_page('shootback', __('Optimization', 'shootback'), __('Optimization', 'shootback'), 'administrator', 'shootback&tab=optimization', 'shootback&tab=optimization');
}

add_action( 'admin_menu', 'shootback_create_menu' );

function shootback_template_modals($location = 'header', $template_id = 'default', $template_name = 'Default') {
	ob_start();
    ob_clean();
    	wp_editor('', 'ts_editor_id', array('textarea_name' => 'ts_name_textarea'));
    $editor_code = ob_get_clean();
	return '<table>
		<tr>
			<td style="width: 500px">
				<p>
					<input id="ts-blank-template" data-toggle="modal" data-target="#ts-confirmation" type="button" name="submit" class="button-primary" value="'.__('Clear layout', 'shootback') . '" />

					<input id="ts-save-as-template" data-location="'.esc_attr($location).'" data-toggle="modal" data-target="ts-save-template-modal" type="button" name="submit" class="button-primary" value="' . __('Save as...', 'shootback') . '" />

					<input id="ts-load-template-button" data-location="'.esc_attr($location).'" type="button" name="submit" class="button-primary" value="'. __('Load template', 'shootback') . '" />
				</p>
				<!-- Blank template modal -->
				<div class="modal ts-modal fade" id="ts-blank-template-modal" tabindex="-1" role="dialog" aria-labelledby="blank-template-modal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="blank-template-modal">' . __('Blank template', 'shootback') . '</h4>
							</div>
							<div class="modal-body">
								<h5>' . __('Template name', 'shootback') . '</h5>
								<input type="text" name="template_name" value="" id="ts-blank-template-name"/>
							</div>
					      	<div class="modal-footer">
					        	<button type="button" class="button-primary" data-dismiss="modal">' . __('Close', 'shootback') . ' </button>
								<button type="button" class="button-primary" data-location="' . esc_attr($location) . '" id="ts-save-blank-template-action">' . __('Save', 'shootback') .'</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Blank template modal confirmation -->
				<div class="modal ts-modal fade" id="ts-confirmation" tabindex="-1" role="dialog" aria-labelledby="blank-modal-confirmation-label" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="blank-modal-confirmation-label">' . __('Are you sure?', 'shootback') . '</h4>
							</div>
							<div class="modal-body">
								<p>' . __('The layout you currently have on the page will be removed. It will only be saved in the database only after you click Save Layout (Publish) button.', 'shootback') . '</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="button-primary ts-modal-confirm">' . __('Yes', 'shootback') . '</button>
								<button type="button" class="button-primary ts-modal-decline" data-dismiss="modal">' . __('No', 'shootback') .' </button>
							</div>
						</div>
					</div>
				</div>

				<!-- Save as... template modal -->
				<div class="modal ts-modal fade" id="ts-save-template-modal" tabindex="-1" role="dialog" aria-labelledby="save-template-modal-label" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="save-template-modal-label">' . __('Save template', 'shootback') . '</h4>
							</div>
							<div class="modal-body">
								<h5>' . __('Template name', 'shootback') . ':</h5>
								<input type="text" name="template_name" value="" id="ts-save-template-name"/>
							</div>
							<div class="modal-footer">
								<button type="button" class="button-primary" data-dismiss="modal">' . __('Close', 'shootback') . '</button>
								<button type="button" class="button-primary" data-location="'.esc_attr($location).'" id="ts-save-as-template-action">' . __('Save', 'shootback') . '</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Load template modal -->
				<div class="modal ts-modal fade" id="ts-load-template" tabindex="-1" role="dialog" aria-labelledby="load-template-modal-label" aria-hidden="true">
					<div class="modal-dialog">
					    <div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="load-template-modal-label">' . __('Load template', 'shootback') . '</h4>
							</div>
							<div class="modal-body">
								<h5>' . __('Select template', 'shootback') . ':</h5>
								<table id="ts-layout-list">

								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="button-primary" data-dismiss="modal">'.__('Cancel', 'shootback') . '</button>
								<button type="button" class="button-primary" data-location="'.esc_attr($location).'" id="ts-load-template-action">' . __('Load', 'shootback') . '</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Open builder options modal -->
				<div id="ts-builder-elements-modal-preloader"></div>
				<div class="modal ts-modal fade" id="ts-builder-elements-modal" tabindex="-1" role="dialog" aria-labelledby="ts-builder-elements-modal-label" aria-hidden="true">
					<div class="modal-dialog">
					    <div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="ts-builder-elements-modal-label">' . __('Builder elements', 'shootback') . '</h4>
							</div>
							<div class="modal-body">

							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div id="ts-builder-elements-editor-preloader"></div>
				<div class="tsz-text-editor-modal">
					<div class="tsz-modal-content">
						<div class="modal-header">
							<button type="button" class="tsz-editor-modal-close">&times;</button>
							<h4 class="modal-title" id="ts-builder-elements-editor-modal-label">' . esc_html__( 'Text element', 'shootback' ) . '</h4>
						</div>
						<div class="modal-body">
							<table width="100%" cellpadding="10">
							    <tr>
							        <td>
							            <label for="text-admin-label">' . esc_html__('Admin label','shootback') . ':</label>
							        </td>
							        <td>
							           <input type="text" id="text-admin-label" name="text-admin-label" />
							        </td>
							    </tr>
							    <tr>
							        <td>' . esc_html__('Add your text here','shootback') . ':</td><td>'
								. $editor_code .
								'</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="tsz-modal-footer">
						<div class="button-primary ts-save-editor save-element">' . esc_html__('Save', 'shootback') . '</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<h3>
					<strong> ' . __('Template name', 'shootback') . ' :</strong> <span id="ts-template-name">'.wp_kses($template_name, array()).'</span>
				</h3>
				<input type="hidden" name="template_id" id="ts-template-id" value="'.esc_attr($template_id).'"/>
				<input type="hidden" name="template_location" value="' . esc_attr($location) . '" />
			</td>
		</tr>
	</table>';
}

/**
 * Edit header
 */
function shootback_header()
{
?>
	<div class="wrap">
		<div class="wrap-red-templates">
			<p><h2><?php _e('Header', 'shootback') ?></h2></p>
			<?php
				$template_id = Template::get_template_info('header', 'id');
				$template_name = Template::get_template_info('header', 'name');
			 	echo shootback_template_modals( 'header', $template_id, $template_name );
			?>
			<br/><br/>
			<?php ts_layout_wrapper(Template::edit('header')); ?>
			<input id="save-header-footer" data-location="header" type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes', 'shootback') ?>"/>
		</div>
	</div>
<?php
}

/**
 * Edit footer
 */
function shootback_footer()
{
?>
	<div class="wrap">
		<div class="wrap-red-templates">
			<p><h2><?php _e('Footer', 'shootback') ?> W…P…L…O…C…K…E…R….…C…O…M</h2></p>
			<?php
				$template_id = Template::get_template_info('footer', 'id');
				$template_name = Template::get_template_info('footer', 'name');
				echo shootback_template_modals( 'footer', $template_id, $template_name );
			?>
			<br/><br/>

			<?php ts_layout_wrapper(Template::edit('footer')); ?>
			<input id="save-header-footer" data-location="footer" type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes', 'shootback') ?>"/>
		</div>
	</div>
<?php
}

function shootback_display_menu_page( $active_tab = '')
{
?>

<div class="wrap">
		<div class="wrap-red">
		<?php
			settings_errors();

			if ( isset( $_GET['tab'] ) ) {

				$active_tab = $_GET['tab'];

			} else if ( $active_tab === 'general' ) {

				$active_tab = 'general';

			} else if ( $active_tab === 'styles' ) {

				$active_tab = 'styles';

			} else if ( $active_tab === 'image_sizes' ) {

				$active_tab = 'image_sizes';

			} else if ( $active_tab === 'layout' ) {

				$active_tab = 'layout';

			} else if ( $active_tab === 'typography' ) {

				$active_tab = 'typography';

			} else if ( $active_tab === 'single' ) {

				$active_tab = 'single';

			} else if ( $active_tab === 'page_settings' ) {

				$active_tab = 'page_settings';

			} else if ( $active_tab === 'social' ) {

				$active_tab = 'social';

			} else if ( $active_tab === 'custom_css' ) {

				$active_tab = 'custom_css';

			} else if ( $active_tab === 'sidebars' ) {

				$active_tab = 'sidebars';

			} else if ( $active_tab === 'impots_options' ) {

				$active_tab = 'impots_options';

			} else if ( $active_tab === 'red_area' ) {

				$active_tab = 'red_area';

			} else if ( $active_tab === 'theme_advertising' ) {

				$active_tab = 'theme_advertising';

			} else if ( $active_tab === 'support' ) {

				$active_tab = 'support';

			} else {

				$active_tab = 'general';
			}
		?>
		<div id="red-wprapper">
			<div id="red-menu">
				<ul id="theme-setting">
					<li>
						<a href="?page=shootback&tab=general" class="<?php echo $active_tab == 'general' ? 'selected-tab' : ''; ?>">
							<i class="icon-settings"></i>
							<span><?php _e( 'General', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=styles" class="<?php echo $active_tab == 'styles' ? 'selected-tab' : ''; ?>">
							<i class="icon-code"></i>
							<span><?php _e( 'Styles', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=colors" class="<?php echo $active_tab == 'colors' ? 'selected-tab' : ''; ?>">
							<i class="icon-palette"></i>
							<span><?php _e( 'Colors', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=image_sizes" class="<?php echo $active_tab == 'image_sizes' ? 'selected-tab' : ''; ?>">
							<i class="icon-image-size"></i>
							<span><?php _e( 'Image sizes', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=layout" class="<?php echo $active_tab == 'layout' ? 'selected-tab' : ''; ?>">
							<i class="icon-layout"></i>
							<span><?php _e( 'Layout', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=typography" class="<?php echo $active_tab == 'typography' ? 'selected-tab' : ''; ?>">
							<i class="icon-edit"></i>
							<span><?php _e( 'Typography', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=single" class="<?php echo $active_tab == 'single' ? 'selected-tab' : ''; ?>">
							<i class="icon-post"></i>
							<span><?php _e( 'Single post', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=page_settings" class="<?php echo $active_tab == 'page_settings' ? 'selected-tab' : ''; ?>">
							<i class="icon-page"></i>
							<span><?php _e( 'Page settings', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=social" class="<?php echo $active_tab == 'social' ? 'selected-tab' : ''; ?>">
							<i class="icon-social"></i>
							<span><?php _e( 'Social', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=custom_css" class="<?php echo $active_tab == 'custom_css' ? 'selected-tab' : ''; ?>">
							<i class="icon-code"></i>
							<span><?php _e( 'Custom CSS', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=sidebars" class="<?php echo $active_tab == 'sidebars' ? 'selected-tab' : ''; ?>">
							<i class="icon-sidebar"></i>
							<span><?php _e( 'Sidebars', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=impots_options" class="<?php echo $active_tab == 'impots_options' ? 'selected-tab' : ''; ?>">
							<i class="icon-import"></i>
							<span><?php _e( 'Import options', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=theme_advertising" class="<?php echo $active_tab == 'theme_advertising' ? 'selected-tab' : ''; ?>">
							<i class="icon-dollar"></i>
							<span><?php _e( 'Advertising', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=theme_update" class="<?php echo $active_tab == 'theme_update' ? 'selected-tab' : ''; ?>">
							<i class="icon-download"></i>
							<span><?php _e( 'Theme update', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=red_area" class="<?php echo $active_tab == 'red_area' ? 'selected-tab' : ''; ?>">
							<i class="icon-attention"></i>
							<span><?php _e( 'Red Area', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=support" class="<?php echo $active_tab == 'support' ? 'selected-tab' : ''; ?>">
							<i class="icon-support"></i>
							<span><?php _e( 'Support', 'shootback' ); ?></span>
						</a>
					</li>
					<li>
						<a href="?page=shootback&tab=optimization" class="<?php echo $active_tab == 'optimization' ? 'selected-tab' : ''; ?>">
							<i class="icon-signal"></i>
							<span><?php _e( 'Optimization', 'shootback' ); ?></span>
						</a>
					</li>
				</ul>
			</div>
			<div id="red-options">
				<div class="theme-name">
					<h3>Shootback</h3>
					<h3>TouchSize</h3>
				</div>
				<?php if ($active_tab !== 'impots_options' ): ?>
				<form method="post" data-table="<?php echo $active_tab; ?>" action="options.php">
				<?php endif ?>
					<?php
						if ( $active_tab === 'general' ) {

							settings_fields( 'shootback_general' );
							do_settings_sections( 'shootback_general' );

						} else if ( $active_tab === 'styles' ) {

							settings_fields( 'shootback_styles' );
							do_settings_sections( 'shootback_styles' );

						} else if ( $active_tab === 'colors' ) {

							settings_fields( 'shootback_colors' );
							do_settings_sections( 'shootback_colors' );

						} else if ( $active_tab === 'image_sizes' ) {

							settings_fields( 'shootback_image_sizes' );
							do_settings_sections( 'shootback_image_sizes' );

						} else if ( $active_tab === 'layout' ) {

							settings_fields( 'shootback_layout' );
							do_settings_sections( 'shootback_layout' );

						} else if ( $active_tab === 'typography' ) {

							settings_fields( 'shootback_typography' );
							do_settings_sections( 'shootback_typography' );

						} else if ( $active_tab === 'single' ) {

							settings_fields( 'shootback_single_post' );
							do_settings_sections( 'shootback_single_post' );

						} else if ( $active_tab === 'page_settings' ) {

							settings_fields( 'shootback_page' );
							do_settings_sections( 'shootback_page' );

						} else if ( $active_tab === 'social' ) {

							settings_fields( 'shootback_social' );
							do_settings_sections( 'shootback_social' );

						} else if ( $active_tab === 'custom_css' ) {

							settings_fields( 'shootback_css' );
							do_settings_sections( 'shootback_css' );

						} else if ( $active_tab === 'sidebars' ) {

							settings_fields( 'shootback_sidebars' );
							do_settings_sections( 'shootback_sidebars' );

						} else if ( $active_tab === 'theme_advertising' ) {

							settings_fields( 'shootback_theme_advertising' );
							do_settings_sections( 'shootback_theme_advertising' );

						} else if ( $active_tab === 'theme_update' ) {

							settings_fields( 'shootback_theme_update' );
							do_settings_sections( 'shootback_theme_update' );

						}  else if ( $active_tab === 'impots_options' ) {

							settings_fields( 'shootback_impots_options' );
							do_settings_sections( 'shootback_impots_options' );

						} else if ( $active_tab === 'red_area' ) {

							settings_fields( 'shootback_red_area' );
							do_settings_sections( 'shootback_red_area' );

						} else if ( $active_tab === 'support' ) {

							settings_fields( 'shootback_support' );
							do_settings_sections( 'shootback_support' );

						} else if ( $active_tab === 'optimization' ) {

							settings_fields( 'shootback_optimization' );
							do_settings_sections( 'shootback_optimization' );

						}

					if ( $active_tab != 'sidebars' && $active_tab != 'red_area' && $active_tab != 'impots_options' && $active_tab != 'support' ) {
						submit_button(__('Save changes','shootback'), 'button', 'ts_submit_button');
					}
				?>

				<?php if ($active_tab !== 'impots_options' ): ?>
				</form>
				<?php endif ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<?php
}

function shootback_optimization_options()
{
	//delete_option('shootback_optimization');
	if ( false === get_option( 'shootback_optimization' ) ) {

		add_option( 'shootback_optimization', array(
			'include_parallax'            => 'y',
			'include_parallax_background' => 'y',
			'include_chart' => 'y'
		));

	} // end if

	// Register a section
	add_settings_section(
		'optimization_settings_section',
		__( 'Optimization settings', 'shootback' ),
		'shootback_optimizition_callback',
		'shootback_optimization'
	);

	add_settings_field(
		'include_parallax',
		__( 'Include parallax slider', 'shootback' ),
		'toggle_include_parallax_callback',
		'shootback_optimization',
		'optimization_settings_section',
		array(
			__( 'Include parallax slider scripts', 'shootback' )
		)
	);

	add_settings_field(
		'include_parallax_background',
		__( 'Include parallax background row', 'shootback' ),
		'toggle_include_parallax_background_callback',
		'shootback_optimization',
		'optimization_settings_section',
		array(
			__( 'Include parallax background scripts', 'shootback' )
		)
	);

	add_settings_field(
		'include_chart',
		__( 'Include chart script', 'shootback' ),
		'toggle_include_chart_callback',
		'shootback_optimization',
		'optimization_settings_section',
		array(
			__( 'Include chart scripts', 'shootback' )
		)
	);


	register_setting( 'shootback_optimization', 'shootback_optimization');

} // END shootback_initialize_general_options

add_action( 'admin_init', 'shootback_optimization_options' );


function shootback_optimizition_callback()
{
	echo '<p>'.__( 'Below are the optimization options that this theme offers. You can enable/disable options and sections of your website.', 'shootback' ).'</p>';
}

function toggle_include_parallax_callback($args)
{
	$includeParallax = get_option('shootback_optimization', array('include_parallax' => 'y'));
	$includeParallax = (isset($includeParallax['include_parallax']) && ($includeParallax['include_parallax'] == 'y' || $includeParallax['include_parallax'] == 'n')) ? $includeParallax['include_parallax'] : 'y';

	$html = '<select name="shootback_optimization[include_parallax]">
				<option value="y"' . selected($includeParallax, 'y', false) . '>' . __('Yes', 'shootback') . '</option>
				<option value="n"' . selected($includeParallax, 'n', false) . '>' . __('No', 'shootback') . '</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_include_parallax_background_callback($args)
{
	$includeParallaxBackground = get_option('shootback_optimization', array('include_parallax_background' => 'y'));
	$includeParallaxBackground = (isset($includeParallaxBackground['include_parallax_background']) && ($includeParallaxBackground['include_parallax_background'] == 'y' || $includeParallaxBackground['include_parallax_background'] == 'n')) ? $includeParallaxBackground['include_parallax_background'] : 'y';

	$html = '<select name="shootback_optimization[include_parallax_background]">
				<option value="y"' . selected($includeParallaxBackground, 'y', false) . '>' . __('Yes', 'shootback') . '</option>
				<option value="n"' . selected($includeParallaxBackground, 'n', false) . '>' . __('No', 'shootback') . '</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_include_chart_callback($args)
{
	$includeChart = get_option('shootback_optimization', array('include_chart' => 'y'));
	$includeChart = (isset($includeChart['include_chart']) && ($includeChart['include_chart'] == 'y' || $includeChart['include_chart'] == 'n')) ? $includeChart['include_chart'] : 'y';

	$html = '<select name="shootback_optimization[include_chart]">
				<option value="y"' . selected($includeChart, 'y', false) . '>' . __('Yes', 'shootback') . '</option>
				<option value="n"' . selected($includeChart, 'n', false) . '>' . __('No', 'shootback') . '</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}



/**
 * Iniaitalize the theme options page by registering the Fields, Sections, Settings
 */
function shootback_initialize_general_options()
{
	//delete_option('shootback_general');
	if ( false === get_option( 'shootback_general' ) ) {

		add_option( 'shootback_general', array(
			'featured_image_in_post' => 'Y',
			'enable_lightbox'        => 'Y',
			'enable_imagesloaded'    => 'N',
			'comment_system'         => 'default',
			'show_wp_admin_bar'      => 'Y',
			'enable_sticky_menu'     => 'Y',
			'enable_mega_menu'     	 => 'N',
			'sticky_menu_bg_color'	 => '#FFFFFF',
			'sticky_menu_text_color' => '#444444',
			'tracking_code'			 => '',
			'enable_preloader'		 => 'N',
			'onepage_website'		 => 'N',
			'facebook_id'			 => '',
			'grid_excerpt'			 => 260,
			'list_excerpt'			 => 600,
			'bigpost_excerpt'	     => 260,
			'timeline_excerpt'	     => 260,
			'featured_area_excerpt'	 => 160,
			'enable_facebook_box'    => 'N',
			'facebook_name' 		 => '',
			'like'                   => 'y',
			'like_icons'             => 'heart',
			'mode_display_menu'      => 'ts-orizontal-menu',
			'slug_video_taxonomy'    => 'videos_categories',
			'slug_video'             => 'video',
			'slug_portfolio_taxonomy'=> 'portfolio-categories',
			'slug_portfolio'         => 'portfolio',
			'slug_event_taxonomy'    => 'event-categories',
			'slug_event'             => 'event',
			'slug_gallery_taxonomy'  => 'gallery-categories',
			'slug_gallery'           => 'gallery',
			'show_description'       => 'y',
			'show_icons'             => 'y',
			'right_click'            => 'n'
		));

	} // end if

	// Register a section
	add_settings_section(
		'general_settings_section',
		__( 'General Options', 'shootback' ),
		'shootback_general_options_callback',
		'shootback_general'
	);

	add_settings_field(
		'enable_preloader',
		__( 'Enable preloader for website?', 'shootback' ),
		'toggle_enable_preloader_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "If you want to add a preloader to your website, you can activate it only for your frontpage, for the whole website or disable it.", 'shootback' )
		)
	);

	add_settings_field(
		'onepage_website',
		__( 'Enable the onepage layout', 'shootback' ),
		'toggle_onepage_website_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "If you enable this, you'll activate the smooth scrolling for the menus in onepage layout. Do not forget to create links with the row names and set them in your menu. For more info check the documentation.", 'shootback' )
		)
	);

	add_settings_field(
		'featured_image_in_post',
		__( 'Display featured image in post?', 'shootback' ),
		'toggle_featured_image_in_post_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "Use this to hide or show the featured image in posts.", 'shootback' )
		)
	);

	add_settings_field(
		'enable_lightbox',
		__( 'Enable lightbox?', 'shootback' ),
		'toggle_enable_lightbox_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "Enable this if you want your featured images on single pages to have lightbox available", 'shootback')
		)
	);

	add_settings_field(
		'enable_imagesloaded',
		__( 'Want to use imagesloaded?', 'shootback' ),
		'toggle_enable_imagesloaded_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "Help loading site with a relatively higher speed.", 'shootback')
		)
	);

	add_settings_field(
		'comment_system',
		__( 'Which comment system you want to use?', 'shootback' ),
		'toggle_comment_system_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Select which type of comments do you want to use.', 'shootback' )
		)
	);

	add_settings_field(
		'enable_facebook_box',
		__( 'Facebook modal box page', 'shootback' ),
		'facebook_page_modal_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Add the page modal box in the site.', 'shootback' )
		)
	);

	add_settings_field(
		'show_wp_admin_bar',
		__( 'Show wordpress admin bar?', 'shootback' ),
		'toggle_show_wp_admin_bar_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'This options disables the wordpress admin bar when logged.', 'shootback' )
		)
	);

	add_settings_field(
		'enable_sticky_menu',
		__( 'Enable sticky menu', 'shootback' ),
		'toggle_enable_sticky_menu_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Enable sticky menu', 'shootback' )
		)
	);

	add_settings_field(
		'enable_mega_menu',
		__( 'Enable mega menu', 'shootback' ),
		'toggle_enable_mega_menu_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "If you want to add a mega menu to your website, you can activate it.", 'shootback' )
		)
	);

	add_settings_field(
		'like',
		__( 'Enable likes', 'shootback' ),
		'toggle_like_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "If you want to add a likes to your website, you can activate it.", 'shootback' )
		)
	);

	add_settings_field(
		'like_icons',
		__( 'Select your icon for like', 'shootback' ),
		'toggle_like_icons_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "You can select your icon for likes.", 'shootback' )
		)
	);

	add_settings_field(
		'generate_likes',
		__( 'You can add the likes to posts', 'shootback' ),
		'toggle_generate_likes_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( "You can generate likes in your posts.", 'shootback' )
		)
	);

	add_settings_field(
		'tracking_code',
		__( 'Tracking code', 'shootback' ),
		'toggle_tracking_code_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Google analytics or any other scripts you have', 'shootback' )
		)
	);


	add_settings_field(
		'grid_excerpt',
		__( 'Grid view excerpt size', 'shootback' ),
		'toggle_grid_excerpt_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'If you want to shorten or use more characters for your grid articles change the number here', 'shootback' )
		)
	);

	add_settings_field(
		'list_excerpt',
		__( 'List view excerpt size', 'shootback' ),
		'toggle_list_excerpt_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'If you want to shorten or use more characters for your list articles change the number here', 'shootback' )
		)
	);

	add_settings_field(
		'bigpost_excerpt',
		__( 'Big posts view excerpt size', 'shootback' ),
		'toggle_bigpost_excerpt_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'If you want to shorten or use more characters for your big post articles change the number here', 'shootback' )
		)
	);

	add_settings_field(
		'timeline_excerpt',
		__( 'Timeline view excerpt size', 'shootback' ),
		'toggle_timeline_excerpt_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'If you want to shorten or use more characters for your list articles change the number here', 'shootback' )
		)
	);

	add_settings_field(
		'featured_area_excerpt',
		__( 'Featured area excerpt size', 'shootback' ),
		'toggle_featured_area_excerpt_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'If you want to shorten or use more characters for your featured area articles change the number here', 'shootback' )
		)
	);

	add_settings_field(
		'right_click',
		__( 'Disable right click', 'shootback' ),
		'toggle_right_click_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'If you want to disable right click on the page set "yes"', 'shootback' )
		)
	);

	add_settings_field(
		'slug_video',
		__( 'Change custom post video slug', 'shootback' ),
		'toggle_slug_video_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for video custom post', 'shootback' )
		)
	);

	add_settings_field(
		'slug_video_taxonomy',
		__( 'Change archive video slug', 'shootback' ),
		'toggle_slug_video_taxonomy_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for video texonomy', 'shootback' )
		)
	);

	add_settings_field(
		'slug_portfolio',
		__( 'Change custom post portfolio slug', 'shootback' ),
		'toggle_slug_portfolio_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for portfolio custom post', 'shootback' )
		)
	);

	add_settings_field(
		'slug_portfolio_taxonomy',
		__( 'Change archive portfolio slug', 'shootback' ),
		'toggle_slug_portfolio_taxonomy_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for portfolio taxonomy', 'shootback' )
		)
	);

	add_settings_field(
		'slug_event',
		__( 'Change custom post event slug', 'shootback' ),
		'toggle_slug_event_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for event custom post', 'shootback' )
		)
	);

	add_settings_field(
		'slug_event_taxonomy',
		__( 'Change archive event slug', 'shootback' ),
		'toggle_slug_event_taxonomy_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for event taxonomy', 'shootback' )
		)
	);

	add_settings_field(
		'slug_gallery',
		__( 'Change custom post gallery slug', 'shootback' ),
		'toggle_slug_gallery_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for gallery custom post', 'shootback' )
		)
	);

	add_settings_field(
		'slug_gallery_taxonomy',
		__( 'Change archive gallery slug', 'shootback' ),
		'toggle_slug_gallery_taxonomy_callback',
		'shootback_general',
		'general_settings_section',
		array(
			__( 'Slug for gallery taxonomy', 'shootback' )
		)
	);

	add_settings_section(
		'general_settings_section',
		__( 'Support', 'shootback' ),
		'shootback_support_callback',
		'shootback_support'
	);

	register_setting( 'shootback_general', 'shootback_general');

} // END shootback_initialize_general_options

add_action( 'admin_init', 'shootback_initialize_general_options' );

/**************************************************
 * Section Callbacks
 *************************************************/

function shootback_general_options_callback()
{
	echo '<p>'.__( 'Below are the general options that this theme offers. You can enable/disable options and sections of your website.', 'shootback' ).'</p>';
} // END shootback_general_options_callback

function shootback_support_callback()
{
	echo '<strong>Dear customers</strong>,<br><br>

			<p>To make sure you recieve fast and quality support - please make sure you use our help desk for any questions regarding theme theme settings and questions about how it works. <strong style="color: red;">We offer support exclusively on the help desk</strong>, and emailing or contacting us via any other forms will result in lost time and longer waits. We try to respond to your questions as soon as possible, but please, be patient, calm and friendly. It it a huge amount of work to respond to everyone and being rude to our support guys will just not make it easier for any of us.</p>

			<p>If you found any bugs and issues while using our theme, please report them to our support guys.</p>

			<p>Note: Before submitting a ticket, try to disable ALL your plugins and make sure you are using the latest version of the theme. If you are not sure which is the latest one, you can check it on our website - www.touchsize.com. We cannot guarantee that the theme will work perfectly with all the plugins out there, since there might be conflicts or errors in your plugins. If you do find such conflicts, also - report them to our support team.</p>

			<p>Thank you very much for your understanding and we hope you are having a nice experience with the theme.</p>

			<a href="http://support.touchsize.com" target="_blank" class="go-help-desk">Go to help desk</a>';
}

function toggle_enable_preloader_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[enable_preloader]">
		<option value="Y" '. selected( @$options["enable_preloader"], 'Y', false ). '>' . __('Yes', 'shootback') . '</option>
		<option value="N" '. selected( @$options["enable_preloader"], 'N', false ). '>' . __('No', 'shootback') . '</option>
		<option value="FP" '. selected( @$options["enable_preloader"], 'FP', false ). '>' . __('Only on first page', 'shootback') . '</option>
	</section>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_onepage_website_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[onepage_website]">
		<option value="Y" '. selected( @$options["onepage_website"], 'Y', false ). '>' . __('Yes', 'shootback') . '</option>
		<option value="N" '. selected( @$options["onepage_website"], 'N', false ). '>' . __('No', 'shootback') . '</option>
	</section>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_featured_image_in_post_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[featured_image_in_post]">
					<option value="Y" '. selected( @$options["featured_image_in_post"], 'Y', false ). '>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["featured_image_in_post"], 'N', false ).'>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_enable_imagesloaded_callback($args){

	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[enable_imagesloaded]">
					<option value="Y" '. selected( @$options["enable_imagesloaded"], 'Y', false ). '>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["enable_imagesloaded"], 'N', false ).'>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_enable_lightbox_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[enable_lightbox]">
					<option value="Y" '. selected( @$options["enable_lightbox"], 'Y', false ). '>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["enable_lightbox"], 'N', false ).'>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_comment_system_callback($args)
{
	$options = get_option('shootback_general');

	$is_hidden = ( @$options["comment_system"] === 'default' ) ? 'hidden' : '';
	$facebook_id = @$options["facebook_id"];

	$html = '<select name="shootback_general[comment_system]" id="ts_comment_system">
				<option value="default" '. selected( @$options["comment_system"], 'default', false ).'>'.__( 'Default', 'shootback' ).'</option>
				<option value="facebook" '. selected( @$options["comment_system"], 'facebook', false ).'>Facebook</option>
			</select>

			<p class="description">' .$args[0]. '</p>

			<div id="facebook_app_id" class="' . $is_hidden . '">
				<p>' . __('Get a Facebook App ID', 'shootback') . '</p>
				<input type="text" name="shootback_general[facebook_id]" value="' . esc_attr($facebook_id) . '" />
			</div>

			<script>
				jQuery( document ).ready(function( $ ) {
					var facebook_id = $("#facebook_app_id");

					$("#ts_comment_system").change(function(){
						if ($(this).val() === "default") {
							facebook_id.addClass("hidden");
						} else {
							facebook_id.removeClass("hidden");
						}
					});
				});
			</script>';

	echo $html;
}

function facebook_page_modal_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[enable_facebook_box]" id="enable_facebook_box">
				<option value="Y" '. selected( @$options["enable_facebook_box"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["enable_facebook_box"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	$enable_facebook_box_options = ($options["enable_facebook_box"] === 'Y') ? '' : 'hidden';

	$html .= '<div id="facebook_page" class="'.$enable_facebook_box_options .'">
				<p>' . __('Page name', 'shootback') . ':</p>
				<input type="text" id="facebook_box" name="shootback_general[facebook_name]" value="' . @$options['facebook_name'] . '" />
			 </div>';

	echo $html;
}

function toggle_show_wp_admin_bar_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[show_wp_admin_bar]">
					<option value="Y" '. selected( @$options["show_wp_admin_bar"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["show_wp_admin_bar"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_enable_sticky_menu_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[enable_sticky_menu]" id="enable_sticky_menu">
				<option value="Y" '. selected( @$options["enable_sticky_menu"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["enable_sticky_menu"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	$enable_sticky_menu_options = ($options["enable_sticky_menu"] === 'Y') ? '' : 'hidden';

	$html .= '<div id="sticky_menu_options" class="'.$enable_sticky_menu_options .'">
				<p>' . __('Background color', 'shootback') . ':</p>
				<input type="text" id="sticky_menu_bg_color" name="shootback_general[sticky_menu_bg_color]" value="' . @$options['sticky_menu_bg_color'] . '" />
				<div id="sticky_menu_bg_color_picker"></div>

				<p>' . __('Text color', 'shootback') . ':</p>
				<input type="text" id="sticky_menu_text_color" name="shootback_general[sticky_menu_text_color]" value="' . @$options['sticky_menu_text_color'] . '" />
				<div id="sticky_menu_text_color_picker"></div>

				<p>' . __('Show description', 'shootback') . ':</p>
				<select name="shootback_general[show_description]">
					<option ' . selected($options['show_description'], 'y', false) . ' value="y">' . __('Yes', 'shootback') . '</option>
					<option ' . selected($options['show_description'], 'n', false) . ' value="n">' . __('No', 'shootback') . '</option>
				</select>

				<p>' . __('Show icons', 'shootback') . ':</p>
				<select name="shootback_general[show_icons]">
					<option ' . selected($options['show_icons'], 'y', false) . ' value="y">' . __('Yes', 'shootback') . '</option>
					<option ' . selected($options['show_icons'], 'n', false) . ' value="n">' . __('No', 'shootback') . '</option>
				</select>
			</div>';

	echo $html;
}

function toggle_enable_mega_menu_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[enable_mega_menu]" id="enable_mega_menu">
				<option value="Y" '. selected( @$options["enable_mega_menu"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["enable_mega_menu"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_like_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<select name="shootback_general[like]" class="enable-likes">
				<option value="y" '. selected( @$options["like"], 'y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="n" '. selected( @$options["like"], 'n', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_like_icons_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<div class="icons-likes">
				<ul class="imageRadioMetaUl perRow-3 builder-icon-list ts-custom-selector" data-selector="#likes-icons">
	               <li><i class="icon-heart clickable-element" data-option="heart"></i></li>
	               <li><i class="icon-thumb clickable-element" data-option="thumb"></i></li>
	               <li><i class="icon-star clickable-element" data-option="star"></i></li>
	            </ul>
	            <select class="hidden" name="shootback_general[like_icons]" id="likes-icons">
	                <option value="heart" '. selected( @$options["like_icons"], 'heart', false ). '>' . __( 'Heart', 'shootback' ) . '</option>
	                <option value="thumb" '. selected( @$options["like_icons"], 'thumb', false ). '>' . __( 'Thumb', 'shootback' ) . '</option>
	                <option value="star" '. selected( @$options["like_icons"], 'star', false ). '>' . __( 'Star', 'shootback' ) . '</option>
	            </select>
	         </div>';
	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_generate_likes_callback($args)
{
	$html = '<div class="generate-likes">
				<input type="button" id="generate-likes" value="' . __( "Generate likes","shootback" ) . '" />
				<div style="display:none;" class="ts-wait">' . __('Please wait...', 'shootback') . '</div>
				<div style="display:none;" class="ts-succes-like">' . __('Done!', 'shootback') . '</div>
				<div style="display:none;" class="ts-error-like">' . __('Error!', 'shootback') . '</div>
			</div>';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_tracking_code_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<textarea name="shootback_general[tracking_code]">'.esc_attr(@$options["tracking_code"]).'</textarea>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_grid_excerpt_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<input type="text" name="shootback_general[grid_excerpt]" value="'.esc_attr(@$options["grid_excerpt"]).'" />';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_list_excerpt_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<input type="text" name="shootback_general[list_excerpt]" value="'.esc_attr(@$options["list_excerpt"]).'" />';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_bigpost_excerpt_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<input type="text" name="shootback_general[bigpost_excerpt]" value="'.esc_attr(@$options["bigpost_excerpt"]).'" />';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_timeline_excerpt_callback($args)
{
	$options = get_option('shootback_general');

	$html = '<input type="text" name="shootback_general[timeline_excerpt]" value="'.esc_attr(@$options["timeline_excerpt"]).'" />';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_featured_area_excerpt_callback($args)
{
	$options = get_option('shootback_general');
	$featuredAreaExcerpt = (isset($options['featured_area_excerpt']) && is_numeric($options['featured_area_excerpt'])) ? absint($options['featured_area_excerpt']) : 160;

	$html = '<input type="text" name="shootback_general[featured_area_excerpt]" value="' . $featuredAreaExcerpt . '" />';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_right_click_callback($args)
{
	$options = get_option('shootback_general');
	$rightClick = (isset($options['right_click']) && ($options['right_click'] == 'y' || $options['right_click'] == 'n')) ? $options['right_click'] : 'n';

	$html = '<select name="shootback_general[right_click]">
				<option ' . selected($rightClick, 'y', false) . ' value="y">' . __('Yes', 'shootback') . '</option>
				<option ' . selected($rightClick, 'n', false) . ' value="n">' . __('No', 'shootback') . '</option>
			</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_video_callback($args)
{
	$options = get_option('shootback_general');

    $html = '<input type="text" name="shootback_general[slug_video]" value="' . $options['slug_video'] . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_video_taxonomy_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_video_taxonomy']) && $options['slug_video_taxonomy'] !== '') ? $options['slug_video_taxonomy'] : 'videos_categories';

    $html = '<input type="text" name="shootback_general[slug_video_taxonomy]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_portfolio_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_portfolio']) && $options['slug_portfolio'] !== '') ? $options['slug_portfolio'] : 'portfolio';

    $html = '<input type="text" name="shootback_general[slug_portfolio]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_portfolio_taxonomy_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_portfolio_taxonomy']) && $options['slug_portfolio_taxonomy'] !== '') ? $options['slug_portfolio_taxonomy'] : 'portfolio-categories';

    $html = '<input type="text" name="shootback_general[slug_portfolio_taxonomy]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_event_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_event']) && $options['slug_event'] !== '') ? $options['slug_event'] : 'event';

    $html = '<input type="text" name="shootback_general[slug_event]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_event_taxonomy_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_event_taxonomy']) && $options['slug_event_taxonomy'] !== '') ? $options['slug_event_taxonomy'] : 'event-categories';

    $html = '<input type="text" name="shootback_general[slug_event_taxonomy]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_gallery_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_gallery']) && $options['slug_gallery'] !== '') ? $options['slug_gallery'] : 'gallery';

    $html = '<input type="text" name="shootback_general[slug_gallery]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_slug_gallery_taxonomy_callback($args)
{
	$options = get_option('shootback_general');
	$slug = (isset($options['slug_gallery_taxonomy']) && $options['slug_gallery_taxonomy'] !== '') ? $options['slug_gallery_taxonomy'] : 'gallery-categories';

    $html = '<input type="text" name="shootback_general[slug_gallery_taxonomy]" value="' . $slug . '"/>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function shootback_initialize_image_sizes_options($args) {

	if( false === get_option( 'shootback_image_sizes' ) ) {

		$defaults = array(
			'grid' => array(
				'width'  => '450',
				'height' => '350',
				'mode'   => 'crop'
			),
			'thumbnails' => array(
				'width'  => '450',
				'height' => '370',
				'mode'   => 'crop'
			),
			'bigpost' => array(
				'width'  => '720',
				'height' => '400',
				'mode'   => 'crop'
			),
			'superpost' => array(
				'width'  => '700',
				'height' => '350',
				'mode'   => 'crop'
			),
			'single' => array(
				'width'  => '1140',
				'height' => '9999',
				'mode'   => 'resize'
			),
			'portfolio' => array(
				'width'  => '1140',
				'height' => '9999',
				'mode'   => 'resize'
			),
			'featarea' => array(
				'width'  => '920',
				'height' => '440',
				'mode'   => 'crop'
			),
			'slider' => array(
				'width'  => '1920',
				'height' => '650',
				'mode'   => 'crop'
			),
			'carousel' => array(
				'width'  => '9999',
				'height' => '400',
				'mode'   => 'resize'
			),
			'timeline' => array(
				'width'  => '700',
				'height' => '280',
				'mode'   => 'resize'
			),
		);

		add_option( 'shootback_image_sizes', $defaults );
	}

	// Register  section
	add_settings_section(
		'image_sizes_section',
		__( 'Image sizes', 'shootback' ),
		'shootback_image_sizes_callback',
		'shootback_image_sizes'
	);

	add_settings_field(
		'grid',
		__( 'Grid view', 'shootback' ),
		'toggle_image_sizes_grid_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'thumbnails',
		__( 'Thumbnails view', 'shootback' ),
		'toggle_image_sizes_thumbnails_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'bigpost',
		__( 'Big post view', 'shootback' ),
		'toggle_image_sizes_bigpost_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'superpost',
		__( 'Super post view', 'shootback' ),
		'toggle_image_sizes_superpost_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'single',
		__( 'Single view', 'shootback' ),
		'toggle_image_sizes_single_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'portfolio',
		__( 'Portfolio view', 'shootback' ),
		'toggle_image_sizes_portfolio_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'portfolio',
		__( 'Featured area view', 'shootback' ),
		'toggle_image_sizes_featarea_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'slider',
		__( 'Slider image size', 'shootback' ),
		'toggle_image_sizes_slider_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'carousel',
		__( 'Carousel image size', 'shootback' ),
		'toggle_image_sizes_carousel_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	add_settings_field(
		'timeline',
		__( 'Timeline post view', 'shootback' ),
		'toggle_image_sizes_timeline_callback',
		'shootback_image_sizes',
		'image_sizes_section'
	);

	register_setting( 'shootback_image_sizes', 'shootback_image_sizes');
}

add_action( 'admin_init', 'shootback_initialize_image_sizes_options' );


function shootback_image_sizes_callback() {
	echo '<p>'.__( 'In this tab you can choose the dimensions for the images that are used on your website. Caution - these are not the sizes that will be shown on the website as the website is adaptive, but it is the size of the images that will be used. We strongly recommend to use given settings and not to fiddle with any as long as you are not sure what you are doing.', 'shootback' ).'</p>';
}

function toggle_image_sizes_grid_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['grid'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[grid][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[grid][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[grid][mode]" id="img-sizes-grid-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-grid-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[grid][mode]" id="img-sizes-grid-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-grid-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_thumbnails_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['thumbnails'];


	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[thumbnails][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[thumbnails][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<input type="hidden" name="shootback_image_sizes[thumbnails][mode]" value="crop"><br/><br/>
			<em>'.__('Images for thumbnails view are cropped', 'shootback').'</em>';

	echo $html;
}

function toggle_image_sizes_bigpost_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['bigpost'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[bigpost][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[bigpost][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[bigpost][mode]" id="img-sizes-bigpost-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-bigpost-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[bigpost][mode]" id="img-sizes-bigpost-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-bigpost-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_superpost_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['superpost'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[superpost][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[superpost][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[superpost][mode]" id="img-sizes-superpost-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-superpost-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[superpost][mode]" id="img-sizes-superpost-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-superpost-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_single_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['single'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[single][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[single][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[single][mode]" id="img-sizes-single-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-single-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[single][mode]" id="img-sizes-single-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-single-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_timeline_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['timeline'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[timeline][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[timeline][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[timeline][mode]" id="img-sizes-timeline-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-timeline-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[timeline][mode]" id="img-sizes-timeline-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-timeline-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_portfolio_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['portfolio'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[portfolio][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[portfolio][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[portfolio][mode]" id="img-sizes-portfolio-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-portfolio-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[portfolio][mode]" id="img-sizes-portfolio-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-portfolio-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_featarea_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['featarea'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[featarea][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[featarea][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[featarea][mode]" id="img-sizes-featarea-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-featarea-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[featarea][mode]" id="img-sizes-featarea-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-featarea-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_slider_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['slider'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[slider][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[slider][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[slider][mode]" id="img-sizes-slider-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-slider-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[slider][mode]" id="img-sizes-slider-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-slider-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function toggle_image_sizes_carousel_callback($args) {

	$options = get_option( 'shootback_image_sizes' );
	$options = @$options['carousel'];

	$html = '<p>'.__('Width', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[carousel][width]" value="'.esc_attr(@$options['width']).'">
			<p>'.__('Height', 'shootback').' (px)</p>
			<input type="text" name="shootback_image_sizes[carousel][height]" value="'.esc_attr(@$options['height']).'"><br/><br/>
			<p>
				<input type="radio" name="shootback_image_sizes[carousel][mode]" id="img-sizes-carousel-crop" '. checked( @$options['mode'], 'crop', false).' value="crop" />
				<label for="img-sizes-carousel-crop">'.__('Crop', 'shootback').' </label><br/>
				<input type="radio" name="shootback_image_sizes[carousel][mode]" id="img-sizes-carousel-resize" '. checked( @$options['mode'], 'resize', false ).' value="resize" />
				<label for="img-sizes-carousel-resize">'.__('Resize', 'shootback').'</label>
			</p>';

	echo $html;
}

function shootback_initialize_layout_options() {

	if( false === get_option( 'shootback_layout' ) ) {

		add_option( 'shootback_layout', array() );

		$data = array();

		$layouts = array(
			'single_layout',
			'page_layout',
			'blog_layout',
			'category_layout',
			'author_layout',
			'search_layout',
			'archive_layout',
			'tags_layout',
			'product_layout',
			'show_layout',
			'product_layout'
		);

		$default_style = array(
			'sidebar' => array(
				'position' => 'none',
				'size'     => '1-3',
				'id'       => '0'
			),
			'display-mode'    => 'big-post',
			'grid' => array(
				'enable-carousel' => 'n',
				'display-title'   => 'title-below-image',
				'show-meta'       => 'y',
				'elements-per-row'=> '3',
				'special-effects' => 'none'
			),
			'list' => array(
				'display-title'   => 'title-below-image',
				'show-meta'       => 'y',
				'image-split'     => '1-2',
				'special-effects' => 'none'
			),
			'thumbnails' => array(
				'enable-carousel' => 'n',
				'elements-per-row'=> '3',
				'special-effects' => 'none',
				'gutter'		  => 'n'
			),
			'big-post' => array(
				'display-title'   => 'title-below-image',
				'show-meta'       => 'y',
				'image-split'     => '1-2',
				'related-posts'   => 'n',
				'special-effects' => 'none'
			),
			'super-post' => array(
				'elements-per-row'=> '3',
				'special-effects' => 'none'
			)
		);

		foreach ($layouts as $layout_id => $layout) {
			if ($layout_id === 'single_layout' || $layout_id === 'page_layout' || $layout_id == 'product_layout') {
				$data[$layout] = $default_style['sidebar'];
			}

			$data[$layout] = $default_style;
		}

		update_option( 'shootback_layout', $data );

	} // end if

	// Register  section
	add_settings_section(
		'layout_settings_section',
		__( 'Default layout settings', 'shootback' ),
		'shootback_layout_category_callback',
		'shootback_layout'
	);

	add_settings_field(
		'single_layout',
		__( 'Single', 'shootback' ),
		'toggle_single_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	add_settings_field(
		'page_layout',
		__( 'Page', 'shootback' ),
		'toggle_page_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	add_settings_field(
		'blog_layout',
		__( 'Blog page', 'shootback' ),
		'toggle_blog_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'woocommerce/woocommerce.php' ) ){

      	add_settings_field(
			'product_layout',
			__( 'Product', 'shootback' ),
			'toggle_product_layout_callback',
			'shootback_layout',
			'layout_settings_section'
		);

      	add_settings_field(
			'shop_layout',
			__( 'Shop page', 'shootback' ),
			'toggle_shop_layout_callback',
			'shootback_layout',
			'layout_settings_section'
		);
	}

	add_settings_field(
		'category_layout',
		__( 'Category', 'shootback' ),
		'toggle_category_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);
	add_settings_field(
		'author_layout',
		__( 'Author', 'shootback' ),
		'toggle_author_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	add_settings_field(
		'search_layout',
		__( 'Search', 'shootback' ),
		'toggle_search_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	add_settings_field(
		'archive_layout',
		__( 'Archive', 'shootback' ),
		'toggle_archive_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	add_settings_field(
		'tags_layout',
		__( 'Tags', 'shootback' ),
		'toggle_tags_layout_callback',
		'shootback_layout',
		'layout_settings_section'
	);

	register_setting( 'shootback_layout', 'shootback_layout');
}

add_action( 'admin_init', 'shootback_initialize_layout_options' );

function shootback_layout_category_callback() {
	echo '<p>'.__( 'This is the default layouts settings area. Here you can set the defaults for your website. Default sidebar settings and the way articles are going to be shown on archive pages.', 'shootback' ).'</p>';
}

function toggle_single_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('single_layout', $options);
	$html.= '</td></tr></table>';

	echo $html;
}

function toggle_product_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('product_layout', $options);
	$html.= '</td></tr></table>';

	echo $html;
}

function toggle_shop_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('shop_layout', $options);
	$html.= '</td></tr></table>';

	echo $html;
}

function toggle_page_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('page_layout', $options);
	$html.= '</td></tr></table>';

	echo $html;
}

function toggle_category_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('category_layout', $options);
	$html.= '</td></tr><tr><td>'.shootback_layout_style_generator('category_layout', $options).'</td></tr></table>';

	echo $html;
}

function toggle_blog_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('blog_layout', $options);
	$html.= '</td></tr><tr><td>'.shootback_layout_style_generator('blog_layout', $options).'</td></tr></table>';

	echo $html;
}

function toggle_author_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('author_layout', $options);
	$html.= '</td></tr><tr><td>'.shootback_layout_style_generator('author_layout', $options).'</td></tr></table>';

	echo $html;
}

function toggle_search_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('search_layout', $options);
	$html.= '</td></tr><tr><td>'.shootback_layout_style_generator('search_layout', $options).'</td></tr></table>';

	echo $html;
}

function toggle_archive_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('archive_layout', $options);
	$html.= '</td></tr><tr><td>'.shootback_layout_style_generator('archive_layout', $options).'</td></tr></table>';

	echo $html;
}

function toggle_tags_layout_callback($args)
{
	$options = get_option('shootback_layout');

	$html = '<table><tr><td><strong>' . __( 'Sidebar position', 'shootback' ) . '</strong>';
	$html.= shootback_sidebar_settings_generator('tags_layout', $options);
	$html.= '</td></tr><tr><td>'.shootback_layout_style_generator('tags_layout', $options).'</td></tr></table>';

	echo $html;
}

function shootback_sidebar_settings_generator($section = 'category_layout', $options = array()) {

	$html = '<select name="shootback_layout['.$section.'][sidebar][position]">
				<option value="none" '. selected( @$options[$section]['sidebar']['position'], 'none', 0 ).'>None</option>
				<option value="left" '. selected( @$options[$section]['sidebar']['position'], 'left', 0 ).'>Left</option>
				<option value="right" '. selected( @$options[$section]['sidebar']['position'], 'right', 0 ).'>Right</option>
			</select>';

	$html .= '<strong>' . __( 'Sidebar size', 'shootback' ).'</strong>';
	$html .= '<select name="shootback_layout['.$section.'][sidebar][size]">
				<option value="1-3" '. selected( @$options[$section]['sidebar']['size'], '1-3', 0 ).'>1/3</option>
				<option value="1-4" '. selected( @$options[$section]['sidebar']['size'], '1-4', 0 ).'>1/4</option>
			</select>';

	$html .= '<strong>' . __( 'Sidebar name', 'shootback' ).'</strong>';
	$html .= ts_sidebars_drop_down(@$options[$section]['sidebar']['id'], $section.'_sidebar', 'shootback_layout['.$section.'][sidebar][id]');

	return $html;
}

function shootback_layout_style_generator($section = 'category_layout', $options = array()) {

	$show_grid = (@$options[$section]['display-mode'] === 'grid') ? '' : 'hidden';
	$show_list = (@$options[$section]['display-mode'] === 'list') ? '' : 'hidden';
	$show_thumbnails = (@$options[$section]['display-mode'] === 'thumbnails') ? '' : 'hidden';
	$show_big_post = (@$options[$section]['display-mode'] === 'big-post') ? '' : 'hidden';
	$show_super_post = (@$options[$section]['display-mode'] === 'super-post') ? '' : 'hidden';

	switch ($section) {
		case 'category_layout':
			$prefix = 'category';
			break;

		case 'blog_layout':
			$prefix = 'blog';
			break;

		case 'author_layout':
			$prefix = 'author';
			break;

		case 'search_layout':
			$prefix = 'search';
			break;

		case 'archive_layout':
			$prefix = 'archive';
			break;

		case 'tags_layout':
			$prefix = 'tags';
			break;

		default:
			$prefix = '';
			break;
	}
	return '<span class="icon-resize-vertical display-layout-options">Show view options <em>(click to toggle)</em></span><div class="builder-elements layout-settings-fields hidden">
                <!-- Display mode -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="'.$prefix.'-last-posts-display-mode">'.__( 'How to display', 'shootback' ) . ':</label>
                        </td>
                        <td>
                            <select name="shootback_layout['.$section.'][display-mode]" class="'.$prefix.'-last-posts-display-mode">
                                <option value="grid" '. selected( @$options[$section]['display-mode'], 'grid', 0 ).'>'.__( 'Grid', 'shootback' ) .'</option>
                                <option value="list" ' . selected( @$options[$section]['display-mode'], 'list', 0 ).'>'.__( 'List', 'shootback' ) .'</option>
                                <option value="thumbnails" ' . selected( @$options[$section]['display-mode'], 'thumbnails', 0 ).'>'.__( 'Thumbnails', 'shootback' ) .'</option>
                                <option value="big-post" ' . selected( @$options[$section]['display-mode'], 'big-post', 0 ) . '>'.__( 'Big post', 'shootback' ) .'</option>
                                <option value="super-post" ' . selected( @$options[$section]['display-mode'], 'super-post', 0 ) . '>'.__( 'Super Post', 'shootback' ) .'</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="'.$prefix.'-last-posts-display-mode-options">
                    <!-- Grid options -->
                    <div class="last-posts-grid '.$show_grid.'">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-grid-title">'.__( 'Title', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <select name="shootback_layout['.$section.'][grid][display-title]" id="'.$section.'-last-posts-grid-title">
                                        <option value="title-above-image" ' . selected( @$options[$section]['grid']['display-title'], 'title-above-image', 0 ) . '>'.__( 'Above image', 'shootback' ).'</option>
                                        <option value="title-below-image" ' . selected( @$options[$section]['grid']['display-title'], 'title-below-image', 0 ) . '>'.__( 'Above excerpt', 'shootback' ).'</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-grid-show-meta">'.__( 'Show meta', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <input type="radio" name="shootback_layout['.$section.'][grid][show-meta]" id="'.$section.'-last-posts-grid-show-meta-y"  value="y" '.checked( @$options[$section]['grid']['show-meta'], 'y', 0 ).' />
                                    <label for="'.$section.'-last-posts-grid-show-meta-y">'.__( 'Yes', 'shootback' ).'</label>
                                    <input type="radio" name="shootback_layout['.$section.'][grid][show-meta]" id="'.$section.'-last-posts-grid-show-meta-n" value="n" '.checked( @$options[$section]['grid']['show-meta'], 'n', 0 ).'/>
                                    <label for="'.$section.'-last-posts-grid-show-meta-n">'.__( 'No', 'shootback' ).'</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-grid-el-per-row">'.__( 'Elements per row', 'shootback' ).'</label>
                                </td>
                                <td>
                                    <select name="shootback_layout['.$section.'][grid][elements-per-row]" id="'.$section.'-last-posts-grid-el-per-row">
                                        <option value="1" ' . selected( @$options[$section]['grid']['elements-per-row'], '1', 0 ) . '>1</option>
                                        <option value="2" ' . selected( @$options[$section]['grid']['elements-per-row'], '2', 0 ) . '>2</option>
                                        <option value="3" ' . selected( @$options[$section]['grid']['elements-per-row'], '3', 0 ) . '>3</option>
                                        <option value="4" ' . selected( @$options[$section]['grid']['elements-per-row'], '4', 0 ) . '>4</option>
                                        <option value="6" ' . selected( @$options[$section]['grid']['elements-per-row'], '6', 0 ) . '>6</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- List options -->
                    <div class="last-posts-list '.$show_list.'">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-list-title">'.__( 'Title:', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <select name="shootback_layout['.$section.'][list][display-title]" id="'.$section.'-last-posts-list-title">
                                        <option value="title-above-image" '. selected( @$options[$section]['list']['display-title'], 'title-above-image', 0 ) .'>'.__( 'Above image', 'shootback' ).'</option>
                                        <option value="title-below-image" '. selected( @$options[$section]['list']['display-title'], 'title-below-image', 0 ) .'>'.__( 'Above excerpt', 'shootback' ).'</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-list-show-meta">'.__( 'Show meta', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <input type="radio" name="shootback_layout['.$section.'][list][show-meta]" id="'.$section.'-last-posts-list-show-meta-y"  value="y" '.checked( @$options[$section]['list']['show-meta'], 'y', 0 ).'  />
                                    <label for="'.$section.'-last-posts-list-show-meta-y">'.__( 'Yes', 'shootback' ).'</label>
                                    <input type="radio" name="shootback_layout['.$section.'][list][show-meta]" id="'.$section.'-last-posts-list-show-meta-n" value="n" '.checked( @$options[$section]['list']['show-meta'], 'n', 0 ).'/>
                                    <label for="'.$section.'-last-posts-list-show-meta-n">'.__( 'No', 'shootback' ).'</label>
                                </td>
                            </tr>
                            <tr>
                                <td>'.__( 'Content split', 'shootback' ).'</td>
                                <td>
                                    <select name="shootback_layout['.$section.'][list][image-split]" id="'.$section.'-last-posts-list-image-split">
                                        <option value="1-3" '. selected( @$options[$section]['list']['image-split'], '1-3', 0 ) .'>1/3</option>
                                        <option value="1-2" '. selected( @$options[$section]['list']['image-split'], '1-2', 0 ) .'>1/2</option>
                                        <option value="3-4" '. selected( @$options[$section]['list']['image-split'], '3-4', 0 ) .'>3/4</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Thumbnail options -->
                    <div class="last-posts-thumbnails '.$show_thumbnails.'">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-thumbnail-posts-per-row">'.__( 'Number of posts per row', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <select name="shootback_layout['.$section.'][thumbnails][elements-per-row]" id="'.$section.'-last-posts-thumbnail-posts-per-row">
                                        <option value="1" ' . selected( @$options[$section]['thumbnails']['elements-per-row'], '1', 0 ) .'>1</option>
                                        <option value="2" ' . selected( @$options[$section]['thumbnails']['elements-per-row'], '2', 0 ) .'>2</option>
                                        <option value="3" ' . selected( @$options[$section]['thumbnails']['elements-per-row'], '3', 0 ) .'>3</option>
                                        <option value="4" ' . selected( @$options[$section]['thumbnails']['elements-per-row'], '4', 0 ) .'>4</option>
                                        <option value="6" ' . selected( @$options[$section]['thumbnails']['elements-per-row'], '6', 0 ) .'>6</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="last-posts-big-post '.$show_big_post.'">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-big-post-title">'.__( 'Title', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <select name="shootback_layout['.$section.'][big-post][display-title]" id="'.$section.'-last-posts-big-post-title">
                                        <option value="title-above-image" ' . selected( @$options[$section]['big-post']['display-title'], 'title-above-image', 0 ) .'>'.__( 'Above image', 'shootback' ).'</option>
                                        <option value="title-below-image" ' . selected( @$options[$section]['big-post']['display-title'], 'title-below-image', 0 ) .'>'.__( 'Above excerpt', 'shootback' ).'</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-big-post-show-meta">'.__( 'Show meta', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <input type="radio" name="shootback_layout['.$section.'][big-post][show-meta]" id="'.$section.'-last-posts-big-post-show-meta-y"  value="y" '.checked( @$options[$section]['big-post']['show-meta'], 'y', 0 ).'   />
                                    <label for="'.$section.'-last-posts-big-post-show-meta-y">'.__( 'Yes', 'shootback' ).'</label>

                                    <input type="radio" name="shootback_layout['.$section.'][big-post][show-meta]" id="'.$section.'-last-posts-big-post-show-meta-n" value="n" '.checked( @$options[$section]['big-post']['show-meta'], 'n', 0 ).' />
                                    <label for="'.$section.'-last-posts-big-post-show-meta-n">'.__( 'No', 'shootback' ).'</label>
                                </td>
                            </tr>
                            <tr>
                                <td>'.__( 'Content split', 'shootback' ).'</td>
                                <td>
                                    <select name="shootback_layout['.$section.'][big-post][image-split]" id="'.$section.'-last-posts-big-post-image-split">
                                        <option value="1-3" ' . selected( @$options[$section]['big-post']['image-split'], '1-3', 0 ) .'>1/3</option>
                                        <option value="1-2" ' . selected( @$options[$section]['big-post']['image-split'], '1-2', 0 ) .'>1/2</option>
                                        <option value="3-4" ' . selected( @$options[$section]['big-post']['image-split'], '3-4', 0 ) .'>3/4</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="last-posts-super-post '.$show_super_post.'">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="'.$section.'-last-posts-super-post-posts-per-row">'.__( 'Number of posts per row', 'shootback' ).':</label>
                                </td>
                                <td>
                                    <select name="shootback_layout['.$section.'][super-post][elements-per-row]" id="'.$section.'-last-posts-super-post-posts-per-row">
                                        <option value="1" ' . selected( @$options[$section]['super-post']['elements-per-row'], '1', 0 ) .'>1</option>
                                        <option value="2" ' . selected( @$options[$section]['super-post']['elements-per-row'], '2', 0 ) .'>2</option>
                                        <option value="3" ' . selected( @$options[$section]['super-post']['elements-per-row'], '3', 0 ) .'>3</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
        </div>';
}

/**
 * Iniaitalize the theme options page by registering the Fields, Sections, Settings
 */

function shootback_initialize_styles_options()
{
	//delete_option('shootback_styles');
	if( false === get_option( 'shootback_styles' ) ) {

		$defaultStyles = array(
			'boxed_layout' => 'N',
			'image_hover_effect' => 'Y',
			'theme_custom_bg' => 'color',
			'theme_bg_pattern' => '',
			'theme_bg_color' => '#F6F6F6',
			'bg_image' => '',
			'overlay_effect_for_images' => 'N',
			'overlay_effect_type' => 'dots',
			'sharing_overlay' => 'Y',
			'facebook_image' => '',
			'scroll_to_top' => 'y',
			'box_shadow' => 'n',
			'style_hover' => 'style1',
			'hover_gallery' => 'open-on-click',
			'header_position' => 'top',
			'logo' => array(
				'type' => 'image',
				'image_url' => '',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '32',
				'font_weight' => 'normal',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Aclonica',
				'retina_logo' => 'Y',
				'retina_width' => '450',
				'retina_height' => '121',
			),
		);

		if( !function_exists( 'has_site_icon' ) || !has_site_icon() ){
			$defaultStyles['favicon'] = '';
		}

		add_option( 'shootback_styles', $defaultStyles);


	} // end if

	// Register styles section
	add_settings_section(
		'style_settings_section',
		__( 'Styles Options', 'shootback' ),
		'shootback_styles_callback',
		'shootback_styles'
	);

	add_settings_field(
		'boxed_layout',
		__( 'Boxed Layout', 'shootback' ),
		'toggle_boxed_layout_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'If enabled it will add white background to content and limit it to the site that is set in general settings.', 'shootback' )
		)
	);

	add_settings_field(
		'theme_custom_bg',
		__( 'Theme background customization', 'shootback' ),
		'toggle_theme_custom_bg_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'Background options for your website. You can set image background, background color or pattern.', 'shootback' )
		)
	);

	if( !function_exists( 'has_site_icon' ) || !has_site_icon() ){
		add_settings_field(
			'favicon',
			__( 'Custom favicon', 'shootback' ),
			'toggle_favicon_callback',
			'shootback_styles',
			'style_settings_section',
			array(
				'Upload your own favicon for your website.'
			)
		);
	}

	add_settings_field(
		'facebook_image',
		__( 'Facebook image', 'shootback' ),
		'toggle_facebook_image_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			'Upload your own facebook image for your website.'
		)
	);

	add_settings_field(
		'overlay_effect_for_images',
		__( 'Enable overlay stripes/dots effect for images', 'shootback' ),
		'toggle_overlay_effect_for_images_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'If enabled, it will add subtle effect over images in archive pages and single featured images.', 'shootback' )
		)
	);

	add_settings_field(
		'sharing_overlay',
		__( 'Enable sharing overlay buttons in views', 'shootback' ),
		'toggle_sharing_overlay_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'If enabled, it will show sharing buttons on mouse over in post views.', 'shootback' )
		)
	);

	add_settings_field(
		'logo_type',
		__( 'Logo type', 'shootback' ),
		'toggle_logo_type_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'Choose which type of logo do you want to use. If text, select the font and the styles you need. If you want to use custom image logo use the uploader provided.', 'shootback' )
		)
	);

	add_settings_field(
		'scroll_to_top',
		__( 'Enable scroll to top button', 'shootback' ),
		'toggle_scroll_to_top_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'Enable scroll to top button', 'shootback' )
		)
	);

	add_settings_field(
		'box_shadow',
		__( 'Add box shadow to view boxes', 'shootback' ),
		'toggle_box_shadow_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'You can add box shadows to the boxes.', 'shootback' )
		)
	);

	add_settings_field(
		'style_hover',
		__( 'Change style for hover', 'shootback' ),
		'toggle_style_hover_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'Change the hover styling', 'shootback' )
		)
	);

	add_settings_field(
		'hover_gallery',
		__( 'Change style for hover image gallery', 'shootback' ),
		'toggle_hover_gallery_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'Change the hover styling for gallery images', 'shootback' )
		)
	);

	add_settings_field(
		'header_position',
		__( 'Choose header position', 'shootback' ),
		'toggle_header_position_callback',
		'shootback_styles',
		'style_settings_section',
		array(
			__( 'Left, top or right', 'shootback' )
		)
	);

	register_setting( 'shootback_styles', 'shootback_styles');

} // end shootback_initialize_theme_options


add_action( 'admin_init', 'shootback_initialize_styles_options' );

/**************************************************
 * Styles Section Callbacks
 *************************************************/

function shootback_styles_callback()
{
	echo '<p>'.__( 'Settings for your website styling. Here you can change colors, effects, logo type, custom favicon, background.', 'shootback' ).'</p>';
?>

<?php
} // end shootback_styles_callback

function toggle_boxed_layout_callback($args)
{
	$options = get_option('shootback_styles');

	$html = '<select name="shootback_styles[boxed_layout]">
					<option value="Y" '. selected( @$options["boxed_layout"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["boxed_layout"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}

function toggle_image_hover_effect_callback($args)
{
	$options = get_option('shootback_styles');

	$html = '<select name="shootback_styles[image_hover_effect]">
					<option value="Y" '. selected( @$options["image_hover_effect"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["image_hover_effect"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}


function toggle_sharing_overlay_callback($args)
{
	$options = get_option('shootback_styles');

	$html = '<select name="shootback_styles[sharing_overlay]">
					<option value="Y" '. selected( @$options["sharing_overlay"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["sharing_overlay"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';
	echo $html;
}


function toggle_theme_custom_bg_callback($args)
{
	$options = get_option('shootback_styles');

	$html = '<select name="shootback_styles[theme_custom_bg]" id="custom-bg-options">
					<option value="pattern" '. selected( @$options["theme_custom_bg"], 'pattern', false ).'>'.__( 'Pattern', 'shootback' ).'</option>
					<option value="color" '. selected( @$options["theme_custom_bg"], 'color', false ).'>'.__( 'Color', 'shootback' ).'</option>
					<option value="image" '. selected( @$options["theme_custom_bg"], 'image', false ).'>'.__( 'Image', 'shootback' ).'</option>
					<option value="N" '. selected( @$options["theme_custom_bg"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
				</select>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	if ( trim(@$options["theme_bg_pattern"]) !== "" ) {
		$bg_pattern_url = 'background: url(' . get_template_directory_uri(). '/images/patterns/' . $options["theme_bg_pattern"] . ')';
	} else {
		$bg_pattern_url = '';
	}

	$html .= '<div id="ts-patterns-option" class="ts-custom-bg">
				<p>'.__( 'Please select pattern by clicking on image', 'shootback' ).'</p>

				<a class="thickbox" title="'.__( 'Click on pattern, then click OK button', 'shootback' ).'" href="'.admin_url('admin.php?page=shootback&tab=load_patterns&height=480&width=960') . '">
					<div style="width:100px; height:100px; ' . $bg_pattern_url . '" id="pattern-demo">&nbsp;</div>
				</a>

				<input type="hidden" name="shootback_styles[theme_bg_pattern]" value="' . esc_attr(@$options["theme_bg_pattern"]).'" id="shootback-bg-pattern"/>
	</div>';

	$html .= '<div id="ts-bg-color" class="ts-custom-bg"><p>Background color:</p>';

	$color = isset($options["theme_bg_color"]) ? $options["theme_bg_color"] : '#FFFFFF';

	$html .= '<input type="text" id="theme-bg-color" class="popup-colorpicker" name="shootback_styles[theme_bg_color]" value="' . $color . '"/><div id="ts-theme-bg-picker"></div>
	</div>
	';

	$html .= '<div id="ts-bg-image" class="ts-custom-bg">';
	$html .= '<p>'.__( 'Upload background image:', 'shootback' ).'</p>';
	$html .= '<input type="text" name="shootback_styles[bg_image]" class="image_url" value="'.esc_url(@$options['bg_image']).'"/>
			<input type="hidden" value="" class="image_media_id"/>
			<input id="ts-upload-bg-image" type="button" name="ts-upload-fb-image" class="button-primary shootback_select_image" value="'.__('Upload', 'shootback').'">';
	$html .= '</div>';

	echo $html;
}

function toggle_favicon_callback($args)
{
	$options = get_option('shootback_styles');

	$favicon = esc_url(@$options["favicon"]);

	$html = '<div>
					<input type="text" name="shootback_styles[favicon]" class="image_url" value="'.$favicon.'">
					<input id="ts-upload-favicon" type="button" name="ts-upload-favicon" class="button-primary shootback_select_image" value="'.__('Upload', 'shootback').'">
					<input type="hidden" value="" class="image_media_id" />';
	$html.= '<p class="description">' .$args[0]. '</p>
				</div>';

	echo $html;
}

function toggle_facebook_image_callback($args)
{
	$options = get_option('shootback_styles');

	$facebook_image = esc_url(@$options["facebook_image"]);

	$html = '<div>
					<input type="text" name="shootback_styles[facebook_image]" class="image_url" value="'.$facebook_image.'">
					<input id="ts-upload-facebook-image" type="button" name="ts-upload-facebook_image" class="button-primary shootback_select_image" value="'.__('Upload', 'shootback').'">
					<input type="hidden" value="" class="image_media_id" />';
	$html.= '<p class="description">' .$args[0]. '</p>
				</div>';

	echo $html;
}

function toggle_overlay_effect_for_images_callback($args)
{
	$options = get_option('shootback_styles');

	$html = '<select name="shootback_styles[overlay_effect_for_images]" id="overlay-effect-for-images">
				<option value="Y" '. selected( @$options["overlay_effect_for_images"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["overlay_effect_for_images"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';

	$html .= '<p class="description">' .$args[0]. '</p>
				<div id="overlay-effects">
				<label for="stripes_effect">
				<input type="radio" id="stripes_effect" name="shootback_styles[overlay_effect_type]" value="stripes"' . checked( @$options["overlay_effect_type"], 'stripes', false ) .'/>'.__( 'stripes', 'shootback' ) . '</label>
				<label for="dotts_effect">
				<input type="radio" id="dotts_effect" name="shootback_styles[overlay_effect_type]" value="dots" ' . checked( @$options["overlay_effect_type"], 'dots', false ) . ' />'.__( 'dots', 'shootback' ) .'</label>
				</div>';

	echo $html;
}

function toggle_scroll_to_top_callback($args)
{
	$options = get_option('shootback_styles');
	$scroll_to_top = (isset($options['scroll_to_top']) && ($options['scroll_to_top'] == 'y' || $options['scroll_to_top'] == 'n')) ? $options['scroll_to_top'] : 'y';

	$html = '<select name="shootback_styles[scroll_to_top]">
				<option value="y" ' . selected($scroll_to_top, 'y', false) . '>' . __( 'Yes', 'shootback' ) . '</option>
				<option value="n" ' . selected($scroll_to_top, 'n', false) . '>' . __( 'No', 'shootback' ) . '</option>
			</select>';

	echo $html;
}

function toggle_box_shadow_callback($args)
{
	$options = get_option('shootback_styles');
	$box_shadow = (isset($options['box_shadow']) && ($options['box_shadow'] == 'y' || $options['box_shadow'] == 'n')) ? $options['box_shadow'] : 'n';

	$html = '<select name="shootback_styles[box_shadow]">
				<option value="y" ' . selected($box_shadow, 'y', false) . '>' . __( 'Yes', 'shootback' ) . '</option>
				<option value="n" ' . selected($box_shadow, 'n', false) . '>' . __( 'No', 'shootback' ) . '</option>
			</select>';

	echo $html;
}

function toggle_style_hover_callback($args)
{
	$options = get_option('shootback_styles');
	$style_hover = (isset($options['style_hover']) && ($options['style_hover'] == 'style1' || $options['style_hover'] == 'style2')) ? $options['style_hover'] : 'style1';

	$html = '<select name="shootback_styles[style_hover]">
				<option value="style1" ' . selected($style_hover, 'style1', false) . '>' . __( 'Style 1', 'shootback' ) . '</option>
				<option value="style2" ' . selected($style_hover, 'style2', false) . '>' . __( 'Style 2', 'shootback' ) . '</option>
			</select>';

	echo $html;
}

function toggle_hover_gallery_callback($args)
{
	$options = get_option('shootback_styles');
	$hover_gallery = (isset($options['hover_gallery']) && ($options['hover_gallery'] == 'open-on-click' || $options['hover_gallery'] == 'slide-from-bottom')) ? $options['hover_gallery'] : 'open-on-click';

	$html = '<select name="shootback_styles[hover_gallery]">
				<option value="open-on-click" ' . selected($hover_gallery, 'open-on-click', false) . '>' . __( 'Open on click', 'shootback' ) . '</option>
				<option value="slide-from-bottom" ' . selected($hover_gallery, 'slide-from-bottom', false) . '>' . __( 'Slide on bottom', 'shootback' ) . '</option>
			</select>';

	echo $html;
}

function toggle_header_position_callback($args)
{
	$options = get_option('shootback_styles');
	$header_position = (isset($options['header_position']) && ($options['header_position'] == 'right' || $options['header_position'] == 'left' || $options['header_position'] == 'top')) ? $options['header_position'] : 'top';

	$html = '<select name="shootback_styles[header_position]">
				<option value="right" ' . selected($header_position, 'right', false) . '>' . __( 'Right', 'shootback' ) . '</option>
				<option value="top" ' . selected($header_position, 'top', false) . '>' . __( 'Top', 'shootback' ) . '</option>
				<option value="left" ' . selected($header_position, 'left', false) . '>' . __( 'Left', 'shootback' ) . '</option>
			</select>';

	echo $html;
}

function toggle_logo_type_callback($args)
{
	$options = array(
        'type' => array(
            'image'          => __('Logo image', 'shootback'),
            'google'       => __('Logo text', 'shootback')
        ),
        'font_weight'  => '',
        'font_size'    => '',
        'font_style'   => '',
        'text'         => '',
        'font_subsets' => ''
    );
	tsAddTypographyElement('', 'shootback_styles', 'logo', $options);
}

/**
 * Iniaitalize the theme options colors section by registering the Fields, Sections, Settings
 */
function shootback_initialize_colors_options()
{

	if( false === get_option( 'shootback_colors' ) ) {

		add_option( 'shootback_colors', array(
			'general_text_color' => '#3f4549',
			'link_color' => '#DA192C',
			'link_color_hover' => '#bb1525',
			'view_link_color' => '#434A54',
			'view_link_color_hover' => '#DA192C',
			'meta_color' => '#a7a7a7',
			'primary_color' => '#DA192C',
			'primary_color_hover' => '#bb1525',
			'secondary_color' => '#000000',
			'secondary_color_hover' => '#24272c',
			'primary_text_color' => '#FFFFFF',
			'primary_text_color_hover' => '#f5f6f7',
			'secondary_text_color' => '#FFFFFF',
			'secondary_text_color_hover' => '#eef4f7',
			'submenu_bg_color' => '#FDFDFD',
			'submenu_text_color' => '#343434',
			'submenu_bg_color_hover' => '#FFFFFF',
			'submenu_text_color_hover' => '#DA192C',
			'view_background_color' => '#FFFFFF',
			'view_text_color' => '#000000',
			'excerpt_color' => '#a7a7a7'
		));

	} // end if

	// Register styles section
	add_settings_section(
		'color_settings_section',
		__( 'Theme color options', 'shootback' ),
		'shootback_colors_callback',
		'shootback_colors'
	);



	add_settings_field(
		'general_text_color',
		__( 'General color for the text on the website', 'shootback' ),
		'toggle_shootback_general_text_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Change this to any color you want and that fits the background of the website.', 'shootback' )
		)
	);

	add_settings_field(
		'general_text_color',
		__( 'General color for the text on the website', 'shootback' ),
		'toggle_shootback_general_text_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Change this to any color you want and that fits the background of the website.', 'shootback' )
		)
	);

	add_settings_field(
		'link_color',
		__( 'Link color', 'shootback' ),
		'toggle_shootback_link_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Change this color if you want the links on your website to have a different color.', 'shootback' )
		)
	);
	add_settings_field(
		'link_color_hover',
		__( 'Link color on hover', 'shootback' ),
		'toggle_shootback_link_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Change this color if you want the links on hover to have a different color.', 'shootback' )
		)
	);
	add_settings_field(
		'view_background_color',
		__( 'View background color', 'shootback' ),
		'toggle_view_background_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( '', 'shootback' )
		)
	);
	add_settings_field(
		'view_text_color',
		__( 'View text color', 'shootback' ),
		'toggle_view_text_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( '', 'shootback' )
		)
	);
	add_settings_field(
		'views_link_color',
		__( 'Link colors in views (grid/list/bigpost)', 'shootback' ),
		'toggle_shootback_view_link_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'You have different types to showcase your articles. This option will change the color of the links of the articles.', 'shootback' )
		)
	);
	add_settings_field(
		'views_link_color_hover',
		__( 'Title colors on hover in view', 'shootback' ),
		'toggle_shootback_view_link_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'You have different types to showcase your articles. This option will change the color on hover of the titles of the articles.', 'shootback' )
		)
	);
	add_settings_field(
		'meta_color',
		__( 'Meta text color', 'shootback' ),
		'toggle_shootback_meta_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Change the color of the text for your meta.', 'shootback' )
		)
	);
	add_settings_field(
		'primary_color',
		__( 'Primary color', 'shootback' ),
		'toggle_shootback_primary_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Main color of the website. It is used for backgrounds, borders of elements, etc. This defines your main brand/website color.', 'shootback' )
		)
	);
	add_settings_field(
		'primary_color_hover',
		__( 'Primary color on hover', 'shootback' ),
		'toggle_shootback_primary_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Main color of the website. It is used for backgrounds, borders of elements, etc. This defines your main brand/website color on hover.', 'shootback' )
		)
	);
	add_settings_field(
		'secondary_color',
		__( 'Secondary color', 'shootback' ),
		'toggle_shootback_secondary_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Secondary color of the website. It is used for backgrounds, borders of elements, etc. This defines your secondary or contrast brand/website color.', 'shootback' )
		)
	);
	add_settings_field(
		'secondary_color_hover',
		__( 'Secondary color on hover', 'shootback' ),
		'toggle_shootback_secondary_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Secondary color of the website. It is used for backgrounds, borders of elements, etc. This defines your secondary or contrast brand/website color on hover.', 'shootback' )
		)
	);
	add_settings_field(
		'primary_text_color',
		__( 'Primary text color', 'shootback' ),
		'toggle_shootback_primary_text_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The color of the text that has a primary color background. Primary color reffers to the color setting above.', 'shootback' )
		)
	);
	add_settings_field(
		'primary_text_color_hover',
		__( 'Primary text color on hover', 'shootback' ),
		'toggle_shootback_primary_text_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The color of the text that has a primary color background on hover. Primary color reffers to the color setting above.', 'shootback' )
		)
	);
	add_settings_field(
		'secondary_text_color',
		__( 'Secondary text color', 'shootback' ),
		'toggle_shootback_secondary_text_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The color of the text that has a secondary color background.', 'shootback' )
		)
	);
	add_settings_field(
		'secondary_text_color_hover',
		__( 'Secondary text color on hover', 'shootback' ),
		'toggle_shootback_secondary_text_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The color of the text that has a secondary color background on hover. Primary color reffers to the color setting above.', 'shootback' )
		)
	);
	add_settings_field(
		'menu_bg_color',
		__( 'Submenu background color', 'shootback' ),
		'toggle_shootback_submenu_bg_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'This is used for menus that have background colors. Not all menu styles can have backgrounds. Even so, this option will apply for submenu backgrounds as well, even for those that do not have a background by default', 'shootback' )
		)
	);
	add_settings_field(
		'menu_bg_color_hover',
		__( 'Submenu background color on hover', 'shootback' ),
		'toggle_shootback_submenu_bg_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'Same thing as the option above, only for the hover state.', 'shootback' )
		)
	);
	add_settings_field(
		'menu_text_color',
		__( 'Menu text color', 'shootback' ),
		'toggle_shootback_submenu_text_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The colors of the text in the menus and submenus.', 'shootback' )
		)
	);
	add_settings_field(
		'menu_text_color_hover',
		__( 'Menu text color on hover', 'shootback' ),
		'toggle_shootback_submenu_text_color_hover_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The colors of the text in the menus and submenus on hover.', 'shootback' )
		)
	);

	add_settings_field(
		'excerpt_color',
		__( 'Excerpt color', 'shootback' ),
		'toggle_excerpt_color_callback',
		'shootback_colors',
		'color_settings_section',
		array(
			__( 'The colors of the text in the menus and submenus on hover.', 'shootback' )
		)
	);

	register_setting( 'shootback_colors', 'shootback_colors');

} // end shootback_initialize_theme_options


add_action( 'admin_init', 'shootback_initialize_colors_options' );

/**************************************************
 * Colors Section Callbacks
 *************************************************/

function shootback_colors_callback()
{
	echo '<p>'.__( 'Settings for your website color settings. Here you can change colors that are shown on your website.', 'shootback' ).'</p>';
?>

<?php
} // end shootback_styles_callback

function toggle_shootback_general_text_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-general-text-color" class="colors-section-picker" name="shootback_colors[general_text_color]" value="'.esc_attr(@$options["general_text_color"]).'" /><div class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}


function toggle_shootback_link_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-link-color" class="colors-section-picker" name="shootback_colors[link_color]" value="'.esc_attr(@$options["link_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_link_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-link-hover-color" class="colors-section-picker" name="shootback_colors[link_color_hover]" value="'.esc_attr(@$options["link_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_view_background_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" class="colors-section-picker" name="shootback_colors[view_background_color]" value="' . esc_attr(@$options["view_background_color"]) . '" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_view_text_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" class="colors-section-picker" name="shootback_colors[view_text_color]" value="' . esc_attr(@$options["view_text_color"]) . '" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_shootback_view_link_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-view-link-color" class="colors-section-picker" name="shootback_colors[view_link_color]" value="'.esc_attr(@$options["view_link_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_view_link_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-view-link-hover-color" class="colors-section-picker" name="shootback_colors[view_link_color_hover]" value="'.esc_attr(@$options["view_link_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_meta_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-meta-text-color" class="colors-section-picker" name="shootback_colors[meta_color]" value="'.esc_attr(@$options["meta_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_primary_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-primary-color" class="colors-section-picker" name="shootback_colors[primary_color]" value="'.esc_attr(@$options["primary_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_primary_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-primary-color-hover" class="colors-section-picker" name="shootback_colors[primary_color_hover]" value="'.esc_attr(@$options["primary_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_secondary_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-secondary-color" class="colors-section-picker" name="shootback_colors[secondary_color]" value="'.esc_attr(@$options["secondary_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_secondary_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-secondary-color-hover" class="colors-section-picker" name="shootback_colors[secondary_color_hover]" value="'.esc_attr(@$options["secondary_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_shootback_primary_text_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-primary-text-color" class="colors-section-picker" name="shootback_colors[primary_text_color]" value="'.esc_attr(@$options["primary_text_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_primary_text_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-primary-text-color-hover" class="colors-section-picker" name="shootback_colors[primary_text_color_hover]" value="'.esc_attr(@$options["primary_text_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_secondary_text_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-secondary-text-color-hover" class="colors-section-picker" name="shootback_colors[secondary_text_color_hover]" value="'.esc_attr(@$options["secondary_text_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_secondary_text_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-secondary-text-color" class="colors-section-picker" name="shootback_colors[secondary_text_color]" value="'.esc_attr(@$options["secondary_text_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_submenu_bg_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-menu-bg-color" class="colors-section-picker" name="shootback_colors[submenu_bg_color]" value="'.esc_attr(@$options["submenu_bg_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_submenu_bg_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-menu-bg-hover-color" class="colors-section-picker" name="shootback_colors[submenu_bg_color_hover]" value="'.esc_attr(@$options["submenu_bg_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_submenu_text_color_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-menu-text-color" class="colors-section-picker" name="shootback_colors[submenu_text_color]" value="'.esc_attr(@$options["submenu_text_color"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}
function toggle_shootback_submenu_text_color_hover_callback($args)
{
	$options = get_option('shootback_colors');

	$html = '<input type="text" id="ts-menu-text-hover-color" class="colors-section-picker" name="shootback_colors[submenu_text_color_hover]" value="'.esc_attr(@$options["submenu_text_color_hover"]).'" /><div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_excerpt_color_callback($args)
{
	$options = get_option('shootback_colors');
	$excerptColor = (isset($options['excerpt_color']) && !empty($options['excerpt_color'])) ? esc_attr($options['excerpt_color']) : '#808080';
	$html = '<input type="text" class="colors-section-picker" name="shootback_colors[excerpt_color]" value="' . $excerptColor . '" />
			<div  class="colors-section-picker-div"></div>';

	$html .= '<p class="description">' . $args[0] . '</p>';

	echo $html;
}

// Typography tab
function shootback_initialize_typography_options()
{
	if( false === get_option( 'shootback_typography' ) ) {
		add_option( 'shootback_typography', array(
			'google_fonts_key' => 'AIzaSyBHh7VPOKMPw1oy6wsEs8FNtR5E8zjb-7A',
			'h1' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '54',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Rochester'
			),
			'h2' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '44',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Rochester'
			),
			'h3' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_size'   => '36',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Rochester'
			),
			'h4' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '28',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Rochester'
			),
			'h5' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '18',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Montserrat'
			),
			'menu' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '18',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Alex+Brush'
			),
			'body' => array(
				'type' => 'std',
				'font_name' => '0',
				'font_family' => '',
				'font_size'   => '14',
				'font_weight' => '400',
				'font_style' => 'normal',
				'text' => 'Shootback',
				'font_subsets' => array('latin'),
				'font_eot' => '',
				'font_svg' => '',
				'font_ttf' => '',
				'font_woff' => '',
				'standard_font' => 'Libre+Baskerville'
			),

			'icons' => 'icon-noicon,icon-image,icon-comments,icon-delete,icon-rss,icon-drag,icon-down,icon-up,icon-layout,icon-import,icon-play,icon-desktop,icon-social,icon-empty,icon-filter,icon-money,icon-flickr,icon-pinterest,icon-user,icon-video,icon-close,icon-link,icon-views,icon-quote,icon-pencil,icon-page,icon-post,icon-category,icon-time,icon-left,icon-right,icon-palette,icon-code,icon-sidebar,icon-vimeo,icon-lastfm,icon-logo,icon-heart,icon-list,icon-attention,icon-menu,icon-delimiter,icon-image-size,icon-settings,icon-share,icon-resize-vertical,icon-text,icon-movie,icon-dribbble,icon-yahoo,icon-facebook,icon-twitter,icon-tumblr,icon-gplus,icon-skype,icon-linkedin,icon-tick,icon-edit,icon-font,icon-home,icon-button,icon-wordpress,icon-music,icon-mail,icon-lock,icon-search,icon-github,icon-basket,icon-star,icon-link-ext,icon-award,icon-signal,icon-target,icon-attach,icon-download,icon-upload,icon-mic,icon-calendar,icon-phone,icon-headphones,icon-flag,icon-credit-card,icon-save,icon-megaphone,icon-key,icon-euro,icon-pound,icon-dollar,icon-rupee,icon-yen,icon-rouble,icon-try,icon-won,icon-bitcoin,icon-anchor,icon-support,icon-blocks,icon-block,icon-graduate,icon-shield,icon-window,icon-coverflow,icon-flight,icon-brush,icon-resize-full,icon-news,icon-pin,icon-params,icon-beaker,icon-delivery,icon-bell,icon-help,icon-laptop,icon-tablet,icon-mobile,icon-thumb,icon-briefcase,icon-direction,icon-ticket,icon-chart,icon-book,icon-print,icon-on,icon-off,icon-featured-area,icon-team,icon-login,icon-clients,icon-tabs,icon-tags,icon-gauge,icon-bag,icon-key,icon-glasses,icon-ok-full,icon-restart,icon-recursive,icon-shuffle,icon-ribbon,icon-lamp,icon-flash,icon-leaf,icon-chart-pie-outline,icon-puzzle,icon-fullscreen,icon-downscreen,icon-zoom-in,icon-zoom-out,icon-pencil-alt,icon-down-dir,icon-left-dir,icon-right-dir,icon-up-dir,icon-circle-outline,icon-circle-full,icon-dot-circled,icon-threedots,icon-colon,icon-down-micro,icon-cancel,icon-medal,icon-square-outline,icon-rhomb,icon-rhomb-outline',

		));
	} // end if

	// Register a section
	add_settings_section(
		'typography_settings_section',
		__( 'Typography Options', 'shootback' ),
		'shootback_typography_callback',
		'shootback_typography'
	);

	add_settings_field(
		'google_fonts_key',
		__( 'Google fonts API key', 'shootback' ),
		'toggle_google_api_key_callback',
		'shootback_typography',
		'typography_settings_section',
		array(
			__( sprintf('Get your key <a href="%s" target="_blank">%s</a>', 'https://developers.google.com/fonts/docs/developer_api', __('here', 'shootback') ), 'shootback' )
		)
	);

	$tags_h = array('H1', 'H2', 'H3', 'H4', 'H5');
	foreach($tags_h as $tag){
		add_settings_field(
			$tag,
			$tag . __(' styles', 'shootback' ),
			'toggle_' . $tag . '_callback',
			'shootback_typography',
			'typography_settings_section',
			array(
				__( '', 'shootback' )
			)
		);
	}

	add_settings_field(
		'body',
		__( 'General body text styles', 'shootback' ),
		'toggle_body_callback',
		'shootback_typography',
		'typography_settings_section',
		array(
			__( 'This is general body settings. This will change the font for the entire website.', 'shootback' )
		)
	);

	add_settings_field(
		'menu_font',
		__( 'Menu text styles', 'shootback' ),
		'toggle_menu_font_callback',
		'shootback_typography',
		'typography_settings_section',
		array(
			__( 'This is used for styling the menu element.', 'shootback' )
		)
	);

	register_setting( 'shootback_typography', 'shootback_typography');

} // END shootback_initialize_typography_options

add_action( 'admin_init', 'shootback_initialize_typography_options' );

/**************************************************
 * Typography Section Callbacks
 *************************************************/

function shootback_typography_callback()
{
	echo '<p>'.__( 'Use settings below to change typography for your website.', 'shootback' ).'</p>';
} // END shootback_typography_callback()

function toggle_H1_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'h1', array());
}
function toggle_H2_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'h2', array());
}
function toggle_H3_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'h3', array());
}
function toggle_H4_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'h4', array());
}
function toggle_H5_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'h5', array());
}
function toggle_menu_font_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'menu', array());
}
function toggle_body_callback()
{
	tsAddTypographyElement('', 'shootback_typography', 'body', array());
}

function toggle_google_api_key_callback($args)
{
	$options = get_option('shootback_typography');

	$key = @$options['google_fonts_key'];

	echo '<input type="text" name="shootback_typography[google_fonts_key]" id="shootback_google_fonts_key" value="'.esc_attr($key).'"/><p class="description">' .@$args[0]. '</p>';
}

function shootback_single_post_options()
{
	//delete_option('shootback_single_post');
	if( false === get_option( 'shootback_single_post' ) ) {
		add_option( 'shootback_single_post', array() );

		$data = array(
			'related_posts' => 'Y',
			'number_of_related_posts' => 6,
			'related_posts_nr_of_columns' => 3,
			'related_posts_type' => 'thumbnails',
			'related_posts_selection_criteria' => 'by_tags',
			'social_sharing' => 'Y',
			'post_tags' => 'Y',
			'post_meta' => 'Y',
			'post_pagination' => 'Y',
			'show_more' => 'y',
			'display_author_box' => 'n',
			'breadcrumbs' => 'y',
			'gallery-horizontal' => array('height-mobile' => 300, 'height-desktop' => 500),
			'gallery-justified' => array('height-mobile' => 300, 'height-desktop' => 500),
			'gallery-thumbnails-below' => array('height-mobile' => 300, 'height-desktop' => 500),
			'gallery-vertical-slider' => array('height-mobile' => 300, 'height-desktop' => 500),
			'gallery-masonry-layout' => array('height-mobile' => 300, 'height-desktop' => 500),
			'gallery-horizontal-scroll' => array('height-mobile' => 300, 'height-desktop' => 500)
		);

		update_option('shootback_single_post', $data);
	}

	add_settings_section(
		'single_post_settings_section',
		__( 'Single post Options', 'shootback' ),
		'shootback_single_post_callback',
		'shootback_single_post'
	);

	add_settings_field(
		'related_posts',
		__( 'Enable related posts', 'shootback' ),
		'toggle_related_posts_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'Settings for related posts on single posts', 'shootback' )
		)
	);

	add_settings_field(
		'social_sharing',
		__( 'Social sharing', 'shootback' ),
		'toggle_social_sharing_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'Enable social sharing on single posts.', 'shootback' )
		)
	);

	add_settings_field(
		'post_meta',
		__( 'Display post meta', 'shootback' ),
		'toggle_post_meta_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'Use this option to show or hide meta in posts.', 'shootback' )
		)
	);

	add_settings_field(
		'post_tags',
		__( 'Display post tags', 'shootback' ),
		'toggle_post_tags_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'Show or hide tags in single posts.', 'shootback' )
		)
	);

	add_settings_field(
		'post_pagination',
		__( 'Display pagination in single post', 'shootback' ),
		'toggle_post_pagination_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'Show or hide pagination in single posts.', 'shootback' )
		)
	);

	add_settings_field(
		'display_author_box',
		__( 'Hide author box', 'shootback' ),
		'toggle_display_author_box_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'You can globally author box on your single posts.', 'shootback' )
		)
	);

	add_settings_field(
		'breadcrumbs',
		__( 'Breadcrumbs:', 'shootback' ),
		'toggle_breadcrumbs_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( 'Activate or disable breadcrumbs on your website.', 'shootback' )
		)
	);

	add_settings_field(
		'gallery-horizontal',
		__( 'Horizontal gallery', 'shootback' ),
		'toggle_gallery_horizontal_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( '', 'shootback' )
		)
	);

	add_settings_field(
		'gallery-justified',
		__( 'Justified gallery', 'shootback' ),
		'toggle_gallery_justified_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( '', 'shootback' )
		)
	);

	add_settings_field(
		'gallery-vertical-slider',
		__( 'Vertical slider gallery', 'shootback' ),
		'toggle_gallery_vertical_slider_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( '', 'shootback' )
		)
	);

	add_settings_field(
		'gallery-thumbnails-below',
		__( 'Thumbnails below gallery', 'shootback' ),
		'toggle_gallery_thumbnail_below_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( '', 'shootback' )
		)
	);

	add_settings_field(
		'gallery-masonry-layout',
		__( 'Masonry layout gallery', 'shootback' ),
		'toggle_gallery_masonry_layout_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( '', 'shootback' )
		)
	);

	add_settings_field(
		'gallery-horizontal-scroll',
		__( 'Horizontal scroll gallery', 'shootback' ),
		'toggle_gallery_horizontal_scroll_callback',
		'shootback_single_post',
		'single_post_settings_section',
		array(
			__( '', 'shootback' )
		)
	);


	register_setting( 'shootback_single_post', 'shootback_single_post');

} // end shootback_single_post_options()

add_action( 'admin_init', 'shootback_single_post_options' );

/**************************************************
 * Single post Section Callbacks
 *************************************************/

function shootback_single_post_callback()
{
	echo '<p>'.__( 'Single posts settings options. In this section you can enable/disable related posts, social sharing, tags.', 'shootback' ).'</p>';
} // end shootback_single_post_callback()

function toggle_related_posts_callback($args)
{
	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[related_posts]" class="ts-related-posts">
				<option value="Y" '. selected( @$options["related_posts"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["related_posts"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';

	$html .= '<p class="description">' .@$args[0]. '</p>';

	$number_of_related_posts = (int)@$options['number_of_related_posts'];
	$number_of_related_posts = ($number_of_related_posts < 1) ? 3 : $number_of_related_posts;

	$related_posts_nr_of_columns = (int)@$options['related_posts_nr_of_columns'];

	$html .= '<div id="ts-related-posts-options">';

	$html .= '<p>'.__( 'Number of related posts', 'shootback' ).'</p>';

	$html .= '<select name="shootback_single_post[number_of_related_posts]">
		<option value="2" '.selected( $number_of_related_posts, '2', false ). '>2</option>
		<option value="3" '.selected( $number_of_related_posts, '3', false ). '>3</option>
		<option value="4" '.selected( $number_of_related_posts, '4', false ). '>4</option>
		<option value="6" '.selected( $number_of_related_posts, '6', false ). '>6</option>
		<option value="9" '.selected( $number_of_related_posts, '9', false ). '>9</option>
	</select>';

	$html .= '<p>' . __( 'Number of columns', 'shootback' ) . '</p>';

	$html .= '<select name="shootback_single_post[related_posts_nr_of_columns]">
				<option value="2" '.selected( $related_posts_nr_of_columns, '2', false ). '>2</option>
				<option value="3" '.selected( $related_posts_nr_of_columns, '3', false ). '>3</option>
				<option value="4" '.selected( $related_posts_nr_of_columns, '4', false ). '>4</option>
			</select>';

	$html .= '<p>' . __( 'Post type', 'shootback' ) . '</p>';

	$html .= '<select name="shootback_single_post[related_posts_type]">
				<option value="grid" '. selected( @$options["related_posts_type"], 'grid', false ).'>'.__( 'Grid', 'shootback' ).'</option>
				<option value="thumbnails" '. selected( @$options["related_posts_type"], 'thumbnails', false ). '>'.__( 'Thumbnail', 'shootback' ).'</option>
			</select>';

	$html .= '<p>'.__( 'Selection criteria', 'shootback' ).'</p>';

	$html .= '<select name="shootback_single_post[related_posts_selection_criteria]">
				<option value="by_tags" '. selected( @$options["related_posts_selection_criteria"], 'by_tags', false ).'>'.__( 'by Tags', 'shootback' ).'</option>
				<option value="by_categs" '. selected( @$options["related_posts_selection_criteria"], 'by_categs', false ). '>'.__( 'by Categories', 'shootback' ).'</option>
			</select>';
	$html .= '</div>';

	echo $html;

} // END toggle_related_posts_callback()

function toggle_social_sharing_callback($args)
{

	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[social_sharing]">
				<option value="Y" '. selected( @$options["social_sharing"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["social_sharing"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;

} // END toggle_social_sharing_callback()

function toggle_post_meta_callback($args)
{
	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[post_meta]">
				<option value="Y" '. selected( @$options["post_meta"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["post_meta"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;

} // END toggle_post_meta_callback()

function toggle_post_tags_callback($args)
{
	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[post_tags]">
				<option value="Y" '. selected( @$options["post_tags"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["post_tags"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;

} // toggle_post_tags_callback()

function toggle_display_author_box_callback($args)
{
	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[display_author_box]">
				<option value="y" ' . selected(@$options["display_author_box"], 'y', false) .'>'.__( 'Yes', 'shootback' ) . '</option>
				<option value="n" ' . selected(@$options["display_author_box"], 'n', false) . '>'.__( 'No', 'shootback' ) . '</option>
			</select>';
	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_breadcrumbs_callback($args)
{
	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[breadcrumbs]">
				<option value="y" ' . selected(@$options["breadcrumbs"], 'y', false) .'>'.__( 'Yes', 'shootback' ) . '</option>
				<option value="n" ' . selected(@$options["breadcrumbs"], 'n', false) . '>'.__( 'No', 'shootback' ) . '</option>
			</select>';
	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_gallery_horizontal_callback($args)
{
	$options = get_option('shootback_single_post');
	$heightDesktop = (isset($options['gallery-horizontal']['height-desktop']) && is_numeric($options['gallery-horizontal']['height-desktop'])) ? $options['gallery-horizontal']['height-desktop'] : 500;
	$heightMobile = (isset($options['gallery-horizontal']['height-mobile']) && is_numeric($options['gallery-horizontal']['height-mobile'])) ? $options['gallery-horizontal']['height-mobile'] : 300;

	$html = '<p>' . __('Change image height for desktop', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-horizontal][height-desktop]" value="' . $heightDesktop . '" readonly  id="ts-horizontal-height-desktop"/>
			<div id="ts-slider-horizontal-height-desktop"></div>';

	$html .= '<p>' . __('Change image height for mobile', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-horizontal][height-mobile]" value="' . $heightMobile . '" readonly  id="ts-horizontal-height-mobile"/>
			<div id="ts-slider-horizontal-height-mobile"></div>';
	$html .= 	'<script>
					jQuery(document).ready(function(){
						ts_slider_pips(400, 1000, 10, ' . $heightDesktop . ', "ts-slider-horizontal-height-desktop", "ts-horizontal-height-desktop");
						ts_slider_pips(180, 500, 10, ' . $heightMobile . ', "ts-slider-horizontal-height-mobile", "ts-horizontal-height-mobile");
					});
				</script>';

	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_gallery_justified_callback($args)
{
	$options = get_option('shootback_single_post');
	$heightDesktop = (isset($options['gallery-justified']['height-desktop']) && is_numeric($options['gallery-justified']['height-desktop'])) ? $options['gallery-justified']['height-desktop'] : 500;
	$heightMobile = (isset($options['gallery-justified']['height-mobile']) && is_numeric($options['gallery-justified']['height-mobile'])) ? $options['gallery-justified']['height-mobile'] : 300;

	$html = '<p>' . __('Change image height for desktop (max-height)', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-justified][height-desktop]" value="' . $heightDesktop . '" readonly id="ts-justified-height-desktop"/>
			<div id="ts-slider-justified-height-desktop"></div>';

	$html .= '<p>' . __('Change image height for mobile (max-height)', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-justified][height-mobile]" value="' . $heightMobile . '" readonly  id="ts-justified-height-mobile"/>
			<div id="ts-slider-justified-height-mobile"></div>';
	$html .= 	'<script>
					jQuery(document).ready(function(){
						ts_slider_pips(150, 600, 10, ' . $heightDesktop . ', "ts-slider-justified-height-desktop", "ts-justified-height-desktop");
						ts_slider_pips(180, 400, 10, ' . $heightMobile . ', "ts-slider-justified-height-mobile", "ts-justified-height-mobile");
					});
				</script>';

	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_gallery_vertical_slider_callback($args)
{
	$options = get_option('shootback_single_post');
	$heightDesktop = (isset($options['gallery-vertical-slider']['height-desktop']) && is_numeric($options['gallery-vertical-slider']['height-desktop'])) ? $options['gallery-vertical-slider']['height-desktop'] : 500;
	$heightMobile = (isset($options['gallery-vertical-slider']['height-mobile']) && is_numeric($options['gallery-vertical-slider']['height-mobile'])) ? $options['gallery-vertical-slider']['height-mobile'] : 300;

	$html = '<p>' . __('Change image height for desktop', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-vertical-slider][height-desktop]" value="' . $heightDesktop . '" readonly  id="ts-vertical-slider-height-desktop"/>
			<div id="ts-slider-vertical-slider-height-desktop"></div>';

	$html .= '<p>' . __('Change image height for mobile', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-vertical-slider][height-mobile]" value="' . $heightMobile . '" readonly  id="ts-vertical-slider-height-mobile"/>
			<div id="ts-slider-vertical-slider-height-mobile"></div>';
	$html .= 	'<script>
					jQuery(document).ready(function(){
						ts_slider_pips(400, 1000, 10, ' . $heightDesktop . ', "ts-slider-vertical-slider-height-desktop", "ts-vertical-slider-height-desktop");
						ts_slider_pips(180, 500, 10, ' . $heightMobile . ', "ts-slider-vertical-slider-height-mobile", "ts-vertical-slider-height-mobile");
					});
				</script>';

	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_gallery_thumbnail_below_callback($args)
{
	$options = get_option('shootback_single_post');
	$heightDesktop = (isset($options['gallery-thumbnails-below']['height-desktop']) && is_numeric($options['gallery-thumbnails-below']['height-desktop'])) ? $options['gallery-thumbnails-below']['height-desktop'] : 500;
	$heightMobile = (isset($options['gallery-thumbnails-below']['height-mobile']) && is_numeric($options['gallery-thumbnails-below']['height-mobile'])) ? $options['gallery-thumbnails-below']['height-mobile'] : 300;

	$html = '<p>' . __('Change image height for desktop', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-thumbnails-below][height-desktop]" value="' . $heightDesktop . '" readonly  id="ts-thumbnails-below-height-desktop"/>
			<div id="ts-slider-thumbnails-below-height-desktop"></div>';

	$html .= '<p>' . __('Change image height for mobile', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-thumbnails-below][height-mobile]" value="' . $heightMobile . '" readonly  id="ts-thumbnails-below-height-mobile"/>
			<div id="ts-slider-thumbnails-below-height-mobile"></div>';
	$html .= 	'<script>
					jQuery(document).ready(function(){
						ts_slider_pips(400, 1000, 10, ' . $heightDesktop . ', "ts-slider-thumbnails-below-height-desktop", "ts-thumbnails-below-height-desktop");
						ts_slider_pips(180, 500, 10, ' . $heightMobile . ', "ts-slider-thumbnails-below-height-mobile", "ts-thumbnails-below-height-mobile");
					});
				</script>';

	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_gallery_masonry_layout_callback($args)
{
	$options = get_option('shootback_single_post');
	$heightDesktop = (isset($options['gallery-masonry-layout']['height-desktop']) && is_numeric($options['gallery-masonry-layout']['height-desktop'])) ? $options['gallery-masonry-layout']['height-desktop'] : 500;
	$heightMobile = (isset($options['gallery-masonry-layout']['height-mobile']) && is_numeric($options['gallery-masonry-layout']['height-mobile'])) ? $options['gallery-masonry-layout']['height-mobile'] : 300;

	$html = '<p>' . __('Change image width for desktop (max-width)', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-masonry-layout][height-desktop]" value="' . $heightDesktop . '" readonly  id="ts-masonry-layout-height-desktop"/>
			<div id="ts-slider-masonry-layout-height-desktop"></div>';

	$html .= '<p>' . __('Change image width for mobile (max-width)', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-masonry-layout][height-mobile]" value="' . $heightMobile . '" readonly  id="ts-masonry-layout-height-mobile"/>
			<div id="ts-slider-masonry-layout-height-mobile"></div>';
	$html .= 	'<script>
					jQuery(document).ready(function(){
						ts_slider_pips(250, 600, 10, ' . $heightDesktop . ', "ts-slider-masonry-layout-height-desktop", "ts-masonry-layout-height-desktop");
						ts_slider_pips(150, 400, 10, ' . $heightMobile . ', "ts-slider-masonry-layout-height-mobile", "ts-masonry-layout-height-mobile");
					});
				</script>';

	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_gallery_horizontal_scroll_callback($args)
{
	$options = get_option('shootback_single_post');
	$heightDesktop = (isset($options['gallery-horizontal-scroll']['height-desktop']) && is_numeric($options['gallery-horizontal-scroll']['height-desktop'])) ? $options['gallery-horizontal-scroll']['height-desktop'] : 500;
	$heightMobile = (isset($options['gallery-horizontal-scroll']['height-mobile']) && is_numeric($options['gallery-horizontal-scroll']['height-mobile'])) ? $options['gallery-horizontal-scroll']['height-mobile'] : 300;

	$html = '<p>' . __('Change image height for desktop', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-horizontal-scroll][height-desktop]" value="' . $heightDesktop . '" readonly  id="ts-horizontal-scroll-height-desktop"/>
			<div id="ts-slider-horizontal-scroll-height-desktop"></div>';

	$html .= '<p>' . __('Change image height for mobile', 'shootback') . '</p>';
	$html .= '<input type="text" name="shootback_single_post[gallery-horizontal-scroll][height-mobile]" value="' . $heightMobile . '" readonly  id="ts-horizontal-scroll-height-mobile"/>
			<div id="ts-slider-horizontal-scroll-height-mobile"></div>';
	$html .= 	'<script>
					jQuery(document).ready(function(){
						ts_slider_pips(400, 1000, 10, ' . $heightDesktop . ', "ts-slider-horizontal-scroll-height-desktop", "ts-horizontal-scroll-height-desktop");
						ts_slider_pips(180, 500, 10, ' . $heightMobile . ', "ts-slider-horizontal-scroll-height-mobile", "ts-horizontal-scroll-height-mobile");
					});
				</script>';

	$html .= '<p class="description">' . @$args[0] . '</p>';

	echo $html;

}

function toggle_post_pagination_callback($args)
{
	$options = get_option('shootback_single_post');

	$html = '<select name="shootback_single_post[post_pagination]">
				<option value="Y" '. selected( @$options["post_pagination"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["post_pagination"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;

} // toggle_post_pagination_callback()

function shootback_page_options()
{
	//delete_option('shootback_page');
	if( false === get_option( 'shootback_page' ) ) {
		add_option( 'shootback_page' );

		$data = array(
			'social_sharing' => 'Y',
			'post_meta' => 'Y',
			'breadcrumbs' => 'y'
		);

		update_option('shootback_page', $data);
	}

	// Register a section
	add_settings_section(
		'page_settings_section',
		__( 'Page options', 'shootback' ),
		'shootback_page_callback',
		'shootback_page'
	);

	add_settings_field(
		'social_sharing',
		__( 'Social sharing', 'shootback' ),
		'toggle_page_social_sharing_callback',
		'shootback_page',
		'page_settings_section',
		array(
			__( 'This will enable/disable social sharing buttons on pages.', 'shootback' )
		)
	);

	add_settings_field(
		'post_meta',
		__( 'Display page meta', 'shootback' ),
		'toggle_page_post_meta_callback',
		'shootback_page',
		'page_settings_section',
		array(
			__( 'Show/hide page meta', 'shootback' )
		)
	);

	add_settings_field(
		'breadcrumbs',
		__( 'Breadcrumbs', 'shootback' ),
		'toggle_page_breadcrumbs_callback',
		'shootback_page',
		'page_settings_section',
		array(
			__( 'Show/hide page meta', 'shootback' )
		)
	);
	register_setting( 'shootback_page', 'shootback_page');

} // end shootback_page_options

add_action( 'admin_init', 'shootback_page_options' );

/**************************************************
 * Single post Section Callbacks
 *************************************************/

function shootback_page_callback()
{

	echo '<p>'.__( 'In this section you can change settings for pages, to enable/disable page meta and social sharing.', 'shootback' ).'</p>';
} // END shootback_page_callback

function toggle_page_social_sharing_callback($args)
{
	$options = get_option('shootback_page');

	$html = '<select name="shootback_page[social_sharing]">
				<option value="Y" '. selected( @$options["social_sharing"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["social_sharing"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_page_post_meta_callback($args)
{
	$options = get_option('shootback_page');

	$html = '<select name="shootback_page[post_meta]">
				<option value="Y" '. selected( @$options["post_meta"], 'Y', false ).'>'.__( 'Yes', 'shootback' ).'</option>
				<option value="N" '. selected( @$options["post_meta"], 'N', false ). '>'.__( 'No', 'shootback' ).'</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;
}

function toggle_page_breadcrumbs_callback($args)
{
	$options = get_option('shootback_page');

	$html = '<select name="shootback_page[breadcrumbs]">
				<option value="y" ' . selected( @$options["breadcrumbs"], 'y', false ) .'>' . __( 'Yes', 'shootback' ) . '</option>
				<option value="n" ' . selected( @$options["breadcrumbs"], 'n', false ) . '>' . __( 'No', 'shootback' ) . '</option>
			</select>';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;
}

function shootback_social_options()
{		$x = get_option('shootback_social');

	$social = array();
	if( isset($_POST) && isset($_POST['shootback_social']['social-new']) && !empty($_POST['shootback_social']['social-new']) && is_array($_POST['shootback_social']['social-new']) ){
		foreach ($_POST['shootback_social']['social-new'] as $key => $value) {
			$url = (isset($value['url'])) ? esc_attr($url) : '';
			$image = (isset($value['image'])) ? esc_url($image) : '';
			$color = (isset($value['color'])) ? esc_attr($color) : '';
			$social[]['url'] = $url;
			$social[]['image'] = $image;
			$social[]['color'] = $color;
		}
	}
	if( false === get_option( 'shootback_social' ) ) {
		add_option( 'shootback_social' );

		$data = array(
			'email'		 => '',
			'skype'      => '',
			'github'     => '',
			'gplus'      => '',
			'dribble'    => '',
			'lastfm'     => '',
			'linkedin'   => '',
			'tumblr'     => '',
			'twitter'    => '',
			'vimeo'      => '',
			'wordpress'  => '',
			'yahoo'      => '',
			'youtube'    => '',
			'facebook'   => '',
			'flickr'     => '',
			'pinterest'  => '',
			'instagram'  => '',
			'social-new' => $social
		);

		update_option('shootback_social', $data);
	}

	add_settings_section(
		'social_section',
		__( 'Social icons options', 'shootback' ),
		'shootback_social_callback',
		'shootback_social'
	);

	add_settings_field(
		'email',
		__( 'Email', 'shootback' ),
		'toggle_email_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'This email is used to receive emails from contact form', 'shootback' )
		)
	);

	add_settings_field(
		'skype',
		__( 'Skype', 'shootback' ),
		'toggle_skype_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Skype here', 'shootback' )
		)
	);

	add_settings_field(
		'github',
		__( 'Github', 'shootback' ),
		'toggle_github_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your github page here', 'shootback' )
		)
	);

	add_settings_field(
		'gplus',
		__( 'Google+', 'shootback' ),
		'toggle_google_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Google+ page here.', 'shootback' )
		)
	);

	add_settings_field(
		'dribble',
		__( 'Dribble', 'shootback' ),
		'toggle_dribble_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Dribbble page here.', 'shootback' )
		)
	);

	add_settings_field(
		'lastfm',
		__( 'last.fm', 'shootback' ),
		'toggle_lastfm_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your last.fm page here.', 'shootback' )
		)
	);

	add_settings_field(
		'linkedin',
		__( 'LinkedIn', 'shootback' ),
		'toggle_linkedin_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your LinkedIn here.', 'shootback' )
		)
	);

	add_settings_field(
		'tumblr',
		__( 'Tumblr', 'shootback' ),
		'toggle_tumblr_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Tumblr page here.', 'shootback' )
		)
	);

	add_settings_field(
		'twitter',
		__( 'Twitter', 'shootback' ),
		'toggle_twitter_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Twitter page here.', 'shootback' )
		)
	);

	add_settings_field(
		'vimeo',
		__( 'Vimeo', 'shootback' ),
		'toggle_vimeo_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Vimeo page here.', 'shootback' )
		)
	);

	add_settings_field(
		'wordpress',
		__( 'WordPress', 'shootback' ),
		'toggle_wordpress_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your WordPress page here.', 'shootback' )
		)
	);

	add_settings_field(
		'yahoo',
		__( 'Yahoo', 'shootback' ),
		'toggle_yahoo_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Yahoo ID here.', 'shootback' )
		)
	);

	add_settings_field(
		'youtube',
		__( 'Youtube', 'shootback' ),
		'toggle_youtube_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your YouTube page here.', 'shootback' )
		)
	);

	add_settings_field(
		'facebook',
		__( 'Facebook', 'shootback' ),
		'toggle_facebook_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Facebook page here.', 'shootback' )
		)
	);

	add_settings_field(
		'flickr',
		__( 'Flickr', 'shootback' ),
		'toggle_flickr_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Flickr page here.', 'shootback' )
		)
	);

	add_settings_field(
		'pinterest',
		__( 'Pinterest', 'shootback' ),
		'toggle_pinterest_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Pinterest page here.', 'shootback' )
		)
	);

	add_settings_field(
		'instagram',
		__( 'Instagram', 'shootback' ),
		'toggle_instagram_social_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your Instagram page here.', 'shootback' )
		)
	);

	add_settings_field(
		'social-new',
		__( 'Add new', 'shootback' ),
		'toggle_social_new_callback',
		'shootback_social',
		'social_section',
		array(
			__( 'Insert your new social page here.', 'shootback' )
		)
	);

	register_setting( 'shootback_social', 'shootback_social');

} // END shootback_social_options

add_action( 'admin_init', 'shootback_social_options' );

function shootback_theme_update_options()
{
	//delete_option('shootback_theme_update');
	if( false === get_option( 'shootback_theme_update' ) ) {
		add_option( 'shootback_theme_update' );

		$data = array(
			'update_options'=> array(
				'user_name' => '',
				'key_api'   => ''
			)
		);

		update_option('shootback_theme_update', $data);
	}

	add_settings_section(
		'theme_update_section',
		__( 'Update your Theme from the WordPress Dashboard', 'shootback' ),
		'shootback_theme_update_callback',
		'shootback_theme_update'
	);

	register_setting( 'shootback_theme_update', 'shootback_theme_update');

}

add_action( 'admin_init', 'shootback_theme_update_options' );

function shootback_theme_advertising_options()
{
	//delete_option('shootback_theme_advertising');
	if( false === get_option( 'shootback_theme_advertising' ) ) {
		add_option( 'shootback_theme_advertising' );

		$data = array(
				'ad_area_1'   => '',
				'ad_area_2'   => ''
		);

		update_option('shootback_theme_advertising', $data);
	}

	add_settings_section(
		'theme_advertising_section',
		__( 'Advertising code', 'shootback' ),
		'shootback_theme_advertising_callback',
		'shootback_theme_advertising'
	);

	add_settings_field(
		'ad_area_1',
		__( 'Area 1', 'shootback' ),
		'shootback_add_area_1_callback',
		'shootback_theme_advertising',
		'theme_advertising_section',
		array(
			__( 'This advertising will be shown <b>above the video</b> on the video single post. Used only for custom video posts.', 'shootback' )
		)
	);

	add_settings_field(
		'ad_area_2',
		__( 'Area 2', 'shootback' ),
		'shootback_add_area_2_callback',
		'shootback_theme_advertising',
		'theme_advertising_section',
		array(
			__( 'This advertising will be shown <b>above the comments</b> on the single post. Used only for any theme posts types.', 'shootback' )
		)
	);


	register_setting( 'shootback_theme_advertising', 'shootback_theme_advertising');

}
add_action( 'admin_init', 'shootback_theme_advertising_options' );

/**************************************************
 * Advertising Section Callbacks
 *************************************************/

function shootback_theme_advertising_callback()
{

	$html   = '';
	echo $html;
}

function shootback_add_area_1_callback($args)
{
	$options = get_option('shootback_theme_advertising');
	$html    = '<textarea name="shootback_theme_advertising[ad_area_1]" cols="80" rows="10">' . @$options['ad_area_1'] . '</textarea>';
	$html   .= '<p class="description">' . @$args[0] . '</p>';
	echo $html;
}

function shootback_add_area_2_callback($args)
{
	$options = get_option('shootback_theme_advertising');
	$html    = '<textarea name="shootback_theme_advertising[ad_area_2]" cols="80" rows="10">' . @$options['ad_area_2'] . '</textarea>';
	$html   .= '<p class="description">' . @$args[0] . '</p>';
	echo $html;
}


/**************************************************
 * Single post Section Callbacks
 *************************************************/
function shootback_social_callback()
{
	echo '<p>'.__( 'Insert your link to the social pages below. These are used for social icons. The email set here is going to be used for contact forms.', 'shootback' ).'</p>';
} // END shootback_social_callback

function toggle_email_callback($args)
{
	$options = get_option('shootback_social');
	$email = is_email(@$options['email']) ? @$options['email'] : '';

	$html = '<input type="text" name="shootback_social[email]" value="'. $email . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_skype_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[skype]" value="'. @esc_url($options['skype']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_github_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[github]" value="'. @esc_url($options['github']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_google_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[gplus]" value="'. @esc_url($options['gplus']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_dribble_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[dribble]" value="'. @esc_url($options['dribble']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_lastfm_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[lastfm]" value="'. @esc_url($options['lastfm']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}


function toggle_linkedin_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[linkedin]" value="'. @esc_url($options['linkedin']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_tumblr_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[tumblr]" value="'. @esc_url($options['tumblr']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_twitter_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[twitter]" value="'. @esc_url($options['twitter']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';

	echo $html;
}

function toggle_vimeo_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[vimeo]" value="'. @esc_url($options['vimeo']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_wordpress_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[wordpress]" value="'. @esc_url($options['wordpress']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_yahoo_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[yahoo]" value="'. @esc_url($options['yahoo']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_youtube_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[youtube]" value="'. @esc_url($options['youtube']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_facebook_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[facebook]" value="'. @esc_url($options['facebook']) . '">';
	$html .= '<p class="description">' .$args[0]. '</p>';

	echo $html;
}

function toggle_flickr_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[flickr]" value="'. @esc_url($options['flickr']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_pinterest_social_callback($args)
{
	$options = get_option('shootback_social');

	$html = '<input type="text" name="shootback_social[pinterest]" value="'. @esc_url($options['pinterest']) . '">';
	$html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function toggle_instagram_social_callback($args)
{
	$options = get_option('shootback_social');
	$instagram = (isset($options['instagram']) && !empty($options['instagram'])) ? esc_url($options['instagram']) : '';

	$html = '<input type="text" name="shootback_social[instagram]" value="'. $instagram .'">';
	$html .= '<p class="description">'. @$args[0] .'</p>';
	echo $html;
}

function toggle_social_new_callback($args)
{
	$options = get_option('shootback_social');
	$html = '';
	$i = 1;

	if( isset($options) && isset($options['social_new']) && is_array($options['social_new']) && !empty($options['social_new']) ){
		$html = '<ul>';
		foreach($options['social_new'] as $key=>$option){
			$image_url = (isset($option['image'])) ? $option['image'] : '';
			$url_social = (isset($option['url'])) ? $option['url'] : '';
			$color = (isset($option['color'])) ? $option['color'] : '';
			$key_clean = (isset($key) && (int)$key !== 0) ? (int)$key : '';

			$html .= '<li>
						<div class="sortable-meta-element">
		            		<span class="tab-arrow icon-down"></span> <span class="social-item-tab ts-multiple-item-tab">' . __('Social item:', 'shootback') . ' ' . $i .'</span>
		             	</div>
		    			<div class="hidden">
					        <table>
					             <tr>
					               <td>'.__( "Social icon","shootback" ).'</td>
					               <td>
					                     <input id="" type="text" data-role="media-url" name="shootback_social[social_new][' . $i . '][image]" value="' . $image_url . '"/>
					                     <input id="ts_upload-' . $i . '" type="button" class="button ts-upload-social-image ts-multiple-item-upload" value="' . __( "Upload","shootback" ) . '" />
					                 </td>
					             </tr>
					             <tr>
					                 <td>
					                     <label for="social-url">Enter url social here:</label>
					                 </td>
					                 <td>
					                    <input value ="' .  $url_social . '" type="text" name="shootback_social[social_new][' .  $i . '][url]" />
					                 </td>
					             </tr>
					             <tr>
					                 <td>
					                     <label for="social-color">Color hover:</label>
					                 </td>
					                 <td>
					                     <input type="text" value="' . $color . '" class="colors-section-picker" name="shootback_social[social_new][' . $i . '][color]" />
					                     <div class="colors-section-picker-div"></div>
					                 </td>
					             </tr>
					        </table>
			        		<input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" /></div>
			        	</div>
			       	</li>';

		    $i++;
		}
		$html .= '</ul>';
	}

	$html .= '<ul id="social_items">
 			</ul>
	 		<input type="hidden" id="social_content" value="" />
 			<input type="button" class="button ts-multiple-add-button" data-element-name="social" id="social_add_item" value="' . __('Add New Icon', 'shootback') . '" />';
 	$html .= '<script id="social_items_template" type="text/template">
	     		<li id="list-item-id-{{item-id}}" class="social-item ts-multiple-add-list-element">
		            <div class="sortable-meta-element">
		            	<span class="tab-arrow icon-down"></span> <span class="social-item-tab ts-multiple-item-tab">' . __('Item:', 'shootback') . ' {{slide-number}}</span>
		            </div>
		            <div class="hidden">

			        <table>
			             <tr>
			               <td>'.__( "Social icon","shootback" ).'</td>
			               <td>
			                    <input type="text" data-role="media-url" name="shootback_social[social_new][{{item-id}}][image]" id="social-{{item-id}}-image" value=""/>
			                    <input type="button" id="uploader_{{item-id}}"  class="button ts-upload-social-image ts-multiple-item-upload" value="' . __( "Upload","shootback" ) . '" />
			                 </td>
			             </tr>
			             <tr>
			                 <td>
			                     <label for="social-{{item-id}}-url">' . __('Enter url social here:', 'shootback') . '</label>
			                 </td>
			                 <td>
			                    <input type="text" name="shootback_social[social_new][{{item-id}}][url]" />
			                 </td>
			             </tr>
			             <tr>
			                 <td>
			                     <label for="social-color">' . __('Color hover:', 'shootback') . '</label>
			                 </td>
			                 <td>
			                     <input type="text" value="#777" class="colors-section-picker" name="shootback_social[social_new][{{item-id}}][color]" />
			                     <div class="colors-section-picker-div" id="social-{{item-id}}-color-picker"></div>
			                 </td>
			             </tr>
			        </table>
		        	<input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" /></div>
	     		</li>
     		</script>';
    $html .= '<p class="description">' .@$args[0]. '</p>';
	echo $html;
}

function shootback_css_options()
{
	if( false === get_option( 'shootback_css' ) ) {
		add_option( 'shootback_css' );
		$data = array(
			'css' => ''
		);

		update_option('shootback_css', $data);
	}

	// Register a section
	add_settings_section(
		'css_section',
		__( 'Custom CSS', 'shootback' ),
		'shootback_css_callback',
		'shootback_css'
	);

	register_setting( 'shootback_css', 'shootback_css');

} // END shootback_css_options()

add_action( 'admin_init', 'shootback_css_options' );

/**************************************************
 * Single post Section Callbacks
 *************************************************/

function shootback_css_callback()
{
	echo '<p>'.__( 'Insert here your custom CSS', 'shootback' ).'</p>';

	$options = get_option('shootback_css');

	$html = '<textarea name="shootback_css[css]" cols="80" rows="30">' . @$options['css']. '</textarea>';
	echo $html;

} // END shootback_css_callback()

function shootback_sidebars_options()
{
	if( false === get_option( 'shootback_sidebars' ) ) {
		add_option( 'shootback_sidebars' );
		update_option( 'shootback_sidebars', array() );
	}

	// Register a section
	add_settings_section(
		'sidebars_section',
		__( 'Sidebars', 'shootback' ),
		'shootback_sidebars_callback',
		'shootback_sidebars'
	);

	register_setting( 'shootback_sidebars', 'shootback_sidebars');

} // END shootback_sidebars_options()

add_action( 'admin_init', 'shootback_sidebars_options' );

/**************************************************
 * Sidebars Section Callbacks
 *************************************************/

function shootback_sidebars_callback()
{
	echo '<p>'.__( 'Manage your theme sidebars from here', 'shootback' ).'</p>';

	$sidebars = get_option('shootback_sidebars');
	$html = '';

	if (isset($sidebars)) {
		$html .= '<table cellpadding="10" id="ts-sidebars">';

		foreach ($sidebars as $id => $sidebar) {
			$html .= '
			<tr>
				<td class="dynamic-sidebar">'.$sidebar. '</td>
				<td><a href="#" id="'.$id.'" class="ts-remove-sidebar">'.__( 'Delete', 'shootback' ).'</a></td>
			</tr>';
		}
		$html .= '</table>';
	}

	$html .= '
		<input type="text" name="sidebar_name" id="ts_sidebar_name" />
		<input type="submit" name="add_sidebar" id="ts_add_sidebar" class="button-primary" value="'.__( 'Add sidebar', 'shootback' ).'" />
		<br/><br/><br/>';
	echo $html;

} // END shootback_sidebars_callback()

function shootback_init_impots_options()
{
	if( false === get_option( 'shootback_impots_options' ) ) {
		add_option( 'shootback_impots_options', array() );
	}

	// Register a section
	add_settings_section(
		'shootback_impots_options_section',
		__( 'Import Options', 'shootback' ),
		'shootback_impots_options_callback',
		'shootback_impots_options'
	);

	add_settings_field(
		'import_demo',
		__( 'Import demo', 'shootback' ),
		'shootback_import_demo_callback',
		'shootback_impots_options',
		'shootback_impots_options_section',
		array(
			__( 'Import demo data', 'shootback' )
		)
	);

	add_settings_field(
		'reset_settings',
		__( 'Reset settings', 'shootback' ),
		'shootback_reset_settings_callback',
		'shootback_impots_options',
		'shootback_impots_options_section',
		array(
			__( 'Reset your settings to default.', 'shootback' )
		)
	);

	register_setting( 'shootback_impots_options', 'shootback_impots_options');

} // END shootback_css_options()

add_action( 'admin_init', 'shootback_init_impots_options' );

function shootback_impots_options_callback($args)
{
	$file_data = '';

	$file_headers = @get_headers(get_template_directory_uri() . '/import/demo-files/settings.txt');
	if($file_headers[0] !== 'HTTP/1.1 404 Not Found') {
		$file_data = wp_remote_fopen(get_template_directory_uri() . '/import/demo-files/settings.txt');
	}

	echo '<p>' . __( 'Proceed with caution. Warning! You <b style="color: #E75750">WILL lose all your current settings FOREVER</b> if you paste the import data and click "Save changes". Double check everything!', 'shootback' ) . '</p>';

	if (isset($_GET['updated'])) {
		if ($_GET['updated'] === 'true') {
			echo '<div class="sucess">' . __('Options are successfully imported', 'shootback').'</div>';
		} else {
			echo '<div class="error">' . __("Options can't be imported. Inserted data can't be decoded properly", 'shootback').'</div>';
		}
	}
?><br>
	<form action="<?php echo admin_url('admin.php?page=shootback&tab=save_options') ?>" method="POST">
		<textarea data-import-demo="<?php echo $file_data; ?>" name="encoded_options" id="ts_encoded_options" cols="30" rows="10"><?php echo esc_attr(shootback_exports_options()); ?></textarea>
		<br><br>
		<input type="submit" name="ts_submit_button" class="button" value="Save changes">

		<script>
			jQuery(document).ready(function($) {

				$(document).on('click', '#ts_encoded_options', function(event) {
					event.preventDefault();
					$('#ts_encoded_options').select();
				});
			});
		</script>
	</form>
<?php
}

function shootback_import_demo_callback(){

	$import = new Ts_Importer();
	$import->demo_installer(); ?>
	<script>
		jQuery('.ts-importer-wrap').siblings().remove();
	</script>
<?php
}

function shootback_reset_settings_callback(){
	if( isset($_POST['reset-settings']) ){
		$expots_options = array(
			'shootback_general',
			'shootback_image_sizes',
			'shootback_layout',
			'shootback_colors',
			'shootback_styles',
			'shootback_typography',
			'shootback_single_post',
			'shootback_page',
			'shootback_social',
			'shootback_css',
			'shootback_sidebars',
			'shootback_header',
			'shootback_header_templates',
			'shootback_header_template_id',
			'shootback_footer',
			'shootback_footer_templates',
			'shootback_footer_template_id',
			'shootback_footer_template_id',
			'shootback_page_template_id',
			'shootback_theme_advertising',
			'shootback_theme_update',
			'shootback_optimization'
		);

		foreach ($expots_options as $option) {
			delete_option($option);
		}
	}
?>
	<form action="<?php echo admin_url('admin.php?page=shootback&tab=impots_options') ?>" method="POST">
		<input type="submit" name="reset-settings" class="button" value="<?php _e('Reset settings', 'shootback'); ?>">
	</form>
<?php
}

// ========================================================================================
// TouchSize news and alerts ==============================================================
// ========================================================================================

function shootback_red_area()
{
	if( false === get_option( 'shootback_red_area' ) ) {
		$data = array(
			'news' => '',
			'alert' => array(
				'id' => 0,
				'message' => ''
			),
			'hidden_alerts' => array(),
			'time' => time()
		);

		add_option( 'shootback_red_area', $data );
	}

	// Register a section
	add_settings_section(
		'shootback_red_area',
		__( 'Red Area', 'shootback' ),
		'shootback_red_area_callback',
		'shootback_red_area'
	);

	register_setting( 'shootback_red_area', 'shootback_red_area');

} // END shootback_css_options()

add_action( 'admin_init', 'shootback_red_area' );

function shootback_red_area_callback() {

	echo '<div class="red-last-news">';
	echo '<h4>'.__( 'Latest news', 'shootback' ).'</h4>';

	$options = get_option('shootback_red_area', array());

	if (isset($options['news'])) {
		echo $options['news'];
	}
	echo '</div>';
}

function shootback_theme_update_callback(){

	echo '<p>'.__( 'Update your Theme from the WordPress Dashboard', 'shootback' ).'</p>';

	$theme_update_options = get_option('shootback_theme_update');

	$theme_update = (isset($theme_update_options['update_options'])) ? $theme_update_options['update_options'] : '';

	$html = '<p>In order to be able to do updates directly from the WP Dashboard, you will need to add your ThemeForest details in the form below. If you do not know where to get your API key from, here is a link:<br><br><a href="http://support.touchsize.com/knowledgebase/How-to-get-ThemeForest-API-key-for-updates-58.html" class="button button-secondary" target="_blank">Click for API Key Tutorial</a><br><br></p>';
	$html .= '<h4>Add your ThemeForest information below:</h4>';
	$html .= '<p>Your Themeforest User Name:</p>
	          <input type="text" name="shootback_theme_update[update_options][user_name]" value="'.  trim(esc_attr($theme_update['user_name'])) .'" />';

	$html .= '<p>Your Themeforest API Key:</p>
	          <input type="text" name="shootback_theme_update[update_options][key_api]" value="'.  trim(esc_attr($theme_update['key_api'])) .'" />';

	if($update = check_for_theme_update()){
		$html .= '<p>You have update for your theme</p>';
	}

	echo $html;
}

function check_for_theme_update(){
	$updates = get_site_transient('update_themes');

	if(!empty($updates) && !empty($updates->response))
	{
		$theme = wp_get_theme();
		if($key = array_key_exists($theme->get_template(), $updates->response))
		{
			return $updates->response[$theme->get_template()];
		}
	}

	return false;

}
?>
