<?PHP

/*
  Plugin Name: PopUp Domination
  Author: PopUp Domination Team
  Version: 3.9.1
  Author URI: http://www.popupdomination.com
  Description: The Ultimate plugin to increase your list size. Make more money by using our beautiful themes and specific functionality to grow your subscriber list by over 500%.
 */

class PopUp_Domination {

    /**
     * Setting up all variables needed throughout the classes.
     */
    var $base_name = '';
    var $menu_url = '';
    var $theme_path = '';
    var $theme_url = '';
    var $plugin_url = '';
    var $plugin_path = '';
    var $opts_url = '';
    var $install_url = '';
    var $currentcss = '';
    var $newcampid = '';
    var $wpadmin_page = '';
    var $themes = array();
    var $natypes = array('.original.php', '.original.htm', '.original.html', '.original.css', '.original.txt');
    var $atypes = array('.php', '.htm', '.html', '.css', '.txt');
    var $is_preview = false;
    var $version = '3.9.1';
    var $custominputs = 0;
    var $submenu = array();
    var $curpage = array();
    var $campaigns = array();
    var $campaigndata = array();
    var $abcamp = array();
    var $update_msg = '';
    var $success = false;
    var $facebook = '';
    var $user = '';
    var $TMP = '';
    var $show_anim = '';
    var $show_where = '';
    var $show_background = '';
    var $allow_background_close = '';
    var $show_referral = array();
    var $show_opacity = 70;
    var $show_color = '#000000';
    var $no_form_themes = array('giveaway', 'lightbox-redirect', 'limitedtime1', 'limitedtime2', 'social-1', 'social-2', 'social-3', 'social-vid', 'lightbox1-redirect', 'yesorno');
    /**
     * PopUp_Domination();
     *
     * The Daddy function in the plugin. ALL Main funcitonailty (hooks, filters, Ajax Hooks ect) all get registered here.
     * This function is fired as soon as the plugin is turned on and fired after ever function Wordpress does.
     */
    function PopUp_Domination() {
        /**
         * More objects being set.
         */
        $this->base_name = plugin_basename(__FILE__);
        $this->menu_url = dirname(plugin_basename(__FILE__)) . '/';
        $this->plugin_url = WP_PLUGIN_URL . '/' . dirname($this->base_name) . '/';
        $this->plugin_path = WP_PLUGIN_DIR . '/' . dirname($this->base_name) . '/';
        $this->theme_url = $this->plugin_url . 'themes/';
        $this->theme_path = $this->plugin_path . 'themes/';

        if(!defined('POPUP_DOM_PATH'))
            define('POPUP_DOM_PATH', $this->plugin_path);

        $checkifpopdom = 0;


        //Hook into the 'wp_dashboard_setup' action to register our other functions
        add_action('wp_dashboard_setup', array(&$this, 'popup_domination_dashboard_widget'));


        /**
         * Check if license already checked.
         */
        $check = $this->option('v3installed');
        if(isset($check) && $check == 'Y') {
            $this->update('installed', 'Y');
        }
        /**
         * For backing up themes after user logs in.
         */
        add_action('wp_login', array(&$this, 'login_move'));
        add_action('init', array(&$this, 'facebook'));

        $port = ($_SERVER['SERVER_PORT'] == '80') ? '' : ':' . $_SERVER['SERVER_PORT'];
        $base = '//' . $_SERVER['HTTP_HOST'] . $port . $_SERVER['REQUEST_URI'];

        if(function_exists('admin_url'))
            $url = admin_url('admin.php?page=' . $this->base_name);
        else
            $url = 'admin.php?page=' . $this->base_name;

        $install = $base;
        $this->opts_url = $url;
        $this->install_url = $install;
        $this->install_fin = "admin.php?page=popup-domination/campaigns";
        if(is_admin()) {
            /**
             * Encoded plugin Updater functionality.
             * Don't change unless update JSON location is ever moved.
             */
            try {
                require 'plugin-update-checker.php';
                $hfscmxvsri = "\x45\x78\x61m\x70\x6c\x65Upda\x74e\x43\x68\x65\x63\x6b\x65\x72";
                ${$hfscmxvsri} = new PluginUpdateChecker("\x68\x74tp://\x70o\x70\x75\x70\x64om\x69\x6eation.c\x6f\x6d/upd\x61t\x65-ch\x65\x63\x6b/\x75pd\x61t\x65.\x6as\x6fn", __FILE__, "\x70\x6f\x70up\x2d\x64om\x69na\x74i\x6f\x6e", 12, "p\x6fpu\x70\x5fdo\x6dina\x74io\x6e\x5f\x75\x70\x64\x61te\x69nf\x6f");
            } catch(Exception $e) {
                // TODO: Handle update errors
            }

            if(isset($_GET['page'])) {
                $wpadmin_page = $_GET['page'];
                $checkifpopdom = strpos($wpadmin_page, 'domination/');
            }

            add_action('admin_menu', array(&$this, 'admin_menu'));
            add_filter('plugin_action_links', array(&$this, 'plugin_action_links'), 10, 2);
        }
        /**
         * If plugin installed an verified as 3.0.
         */
        if($ins = $this->option('v3installed')) {
            if(is_admin()) {
                add_action('admin_bar_menu', array(&$this, 'custom_menu'), 1000);
                add_action('wp_dashboard_setup', array(&$this, 'popup_domination_dashboard_widget'));
                /**
                 * Check if update info is in DB. If running newest version, move themes from backup folder. (See login_move() for break down)
                 */
                $current_plugin_version_tmp = $this->get_db('options', 'option_name = "popup_domination_updateinfo"', 'option_value');
                if(isset($current_plugin_version_tmp[0]->option_value) && !empty($current_plugin_version_tmp[0]->option_value)) {
                    $current_plugin_version = unserialize($current_plugin_version_tmp[0]->option_value);
                    $version_check = $this->fixclass('stdClass', $current_plugin_version->update);
                    if(isset($this->version) && isset($version_check->version) && $this->version >= $version_check->version) {
                        if($this->dir_is_empty(WP_PLUGIN_DIR . '/popdom-themes-backup/') != NULL || file_exists(WP_PLUGIN_DIR . '/popdom-themes-backup/')) {
                            $this->theme_backup('Y');
                            $this->update("updateinfo", "");
                        }
                    }
                }
                /**
                 * Admin Ajax Functions.
                 */
                add_action('wp_ajax_popup_domination_file_upload', array(&$this, 'upload_file'));
                add_action('wp_ajax_popup_domination_upload_theme', array(&$this, 'upload_theme'));
                add_action('wp_ajax_popup_domination_upload_theme_remote', array(&$this, 'upload_theme_remote'));
                add_action('wp_ajax_popup_domination_activation', array(&$this, 'activate'));
                add_action('wp_ajax_popup_domination_clear_cookie', array(&$this, 'clear_cookie'));
                add_action('wp_ajax_popup_domination_aweber_cookies', array(&$this, 'aweber_cookies_clear'));
                add_action('wp_ajax_popup_domination_preview', array(&$this, 'preview'));
                add_action('wp_ajax_popup_domination_mailing_client', array(&$this, 'get_mailing_list'));
                add_action('wp_print_scripts', array(&$this, 'wp_print_scripts'));
                add_action('init', array(&$this, 'adblock_bypass'));
                add_action('wp_ajax_popup_domination_copy', array(&$this, 'copy_campaign'));
                add_action('wp_ajax_popup_domination_toggle', array(&$this, 'toggle_campaign'));
                add_action('wp_ajax_popup_domination_delete', array(&$this, 'deletecamp'));
                add_action('wp_ajax_popup_domination_check_name', array(&$this, 'check_camp_name'));
                add_action('wp_ajax_popup_domination_campaigns', array(&$this, 'load_campaigns_select'));
            } else {
                add_action('wp_enqueue_scripts', array(&$this, 'wp_print_scripts'));
                add_action('wp_print_styles', array(&$this, 'wp_print_styles'));
                add_action('init', array(&$this, 'adblock_bypass'));
            }
            /**
             * Front-End Ajax Functions.
             */
            add_action('wp_ajax_nopriv_popup_domination_lightbox_get', array(&$this, 'lightbox_get'));
            add_action('wp_ajax_popup_domination_lightbox_get', array(&$this, 'lightbox_get'));
            add_action('wp_ajax_nopriv_popup_domination_lightbox_submit', array(&$this, 'lightbox_submit'));
            add_action('wp_ajax_popup_domination_lightbox_submit', array(&$this, 'lightbox_submit'));
            add_action('wp_ajax_nopriv_popup_domination_ab_split', array(&$this, 'lightbox_split_db'));
            add_action('wp_ajax_popup_domination_ab_split', array(&$this, 'lightbox_split_db'));
            add_action('wp_ajax_nopriv_popup_domination_analytics_add', array(&$this, 'analytics_add'));
            add_action('wp_ajax_popup_domination_analytics_add', array(&$this, 'analytics_add'));
            add_action('the_content', array(&$this, 'popdom_inpost'));
            add_shortcode('popdom', array(&$this, 'popdom_shortcode_handler'));
            add_filter('widget_text', 'do_shortcode'); // this allows us to make shortcodes work in the sidebar!
        } else {
            /**
             * Functions for non-verfied stages.
             */
            $url = 'admin.php?page=' . $this->base_name;
            $install = 'admin.php?page=popup-domination/install';
            add_action('admin_menu', array(&$this, 'install_menu'));
        }
    }

