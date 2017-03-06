<div class="row-settings-editor">
<table>
	<tr>
		<td valign="top" width="30%"><?php _e( 'Row ID', 'shootback' ); ?></td>
		<td width="60%">
			#ts_<input type="text" name="row-name-id" id="row-name-id" value="" />
			<div class="ts-option-description">
			    <?php _e('If you are using the one-page layout - use this for your links.', 'shootback'); ?> (#ts_YOUR-ID-HERE) 
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php _e( 'Background color', 'shootback' ); ?></td>
		<td>
			<input class="colors-section-picker" type="text" name="row-background-color" id="row-background-color" value="" />
			<div  class="colors-section-picker-div"  id="row-background-color-picker"></div>
			<div class="ts-option-description">
			    <?php _e('Choose the background color for your row. Unless you are using the boxed layout, the background will go from one edge of the screen to another.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php _e( 'Text color', 'shootback' ); ?></td>
		<td>
			<input class="colors-section-picker"  type="text" name="row-text-color" id="row-text-color" value="" />
			<div class="colors-section-picker-div"  id="row-text-color-picker"></div>
			<div class="ts-option-description">
			    <?php _e('Choose the text color for your row. This might not affect all elements in this row, some colors might be overwritten by some theme or builder element options', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background image', 'shootback' ); ?></td>
		<td><input type="text" name="row-bg-image" id="row-bg-image" value="" />
			<input type="hidden" id="slide_media_id_image" name="row_media_id_image" value="" />
			<input class="ts-upload-row-image button" type="button" value="<?php _e( 'Upload image', 'shootback' ); ?>" />

			<div class="ts-option-description">
			    <?php _e('Add a background image to your row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background video .mp4', 'shootback' ); ?></td>
		<td><input type="text" name="row-bg-video-mp" id="row-bg-video-mp" value="" />
			<input type="hidden" id="slide_media_id_video_mp" name="row_media_id_video_mp" value="" />
			<input class="ts-upload-row-video-mp button" type="button" value="<?php _e( 'Upload video', 'shootback' ); ?>" />
			<div class="ts-option-description">
			    <?php _e('Add a background video to your row. We strongly recommend to use muted videos, since there is no way to stop, pause or mute a background video. Use the MP4 format here for some browsers.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background video .webm', 'shootback' ); ?></td>
		<td><input type="text" name="row-bg-video_webm" id="row-bg-video-webm" value="" />
			<input type="hidden" id="slide_media_id_video_webm" name="row_media_id_video_webm" value="" />
			<input class="ts-upload-row-video-webm button" type="button" value="<?php _e( 'Upload video', 'shootback' ); ?>" /> 
			<div class="ts-option-description">
			    <?php _e('Add a background video to your row. We strongly recommend to use muted videos, since there is no way to stop, pause or mute a background video. Use the WEBM format here for some browsers.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Enable parallax', 'shootback' ); ?> </td>
		<td>
			<select <?php disabled(fields::get_options_value('shootback_optimization', 'include_parallax_background'), 'n', true) ?> name="row-parallax" id="row-parallax">
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
				<option selected="selected" value="no"><?php _e('No', 'shootback') ?></option>
			</select>

			<div class="ts-option-description">
			    <?php _e('If you have a background image set, this will create a cool parallax efect for the background image of this specifc row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Enable show mask', 'shootback' ); ?> </td>
		<td>
			<select name="row-mask" id="row-mask">
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
				<option value="no"><?php _e('No', 'shootback') ?></option>
			</select>

			<div class="ts-option-description">
			    <?php _e('If you have a background image or a background video for this row, but some of the elements or some text cannot be read, add a row mask. This will place a mask over the background, but under the row contents.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr id="ts_mask_opacity">
		<label for="row-opacity"><td valign="top"><?php _e( 'Opacity', 'shootback' ); ?></td></label>
		<td>
			<input type="text" name="row-opacity" id="row-opacity" value="" readonly  />
			<div id="row-opacity-slider"></div>
			<div class="ts-option-description">
			    <?php _e('Select the opacity of the color mask. You can set anything from 1 to 100.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr id="ts_mask_color">
		<td valign="top">
			<?php _e( 'Color mask', 'shootback' ); ?>
		</td>
		<td>
			<input class="colors-section-picker" type="text" name="row-mask-color" id="row-mask-color" value="" />
			<div class="colors-section-picker-div" id="row-mask-color-picker"></div>
			<div class="ts-option-description">
			    <?php _e('Select the color of the mask that you want applied over the background of the row. Make sure you adapt it right with the opacity.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background postition', 'shootback' ); ?></td>
		<td>
			<select name="row-bg-position" id="row-bg-position">
				<option value="left"><?php _e( 'Left', 'shootback' ); ?></option>
				<option value="center"><?php _e( 'Center', 'shootback' ); ?></option>
				<option value="right"><?php _e( 'Right', 'shootback' ); ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('Select the background position for background image of the row. Vertically the image will always be centered.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background attachment', 'shootback' ); ?></td>
		<td>
			<select name="row-bg-attachement" id="row-bg-attachement">
				<option value="fixed"><?php _e( 'Fixed', 'shootback' ); ?></option>
				<option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('You can make the background of this specific row scroll with the content when you scroll down or up, or make it fixed so it makes the website feel like it has a hole in it.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background repeat', 'shootback' ); ?> </td>
		<td>
			<select name="row-bg-repeat" id="row-bg-repeat">
				<option value="repeat"><?php _e( 'Repeat', 'shootback' ); ?></option>
				<option value="no-repeat"><?php _e( 'No-repeat', 'shootback' ); ?></option>
				<option value="repeat-x"><?php _e( 'Horizontaly', 'shootback' ); ?></option>
				<option value="repeat-y"><?php _e( 'Verticaly', 'shootback' ); ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('Select how do you want the background image to be repeated.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background size', 'shootback' ); ?> </td>
		<td>
			<select name="row-bg-size" id="row-bg-size">
				<option value="auto"><?php _e( 'Auto', 'shootback' ); ?></option>
				<option value="cover"><?php _e( 'Cover', 'shootback' ); ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('If you are using a background image, select the background size that you want. You can have it auto so it will keep the image size that you have uploaded or set it cover, so it makes sure that image will fill the row vertically and horizontally. Keep in mind that the second option could crop bits of your image.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Margin top', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="margin-top" id="row-margin-top" value="0"> px
			<div class="ts-option-description">
			    <?php _e('Set a margin top for your row. Margins will set a certain amout of space above this row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Margin bottom', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="margin-top" id="row-margin-bottom" value="30"> px
			<div class="ts-option-description">
			    <?php _e('Set a margin bottom for your row. Margins will set a certain amout of space below this row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Padding top', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="padding-top" id="row-padding-top" value="0"> px
			<div class="ts-option-description">
			    <?php _e('Set a padding top for your row. Padding top will set a certain amout of space inside the row, but from the top. So you can add blank space inside the row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Padding bottom', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="padding-bottom" id="row-padding-bottom" value="0"> px
			<div class="ts-option-description">
			    <?php _e('Set a padding bottom for your row. Padding bottom will set a certain amout of space inside the row, but from the bottom. So you can add blank space inside the row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Special effects', 'shootback' ); ?> </td>
		<td>
			<select name="special-effects" id="special-effects">
				<option value="no"><?php _e('None', 'shootback') ?></option>
				<option value="slideup"><?php _e('Slide up', 'shootback') ?></option>
				<option value="perspective-x"><?php _e('Perspective X', 'shootback') ?></option>
				<option value="perspective-y"><?php _e('Perspective Y', 'shootback') ?></option>
				<option value="opacited"><?php _e('Opacity', 'shootback') ?></option>
				<option value="slideright"><?php _e('Slide right', 'shootback') ?></option>
				<option value="slideleft"><?php _e('Slide left', 'shootback') ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('You can choose a certain animation for articles that are inside this row. Keep in mind that not all elements inside the row can be animated.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Text align', 'shootback' ); ?> </td>
		<td>
			<select name="text-align" id="text-align">
				<option value="auto"><?php _e('Auto', 'shootback') ?></option>
				<option value="left"><?php _e('Left', 'shootback') ?></option>
				<option value="center"><?php _e('Center', 'shootback') ?></option>
				<option value="right"><?php _e('Right', 'shootback') ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('You can select the align of the text inside this row. Keep in mind that some element aligns are hardcoded and you cannot change them.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Enable box shadow', 'shootback' ); ?> </td>
		<td>
			<select name="row-shadow" id="row-shadow">
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
				<option value="no"><?php _e('No', 'shootback') ?></option>
			</select>

			<div class="ts-option-description">
			    <?php _e('If you enable this option, it will add a subtle box shadow inside the row edges.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Expand row', 'shootback' ); ?> </td>
		<td>
			<ul class="imageRadioMetaUl perRow-4 ts-custom-selector" data-selector="#expand-row" id="expand-row-selector">
               <li><img class="image-radio-input clickable-element" data-option="yes" src="<?php echo get_template_directory_uri().'/images/options/expand_row_yes.png'; ?>"></li>
               <li><img class="image-radio-input clickable-element" data-option="no" src="<?php echo get_template_directory_uri().'/images/options/expand_row_no.png'; ?>"></li>
            </ul>
			<select class="hidden" name="expand-row" id="expand-row">
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
				<option value="no"><?php _e('No', 'shootback') ?></option>
			</select>
			<div class="ts-option-description">
			    <?php _e('Once you decide to expand this row, all the content inside will go from one edge of the screen to another. (If you are not using the boxed version). Mostly used for sliders.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Fullscreen row', 'shootback' ); ?> </td>
		<td>
			<ul class="imageRadioMetaUl perRow-4 ts-custom-selector" data-selector="#fullscreen-row" id="fullscreen-row-selector">
               <li><img class="image-radio-input clickable-element" data-option="no" src="<?php echo get_template_directory_uri().'/images/options/fullscreen_row_no.png'; ?>"></li>
               <li><img class="image-radio-input clickable-element" data-option="yes" src="<?php echo get_template_directory_uri().'/images/options/fullscreen_row_yes.png'; ?>"></li>
            </ul>
			<select name="fullscreen-row" id="fullscreen-row">
				<option value="no"><?php _e('No', 'shootback') ?></option>
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
			</select>

			<div class="ts-option-description">
			    <?php _e('If you want a row that will cover the whole screen, this is the option. Once you set it to fullscreen it will resize the row so that it fits the screen of the user. This will not expand your content though.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr class="ts_vertical_align">
		<td><?php _e( 'Vertical align', 'shootback' ); ?></td>
		<td>
			<select name="row-vertical-align" id="row-vertical-align">
				<option value="top"><?php _e('Top', 'shootback') ?></option>
				<option value="middle"><?php _e('Middle', 'shootback') ?></option>
				<option value="bottom"><?php _e('Bottom', 'shootback') ?></option>
			</select>

			<div class="ts-option-description">
			    <?php _e('If you have the fullscreen row option selected, you can decide where should the content from this row be aligned vertically. You can center it, keep it on the top or stick it to the bottom.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr class="ts_scroll_nag">
		<td><?php _e( 'Scroll down button', 'shootback' ); ?></td>
		<td>
			<select name="scroll-down-button" id="scroll-down-button">
				<option value="no"><?php _e('No', 'shootback') ?></option>
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
			</select>

			<div class="ts-option-description">
			    <?php _e('This will add a small buttom at the bottom of the row that will show the users to scroll down and once clicked, it will scroll the browser just below the row.', 'shootback'); ?>.
			</div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Custom css', 'shootback' ); ?></td>
		<td>
			<textarea name="row-custom-css" id="row-custom-css" cols="50" rows="5"></textarea>
		</td>
	</tr>
</table>
<input type="button" class="button-primary save-element" value="<?php _e( 'Save changes', 'shootback' ); ?>" id="save-row-settings"/>
</div>
	<script>
	jQuery(document).ready(function($) {

		var modalWindow = $('#ts-builder-elements-modal', document),
		row = window.currentEditedRow,

		rowName = row.attr("data-name-id") ? row.attr("data-name-id") : '',
		bgColor = row.attr("data-bg-color") ? row.attr("data-bg-color") : '',
		textColor = row.attr("data-text-color") ? row.attr("data-text-color") : '',
		rowMaskColor = row.attr("data-mask-color") ? row.attr("data-mask-color") : '',
		rowOpacity = row.attr("data-opacity") ? row.attr("data-opacity") : '',
		bgImage = row.attr("data-bg-image") ? row.attr("data-bg-image") : '',
		bgVideoMp = row.attr("data-bg-video-mp") ? row.attr("data-bg-video-mp") : '',
		bgVideoWebm = row.attr("data-bg-video-webm") ? row.attr("data-bg-video-webm") : '',
		bgPosition = row.attr("data-bg-position") ? row.attr("data-bg-position") : '',
		bgAttachement = row.attr("data-bg-attachment") ? row.attr("data-bg-attachment") : '',
		bgRepeat = row.attr("data-bg-repeat") ? row.attr("data-bg-repeat") : '',
		bgSize = row.attr("data-bg-size") ? row.attr("data-bg-size") : '',
		rowMarginTop = row.attr("data-margin-top") ? row.attr("data-margin-top") : '0',
		rowMarginBottom = row.attr("data-margin-bottom") ? row.attr("data-margin-bottom") : '30',
		rowPaddingTop = row.attr("data-padding-top") ? row.attr("data-padding-top") : '0',
		rowPaddingBottom = row.attr("data-padding-bottom") ? row.attr("data-padding-bottom") : '0',
		expandRow = row.attr("data-expand-row") ? row.attr("data-expand-row") : 'no',
		specialEffects = row.attr("data-special-effects") ? row.attr("data-special-effects") : 'none';
		rowTextAlign = row.attr("data-text-align") ? row.attr("data-text-align") : 'auto';
		fullscreenRow = row.attr("data-fullscreen-row") ? row.attr("data-fullscreen-row") : 'no';
		rowMask = row.attr("data-mask") ? row.attr("data-mask") : 'no';
		rowShadow = row.attr("data-shadow") ? row.attr("data-shadow") : 'no';
		rowVerticalAlign = row.attr("data-vertical-align") ? row.attr("data-vertical-align") : 'top';
		scrollDownButton = row.attr("data-scroll-down-button") ? row.attr("data-scroll-down-button") : 'no';
		rowParallax = row.attr("data-parallax") ? row.attr("data-parallax") : 'no';
		customCss = row.attr("data-custom-css") ? row.attr("data-custom-css") : '';
	
		// repopulate row settings
		modalWindow.find('#row-name-id').val(rowName);
		modalWindow.find('#row-background-color').val(bgColor);
		modalWindow.find('#row-text-color').val(textColor);
		modalWindow.find('#row-mask-color').val(rowMaskColor);
		modalWindow.find('#row-opacity').val(rowOpacity);
		ts_slider_pips(1, 100, 1, rowOpacity, 'row-opacity-slider', 'row-opacity');
		modalWindow.find('#row-bg-image').val(bgImage);
		modalWindow.find('#row-bg-video-mp').val(bgVideoMp);
		modalWindow.find('#row-bg-video-webm').val(bgVideoWebm);
		modalWindow.find('#row-custom-css').val(customCss);

		modalWindow.find('#row-bg-position option').filter(function() {
			return $(this).val() == bgPosition; 
		}).prop('selected', true);

		modalWindow.find('#row-bg-attachement option').filter(function() {
			return $(this).val() == bgAttachement; 
		}).prop('selected', true);

		modalWindow.find('#row-bg-repeat option').filter(function() {
			return $(this).val() == bgRepeat; 
		}).prop('selected', true)
		;
		modalWindow.find('#row-bg-size option').filter(function() {
			return $(this).val() == bgSize; 
		}).prop('selected', true)
		;

		modalWindow.find('#row-margin-top').val(rowMarginTop);
		modalWindow.find('#row-margin-bottom').val(rowMarginBottom);
		modalWindow.find('#row-padding-top').val(rowPaddingTop);
		modalWindow.find('#row-padding-bottom').val(rowPaddingBottom);

		modalWindow.find('#expand-row option').filter(function() {
			return $(this).val() == expandRow; 
		}).prop('selected', true);

		modalWindow.find('#special-effects option').filter(function() {
			return $(this).val() == specialEffects; 
		}).prop('selected', true);

		modalWindow.find('#row-mask option').filter(function() {
			return $(this).val() == rowMask; 
		}).prop('selected', true);

		modalWindow.find('#row-shadow option').filter(function() {
			return $(this).val() == rowShadow; 
		}).prop('selected', true);

		modalWindow.find('#fullscreen-row option').filter(function() {
			return $(this).val() == fullscreenRow; 
		}).prop('selected', true);

		modalWindow.find('#text-align option').filter(function() {
			return $(this).val() == rowTextAlign; 
		}).prop('selected', true);

		modalWindow.find('#row-vertical-align option').filter(function() {
			return $(this).val() == rowVerticalAlign; 
		}).prop('selected', true);

		modalWindow.find('#scroll-down-button option').filter(function() {
			return $(this).val() == scrollDownButton; 
		}).prop('selected', true);

		modalWindow.find('#row-parallax option').filter(function() {
			return $(this).val() == rowParallax; 
		}).prop('selected', true);

		function ts_show_proprety_mask(){

			$('#ts_mask_color').hide();
			$('#ts_mask_opacity').hide();
			$('#row-mask').change(function(){
				if( $(this).val() == 'no' ){
					$('#ts_mask_color').hide();
					$('#ts_mask_opacity').hide();
				}else{
					$('#ts_mask_color').show();
					$('#ts_mask_opacity').show();
				}
			});

			if( $('#row-mask').val() == 'yes' ){
				$('#ts_mask_color').show();
				$('#ts_mask_opacity').show();
			}
		}
		ts_show_proprety_mask();

		function ts_upload_file(class_button,library,curent_row_id,prefix_button_id,input_hidden_id,input_attachment_id,text_button){

			var custom_uploader = {};
			if (typeof wp.media.frames.file_frame == 'undefined') {
				wp.media.frames.file_frame = {};
			}
			$(class_button).attr('id', prefix_button_id + 'button'+ curent_row_id);
			// Upload background image
			$(document).on('click', '#' + prefix_button_id + 'button'+ curent_row_id, function(e) {
				e.preventDefault();
				var _this     = $(this),
				target_id = _this.attr('id'),
				media_id  = _this.closest('td').find(input_hidden_id).val();

				//If the uploader object has already been created, reopen the dialog
				if (custom_uploader[target_id]) {
					custom_uploader[target_id].open();
					return;
				}

				//Extend the wp.media object
				custom_uploader[target_id] = wp.media.frames.file_frame[target_id] = wp.media({
					title: text_button,
					button: {
						text: text_button
					},
					library: {
						type: library
					},
					multiple: false,
					selection: [media_id]
				});

				//When a file is selected, grab the URL and set it as the text field's value
				custom_uploader[target_id].on('select', function() {
					var attachment = custom_uploader[target_id].state().get('selection').first().toJSON();
					var slide = _this.closest('table');
					slide.find(input_attachment_id).val(attachment.url);
					slide.find(input_hidden_id).val(attachment.id);
				});

				//Open the uploader dialog
				custom_uploader[target_id].open();
			});
		}
		ts_upload_file('.ts-upload-row-image','image',window.currentSetId,'ts_image','#slide_media_id_image','#row-bg-image','Upload image');
		ts_upload_file('.ts-upload-row-video-mp','webm',window.currentSetId,'ts_video_mp','#slide_media_id_video_mp','#row-bg-video-mp','Upload video mp4');
		ts_upload_file('.ts-upload-row-video-webm','webm',window.currentSetId,'ts_video_webm','#slide_media_id_video_webm','#row-bg-video-webm','Upload video webm');

		function custom_selectors(selector, targetselect){
            selector_option = jQuery(selector).attr('data-option');
            jQuery(selector).parent().parent().find('.selected').removeClass('selected');
            jQuery(targetselect).find('option[selected="selected"]').removeAttr('selected');
            jQuery(targetselect).find('option[value="' + selector_option + '"]').attr('selected','selected');
            jQuery(selector).parent().addClass('selected');
        }

        function custom_selectors_run(){
            jQuery('.ts-custom-selector').each(function(){
                the_selector = jQuery(this).attr('data-selector');
                the_selector_value = jQuery(the_selector + ' option[selected="selected"]').attr('value');
                selected_class = jQuery(this).find('[data-option="' + the_selector_value + '"]').attr('data-option');
                jQuery(this).find('[data-option="' + selected_class + '"]').parent().addClass('selected');

                var firstchild = jQuery(this).children('li:first'),
                    bool = false;

				if(jQuery(this).children().hasClass('selected') == false){
					firstchild.addClass('selected');
					bool = true;
					if(bool == true){
					    jQuery(the_selector + ' li .clickable-element:first-child').trigger('click');
					}
                }else{
                	return true;
                }
            });
        }

        jQuery('.ts-custom-selector').each(function(){
            var data_select = jQuery(this).attr('data-selector');
            jQuery(data_select).addClass('hidden');
        });

        function restartColorPickers(){
          var pickers = jQuery('.colors-section-picker-div');
          jQuery.each(pickers, function( index, value ) {
            jQuery(this).farbtastic(jQuery(this).prev());
          });
        }
        setTimeout(function(){
            custom_selectors_run();
        },200);

        jQuery('.clickable-element').click(function(){
            data_selector = jQuery(this).parent().parent().attr('data-selector');
            custom_selectors(jQuery(this), data_selector);
            jQuery(data_selector).trigger('change');
        });

        if( expandRow ){
        	jQuery('#expand-row option').each(function(){
        		jQuery(this).val() == expandRow ? jQuery(this).attr('selected','selected') : '';
        	})
        }
        if( fullscreenRow ){
        	jQuery('#fullscreen-row option').each(function(){
        		jQuery(this).val() == fullscreenRow ? jQuery(this).attr('selected','selected') : '';
        	})
        }

		function ts_show_hide_fullscreen_row_options(){

			jQuery('#fullscreen-row').change(function(){
				if( jQuery(this).val() == 'no' ){
					jQuery('.ts_vertical_align').css({'display':'none'});
				}else{
					jQuery('.ts_vertical_align').css({'display':''});
				}
			});

			if( jQuery('#fullscreen-row').val() == 'no' ){
				jQuery('.ts_vertical_align').css({'display':'none'});
			}else{
				jQuery('.ts_vertical_align').css({'display':''});
			}

			jQuery('#fullscreen-row').change(function(){
				if( jQuery(this).val() == 'no' ){
					jQuery('.ts_scroll_nag').css({'display':'none'});
				}else{
					jQuery('.ts_scroll_nag').css({'display':''});
				}
			});

			if( jQuery('#fullscreen-row').val() == 'no' ){
				jQuery('.ts_scroll_nag').css({'display':'none'});
			}else{
				jQuery('.ts_scroll_nag').css({'display':''});
			}

		}
		ts_show_hide_fullscreen_row_options();


		// Color pickers
		if (jQuery('.colors-section-picker-div').length) {
		    jQuery('.colors-section-picker-div').hide();

		    jQuery(".colors-section-picker").click(function(e){
		        e.stopPropagation();
		        jQuery(jQuery(this).next()).show();
		    });
		    
		    var pickers = jQuery('.colors-section-picker-div');
		    setTimeout(function(){
		        jQuery.each(pickers, function( index, value ) {
		            jQuery(this).farbtastic(jQuery(this).prev());
		        });
		    },100);
		    jQuery('body').click(function() {
		        jQuery(pickers).hide();
		    });
		}
		
	});
	</script>
