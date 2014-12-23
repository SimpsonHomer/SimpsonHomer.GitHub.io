<div class="mainbox" id="popup_domination_tab_look_and_feel">
    <div class="popdom_contentbox the_help_box">
        <h3 class="help">Help</h3>
        <div class="popdom_contentbox_inside">
            <?PHP $url = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            $tmpurl = explode('/campaigns', $url);
            $furl = $tmpurl[0] . '/theme_upload'; 
            $gurl = $tmpurl[0] . '/verify_themeclub'; 
            ?>
            <p>To upload your other themes, please go to the <a href="<?PHP echo 'http://' . $furl; ?>">Theme Uploader</a>.
            <p>If this is the first time you have installed PopUp Domination 3.0, you will need to download the Themes archive
                and then upload them. Unfortunately due to the size of the Themes, we now have to separate them from the main plugin.
                Don't worry though, there are no further charges, and nothing technical is involved.</p>
            <p>See a <a href="http://popdom.assistly.com/customer/portal/articles/252964-theme-upload">help video</a> on how to do this step by step.</p>
        </div>
    </div>
    <br/>
    <div class="inside twodivs">
        <div class="popdom-inner-sidebar">
            <div class="postbox">
                <h3 class="hndle"><span>Choose a template style & colour</span></h3>
                <div class="sidebar-inside">
                    <p class="popup_template">
                        <select id="popup_domination_template" name="popup_domination[template]">
                            <?PHP echo $opts ?>
                            <option value="get_more_themes_link" style="background-color:#F2F2F2;">Get More Themes!</option>
                        </select>
                    </p>
                    <p class="popup_color" <?PHP echo ((!empty($opts2)) ? '' : ' style="display:none"') ?>>
                        <select id="popup_domination_color_selected" name="popup_domination[color]"><?PHP print_r($opts2) ?></select>
                    </p>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div id="normal-sortables">
            <div id="popup_domination_preview">
                <?PHP
                $style = '';
                if($cur_preview != '') {
                    $style .= 'background-image:url(\'' . $this->theme_url . $cur_preview . '\')';
                    if(count($cur_size) == 2)
                        $style .= ';width:' . $cur_size[0] . 'px;height:' . $cur_size[1] . 'px; background-repeat: no-repeat;';
                    $style = ' style="' . $style . '"';
                }
                ?>
                <div class="preview" <?PHP echo $style ?>></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="postbox" <?PHP echo ((!empty($cur_theme['button_colors'])) ? '' : ' style="display:none"') ?> id="popup_domination_colors_container">
            <h3 class="hndle"><span>Choose a button Color</span></h3>
            <div class="sidebar-inside">
                <?PHP
                $btns = '';
                $button_color = $valbuttonc;
                if(isset($cur_theme['button_colors'])) {
                    foreach($cur_theme['button_colors'] as $c) {
                        $btns .= '<option value="' . $c['color_id'] . '"' . (($c['color_id'] == $button_color) ? ' selected="selected"' : '') . '>' . $c['name'] . '</option>';
                    }
                }
                ?>
                <p>
                    <select id="popup_domination_btn_color" name="popup_domination[button_color]"><?PHP echo $btns ?></select>
                    <input type="hidden" id="popup_domination_btn_color_selected" value="<?PHP echo $valbuttonc; ?>" />
                </p>
            </div>
        </div>
        <?PHP if($this->option('themeclub') != 'Y') { ?>
        <div class="postbox" id="popdom_contentbox_unlock_themeclub">
            <div class="sidebar-inside">
                <div class="popdom_contentbox the_help_box">
                    <h3 class="help">Unlock Theme Club Features</h3>
                    <p>
                        To unlock additional features of this theme, simply join the <a href="http://www.popupdomination.com/themeclub/">Theme Club!</a><br /><br />
                        <strong>Already a member of our Theme Club?</strong><br /><br />
                        <a href="<?PHP echo 'http://' . $gurl; ?>">Click here to verify your account.</a><br /><br />
                        <strong>Not yet a member of our Theme Club?</strong><br />
                        <br />
                        <a href="http://www.popupdomination.com/themeclub/">Learn more about the benefits here.</a> Membership fee's go towards creating new, exciting and high converting themes that will make you more money!
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <?PHP } ?>
    </div>
    <div class="clear"></div>
</div>