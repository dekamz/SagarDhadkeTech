;
"use strict";
var wtladmin = {
    init: function () {
        $ = jQuery;
        this.advance_post_contents();
        this.on_change_advance_post_contents();
        this.advance_contents_settings();
        this.on_change_advance_contents_settings();
        this.loader_animation();
        this.load_layou_config();
        this.select_template();
        this.hide_field_for_layout();
        this.show_preview();
        // this.reset_layout_to_default();
    },
    current_layout: function () { return $(".wp_timeline_template_name").val() },
    get_shortcut_id: function () {
        var l = $('.wp-timeline-shortcode-div').attr('lid');
        if (l) { return l }
    },
    is_horizontal: function () {
        v = $('input[name="layout_type"]:checked').val();
        if (v == 1) { return true }
    },
    load_layou_config() {
        l = this.current_layout();
        if (l == 'advanced_layout' || l == 'hire_layout' || l == 'curve_layout' || l == 'rounded_layout' || l == 'glossary_layout' || l == 'business_layout' || l == 'timeline_graph_layout' || l == 'boxy_layout' || l == 'wise_layout' || l == 'cover_layout' || l == 'easy_layout' || l == 'filledtimeline_layout') {
            $('.display_layout_type').show();
            $('.wtl-navigation-color').show();
            $('.wtl-navigation-bg-color').show();
            $('.wtl-navigation-arrow-size').show();
            $('.display_year_timeline_side').hide();
        } else {
            $('.display_layout_type').hide();
            $('.wtl-navigation-color').hide();
            $('.wtl-navigation-bg-color').hide();
            $('.wtl-navigation-arrow-size').hide();
        }
    },
    advance_post_contents: function () {
        a = $('.advance_contents_settings');
        b = $('.advance_contents_settings_character');
        c = $("select[name='contents_stopage_from']").val();
        if ($('input[name="advance_contents"]:checked').val() == 1) { a.show(); if (c == 'character') { b.show() } else { b.hide() } } else { a.hide(); if (c == 'character') { b.show() } else { b.hide() } }
    },
    on_change_advance_post_contents: function () {
        $('input[name="advance_contents"]').change(function () {
            wtladmin.advance_post_contents();
        });
    },
    advance_contents_settings: function () {
        a = $(".advance_contents_settings_character");
        if ($("select[name='contents_stopage_from']").val() == 'character' && $("input[name='advance_contents']:checked").val() == 1) { a.show() } else { a.hide() }
    },
    on_change_advance_contents_settings: function () {
        $("select[name='contents_stopage_from']").change(function () { wtladmin.advance_contents_settings() });
    },
    loader_animation: function () {
        var loaders = {
            circularG: '<div class="wtl-circularG-wrapper"><div class="wtl-circularG wtl-circularG_1"></div><div class="wtl-circularG wtl-circularG_2"></div><div class="wtl-circularG wtl-circularG_3"></div><div class="wtl-circularG wtl-circularG_4"></div><div class="wtl-circularG wtl-circularG_5"></div><div class="wtl-circularG wtl-circularG_6"></div><div class="wtl-circularG wtl-circularG_7"></div><div class="wtl-circularG wtl-circularG_8"></div></div>',
            floatingCirclesG: '<div class="wtl-floatingCirclesG"><div class="wtl-f_circleG wtl-frotateG_01"></div><div class="wtl-f_circleG wtl-frotateG_02"></div><div class="wtl-f_circleG wtl-frotateG_03"></div><div class="wtl-f_circleG wtl-frotateG_04"></div><div class="wtl-f_circleG wtl-frotateG_05"></div><div class="wtl-f_circleG wtl-frotateG_06"></div><div class="wtl-frotateG_07 wtl-f_circleG"></div><div class="wtl-frotateG_08 wtl-f_circleG"></div></div>',
            spinloader: '<div class="wtl-spinloader"></div>',
            doublecircle: '<div class="wtl-doublec-container"><ul class="wtl-doublec-flex-container"><li><span class="wtl-doublec-loading"></span></li></ul></div>',
            wBall: '<div class="wtl-windows8"><div class="wtl-wBall wtl-wBall_1"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_2"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_3"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall wtl-wBall_4"><div class="wtl-wInnerBall"></div></div><div class="wtl-wBall_5 wtl-wBall"><div class="wtl-wInnerBall"></div></div></div>',
            cssanim: '<div class="wtl-cssload-aim"></div>',
            thecube: '<div class="wtl-cssload-thecube"><div class="wtl-cssload-cube wtl-cssload-c1"></div><div class="wtl-cssload-cube wtl-cssload-c2"></div><div class="wtl-cssload-cube wtl-cssload-c4"></div><div class="wtl-cssload-cube wtl-cssload-c3"></div></div>',
            ballloader: '<div class="wtl-ballloader"><div class="wtl-loader-inner wtl-ball-grid-pulse"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
            squareloader: '<div class="wtl-squareloader"><div class="wtl-square"></div><div class="wtl-square"></div><div class="wtl-square last"></div><div class="wtl-square clear"></div><div class="wtl-square"></div><div class="wtl-square last"></div><div class="wtl-square clear"></div><div class="wtl-square"></div><div class="wtl-square last"></div></div>',
            loadFacebookG: '<div class="wtl-loadFacebookG"><div class="wtl-blockG_1 wtl-facebook_blockG"></div><div class="wtl-blockG_2 wtl-facebook_blockG"></div><div class="wtl-facebook_blockG wtl-blockG_3"></div></div>',
            floatBarsG: '<div class="wtl-floatBarsG-wrapper"><div class="wtl-floatBarsG_1 wtl-floatBarsG"></div><div class="wtl-floatBarsG_2 wtl-floatBarsG"></div><div class="wtl-floatBarsG_3 wtl-floatBarsG"></div><div class="wtl-floatBarsG_4 wtl-floatBarsG"></div><div class="wtl-floatBarsG_5 wtl-floatBarsG"></div><div class="wtl-floatBarsG_6 wtl-floatBarsG"></div><div class="wtl-floatBarsG_7 wtl-floatBarsG"></div><div class="wtl-floatBarsG_8 wtl-floatBarsG"></div></div>',
            movingBallG: '<div class="wtl-movingBallG-wrapper"><div class="wtl-movingBallLineG"></div><div class="wtl-movingBallG_1 wtl-movingBallG"></div></div>',
            ballsWaveG: '<div class="wtl-ballsWaveG-wrapper"><div class="wtl-ballsWaveG_1 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_2 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_3 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_4 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_5 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_6 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_7 wtl-ballsWaveG"></div><div class="wtl-ballsWaveG_8 wtl-ballsWaveG"></div></div>',
            fountainG: '<div class="fountainG-wrapper"><div class="wtl-fountainG_1 wtl-fountainG"></div><div class="wtl-fountainG_2 wtl-fountainG"></div><div class="wtl-fountainG_3 wtl-fountainG"></div><div class="wtl-fountainG_4 wtl-fountainG"></div><div class="wtl-fountainG_5 wtl-fountainG"></div><div class="wtl-fountainG_6 wtl-fountainG"></div><div class="wtl-fountainG_7 wtl-fountainG"></div><div class="wtl-fountainG_8 wtl-fountainG"></div></div>',
            audio_wave: '<div class="wtl-audio_wave"><span></span><span></span><span></span><span></span><span></span></div>',
            warningGradientBarLineG: '<div class="wtl-warningGradientOuterBarG"><div class="wtl-warningGradientFrontBarG wtl-warningGradientAnimationG"><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div><div class="wtl-warningGradientBarLineG"></div></div></div>',
            floatingBarsG: '<div class="wtl-floatingBarsG"><div class="wtl-rotateG_01 wtl-blockG"></div><div class="wtl-rotateG_02 wtl-blockG"></div><div class="wtl-rotateG_03 wtl-blockG"></div><div class="wtl-rotateG_04 wtl-blockG"></div><div class="wtl-rotateG_05 wtl-blockG"></div><div class="wtl-rotateG_06 wtl-blockG"></div><div class="wtl-rotateG_07 wtl-blockG"></div><div class="wtl-rotateG_08 wtl-blockG"></div></div>',
            rotatecircle: '<div class="wtl-cssload-loader"><div class="wtl-cssload-inner wtl-cssload-one"></div><div class="wtl-cssload-inner wtl-cssload-two"></div><div class="wtl-cssload-inner wtl-cssload-three"></div></div>',
            overlay_loader: '<div class="wtl-overlay-loader"><div class="wtl-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',
            circlewave: '<div class="wtl-circlewave"></div>',
            cssload_ball: '<div class="wtl-cssload-ball"></div>',
            cssheart: '<div class="wtl-cssload-main"><div class="wtl-cssload-heart"><span class="wtl-cssload-heartL"></span><span class="wtl-cssload-heartR"></span><span class="wtl-cssload-square"></span></div><div class="wtl-cssload-shadow"></div></div>',
            spinload: '<div class="wtl-spinload-loading"><i></i><i></i><i></i></div>',
            bigball: '<div class="wtl-bigball-container"><div class="wtl-bigball-loading"><i></i><i></i><i></i></div></div>',
            bubblec: '<div class="wtl-bubble-container"><div class="wtl-bubble-loading"><i></i><i></i></div></div>',
            csball: '<div class="wtl-csball-container"><div class="wtl-csball-loading"><i></i><i></i><i></i><i></i></div></div>',
            ccball: '<div class="wtl-ccball-container"><div class="wtl-ccball-loading"><i></i><i></i></div></div>',
            circulardot: '<div class="wtl-cssload-wrap"><div class="wtl-circulardot-container"><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span><span class="wtl-cssload-dots"></span></div></div>',
        };
        $(".wp_timeline_select_loader").click(function (e) {
            e.preventDefault();
            $(".wp-timeline-loader-popupdiv").dialog({ title: 'Select Loader', dialogClass: 'wp_timeline_template_model', width: $(window).width() - 216, height: $(window).height() - 100, modal: true, draggable: false, resizable: false });
            var $loader_style = $('#loader_style_hidden').val();

            $('.wp-timeline-loader-style-box .wp-timeline-dialog-loader-style').each(function () {
                $(this).removeClass('wp-timeline-active-loader');
                if ($(this).hasClass($loader_style)) {
                    $(this).addClass('wp-timeline-active-loader');
                }
            });
            return false;
        });
        $(".wp-timeline-dialog-loader-style").click(function (e) {
            var loader_val = $(this).children('input.wp-timeline-loader-style-hidden').val();
            $(".loader_style_hidden").val(loader_val);
            $(".loader_hidden").html();
            if (loader_val != 'audio_wave') {
                var loader_val_new = loader_val.replace('-', '_');
            } else {
                var loader_val_new = loader_val;
            }
            $(".loader_hidden").html(loaders[loader_val_new]);
            $("#popuploaderdiv").dialog("close");
        });
        wtladmin.loader_custom();
    },
    loader_custom: function () {
        $("select[name='loader_type']").change(function () {
            if ($(this).val() != 1) {
                $(".default_loader").show();
                $(".upload_loader").hide()
            } else {
                $(".default_loader").hide();
                $(".upload_loader").show()
            }
        });
    },
    setOptionVisibility: function (t) {
        var r = ["soft_block", "fullwidth_layout"];
        var info = ["infographic_layout"];
        var zz = ["zigzag_layout"];
        var ll = ["leafty_layout"];
        var sl = ["sportking_layout"];
        var ft = ["filledtimeline_layout"];
        var ct = ["classictimeline_layout"];
        var mt = ["milestonetimeline_layout"];
        t = $.trim(t);
        s = $('.wtl-back-color-soft-block');
        inf = $('.wtl-arrow-back-color-infographic');
        zigzag = $('.wp_timeline_image_shape_zigzag');
        zigzag1 = $('.wtl-line-color-zigzag');
        pl1 = $('.wtl-repetative-line-color1');
        pl2 = $('.wtl-repetative-line-color2');
        pl3 = $('.wtl-repetative-line-color3');
        pl4 = $('.wtl-repetative-line-color4');
        pl5 = $('.wtl-repetative-line-color5');
        pl_shape = $('.wp_timeline_shape_pl');
        ll_back_color = $('.ad-background-color');
        sl_back_color = $('.ad-background-color');
        ft_nav_back_color1 = $('.wtl-navigation-background-color1');
        ft_nav_back_color2 = $('.wtl-navigation-background-color2');
        ft_nav_back_color3 = $('.wtl-navigation-background-color3');
        ft_icon_bar_color = $('.wtl-default-icon-bar-color');
        ct_icon_content_color = $('.icon-content-bg-color-tr');
        mt_icon_color = $('.wtl-icon-color-milestonetimeline');
        if ($.inArray(t, info) !== -1) {
            inf.show();
        } else {
            inf.hide()
        }
        if ($.inArray(t, zz) !== -1) {
            zigzag.show();
            zigzag1.show();
        } else {
            zigzag.hide();
            zigzag1.hide();
        }

        pl1.hide();
        pl2.hide();
        pl3.hide();
        pl4.hide();
        pl5.hide();
        pl_shape.hide();

        if ($.inArray(t, ll) !== -1) {
            ll_back_color.show();
        } else {
            ll
            ll_back_color.hide()
        }
        if ($.inArray(t, sl) !== -1) {
            sl_back_color.show();
        } else {
            sl
            sl_back_color.hide()
        }
        if ($.inArray(t, ft) !== -1) {
            ft_nav_back_color1.show();
            ft_nav_back_color2.show();
            ft_nav_back_color3.show();
            ft_icon_bar_color.show();
        } else {
            ft_nav_back_color1.hide();
            ft_nav_back_color2.hide();
            ft_nav_back_color3.hide();
            ft_icon_bar_color.hide();
        }
        if ($.inArray(t, ct) !== -1) {
            ct_icon_content_color.show();
            zigzag1.show();
        } else {
            ct_icon_content_color.hide();
            zigzag1.hide();
        }
        if ($.inArray(t, r, info) !== -1) {
            s.show();
            $('.blog-templatecolor-tr').hide()
        } else {
            s.hide()
        }
        if ($.inArray(t, mt) !== -1) {
            mt_icon_color.show();
        } else {
            mt_icon_color.hide();
        }
    },
    select_template: function () {
        $(".wp-timeline-edit-layout .wp_timeline_select_template").click(function (e) {
            e.preventDefault();
            var tmplt = $('.wp_timeline_template_name');
            var template_name = tmplt.val();
            $("#popupdiv").dialog({
                title: wp_timeline_js.choose_blog_template,
                dialogClass: 'wp_timeline_template_model',
                width: $(window).width() - 216,
                height: $(window).height() - 100,
                modal: true,
                draggable: false,
                resizable: false,
                create: function (e, ui) {
                    var pane = $(this).dialog("widget").find(".ui-dialog-buttonpane");
                    var checked = '';
                    if (tmplt.hasClass('wp-timeline-create-shortcode')) {
                        checked = 'checked=checked';
                    }
                    $("<div class='wp-timeline-div-default-style'><label><input id='wp-timeline-apply-default-style' class='wp-timeline-apply-default-style' type='checkbox' " + checked + "/>" + wp_timeline_js.default_style_template + "</label></div>").prependTo(pane);
                },
                buttons: [{
                    text: wp_timeline_js.set_blog_template,
                    id: "btnSetBlogTemplate",
                    click: function () {
                        var template_src = $('#popupdiv div.template-thumbnail.wp_timeline_selected_template .template-thumbnail-inner').children('img').attr('src');
                        if (typeof template_src === 'undefined' || template_src === null) { $("#popupdiv").dialog('close'); return }
                        var template_name = $('#popupdiv div.template-thumbnail.wp_timeline_selected_template .wp-timeline-span-template-name').html();
                        var template_value = $('#popupdiv div.template-thumbnail.wp_timeline_selected_template .template-thumbnail-inner').children('img').attr('data-value');
                        $(".select_button_upper_div .wp_timeline_selected_template_image > div").empty();
                        tmplt.val(template_value);
                        $(".select_button_upper_div .wp_timeline_selected_template_image > div").append('<img src="' + template_src + '" alt="' + template_name + '" /><label id="template_select_name">' + template_name + ' </label>');
                        $("#popupdiv").dialog('close');
                        if ($('#wp-timeline-apply-default-style').is(":checked")) {
                            $("input[name=wp_timeline_color_preset][value=" + tmplt.val() + "_default]").attr('checked', 'checked');
                            lid = $('.wp-timeline-shortcode-div').attr('lid');
                            if (lid) {
                                wtladmin.reset_layout_to_default(); /* Reset field for current layout */

                            } else {
                                wtladmin.reset_layout_when_new();
                            }
                        }
                        wtladmin.horizontalSetting();
                        wtladmin.hide_field_for_layout(); /* Hide Fields for current layout */
                        wtladmin.setOptionVisibility(tmplt.val());
                        wtladmin.disable_link_chk();
                        wtladmin.blog_background_image();
                        dcp = 'div.controls_preset';
                        $(dcp).hide();
                        $(dcp + '.' + tmplt.val()).show();
                        wtladmin.wp_timelineAltBackground();
                        wtladmin.load_layou_config();
                    }
                },
                { text: wp_timeline_js.close, class: 'wp_timeline_template_close', click: function () { $(this).dialog("close") } }
                ],
                open: function (event, ui) {
                    pdt = $('#popupdiv .template-thumbnail');
                    pdt.removeClass('wp_timeline_selected_template');
                    pdt.each(function () {
                        if ($(this).children('.template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                            $(this).addClass('wp_timeline_selected_template');
                        }
                    });
                    $('body.wp-timeline_page_add_wtl_shortcode').css('position', 'relative').css('overflow', 'hidden');
                    $('.wp-timeline-blog-template-search-cover #wp-timeline-template-search').val('');
                    var $template_name = '';
                    wtladmin.blogTemplateSearch($template_name)
                    $('.wp-timeline-blog-template-cover .template-thumbnail').each(function () {
                        var tplbl = $(this).data('value');
                        if (tplbl != '' && tplbl != undefined) {
                            $(this).append('<div class="wp-timeline-label">' + tplbl + '</div>')
                        }
                    });
                },
                close: function (event, ui) {
                    $('body.wp-timeline_page_add_wtl_shortcode').css('position', 'unset').css('overflow', 'visible');
                    $('.wp-timeline-blog-template-search-cover #wp-timeline-template-search').val('');
                }
            });
            return false;
        });
    },
    template_search: function () {
        $('.wp-timeline-blog-template-search-cover #wp-timeline-template-search').keyup(function () {
            var $template_name = $(this).val();
            wtladmin.blogTemplateSearch($template_name);
        });
        $('.wp-timeline-blog-template-search-cover .wp-timeline-template-search-clear').on('click', function () {
            $('.wp-timeline-blog-template-search-cover #wp-timeline-template-search').val('');
            var $template_name = '';
            wtladmin.blogTemplateSearch($template_name);
        });
    },
    controls_preset: function () {
        var c = $('.wp_timeline_template_name').val();
        d = 'div.controls_preset';
        $(d).hide();
        $(d + c).show();
        $('div.color-option.preset').on('click', function () {
            $(this).find('input.of-radio-color').attr('checked', 'checked');
            var v = $(this).data('value');
            if (v) {
                var l = v.split(',');
                $.each(l, function (i) {
                    var sc = l[i].split(':');
                    $('#' + sc[0]).iris('color', sc[1])
                })
            }
        });
    },
    custom_css: function () {
        if ($('#custom_css').length) {
            if (wp_timeline_js.wp_version >= '4.9') {
                var es = wp.codeEditor.defaultSettings ? _.clone(wp.codeEditor.defaultSettings) : {};
                es.codemirror = _.extend({}, es.codemirror, { indentUnit: 2, tabSize: 2, mode: 'css' });
                var editor = wp.codeEditor.initialize($('#custom_css'), es)
            }
        }
    },
    setLayout: function () {
        $("#popupdiv div.template-thumbnail .popup-select a").click(function (e) {
            e.preventDefault();
            $('#popupdiv div.template-thumbnail').removeClass('wp_timeline_selected_template');
            $(this).parents('div.template-thumbnail').addClass('wp_timeline_selected_template');
        });
    },
    onTabClick: function () {
        $('.wp-timeline-form-class .wp-timeline-setting-handle > li').on('click', function (event) {
            if ($(this).hasClass('clickDisable')) {
                wtladmin.clickDisable();
            } else {
                var cl = $(this).data('show');
                $('.wp-timeline-form-class .wp-timeline-setting-handle > li').removeClass('wp-timeline-active-tab');
                $(this).addClass('wp-timeline-active-tab');
                $('.wp-timeline-settings-wrappers .postbox').hide();
                $('#' + cl).show();
                $('#' + cl + ' .inside').show();
                $.post(ajaxurl, { action: 'wtl_closed_boxes', closed: cl, page: $('.wp_timeline_originalpage').val() });
            }
            wtladmin.wp_timelineAltBackground();
        });
    },
    clickDisable: function () {
        $('.clickDisable').on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();
            return false
        });
    },
    applySettings: function () {
        var navarr = '#template_navarrowsizeInput',
            ttfsi = '#template_titlefontsizeInput',
            ttfcsi = '#template_postTitlecountfontsizeInput',
            tptfsi = '#template_postTitlefontsizeInput',
            flfss = '#firstletter_fontsize_slider',
            nflfss = '#post_content_fontsize_slider',
            cfss = '#content_fontsize_slider',
            bltfs = '#beforeloop_titlefontsizeInput',
            pfsi = '#wp_timeline_pricefontsizeInput',
            epfsi = '#wp_timeline_edd_pricefontsizeInput',
            rpfs = '#related_post_fontsize',
            ssfs = '#social_share_fontsize',
            acfss = '#author_content_fontsize_slider',
            ttpmi = '#template_template_post_marginInput',
            tibri = '#template_icon_border_radiousInput',
            acbfsi = '#wp_timeline_addtocart_button_fontsizeInput',
            awbfsi = '#wp_timeline_addtowishlist_button_fontsizeInput',
            stfsi = '#wp_timeline_sale_tagfontsizeInput',
            rmfss = '#readmore_fontsize_slider',
            eacbfs = '#wp_timeline_edd_addtocart_button_fontsizeInput',
            irsv = 'input.range-slider__value';
        $('.slider_controls div').on('click', function () { $(this).find($('input')).attr('checked', 'checked') });
        $(navarr + ',' + ttfsi + ',' + ttfcsi + ',' + tptfsi + ',' + nflfss + ',' + flfss + ',' + cfss + ',' + bltfs + ',' + pfsi + ',' + epfsi + ',' + rpfs + ',' + ssfs + ',' + acfss + ',' + ttpmi + ',' + tibri + ',' + acbfsi + ',' + awbfsi + ',' + stfsi + ',' + rmfss + ',' + eacbfs + ',#wp_timeline_time_period_dayInput').slider({ range: "min", value: 1, step: 1, min: 0, max: 100, slide: function (e, ui) { $(this).parent().find(irsv).val(ui.value) } });
        var pm = $(ttpmi).parent().find(irsv).val(),
            tfsz = $(ttfsi).parent().find(irsv).val(),
            tfscz = $(ttfcsi).parent().find(irsv).val(),
            navarrsize = $(navarr).parent().find(irsv).val(),
            ptfsz = $(tptfsi).parent().find(irsv).val(),
            flfsz = $(flfss).parent().find(irsv).val(),
            nflfsz = $(nflfss).parent().find(irsv).val(),
            cnfsz = $(cfss).parent().find(irsv).val(),
            blfsz = $(bltfs).parent().find(irsv).val(),
            pfsz = $(pfsi).parent().find(irsv).val(),
            epfsz = $(epfsi).parent().find(irsv).val(),
            stgfz = $(stfsi).parent().find(irsv).val(),
            acbfz = $(acbfsi).parent().find(irsv).val(),
            ecbfz = $(eacbfs).parent().find(irsv).val(),
            awlbz = $(awbfsi).parent().find(irsv).val(),
            actsz = $(acfss).parent().find(irsv).val(),
            rpfsz = $(rpfs).parent().find(irsv).val(),
            ssfsz = $(ssfs).parent().find(irsv).val(),
            rmfsz = $(rmfss).parent().find(irsv).val();
            bdpbri = $(tibri).parent().find(irsv).val();
        $(ttpmi).slider("value", pm);
        $(tibri).slider("value", bdpbri);
        $(ttfsi).slider("value", tfsz);
        $(ttfcsi).slider("value", tfscz);
        $(nflfss).slider("value", nflfsz);
        $(navarr).slider("value", navarrsize);
        $(tptfsi).slider("value", ptfsz);
        $(flfss).slider("value", flfsz);
        $(cfss).slider("value", cnfsz);
        $(bltfs).slider("value", blfsz);
        $(pfsi).slider("value", pfsz);
        $(epfsi).slider("value", epfsz);
        $(stfsi).slider("value", stgfz);
        $(acbfsi).slider("value", acbfz);
        $(awbfsi).slider("value", awlbz);
        $(eacbfs).slider("value", ecbfz);
        $(acfss).slider("value", actsz);
        $(rpfs).slider("value", rpfsz);
        $(ssfs).slider("value", ssfsz);
        $(rmfss).slider("value", rmfsz);
        var gin = '#grid_col_spaceInputId';
        $(gin).slider({ range: "min", value: 1, step: 1, min: 0, max: 50, slide: function (event, ui) { $("#grid_col_spaceOutputId").val(ui.value) } });
        var gs = $("#grid_col_spaceOutputId").val();
        $(gin).slider("value", gs);
        $("#grid_col_spaceOutputId").change(function () {
            var vl = this.value;
            var mx = 50;
            if (vl > mx) {
                $(gin).slider("value", '50');
                $(this).val('50')
            } else { $(gin).slider("value", parseInt(vl)) }
        });
        var edlyf = '#edit_layout_form';

        $(edlyf + ' #date_font_family,' +
            edlyf + ' #template_titlefontface,' +
            edlyf + ' #content_font_family,' +
            edlyf + ' #meta_font_family,' +
            edlyf + ' #readmore_font_family,' +
            edlyf + ' #firstletter_font_family,' +
            edlyf + ' #beforeloop_titlefontface,' +
            edlyf + ' #content_font_family,' +
            edlyf + ' #wp_timeline_sale_tagfontface,' +
            edlyf + ' #wp_timeline_pricefontface,' +
            edlyf + ' #wp_timeline_addtocart_button_fontface,' +
            edlyf + ' #wp_timeline_addtowishlist_button_fontface,' +
            edlyf + ' #wp_timeline_edd_pricefontface,' +
            edlyf + ' #wp_timeline_edd_addtocart_button_fontface').change(function () {
                var nm = $(this).attr('name');
                var sd = $(':selected', this);
                var lb = sd.closest('optgroup').attr('label');
                $('#' + nm + '_font_type').val(lb)
            });
        $(".range_slider_days").slider({ range: "min", value: $('.range_slider_days').data('value'), step: 1, min: 0, max: 365, slide: function (event, ui) { $(this).next().find('.range-slider__value_day').val(ui.value) } });
        /** Date picker */
        var btdfm = $('#between_two_date_from'),
            btdto = $('#between_two_date_to'),
            tlhct = $('.title-link-hover-color-tr'),
            inwptl = 'input[name="wp_timeline_post_title_link"]',
            explen = $('.excerpt_length'),
            adcntr = $('.advance_contents_tr'),
            inrmlc = $("input[name='read_more_link']:checked"),
            rmlnk = $('.display_read_more_link'),
            rmtxt = $('.read_more_text'),
            rmtxc = $('.read_more_text_color'),
            rmtxb = $('.read_more_text_background'),
            rmtxh = $('.read_more_text_hover_background'),
            rmtxr = $('.read_more_button_border_radius_setting'),
            rmtxs = $('.read_more_button_border_setting'),
            rmtxg = $('.read_more_text_typography_setting'),
            rmtxo = $("input[name='read_more_on']:checked"),
            pcfrm = $('.post_content_from'),
            pcfrn = $('.display_html_tags_tr'),
            pcfro = $('.display_read_more_on');
            rmwra = $('.read_more_wrap');

        if (btdfm.length >= 1) { btdfm.datepicker({ onSelect: function (date) { btdto.datepicker("option", "minDate", date); } }) };
        if (btdto.length >= 1) { btdto.datepicker({}) }
        /** Show hide option */
        if ($(inwptl + ':checked').val() == 0) { tlhct.hide() } else { tlhct.show() }
        $(inwptl).on('click', function () {
            if ($(inwptl + ':checked').val() == 0) { tlhct.hide() } else { tlhct.show() }
            wtladmin.wp_timelineAltBackground();
        });

        if ($("input[name='rss_use_excerpt']:checked").val() == 1) {
            explen.show();
            adcntr.show();
            if (inrmlc.val() == 1) {

                rmtxt.show();
                rmtxc.show();
                rmtxb.show();
                if (rmtxo.val() == 1) {
                    rmtxb.hide();
                    rmtxh.hide();
                    rmtxr.hide();
                    rmtxs.hide();
                    rmtxg.hide()
                }
            } else {
                rmtxt.hide();
                rmtxc.hide();
                rmtxb.hide();
                rmtxh.hide();
                rmtxr.hide();
                rmtxs.hide();
                $('.read_more_button_alignment_setting').hide()

            };
            pcfrm.show();
            pcfrn.show()
            rmlnk.show();
            pcfro.show();
            rmwra.show();
        } else {
            rmlnk.hide();
            explen.hide();
            adcntr.hide();
            rmtxt.hide();
            rmtxc.hide();
            rmtxb.hide();
            pcfrm.hide();
            pcfrn.hide();
            pcfro.hide();
            rmwra.hide();
        };

        $("input[name='rss_use_excerpt']").change(function () {
            if ($(this).val() == 1) {
                explen.show();
                adcntr.show();
                rmlnk.show();
                if (inrmlc.val() == 1) {
                    rmtxt.show();
                    rmtxc.show();
                    rmtxb.show();
                    if (rmtxo.val() == 1) {
                        rmtxb.hide();
                        rmtxh.hide();
                        rmtxr.hide();
                        rmtxs.hide();
                        rmtxg.hide()
                    } else {
                        rmtxb.show();
                        rmtxh.show();
                        rmtxr.show();
                        rmtxs.show()
                    }
                } else {
                    rmtxt.hide();
                    rmtxc.hide();
                    rmtxb.hide()
                };
                $('.remove_html_tags_tr').show();
                pcfrm.show();
                pcfrn.show();
                pcfro.show();
                rmwra.show();
            } else {
                rmlnk.hide();
                explen.hide();
                adcntr.hide();
                rmtxt.hide();
                rmtxc.hide();
                rmtxb.hide();
                pcfrm.hide();
                pcfrn.hide();
                pcfro.hide();
                rmwra.hide();
                $('.remove_html_tags_tr').hide()
            }
            wtladmin.wp_timelineAltBackground();
        });
        // product settings
        var stpwrp = '.wp_timeline_sale_setting',
            srpwrp = '.wp_timeline_star_rating_setting',
            ppwrp = '.wp_timeline_price_setting',
            acbpwrp = '.wp_timeline_cart_button_setting',
            awbpwrp = '.wp_timeline_wishlist_button_setting';

        $("input[name='display_sale_tag']").change(function () { if ($(this).val() == 1) { $(stpwrp).show() } else { $(stpwrp).hide() } });
        $("input[name='display_product_rating']").change(function () { if ($(this).val() == 1) { $(srpwrp).show() } else { $(srpwrp).hide() } });
        $("input[name='display_product_price']").change(function () { if ($(this).val() == 1) { $(ppwrp).show() } else { $(ppwrp).hide() } });
        $("input[name='display_addtocart_button']").change(function () { if ($(this).val() == 1) { $(acbpwrp).show() } else { $(acbpwrp).hide() } });
        $("input[name='display_addtowishlist_button']").change(function () { if ($(this).val() == 1) { $(awbpwrp).show() } else { $(awbpwrp).hide() } });

        if ($("input[name='display_sale_tag']:checked").val() == 1) { $(stpwrp).show() } else { $(stpwrp).hide() }
        if ($("input[name='display_product_rating']:checked").val() == 1) { $(srpwrp).show() } else { $(srpwrp).hide() }
        if ($("input[name='display_product_price']:checked").val() == 1) { $(ppwrp).show() } else { $(ppwrp).hide() }
        if ($("input[name='display_addtocart_button']:checked").val() == 1) { $(acbpwrp).show() } else { $(acbpwrp).hide() }
        if ($("input[name='display_addtowishlist_button']:checked").val() == 1) { $(awbpwrp).show() } else { $(awbpwrp).hide() }
        //EDD settings
        var wtleps = '.wp_timeline_edd_price_setting';
        var deacb = '.wp_timeline_edd_cart_button_setting';
        if ($("input[name='display_download_price']:checked").val() == 1) { $(wtleps).show() } else { $(wtleps).hide() }
        if ($("input[name='display_edd_addtocart_button']:checked").val() == 1) { $(deacb).show() } else { $(deacb).hide() }

        $("input[name='display_download_price']").change(function () { if ($(this).val() == 1) { $(wtleps).show() } else { $(wtleps).hide() } });
        $("input[name='display_edd_addtocart_button']").change(function () { if ($(this).val() == 1) { $(deacb).show() } else { $(deacb).hide() } });

        /* Read More */
        var clurl = '.custom_link_url';

        var rmwrp = '.read_more_wrap';
        if (inrmlc.val() == 1) { $(rmwrp).show() } else { $(rmwrp).hide() };
        $("input[name='read_more_link']").change(function () {
            if ($(this).val() == 1) {
                $(rmwrp).show();
                $(clurl).hide()
            } else { $(rmwrp).hide() }
            wtladmin.wp_timelineAltBackground()
        });

        if ($("input[name='read_more_link']:checked").val() == 1) {
            $(rmwrp).show()
        } else {
            $(rmwrp).hide()
        }
        if ($("input[name='rss_use_excerpt']:checked").val() == 1) {
            $(rmwrp).show();
        } else {
            $(rmwrp).hide();
        }

        if ($("input[name='post_link_type']:checked").val() == 1 && inrmlc.val() == 1) { $(clurl).show() } else { $(clurl).hide() }
        $("input[name='post_link_type']").change(function () {
            if ($(this).val() == 1) { $(clurl).show() } else { $(clurl).hide() }
            wtladmin.wp_timelineAltBackground();
        });

        /**  Pagination */
        var snpgt = "select[name='pagination_template']",
            pgbwp = '.wp-timeline-pagination-border-wrap',
            pgabw = '.wp-timeline-pagination-active-border-wrap',
            pgbgc = '.wp-timeline-pagination-background-color';
        $(snpgt).change(function () {
            var imgname = $(snpgt).val();
            var imgpath = plugin_path + '/images/pagination/' + imgname + '.png';
            $(".pagination_template_images").attr("src", imgpath);
            wtladmin.wp_timelineAltBackground();
            $('.wp-timeline-pagination-cover.wp-timeline-pagination-background-color').hide();
        });
        $("select[name='filter_template']").change(function () {
            var imgname = $("select[name='filter_template']").val();
            var imgpath = plugin_path + '/images/filter/' + imgname + '.png';
            $(".filter_template_images").attr("src", imgpath);
            wtladmin.wp_timelineAltBackground();
        });
        if ($(snpgt).val() == 'template-4') {
            $(pgbwp).show();
            $(pgabw).show()
        } else if ($(snpgt).val() == 'template-1') {
            $(pgbwp).hide();
            $(pgabw).hide()
        } else if ($(snpgt).val() == 'template-2') {
            $(pgbwp).show();
            $(pgabw).hide();
            $(pgbgc).hide()
        } else if ($(snpgt).val() == 'template-3') {
            $(pgbwp).show();
            $(pgabw).hide()
        } else {
            $(pgbwp).hide();
            $(pgbgc).show()
        }
        $(snpgt).change(function () {
            if ($(this).val() == 'template-4') {
                $(pgbwp).show();
                $(pgabw).show()
            } else if ($(this).val() == 'template-1') {
                $(pgbwp).hide();
                $(pgabw).hide()
            } else if ($(this).val() == 'template-2') {
                $(pgbwp).show();
                $(pgabw).hide()
            } else if ($(this).val() == 'template-3') {
                $(pgbwp).show();
                $(pgabw).hide()
            } else {
                $(pgbwp).hide();
                $(pgabw).hide();
                $('.wp-timeline-pagination-hover-background-color').show();
                $(pgbgc).show()
            }
        });

        $("select[name='load_more_button_template']").change(function () {
            var imgname = $("select[name='load_more_button_template']").val();
            var imgpath = plugin_path + '/images/buttons/' + imgname + '.png';
            $(".load_more_button_template_images").attr("src", imgpath);
            wtladmin.wp_timelineAltBackground();
        });
        /* First Letter Setting show hide*/
        var infbg = 'input[name="firstletter_big"]',
            uwtst = 'ul.wp-timeline-settings',
            fltsg = '.firstletter-setting';
        if ($(infbg + ':checked').val() == 0) { $(infbg).closest(uwtst).find(fltsg).hide() } else { $(infbg).closest(uwtst).find(fltsg).show() };
        $(infbg).on('click', function () {
            if ($(infbg + ':checked').val() == 0) { $(this).closest(uwtst).find(fltsg).hide() } else { $(this).closest(uwtst).find(fltsg).show() };
            wtladmin.wp_timelineAltBackground()
        });
        /* Timeline Icon */
        var hticon = 'input[name="hide_timeline_icon"]';
        var ticon = $('.wtl-post-timeline-icon');
        if ($(hticon + ':checked').val() == 1) { ticon.hide() } else { ticon.show() }
        $(hticon).on('click', function () {
            if ($(hticon + ':checked').val() == 1) { ticon.hide() } else { ticon.show() }
        });
    },
    mediaSettings: function () {
        var md = $('.wtl_mdsfild');
        if ($("input[name='wp_timeline_enable_media']:checked").val() == 1) {
            md.show();
            $('.lazy_load_section_li').show();
            $('.lightbox_section_li').show();
        } else {
            md.hide();
            $('.lazy_load_section_li').hide();
            $('.lightbox_section_li').hide();
            $('.lazy_load_blurred_section_li').hide();
            $('.lazy_load_color_section_li').hide();
        }
        $('input[name="wp_timeline_enable_media"]').on('change', function () {
            if ($("input[name='wp_timeline_enable_media']:checked").val() == 1) {
                md.show();
                $('.lazy_load_section_li').show();
                $('.lightbox_section_li').show();
            } else {
                md.hide();
                $('.lazy_load_section_li').hide();
                $('.lightbox_section_li').hide();
                $('.lazy_load_blurred_section_li').hide();
                $('.lazy_load_color_section_li').hide();
            }
        });
        var bsi = $('.lazy_load_blurred_section_li');
        var lc = $('.lazy_load_color_section_li');
        if ($("input[name='wp_timeline_lazy_load_image']:checked").val() == 1 && $("input[name='wp_timeline_enable_media']:checked").val() == 1) {
            bsi.show();
            lc.show();
        } else {
            bsi.hide();
            lc.hide();
        }
        $('input[name="wp_timeline_lazy_load_image"]').on('change', function () {
            if ($("input[name='wp_timeline_lazy_load_image']:checked").val() == 1 && $("input[name='wp_timeline_enable_media']:checked").val() == 1) {
                bsi.show();
                lc.show();
            } else {
                bsi.hide();
                lc.hide();
            }
        });
    },
    horizontalSetting: function () {
        var md = $('li[data-show="wp_timeline"]');
        var cl = this.current_layout();

        if ($("input[name='layout_type']:checked").val() == 2) {
            md.addClass('clickDisable')
        } else {
            md.removeClass('clickDisable')
        }
        $('input[name="layout_type"]').on('change', function () {
            if ($("input[name='layout_type']:checked").val() == 1) {
                md.removeClass('clickDisable');
                $('.timeline_animation').hide();
                $('li[data-show="wp_timeline_pagination"]').addClass('clickDisable');
                $('#pagination_type option').removeAttr('selected');
                $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
                $('#template_navigation_background_color1').val('#39ACBD');
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
                $('.display_year_timeline_side').hide();
            } else {
                md.addClass('clickDisable')
                $('.timeline_animation').show();
                $('li[data-show="wp_timeline_pagination"]').removeClass('clickDisable');
                $('#template_navigation_background_color1').val('#35C189');
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
                $('.display_year_timeline_side').show();
            }
        });
        if (cl == 'cool_horizontal' || cl == 'overlay_horizontal') {
            md.removeClass('clickDisable');
        }
    },
    socialShare: function () {
        var ss = $('.social_share_options');
        if ($("input[name='social_share']:checked").val() == 1) { ss.show() } else { ss.hide() }
        $('input[name="social_share"]').on('change', function () {
            if ($("input[name='social_share']:checked").val() == 1) {
                ss.show()
                if ($('input[name="social_style"]:checked').val() == 0) {
                    $('.default_icon_layouts').hide();
                    $('.shape_social_icon,.size_social_icon').show();
                } else {
                    $('.default_icon_layouts').show();
                    $('.shape_social_icon,.size_social_icon').hide();
                }
            } else {
                ss.hide()
            }
        });
        if ($("input[name='social_share']:checked").val() == 1) {
            if ($('input[name="social_style"]:checked').val() == 0) {
                $('.default_icon_layouts').hide();
                $('.shape_social_icon,.size_social_icon').show();
            } else {
                $('.default_icon_layouts').show();
                $('.shape_social_icon,.size_social_icon').hide();
            }
        } else {
            $('.social_share_options').hide();
        }
        $('input[name="social_style"]').on('change', function () {
            if ($('input[name="social_style"]:checked').val() == 0) {
                $('.default_icon_layouts').hide();
                $('.shape_social_icon,.size_social_icon').show();
            } else {
                $('.default_icon_layouts').show();
                $('.shape_social_icon,.size_social_icon').hide();
            }
        });
    },
    uploadImage: function () {
        $(document).on('click', '.wp-timeline-upload_image_button', function (e) {
            e.preventDefault();
            var frame, elm = $(this);
            var prid = elm.closest('div');
            if (frame) { frame.open(); return };
            frame = wp.media({ title: elm.data('choose'), button: { text: elm.data('update'), close: false }, multiple: false, library: { type: 'image' } });
            frame.on('select', function () {
                var attachment = frame.state().get('selection').first();
                frame.close(attachment);
                prid.find('span.wp_timeline_default_image_holder').empty().hide().append('<img src="' + attachment.attributes.url + '">').slideDown('fast');
                var bgimg = 'wp_timeline_bg_image';
                if (elm.hasClass(bgimg)) {
                    prid.find('#' + bgimg + '_id').val(attachment.attributes.id);
                    prid.find('#' + bgimg + '_src').val(attachment.attributes.url)
                } else {
                    prid.find('#wp_timeline_default_image_id').val(attachment.attributes.id);
                    prid.find('#wp_timeline_default_image_src').val(attachment.attributes.url)
                };
                elm.removeClass('wp-timeline-upload_image_button');
                elm.addClass('wp-timeline-remove_image_button');
                elm.val('');
                elm.val('Remove Image')
            });
            frame.open()
        });
        $(document).on('click', '.wp-timeline-remove_image_button', function (event) {
            event.preventDefault();
            var elm = $(this);
            if (elm.hasClass("wp_timeline_bg_image")) {
                $('.wp_timeline_bg_image.wp_timeline_default_image_holder > img').slideDown().remove();
                $('#wp_timeline_bg_image_id').val('');
                $('#wp_timeline_bg_image_src').val('');
                elm.addClass('wp-timeline-upload_image_button');
                elm.removeClass('wp-timeline-remove_image_button');
                elm.val('');
                elm.val('Upload Image')
            } else {
                $('.wp_timeline_default_image_holder > img').slideDown().remove();
                $('#wp_timeline_default_image_id').val('');
                $('#wp_timeline_default_image_src').val('');
                elm.addClass('wp-timeline-upload_image_button');
                elm.removeClass('wp-timeline-remove_image_button');
                elm.val('');
                elm.val('Upload Image')
            }
        });
        $(document).on('click', '.wp-timeline-loader_upload_image_button', function (event) {
            event.preventDefault();
            var frame;
            var elm = $(this);
            var prid = elm.closest('li');
            if (frame) { frame.open(); return };
            frame = wp.media({ title: elm.data('choose'), button: { text: elm.data('update') }, multiple: false, library: { type: 'image' } });
            frame.on('select', function () {
                var attachment = frame.state().get('selection').first();
                frame.close(attachment);
                prid.find('span.wp_timeline_loader_image_holder').empty().hide().append('<img src="' + attachment.attributes.url + '">').slideDown('fast');
                console.error(attachment.attributes.id);
                console.error(attachment.attributes.url);
                prid.find('#wp_timeline_loader_image_id').val(attachment.attributes.id);
                prid.find('#wp_timeline_loader_image_src').val(attachment.attributes.url);
                elm.removeClass('wp-timeline-loader_upload_image_button');
                elm.addClass('wp-timeline-remove_upload_image_button');
                elm.val('');
                elm.val('Remove Image');
            });
            frame.open()
        });
        $(document).on('click', '.wp-timeline-remove_upload_image_button', function (event) {
            event.preventDefault();
            var elm = $(this);
            $('.wp_timeline_loader_image_holder > img').slideDown().remove();
            $('#wp_timeline_loader_image_id').val('');
            $('#wp_timeline_loader_image_src').val('');
            elm.addClass('wp-timeline-loader_upload_image_button');
            elm.removeClass('wp-timeline-remove_upload_image_button');
            elm.val('');
            elm.val('Upload Image')
        });

        var ihetr = $('.wp-timeline-image-hover-effect-tr');
        ihetr.hide();
        if ($("input[name='wp_timeline_enable_media']:checked").val() == 1 && $("input[name='wp_timeline_image_hover_effect']:checked").val() == 1) {
            ihetr.show()
        } else {
            ihetr.hide()
        };
        $("input[name='wp_timeline_image_hover_effect']").change(function () {
            if ($(this).val() == 1) { ihetr.show() } else { ihetr.hide() }
            wtladmin.wp_timelineAltBackground();
        });
        var mcstr = $('.wp_timeline_media_custom_size_tr');
        mcstr.hide();
        if ($('#wp_timeline_media_size').val() == 'custom') {
            mcstr.show();
        } else {
            mcstr.hide();
        }
        $('#wp_timeline_media_size').on('change', function () {
            if ($(this).val() == 'custom') { mcstr.show() } else { mcstr.hide() }
            wtladmin.wp_timelineAltBackground();
        });
    },
    sortFilterPageination: function () {
        var bttdt = $('.wp_timeline_between_two_date'),
            tpdays = $('.wp_timeline_time_period_days'),
            btprid = $('#blog_time_period'),
            snboby = $("select[name='wp_timeline_blog_order_by']"),
            sobyfr = $('.wp_timeline_sort_by_front'),
            adftop = $('.advance_filter_option');
        bttdt.hide();
        tpdays.hide();
        if (btprid.val() == 'between_two_date') { bttdt.show() };
        if (btprid.val() == 'last_n_days' || btprid.val() == 'next_n_days') { tpdays.show() } else { tpdays.hide() };
        btprid.change(function () { if ($(this).val() == 'between_two_date') { bttdt.show() } else { bttdt.hide() } if ($(this).val() == 'last_n_days' || $(this).val() == 'next_n_days') { tpdays.show() } else { tpdays.hide() } });
        snboby.next('div.blg_order').show();
        if (snboby.val() == '' || snboby.val() == 'rand') {
            $('.wtl_blog_order_by .blg_order').hide();
        }
        snboby.change(function () {
            if ($(this).val() == '' || $(this).val() == 'rand') {
                $('div.blg_order').hide()
            } else {
                $('div.blg_order').show()
            }
            wtladmin.wp_timelineAltBackground();
        });

        sobyfr.hide();
        if ($("input[name='wp_timeline_display_sort_by']:checked").val() == 1) { sobyfr.show(); }
        $("input[name='wp_timeline_display_sort_by']").change(function () { sobyfr.hide(); if ($(this).val() == 1) { sobyfr.show() } });
        $("input[name='advance_filter']").change(function () {
            if ($(this).val() == 1) { adftop.show() } else { adftop.hide() };
            wtladmin.wp_timelineAltBackground();
        });
        if ($("select[name='custom_post_type']").val() == 'post') { if ($("input[name='advance_filter']:checked").val() == 1) { adftop.show() } else { adftop.hide() } } else {
            adftop.hide();
            ///$('.advance_filter_settings').hide()
        };
        if ($("input[name='display_filter']:checked").val() == 1) {
            $('.wp-timeline-setting-handle li').each(function () {
                var hide = $(this).attr('data-show');
                if (hide == 'wp_timeline_pagination') {
                    $(this).addClass('clickDisable');
                }
            });
            $('.wp_timeline_posts_per_page').hide();
            $('.wp_timeline_pagination_type').hide();
            $('.wp_template_pagination_template').hide();

        } else {
            $('.wp-timeline-setting-handle li').each(function () {
                var hide = $(this).attr('data-show');
                if (hide == 'wp_timeline_pagination') {
                    $(this).removeClass('clickDisable');
                }
            });
            $('.wp_timeline_posts_per_page').show();
            $('.wp_timeline_pagination_type').show();
            $('.wp_template_pagination_template').show();
        }

        if ($('#pagination_type').val() == 'no_pagination') {
            $('.wp-timeline-setting-handle li').each(function () {
                var hide = $(this).attr('data-show');
                if (hide == 'wp_timeline_customreadmore') {
                    $(this).removeClass('clickDisable');
                }
            });
        }
        wtladmin.paginationTypeSelection();

        $("select[name='pagination_type']").change(function () {
            if ($(this).val() == 'paged') {
                $(".wp_template_pagination_template").show();
                $('.loadmore_btn_option').hide();
            } else {
                $(".wp_template_pagination_template").hide();
            }
            if ($(this).val() == 'load_more_btn' || $(this).val() == 'load_onscroll_btn') {
                $(".wp_template_loader_template").show();
                if ($(this).val() == 'load_more_btn') {
                    $('.loadmore_btn_option').show();
                } else {
                    $('.loadmore_btn_option').hide();
                }
                if ($("select[name='loader_type']").val() != 1) {
                    $(".default_loader").show();
                    $(".upload_loader").hide();
                } else if ($(this).val() == 'load_more_btn' || $(this).val() == 'load_onscroll_btn') {
                    $(".default_loader").hide();
                    $(".upload_loader").show();
                    wtladmin.wp_timelineAltBackground();
                }
                wtladmin.wp_timelineAltBackground();
            } else {
                $(".wp_template_loader_template").hide();
            }
            wtladmin.wp_timelineAltBackground();
        });

    },
    selectPostType: function () {
        if ($("select[name='custom_post_type']").val() == 'product') {
            $('.wp-timeline-setting-handle li').each(function () {
                var hide = $(this).attr('data-show');
                if (hide == 'wp_timeline_productsetting') { $(this).removeClass('clickDisable') }
                if (hide == 'wp_timeline_eddsetting') { $(this).addClass('clickDisable') }
                $('.wtl-post-category,.wtl-post-tag-settings').hide();
            });
        } else if ($("select[name='custom_post_type']").val() == 'download') {
            $(".wp-timeline-post-sticky").hide();
            $('.wp-timeline-setting-handle li').each(function () {
                var hide = $(this).attr('data-show');
                if (hide == 'wp_timeline_eddsetting') {
                    $(this).removeClass('clickDisable');
                }
                if (hide == 'wp_timeline_productsetting') {
                    $(this).addClass('clickDisable');
                }
            });
        } else {
            if ($("select[name='custom_post_type']").val() == 'post') {
                $('.wp-timeline-setting-handle li').each(function () {
                    var hide = $(this).attr('data-show');
                    if (hide == 'wp_timeline_productsetting') {
                        $(this).addClass('clickDisable');
                    }
                    if (hide == 'wp_timeline_eddsetting') {
                        $(this).addClass('clickDisable');
                    }
                });
            } else {
                $(".wtl-post-category").hide();
                $(".post-tag").hide();
                ///$(".advance_filter_settings").hide();
                $('.advance_filter_option').hide();
                $("#advance_filter_0").prop("checked", true);
                $("#advance_filter_1").prop("checked", false);
                $('.wp-timeline-setting-handle li').each(function () {
                    var hide = $(this).attr('data-show');
                    if (hide == 'wp_timeline_productsetting') {
                        $(this).addClass('clickDisable');
                    }
                    if (hide == 'wp_timeline_eddsetting') {
                        $(this).addClass('clickDisable');
                    }
                });

            }
        }
        $("select[name='custom_post_type']").change(function () {
            var posttypeval = $(this).val();
            if (posttypeval == 'product') {
                $('.wp-timeline-setting-handle li').each(function () {
                    var hide = $(this).attr('data-show');
                    if (hide == 'wp_timeline_productsetting') {
                        $(this).removeClass('clickDisable');
                    }
                    if (hide == 'wp_timeline_eddsetting') {
                        $(this).addClass('clickDisable');
                    }
                });
            } else if (posttypeval == 'download') {
                $(".wp-timeline-post-sticky").hide();
                $('.wp-timeline-setting-handle li').each(function () {
                    var hide = $(this).attr('data-show');
                    if (hide == 'wp_timeline_eddsetting') {
                        $(this).removeClass('clickDisable');
                    }
                    if (hide == 'wp_timeline_productsetting') {
                        $(this).addClass('clickDisable');
                    }
                });
            } else {
                $('.wp-timeline-setting-handle li').each(function () {
                    var hide = $(this).attr('data-show');
                    if (hide == 'wp_timeline_productsetting') {
                        $(this).addClass('clickDisable');
                    }
                    if (hide == 'wp_timeline_eddsetting') {
                        $(this).addClass('clickDisable');
                    }
                });
            }
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: { action: 'wtl_get_acf_field_list', posttype: posttypeval, nonce: wp_timeline_js.ajax_nonce, },
                success: function (response) {
                    $('.wp_timeline_setting_acf_field_blog').html('');
                    $('.wp_timeline_setting_acf_field_blog').html(response);
                    $(".chosen-select").chosen();
                }
            });
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: { action: 'wtl_get_posts', custom_post_type: posttypeval, nonce: wp_timeline_js.ajax_nonce, },
                success: function (response) {
                    $('.wp_timeline_post_li').html(response);
                    $(".chosen-select").chosen();
                }
            });
            $("#wp_timeline_general .wp-timeline-display-settings .display-custom-taxonomy").remove();
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: { action: 'wtl_custom_post_taxonomy_display_settings', posttype: posttypeval, nonce: wp_timeline_js.ajax_nonce, },
                success: function (response) {
                    var gndist = '#wp_timeline_general .wp-timeline-display-settings';
                    $(gndist + " .display-custom-taxonomy").remove();
                    $(gndist + ' .wp-timeline-typography-wrapper').prepend(response);
                    if (response == "") {
                        $(gndist + " .display-custom-taxonomy").remove();
                    }
                    $('.buttonset').buttonset();
                }
            });
            if (posttypeval == 'post') {
                $(".wtl-post-category").show();
                $(".post-tag").show();
                $(".advance_filter_settings").show();
                if ($("input[name='advance_filter']:checked").val() == 1) {
                    $('.advance_filter_option').show();
                } else {
                    $('.advance_filter_option').hide();
                }
                $(".wp-timeline-post-terms").remove();
            } else {
                $(".wtl-post-category").hide();
                $(".post-tag").hide();
                ///$(".advance_filter_settings").hide();
                $('.advance_filter_option').hide();
                $("#advance_filter_0").prop("checked", true);
                $("#advance_filter_1").prop("checked", false);
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: { action: 'wtl_get_custom_taxonomy_terms', posttype: posttypeval, nonce: wp_timeline_js.ajax_nonce, },
                    success: function (response) {
                        $('.wp-timeline-post-authors-list').before(response);
                        $("#wp_timeline_filter .wp-timeline-settings .wp-timeline-post-terms select").each(function () {
                            if ($(this).parent('.select-cover').length == 0) {
                                $(this).wrap("<div class='select-cover'></div>");
                                $('.select-cover select').chosen();
                                $('.select-cover select').trigger("chosen:updated");
                            }
                        });
                        wtladmin.wp_timelineAltBackground();
                    }
                });
            }
            if ($('.wp_timeline_template_name').val() == 'cool_horizontal' || $('.wp_timeline_template_name').val() == 'overlay_horizontal') {
                var posttypeval = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: { action: 'wtl_get_timeline_post_list', posttype: posttypeval, nonce: wp_timeline_js.ajax_nonce, },
                    success: function (response) {
                        $('.active_post_list').html('');
                        $('.active_post_list').html(response);
                        $(".wp-timeline-settings-wrappers .wp-timeline-settings select:not(.chosen-select)").wrap("<div class='select-cover'></div>");
                        $(".select-cover select").chosen();
                        $('.select-cover select').trigger("chosen:updated");
                        wtladmin.wp_timelineAltBackground();
                    }
                });
            }
            wtladmin.wp_timelineAltBackground();
        });
    },
    paginationTypeSelection: function () {
        if ($("select[name='pagination_type']").val() == 'paged') {
            $(".wp_template_pagination_template").show();
            $('.loadmore_btn_option').hide();

        } else {
            $(".wp_template_pagination_template").hide();
            $('.loadmore_btn_option').hide();
            $(".default_loader").hide();
            $(".upload_loader").hide();
            $(".wp_template_loader_template").hide();
        }
        if ($("select[name='pagination_type']").val() == 'load_more_btn' || $("select[name='pagination_type']").val() == 'load_onscroll_btn') {
            $(".wp_template_loader_template").show();
            if ($("select[name='pagination_type']").val() == 'load_more_btn') {
                $('.loadmore_btn_option').show();
            } else {
                $('.loadmore_btn_option').hide();
            }
            if ($("select[name='loader_type']").val() != 1) {
                $(".default_loader").show();
                $(".upload_loader").hide();
            } else if ($("select[name='pagination_type']").val() == 'load_more_btn' || $("select[name='pagination_type']").val() == 'load_onscroll_btn') {
                $(".default_loader").hide();
                $(".upload_loader").show();
            }
        } else {
            $(".wp_template_loader_template").hide();
        }
    },
    disable_link_chk: function () {
        var tycnt = 'div.wp-timeline-typography-content',
            indcat = "input[name='display_category']",
            indtag = "input[name='display_tag']",
            indaut = "input[name='display_author']",
            indcct = "input[name='display_comment_count']";

        // Categories link option
        if ($(indcat + ":checked").val() == 1) { $(indcat).closest(tycnt).find('.disable_link').show() } else { $(indcat).closest(tycnt).find('.disable_link').hide() }
        $(indcat).on('change', function () {
            if ($(indcat + ":checked").val() == 1) { $(indcat).closest(tycnt).find('.disable_link').show() } else { $(indcat).closest(tycnt).find('.disable_link').hide() }
        });

        // Tags link option
        if ($("input[name='display_tag']:checked").val() == 1) { $("input[name='display_tag']").closest(tycnt).find('.disable_link').show() } else { $("input[name='display_tag']").closest(tycnt).find('.disable_link').hide() }

        $(indtag).on('change', function () {
            if ($(indtag + ":checked").val() == 1) { $(indtag).closest(tycnt).find('.disable_link').show() } else { $(indtag).closest(tycnt).find('.disable_link').hide() }
        });
        // Author link option
        if ($("input[name='display_author']:checked").val() == 1) { $("input[name='display_author']").closest(tycnt).find('.disable_link').show() } else { $("input[name='display_author']").closest(tycnt).find('.disable_link').hide() }

        $(indaut).on('change', function () {
            if ($(indaut + ":checked").val() == 1) { $(indaut).closest(tycnt).find('.disable_link').show() } else { $(indaut).closest(tycnt).find('.disable_link').hide() }
        });


        if ($("#custom_post_type").val() == 'product' || $("#custom_post_type").val() == 'download') {
            $("input[name='display_author']").closest(tycnt).find('.disable_link').hide();
        }
        // Publish Date link option
        if ($("input[name='display_date']:checked").val() == 1) {
            $("input[name='display_date']").closest(tycnt).find('.disable_link').show();
        } else {
            $("input[name='display_date']").closest(tycnt).find('.disable_link').hide();
        }
        // Comment Form link option
        if ($("input[name='display_comment_count']:checked").val() == 1 || $("input[name='display_comment']:checked").val() == 1) {
            $("input[name='display_comment_count']").closest(tycnt).find('.disable_link').show();
            $("input[name='display_comment']").closest(tycnt).find('.disable_link').show();
        } else {
            $("input[name='display_comment_count']").closest(tycnt).find('.disable_link').hide();
            $("input[name='display_comment']").closest(tycnt).find('.disable_link').hide();
        }
        $(indcct).on('change', function () {
            if ($(indcct + ":checked").val() == 1) { $(indcct).closest(tycnt).find('.disable_link').show() } else { $(indcct).closest(tycnt).find('.disable_link').hide() }
        });
        // Taxonomy Set
        $("fieldset.taxonomies_set input").each(function () {
            var name = $(this).attr("name");
            if ($("input[name='" + name + "']:checked").val() == 1) {
                $(this).closest(tycnt).find('.disable_link').show();
            } else {
                $(this).closest(tycnt).find('.disable_link').hide();
            }
        });
        $("fieldset.wp-timeline-display_tax input").each(function () {
            var name = $(this).attr("name");
            if ($("input[name='" + name + "']:checked").val() == 1) {
                $(this).closest(tycnt).find('.disable_link').show();
            } else {
                $(this).closest(tycnt).find('.disable_link').hide();
            }
        });
    },
    wp_timelineAltBackground: function () {
        /*Alternet background color set*/
        $('.postbox').each(function () {
            var li = 'ul.wp-timeline-settings > li';
            $(this).find(li).removeClass('wp-timeline-gray');
            $(this).find(li + ':visible:odd').addClass('wp-timeline-gray')
        });
    },
    blogTemplateSearch: function (tmpnm) {
        var tpnm = $('.wp_timeline_template_name').val()
        var altmphide = true;
        if (tmpnm.length < 3) { tmpnm = '' };
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: { action: 'wtl_template_search_result', temlate_name: tmpnm, nonce: wp_timeline_js.ajax_nonce, },
            success: function (response) {
                $('.wp-timeline-blog-template-cover').html(response);
                $('.template-thumbnail').show();
                $('.template-thumbnail').each(function () {
                    if ($(this).is(':visible')) {
                        altmphide = false;
                    }
                });
                if (altmphide) {
                    $('.no-template').show();
                } else {
                    $('.no-template').hide();
                }
                $("#popupdiv div.template-thumbnail .popup-select a").click(function (e) {
                    e.preventDefault();
                    $('#popupdiv div.template-thumbnail').removeClass('wp_timeline_selected_template');
                    $(this).parents('div.template-thumbnail').addClass('wp_timeline_selected_template');
                });
                $('#popupdiv .template-thumbnail').removeClass('wp_timeline_selected_template');
                $('#popupdiv .template-thumbnail').each(function () {
                    if ($(this).children('.template-thumbnail-inner').children('img').attr('data-value') == tpnm) {
                        $(this).addClass('wp_timeline_selected_template');
                    }
                });
                $('.wp-timeline-blog-template-cover .template-thumbnail').each(function () {
                    var templateLable = $(this).data('value');
                    if (templateLable != '' && templateLable != undefined) {
                        $(this).append('<div class="wp-timeline-label">' + templateLable + '</div>')
                    }
                });
            }
        });
    },
    reset_layout_to_default: function () {
        page_display = $('#wtl_page_display').val()
        layout = this.current_layout();
        lid = $('.wp-timeline-shortcode-div').attr('lid');
        $.ajax({
            type: 'POST',
            dataType: 'text',
            crossDomain: true,
            cache: false,
            url: ajaxurl,
            data: { 'action': 'wtl_do_rest_layout_ajax', layout: layout, page_display: page_display, lid: lid, nonce: wp_timeline_js.ajax_nonce, },
            success: function (data) {
                wtl_settings = JSON.parse(data);
                wtladmin.do_reset(wtl_settings);
                if ($('#wp-timeline-apply-default-style').is(":checked")) {
                    //location.reload();
                }
            }
        });

        if (this.current_layout() == 'advanced_layout') {
            $('#content_box_bg_color').val('#f1f1f1');
            $('#wp_timeline_content_border_radius').val('5');
            $('#template_contentcolor').val('#333');
            $('#content_fontsize').val('16');
            $("#display_date_1").attr('checked', 'checked');
            $('#template_icon_border_radious').val(50);
            $('#template_color').val('#000');
            $('#timeline_line_width').val('4');

            $('#template_titlecolor').val('#fff');
            $('#template_titlehovercolor').val('#f1f1f1');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('20');
            $('#template_contentcolor').val('#000000');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');

        }
        if (this.current_layout() == 'verticalblur_layout') {
            $('#content_box_bg_color').val('#f1f1f1');
            $('#wp_timeline_content_border_radius').val('5');
            $('#template_contentcolor').val('#333');
            $('#content_fontsize').val('16');
            $("#display_date_1").attr('checked', 'checked');
            $('#template_icon_border_radious').val(50);
            $('#template_color').val('#000');

            $('#template_titlecolor').val('#fff');
            $('#template_titlehovercolor').val('#f1f1f1');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('20');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');

        }
        if (this.current_layout() == 'hire_layout') {
            $('#timeline_heading_1').val('New hire timeline');
            $('#timeline_heading_2').val('Your first day');

            $("#display_category_1").attr('checked', 'checked');
            $("#display_tag_1").attr('checked', 'checked');
            $("#display_author_1").attr('checked', 'checked');
            $("#display_date_1").attr('checked', 'checked');

            //Standard Settings

            $('#template_bgcolor').val('#fff');
            $('#template_ftcolor').val('#2e3e4b');
            $('#template_fthovercolor').val('#acb7c0');

            $('#meta_fontsize,#content_fontsize').val('18');
            //Post Title
            $('#template_titlecolor').val('#2e3e4b');
            $('#template_titlehovercolor').val('#2e3e4b');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('24');

            $("#template_title_alignment_center").attr('checked', 'checked');
            $('#template_title_font_text_transform option[value="uppercase"]').attr('selected', 'selected');
            $('#template_title_font_weight option[value="700"]').attr('selected', 'selected');

            //Post Content
            $('#template_contentcolor').val('#57616b');
            $('#content_box_bg_color').val('#fff');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Georgia, serif"]').attr('selected', 'selected');
            //Timeline
            $('#template_color').val('#313d4b');
            $('#navigation_color').val('#313d4b');
            $('#navigation_bg_color').val('#313d4b');
            $('#navigation_arrow_size').val('24');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'cool_horizontal' || this.current_layout() == 'overlay_horizontal') {
            $('#template_titlecolor').val('#f16c20');
            $('#template_titlehovercolor').val('#303030');
        }

        if (this.current_layout() == 'curve_layout') {
            $("#display_category_1").attr('checked', 'checked');
            $("#display_tag_1").attr('checked', 'checked');
            $("#display_author_1").attr('checked', 'checked');
            //Standard Settings
            $('#template_bgcolor').val('#fff');
            $('#template_ftcolor').val('#338754');
            $('#template_fthovercolor').val('#338754');
            //Post Title
            $('#template_titlecolor').val('#2d3033');
            $('#template_titlehovercolor').val('#2d3033');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('22');
            $('#template_titlefontface option[value="Georgia, serif"]').attr('selected', 'selected');
            $('#template_title_font_weight option[value="600"]').attr('selected', 'selected');

            // Content box
            $('#content_box_bg_color').val('');
            $('#template_contentcolor').val('#2d3033');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Georgia, serif"]').attr('selected', 'selected');

            //Timeline
            $('#template_color').val('#2d3033');
            $('#navigation_color').val('#000000');
            $('#navigation_arrow_size').val('24');
            $('#template_color2').val('#2d3033');
            $('#template_color3').val('#338754');
            $('#template_color4').val('#338754');
            $('#template_color5').val('#2d3033');
            //social
            $("#social_share_1").attr('checked', 'checked');
            $("#default_icon_theme_9").attr('checked', 'checked');
            $('#facebook_link_with_count').prop('checked', true);
            $('#pinterest_link_with_count').prop('checked', true);
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'year_layout') {
            $("#display_date_1").attr('checked', 'checked');
            $('#template_color').val('#4557bb');
            //ss
            $('#template_bgcolor').val('');
            $('#template_ftcolor').val('');
            $('#template_fthovercolor').val('#acb7c0');
            //Post Title
            $('#template_titlecolor').val('#333333');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('18');
            $('#template_titlefontface option[value="Georgia, serif"]').attr('selected', 'selected');
            //Post Content
            $('#template_contentcolor').val('#333');
            $('#content_box_bg_color').val('#fff');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Georgia, serif"]').attr('selected', 'selected');
            //box
            $('#wp_timeline_content_border_radius').val('3');
            $('#wp_timeline_top_content_box_shadow').val('1');
            $('#wp_timeline_right_content_box_shadow').val('1');
            $('#wp_timeline_bottom_content_box_shadow').val('4');
            $('#wp_timeline_left_content_box_shadow').val('1');
            $('#wp_timeline_content_box_shadow_color').val('#bfbfbf');
            //media
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked", true);
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'fullwidth_layout') {
            $('#timeline_heading_1').val('7 Things to Do');
            $('#timeline_heading_2').val("Before A New Hires First Day");

            //Post Title
            $('#template_titlecolor').val('#fff');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_center").attr('checked', 'checked');
            $('#template_titlefontsize').val('24');
            $('#template_titlefontface option[value="Georgia, serif"]').attr('selected', 'selected');
            //Content
            $('#template_contentcolor').val('#fff');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('20');
            $('#content_font_family option[value="Georgia, serif"]').attr('selected', 'selected');
            //box
            $('#content_box_bg_color').val('');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'easy_layout' || this.current_layout() == 'attract_layout' || this.current_layout() == 'divide_layout' || this.current_layout() == 'topdivide_layout' || this.current_layout() == 'cover_layout' || this.current_layout() == 'rounded_layout') {
            //Post Title
            $('#template_titlecolor').val('#000');
            $('#template_titlehovercolor').val('#23be63');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('18');
            $('#template_titlefontface option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            //Post Content
            $('#template_contentcolor').val('#000');
            $('#template_categorybgcolor').val('#8c98a3');
            $('#template_categorytextcolor').val('#ffffff');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            //media
            $("#wp_timeline_enable_media_0").prop("checked", true);
            $("#wp_timeline_enable_media_1").prop("checked", false);
            //box
            $('#wp_timeline_content_border_radius').val('3');
            $('#wp_timeline_top_content_box_shadow').val('1');
            $('#wp_timeline_right_content_box_shadow').val('1');
            $('#wp_timeline_bottom_content_box_shadow').val('4');
            $('#wp_timeline_left_content_box_shadow').val('1');
            $('#wp_timeline_content_box_shadow_color').val('#bfbfbf');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'fullhorizontal_layout') {
            //Post Title
            $('#template_titlecolor').val('#000');
            $('#template_titlehovercolor').val('#23be63');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('18');
            $('#template_titlefontface option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            $('#layout_type_1').attr('checked', 'checked');
            //Post Content
            $('#template_contentcolor').val('#000');
            $('#template_categorybgcolor').val('#8c98a3');
            $('#template_categorytextcolor').val('#ffffff');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            //media
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked", true);
            //box
            $('#wp_timeline_content_border_radius').val('3');
            $('#wp_timeline_top_content_box_shadow').val('1');
            $('#wp_timeline_right_content_box_shadow').val('1');
            $('#wp_timeline_bottom_content_box_shadow').val('4');
            $('#wp_timeline_left_content_box_shadow').val('1');
            $('#wp_timeline_content_box_shadow_color').val('#bfbfbf');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'fullvertical_layout') {
            //Post Title
            $('#template_titlecolor').val('#000');
            $('#template_titlehovercolor').val('#23be63');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('18');
            $('#template_titlefontface option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            $('#layout_type_1').attr('checked', 'checked');
            //Post Content
            $('#template_contentcolor').val('#000');
            $('#template_categorybgcolor').val('#8c98a3');
            $('#template_categorytextcolor').val('#ffffff');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            //media
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked", true);
            //box
            $('#wp_timeline_content_border_radius').val('3');
            $('#wp_timeline_top_content_box_shadow').val('1');
            $('#wp_timeline_right_content_box_shadow').val('1');
            $('#wp_timeline_bottom_content_box_shadow').val('4');
            $('#wp_timeline_left_content_box_shadow').val('1');
            $('#wp_timeline_content_box_shadow_color').val('#bfbfbf');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'attract_layout') {
            //Timeline
            $('#navigation_color').val('#000000');
            $('#navigation_bg_color').val('#535758');
            $('#navigation_arrow_size').val('20');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#layout_type_1').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'processinfo_layout') {
            //General Setting
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');;
            $('#display_date_0').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            //Standard Settings
            $("#layout_type_1").attr('checked', 'checked');
            $("#template_bgcolor").val('#F0CF80');
            $("#template_bgcolor1").val('#4fbfc1');
            $("#template_bgcolor2").val('#508FC4');
            $("#template_bgcolor3").val('#F47882');
            $("#template_bgcolor4").val('#F0CF80');
            $("#template_ftcolor").val('#222222');
            $("#template_fthovercolor").val('#FFFFFF');
            $('#template_categorybgcolor').val('#FFFFFF');
            $('#meta_fontsize').val('14');
            $('#meta_font_italic_0').attr('checked', 'checked');
            //Timeline
            $('#navigation_color').val('#000000');
            $('#navigation_bg_color').val('#535758');
            $('#navigation_arrow_size').val('20');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#layout_type_2').attr('checked', 'checked');
            //Post Title
            $('#template_ftcolor').val('#000');
            $('#wp_timeline_post_title_link_1').attr('checked', 'checked');
            $('#template_title_alignment_left').attr('checked', 'checked');
            $('#template_titlecolor').val('#FFF');
            $('#template_titlehovercolor').val('#FFF');
            $('#template_titlebackcolor').val('');
            $('#template_titlefontsize').val('32');
            $('#template_title_count_color').val('#FFF');
            $('#template_title_count_fontsize').val('32');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            $('#template_title_font_text_transform option[value="uppercase"]').attr('selected', 'selected');
            $('#template_titlefontface option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            //Post Content
            $('#rss_use_excerpt_1').attr('checked', 'checked');
            $('#txtExcerptlength').val('15');
            $('#template_contentcolor').val('#666');
            $('#content_fontsize').val('14');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#content_font_family option[value="Arial, Helvetica, sans-serif"]').attr('selected', 'selected');
            //media
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked",true);
            //box
            $('#wp_timeline_content_border_radius').val('0');   
            $('#wp_timeline_top_content_box_shadow').val('0');
            $('#wp_timeline_right_content_box_shadow').val('0');
            $('#wp_timeline_bottom_content_box_shadow').val('0');
            $('#wp_timeline_left_content_box_shadow').val('0');
            $('#wp_timeline_content_box_shadow_color').val('#bfbfbf');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            //Social setting
            $('#social_share_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'rounded_layout') {
            //Timeline
            $('#navigation_color').val('#000000');
            $('#navigation_bg_color').val('#FFFFFF');
            $('#navigation_arrow_size').val('20');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#content_box_bg_color').val('#FFFFFF');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'fullhorizontal_layout') {
            //Timeline
            $('#navigation_color').val('#FFFFFF');
            $('#navigation_bg_color').val('#000000');
            $('#navigation_arrow_size').val('30');

            $('#wp_timeline_sale_tagtext_alignment').val('center');
            $('#wp_timeline_star_rating_alignment').val('center');
            $('#wp_timeline_pricetext_alignment').val('center');
            $('#wp_timeline_cart_wishlistbutton_alignment').val('center');
            $('#wp_timeline_addtocartbutton_alignment').val('center');
            $('#wp_timeline_wishlistbutton_alignment').val('center');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $("#layout_type_1").attr('checked', 'checked');
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked", true);

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'infographic_layout') {
            $('#timeline_heading_1').val('Infographic Layout');

            //Standard Settings
            $('#template_bgcolor').val('#fff');
            $('#template_ftcolor').val('#000');
            $('#template_arrow_back_color').val('#fa932a');
            $('#template_fthovercolor').val('#7f7f7f');
            //Post Title
            $('#template_titlecolor').val('#fff');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_left").attr('checked', 'checked');
            $('#template_titlefontsize').val('22');
            $('#template_titlefontface option[value="Roboto Condensed, sans-serif"]').attr('selected', 'selected');
            //Content
            $('#template_contentcolor').val('#000');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Roboto Condensed, sans-serif"]').attr('selected', 'selected');
            //box
            $('#content_box_bg_color').val('');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout()) {
            //Standard Settings
            $('#template_bgcolor').val('#112C30');
            $('#template_ftcolor').val('#FFFFFF');
            $('#template_fthovercolor').val('#FFFFFF');
            $('#meta_font_family_font_type option[value="Roboto"]').attr('selected', 'selected');
            $('#meta_fontsize').val('22');
            //Timeline
            $('#template_repetative_line_color1').val('#9AA92A');
            $('#template_repetative_line_color2').val('#35a3be');
            $('#template_repetative_line_color3').val('#913fe2');
            $('#template_repetative_line_color4').val('#29a823');
            $('#template_repetative_line_color5').val('#dd3333');
            $('#wp-timeline-preview-box .wtl-post-category').val('');
            $('#wp-timeline-preview-box .wp-timeline-custom-tag a').val('');
            $('#navigation_color').val('#FFFFFF');
            $('#navigation_bg_color').val('#535758');
            $('#navigation_arrow_size').val('24');
            $('#wp_timeline_shape option[value="round"]').attr('selected', 'selected');
            $('.wtl_single_display_timeline_icon option[value="fontawesome"]').attr('selected', 'selected');
            $('#layout_type_2').attr('checked', 'checked');
            //Post Title
            $('#template_titlecolor').val('#000');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_center").attr('checked', 'checked');
            $('#template_titlefontsize').val('24');
            $('#template_titlefontface option[value="Roboto"]').attr('selected', 'selected');
            //Content
            $('#template_contentcolor').val('#000');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Roboto"]').attr('selected', 'selected');
            //box
            $('#content_box_bg_color').val('');
            //horizontal settings
            $('#noof_slide').val('4');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');
            $('#template_category').val('');
            $('#label_featured_post').val('');
            $('#blog_time_period').val('all');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');

            

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'fullvertical_layout') {
            //Timeline
            $('#layout_type_1').attr('checked', 'checked');
            $('#layout_type_1').click();
        }
        if (this.current_layout() == 'leafty_layout') {
            //Timeline
            $('#layout_type_1').attr('checked', 'checked');
            $('#layout_type_1').click();
        }
        if (this.current_layout() == 'accordion') {
            $('#wp_timeline_pricetextcolor').val('#fff');
            $('#wp_timeline_star_rating_color').val('#fff');
            $('#template_titlecolor').val('#fff');
            $('#template_contentcolor').val('#fff');
        }
        if (this.current_layout() == 'wise_layout') {
            //Timeline
            $('#navigation_color').val('#000000');
            $('#navigation_bg_color').val('#FFFFFF');
            $('#navigation_arrow_size').val('24');
        }
        if (this.current_layout() == 'columy_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_1').attr('checked', 'checked');
            $('#display_author_1').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_1').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_1').attr('checked', 'checked');
            $('#display_product_tag_1').attr('checked', 'checked');
            $('#layout_type_1').attr('checked', 'checked');
            //Standard Settings
            $('#template_bgcolor').val('#abcb88');
            $('#template_ftcolor').val('#FFFFFF');
            $('#template_fthovercolor').val('#23527c');
            $('#meta_font_family option[value="Lato, sans-serif"]').attr('selected', 'selected');
            $('#meta_fontsize').val('24');
            $('#meta_font_italic_0').attr('checked', 'checked');
            //Timeline
            $('#navigation_color').val('#000000');
            $('#navigation_bg_color').val('#FFFFFF');
            $('#navigation_arrow_size').val('30');
            //Post Title
            $('#template_color').val('#bfbfbf');
            $('#template_titlecolor').val('#fff');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            jQuery("#template_title_alignment_center").prop("checked", true);
            jQuery("#template_title_alignment_left").prop("checked", false);
            jQuery("#template_title_alignment_right").prop("checked", false);
            $('#template_titlefontsize').val('24');
            $('#template_titlefontface option[value="Lato, sans-serif"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked');
            //Content
            $('#template_contentcolor').val('#FFFFFF');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('18');
            $('#content_font_family option[value="Lato, sans-serif"]').attr('selected', 'selected');
            $('#content_font_italic_0').attr('checked', 'checked');
            //box
            $('#content_box_bg_color').val('');
            //horizontal settings
            $('#noof_slide').val('4');
            //Filter
            $('#post_date_format option[value="(d M Y)"]').attr('selected', 'selected');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            //Social Share
            $('#social_share_1').attr('checked', 'checked');
            $('#social_style_0').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'leafty_layout') {
            //General
            $('#display_category_1').attr('checked', 'checked');
            $('#display_tag_1').attr('checked', 'checked');
            $('#display_author_1').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_1').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_1').attr('checked', 'checked');
            $('#display_product_tag_1').attr('checked', 'checked');
            $("#layout_type_1").attr('checked', 'checked');
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked", true);
            $('#timeline_animation').val('none');
            //Standard Settings
            $('#template_ftcolor').val('#c87f76');
            $('#template_fthovercolor').val('#23527c');
            $('#meta_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#meta_fontsize').val('18');
            $('#meta_font_italic_0').attr('checked', 'checked');
            //Timeline
            $('#ad_background_color').val('#c87f76');
            $('#navigation_color').val('#FFFFFF');
            $('#navigation_bg_color').val('#c87f76');
            $('#navigation_arrow_size').val('24')
            //Post Title
            $('#template_titlecolor').val('#000');
            $('#template_titlehovercolor').val('#23527c');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_left").attr('checked', 'checked');
            $('#template_titlefontsize').val('30');
            $('#template_titlefontface option[value="Roboto"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            //Content
            $('#template_contentcolor').val('#000000');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('16');
            $('#content_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#read_more_link_1').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
            $('#post_link_type_0').attr('checked', 'checked');
            $('#readmore_button_alignment_left').attr('checked', 'checked');
            $('#template_readmorecolor').val('#337ab7');
            $('#template_readmorehovercolor').val('#23527c');
            $('#readmore_button_paddingleft').val('0');
            $('#readmore_button_paddingright').val('0');
            $('#readmore_button_paddingtop').val('0');
            $('#readmore_button_paddingbottom').val('0');
            $('#readmore_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#readmore_fontsize_slider').val('16');
            $('#readmore_font_italic_0').attr('checked', 'checked');
            //box
            $('#content_box_bg_color').val('');
            //horizontal settings
            $('#noof_slide').val('4');
            //Filter
            $('#post_date_format option[value="(d M Y)"]').attr('selected', 'selected');
            $('#wp_timeline_pricetextcolor').val('#000');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtext_alignment option[value="right-top"]').attr('selected', 'selected');
            //Social Share
            $('#social_share_1').attr('checked', 'checked');
            $('#social_style_0').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#FFF');
            $('#wp_timeline_star_rating_bg_color').val('#FFF');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'sportking_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_0').attr('checked', 'checked');
            $('#display_product_tag_0').attr('checked', 'checked');
            $("#layout_type_1").attr('checked', 'checked');
            //Standard Settings
            $('#template_ftcolor').val('#c87f76');
            $('#template_fthovercolor').val('#23527c');
            $('#meta_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#meta_fontsize').val('18');
            $('#meta_font_italic_0').attr('checked', 'checked');
            //Timeline
            $('#ad_background_color').val('#c87f76');
            $('#navigation_color').val('#FFFFFF');
            $('#navigation_bg_color').val('#c87f76');
            $('#navigation_arrow_size').val('24')
            //Post Title
            $('#template_titlecolor').val('#000');
            $('#template_titlehovercolor').val('#23527c');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_left").attr('checked', 'checked');
            $('#template_titlefontsize').val('12');
            $('#template_titlefontface option[value="Roboto"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            //Content
            $('#template_contentcolor').val('#000000');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('16');
            $('#content_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#read_more_link_0').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
            $('#post_link_type_0').attr('checked', 'checked');
            $('#readmore_button_alignment_left').attr('checked', 'checked');
            $('#template_readmorecolor').val('#337ab7');
            $('#template_readmorehovercolor').val('#23527c');
            $('#readmore_button_paddingleft').val('0');
            $('#readmore_button_paddingright').val('0');
            $('#readmore_button_paddingtop').val('0');
            $('#readmore_button_paddingbottom').val('0');
            $('#readmore_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#readmore_fontsize_slider').val('16');
            $('#readmore_font_italic_0').attr('checked', 'checked');
            //box
            $('#content_box_bg_color').val('');
            //horizontal settings
            $('#noof_slide').val('4');
            //Filter
            $('#post_date_format option[value="(d M Y)"]').attr('selected', 'selected');
            $('#wp_timeline_pricetextcolor').val('#000');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtext_alignment option[value="right-top"]').attr('selected', 'selected');
            //Social Share
            $('#social_share_0').attr('checked', 'checked');
            $('#social_style_0').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }

        if (this.current_layout() == 'filledtimeline_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_0').attr('checked', 'checked');
            $('#display_product_tag_0').attr('checked', 'checked');
            //Standard Settings
            $('#template_bgcolor').val('#112c30');
            $('#template_ftcolor').val('#FFFFFF');
            $('#template_fthovercolor').val('#FFFFFF');
            $('#meta_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#meta_fontsize').val('16');
            $('#meta_font_italic_0').attr('checked', 'checked');
            $('#meta_font_line_height').val('2.5');
            //Timeline
            if (wtl_settings['layout_type'] == '1') {
                $('#template_navigation_background_color1').val('#39ACBD');
            } else {
                $('#template_navigation_background_color1').val('#35C189');
            }
            $('#template_navigation_background_color2').val('#E9E566');
            $('#template_navigation_background_color3').val('#FFFFFF');
            $('#default_icon_bar_color').val('#1e4f56');
            $('#navigation_color').val('#000000');
            $('#navigation_bg_color').val('#FFFFFF');
            $('#navigation_arrow_size').val('24');
            $('#layout_type_2').attr('checked', 'checked');
            //Post Title
            $('#template_titlecolor').val('#FFFFFF');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_left").attr('checked', 'checked');
            $('#template_titlefontsize').val('24');
            $('#template_titlefontface option[value="Roboto"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            //Content
            $('#template_contentcolor').val('#FFFFFF');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('16');
            $('#content_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#content_font_line_height').val('2');
            $('#read_more_link_1').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
            $('#post_link_type_0').attr('checked', 'checked');
            $('#readmore_button_alignment_left').attr('checked', 'checked');
            $('#template_readmorecolor').val('#000000');
            $('#template_readmorehovercolor').val('#2376ad');
            $('#readmore_button_paddingleft').val('0');
            $('#readmore_button_paddingright').val('0');
            $('#readmore_button_paddingtop').val('0');
            $('#readmore_button_paddingbottom').val('0');
            $('#readmore_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#readmore_fontsize_slider').val('16');
            $('#readmore_font_italic_0').attr('checked', 'checked');
            $('#readmore_font_line_height').val('3.5');
            //box
            $('#content_box_bg_color').val('');
            //horizontal settings
            $('#noof_slide').val('3');
            $('#noof_slider_nav_itme').val('3');
            //Filter
            $('#post_date_format option[value="(F j, Y)"]').attr('selected', 'selected');
            $('#wp_timeline_pricetextcolor').val('#000');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            //Social Share
            $('#social_share_1').attr('checked', 'checked');
            $('#social_style_0').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'classictimeline_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_0').attr('checked', 'checked');
            $('#display_product_tag_0').attr('checked', 'checked');
            //Standard Settings
            $('#template_bgcolor').val('#ffffff');
            $('#template_ftcolor').val('#000000');
            $('#template_fthovercolor').val('#000000');
            $('#icon_content_bg_color').val('#00bcd4');
            $('#meta_font_family option[value="Roboto Condensed, sans-serif"]').attr('selected', 'selected');
            $('#meta_fontsize').val('16');
            $('#meta_font_italic_0').attr('checked', 'checked');
            $('#meta_font_line_height').val('1.5');
            //Timeline
            $('#template_color').val('#FFFFFF');
            $('#template_line_color').val('#d6d6d6');
            $('#layout_type_2').attr('checked', 'checked');
            //Post Title
            $('#template_titlecolor').val('#000000');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_left").attr('checked', 'checked');
            $('#template_titlefontsize').val('24');
            $('#template_title_font_weight option[value="bold"]').attr('selected', 'selected');
            $('#template_title_font_line_height').val('1.5');
            $('#template_titlefontface option[value="Roboto Condensed, sans-serif"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            //Content
            $('#template_contentcolor').val('#000000');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('16');
            $('#content_font_family option[value="Roboto Condensed, sans-serif"]').attr('selected', 'selected');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#content_font_line_height').val('1.4');
            $('#read_more_link_1').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
            $('#txtReadmoretext').val('Continue Reading');
            $('#post_link_type_0').attr('checked', 'checked');
            $('#readmore_button_alignment_left').attr('checked', 'checked');
            $('#template_readmorecolor').val('#000000');
            $('#template_readmorehovercolor').val('#2376ad');
            $('#readmore_button_paddingleft').val('0');
            $('#readmore_button_paddingright').val('0');
            $('#readmore_button_paddingtop').val('0');
            $('#readmore_button_paddingbottom').val('0');
            $('#readmore_font_family option[value="Roboto Condensed, sans-serif"]').attr('selected', 'selected');
            $('#readmore_fontsize_slider').val('16');
            $('#readmore_font_italic_0').attr('checked', 'checked');
            $('#readmore_font_line_height').val('1.5');
            $('#template_readmorebackcolor').val('#e0f0ed');
            $('#wp_timeline_readmore_button_borderleft').val('2');
            $('#wp_timeline_readmore_button_borderleftcolor').val('#2b2b2b');
            $('#wp_timeline_readmore_button_borderright').val('2');
            $('#wp_timeline_readmore_button_borderrightcolor').val('#2b2b2b');
            $('#wp_timeline_readmore_button_bordertop').val('2');
            $('#wp_timeline_readmore_button_bordertopcolor').val('#2b2b2b');
            $('#wp_timeline_readmore_button_borderbottom').val('2');
            $('#wp_timeline_readmore_button_borderbottomcolor').val('#2b2b2b');
            $('#readmore_button_paddingleft').val('5');
            $('#readmore_button_paddingright').val('5');
            $('#readmore_button_paddingtop').val('5');
            $('#readmore_button_paddingbottom').val('5');
            $('#readmore_font_weight option[value="600"]').attr('selected', 'selected');
            $('#readmore_font_text_transform option[value="uppercase"]').attr('selected', 'selected');
            //box
            $('#content_box_bg_color').val('');
            //Media
            jQuery("#wp_timeline_enable_media_0").prop("checked", false);
            jQuery("#wp_timeline_enable_media_1").prop("checked", true);
            //Filter
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_pricetextcolor').val('#000');
             $('#display_date_from option[value="publish"]').attr('selected', 'selected');
             $('#post_date_format option[value="default"]').attr('selected', 'selected');
             $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
             $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            //Social Share
            $('#social_share_0').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'topdivide_layout') {
            $('#noof_slide').val('1');
            $("#layout_type_1").attr('checked', 'checked')
        }
        if (this.current_layout() == 'milestonetimeline_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_0').attr('checked', 'checked');
            $('#display_product_tag_0').attr('checked', 'checked');
            //Standard Settings
            $('#template_bgcolor').val('#ffffff');
            $('#template_ftcolor').val('#000000');
            $('#template_fthovercolor').val('#000000');
            $('#template_icon_color').val('#FFFFFF');
            $('#meta_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#meta_fontsize').val('18');
            $('#meta_font_italic_0').attr('checked', 'checked');
            $('#meta_font_line_height').val('1.5');
            //Timeline
            $('#template_color').val('#0087BF');
            $('#wtl_single_display_timeline_icon option[value="fontawesome"]').attr('selected', 'selected');
            //Post Title
            $('#template_titlecolor').val('#000000');
            $('#template_titlehovercolor').val('');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_center").attr('checked', 'checked');
            $('#template_titlefontsize').val('24');
            $('#template_title_font_weight option[value="bold"]').attr('selected', 'selected');
            $('#template_title_font_line_height').val('1.5');
            $('#template_titlefontface option[value="Roboto"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            //Content
            $('#template_contentcolor').val('#000000');
            $('#content_box_bg_color').val('');
            $('#meta_fontsize,#content_fontsize').val('16');
            $('#content_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#content_font_line_height').val('1.4');
            $('#read_more_link_0').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
            $('#txtReadmoretext').val('Read More');
            $('#post_link_type_0').attr('checked', 'checked');
            $('#readmore_button_alignment_center').attr('checked', 'checked');
            $('#template_readmorecolor').val('#000000');
            $('#template_readmorehovercolor').val('#000000');
            $('#template_readmorebackcolor').val('#0087BF');
            $('#readmore_button_paddingleft').val('10');
            $('#readmore_button_paddingright').val('10');
            $('#readmore_button_paddingtop').val('10');
            $('#readmore_button_paddingbottom').val('10');
            $('#readmore_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#readmore_fontsize_slider').val('16');
            $('#readmore_font_italic_0').attr('checked', 'checked');
            $('#readmore_font_line_height').val('1.5');
            //box
            $('#content_box_bg_color').val('');
            //Media
            jQuery("#wp_timeline_enable_media_0").prop("checked", true);
            jQuery("#wp_timeline_enable_media_1").prop("checked", false);
            //Filter
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_pricetextcolor').val('#000');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            //Horizontal Slider
            $('#enable_autoslide_0').prop("checked", true);
            $('#enable_autoslide_1').prop("checked", false);
            $('#scroll_speed').val('1000');
            $('#noof_slide').val('4');
            //Social Share
            $('#social_share_0').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'glossary_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');
            $('#display_date_0').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_0').attr('checked', 'checked');
            $('#display_product_tag_0').attr('checked', 'checked');
            //Content
            $('#read_more_link_1').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
             //Filter
             $('#post_date_format option[value="(d M Y)"]').attr('selected', 'selected');
             $('#wp_timeline_pricetextcolor').val('#000');
             $('#wp_timeline_sale_tagtext_alignment option[value="right-top"]').attr('selected', 'selected');
             $('#display_date_from option[value="publish"]').attr('selected', 'selected');
             $('#post_date_format option[value="default"]').attr('selected', 'selected');
             $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
             $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            //Social Share
            $('#social_share_1').attr('checked', 'checked');
            $('#social_style_1').attr('checked', 'checked');
            $('#social_icon_style_1').attr('checked', 'checked');
            $('#social_icon_size_0').attr('checked', 'checked');
            $('#default_icon_theme_1').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#pinterest_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'business_layout') {
            //General
            $('#display_category_0').attr('checked', 'checked');
            $('#display_tag_0').attr('checked', 'checked');
            $('#display_author_0').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            //Standard Settings
            $('#template_bgcolor').val('#f0f0f0');
            $('#template_bgcolor1').val('#369fbc');
            $('#template_bgcolor2').val('#2d8aab');
            $('#template_bgcolor3').val('#00537b');
            $('#template_bgcolor4').val('#022f4e');
            $('#template_ftcolor').val('#2d8aab');
            $('#template_fthovercolor').val('#00537b');
            $('#meta_font_family option[value="Roboto"]').attr('selected', 'selected');
            $('#meta_fontsize').val('14');
            $('#meta_font_italic_0').attr('checked', 'checked');
            $('#meta_font_line_height').val('1.5');
            //Post Title
            $('#wp_timeline_post_title_link_0').attr('checked', 'checked');
            $('#template_titlecolor').val('#333333');
            $('#template_titlehovercolor').val('#333333');
            $('#template_titlebackcolor').val('');
            $("#template_title_alignment_center").attr('checked', 'checked');
            $("#template_title_font_italic_0").attr('checked', 'checked');
            $('#template_titlefontsize').val('20');
            $('#template_title_font_weight option[value="600"]').attr('selected', 'selected');
            $('#template_title_font_line_height').val('1.5');
            $('#template_titlefontface option[value="Roboto"]').attr('selected', 'selected');
            $('#template_title_font_italic_0').attr('checked', 'checked');
            //Content
            $('#read_more_link_1').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
            $('rss_use_excerpt_1').attr('checked', 'checked');
            $('#template_post_content_from option[value="from_content"]').attr('selected', 'selected');
            $('#display_popup_0').attr('checked', 'checked');
            $('#content_fontsize').val('14');
            $('#content_font_italic_0').attr('checked', 'checked');
            $('#readmore_button_alignment_center').attr('checked', 'checked');
            $('#template_readmorecolor').val('#000');
            $('#template_readmorehovercolor').val('#fff');
            $('#template_readmorebackcolor').val('#56a0a1');
            $('#template_readmore_hover_backcolor').val('#1a7b8b');
            $('#readmore_button_border_radius').val('5');
            $('#readmore_button_hover_border_radius').val('5');
            $('#readmore_button_paddingleft').val('11');
            $('#readmore_button_paddingright').val('11');
            $('#readmore_button_paddingtop').val('6');
            $('#readmore_button_paddingbottom').val('6');
            $('#readmore_fontsize').val('14');
            $('#readmore_font_italic_0').attr('checked', 'checked');
            //Media Setting
            $('#wp_timeline_enable_media_1').attr('checked', 'checked');
            $('#wp_timeline_post_image_link_1').attr('checked', 'checked');
            //Filter
            $('#post_date_format option[value="(d M Y)"]').attr('selected', 'selected');
            $('#wp_timeline_pricetextcolor').val('#000');
            $('#display_date_from option[value="publish"]').attr('selected', 'selected');
            $('#post_date_format option[value="default"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
            $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtext_alignment option[value="right-top"]').attr('selected', 'selected');
            //Social Share
            $('#social_share_0').attr('checked', 'checked');
            $('#social_style_1').attr('checked', 'checked');
            $('#social_icon_style_1').attr('checked', 'checked');
            $('#social_icon_size_0').attr('checked', 'checked');
            $('#default_icon_theme_1').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#pinterest_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');
            $('#template_category_border_color').val('#02a6af');
            $('#template_category_dots_bg_color').val('#02a6af');
            $('#template_category_dots_line_color').val('#02a6af');
            $('#template_category_dots_wave_color').val('#90e6e3');
            $('#template_metacolor').val('#02a6af');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'timeline_graph_layout') {
            //General
            $('#display_category_1').attr('checked', 'checked');
            $('#display_tag_1').attr('checked', 'checked');
            $('#display_author_1').attr('checked', 'checked');
            $('#display_date_1').attr('checked', 'checked');
            $('#display_comment_count_0').attr('checked', 'checked');
            $('#display_postlike_0').attr('checked', 'checked');
            $('#display_demo-tag_1').attr('checked', 'checked');
            $('#display_product_tag_1').attr('checked', 'checked');
            //Content
            $('#read_more_link_1').attr('checked', 'checked');
            $('#read_more_on_2').attr('checked', 'checked');
             //Filter
             $('#post_date_format option[value="(d M Y)"]').attr('selected', 'selected');
             $('#wp_timeline_pricetextcolor').val('#000');
             $('#display_date_from option[value="publish"]').attr('selected', 'selected');
             $('#post_date_format option[value="default"]').attr('selected', 'selected');
             $('#wp_timeline_blog_order_by option[value="rand"]').attr('selected', 'selected');
             $('#wp_timeline_blog_order_asc').attr('checked', 'checked');
             $('#wp_timeline_sale_tagtext_alignment option[value="right-top"]').attr('selected', 'selected');
            //Social Share
            $('#social_share_1').attr('checked', 'checked');
            $('#social_style_1').attr('checked', 'checked');
            $('#social_icon_style_1').attr('checked', 'checked');
            $('#social_icon_size_0').attr('checked', 'checked');
            $('#default_icon_theme_1').attr('checked', 'checked');
            $('#facebook_link_1').attr('checked', 'checked');
            $('#twitter_link_1').attr('checked', 'checked');
            $('#linkedin_link_1').attr('checked', 'checked');
            $('#whatsapp_link_1').attr('checked', 'checked');
            $('#pinterest_link_1').attr('checked', 'checked');
            $('#wp_timeline_lazy_load_image_0').attr('checked', 'checked');
            $('#wp_timeline_lightbox_0').attr('checked', 'checked');
            $('#wp_year_timeline_side_0').attr('checked', 'checked');
            $('#wp_year_timeline_left_right_side_0').attr('checked', 'checked');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
        if (this.current_layout() == 'cover_layout') {
            $('#content_box_bg_color').val('#f0f0f0');
            $('#navigation_color').val('#000000');

            //Pagination Settings
            $('#pagination_type option[value="no_pagination"]').attr('selected', 'selected');
            $('#pagination_template option[value="template-1"]').attr('selected', 'selected');
            $('#pagination_text_color').val('#000000');
            $('#pagination_background_color').val('#ffffff');
            $('#pagination_text_hover_color').val('#ffffff');
            $('#pagination_background_hover_color').val('#000000');
            $('#pagination_text_active_color').val('#ffffff');
            $('#pagination_active_background_color').val('#000000');
            $('#pagination_border_color').val('#000000');
            $('#pagination_active_border_color').val('#000000');
            $('#load_more_button_template option[value="template-1"]').attr('selected', 'selected');
            $('#loadmore_button_text').val('Load More');
            $('#loadmore_button_color').val('#ffffff');
            $('#loadmore_button_hover_color').val('#000000');
            $('#loadmore_button_bg_color').val('#000000');
            $('#loadmore_button_bg_hover_color').val('#ffffff');
            $('#load_more_button_border_style option[value="none"]').attr('selected', 'selected');
            $('#wtl_loadmore_btn_borderleft').val('1');
            $('#wtl_loadmore_btn_borderright').val('1');
            $('#wtl_loadmore_btn_bordertop').val('1');
            $('#wtl_loadmore_btn_borderbottom').val('1');
            $('#wtl_loadmore_btn_borderleftcolor').val('#000000');
            $('#wtl_loadmore_btn_borderrightcolor').val('#000000');
            $('#wtl_loadmore_btn_bordertopcolor').val('#000000');
            $('#wtl_loadmore_btn_borderbottomcolor').val('#000000');
            $('#pagination_template option[value="0"]').attr('selected', 'selected');
            $('#loader_color').val('#222222');

            //Product Setting
            $('#display_sale_tag_1').attr('checked', 'checked');
            $('#wp_timeline_sale_tagtextcolor').val('#ffffff');
            $('#wp_timeline_sale_tagbgcolor').val('#222222');
            $('#wp_timeline_sale_tagtext_alignment option[value="left-top"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_angle').val('0');
            $('#wp_timeline_sale_tag_border_radius').val('0');
            $('#wp_timeline_sale_tagtext_paddingleft').val('5');
            $('#wp_timeline_sale_tagtext_paddingright').val('5');
            $('#wp_timeline_sale_tagtext_paddingtop').val('5');
            $('#wp_timeline_sale_tagtext_paddingbottom').val('5');
            $('#wp_timeline_sale_tagtext_marginleft').val('5');
            $('#wp_timeline_sale_tagtext_marginright').val('5');
            $('#wp_timeline_sale_tagtext_margintop').val('5');
            $('#wp_timeline_sale_tagtext_marginbottom').val('5');
            $('#wp_timeline_sale_tagfontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_sale_tagfontsize').val('12');
            $('#wp_timeline_sale_tag_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_line_height').val('1.5');
            $('#wp_timeline_sale_tag_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_sale_tag_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_sale_tag_font_letter_spacing').val('0');
            $('#display_product_rating_0').attr('checked', 'checked');
            $('#wp_timeline_star_rating_color').val('#eeee22');
            $('#wp_timeline_star_rating_bg_color').val('#eeee22');
            $('#wp_timeline_star_rating_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_star_rating_paddingleft').val('5');
            $('#wp_timeline_star_rating_paddingright').val('5');
            $('#wp_timeline_star_rating_paddingtop').val('5');
            $('#wp_timeline_star_rating_paddingbottom').val('5');
            $('#wp_timeline_star_rating_marginleft').val('5');
            $('#wp_timeline_star_rating_marginright').val('5');
            $('#wp_timeline_star_rating_margintop').val('5');
            $('#wp_timeline_star_rating_marginbottom').val('5');
            $('#display_product_price_1').attr('checked', 'checked');
            $('#wp_timeline_pricetextcolor').val('#222222');
            $('#wp_timeline_pricetext_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_pricetext_paddingleft').val('5');
            $('#wp_timeline_pricetext_paddingright').val('5');
            $('#wp_timeline_pricetext_paddingtop').val('5');
            $('#wp_timeline_pricetext_paddingbottom').val('5');
            $('#wp_timeline_pricetext_marginleft').val('5');
            $('#wp_timeline_pricetext_marginright').val('5');
            $('#wp_timeline_pricetext_margintop').val('5');
            $('#wp_timeline_pricetext_marginbottom').val('5');
            $('#wp_timeline_pricefontface option[value=""]').attr('selected', 'selected');
            $('#wp_timeline_pricefontsize').val('12');
            $('#wp_timeline_price_font_weight option[value="100"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_line_height').val('1.5');
            $('#wp_timeline_price_font_italic_0').attr('checked', 'checked');
            $('#wp_timeline_price_font_text_transform option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_text_decoration option[value="none"]').attr('selected', 'selected');
            $('#wp_timeline_price_font_letter_spacing').val('0');
            $('#wp_timeline_addtocartbutton_alignment_left').attr('checked', 'checked');
            $('#wp_timeline_addtocart_textcolor').val('#FFF');
            $('#wp_timeline_addtocart_text_hover_color').val('#000');
            $('#wp_timeline_addtocart_backgroundcolor').val('#000');
            $('#wp_timeline_addtocart_hover_backgroundcolor').val('#FFF');
            $('#display_addtocart_button_border_radius').val('0');
            $('#wp_timeline_addtocartbutton_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_borderright').val('0');
            $('#wp_timeline_addtocartbutton_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_borderbottomcolor').val('');
            $('#display_addtocart_button_border_hover_radius').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleft').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderright').val('0');
            $('#wp_timeline_addtocartbutton_hover_bordertop').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderbottom').val('0');
            $('#wp_timeline_addtocartbutton_hover_borderleftcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderrightcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_bordertopcolor').val('');
            $('#wp_timeline_addtocartbutton_hover_borderbottomcolor').val('');
            $('#wp_timeline_addtocartbutton_padding_leftright').val('10');
            $('#wp_timeline_addtocartbutton_padding_topbottom').val('0');
            $('#wp_timeline_addtocartbutton_margin_leftright').val('10');
            $('#wp_timeline_addtocartbutton_margin_topbottom').val('0');
            $('#wp_timeline_addtocart_button_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_hover_top_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_right_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_bottom_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_left_box_shadow').val('0');
            $('#wp_timeline_addtocart_button_hover_box_shadow_color').val('');
            $('#wp_timeline_addtocart_button_fontface').val('Roboto');
            $('#wp_timeline_addtocart_button_fontsize').val('14');
            $('#wp_timeline_addtocart_button_font_weight').val('normal');
            $('#display_addtocart_button_line_height').val('1.5');
            $('#wp_timeline_addtocart_button_font_italic_1').attr('checked', 'checked');
            $('#wp_timeline_addtocart_button_font_text_transform').val('none');
            $('#wp_timeline_addtocart_button_font_text_decoration').val('none');
            $('#wp_timeline_addtocart_button_letter_spacing').val('0');
        }
    },
    reset_layout_when_new: function () {
        layout = this.current_layout();
        $.ajax({
            type: 'POST',
            dataType: 'text',
            crossDomain: true,
            cache: false,
            url: ajaxurl,
            data: { 'action': 'wtl_load_default_layout_ajax', layout: layout, nonce: wp_timeline_js.ajax_nonce, },
            success: function (data) {
                wtl_settings = JSON.parse(data);
                wtladmin.do_reset(wtl_settings);
            }
        });
    },
    do_reset: function (wtl_settings) {

        /* General Settings */
        $('#timeline_heading_1').val(wtl_settings['timeline_heading_1']);
        $('#timeline_heading_2').val(wtl_settings['timeline_heading_2']);
        $('#posts_per_page').val(wtl_settings['posts_per_page']); //posts_per_page


        if (wtl_settings['display_category']) { $("#display_category_1").attr('checked', 'checked') } else { $("#display_category_0").attr('checked', 'checked') }
        if (wtl_settings['display_tag']) { $("#display_tag_1").attr('checked', 'checked') } else { $("#display_tag_0").attr('checked', 'checked') }
        if (wtl_settings['display_author']) { $("#display_author_1").attr('checked', 'checked') } else { $("#display_author_0").attr('checked', 'checked') }
        if (wtl_settings['display_date']) { $("#display_date_1").attr('checked', 'checked') } else { $("#display_date_0").attr('checked', 'checked') }
        if (wtl_settings['display_comment_count']) { $("#display_comment_count_1").attr('checked', 'checked') } else { $("#display_comment_count_0").attr('checked', 'checked') }

        // display_story_year
        $('#custom_css').val(wtl_settings['custom_css']);

        /* Standard Settings */
        $('#template_bgcolor').val(wtl_settings['template_bgcolor']);
        $('#template_bgcolor1').val(wtl_settings['template_bgcolor1']);
        $('#template_bgcolor2').val(wtl_settings['template_bgcolor2']);
        $('#template_bgcolor3').val(wtl_settings['template_bgcolor3']);
        $('#template_bgcolor4').val(wtl_settings['template_bgcolor4']);
        $('#template_bgcolor5').val(wtl_settings['template_bgcolor5']);
        $('#template_bgcolor6').val(wtl_settings['template_bgcolor6']);
        $('#template_ftcolor').val(wtl_settings['template_ftcolor']);

        $('#wp_timeline_star_rating_bg_color').val(wtl_settings['wp_timeline_star_rating_bg_color']);


        $('#template_fthovercolor').val(wtl_settings['template_fthovercolor']);
        $('#wp_timeline_post_offset').val(wtl_settings['wp_timeline_post_offset']);

        $('#meta_font_family_font_type option[value="' + wtl_settings["meta_font_family_font_type"] + '"]').attr('selected', 'selected');
        $('#meta_font_family option[value="' + wtl_settings["meta_font_family"] + '"]').attr('selected', 'selected');
        $('#meta_fontsize').val(wtl_settings['meta_fontsize']);
        $('#meta_font_weight option[value="' + wtl_settings["meta_font_weight"] + '"]').attr('selected', 'selected');
        $('#meta_font_line_height').val(wtl_settings['meta_font_line_height']);
        if (wtl_settings['meta_font_italic']) { $("#meta_font_italic_1").attr('checked', 'checked') } else { $("#meta_font_italic_0").attr('checked', 'checked') }
        $('#meta_font_text_transform option[value="' + wtl_settings["meta_font_text_transform"] + '"]').attr('selected', 'selected');
        $('#meta_font_text_decoration option[value="' + wtl_settings["meta_font_text_decoration"] + '"]').attr('selected', 'selected');
        $('#meta_font_letter_spacing').val(wtl_settings['meta_font_letter_spacing']);

        $('#date_font_family_font_type option[value="' + wtl_settings["date_font_family_font_type"] + '"]').attr('selected', 'selected');
        $('#date_font_family option[value="' + wtl_settings["date_font_family"] + '"]').attr('selected', 'selected');
        $('#date_fontsize').val(wtl_settings['date_fontsize']);
        $('#date_font_weight option[value="' + wtl_settings["date_font_weight"] + '"]').attr('selected', 'selected');
        $('#date_font_line_height').val(wtl_settings['date_font_line_height']);
        if (wtl_settings['date_font_italic']) { $("#date_font_italic_1").attr('checked', 'checked') } else { $("#date_font_italic_0").attr('checked', 'checked') }
        $('#date_font_text_transform option[value="' + wtl_settings["date_font_text_transform"] + '"]').attr('selected', 'selected');
        $('#date_font_text_decoration option[value="' + wtl_settings["date_font_text_decoration"] + '"]').attr('selected', 'selected');
        $('#date_font_letter_spacing').val(wtl_settings['date_font_letter_spacing']);

        /* Post Title Settings */
        if (wtl_settings['wp_timeline_post_title_link']) { $("#wp_timeline_post_title_link_1").attr('checked', 'checked') } else { $("#wp_timeline_post_title_link_0").attr('checked', 'checked') }
        if (wtl_settings['template_title_alignment'] == 'center') {
            $("#template_title_alignment_center").attr('checked', 'checked')
        } else if (wtl_settings['template_title_alignment'] == 'right') {
            $("#template_title_alignment_right").attr('checked', 'checked')
        } else {
            $("#template_title_alignment_left").attr('checked', 'checked')
        }
        $('#template_titlecolor').val(wtl_settings['template_titlecolor']);
        $('#template_titlehovercolor').val(wtl_settings['template_titlehovercolor']);
        $('#template_titlebackcolor').val(wtl_settings['template_titlebackcolor']);

        $('#template_titlefontface option[value="' + wtl_settings["template_titlefontface"] + '"]').attr('selected', 'selected');
        $('#template_titlefontsize').val(wtl_settings['template_titlefontsize']);
        $('#template_title_count_fontsize').val(wtl_settings['template_title_count_fontsize']);
        $('#template_title_font_weight option[value="' + wtl_settings["template_title_font_weight"] + '"]').attr('selected', 'selected');
        $('#template_title_font_line_height').val(wtl_settings['template_title_font_line_height']);
        if (wtl_settings['template_title_font_italic']) { $("#template_title_font_italic_1").attr('checked', 'checked') } else { $("#template_title_font_italic_0").attr('checked', 'checked') }
        $('#template_title_font_text_transform option[value="' + wtl_settings["template_title_font_text_transform"] + '"]').attr('selected', 'selected');
        $('#template_title_font_text_decoration option[value="' + wtl_settings["template_title_font_text_decoration"] + '"]').attr('selected', 'selected');
        $('#template_title_font_letter_spacing').val(wtl_settings['template_title_font_letter_spacing']);

        /* Post Content Settings */
        $('#template_categorybgcolor').val(wtl_settings['template_categorybgcolor']);
        $('#template_categorytextcolor').val(wtl_settings['template_categorytextcolor']);
        if (wtl_settings['rss_use_excerpt'] == '0') {
            $("#rss_use_excerpt_0").attr('checked', 'checked')
        } else {
            $("#rss_use_excerpt_1").attr('checked', 'checked')
        }
        $('#template_post_content_from option[value="' + wtl_settings["template_post_content_from"] + '"]').attr('selected', 'selected');
        if (wtl_settings['display_html_tags'] == '1') {
            $("#display_html_tags_1").attr('checked', 'checked')
        } else {
            $("#display_html_tags_0").attr('checked', 'checked')
        }
        if (wtl_settings['firstletter_big'] == '1') {
            $("#firstletter_big_1").attr('checked', 'checked')
        } else {
            $("#firstletter_big_0").attr('checked', 'checked')
        }

        $('#firstletter_font_family option[value="' + wtl_settings["firstletter_font_family"] + '"]').attr('selected', 'selected');
        $('#firstletter_fontsize').val(wtl_settings['firstletter_fontsize']);
        $('#firstletter_contentcolor').val(wtl_settings['firstletter_contentcolor']);
        $('#txtExcerptlength').val(wtl_settings['txtExcerptlength']);

        if (wtl_settings['advance_contents'] == '1') {
            $("#advance_contents_1").attr('checked', 'checked');
        } else {
            $("#advance_contents_0").attr('checked', 'checked');
        }
        $('#contents_stopage_from option[value="' + wtl_settings["contents_stopage_from"] + '"]').attr('selected', 'selected');
        //contents_stopage_character

        $('#template_contentcolor').val(wtl_settings['template_contentcolor']);

        $('#content_font_family_font_type option[value="' + wtl_settings["content_font_family_font_type"] + '"]').attr('selected', 'selected');
        $('#content_font_family option[value="' + wtl_settings["content_font_family"] + '"]').attr('selected', 'selected');
        $('#content_fontsize').val(wtl_settings['content_fontsize']);
        $('#content_font_weight option[value="' + wtl_settings["content_font_weight"] + '"]').attr('selected', 'selected');
        $('#content_font_line_height').val(wtl_settings['content_font_line_height']);
        if (wtl_settings['content_font_italic']) { $("#content_font_italic_1").attr('checked', 'checked') } else { $("#content_font_italic_0").attr('checked', 'checked') }
        $('#content_font_text_transform option[value="' + wtl_settings["content_font_text_transform"] + '"]').attr('selected', 'selected');
        $('#content_font_text_decoration option[value="' + wtl_settings["content_font_text_decoration"] + '"]').attr('selected', 'selected');
        $('#content_font_letter_spacing').val(wtl_settings['content_font_letter_spacing']);
        //Read More
        if (wtl_settings['read_more_link'] == '1') {
            $("#read_more_link_1").attr('checked', 'checked')
        } else {
            $("#read_more_link_0").attr('checked', 'checked')
        }
        if (wtl_settings['read_more_on'] == '1') {
            $("#read_more_on_1").attr('checked', 'checked')
        } else {
            $("#read_more_on_0").attr('checked', 'checked')
        }
        $('#txtReadmoretext').val(wtl_settings['txtReadmoretext']);

        if (wtl_settings['post_link_type'] == '0') {
            $("#post_link_type_0").attr('checked', 'checked')
        } else {
            $("#post_link_type_1").attr('checked', 'checked')
        }
        $('#custom_link_url').val(wtl_settings['custom_link_url']);

        if (wtl_settings['readmore_button_alignment'] == 'center') {
            $("#readmore_button_alignment_center").attr('checked', 'checked')
        } else if (wtl_settings['readmore_button_alignment'] == 'right') {
            $("#readmore_button_alignment_right").attr('checked', 'checked')
        } else {
            $("#readmore_button_alignment_left").attr('checked', 'checked')
        }
        $('#template_readmorecolor').val(wtl_settings['template_readmorecolor']);
        $('#template_readmorehovercolor').val(wtl_settings['template_readmorehovercolor']);
        $('#template_readmorebackcolor').val(wtl_settings['template_readmorebackcolor']);
        $('#template_readmore_hover_backcolor').val(wtl_settings['template_readmore_hover_backcolor']);

        $('#read_more_button_border_style option[value="' + wtl_settings["read_more_button_border_style"] + '"]').attr('selected', 'selected');
        $('#readmore_button_border_radius').val(wtl_settings['readmore_button_border_radius']);
        $('#wp_timeline_readmore_button_borderleft').val(wtl_settings['wp_timeline_readmore_button_borderleft']);
        $('#wp_timeline_readmore_button_borderleftcolor').val(wtl_settings['wp_timeline_readmore_button_borderleftcolor']);
        $('#wp_timeline_readmore_button_borderright').val(wtl_settings['wp_timeline_readmore_button_borderright']);
        $('#wp_timeline_readmore_button_borderrightcolor').val(wtl_settings['wp_timeline_readmore_button_borderrightcolor']);
        $('#wp_timeline_readmore_button_bordertop').val(wtl_settings['wp_timeline_readmore_button_bordertop']);
        $('#wp_timeline_readmore_button_bordertopcolor').val(wtl_settings['wp_timeline_readmore_button_bordertopcolor']);
        $('#wp_timeline_readmore_button_borderbottom').val(wtl_settings['wp_timeline_readmore_button_borderbottom']);
        $('#wp_timeline_readmore_button_borderbottomcolor').val(wtl_settings['wp_timeline_readmore_button_borderbottomcolor']);
        $('#readmore_button_border_radius').val(wtl_settings['readmore_button_border_radius']);
        $('#readmore_button_border_radius').val(wtl_settings['readmore_button_border_radius']);

        $('#read_more_button_hover_border_style option[value="' + wtl_settings["read_more_button_hover_border_style"] + '"]').attr('selected', 'selected');

        $('#readmore_button_hover_border_radius').val(wtl_settings['readmore_button_hover_border_radius']);
        $('#wp_timeline_readmore_button_hover_borderleft').val(wtl_settings['wp_timeline_readmore_button_hover_borderleft']);
        $('#wp_timeline_readmore_button_hover_borderleftcolor').val(wtl_settings['wp_timeline_readmore_button_hover_borderleftcolor']);
        $('#wp_timeline_readmore_button_hover_borderright').val(wtl_settings['wp_timeline_readmore_button_hover_borderright']);
        $('#wp_timeline_readmore_button_hover_borderrightcolor').val(wtl_settings['wp_timeline_readmore_button_hover_borderrightcolor']);
        $('#wp_timeline_readmore_button_hover_bordertop').val(wtl_settings['wp_timeline_readmore_button_hover_bordertop']);
        $('#wp_timeline_readmore_button_hover_bordertopcolor').val(wtl_settings['wp_timeline_readmore_button_hover_bordertopcolor']);
        $('#wp_timeline_readmore_button_hover_borderbottom').val(wtl_settings['wp_timeline_readmore_button_hover_borderbottom']);
        $('#wp_timeline_readmore_button_hover_borderbottomcolor').val(wtl_settings['wp_timeline_readmore_button_hover_borderbottomcolor']);

        $('#readmore_button_paddingleft').val(wtl_settings['readmore_button_paddingleft']);
        $('#readmore_button_paddingright').val(wtl_settings['readmore_button_paddingright']);
        $('#readmore_button_paddingtop').val(wtl_settings['readmore_button_paddingtop']);
        $('#readmore_button_paddingbottom').val(wtl_settings['readmore_button_paddingbottom']);

        $('#readmore_button_marginleft').val(wtl_settings['readmore_button_marginleft']);
        $('#readmore_button_marginright').val(wtl_settings['readmore_button_marginright']);
        $('#readmore_button_margintop').val(wtl_settings['readmore_button_margintop']);
        $('#readmore_button_marginbottom').val(wtl_settings['readmore_button_marginbottom']);
        //

        $('#readmore_font_family_font_type option[value="' + wtl_settings["readmore_font_family_font_type"] + '"]').attr('selected', 'selected');
        $('#readmore_font_family option[value="' + wtl_settings["readmore_font_family"] + '"]').attr('selected', 'selected');
        $('#readmore_fontsize').val(wtl_settings['readmore_fontsize']);
        $('#readmore_font_weight option[value="' + wtl_settings["readmore_font_weight"] + '"]').attr('selected', 'selected');
        $('#readmore_font_line_height').val(wtl_settings['readmore_font_line_height']);
        if (wtl_settings['readmore_font_italic']) { $("#readmore_font_italic_1").attr('checked', 'checked') } else { $("#readmore_font_italic_0").attr('checked', 'checked') }
        $('#readmore_font_text_transform option[value="' + wtl_settings["readmore_font_text_transform"] + '"]').attr('selected', 'selected');
        $('#readmore_font_text_decoration option[value="' + wtl_settings["readmore_font_text_decoration"] + '"]').attr('selected', 'selected');
        $('#readmore_font_letter_spacing').val(wtl_settings['readmore_font_letter_spacing']);

        /* Content Box Settings */
        $('#wp_timeline_content_border_width').val(wtl_settings['wp_timeline_content_border_width']);
        $('#wp_timeline_content_border_style option[value="' + wtl_settings["wp_timeline_content_border_style"] + '"]').attr('selected', 'selected');
        $('#wp_timeline_content_border_color').val(wtl_settings['wp_timeline_content_border_color']);
        $('#wp_timeline_content_border_radius').val(wtl_settings['wp_timeline_content_border_radius']);

        $('#content_box_bg_color').val(wtl_settings['content_box_bg_color']);
        $('#template_content_box_bg_color').val(wtl_settings['template_content_box_bg_color']);
        $('#wp_timeline_top_content_box_shadow').val(wtl_settings['wp_timeline_top_content_box_shadow']);
        $('#wp_timeline_right_content_box_shadow').val(wtl_settings['wp_timeline_right_content_box_shadow']);
        $('#wp_timeline_bottom_content_box_shadow').val(wtl_settings['wp_timeline_bottom_content_box_shadow']);
        $('#wp_timeline_left_content_box_shadow').val(wtl_settings['wp_timeline_left_content_box_shadow']);
        $('#wp_timeline_content_box_shadow_color').val(wtl_settings['wp_timeline_content_box_shadow_color']);
        $('#wp_timeline_content_padding_leftright').val(wtl_settings['wp_timeline_content_padding_leftright']);
        $('#wp_timeline_content_padding_topbottom').val(wtl_settings['wp_timeline_content_padding_topbottom']);

        /* Timeline Settings */
        $('#template_icon_border_radious').val(wtl_settings['template_icon_border_radious']);
        $('#timeline_style_type option[value="' + wtl_settings["timeline_style_type"] + '"]').attr('selected', 'selected');

        if (wtl_settings['timeline_style_view'] == 'center') {
            $("#timeline_style_view_center").attr('checked', 'checked')
        } else if (wtl_settings['timeline_style_view'] == 'minima') {
            $("#timeline_style_view_minima").attr('checked', 'checked')
        } else if (wtl_settings['timeline_style_view'] == 'left') {
            $("#timeline_style_view_left").attr('checked', 'checked')
        } else {
            $("#timeline_style_view_right").attr('checked', 'checked')
        }
        $('#timeline_animation option[value="' + wtl_settings["timeline_animation"] + '"]').attr('selected', 'selected');
        $('#template_color').val(wtl_settings['template_color']);
        $('#template_color2').val(wtl_settings['template_color2']);
        $('#template_color3').val(wtl_settings['template_color3']);
        $('#template_color4').val(wtl_settings['template_color4']);
        $('#template_color5').val(wtl_settings['template_color5']);
        $('#story_startup_text').val(wtl_settings['story_startup_text']);
        $('#story_ending_text').val(wtl_settings['story_ending_text']);
        $('#story_start_bg_color').val(wtl_settings['story_start_bg_color']);
        $('#story_start_text_color').val(wtl_settings['story_start_text_color']);
        $('#story_ending_bg_color').val(wtl_settings['story_ending_bg_color']);
        $('#story_ending_text_color').val(wtl_settings['story_ending_text_color']);


        $('#wtl_single_display_timeline_icon').val(wtl_settings['wtl_single_display_timeline_icon']);
        $('#wtl_single_timeline_icon').val(wtl_settings['wtl_single_timeline_icon']);
        $('#wtl_icon_image_id').val(wtl_settings['wtl_icon_image_id']);
        $('#wtl_icon_image_src').val(wtl_settings['wtl_icon_image_src']);

        if (wtl_settings['layout_type'] == '1') {
            $("#layout_type_1").attr('checked', 'checked')
        } else {
            $("#layout_type_2").attr('checked', 'checked')
        }
        /* Media Settings */
        if (wtl_settings['wp_timeline_enable_media'] == '1') {
            $("#wp_timeline_enable_media_0").prop("checked", false);
            $("#wp_timeline_enable_media_1").prop("checked", true);
        } else {
            $("#wp_timeline_enable_media_0").prop("checked", true);
            $("#wp_timeline_enable_media_1").prop("checked", false);
        }

        if (wtl_settings['wp_timeline_post_image_link'] == '1') {
            $("#wp_timeline_post_image_link_1").attr('checked', 'checked')
        } else {
            $("#wp_timeline_post_image_link_0").attr('checked', 'checked')
        }

        if (wtl_settings['wp_timeline_image_hover_effect'] == '1') {
            $("#wp_timeline_image_hover_effect_1").attr('checked', 'checked')
        } else {
            $("#wp_timeline_image_hover_effect_0").attr('checked', 'checked')
        }
        $('#wp_timeline_image_hover_effect_type option[value="' + wtl_settings["wp_timeline_image_hover_effect_type"] + '"]').attr('selected', 'selected');
        $('#wp_timeline_default_image_id').val(wtl_settings['wp_timeline_default_image_id']);
        $('#wp_timeline_default_image_src').val(wtl_settings['wp_timeline_default_image_src']);
        $('#wp_timeline_media_size option[value="' + wtl_settings["wp_timeline_media_size"] + '"]').attr('selected', 'selected');
        $('#media_custom_width').val(wtl_settings['media_custom_width']);
        $('#media_custom_height').val(wtl_settings['media_custom_height']);
        /* Horizontal Timeline Settings */

        if (wtl_settings['display_timeline_bar'] == '0') {
            $("#display_timeline_bar_0").attr('checked', 'checked')
        } else {
            $("#display_timeline_bar_1").attr('checked', 'checked')
        }
        $('#timeline_start_from').val(wtl_settings['timeline_start_from']);
        $('#media_custom_height').val(wtl_settings['media_custom_height']);
        $('#template_easing option[value="' + wtl_settings["template_easing"] + '"]').attr('selected', 'selected');
        $('#item_width').val(wtl_settings['item_width']);
        $('#item_height').val(wtl_settings['item_height']);
        $('#template_post_margin').val(wtl_settings['template_post_margin']);
        if (wtl_settings['enable_autoslide'] == '1') {
            $("#enable_autoslide_1").attr('checked', 'checked');
        } else {
            $("#enable_autoslide_0").attr('checked', 'checked')
        }
        $('#scroll_speed').val(wtl_settings['scroll_speed']);
        $('#noof_slider_nav_itme').val(wtl_settings['noof_slider_nav_itme']);
        $('#noof_slide').val(wtl_settings['noof_slide']);

        /* Filter Settings */

        /* Pagination Settings */
        $('#pagination_type option[value="' + wtl_settings["pagination_type"] + '"]').attr('selected', 'selected');

        /* Social Share Settings */
        if (wtl_settings['social_share'] == '1') {
            $("#social_share_1").attr('checked', 'checked')
        } else {
            $("#social_share_0").attr('checked', 'checked')
        }

        if (wtl_settings['social_share_position'] == 'center') {
            $('#social_share_position option[value="' + wtl_settings["social_share_position"] + '"]').attr('selected', 'selected');
        } else if (wtl_settings['social_share_position'] == 'right') {
            $('#social_share_position option[value="' + wtl_settings["social_share_position"] + '"]').attr('selected', 'selected');
        } else {
            $('#social_share_position option[value="' + wtl_settings["social_share_position"] + '"]').attr('selected', 'selected');
        }
        $("#facebook_link_with_count").attr('checked', 'checked');
        $("#pinterest_link_with_count").attr('checked', 'checked');
        $("#default_icon_theme").val('checked', 'checked');
        if (wtl_settings['default_icon_theme'] == '5') {
            $("#default_icon_theme").val('checked', 'checked');
        } else if (wtl_settings['social_share_position'] == '6') {
            $("#default_icon_theme").val('checked', 'checked');
        } else {
            $("#default_icon_theme").val('checked', 'checked');
        }
    },
    hide_field_for_layout: function () {
        var cl = this.current_layout();
        ish = this.is_horizontal();
        if (ish) {
            $('.wp_timeline_pagination').addClass('clickDisable');
            $('.wtl_hz_ts_9,.wtl_hz_ts_10').show();
            $('li[data-show="wp_timeline_pagination"]').addClass('clickDisable');
            $('.display_year_timeline_side').hide();
        } else {
            $('.wtl_hz_ts_9,.wtl_hz_ts_10').hide();
            $('li[data-show="wp_timeline_pagination"]').removeClass('clickDisable');
            $('.display_year_timeline_side').show();
        }
        $('.hire-pbar-color').hide();
        $('.timeline_line_width').hide();

        $('.hide_timeline_icon_tr').hide();
        $('.category-text-color-tr').hide();
        icon_layout = $('.wtl_icon_layout_type');
        box_arrow_bor = $('.wtl_box_arrow_side_border');
        tl_style = $('.timeline_style');
        icon_layout.hide();
        box_arrow_bor.hide();
        tl_style.hide();

        if (cl == 'advanced_layout') {
            $('.titlebackcolor_tr,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl-post-timeline-icon,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.temp-sportik-bg-color ').hide();
            $('.wtl_heading_1,.wtl_heading_2').show();
            $('.timeline_line_width').show();
            icon_layout.show();
            box_arrow_bor.show();
            tl_style.show();
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'verticalblur_layout') {
            $('.titlebackcolor_tr,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl-post-timeline-icon,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.category-bg-color-tr,.wp-timeline-back-color-blog,.timeline-icon-border-radious,.title_alignment_section,.post_date_format_tr,.wp-timeline-post-sortby,.temp-sportik-bg-color').hide();
            $('.wp_timeline_content_box').addClass('clickDisable');
            $('.wtl_heading_1,.wtl_heading_2,.timeline_line_width,.timeline_animation,.timeline_style_type').show();
            icon_layout.show();
            box_arrow_bor.show();
        }
        if (cl == 'accordion') {
            $('.wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.temp-sportik-bg-color').hide();
            $('#pagination_type').children('option[value="load_onscroll_btn"]').hide();
            $('.wtl_heading_1,.wtl_heading_2,.category-bg-color-tr,.post_date_format_tr').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.blog-templatebgcolor-tr').show();
        }
        if (cl == 'collapsible') {
            $('.wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.post_date_format_tr,.social_share_position_option,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('#pagination_type').children('option[value="load_onscroll_btn"]').hide();
            $('.timeline_animation,.category-text-color-tr').show();
        }
        if (cl == 'hire_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.temp-sportik-bg-color ').hide();
            $('.timeline_animation').show();
            $('.hire-pbar-color').show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'curve_layout') {
            $('.wtl_heading_1,.wtl_heading_2,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl-post-timeline-icon,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.temp-sportik-bg-color ').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
                $('.timeline-icon-border-radious').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
                $('.timeline-icon-border-radious').hide();
            }
        }
        if (cl == 'story_layout') {
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###             
            $('.timeline_animation').show();
            //$('.wp_timeline_settings').addClass('clickDisable');
        }
        if (cl == 'fullvertical_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_10,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2,.blog-template-tr.wp-timeline-back-color-blog,.category-bg-color-tr,.wtl-post-timeline-icon,.wp-timeline-image-hover-effect,.post_image_link_section_li,.wp-timeline-post-sortby').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.hide_timeline_icon_tr,.timeline_animation').hide(1000);
        }
        if (cl == 'year_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            //$('.wp_timeline_settings').addClass('clickDisable');
            $('.timeline_animation').show();
        }
        if (cl == 'fullwidth_layout') {
            $('.blog-templatebgcolor-tr, .wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.temp-sportik-bg-color ').hide();
            $('.wtl-back-color-soft-block').show();
            $('.wp_timeline_settings').addClass('clickDisable');
            $('.timeline_animation').show();
        }
        if (cl == 'easy_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.temp-sportik-bg-color ').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.hide_timeline_icon_tr').show(1000);
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'fullhorizontal_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl-post-timeline-icon,.wtl-option-timeline-icon-fontawesome,.wp-timeline-back-color-blog,.category-bg-color-tr,.template-color,.social_share_position_option,.post_image_link_section_li,.wp-timeline-post-sortby').hide();
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'attract_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wp-timeline-post-sortby,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.hide_timeline_icon_tr').show(1000);
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'processinfo_layout') {
            $('.title-link-count-color-tr').show();
            $('.title-font-count-size').show();
            $('.wtl_hz_ts_9,.wtl_hz_ts_10').show();
            $('.wp_timeline_pagination').addClass('clickDisable');
        }
        else{
            $('.title-link-count-color-tr').hide();
            $('.title-font-count-size').hide();
            $('.wtl_hz_ts_9,.wtl_hz_ts_10').hide();
            $('.wp_timeline_pagination').removeClass('clickDisable');
        }
        if (cl == 'processinfo_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wp-timeline-post-sortby').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.wtl-back-color-soft-block').show();
            $('.wtl-soft-block-num').hide();
            $('.hide_timeline_icon_tr').hide();
            $('.wtl-post-timeline-icon').hide();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'divide_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_10,.hide_timeline_icon_tr,.wtl-post-timeline-icon,.wp-timeline-post-authors-list,.wp_timeline_sort_by_front,.advance_filter_settings,.wp-timeline-post-sticky,.wp-timeline-post-sortby,.category-bg-color-tr,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.timeline-icon-border-radious').show();
            $(".display_image_tr").show();
            $(".wp-timeline-image-hover-effect-tr").show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'topdivide_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_10,.hide_timeline_icon_tr,.wtl-post-timeline-icon,.wp-timeline-post-authors-list,.wp_timeline_sort_by_front,.advance_filter_settings,.wp-timeline-post-sticky,.wp-timeline-post-sortby,.social_share_position_option').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.timeline-icon-border-radious').show();
            $(".display_image_tr").show();
            $(".wp-timeline-image-hover-effect-tr").show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'cool_horizontal') {
            $('.titlebackcolor_tr, .blog-templatebgcolor-tr, .wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.wtl_hz_ts_11,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            //$('.wp_timeline_settings').addClass('clickDisable');
            $('.wp_timeline_pagination').addClass('clickDisable');
            $('.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6').show();
            $('.display_popup_tr').hide();
            $('.wtl-navigation-color').show();
            $('.wtl-navigation-bg-color').show();
            $('.wtl-navigation-arrow-size').show();
        }
        if (cl == 'overlay_horizontal') {
            $('.titlebackcolor_tr, .blog-templatebgcolor-tr, .wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.wtl_hz_ts_11 ').hide();
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###            
            $('.wp_timeline_settings').addClass('clickDisable');
            $('.wp_timeline_pagination').addClass('clickDisable');
            $('.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6').show();
            $('.display_popup_tr').hide();
            $('.wtl-navigation-color').show();
            $('.wtl-navigation-bg-color').show();
            $('.wtl-navigation-arrow-size').show();
        }
        if (cl == 'sportking_layout') {
            $('.wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6 ').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.wtl-back-color-soft-block').hide();
            $('.timeline_animation').show();
            $('#pagination_type option[value="load_more_btn"]').hide();
            $('#pagination_type option[value="load_onscroll_btn"]').hide();
        }
        if (cl == 'milestone_layout') {
            $('.wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,wtl_hz_ts_9,.wtl_hz_ts_10 ').hide();
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###
            $('.wtl-back-color-soft-block').show();
            $('.timeline_animation').show();
            $('#pagination_type option[value="load_more_btn"]').hide();
            $('#pagination_type option[value="load_onscroll_btn"]').hide();
        }
        if (cl == 'schedule') {
            $('.wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10').hide();
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###
            $('.timeline_animation').show();
        }
        if (cl == 'soft_block') {
            $('.wtl-post-timeline-icon, .timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.wtl_hz_ts_10,.temp-sportik-bg-color,.template-color,.temp-even-bg-color').hide();
            $('li[data-show="wp_timeline"]').addClass('clickDisable');
            $('li[data-show="wp_timeline_content_box"]').addClass('clickDisable');
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.timeline_animation').show();
        }
        if (cl == 'glossary_layout') {
            $('.timeline_line_width,.timeline_style_type,.timeline_style_view,.hire-pbar-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.hide_timeline_icon_tr,.temp-odd-bg-color,.wtl-post-timeline-icon,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.temp-sportik-bg-color').hide();
            $('.timeline_animation').show();
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'business_layout') {
            $('.wp-timeline-b-l').show();
            $('.wtl-meta-color-business').show();
        }
        else{
            $('.wp-timeline-b-l').hide();
            $('.wtl-meta-color-business').hide();
        }
        if (cl == 'business_layout') {
            $('.timeline_line_width,.timeline_style_type,.timeline_style_view,.hire-pbar-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.hide_timeline_icon_tr,.temp-odd-bg-color,.wtl-post-timeline-icon,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.temp-sportik-bg-color').hide();
            $('.timeline_animation').show();
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if(cl == 'timeline_graph_layout' ){
            $('.timeline_line_width,.timeline_style_type,.timeline_style_view,.hire-pbar-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.hide_timeline_icon_tr,.temp-odd-bg-color,.wtl-post-timeline-icon,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.temp-sportik-bg-color').hide();
            $('.timeline_animation').show();
            $('.wtl-back-color-soft-block').show();
            $('.wtl-soft-block-num').hide();
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'boxy_layout') {
            $('.timeline_line_width,.timeline_style_type,.timeline_style_view,.hire-pbar-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.hide_timeline_icon_tr,.temp-odd-bg-color,.wtl-post-timeline-icon,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.temp-sportik-bg-color').hide();
            $('.timeline_animation').show()
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'wise_layout') {
            $('.timeline_line_width,.timeline_style_type,.timeline_style_view,.hire-pbar-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.hide_timeline_icon_tr,.temp-odd-bg-color,.wtl-post-timeline-icon,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.temp-sportik-bg-color').hide();
            $('.timeline_animation').show()
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }

        }
        if (cl == 'cover_layout') {
            $('.timeline-icon-border-radious,.timeline_line_width,.timeline_style_type,.timeline_style_view,.hire-pbar-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.hide_timeline_icon_tr,.temp-odd-bg-color,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.temp-sportik-bg-color,.temp-even-bg-color,.template-color').hide();
            $('.timeline_animation').show();
            if (this.is_horizontal()) {
                $('.timeline_animation').hide();
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
            $('.timeline-icon-border-radious,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6 ').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###

            $('.hide_timeline_icon_tr').show();
            $('.temp-even-bg-color').show();
        }

        if (cl == 'rounded_layout') {
            $('.timeline-icon-border-radious,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6 ').hide();
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###
            $('.timeline_animation').show();
            $('.hide_timeline_icon_tr').show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'infographic_layout') {
            $('.wtl-post-timeline-icon,.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.hide_timeline_icon_tr,.template-color,.category-bg-color-tr,.temp-sportik-bg-color ').hide();
            $('.wtl-arrow-back-color-infographic').show();
            $('.timeline_animation').show();
        }
        if (cl == 'zigzag_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.story-s-text,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.hide_timeline_icon_tr,.temp-sportik-bg-color').hide();
            $('.wp_timeline_image_shape_zigzag').show();
            $('.timeline_animation').show();
        }

        if (cl == 'columy_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.social_share_position_option,.post_image_link_section_li,.wp-timeline-post-sortby,.temp-sportik-bg-color,.wtl-post-timeline-icon').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'leafty_layout') {
            $('.timeline-icon-border-radious,.template-color,.wp-timeline-back-color-blog,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.category-bg-color-tr,.social_share_position_option,.wp-timeline-post-sortby,.temp-sportik-bg-color,.wtl-post-timeline-icon').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'sportking_layout') {
            $('.timeline-icon-border-radious,.wp-timeline-back-color-blog,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.category-bg-color-tr,.social_share_position_option,.wp-timeline-post-sortby').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            }
        }
        if (cl == 'filledtimeline_layout') {
            $('.timeline-icon-border-radious,.template-color,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.category-bg-color-tr,.social_share_position_option,.wp-timeline-post-sortby').hide();
            $('.wtl_heading_1,.wtl_heading_2,.temp-sportik-bg-color').hide(); ///### HEADING ###
            $('.wtl-navigation-background-color1, .wtl-navigation-background-color2, .wtl-navigation-background-color3').show();
            if (this.is_horizontal()) {
                $('.wtl-navigation-color').show();
                $('.wtl-navigation-bg-color').show();
                $('.wtl-navigation-arrow-size').show();
            } else {
                $('.wtl-navigation-color').hide();
                $('.wtl-navigation-bg-color').hide();
                $('.wtl-navigation-arrow-size').hide();
            }
        }
        if (cl == 'classictimeline_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.category-bg-color-tr,.social_share_position_option,.wp-timeline-post-sortby,.temp-sportik-bg-color').hide();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
            $('.wtl-post-timeline-icon, .wtl-line-color-zigzag').show();
        }
        if (cl == 'milestonetimeline_layout') {
            $('.timeline-icon-border-radious,.temp-even-bg-color,.temp-odd-bg-color,.temp-even-color,.temp-odd-color,.story-s-text,.story-e-text,.story-s-bg-color,.story-s-bg-color,.story-s-text-color,.story-end-bg-color,.story-end-text-color,.wtl_hz_ts_1,.wtl_hz_ts_2,.wtl_hz_ts_3,.wtl_hz_ts_4,.wtl_hz_ts_5,.wtl_hz_ts_6,.wtl_hz_ts_9,.social_share_position_option,.post_image_link_section_li,.wp-timeline-post-sortby,.category-bg-color-tr,.wp-timeline-post-offset,.temp-sportik-bg-color').hide();
            $('.wtl-icon-color-milestonetimeline').show();
            $('.wtl-navigation-color').show();
            $('.wtl-navigation-bg-color').show();
            $('.wtl-navigation-arrow-size').show();
            $('.wtl_heading_1,.wtl_heading_2').hide(); ///### HEADING ###
        }

        /*Mix*/
        if (cl == 'advanced_layout' || cl == 'hire_layout' || cl == 'curve_layout') {
            $('input[name="layout_type"]').on('change', function () {
                v = $('input[name="layout_type"]:checked').val();
                if (v == 1) {
                    $('.wtl_hz_ts_9,.wtl_hz_ts_10').show();
                    $('.wp_timeline_pagination').addClass('clickDisable');
                } else {
                    $('.wp_timeline_pagination').removeClass('clickDisable');
                }
            });
        }
        if (cl == 'curve_layout') {
            $('input[name="layout_type"]').on('change', function () {
                v = $('input[name="layout_type"]:checked').val();
                if (v == 1) {
                    $('.timeline-icon-border-radious').show();
                } else {
                    $('.timeline-icon-border-radious').hide();
                }
            });
        }
        if (cl == 'verticalblur_layout' || cl == 'fullvertical_layout') {
            $('li[data-show="wp_timeline_pagination"]').addClass('clickDisable');
            $('input[name="layout_type"]').on('change', function () {
                if ($("input[name='layout_type']:checked").val() == 2) {
                    $('li[data-show="wp_timeline_pagination"]').addClass('clickDisable');
                } else {
                    $('li[data-show="wp_timeline_pagination"]').removeClass('clickDisable');
                }
            });
        }
        if (cl == 'advanced_layout' || cl == 'hire_layout' || cl == 'fullwidth_layout' || cl == 'schedule' || cl == 'accordion' || cl == 'collapsible' || cl == 'soft_block') {
            $('.wtl_post_date_option').show();
        } else {
            $('.wtl_post_date_option').hide();
        }
        if (cl == 'advanced_layout' || cl == 'boxy_layout' || cl == 'classictimeline_layout' || cl == 'cover_layout' || cl == 'curve_layout' || cl == 'easy_layout' || cl == 'filledtimeline_layout' || cl == 'fullwidth_layout' || cl == 'glossary_layout' || cl == 'business_layout' || cl == 'timeline_graph_layout' || cl == 'hire_layout' || cl == 'infographic_layout' || cl == 'rounded_layout' || cl == 'story_layout' || cl == 'verticalblur_layout' || cl == 'wise_layout' || cl == 'year_layout' || cl == 'zigzag_layout') {
            $('input[name="wp_year_timeline_side"]').on('change', function () {
                v = $('input[name="wp_year_timeline_side"]:checked').val();
                if (v == 1) {
                    $('.display_year_timeline_left_right_side').show();
                } else {
                    $('.display_year_timeline_left_right_side').hide();
                }
            });
            v = $('input[name="wp_year_timeline_side"]:checked').val();
            if (v == 1) {
                $('.display_year_timeline_left_right_side').show();
            } else {
                $('.display_year_timeline_left_right_side').hide();
            }
        } else {
            $('.display_year_timeline_side').hide();
            $('.display_year_timeline_left_right_side').hide();
        }
    },
    blog_background_image: function () {
        tr = $('.blog_background_image_style_tr');
        if ($('#blog_background_image').is(':checked')) { tr.show() } else { tr.hide() }
    },
    read_more_inline: function () {
        if ($("input[name='read_more_link']:checked").val() == 1) {

            rm_in_e = $('.read_more_button_alignment_setting,.read_more_text_background,.read_more_text_hover_background,.read_more_button_border_setting,.read_more_button_border_radius_setting,.read_more_button_border_setting,.read_more_button_border_setting,.read_more_button_border_radius_setting,.read_more_button_border_setting,.read_more_button_border_setting,.read_more_button_border_setting');
            if ($("input[name='read_more_on']:checked").val() == 1) {
                rm_in_e.hide();
            } else {
                rm_in_e.show();
            }
            $("input[name='read_more_on']").change(function () {
                if ($(this).val() == 1) {
                    rm_in_e.hide();
                } else {
                    rm_in_e.show();
                }
            });

        } else {

        }
    },
    wp_timelineCustomReadMore: function (dta) {
        $('.wp-timeline-setting-handle li').each(function () {
            var hd = $(this).attr('data-show');
            if (hd == 'wp_timeline_customreadmore') {
                if (dta == 'show' && $('#pagination_type').val() == 'no_pagination') { $(this).removeClass('clickDisable') } else if (dta == 'hide') { $(this).addClass('clickDisable') }
            }
        });
    },
    timeline_style_view: function () {
        var cl = this.current_layout();
        if (cl == 'advanced_layout') {
            tstyleview = $('.timeline_style_view');
            if ($("input[name='layout_type']:checked").val() == 1) {
                tstyleview.hide();
            } else {
                tstyleview.show()
            }
            $("input[name='layout_type']").change(function () {
                if ($(this).val() == 1) {
                    tstyleview.hide()
                } else {
                    tstyleview.show()
                }
            });
        }
    },
    post_image_hover_effect() {
        var ihetr = $('.wp-timeline-image-hover-effect-tr');
        ihetr.hide();
        if ($("input[name='wp_timeline_enable_media']:checked").val() == 1 && $("input[name='wp_timeline_image_hover_effect']:checked").val() == 1) {
            ihetr.show()
        } else {
            ihetr.hide()
        };

        var mcstr = $('.wp_timeline_media_custom_size_tr');
        mcstr.hide();
        if ($('#wp_timeline_media_size').val() == 'custom') {
            mcstr.show();
        } else {
            mcstr.hide();
        }
    },
    show_preview: function () {
        /*Ajax call for preview*/
        var can_preview = 1;
        jQuery("#wp-timeline-btn-show-preview").on('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            jQuery('.splash-screen').show();
            var urlParams = new URLSearchParams(window.location.search);
            var wtl_id = urlParams.get('id');
            jQuery('#wp-timeline-preview-box').addClass('preview-in');
            if (can_preview) {
                var data = jQuery('.wp-timeline-form-class').serialize();
                var $wp_timeline_template_name = jQuery('.wp_timeline_template_name ').val();
                var href = plugin_path + '/public/css/layouts/' + $wp_timeline_template_name + '.css';
                var front_href = plugin_path + '/public/css/wp-timeline-public.css';
                var flexslider_css = plugin_path + '/public/css/flexslider.css';
                var flexslider_js = plugin_path + '/public/js/jquery.flexslider-min.js';
                var masonry_js = plugin_path + '/public/js/isotope.pkgd.min.js';
                var imagesLoaded_js = plugin_path + '/admin/js/imagesloaded.pkgd.min.js';
                var $style = "";
                var $template_bgcolor = jQuery("#template_bgcolor").val();
                var $template_ftcolor = jQuery("#template_ftcolor").val();
                var $fthover = jQuery("#template_fthovercolor").val();
                var $template_categorybgcolor = jQuery("#template_categorybgcolor").val();
                var $template_titlefontface = jQuery("#template_titlefontface").val();
                var $meta_fontsize = jQuery("#meta_fontsize").val();
                var $meta_font_weight = jQuery("#meta_font_weight").val();
                var $meta_font_line_height = jQuery("#meta_font_line_height").val();
                var $meta_font_italic = jQuery("input[name='meta_font_italic']:checked").val();
                var $meta_font_text_transform = jQuery("#meta_font_text_transform").val();
                var $meta_font_text_decoration = jQuery("#meta_font_text_decoration").val();
                var $meta_font_letter_spacing = jQuery("#meta_font_letter_spacing").val();
                var $date_fontsize = jQuery("#date_fontsize").val();
                var $date_font_weight = jQuery("#date_font_weight").val();
                var $date_font_line_height = jQuery("#date_font_line_height").val();
                var $date_font_italic = jQuery("input[name='date_font_italic']:checked").val();
                var $date_font_text_transform = jQuery("#date_font_text_transform").val();
                var $date_font_text_decoration = jQuery("#date_font_text_decoration").val();
                var $date_font_letter_spacing = jQuery("#date_font_letter_spacing").val();
                var $template_icon_border_radious = jQuery("#template_icon_border_radious").val();
                var $timeline_line_width = jQuery("#timeline_line_width").val();
                var $template_color = jQuery("#template_color").val();
                var $title_alignment = jQuery('input[name="template_title_alignment"]:checked').val();
                var $template_titlecolor = jQuery("#template_titlecolor").val();
                var $template_titlehovercolor = jQuery("#template_titlehovercolor").val();
                var $template_title_count_color = jQuery("#template_title_count_color").val();
                var $template_title_count_fontsize = jQuery("#template_title_count_fontsize").val();
                var $template_titlebackcolor = jQuery("#template_titlebackcolor").val();
                var $firstletter_big = jQuery('input[name="firstletter_big"]:checked').val();
                var $firstletter_fontsize = jQuery("#firstletter_fontsize").val();
                var $firstletter_contentcolor = jQuery("#firstletter_contentcolor").val();
                var $template_contentcolor = jQuery("#template_contentcolor").val();
                var $content_font_family = jQuery("#content_font_family").val();
                var $content_fontsize = jQuery("#content_fontsize").val();
                var $content_font_weight = jQuery("#content_font_weight").val();
                var $content_font_line_height = jQuery("#content_font_line_height").val();
                var $content_font_italic = jQuery("input[name='content_font_italic']:checked").val();
                var $content_font_text_transform = jQuery("#content_font_text_transform").val();
                var $content_font_text_decoration = jQuery("#content_font_text_decoration").val();
                var $content_font_letter_spacing = jQuery("#content_font_letter_spacing").val();
                var $readmore_button_alignment = jQuery("input[name='readmore_button_alignment']:checked").val();
                var $template_readmorecolor = jQuery("#template_readmorecolor").val();
                var $template_readmorebackcolor = jQuery("#template_readmorebackcolor").val();
                var $template_readmorehovercolor = jQuery("#template_readmorehovercolor").val();
                var $template_readmore_hover_backcolor = jQuery("#template_readmore_hover_backcolor").val();
                var $read_more_button_border_style = jQuery("#read_more_button_border_style").val();
                var $wp_timeline_readmore_button_borderleft = jQuery("#wp_timeline_readmore_button_borderleft").val();
                var $wp_timeline_readmore_button_borderright = jQuery("#wp_timeline_readmore_button_borderright").val();
                var $wp_timeline_readmore_button_bordertop = jQuery("#wp_timeline_readmore_button_bordertop").val();
                var $wp_timeline_readmore_button_borderbottom = jQuery("#wp_timeline_readmore_button_borderbottom").val();
                var $wp_timeline_readmore_button_borderleftcolor = jQuery("#wp_timeline_readmore_button_borderleftcolor").val();
                var $wp_timeline_readmore_button_borderrightcolor = jQuery("#wp_timeline_readmore_button_borderrightcolor").val();
                var $wp_timeline_readmore_button_bordertopcolor = jQuery("#wp_timeline_readmore_button_bordertopcolor").val();
                var $wp_timeline_readmore_button_borderbottomcolor = jQuery("#wp_timeline_readmore_button_borderbottomcolor").val();
                var $read_more_button_hover_border_style = jQuery("#read_more_button_hover_border_style").val();
                var $wp_timeline_readmore_button_hover_borderleft = jQuery("#wp_timeline_readmore_button_hover_borderleft").val();
                var $wp_timeline_readmore_button_hover_borderleftcolor = jQuery("#wp_timeline_readmore_button_hover_borderleftcolor").val();
                var $wp_timeline_readmore_button_hover_borderright = jQuery("#wp_timeline_readmore_button_hover_borderright").val();
                var $wp_timeline_readmore_button_hover_borderrightcolor = jQuery("#wp_timeline_readmore_button_hover_borderrightcolor").val();
                var $wp_timeline_readmore_button_hover_bordertop = jQuery("#wp_timeline_readmore_button_hover_bordertop").val();
                var $wp_timeline_readmore_button_hover_bordertopcolor = jQuery("#wp_timeline_readmore_button_hover_bordertopcolor").val();
                var $wp_timeline_readmore_button_hover_borderbottom = jQuery("#wp_timeline_readmore_button_hover_borderbottom").val();
                var $wp_timeline_readmore_button_hover_borderbottomcolor = jQuery("#wp_timeline_readmore_button_hover_borderbottomcolor").val();
                var $readmore_button_paddingleft = jQuery("#readmore_button_paddingleft").val();
                var $readmore_button_paddingright = jQuery("#readmore_button_paddingright").val();
                var $readmore_button_paddingtop = jQuery("#readmore_button_paddingtop").val();
                var $readmore_button_paddingbottom = jQuery("#readmore_button_paddingbottom").val();
                var $readmore_fontsize = jQuery("#readmore_fontsize").val();
                var $readmore_font_weight = jQuery("#readmore_font_weight").val();
                var $readmore_font_line_height = jQuery("#readmore_font_line_height").val();
                var $readmore_font_italic = jQuery("input[name='readmore_font_italic']:checked").val();
                var $readmore_font_text_transform = jQuery("#readmore_font_text_transform").val();
                var $readmore_font_text_decoration = jQuery("#readmore_font_text_decoration").val();
                var $readmore_font_letter_spacing = jQuery("#readmore_font_letter_spacing").val();
                var $template_lazyload_color = jQuery("#template_lazyload_color");
                var $navigation_color = jQuery("#navigation_color").val();
                var $navigation_bg_color = jQuery("#navigation_bg_color").val();
                var $navigation_arrow_size = jQuery("#navigation_arrow_size").val();

                

                $style += "#wp-timeline-preview-box .wtl_wrapper{background: " + $template_bgcolor + " !important;}";
                $style += "#wp-timeline-preview-box .wtl-post-category a,#wp-timeline-preview-box .wtl-post-tags a,#wp-timeline-preview-box .wtl_blog_template .link-lable,#wp-timeline-preview-box .wtl-author a,#wp-timeline-preview-box .wtl-comment a,#wp-timeline-preview-box .wtl-comment i, #wp-timeline-preview-box .wtl-author i,#wp-timeline-preview-box .wtl-meta-content-left i:before,#wp-timeline-preview-box .wtl-post-category .post-category a,#wp-timeline-preview-box .wtl-meta-content-left i,#wp-timeline-preview-box .wtl-post-tags i,#wp-timeline-preview-box span.author-name a i,#wp-timeline-preview-box .wtl-wrapper-like a,#wp-timeline-preview-box .comments-link,#wp-timeline-preview-box .wtl-post-date a,#wp-timeline-preview-box .author a{color: " + $template_ftcolor + " !important;}";
                $style += "#wp-timeline-preview-box .wtl-author a:hover,#wp-timeline-preview-box .wtl-post-category a:hover,#wp-timeline-preview-box .wtl-post-tags a:hover,#wp-timeline-preview-box .wtl-comment a:hover,#wp-timeline-preview-box .mcomments a:hover,#wp-timeline-preview-box .schedule_wrapper .post-meta a:hover,#wp-timeline-preview-box .schedule_wrapper .wtl-post-category a:hover,#wp-timeline-preview-box .schedule_wrapper .tags a:hover,#wp-timeline-preview-box .schedule_wrapper .wtl-has-links a:hover,#wp-timeline-preview-box .schedule_wrapper .post-author a:hover,#wp-timeline-preview-box .schedule_wrapper .date-meta a:hover,#wp-timeline-preview-box .author-name a:hover,#wp-timeline-preview-box .metacomments a.comments-link:hover,#wp-timeline-preview-box .wtl-schedule-button:hover,#wp-timeline-preview-box .wtl-post-category a:hover,#wp-timeline-preview-box .label_featured_post span:hover,#wp-timeline-preview-box .meta-archive a:hover,#wp-timeline-preview-box .meta-archive:hover #wp-timeline-preview-box .wtl-author-name a:hover,#wp-timeline-preview-box .meta-comment a:hover,#wp-timeline-preview-box .post-meta:hover #wp-timeline-preview-box .wtl-author:hover,#wp-timeline-preview-box .wtl-author-name:hover,#wp-timeline-preview-box .meta-comment:hover,#wp-timeline-preview-box .wtl-wrapper-like .wtl-count:hover,#wp-timeline-preview-box .schedule-time:hover,#wp-timeline-preview-box .schedule-time a:hover,#wp-timeline-preview-box .wtl-post-category:hover,#wp-timeline-preview-box .wtl-meta-comment i:hover,#wp-timeline-preview-box .wtl-post-category a:hover,#wp-timeline-preview-box .wtl-post-tags a:hover,#wp-timeline-preview-box .author-name a:hover#wp-timeline-preview-box .wtl-post-date a:hover,#wp-timeline-preview-box .wtl-author a:hover{color: " + $fthover + " !important;}";
                $style += "#wp-timeline-preview-box .wtl-attract-post-content span.category-link,#wp-timeline-preview-box .wtl-post-category,#wp-timeline-preview-box .wtl-post-category,#wp-timeline-preview-box .wtl-attract-post-content span.category-link,#wp-timeline-preview-box .wtl-main-social-cat-content,#wp-timeline-preview-box .wtl-post-category .category-link a,#wp-timeline-preview-box .wtl-post-category .category-link .link-lable,#wp-timeline-preview-box .wtl-post-category .category-link,#wp-timeline-preview-box .blog_template.wise_block_blog .wtl_blog_wraper,#wp-timeline-preview-box .post-category,#wp-timeline-preview-box .wtl-post-category a,#wp-timeline-preview-box .columy_layout .post-tag-inner{background: " + $template_categorybgcolor + " !important;}";
                $style += "#wp-timeline-preview-box .wtl-post-title a,#wp-timeline-preview-box .wtl_blog_template .wtl-post-title a,#wp-timeline-preview-box .wtl_blog_template .wtl-post-title,#wp-timeline-preview-box .wtl-fl-box .wtl-post-title a,#wp-timeline-preview-box .wtl-fl-box .wtl-post-title,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .label_featured_post span,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .desc h3,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .desc h3 a,#wp-timeline-preview-box .horizontal .wtl-post-title,#wp-timeline-preview-box .horizontal .wtl-post-title > a,#wp-timeline-preview-box .horizontal .overlay_horizontal .post-content-area .wtl-post-title,#wp-timeline-preview-box .horizontal .overlay_horizontal .post-content-area .wtl-post-title a{font-family: " + $template_titlefontface + ";}";
                $style += "#wp-timeline-preview-box .horizontal .wtl-mdate, #wp-timeline-preview-box .horizontal .wtl-mdate a, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate a, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate i, #wp-timeline-preview-box .horizontal .blog_footer .tags.tag_link, #wp-timeline-preview-box .horizontal .blog_footer .tags a, #wp-timeline-preview-box .horizontal .blog_footer .categories a, #wp-timeline-preview-box .horizontal .mauthor, #wp-timeline-preview-box .horizontal .mdate i, #wp-timeline-preview-box .horizontal .mauthor i, #wp-timeline-preview-box .horizontal .mcomments i, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate a, #wp-timeline-preview-box .horizontal .mdate i, #wp-timeline-preview-box .horizontal .mauthor i, #wp-timeline-preview-box .horizontal .mcomments i, #wp-timeline-preview-box .horizontal .tags, #wp-timeline-preview-box .horizontal .categories i, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate, #wp-timeline-preview-box .horizontal .metadatabox, #wp-timeline-preview-box .horizontal .blog_footer, #wp-timeline-preview-box .metadatabox, #wp-timeline-preview-box .metadatabox a, #wp-timeline-preview-box .wtl-schedule-meta-content, #wp-timeline-preview-box .wtl-schedule-meta-content a, #wp-timeline-preview-box .wtl-post-date, #wp-timeline-preview-box.top_divide_layout span.wtl-comment, #wp-timeline-preview-box .wtl-post-date a.mdate, #wp-timeline-preview-box .wtl-post-date a, #wp-timeline-preview-box .wtl-post-date time, #wp-timeline-preview-box .wtl-post-category, #wp-timeline-preview-box .wtl-post-category a, #wp-timeline-preview-box .wtl-post-tags, #wp-timeline-preview-box .wtl-post-tags span, #wp-timeline-preview-box .wtl-post-tags a, #wp-timeline-preview-box .mcomments i, #wp-timeline-preview-box .comments-link, #wp-timeline-preview-box .author-name, #wp-timeline-preview-box .wtl-author, #wp-timeline-preview-box .author-name, #wp-timeline-preview-box .author-name a, #wp-timeline-preview-box .wtl_comment_count, #wp-timeline-preview-box .wtl_comment_count a, #wp-timeline-preview-box .wtl_blog_template .link-lable, #wp-timeline-preview-box .wtl-author a{font-size: " + $meta_fontsize + "px !important; font-weight: " + $meta_font_weight +"; line-height: " + $meta_font_line_height + "; text-transform: " + $meta_font_text_transform + "; text-decoration: " + $meta_font_text_decoration + "; letter-spacing: " + $meta_font_letter_spacing + "px;}";
                if ($meta_font_italic == 1) {
                    $style += "#wp-timeline-preview-box .horizontal .wtl-mdate, #wp-timeline-preview-box .horizontal .wtl-mdate a, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate a, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate i, #wp-timeline-preview-box .horizontal .blog_footer .tags.tag_link, #wp-timeline-preview-box .horizontal .blog_footer .tags a, #wp-timeline-preview-box .horizontal .blog_footer .categories a, #wp-timeline-preview-box .horizontal .mauthor, #wp-timeline-preview-box .horizontal .mdate i, #wp-timeline-preview-box .horizontal .mauthor i, #wp-timeline-preview-box .horizontal .mcomments i, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate a, #wp-timeline-preview-box .horizontal .mdate i, #wp-timeline-preview-box .horizontal .mauthor i, #wp-timeline-preview-box .horizontal .mcomments i, #wp-timeline-preview-box .horizontal .tags, #wp-timeline-preview-box .horizontal .categories i, #wp-timeline-preview-box .horizontal .wtl-post-title .mdate, #wp-timeline-preview-box .horizontal .metadatabox, #wp-timeline-preview-box .horizontal .blog_footer, #wp-timeline-preview-box .metadatabox, #wp-timeline-preview-box .metadatabox a, #wp-timeline-preview-box .wtl-schedule-meta-content, #wp-timeline-preview-box .wtl-schedule-meta-content a, #wp-timeline-preview-box .wtl-post-date, #wp-timeline-preview-box.top_divide_layout span.wtl-comment, #wp-timeline-preview-box .wtl-post-date a.mdate, #wp-timeline-preview-box .wtl-post-date a, #wp-timeline-preview-box .wtl-post-date time, #wp-timeline-preview-box .wtl-post-category, #wp-timeline-preview-box .wtl-post-category a, #wp-timeline-preview-box .wtl-post-tags, #wp-timeline-preview-box .wtl-post-tags span, #wp-timeline-preview-box .wtl-post-tags a, #wp-timeline-preview-box .mcomments i, #wp-timeline-preview-box .comments-link, #wp-timeline-preview-box .author-name, #wp-timeline-preview-box .wtl-author, #wp-timeline-preview-box .author-name, #wp-timeline-preview-box .author-name a, #wp-timeline-preview-box .wtl_comment_count, #wp-timeline-preview-box .wtl_comment_count a, #wp-timeline-preview-box .wtl_blog_template .link-lable, #wp-timeline-preview-box .wtl-author a{font-style: italic;}";
                }
                $style += "#wp-timeline-preview-box .date-meta a.mdate,#wp-timeline-preview-box .wtl-date-top,#wp-timeline-preview-box .wtl-date-top a,#wp-timeline-preview-box .wtl-date-title,#wp-timeline-preview-box .wtl-date-title a,#wp-timeline-preview-box .wtl-post-date,#wp-timeline-preview-box .wtl-post-date a,#wp-timeline-preview-box .wtl-post-date time,#wp-timeline-preview-box .wtl-post-date a.mdate,#wp-timeline-preview-box .wtl-post-date span{font-size: " + $date_fontsize + "px !important; font-weight: " + $date_font_weight +"; line-height: " + $date_font_line_height + "; text-transform: " + $date_font_text_transform + "; text-decoration: " + $date_font_text_decoration + "; letter-spacing: " + $date_font_letter_spacing + "px;}";
                if($date_font_italic == 1){
                    $style += "#wp-timeline-preview-box .date-meta a.mdate,#wp-timeline-preview-box .wtl-date-top,#wp-timeline-preview-box .wtl-date-top a,#wp-timeline-preview-box .wtl-date-title,#wp-timeline-preview-box .wtl-date-title a,#wp-timeline-preview-box .wtl-post-date,#wp-timeline-preview-box .wtl-post-date a,#wp-timeline-preview-box .wtl-post-date time,#wp-timeline-preview-box .wtl-post-date a.mdate,#wp-timeline-preview-box .wtl-post-date span{font-style: italic;}";
                }
                $style += "#wp-timeline-preview-box .wtl_is_horizontal .wtl_al_nav .wtl-blog-img img,#wp-timeline-preview-box .wtl-schedule-wrap .wtl_year span,#wp-timeline-preview-box .wtl_year,#wp-timeline-preview-box .wtl-post-center-image,#wp-timeline-preview-box .wtl-post-center-image span,#wp-timeline-preview-box .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format,#wp-timeline-preview-box .wtl_steps_post_format i:before,#wp-timeline-preview-box .wtl_blog_template .wtl_steps .wtl_blog_single_post_wrapp .wtl_steps_post_format,#wp-timeline-preview-box .wtl_steps_post_format i:before{border-radius: " + $template_icon_border_radious + "%!important}";
                $style += "#wp-timeline-preview-box .wtl_blog_template .blog-wrap.odd_class .post_content_wrap:after,#wp-timeline-preview-box .wtl_blog_template .blog-wrap.odd_class .post_content_wrap::before,#wp-timeline-preview-box .blog-wrap .datetime,#wp-timeline-preview-box .blog_template .timeline_bg_wrap:before,#wp-timeline-preview-box .blog_template.wtl_blog_template.blog-wrap .post_hentry:before,#wp-timeline-preview-box .blog_template.wtl_blog_template.blog-wrap.odd_class .post_content_wrap:after,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline.blog-wrap.odd_class .post_content_wrap:before,#wp-timeline-preview-box .blog_template.wtl_blog_template.blog-wrap.even_class .post_content_wrap:after,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline.blog-wrap.even_class .post_content_wrap:before{background: " + $template_color + " !important}";
                if ($title_alignment == "left") {
                    $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-post-title{text-align:" + $title_alignment + " !important;}";
                }
                if ($title_alignment == "center") {
                    $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-post-title{text-align:" + $title_alignment + " !important;}";
                }
                if ($title_alignment == "right") {
                    $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-post-title{text-align:" + $title_alignment + " !important;}";
                }
                $style += "#wp-timeline-preview-box .wtl-schedule-wrap .wtl_steps_wrap,#wp-timeline-preview-box .wtl-schedule-wrap .wtl-schedule-post-content#wp-timeline-preview-box .wtl-post-title a,#wp-timeline-preview-box .wtl_blog_template .wtl-post-title a,#wp-timeline-preview-box .wtl_blog_template .wtl-post-title,#wp-timeline-preview-box .wtl-fl-box .wtl-post-title a,#wp-timeline-preview-box .wtl-fl-box .wtl-post-title{color: " + $template_titlecolor + " !important;}";
                $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-post-title a:hover,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .desc h3:hover a,#wp-timeline-preview-box .horizontal .wtl-post-title > a:hover,#wp-timeline-preview-box #content .logbook.flatLine a.lb-line-node.active,#wp-timeline-preview-box .logbook.flatLine a.lb-line-node.active,#wp-timeline-preview-box .overlay_horizontal .wtl-post-title a:hover,#wp-timeline-preview-box .schedule_wrapper .wtl-post-title a:hover,#wp-timeline-preview-box .schedule_wrapper .wtl-read-more .more-tag:hover{color: " + $template_titlehovercolor + " !important;}";
                $style += "#wp-timeline-preview-box .processinfo_layout .wtl_blog_template .wtl-count{color: " + $template_title_count_color + " !important; font-size: " + $template_title_count_fontsize + "px !important;}";
                $style += "#wp-timeline-preview-box .processinfo_layout .wtl_blog_template .wtl-post-title,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .desc h3,#wp-timeline-preview-box .horizontal .wtl-post-title{background: " + $template_titlebackcolor + " !important;}";
                $style += "#wp-timeline-preview-box .wtl-read-more-div a.more-tag,#wp-timeline-preview-box .wtl_blog_template a.wtl-read-more:hover,#wp-timeline-preview-box .blog_template .wtl-read-more-div a.wtl-read-more:hover,#wp-timeline-preview-box .blog_template .wtl-read-more-div a.more-tag:hover,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .label_featured_post span:hover,#wp-timeline-preview-box .wtl_blog_template.timeline a.more-tag:hover,#wp-timeline-preview-box .horizontal a.wtl-read-more :hover,#wp-timeline-preview-box .horizontal .label_featured_post span:hover,#wp-timeline-preview-box .overlay_horizontal a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template.schedule a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template.accordion a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template.media-grid .wtl-post-image .category-link a:hover,#wp-timeline-preview-box .wtl-post-tags a:hover,#wp-timeline-preview-box .wtl_blog_template.media-grid .wtl-post-image .category-link a{color: " + $template_readmorehovercolor + "; background: " + $template_readmore_hover_backcolor + ";}";
                $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-read-more-div a.more-tag,#wp-timeline-preview-box .timeline .read_more a.more-tag,#wp-timeline-preview-box .wtl_blog_template .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .overlay_horizontal .wtl-read-more-div a.more-tag {border-left:" + $wp_timeline_readmore_button_borderleft + "px " + $read_more_button_border_style + " " + $wp_timeline_readmore_button_borderleftcolor + ";border-right:" + $wp_timeline_readmore_button_borderright + "px " + $read_more_button_border_style + " " + $wp_timeline_readmore_button_borderrightcolor + ";border-top:"+ $wp_timeline_readmore_button_bordertop + "px " + $read_more_button_border_style + " " + $wp_timeline_readmore_button_bordertopcolor + ";border-bottom:"+ $wp_timeline_readmore_button_borderbottom + "px " + $read_more_button_border_style + " " + $wp_timeline_readmore_button_borderbottomcolor + ";}";
                $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-read-more-div a.more-tag:hover,#wp-timeline-preview-box .timeline .read_more a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template .wtl-read-more-div a.wtl-read-more:hover,#wp-timeline-preview-box .overlay_horizontal .wtl-read-more-div a.more-tag:hover {border-left:" + $wp_timeline_readmore_button_hover_borderleft + "px " + $read_more_button_hover_border_style + " " + $wp_timeline_readmore_button_hover_borderleftcolor + ";border-right:" + $wp_timeline_readmore_button_hover_borderright + "px " + $read_more_button_hover_border_style + " " + $wp_timeline_readmore_button_hover_borderrightcolor + ";border-top:"+ $wp_timeline_readmore_button_hover_bordertop + "px " + $read_more_button_hover_border_style + " " + $wp_timeline_readmore_button_hover_bordertopcolor + ";border-bottom:"+ $wp_timeline_readmore_button_hover_borderbottom + "px " + $read_more_button_hover_border_style + " " + $wp_timeline_readmore_button_hover_borderbottomcolor + ";}";
                $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .wtl-read-more-div a.more-tag,#wp-timeline-preview-box .read_more a.more-tag{padding-top: " + $readmore_button_paddingtop + "px; padding-bottom: " + $readmore_button_paddingbottom + "px; padding-right: " + $readmore_button_paddingright + "px; padding-left: " + $readmore_button_paddingleft + "px;}";
                $style += "#wp-timeline-preview-box .wtl-read-more-div a.more-tag,#wp-timeline-preview-box .wtl_blog_template a.wtl-read-more:hover,#wp-timeline-preview-box .blog_template .wtl-read-more-div a.wtl-read-more:hover,#wp-timeline-preview-box .blog_template .wtl-read-more-div a.more-tag:hover,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .label_featured_post span:hover,#wp-timeline-preview-box .wtl_blog_template.timeline a.more-tag:hover,#wp-timeline-preview-box .horizontal a.wtl-read-more :hover,#wp-timeline-preview-box .horizontal .label_featured_post span:hover,#wp-timeline-preview-box .overlay_horizontal a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template.schedule a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template.accordion a.more-tag:hover,#wp-timeline-preview-box .wtl_blog_template.media-grid .wtl-post-image .category-link a:hover,#wp-timeline-preview-box .wtl-post-tags a:hover,#wp-timeline-preview-box .wtl_blog_template.media-grid .wtl-post-image .category-link a{font-size: " + $readmore_fontsize + "; font-weight: " + $readmore_font_weight + "; line-height: " + $readmore_font_line_height + "; text-transform: " + $readmore_font_text_transform + "; text-decoration: " + $readmore_font_text_decoration + "; letter-spacing: " + $readmore_font_letter_spacing + ";}";

                if($firstletter_big == 1){
                    $style += "#wp-timeline-preview-box .wtl_blog_template div.post-content > *:first-child:first-letter,#wp-timeline-preview-box .wtl_blog_template div.post-content > p:first-child:first-letter,#wp-timeline-preview-box .wtl_blog_template div.post-content:first-letter,#wp-timeline-preview-box .wtl_blog_template div.post_content > *:first-child:first-letter,#wp-timeline-preview-box .wtl_blog_template div.post_content > p:first-child:first-letter,#wp-timeline-preview-box .wtl_blog_template div.post_content:first-letter ,#wp-timeline-preview-box .wtl-first-letter,#wp-timeline-preview-box .wp-timeline-first-letter{font-size: " + $firstletter_fontsize + " !important; color: " + $firstletter_contentcolor + " !important;}";
                }
                $style += "#wp-timeline-preview-box .wtl_blog_template .wtl-post-content,#wp-timeline-preview-box .wtl_blog_template .wtl-post-content p,#wp-timeline-preview-box .wtl-fl-box .wtl-post-content,#wp-timeline-preview-box .wtl-fl-box .wtl-post-content p,#wp-timeline-preview-box .wtl_blog_template .upper_image_wrapper blockquote p,#wp-timeline-preview-box .wtl_blog_template .upper_image_wrapper blockquote,#wp-timeline-preview-box .wtl_blog_template .upper_image_wrapper blockquote:before{color: " + $template_contentcolor + " !important; font-family: " + $content_font_family + ";}";
                if($content_font_italic == 1){
                    $style += "#wp-timeline-preview-box .wtl-post-content,#wp-timeline-preview-box .wtl_blog_template .wtl-post-content,#wp-timeline-preview-box .wtl_blog_template .label_featured_post,#wp-timeline-preview-box .wtl_blog_template .label_featured_post span,#wp-timeline-preview-box .wtl_blog_template .wtl-post-content p,#wp-timeline-preview-box .wtl-fl-box .wtl-post-content,#wp-timeline-preview-box .wtl-fl-box .wtl-post-content p{font-style: italic;}";
                }
                $style += "#wp-timeline-preview-box .wtl-post-content,#wp-timeline-preview-box .wtl_blog_template .wtl-post-content,#wp-timeline-preview-box .wtl_blog_template .label_featured_post,#wp-timeline-preview-box .wtl_blog_template .label_featured_post span,#wp-timeline-preview-box .wtl_blog_template .wtl-post-content p,#wp-timeline-preview-box .wtl-fl-box .wtl-post-content,#wp-timeline-preview-box .wtl-fl-box .wtl-post-content p{font-size:" + $content_fontsize + " !important; font-weight: " + $content_font_weight + " !important; line-height: " + $content_font_line_height + " !important; text-transform: " + $content_font_text_transform + " !important; text-decoration: " + $content_font_text_decoration + " !important; letter-spacing: " + $content_font_letter_spacing + " !important;}";
                
                if($readmore_button_alignment == "left" )
                {
                    $style += "#wp-timeline-preview-box .wtl-read-more-div,#wp-timeline-preview-box .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .entity-content-right .wtl-read-more-div a.wtl-read-more{text-align : " + $readmore_button_alignment +"; float : " + $readmore_button_alignment +";}";
                }
                if($readmore_button_alignment == "left" )
                {
                    $style += "#wp-timeline-preview-box .wtl-read-more-div,#wp-timeline-preview-box .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .entity-content-right .wtl-read-more-div a.wtl-read-more{text-align : " + $readmore_button_alignment +";}";
                }
                if($readmore_button_alignment == "left" )
                {
                    $style += "#wp-timeline-preview-box .wtl-read-more-div,#wp-timeline-preview-box .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .post_even .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .wtl_blog_template .entity-content-right .wtl-read-more-div a.wtl-read-more{text-align : " + $readmore_button_alignment +"; float : " + $readmore_button_alignment +";}";
                }
                $style += "#wp-timeline-preview-box .wtl-read-more-div a.more-tag,#wp-timeline-preview-box .wtl_blog_template a.wtl-read-more,#wp-timeline-preview-box .blog_template .wtl-read-more-div a.wtl-read-more,#wp-timeline-preview-box .blog_template .wtl-read-more-div a.more-tag,#wp-timeline-preview-box .blog_template.wtl_blog_template.timeline .label_featured_post span,#wp-timeline-preview-box .wtl_blog_template.timeline a.more-tag,#wp-timeline-preview-box .horizontal a.wtl-read-more ,#wp-timeline-preview-box .horizontal .label_featured_post span,#wp-timeline-preview-box .overlay_horizontal a.more-tag,#wp-timeline-preview-box .wtl_blog_template.schedule a.more-tag,#wp-timeline-preview-box .wtl_blog_template.accordion a.more-tag,#wp-timeline-preview-box .wtl_blog_template.media-grid .wtl-post-image .category-link a,#wp-timeline-preview-box .wtl-post-tags a,#wp-timeline-preview-box .wtl_blog_template.media-grid .wtl-post-image .category-link a{color: " + $template_readmorecolor + "; background: " + $template_readmorebackcolor + "}";

                $style += "#wp-timeline-preview-box .wp-timeline-post-image .lazyload,#wp-timeline-preview-box .wp-timeline-post-image .lazyloading,#wp-timeline-preview-box .post-image .lazyload,#wp-timeline-preview-box .post-image .lazyloading{background-color: " + $template_lazyload_color + ";}";

                $style += "#wp-timeline-preview-box .logbook .lb-line div#lb_line_left:after, #wp-timeline-preview-box .logbook .lb-line #lb_line_right:after, #wp-timeline-preview-box .divide_layout span.wtl-post-content-ss-right i, #wp-timeline-preview-box .divide_layout span.wtl-post-content-ss-left i, #wp-timeline-preview-box .wtl_al_nav .fa-angle-left, #wp-timeline-preview-box wtl-author-name.wtl_al_nav .fa-angle-right { font-size: " + $navigation_arrow_size + "px ; color: "+ $navigation_color +" !important; background: "+ $navigation_bg_color +" !important; } ";

                $style += "#wp-timeline-preview-box .wtl_is_horizontal .wtl-ss-right i, #wp-timeline-preview-box .wtl_is_horizontal .wtl-ss-left i { font-size: " + $navigation_arrow_size + "px ; color: "+ $navigation_color +" !important; background: "+ $navigation_bg_color +" !important; } ";

                $style += "#wp-timeline-preview-box .wtl_is_horizontal .wtl_progress-circle:after { border-color: "+ $navigation_bg_color +" !important; } ";

                $style += "#wp-timeline-preview-box .wtl_steps_wrap:before { background: "+ $navigation_bg_color +" !important; } ";

                $style += "#wp-timeline-preview-box :not(.filledtimeline) .wtl_steps_post_format i:before, #wp-timeline-preview-box :not(.filledtimeline) .wtl_steps_post_format i:before, #wp-timeline-preview-box span.wtl-post-content-ss-left i:hover, #wp-timeline-preview-box span.wtl-post-content-ss-right i:hover { color: "+ $navigation_color +" !important; background: "+ $navigation_bg_color +" !important; } ";

                $style += "#wp-timeline-preview-box .top_divide_layout .wtl-ss-right i, #wp-timeline-preview-box .top_divide_layout .wtl-ss-left i, #wp-timeline-preview-box .wtl-ss-right i, #wp-timeline-preview-box .wtl-ss-left i, #wp-timeline-preview-box .wtl_al_slider span.wtl-ss-left i, #wp-timeline-preview-box .wtl_al_slider span.wtl-ss-right i, #wp-timeline-preview-box .wtl_al_nav .wtl-ss-right i, #wp-timeline-preview-box .wtl_al_nav .wtl-ss-left i { font-size: " + $navigation_arrow_size + "px ; color: "+ $navigation_color +" !important; } ";

                $style += "#wp-timeline-preview-box .wtl_is_horizontal .wtl_al_nav .slick-track:before { border-color: "+ $navigation_color +" !important; } ";


                if (jQuery("#template_titlefontface_font_type").val() == "Google Fonts" && $template_titlefontface != "") {
                    var font_family_link = bdpro_js.bdp_font_base + "fonts.googleapis.com/css?family=" + $template_titlefontface;
                    
                    jQuery("head").append(
                        '<link type="text/css" class="bdp_google_font_link" rel="stylesheet" href="' + font_family_link + '">'
                    );
                }
                if (jQuery("#content_font_family").val() == "Google Fonts" && $content_font_family != "") {
                    var font_family_link = bdpro_js.bdp_font_base + "fonts.googleapis.com/css?family=" + $content_font_family;
                    
                    jQuery("head").append(
                        '<link type="text/css" class="bdp_google_font_link" rel="stylesheet" href="' + font_family_link + '">'
                    );
                }
                
                jQuery('head').append('<link rel="stylesheet" id="wtl-template-main-css" type="text/css" href="' + href + '">');
                jQuery('head').append('<link rel="stylesheet" id="wtl-theme-style" type="text/css" href="' + style_path + '">');
                jQuery('head').append('<script type="text/javascript" id="wtl-admin-flexslider-js" src="' + flexslider_js + '">');
                jQuery('head').append('<link rel="stylesheet" id="wtl-admin-flexslider-css" type="text/css" href="' + flexslider_css + '">');
                jQuery('head').append('<link rel="stylesheet" id="wtl-front-style" type="text/css" href="' + front_href + '">');
                jQuery('head').append('<script type="text/javascript" id="wtl-admin-masonry-js" src="' + masonry_js + '">');
                jQuery('head').append('<script type="text/javascript" id="wtl-admin-imagesloaded-js" src="'+ imagesLoaded_js +'">');
                jQuery("head").append('<style type="text/css" id="template-dynamic-style" >' + $style + "</style>");

                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'wtl_preview_request',
                        settings: data,
                        wtlid: wtl_id,
                    },
                    success: function (response) {
                        var l = jQuery('.masonry').length;
                        if (jQuery('.masonry').length > 0) {
                            setTimeout(
                                function() {
                                    jQuery('.masonry').imagesLoaded(
                                        function() {
                                            jQuery('.masonry').masonry({
                                                columnWidth: 0,
                                                itemSelector: '.blog_masonry_item',
                                                isResizable: true
                                            });
                                        }
                                    );
                                },
                                500
                            );
                        }
                        jQuery('#wp-timeline-preview-box').html(response).dialog({
                            title: wp_timeline_js.template_preview,
                            dialogClass: 'wtl_template_preview_model',
                            width: jQuery(window).width() - 216,
                            height: jQuery(window).height() - 100,
                            modal: true,
                            draggable: false,
                            resizable: false,
                            open: function (event, ui) {
                                setTimeout(function () { }, 5000);
                            },
                            close: function (event, ui) {
                                jQuery("#wtl-template-main-css").remove();
                                jQuery("#bdp-template-main-css").remove();
                                jQuery("#wtl-theme-style").remove();
                                jQuery("#bdp-front-style").remove();
                                jQuery("#bdp-front-rtl-style").remove();
                                jQuery("#bdp-admin-masonary-effect").remove();
                                jQuery("#bdp-admin-image-effect").remove();
                                jQuery("#bdp-admin-flexslider-js").remove();
                                jQuery("#bdp-admin-flexslider-css").remove();
                                jQuery("body.blog-designer_page_bdp_add_archive_layout")
                                  .css("position", "unset")
                                  .css("overflow", "visible");
                            },
                        });
                        $(".popup_id").click(function(e) {
                            e.preventDefault();
                            var id = $(this).data('id');
                            $('#' + id).fadeIn($(this).data());
                        });
                    
                        $(".js-modal-close").click(function(e) {
                            e.preventDefault();
                            $(".modal-box").fadeOut(500);
                        });
                        if ($('.wtl-flexslider.flexslider').length > 0) {
                            $('.wtl-flexslider.flexslider').flexslider({ animation: "slide", controlNav: false, prevText: "", nextText: "", rtl: wp_timeline_js.is_rtl });
                        }
                        if (typeof AOS != "undefined") {
                            AOS.init({ startEvent: 'DOMContentLoaded' });
                        }
                        if (typeof AOS != "undefined") {
                            AOS.init();
                        }
                        can_preview = 1;
                        jQuery('.splash-screen').hide();

                    }
                });
            }
        });
    },
   
};


