<?PHP
/*
* list.php
*
* PHP file used to display all current campaigns
*/
?>
<div class="wrap" id="popup_domination">
    <?PHP
        $header_link = 'Verify Your Theme Club Membership';
        $header_url = '#';
        include $this->plugin_path.'tpl/header.php';
    ?>
    <div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
    <div class="clear"></div>
    <div id="popup_domination_container" class="has-left-sidebar">
        <div style="display:none" id="popup_domination_hdn_div2"></div>
        
        <div style="padding:20px">
            <h1>Verify Your Theme Club Membership</h1>
            <hr />
            Verify your membership by entering your order number below. Not a member yet? <a href="http://www.popupdomination.com/themeclub/">Click here to find out more.</a>
            <br /><br />
            <?PHP if(!empty($error)) { ?>
            <span style="color:red;font-weight:bold"><?PHP echo $error; ?></span><br /><br />
            <?PHP } ?>
            <br />
            <form method="post" action="">
                <strong>Enter your order number:</strong><br /><br />
                <input type="text" name="order_number"/><br />
                <input class="green-btn" type="submit" value="Verify">
            </form>
        </div>
        <div class="clearfix"></div>
    <?PHP
        $page_javascript = '';
        $page_javascript = 'var popup_domination_delete_table = "campaigns", popup_domination_delete_stats = "";';
        include $this->plugin_path.'tpl/footer.php'; 
    ?>
    </div>
</div>
