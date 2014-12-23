<label class="setting">
	<span><?php _e('Cloaking'); ?></span>
	<select data-bind="value: shortcodeLinkCloaking">
		<option value="default"><?php _e('Default'); ?></option>
		<option value="yes"><?php _e('Yes'); ?></option>
		<option value="no"><?php _e('No'); ?></option>
	</select>
</label>

<?php if('link' === $context) { ?>
<label class="setting">
	<span><?php _e('Product Popups'); ?></span>
	<select data-bind="value: shortcodeLinkPopups">
		<option value="default"><?php _e('Default'); ?></option>
		<option value="yes"><?php _e('Yes'); ?></option>
		<option value="no"><?php _e('No'); ?></option>
	</select>
</label>
<?php } ?>

<?php if('search' !== $context) { ?>
<label class="setting">
	<span><?php _e('Add to Cart'); ?></span>
	<select data-bind="value: shortcodeLinkAddToCart">
		<option value="default"><?php _e('Default'); ?></option>
		<option value="yes"><?php _e('Yes'); ?></option>
		<option value="no"><?php _e('No'); ?></option>
	</select>
</label>
<?php } ?>

<label class="setting">
	<span><?php _e('Localization'); ?></span>
	<select data-bind="value: shortcodeLinkLocalization">
		<option value="default"><?php _e('Default'); ?></option>
		<option value="yes"><?php _e('Yes'); ?></option>
		<option value="no"><?php _e('No'); ?></option>
	</select>
</label>