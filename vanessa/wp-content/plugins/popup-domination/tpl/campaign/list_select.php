<?PHP
/*
* list.php
*
* PHP file used to display all current campaigns
*/
?>
<html>
<head>
    <link rel="stylesheet" id="popup-domination-page-css" href="<?PHP echo $this->rewrite_script('css/page.css?ver=3.8'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" id="popup-domination-campaigns-css" href="<?PHP echo $this->rewrite_script('css/campaigns.css?ver=3.8'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" id="popup-domination-campaigns-css" href="<?PHP echo admin_url('css/colors.min.css?ver=3.8'); ?>" type="text/css" media="all" />
    <link rel="stylesheet" href="<?PHP echo admin_url('load-styles.php?c=1&dir=ltr&load=dashicons,admin-bar,buttons,media-views,wp-admin,wp-auth-check&ver=3.8'); ?>" type="text/css" media="all" />
    <script type="text/javascript" src="<?PHP echo admin_url('load-scripts.php?c=1&amp;load%5B%5D=jquery-core,jquery-migrate,utils,jquery-ui-core,jquery-ui-widget,jquery-ui-mouse,jquery-ui-slider&amp;ver=3.8'); ?>"></script>
    <script type="text/javascript" src="<?PHP echo includes_url('js/tinymce/tiny_mce_popup.js'); ?>"></script>

    <style>
        html, body { height: auto; }
        .insert_options table { margin-left: 18px; }
        .insert_options table input, .insert_options table select { margin:0 !important; min-width:300px; }
        .insert_options table .show_where { padding-top: 6px; }
        .insert_options .label {
            font-size: 12px;
            padding-top: 12px;
            font-weight: 900;
            vertical-align: text-top;
            padding-right: 10px;
        }    
    </style>

    <script>
    function addParam(url, param, value) {
        var a = document.createElement('a');
        a.href = url;
        a.search += a.search.substring(0,1) == '?' ? '&' : '?';
        a.search += encodeURIComponent(param) + '=' + encodeURIComponent(value);
        return a.href;
    }
    jQuery(document).ready(function($) {
        var title = window.parent.tinyMCE.activeEditor.selection.getContent({format : 'html'});
        if(title.length !== 0)
            $('.link_text').css('display', 'none');
            
        $('#insert').click(function() {
            var show_where = $('#show_where').val();
            var popdom = $('input[name="popdomid"]:checked').val();
            
            if(title.length === 0)
                title = $('#link_text').val();
            
            if(title.length === 0) {
                alert('Please enter a valid text for the URL');
                return;
            }
            
            if(typeof popdom === 'undefined') {
                alert('Please select a popup campaign');
                return;
            }
           
            if(show_where === 'current') {
                window.parent.tinyMCE.execCommand('mceInsertContent', false, '<a href="#popdom-' + popdom + '">' + title + '</a>');
            } else
                window.parent.tinyMCE.execCommand('mceInsertContent', false, '<a href="' + addParam(show_where, 'popdom', popdom) + '">' + title + '</a>');
            
            window.parent.tinyMCE.activeEditor.windowManager.close(window);
        });
    });
    </script>
</head>
<body>
    <div class="wrap wp-core-ui" id="popup_domination">
        <?PHP
            $header_link = '  ';
            $header_url = '#';
            include $this->plugin_path.'tpl/header.php';
        ?>
        <div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
        <div class="clear"></div>
        <div id="popup_domination_container" class="has-left-sidebar">
            <div style="display:none" id="popup_domination_hdn_div2"></div>

            <div class="mainbox" id="popup_domination_campaign_list">
                <div class="clear"></div>

                <?PHP 
                foreach($campaigns as $campaign){ 
                    if($campaign['active'] == '0' || $campaign['inpost'] == true)
                        continue;
                ?>
                <div class="camprow" id="camprow_<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['id']; ?>">
                    <input type="radio" name="popdomid" value="<?PHP echo $campaign['id']; ?>" style="float:left;vertical-align: middle;margin-top: 50px;margin-right: 10px;">
                    <div class="tmppreview">
                        <div class="preview_crop">
                            <div class="spacing">
                                <div class="slider"><h2><?PHP echo (!empty($c)) ? $tempname[$c->id] : ''; ?></h2></div>
                                <img class="img" id="test" src="<?PHP echo $campaign['previewurl']; ?>" height="<?PHP echo $campaign['height']; ?>" width="<?PHP echo $campaign['width']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="namedesc">
                        <a href="<?PHP echo 'admin.php?page='.$this->menu_url.'campaigns&action=edit&id='.$campaign['id']; ?>"><?PHP echo $campaign['name']; ?></a><br/>
                        <p class="description"><?PHP echo $campaign['desc']; ?></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <?PHP } ?>
                <div class="clear"></div>
                <div class="insert_options">
                    <table>
                        <tr class="link_text">
                            <td class="label">Link Text</td>
                            <td><input type="text" id="link_text"></td>
                        </tr>
                        <tr>
                            <td class="label">Show Where</td>
                            <td class="show_where">
                                <select id="show_where">
                                    <option value="current">Current Page</option>
                                    <option disabled>-- Pages</option>
                                    <?PHP
                                    $pages = get_pages(array('posts_per_page' => 150)); 
                                    foreach($pages as $page) {
                                        $option = '<option value="' . get_page_link($page->ID) . '">';
                                        $option .= $page->post_title;
                                        $option .= '</option>';
                                        echo $option;
                                    }
                                    ?>
                                    <option disabled>-- Posts</option>
                                    <?PHP
                                    $pages = get_posts(array('posts_per_page' => 100)); 
                                    foreach($pages as $page) {
                                        $option = '<option value="' . get_page_link($page->ID) . '">';
                                        $option .= $page->post_title;
                                        $option .= '</option>';
                                        echo $option;
                                    }
                                    ?>                                
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><br /><input name="save" type="submit" class="button button-primary button-large" id="insert" accesskey="p" value="Insert"></td>
                        </tr>
                    </table>
                </div>
                <br />
                <div class="clear"></div>
            </div>
        </div>
    </div>
</body>
</html>