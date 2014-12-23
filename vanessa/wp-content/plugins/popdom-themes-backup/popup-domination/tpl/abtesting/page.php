<?PHP
/**
 * page.php
 *
 * Template - This displays all the settings, details and stats for a/b campaign, this is also the template that is used for creating a new a/b split campaign.
 */
if(!isset($camp_id))
    $camp_id = '';
?>
<?PHP if($success) { ?>
    <div id="message" class="updated"><p>Your Settings have been <strong>Saved</strong></p></div>
<?PHP } ?>
<div class="wrap with-sidebar" id="popup_domination">
    <?PHP
    $header_link = 'Back to A/B Management';
    $header_url = 'admin.php?page=popup-domination/a-btesting';
    include $this->plugin_path . 'tpl/header.php';
    ?>			
    <form action="<?PHP echo $this->opts_url ?>" method="post" id="popup_domination_form">
        <div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields ?></div>
        <div class="clear"></div>
        <div id="popup_domination_container" class="has-left-sidebar">
            <div style="display:none" id="popup_domination_hdn_div2"></div>
            <?PHP include $this->plugin_path . 'tpl/abtesting/header.php'; ?>
            <?PHP include $this->plugin_path . 'tpl/abtesting/tabs.php'; ?>
            <div class="notices" style="display:none;">
                <p class="message">
                    <?PHP if(!isset($this->update_msg))
                        $this->update_msg = ' ';
                    else
                        echo $this->update_msg;
                    ?>
                </p>
            </div>
            <div class="flotation-device">
            <?PHP include $this->plugin_path . 'tpl/abtesting/campaigns.php'; ?>
            <?PHP include $this->plugin_path . 'tpl/abtesting/schedule.php'; ?>
            <?PHP include $this->plugin_path . 'tpl/abtesting/results.php'; ?>
            </div>
            <div class="clear"></div>
            <?PHP
            $footer_fields = '<input type="hidden" class="extra_fields" name="extra_fields" value="0" />
								<input type="hidden" class="campaigncookieid" name="campaignid" value="' . $camp_id . '" />';
            $save_button = '<input class="savecamp save-btn" type="submit" name="update" value="' . __("Save Changes", "popup_domination") . '" />';
            $page_javascript = isset($camp_id) ? "popup_domination_campaign_id = " . $camp_id . ";" : "";
            include $this->plugin_path . 'tpl/footer.php';
            ?>
    </form>
</div>