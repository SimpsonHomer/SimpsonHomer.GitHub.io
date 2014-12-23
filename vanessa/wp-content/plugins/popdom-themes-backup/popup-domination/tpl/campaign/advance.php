<?PHP
if(empty($advance_custom_css))
	$advance_custom_css = '';
?>
<div class="mainbox" id="popup_domination_tab_advance">
    <div class="inside twomaindivs">
        <div class="the_content_box">
            <h3>Custom CSS</h3>
            <textarea id="popdom_advance_custom_css" name="popup_domination[advance_custom_css]"><?PHP echo esc_textarea($advance_custom_css); ?></textarea>
            <h3>Miscellaneous</h3>
            <label>
                <input type="checkbox" name="popup_domination[disable_analytics]" value="true" <?PHP if($disable_analytics) { ?>checked="checked"<?PHP } ?>>
                <strong>Disable Analytics</strong><br />
                Disables the updating of the analytics feature for this popup. This may be useful during testing or times of heavy server loads. <i>Does not affect A/B testing or social based themes.</i>
            </label>
        </div>
    </div>
</div>
