<div class="mainbox" id="popup_domination_tab_themeupdate" style="display:none">
    <div class="inside twodivs">
        <div class="popdom_contentbox the_help_box">
            <h3 class="help">Help</h3>
            <div class="popdom_contentbox_inside">
                <p>Please make sure you have either "755" or "777" Premissions set on both the "Themes" folder and the "TMP" folder within the PopUp Domination plugin folder, they need to be writable by the web server.</p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="popdom-inner-sidebar">
            <div class="postbox">
                <div class="popdom_contentbox the_content_box">
                    <h3>Theme Updater</h3>
                    <div class="popdom_contentbox_inside">
                        <p><strong>EXPERIMENTAL</strong> Use this tool to update themes if they appear broken. If nothing is wrong, then it's adviced not to update the theme.</p>
                    </div>
                    <?PHP $this->theme_update_check(); ?><br />
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>