jQuery(document).ready(function () {
    (function ($) {

        wtladmin.init();
        /** disanle link  */
        wtladmin.disable_link_chk();
        $('.buttonset').buttonset();

        /** Click on Save button  */
        $("#wp-timeline-btn-show-submit").click(function () {
            $(".bloglyout_savebtn").trigger("click")
        });
        $(".wp-timeline-reset-data").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            wtladmin.reset_layout_to_default();
            setTimeout(function () {
                $(".bloglyout_savebtn").trigger("click");
            }, 3000);
        });

        /* Apply Chosen Script on select */
        $(".wp-timeline-settings-wrappers .wp-timeline-settings li select:not(.chosen-select)").wrap("<div class='select-cover'></div>");
        $(".chosen-select").chosen();
        $(".select-cover select").chosen({ no_results_text: "Oops, nothing found!" });
        wtladmin.template_search();
        wtladmin.setOptionVisibility($(".wp_timeline_template_name").val());
        /** Color preset change event  */
        wtladmin.controls_preset();
        /** Code mirror add on custom css */
        wtladmin.custom_css();
        /** Select layout  */
        wtladmin.setLayout();
        /** Click on setting tab */
        wtladmin.onTabClick();
        /** Font size apply slider */
        wtladmin.applySettings();
        /** Upload image */
        wtladmin.uploadImage();
        /** sort filter pagination  */
        wtladmin.sortFilterPageination();
        /** Select post type  */
        wtladmin.selectPostType();
        /** Media Settings */
        wtladmin.mediaSettings();
        wtladmin.horizontalSetting();
        wtladmin.socialShare();
        wtladmin.read_more_inline();


        wptimelinejs.init();
        wtladmin.hide_field_for_layout();
        wtladmin.timeline_style_view();
        wtladmin.post_image_hover_effect();

        if ($('input[name="advance_contents"]:checked').val() == 1) {
            $('.advance_contents_tr.advance_contents_settings').show();
        } else {
            $('.advance_contents_tr.advance_contents_settings').hide();
        }
    }(jQuery))
});

