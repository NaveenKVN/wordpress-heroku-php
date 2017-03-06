<?php
if ( ! defined( 'WPINC' ) ) {
	die('Nice try dude. But I am sorry');
}
/**
 * Creating widget - Feedjit.
 *
 * Class function to create new widget for Feedji
 * live traffic.
 * Extends to WP_Widget WordPess class
 *
 * @link       http://jkshoppie.com/product/feedjit
 * @since      1.0.0
 *
 * @package    FEEDJIT
 * @subpackage FEEDJIT/admin
 * @author     Joel James <me@joelsays.com>
 */
class feedjit_widget extends WP_Widget {

	/**
	* The options from db.
	*
	* @since    1.0.0
	* @access   private
	* @var      string    $output    Get the options saved in db.
	*/
	private $options;
	/**
	* Initialize the widget class and set its properties.
	*
	* Setting Base ID of the widget
	* Setting widget name
	* Setting widget description
	*
	* @since    1.0.0
	* @author	Joel James
	* @var      string    $version    The version of this plugin.
	*/
	function __construct() {
		parent::__construct(
			'feedjit_widget', 
			__('Feedjit Widget', 'feedjit_widget_domain'), 
			array( 'description' => __( 'Feedjit widget to show live traffic details on this website', 'feedjit_widget_domain' ), ) 
		);
		$this->options 	= get_option( 'feedjit_script' );
	}

	/**
	* Creating widget front-end.
	*
	* This function will display widget frontend
	* contents and widget actions will be happening here
	*
	* @since    1.0.0
	* @author	Joel James
	*/
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
			
		echo $this->options;
		
		echo $args['after_widget'];
	}
			
	/**
	* Creating widget backend.
	*
	* This function will display widget on
	* backend and will enable users to change
	* widget title.
	*
	* @since    1.0.0
	* @author	Joel James
	*/
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Feedjit Widget', 'feedjit_widget_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>You can customize the widget look and feel <a href="<?php echo admin_url( 'options-general.php?page=feedjit-settings'); ?>">here</a></p>
		<?php 
	}
		
	/**
	* Updating widget replacing old instances with new.
	*
	* @since    1.0.0
	* @author	Joel James
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}