/**
 * page.js
 *
 * jQuery file used in every page of PopUp Domination
 */
;
(function($) {
    $(document).ready(function() {
        $('.noscript').each(function() {
            $(this).css('display', 'none');
        });
        init_tabs();
        $('h3.help').on('click', function() {
            $(this).siblings(".popdom_contentbox_inside").toggle('fast');
        });
        
        $('<div id="adsense_test" class="adsense bottomAd" style="height:10px"/>').appendTo('body');
        setTimeout(function() {
            if($('#adsense_test').css("display") === 'none')
                alert('Warning: It appears you may be using some form of adblock. This has been known to cause issues in the admin panel.');
        }, 3000);
        
        function checkInputs() {
            $('#popup_domination_container input.required, #popup_domination_container textarea.required').each(function() {
                if($(this).val().length == 0) {
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        }

        $('.default-values').on('click', function() {
            $('.popdom_contentbox_inside .template_fields input[type=\'text\'], .popdom_contentbox_inside .template_fields textarea').each(function() {
                if($(this).attr('default-value') && $(this).attr('default-value').length)
                    $(this).val($(this).attr('default-value'))
            });
        });

        $('.remote_update').on('click', function(event) {
            event.preventDefault();
            var update_url = $(this).attr('href');
            var status_obj = $(this).parent('div').find('.update_status');

            $(this).remove();
            status_obj.html('Updating');

            var opts = {
                'action': 'popup_domination_upload_theme_remote',
                'update_url': update_url
            };
            $.get(popup_domination_admin_ajax + '?rand=' + (Math.random() * 555), opts, function(resp) {
                status_obj.html(resp);
            });

            return false;
        });
    });
    
    function get_hash(str) {
        if(str.indexOf('#') !== -1)
            return str.split('#').pop();
        return str;
    }

    function init_tabs() {
        var elem = $('#popup_domination_tabs a'), cur_hash = get_hash(document.location.hash);
        height2 = $('#popup_domination_container div[id^="popup_domination_tab_"]' + cur_hash + ' .the_content_box').outerHeight(true);
        $('.the_content_box').parent().css('min-height', height2);
        elem.each(function() {
            var hash = get_hash($(this).attr('href'));
            if(hash == 'preview') {
                $(this).click(function() {
                    do_preview();
                    return false;
                });
            } else {
                if($('#popup_domination_tab_' + hash).length > 0) {
                    $(this).click(function() {

                        $('.icon').removeClass('selected');
                        $(this).addClass('selected');
                        var id = get_hash($(this).attr('href'));
                        $('#popup_domination_form_submit').toggle((id != 'advanced_view'));
                        $('#popup_domination_current_version').toggle((id != 'advanced_view'));
                        if(id != 'advanced_view') {
                            $('#popup_domination_tab_advanced_view:visible').toggle();
                        }
                        id = '#popup_domination_tab_' + id;
                        $('#popup_domination_container div[id^="popup_domination_tab_"]:not(' + id + '):visible').toggle();
                        $(id + ':not(:visible)').toggle();
                        height2 = $('div[id^="popup_domination_tab_"]' + id + ' .the_content_box').outerHeight(true);
                        $('.the_content_box').parent().css('min-height', height2);
                        return false;
                    });
                }
                $('.popup_domination_check_updates_link a').click(function() {
                    var waiting = $('#popup_domination_tab_schedule .waiting');
                    waiting.show();
                    $('#popup_domination_container div[id^="popup_domination_tab_"]:visible').toggle();
                    height2 = $('#popup_domination_tab_check_updates .the_content_box').outerHeight(true);
                    $('.the_content_box').parent().css('min-height', height2);
                    $('#popup_domination_tab_check_updates').show();
                    var opts = {"action": 'popup_domination_check_updates',
                        "_wpnonce": $('#_wpnonce').val(),
                        "_wp_http_referer": $('input[name="_wp_http_referer"]').val()};
                    $.get(popup_domination_admin_ajax + '?rand=' + (Math.random() * 555), opts, function(resp) {
                        waiting.hide();
                    }, 'json');
                });

            }
        });
        if(cur_hash != '') {
            var elem2 = elem.filter('[href$="#' + cur_hash + '"]');
            if(elem2.length > 0) {
                elem2.click();
                return;
            }
        }
        elem.filter(':eq(0)').click();
    }

    function do_preview() {
        window.open('', 'preview_popup', '');

        var elem = $('#popup_domination_form');
        var action = elem.attr('action');
        elem.attr('action', popup_domination_admin_ajax + '?action=popup_domination_preview')
                .attr('target', 'preview_popup')
                .submit()
                .attr('action', action)
                .removeAttr('target');
    }
})(jQuery);