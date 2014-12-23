<?PHP
if(!class_exists('PopUp_Domination'))
    die('No direct access allowed. PopUp Domination Admin');

/**
 * Admin Class
 *
 * All admin dashboard functionality goes in this class.
 */
class PopUp_Domination_Admin extends PopUp_Domination {

    function PopUp_Domination_Admin() {
        parent::PopUp_Domination();
    }

    /**
     * admin_menu()
     *
     * Setups up the dashboard menu and the virtual plugin's admin panel.
     */
    function admin_menu() {
        $ins = '';
        if($ins != $this->option('v3installed')) {
            $this->submenu['main'] = add_menu_page('PopUp Domination', 'PopUp Domination', 'manage_options', 'popup-domination/campaigns', array(&$this, 'admin_page'), $this->rewrite_script('css/images/icon.png'));
            $this->submenu['campaigns'] = add_submenu_page('popup-domination/campaigns', 'Campaigns', 'Campaigns', 'manage_options', 'popup-domination/campaigns', array(&$this, 'admin_page'));
            $this->submenu['mailing'] = add_submenu_page('popup-domination/campaigns', 'Mailing List Manager', 'Mailing List Manager', 'manage_options', $this->menu_url . 'mailinglist', array(&$this, 'admin_page'));
            $this->submenu['ab'] = add_submenu_page('popup-domination/campaigns', 'A/B Testing', 'A/B Testing', 'manage_options', $this->menu_url . 'a-btesting', array(&$this, 'admin_page'));
            $this->submenu['analytics'] = add_submenu_page('popup-domination/campaigns', 'Analytics', 'Analytics', 'manage_options', $this->menu_url . 'analytics', array(&$this, 'admin_page'));
            $this->submenu['theme'] = add_submenu_page('popup-domination/campaigns', 'Theme Installer', 'Theme Installer', 'manage_options', $this->menu_url . 'theme_upload', array(&$this, 'admin_page'));
            $this->submenu['promote'] = add_submenu_page('popup-domination/campaigns', 'Sell PopUp Domination', 'Sell PopUp Domination', 'manage_options', $this->menu_url . 'promote', array(&$this, 'admin_page'));
            $this->submenu['support'] = add_submenu_page('popup-domination/campaigns', 'Support', 'Support', 'manage_options', $this->menu_url . 'support', array(&$this, 'admin_page'));
            $this->submenu['upgrade'] = add_submenu_page('popup-domination/campaigns', 'Support', '- Upgrade', 'manage_options', $this->menu_url . 'support#upgrade', array(&$this, 'admin_page'));
            add_submenu_page(NULL, '', '', 'manage_options', $this->menu_url . 'verify_themeclub', array(&$this, 'admin_page'));
            add_submenu_page(NULL, '', '', 'manage_options', $this->menu_url . 'debug', array(&$this, 'admin_page'));
            $this->admin_styles();
        }
    }

    /**
     * install_menu()
     *
     * Setups the menu seen before the plugin is verfied.
     */
    function install_menu() {
        $this->submenu['main'] = add_menu_page('PopUp Domination', 'PopUp Domination', 'manage_options', 'popup-domination/install', array(&$this, 'installation_process'), $this->rewrite_script('css/images/icon.png'));
        $this->submenu['install'] = add_submenu_page('popup-domination/install', 'Install', 'Install', 'manage_options', $this->menu_url . 'install', array(&$this, 'installation_process'));
        //$this->submenu['support'] = add_submenu_page('popup-domination/install', 'Support', 'Support','manage_options', $this->menu_url.'support', array(&$this, 'admin_page'));
    }

    /**
     * admin_styles_()
     *
     * Registers each stylesheet for each panel.
     * Works in conjustion with admin_styles() to load each only when the user navigates to that panel (no extra css loading).
     */
    function admin_styles_page() {
        wp_enqueue_style('popup-domination-page');
    }

    function admin_styles_campaigns() {
        wp_enqueue_style('popup-domination-campaigns');
    }

    function admin_styles_verify_themeclub() {
        wp_enqueue_style('popup-domination-campaigns');
    }

    function admin_styles_ab() {
        wp_enqueue_style('popup-domination-ab');
    }

    function admin_styles_fancybox() {
        wp_enqueue_style('fancybox');
    }

    function admin_styles_analytics() {
        wp_enqueue_style('popup-domination-anayltics');
    }

    function admin_styles_support() {
        wp_enqueue_style('popup-domination-support');
    }

    function admin_styles_mailing() {
        wp_enqueue_style('popup-domination-mailing');
        wp_enqueue_style('fancybox');
    }

    function admin_styles_graphs() {
        wp_enqueue_style('the_graphs');
    }

    function admin_styles_theme_upload() {
        wp_enqueue_style('fileuploader');
    }

    function admin_styles_promote() {
        wp_enqueue_style('popup-domination-promote');
    }

    function url_origin($s, $use_forwarded_host=false) {
        $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
        $sp = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $s['SERVER_PORT'];
        $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
        $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
        $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
        return $protocol . '://' . $host;
    }
    
    function full_url($s, $use_forwarded_host=false) {
        return $this->url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
    }    
    