    // Create the function use in the action hook
    function popup_domination_dashboard_widget() {
        wp_add_dashboard_widget('popup_domination_dashboard_widget', 'PopUp Domination', array(&$this, 'popup_domination_dashboard_function'));
        $this->place_at_top();
    }

    // Create the function to output the contents of our Dashboard Widget
    function popup_domination_dashboard_function() {

        $rss = array();
        $rss = fetch_feed('http://www.popupdomination.com/blog/feed/');
        if(!is_wp_error($rss)) {
            $maxitems = $rss->get_item_quantity(5);
            $rss_items = $rss->get_items(0, $maxitems);
            if($maxitems == 0) {
                _e('No items', 'PopUp Domination News');
            } else {
                foreach($rss_items as $item) {
                    echo '<p><strong><a href="' . esc_url($item->get_permalink()) . '" title="' . $item->get_title() . '">' . $item->get_title() . '</a></strong><br />';
                    echo '<small><em>Posted on ' . $item->get_date('j F Y | g:i a') . '</em></small></p>';
                    echo '<p>' . $item->get_description() . '</p>';
                }
            }
        } else {
            //periodically update this string to reflect current feed
            echo '<p><strong><a href="http://www.popupdomination.com/blog/popup-domination-3-5-4-4/" title="PopUp Domination 3.5.4.4 Download Now Available!">PopUp Domination 3.5.4.4 Download Now Available!</a></strong><br><small><em>Posted on 15 July 2013 | 3:24 pm</em></small></p>
<p>We’ve just released PopUp Domination version 3.5.4.4 for WordPress into your download links and the WordPress updater system. This edition has a couple of cool additions we’re sure you’ll love. New Preview System! This one’s been a long time coming, our old preview system was, well, rubbish. If you had any CSS on your site[...]</p>
<p><strong><a href="http://www.popupdomination.com/blog/popup-domination-3-5-4-1-out-now/" title="PopUp Domination 3.5.4.1 out now!">PopUp Domination 3.5.4.1 out now!</a></strong><br><small><em>Posted on 12 June 2013 | 9:45 am</em></small></p>
<p>We’ve released our latest version today which should be showing up in your plugin updaters throughout the day if it’s not already there. (Or you can grab it from your download link) While mostly a bug-fix point release we have added a couple of additional functional improvements. We’ve been taking your feedback on board and[...]</p>
<p><strong><a href="http://www.popupdomination.com/blog/popup-domination-3-5-3-9/" title="PopUp Domination 3.5.3.9">PopUp Domination 3.5.3.9</a></strong><br><small><em>Posted on 22 May 2013 | 4:10 pm</em></small></p>
<p>Today marks the release of PopUp Domination 3.5.3.9 in your download links. This is a mostly bug-fix release but we have released two features in particular that we think you’ll like. Optional mobile device support for popup campaigns! Yes, finally our popups can be shown to mobile devices as an option within their display settings.[...]</p>
<p><strong><a href="http://www.popupdomination.com/blog/popup-domination-3-5-3-3-released/" title="PopUp Domination for WordPress 3.5.3.3 Released!">PopUp Domination for WordPress 3.5.3.3 Released!</a></strong><br><small><em>Posted on 1 February 2013 | 2:12 pm</em></small></p>
<p>We’ve got a new release of PopUp Domination out today featuring some awesome features, many in response to suggestions from you, our users. It’s already in your download links so go get it! So what’s new? Introducing IN-POST themes! We’ve added the ability to add a styled form to the end of your posts or[...]</p>
<p><strong><a href="http://www.popupdomination.com/blog/popupdomination-analytics-fix/" title="PD Analytics Fix">PD Analytics Fix</a></strong><br><small><em>Posted on 1 May 2012 | 2:44 pm</em></small></p>
<p>Today we released an update for PopUp Domination to fix some of the the little bugs that have been affecting our users. Some of our users have been unhappy that their Analytics were not working correctly and therefore, could not accurately tell what was working for them and what wasn’t. Well today we hope to[...]</p>';
        }
    }

    function place_at_top() {
        global $wp_meta_boxes;

        // Get the regular dashboard widgets array
        // (which has our new widget already but at the end)
        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

        // Backup and delete our new dashbaord widget from the end of the array
        $example_widget_backup = array('popup_domination_dashboard_widget' => $normal_dashboard['popup_domination_dashboard_widget']);
        unset($normal_dashboard['popup_domination_dashboard_widget']);

        // Merge the two arrays together so our widget is at the beginning
        $sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

        // Save the sorted array back into the original metaboxes
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
    }

    function facebook() {
        if($this->option('facebook_enabled', false) == 'Y') {
            require $this->plugin_path . 'inc/facebook/facebook.php';
            $this->facebook = new Facebook(array(
                'appId' => $this->option('facebook_id', false),
                'secret' => $this->option('facebook_sec', false),
                'cookie' => true,
            ));
        }
        if(is_admin()) {
            /**
             * Register all Stylesheets if the user is navigating to plugin's admin pages.
             */
            wp_register_style('popup-domination-page', $this->rewrite_script('css/page.css?ver='.$this->version));
            wp_register_style('popup-domination-sidebar', $this->rewrite_script('css/sidebar.css?ver='.$this->version));
            wp_register_style('popup-domination-campaigns', $this->rewrite_script('css/campaigns.css?ver='.$this->version));
            wp_register_style('popup-domination-anayltics', $this->rewrite_script('css/analytics.css?ver='.$this->version));
            wp_register_style('popup-domination-ab', $this->rewrite_script('css/ab.css?ver='.$this->version));
            wp_register_style('popup-domination-mailing', $this->rewrite_script('css/mailing.css?ver='.$this->version));
            wp_register_style('popup-domination-promote', $this->rewrite_script('css/promote.css?ver='.$this->version));
            wp_register_style('popup-domination-support', $this->rewrite_script('css/support.css?ver='.$this->version));
            wp_register_style('fancybox', $this->rewrite_script('js/fancybox/jquery.fancybox-1.3.4.css?ver='.$this->version));
            wp_register_style('fileuploader', $this->rewrite_script('css/fileuploader.css?ver='.$this->version));
            wp_register_style('the_graphs', $this->rewrite_script('css/graph.css?ver='.$this->version));
        }
    }

    /**
     * login_move();
     *
     * Backs up and moves themes from outsite PopDom folder.
     * Updates overwrites themes, basic work around as no support from WP.
     */
    function login_move() {
        $this->theme_backup();
    }

    /**
     * dir_is_empty();
     *
     * Used for theme backup.
     */
    function dir_is_empty($dir) {
        if(!is_readable($dir))
            return NULL;
        return (count(scandir($dir)) == 2);
    }