var wptimelinejs = {
    init: function () {
        $ = jQuery;
        wptimelinejs.post_auto_slug();
    },
    post_auto_slug: function () {
        if ($('#cpt_icon_type_1').is(':checked')) { $('.wtl_cpt_icon_wordpress').show(); }
        if ($('#cpt_icon_type_2').is(':checked')) { $('.wtl_cpt_icon_custom').show(); }

        $('#cpt_icon_type_1, #cpt_icon_type_2').on('change', function () {
            if ($('#cpt_icon_type_1').is(':checked')) {
                $('.wtl_cpt_icon_wordpress').show();
                $('.wtl_cpt_icon_custom').hide()
            }
            if ($('#cpt_icon_type_2').is(':checked')) {
                $('.wtl_cpt_icon_custom').show();
                $('.wtl_cpt_icon_wordpress').hide()
            }
        });
        $('.li_cpt_category_name,.li_cpt_category_slug,.li_cpt_tag_name,.li_cpt_tag_slug').hide();


        if ($('#cpt_category_1').is(':checked')) { $('.li_cpt_category_name,.li_cpt_category_slug').show() }
        if ($('#cpt_category_0').is(':checked')) { $('.li_cpt_category_name,.li_cpt_category_slug').hide() }

        $('#cpt_category_1,#cpt_category_0').on('change', function () {
            if ($('#cpt_category_1').is(':checked')) { $('.li_cpt_category_name,.li_cpt_category_slug').show() }
            if ($('#cpt_category_0').is(':checked')) { $('.li_cpt_category_name,.li_cpt_category_slug').hide() }
        });

        if ($('#cpt_taxonomy_tag_1').is(':checked')) { $('.li_cpt_tag_name,.li_cpt_tag_slug').show() }
        if ($('#cpt_taxonomy_tag_0').is(':checked')) { $('.li_cpt_tag_name,.li_cpt_tag_slug').hide() }

        $('#cpt_taxonomy_tag_1,#cpt_taxonomy_tag_0').on('change', function () {
            if ($('#cpt_taxonomy_tag_1').is(':checked')) { $('.li_cpt_tag_name,.li_cpt_tag_slug').show() }
            if ($('#cpt_taxonomy_tag_0').is(':checked')) { $('.li_cpt_tag_name,.li_cpt_tag_slug').hide() }
        });
    },
    disable_tab: function ($template, $tabs) {
        $ = jQuery;
        if ($.inArray($('.wp_timeline_template_name').val(), $template) !== -1) {
            $('.wp-timeline-setting-handle li').each(function () {
                var hide = $(this).attr('data-show');
                if (hide == $tabs) {
                    $(this).addClass('clickDisable');
                }
            });
        }
    },
};