    /**
     * admin_styles()
     *
     * Works out url in relation to wordpress and then decides which panel user is on a loads correct function for stylesheet.
     */
    function admin_styles() {
        if(empty($this->curpage))
            $this->curpage = '';
            
        $this->opts_url = $this->full_url($_SERVER);

        foreach($this->submenu as $t) {
            $subpages[] = str_replace('popup-domination_page_popup-domination/', '', $t);
        }
        
        if(!empty($_GET['page']))
            $this->curpage = str_replace('popup-domination/', '', $_GET['page']);

        if(!empty($_GET['action']))
            $this->curpage .= '&action';
        else if(!empty($_GET['id']))
            $this->curpage .= '&id';
        else if(!empty($_GET['path']))
            $this->curpage .= '&path';
        
        add_action('admin_print_styles', array(&$this, 'admin_styles_page'));

        switch($this->curpage) {
            case 'sidebar':
                add_action('admin_print_styles', array(&$this, 'admin_styles_sidebar'));
                break;
            case 'campaigns':
                add_action('admin_print_styles', array(&$this, 'admin_styles_campaigns'));
                break;
            case 'analytics':
                add_action('admin_print_styles', array(&$this, 'admin_styles_analytics'));
                break;
            case 'a-btesting':
                add_action('admin_print_styles', array(&$this, 'admin_styles_campaigns'));
                break;
            case 'mailinglist':
                add_action('admin_print_styles', array(&$this, 'admin_styles_mailing'));
                break;
            case 'promote':
                add_action('admin_print_styles', array(&$this, 'admin_styles_promote'));
                break;
            case 'theme_upload':
                add_action('admin_print_styles', array(&$this, 'admin_styles_theme_upload'));
                break;
            case 'verify_themeclub':
                add_action('admin_print_styles', array(&$this, 'admin_styles_verify_themeclub'));
                break;
            case 'theme_remove':
                add_action('admin_print_styles', array(&$this, 'admin_styles_theme_upload'));
                break;
            case 'campaigns&action':
                add_action('admin_print_styles', array(&$this, 'admin_styles_campaigns'));
                break;
            case 'a-btesting&action':
                add_action('admin_print_styles', array(&$this, 'admin_styles_ab'));
                add_action('admin_print_styles', array(&$this, 'admin_styles_graphs'));
                break;
            case 'analytics&id':
                add_action('admin_print_styles', array(&$this, 'admin_styles_analytics'));
                add_action('admin_print_styles', array(&$this, 'admin_styles_graphs'));
                break;
            case 'mailinglist&path':
                if(!empty($_GET['path']) && !empty($_GET['path']))
                    $this->connect_mailing();
            case 'mailinglist&action':
                if(!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier']))
                    require_once($this->plugin_path.'/inc/aweber.php');
                
                add_action('admin_print_styles', array(&$this, 'admin_styles_mailing'));
                break;
            case 'support':
                add_action('admin_print_styles', array(&$this, 'admin_styles_support'));
                break;
            default:
                add_action('admin_print_styles', array(&$this, 'admin_styles_campaigns'));
                break;
        }
    }

    /**
     * installation_process()
     *
     * Encoded functionality for verifying the plugin.
     * Also contain encoded install code.
     */
    function installation_process() {
        global$wpdb;
        ${"G\x4c\x4fB\x41\x4cS"}["\x72\x74\x6eu\x65\x6aj\x72\x68"] = "\x62";
        ${"G\x4c\x4fB\x41L\x53"}["\x75pu\x68f\x6b\x78\x6fc\x75"] = "\x61";
        $xsfwvqrbf = "t\x61\x62\x6c\x65\x73";
        ${"G\x4c\x4fB\x41L\x53"}["\x64\x6b\x77\x67\x73o"] = "\x64\x65\x66\x61ul\x74\x73";
        ${"GLOB\x41\x4c\x53"}["jt\x7a\x71wh\x6e\x63"] = "\x74\x61bl\x65\x73";
        ${$xsfwvqrbf} = array("C\x52E\x41\x54\x45 T\x41\x42\x4cE I\x46\x20\x4eO\x54 E\x58\x49S\x54S \x60" . $wpdb->prefix . "pop\x64\x6f\x6d\x5f\x63a\x6d\x70aigns\x60 (\n\t\t\t\t\x20 \x60\x69d` i\x6et(25)\x20\x4eO\x54\x20\x4eU\x4c\x4c \x61u\x74o\x5finc\x72em\x65\x6et,\n\t\t\t\t\x20\x20\x60\x63a\x6d\x70a\x69\x67\x6e\x60 va\x72c\x68\x61\x72(55)\x20\x63ol\x6c\x61te \x75tf8_\x67ene\x72\x61l\x5f\x63i\x20\x4e\x4fT NU\x4cL,\n\t\t\t\t\x20\x20`\x64a\x74\x61\x60 l\x6f\x6eg\x74\x65\x78\x74\x20co\x6c\x6ca\x74\x65\x20\x75\x74f8\x5fg\x65\x6ee\x72\x61l_\x63\x69\x20\x4e\x4fT NUL\x4c,\n\t\t\t\t\x20 `p\x61ge\x73`\x20\x6c\x6f\x6e\x67\x74ex\x74 c\x6f\x6clate\x20\x75\x74\x668_\x67eneral_c\x69 N\x4fT\x20\x4e\x55LL,\n\t\t\t\t  `d\x65sc\x60 lo\x6egtext\x20\x63o\x6c\x6cat\x65 \x75\x74\x66\x38_\x67\x65\x6ee\x72\x61l\x5fci\x20NO\x54 \x4e\x55L\x4c,\n\t\t\t\t\x20\x20\x60\x61nal\x79\x74\x69\x63\x73`\x20\x6c\x6fngt\x65x\x74\x20\x4e\x4f\x54\x20\x4e\x55\x4cL\x20D\x45F\x41\x55L\x54 '',\n\t\t\t\t\x20\x20\x60\x61c\x74i\x76\x65\x60\x20in\x74(\x325) \x4eO\x54 \x4eUL\x4c D\x45\x46\x41ULT\x200,\n\t\t\t\t  \x50RI\x4dARY\x20K\x45\x59\x20 (\x60\x69d\x60)\n\t\t\t\t) \x45\x4e\x47\x49\x4eE\x3d\x4dy\x49SAM\x20\x44\x45\x46\x41\x55L\x54 \x43\x48\x41\x52SET\x3d\x75t\x66\x38\x20CO\x4c\x4c\x41TE\x3d\x75\x74f8\x5f\x67e\x6eer\x61\x6c_ci\x3b\n\t\t\t\t", "\x43\x52E\x41\x54\x45 TABLE\x20\x49F\x20\x4e\x4f\x54 \x45\x58IS\x54\x53\x20\x60" . $wpdb->prefix . "\x70\x6f\x70\x64\x6f\x6d\x5f\x61b\x60\x20(\n\t\t\t\t \x20\x60id\x60\x20i\x6e\x74(\x32\x35) \x4e\x4f\x54\x20\x4eU\x4c\x4c\x20a\x75\x74o\x5f\x69\x6e\x63r\x65\x6d\x65\x6e\x74,\n\t\t\t\t\x20 `\x63a\x6d\x70\x61i\x67\x6es\x60 \x6c\x6fn\x67\x74e\x78\x74 co\x6c\x6ca\x74\x65 u\x74f\x38\x5fgen\x65ral\x5f\x63i\x20N\x4fT\x20\x4e\x55LL,\n\t\t\t\t  `\x73\x63\x68e\x64ul\x65\x60 l\x6f\x6e\x67t\x65\x78\x74 c\x6fllat\x65\x20\x75\x74\x66\x38\x5f\x67\x65\x6e\x65r\x61\x6c\x5f\x63\x69 NOT\x20N\x55LL,\n\t\t\t\t\x20\x20\x60a\x62\x73\x65\x74ti\x6e\x67\x73\x60\x20long\x74ext c\x6fll\x61\x74e ut\x668_\x67\x65\x6ee\x72\x61\x6c_ci\x20NOT \x4eULL,\n\t\t\t\t  \x60as\x74at\x73`\x20lon\x67\x74\x65x\x74\x20co\x6cl\x61\x74e\x20\x75\x74\x66\x38\x5fge\x6ee\x72a\x6c\x5f\x63i \x4eO\x54\x20N\x55\x4c\x4c,\n\t\t\t\t\x20 \x60\x6eam\x65\x60\x20\x76archar(\x355)\x20co\x6c\x6c\x61te\x20\x75tf\x38_\x67\x65\x6eera\x6c_\x63i\x20N\x4fT NU\x4c\x4c,\n\t\t\t\t  \x60\x64es\x63\x72\x69\x70tio\x6e\x60\x20\x6c\x6fn\x67t\x65\x78t collate\x20\x75\x74f\x38_\x67e\x6ee\x72\x61l_\x63i\x20\x4eOT \x4e\x55\x4c\x4c,\n\t\t\t\t  `a\x63ti\x76\x65` \x69\x6e\x74(\x325) \x4eO\x54 \x4eUL\x4c\x20\x44E\x46A\x55\x4cT 0,\n\t\t\t\t\x20\x20\x50\x52IM\x41RY \x4bE\x59  (`i\x64\x60)\n\t\t\t\t) \x45\x4e\x47INE\x3d\x4d\x79IS\x41M\x20D\x45F\x41U\x4c\x54\x20CH\x41RS\x45\x54=\x75\x74\x66\x38\x20\x43O\x4c\x4cA\x54\x45\x3dutf8_\x67e\x6ee\x72\x61l_c\x69\x3b\n\t\t\t\t", "CR\x45A\x54E \x54\x41\x42L\x45 I\x46\x20NOT \x45\x58\x49S\x54S `" . $wpdb->prefix . "\x70\x6f\x70\x64om\x5f\x6d\x61il\x69ng` (\n\t\t\t\t\x20\x20\x60id` \x69n\x74(\x325) NOT \x4eUL\x4c\x20a\x75\x74o_i\x6ec\x72em\x65nt,\n\t\t\t\t  `n\x61m\x65`\x20\x76a\x72\x63\x68\x61\x72(5\x35) \x63o\x6cl\x61te\x20u\x74f\x38\x5f\x67\x65\x6eera\x6c\x5fc\x69\x20\x4e\x4fT\x20\x4eULL,\n\t\t\t\t\x20 \x60\x64e\x73\x63\x72i\x70t\x69\x6f\x6e\x60\x20\x6co\x6e\x67t\x65\x78\x74\x20c\x6f\x6clat\x65\x20\x75t\x66\x38_g\x65ne\x72a\x6c\x5f\x63i\x20\x4eOT\x20N\x55\x4cL,\n\t\t\t\t\x20 `\x73\x65tti\x6e\x67\x73`\x20\x6congt\x65xt \x63\x6fl\x6c\x61t\x65 ut\x66\x38\x5fg\x65n\x65ral\x5fc\x69\x20N\x4fT\x20\x4eULL,\n\t\t\t\t\x20 \x50\x52\x49\x4d\x41R\x59\x20\x4b\x45Y  (`i\x64\x60)\n\t\t\t\t)\x20\x45NG\x49\x4eE=\x4d\x79I\x53A\x4d\x20\x44E\x46\x41\x55\x4cT C\x48A\x52S\x45T\x3d\x75tf8\x20\x43\x4f\x4c\x4c\x41T\x45=\x75t\x66\x38\x5f\x67ene\x72a\x6c\x5f\x63i;");
        if(isset($_POST["popup\x5fd\x6fmi\x6eat\x69o\x6e\x5f\x61\x63\x74i\x76\x61t\x65"])) {
            if($_POST["\x70\x6f\x70\x75p\x5f\x64o\x6d\x69\x6eat\x69on_\x61\x63\x74i\x76\x61te"] == "\x74\x72\x75\x65") {
                $vcvocyeon = "d\x65f\x61ult\x73";
                $pbyruokwhp = "\x74a\x62\x6c\x65";
                require_once(ABSPATH . "w\x70-ad\x6din/i\x6e\x63lud\x65s/\x75pg\x72\x61\x64e\x2eph\x70");
                ${"\x47\x4c\x4f\x42ALS"}["b\x77v\x79\x71\x69r"] = "\x61";
                foreach(${${"\x47L\x4f\x42\x41\x4c\x53"}["\x6atzq\x77\x68nc"]} as ${$pbyruokwhp}) {
                    ${"\x47\x4cO\x42\x41\x4cS"}["\x74hc\x69\x64\x72wh\x66"] = "\x74\x61\x62\x6c\x65";
                    dbDelta(${${"G\x4c\x4fB\x41L\x53"}["\x74\x68\x63\x69d\x72w\x68\x66"]});
                }${$vcvocyeon} = array("s\x68ow" => serialize(array("ever\x79\x77\x68\x65re" => "\x59")), "impr\x65\x73\x73i\x6fn\x5f\x63ount" => 0, "d\x65\x6c\x61\x79" => 0, "\x63\x6f\x6fkie_ti\x6d\x65" => 7, "p\x72\x6fmote" => "Y", "\x74em\x70lat\x65" => "\x6c\x69\x67\x68tb\x6f\x78", "\x63\x6f\x6c\x6f\x72" => "b\x6cu\x65", "b\x75t\x74\x6f\x6e_c\x6flo\x72" => "red", "n\x65\x77\x5f\x77\x69ndo\x77" => "\x4e", "s\x68o\x77_\x6fpt" => "o\x70\x65n", "\x65na\x62\x6c\x65d" => "N", "v\x65rsi\x6fn" => $this->version, "\x69\x6es\x74al\x6ced" => "Y", "\x76\x33i\x6e\x73tal\x6ced" => "Y");
                foreach(${${"\x47\x4c\x4f\x42AL\x53"}["\x64k\x77g\x73\x6f"]} as ${${"\x47\x4cO\x42\x41\x4c\x53"}["\x62w\x76y\x71\x69\x72"]} => ${${"G\x4cO\x42\x41\x4c\x53"}["r\x74n\x75e\x6aj\x72\x68"]}) {
                    $ljwrmxxnkjn = "\x61";
                    $fdobwxmft = "b";
                    if(!$this->option(${$ljwrmxxnkjn}))
                        $this->update(${${"GL\x4fB\x41\x4c\x53"}["u\x70uh\x66\x6b\x78\x6f\x63\x75"]}, ${$fdobwxmft});
                }include_once$this->plugin_path . "\x74\x70\x6c/i\x6e\x73ta\x6c\x6c/in\x73\x74\x61\x6c\x6c_\x66\x69nish.\x70\x68\x70";
            }else {
                $ccvkyuydyjlw = "e\x72\x72o\x72_\x63\x6fde";
                ${"GL\x4fB\x41LS"}["\x72\x64\x75\x79be\x71g\x70k"] = "er\x72\x6f\x72_\x63\x6f\x64\x65";
                ${$ccvkyuydyjlw} = $_POST["\x70\x6f\x70\x75p\x5fdominat\x69\x6fn\x5f\x65\x72\x72\x6f\x72"];
                echo"<d\x69\x76\x20\x63\x6cas\x73\x3d\"\x75pd\x61\x74\x65\x64\x22\x3e\x3c\x70>\x54h\x65\x20o\x72\x64\x65\x72 n\x75\x6db\x65\x72\x20y\x6f\x75\x20\x65nte\x72ed\x20is\x20in\x76a\x6c\x69d. \x50le\x61\x73\x65 \x63\x6fntac\x74\x20\x3ca\x20\x68\x72ef\x3d\"\x68\x74\x74p://p\x6f\x70\x64\x6f\x6d.d\x65s\x6b\x2e\x63\x6f\x6d/cu\x73\x74ome\x72/p\x6frt\x61\x6c/emails/ne\x77\"\x3e\x73\x75pp\x6f\x72t</a>\x2e\x20[\x45r\x72\x6fr\x20\x63\x6fd\x65: " . ${${"G\x4c\x4f\x42A\x4cS"}["\x72\x64\x75\x79b\x65qg\x70\x6b"]} . "]</p\x3e\x3c/d\x69\x76\x3e";
                include_once$this->plugin_path . "tpl/\x69ns\x74a\x6cl/\x69\x6e\x73t\x61ll\x5f\x73\x74\x61r\x74.php";
            }
        } else {
            include_once$this->plugin_path . "t\x70l/inst\x61\x6c\x6c/ins\x74\x61\x6c\x6c\x5fsta\x72\x74\x2eph\x70";
        }
    }

    /**
     * get_mailing_list()
     *
     * Ajax triggered. Grabs PHP which loads another file depending on selected provider.
     */
    function get_mailing_list() {
        $provider = $_POST['provider'];
        if($provider == 'mc') {
            include 'inc/mc/get_lists.php';
        } else if($provider == 'cm') {
            include 'inc/campmon/get_lists.php';
        } else if($provider == 'aw') {
            include 'inc/aweber_api/get_lists.php';
        } else if($provider == 'cc') {
            include 'inc/concon/get_lists.php';
        } else if($provider == 'ic') {
            include 'inc/icon/get_lists.php';
        } else if($provider == 'gr') {
            include 'inc/getre/get_lists.php';
        }
        die();
    }

    /**
     * promote_settings()
     *
     * Ajax triggered. Grabs PHP which loads another file depending on selected provider.
     */
    function promote_settings() {
        $success = false;
        if(isset($_POST['update'])) {
            $popdom = $_POST['popup_domination'];
            $this->update('promote', $popdom['promote'], false);
            $this->update('clickbank', $popdom['clickbank'], false);
            $success = true;
        }
        $this->option('promote');
        if($promote = $this->option('promote')) {
            if($promote == 'Y') {
                $clickbank = $this->option('clickbank');
            }
        } else {
            $promote = 'N';
        }
        if(isset($prev['promote'])) {
            $promote = $prev['promote'];
            if($promote == 'Y') {
                $clickbank = (isset($prev['clickbank'])) ? $prev['clickbank'] : '';
            }
        } else {
            $promote = 'N';
        }
        include $this->plugin_path . 'tpl/promote/page.php';
    }

    /**
     * load_abtesting()
     *
     * Loads list of A/B Campaigns in the A/B Split initial Admin panel.
     */
    function load_abtesting() {
        $ab_campaigns_data = $this->get_db('popdom_ab');
        $this->abcamp = $ab_campaigns_data;
        $campaigns = array();
        foreach($ab_campaigns_data as $ab_campaign) {
            $campaign = array();
            $campaign['id'] = $ab_campaign->id;
            $campaign['name'] = $ab_campaign->name;
            $campaign['schedule'] = $ab_campaign->schedule;
            $campaign['absettings'] = $ab_campaign->absettings;
            $campaign['astats'] = $ab_campaign->astats;
            $campaign['active'] = $ab_campaign->active;
            $campaign['description'] = $ab_campaign->description;

            $campaign['campaigns'] = unserialize($ab_campaign->campaigns);
            if(!empty($campaign['campaigns'])) {
                foreach($campaign['campaigns'] as $id) {
                    $camps = $this->get_db('popdom_campaigns', 'id = "' . $id . '"');
                    if(!empty($camps)) {
                        $camp = $camps[0];
                        $tmp = unserialize($camp->data);
                        $temppreview = $tmp['template']['template'];
                        $temppreviewcolor = $tmp['template']['color'];
                        $temppreviewcolor = strtolower($temppreviewcolor);
                        $temppreviewcolor = str_replace(' ', '-', $temppreviewcolor);
                        $campaign['previewurl'][] = $this->theme_url . $temppreview . '/previews/' . $temppreviewcolor . '.jpg';
                    }
                }
            }
            $campaigns[] = $campaign;
        }
        $count = count($campaigns);
        include $this->plugin_path . 'tpl/abtesting/list.php';
    }

    /**
     * load_absettings()
     *
     * Loads all settings needed for the A/B Split Campaign setup.
     * Also comtains functionality for saving the settings in these panels.
     */
    function load_absettings() {
        $success = false;
        $this->newcampid = false;
        if(isset($_POST['update'])) {
            $ab['name'] = stripslashes($_POST['campname']);
            $ab['desc'] = stripslashes($_POST['campaigndesc']);
            $pages = $_POST['popup_domination_show'];
            if(isset($_POST['trafficamount'])) {
                $trafficamount = $_POST['trafficamount'];
            } else {
                $trafficamount = 0;
            }
            $ab['name'];
            $data = $this->get_db('popdom_ab', 'name = "' . $ab['name'] . '"');
            $ab['campaigns'] = serialize($_POST['campaign']);
            $ab['show'] = serialize($pages);
            $ab['settings'] = serialize(array('visitsplit' => $_POST['numbervisitsplit'], 'page' => (isset($_POST['conversionpage']) ? $_POST['conversionpage'] : ''), 'traffic' => $trafficamount));
            if(isset($_GET['id'])) {
                $camp_id = $_GET['id'];
            } else {
                $camp_id = $this->newcampid;
            }
            if(empty($data)) {
                $save = $this->write_db('popdom_ab', array('campaigns' => $ab['campaigns'], 'schedule' => $ab['show'], 'absettings' => $ab['settings'], 'name' => $ab['name'], 'description' => $ab['desc']), array('%s', '%s', '%s', '%s', '%s'));
            } else {
                $save = $this->write_db('popdom_ab', array('campaigns' => $ab['campaigns'], 'schedule' => $ab['show'], 'absettings' => $ab['settings'], 'name' => $ab['name'], 'description' => $ab['desc']), array('%s', '%s', '%s', '%s'), true, array('id' => $camp_id), array('%d'));
                if(isset($pages['everywhere']) && $pages['everywhere'] = 'Y') {
                    //$save = $this->write_db('popdom_ab', array('everywhere' => 'Y'), array('%s'), true, array('id' => $camp_id), array('%d'));
                } else {
                    //$save = $this->write_db('popdom_ab', array('everywhere' => 'N'), array('%s'), true, array('id' => $camp_id), array('%d'));
                }
            }
            $success = true;
        }
        if(isset($_GET['id']) || $this->newcampid != '') {
            if(isset($_GET['id'])) {
                $camp_id = $_GET['id'];
            } else {
                $camp_id = $this->newcampid;
                $url = "//" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                $url = explode('action=create', $url);
                //print_r($url);
                $furl = $url[0] . 'action=edit&id=' . $this->newcampid . '&message=1';
                echo '<script>window.location.href="' . $furl . '"</script>';
            }
            if(isset($_GET['message'])) {
                $this->update_msg = 'Settings saved.';
            }
            $data = $this->get_db('popdom_ab', 'id = ' . $camp_id);
            $split['campaigns'] = unserialize($data[0]->campaigns);
            $split['schedule'] = unserialize($data[0]->schedule);
            $split['absettings'] = unserialize($data[0]->absettings);
            $split['results'] = unserialize($data[0]->astats);
            $visitsplit = $split['absettings']['visitsplit'];
            $page = $split['absettings']['page'];
            $traffic = $split['absettings']['traffic'];
            $name = $data[0]->name;
            $desc = $data[0]->description;
            if(!empty($split['results'])) {
                $keys = array_keys($split['results']);
                foreach($keys as $k) {
                    $campname[] = $this->get_db('popdom_campaigns', 'id = "' . $k . '"', 'campaign');
                }
            } else {
                $keys = array();
                $campname = array();
            }
        } else {
            $data = array();
            $split['campaigns'] = false;
            $split['schedule'] = '';
            $split['absettings'] = '';
            $visitsplit = '';
            $page = '';
            $traffic = '';
        }
        $campdata = $this->get_db('popdom_campaigns', NULL, 'id, campaign');

        $this->abcamp = $data;
        include $this->plugin_path . 'tpl/abtesting/page.php';
    }

    function connect_mailing() {
        include($this->plugin_path.'/inc/aweber.php');
        die();
    }
    
    function show_mailing($id = 0) {
        $mailing_data = $this->get_db('popdom_mailing', 'id="' . $id . '"');

        if(!empty($mailing_data)) {
            $config_name = $mailing_data[0]->name;
            $config_desc = $mailing_data[0]->description;
            $mailing_info = unserialize(base64_decode($mailing_data[0]->settings));
            $provider_details = array();
            $provider = $mailing_info['provider'];

            if(!empty($mailing_info) && !empty($provider)) {
                $this->update_msg = 'Settings saved.';
                // set up variables used by every provider
                foreach($mailing_info as $key => $value) {
                    $$key = $value;
                }

                if(gettype($provider_details) == "array") {
                    // create all variables required for each provider
                    foreach($provider_details as $key => $value) {
                        $$key = $value;
                    }
                    $formhtml = (isset($provider_details['formhtml']) ? stripslashes($provider_details['formhtml']) : '');
                }
            }
        }
        include $this->plugin_path . 'tpl/mailing/page.php';
    }

    function save_mailing($id = 0) {
        //look at using variable variables
        $data = array();
        $mailing_list_name = $_POST['config_name'];
        $mailing_list_description = $_POST['config_desc'];
        foreach($_POST as $key => $value) {
            $$key = $value;
        }
        $listname = trim($listname) == '' ? $listid : $listname;
        $provider_details = isset($_POST[$newprovider]) ? $_POST[$newprovider] : '';

        $valid = false;
        if($newprovider == 'nm')
            $valid = empty($provider_details['username']) ? $valid : true;
        elseif($newprovider == 'form')
            $valid = empty($provider_details['formhtml']) ? $valid : true;

        if(($newlistid != $listid && !empty($newlistid)) || $valid) {
            //Information update if list is changed
            $provider = $newprovider;
            $listid = $newlistid;
            $listname = $newlistname;
            if(empty($provider_details['name_box']))
                $provider_details['name_box'] = 'name';

            if(empty($provider_details['email_box']))
                $provider_details['email_box'] = 'email';

            if($provider == 'nm') {
                $custom1name = 'custom1';
                $custom2name = 'custom2';
            }
        }
        $custom1name = trim($custom1name) == '' ? 'custom1' : $custom1name;
        $custom2name = trim($custom2name) == '' ? 'custom2' : $custom2name;
        $provider_details = isset($_POST[$provider]) ? $_POST[$provider] : '';
        $data['listid'] = $listid;
        $data['listname'] = $listname;
        $data['provider'] = $provider;
        $data['custom_fields'] = $custom_fields;
        $data['disable_name'] = $disable_name;
        $data['redirect_url'] = (empty($redirect_url) ? '' : $redirect_url);
        $data['redirect'] = $redirect;
        $data['new_window'] = $new_window;
        $data['provider_details'] = $provider_details;
        $data['custom1name'] = $custom1name;
        $data['custom2name'] = $custom2name;
        $settings = base64_encode(serialize($data));
        
        if($id != 0)
            $check = $this->get_db('popdom_mailing', 'id="' . $id . '"');

        if(empty($check))
            $save = $this->write_db('popdom_mailing', array('name' => $mailing_list_name, 'description' => $mailing_list_description, 'settings' => $settings), array('%s', '%s', '%s'));
        else
            $save = $this->write_db('popdom_mailing', array('name' => $mailing_list_name, 'description' => $mailing_list_description, 'settings' => $settings), array('%s', '%s', '%s'), true, array('id' => $id), array('%d'));
    }

    /**
     * list_mailing()
     *
     * Displays all the the Mailing Configurations set up by the user
     */
    function list_mailing() {
        $data = $this->get_db('popdom_mailing');
        $mailing_configs = array();
        foreach($data as $config) {
            $mailing_config['id'] = $config->id;
            $mailing_config['name'] = $config->name;
            $mailing_config['description'] = $config->description;
            $mailing_config['settings'] = unserialize(base64_decode($config->settings));
            $mailing_config['provider'] = $mailing_config['settings']['provider'];
            $mailing_configs[$mailing_config['id']] = $mailing_config;
        }
        $count = count($mailing_configs);
        include $this->plugin_path . 'tpl/mailing/list.php';
    }

    /**
     * save_options()
     *
     * Saves all the data set in the Campaign Panels.
     */
    function save_options() {
        $superupdate = array();

        $mailing_option = $_POST['popup_domination_mailing'];
        if(isset($mailing_option['mailing_option'])) {
            $mailing_option['new_window'] = !empty($mailing_option['new_window']) ? true : false;

            $superupdate['mailing_option'] = array('mailing_list' => $mailing_option['mailing_option'], 'redirect_url' => $mailing_option['redirect_url'], 'mail_notify' => $mailing_option['mail_notify'], 'google_goal' => $mailing_option['google_goal'], 'new_window' => $mailing_option['new_window']);
        }

        $update = $_POST['popup_domination'];
        $updatesch = $_POST['popup_domination_show'];

        if(empty($_POST['campaignid']))
            $campaignid = '0';
        else
            $campaignid = $_POST['campaignid'];

        if(isset($update['custom_fields']))
            $this->custominputs = $update['custom_fields'];
        else
            $this->custominputs = "";
      
        $tmparr = array('template', 'color', 'button_color');
        $fieldsarr = array();
        $tmpsch = array('cookie_time', 'delay', 'unload_msg', 'impression_count', 'show_opt', 'tab_height', 'show_anim', 'show_where', 'show_opacity', 'advance_custom_css', 'disable_analytics', 'show_color', 'show_referral', 'show_background', 'allow_background_close', 'close_option', 'linkclick');
        $tmparr2 = array('clickbank' => $this->option('clickbank'), 'disable_name' => 'N',
            'unload_msg' => $this->option('unload_msg'), 'new_window' => 'N');
        $arr = array();
        $arrt = array();
        foreach($tmparr as $t) {
            if(!isset($update[$t])) {
                $update[$t] = '';
                if(isset($tmparr2[$t]) && $tmparr2[$t])
                    $update[$t] = $tmparr2[$t];
            }
            $arr[$t] = strtolower(stripslashes($update[$t]));

            $arr[$t] = str_replace(' ', '-', $arr[$t]);
        }

        $extra_fields = $this->update('custom_fields', $_POST['extra_fields'], false);

        $superupdate['num_cus'] = str_replace(" ", "", $_POST['extra_fields']);

        if(empty($arr['color']))
            $arr['color'] = 'blue';

        if(empty($arr['template']))
            $arr['template'] = 'lightbox';
            
        if(empty($arr['button_color']))
            $arr['button_color'] = 'blue';

        foreach($tmpsch as $t) {
            if(!isset($update[$t])) {
                $update[$t] = '';
                if(isset($tmparr2[$t]) && $tmparr2[$t])
                    $update[$t] = $tmparr2[$t];
            }

            if(is_array($update[$t]))
                $arrsch[$t] = serialize($update[$t]);
            else
                $arrsch[$t] = stripslashes($update[$t]);
        }
        $t = $this->get_theme_info($update['template']);
        if(isset($t['fields']) && !empty($t['fields']) && count($t['fields']) > 0 && isset($_POST['popup_domination_fields'])) {
            foreach($t['fields'] as $f) {
                $arrt['field_' . $f['field_opts']['id']] = stripslashes($_POST['popup_domination_fields'][$f['field_opts']['id']]);
            }
        }

        $campname = stripslashes($_POST['campname']);
        $campdesc = stripslashes($_POST['campaigndesc']);

        foreach($arr as $a => $b) {
            $superupdate['template'][$a] = $b;
        }
        foreach($arrsch as $a => $b) {
            $superupdate['schedule'][$a] = $b;
        }
        foreach($updatesch as $a => $b) {
            $superupdate['pages'][$a] = $b;
            $pages[$a] = $b;
        }

        foreach($arrt as $c => $d) {
            $chk = ($c == 'field_video-embed');
            $b = ($chk ? $this->encode2($d) : $d);
            $superupdate['fields'][$c] = $d;
        }
        $fields = array();
        if(isset($_POST['field_name']) && isset($_POST['field_vals']) && count($_POST['field_name']) == count($_POST['field_vals'])) {
            $fl = count($_POST['field_name']);
            for($i = 0; $i < $fl; $i++) {
                if(!empty($_POST['field_name'][$i]))
                    $fields[$_POST['field_name'][$i]] = $_POST['field_vals'][$i];
            }
        }

        $images = array();
        if(isset($_POST['field_img']) && count($_POST['field_img'])) {
            $img = $_POST['field_img'];
            $fl = count($img);
            for($i = 0; $i < $fl; $i++) {
                if(!empty($img[$i]))
                    $images[] = $img[$i];
            }
        }
        $superupdate['images'] = $images;

        $list = array();
        if(isset($_POST['list_item']) && count($_POST['list_item']) > 0) {
            foreach($_POST['list_item'] as $l) {
                $list[] = stripslashes($l);
            }
        }
        $superupdate['list'] = $list;
        $show = array();
        $origshow = $this->show_var();
        if(isset($_POST['popup_domination_show'])) {
            $sch = $_POST['popup_domination_show'];
            if(isset($sch['everywhere'])) {
                $show['everywhere'] = 'Y';
                if(!isset($origshow['everywhere']) || $origshow['everywhere'] != 'Y') {
                    $this->update('show_backup', serialize($origshow), false);
                    $superupdate[] = $origshow;
                }
            } else {
                $this->update('show_backup', serialize($origshow), false);
                $superupdate[] = $origshow;
            }
            
            if(isset($sch['front']))
                $show['front'] = 'Y';
            
            $show['pageid'] = array();
            if(isset($sch['pageid']) && is_array($sch['pageid'])) {
                foreach($sch['pageid'] as $s)
                    $show['pageid'][] = $s;
            }
            $show['catid'] = array();
            if(isset($sch['catid']) && is_array($sch['catid'])) {
                foreach($sch['catid'] as $s)
                    $show['catid'][] = $s;
            }
            $show['caton'] = $sch['caton'];
        }
        $superupdate['show'] = $show;

        if(isset($superupdate['fields']['field_fb-sec']) && !empty($superupdate['fields']['field_fb-sec']) && isset($superupdate['fields']['field_fb-id']) && !empty($superupdate['fields']['field_fb-id'])) {
            $this->update('facebook_enabled', 'Y');
            $this->update('facebook_sec', $superupdate['fields']['field_fb-sec']);
            $this->update('facebook_id', $superupdate['fields']['field_fb-id']);
        } else
            $this->update('facebook_enabled', 'N');

        $superupdate = serialize($superupdate);
        $qpage = $pages;
        $pages = serialize($pages);

        $check = $this->get_db('popdom_campaigns', 'id = ' . $campaignid);

        if(empty($check)) {
            $analytics = array();
            $analytics = serialize($analytics);
            $save = $this->write_db('popdom_campaigns', array('campaign' => $campname, 'data' => $superupdate, 'pages' => $pages, 'desc' => $campdesc, 'analytics' => $analytics));
        } else
            $save = $this->write_db('popdom_campaigns', array('campaign' => $campname, 'data' => $superupdate, 'pages' => $pages, 'desc' => $campdesc), array('%s', '%s', '%s'), true, array('id' => $campaignid), array('%d'));

        if(empty($campaignid))
            $this->newcampid = $this->newcampid;
        else
            $this->newcampid = $campaignid;

        $success = true;
    }

    /**
     * load_settings()
     *
     * Loads all the data for creating and editing campaigns.
     */
    function load_settings() {
        $templates = $this->get_themes((!empty($_GET['type']) && $_GET['type'] == "inline"));
        if(isset($_GET['id'])) {
            /**
             * If we are editing an existing campaign
             */
            $camp_id = $_GET['id'];
            $data = $this->get_db('popdom_campaigns', 'id = ' . $camp_id);
            $campaignid = $data[0]->id;
            $campaign = unserialize($data[0]->data);
            $this->campaigndata = $campaign;
            $campname = $data[0]->campaign;
            $val = $campaign;
            $valtemp = $campaign['template']['template'];
            $valc = $campaign['template']['color'];
            $valbuttonc = $campaign['template']['button_color'];
            $campdesc = htmlspecialchars($data[0]->desc);
        } else if($this->newcampid != '') {

            /**
             * If we have just saved a new campaingn and are returning to the screen.
             */
            $camp_id = $this->newcampid;
            $data = $this->get_db('popdom_campaigns', 'id = ' . $camp_id);
            $campaignid = $data[0]->id;
            $campaign = unserialize($data[0]->data);
            $this->campaigndata = $campaign;
            $campname = $data[0]->campaign;
            $campdesc = htmlspecialchars($data[0]->desc);
            $val = $campaign;
            $valtemp = $campaign['template']['template'];
            $valc = $campaign['template']['color'];
            $valbuttonc = $campaign['template']['button_color'];
        } else {
            /**
             * If it's a new campaign
             */
            if(!empty($_GET['type']) && $_GET['type'] == "inline") {
                $valtemp = "lightbox-inpost";
            } else {
                $valtemp = 'lightbox';
            }
            $valc = 'blue';
            $valbuttonc = 'blue';
            $this->campaigndata = '';
            $campaignid = '';
            $val = '';
            $campaign = array('fields' => '', 'images' => '', 'list' => '');
        }
        /**
         * Now we start the complex process of creating the JSON that creates all the fields in the admin panel.
         *
         * This allows the fields to change depending on which templates has been selected in the drop down.
         */
        $js = '{';
        $opts = $opts2 = $field_str = $cur_preview = '';
        $numfields = $counter = 0;
        $cur_theme = $cur_size = array();
        foreach($templates as $t) {
            $selected = false;
            if($t['theme'] == $valtemp) {
                $selected = true;
                if(isset($t['colors'])) {
                    foreach($t['colors'] as $c) {
                        $selected2 = false;
                        $valc = strtolower($valc);
                        $valc = str_replace(' ', '-', $valc);
                        if($valc == $c['info'][0]) {
                            $selected2 = true;
                            $cur_preview = (isset($c['info'][2])) ? $c['info'][2] : '';
                            if(isset($t['size']))
                                $cur_size = $t['size'];
                        }
                        $opts2 .= '<option class="' . $c['info'][0] . '" ' . (($valc == $c['info'][0]) ? ' selected="selected" ' : '') . '>' . $c['name'] . '</option>';
                    }
                }else if(isset($t['img'])) {
                    $cur_preview = $t['img'];
                }
            }
            $opts .= '<option value="' . $t['theme'] . '"' . (($t['theme'] == $valtemp) ? ' selected="selected"' : '') . '>' . $t['name'] . '</option>';
            $js .= (($counter > 0) ? ',' : '') . '"' . $t['theme'] . '":{';
            if(count($t['colors']) > 0) {
                $js .= '"colors":[';
                $count = 0;
                foreach($t['colors'] as $c) {
                    $js .= (($count > 0) ? ',' : '') . '{"name":"' . $this->input_val($c['name']) . '","options":["' . $this->input_val($c['info'][0]) . '","' . $this->input_val($c['info'][1]) . '"]' . ((isset($c['info'][2])) ? ',"preview":"' . $this->input_val($c['info'][2]) . '"' : '') . '}';
                    $count++;
                }
                $js .= '],';
            } elseif(isset($t['img'])) {
                $js .= '"preview_image":"' . $t['img'] . '",';
            }
            if(isset($t['button_colors']) && count($t['button_colors']) > 0) {
                $js .= '"button_colors":[';
                $count = 0;
                foreach($t['button_colors'] as $c) {
                    $c['color_id'] = (!empty($c['color_id'])) ? $c['color_id'] : $c['name'];
                    $js .= (($count > 0) ? ',' : '') . '{"name":"' . $c['name'] . '","color_id":"' . $c['color_id'] . '"}';
                    $count++;
                }
                $js .= '],';
            }
            if(isset($t['fields']) && is_array($t['fields']) && count($t['fields']) > 0) {
                $js .= '"fields":[';
                $count = 0;
                foreach($t['fields'] as $f) {
                    $type = 'text';
                    $default_value = ((isset($f['field_opts']['default_val'])) ? $f['field_opts']['default_val'] : '');
                    if(isset($f['field_opts']['type'])) {
                        $type = $f['field_opts']['type'];
                    }
                    $tmp = array('"type":"' . $type . '"');
                    if($selected) {
                        $field_str .= '<p id="popup_domination_field_' . $f['field_opts']['id'] . '">';
                        $fieldid = 'popup_domination_field_' . $f['field_opts']['id'] . '_field';
                        $field_str .= '<label for="' . $fieldid . '">' . $f['name'] . '</label><span class="line">&nbsp;</span>';
                        if(!$val) {
                            $val = ((isset($f['field_opts']['default_val'])) ? $f['field_opts']['default_val'] : '');
                            if(isset($campaign['fields']['field_' . $f['field_opts']['id']])) {
                                $val = $campaign['fields']['field_' . $f['field_opts']['id']];
                            } else {
                                $val = '';
                            }
                        } else {
                            if(isset($campaign['fields']['field_' . $f['field_opts']['id']])) {
                                $val = $campaign['fields']['field_' . $f['field_opts']['id']];
                            } else {
                                $val = '';
                            }
                        }
                        switch($type) {
                            case 'textarea':
                                $field_str .= '<textarea cols="60" rows="5" name="popup_domination_fields[' . $f['field_opts']['id'] . ']" id="' . $fieldid . '" default-value="' . esc_attr($this->input_val($default_value)) . '">' . esc_textarea(html_entity_decode($this->input_val($val))) . '</textarea><br/>' . $this->maxlength_txt($f, $val);
                                break;
                            case 'image':
                                $field_str .= '<input type="text" name="popup_domination_fields[' . $f['field_opts']['id'] . ']" id="popup_domination_field_' . $f['field_opts']['id'] . '_field" value="' . esc_attr($this->input_val($val)) . '" /> Resizes to: (max width: ' . $f['field_opts']['max_w'] . ', max height: ' . $f['field_opts']['max_h'] . ') <a href="#upload_file" class="button">Upload file</a><span id="popup_domination_field_' . $f['field_opts']['id'] . '_field_btns"' . (($val == '') ? ' style="display:none"' : '') . '> | <a href="#remove" class="button ">Remove</a></span> <img class="waiting" style="display:none;" src="images/wpspin_light.gif" alt="" /> <span id="popup_domination_field_' . $f['field_opts']['id'] . '_error" style="display:none"></span><br />Want to create a stunning eCover design to put here? Check out <a href="http://www.myecovermaker.com/ref=popdom.html" target="_blank">eCover Creator 3D</a>.';
                                break;
                            case 'videoembed':
                                $field_str .= '<span style="font-size:smaller;"><a href="http://support.google.com/youtube/bin/answer.py?hl=en-GB&answer=171780" target="_blank">YouTube</a> | <a href="http://developer.vimeo.com/player/embedding#universal-embed-code" target="_blank">Vimeo</a> | <a href=http://www.flickr.com/help/video/#150321331" target="_blank">Flickr</a></span><br/><textarea cols="60" rows="5" name="popup_domination_fields[' . $f['field_opts']['id'] . ']" id="' . $fieldid . '">' . esc_textarea($val) . '</textarea>' . $this->videosize($f);
                                break;
                            case 'video':
                                $field_str .= "<strong>Only fill in a URL here if you are hosting the video yourself. If you're using YouTube etc, use the embed code instead.</strong><br/><br/>" . '<input class="sdfds ' . $val . '" type="' . $type . '" name="popup_domination_fields[' . $f['field_opts']['id'] . ']" id="' . $fieldid . '" value="' . esc_attr($this->input_val($val)) . '" />' . $this->maxlength_txt($f, $val) . '<br/><span style="font-size:smaller;">Want to display your video here? Want it to convert well? Check out <a href="http://spdom.webactix.hop.clickbank.net" target="_blank"> Easy Video Player now!</a></span>';
                                break;
                            default:
                                $field_str .= '<input class="' . esc_attr($val) . '" type="' . $type . '" name="popup_domination_fields[' . $f['field_opts']['id'] . ']" id="' . $fieldid . '" value="' . esc_attr($this->input_val($val)) . '" default-value="' . esc_attr($this->input_val($default_value)) . '"/>' . $this->maxlength_txt($f, $val);
                                break;
                        }
                        $field_str .= '</p>';
                    }

                    foreach($f['field_opts'] as $a => $b) {
                        if($a != 'type')
                            $tmp[] = '"' . $a . '":"' . $b . '"';
                    }
                    $tmp = '{' . implode(',', $tmp) . '}';
                    $js .= (($count > 0) ? ',' : '') . '{"name":"' . $this->input_val($f['name']) . '","opts":' . $tmp . '}';
                    $count++;
                }
                $js .= '],';
            }
            if(isset($t['size']) && count($t['size']) == 2) {
                $js .= '"preview_size":["' . $t['size'][0] . '","' . $t['size'][1] . '"],';
            }
            $lcount = 0;
            if(isset($t['list'])) {
                $lcount = $t['list'];
            }
            if($selected) {
                $t['list_count'] = $lcount;
                $cur_theme = $t;
            }
            $js .= '"list_count":"' . $this->input_val($lcount) . '",';
            $counter++;

            if(isset($t['numfields'])) {
                $this->custominputs = $t['numfields'];
            } else {
                $this->custominputs = 0;
            }
            $js .= '"numfields":" ' . $this->custominputs . '"}';
        }
        $js .= '}';
        $showjs = $this->show_var(true);
        $js .= ', popup_domination_show_backup = {"opts":[';
        $count = 0;
        if(isset($showjs['everywhere']) && $showjs['everywhere'] == 'Y') {
            $js .= "'everywhere'";
            $count++;
        }
        if(isset($showjs['front']) && $showjs['front'] == 'Y') {
            $js .= (($count > 0) ? ',' : '') . "'front'";
            $count++;
        }
        $js .= '],"catids":[' . ((isset($showjs['catid'])) ? implode(',', $showjs['catid']) : '') . '],';
        $js .= '"pageids":[' . ((isset($showjs['pageid'])) ? implode(',', $showjs['pageid']) : '') . '],';
        $js .= '"caton":\'' . ((isset($showjs['caton'])) ? $showjs['caton'] : '') . '\'}';
        $options = array('name_box', 'email_box');
        for($i = 1; $i <= $this->custominputs; $i++) {
            $options[] = 'custom' . $i . '_box';
        }
        foreach($options as $o)
            $$o = $this->input_val($this->option($o));

        $fields = '';
        if($f = $campaign['fields']) {
            if(!empty($f)) {
                if(is_array($f))
                    $fieldsarr = $f;
                else
                    $fieldsarr = unserialize($f);
                foreach($fieldsarr as $a => $b)
                    $fields .= '<input type="hidden" name="field_name[]" value="' . $a . '" /><input type="hidden" name="field_vals[]" value="' . $b . '" />';
            }
        }
        if($f = $campaign['images']) {
            if(!empty($f)) {
                if(is_array($f))
                    $fieldsarr = $f;
                else
                    $fieldsarr = unserialize($f);
                foreach($fieldsarr as $b)
                    $fields .= '<input type="hidden" name="field_img[]" value="' . $b . '" />';
            }
        }
        $listitems = '';
        if($l = $campaign['list']) {
            if(!empty($l)) {
                if(is_array($l))
                    $list = $l;
                else
                    $list = unserialize($l);
                $count = 1;
                foreach($list as $a) {
                    $class = '';
                    if(isset($cur_theme['list_count']) && $count > $cur_theme['list_count'])
                        $class = 'over';
                    $listitems .= '
              <li' . (($class == '') ? '' : ' class="' . $class . '"') . '><input type="text" name="list_item[]" value="' . htmlspecialchars($a) . '" /> <a href="#delete" class="thedeletebutton remove_list_item">Delete</a><div class="clear"></div></li>';
                    $count++;
                }
            }
        }

        if(isset($campaign['schedule']['show_opt']))
            $show_opt = $campaign['schedule']['show_opt'];
        else
            $show_opt = 'open';

        if(isset($campaign['schedule']['tab_height']))
            $tab_height = $campaign['schedule']['tab_height'];
        else
            $tab_height = '120';

        if(isset($campaign['schedule']['show_anim']))
            $show_anim = $campaign['schedule']['show_anim'];
        else
            $show_anim = 'open';

        if(isset($campaign['schedule']['show_where']))
            $show_where = $campaign['schedule']['show_where'];
        else
            $show_where = 'center';

        if(isset($campaign['schedule']['show_opacity']))
            $show_opacity = intval($campaign['schedule']['show_opacity']);
        else
            $show_opacity = 70;
        
        if(isset($campaign['schedule']['advance_custom_css']))
            $advance_custom_css = $campaign['schedule']['advance_custom_css'];
        
        $disable_analytics = (!empty($campaign['schedule']['disable_analytics']) && ($campaign['schedule']['disable_analytics'] || $campaign['schedule']['disable_analytics'] == 'true'));

        if(!empty($campaign['schedule']['show_color']))
            $show_color = $campaign['schedule']['show_color'];
        else
            $show_color = '#000000';

        if(!isset($campaign['schedule']['show_background']))
            $show_background = 'true';
        else
            $show_background = ($campaign['schedule']['show_background'] == 'true') ? 'true' : 'false';

        if(!isset($campaign['schedule']['allow_background_close']))
            $allow_background_close = 'true';
        else
            $allow_background_close = ($campaign['schedule']['allow_background_close'] == 'true') ? 'true' : 'false';

        if(isset($campaign['schedule']['show_referral'])) {
            $show_referral = unserialize($campaign['schedule']['show_referral']);
            if(!is_array($show_referral))
                $show_referral = array();
        } else
            $show_referral = array();

        if(isset($campaign['mailing_option'])) {
            $mailing['id'] = $campaign['mailing_option']['mailing_list'];
            $mailing['redirect_url'] = $campaign['mailing_option']['redirect_url'];
            $mailing['mail_notify'] = $campaign['mailing_option']['mail_notify'];
            $mailing['google_goal'] = stripslashes($campaign['mailing_option']['google_goal']);
            $mailing['new_window'] = $campaign['mailing_option']['new_window'];
        }


        /**
         * The JSON is now been created, so let's display it on the page and create the fields.
         */
        echo '<script>
    var popup_domination_tpl_info = ' . $js . '
    </script>';
        include $this->plugin_path . 'tpl/campaign/page.php';
    }

    /**
     * admin_page()
     *
     * Initial function in fired in the plugin's Admin panels.
     * Also checks if the plugin has been verified and installed.
     */
    function admin_page() {
        if(!$ins = $this->option('installed')) {
            if($_GET['page'] == 'popup-domination/support') {
                $this->support();
            } else {
                $this->installation_process();
            }
        } else {
            if(strstr($this->wpadmin_page, 'campaign')) {
                if(isset($_POST['popup_domination'])) {
                    if(wp_verify_nonce($_POST['_wpnonce'], 'update-options')) {
                        $this->save_options();
                        $this->success = true;
                    } else {
                        $update_msg = 'Could not save settings due to verification problems. Please try again.';
                        $this->success = false;
                    }
                } else {
                    $this->success = false;
                }
            } else if(strstr($this->wpadmin_page, 'mailinglist')) {
                //required?
                if(isset($_POST['update'])) {
                    if(wp_verify_nonce($_POST['_wpnonce'], 'update-options')) {
                        $this->success = true;
                    } else {
                        $update_msg = 'Could not save settings due to verification problems. Please try again.';
                        $this->success = false;
                    }
                } else {
                    $this->success = false;
                }
            }
            
            /* Upgrade user. Allows us to modify database and commit restructuring. */
            $previous_version = $this->option('version');
            if($previous_version < 3.5) {
                $this->version_3_5_upgrade();
                $this->update('version', $this->version);
            }
            $this->load_pages();
        }
    }

    /**
     * load_analytics()
     *
     * Loads all data for listing all analytics for campaigns.
     * Initial page when entering analytics panel.
     */
    function load_analytics() {
        $data = $this->get_db('popdom_campaigns');
        foreach($data as $d) {
            $name = $d->campaign;
            $tmp = unserialize($d->data);
            $temppreview = $tmp['template']['template'];
            $temppreviewcolor = $tmp['template']['color'];
            $temppreviewcolor = strtolower($temppreviewcolor);
            $temppreviewcolor = str_replace(' ', '-', $temppreviewcolor);
            $previewurl[$d->id] = $this->theme_url . $temppreview . '/previews/' . $temppreviewcolor . '.jpg';

            $height[$d->id] = '';
            $width[$d->id] = '';
        }
        include $this->plugin_path . 'tpl/analytics/list.php';
    }

    /**
     * analytics_settings()
     *
     * Loads all data needed to show analytic data for the selected campaign.
     */
    function analytics_settings() {
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $this->get_db('popdom_campaigns', 'id = "' . $id . '"');
            $campaign = $data[0];
            $campaign_name = $campaign->campaign;
            $analytics = unserialize($campaign->analytics);
            $year = date('Y');
            $month = date('m');
            if(!empty($analytics)) {
                if(array_key_exists($year, $analytics)) {
                    if(array_key_exists($month, $analytics[$year])) {
                        $months_views = $analytics[$year][$month]['views'];
                        $months_conversions = $analytics[$year][$month]['conversions'];
                    }
                }
            } else {
                $months_views = 0;
                $months_conversions = 0;
            }
        }
        include($this->plugin_path . 'tpl/analytics/page.php');
    }