    /**
     * theme_backup();
     *
     * Backs up and moves themes. Used in conjuction with login_move() & PopUp_Domination().
     */
    function theme_backup($move = NULL) {
        $themeDir = $this->plugin_path . 'themes';
        $backupDir = WP_PLUGIN_DIR . '/' . 'popdom-themes-backup';
        $backupDirExists = file_exists($backupDir);
        if(!$backupDirExists) {
            $backupDirExists = @mkdir($backupDir, 0755);
        }
        if($backupDirExists) { //by this time we know if we can backup themes at all
            $installedThemes = scandir($themeDir);
            $backedUpThemes = scandir($backupDir);
            $themesNeedingBackedUp = array_diff($installedThemes, $backedUpThemes); //themes missing from the backup directory
            $themesNeedingReinstated = array_diff($backedUpThemes, $installedThemes); //themes existing in backup directory but missing from theme directory
            foreach($themesNeedingBackedUp as $theme) {
                $this->full_copy("{$themeDir}/{$theme}", "{$backupDir}/{$theme}");
            }
            foreach($themesNeedingReinstated as $theme) {
                $this->full_copy("{$backupDir}/{$theme}", "{$themeDir}/{$theme}");
            }
        }
    }

    /**
     * fixclass();
     *
     * $current_plugin_version->version comes back as a broken class.
     * This baby fixes that for use in the login_move().
     */
    function fixclass($class, $object) {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
    }

    /**
     * deleteDir();
     *
     * Ronseal.
     */
    function deleteDir($path) {
        $this_func = array($this, __FUNCTION__);
        return is_file($path) ?
                @unlink($path) :
                array_map($this_func, glob($path . '/*')) == @rmdir($path);
    }

