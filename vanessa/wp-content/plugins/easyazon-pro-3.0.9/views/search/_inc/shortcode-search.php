<div class="easyazon-process-shortcode-search" data-bind="visible: shortcodeSearchStateActive">
	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeSearch" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>

	<label class="setting">
		<span><?php _e('Link Text'); ?></span>
		<input type="text" data-bind="value: shortcodeContent" />
	</label>

	<?php do_action('easyazon_shortcode_link_options', 'search'); ?>

	<label class="setting">
		<input type="button" class="button-primary easyazon-button easyazon-input" value="<?php _e('Insert shortcode'); ?>" data-bind="click: insertShortcodeSearch" />
		<input type="button" class="button-secondary easyazon-button easyazon-input" value="<?php _e('Return to search'); ?>" data-bind="click: restoreSearchState" />
	</label>
</div>