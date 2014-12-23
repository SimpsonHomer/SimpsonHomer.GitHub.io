var once_onload = false;
function load_lightbox() {
    if(once_onload) { return false; } else { once_onload = true; }
    var once_document_ready = false;
    jQuery(document).ready(function($) {
        if(once_document_ready) { return false; } else { once_document_ready = true; }
        if(typeof popup_domination !== 'undefined' && (typeof popup_non === 'undefined' || (typeof popup_non !== 'undefined' && popup_non !== 'true'))) {
            if(popup_domination.show_anim !== 'inpost') {
                $('<iframe id="popdom_iframe" style="border:0 !important;padding:0 !important;position:fixed !important;top:0 !important;left:0 !important;right:0 !important;bottom:0 !important;width:100% !important;min-height:100% !important;z-index:99999999;display:none;background:transparent !important;" />').on('load', function(){
                    $('#popdom_iframe').ready(function() {
                        $('#popdom_iframe').contents().find('body').append( popup_domination.output );

                        /* Fix for some themes that define body style */
                        $('#popdom_iframe').contents().find('body').css('background', 'transparent');

                        if(typeof popup_domination_admin_ajax !== 'undefined')
                            $('#popdom_iframe').get(0).contentWindow.popup_domination_admin_ajax = popup_domination_admin_ajax;

                        if(typeof popup_domination !== 'undefined')
                            $('#popdom_iframe').get(0).contentWindow.popup_domination = popup_domination;

                        if(typeof popup_non !== 'undefined')
                            $('#popdom_iframe').get(0).contentWindow.popup_non = popup_non;

                        if(typeof popup_domination_new_window !== 'undefined')
                            $('#popdom_iframe').get(0).contentWindow.popup_domination_new_window = popup_domination_new_window;

                        $('#popdom_iframe').contents().find('head').append(
                            popup_domination.dom_head
                        );
                        $('#popdom_iframe').load(function(){
                            try {
                                window.location = this.contentWindow.location;
                            } catch(err) {
                                /* Fail gracefully */
                                $('#popdom_iframe').css('background', 'white');
                            }
                        });
                    });
                }).appendTo('body');
            } else
                $('#popdom-inline-container').append(popup_domination.dom_head);
        }
    });
}
load_lightbox();