    /**
     * theme_uploader()
     *
     * Loads theme uploader options and handles in-app installation of themes.
     */
    function theme_uploader() {
        global $wp_filesystem;
        $success = false;
        if(!empty($_POST['themenumber'])) {
            $orderNumber = $_POST['themenumber'];
            $checkURL = "http://popupdomination.com/3/theme-uploader-themes/check.php";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $checkURL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);
            $data = array(
                'orderNumber' => $orderNumber
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $output = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            if(strpos($output, 'success') !== false) {
                $url = trim(substr($output, 8));
                $path = $this->plugin_path;
                $path .= "themes" . strrchr($url, '/');
                $fp = fopen($path, 'w');
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_FILE, $fp);
                $data = curl_exec($ch);
                curl_close($ch);
                fclose($fp);

                //wordpres hack to get round ZIPArchive unavailability
                function __return_direct() {
                    return 'direct';
                }

                add_filter('filesystem_method', '__return_direct');
                WP_Filesystem();
                remove_filter('filesystem_method', '__return_direct');
                $unzip_result = unzip_file($path, $this->plugin_path . "themes/");
                if($unzip_result === true) {
                    $success = true;
                    $theme_message = "<strong>Success!</strong> Your theme has been installed.";
                } else {
                    $success = true;
                    //$unzip_result = print_r($unzip_result,1);
                    $theme_message = "There has been an error extracting your theme. {$unzip_result}";
                }
            } else {
                $success = true;
                $theme_message = $output;
            }
        }
        if(!empty($_POST['removetheme'])) {
            $what_theme = $_POST['removetheme'];
            global $wp_filesystem;
            $path = $this->theme_path . $what_theme;
            $backup_path = WP_PLUGIN_DIR . '/popdom-themes-backup/' . $what_theme;
            $dir_is_empty = $this->dir_is_empty($path);
            if(!$dir_is_empty) {
                $theme_message .= ($this->remove_dir($path)) ? "Successfully removed {$path}</br>" : "There was a problem removing {$path}<br/>";
                $success = true;
            }
            $dir_is_empty = $this->dir_is_empty($path);
            if(!$dir_is_empty) {
                $theme_message .= ($this->remove_dir($backup_path)) ? "Successfully removed {$backup_path}</br>" : "There was a problem removing {$backup_path}<br/>";
                $success = true;
            }
        }
        $this->success = $success;
        $this->get_themes(); //make sure $this->themes holds a value for use in theme remover dropdown
        include $this->plugin_path . 'tpl/theme_uploader/page.php';
    }

    function remove_dir($dirname) {
        if(!file_exists($dirname)) {
            return false;
        }
        if(is_file($dirname)) {
            return unlink($dirname);
        }
        $dir = dir($dirname);
        while(false !== $entry = $dir->read()) {
            if($entry == '.' || $entry == '..') {
                continue;
            }
            $this->remove_dir($dirname . DIRECTORY_SEPARATOR . $entry);
        }
        $dir->close();
        return rmdir($dirname);
    }

    /**
     * support()
     *
     * Load up support page and send information on submit
     * Adds additional information so we do not rely on the customer
     */
    function support() {
        $this->success = false;
        if(isset($_POST['email'])) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $subject = $_POST['support'];
            $description = $_POST['description'];
            $order_number = $_POST['order_number'];

            $headers = "From: $name <$email>\n";
            $headers .= "Reply-To: $email\n";
            $headers .= "X-Sender: $name<$email>\n";
            $headers .= "Return-Path: $name<$email>\n";
            $headers .= "X-Mailer: PHP/" . phpversion();

            //Gives us the chance to review information sent by client to help with debugging
            global $wp_version;
            $debug_info = 'Order number: ' . $order_number . "\n";
            $debug_info .= site_url('/') . "\n";
            $debug_info .= 'Wordpress version: ' . $wp_version . "\n";
            $debug_info .= 'PHP Version: ' . phpversion() . "\n";
            $debug_info .= 'Server: ' . php_uname() . "\n";
            $debug_info .= 'PopUp Domination version: ' . $this->version . "\n";
            $debug_info .= 'PopUp Domination Path: ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            if(file_exists($this->plugin_path . 'hashes.txt')) {
                $missing_files = array();
                $wrong_hashes = array();

                $hash_raw = file_get_contents($this->plugin_path . 'hashes.txt');
                $hashes = preg_split('/\r\n|\r|\n/', $hash_raw);

                $text_exts = array('txt', 'css', 'js', 'php', 'html', 'tpl', 'log', 'crt');
                foreach($hashes as $hash) {
                    $file = '';
                    $md5 = '';
                    list($file, $md5) = explode('|', $hash);

                    if(!preg_match('/^[a-f0-9]{32}$/', $md5))
                        continue;

                    if(!file_exists($this->plugin_path . $file)) {
                        $missing_files[] = $file;
                        continue;
                    }

                    if(in_array(pathinfo($file, PATHINFO_EXTENSION), $text_exts)) {
                        $file_content = file_get_contents($this->plugin_path . $file);
                        $file_content = str_replace(array("\r\n", "\r", "\n", "\t", ' '), '', $file_content);
                        $file_md5 = md5($file_content);
                    } else
                        $file_md5 = md5_file($this->plugin_path . $file);

                    if($file_md5 != $md5)
                        $wrong_hashes[] = $file;
                }

                if(!empty($missing_files)) {
                    $debug_info .= "\n" . 'Missing Files: (' . count($missing_files) . ")\n";
                    $debug_info .= implode("\n", $missing_files);
                }
                if(!empty($wrong_hashes)) {
                    $debug_info .= "\n" . 'Modified Files: (' . count($wrong_hashes) . ")\n";
                    $debug_info .= implode("\n", $wrong_hashes);
                }
            } else
                $debug_info .= "\n" . 'Hashes file missing!' . "\n";

            $description .= "\n\r\n\r" . $debug_info;
            $footer = "\n\n" . 'Submitted via the PopUp Domination Plugin';
            $description .= $footer;
            $description = stripslashes($description);

            mail('support@popupdomination.com', $subject, $description, $headers);
            $this->success = true;
        }
        include($this->plugin_path . 'tpl/support/page.php');
    }

    /* Not implemented yet, allows users to add attachments */

    function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
        $file = $path . $filename;
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
        $header .= "Reply-To: " . $replyto . "\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
        $header .= "This is a multi-part message in MIME format.\r\n";
        $header .= "--" . $uid . "\r\n";
        $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $header .= $message . "\r\n\r\n";
        $header .= "--" . $uid . "\r\n";
        $header .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n"; // use different content types here
        $header .= "Content-Transfer-Encoding: base64\r\n";
        $header .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
        $header .= $content . "\r\n\r\n";
        $header .= "--" . $uid . "--";
        if(mail($mailto, $subject, "", $header)) {
            echo "mail send ... OK"; // or use booleans here
        } else {
            echo "mail send ... ERROR!";
        }
    }

    /**
     * load_pages()
     *
     * Works out which panel and which action the user is requesting via the url.
     * Loads function in relation to panel/action/url.
     */
    function load_pages() {
        $this->display_notices();

        switch($this->curpage) {
            case 'campaigns':
                $this->load_campaigns();
                break;
            case 'analytics':
                $this->load_analytics();
                break;
            case 'a-btesting':
                $this->load_abtesting();
                break;
            case 'mailinglist':
                if(isset($_POST['update'])) {
                    if(isset($_POST['id'])) {
                        $this->save_mailing($_POST['id']);
                    } else {
                        $this->save_mailing();
                    }
                }
                $this->list_mailing();
                break;
            case 'promote':
                $this->promote_settings();
                break;
            case 'theme_upload':
                $this->theme_uploader();
                break;
            case 'theme_remove':
                $this->destroy_theme();
                break;
            case 'campaigns&action':
                $this->load_settings();
                break;
            case 'a-btesting&action':
                $this->load_absettings();
                break;
            case 'analytics&id':
                $this->analytics_settings();
                break;
            case 'mailinglist&action':
                if($_GET['action'] == 'create')
                    $this->show_mailing();
                else if($_GET['action'] == 'edit')
                    $this->show_mailing($_GET['id']);
                break;
            case 'support':
                $this->support();
                break;
            case 'verify_themeclub':
                $this->verify_themeclub();
                break;
            case 'debug':
                $this->debug_page();
                break;
            default:
                $this->load_campaigns();
                break;
        }
    }

    /**
     * maxlength_txt()
     *
     * Collects out text length, used for template fields and list points.
     * Loads these values from the theme.txt file.
     */
    function maxlength_txt($f, $val) {
        if(isset($f['field_opts']['max'])) {
            $max = intval($f['field_opts']['max']);
            $len = strlen($val);
            $txt = ' Recommended ' . $max;
            $class = 'green';
            $msg = 'remaining <span>' . ($max - $len) . '</span>';
            if(strlen($val) > $f['field_opts']['max']) {
                $class = 'red';
                $msg = 'hmm, you\'re over the limit, it might look bad';
            }
            return '<span class="recommended"><span class="' . $class . '">' . $txt . '</span> <span class="note"> - ' . $msg . '</span></span>';
        }
        return '';
    }

    /**
     * videosize()
     *
     * Collects out the max video dimensions from theme.txt file.
     */
    function videosize($f) {
        if(isset($f['field_opts']['max_w']) && isset($f['field_opts']['max_h'])) {
            $max_w = intval($f['field_opts']['max_w']);
            $max_h = intval($f['field_opts']['max_h']);
            return '<span class="recommended"><span class="green">Recommended Video Size</span>: height = <strong>' . $max_h . '</strong>, width = <strong>' . $max_w . '</strong>.</span>';
        }
        return '';
    }

    /**
     * load_campaigns()
     *
     * Loads all data needed to list out campaigns, initial panels when navigation to campaign menu.
     */
    function load_campaigns() {
        $all_campaigns = $this->get_db('popdom_campaigns');
        $campaigns = array();
        foreach($all_campaigns as $config) {
            $campaign = array();
            $campaign['id'] = $config->id;
            $campaign['name'] = $config->campaign;
            $campaign['desc'] = $config->desc;
            $campaign['active'] = $config->active;
            $tmp = unserialize($config->data);
            $temppreview = $tmp['template']['template'];
            $temppreviewcolor = $tmp['template']['color'];
            $temppreviewcolor = strtolower($temppreviewcolor);
            $temppreviewcolor = str_replace(' ', '-', $temppreviewcolor);
            $campaign['mailinglist_set'] = (isset($tmp['mailing_option']) && isset($tmp['mailing_option']['mailing_list']) && (intval($tmp['mailing_option']['mailing_list']) != -1) ? true : false);
            $campaign['filename'] = $temppreview;
            $campaign['previewurl'] = $this->theme_url . $temppreview . '/previews/' . $temppreviewcolor . '.jpg';
            $campaign['inpost'] = ($tmp['schedule']['show_anim'] == "inpost");
            $campaign['height'] = '';
            $campaign['width'] = '';
            $campaigns[] = $campaign;
        }
        $theIDs = array();
        foreach($campaigns as $key => $row) {
            $theIDs[$key] = $row['id'];
        }
        array_multisort($theIDs, SORT_ASC, $campaigns);
        $count = count($campaigns);
        include $this->plugin_path . 'tpl/campaign/list.php';
    }

    function verify_themeclub() {
        $error = '';
        if(!empty($_POST) && isset($_POST['order_number'])) {
            set_time_limit(0);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://popupdomination.com/checkorder/?order=' . $_POST['order_number']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            $data = curl_exec($ch);
            curl_close($ch);

            if($data == 'OKAY') {
                $this->update('themeclub', 'Y');
                echo '<script> window.location = "' . admin_url('admin.php?page=popup-domination/campaigns') . '";</script>';
                echo 'Redirecting...';
                return;
            } else {
                $error = $data;
                $this->update('themeclub', 'N');
            }
        }
        include $this->plugin_path . 'tpl/install/verify.php';
    }

    function clear_wp_options() {
        
        
    }
    
    function clear_db_ab() {
        global $wpdb;
        $wpdb->delete($wpdb->prefix.'popdom_ab', array(1 => 1));
    }
    
    function clear_db_campaigns() {
        global $wpdb;
        $wpdb->delete($wpdb->prefix.'popdom_campaigns', array(1 => 1));  
    }
    
    function clear_db_mailing() {
        global $wpdb;
        $wpdb->delete($wpdb->prefix.'popdom_mailing', array(1 => 1));
    }
    
    function debug_page() {
        $debug_resp = '';
        if(!empty($_POST['action'])) {
            switch($_POST['action']) {
                case 'Clear All WP Options':
                    $this->clear_wp_options();
                    $debug_resp = '<strong>Completed:</strong> Clear All WP Options';
                    break;
                case 'Clear DB AB':
                    $this->clear_db_ab();
                    $debug_resp = '<strong>Completed:</strong> Clear DB AB';
                    break;
                case 'Clear DB Campaigns':
                    $this->clear_db_campaigns();
                    $debug_resp = '<strong>Completed:</strong> Clear DB Campaigns';
                    break;
                case 'Clear DB Mailing':
                    $this->clear_db_mailing();
                    $debug_resp = '<strong>Completed:</strong> Clear DB Mailing';
                    break;
                case 'Clear DB ALL':
                    $this->clear_db_ab();
                    $this->clear_db_campaigns();
                    $this->clear_db_mailing();
                    $debug_resp = '<strong>Completed:</strong> Clear DB ALL';
                    break;
                case 'Enable AdBlock Bypass (Option Method)':
                    update_option('popup_domination_adblock_bypass', true);
                    $debug_resp = '<strong>Completed:</strong> Enable AdBlock Bypass (Option Method)';
                    break;
                case 'Disable AdBlock Bypass (Option Method)':
                    update_option('popup_domination_adblock_bypass', false);
                    $debug_resp = '<strong>Completed:</strong> Disable AdBlock Bypass (Option Method)';
                    break;
                case 'Enable Experimental Theme Updater':
                    update_option('popup_domination_theme_updater', true);
                    $debug_resp = '<strong>Completed:</strong> Enable Experimental Theme Updater';
                    break;
                case 'Disable Experimental Theme Updater':
                    update_option('popup_domination_theme_updater', false);
                    $debug_resp = '<strong>Completed:</strong> Disable Experimental Theme Updater';
                    break;
               case 'Enable Server Time Checker':
                    update_option('popup_domination_server_time_checker', true);
                    $debug_resp = '<strong>Completed:</strong> Enable Server Time Checker';
                    break;
                case 'Disable Server Time Checker':
                    update_option('popup_domination_server_time_checker', false);
                    $debug_resp = '<strong>Completed:</strong> Disable Server Time Checker';
                    break;
               case 'Enable Experimental Footer Scripts Support':
                    update_option('popup_domination_enqueue_footer', true);
                    $debug_resp = '<strong>Completed:</strong> Enable Experimental Footer Scripts Support';
                    break;
                case 'Disable Experimental Footer Scripts Support':
                    update_option('popup_domination_enqueue_footer', false);
                    $debug_resp = '<strong>Completed:</strong> Disable Experimental Footer Scripts Support';
                    break;
            }
        }
        include($this->plugin_path . 'tpl/debug.php');
    }
    
    /**
     * load_campaigns_select()
     *
     * 
     */
    function load_campaigns_select() {
        $current_page_url = isset($_GET['post']) ? get_page_link($_GET['post']) : 'nope';
        $all_campaigns = $this->get_db('popdom_campaigns');
        $campaigns = array();
        foreach($all_campaigns as $config) {
            $campaign = array();
            $campaign['id'] = $config->id;
            $campaign['name'] = $config->campaign;
            $campaign['desc'] = $config->desc;
            $campaign['active'] = $config->active;
            $tmp = unserialize($config->data);
            $temppreview = $tmp['template']['template'];
            $temppreviewcolor = $tmp['template']['color'];
            $temppreviewcolor = strtolower($temppreviewcolor);
            $temppreviewcolor = str_replace(' ', '-', $temppreviewcolor);
            $campaign['filename'] = $temppreview;
            $campaign['previewurl'] = $this->theme_url . $temppreview . '/previews/' . $temppreviewcolor . '.jpg';
            $campaign['inpost'] = ($tmp['schedule']['show_anim'] == "inpost");
            $campaign['height'] = '';
            $campaign['width'] = '';
            $campaigns[] = $campaign;
        }
        $theIDs = array();
        foreach($campaigns as $key => $row) {
            $theIDs[$key] = $row['id'];
        }
        array_multisort($theIDs, SORT_ASC, $campaigns);
        $count = count($campaigns);
        include $this->plugin_path . 'tpl/campaign/list_select.php';

        die();
    }

    /**
     * check_camp_name()
     *
     * Checks the DB if a campaign name is already registered and returns false (meaning name is free).
     */
    function check_camp_name() {
        $return = '';
        $table = '';
        $data = '';
        $name = trim($_POST['name']);
        if($_POST['type'] == 'campaign') {
            $table = 'popdom_campaigns';
            $data = $this->get_db($table, 'campaign = "' . $name . '"');
        } else if($_POST['type'] == 'ab') {
            $table = 'popdom_ab';
            $data = $this->get_db($table, 'name = "' . $name . '"');
        } else {
            $return = '-1';
            die();
        }
        if(!empty($data)) {
            /**
             * If name already taken, returns DB Row ID incase it's same campaign.
             */
            $return = $data[0]->id;
        } else {
            $return = 'false';
        }
        echo $return;
        die();
    }

    /**
     * deletecamp()
     *
     * Deletes a campaign from the DB.
     */
    function deletecamp() {
        $id = $_POST['id'];
        $table = $_POST['table'];
        $stats = $_POST['stats'];

        $table = 'popdom_' . $table;
        if($stats == 'analytics') {
            if($table == 'popdom_campaigns') {
                echo $this->write_db($table, array('views' => 0, 'conversions' => 0, 'previousdata' => ''), array('%s', '%s', '%s'), true, array('id' => $id), array('%d'));
            } else if($table == 'popdom_ab') {
                echo $this->write_db($table, array('astats' => ''), array('%s'), true, array('id' => $id), array('%d'));
            }
        } else {
            echo $this->delete_db($table, $id, $col);
        }
        die();
    }

    /**
     * deletecamp()
     *
     * Deletes a campaign from the DB.
     */
    function toggle_campaign() {
        $id = $_POST['id'];
        $table = 'popdom_' . $_POST['table'];
        $records = $this->get_db($table, 'id = ' . $id);
        $is_active = 0;
        if(!empty($records)) {
            $record = $records[0];
            $is_active = $record->active;
        }
        if($is_active) {
            $this->write_db($table, array('active' => 0), array('%d'), true, array('id' => $id), array('%d'));
        } else {
            $this->write_db($table, array('active' => 1), array('%d'), true, array('id' => $id), array('%d'));
        }
        echo $is_active;
        die();
    }

    /**
     * copy_campaign()
     *
     * Copies a configuration and adds the new row to screen.
     */
    function copy_campaign() {
        $id = $_POST['id'];
        $table = 'popdom_' . $_POST['table'];
        $records = $this->get_db($table, 'id = ' . $id);
        $record = array();
        if(!empty($records)) {
            $record = $records[0];
            $name = isset($record->name) ? $record->name : $record->campaign;
            $name = $name . ' [copy]';
            $description = $record->description;


            // Get the records values and copy them to a new array
            foreach($record as $var => $value) {
                $$var = $value;
            }
            $inpost = '';
            $campaign_type = "Popup";
            $unserialized_data = unserialize($data);
            if($unserialized_data['schedule']['show_anim'] == 'inpost') {
                $inpost_link = "&amp;type=inline";
                $campaign_type = "In-post";
            }
            $name .= ' [copy]';
            switch($table) {
                case 'popdom_campaigns':
                    $campaign .= ' [copy]';
                    $values = array('campaign' => $campaign, 'data' => $data, 'pages' => $pages, 'desc' => $desc, 'analytics' => '', 'active' => 0);
                    $type_array = array('%s', '%s', '%s', '%s', '%s', '%d');
                    $name = $campaign;
                    $description = $desc;
                    $view_analytics_link = '<li><a class="view_analytics" title="' . $name . '" href="admin.php?page=' . $this->menu_url . 'analytics&id=';
                    break;
                case 'popdom_mailing':
                    $values = array('name' => $name, 'description' => $description, 'settings' => $settings);
                    $type_array = array('%s', '%s', '%s');
                    break;
                case 'popdom_ab':
                    $values = array('name' => $name, 'schedule' => $schedule, 'absettings' => $absettings, 'astats' => '', 'description' => $description, 'active' => 0, 'campaigns' => $campaigns);
                    $type_array = array('%s', '%s', '%s', '%s', '%s', '%d', '%s');
                    break;
                default:
                    die();
                    break;
            }
            $success = $this->write_db($table, $values, $type_array);
            $id = $this->newcampid;
            if(isset($view_analytics_link)) {
                $view_analytics_link .= $id . '" >Analytics</a></li>';
            }
            $section = 'campaigns';
            $actions = '';
            if($success) {
                if($table == 'popdom_mailing') {
                    $previewurl = $this->rewrite_script('css/img/mailchimp.png');
                    $section = 'mailinglist';
                } else {
                    $toggle_link = '<li><a href="#toggle" class="toggle_button on" title="' . $name . '" data-id="' . $id . '"><span style="color:silver">ON</span> | OFF</a></li>';
                    if($table == 'popdom_ab') {
                        $section = 'a-btesting';
                        $campaigns = unserialize($campaigns);
                        foreach($campaigns as $campaign_id) {
                            $camp_ids[] = $campaign_id;
                        }
                        $random = rand(0, count($camp_ids));
                        $records = $this->get_db('popdom_campaigns', 'id = "' . $camp_ids[$random] . '"');
                        if(!empty($records)) {
                            $record = $records[0];
                        }
                    }



                    $tmp = unserialize($record->data);

                    $temppreview = $tmp['template']['template'];
                    $temppreviewcolor = $tmp['template']['color'];
                    $temppreviewcolor = strtolower($temppreviewcolor);
                    $temppreviewcolor = str_replace(' ', '-', $temppreviewcolor);
                    $previewurl = $this->theme_url . $temppreview . '/previews/' . $temppreviewcolor . '.jpg';
                }

                $copy_link = '<li><a href="#copy" class="copy_button" title="' . $name . '" data-id="' . $id . '">Duplicate</a></li>';
                $delete_link = '<li><a href="#deletecamp" class="deletecamp thedeletebutton" title="' . $name . '" data-id="' . $id . '">Delete</a></li>';
                $actions = $view_analytics_link .
                        $copy_link .
                        $toggle_link .
                        $delete_link;

                $row = '<div title="' . $id . '" id="camprow_' . $id . '" class="camprow">
          <div class="tmppreview">
            <div class="preview_crop">
              <div class="spacing">
                <div class="slider"><h2></h2></div>
                <img src="' . $previewurl . '" id="test" class="img">
              </div>
            </div>
          </div>
          <div class="namedesc">
            <a href="admin.php?page=popup-domination/' . $section . '&amp;action=edit&amp;id=' . $id . $inpost_link . '">' . $name . '</a><br>
            <p class="description">' . $description . '</p>
            <p class="campstyle">(' . $campaign_type . ' campaign)</p>
          </div>
          <ul class="actions">' . $actions . '</ul>
          <div class="clear"></div>
        </div>';
            }
        }
        echo $row;
        die();
    }

    /**
     * preview()
     *
     * Loads up everything needed to do an almost live preview PopUp for ppl to check the formatting.
     */
    function preview() {
        global $new_preview;
        $new_preview = true;
        //die("The preview system is currently down for maintenance");
        $output = '';
        wp_enqueue_script('jquery', false, array(), false, get_option('popup_domination_enqueue_footer', false));

        include($this->plugin_path . "popup-domination.front.php");
        $pd_front = new PopUp_Domination_Front();
        ob_start();
        get_template_part('header');
        $output .= ob_get_clean();
        $output .= '<script src="//code.jquery.com/jquery-1.10.1.min.js"></script><script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>';
        $output .= $pd_front->popdom_preview_handler($_POST['campaignid']);
        ob_start();
        get_template_part('footer');
        $output .= ob_get_clean();

        die($output);
    }

    /**
     * page_list()
     *
     * Collects and generates all pages and categories to set campaigns to appear on.
     */
    function page_list() {
        if(isset($this->campaigndata['pages']))
            $selected = $this->campaigndata['pages'];
        else
            $selected = array('everywhere' => 'Y');

        $front = get_option('page_on_front');
        $ex_pages = '';
        if(get_option('show_on_front') == 'page' && $front)
            $ex_pages = $front;

        $catstr = '';
        $selectedcat = isset($selected['caton']) ? $selected['caton'] : 0;
        $opts = array('Both', 'Category page', 'Post page within the categories');
        foreach($opts as $a => $b) {
            $catstr .= '
          <option value="' . $a . '"' . (($a == $selectedcat) ? ' selected="selected"' : '') . '>' . $b . '</option>';
        }
        
        $cats = $this->cat_list_recursive(0, $selected);
        $str = '
    <ul class="page_list">
      <li class="everywhere"><input type="checkbox" name="popup_domination_show[everywhere]" id="popup_domination_show_everywhere" value="Y"' . ((isset($selected['everywhere'])) ? ' checked="checked"' : '') . ' /> <label for="popup_domination_show_everywhere">Everywhere</label></li>';
        if(!empty($this->campaigndata['schedule']['show_anim']) && $this->campaigndata['schedule']['show_anim'] != "inpost") {
            $str .= '<li class="home"><input type="checkbox" name="popup_domination_show[front]" id="popup_domination_show_front" value="Y"' . ((isset($selected['front'])) ? ' checked="checked"' : '') . ' /> <label for="popup_domination_show_front">Front Page</label></li>';
        } elseif(!empty($_GET['type']) && $_GET['type'] == "inline") {
            $str .= '<li class="home"><input type="checkbox" name="popup_domination_show[none]" id="popup_domination_show_none" value="Y"' . ((isset($selected['none'])) ? ' checked="checked"' : '') . ' /> <label for="popup_domination_show_none">Nowhere (shortcode only)</label>';
            $str .= (!empty($_GET['id'])) ? '<input type="text" value="[popdom id=\'' . $_GET["id"] . '\']" readonly style="border:none;text-align:center;">' : '';
            $str .= '</li>';
        }
        $str .= '<li>Pages:' . $this->page_list_recursive(0, $ex_pages, $selected) . '</li>';
        if(!empty($cats)) {
            $str .= '
      <li><label>Categories:</label><br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="popup_domination_show_caton">Show on:</label>&nbsp;
        <select name="popup_domination_show[caton]" id="popup_domination_show_caton">' . $catstr . '
        </select>
        ' . $cats . '
      </li>';
        }
        $str .= '
    </ul>';
        echo $str;
    }

    /**
     * absplit_list()
     *
     * Collects and generates all pages and categories to set A/B Split campaigns to appear on.
     */
    function absplit_list($splitdata) {
        if(isset($splitdata)) {
            $selected = $splitdata;
        } else {
            $selected = array('everywhere' => 'Y');
        }
        $front = get_option('page_on_front');
        $ex_pages = '';
        if(get_option('show_on_front') == 'page' && $front) {
            $ex_pages = $front;
        }
        $catstr = '';
        $selectedcat = isset($selected['caton']) ? $selected['caton'] : 0;
        $opts = array('Both', 'Category page', 'Post page within the categories');
        foreach($opts as $a => $b) {
            $catstr .= '
          <option value="' . $a . '"' . (($a == $selectedcat) ? ' selected="selected"' : '') . '>' . $b . '</option>';
        }
        $cats = $this->cat_list_recursive(0, $selected);
        $str = '
    <ul class="page_list">
      <li class="everywhere"><input type="checkbox" name="popup_domination_show[everywhere]" id="popup_domination_show_everywhere" value="Y"' . ((isset($selected['everywhere'])) ? ' checked="checked"' : '') . ' /> <label for="popup_domination_show_everywhere">Everywhere</label></li>
      <li class="home"><input type="checkbox" name="popup_domination_show[front]" id="popup_domination_show_front" value="Y"' . ((isset($selected['front'])) ? ' checked="checked"' : '') . ' /> <label for="popup_domination_show_front">Front Page</label></li>
      <li>Pages:' . $this->page_list_recursive(0, $ex_pages, $selected) . '</li>';
        if(!empty($cats)) {
            $str .= '
      <li><label>Categories:</label>
        <label for="popup_domination_show_caton">Show on:</label>&nbsp;
        <select name="popup_domination_show[caton]" id="popup_domination_show_caton">' . $catstr . '
        </select>
        ' . $cats . '
      </li>';
        }
        $str .= '
    </ul>';
        echo $str;
    }

    /*
     *  Function designed to retrieve the list of Mailing options available to users. Used within campaign
     */

    function get_mailing_lists() {
        $return = array();
        $data = $this->get_db('popdom_mailing');
        foreach($data as $d) {
            $id = $d->id;
            $name = $d->name;
            $return[$id] = $name;
        }
        return $return;
    }

    function remote_server_time() {
        /* Figure out max execution time */
        $max_time_limit = 180;
        while($max_time_limit) {
            if(set_time_limit($max_time_limit))
                break;
            $max_time_limit--;
        }
        if ($max_time_limit < 20)
            return false;

        /* Query server for updates */
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://popupdomination.com/time/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, max(5, $max_time_limit - 5));
            $server_time = curl_exec($ch);
            $server_time = intval($server_time);
            curl_close($ch);
        } catch (Exception $e) {
            return false;
        }

        return $server_time;
    }

    function display_notice($str) { echo '<div class="popdom_info_error"> <strong>Notice:</strong>'.$str.'</div>'; }
    function display_warning($str) { echo '<div class="popdom_info_warrning"> <strong>Warning:</strong>'.$str.'</div>'; }

    function display_notices() {
        if(is_plugin_active('autoptimize/autoptimize.php'))
            $this->display_notice('PopUp Domination is currently not compatible with the Autoptimize plugin. This'.
                'is out of our control and we recommend users to disable this plugin until it is updated.');

        if(!defined('PHP_VERSION_ID')) {
            $version = explode('.', PHP_VERSION);
            define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
        }
        if(PHP_VERSION_ID < 50300)
            $this->display_notice('PopUp Domination requires a PHP version of at least 5.3 due to the API libraries we use directly from mailing providers. '.
                'Please contact your web hosting provider and have them update your site to at least PHP 5.3. (PHP 5.2 was released in November 2006 and supported up until January of 2011.)'.
                '<br /><br /><strong>Current Version: </strong>PHP '.PHP_VERSION);

        /* Verify server time */
        if(get_option('popup_domination_server_time_checker', true)) {
            $last_check = get_option('popup_domination_time_check', 0);

            if(get_option('popup_domination_time_check_failed', false))
                $last_check = 0;

            if($last_check == 0) {
                $server_time = $this->remote_server_time();
                if($server_time + 500 < time() || $server_time - 500 > time()) {
                    $this->display_notice('PopUp Domination requires an accurate server time to authenticate with 3rd party services. It appears that your server\'s time might be off. Please contact support for more details.');
                    update_option('popup_domination_time_check_failed', true);
                } else
                    update_option('popup_domination_time_check_failed', false);

                update_option('popup_domination_time_check', 15);
            } else
                update_option('popup_domination_time_check', (($last_check - 1) < 0 ? 0 : ($last_check - 1)));
        }
    }

    function theme_update_check() {
        /* Sanity Checks */
        if(!function_exists('curl_version')) {
            $this->display_warning('PHP cURL appears not to be enabled or installed. Please contact your web hosting provider about how to enable this required PHP library. ');
            return false;
        }

        /* Build information about current themes */
        $themes = $this->get_themes();
        $update_query = array(
            'themes' => array()
        );
        foreach ($themes as $theme) {
            $theme_name = $theme['theme'];
            $theme_version = (empty($theme['version']) ? '1.0.0' : $theme['version']);
            $update_query['themes'][$theme_name] = $theme_version;
        }

        $update_query = build_query($update_query);

        /* Figure out max execution time */
        $max_time_limit = 180;
        while ($max_time_limit) {
            if (set_time_limit($max_time_limit))
                break;
            $max_time_limit--;
        }
        if ($max_time_limit < 20) {
            $this->display_warning('Was unable to increase max execution time.');
            return false;
        }

        /* Query server for updates */
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://popupdomination.com/update-check-themes/?'.$update_query);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, max(5, $max_time_limit - 5));
            $update_results = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            $this->display_warning('Connection to PopUp Domination Update server failed. Please try again later.');
            return false;
        }

        /* Process Results */
        try {
            $updates = unserialize($update_results);
        } catch (Exception $e) {
            $this->display_warning('Unexpected response from PopUp Domination Update server. Please try again later.');
            return false;
        }

        if(empty($updates))
            echo 'No updates found!';

        echo 'Found '.count($updates).' updates.<br /><hr />';

        foreach($updates as $update_theme => $update_url) {
            /* Match update to theme data */
            foreach($themes as $theme) {
                if($theme['theme'] == $update_theme) {
                    echo '<div><strong>'.$theme['name'].'</strong><br /> <a href="'.$update_url.'" class="remote_update">Update Theme</a><br /><span class="update_status"></span><hr /></div>';
                    break;
                }
            }
        }
    }
}

$popup_domination = new PopUp_Domination_Admin();