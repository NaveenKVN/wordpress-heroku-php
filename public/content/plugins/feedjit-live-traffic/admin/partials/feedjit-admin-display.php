<?php
if ( ! defined( 'WPINC' ) ) {
	die('Nice try dude. But I am sorry');
}
/**
 * Provide a dashboard settings page for feedjit
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://jkshoppie.com/product/feedjit
 * @since      1.0.0
 *
 * @package    FEEDJIT
 * @subpackage FEEDJIT/admin/partials
 */


if ( ! isset( $_REQUEST['updated'] ) ) $_REQUEST['updated'] = false; ?>

	<div class="feedjit-container">
		<form method="post" action="options.php">
			<h2>Feedjit - Widget Customizer</h2> <hr/>
			<?php settings_fields( 'feedjit_settings' ); ?>
			<?php $options = get_option( 'feedjit_settings' ); ?>
			<?php if (!empty($options['feedjit_code'])) { ?>
			<?php } ?>
			<table>
				<tr valign="top"><td><h3>Customize Size</h3></td></tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_width]"><strong>Widget Width </strong></label>
					<input type="number" min="160" max="300" name="feedjit_settings[feedjit_width]" id="feedjit_settings[feedjit_width]" placeholder="Widget width" value="<?php echo $options['feedjit_width']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_visitors]"><strong>Number of visitors to show </strong></label>
					<input type="number" min="1" max="10" name="feedjit_settings[feedjit_visitors]" id="feedjit_settings[feedjit_visitors]" placeholder="No. of visitors to show" value="<?php echo $options['feedjit_visitors']; ?>" required /></td>
				</tr>
				<tr valign="top"><td><h3>Customize Colour Scheme</h3></td></tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_background_color]"><strong>Background </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_background_color]" id="feedjit_settings[feedjit_background_color]" value="<?php echo $options['feedjit_background_color']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_header_color]" ><strong>Header </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_header_color]" id="feedjit_settings[feedjit_header_color]" value="<?php echo $options['feedjit_header_color']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_border_color]" ><strong>Border </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_border_color]" id="feedjit_settings[feedjit_border_color]" value="<?php echo $options['feedjit_border_color']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_button_color]" ><strong>Button </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_button_color]" id="feedjit_settings[feedjit_button_color]" value="<?php echo $options['feedjit_button_color']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_h_text]" ><strong>Header Text </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_h_text]" id="feedjit_settings[feedjit_h_text]" value="<?php echo $options['feedjit_h_text']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_n_text]" ><strong>Normal Text </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_n_text]" id="feedjit_settings[feedjit_n_text]" value="<?php echo $options['feedjit_n_text']; ?>" required /></td>
				</tr>
				<tr valign="top">
					<td scope="row"><label for="feedjit_settings[feedjit_l_text]" ><strong>Link Text </strong></label>
					<input type="text" class="color" name="feedjit_settings[feedjit_l_text]" id="feedjit_settings[feedjit_l_text]" value="<?php echo $options['feedjit_l_text']; ?>" required /></td>
				</tr>
				
			</table>
			<p><input class="button-primary button" name="submit" id="submit" value="Save Changes" type="submit"></p>
		</form>
		<hr/><br/>
		<p>More features are coming soon. For more details about Feedjit, please <a href="http://feedjit.com/" target="_blank">click here</a>
	
	</div>
