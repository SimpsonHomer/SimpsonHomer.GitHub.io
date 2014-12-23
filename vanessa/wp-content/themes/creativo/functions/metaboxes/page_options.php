<div class="pyre_metabox">

<?php
$this->select(	'show_title',
				__('Show Page Title & Breadcrumb', 'Creativo'),
				array('yes' => __('Yes', 'Creativo'), 'no' => __('No', 'Creativo')),
				''
			);
?>
<?php
$this->select(	'show_title_sec',
				__('Show Linkable Page Title', 'Creativo'),
				array('yes' => __('Yes', 'Creativo'), 'no' => __('No', 'Creativo')),
				''
			);
?>
<?php
$this->select(	'show_featured',
				__('Show All Featured Images', 'Creativo'),
				array('yes' => __('Yes', 'Creativo'), 'no' => __('No', 'Creativo')),
				__('Display featured images at the beggining of the page.', 'Creativo')
			);
?>
<?php /*
$this->select(	'show_featured_one',
				__('Show Only Main Featured Image', 'Creativo'),
				array('yes' => __('Yes', 'Creativo'), 'no' => __('No', 'Creativo')),
				__('Display only the main featured image, at the beginning of the post. The rest of the images will not be included and will not be displayed on the top of the page. <br />* Show Featured Images option (above) needs to be turned off - Select No', 'Creativo')
			);*/
?>
<?php
/*
$this->select(	'en_sidebar',
				__('Enable Sidebar', 'Creativo'),
				array('yes' => __('Yes', 'Creativo'), 'no' => __('No', 'Creativo')),
				''
			);
			*/
?>
<?php
$this->select(	'sidebar_pos',
				__('Sidebar Position', 'Creativo'),
				array('right' => __('Right', 'Creativo'), 'left' => __('Left', 'Creativo')),
				''
			);
?>
<?php
$types = get_terms('portfolio_category', 'hide_empty=0');
$types_array[0] = __('All categories', 'Creativo');
if($types) {
	foreach($types as $type) {
		$types_array[$type->term_id] = $type->name;
	}
$this->select(	'portfolio_category',
				__('Portfolio Type', 'Creativo'),
				$types_array,
				__('Choose what portfolio category you want to display on this page. Leave blank for all categories.', 'Creativo')
			);
}
?>

</div>