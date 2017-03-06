<?php
if ( ! defined( 'WPINC' ) ) {
	die('Nice try dude. But I am sorry');
}
/**
 * Fired during Feedjit plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       http://jkshoppie.com/product/feedjit
 * @since      1.0.0
 *
 * @package    FEEDJIT
 * @author     Joel James <me@joelsays.com>
 */

class FEEDJIT_Activator {
	
	/**
	 * Set default options on activate
	 *
	 * This function checks if the plugin data already
	 * exist in db. If not it will add default options
	 * and later user can change it through options page
	 * These are the default options provided by Feedjit.
	 *
	 * @since		1.0.0
	 * @modified	1.0.2
	 * @author		Joel James <me@joelsays.com>
	 */
	public static function activate() {
		
		if(!get_option('feedjit_settings')) {
			$options['feedjit_background_color']	= 'FFFFFF';
			$options['feedjit_header_color']		= '000000';
			$options['feedjit_border_color']		= '012B6B';
			$options['feedjit_l_text']				= '135D9E';
			$options['feedjit_h_text']				= 'FFFFFF';
			$options['feedjit_n_text']				= '2853A8';
			$options['feedjit_button_color']		= 'C99700';
			$options['feedjit_width']				= '250';
			$options['feedjit_visitors']			= '10';
			$feedjit_script							= '<script type="text/javascript" src="http://feedjit.com/serve/?vv=1515&amp;tft=3&amp;dd=0&amp;wid=&amp;pid=0&amp;proid=0&amp;bc=FFFFFF&amp;tc=000000&amp;brd1=012B6B&amp;lnk=135D9E&amp;hc=FFFFFF&amp;hfc=2853A8&amp;btn=C99700&amp;ww=300&amp;went=10"></script><noscript><a href="http://feedjit.com/">Live Traffic Stats</a></noscript>';
			add_option('feedjit_settings',$options);
			add_option('feedjit_script',$feedjit_script);
		}
	}

}