jQuery(document).ready(function ($) {
    $(document).on('click', '.wtl-accordion-head-content > h2', (function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .siblings(".wtl-accordion-inner")
                .slideUp(200);

        } else {
            $(".wtl-accordion-head-content > h2").removeClass("active");
            $(this).addClass("active");
            $(".wtl-accordion-inner").slideUp(200);
            $(this)
                .siblings(".wtl-accordion-inner")
                .slideDown(200);
        }
    }));
    $(document).on('click', '.wtl-collapsible-head-content > h2', (function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .siblings(".wtl-collapsible-inner")
                .slideUp(200);

        } else {
            $(".wtl-collapsible-head-content > h2").removeClass("active");
            $(this).addClass("active");
            $(".wtl-collapsible-inner").slideUp(200);
            $(this)
                .siblings(".wtl-collapsible-inner")
                .slideDown(200);
        }
    }));
    // $(document).on('click', '.wtl_template_preview_model .ui-dialog-titlebar-close', (function () {
    //     location.reload();
    // }));
    if ($("input[name='rss_use_excerpt']:checked").val() == 1) {
        $('.read_more_wrap').show();
    } else {
        $('.read_more_wrap').hide();
    }
    if ($("input[name='read_more_link']:checked").val() == 1) {
        $('.read_more_wrap').show();
    } else {
        $('.read_more_wrap').hide();
    }
    if( 'cover_layout' == $(".wp_timeline_template_name").val() ) {
        $('.temp-even-bg-color').hide();
    }
    if( 'divide_layout' == $(".wp_timeline_template_name").val() || 'leafty_layout' == $(".wp_timeline_template_name").val() || 'processinfo_layout' == $(".wp_timeline_template_name").val() || 'soft_block' == $(".wp_timeline_template_name").val() || 'cool_horizontal' == $(".wp_timeline_template_name").val() || 'overlay_horizontal' == $(".wp_timeline_template_name").val() ) {
        $('.temp-even-bg-color').hide();
        $('.temp-sportik-bg-color').hide();
    }
    if( 'fullhorizontal_layout' == $(".wp_timeline_template_name").val() ) {
        $('.timeline_animation.timeline_style').hide();
    } else {
        $('.timeline_animation.timeline_style').show();
    }

    if( 0 == $("input[name='rss_use_excerpt']:checked").val() ) {
        $('.read_more_wrap').hide();
    } else {
        $('.read_more_wrap').show();
    }
});

