<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * Deleting this plugin related data from your dba_close
 * when plugin is un-installed (deleted).
 *
 * @link       http://www.jkshoppie.com
 * @since      1.0.0
 * @author	   Joel James<me@joelsays.com>
 *
 * @package    FEEDJIT
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option('feedjit_settings');
delete_option('feedjit_script');

/******* The end. Thanks for using this plugin ********/