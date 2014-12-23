<?PHP
if(!isset($formhtml))
	$formhtml = '';
	
if(!isset($name_box))
	$name_box = '';
	
if(!isset($disable_namel))
	$disable_name = '';
	
if(!isset($custom_fields))
	$custom_fields = '';
	
if(!isset($email_box))
	$email_box = '';
	
if(!isset($form_action))
	$form_action = '';
?>
<div class="mainbox" id="popup_domination_tab_htmlform" style="display:none;">
	<div class="inside twodivs">
		<div class="popdom-inner-sidebar">
			<div class="other">
				<h3>Please Fill in the Following Details:</h3>
                <div class="col">
                    <p class="msg">Enter your html opt-in code below and we'll hook up your form to the template:</p>
                    <p><textarea cols="60" rows="10" id="popup_domination_formhtml" name="form[formhtml]"><?PHP echo $formhtml?></textarea></p>
                    <textarea id="hidden-fields" name="form[hidden_fields]" style="display:none;"></textarea>

					<div id="chosen-fields" style="display:block" >
						<div id="name_field">
							<label for="popup_domination_name_box"><strong>Name:</strong></label>
							<select id="popup_domination_name_box" name="form[name_box]"<?PHP echo ($disable_name && $disable_name=='Y')?' disabled="disabled"':''; ?>></select>
							<span class="required" style="display:none;" id="name_box_reminder">(Remember to select the name field)</span>
							<input type="hidden" id="popup_domination_name_box_selected" value="<?PHP echo $name_box?>" <?PHP echo ($disable_name && $disable_name=='Y')?' disabled="disabled"':''; ?> />
						</div>
						
						<div id="email_field" style="display:block">
							<label for="popup_domination_email_box"><strong>Email:</strong></label>
							<select id="popup_domination_email_box" name="form[email_box]"></select>
							<span class="required" style="display:none;" id="email_box_reminder">(Remember to select the email field)</span>
							<input type="hidden" id="popup_domination_email_box_selected" value="<?PHP echo $email_box?>" />
						</div>
						
						
						<div class="popup_domination_custom_inputs">
	                    <?PHP if(isset($extra_inputs) && $extra_inputs > 0): ?>
	                    	<input type="hidden" id="popup_domination_inputs_num" name="form[custom_fields]" value="<?PHP echo $custom_fields; ?>" />
	                    	<?PHP for($i=1;$i<=$extra_inputs;$i++): ?>
	                    	<?PHP $str = 'custom'.$i.'_box'; ?>
	                            <p>
	                                <label for="popup_domination_custom<?PHP echo $i; ?>_box"><strong>Custom Field <?PHP echo $i; ?>:</strong></label>
	                                <select id="popup_domination_custom<?PHP echo $i; ?>_box" name="form[custom<?PHP echo $i; ?>_box]"></select>
	                                <input type="hidden" id="popup_domination_custom<?PHP echo $i; ?>_box_selected" value="<?PHP echo $str; ?>"/>
	                            </p>
	                        <?PHP endfor; ?>
	                    <?PHP endif; ?>
	                    </div>
	
	                    <label for="popup_domination_action"><strong>Form URL:</strong></label>
                        <input type="text" id="popup_domination_action" name="form[form_action]" value="<?PHP echo $form_action; ?>" />
					</div>
                </div>
                <div class="form_custom_fields">
    		</div>
    	</div>
    	<div class="clear"></div>
	</div>
</div>
</div>