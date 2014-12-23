<?PHP
require_once($this->plugin_path . '/inc/concon/Ctct/autoload.php');

use Ctct\Auth\CtctOAuth2;
use Ctct\Exceptions\OAuth2Exception;
use Ctct\ConstantContact;
?>
<div class="mainbox" id="popup_domination_tab_constantcontact" style="display:none;">
	<div class="inside twodivs">
		<div class="popdom_contentbox the_help_box">
			<h3 class="help">Help</h3>
			<div class="popdom_contentbox_inside">
				<p>Click on the "Connect" Button, enter your login details and follow the steps on screen. Once Completed and returned to this screen, click the Get Mailing List link to get your mailing lists.</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="popdom-inner-sidebar">

			<div class="cc">
                <?PHP
                $show_connect = true;
                try {
                    @session_start();
                    if(isset($_GET['provider']) && isset($_GET['code']) && $_GET['provider'] == 'cc')
                        $_SESSION['popdom_provider_cc_code'] = $_GET['code'];

                    if(!empty($_SESSION['popdom_provider_cc_code'])) {
                        $ConstantContact = new ConstantContact('3psaz7mf73gy9rhtjqxc7ygp');
                        $ContactLists = $ConstantContact->getLists($_SESSION['popdom_provider_cc_code']);

                        if(!empty($ContactLists)) {
                            $mailing_list = '<span class="mailing-list-small">Your Constant Contact Mailing Lists</span><select class="mailing_lists" name="listsid" >';
                            foreach($ContactLists as $list) {
                                $mailing_list .= '<option name="' . $list->name . '" value="' . str_replace(array('http:', 'hhtps:'), '', $list->id) . '"> ' . $list->name . '<br />';
                            }
                            $mailing_list .= '</select>';
                        } else
                            $mailing_list = '<p class="no-lists">You don\'t have any lists yet</p>';

                        $show_connect = false;
                    }
                } catch(Exception $e) {
                    unset($_SESSION['popdom_provider_cc_code']);
                    $show_connect = true;
                }

                if($show_connect) { ?>
                    <h3>Please Fill in the Following Details:</h3>
				    <a href="https://oauth2.constantcontact.com/oauth2/oauth/siteowner/authorize?response_type=code&client_id=3psaz7mf73gy9rhtjqxc7ygp&redirect_uri=<?PHP echo rawurlencode('http://popupdomination.com/oauth2_client/?provider=cc&return_url='.base64_encode(admin_url('admin.php?page=popup-domination/mailinglist&action=edit&id='.$_GET['id']))); ?>" data-provider='cc_apikey' class="connect-to getlist"><span>Connect to Constant Contact</span></a>
                <?PHP } else { ?>
                    <h3>Please Select a Mailing List</h3>
                    <?PHP echo $mailing_list; ?>
                <?PHP } ?>
                <input type="hidden" name="cc[cc_access]" data-provider="cc" id="cc_access" value="<?PHP if(isset($_SESSION['popdom_provider_cc_code'])) { echo $_SESSION['popdom_provider_cc_code']; } elseif(isset($provider) && $provider == 'cc') { echo $provider_details['cc_access']; } ?>"/>
            	<a href="#" data-provider='cc_apikey' class="cc_getlist getlist" style="display:none;"><span>Grab Mailing List</span></a><span class="mailing-ajax-waiting">waiting</span>
    			<div class="clear"></div>
    			<div class="cc_custom_fields"></div>
			</div>
		</div>
	</div>
</div>
