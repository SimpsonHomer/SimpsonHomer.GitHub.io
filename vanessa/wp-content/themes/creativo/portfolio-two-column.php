<?php // Template Name: Portfolio Two Column ?>
<?php get_header(); ?>
	<?php 
	if(get_post_meta($post->ID, 'pyre_slider_select', true) == 'layer_slider') {  
	?>
    	<div class="content-layer">
            <div class="inside_content2"> 
        		<?php echo do_shortcode('[layerslider id="'.get_post_meta($post->ID, 'pyre_slider_id',true).'"]'); ?> 
            </div>
        </div>
    <?php
	}
	if(get_post_meta($post->ID, 'pyre_slider_select', true) == 'rev_slider') {  
	?>
    	<div class="content-layer">
            <div class="inside_content"> 
        		<?php putRevSlider(get_post_meta($post->ID, 'pyre_slider_id',true)); ?>
            </div>
        </div>
    <?php
	}	
	?> 
			<div class="row">
            	<?php while(have_posts()): the_post(); ?>
                	<div class="page_description"><?php the_content(); ?></div>
                <?php endwhile; ?> 
                <div id="content" class="portfolio-two">
                    <?php
                    if(!get_post_meta(get_the_ID(), 'pyre_portfolio_category', true)):
                    $portfolio_category = get_terms('portfolio_category');
                    if($portfolio_category):
                    ?>                    
                    <ul class="portfolio-tabs clearfix">
                        <li class="active"><a data-filter="*" href="#"><?php _e('All', 'Creativo'); ?></a></li>
                        <?php foreach($portfolio_category as $portfolio_cat): ?>
                        <li><span>/</span><a data-filter=".<?php echo $portfolio_cat->slug; ?>" href="#"><?php echo $portfolio_cat->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="portfolio-wrapper">
                        <?php
                        if(is_front_page()) {
							$paged = (get_query_var('page')) ? get_query_var('page') : 1;
						} else {
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						}
                        $args = array(
                            'post_type' => 'creativo_portfolio',
                            'paged' => $paged,
                            'posts_per_page' => $data['portfolio_items']
                        );
                        if(get_post_meta(get_the_ID(), 'pyre_portfolio_category', true)){
                            $args['tax_query'][] = array(
                                'taxonomy' => 'portfolio_category',
                                'field' => 'ID',
                                'terms' => get_post_meta(get_the_ID(), 'pyre_portfolio_category', true)
                            );
                        }
                        $gallery = new WP_Query($args);
						
                        while($gallery->have_posts()): $gallery->the_post();
                            if(has_post_thumbnail() || get_post_meta($post->ID, 'pyre_youtube', true) || get_post_meta($post->ID, 'pyre_vimeo', true)):
                        ?>
                        <?php
                        $item_classes = '';
                        $item_cats = get_the_terms($post->ID, 'portfolio_category');
						$portf_cat = wp_get_object_terms($post->ID, 'portfolio_category');
                        if($item_cats):
                        foreach($item_cats as $item_cat) {
                            $item_classes .= $item_cat->slug . ' ';
                        }
                        endif;						
                        ?>
                        		<div class="portfolio-item  <?php echo $item_classes; ?>">	 
									<div class="project-feed clearfix">										
										<div class="ch-item portfolio-2">	
											<div class="ch-info portfolio-2">
												<div class="ch-info-front2 "><?php echo get_the_post_thumbnail($post->ID, 'portfolio-two');?></div>
												<div class="ch-info-back2 portfolio-2">
													<?php 
													if (get_post_meta($post->ID, 'pyre_custom_link', true) != '') {													
													?>
                                                    	<h3><a href="<?php echo get_post_meta($post->ID, 'pyre_custom_link', true); ?>" target="<?php echo get_post_meta($post->ID, 'pyre_custom_link_target', true); ?>"><?php echo get_the_title(); ?></a></h3>
                                                    <?php
													}
													else{
													?>
														<h3><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_title(); ?></a></h3>
                                                    <?php 
													} 
													?>
													<div class="portfolio_tags"><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', '');?></div>
												</div>
											</div>
										</div>
									</div>									
								</div>
                        <?php endif; endwhile; ?>
                    </div>
                    
                </div>
                <?php kriesi_pagination($gallery->max_num_pages, $range = 2); ?>
 			</div>
<?php get_footer(); ?>