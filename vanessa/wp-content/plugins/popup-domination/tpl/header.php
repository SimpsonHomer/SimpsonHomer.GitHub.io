<div class="popup_domination_top_left">
    <img class="logo" src="<?PHP echo $this->plugin_url?>css/img/popup-domination3-logo.png" alt="Popup Domination 3.0" title="Popup Domination 3.0" width="200" height="62" />
<?PHP if ((isset($header_link) && $header_link != '') &&  (isset($header_url) && $header_url != '')): ?>
    <p><a href="<?PHP echo $header_url; ?>"><?PHP echo $header_link; ?></a></p>
<?PHP else: ?>
    <p><a href="#">&lt; Home</a></p>
<?PHP endif; ?>
    <div class="clear"></div>
</div>