var addClassOnScroll = function () {
    var windowTop = jQuery(window).scrollTop();
    jQuery('.wtl-schedule-post-content .wtl_year, .wtl_blog_template.media-grid, .wtl_blog_single_post_wrapp, .wtl-blog-curve-timeline-inner .wtl-schedule-post-content, .filledtimeline .wtl-schedule-post-content, .fullwidth_layout_cover .wtl-schedule-post-content, .wtl-schedule-post-content.wtl_template_hire_layout, .infographic_layout_cover .wtl-schedule-post-content, .schedule.wtl_single_post_wrapp, .soft-block-post-wrapper.wtl_single_post_wrapp, .story.blog-wrap, .vertical_blur_layout .wtl-schedule-post-content, .zigzag_layout .wtl-schedule-post-content, .wise_block_blog.wtl_blog_single_post_wrapp').each(function (index, elem) {
        var offsetTop = jQuery(elem).offset().top;
        var outerHeight = jQuery(this).outerHeight(true);

        if( windowTop > (offsetTop - 50) && windowTop < ( offsetTop + outerHeight)) {
            var elemId = jQuery(elem).attr('id');
            jQuery(".wtl-bullets-container ul li a.active").removeClass('active');
            jQuery(".wtl-bullets-container ul li a[href='#" + elemId + "']").addClass('active');
        }
    });
};

