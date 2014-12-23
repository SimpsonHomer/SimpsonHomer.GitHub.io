<div class="mainbox" id="popup_domination_tab_aweber" style="display:none;">
    <div class="inside twodivs">
        <div class="popdom_contentbox the_help_box">
            <h3 class="help">Help</h3>
            <div class="popdom_contentbox_inside">
                <p>Click on the "Connect" Button, enter your login details and follow the steps on screen. Once Completed and returned to this screen, click the Get Mailing List link to get your mailing lists.</p>
                <br/>
                <p>If you receive an error message when attempting to connect to Aweber or attempting to collect your mailing lists, please use the button below to clear your cookies and try again.</p>
                <p>If you want to re-connect to Aweber, please use the clear cookies button and then refresh your page.</p>
                <p><a href="#clear" class="button aweber_cookieclear">Clear my Aweber cookies</a> <img class="waiting" style="display:none;" src="<?PHP echo $this->plugin_url; ?>css/img/ajax-loader.gif" alt="" /></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="popdom-inner-sidebar">
            <div class="provider_divs">
                <h3>Please Fill in the Following Details:</h3>
                <div class="aw">
                    <input type="hidden" name="aw[username]" data-provider='aw' value="<?PHP if(isset($provider) && $provider == 'aw') { echo $provider_details['username']; } elseif(isset($_COOKIE['awTokenSecret'])) { echo $_COOKIE['awTokenSecret']; } ?>" id="aw_clientid" />
                    <input type="hidden" name="aw[apikey]" data-provider='aw' value="<?PHP if(isset($provider) && $provider == 'aw') { echo $provider_details['apikey']; } elseif(isset($_COOKIE['awToken'])) { $value = $_COOKIE['awToken']; } ?>" id="aw_apikey" />
                    <?PHP 
                    if(!isset($_COOKIE['aw_getlists']))
                        echo '<a href="admin.php?page=popup-domination/mailinglist&path=' . urlencode(admin_url('admin.php?page=popup-domination/mailinglist&action=edit&id='.$_GET['id'])) . '" data-provider="aw_apikey" class="connect-to getlist"><span>Connect to Aweber</span></a>';
                    else
                        echo '<a href="#" data-provider="aw_apikey" class="aw_getlist getlist"><span>Grab Mailing List</span></a><span class="mailing-ajax-waiting">waiting</span>';
                    ?>
                    <div class="clear"></div>
                    <div class="aw_custom_fields">
                        <input type="hidden" name="aw[form_action]" value="//www.aweber.com/scripts/addlead.pl" />
                        <input type="hidden" name="aw[hidden][meta_adtracking]" value="PopUp Domination" />
                        <input type="hidden" name="aw[hidden][meta_message]" value="1" />
                        <input type="hidden" name="aw[hidden][meta_required]" value="<?PHP echo ($disable_name == 'yes') ? '' : 'name,'; ?>email" id="aw_disable_name" />
                        <input type="hidden" name="aw[hidden][meta_tooltip]" value="" />
                        <input type="hidden" name="aw[hidden][meta_split_id]" value="" />
                        <!-- // required? = <input type="hidden" name="meta_web_form_id" value="$form_id?????" /> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>