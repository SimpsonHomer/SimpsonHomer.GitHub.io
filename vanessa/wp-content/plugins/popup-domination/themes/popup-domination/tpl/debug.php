<div class="wrap with-sidebar" id="popup_domination">
    <?PHP
    $header_link = 'Debug';
    $header_url = '#';
    include($this->plugin_path . 'tpl/header.php');
    ?>
    <form action="<?PHP echo $this->opts_url ?>" method="post" id="popup_domination_form">
        <div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields ?></div>
        <div class="clear"></div>
        <div id="popup_domination_container" class="has-left-sidebar">
            <div style="display:none" id="popup_domination_hdn_div2"></div>
            <div id="popup_domination_tabs" class="tab-menu">
                <a class="icon feel selected" href="#">Debug</a>
            </div>
            <div class="flotation-device">
                <center><h2 style="color:red;"><strong>Warning!</strong> Some of the options on this page may cause irreversible changes to PopUp Domination. Please use with caution.</h2></center>
                <?PHP
                global $wp_version, $wpdb;
                ?>
                <hr />
                <br />
                <table>
                    <tr>
                        <td><strong>WordPress Version</strong></td>
                        <td><?PHP echo $wp_version; ?></td>
                    </tr>
                    <tr>
                        <td><strong>PHP Version</strong></td>
                        <td><?PHP echo phpversion(); ?></td>
                    </tr>
                   <tr>
                        <td><strong>Server Time</strong></td>
                        <td><?PHP echo time(); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Server</strong></td>
                        <td><?PHP echo php_uname(); ?></td>
                    </tr>
                    <tr>
                        <td><strong>PopUp Domination Version</strong>&nbsp;</td>
                        <td><?PHP echo $this->version; ?></td>
                    </tr>
                    <tr>
                        <td><strong>PopUp Domination Path</strong></td>
                        <td><?PHP echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>DB AB Count</strong></td>
                        <td><?PHP echo $wpdb->get_var('SELECT COUNT(*) FROM '.$wpdb->prefix.'popdom_ab'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>DB Campaigns Count</strong></td>
                        <td><?PHP echo $wpdb->get_var('SELECT COUNT(*) FROM '.$wpdb->prefix.'popdom_campaigns'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>DB Mailing Count</strong></td>
                        <td><?PHP echo $wpdb->get_var('SELECT COUNT(*) FROM '.$wpdb->prefix.'popdom_mailing'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>AdBlock Bypass (Option Method)</strong>&nbsp;</td>
                        <td><?PHP echo (get_option('popup_domination_adblock_bypass', true) ? 'Enabled' : 'Disabled'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Experimental Theme Updater (Option Method)</strong>&nbsp;</td>
                        <td><?PHP echo (get_option('popup_domination_theme_updater', false) ? 'Enabled' : 'Disabled'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Server Time Checker (Option Method)</strong>&nbsp;</td>
                        <td><?PHP echo(get_option('popup_domination_server_time_checker', true) ? 'Enabled' : 'Disabled'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Experimental Footer Scripts Support (Option Method)</strong>&nbsp;</td>
                        <td><?PHP echo (get_option('popup_domination_enqueue_footer', false) ? 'Enabled' : 'Disabled'); ?></td>
                    </tr>
                </table>
                <br />
                <hr />
                <br />
                <form method="post">
                    <?PHP wp_nonce_field('popdom_debug'); ?>
                    <input type="submit" name="action" value="Clear All WP Options">
                    <br /><br />
                    <input type="submit" name="action" value="Clear DB AB">
                    <input type="submit" name="action" value="Clear DB Campaigns">
                    <input type="submit" name="action" value="Clear DB Mailing">
                    <input type="submit" name="action" value="Clear DB ALL">
                    <br /><br />
                    <input type="submit" name="action" value="Enable AdBlock Bypass (Option Method)">                    
                    <input type="submit" name="action" value="Disable AdBlock Bypass (Option Method)">
                    <br /><br />
                    <input type="submit" name="action" value="Enable Experimental Theme Updater">
                    <input type="submit" name="action" value="Disable Experimental Theme Updater">
                    <br /><br />
                    <input type="submit" name="action" value="Enable Server Time Checker">
                    <input type="submit" name="action" value="Disable Server Time Checker">
                    <br /><br />
                    <input type="submit" name="action" value="Enable Experimental Footer Scripts Support">
                    <input type="submit" name="action" value="Disable Experimental Footer Scripts Support">
                </form>
                <br /><br />
                <hr />
                <?PHP echo $debug_resp; ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clear"></div>
        <?PHP
        $page_javascript = '';
        include $this->plugin_path . 'tpl/footer.php';
        ?>
    </form>
</div>