<?PHP
/*
 * page.php
 *
 *
 */

if(!isset($new_window))
    $new_window = '';

if(!isset($disable_name))
    $disable_name = '';

if(!isset($provider))
    $provider = '';

if(!isset($redirect))
    $redirect = '';

if(!isset($redirect_url))
    $redirect_url = '';

if(!isset($custom_fields))
    $custom_fields = 0;

if(!isset($custom1name))
    $custom1name = '';

if(!isset($custom2name))
    $custom2name = '';
?>

<?PHP if($this->success): ?>
    <div id="message" class="updated"><p>Your Settings have been <strong>Saved</strong></p></div>
<?PHP endif; ?>
<div class="wrap with-sidebar" id="popup_domination">
<?PHP
$header_link = 'Back to Mailing List Management';
$header_url = 'admin.php?page=popup-domination/mailinglist';
include $this->plugin_path . 'tpl/header.php';
?>
    <div style="display:none" id="popup_domination_hdn_div"><?PHP if(isset($fields)) {
        echo $fields;
    } ?></div>
    <div class="clear"></div>

    <form name="apidata" id="apiformdata" action="admin.php?page=popup-domination/mailinglist" method="post">
        <div id="popup_domination_container" class="has-left-sidebar">
            <div style="display:none" id="popup_domination_hdn_div2"></div>
            <?PHP include $this->plugin_path . 'tpl/mailing/header.php'; ?>
            <?PHP include $this->plugin_path . 'tpl/mailing/tabs.php'; ?>
            <div class="notices" style="display:none;">
                <p class="message"></p>
            </div>
            <div class="flotation-device">
                <?PHP include $this->plugin_path . 'tpl/mailing/mailchimp.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/aweber.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/icontact.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/constantcontact.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/campaignmonitor.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/getresponse.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/email.php'; ?>
                <?PHP include $this->plugin_path . 'tpl/mailing/htmlform.php'; ?>

                <div class="clear"></div>
                <div class="mainbox" id="popup_domination_tab_api">
                    <div class="inside twodivs">
                        <div class="popdom-inner-sidebar">

                            <div id="mailingfeedback"></div>

                            <!-- Generic configuration details shared for all providers i.e. PopDom features -->
                            <div id="new_window">
                                <h3>Submit to a new window?</h3>
                                <ul id="submit_new_window">
                                    <li><input type="radio" name="new_window" id="new_window_yes" value="yes" <?PHP echo ($new_window == 'yes') ? 'checked="checked"' : ''; ?> /><label for="new_window_yes">Yes</label></li>
                                    <li><input type="radio" name="new_window" id="new_window_no" value="no" <?PHP echo ($new_window != 'yes') ? 'checked="checked"' : ''; ?> /><label for="new_window_no">No</label></li>
                                </ul>
                            </div>

                            <div id="disable_name">
                                <h3>Disable the name field?</h3>
                                <ul id="disable_name_field">
                                    <li><input type="radio" name="disable_name" id="disable_name_yes" value="yes" <?PHP echo ($disable_name == 'yes') ? 'checked="checked"' : ''; ?> /><label for="disable_name_yes">Yes</label></li>
                                    <li><input type="radio" name="disable_name" id="disable_name_no" value="no" <?PHP echo ($disable_name != 'yes') ? 'checked="checked"' : ''; ?> /><label for="disable_name_no">No</label></li>
                                </ul>
                            </div>



                            <div id="mailing-redirect-check" <?PHP echo ($provider == 'form') ? 'style="display:none;"' : ''; ?>>
                                <h3>Re-direct user after Opt In?</h3>
                                <ul id="redirect_user" <?PHP echo ($provider == 'form') ? 'disabled="disabled"' : ''; ?>>
                                    <li><input type="radio" name="redirect" id="redirect_user_yes" value="yes" <?PHP echo ($redirect == 'yes') ? 'checked="checked"' : ''; ?> /><label for="redirect_user_yes">Yes</label></li>
                                    <li><input type="radio" name="redirect" id="redirect_user_no" value="no" <?PHP echo ($redirect != 'yes') ? 'checked="checked"' : ''; ?> /><label for="redirect_user_no">No</label></li>
                                </ul>
                            </div>
                            <div id="mailing-redirect-url" <?PHP echo ($provider == 'form' || $redirect != 'yes') ? 'style="display:none;"' : ''; ?>>
                                <h3>Re-direct URL:</h3>
                                <input id="redirect_url" type="text" name="redirect_url" <?PHP echo ($provider == 'form' || $redirect != 'yes') ? 'disabled="disabled"' : ''; ?> value="<?PHP echo $redirect_url; ?>" placeholder="Enter the URL here..." />
                            </div>

                            <div id="custom_fields">
                                <h3>Custom Fields</h3>
                                <span class="example">How Many Extra Fields Would You Like? (this is limited by the template)</span>
                                <select id="custom_select" class="custom_num" name="custom_fields">
                                    <option id="none" value="0">0</option>
                                    <option id="one" value="1" <?PHP echo $custom_fields == 1 ? 'selected="selected"' : ''; ?> >1</option>
                                    <option id="two" value="2" <?PHP echo $custom_fields == 2 ? 'selected="selected"' : ''; ?> >2</option>
                                </select>

                                <div id="general_custom_fields" <?PHP echo ($provider == 'cc' || $provider == 'form') ? 'style="display:none;" disabled="disabled"' : ''; ?>>
                                    <div id="more_custom_fields">
                                        <div id="custom1" style="<?PHP echo $custom_fields >= 1 ? 'display:block;' : 'display:none;'; ?>">
                                            <span class="example">What is Your 1st Custom Field Name? (Need Help? <a target="_blank" href="http://popdom.desk.com/customer/portal/articles/367583-extra-custom-fields">Click Here</a>)</span>
                                            <input type="text" name="custom1name" value="<?PHP echo $custom1name; ?>"/>
                                        </div>
                                        <div id="custom2" style="<?PHP echo $custom_fields >= 2 ? 'display:block;' : 'display:none;'; ?>">
                                            <span class="example custom2" >What is Your 2nd Custom Field Name? (Need Help? <a target="_blank" href="http://popdom.desk.com/customer/portal/articles/367583-extra-custom-fields">Click Here</a>)</span>
                                            <input type="text" name="custom2name" value="<?PHP echo $custom2name; ?>"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="cc_custom_fields" <?PHP echo $provider == 'cc' ? '' : 'style="display:none;"'; ?>>
                                    <select id="custom1" name="custom1name" <?PHP echo $provider == 'cc' ? '' : 'disabled="disabled"'; ?>  style="<?PHP echo $custom_fields >= 1 ? 'display:block;' : 'display:none;'; ?>">
                                        <option value="" >Please Select...</option>
                                        <option value="MiddleName" <?PHP if($custom1name == 'MiddleName') { echo 'selected="selected"'; } ?>>Middle Name</option>
                                        <option value="LastName" <?PHP if($custom1name == 'LastName') { echo 'selected="selected"'; } ?>>Last Name</option>
                                        <option value="HomePhone" <?PHP if($custom1name == 'HomePhone') { echo 'selected="selected"'; } ?>>Home Phone</option>
                                        <option value="Addr1" <?PHP if($custom1name == 'Addr1') { echo 'selected="selected"'; } ?>>Address</option>
                                        <option value="City" <?PHP if($custom1name == 'City') { echo 'selected="selected"'; } ?>>City</option>
                                        <option value="StateName" <?PHP if($custom1name == 'StateName') { echo 'selected="selected"'; } ?>>State/Province</option>
                                        <option value="PostalCode" <?PHP if($custom1name == 'PostalCode') { echo 'selected="selected"'; } ?>>Zip/Postal Code</option>
                                    </select>
                                    <select id="custom2" name="custom2name" <?PHP echo $provider == 'cc' ? '' : 'disabled="disabled"'; ?> style="<?PHP echo $custom_fields >= 2 ? 'display:block;' : 'display:none;'; ?>">
                                        <option value="">Please Select...</option>
                                        <option value="MiddleName" <?PHP if($custom2name == 'MiddleName') { echo 'selected="selected"'; } ?>>Middle Name</option>
                                        <option value="LastName" <?PHP if($custom2name == 'LastName') { echo 'selected="selected"'; } ?>>Last Name</option>
                                        <option value="HomePhone" <?PHP if($custom2name == 'HomePhone') { echo 'selected="selected"'; } ?>>Home Phone</option>
                                        <option value="Addr1" <?PHP if($custom2name == 'Addr1') { echo 'selected="selected"'; } ?>>Address</option>
                                        <option value="City" <?PHP if($custom2name == 'City') { echo 'selected="selected"'; } ?>>City</option>
                                        <option value="StateName" <?PHP if($custom2name == 'StateName') { echo 'selected="selected"'; } ?>>State/Province</option>
                                        <option value="PostalCode" <?PHP if($custom2name == 'PostalCode') { echo 'selected="selected"'; } ?>>Zip/Postal Code</option>
                                    </select>
                                </div>
                                <div id="form_custom_fields" <?PHP echo $provider == 'form' ? '' : 'style="display:none;"'; ?>>
                                    <select id="custom1" name="custom1name" <?PHP echo $provider == 'form' ? '' : 'disabled="disabled"'; ?> style="<?PHP echo $custom_fields >= 1 ? 'display:block;' : 'display:none;'; ?>"></select>
                                    <input type="hidden" name="custom1" id="custom1_selected" value="<?PHP echo $custom1name; ?>" />
                                    <select id="custom2" name="custom2name" <?PHP echo $provider == 'form' ? '' : 'disabled="disabled"'; ?> style="<?PHP echo $custom_fields >= 2 ? 'display:block;' : 'display:none;'; ?>"></select>
                                    <input type="hidden" name="custom2" id="custom2_selected" value="<?PHP echo $custom2name; ?>" />
                                </div>
                            </div>

                            <!-- Data used to determine whether the information has been updated or user has just clicked save -->
                            <input type="hidden" name="listid" id="listid" value="<?PHP echo!empty($provider) ? $listid : ''; ?>"/>
                            <input type="hidden" name="listname" id="listname" value="<?PHP echo!empty($provider) ? $listname : ''; ?>" />
                            <input type="hidden" name="provider" id="provider" value="<?PHP echo!empty($provider) ? $provider : 'mc'; ?>"/>
                            <input type="hidden" name="newprovider" id="newprovider" value="<?PHP echo!empty($provider) ? $provider : 'mc'; ?>"/>
                            <input type="hidden" name="newlistid" id="newlistid" value="<?PHP echo!empty($provider) ? $listid : ''; ?>" />
                            <input type="hidden" name="newlistname" id="newlistname" value="<?PHP echo!empty($provider) ? $listname : ''; ?>" />

                            <?PHP if(!empty($provider)) { ?>
                                <!-- Shows which mailing list provider the user is connected to -->
                                <h3>Currently Connected</h3>
                                <div id="connected-provider">
                                    <div id="current-connect">
                                        <p id="currently-connected">You are currently connected to:</p>
                                        <?PHP
                                        if($provider == 'mc')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/mailchimp.png" alt="mailchimp" />';
                                        else if($provider == 'aw')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/aweber.png" style="margin-left:-13px;" alt="AWeber"/>';
                                        else if($provider == 'ic')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/icontact.png" alt="iContact"/>';
                                        else if($provider == 'cc')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/constant.png" alt="ConstantContact"/>';
                                        else if($provider == 'cm')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/campaign.png" alt="Campaign Monitor"/>';
                                        else if($provider == 'gr')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/response.png" alt="Get Response"/>';
                                        else if($provider == 'nm')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/email.png" alt="Opt In to Email" />';
                                        else if($provider == 'form')
                                            $logo = '<img src="' . $this->plugin_url . 'css/img/htmlform.png" alt="HTML Form Code" />';
                                        else
                                            $logo = '';
                                        ?>
                                        <p id="mailing-provider"><?PHP echo $logo; ?></p>
                                    </div>
                                    <div id="connected-list" <?PHP echo ($provider == 'nm' || $provider == 'form') ? 'style="display:none;"' : ''; ?>>
                                        <p id="connect-mailing-list">Mailing List you are currently using:</p>
                                        <p id="mailing-list"><?PHP echo $listname; ?></p>
                                    </div>
                                </div>
                            <?PHP } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?PHP
            $save_button = '<input class="savecamp save-btn apisubmit" type="submit" value="Save Changes" name="update" style="display: inline;">';
            $footer_fields = '<input type="hidden" name="id" value="' . $id . '" />';
            
            if(!isset($custom_fields))
                $custom_fields = 0;
            
            $page_javascript = "var website_url = '" . site_url() . "';";
            include($this->plugin_path . 'tpl/footer.php');
            ?>
        </div>
    </form>
    <div id="popup-domination-html-hidden-form" style="display:none;"></div>
</div>