<div class="column-settings-editor">
<table>
	<tr>
		<td valign="top"><?php _e( 'Column ID', 'shootback' ); ?></td>
		<td>
			#ts_<input type="text" name="column-name-id" id="column-name-id" value="" />
			<div>
				<small><?php _e('(#ts_YOUR-ID-HERE)', 'shootback'); ?></small>
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php _e( 'Background color', 'shootback' ); ?></td>
		<td>
			<input class="colors-section-picker" type="text" name="column-background-color" id="column-background-color" value="#FFFFFF" />
			<div  class="colors-section-picker-div"></div>
		</td>
	</tr>
	<tr>
		<td valign="top"><?php _e( 'Text color', 'shootback' ); ?></td>
		<td>
			<input class="colors-section-picker"  type="text" name="column-text-color" id="column-text-color" value="#000000" />
			<div class="colors-section-picker-div"  id="column-text-color-picker"></div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background image', 'shootback' ); ?></td>
		<td><input type="text" name="column-bg-image" id="column-bg-image" value="" />
			<input type="hidden" id="slide_media_id_image" name="column_media_id_image" value="" />
			<input class="ts-upload-column-image button" type="button" value="<?php _e( 'Upload image', 'shootback' ); ?>" /> 
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background video .mp4', 'shootback' ); ?></td>
		<td><input type="text" name="column-bg-video-mp" id="column-bg-video-mp" value="" />
			<input type="hidden" id="slide_media_id_video_mp" name="column_media_id_video_mp" value="" />
			<input class="ts-upload-column-video-mp button" type="button" value="<?php _e( 'Upload video', 'shootback' ); ?>" /> 
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background video .webm', 'shootback' ); ?></td>
		<td><input type="text" name="column-bg-video_webm" id="column-bg-video-webm" value="" />
			<input type="hidden" id="slide_media_id_video_webm" name="column_media_id_video_webm" value="" />
			<input class="ts-upload-column-video-webm button" type="button" value="<?php _e( 'Upload video', 'shootback' ); ?>" /> 
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Enable show mask', 'shootback' ); ?> </td>
		<td>
			<select name="column-mask" id="column-mask">
				<option value="yes"><?php _e('Yes', 'shootback') ?></option>
				<option value="no"><?php _e('No', 'shootback') ?></option>
			</select>
		</td>
	</tr>
	<tr id="ts_mask_opacity">
		<td valign="top"><?php _e( 'Opacity', 'shootback' ); ?></td>
		<td>
			<input type="text" name="column-opacity" id="column-opacity" value="" />%
		</td>
	</tr>
	<tr id="ts_mask_color">
		<td valign="top">
			<?php _e( 'Color mask', 'shootback' ); ?>
		</td>
		<td>
			<input class="colors-section-picker" type="text" name="column-mask-color" id="column-mask-color" value="" />
			<div class="colors-section-picker-div" id="column-mask-color-picker"></div>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background postition', 'shootback' ); ?></td>
		<td>
			<select name="column-bg-position" id="column-bg-position">
				<option value="left"><?php _e( 'Left', 'shootback' ); ?></option>
				<option value="center"><?php _e( 'Center', 'shootback' ); ?></option>
				<option value="right"><?php _e( 'Right', 'shootback' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background attachment', 'shootback' ); ?></td>
		<td>
			<select name="column-bg-attachement" id="column-bg-attachement">
				<option value="fixed"><?php _e( 'Fixed', 'shootback' ); ?></option>
				<option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background repeat', 'shootback' ); ?> </td>
		<td>
			<select name="column-bg-repeat" id="column-bg-repeat">
				<option value="repeat"><?php _e( 'Repeat', 'shootback' ); ?></option>
				<option value="no-repeat"><?php _e( 'No-repeat', 'shootback' ); ?></option>
				<option value="repeat-x"><?php _e( 'Horizontaly', 'shootback' ); ?></option>
				<option value="repeat-y"><?php _e( 'Verticaly', 'shootback' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Background size', 'shootback' ); ?> </td>
		<td>
			<select name="column-bg-size" id="column-bg-size">
				<option value="auto"><?php _e( 'Auto', 'shootback' ); ?></option>
				<option value="cover"><?php _e( 'Cover', 'shootback' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Padding top', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="padding-top" id="column-padding-top" value="0"> px
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Padding bottom', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="padding-bottom" id="column-padding-bottom" value="0"> px
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Padding left', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="padding-left" id="column-padding-left" value="20"> px
		</td>
	</tr>
	<tr>
		<td><?php _e( 'Padding right', 'shootback' ); ?> </td>
		<td>
			<input type="text" name="padding-right" id="column-padding-right" value="20"> px
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
		</td>
	</tr>
</table>
<input type="button" class="button-primary save-element" value="<?php _e( 'Save changes', 'shootback' ); ?>" id="save-column-settings"/>
</div>

<script>
	jQuery(document).ready(function($) {

		var modalWindow = $('#ts-builder-elements-modal', document),
			column = window.currentEditedColumn,

			columnName = column.attr("data-name-id") ? column.attr("data-name-id") : '',
			bgColor = column.attr("data-bg-color") ? column.attr("data-bg-color") : '#FFFFFF',
			textColor = column.attr("data-text-color") ? column.attr("data-text-color") : '#000000',
			columnMaskColor = column.attr("data-mask-color") ? column.attr("data-mask-color") : '#fff',
			columnOpacity = column.attr("data-opacity") ? column.attr("data-opacity") : '',
			bgImage = column.attr("data-bg-image") ? column.attr("data-bg-image") : '',
			bgVideoMp = column.attr("data-bg-video-mp") ? column.attr("data-bg-video-mp") : '',
			bgVideoWebm = column.attr("data-bg-video-webm") ? column.attr("data-bg-video-webm") : '',
			bgPosition = column.attr("data-bg-position") ? column.attr("data-bg-position") : '',
			bgAttachement = column.attr("data-bg-attachment") ? column.attr("data-bg-attachment") : '',
			bgRepeat = column.attr("data-bg-repeat") ? column.attr("data-bg-repeat") : '',
			bgSize = column.attr("data-bg-size") ? column.attr("data-bg-size") : '',
			columnPaddingTop = column.attr("data-padding-top") ? column.attr("data-padding-top") : '0',
			columnPaddingBottom = column.attr("data-padding-bottom") ? column.attr("data-padding-bottom") : '0',
			columnPaddingLeft = column.attr("data-padding-left") ? column.attr("data-padding-left") : '20',
			columnPaddingRight = column.attr("data-padding-right") ? column.attr("data-padding-right") : '20',
			columnTextAlign = column.attr("data-text-align") ? column.attr("data-text-align") : 'auto';
			columnMask = column.attr("data-mask") ? column.attr("data-mask") : 'no';

	
		// repopulate column settings
		modalWindow.find('#column-name-id').val(columnName);
		modalWindow.find('#column-background-color').val(bgColor);
		modalWindow.find('#column-text-color').val(textColor);
		modalWindow.find('#column-mask-color').val(columnMaskColor);
		modalWindow.find('#column-opacity').val(columnOpacity);
		modalWindow.find('#column-bg-image').val(bgImage);
		modalWindow.find('#column-bg-video-mp').val(bgVideoMp);
		modalWindow.find('#column-bg-video-webm').val(bgVideoWebm);

		modalWindow.find('#column-bg-position option').filter(function() {
			return $(this).val() == bgPosition; 
		}).prop('selected', true);

		modalWindow.find('#column-bg-attachement option').filter(function() {
			return $(this).val() == bgAttachement; 
		}).prop('selected', true);

		modalWindow.find('#column-bg-repeat option').filter(function() {
			return $(this).val() == bgRepeat; 
		}).prop('selected', true)
		;
		modalWindow.find('#column-bg-size option').filter(function() {
			return $(this).val() == bgSize; 
		}).prop('selected', true)
		;

		modalWindow.find('#column-padding-top').val(columnPaddingTop);
		modalWindow.find('#column-padding-bottom').val(columnPaddingBottom);
		modalWindow.find('#column-padding-left').val(columnPaddingLeft);
		modalWindow.find('#column-padding-right').val(columnPaddingRight);

		modalWindow.find('#column-mask option').filter(function() {
			return $(this).val() == columnMask; 
		}).prop('selected', true);

		modalWindow.find('#text-align option').filter(function() {
			return $(this).val() == columnTextAlign; 
		}).prop('selected', true);

		function ts_show_proprety_mask(){

			$('#ts_mask_color').hide();
			$('#ts_mask_opacity').hide();
			$('#column-mask').change(function(){
				if( $(this).val() == 'no' ){
					$('#ts_mask_color').hide();
					$('#ts_mask_opacity').hide();
				}else{
					$('#ts_mask_color').show();
					$('#ts_mask_opacity').show();
				}
			});

			if( $('#column-mask').val() == 'yes' ){
				$('#ts_mask_color').show();
				$('#ts_mask_opacity').show();
			}
		}
		ts_show_proprety_mask();

		function ts_upload_file(class_button,library,curent_column_id,prefix_button_id,input_hidden_id,input_attachment_id,text_button){

			var custom_uploader = {};
			if (typeof wp.media.frames.file_frame == 'undefined') {
				wp.media.frames.file_frame = {};
			}
			$(class_button).attr('id', prefix_button_id + 'button'+ curent_column_id);
			// Upload background image
			$(document).on('click', '#' + prefix_button_id + 'button'+ curent_column_id, function(e) {
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
		ts_upload_file('.ts-upload-column-image','image',window.currentSetId,'ts_image','#slide_media_id_image','#column-bg-image','Upload image');
		ts_upload_file('.ts-upload-column-video-mp','webm',window.currentSetId,'ts_video_mp','#slide_media_id_video_mp','#column-bg-video-mp','Upload video mp4');
		ts_upload_file('.ts-upload-column-video-webm','webm',window.currentSetId,'ts_video_webm','#slide_media_id_video_webm','#column-bg-video-webm','Upload video webm');

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
