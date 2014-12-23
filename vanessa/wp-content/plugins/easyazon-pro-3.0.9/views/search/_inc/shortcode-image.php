<div class="easyazon-process-shortcode-image" data-bind="visible: shortcodeImageStateActive">
	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeImage" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>

	<label class="setting">
		<span><?php _e('Alt Text'); ?></span>
		<input type="text" data-bind="value: shortcodeAltText" />
	</label>

	<label class="setting">
		<span><?php _e('Size'); ?></span>
		<select data-bind="options: shortcodeImages, optionsText: 'Size', value: shortcodeImageObject"></select>
	</label>

	<div class="easyazon-shortcode-image-preview-container setting">
		<img class="easyazon-shortcode-image-preview" data-bind="attr: { alt: shortcodeAltText, src: shortcodeImageObjectSrc, height: shortcodeImageObjectHeight, width: shortcodeImageObjectWidth }" />
	</div>

	<label class="setting">
		<span><?php _e('Alignment'); ?></span>
		<select data-bind="value: shortcodeAlignment">
			<option value="none"><?php _e('None'); ?></option>
			<option value="left"><?php _e('Left'); ?></option>
			<option value="center"><?php _e('Center'); ?></option>
			<option value="right"><?php _e('Right'); ?></option>
		</select>
	</label>

	<?php do_action('easyazon_shortcode_link_options', 'image'); ?>

	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeImage" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>
</div>