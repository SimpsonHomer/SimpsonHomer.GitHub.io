<?PHP
/*
* page.php
*
* Main page which holds all the information for the Theme Uploader option
*/
?>
<div class="wrap with-sidebar" id="popup_domination">
<?PHP
$header_link = 'Back to Campaign Management';
$header_url = 'admin.php?page=popup-domination/campaigns';
include $this->plugin_path.'tpl/header.php';
?>
    <div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
    <div class="clear"></div>
    <div id="popup_domination_container" class="has-left-sidebar">
        <div style="display:none" id="popup_domination_hdn_div2"></div>

        <?PHP include $this->plugin_path.'tpl/theme_uploader/tabs.php'; ?>

        <div class="notices" style="display:none;">
            <p class="message"></p>
        </div>
        <div class="flotation-device">
            <?PHP include('uploader.php'); ?>
            <?PHP if(get_option('popup_domination_theme_updater', false)) { include('theme_update.php'); } ?>
            <?PHP include('themebuy.php');?>
            <?PHP include('theme_remove.php');?>
        </div>
        <?PHP include $this->plugin_path.'tpl/footer.php'; ?>
    </div>
</div>