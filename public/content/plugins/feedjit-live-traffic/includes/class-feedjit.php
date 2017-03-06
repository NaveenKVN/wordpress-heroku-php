<?php
if ( ! defined( 'WPINC' ) ) {
	die('Nice try dude. But I am sorry');
}
/**
 * The core plugin class - Feedjit.
 *
 * This is used to define internationalization, dashboard-specific hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       http://jkshoppie.com/product/feedjit
 * @since      1.0.0
 * @package    FEEDJIT
 * @subpackage FEEDJIT/includes
 * @author     Joel James <me@joelsays.com>
 */
 
class Feedjit {
	
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_slug    The string used to uniquely identify this plugin.
	 */
	protected $plugin_slug;
	
	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard.
	 *
	 * @since		1.0.0
	 * @author		Joel James
	 */
	public function __construct() {

		$this->plugin_slug = 'feedjit';
		$this->version = '1.0.2';

		$this->load_dependencies();
		$this->define_admin_hooks();

	}
	
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - FEEDJIT_Loader. Orchestrates the hooks of the plugin.
	 * - FEEDJIT_Admin. Defines all hooks for the dashboard.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-feedjit-admin.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-feedjit-widget.php';
		
		require_once plugin_dir_path( __FILE__ ) . 'class-feedjit-loader.php';
		
		$this->loader = new FEEDJIT_Loader();

	}
	
	/**
	 * Defines all hooks for the dashboard.
	 * Register all of the hooks related to the dashboard functionality
	 * and widget of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @author	 Joel James
	 */
	private function define_admin_hooks() {

		$admin = new FEEDJIT_Admin( $this->get_version() );
		
		$this->loader->add_action('admin_menu', $admin, 'feedjit_create_menu');
		
		$this->loader->add_action( 'admin_init', $admin, 'feedjit_options_register' );
		
		$this->loader->add_action( 'widgets_init', $admin, 'feedjit_load_widget' );
		
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'feedjit_enqueue_scripts' );
		
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'feedjit_enqueue_style' );

	}
	
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 * @access	 public
	 * @author	 Joel James
	 */
	public function run() {
		$this->loader->run();
	}
	
	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @access	  public
	 * @author	  Joel James
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
