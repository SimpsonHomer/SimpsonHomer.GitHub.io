<?PHP
/*
* list.php
*
* PHP file used to display all current campaigns
*/
?>
<div class="wrap" id="popup_domination">
    <?PHP
        $header_link = 'Campaign Management';
        $header_url = '#';
        include $this->plugin_path.'tpl/header.php';
    ?>
    <div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
    <div class="clear"></div>
    <div id="popup_domination_container" class="has-left-sidebar">
        <div style="display:none" id="popup_domination_hdn_div2"></div>
        
        <div class="mainbox" id="popup_domination_campaign_list">
            <div class="popdom_contentbox the_help_box">
                <h3 class="help">Help</h3>
                <div class="popdom_contentbox_inside">
                    <p><strong>How to first set up your PopUp Domination</strong></p>
                    <iframe width="560" height="315" src="//www.youtube.com/embed/LKNM6enZysU?html5=1" frameborder="0" allowfullscreen></iframe>
                    <p>Use the buttons below to create new campaigns</p>
                    <ul>
                        <li>Popup campaigns provide a lightbox overlay to the page</li>
                        <li>In-post campaigns appear at the end of your posts content if you choose the pages and/or anywhere you paste the shortcode in a post, page or sidebar widget</li>
                        <!--<li>Sidebar campaigns provide a shortcode to paste into a text widget for your sidebar</li>-->
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
    
            <div class="newcampaign">
                <a class="green-btn" href="<?PHP echo 'admin.php?page='.$this->menu_url.'campaigns&action=create'; ?>"><span>Add New Popup Campaign</span></a>
                <a class="green-btn" href="<?PHP echo 'admin.php?page='.$this->menu_url.'campaigns&action=create&type=inline'; ?>"><span>Add New In-post Campaign</span></a>
                <!--<a class="green-btn" href="<?PHP echo 'admin.php?page='.$this->menu_url.'campaigns&action=create&type=sidebar'; ?>"><span>Add New Sidebar Campaign</span></a>-->
                <p class="campaign-notice">You have <span id="row_count"><?PHP echo $count; ?></span> campaign(s).</p>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            
            <?PHP foreach ($campaigns as $campaign): ?>
            <div class="camprow" id="camprow_<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['id']; ?>">
                <div class="tmppreview">
                    <div class="preview_crop">
                        <div class="spacing">
                            <div class="slider"><h2><?PHP echo (!empty($c)) ? $tempname[$c->id] : ''; ?></h2></div>
                            <img class="img" src="<?PHP echo $campaign['previewurl']; ?>" height="<?PHP echo $campaign['height']; ?>" width="<?PHP echo $campaign['width']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="namedesc">
                    <?PHP 
                        $type = ($campaign['inpost']) ? "&type=inline" : "" ;
                    ?>
                    <a href="<?PHP echo 'admin.php?page='.$this->menu_url.'campaigns&action=edit&id='.$campaign['id'].$type; ?>"><?PHP echo $campaign['name']; ?></a><br/>
                    <?PHP
                        $type = "Popup"; 
                        if (!empty($campaign['inpost'])) $type = "In-post";
                        if (!empty($campaign['sidebar'])) $type = "Sidebar";
                    ?>
                    <p class="description"><?PHP echo $campaign['desc']; ?></p>
                    <p class="campstyle">(<?PHP echo $type ?> campaign)</p>
                    <?PHP if ($type == "In-post") { ?>
                        <p class="popdom-quick-shortcode">Shortcode: <input type="text" value="[popdom id='<?PHP echo $campaign['id']?>']" readonly style="border:none;text-align:center;"/></p>
                    <?PHP } ?>
                </div>
                <ul class="actions">
                    <li><a title="<?PHP echo $campaign['name']; ?>" class="view_analytics" href="admin.php?page=<?PHP echo $this->menu_url; ?>analytics&id=<?PHP echo $campaign['id'] ?>">Analytics</a></li>
                    <li><a data-id="<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['name']; ?>" class="copy_button" href="#copy">Duplicate</a></li>
                    <li><a data-id="<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['name']; ?>" class="toggle_button <?PHP echo ($campaign['active']) ? 'off':'on';?>" href="#toggle"><?PHP echo ($campaign['active']) ? 'ON | <span style="color:silver">OFF</span>':'<span style="color:silver">ON</span> | OFF';?></a></li>
                    <li><a data-id="<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['name']; ?>" class="deletecamp thedeletebutton" href="#deletecamp">Delete</a></li>
                </ul>
                <div class="clear"></div>
                <?PHP if($campaign['active'] && !in_array($campaign['filename'], $this->no_form_themes) && !$campaign['mailinglist_set']) { ?>
                <div class="popdom_info_warning">
                    <strong>Warning:</strong> A Mailing List is not set for this popup. This popup will <b>not</b> show form inputs until one is set.<br />
                    <strong>Tutorial:</strong> <a href="http://popupdomination.com/help/knowledgebase/setting-up-for-the-first-time/" target="_blank">Setting up for the first time</a>
                </div>
                <?PHP } ?>
            </div>
            <?PHP endforeach; ?>
            
        </div>
        <div class="clearfix"></div>
    <?PHP
        $page_javascript = '';
        $page_javascript = 'var popup_domination_delete_table = "campaigns", popup_domination_delete_stats = "";';
        include $this->plugin_path.'tpl/footer.php'; 
    ?>
    </div>
</div>