// (function($) {

    // $(document).ready(function() {
    //     setupFade();
    //     setupClickToScroll();
    //     setupPostAnimation();
    //     setupScrollToTop();
    //     enableScrollAbortion();

    //     // Trigger window.scroll, this will initiate some of the scripts
    //     $('#wp-timeline-preview-box').scroll();
    // });


    // Allow user to cancel scroll animation by manually scrolling
    function enableScrollAbortion() {
        var $viewport = jQuery('html, body');
        $viewport.on('scroll mousedown DOMMouseScroll mousewheel keyup', function(e) {
            if (e.which > 0 || e.type === 'mousedown' || e.type === 'mousewheel') {
                $viewport.stop();
            }
        });
    }

    function setupScrollToTop() {
        var scrollSpeed = 500;
        jQuery('.trigger-scroll-to-top').click(function(e) {
            e.preventDefault();
            jQuery('html, body').animate({
                scrollTop: 0
            }, scrollSpeed);
        });
    }


    function setupPostAnimation() {
        var posts = jQuery('.filledtimeline .wtl-schedule-wrap .wtl-schedule-post-content');
        // jQuery(window).on('scroll resize', function() {

            var currScroll = jQuery(window).scrollTop() > jQuery(document).scrollTop() ? jQuery(window).scrollTop() : jQuery(document).scrollTop(),
                windowHeight = jQuery(window).height(), // Needs to be here because window can resize
                overScroll = Math.ceil(windowHeight * .20),
                treshhold = (currScroll + windowHeight) - overScroll;

            posts.each(function() {

                var post = jQuery(this),
                    postScroll = post.offset().top

                if (postScroll > treshhold) {
                    post.addClass('hiddentext');
                } else {
                    post.removeClass('hiddentext');
                }

            });

        // });
    }

    function setupFade() {

        var posts = jQuery('.filledtimeline .wtl-schedule-wrap .wtl-schedule-post-content').reverse(),
            stemWrapper = jQuery('.stem-wrapper'),
            stemWrappericon = jQuery('.stem-wrappericon'),
            halfScreen = jQuery(window).height() / 2;

        // jQuery(window).on('scroll resize', function() {
            delay(function() {

                var currScroll = jQuery(window).scrollTop() > jQuery(document).scrollTop() ? jQuery(window).scrollTop() : jQuery(document).scrollTop(),
                    scrollSplit = currScroll + halfScreen;

                posts.removeClass('topactive').each(function() {
                    var post = jQuery(this),
                        postOffset = post.offset().top;

                    if (scrollSplit > postOffset) {
                        post.addClass('topactive');
                    }
                });

                posts.removeClass('active').each(function() {

                    var post = jQuery(this),
                        postOffset = post.offset().top;

                    if (scrollSplit > postOffset) {

                        // Add active class to fade in
                        post.addClass('active');


                        // Get post color
                        var color = post.data('stem-color') ? post.data('stem-color') : null,
                            allColors = 'color-green color-yellow color-white'

                        stemWrapper.removeClass(allColors);
                        if (color !== null) {
                            stemWrapper.addClass('color-' + color);
                        }

                        var iconcolor = post.data('stem-color') ? post.data('stem-color') : null,
                            iconallColors = 'color-green color-yellow color-white'

                        stemWrappericon.removeClass(iconallColors);

                        if (iconcolor !== null) {
                            stemWrappericon.addClass('color-' + iconcolor);
                        }

                        return false;
                    }

                });
            }, 20);

        // });

    }


    function setupClickToScroll(post) {

        var scrollSpeed = 500;

        jQuery('.filledtimeline .wtl-schedule-wrap .wtl-schedule-post-content .wtl-post-center-image').click(function(e) {
            e.preventDefault();

            var icon = jQuery(this),
                post = icon.closest('.wtl-schedule-post-content'),
                postTopOffset = post.offset().top,
                postHeight = post.height(),
                halfScreen = jQuery(window).height() / 2,
                scrollTo = postTopOffset - halfScreen + (postHeight / 2);

            jQuery('html, body').animate({
                scrollTop: scrollTo
            }, scrollSpeed);
        });

    }

    jQuery.fn.reverse = function() {
        return this.pushStack(this.get().reverse(), arguments);
    };
    
    var delay = (function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

// })(jQuery);

jQuery.fn.timeline = function() {
    var selectors = {
        id: jQuery(this),
        item: jQuery(this).find(".wtl-schedule-post-content"),
        activeClass: "timeline-item--active",
        img: ".wtl-post-thumbnail img"
    };
    selectors.item.eq(0).addClass(selectors.activeClass);
    selectors.id.css(
        "background-image",
        "url(" + (selectors.item.first().find(selectors.img).attr("src")) + ")"
    );
    var itemLength = selectors.item.length;
    var max, min;
    var pos = jQuery(this).scrollTop();
    selectors.item.each(function(i) {
        min = jQuery(this).offset().top;
        max = jQuery(this).height() + jQuery(this).offset().top;
        var that = jQuery(this);
        if (i == itemLength - 2 && pos > min + jQuery(this).height() / 2) {
            selectors.item.removeClass(selectors.activeClass);
            selectors.id.css(
                "background-image",
                "url(" + selectors.item.last().find(selectors.img).attr("src") + ")"
            );
            selectors.item.last().addClass(selectors.activeClass);
        } else if (pos <= max - 80 && pos >= min) {
            selectors.id.css(
                "background-image",
                "url(" + jQuery(this).find(selectors.img).attr("src") + ")"
            );
            selectors.item.removeClass(selectors.activeClass);
            jQuery(this).addClass(selectors.activeClass);
        }
    });
};

jQuery(function () {
    jQuery('#wp-timeline-preview-box').on('scroll', function () {
        addClassOnScroll();
        setupFade();
        setupClickToScroll();
        setupPostAnimation();
        setupScrollToTop();
        enableScrollAbortion();
        if(jQuery('.wp_timeline_template_name').val() == 'verticalblur_layout') {
            jQuery(".wtl_wrapper.wp_timeline_post_list.schedule_cover").timeline();
        }
    });

    jQuery('<div class="input-type-number-nav"><div class="input-type-number-button input-type-number-up">+</div><div class="input-type-number-button input-type-number-down">-</div></div>').insertAfter(".input-type-number input");
      jQuery(".input-type-number").each(function () {
        var spinner = jQuery(this),
          input = spinner.find('input[type="number"]'),
          btnUp = spinner.find(".input-type-number-up"),
          btnDown = spinner.find(".input-type-number-down"),
          min = input.attr("min"),
          max = input.attr("max");
    
        btnUp.on("click", function () {
          var oldValue = parseFloat(input.val());
          if (oldValue >= max) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue + 1;
          }
          spinner.find("input").val(newVal);
          spinner.find("input").trigger("change");
        });
    
        btnDown.on("click", function () {
          var oldValue = parseFloat(input.val());
          if (oldValue <= min) {
            var newVal = oldValue;
          } else {
            var newVal = oldValue - 1;
          }
          spinner.find("input").val(newVal);
          spinner.find("input").trigger("change");
        });
      });
      jQuery(document).on("click",".overlay_horizontal_cover .lb-left-arrow",function(){
        if(jQuery("body").find(".lb-items-holder").length > 0 ){
            jQuery(".lb-items-holder .lb-items").each(function(){
                var width = jQuery(this).css("width");
                jQuery(this).parent().removeAttr("style");
                jQuery(this).parent().attr("style","width:"+width+" !important;");
            });
        }
    });

    jQuery(document).on("click",".leafty_layout .wtl-ss-right.slick-arrow ",function(){
        if(jQuery("body").find(".wtl_al_slider").length > 0 ){
            var height = jQuery(".wtl_al_slider > div.slick-list.draggable").css("height");
            jQuery(".wtl_al_slider > div.slick-list.draggable .wtl-schedule-post-content").css("min-height",height);
        }
    });

    jQuery(document).on("click",".full_vertical_layout .wtl-ss-right.slick-arrow ",function(){
        if(jQuery("body").find(".wtl_al_slider").length > 0 ){
            var height = jQuery(".wtl_al_slider > div.slick-list.draggable").css("height");
            jQuery(".wtl_al_slider > div.slick-list.draggable .wtl-fullvertical-post-content").css("min-height",height);
        }
    });
});