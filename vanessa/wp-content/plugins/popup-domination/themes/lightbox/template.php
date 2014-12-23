<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-overlay"></div>
	<div class="lightbox-main lightbox-color-<?PHP echo $color ?>">
		<a href="#" class="lightbox-close" id="<?PHP echo $lightbox_close_id?>"><span>Close</span></a>
		<div class="lightbox-top">
			<div class="lightbox-top-content">
				<p class="heading"><?PHP echo $fields['title'] ?></p>
				<div class="bullet-listx">
                    <ul class="bullet-list">
                        <?PHP
                        $list_items = is_array($list_items) ? $list_items : array();
                        foreach($list_items as $l)
                            echo '<li>'.$l.'</li>';
                        ?>
                    </ul>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div class="lightbox-middle-bar">
			<p class="heading2"><?PHP echo $fields['form_header'] ?></p>
		</div>
		<?PHP if($provider != 'form' && $provider != 'nm'): ?>
		<div class="lightbox-bottom">
			<div class="lightbox-signup-panel">
				<div class="wait" style="display:none;"><img src="<?PHP echo $this->rewrite_script('css/images/wait.gif'); ?>" /></div>
	            <div class="form">
	                <div>
	                    <?PHP echo $inputs['hidden'].$fstr; ?>
	                    <input type="submit" value="<?PHP echo $fields['submit_button'] ?>" src="<?PHP echo $theme_url?>/images/trans.png" class="<?PHP echo $button_color?>-button" />
	                    <p class="secure"><?PHP echo $fields['footer_note'] ?></p>
	                </div>
	            </div>
			</div>
		</div>
		<?PHP else: ?>
		<div class="lightbox-bottom">
			<div class="lightbox-signup-panel">
	            <form method="post" action="<?PHP echo $form_action ?>"<?PHP echo $target ?>>
	                <div>
	                    <?PHP echo $inputs['hidden'].$fstr ?>
	                    <input type="submit" value="<?PHP echo $fields['submit_button'] ?>" src="<?PHP echo $theme_url?>/images/trans.png" class="<?PHP echo $button_color?>-button" />
						<p class="secure"><?PHP echo $fields['footer_note'] ?></p>
	                </div>
	            </form>	
            </div>
		</div>
		<?PHP endif; ?>
			<?PHP echo $promote_link ?>
	</div>
</div>