    /**
     * full_copy();
     *
     * Copies a directory and all files in it.
     * Used for theme backup.
     */
    function full_copy($source, $target) {
        if(is_dir($source)) {
            @mkdir($target);
            $d = dir($source);
            while(FALSE !== ( $entry = $d->read() )) {
                if($entry == '.' || $entry == '..') {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                $cleantarget = str_replace("//", "/", $target . "/" . $entry);
                if(is_dir($Entry)) {
                    $this->full_copy($Entry, $cleantarget);
                    continue;
                }
                @copy($Entry, $cleantarget);
            }
            $d->close();
        } else {
            @copy($source, $target);
        }
    }

    /**
     * aweber_cookies_clear()
     *
     * Used to clear cookies the aweber api needs to connect to accounts.
     * Fixes error when using aweber api.
     */
    function aweber_cookies_clear() {
        if(wp_verify_nonce($_POST['wpnonce'], 'update-options')) {
            setcookie('accessToken', '', time() - 60 * 60 * 24 * 100, '/' . $_POST['wpurl'] . 'inc/');
            setcookie('accessTokenSecret', '', time() - 60 * 60 * 24 * 100, '/' . $_POST['wpurl'] . 'inc/');
            setcookie('awTokenSecret', '', time() - 60 * 60 * 24 * 100, '/');
            setcookie('awToken', '', time() - 60 * 60 * 24 * 100, '/');
            setcookie('aw_getlists', '', time() - 60 * 60 * 24 * 100, '/');
            $this->update('formapi', '', false);
        } else {
            echo '{"error":"Verification failed, please refresh the page and try again."}';
        }
        exit;
    }

    /**
     * clear_cookie()
     *
     * Clears the cookies stopping the PopUp from appearing.
     */
    function clear_cookie() {
        if(wp_verify_nonce($_GET['_wpnonce'], 'update-options')) {
            if($_GET['id'] == 0) {
                $id = 'zero';
            } else if($_GET['id'] == 1) {
                $id = 'one';
            } else if($_GET['id'] == 3) {
                $id = 'three';
            } else if($_GET['id'] == 4) {
                $id = 'four';
            } else {
                $id = $_GET['id'];
            }
            setcookie('popup_domination_hide_lightbox' . $id, '', time() - 1, COOKIEPATH);
            setcookie('popup_domination_hide_ab' . $id, '', time() - 1, COOKIEPATH);
            $mailing_lists = $this->get_mailing_lists();
            foreach($mailing_lists as $id => $name) {
                setcookie('popup_domination_hide_mailing' . $id, '', time() - 1, COOKIEPATH);
            }

            echo '{"done":"done"}';
        } else {
            echo '{"error":"Verification failed, please refresh the page and try again."}';
        }
        die();
    }

    /**
     * lastday()
     *
     * Works out if it's the last day of the month.
     * Used in Conjuction with analytics_add().
     */
    function lastday($month = '', $year = '') {
        if(empty($month)) {
            $month = date('m');
        }
        if(empty($year)) {
            $year = date('Y');
        }
        $result = strtotime("{$year}-{$month}-01");
        $result = strtotime('-1 second', strtotime('+1 month', $result));
        return date('d-m-Y', $result);
    }

    /**
     * analytics_add()
     *
     * Adds analytic data for a PopUp into the DB.
     * Trigger through the Ajax in PopUp_Domination().
     */
    function analytics_add() {
        if(!is_numeric($_POST['popupid'])) {
            exit('Illegal operation. Exiting.');
        }
        $campaigns = $this->get_db('popdom_campaigns', 'id = ' . $_POST['popupid']);
        $index = ($_POST['stage'] == 'opt-in') ? 'conversions' : 'views';
        if(!empty($campaigns)) {
            $campaign = $campaigns[0];
            $year = date('Y');
            $month = date('m');
            $analytics = unserialize($campaign->analytics);
            if(!empty($analytics)) {
                if(array_key_exists($year, $analytics)) {
                    $thisyear = &$analytics[$year];
                    if(array_key_exists($month, $thisyear)) {
                        $thismonth = &$thisyear[$month];
                        $thismonth[$index] ++;
                    } else {
                        $analytics[$year][$month] = array('views' => 1, 'conversions' => 0);
                    }
                } else {
                    $analytics[$year][$month] = array('views' => 1, 'conversions' => 0);
                }
            } else {
                $analytics[$year][$month] = array('views' => 1, 'conversions' => 0);
            }
            $analytics_data = serialize($analytics);
            $this->write_db('popdom_campaigns', array('analytics' => $analytics_data), array('%s'), true, array('id' => $campaign->id), array('%d'));
        } else {
            exit("No campaign found.");
        }
        die();
    }

    /**
     *  popdom_inpost()
     *  over-rides the normal content display hook to append popups
     *  to posts/pages after the content rather than overlay style
     */
    function popdom_inpost($content) {
        if($this->show_anim == "inpost" && is_singular() && empty($this->shortcode_campaign_id)) {
            $inpostPopup = "<div id='popdom-inline-container'>\n";
            $inpostPopup .= stripslashes($this->output);
            $inpostPopup .= "\n</div>\n";
            return $content . $inpostPopup;
        } else
            return $content;
    }

    /**
     * generate_js()
     *
     * returns all the data and produces this on the web page.
     */
    function generate_js($delay, $center, $cookie_time, $opts = array(), $show_opt, $show_anim, $show_where, $show_opacity, $advance_custom_css, $disable_analytics, $show_color, $show_background, $allow_background_close, $unload_msg, $icount = 0, $redirect) {
        $js = '';
        if(count($opts) > 0) {
            foreach($opts as $o) {
                if(!empty($o['default']) && !empty($o['class'])) {
                    $js .= (($js == '') ? '' : ',') . '".' . $o['class'] . '":"' . $this->input_val($o['default']) . '"';
                }
            }
        }
        return 'var popup_domination_defaults = {' . $js . '}, delay = ' . floatval($delay) . ', popup_domination_cookie_time = ' . floatval($cookie_time) . ', popup_domination_center = \'' . $center . '\', popup_domination_cookie_path = \'' . $this->cookie_path . '\', popup_domination_show_opt = \'' . $show_opt . '\', popup_domination_unload_msg = \'' . $this->input_val($unload_msg) . '\', popup_domination_impression_count = ' . intval($icount) . ', popup_domination_redirect = \'' . $redirect . '\' , popup_domination_anim = \'' . $show_anim . '\', popup_domination_where = \'' . $show_where . '\', popup_domination_opacity = \'' . $show_opacity . '\', popup_domination_advance_custom_css = \'' . $advance_custom_css . '\', popup_domination_disable_analytics = \'' . $disable_analytics . '\', popup_domination_color = \'' . $show_color . '\', popup_domination_show_background = \'' . $show_background . '\', popup_domination_allow_background_close = \'' . $allow_background_close . '\'; ';
    }

    /**
     * lightbox_split_db()
     *
     * Sorts out the analytics data for the A/B Split Testing.
     * Trigger through the Ajax in PopUp_Domination().
     */
    function lightbox_split_db() {
        if(!is_numeric($_POST['popupid']) || !is_numeric($_POST['camp']))
            exit('Illegal operation. Exiting.');

        $datasplit = $this->get_db('popdom_ab', 'id = ' . $_POST['camp'], 'astats');
        $current = array();
        $current = $datasplit[0]->astats;

        if(empty($current['popupid']))
            $current[$_POST['popupid']] = array(date('m') => array('optin' => '', 'show' => ''));
        else
            $current = unserialize($current);

        if(array_key_exists($_POST['popupid'], $current)) {
            if($_POST['stage'] == 'opt-in') {
                $current[$_POST['popupid']][date('m')]['optin'] = $current[$_POST['popupid']][date('m')]['optin'] + 1;
            } else if($_POST['stage'] == 'show') {
                $current[$_POST['popupid']][date('m')]['show'] = $current[$_POST['popupid']][date('m')]['show'] + 1;
            }
        } else {
            $current[$_POST['popupid']] = array(date('m') => array('optin' => '', 'show' => ''));
            if($_POST['stage'] == 'opt-in')
                $current[$_POST['popupid']][date('m')]['optin'] = 1;
            else if($_POST['stage'] == 'show')
                $current[$_POST['popupid']][date('m')]['show'] = 1;
        }
        $popup = serialize($current);
        $update = $this->write_db('popdom_ab', array('astats' => $popup), array('%s'), 'true', array('id' => $_POST['camp']), array('%s'));
        die();
    }

    /**
     * get_db()
     *
     * Generic database retreval code, used all over the shop to grab data from the main 3 PopDom tables.
     */
    function get_db($from, $where = NULL, $select = NULL, $single = NULL, $and = NULL, $array = NULL) {
        global $wpdb;
        if($where != NULL)
            $where = 'WHERE ' . $where;
        else
            $where = '';

        if($and != NULL)
            $and = 'AND WHERE ' . $and;
        else
            $and = '';

        if($select == NULL) {
            $select = '*';
            $results = $wpdb->get_results("SELECT $select FROM `{$wpdb->prefix}$from` $where $and");
        } else {
            if($array == NULL)
                $results = $wpdb->get_results("SELECT $select FROM `{$wpdb->prefix}$from` $where $and");
            else
                echo 'Setup is wrong, check function';
        }
        return $results;
    }

    /**
     * write_db()
     *
     * Generic database write code, used all over the shop to write data to the main 3 PopDom tables.
     */
    function write_db($table, $values = NULL, $array = NULL, $update = NULL, $where = NULL, $wherearray = NULL) {
        global $wpdb;
        $table = $wpdb->prefix . $table;
        if($update == NULL) {
            $results = $wpdb->insert($table, $values, $array);
            $this->newcampid = $wpdb->insert_id;
        } else
            $results = $wpdb->update($table, $values, $where, $array, $wherearray);

        return $results;
    }

    /**
     * delete_db()
     *
     * Generic database delete code, used all over the shop to delete data to the main 3 PopDom tables.
     */
    function delete_db($table, $rowid, $column = NULL) {
        global $wpdb;
        $table = $wpdb->prefix . $table;
        if(isset($column) && $column != NULL) {
            $results = $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE $column = %s", $rowid));
        } else
            $results = $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id = %d", $rowid));

        return $results;
    }

    /**
     * wp_print_scripts()
     *
     * Enqueues all javascript scripts on front end and admin end.
     * Checks if user is "in" PopDom admin panels before registering admin scripts.
     */
    function wp_print_scripts($shortcode_campaign_id = false) {
        global $pagenow;
        global $plugin_page;
        global $new_preview;
        global $wp_scripts;

        if(is_admin()) {
            $this->wpadmin_page = isset($_GET['page']) ? $_GET['page'] : '';
            $checkifpopdom = strpos($this->wpadmin_page, 'popup-domination/');
            if(isset($plugin_page) && $checkifpopdom > -1) {
                wp_enqueue_script('popup_domination', $this->rewrite_script('js/page.js?ver='.$this->version), array('jquery', 'jquery-ui-core', 'jquery-ui-slider'), '3.0');

                $queryui = $wp_scripts->query('jquery-ui-core');
                wp_enqueue_style('jquery-ui-smoothness', 'http://ajax.googleapis.com/ajax/libs/jqueryui/' . $queryui->ver . '/themes/smoothness/jquery-ui.css', false, null);
                wp_enqueue_script('wp-color-picker');
                wp_enqueue_style('wp-color-picker');
                if(strstr($this->wpadmin_page, 'mailinglist')) {
                    if(isset($_GET['action'])) {
                        wp_enqueue_script('thickbox-js', $this->rewrite_script('js/fancybox/jquery.fancybox-1.3.4.pack.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_domination_mailing', $this->rewrite_script('js/mailing/mailing.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_domination_mailchimp', $this->rewrite_script('js/mailing/mailchimp.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_aweber', $this->rewrite_script('js/mailing/aweber.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_icontact', $this->rewrite_script('js/mailing/icontact.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_constant_contact', $this->rewrite_script('js/mailing/constantcontact.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_campaign_monitor', $this->rewrite_script('js/mailing/campaignmonitor.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_get_response', $this->rewrite_script('js/mailing/getresponse.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_email', $this->rewrite_script('js/mailing/email.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                        wp_enqueue_script('popup_domination_html_form', $this->rewrite_script('js/mailing/htmlform.js?ver='.$this->version), array('jquery', 'popup_domination', 'popup_domination_mailing'), '3.0');
                    } else {
                        wp_enqueue_script('popup_dominaton_delete_command', $this->rewrite_script('js/delete.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_dominaton_copy', $this->rewrite_script('js/copy.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                    }
                } else if(strstr($this->wpadmin_page, 'promote')) {
                    wp_enqueue_script('popup_domination_promote', $this->rewrite_script('js/promote/promote.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                } else if(strstr($this->wpadmin_page, 'a-btesting')) {
                    if(!empty($_GET['action'])) {
                        wp_enqueue_script('popup_domination_abtesting', $this->rewrite_script('js/ab/abtesting.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_domination_graphs', $this->rewrite_script('js/graphs.jquery.1.0.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                    } else {
                        wp_enqueue_script('popup_dominaton_delete_command', $this->rewrite_script('js/delete.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_dominaton_toggle', $this->rewrite_script('js/toggle.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_dominaton_copy', $this->rewrite_script('js/copy.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                    }
                } else if(strstr($this->wpadmin_page, 'analytics')) {
                    wp_enqueue_script('popup_domination_graphs', $this->rewrite_script('js/graphs.jquery.1.0.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                    wp_enqueue_script('popup_domination_analytics', $this->rewrite_script('js/analytics/analytics.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                } else if(strstr($this->wpadmin_page, 'theme_upload')) {
                    wp_enqueue_script('ajax-theme-uploader', $this->rewrite_script('js/theme_upload/fileuploader.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                    wp_enqueue_script('popup_domination_theme_upload', $this->rewrite_script('js/theme_upload/themeupload.js?ver='.$this->version), array('jquery', 'popup_domination', 'ajax-theme-uploader'), '3.0');
                } else if(strstr($this->wpadmin_page, 'support')) {
                    wp_enqueue_script('popup_domination_support', $this->rewrite_script('js/support/support.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                } else if(strstr($this->wpadmin_page, 'campaigns')) {
                    if(isset($_GET['action'])) {
                        wp_enqueue_script('ajax-upload', $this->rewrite_script('js/campaign/ajaxupload.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_domination_campaigns', $this->rewrite_script('js/campaign/admin_lightbox.js?ver='.$this->version), array('jquery', 'popup_domination', 'ajax-upload'), '13.0');
                    } else {
                        wp_enqueue_script('popup_dominaton_delete_command', $this->rewrite_script('js/delete.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_dominaton_toggle', $this->rewrite_script('js/toggle.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                        wp_enqueue_script('popup_dominaton_copy', $this->rewrite_script('js/copy.js?ver='.$this->version), array('jquery', 'popup_domination'), '3.0');
                    }
                }
                //wp_enqueue_script('popup_dominaton_master_jquery',$plugin_url.'js/master.js',array('jquery'),'3.0');
                //wp_enqueue_script('popup_domination_placeholder_support',$plugin_url.'js/placeholder.jquery.js',array('jquery', 'popup_domination'),'3.0');     
            }
        } else {
            //check if popdom should even be on the page, if not don't show anything!
            //global $post;
            $post = get_queried_object();
            $ab_data = $this->get_db('popdom_ab');
            $campaigns_data = $this->get_db('popdom_campaigns');
            $should_load = false;
            if(!empty($ab_data)) {
                foreach($ab_data as $ab_test) {
                    $schedule = unserialize($ab_test->schedule);
                    $active = $ab_test->active;
                    if($active) {
                        if(($schedule['everywhere'] == 'Y')) {
                            $should_load = true;
                        } elseif($schedule['front'] == 'Y' && (is_front_page() || is_home())) {
                            $should_load = true;
                        } else {
                            if(!empty($schedule['pageid'])) {
                                foreach($schedule['pageid'] as $page_id) {
                                    if($page_id == $post->ID)
                                        $should_load = true;
                                }
                            }

                            if(!empty($schedule['catid'])) {
                                foreach($schedule['catid'] as $cat_id) {
                                    if(has_category($catid, $post->ID))
                                        $should_load = true;
                                }
                            }
                        }
                    }
                }
            }
            if(!empty($campaigns_data) && !$should_load) {
                foreach($campaigns_data as $campaign) {
                    $schedule = unserialize($campaign->pages);
                    $active = $campaign->active;
                    if($active) {
                        if($campaign->id === $shortcode_campaign_id) {
                            $should_load = true;
                        } elseif(isset($schedule['everywhere']) && $schedule['everywhere'] == 'Y') {
                            $should_load = true;
                        } elseif((isset($schedule['front']) && $schedule['front'] == 'Y') && (is_front_page() || is_home())) {
                            $should_load = true;
                        } else {
                            if(!empty($schedule['pageid'])) {
                                foreach($schedule['pageid'] as $page_id) {
                                    if(isset($post->ID) && $page_id == $post->ID)
                                        $should_load = true;
                                }
                            }

                            if(!empty($schedule['catid'])) {
                                foreach($schedule['catid'] as $cat_id) {
                                    if(has_category($catid, $post->ID))
                                        $should_load = true;
                                }
                            }
                        }

                        if(!empty($_SERVER['HTTP_REFERER']) && isset($campaign->data)) {
                            $camp_data = unserialize($campaign->data);
                            if(is_array($camp_data) && isset($camp_data['schedule']) && !empty($camp_data['schedule']['show_referral'])) {
                                $show_referral = unserialize($camp_data['schedule']['show_referral']);
                                if(is_array($show_referral)) {
                                    foreach($show_referral as $referral) {
                                        if(strpos($_SERVER['HTTP_REFERER'], $referral) !== false)
                                            $should_load = true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $should_load = true;
            if($should_load && !in_array($pagenow, array('wp-login.php', 'wp-register.php'))) {
                if(!is_404()) {
                    wp_enqueue_script('jquery');
                    wp_enqueue_script('popup_domination_lightbox', $this->rewrite_script('js/load_lightbox.js?ver='.$this->version), array('jquery'), $this->version, get_option('popup_domination_enqueue_footer', false));
                    $this->load_lightbox($shortcode_campaign_id);
                }
            }
        }
    }

    /**
     * check_rewrite()
     *
     * Checks if rewrite is working on server.
     */
    function check_rewrite($rewrite_rule) {
        if(!function_exists('curl_init'))
            return false;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, get_site_url() . '/' . $rewrite_rule . '/css/rewrite_test.css');
        curl_setopt($ch, CURLOPT_USERAGENT, 'Wordpress');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);

        update_option('popupdomination_bypass_working', (strpos($output, '#popup_domination_rewrite_test') !== false));
        return (strpos($output, '#popup_domination_rewrite_test') !== false);
    }

    /**
     * rewrite_script()
     *
     * Used to generate the include URL injection with adblock_bypass()
     */
    public function rewrite_script($url) {
        if(!get_option('popup_domination_adblock_bypass', true))
            return $this->plugin_url . $url;
        
        $url = substr($url, ($pos = strrpos($url, 'plugins/popup-domination/')) !== false ? $pos + 25 : 0);

        if(!defined('ABSPATH') || !is_writable(ABSPATH . '/.htaccess'))
            return $this->plugin_url . $url;

        $htaccess = file_get_contents(ABSPATH . '/.htaccess');

        if($htaccess === false)
            return $this->plugin_url . $url;

        preg_match('/# BEGIN PopUpBypass(.*?)# END PopUpBypass/si', $htaccess, $matches);
        $rewrite_rule = false;

        if(isset($matches[1])) {
            $rewrite_rules = preg_split("/\\r\\n|\\r|\\n/", $matches[1]);
            foreach($rewrite_rules as $rewrite_rule) {
                if(strpos($rewrite_rule, 'RewriteRule') !== false) {
                    $rewrite_rule = explode(' ', $rewrite_rule);
                    $rewrite_rule = str_replace(array('^', '(.*)', '$'), '', $rewrite_rule[1]);
                    break;
                }
            }
        } else {
            $rand = uniqid();
            $rule = '# BEGIN PopUpBypass' . PHP_EOL .
                    '<IfModule mod_rewrite.c>' . PHP_EOL .
                    'RewriteEngine On' . PHP_EOL .
                    'RewriteBase /' . PHP_EOL .
                    'RewriteRule ^' . $rand . '/(.*)$ /wp-content/plugins/popup-domination/$1 [NC,L]' . PHP_EOL .
                    '</IfModule>' . PHP_EOL . '# END PopUpBypass' . PHP_EOL . PHP_EOL;
            file_put_contents(ABSPATH . '/.htaccess', $rule . preg_replace('/# BEGIN PopUpBypass(.*?)# END PopUpBypass/si', '', $htaccess));
            $rewrite_rule = $rand . '/';

            if(!$this->check_rewrite($rewrite_rule)) {
                file_put_contents(ABSPATH . '/.htaccess', '# BEGIN PopUpBypass' . PHP_EOL . '# END PopUpBypass' . PHP_EOL . PHP_EOL . preg_replace('/# BEGIN PopUpBypass(.*?)# END PopUpBypass/si', '', $htaccess));
                $rewrite_rule = false;
            }
        }

        if($rewrite_rule !== false && !empty($rewrite_rule))
            return '/' . $rewrite_rule . $url;
        else
            return $this->plugin_url . $url;
    }

    /**
     * adblock_bypass()
     *
     * Setup rewrite rules to bypass Ad Blocker. Ignoring rewrite issues by checking ourselfs
     */
    function adblock_bypass() {
        $allowed_ext = array('js', 'css', 'html', 'jpg', 'png');
        $key = '/meh/';
        if(strpos($_SERVER['REQUEST_URI'], $key) === 0) {
            $request = $this->plugin_path . str_replace(array($key, '..', '@'), '', array_shift(explode('?', $_SERVER['REQUEST_URI'])));
            if(file_exists($request) && in_array(pathinfo($request, PATHINFO_EXTENSION), $allowed_ext))
                echo file_get_contents($request);

            die();
        }
    }

    /**
     * show_var()
     *
     * ???
     */
    function show_var($backup = false) {
        $var = 'show';
        if($backup)
            $var .= '_backup';
        $$var = array();
        if($s = $this->option($var, false)) {
            if(!empty($s)) {
                if(is_array($s))
                    $$var = $s;
                else
                    $$var = unserialize($s);
            }
        }
        return $$var;
    }

    /**
     * plugin_action_links()
     *
     * When users click settings in the plugin menu, this kicks in and re-directs them to admin panels.
     */
    function plugin_action_links($links, $file) {
        if($file == $this->base_name) {
            $ins = '';
            if($ins != $this->option('v3installed')) {
                array_unshift($links, 
                    '<a href="admin.php?page=popup-domination/campaigns">' . __('Settings') . '</a>', 
                    '<a href="admin.php?page=popup-domination/debug">' . __('Debug') . '</a>'
                );
            } else
                array_unshift($links, '<a href="options-general.php?page=popup-domination/install">' . __('Settings') . '</a>');
        }
        return $links;
    }

    /**
     * is_active_campaign()
     *
     * @param campaign_id int to find
     */
    function is_active_campaign($campaign_id = null) {
        if($campaign_id == null) {
            return false;
        } else {
            $this_campaign = $this->get_db("popdom_campaigns", "id = $campaign_id");
            return ($this_campaign->active);
        }
    }

    function is_inpost_campaign($campaign_id = null) {
        if($campaign_id == null)
            return false;
        else {
            $this_campaign = $this->get_db("popdom_campaigns", "id = $campaign_id AND data LIKE '%show_anim\";s:6:\"inpost%'");
            return (!empty($this_campaign));
        }
    }

    /**
     * upload_file()
     *
     * PHP for image files uploaded through the plugin.
     * Moves images to upload folder in wp-content.
     */
    function upload_file() {
        if(wp_verify_nonce($_POST['_wpnonce'], 'update-options') && isset($_POST['template']) && $t = $this->get_theme_info($_POST['template'])) {
            if(isset($_POST['fieldid'])) {
                if($field = $this->get_field($t, $_POST['fieldid'])) {
                    $uploads = wp_upload_dir();
                    $fileobj = $_FILES['userfile'];
                    if(!function_exists('wp_handle_upload'))
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                    if(!function_exists('wp_generate_attachment_metadata'))
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                    if(!empty($fileobj['tmp_name']) && file_is_displayable_image($fileobj['tmp_name'])) {
                        if($file = wp_handle_upload($fileobj, array('test_form' => false, 'action' => 'wp_handle_upload'))) {
                            $sizes = array();
                            if(isset($field['field_opts'])) {
                                $opts = $field['field_opts'];
                                if(isset($opts['max_w']) && isset($opts['max_h']))
                                    $sizes = array($opts['max_w'], $opts['max_h']);
                            }
                            $image_url = $file['url'];
                            if(count($sizes) == 2) {
                                $resized = image_make_intermediate_size($file['file'], $sizes[0], $sizes[1]);
                                if($resized)
                                    $image_url = $uploads['url'] . '/' . $resized['file'];
                            }
                            $attachment = array('post_title' => $fileobj['name'],
                                'post_content' => '',
                                'post_status' => 'inherit',
                                'post_mime_type' => $file['type'],
                                'guid' => $image_url);
                            $aid = wp_insert_attachment($attachment, $file['file'], 0);
                            if(!is_wp_error($aid)) {
                                wp_update_attachment_metadata($aid, wp_generate_attachment_metadata($aid, $file['file']));
                                echo $image_url . '|' . $aid . '|';
                            } else {
                                echo 'error|<strong>Upload Error:</strong> ' . $aid->get_error_message();
                            }
                            exit;
                        }
                    } else {
                        echo 'error|<strong>Upload Error:</strong> The file you tried to upload is not a valid image.';
                        exit;
                    }
                }
            }
        }
        echo 'error|<strong>Upload Error:</strong> There was an error finding the field.';
        die();
    }

    /**
     * upload_theme()
     *
     * PHP for processing and unzipping uploaded themes through then uploader.
     */
    function upload_theme() {
        error_reporting(0);
        require 'php.php';
        $allowedExtensions = array();
        // max file size in bytes
        $sizeLimit = 5 * 1024 * 1024;

        $file = new qqFileUploader($allowedExtensions, $sizeLimit);
        $name = $file->getName();

        /* Remove previous uploads, just in case */
        try {
            @unlink($this->plugin_path . 'tmp/' . $name);
        } catch (Exception $e) {
            /* TODO: Handle errors */
        }

        $result = $file->handleUpload($this->plugin_path . 'tmp/', true);
        if($result['success'] == '1') {
            /**
             * Checks if .zip saved in TMP folder then unzips.
             * Has some hacks for working with WP unzipper as some ppl may not have PHP upzip applied on server.
             */
            function __return_direct() {
                return 'direct';
            }

            add_filter('filesystem_method', '__return_direct');
            WP_Filesystem();
            remove_filter('filesystem_method', '__return_direct');
            $folder = $this->plugin_path . 'themes/';
            unzip_file($this->plugin_path . 'tmp/' . $name, $folder);
            $this->theme_backup();
            echo '{success:true}';
        } else {
            if(!empty($result['error']))
                echo '{error:"' . $result['error'] . '"}';
            else
                echo '{error:"Theme uploading failed for an unknown reason, please contact support@popupdomination.com for further assistance"}';
        }

        /* Keep the tmp folder clean! */
        try {
            unlink($this->plugin_path . 'tmp/' . $name);
        } catch (Exception $e) {
            /* TODO: Handle errors */
        }
        die();
    }

    function upload_theme_remote() {
        error_reporting(0);
        if(empty($_GET['update_url']))
            die();

        $temp_name = md5(rand(0, getrandmax()) + rand(0, getrandmax()));

        /* Keep the tmp folder clean! */
        try {
            //@unlink($this->plugin_path . 'tmp/theme_update.zip');
        } catch (Exception $e) {
            /* TODO: Handle errors */
        }

        try {
            /* Figure out max execution time */
            $max_time_limit = 180;
            while ($max_time_limit) {
                if (set_time_limit($max_time_limit))
                    break;
                $max_time_limit--;
            }
        } catch (Exception $e) {
            /* TODO: Handle errors */
        }

        $update_url = $_GET['update_url'];
        if($this->download($update_url, $this->plugin_path.'tmp/theme_'.$temp_name.'.zip')) {
            /**
             * Checks if .zip saved in TMP folder then unzips.
             * Has some hacks for working with WP unzipper as some ppl may not have PHP upzip applied on server.
             */
            function __return_direct() {
                return 'direct';
            }

            add_filter('filesystem_method', '__return_direct');
            WP_Filesystem();
            remove_filter('filesystem_method', '__return_direct');

            unzip_file($this->plugin_path . 'tmp/theme_'.$temp_name.'.zip', $this->plugin_path . 'themes/');
            $this->theme_backup();
        } else
            die('Failed to download '.$update_url);

        /* Keep the tmp folder clean! */
        try {
            @unlink($this->plugin_path . 'tmp/theme_'.$temp_name.'.zip');
        } catch (Exception $e) {
            /* TODO: Handle errors */
        }

        die('Update complete');
    }

    /**
     * Download
     * @return bool || void
     */
    function download($url, $path) {
        $fp = fopen($path, 'w+');
        $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        if(filesize($path) > 0)
            return true;
    }

    /**
     * sort_array()
     *
     * Ronseal.
     */
    function sort_array($a, $b) {
        if($a['name'] == $b['name'])
            return 0;
        return ($a['name'] < $b['name']) ? -1 : 1;
    }

    /**
     * get_field()
     *
     * Gets theme fields from the theme.txt file.
     */
    function get_field($theme, $field) {
        if(empty($field))
            return false;
        if(!isset($theme['fields']))
            return false;
        foreach($theme['fields'] as $f) {
            if($f['field_opts']['id'] == $field)
                return $f;
        }
        return false;
    }

    /**
     * option()
     *
     * Security checks and gets data from PopDom fields in wp_options.
     */
    function option($key, $enc = true) {
        return (($enc) ? $this->encode(get_option('popup_domination_' . $key)) : get_option('popup_domination_' . $key));
    }

    /**
     * update()
     *
     * Security checks and saves data from PopDom fields in wp_options.
     */
    function update($key, $val, $enc = true) {
        update_option('popup_domination_' . $key, (($enc) ? $this->encode($val) : $val));
    }

    /**
     * encode()
     *
     * Removes html code to stop the plugin from breaking.
     * Used for the field inputs in the campaign builder.
     */
    function encode($str, $striptags = true) {
        if($striptags) {
            $str = strip_tags($str, '<b><strong><em><i><br>');
            $str = preg_replace('{<br\s*>}si', '<br />', $str);
        }
        return $str;
    }

    /**
     * encode2()
     *
     * Removes script and style tags to stop plugin from breaking.
     * used for the field inputs in the campaign builder.
     */
    function encode2($str) {
        $str = preg_replace('{<style[^>]*>.*</style>}si', '', $str);
        $str = preg_replace('{<script[^>]*>.*</script>}si', '', $str);
        return utf8_encode(stripslashes($str));
    }

    /**
     * check_file_type()
     *
     * ???
     */
    function check_file_type($file, $types = array(), $natypes = array()) {
        if(empty($file))
            return false;
        if(count($types) == 0 && count($natypes) == 0)
            return true;
        $lower = strtolower($file);
        $fl = strlen($file);
        if(count($natypes) > 0) {
            foreach($natypes as $n) {
                $nl = strlen($n);
                $tmp = substr($lower, ($fl - $nl), $nl);
                if($tmp == $n)
                    return false;
            }
        }
        if(count($types) > 0) {
            foreach($types as $t) {
                $tl = strlen($t);
                $tmp = substr($lower, ($fl - $tl), $tl);
                if($tmp == $t)
                    return true;
            }
        }
        return false;
    }

    /**
     * get_file_list()
     *
     * Gets a full list of files that are in a directory.
     */
    function get_file_list($dir, $dirs = false, $types = array(), $natypes = array()) {
        $t_dir = @opendir($dir);
        if(!$t_dir)
            return false;
        $na = array('', '.', '..');
        $files = array();
        while(($file = readdir($t_dir)) !== false) {
            if(!in_array($file, $na)) {
                if($dirs) {
                    if(is_dir($dir . $file))
                        $files[] = $file;
                } else {
                    if(!is_dir($dir . $file)) {
                        if($this->check_file_type($file, $types, $natypes))
                            $files[] = $file;
                    }
                }
            }
        }
        if($t_dir)
            @closedir($t_dir);
        return $files;
    }

    /**
     * get_theme_info()
     *
     * Ronseal. Gets the theme info from the theme.txt file.
     */
    function get_theme_info($t) {
        $files = $this->get_file_list($this->theme_path . $t);
        $files = (is_array($files)) ? $files : array();
        if(in_array('theme.txt', $files)) {
            $template_data = implode('', file($this->theme_path . $t . '/theme.txt'));
            $name = '';
            $opts = array();
            if(preg_match('|Template Name:(.*)$|mi', $template_data, $name)) {
                $opts['name'] = _cleanup_header_comment($name[1]);
                $opts['center'] = 'N';
                if(preg_match('|Center:(.*)$|mi', $template_data, $size))
                    $opts['center'] = _cleanup_header_comment($size[1]);
                if(preg_match('|Preview Size:(.*)$|mi', $template_data, $size))
                    $opts['size'] = array_filter(explode('x', _cleanup_header_comment($size[1])));
                $opts['ext'] = 'png';
                if(preg_match('|Preview Ext:(.*)$|mi', $template_data, $ext))
                    $opts['ext'] = _cleanup_header_comment($ext[1]);
                if(preg_match('|Colors:(.*)$|mi', $template_data, $color)) {
                    $opts['colors'] = $this->color_opts($t, $opts['ext'], array_filter(explode(' | ', _cleanup_header_comment($color[1]))));
                } else {
                    if(file_exists($this->theme_path . $t . '/preview.' . $opts['ext']))
                        $opts['img'] = $t . '/preview.' . $opts['ext'];
                }
                if(preg_match('|Button Colors:(.*)$|mi', $template_data, $colors))
                    $opts['button_colors'] = $this->button_colors($t, array_filter(explode('|', _cleanup_header_comment($colors[1]))));
                if(preg_match('|List Items:(.*)$|mi', $template_data, $list))
                    $opts['list'] = intval(_cleanup_header_comment($list[1]));
                if(preg_match('|Fields:(.*)$|mi', $template_data, $fields))
                    $opts['fields'] = $this->field_opts(array_filter(explode('|', _cleanup_header_comment($fields[1]))));
                if(preg_match('|NumberExtraInputs:(.*)$|mi', $template_data, $numfields))
                    $opts['numfields'] = intval(_cleanup_header_comment($numfields[1]));
                if(preg_match('|In Post:(.*)$|mi', $template_data, $inpost))
                    $opts['inpost'] = _cleanup_header_comment($inpost[1]);
                if(preg_match('|Version:(.*)$|mi', $template_data, $inpost))
                    $opts['version'] = _cleanup_header_comment($inpost[1]);
                $opts['theme'] = $t;
                return $opts;
            }
        }
        return false;
    }

    /**
     * field_opts()
     *
     * Gets all field options.
     * Used in conjuction with get_theme_info().
     */
    function field_opts($fields = array()) {
        if(is_array($fields) && count($fields) > 0) {
            $arr = array();
            foreach($fields as $f) {
                $tmp_arr = array();
                $f2 = explode('[', $f);
                $tmp_arr['name'] = $f2[0];
                $f2 = explode(']', $f2[1]);
                $f2 = array_filter(explode(',', $f2[0]));
                $tmp_arr['field_opts'] = array();
                foreach($f2 as $a => $b) {
                    $f3 = explode(':', $b);
                    if(count($f3) > 1) {
                        $tmp_arr['field_opts'][$f3[0]] = $f3[1];
                    }
                }
                $arr[] = $tmp_arr;
            }
            return $arr;
        }
        return false;
    }

    /**
     * color_opts()
     *
     * Gets all colour options for the templates.
     * Used in conjuction with get_theme_info().
     */
    function color_opts($t, $ext, $colors = array()) {
        if(is_array($colors) && count($colors) > 0) {
            $arr = array();
            foreach($colors as $c) {
                $tmp_arr = array();
                $c2 = explode('[', $c);
                $tmp_arr['name'] = $c2[0];
                $c2 = explode(']', $c2[1]);
                $info = array_filter(explode(':', $c2[0]));
                $file = $t . '/previews/' . $info[0] . '.' . $ext;
                if(file_exists($this->theme_path . $file) && is_file($this->theme_path . $file)) {
                    $info[2] = $file;
                }
                $tmp_arr['info'] = $info;
                $arr[] = $tmp_arr;
            }
            return $arr;
        }
        return false;
    }

    /**
     * button_colors()
     *
     * Gets all button colour options for the templates.
     * Used in conjuction with get_theme_info().
     */
    function button_colors($t, $colors = array()) {
        if(is_array($colors) && count($colors) > 0) {
            $arr = array();
            foreach($colors as $c) {
                $tmp_arr = array();
                $c2 = explode('[', $c);
                $tmp_arr['name'] = $c2[0];
                if(!empty($c2[1])) {
                    $c2 = explode(']', $c2[1]);
                    $tmp_arr['color_id'] = $c2[0];
                }
                $arr[] = $tmp_arr;
            }
            usort($arr, array(&$this, 'sort_array'));
            return $arr;
        }
        return false;
    }

    /**
     * get_themes()
     *
     * Ronseal.
     * Used for dropdown list of themes in campaign builder.
     */
    function get_themes($inline = false) {
        if(count($this->themes) == 0 || $inline) {
            $themes = $this->get_file_list($this->theme_path, true);
            $this->themes = array();
            foreach($themes as $t) {
                if($t = $this->get_theme_info($t)) {
                    if(!empty($t['inpost']) == $inline) {
                        $this->themes[] = $t;
                    }
                }
            }
            usort($this->themes, array(&$this, 'sort_array'));
        }
        return $this->themes;
    }

    /**
     * show_lightbox()
     *
     * ???
     */
    function show_lightbox() {
        echo $this->load_lightbox();
    }

    /**
     * page_list_recursive()
     *
     * Get list of pages from the WP DB.
     * Used in campaign builder "display settings".
     */
    function page_list_recursive($parentid = 0, $exclude = '', $selected = array()) {
        $pages = get_pages('parent=' . $parentid . '&child_of=' . $parentid . '&exclude=' . $exclude);
        if(count($pages) > 0) {
            $str = '
    <ul class="children">';
            foreach($pages as $p) {
                $sel = false;
                if(isset($selected['pageid']) && in_array($p->ID, $selected['pageid']))
                    $sel = true;
                $str .= '
      <li><input type="checkbox" name="popup_domination_show[pageid][]" value="' . $p->ID . '" id="pageid_' . $p->ID . '"' . (($sel) ? ' checked="checked"' : '') . ' /> <label for="pageid_' . $p->ID . '">' . esc_html($p->post_title) . '</label>' . $this->page_list_recursive($p->ID, $exclude, $selected) . '</li>';
            }
            $str .= '
    </ul>';
            return $str;
        }
    }

    /**
     * cat_list_recursive()
     *
     * Get list of categories from the WP DB.
     * Used in campaign builder "display settings".
     */
    function cat_list_recursive($parentid = 0, $selected = array()) {
        $cats = get_categories('hide_empty=0&child_of=' . $parentid . '&parent=' . $parentid);
        if(count($cats) > 0) {
            $str = '<ul class="children">';
            foreach($cats as $c) {
                $sel = false;
                if(isset($selected['catid']) && in_array($c->cat_ID, $selected['catid']))
                    $sel = true;
                $str .= ' <li><input type="checkbox" name="popup_domination_show[catid][]" value="' . $c->cat_ID . '" id="catid_' . $c->cat_ID . '"' . (($sel) ? ' checked="checked"' : '') . ' /> <label for="catid_' . $c->cat_ID . '">' . esc_html($c->cat_name) . '</label>' . $this->cat_list_recursive($c->cat_ID, $selected) . '</li>';
            }
            $str .= '</ul>';
            return $str;
        }
        return '';
    }

    /**
     * input_val()
     *
     * Security for all input fields.
     */
    function input_val($str) {
        $str = htmlspecialchars($str);
        $str = str_replace(array("'", '"'), array('&#39;', '&quot;'), $str);
        return $str;
    }

    /**
     * get_cur_url()
     *
     * Ronseal. Used for cURL.
     */
    function get_cur_url() {
        return '//' . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] != '80') ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['REQUEST_URI'];
    }

    /**
     * lightbox_submit()
     *
     * Ajax triggered, loads file where plugin does action depening on the mailing list provider selected.
     */
    function lightbox_submit() {
        include $this->plugin_path . 'inc/submitdetails.php';
        die();
    }

    /**
     * lightbox_get()
     *
     * 
     */
    function lightbox_get() {
        require_once('popup-domination.front.php');
        echo $popup_domination->load_lightbox();
        die();
    }

    /*
     *  Introduced to help transport users currently on earlier 3.0 versions onto verion 3.5
     *
     *  CHANGES REQUIRED
     *
     *  Mailing list table added
     *  Daily analytics row added
     *  Past analytics row added and imported from Analytics table
     *  Change A/B references to unique
     *  Analytics table deleted
     */

    function version_3_5_upgrade() {
        //add mailing table
        global $wpdb;
        $table = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "popdom_mailing` (
              `id` int(25) NOT NULL auto_increment,
              `name` varchar(55) collate utf8_general_ci NOT NULL,
              `description` longtext collate utf8_general_ci NOT NULL,
              `settings` longtext collate utf8_general_ci NOT NULL,
              PRIMARY KEY  (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($table);

        //add the two rows to campaign table
        $alter = "ALTER TABLE `" . $wpdb->prefix . "popdom_campaigns` ADD COLUMN `analytics` longtext NOT NULL DEFAULT '', ADD COLUMN `active` int(25) NOT NULL DEFAULT 0";
        $wpdb->query($alter);
        $alter = "ALTER TABLE `" . $wpdb->prefix . "popdom_ab` ADD COLUMN `active` int(25) NOT NULL DEFAULT 0";
        $wpdb->query($alter);

        //import analytics into campaign table
        $analytics = $this->get_db("popdom_analytics");
        $campaign_analytics = array();
        foreach($analytics as $config) {
            $analytic = array();
            $analytic['name'] = $config->campname;
            $analytic['views'] = $config->views;
            $analytic['conversions'] = $config->conversions;
            $analytic['analytics'] = unserialize($config->previousdata);
            $campaign_analytics[] = $analytic;
        }

        //modify how analytics are referenced
        $campaigns = $this->get_db("popdom_campaigns");
        foreach($campaigns as $config) {
            $campaign_name = $config->campaign;
            foreach($campaign_analytics as $analytic) {
                $analytic_name = $analytic['name'];
                if($campaign_name == $analytic_name) {
                    $id = $config->id;
                    $year = date('Y');
                    $month = date('m');
                    $campaign = array();
                    $campaign[$year][$month] = array('views' => $analytic['views'], 'conversions' => $analytic['conversions']);
                    if(!empty($analytic['analytics'])) {
                        foreach($analytic['analytics'] as $thatmonth => $details) {
                            $campaign[$year][$thatmonth] = $details;
                        }
                    }
                    $analytics_data = serialize($campaign);
                    $save = $this->write_db('popdom_campaigns', array('analytics' => $analytics_data, 'active' => 1), array('%s', '%s', '%s'), true, array('id' => $id), array('%d'));
                }
            }
        }


        /* Convert A/B to reference ID's and not names */
        $ab_campaigns = $this->get_db("popdom_ab");
        foreach($ab_campaigns as $config) {
            $ab = array();
            $id = $config->id;
            $ab['campaigns'] = unserialize($config->campaigns);

            $ids = array();
            if(!empty($ab['campaigns'])) {
                foreach($ab['campaigns'] as $name) {
                    $campaigns = $this->get_db('popdom_campaigns', 'campaign="' . $name . '"');
                    if(!empty($campaigns)) {
                        $campaign = $campaigns[0];
                        $ids[] = $campaign->id;
                    }
                }
            }
            $ab_campaigns_used = serialize($ids);
            $this->write_db('popdom_ab', array('campaigns' => $ab_campaigns_used, 'active' => 1), array('%s'), true, array('id' => $id), array('%d'));
        }
    }

    function custom_menu() {
        global $wp_admin_bar;
        if(!is_super_admin() || !is_admin_bar_showing())
            return;
        /*
          $argsParent=array(
          'id' => 'popdom_menu',
          'title' => 'Popup Domination',
          'href' => false
          );
          $wp_admin_bar->add_menu($argsParent);
          $argsSub1 = array(
          'parent' => 'popdom_menu',
          'title' => 'Clear Display Cookie',
          'href' => '#',
          'meta' => array('onclick' => 'document.cookie = &quot;popup_domination_hide_lightbox2=N;expires=Thu, 01 Jan 1970 00:00:01 GMT;&quot;; alert(&quot;Display cookie cleared&quot;);')
          );
          $wp_admin_bar->add_menu($argsSub1);
         */
    }

}

/**
 * Don't fiddle with these, helps manage the 3 file system.
 */
if(!function_exists('_cleanup_header_comment')) {
    function _cleanup_header_comment($str) {
        return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
    }
}

if(is_admin())
    require_once plugin_basename('popup-domination.admin.php');
else
    require_once plugin_basename('popup-domination.front.php');