<div class="easyazon-block easyazon-block-align-<?php esc_attr_e($align); ?> <?php echo ($image ? 'easyazon-block-has-image' : ''); ?> easyazon-block-layout-<?php esc_attr_e($layout); ?>">
	<?php if($image) { ?>
	<div class="easyazon-block-image-container">
		<a <?php echo $link_attributes_string; ?> href="<?php esc_attr_e(esc_url($link_url)); ?>">
			<?php printf('<img alt="%1$s" class="easyazon-block-image" src="%2$s" height="%3$d" width="%4$d" />', esc_attr($title), esc_attr(esc_url($image['URL'])), $image['Height'], $image['Width']); ?>
		</a>
	</div>
	<?php } ?>

	<div class="easyazon-block-attributes">
		<div class="easyazon-block-attribute">
			<a <?php echo $link_attributes_string; ?> href="<?php esc_attr_e(esc_url($link_url)); ?>"><?php esc_html_e($title); ?></a>
		</div>

		<?php if($price_list) { ?>
		<div class="easyazon-block-attribute">
			<strong><?php _e('List Price'); ?></strong>: <a <?php echo $link_attributes_string; ?> data-easyazon-price="data-easyazon-price" href="<?php esc_attr_e(esc_url($link_url)); ?>"><?php esc_html_e($price_list); ?></a>
		</div>
		<?php } ?>

		<?php if($price_actual) { ?>
		<div class="easyazon-block-attribute">
			<strong><?php _e('Current Price'); ?></strong>: <a <?php echo $link_attributes_string; ?> data-easyazon-price="data-easyazon-price" href="<?php esc_attr_e(esc_url($link_url)); ?>"><?php esc_html_e($price_actual); ?></a>
		</div>
		<?php } ?>

		<div class="easyazon-block-attribute easyazon-block-attribute-buy-now">
		<?php printf('<a %1$s data-easyazon-buy="data-easyazon-buy" href="%2$s"><img alt="%3$s" class="easyazon-buy-button" src="%4$s" /></a>', $link_attributes_string, esc_attr(esc_url($link_url)), __('Buy Now'), $buy_now_url); ?>
		</div>

		<div class="easyazon-block-attribute easyazon-block-attribute-price-disclaimer">
			<small class="easyazon-price-disclaimer" data-content="<?php printf(__('Prices are accurate as of %1$s. Product prices and availability are subject to change. Any price and availablility information displayed on Amazon at the time of purchase will apply to the purchase of any products.'), date('F j, Y \a\t g:i A', $item['Fetched'])); ?>"><?php _e('Price Disclaimer'); ?></small>
		</div>
	</div>

	<div class="easyazon-block-clear"></div>
</div>