<div class="easyazon-process-shortcode-call-to-action" data-bind="visible: shortcodeCallToActionStateActive">
	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeCallToAction" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>

	<span class="setting">
		<span><?php _e('Alt Text'); ?></span>
		<input type="text" data-bind="value: shortcodeAltText" />
	</span>

	<label class="setting">
		<span><?php _e('Button'); ?></span>
		<div data-bind="foreach: { data: shortcodeCallsToAction, as: 'callToAction' }">
			<label class="setting">
				<div class="easyazon-radio-container">
					<input class="easyazon-radio" type="radio" data-bind="checked: $parent.shortcodeCallToActionKey, value: callToAction.key" />
					<img alt="" class="easyazon-radio-container-image" data-bind="attr: { height: callToAction.height, src: callToAction.url, width: callToAction.width }"/>
				</div>
			</label>
		</div>
	</label>

	<label class="setting">
		<span><?php _e('Alignment'); ?></span>
		<select data-bind="value: shortcodeAlignment">">
			<option value="none"><?php _e('None'); ?></option>
			<option value="left"><?php _e('Left'); ?></option>
			<option value="center"><?php _e('Center'); ?></option>
			<option value="right"><?php _e('Right'); ?></option>
		</select>
	</label>

	<?php do_action('easyazon_shortcode_link_options', 'call-to-action'); ?>

	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeCallToAction" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>
</div>
