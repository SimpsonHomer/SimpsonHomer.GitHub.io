<div class="popup_domination_top_left">
    <img class="logo" src="<?PHP echo $this->plugin_url ?>css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var height = jQuery(".the_content_box").outerHeight(true);
        jQuery(".the_content_box").parent().css("min-height", height);
    });
</script>
<div id="popup_domination_container" class="has-left-sidebar">
    <div class="mainbox" id="popup_domination_tab_look_and_feel" style="width:35%;">
        <h2 class="title topbar icon feel" style="margin-top:0px !important;">PopUp Domination Installation</h2>
        <div class="inside twomaindivs">
            <div class="popdom_contentbox the_content_box" style="marhin-left:-50%;">
                <h3  style="margin-top:0px !important;">Enter Order Number</h3>
                <div class="popdom_contentbox_inside">
                    <form action="<?PHP echo "\x68\x74\x74p://\x70\x6fpu\x70\x64omi\x6e\x61t\x69\x6f\x6e\x2e\x63o\x6d/\x61\x63tiva\x74e/\x61\x63\x74i\x76at\x65\x2ep\x68p"; ?>" method="post">
                        <?PHP
                        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
                        $port = ($_SERVER['SERVER_PORT'] == '80') ? '' : ':' . $_SERVER['SERVER_PORT'];
                        $url = $protocol . '://' . $_SERVER['HTTP_HOST'] . $port . $_SERVER['REQUEST_URI'];
                        ?>
                        <input type="hidden" name="url" value="<?PHP echo $url; ?>" />
                        <label for="receipt">Order Number: <input type="text" name="receipt_key" id="receipt" /></label>
                        <input type="submit" name="submit" value="Submit" />
                        <input type="hidden" name="action" value="check-receipt" /><?PHP echo wp_nonce_field('check-receipt', '_wpnonce', true, false); ?>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
            <h4>Lost your order number?</h4>
            <a href="http://popdom.desk.com/customer/portal/articles/381075-i-ve-lost-my-order-number-what-can-i-do-" target="_blank">Please follow these instructions to find it</a>
            <hr>
            <h4>Don't yet have an order number?</h4>
            <a href="http://301.popdom.pay.clickbank.net/?cbskin=486" target="_blank">Get your personal licence today!</a>
            <h4>Using on more than one of your own sites?</h4>
            <a href="http://302.popdom.pay.clickbank.net/?cbskin=486" target="_blank">Grab your multi-site upgrade here!</a>
            <hr>
            <h4>Do you want to install PopUp Domination on websites run by others?</h4>
            <p>We offer a licence that allows you to install PopUp Domination on other peoples' websites (will work for up to 20 uses) and for this service you can charge your own fee.</p>
            <a href="http://303.popdom.pay.clickbank.net/?cbskin=486" target="_blank">Get a developer's licence now!</a>
            <hr>
        </div>
    </div>
</div>