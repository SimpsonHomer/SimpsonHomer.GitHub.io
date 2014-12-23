<div class='pyre_metabox'>
<?php
$this->select(	'width',
				__('Width (Content Columns)', 'Creativo'),
				array('full' => __('Full Width', 'Creativo'), 'half' => __('Half Width', 'Creativo')),
				''
			);
?>
<?php
$this->select(	'show_title',
				__('Show Page Title', 'Creativo'),
				array('yes' => __('Yes', 'Creativo'), 'no' => __('No', 'Creativo')),
				''
			);
?>

<?php
$this->text(	'custom_link',
				__('Custom Link', 'Creativo'),
				__('Your portfolio item can be linked to a custom page - paste the entire link above. E.g: http://rockythemes.com/<br>Leave blank for the portfolio item to link to the actual portfolio page.', 'Creativo')
			);
?>
<?php
$this->select(	'custom_link_target',
				__('Custom Link Opens in', 'Creativo'),
				array('self' => __('Same Window', 'Creativo'), '_blank' => __('New Window', 'Creativo')),
				''
			);
?>

</div>
