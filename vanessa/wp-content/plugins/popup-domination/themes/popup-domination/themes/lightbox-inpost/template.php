<div class="popup-dom-lightbox-wrapper" id="<?PHP echo $lightbox_id?>"<?PHP echo $delay_hide ?>>
	<div class="lightbox-main lightbox-color-<?PHP echo $color ?>">
		<div class="lightbox-clear"></div>
		<div class="lightbox-grey-panel">
			<p class="heading"><?PHP echo $fields['title'] ?></p>
			<div class="bullet-listx">
				<p><?PHP echo nl2br($fields['short_paragraph']) ?></p>
				<ul class="bullet-list"><?PHP
					if(isset($list_items) && count($list_items) > 0):
						foreach($list_items as $l):
						  ?>
					<li><?PHP echo $l ?></li><?PHP
						endforeach;
					endif;?>
				</ul>
				<div class="lightbox-clear"></div>
			</div>
		</div>
		<?PHP if($provider != 'nm' && $provider != 'form'): ?>
		<div class="lightbox-signup-panel">
			<p class="heading"><?PHP echo $fields['form_header'] ?></p>
			<div class="wait" style="display:none;"><img src="<?PHP echo $this->rewrite_script('css/images/wait.gif'); ?>" /></div>
            <div class="form">
                <div>
	                <form class="popdom_form" id="removeme">
	                    <?PHP echo $inputs['hidden'].$fstr; ?>
	                    <input type="submit" value="<?PHP echo $fields['submit_button'] ?>" class="<?PHP echo $button_color?>-button" />
						<p class="secure"><img src="<?PHP echo $theme_url?>/images/lightbox-secure.png" alt="lightbox-secure"  /> <?PHP echo $fields['footer_note'] ?></p>
					</form>
                </div>
            </div>
		</div>
		<?PHP else: ?>
		<div class="lightbox-signup-panel">
			<p class="heading"><?PHP echo $fields['form_header'] ?></p>
            <form class="popdom_form" method="post" action="<?PHP echo $form_action ?>" <?PHP echo $target ?>>
                <div>
                    <?PHP echo $inputs['hidden'].$fstr; ?>
                    <input type="submit" value="<?PHP echo $fields['submit_button'] ?>" class="<?PHP echo $button_color?>-button" />
					<p class="secure"><img src="<?PHP echo $theme_url?>/images/lightbox-secure.png" alt="lightbox-secure" /> <?PHP echo $fields['footer_note'] ?></p>
                </div>
            </form>
		</div>
		<?PHP endif; ?>
		<div class="lightbox-clear"></div>
			<?PHP echo $promote_link ?>
	</div>
</div>