<?php

/*-----------------------------------------------------------------------------------

	Add Portfolio Post Type

-----------------------------------------------------------------------------------*/


/* Create the Portfolio Custom Post Type ------------------------------------------*/
// Register custom post types
add_action('init', 'pyre_init');
function pyre_init() {
	register_post_type(
		'creativo_portfolio',
		array(
			'labels' => array(
				'name' => __('Portfolio', 'Creativo'),
				'singular_name' => __('Portfolio', 'Creativo')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-items'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_category', 'creativo_portfolio', array('hierarchical' => true, 'label' => __('Categories', 'Creativo'), 'query_var' => true, 'rewrite' => true));

}