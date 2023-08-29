;
(function(jQuery, undefined) {
    "use strict";

    // MAKE MODULES
    var modules = {
        lbinit: function(options) {
            var defaults = { autoplay: false, mobile: { enable: false, autoplay: false }, vertical: false, levels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], levelSegments: [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31], lineType: 'fixed-width', lineWidth: 920, enableYears: true, step: 10000, startFrom: 'last', itemMargin: 10, scrollSpeed: 500, easing: "easeOutSine", enableSwipe: true, hideLogbook: false, hideArrows: false, closeText: "Close", closeItemOnTransition: false, debug: false, class: { item: '.lb-item', itemDetail: '.lb-item-detail', readMore: '.lb-item', }, mousewheel: false };
            options = jQuery.extend(true, {}, defaults, options);
            var c = jQuery(this);
            initLogBook(c, options);
        },
        lbdestroy: function() {
            jQuery(document).unbind('mouseup');
            jQuery(window).unbind('resize');
            var $this = this,
                data = $this.data('logbook');
            $this.removeData('logbook');
        },
        lbtouchstart: function(event) {
            var $this = this,
                data = $this.data('logbook'),
                xmargin = 0;
            data.xpos = event.originalEvent.touches[0].pageX,
                data.ypos = event.originalEvent.touches[0].pageY;
            data.mousedown = true;
            data.touchHorizontal = false;
            data.mousestartpos = data.xpos;
            $this.unbind('touchmove');
            $this.bind(
                'touchmove',
                function(e) {
                    var newx = e.originalEvent.touches[0].pageX,
                        newy = e.originalEvent.touches[0].pageY;
                    if (data.mousedown && !data.touchHorizontal) {
                        if (Math.abs(newx - data.xpos) > Math.abs(newy - data.ypos)) {
                            data.touchHorizontal = true;
                        }
                    } else if (data.touchHorizontal) {
                        e.preventDefault();
                        data.touchpos = e.originalEvent.touches[0].pageX;
                        xmargin = data.margin - data.xpos + e.originalEvent.touches[0].pageX;
                        data.iholder.css('marginLeft', xmargin + 'px');
                    }
                    data.mousedown = false
                }
            );
        },
        lbmousedown: function(xpos) {
            var $this = this,
                data = $this.data('logbook'),
                xmargin = 0;
            data.mousedown = true;
            data.mousestartpos = xpos;

            jQuery('body').css('cursor', 'move');
            jQuery(document).mousemove(
                function(e) {
                    xmargin = data.margin - xpos + e.pageX;
                    data.iholder.css('marginLeft', xmargin + 'px');
                }
            );
        },
        lbtouchend: function(xpos) {
            var $this = this,
                data = $this.data('logbook'),
                wm = data.itemWidth + data.options.itemMargin,
                itemC = data.currentIndex,
                mod = 0,
                xmargin = xpos - data.mousestartpos;
            wm = $this.find(".lb-item").width() + data.options.itemMargin;
            var oscn = -wm / 2;
            var oscp = wm / 2;
            var del = Math.floor(wm / data.options.del);
            if (del > 5) {
                del = 5;
            }

            oscn = -wm / del;
            oscp = wm / del;

            if (typeof data.touchHorizontal != 'undefined' && data.touchHorizontal) {
                data.touchHorizontal = false;

                itemC -= parseInt(xmargin / wm);
                mod = xmargin % wm;
                $this.logbook("lbdebug", "lbtouchend", { xmargin: xmargin, mod: mod, del: del, old_sheet_calc_1: oscn, old_sheet_calc_2: oscp });

                if (xmargin < 0 && mod < oscn) {
                    itemC++;
                }
                if (xmargin > 0 && mod > oscp) {
                    itemC--;
                }

                if (itemC < 0) {
                    itemC = 0;
                }
                if (itemC >= data.itemCount) {
                    itemC = data.itemCount - 1;
                }

                $this.logbook('lbgoto', data.items.eq(itemC).attr('data-id'), data.items.eq(itemC).attr('data-count'));
                if (data.options.closeItemOnTransition) {
                    $this.logbook('lbclose', data.items.eq(itemC).attr('data-id'));
                }
            }
        },
        lbmouseup: function(xpos) {
            var $this = this,
                data = $this.data('logbook'),
                wm = data.itemWidth + data.options.itemMargin,
                itemC = data.currentIndex,
                mod = 0,
                xmargin = xpos - data.mousestartpos;
            data.mousedown = false;
            wm = $this.find(".lb-item").width() + data.options.itemMargin;
            var oscn = -wm / 2;
            var oscp = wm / 2;
            var del = Math.floor(wm / data.options.del);
            if (del > 5) {
                del = 5;
            }

            oscn = -wm / del;
            oscp = wm / del;

            jQuery(document).unbind('mousemove');
            jQuery('body').css('cursor', 'auto');

            itemC -= parseInt(xmargin / wm);
            mod = xmargin % wm;
            $this.logbook("lbdebug", "Mouse Up", { xmargin: xmargin, mod: mod, del: del, old_sheet_calc_1: oscn, old_sheet_calc_2: oscp });

            if (xmargin < 0 && mod < oscn) {
                itemC++;
            }
            if (xmargin > 0 && mod > oscp) {
                itemC--;
            }

            if (itemC < 0) {
                itemC = 0;
            }
            if (itemC >= data.itemCount) {
                itemC = data.itemCount - 1;
            }

            $this.logbook('lbgoto', data.items.eq(itemC).attr('data-id'), data.items.eq(itemC).attr('data-count'));
            if (data.options.closeItemOnTransition) {
                $this.logbook('lbclose', data.items.eq(itemC).attr('data-id'));
            }

        },
        lbopen: function(id, data_count) {

            var $this = this,
                data = $this.data('logbook'),
                _node = $this.find(data.options.class.itemDetail),
                speed = data.options.scrollSpeed,
                width = data.itemDetailWidth,
                easing = data.options.easin,
                itemMargin = data.options.itemMargin;
            var nodew = $this.find(".lb-item-detail").data('width');
            if (typeof nodew != 'undefined') {
                $this.logbook("lbdebug", "Open Change open width", { width: width, itemDetailWidth: nodew });
                width = nodew;
            }
            $this.find(".lb-item-detail-wrapper").width(width);

            var _opt = $this.data('options');
            var scale = _opt.scale;
            var scale_detail = $this.find(".lb-item-detail").data('scale');
            if ((scale < 1) || (scale_detail < 1)) {

                var st_item = 0;
                var end_item = 1;
                var lb_item_count = 1;
                $this.logbook("lbdebug", "Open Start end pos scale<1", { my_start: st_item, my_end: end_item, lb_item_count: lb_item_count, scale: scale });
                var lbww = $this.find(".lb-items-wrapper").width();
                $this.logbook("lbdebug", "Open open width", { width: width });
                var iw = $this.find(".lb-item").width();
                var iwm = iw + data.options.itemMargin;
                $this.logbook("lbdebug", "Open scale<1", { itemWidth: iw, itemWMargin: iwm });

            } else {

                var vla = Math.abs(data.margin);
                var lbww = $this.find(".lb-items-wrapper").width();
                var lbwl = $this.find(".lb-items-wrapper").offset().left;
                var vra = data.margin + lbww;
                var iwm = data.itemWidth + data.options.itemMargin;
                var st_item = Math.floor(Math.abs(vla) / iwm);
                var end_item = st_item + Math.ceil(lbww / iwm) - 1;
                var lb_total_item = Math.ceil(lbww / iwm);
                var lb_pos = Math.floor(lb_total_item / 2);
                var curr_pos = lb_pos;
                $this.logbook("lbdebug", "Set correct position", { position: lb_pos, totalItem: lb_total_item, itemWMargin: iwm });

                var lb_inner_item = Math.ceil(lbww / iwm);
                $this.logbook("lbdebug", "Open open width", { width: width, lbww: lbww });
                $this.logbook("lbdebug", "Open Start end pos scale=1", { id: id, inner: lb_inner_item, data_count: data_count, left: vla, right: vra, iwm: iwm, my_start: st_item, my_end: end_item });
                $this.logbook("lbdebug", "Open Start end pos scale=1", { width: width, st_item: st_item, end_item: end_item });
                var cuttIndex = data.currentIndex;
                var lbwl;
                var lbm, lbm_abs;
                var diff_left, winDiffPos;
                var lb_center_pos;
                var lb_left_pos = 0;
                if (typeof data.activePosition != 'undefined') {
                    $this.logbook("lbdebug", "Open Correct position", { cuttIndex: cuttIndex, new_pos: data.activePosition });

                    cuttIndex = data.activePosition;

                }
                $this.logbook("lbdebug", "Open position", { cuttIndex: cuttIndex, new_pos: data.activePosition });

                if (data.margin > 0) {
                    st_item = 0;
                    end_item = st_item + Math.ceil(lbww / iwm) - 1;
                    lb_left_pos = 0;
                }
                lbm = data.margin;
                lbm_abs = Math.abs(lbm);
                lb_center_pos = (lbm_abs) + lbww / 2;
                $this.logbook("lbdebug", "Open position", { lbm: lbm, lbm_abs: lbm_abs, lb_center_pos: lb_center_pos });

                if (cuttIndex > 0) {
                    if (data.margin < 0) {
                        var lOffset = $this.offset().left;

                        var nlOffset = 0;
                        if (st_item > 0) {
                            nlOffset = iwm * (st_item);
                        }
                        diff_left = nlOffset - lbm_abs;
                        $this.logbook("lbdebug", "Open Calcl left", { lOffset: lOffset, nlOffset: nlOffset, diff_left: diff_left });

                        if (diff_left < 0) {
                            diff_left = iwm + diff_left;
                        }
                        $this.logbook("lbdebug", "Open Calcl left", { lOffset: lOffset, nlOffset: nlOffset, diff_left: diff_left });

                        lb_left_pos = lbm_abs + diff_left;
                        $this.logbook("lbdebug", "Open position", { lb_left_pos: lb_left_pos, lbm: lbm, lbm_abs: lbm_abs, lb_center_pos: lb_center_pos });
                    }
                } else {
                    lb_left_pos = data.margin;
                }
            }
            _node.each(
                function() {
                    if (jQuery(this).attr('data-id') == id) {

                        if (!data_count || data_count == jQuery(this).attr('data-count')) {
                            $this.logbook("lbdebug", "Set correct position ", { curr_pos: curr_pos, lb_pos: lb_pos });

                            var $newThis = jQuery(this);

                            var data_count_temp = jQuery(this).attr('data-count');

                            if (jQuery(data.options.class.item + '[data-count="' + data_count_temp + '"] > .lb-read-more[href="#"]').length == 0 || jQuery(data.options.class.item + '[data-count="' + data_count_temp + '"] > .lb-read-more[href="#"]').length == 0) {

                                $this.trigger('itemVisible.Logbook');

                                var _nim = (itemMargin > 0) ? (itemMargin / 2) : 0;
                                jQuery(this).stop(true).show().animate({ width: width, marginLeft: _nim, marginRight: _nim }, speed, easing);

                                if (typeof jQuery(this).attr('data-access') != 'undefined' && jQuery(this).attr('data-access') != '') {
                                    var action = jQuery(this).attr('data-access');
                                    jQuery.post(
                                        action,
                                        function(data) {

                                            jQuery('body').append('<div class="lb-preloader" style="display:none"></div>');
                                            jQuery('.lb-preloader').html(data);
                                            if (jQuery('.lb-preloader img').length > 0) {
                                                jQuery('.lb-preloader img').load(
                                                    function() {
                                                        $newThis.find('.lb-item-active-content').html(data);
                                                        jQuery('.lb-preloader').remove();
                                                        jQuery(this).attr('data-access', '');

                                                        var event = jQuery.Event('ajaxLoaded.logbook');
                                                        event.element = $newThis.find('.lb-item-active-content');
                                                        jQuery("body").trigger(event);
                                                        $this.trigger(event);
                                                        var scale_detail = $this.find(".lb-item-detail").data('scale');
                                                        $this.logbook("lbdebug", "My open scale", scale_detail);
                                                        if (scale_detail < 1) {
                                                            var cw = $this.find(".lb-item-detail").data('container-width');
                                                            var aiw = parseFloat(_opt.customSize.active.itemWidth);
                                                            var diff = -(Math.abs(cw - aiw)) / 2;
                                                            $this.find(".lb-item-detail a.lb-border-img ").css('left', diff + 'px');
                                                            $this.logbook("lbdebug", "My open scale", { cntWidth: cw, active_itemwidth: aiw, diff: diff });

                                                        } else {
                                                            $this.find(".lb-item-detail a.lb-border-img ").css('left', '');
                                                        }
                                                    }
                                                );
                                            } else {
                                                $newThis.find('.lb-item-active-content').html(data);
                                                jQuery('.lb-preloader').remove();
                                                jQuery(this).attr('data-access', '');

                                                var event = jQuery.Event('ajaxLoaded.logbook');
                                                event.element = $newThis.find('.lb-item-active-content');
                                                jQuery("body").trigger(event);
                                                $this.trigger(event);
                                                var scale_detail = $this.find(".lb-item-detail").data('scale');
                                                $this.logbook("lbdebug", "My open scale", scale_detail);
                                                if (scale_detail < 1) {
                                                    var cw = $this.find(".lb-item-detail").data('container-width');
                                                    var aiw = parseFloat(_opt.customSize.active.itemWidth);
                                                    var diff = -(Math.abs(cw - aiw)) / 2;
                                                    $this.find(".lb-item-detail a.lb-border-img ").css('left', diff + 'px');
                                                    $this.logbook("lbdebug", "My open scale", { cntWidth: cw, active_itemwidth: aiw, diff: diff });

                                                } else {
                                                    $this.find(".lb-item-detail a.lb-border-img ").css('left', '');
                                                }
                                            }

                                        }
                                    );
                                }
                                var scale_detail = $this.find(".lb-item-detail").data('scale');
                                $this.logbook("lbdebug", "My open scale", scale_detail);
                                if (scale_detail < 1) {
                                    var cw = $this.find(".lb-item-detail").data('container-width');
                                    var aiw = parseFloat(_opt.customSize.active.itemWidth);
                                    var diff = -(Math.abs(cw - aiw)) / 2;
                                    $this.logbook("lbdebug", "My open scale", { cntWidth: cw, active_itemwidth: aiw, diff: diff });
                                    $this.find(".lb-item-detail a.lb-border-img ").css('left', diff + 'px');
                                } else {
                                    $this.find(".lb-item-detail a.lb-border-img ").css('left', '');
                                }
                                if (jQuery('body').width() < 767) {
                                    data.marginResponse = true;
                                } else {
                                    data.marginResponse = false;
                                }
                                if (scale == 1 && scale_detail == 1) {
                                    lbm = data.margin;
                                    lbm_abs = Math.abs(lbm);
                                    lb_center_pos = (lbm_abs) + lbww / 2;
                                    $this.logbook("lbdebug", "Open position", { curr_pos: curr_pos, itmewidth_margin: iwm, left_pos: lb_left_pos, margin: lbm, absolute_margin: lbm_abs, center_pos: lb_center_pos });
                                    $this.logbook("lbdebug", "Open position", { cuttIndex: cuttIndex, new_pos: data.activePosition });
                                    if (data.margin > 0) {
                                        lb_center_pos = lbww / 2;
                                        lb_left_pos = lb_center_pos + width;
                                        winDiffPos = -(iwm / 2 + width / 2);
                                    } else {
                                        if (cuttIndex > 0) {
                                            if (curr_pos > 0) {
                                                lb_left_pos += (curr_pos) * iwm;
                                                $this.logbook("lbdebug", "Open Position left is ", { left_pos: lb_left_pos, center_pos: lb_center_pos });

                                                if (lb_left_pos > lb_center_pos) {
                                                    lb_left_pos += width / 2;
                                                    winDiffPos = lb_center_pos - lb_left_pos;
                                                } else {

                                                    var win_diff_static = lb_center_pos - lb_left_pos;
                                                    var win_diff_final = width - win_diff_static;

                                                    if (win_diff_final < width) {
                                                        winDiffPos = -win_diff_final / 2;

                                                    } else {
                                                        lb_left_pos -= width / 2;
                                                        winDiffPos = lb_center_pos - lb_left_pos;

                                                    }
                                                    $this.logbook("lbdebug", "Open Position is smaller", { win_diff_static: win_diff_static, win_diff_final: win_diff_final, winDiffPos: winDiffPos });

                                                }

                                            } else {
                                                lb_left_pos += (curr_pos) * iwm;
                                                $this.logbook("lbdebug", "Open Position left is ", { left_pos: lb_left_pos, center_pos: lb_center_pos });

                                                if (lb_left_pos > lb_center_pos) {
                                                    lb_left_pos += width / 2;
                                                    winDiffPos = lb_center_pos - lb_left_pos;
                                                } else {
                                                    var win_diff_static = lb_center_pos - lb_left_pos;
                                                    var win_diff_final = width - win_diff_static;
                                                    if (win_diff_final < width) {
                                                        winDiffPos = -win_diff_final / 2;
                                                    } else {
                                                        lb_left_pos -= width / 2;
                                                        winDiffPos = lb_center_pos - lb_left_pos;
                                                    }
                                                }
                                            }
                                        } else {
                                            winDiffPos = -(iwm / 2 + width / 2);
                                        }
                                    }
                                    var _nim = (data.options.itemMargin > 0) ? (data.options.itemMargin / 2) : 0;
                                    winDiffPos -= _nim;
                                    data.winDiffPos = winDiffPos;
                                    $this.logbook("lbdebug", "Open Position", { win_diff_static: win_diff_static, itemwrapperwidth: lbww, itemwidth_margin: iwm, left_pos: lb_left_pos, curr_pos: curr_pos, lbwl: lbwl, diff_left: diff_left, cuttIndex: cuttIndex, margin_abs: lbm_abs, center_pos: lb_center_pos, winDiffPos: winDiffPos, margin: data.margin });

                                } else {
                                    var lb_w = width;
                                    var iw = $this.find(".lb-item").width();
                                    var iw = iw;
                                    var cw = lbww;
                                    var scale_detail = $this.find(".lb-item-detail").data('scale');
                                    if (scale_detail < 1 && scale == 1) {
                                        var leftOrRight = Math.abs(cw - iw - data.options.itemMargin) / 2;
                                        winDiffPos = -(leftOrRight + data.options.itemMargin + iw);
                                    } else {
                                        var _nim = (data.options.itemMargin > 0) ? (data.options.itemMargin / 2) : 0;
                                        winDiffPos = -(width / 2 + iwm / 2 + _nim);
                                    }
                                    $this.logbook("lbdebug", "Open Position", { width: lb_w, scale: scale, winDiffPos: winDiffPos });

                                    data.winDiffPos = winDiffPos;
                                }

                                data.margin += winDiffPos;
                                if (false) {
                                    data.iholder.stop(true).animate({ marginLeft: data.margin }, speed, easing, function() {});
                                }
                                // }
                                data.open = id;
                                data.custItemCount = jQuery(this).attr('data-count');
                            }
                        }
                    }

                }
            );
            return $this;
        },
        lbclose: function(id, idOpen, dataCountOpen) {
            var $this = this,
                data = $this.data('logbook'),
                _node = $this.find(data.options.class.itemDetail),
                speed = data.options.scrollSpeed,
                width = data.itemDetailWidth,
                easing = data.options.easing;
            var vla = data.margin;
            var lbww = $this.find(".lb-items-wrapper").width();
            var vra = data.margin + lbww;
            var wm = data.itemWidth + data.options.itemMargin;
            var st_item = Math.floor(Math.abs(vla) / wm);
            var end_item = st_item + Math.floor(lbww / wm);

            _node.each(
                function() {
                    var lb_item_count = jQuery(this).attr('data-count');

                    if (jQuery(this).attr('data-id') == id && jQuery(this).is(":visible")) {
                        $this.trigger('itemClose.Logbook');
                        var curr_pos = jQuery(this).attr('data-count') - st_item;

                        jQuery(this).stop(true).animate({ width: 0, margin: 0 },
                            speed,
                            easing,
                            function() {
                                jQuery(this).hide();
                            }
                        );
                        data.margin += Math.abs(data.winDiffPos);

                        data.iholder.stop(true).animate({ marginLeft: data.margin }, speed, easing);
                        data.open = false;
                    }
                }
            );
            if (idOpen) {

                if (jQuery(this).find('.lb-item[data-count="' + dataCountOpen + '"] a.lb-read-more[href="#"]').length == 0 || jQuery(this).find('.lb-item[data-count="' + dataCountOpen + '"] a.lb-read-more[href="#"]').length == 0) {

                    $this.logbook("lbdebug", "Close Open an item", { idOpen: idOpen, dataCount: dataCountOpen });
                    $this.logbook('lbopen', idOpen, dataCountOpen);
                }
            }
            return $this;
        },
        lbright: function() {
            var $this = this,
                data = $this.data('logbook'),
                speed = data.options.scrollSpeed,
                easing = data.options.easing;
            if (data.currentIndex < data.itemCount - 1) {
                var dataId = data.items.eq(data.currentIndex + 1).attr('data-id');
                var dataCount = data.items.eq(data.currentIndex + 1).attr('data-count');
                $this.logbook('lbgoto', dataId, dataCount);
                if (data.options.closeItemOnTransition) {
                    $this.logbook('lbclose', dataId);
                }
            } else {
                data.iholder.stop(true).animate({ marginLeft: data.margin - 50 }, speed / 2, easing).animate({ marginLeft: data.margin }, speed / 2, easing);
            }
            return $this
        },
        lbleft: function() {
            var $this = this,
                data = $this.data('logbook'),
                speed = data.options.scrollSpeed,
                easing = data.options.easing;

            if (data.currentIndex > 0) {
                var dataId = data.items.eq(data.currentIndex - 1).attr('data-id');
                var dataCount = data.items.eq(data.currentIndex - 1).attr('data-count');
                $this.logbook('lbgoto', dataId, dataCount);
                if (data.options.closeItemOnTransition) {
                    $this.logbook('lbclose', dataId);
                }
            } else {
                data.iholder.stop(true).animate({ marginLeft: data.margin + 50 }, speed / 2, easing).animate({ marginLeft: data.margin }, speed / 2, easing);
            }
            return $this;
        },
        lbgoto: function(id, data_count, openElement) {

            var $this = this,
                data = $this.data('logbook'),
                speed = data.options.scrollSpeed,
                easing = data.options.easing,
                _node = data.items,
                lnw = $this.find('.lb-line').width(),
                count = -1,
                found = false;
            var _opt = $this.data('options');
            var scale = _opt.scale;
            $this.logbook("lbdebug", "Go to scale", { id: id, data_count: data_count, scale: scale });

            if (data.setCenterActiveItem) {
                $this.logbook("lbdebug", "open item return");
                return;
            }
            _node.each(
                function(index) {
                    if (id == jQuery(this).attr('data-id')) {
                        if (!data_count || data_count == jQuery(this).attr('data-count')) {
                            found = true;
                            count = index;
                            return false;
                        }
                    }
                }
            );

            if (found) {
                var $nodes = $this.find('.lb-line-node');
                $nodes.removeClass('active');

                var $goToNode = $nodes.parent().parent().find('[href="#' + id + '"]').addClass('active');
                data.lineMargin = -parseInt($goToNode.parent().parent().attr('data-id'), 10) * 100;

                if ($this.find('.lb-line-view:first').width() > $this.find('.lb-line').width()) {
                    data.lineMargin *= 2;
                    if ($goToNode.parent().hasClass('right')) {
                        data.lineMargin -= 100;
                    }
                }

                if (data.noAnimation) {
                    data.noAnimation = false;

                    $this.find('.lb-line-wrapper').stop(true).css({ marginLeft: data.lineMargin + '%' });
                } else {
                    $this.find('.lb-line-wrapper').stop(true).animate({ marginLeft: data.lineMargin + '%' }, speed, easing);
                }

                if (data.open) {
                    $this.logbook('lbclose', data.open, id, data_count);
                    delete data.activePosition;

                    $this.logbook("lbdebug", "Go to Close postion", data.open);
                } else if (openElement) {
                    delete data.activePosition;
                    $this.logbook("lbdebug", " Go To Open postion", openElement);
                    $this.logbook('lbopen', id, data_count);
                    delete data.activePosition;

                }
                delete data.activePosition;
                $this.trigger('scrollStart.Logbook');
                var lb_index = data.currentIndex;
                var iw = $this.find(".lb-item").width();
                if (scale == 1) {
                    data.margin += (iw + data.options.itemMargin) * (data.currentIndex - count);
                } else {
                    data.margin += (data.currentIndex - count) * (iw) + (data.currentIndex - count) * (data.options.itemMargin);
                }
                data.currentIndex = count;
                $this.logbook("lbdebug", "Go To Count", { currentIndex: data.currentIndex, width: data.itemWidth, scale: scale, count: count, itemIndex: lb_index, margin: data.margin });
                var lbww = $this.find(".lb-items-wrapper").width();
                var lbm = data.margin + (data.current_index - count) * (data.itemWidth + data.itemMargin) + (lbww - data.itemWidth - data.itemMargin) / 2

                $this.logbook("lbdebug", "Go to Count", { count: count, itemIndex: lb_index, margin: data.margin, itemCalMargin: lbm });

                var multiply = (parseInt(data.iholder.css('margin-left')) - data.margin) / data.itemWidth;

                data.iholder.stop(true).animate({ marginLeft: data.margin },
                    speed + (speed / 5) * (Math.abs(multiply) - 1),
                    easing,
                    function() {
                        $this.trigger('scrollStop.logbook');
                    }
                );
            }
            return $this;
        },
        lblineleft: function() {
            var $this = this,
                data = $this.data('logbook'),
                speed = data.options.scrollSpeed,
                easing = data.options.easing;
            if (data.lineMargin != 0 && data.options.levels) {
                data.lineMargin += 100;
                $this.find('.lb-line-wrapper').stop(true).animate({ marginLeft: data.lineMargin + '%' }, speed, easing);
            }
        },
        lblineright: function() {
            var $this = this,
                data = $this.data('logbook'),
                speed = data.options.scrollSpeed,
                easing = data.options.easing;
            if ($this.find('.lb-line-view:first').width() > $this.find('.lb-line').width()) {
                var viewCount = data.lineViewCount * 2;
            } else {
                var viewCount = data.lineViewCount;
            }

            if (data.lineMargin != -(viewCount - 1) * 100 && data.options.levels) {
                data.lineMargin -= 100;
                $this.find('.lb-line-wrapper').stop(true).animate({ marginLeft: data.lineMargin + '%' }, speed, easing);
            }

        },
        lbdebug: function(t, o) {
            var $this = this;
            var options = $this.data('options');
            if (options.debug) {
                if (window.console) {
                    console.log("logbook\n" + t, o);
                }
            }
        },
        lbautoplay: function() {
            var $this = this,
                data = $this.data('logbook'),
                speed = data.options.scrollSpeed,
                easing = data.options.easing;
            var options = $this.data('options');
            if (options.setStopAutoplay || data.open || jQuery(".pp_fade").is(":visible")) {
                $this.logbook("lbdebug", "Autoplay is disabled", { s: options });
                var t = options.step;
                if (options.mobile.enable) {
                    t = t * 4;
                }
                options.setAutoplay = setTimeout(_LB.callAutoplay(options), t);
                $this.data('options', options);

                return;
            }
            if (data.currentIndex == data.itemCount - 1) {
                options.direction = 'left';
            } else if (data.currentIndex == 0) {
                options.direction = 'right';
            } else if (typeof options.direction == 'undefiined') {
                options.direction = 'right';
            }
            if (options.direction == 'right') {
                $this.logbook('lbright');
            } else {
                $this.logbook('lbleft');
            }
            $this.data('options', options);
            $this.logbook("lbdebug", "Autoplay", options.direction);
            setTimeout(
                function() {
                    options.setAutoplay = setTimeout(_LB.callAutoplay(options), options.step);
                    $this.data('options', options);
                },
                options.scrollSpeed
            );
        },
        lbdesignelements: function() {
            var $this = this,
                data = $this.data('logbook'),
                _node = data.items;

            if (data.options.lineType == 'full-width') {
                var lineWidth = parseInt(_LB.getLogbookWidth() - 80);
            } else {
                var lineWidth = data.options.lineWidth;
            }
            lineWidth = jQuery('.logbook.flatLine').width();

            var sl = (Math.round(parseInt(lineWidth) / 2) - 2);
            var sr = (Math.round(parseInt(lineWidth) / 2) - 1);

            var html = '\n' + '<div class="lb-line" style="text-align: left; position:relative; margin-left:auto; margin-right:auto; width:' + lineWidth + 'px;">\n' + '</div>\n';
            $this.prepend(html);
            var logbookWidth = $this.find('.lb-line').width(),
                nodes = new Array(),
                months = [''].concat(data.options.levels),
                monthsDays = [0].concat(data.options.levelSegments),
                minM = months.length,
                minY = 99999,
                maxM = 0,
                maxY = 0;
            if (!data.options.enableYears) {
                maxY = 99999;
            }

            var yearsArr = {};
            if (!data.options.levels) {
                _node.each(
                    function() {
                        var dataId = jQuery(this).attr('data-id'),
                            dataArray = dataId.split('/'),
                            d = parseInt(dataArray[0], 10),
                            m = (jQuery.inArray(dataArray[1], months) != -1) ? jQuery.inArray(dataArray[1], months) : parseInt(dataArray[1], 10),
                            y = parseInt(dataArray[2], 10);
                        if (d < minY) {
                            minY = d;
                        }
                        if (d > maxY) {
                            maxY = d;
                        }
                    }
                );
                minY -= 10;
                maxY += 10;
            }
            var minYear = 2000000,
                maxYear = 0,
                yearCount = 0,
                yearArr = {};
            if (data.options.isYears) {
                _node.each(
                    function(index) {
                        var dataId = jQuery(this).attr('data-id'),
                            nodeName = jQuery(this).attr('data-name'),
                            dataDesc = jQuery(this).attr('data-description'),
                            dataArray = dataId.split('/');
                        var y = parseInt(dataArray[0]);
                        if (typeof yearsArr[y] == 'undefined') {
                            yearCount++;
                            yearArr[y] = yearCount;
                        }
                        if (y < minYear) {
                            minYear = y;
                        }
                        if (y > maxYear) {
                            maxYear = y;
                        }

                    }
                );
                _LB.setDebugMode(data.options, "Min max years", { min: minYear, max: maxYear, yearsCount: yearCount });
            }
            var lbCount = 0,
                lbCountSegments = -1,
                lbYearsSegments = {},
                lbYearsSegmentsStr = {};
            var isIncrementSegment = true;
            _node.each(
                function(index) {
                    var dataId = jQuery(this).attr('data-id'),
                        nodeName = jQuery(this).attr('data-name'),
                        dataDesc = jQuery(this).attr('data-description'),
                        dataArray = dataId.split('/'),
                        d = parseInt(dataArray[0], 10),
                        m = (jQuery.inArray(dataArray[1], months) != -1) ? jQuery.inArray(dataArray[1], months) : parseInt(dataArray[1], 10),
                        y = parseInt(dataArray[2], 10);

                    if (data.options.isYears) {
                        if (yearCount <= 18) {
                            if (typeof lbYearsSegments[0] == 'undefined') {
                                lbYearsSegments[0] = [];
                            }
                            var isActive = (index == data.currentIndex ? ' active' : '');
                            var y1 = y;
                            var leftPos;
                            var pIndex = yearArr[y];
                            leftPos = (100 / (yearCount + 1)) * (index + 1);
                            var isActive = (index == data.currentIndex ? ' active' : '');
                            var nName = ((typeof nodeName != 'undefined') ? nodeName : d);
                            nodes[dataId] = '<a href="#' + dataId + '" class="lb-line-node' + isActive + '" style="left: ' + leftPos + '%; position:absolute; text-align:center;">' + nName;

                            if (typeof dataDesc != 'undefined') {
                                nodes[dataId] += '<span class="lb-node-desc ' + (dataDesc ? '' : 'lb-node-empty-desc') + '" style="white-space:nowrap; position:absolute; z-index: 1;" ><span>' + dataDesc + '</span></span>';
                            }

                            nodes[dataId] += '</a>\n';
                            if (typeof yearsArr[y] == 'undefined') {

                                _LB.setDebugMode(data.options, "ADD Segemnt", { year: y, count: lbCountSegments });

                                yearsArr[y] = {};
                                if (lbCount == 0) {
                                    lbYearsSegmentsStr[0] = y + '-';
                                } else if (lbCount == (data.options.showYears - 1)) {
                                    lbYearsSegmentsStr[0] += y;
                                } else if (index == (yearCount - 1)) {
                                    lbYearsSegmentsStr[0] += y;
                                }
                                var l = lbYearsSegments[0].length;
                                lbYearsSegments[0][l] = nodes[dataId];

                                lbCount++;
                            }

                        } else {

                            if (isIncrementSegment && (lbCount % data.options.showYears == 0)) {
                                lbCountSegments++;
                                lbCount = 0;
                            }
                            if (typeof lbYearsSegments[lbCountSegments] == 'undefined') {
                                lbYearsSegments[lbCountSegments] = [];
                            }

                            var isActive = (index == data.currentIndex ? ' active' : '');
                            var y1 = y;
                            var leftPos;
                            var pIndex = yearArr[y];
                            leftPos = (100 / (data.options.showYears + 1)) * (lbCount + 1);
                            var nName = ((typeof nodeName != 'undefined') ? nodeName : d);
                            nodes[dataId] = '<a href="#' + dataId + '" class="lb-line-node' + isActive + '" style="left: ' + leftPos + '%; position:absolute; text-align:center;">' + nName;

                            if (typeof dataDesc != 'undefined') {
                                nodes[dataId] += '<span class="lb-node-desc ' + (dataDesc ? '' : 'lb-node-empty-desc') + '" style="white-space:nowrap; position:absolute; z-index: 1;" ><span>' + dataDesc + '</span></span>';
                            }

                            nodes[dataId] += '</a>\n';

                            if (typeof yearsArr[y] == 'undefined') {
                                isIncrementSegment = true;

                                _LB.setDebugMode(data.options, "ADD Segemnt", { year: y, count: lbCountSegments });

                                yearsArr[y] = {};
                                if (lbCount == 0) {
                                    lbYearsSegmentsStr[lbCountSegments] = y + '-';
                                } else if (lbCount == (data.options.showYears - 1)) {
                                    lbYearsSegmentsStr[lbCountSegments] += y;
                                } else if (index == (yearCount - 1)) {
                                    lbYearsSegmentsStr[lbCountSegments] += y;
                                }
                                var l = lbYearsSegments[lbCountSegments].length;
                                lbYearsSegments[lbCountSegments][l] = nodes[dataId];

                                lbCount++;
                            } else {
                                if (lbCount == 0) {
                                    isIncrementSegment = false;

                                }
                            }
                        }
                    } else {
                        if (typeof yearsArr[y] == 'undefined') {
                            yearsArr[y] = {};
                        }
                        if (typeof yearsArr[y][m] == 'undefined') {
                            yearsArr[y][m] = {};
                        }
                        yearsArr[y][m][d] = dataId;
                        var isActive = (index == data.currentIndex ? ' active' : '');

                        if (data.options.levels) {
                            var leftPos;
                            leftPos = (100 / monthsDays[m]) * d;
                        } else {
                            var leftPos = (100 / (maxY - minY)) * (d - minY);
                        }
                        var nName = ((typeof nodeName != 'undefined') ? nodeName : d);
                        nodes[dataId] = '<a href="#' + dataId + '" class="lb-line-node' + isActive + '" style="left: ' + leftPos + '%; position:absolute; text-align:center;">' + nName;

                        if (typeof dataDesc != 'undefined') {
                            nodes[dataId] += '<span class="lb-node-desc ' + (dataDesc ? '' : 'lb-node-empty-desc') + '" style="white-space:nowrap; position:absolute; z-index: 1;" ><span>' + dataDesc + '</span></span>';
                        }

                        nodes[dataId] += '</a>\n';

                    }
                }
            );

            html = '\n' +
                '<div id="lb_line_left" style="position: absolute;"></div><div id="lb_line_right" style="position: absolute;"></div>\n' +
                '<div class="lb-line-holder" style="position:relative; overflow: hidden; width:100%;">\n' +
                '<div class="lb-line-wrapper" style="white-space:nowrap;">\n';

            if (!data.options.levels) {
                html +=
                    '<div class="lb-line-view" data-id="' + cnt + '" style="position:relative; display:inline-block; width:100%;">\n' +
                    '<div class="lb-line-segment" style="width:100%; border:0; position:absolute; top:0;">\n';
                for (var x in nodes) {
                    html += nodes[x];
                }
                html += '</div>\n' +
                    '</div>';
            } else {
                if (data.options.isYears) {

                    var cnt = 0;
                    var firstMonth = true;
                    _LB.setDebugMode(data.options, "Years sefgments", { year_s: lbYearsSegments });

                    _LB.setDebugMode(data.options, "Years segemnts str", { year_s_str: lbYearsSegmentsStr });

                    if (yearCount <= 18) {
                        html +=
                            '<div class="lb-line-view" data-id="' + cnt + '" style="position:relative;display:inline-block;width:100%;">\n' +
                            '<div class="lb-line-segment" style="width:100%; border:0; position:absolute; top:0;">\n';
                        jQuery.each(
                            lbYearsSegments[0],
                            function(i, mSegment) {
                                html += mSegment
                            }
                        );
                        html += '</div>\n' +
                            '</div>';
                    } else {
                        // for(var mSegment in lbYearsSegments){
                        jQuery.each(
                            lbYearsSegments,
                            function(i, mSegment) {

                                if (firstMonth) {
                                    firstMonth = !firstMonth;
                                    html +=
                                        '<div class="lb-line-view" data-id="' + cnt + '" style="position:relative; display:inline-block;width:' + lineWidth + 'px">\n' +
                                        '<div class="lb-line-segment" style="position:absolute; top:0;width:' + sl + 'px;">\n' +
                                        '<h4 class="lb-line-month" style="position:abolute; width:100% top:0; text-align:center;">' + (data.options.enableYears ? '<span class="lb-line-my">' + lbYearsSegmentsStr[i] + '</span>' : '') + '</h4>\n';

                                    jQuery.each(
                                        mSegment,
                                        function(i, v) {
                                            html += v;
                                        }
                                    );
                                    html +=
                                        '</div>\n';
                                } else {
                                    firstMonth = !firstMonth;
                                    html +=
                                        '<div class="lb-line-segment right" style="position:absolute; top:0;width:' + sr + 'px;left:' + sr + 'px;">\n' +
                                        '<h4 class="lb-line-month" style="position:abolute; width:100% top:0; text-align:center;">' + (data.options.enableYears ? '<span class="lb-line-my"> ' + lbYearsSegmentsStr[i] + '</span>' : '') + '</h4>\n';

                                    jQuery.each(
                                        mSegment,
                                        function(i, v) {
                                            html += v;
                                        }
                                    );
                                    html +=
                                        '</div>\n' +
                                        '<div style="clear:both"></div>\n' +
                                        '</div>';
                                    cnt++;

                                }
                            }
                        );
                        if (!firstMonth) {
                            html +=
                                '<div class="lb-line-segment right" style="position:absolute; top:0;width:' + sr + 'px;left:' + sr + 'px;">\n' +
                                '<h4 class="lb-line-month" style="position:abolute; width:100% top:0; text-align:center;"></h4>\n' +
                                '</div>\n' +
                                '<div style="clear:both"></div>\n' +
                                '</div>';
                            cnt++;
                        }
                    }
                } else {
                    var firstMonth = true;
                    var cnt = 0;
                    for (var yr in yearsArr) {
                        for (var mnth in yearsArr[yr]) {
                            if (firstMonth) {
                                firstMonth = !firstMonth;
                                html +=
                                    '<div class="lb-line-view" data-id="' + cnt + '" style="position:relative; display:inline-block;width:' + lineWidth + 'px">\n' +
                                    '<div class="lb-line-segment" style="position:absolute; top:0;width:' + sl + 'px;">\n' +
                                    '<h4 class="lb-line-month" style="position:abolute; width:100% top:0; text-align:center;">' + months[mnth] + (data.options.enableYears ? '<span class="lb-line-my"> ' + (yr < 0 ? (-yr) + ' B.C.' : yr) + '</span>' : '') + '</h4>\n';

                                for (var dy in yearsArr[yr][mnth]) {
                                    html += nodes[yearsArr[yr][mnth][dy]];

                                }
                                html +=
                                    '</div>\n';
                            } else {
                                firstMonth = !firstMonth;
                                html +=
                                    '<div class="lb-line-segment right" style="position:absolute; top:0;width:' + sr + 'px;left:' + sr + 'px;">\n' +
                                    '<h4 class="lb-line-month" style="position:abolute; width:100% top:0; text-align:center;">' + (typeof months[mnth] !== 'undefined' ? months[mnth] : '') + (data.options.enableYears ? '<span class="lb-line-my"> ' + yr + '</span>' : '') + '</h4>\n';

                                for (dy in yearsArr[yr][mnth]) {
                                    html += nodes[yearsArr[yr][mnth][dy]];

                                }
                                html +=
                                    '</div>\n' +
                                    '<div style="clear:both"></div>\n' +
                                    '</div>';
                                cnt++;

                            }
                        }
                    }
                    if (!firstMonth) {
                        html +=
                            '<div class="lb-line-segment right" style="position:absolute; top:0;width:' + sr + 'px;left:' + sr + 'px;">\n' +
                            '<h4 class="lb-line-month" style="position:abolute; width:100% top:0; text-align:center;"></h4>\n' +
                            '</div>\n' +
                            '<div style="clear:both"></div>\n' +
                            '</div>';
                        cnt++;
                    }

                }

                html += '\n' +
                    '<div style="clear:both"></div>\n' +
                    '</div>\n' +
                    '</div>\n';

            }
            data.lineViewCount = cnt;
            $this.find('.lb-line:first').html(html);
            $this.find('.lb-line-node').each(
                function() {
                    var $thisNode = jQuery(this);
                    jQuery(this).find('span').hide();
                    jQuery(this).hover(
                        function() {
                            _node.each(
                                function() {
                                    if (jQuery(this).attr('data-id') == $thisNode.attr('href').substr(1)) {
                                        jQuery(this).addClass('lb-node-hover');
                                    }
                                }
                            );

                            var aw = jQuery(this).closest('.lb-line-view').width() - (jQuery(this).offset().left - jQuery(this).closest('.lb-line-view').offset().left);
                            var adw = jQuery(this).find('.lb-node-desc').find('span').width();

                            if (adw > aw) {
                                jQuery(this).find('.lb-node-desc').css({
                                    'left': 'auto',
                                    'right': '2px',
                                });
                                jQuery(this).find('.lb-node-desc').find('span').css({
                                    'left': 'auto',
                                    'right': '2px',
                                    'margin-left': 0,
                                    'margin-right': 0
                                });
                            } else {
                                jQuery(this).find('.lb-node-desc').css({
                                    'right': 'auto',
                                    'left': '2px',
                                });
                                jQuery(this).find('.lb-node-desc').find('span').css({
                                    'right': 'auto',
                                    'left': '2px',
                                    'margin-left': 0,
                                    'margin-right': 0
                                });
                            }
                            jQuery(".lb-hover").finish();

                            var $this = jQuery(this).parents('.logbook');
                            var options = $this.data('options');
                            $this.logbook('lbdebug', 'Hover', { s: options });

                            var off = jQuery(this).offset();
                            var nDesc = jQuery(this).find('.lb-node-desc').html();

                            var _opt = $this.data('options');
                            var isTransition = _opt.isTransition;
                            var pfx = _opt.pfx;
                            var html;

                            if (isTransition) {
                                html = '<span class="lb-node-desc" style="' + pfx + '-transform:top 200ms,opacity 500ms">' + nDesc + "</span>";
                            } else {
                                html = '<span class="lb-node-desc" style="top:0px;opacity:1;">' + nDesc + "</span>";
                            }
                            var id = $this.attr('id');
                            jQuery(".lb-hover").attr('id', id);
                            jQuery(".lb-hover").html(html);
                            jQuery(".lb-hover").find('span').show();
                            jQuery(".lb-hover").find('.lb-node-desc').css({ opacity: 1, top: '0px' });
                            var w = jQuery(".lb-hover").width();
                            var l = off.left - w / 2 + 5;
                            var top = off.top - 13;
                            if (!isTransition) {
                                jQuery(".lb-hover").css({ top: top + 'px', left: l + 'px' }).animate({ opacity: 1 }, 500);
                            } else {
                                jQuery(".lb-hover").css({ top: top + 'px', left: l + 'px', opacity: 1 });
                            }
                        },
                        function() {
                            var $this = jQuery(this).parents('.logbook');
                            var options = $this.data('options');
                            $this.find(".lb-item").removeClass("lb-node-hover");
                            $this.logbook('lbdebug', 'Hover out', { s: options });

                            jQuery(".lb-hover").finish();

                            jQuery(".lb-hover").animate({ opacity: 0 },
                                500,
                                function() {

                                }
                            );
                        }
                    );

                    if (jQuery(this).hasClass('active')) {
                        data.lineMargin = -parseInt(jQuery(this).parent().parent('.lb-line-view').attr('data-id'), 10) * 100;
                        if (data.options.rtl) {
                            $this.find('.lb-line-wrapper').css('margin-right', data.lineMargin + '%');
                        } else {
                            $this.find('.lb-line-wrapper').css('margin-left', data.lineMargin + '%');
                        }
                    }
                    jQuery(this).click(
                        function(e) {
                            e.preventDefault();
                            $this.find('.lb-line-node').removeClass('active');
                            jQuery(this).addClass('active');
                            $this.logbook('lbgoto', jQuery(this).attr('href').substr(1));
                            if (data.options.closeItemOnTransition) {
                                $this.logbook('lbclose', jQuery(this).attr('href').substr(1));
                            }
                        }
                    );
                }
            );
            $this.find('#lb_line_left').click(
                function() {
                    $this.logbook('lblineleft');
                }
            );

            $this.find('#lb_line_right').click(
                function() {
                    $this.logbook('lblineright');
                }
            );

        },
    };

    jQuery.fn.logbook = function(action) {
        if (modules[action]) {
            return modules[action].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof action === 'object' || !action) {
            return modules.lbinit.apply(this, arguments);
        } else {
            jQuery.error('Action ' + action + ' does not exist on jQuery.logbook');
        }

    };
    var _LB = jQuery.fn.logbook;

    jQuery.extend(
        true,
        _LB, {
            setDebugMode: function(opt, m, o) {
                if (opt.debug && window.console) {
                    if (typeof o == 'undefined') {
                        o = {};
                    }
                    console.log(m, o);
                }
            },
            getLogbookWidth: function() {
                var lbw = jQuery('.logbook').width();
                if (lbw == 0) {
                    lbw.parents().each(
                        function() {
                            if (jQuery(this).css('display') == 'none') {
                                jQuery(this).css("visibility", "hidden").show();
                                lbw = jQuery('.logbook').width();
                                jQuery(this).css("visibility", "visible").hide();
                                return false;
                            }
                        }
                    );
                }
                return lbw;
            },
            setResizeImg: function(opt) {

                _LB.setDebugMode(opt, "Resize image");
                opt.c.find(".lb-item").each(
                    function(i, node) {
                        var padd = jQuery(node).find(".lb-share-items").css('padding-top');
                        padd = parseFloat(padd);

                        var bott = jQuery(node).find(".lb-border-img").offset().top;
                        var h = jQuery(node).find(".lb-border-img").height();
                        bott += h;
                        var bott_1 = jQuery(node).find(".lb-content").offset().top;

                        var rel_pos_image = jQuery(node).find(".lb-border-img").offset().top - jQuery(node).offset().top;

                        var h_content = jQuery(node).find(".lb-content").height();

                        _LB.setDebugMode(opt, "Resize image", { rel_pos_image: rel_pos_image, h: h, h_content: h_content, padd: padd, bott: bott, bott_1: bott_1 });

                        if (bott > bott_1) {
                            var diff = Math.abs(bott - bott_1);

                            var h = jQuery(node).find(".lb-border-img").height();
                            if (typeof jQuery(node).data('height') == 'undefined') {
                                jQuery(node).data('height', h);
                            }
                            h -= diff;
                            jQuery(node).find(".lb-border-img").height(h);
                            var diff_1 = diff / 2;
                            jQuery(node).find(".lb-border-img img").css('top', '-' + diff_1 + 'px');

                            _LB.setDebugMode(opt, "Resize image for diff", { diff: diff });

                        } else {
                            var h;
                            if (typeof jQuery(node).data('height') != 'undefined') {
                                h = jQuery(node).data('height');
                                jQuery(node).find(".lb-border-img").height(h);

                            }
                            jQuery(node).find(".lb-border-img img").css('top', '');
                            _LB.setDebugMode(opt, "Resize image for return to original sized");
                        }
                    }
                );
            },

            setWin500: function(opt) {
                var tw = opt.triggerWidth;
                var siw = parseFloat(opt.customSize.sheet.itemWidth);
                var aiw = parseFloat(opt.customSize.active.itemWidth);
                var sm = parseFloat(opt.customSize.sheet.margin);
                var cw = opt.c.width();
                cw -= sm;

                _LB.setDebugMode(opt, "Item width", { containerWidth: cw, sheetItemWidth: siw, activeItemWidth: aiw });

                var scale = 1;
                var scale_detail = 1;
                if (cw <= tw) {
                    if (cw < siw) {

                        scale = cw / siw;

                        var diff = -Math.abs(cw - siw) / 2;

                        opt.c.find(".lb-item .lb-border-img img").css('left', diff + 'px');
                        opt.c.find(".lb-item").width(cw);
                        if (opt.c.find(".lb-content").length > 0) {
                            var ml = parseFloat(opt.c.find(".lb-content").css('margin-left'));
                            opt.c.find(".lb-content").width((cw - 2 * ml));
                        }

                    } else {

                        opt.c.find(".lb-item").width(siw);
                        opt.c.find(".lb-item .lb-border-img img").css('left', '');
                        if (opt.c.find(".lb-content").length > 0) {
                            var ml = parseFloat(opt.c.find(".lb-content").css('margin-left'));
                            opt.c.find(".lb-content").width((siw - 2 * ml));
                        }

                    }
                    if (cw < aiw) {
                        var diff_1 = -Math.abs(cw - aiw) / 2;
                        opt.c.find(".lb-item-detail a.lb-border-img").css('left', diff_1 + 'px');

                        scale_detail = cw / aiw;
                        opt.c.find(".lb-item-detail").data('width', cw);
                        opt.c.find(".lb-item-detail").width(cw);
                        opt.c.find(".lb-item-detail-wrapper").width(cw);

                    } else {
                        opt.c.find(".lb-item-detail a.lb-border-img").css('left', '');

                        opt.c.find(".lb-item-detail").data('width', aiw);
                        opt.c.find(".lb-item-detail").width(aiw);
                        opt.c.find(".lb-item-detail-wrapper").width(aiw);

                    }
                } else {
                    if (cw < siw) {
                        scale = cw / siw;

                        var diff = -Math.abs(cw - siw) / 2;

                        opt.c.find(".lb-item .lb-border-img img").css('left', diff + 'px');
                        opt.c.find(".lb-item").width(cw);
                        if (opt.c.find(".lb-content").length > 0) {
                            var ml = parseFloat(opt.c.find(".lb-content").css('margin-left'));
                            opt.c.find(".lb-content").width((cw - 2 * ml));
                        }

                    } else {

                        opt.c.find(".lb-item").width(siw);
                        opt.c.find(".lb-item .lb-border-img img").css('left', '');
                        if (opt.c.find(".lb-content").length > 0) {
                            var ml = parseFloat(opt.c.find(".lb-content").css('margin-left'));
                            opt.c.find(".lb-content").width((siw - 2 * ml));
                        }

                    }
                    if (cw < aiw) {
                        var diff_1 = -Math.abs(cw - aiw) / 2;
                        opt.c.find(".lb-item-detail a.lb-border-img").css('left', diff_1 + 'px');

                        scale_detail = cw / aiw;

                        opt.c.find(".lb-item-detail").data('width', cw);
                        opt.c.find(".lb-item-detail").width(cw);
                        opt.c.find(".lb-item-detail-wrapper").width(cw);

                    } else {
                        opt.c.find(".lb-item-detail a.lb-border-img").css('left', '');

                        opt.c.find(".lb-item-detail").data('width', aiw);
                        opt.c.find(".lb-item-detail").width(aiw);

                        opt.c.find(".lb-item-detail-wrapper").width(aiw);

                    }
                }

                opt.c.find(".lb-item-detail").data('scale', scale_detail);
                opt.c.find(".lb-item-detail").data('container-width', cw);
                _LB.setDebugMode(opt, "Scale new function", { scale: scale, scale_detail: scale_detail });
                return scale;
            },
            scaleItems: function(opt, scale) {
                var data = opt.c.data('logbook');
                var $iholder = opt.c.find('.lb-items:first');
                var _opt = opt.c.data('options');
                var si = opt.startindex;
                if (typeof data != 'undefined') {
                    if (data.currentIndex != 'undefined') {
                        si = data.currentIndex;
                    }
                }

                var cw = opt.c.width();
                var ciw = opt.c.find(".lb-item").width();

                var custom_w = cw;
                var scale_copy = 1;
                var iw = opt.c.find(".lb-item").width();
                _LB.setDebugMode(opt, "Reposition element", { containerWidth: custom_w, itemWidth: iw });

                var margin = 0;
                if ((scale < 1 || scale == 1) && scale_copy != '' && (typeof _opt != 'undefined')) {
                    if (si == 0) {
                        if (scale < 1) {
                            margin = 0;
                        } else {
                            margin = (custom_w - iw - _opt.itemMargin) / 2;
                        }
                    }
                    if (si > 0) {
                        if (scale < 1) {
                            margin = -(si) * (iw) - (si) * (_opt.itemMargin);
                        } else {
                            margin = -(si) * (iw + _opt.itemMargin) + (custom_w - iw - _opt.itemMargin) / 2;
                        }
                    }

                    _LB.setDebugMode(opt, "Scale margin Margin", { width: cw, start: si, margin: margin });

                    if (true) {
                        $iholder.css({ marginLeft: margin });
                        data.margin = margin;
                    } else {
                        var wiw = opt.c.find(".lb-items-wrapper").width();
                        var win_diff = 0;
                        if (typeof data != 'undefined') {
                            opt.c.logbook("lbdebug", "Scale Factors", { scale: scale, scale_copy: data.scale_copy });
                        }
                        if ((scale == 1) && (data.scale_copy < 1)) {
                            _LB.setDebugMode(opt, "My scale_copy <1 scale==1", win_diff);
                            var cww = _opt.wrapperWidth;
                            win_diff = -(wiw - cww)

                            data.winResizeDiff = win_diff / 2;
                            _opt.wrapperWidth = wiw;
                        } else if ((scale < 1) && (data.scale_copy == 1)) {
                            var cww = _opt.wrapperWidth;
                            win_diff = -(wiw - cww);
                            _LB.setDebugMode(opt, "My scall1 <1 scale_copy==1", win_diff);
                            _opt.wrapperWidth = wiw;
                            data.winResizeDiff = -win_diff / 2;
                        } else {

                            var cww = _opt.wrapperWidth;
                            win_diff = -(wiw - cww);
                            _LB.setDebugMode(opt, "My scale is same <1", { width: wiw, win_diff: win_diff, old_width: cww });
                            _opt.wrapperWidth = wiw;

                        }
                        _LB.setDebugMode(opt, "My scale function Diff margin", { scale: scale, scale_copy: data.scale_copy, win_diff: win_diff });
                    }
                }
                if (typeof data != 'undefined') {
                    _LB.setDebugMode(opt, "Get scale factor", { scale_copy: data.scale_copy });
                    data.scale_copy = scale;
                }
                return scale;
            },
            arrowsMouseLeaveEvt: function(opt, curr) {
                if (opt.setSliderTimeout != '') {
                    clearTimeout(opt.setSliderTimeout);
                    return;
                }
                jQuery(curr).finish();
                opt.c.find(".lb-items-holder").finish('lb_left');

                var w = jQuery(curr).width();
                w -= 20;
                var ml = opt.c.find(".lb-items").css('margin-left');
                ml = parseFloat(ml);
                opt.c.logbook("lbdebug", "Mouse leave", { currentWidth: w, margin_left: ml, arrowName: opt.lb_arrow });
                if (opt.lb_arrow == "lb-left-arrow") {
                    ml = 0;
                } else {
                    ml = 0;
                }

                jQuery(curr).animate({ width: w },
                    350,
                    function() {

                    }
                );
                opt.c.find(".lb-items-holder").animate({ 'margin-left': ml, 'queue': 'lb_left' }, 350);
            },
            setItemCenter: function(opt) {
                if (opt.c.hasClass('lb-center')) {
                    opt.c.find(opt.class.item).each(
                        function(i, v) {
                            var i_h = opt.c.find('img').height();
                            var t_h = jQuery(v).find(".lb-content").outerHeight();
                            var it_h = opt.c.find('.lb-item').height();
                            var top = it_h - i_h - t_h;
                            var p = 0;
                            if (top > 0) {
                                p = top / 2;
                            }
                            opt.c.logbook("lbdebug", "Center style", { image_h: i_h, content_outter_height: t_h, itemHeight: it_h, top: top, middle: p });
                            if (p != 0) {
                                jQuery(v).find(".lb-content").css('bottom', p + 'px');
                            }
                        }
                    );
                }
                /* Width Issue Fix:LOG:19122020*/
                $.fn.sumOuterWidth = function() {
                    var obj = this;
                    if (obj == null || obj.length == 0) { return 0 }
                    var vl = obj.width();
                    vl += parseInt(obj.css("padding-left"), 10) + parseInt(obj.css("padding-right"), 10); //Total Padding Width
                    vl += parseInt(obj.css("margin-left"), 10) + parseInt(obj.css("margin-right"), 10); //Total Margin Width
                    vl += parseInt(obj.css("border-left-width"), 10) + parseInt(obj.css("border-right-width"), 10); //Total Border Width
                    return vl;
                };
                var single_item = $('.lb-items-holder .lb-items .overlay_horizontal');
                var total_item = single_item.length;
                var sitem_width = single_item.sumOuterWidth();
                var twidth = sitem_width * total_item + (sitem_width);
                $('.lb-items-holder .lb-items').width(twidth);
                /* End Issue Fix:LOG:19122020*/

            },
            callAutoplay: function(opt) {
                opt.c.logbook('lbautoplay');
            }
        }
    );

    var initLogBook = function(container, opt) {
        if (container == undefined) {
            return false;
        }
        opt.c = container;
        var pfx, pers;
        var isTransition = function() {
            var obj = document.createElement('div'),
                props = ['perspectiveProperty', 'WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective'];
            for (var i in props) {
                if (obj.style[props[i]] !== undefined) {
                    pfx = props[i].replace('Perspective', '').toLowerCase();
                    pers = "-" + pfx + "-transform";
                    return true;
                }
            }
            return false;
        }();

        _LB.setDebugMode(opt, "mode", { prifix: pfx, perspective: pers, isTransition: isTransition });

        opt.isTransition = isTransition;
        opt.pfx = pfx;

        var _B = jQuery('body'),
            items = container.find(opt.class.item),
            itemDetail = container.find(opt.class.itemDetail),
            iw = items.first().width(),
            idw = itemDetail.first().width(),
            cit = opt.closeItemOnTransition;
        var scale = 1;
        var scale_copy = '';
        scale = _LB.setWin500(opt);
        container.trigger('lbinit.Logbook');
        var si = items.length - 1;
        if (opt.startFrom == 'first') {
            si = 0;
        } else if (opt.startFrom == 'last') {
            si = items.length - 1;
        } else {
            items.each(
                function(index) {
                    if (opt.startFrom == jQuery(this).attr('data-id')) {
                        si = index;
                        return true;
                    }
                }
            );
        }

        items.each(
            function(index) {
                jQuery(this).attr('data-count', index);
                jQuery(this).next(opt.class.itemDetail).attr('data-count', index);
                if (!jQuery(this).hasClass(opt.class.readMore)) {
                    jQuery(this).find(opt.class.readMore).attr('data-count', index);
                    jQuery(this).find(".lb-read-more").attr('data-count', index);
                }

            }
        );
        container.append('<div style="clear:both"></div>');
        container.css({ width: '100%', 'overflow': 'hidden', marginLeft: 'auto', marginRight: 'auto', 'text-align': 'center', height: 0 });
        container.wrapInner('<div class="lb-items" />');
        container.find('.lb-items').css('text-align', 'left');

        if ('ontouchstart' in window) {
            container.addClass('lb-touch');

        }
        container.wrapInner('<div class="lb-items-holder" />');
        if (!opt.hideArrows) {
            container.append('<div class="lb-arrows"><div class="lb-left-arrow"></div><div class="lb-right-arrow"></div></div>');
        }
        container.wrapInner('<div class="lb-items-wrapper" />');
        container.find('.lb-items-holder').css({ width: cw + 'px', marginLeft: 'auto', marginRight: 'auto' });

        var cw = container.width();
        var ciw = container.find(".lb-item").width();

        scale = _LB.scaleItems(opt, scale);
        iw = items.first().width();
        _LB.setDebugMode(opt, "width", { itemFirstWidth: iw, containerWidth: cw, containerItemsWidth: ciw, scale: scale });

        var _nim = (opt.itemMargin > 0) ? (opt.itemMargin / 2) : 0;
        items.css({ paddingLeft: 0, paddingRight: 0, marginLeft: _nim, marginRight: _nim, float: 'left', position: 'relative' });

        itemDetail.each(
            function() {
                jQuery(this).prepend('<div class="lb-close" data-count="' + jQuery(this).attr('data-count') + '" data-id="' + jQuery(this).attr('data-id') + '">' + opt.closeText + '</div>');
                jQuery(this).wrapInner('<div class="' + opt.class.itemDetail.substr(1) + '-wrapper"  />').find('div:first').css({ position: 'relative' });
                jQuery(this).css({ width: 0, padding: 0, margin: 0, float: 'left', display: 'none', position: 'relative', overflow: 'hidden' });
            }
        );
        var $iholder = container.find('.lb-items:first'),
            $line = container.find('.lb-line-wrapper:first'),
            margin = 300 / 2 - (iw + opt.itemMargin) * (1 / 2 + si),
            width = (iw + opt.itemMargin) * items.length + (idw + opt.itemMargin) + 660,
            data = container.data('logbook');
        var lbw = container.width();
        var lbww = container.find(".lb-items-wrapper").width();
        if (si == 0) {
            if (scale < 1) {
                margin = 0;
            } else {
                margin = (lbww - iw - opt.itemMargin) / 2;
            }
        }
        if (si > 0) {
            if (scale < 1) {
                margin = -(si) * (iw) - (si) * (opt.itemMargin);
            } else {
                margin = -(si) * (iw + opt.itemMargin) + (lbww - iw - opt.itemMargin) / 2;
            }
        }
        _LB.setDebugMode(opt, "Margin", { width: lbw, start: si, margin: margin });
        $iholder.css({ width: width, marginLeft: margin });
        if (!data) {
            container.data('logbook', { currentIndex: si, itemCount: items.length, margin: margin, itemWidth: iw, itemDetailWidth: idw, lineMargin: 0, lineViewCount: 0, options: opt, items: items, iholder: $iholder, open: false, noAnimation: false, marginResponse: false, mousedown: false, setCenterActiveItem: false, mousestartpos: 0, });
        }
        opt.scale = scale;
        opt.wrapperWidth = container.find(".lb-items-wrapper").width();;
        if (!opt.hideLogbook) {
            container.logbook('lbdesignelements');
            if (container.hasClass('lb-clean')) {}
        }

        var data = container.data('logbook');
        data.scale = scale;
        data.scale_copy = scale;
        container.data('options', opt);
        container.logbook("lbdebug", "Autoplay set timeout", opt);
        if (container.hasClass('lb-resize')) {
            _LB.setResizeImg(opt);
        }
        opt.setAutoplay = '';
        opt.setStopAutoplay = false;

        if (opt.autoplay) {
            container.logbook("lbdebug", "AutoplayStep", opt.step);
            if (opt.mobile.enable && opt.mobile.autoplay) {
                container.logbook("lbdebug", "Autoplay for mobil", opt.mobile.autoplay);
                opt.setAutoplay = setTimeout(_LB.callAutoplay(opt), opt.step);
                container.data('options', opt);
                container.bind(
                    'touchstart',
                    function(e) {
                        opt.setStopAutoplay = true;
                        container.logbook("lbdebug", "Autoplay touch stop autoplay");
                        container.data('options', opt);
                    }
                );
                container.bind(
                    'touchend',
                    function(e) {
                        opt.setStopAutoplay = false;
                        container.logbook("lbdebug", "Autoplay touch end set new timeout");
                        container.data('options', opt);

                        if (opt.setAutoplay != '') {
                            clearTimeout(opt.setAutoplay);
                            opt.setAutoplay = setTimeout(_LB.callAutoplay(opt), opt.step * 4);
                            container.data('options', opt);
                        }
                    }
                );
            } else if (!opt.mobile.enable) {
                container.logbook("lbdebug", "Autoplay set timeout", opt.step);
                opt.setAutoplay = setTimeout(_LB.callAutoplay(opt), opt.step);
                container.data('options', opt);
                container.bind(
                    'mouseenter',
                    function(e) {
                        opt.setStopAutoplay = true;
                        container.logbook("lbdebug", "Autoplay mouseover clear timeout");
                        container.data('options', opt);
                    }
                );
                container.bind(
                    'mouseleave',
                    function(e) {
                        opt.setStopAutoplay = false;
                        container.logbook("lbdebug", "Autoplay set timeout mouseout");
                        container.data('options', opt);
                    }
                );
            }
        }
        jQuery(window).on(
            'load',
            function() {
                var lbh = container.find(".lb-item").height();
                var win_diff = 0;
                lbh -= win_diff;
                var mt = container.find(".lb-items-wrapper").css('margin-top');
                container.find(".lb-left-arrow , .lb-right-arrow").css({ top: mt, height: lbh + 'px' });
            }
        )

        var lb_arrow = '';

        container.find(".lb-left-arrow , .lb-right-arrow").on(
            "mouseenter",
            function(e) {
                var $p = jQuery(this);
                var setSliderTimeout = setTimeout(
                    function(e) {

                        $p.finish();
                        container.find(".lb-items-holder").finish('lb_left');

                        var w = $p.width();
                        $p.data('width', w);
                        w += 20;
                        var ml = container.find(".lb-items").css('margin-left');
                        container.find(".lb-items").data('marginleft', ml);

                        ml = parseFloat(ml);
                        container.logbook("lbdebug", "mouse eneter", { w: w, margin_left: ml });
                        if ($p.hasClass("lb-left-arrow")) {
                            ml = 100;
                            lb_arrow = 'lb-left-arrow';
                        } else {
                            lb_arrow = 'lb-right-arrow';
                            ml = -100;
                        }
                        $p.animate({ width: w },
                            350,
                            function() {

                            }
                        );

                        container.find(".lb-items-holder").animate({ 'margin-left': 'auto', 'queue': 'lb_left' }, 350);
                        setSliderTimeout = '';
                        opt.setSliderTimeout = setSliderTimeout;
                        opt.lb_arrow = lb_arrow;

                    },
                    130
                );
            }
        );

        container.on(
            "mouseleave",
            function(e) {
                container.find(".lb-left-arrow , .lb-right-arrow").animate({ opacity: 0 }, 150);
            }
        );
        container.on(
            "mouseenter",
            function(e) {
                container.find(".lb-left-arrow , .lb-right-arrow").animate({ opacity: 1 }, 150);
            }
        );
        container.find(".lb-left-arrow , .lb-right-arrow").on(
            "mouseleave",
            function(e) {
                _LB.arrowsMouseLeaveEvt(opt, jQuery(this));
            }
        );

        jQuery(window).on(
            'load',
            function() {
                _LB.setItemCenter(opt);
            }
        );
        jQuery(document).keydown(
            function(e) {
                if (e.keyCode == 37) {
                    container.logbook('lbleft');
                    return false;
                }
                if (e.keyCode == 39) {
                    container.logbook('lbright');
                    return false;
                }
            }
        );
        jQuery(window).resize(
            function() {
                var _opt = container.data('options');
                if (typeof _opt == 'undefined') {
                    _opt = opt;
                }
                var data = container.data('logbook');
                var speed = data.options.scrollSpeed,
                    easing = data.options.easing,
                    items = data.items;
                var id;
                if (_opt.vertical) {
                    id = container.find(".lb-vertical-row:eq(" + data.currentIndex + ") .lb-item").attr('data-id');
                } else {
                    id = container.find(".lb-item:eq(" + data.currentIndex + ")").attr('data-id');
                }

                _LB.setDebugMode(opt, "Reposition Line", { data: data, id: id, currentIndex: data.currentIndex });

                var $nodes = container.find('.lb-line-node');
                $nodes.removeClass('active');
                var $goToNode = $nodes.parent().parent().find('[href="#' + id + '"]').addClass('active');
                data.lineMargin = -parseInt($goToNode.parent().parent().attr('data-id'), 10) * 100;
                _LB.setDebugMode(opt, "Line margin", { margin: data.lineMargin });

                if (container.find('.lb-line-view:first').width() > container.find('.lb-line').width()) {
                    data.lineMargin *= 2;
                    if ($goToNode.parent().hasClass('right')) {
                        data.lineMargin -= 100;
                    }
                }

                if (data.noAnimation) {
                    data.noAnimation = false;

                    container.find('.lb-line-wrapper').stop(true).css({ marginLeft: data.lineMargin + '%' });
                } else {
                    container.find('.lb-line-wrapper').stop(true).animate({ marginLeft: data.lineMargin + '%' }, speed, easing);
                }

                var cw = container.width();
                var lhw = container.find(".lb-line-holder").width();
                var win_diff = cw - lhw;

                if (win_diff < 60 && win_diff > 0) {
                    if (win_diff > 0) {
                        var aPixel = win_diff / 2 + 4;
                        container.find('#lb_line_left').css('left', '-' + aPixel + 'px');
                        container.find('#lb_line_right').css('right', '-' + aPixel + 'px');

                    }
                }
                var cw = container.width();
                if (container.hasClass('lb-resize')) {
                    _LB.setResizeImg(opt);
                }
                container.find('.lb-items-holder').css({ width: cw + 'px' });

                scale = _LB.setWin500(opt);
                _LB.scaleItems(opt, scale);

                _LB.setDebugMode(opt, "Scale factor", scale);

                _LB.setWin500(opt);

                var _opt = container.data('options');
                _opt.scale = scale;
                container.data('options', _opt);
                var data = container.data('logbook');
                data.setResizeFlag = true;
                var lbww = container.find(".lb-items-wrapper").width();
                var width;
                width = container.find(".lb-item-detail").width();
                var scale_detail = container.find(".lb-item-detail").data('scale');
                if (data.open) {
                    if (typeof data != 'undefined') {
                        var id = items.eq(data.currentIndex).attr('data-id');
                        var winDiffPos = 0;
                        width = data.itemDetailWidth;
                        var wrapperWidth = container.find(".lb-item-detail").data('width');
                        if (typeof wrapperWidth != 'undefined') {
                            container.logbook("lbdebug", "Open Change open width", { width: width, wrapperWidth: wrapperWidth });
                            width = wrapperWidth;

                        }
                        container.logbook("lbdebug", "Resize scale factors", { scale: scale, scale_detail: scale_detail });

                        var lbww = container.find(".lb-items-wrapper").width();
                        if (scale < 1 || scale_detail < 1) {

                            var iw = container.find(".lb-item").width();
                            var iwc = iw;
                            var lbwwc = lbww;
                            if (scale_detail < 1 && scale == 1) {
                                var leftOrRight = Math.abs(lbwwc - iwc - data.options.itemMargin) / 2;
                                winDiffPos = -(leftOrRight + data.options.itemMargin + iwc);

                            } else {
                                if (scale < 1) {
                                    winDiffPos = -(lbww + width) / 2;
                                } else {
                                    winDiffPos = -((iwc + data.options.itemMargin + width) / 2);
                                }
                            }
                            container.logbook("lbdebug", "Resize Calculate position scale<1", { ItemSheetWidth: iwc, openWidth: width, ContainerWidth: lbww, scale_copy: scale_copy, scale: scale, winDiffPos: winDiffPos });

                            data.winDiffPos = winDiffPos;
                        } else {
                            winDiffPos = -((data.itemDetailWidth) + (data.options.itemMargin)) / 2 - ((width + data.options.itemMargin) / 2);

                            container.logbook("lbdebug", "Resize Calculate position scale==1", { scale: scale, winDiffPos: winDiffPos });

                            _opt.wrapperWidth = lbww;
                            data.winDiffPos = winDiffPos;
                        }

                        data.margin += winDiffPos;
                        container.logbook("lbdebug", "Data margin", { scale: scale, winDiffPos: winDiffPos, margin: data.margin });

                        data.iholder.css('margin-left', data.margin);
                    }
                }
            }
        );

        jQuery(document).ready(
            function() {

                jQuery('.lb-items .lb-item img').on(
                    'dragstart',
                    function(event) {
                        if (!(jQuery(this).hasClass('lb-rollover-bt'))) {
                            event.preventDefault();
                        }
                    }
                );

                jQuery('.lb-items .lb-rollover-bt').on(
                    'dragstart',
                    function(event) {

                        jQuery(this).addClass("lb-disable-click");
                        event.preventDefault();
                    }
                );

                jQuery('.lb-items .lb-rollover-bt').on(
                    'mousedown',
                    function(event) {
                        if (!jQuery(this).is("hover")) {
                            jQuery(this).removeClass("lb-disable-click");
                        }
                    }
                );

                jQuery('.lb-items .lb-rollover-bt').on(
                    'click',
                    function(event) {
                        if (jQuery(this).hasClass('lb-disable-click')) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        jQuery(this).removeClass('lb-disable-click')
                    }
                );
            }
        );
        container.find('.lb-left-arrow').click(
            function() {
                var data = container.data('logbook'),
                    speed = data.options.scrollSpeed;

                var leftDo = false;
                data.setClickLeft = false;
                if (data.currentIndex > 0) {
                    leftDo = true;
                    container.find(".lb-left-arrow , .lb-right-arrow").animate({ opacity: 0 }, 100);
                    data.setClickLeft = true;
                }

                container.logbook('lbleft');
                if (leftDo) {
                    setTimeout(
                        function() {
                            container.find(".lb-left-arrow , .lb-right-arrow").animate({ opacity: 1 }, 100);
                            data.setClickLeft = false;
                        },
                        speed
                    );
                }

            }
        );
        container.find('.lb-right-arrow').click(
            function() {
                var data = container.data('logbook'),
                    speed = data.options.scrollSpeed;
                var rightDo = false;

                data.setClickRight = false;
                if (data.currentIndex < data.itemCount - 1) {
                    rightDo = true;
                    data.setClickRight = true;
                    container.find(".lb-left-arrow , .lb-right-arrow").animate({ opacity: 0 }, 100);
                }
                container.logbook('lbright');
                if (rightDo) {
                    setTimeout(
                        function() {
                            container.find(".lb-left-arrow , .lb-right-arrow").animate({ opacity: 1 }, 100);
                            data.setClickRight = false;
                        },
                        speed
                    );
                }

            }
        );
        if (opt.enableSwipe) {
            items.find('*').each(function() { jQuery(this).css({ '-webkit-touch-callout': 'none', '-webkit-user-select': 'none', '-khtml-user-select': 'none', '-moz-user-select': 'none', '-ms-user-select': 'none', 'user-select': 'none' }); });
            container.bind('touchstart', function(e) { container.logbook('lbtouchstart', e); });
            container.find(opt.class.item).mousedown(
                function(e) {
                    if (jQuery(e.target).hasClass("lb-open-dialog")) {
                        return;
                    }
                    if (jQuery(e.target).hasClass("lb-icon")) {
                        return;
                    }
                    container.logbook('lbmousedown', e.pageX);
                }
            );
            jQuery(document).bind(
                'touchend',
                function(e) {
                    data = container.data('logbook');
                    container.logbook('lbtouchend', data.touchpos);
                }
            );
            jQuery(document).mouseup(
                function(e) {
                    if (jQuery(e.target).hasClass("lb-open-dialog")) {
                        return;
                    }
                    if (jQuery(e.target).hasClass("lb-icon")) {
                        return;
                    }
                    var data = container.data('logbook');
                    if (typeof data != 'undefined' && data.mousedown) {
                        container.logbook('lbmouseup', e.pageX);
                    }
                }
            );
        }
        if (!opt.isPostLink) {
            container.find(opt.class.readMore).click(
                function() {
                    container.logbook("lbdebug", "Click on read more", { id: jQuery(this).attr('data-id'), count: jQuery(this).attr('data-count') });

                    container.logbook('lbgoto', jQuery(this).attr('data-id'), jQuery(this).attr('data-count'), true);
                }
            );
            container.find(".lb-read-more").click(
                function() {
                    container.logbook("lbdebug", "Click on read more", { id: jQuery(this).attr('data-id'), count: jQuery(this).attr('data-count') });
                    container.logbook('lbgoto', jQuery(this).attr('data-id'), jQuery(this).attr('data-count'), true);

                }
            );
        } else {
            container.find(".lb-read-more").click(
                function() {
                    var url = jQuery(this).data('href');
                    var win = window.open(url, '_blank');
                    win.focus()
                }
            );
        }
        container.find('.lb-close').click(
            function() {
                container.logbook("lbdebug", "Click cloce open", { id: jQuery(this).attr('data-id'), count: jQuery(this).attr('data-count') });
                container.logbook('lbclose', jQuery(this).attr('data-id'), jQuery(this).attr('data-count'));
            }
        );
        container.css({ height: 'auto' }).show();
        container.prev('.lb-loader').hide();
        container.find('.lb-line-node').each(
            function() {
                if (jQuery(this).width() < 10) {
                    jQuery(this).width(12);
                }
                jQuery(this).css({ marginLeft: -jQuery(this).width() / 2 });
            }
        );

        var cw = container.width();
        var lineW = container.find(".lb-line-holder").width();
        var win_diff = cw - lineW;
        if (win_diff < 60 && win_diff > 0) {
            if (win_diff > 0) {
                var aPixel = win_diff / 2 + 4;
                container.find('#lb_line_left').css('left', '-' + aPixel + 'px');
                container.find('#lb_line_right').css('right', '-' + aPixel + 'px');

            }
        } else {
            container.find('#lb_line_left').css('left', '');
            container.find('#lb_line_right').css('right', '');

        }
        if (opt.mousewheel == true) {
            container.mousewheel(
                function(event) {
                    event.preventDefault();
                    if (event.deltaY == 1) {
                        container.logbook('lbleft');
                    }
                    if (event.deltaY == -1) {
                        container.logbook('lbright');
                    }
                }
            );
        }

        return container;
    }

})(jQuery);