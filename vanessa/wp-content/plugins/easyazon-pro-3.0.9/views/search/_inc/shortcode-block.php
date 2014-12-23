<div class="easyazon-process-shortcode-block" data-bind="visible: shortcodeBlockStateActive">
	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeBlock" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>

	<label class="setting">
		<span><?php _e('Layout'); ?></span>
		<select data-bind="value: shortcodeLayout">
			<option value="top"><?php _e('Image on Top, Text Below'); ?></option>
			<option value="left"><?php _e('Image on Left, Text on Right'); ?></option>
			<option value="right"><?php _e('Image on Right, Text on Left'); ?></option>
		</select>
	</label>

	<label class="setting">
		<span><?php _e('Alignment'); ?></span>
		<select data-bind="value: shortcodeAlignmentBlock">
			<option value="left"><?php _e('Left'); ?></option>
			<option value="center"><?php _e('Center'); ?></option>
			<option value="right"><?php _e('Right'); ?></option>
		</select>
	</label>

	<?php do_action('easyazon_shortcode_link_options', 'block'); ?>

	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeBlock" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>
</div>
