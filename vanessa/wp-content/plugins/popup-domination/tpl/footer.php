<div class="clear"></div>
<div id="popup_domination_form_submit">
    <p class="submit">
        <?PHP echo (isset($footer_fields) && !empty($footer_fields)) ? $footer_fields: ''; ?>
        <?PHP echo (isset($save_button) && !empty($save_button)) ? $save_button: ''; ?>
        <?PHP wp_nonce_field('update-options'); ?>
    </p>
    <?PHP echo ((isset($_GET['action']) && ($_GET['action'] == 'edit' || $_GET['action'] == 'create'))) ? '<p><strong>Remember:</strong> You must check your Campaign Name before you can create a new campaign.</p>': ''; ?>

    <div id="popup_domination_current_version">
        <p>You are currently running <strong>version <?PHP echo $this->version; ?></strong></p>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
    var popup_domination_admin_ajax = '<?PHP echo admin_url('admin-ajax.php') ?>', popup_domination_theme_url = '<?PHP echo $this->theme_url ?>', popup_domination_form_url = '<?PHP echo $this->opts_url ?>', popup_domination_url = '<?PHP echo $this->plugin_url ?>';
    <?PHP echo (isset($page_javascript) && $page_javascript != '') ? $page_javascript: ''; ?>
</script>