(function($) {
    /* Stop execution if cookies are not enabled */
    var cookieEnabled = (navigator.cookieEnabled) ? true : false;
    //if not IE4+ nor NS6+
    if(typeof navigator.cookieEnabled === 'undefined' && !cookieEnabled) {
        document.cookie = 'testcookie';
        cookieEnabled = (document.cookie.indexOf('testcookie') !== -1) ? true : false;
    }
    if(!cookieEnabled) {
        console.log('Cookies are disabled. Exiting operation.');
        return false;
    }

    enable_link_select('popup-domination-link');

    // the following variables detect whether or not to show the popup //
    //
    //  isHidden    => true when the popup is part of an A/B campaign that's been seen already
    //  isRefBlock  => true when the URL of the page has teh query string pdref=1 in it.

    if(typeof popup_domination_new_window === 'undefined')
        popup_domination_new_window = 'no';

    var isHidden = (get_cookie('popup_domination_hide_ab' + popup_domination.campaign) === 'Y');
    var isRefBlock = (location.search.indexOf('pdref=1') > -1);

    if(location.search.indexOf('popdom=') > -1)
        isHidden = false;

    if(typeof popup_domination === 'undefined') {
        console.log('popup_domination is undefined');
        popup_domination = '';
        return false;
    }

    var timer, exit_shown = false;
    var forced = false;

    if($('#popdom_iframe').length)
        obj_sel = $('#popdom_iframe').contents();
    else
        obj_sel = $('#popdom-inline-container');

    function start_popdom() {
        vidcheck = setTimeout(function() {
            check_cookie(popup_domination.popupid, popup_domination.mailingid)
        }, 1);
        var cururl = window.location;
        if(decodeURIComponent(popup_domination.conversionpage) == cururl) {
            var abcookie = get_cookie('popup_dom_split_show');
            var camp = popup_domination.campaign;
            if(abcookie == 'Y') {
                var popupid = get_cookie("popup_domination_lightbox");
                var data = {
                    action: 'popup_domination_ab_split',
                    stage: 'opt-in',
                    camp: camp,
                    popupid: popupid,
                    optin: '1'
                };
                jQuery.post(popup_domination_admin_ajax, data, function(response) {
                    document.cookie = 'popup_dom_split_show' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
                });
            }
        }

        if(popup_domination.show_background != 'true') {
            obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-overlay').remove();
            obj_sel.find('.popup-dom-lightbox-wrapper').css({height: 'auto', width: 'auto'});
        }

        if(popup_domination.allow_background_close != '') {
            obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-overlay').click(function() {
                if(popup_domination.close_option != 'false') {
                    $('#popdom_iframe').hide();
                    close_box(popup_domination.popupid, false);
                    return false;
                }
            });
        }

        if(typeof popup_domination.show_opacity !== 'undefined')
            var m_opacity = Math.max(Math.min(parseInt(popup_domination.show_opacity), 100), 0);
        else
            var m_opacity = 70;

        if(typeof popup_domination.show_color !== 'undefined')
            var m_color = popup_domination.show_color;
        else
            var m_color = '#000000';

        obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-overlay').css({
            opacity: (m_opacity / 100).toString(),
            filter: 'alpha(opacity=' + m_opacity.toString() + ')',
            'background-image': 'none',
            'background-color': m_color
        });

        if(popup_domination.impression_count > 1) {
            if(check_impressions())
                return false;
        }
        max_zindex();
        if(popup_domination.center && popup_domination.center == 'Y')
            init_center();

        if(!isHidden && !isRefBlock) {
            switch(popup_domination.show_opt) {
                case 'mouseleave':
                    $('html,body').mouseout(window_mouseout);
                    break;
                case 'bottompage':
                    jQuery(window).scroll(function() {
                        var shown = false;
                        if(shown == false && jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height()) {
                            shown = true;
                            show_lightbox();
                        }
                    });
                    break;
                case 'unload':
                    enable_unload();
                    break;
                case 'linkclick':
                    if(!popup_domination.linkclick)
                        popup_domination.linkclick = 'popup-domination-link';
                    enable_link_select(popup_domination.linkclick);
                    break;
                case 'tab':
                    if(!check_cookie('none', popup_domination.mailingid) && !($.browser.msie && $.browser.version < 10)) {
                        create_tab();
                        break;
                    }
                default:
                    if(popup_domination.delay && popup_domination.delay > 0)
                        timer = setTimeout(show_lightbox, (popup_domination.delay * 1000));
                    else
                        show_lightbox();
                    break;
            }
        }

        obj_sel.find('#popup_domination_lightbox_wrapper #close-button').css('cursor', 'pointer').click(function() {
            if(popup_domination.close_option !== 'false') {
                $('#popdom_iframe').hide(); //possible IE fix?
                close_box(popup_domination.popupid, false);
                return false;
            }
        });
        $(document).keydown(function(e) {
            if(e.which == 27 && popup_domination.close_option !== 'false') {
                close_box(popup_domination.popupid, false);
                return false;
            }
        });

        if(popup_domination.close_option === 'false') {
            obj_sel.find('#popup_domination_lightbox_close').remove();
        } else {
            obj_sel.find('#popup_domination_lightbox_wrapper #popup_domination_lightbox_close').click(function() {
                close_box(popup_domination.popupid, false);
                return false;
            });
        }

        var provider = obj_sel.find('#popup_domination_lightbox_wrapper .provider').val();

        // TODO REVIEW
        if(provider == 'aw')
            obj_sel.find('#popup_domination_lightbox_wrapper .form div').append('</form>');

        //code to allow 'open in new window' functionality - prevents browsers blocking it.
        if(obj_sel.find('#popup_domination_lightbox_wrapper form').attr('target') === 'popdom' || popup_domination_new_window === 'yes')
            obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"],.popdom_form input[type="submit"]').attr('onclick', "window.open('about:blank','popdom')");

        if($.isFunction($.fn.on)) {
            obj_sel.find('#popup_domination_lightbox_wrapper , #popdom-inline-container , .popdom_form ').on('click', 'input[type="submit"]', function(e) {
                submit_the_thing(this, e);
            });
            obj_sel.find('#popup_domination_lightbox_wrapper , #popdom-inline-container , .popdom_form ').on('keyup', 'input[type="text"]', function(e) {
                if(e.keyCode === 13)
                    obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"], #popdom-inline-container input[type="submit"], .popdom_form input[type="submit"]').click();
            });
        } else {
            obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"], #popdom-inline-container input[type="submit"], .popdom_form input[type="submit"]').live('click', function(e) {
                submit_the_thing(this, e);
            });
            obj_sel.find('#popup_domination_lightbox_wrapper input[type="text"], #popdom-inline-container input[type="text"], .popdom_form input[type="text"]').live('keyUp', function(e) {
                if(e.keyCode === 13)
                    obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"], #popdom-inline-container input[type="submit"], .popdom_form input[type="submit"]').click();
            });
        }

        function submit_the_thing(target, e) {
            e.preventDefault();
            var checked = false;
            var checkArray = new Array();
            var thisform = '';//$(this).parents('form');

            if(thisform.length === 0)
                thisform = $(target).parents('#popup_domination_lightbox_wrapper');

            thisform.find(':text').each(function() {
                var $this = $(this), val = $this.val();
                if($this.data('default_value') && val == $this.data('default_value'))
                    checkArray.push(false);

                if(val == '' && typeof $this.attr('required') !== 'undefined') {
                    checkArray.push(false);
                } else {
                    if(val === $this.data('default_value'))
                        checkArray.push(false);
                    else
                        checkArray.push(true);
                }
            });
            if(typeof thisform.find('.email').val() !== 'undefined') {
                if(thisform.find('.email').val().indexOf('@') < 1) {
                    checkArray.push(false);
                    if(obj_sel.find('#popup_domination_lightbox_wrapper form').attr('target') == 'popdom' || popup_domination_new_window == 'yes')
                        open('', 'popdom').close();
                    thisform.find('.error').text('Please enter a valid email address.').show();
                }
            } else {
                //this is a redirect theme (well, there's no email field)
                thisform.find('form').get(0).setAttribute('method', 'get'); //oh yes, another little jQuery "quirk" anyway, make it a get not a post
                //when we submit a form via a GET we need to make all URL query strings part of the form as any querystrings in the action URL
                //will be lost by the browser (html5 spec) and replaced by the contents of the form.
                var keys = [], vals = [], vars = [], hash;
                var q = thisform.find('form').get(0).getAttribute('action').split('?')[1];
                if(q !== undefined) {
                    q = q.split('&');
                    for(var i = 0; i < q.length; i++) {
                        hash = q[i].split('=');
                        keys.push(hash[0]);
                        vals.push(hash[1]);
                    }
                    $.each(vals, function(index) {
                        thisform.find('form').prepend('<input type="hidden" name="' + keys[index] + '" value="' + vals[index] + '">');
                    });
                }
            }
            checked = !($.inArray(false, checkArray) > -1);

            var email = thisform.find('.email').val();
            var name = thisform.find('.name').val();
            var custom1 = thisform.find('.custom1_input').val();
            var custom2 = thisform.find('.custom2_input').val();
            var customf2 = thisform.find('.custom_id2').val();
            var customf1 = thisform.find('.custom_id1').val();
            var listid = thisform.find('.listid').val();
            var mailingid = thisform.find('.mailingid').val();
            var mailnotify = thisform.find('.mailnotify').val();
            var master = thisform.find('.master').val();
            var campaignid = thisform.find('.campaignid').val();
            var campname = thisform.find('.campname').val();
            var provider = thisform.find('.provider').val();

            if(typeof email === 'undefined') {
                campaignid = popup_domination.popupid;
                register_optin(provider, false, campaignid);
            } else if(checked) {
                thisform.find('input[type="submit"]').attr('disabled', 'disabled');
                thisform.find('.form input').hide();
                thisform.find('.wait').show();
                thisform.find('.error').hide();
                var data = {
                    action: 'popup_domination_lightbox_submit',
                    provider: provider,
                    listid: listid,
                    redirect: popup_domination.redirect,
                    mailingid: mailingid,
                    mailnotify: mailnotify,
                    master: master,
                    campaignid: campaignid,
                    campname: campname,
                    name: name,
                    email: email,
                    custom1: custom1,
                    custom2: custom2,
                    customf1: customf1,
                    customf2: customf2
                };
                jQuery.post(popup_domination_admin_ajax, data, function(response) {
                    if(response.length > 4 && response.indexOf('formcode') === -1) {
                        thisform.find('input[type="submit"]').removeAttr('disabled', 'disabled');
                        if(obj_sel.find('#popup_domination_lightbox_wrapper form').attr('target') === 'popdom' || popup_domination_new_window === 'yes')
                            open('', 'popdom').close();
                        thisform.find('.form input').show();
                        thisform.find('.wait').hide();
                        if(provider === 'mc' || provider === 'cc')
                            thisform.find('.error').text(response).show();
                        else
                            thisform.find('.error').text('There was an error, please check your fields.').show();
                    } else
                        register_optin(provider, mailingid, campaignid);
                });
            } else {
                thisform.submit(function(e) {
                    e.preventDefault();
                });
                return false;
            }
            return false;
        }

        obj_sel.find('#popup_domination_lightbox_wrapper .sb_facebook').click(function() {
            if($(this).hasClass('got_user') === true) {
                var email = obj_sel.find('#popup_domination_lightbox_wrapper .fbemail').val();
                var name = obj_sel.find('#popup_domination_lightbox_wrapper .fbname').val();
                var custom1 = obj_sel.find('#popup_domination_lightbox_wrapper .custom1_input').val();
                var custom2 = obj_sel.find('#popup_domination_lightbox_wrapper .custom2_input').val();
                var customf2 = obj_sel.find('#popup_domination_lightbox_wrapper .custom_id2').val();
                var customf1 = obj_sel.find('#popup_domination_lightbox_wrapper .custom_id1').val();
                var listid = obj_sel.find('#popup_domination_lightbox_wrapper .listid').val();
                var mailingid = obj_sel.find('#popup_domination_lightbox_wrapper .mailingid').val();
                var mailnotify = obj_sel.find('#popup_domination_lightbox_wrapper .mailnotify').val();
                var campaignid = obj_sel.find('#popup_domination_lightbox_wrapper .campaignid').val();
                var campname = obj_sel.find('#popup_domination_lightbox_wrapper .campname').val();
                var master = obj_sel.find('#popup_domination_lightbox_wrapper .master').val();
                obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"]').attr('disabled', 'disabled');
                obj_sel.find('#popup_domination_lightbox_wrapper .form input').hide();
                obj_sel.find('#popup_domination_lightbox_wrapper .wait').show();
                obj_sel.find('#popup_domination_lightbox_wrapper .error').hide();
                if(provider !== 'form' && provider !== 'aw' && provider !== 'nm') {
                    var data = {
                        action: 'popup_domination_lightbox_submit',
                        name: name,
                        email: email,
                        custom1: custom1,
                        custom2: custom2,
                        customf1: customf1,
                        customf2: customf2,
                        provider: provider,
                        listid: listid,
                        mailingid: mailingid,
                        mailnotify: mailnotify,
                        master: master,
                        campaignid: campaignid,
                        campname: campname
                    };

                    jQuery.post(popup_domination_admin_ajax, data, function(response) {
                        if(response.length > 4) {
                            obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"]').removeAttr('disabled', 'disabled');
                            obj_sel.find('#popup_domination_lightbox_wrapper .form input').show();
                            obj_sel.find('#popup_domination_lightbox_wrapper .wait').hide();
                        } else {
                            close_box(popup_domination.popupid, mailingid);
                            if(check_split_cookie() !== true) {
                                var popupid = popup_domination.popupid;
                                var data = {
                                    action: 'popup_domination_analytics_add',
                                    stage: 'opt-in',
                                    popupid: popup_domination.popupid
                                };
                                jQuery.post(popup_domination_admin_ajax, data, function() {
                                    redirect(popup_domination.redirect, provider);
                                });
                            } else {
                                redirect(popup_domination.redirect, provider);
                            }
                        }
                    });
                } else {
                    obj_sel.find('#popup_domination_lightbox_wrapper .email').val(email);
                    obj_sel.find('#popup_domination_lightbox_wrapper .name').val(name);
                    if(check_split_cookie() != true) {
                        var popupid = popup_domination.popupid;
                        var data = {
                            action: 'popup_domination_analytics_add',
                            stage: 'opt-in',
                            popupid: popup_domination.popupid
                        };
                        jQuery.post(popup_domination_admin_ajax, data, function() {
                            obj_sel.find('#popup_domination_lightbox_wrapper form').submit();
                            close_box(popup_domination.popupid, mailingid);
                        });
                        return false;
                    } else {
                        obj_sel.find('#popup_domination_lightbox_wrapper form').submit();
                        close_box(popup_domination.popupid, mailingid);
                    }
                    return false;
                }
                return false;
            }
        });

        $(function() {
            var ele = obj_sel.find(".lightbox-download-nums");
            var clr = null;
            var number = obj_sel.find('.lightbox-download-nums').text();
            number = parseInt(number);
            var rand = number;
            loop();
            function loop() {
                clearInterval(clr);
                inloop();
                setTimeout(loop, 1000);
            }
            function inloop() {
                ele.html(rand += 1);
                if(!(rand % 50))
                    return;
                clr = setTimeout(inloop, 3000);
            }
        });

        obj_sel.find('input[type=text], textarea').mouseover(zoomDisable).mousedown(zoomEnable);
        function zoomDisable() {
            $('head meta[name=viewport]').remove();
            $('head').prepend('<meta name="viewport" content="user-scalable=0" />');
        }
        function zoomEnable() {
            $('head meta[name=viewport]').remove();
            $('head').prepend('<meta name="viewport" content="user-scalable=1" />');
        }
    }

    $(document).ready(function() {
        start_popdom();
    });

    function redirect(page, provider) {
        if(page != '' && provider != 'form') {
            if(popup_domination_new_window != 'yes')
                window.location.href = decodeURIComponent(page);
            else
                window.open(decodeURIComponent(page), 'popdom');
        }
    }

    //suspect this function is no longer required...
    function social_submit() {
        if(obj_sel.find('#popup_domination_lightbox_wrapper .fbemail').val() != 'none' && obj_sel.find('#popup_domination_lightbox_wrapper .fbemail').val() != 'none') {
            var checked = false;
            obj_sel.find('#popup_domination_lightbox_wrapper :text').each(function() {
                var $this = $(this), val = $this.val();
                if($this.data('default_value') && val == $this.data('default_value')) {
                    if(checked)
                        $this.val('').focus();
                    checked = false;
                }
                if(val == '') {
                    checked = false;
                } else {
                    if(val == $this.data('default_value'))
                        checked = false;
                    else
                        checked = true;
                }
            });
            if(checked) {
                var email = obj_sel.find('#popup_domination_lightbox_wrapper .fbemail').val();
                var name = obj_sel.find('#popup_domination_lightbox_wrapper .fbname').val();
                var listid = obj_sel.find('#popup_domination_lightbox_wrapper .listid').val();
                var provider = obj_sel.find('#popup_domination_lightbox_wrapper .provider').val();
                var mailingid = obj_sel.find('#popup_domination_lightbox_wrapper .mailingid').val();
                obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"]').attr('disabled', 'disabled');
                obj_sel.find('#popup_domination_lightbox_wrapper .form input').hide();
                obj_sel.find('#popup_domination_lightbox_wrapper .wait').show();
                obj_sel.find('#popup_domination_lightbox_wrapper .error').hide();
                if(provider != 'form' && provider != 'aw' && provider != 'nm') {
                    var data = {
                        action: 'popup_domination_lightbox_submit',
                        name: name,
                        email: email,
                        provider: provider,
                        listid: listid
                    };
                    jQuery.post(popup_domination_admin_ajax, data, function(response) {
                        if(response.length > 4) {
                            obj_sel.find('#popup_domination_lightbox_wrapper input[type="submit"]').removeAttr('disabled', 'disabled');
                            obj_sel.find('#popup_domination_lightbox_wrapper .form input').show();
                            obj_sel.find('#popup_domination_lightbox_wrapper .wait').hide();
                        } else {
                            close_box(popup_domination.popupid, mailingid);
                            if(check_split_cookie() != true) {
                                var popupid = popup_domination.popupid;
                                var data = {
                                    action: 'popup_domination_analytics_add',
                                    stage: 'opt-in',
                                    popupid: popup_domination.popupid
                                };
                                jQuery.post(popup_domination_admin_ajax, data, function() {
                                    redirect(popup_domination.redirect, provider);
                                });
                            } else
                                redirect(popup_domination.redirect, provider);
                        }
                    });
                } else {
                    if(check_split_cookie() != true) {
                        var popupid = popup_domination.popupid;
                        var data = {
                            action: 'popup_domination_analytics_add',
                            stage: 'opt-in',
                            popupid: popup_domination.popupid
                        };
                        jQuery.post(popup_domination_admin_ajax, data, function() {
                            obj_sel.find('#popup_domination_lightbox_wrapper form').submit();
                            close_box(popup_domination.popupid, mailingid);
                        });
                        return false;
                    } else {
                        obj_sel.find('#popup_domination_lightbox_wrapper form').submit();
                        close_box(popup_domination.popupid, mailingid);
                    }
                    return false;
                }
            }
            return false;
        }
    }

    var campaigns_analytics_posted = [];

    function register_view() {
        if(campaigns_analytics_posted.indexOf(popup_domination.popupid) !== -1)
            return;
        campaigns_analytics_posted.push(popup_domination.popupid);

        var data = '';
        if(check_split_cookie() != true) {
            if(popup_domination.disable_analytics === 'true')
                return;
            data = {
                action: 'popup_domination_analytics_add',
                stage: 'show',
                popupid: popup_domination.popupid
            };
        } else {
            var date = new Date();
            date.setTime(date.getTime() + (86400 * 1000));
            set_cookie('popup_dom_split_show', 'Y', date);
            set_cookie('popup_domination_lightbox', popup_domination.popupid, date);
            data = {
                action: 'popup_domination_ab_split',
                stage: 'show',
                popupid: popup_domination.popupid,
                camp: popup_domination.campaign
            };
        }
        jQuery.post(popup_domination_admin_ajax, data);
    }

    function register_all_views() {
        var campaigns_on_page = [];
        obj_sel.find('.campaignid').each(function() {
            campaigns_on_page.push($(this).val());
        });
        $.unique(campaigns_on_page); //we won't register 2 views of the same campaign on the same page
        for(var i = 0; i < campaigns_on_page.length; i++) {
            var data = '';

            if(campaigns_analytics_posted.indexOf(campaigns_on_page[i]) !== -1)
                return;
            campaigns_analytics_posted.push(campaigns_on_page[i]);

            if(check_split_cookie() != true) {
                if(popup_domination.disable_analytics === 'true')
                    continue;

                data = {
                    action: 'popup_domination_analytics_add',
                    stage: 'show',
                    popupid: campaigns_on_page[i]
                };
            } else {
                var date = new Date();
                date.setTime(date.getTime() + (86400 * 1000));
                set_cookie('popup_dom_split_show', 'Y', date);
                set_cookie('popup_domination_lightbox', popup_domination.popupid, date);
                data = {
                    action: 'popup_domination_ab_split',
                    stage: 'show',
                    popupid: popup_domination.popupid,
                    camp: popup_domination.campaign
                };
            }
            if(!check_cookie(campaigns_on_page[i]))
                jQuery.post(popup_domination_admin_ajax, data);
        }
    }

    function register_optin(prov, mailingid, campaignid) {
        close_box(campaignid, mailingid);
        var data = '';
        if(check_split_cookie() != true) {
            data = {
                action: 'popup_domination_analytics_add',
                stage: 'opt-in',
                popupid: campaignid
            };
        } else {
            data = {
                action: 'popup_domination_ab_split',
                stage: 'opt-in',
                popupid: campaignid,
                camp: popup_domination.campaign
            };
        }

        //submit depending on provider
        if(prov === 'form' || prov === 'aw' || typeof prov === 'undefined') {
            if(popup_domination.disable_analytics === 'true' && data.action == 'popup_domination_analytics_add') {
                obj_sel.find('#popup_domination_lightbox_wrapper form').appendTo('body').submit();
            } else {
                jQuery.post(popup_domination_admin_ajax, data, function() {
                    obj_sel.find('#popup_domination_lightbox_wrapper form').appendTo('body').submit();
                });
            }
        } else {
            if(popup_domination.disable_analytics === 'true' && data.action == 'popup_domination_analytics_add') {
                redirect(popup_domination.redirect, prov);
            } else {
                jQuery.post(popup_domination_admin_ajax, data, function() {
                    redirect(popup_domination.redirect, prov);
                });
            }
        }
        if(popup_domination.google_goal !== '')
            eval(popup_domination.google_goal);
    }

    function enable_unload() {
        window.onbeforeunload = function(e) {
            if(exit_shown === false) {
                e = e || window.event;
                exit_shown = true;
                setTimeout(show_lightbox, 1000);
                if(e)
                    e.returnValue = popup_domination.unload_msg;
                return popup_domination.unload_msg;
            }
        };
    }

    function enable_link_select(classname) {
        if($.isFunction($.fn.on)) {
            $('body').on('click', '.' + classname, function(e) {
                e.preventDefault();
                show_lightbox(true);
            });
            $('body').on('hover', '.' + classname, function(e) {
                $(this).css('cursor', 'pointer');
            });
        } else {
            $('.' + classname).live('click', function(e) {
                e.preventDefault();
                show_lightbox(true);
            }).css('cursor', 'pointer');
        }
    }

    function window_mouseout(e) {
        var scrollTop = jQuery(window).scrollTop() + 5;
        var scrollBottom = jQuery(window).scrollTop() + jQuery(window).height() - 5;
        var scrollLeft = jQuery(window).scrollLeft() + 5;
        var scrollRight = scrollLeft + jQuery(window).width() - 5;
        var mX = e.pageX, mY = e.pageY, el = $(window).find('html');

        if((mX <= scrollLeft) || (mY <= scrollTop) || (mY >= scrollBottom))
            show_lightbox();
    }

    function show_lightbox(linkclick) {
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=n" />');

        var siteWordpressUrl = popup_domination_admin_ajax.replace('/wp-admin/admin-ajax.php', '');
        if(!isHidden && !isRefBlock && popup_domination.show_anim !== 'inpost') {
            var provider = '';
            $(document).unbind('focus', show_lightbox);
            $('html,body').unbind('mouseout', window_mouseout);
            show_animation();
            if(popup_domination.center && popup_domination.center === 'Y')
                center_it();
            register_view();
        }
        if(popup_domination.show_anim === 'inpost') {
            if(!check_cookie(popup_domination.popupid, popup_domination.mailingid))
                register_view();
        }
        provider = obj_sel.find('#popup_domination_lightbox_wrapper .provider').val();
        if(popup_domination_new_window === 'yes')
            var new_window_target = "popdom";
        else
            var new_window_target = '';

        $('#popdom_iframe').css('display', 'block');
        obj_sel.find('#popup_domination_lightbox_wrapper .wait').remove(); // set up all forms to use same wait gif placement, after submit button
        obj_sel.find('#popup_domination_lightbox_wrapper input[type=submit]').after('<div class="wait" style="display:none;"><img src="' + siteWordpressUrl + '/wp-content/plugins/popup-domination/css/images/wait.gif" /></div><div class="error" style="display:none;color:red;"></div>');
        if(provider === 'aw') {
            var html = obj_sel.find('#popup_domination_lightbox_wrapper .form div').html();
            if(obj_sel.find('#popup_domination_lightbox_wrapper .form form').html() == null) {
                obj_sel.find('#popup_domination_lightbox_wrapper .form div').html('<form method="post" action="http://www.aweber.com/scripts/addlead.pl" target="' + new_window_target + '">' + html + '</form>');
            } else {
                obj_sel.find('#popup_domination_lightbox_wrapper .form form').remove();
                obj_sel.find('#popup_domination_lightbox_wrapper .form div').html('<form method="post" action="http://www.aweber.com/scripts/addlead.pl" target="' + new_window_target + '">' + html + '</form>');
            }
        }

        // IE placeholder workaround
        if($.browser.msie && $.browser.version < 10) {
            console.log('this is IE');
            window.setTimeout(function() {
                obj_sel.find('#popup_domination_lightbox_wrapper input[type=text]').each(function() {
                    $(this).val($(this).attr('placeholder'));
                    $(this).css('color', 'grey');
                    $(this).focus(function(e) {
                        if($(this).val() === $(this).attr('placeholder')) {
                            $(this).val('');
                            $(this).removeAttr('style');
                            e.preventDefault();
                        }
                    }).blur(function(e) {
                        if($(this).val() === '') {
                            $(this).val($(this).attr("placeholder"));
                            $(this).css('color', 'grey');
                            e.preventDefault();
                        }
                    });
                });
            }, 100);
        }

        if(typeof popdom_preview === 'undefined') {
            if(!linkclick)
                check_all_cookies(true);
            register_all_views();
        }
        return false;
    }

    function show_animation() {
        var animation = {};
        var show_where = popup_domination.show_where;
        if($.browser.msie && $.browser.version < 10) {
            var css = {};
            var anim = {};
            obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css('opacity', 0);
            obj_sel.find('#popup_domination_lightbox_wrapper').show();
            if(popup_domination.show_anim === 'fade') {
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').animate({opacity: 1}, 500, center_it);
            } else if(popup_domination.show_anim === 'slide') {
                if(show_where === 'topleft' || show_where === 'topright') {
                    css.top = -2 * obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                    anim.top = 14;
                }
                else if(show_where === 'bottomleft' || show_where === 'bottomright') {
                    css.bottom = -2 * obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                    anim.bottom = 0;
                }
                else {
                    css.top = 0 - obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerHeight(false);
                    anim.top = ($(window).height() - obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false)) / 2;
                }
                anim.opacity = 1;
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(css, 0);
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').animate(anim, 1500, center_it);
            } else if(popup_domination.show_anim === 'slideUp') {
                if(show_where === 'topleft' || show_where === 'topright') {
                    css.top = $(window).height() + obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                    anim.top = 14;
                }
                else if(show_where === 'bottomleft' || show_where === 'bottomright') {
                    css.top = $(window).height() + obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                    anim.top = $(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                }
                else {
                    css.top = $(window).height() + obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false);
                    anim.top = ($(window).height() - obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false)) / 2;
                }
                anim.opacity = 1;
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(css, 0);
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').animate(anim, 1500, center_it);
            } else if(popup_domination.show_anim === 'slideLeft') { /* Slide TO the left, FROM the right! */
                if(show_where === 'topright' || show_where === 'bottomright') {
                    css.top = 12;
                    css.right = -2 * obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                    anim.right = 10;
                }
                else if(show_where === 'topleft' || show_where === 'bottomleft') {
                    css.top = 12;
                    css.left = $(window).width() + obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                    anim.left = 10;
                }
                else {
                    css.top = 10 + ($(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerHeight(false)) / 2;
                    css.left = $(window).width() + obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                    anim.left = ($(window).width() - obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false)) / 2;
                }
                anim.opacity = 1;
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(css, 0);
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').animate(anim, 1500, center_it);
            } else if(popup_domination.show_anim === 'slideRight') {
                if(show_where === 'topright' || show_where === 'bottomright') {
                    css.top = 12;
                    css.right = -2 * obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                    anim.right = 10;
                }
                else if(show_where === 'topleft' || show_where === 'bottomleft') {
                    css.top = 12;
                    css.left = $(window).width() + obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                    anim.left = 10;
                }
                else {
                    css.top = 10 + ($(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerHeight(false)) / 2;
                    css.left = $(window).width() + obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                    anim.left = ($(window).width() - obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false)) / 2;
                }
                anim.opacity = 1;
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(css, 0);
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').animate(anim, 1500, center_it);
            } else
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css('opacity', 1);
            center_it();
        } else {
            obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css('transition', 'all 0');
            var theTransition = 'all';
            if(popup_domination.show_anim === 'fade') {
                animation.opacity = 0;
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
                theTransition = 'opacity';
            } else if(popup_domination.show_anim === 'slide') {
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
                if(show_where === 'topleft' || show_where === 'topright') {
                    theTransition = 'top';
                    animation.top = -2 * obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                }
                else if(show_where === 'bottomleft' || show_where === 'bottomright') {
                    theTransition = 'bottom';
                    animation.bottom = $(window).height() + obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false);
                }
                else {
                    animation.top = -2 * obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                    theTransition = 'top';
                }
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
            } else if(popup_domination.show_anim === 'slideUp') {
                if(show_where === 'topleft' || show_where === 'topright') {
                    theTransition = 'top';
                    animation.top = $(window).height() + obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false);
                }
                else if(show_where === 'bottomleft' || show_where === 'bottomright') {
                    theTransition = 'bottom';
                    animation.bottom = -2 * obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                }
                else {
                    animation.top = 10 + ($(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false)) / 2;
                    animation.left = ($(window).width() - obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false)) / 2;
                }
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
            } else if(popup_domination.show_anim === 'slideLeft') {
                if(show_where === 'topleft' || show_where === 'bottomleft') {
                    theTransition = 'left';
                    animation.left = $(window).width() + obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false);
                }
                else if(show_where === 'topright' || show_where === 'bottomright') {
                    theTransition = 'right';
                    animation.right = -2 * obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                }
                else {
                    animation.top = 10 + ($(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false)) / 2;
                    animation.left = $(window).width() + obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false);
                    theTransition = 'left';
                }
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
            } else if(popup_domination.show_anim === 'slideRight') {
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
                if(show_where === 'topright' || show_where === 'bottomright') {
                    theTransition = 'right';
                    animation.right = $(window).width() + obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false);
                }
                else if(show_where === 'topleft' || show_where === 'bottomleft') {
                    theTransition = 'left';
                    animation.left = -2 * obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
                }
                else {
                    animation.top = 10 + ($(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false)) / 2;
                    animation.left = 0;
                    theTransition = 'left';
                }
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css(animation);
            } else {
                //catch-all for open immediately or broken/no setting saved.
                obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').css('opacity', 1);
                theTransition = 'none';
            }
            obj_sel.find('#popup_domination_lightbox_wrapper').show();
            center_it(theTransition);
        }
    }

    var firefox_hack = false;
    function center_it(theTransition) {
        if(obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').height() == 0) {
            firefox_hack = true;
            return setTimeout(function(){ if(firefox_hack) {  firefox_hack = false; center_it(theTransition);} }, 100);
        }

        if(popup_domination.show_where == 'topleft') {
            var m_top = 14;
            var m_left = 12;
        }
        else if(popup_domination.show_where == 'topright') {
            var m_top = 14;
            var m_right = 12;
        }
        else if(popup_domination.show_where == 'bottomleft') {
            var m_bottom = 0;
            var m_left = 12;
        }
        else if(popup_domination.show_where == 'bottomright') {
            var m_bottom = 0;
            var m_right = 12;
        }
        else {
            var m_top = 10 + ($(window).height() - obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false)) / 2;
            var m_left = (($(window).width() - obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false)) / 2);
        }

        if($.browser.msie && $.browser.version < 10) {
            transform = 1;
            if($(window).width() <= obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false))
                transform = $(window).width() / obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerWidth(false);
            if($(window).height() <= obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false))
                transform = ($(window).height() / obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false) < transform) ? $(window).height() / (obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-main').outerHeight(false) + 50) : transform;
            var styles = {position: 'fixed', transform: 'scale(' + transform + ')'};
        } else {
            if(typeof theTransition == 'undefined')
                theTransition = 'all';
            scaleNumber = 1;
            if(true || obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-overlay').is(':visible') || obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-overlay').length == 0) {
                if(popup_domination.show_where == 'topleft') {
                    m_top = 0;
                    m_left = 0;
                    var trans_x = '0%';
                    var trans_y = '0%';
                }
                else if(popup_domination.show_where == 'topright') {
                    m_top = 0;
                    m_right = 0;
                    var trans_x = '100%';
                    var trans_y = '0%';
                }
                else if(popup_domination.show_where == 'bottomleft') {
                    m_bottom = 0;
                    m_left = 0;
                    var trans_x = '0%';
                    var trans_y = '100%';
                }
                else if(popup_domination.show_where == 'bottomright') {
                    m_bottom = 0;
                    m_right = 0;
                    var trans_x = '100%';
                    var trans_y = '100%';
                }
                else {
                    var trans_x = 'center';
                    var trans_y = 'center';
                }

                if($(window).width() <= obj_sel.find('#popup_domination_lightbox_wrapper  .lightbox-main').outerWidth(false) + 50)
                    scaleNumber = $(window).width() / (obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerWidth(false) + 50);

                if($(window).height() <= obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false) + 50) {
                    //m_top = 0;
                    scaleNumber = ($(window).height() / (obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false) + 50) < scaleNumber) ? $(window).height() / (obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false) + 50) : scaleNumber;
                }

                var styles = {
                    display: 'block',
                    position: 'fixed',
                    transform: 'scale(' + scaleNumber + ')',
                    transformOrigin: trans_x + ' ' + trans_y + ' 0',
                    opacity: 1,
                    transition: theTransition + ' 1s'
                };
            }
        }

        if(typeof styles != 'undefined') {
            if(typeof m_top != 'undefined')
                styles.top = m_top;
            else
                styles.top = 'initial'
            if(typeof m_left != 'undefined')
                styles.left = m_left;
            else
                styles.left = 'initial'
            if(typeof m_bottom != 'undefined')
                styles.bottom = m_bottom;
            else
                styles.bottom = 'initial'
            if(typeof m_right != 'undefined')
                styles.right = m_right;
            else
                styles.right = 'initial'

            obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').css(styles);
        }
    }

    var pop_width  =  obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerWidth(false);
    var pop_height = obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);

    function init_center() {
        center_it();
        if(!$.browser.msie) {
            $(window).resize(function() {
                center_it('all');
            });
        } else
            $(window).resize(center_it);

        setTimeout(function() {
            if(pop_height != obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false) || pop_width != obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerWidth(false)) {
                pop_width  = obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerWidth(false);
                pop_height = obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-main').outerHeight(false);
                if(!$.browser.msie)
                    center_it('all');
                else
                    center_it();
            }
        }, 300);
    }

    function max_zindex() {
        var maxz = 0;
        $('body *').each(function() {
            var cur = parseInt($(this).css('z-index'));
            maxz = cur > maxz ? cur : maxz;
        });
        obj_sel.find('#popup_domination_lightbox_wrapper ').css('z-index', maxz + 1);
    }

    function hide_box(popupid) {
        var theCampaigns;
        obj_sel.find('.campaignid').each(function() {
            if($(this).val() == popupid) {
                $(this).parents('#popup_domination_lightbox_wrapper , #popdom-inline-container').hide();
                /* TODO: Possible mistake? */
                $('#popdom_iframe').hide();
            }
        });
        if(obj_sel.find('.campaignid').length == 0) {
            //console.log('no mailing list attached');
            obj_sel.find('#popup_domination_lightbox_wrapper , #popdom-inline-container').hide();
            $('#popdom_iframe').hide();
        }
    }

    // closes the popup, if mailingid is set sets cookie for mailing list too
    function close_box(id, mailingid) {
        var elem = obj_sel.find('#popup_domination_lightbox_wrapper , #popdom-inline-container');
        obj_sel.find('.campaignid').each(function() {
            if($(this).val() == id)
                elem = $(this).parents('#popup_domination_lightbox_wrapper , #popdom-inline-container');
        });
        clearTimeout(timer);
        // if this is a preview window don't set the cookie!
        if(typeof popdom_preview == 'undefined') {
            if(popup_domination.cookie_time && popup_domination.cookie_time > 0) {
                var date = new Date();
                date.setTime(date.getTime() + (popup_domination.cookie_time * 86400 * 1000));
            } else {
                var date = new Date();
                date.setTime(date.getTime() + (1 * 86400 * 1000));
            }
            if(id == '0')
                id = 'zero';
            else if(id == '1')
                id = 'one';
            else if(id == '3')
                id = 'three';
            else if(id == '4')
                id = 'four';

            if(popup_domination.show_opt != 'tab' || ($.browser.msie && $.browser.version < 10)) {
                set_cookie('popup_domination_hide_lightbox' + id, 'Y', date);
                stop_video();
            }
            if(check_split_cookie())
                set_cookie('popup_domination_hide_ab' + popup_domination.campaign, 'Y', date);

            if(mailingid != false) {
                //this means we're setting the cookie for the mailing list - someone opted in!
                date = new Date();
                date.setFullYear(date.getFullYear() + 100); // 100 years ought to do it
                set_cookie('popup_domination_hide_mailing' + mailingid, 'Y', date);
            }
        }
        if(popup_domination.show_opt == 'tab' && !$.browser.msie)
            create_tab();
        else
            $('#popdom_iframe').css('display', 'none');
    }

    function create_tab(classname) {
        obj_sel.find('#popup_domination_lightbox_wrapper, .lightbox-main').show();
        obj_sel.find('#popup_domination_lightbox_wrapper').css({height: 0, minHeight: 0});
        obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-overlay').hide();
        var bigWidth = obj_sel.find('#popup_domination_lightbox_wrapper >.lightbox-main').outerWidth(false);
        var shift = 0 - (bigWidth / 15); //bigWidth divided by ten (as we scale to a tenth) and an additional half as much again - this gets it about a third of the width?
        theStyle = {
            position: "fixed",
            left: shift + "px",
            top: popup_domination.tab_height + "px",
            transform: "scale(0.1)",
            transformOrigin: "0 0 0"
        };
        var theOverlay = "<div id='pd_tab_overlay' title='Click to opt in'></div>";
        obj_sel.find('#popup_domination_lightbox_wrapper > .lightbox-main').prepend(theOverlay);
        obj_sel.find('#pd_tab_overlay').css({width: "101%", height: "101%", zIndex: '1', backgroundColor: "transparent", position: 'fixed', cursor: 'pointer', top: "-10px", left: 0, boxShadow: "0 0 2em black , 0 0 2em black inset"});
        obj_sel.find('#popup_domination_lightbox_wrapper > .lightbox-main').css(theStyle);
        obj_sel.find('#pd_tab_overlay').click(function() {
            obj_sel.find('#popup_domination_lightbox_wrapper > .lightbox-main').css({transition: 'all 1s'})
            obj_sel.find('.popup-dom-lightbox-wrapper .lightbox-overlay').show();
            obj_sel.find('#pd_tab_overlay').remove();
            obj_sel.find('#popup_domination_lightbox_wrapper').show();
            provider = obj_sel.find('#popup_domination_lightbox_wrapper .provider').val();
            if(popup_domination_new_window == 'yes')
                var new_window_target = "popdom";
            else
                var new_window_target = '';

            if(obj_sel.find('#popup_domination_lightbox_wrapper .wait').length === 0)
                obj_sel.find('#popup_domination_lightbox_wrapper input[type=submit]').after('<div class="wait" style="display:none;"><img src="//' + document.domain + '/wp-content/plugins/popup-domination/css/images/wait.gif" /></div><div class="error" style="display:none;color:red;"></div>');

            if(obj_sel.find('#popup_domination_lightbox_wrapper .error').length === 0)
                obj_sel.find('#popup_domination_lightbox_wrapper .wait').after('<div class="error" style="display:none;"></div>');

            if(provider === 'aw') {
                var html = obj_sel.find('#popup_domination_lightbox_wrapper .form div').html();
                if(obj_sel.find('#popup_domination_lightbox_wrapper .form form').html() == null) {
                    obj_sel.find('#popup_domination_lightbox_wrapper .form div').html('<form method="post" action="http://www.aweber.com/scripts/addlead.pl" target="' + new_window_target + '">' + html + '</form>');
                } else {
                    obj_sel.find('#popup_domination_lightbox_wrapper .form form').remove();
                    obj_sel.find('#popup_domination_lightbox_wrapper .form div').html('<form method="post" action="http://www.aweber.com/scripts/addlead.pl" target="' + new_window_target + '">' + html + '</form>');
                }
            }
            center_it();
            register_all_views();
        });
        obj_sel.find('#pd_tab_overlay').hover(
                function() {
                    obj_sel.find('#popup_domination_lightbox_wrapper > .lightbox-main').css({left: '-10px', transition: 'all 0.5s'});
                },
                function() {
                    obj_sel.find('#popup_domination_lightbox_wrapper > .lightbox-main').css({left: shift + 'px', transition: 'all 0.5s'});
                }
        );
    }

    function stop_video() {
        //Required for some plugins such as Vimeo
        obj_sel.find('#popup_domination_lightbox_wrapper .lightbox-video').remove();
    }

    function set_cookie(name, value, date) {
        window.document.cookie = [name + '=' + escape(value), 'expires=' + date.toUTCString(), 'path=' + popup_domination.cookie_path].join('; ');
    }

    function check_cookie(id, mailingid) {
        if(id == '0')
            id = 'zero';
        else if(id == '1')
            id = 'one';
        else if(id == '3')
            id = 'three';
        else if(id == '4')
            id = 'four';

        if(get_cookie('popup_domination_hide_lightbox' + id) == 'Y' || get_cookie('popup_domination_hide_mailing' + mailingid) == 'Y') {
            stop_video();
            return true;
        }
        return false;
    }

    function check_all_cookies(close_matches) {
        if(forced === true)
            return;

        var campaigns_on_page = [];
        campaigns_on_page.push(popup_domination.popupid);
        var mailings_on_page = [];
        obj_sel.find('.campaignid').each(function() {
            campaigns_on_page.push($(this).val());
        });
        obj_sel.find('.mailingid').each(function() {
            mailings_on_page.push($(this).val());
        });

        $.unique(campaigns_on_page);
        $.unique(mailings_on_page);
        for(var i = 0; i < campaigns_on_page.length; i++) {
            var cookieExists = check_cookie(campaigns_on_page[i]);
            if(close_matches && cookieExists && location.search.indexOf('popdom=' + campaigns_on_page[i]) === -1) {
                hide_box(campaigns_on_page[i]);
                console.log('campaign cookie match - hiding (' + campaigns_on_page[i] + ")");
            }
        }
        for(var i = 0; i < mailings_on_page.length; i++) {
            var cookieExists = check_cookie(false, mailings_on_page[i]);
            if(close_matches && cookieExists) {
                //this code duplicates the hide_box() code but uses the mailing list ID as the match
                obj_sel.find('.mailingid').each(function() {
                    if($(this).val() == mailings_on_page[i]) {
                        $(this).parents('#popup_domination_lightbox_wrapper , #popdom-inline-container').hide();
                        $('#popdom_iframe').hide();
                    }
                });
                console.log('mailing list cookie match - hiding (' + mailings_on_page[i] + ")");
            }
        }
    }

    function check_split_cookie() {
        return popup_domination.splitcookie;
    }

    function check_impressions() {
        var ic = 1, date = new Date();
        if(ic = get_cookie('popup_domination_icount')) {
            ic = parseInt(ic);
            ic++;
            if(ic == popup_domination.impression_count) {
                date.setTime(date.getTime());
                set_cookie('popup_domination_icount', popup_domination.impression_count, date);
                return false;
            }
        } else {
            ic = 1;
        }
        date.setTime(date.getTime() + (7200 * 1000));
        set_cookie('popup_domination_icount', ic, date);
        return true;
    }

    function get_cookie(cname) {
        var cookie = window.document.cookie;
        if(cookie.length > 0) {
            var c_start = cookie.indexOf(cname + '=');
            if(c_start !== -1) {
                c_start = c_start + cname.length + 1;
                var c_end = cookie.indexOf(';', c_start);
                if(c_end === -1) {
                    c_end = cookie.length;
                }
                return unescape(cookie.substring(c_start, c_end));
            }
        }
        return false;
    }
})(jQuery);