<div class="pyre_metabox">
<?php
$this->select(	'slider_select',
				__('Slider Select', 'Creativo'),
				array(
					'none' => __('None', 'Creativo'), 
					'layer_slider' => __('Layer Slider', 'Creativo'), 
					'rev_slider' => __('Revolution Slider', 'Creativo'), 
					'demo_slider' => __('Demo Slider', 'Creativo')),
				''
			);
?>

<?php
$this->text('slider_id',
			__('Slider ID:', 'Creativo'),
			__('Enter the id of the slider you want to use. (e.g: 1,2,3...)', 'Creativo')
			);
?>
</div>