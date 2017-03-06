<?php
if ( ! defined( 'WPINC' ) ) {
	die('Nice try dude. But I am sorry');
}
/**
 * The dashboard-specific functionality of the plugin - Feedjit.
 *
 * Defines the version, and other hooks for dashboard specific
 * functionalities.
 * Also adds admin options page display.
  *
 * @link       http://jkshoppie.com/product/feedjit
 * @since      1.0.0
 *
 * @package    FEEDJIT
 * @subpackage FEEDJIT/admin
 * @author     Joel James <me@joelsays.com>
 */
class FEEDJIT_Admin {

	/**
	* The unique identifier of this plugin.
	*
	* @since    1.0.0
	* @access   protected
	* @var      string    $plugin_slug    The string used to uniquely identify this plugin.
	*/
	
	protected $plugin_slug;
	/**
	* The version of this plugin.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $version    The current version of this plugin.
	*/
	
	private $version;
	
	/**
	* The output of ads.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $output    The content to output as ads.
	*/
	private $output;
	
	/**
	* The options from db.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $output    Get the options saved in db.
	*/
	private $options;

	/**
	* Initialize the class and set its properties.
	*
	* @since    1.0.0
	* @author	 Joel James
	* @var      string    $version    The version of this plugin.
	*/
	public function __construct( $version ) {
		$this->version 		= 	$version;
		$this->plugin_slug 	= 	'feedjit';
		$this->options 		=	get_option( 'feedjit_settings' );
		$this->feedjit_generate_output_code();
	}

	/**
	* Creating admin menu for Feedjit.
	*
	* @since    1.0.0
	* @author	 Joel James
	* @action	 hook	   add_options_page	  Action hook to add new admin menu.
	*/
	public function feedjit_create_menu() {
		add_options_page(
			'Feedjit Live Traffic',
			'Feedjit Live Traffic', 
			'manage_options', 
			'feedjit-settings', 
			array( $this, 'feedjit_options_page' ) 
		);
	}
	
	/**
	* Registering options.
	*
	* @since    1.0.0
	* @author	 Joel James
	* @action	 hooks 		register_setting       Hook to register options in db.
	*/
	public function feedjit_options_register(){
		register_setting( 
			'feedjit_settings', 
			'feedjit_settings' 
		);
	}

	/**
	* Admin options page display.
	*
	* Includes admin page contents to manage ad code
	* and other thing. Including an Html content page.
	*
	* @since    1.0.0
	* @author	 Joel James
	*/
	public function feedjit_options_page() {
		require plugin_dir_path( __FILE__ ) . 'partials/feedjit-admin-display.php';
	}
	
	/**
	* Register and load the widget.
	*
	* Function to register feedjit widget on
	* your WordPress site.
	*
	* @since    1.0.0
	* @author	Joel James
	*/
	public function feedjit_load_widget() {
		register_widget( 'feedjit_widget' );
	}
	
	/**
	* Register the JavaScript for the dashboard.
	*
	* @since    1.0.0
	* @author	 Joel James
	*/
	public function feedjit_enqueue_scripts() {

		wp_enqueue_script( 
			$this->plugin_slug, plugin_dir_url( __FILE__ ) . 'jscolor-library/jscolor.js', 
			array( 'jquery' ), 
			$this->version, false 
		);

	}
	
	/**
	* Register the CSS for the dashboard.
	*
	* @since    1.0.0
	* @author	 Joel James
	*/
	public function feedjit_enqueue_style() {

		wp_enqueue_style( 
			$this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/feedjit-admin.css', 
			array(), 
			$this->version, 'all' 
		);

	}
	
	/**
	* Generating JavaScript code for widget.
	*
	* Includes admin page options values to manage ad code
	* and other thing. Including an Html content page.
	*
	* @since    1.0.0
	* @author	 Joel James
	*/
	public function feedjit_generate_output_code() {
		$options = $this->options;
		if($options !=='') {
			$vv 	= 	'1515';
			$tft 	= 	'3';
			$dd 	= 	'0';
			$wid 	= 	'';
			$pid 	= 	'0';
			$proid 	= 	'0';
			$bc 	= 	$options['feedjit_background_color'];
			$tc 	= 	$options['feedjit_header_color'];
			$brd1 	= 	$options['feedjit_border_color'];
			$lnk 	= 	$options['feedjit_l_text'];
			$hc 	= 	$options['feedjit_h_text'];
			$hfc 	= 	$options['feedjit_n_text'];
			$btn 	= 	$options['feedjit_button_color'];
			$ww 	= 	$options['feedjit_width'];
			$wne 	= 	$options['feedjit_visitors'];
			$srefs 	= 	'0';
			
			$src = 'http://feedjit.com/serve/?vv='.$vv.'&amp;tft='.$tft.'&amp;dd='.$dd.'&amp;wid='.$wid.'&amp;pid='.$pid.'&amp;proid='.$proid.'&amp;bc='.$bc.'&amp;tc='.$tc.'&amp;brd1='.$brd1.'&amp;lnk='.$lnk.'&amp;hc='.$hc.'&amp;hfc='.$hfc.'&amp;btn='.$btn.'&amp;ww='.$ww.'&amp;wne='.$wne.'&amp;srefs='.$srefs.'';
			
			$script = '<script type="text/javascript" src="'.$src.'"></script><noscript><a href="http://feedjit.com/">Live Traffic Stats</a></noscript>';
			
			update_option('feedjit_script',$script);
		}
	}

}