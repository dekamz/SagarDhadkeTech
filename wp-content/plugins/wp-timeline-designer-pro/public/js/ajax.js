"use strict";
var wtlajax = {
    init: function() {
        $ = jQuery;
    },
    load_more_ajax($data, template, layout_id) {
        var lclass = ".layout_id_" + layout_id;
        var paged = parseInt($(lclass + ' #wtl-load-more-hidden #paged').val());
        var this_year = $(lclass + ' #wtl-load-more-hidden #this_year').val();
        var $timeline_year = $(lclass + ' #wtl-load-more-hidden #timeline_previous_year').val();
        paged = paged + 1;
        var max_num_pages = parseInt($(lclass + ' #wtl-load-more-hidden #max_num_pages').val());
        $(lclass + ' .wp-timeline-load-more-btn').addClass('loading');
        $(lclass + ' .wp-timeline-load-more-btn').fadeOut();
        if (paged <= max_num_pages) {
            $(lclass + ' .loading-image').fadeIn();
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: 'action=get_load_onscroll_blog&' + $data  + '&nonce=' + ajax_object.ajax_nonce,
                cache: false,
                success: function(re) {
                    var jsmasonry = $(lclass + " .wp-timeline-load-more-pre").find("div");
                    $(window).bind('scroll', wtl_animate_elems);
                    $(lclass + ' div.wp-timeline-load-more-pre').append(re);
                    $(lclass + ' .wp-timeline-load-more-btn').removeClass('loading');
                    $(lclass + ' .loading-image').fadeOut();
                    $(lclass + ' .wp-timeline-load-more-btn').fadeIn();
                    $(lclass + ' #wtl-load-more-hidden #paged').val(paged);
                    $(lclass + ' .edd-no-js').hide();
                    if (paged == max_num_pages) {
                        $(lclass + ' .wp-timeline-load-more-btn').fadeOut();
                    }
                    setTimeout(
                        function() {
                            AOS.refresh();
                            AOS.refreshHard();
                            if( template == 'business_layout' || template == 'timeline_graph_layout' ) {
                                $('.wtl_blog_template .blog_template:nth-child(odd)').addClass('wtl_left_side');
                                $('.wtl_blog_template .blog_template:nth-child(even)').addClass('wtl_right_side');
                                if (jQuery('.masonry').length > 0) {
                                    jQuery('.masonry').imagesLoaded(
                                        function() {
                                            jQuery('.masonry').masonry('reload');
                                        }
                                    );
                                }
                            }
                        },
                        1000
                    );

                }
            });
        }
        return false;
    },
    load_more_date_ajax($data, template, layout_id) {
        var lclass = ".layout_id_" + layout_id;
        var paged = parseInt($(lclass + ' #wtl-load-more-hidden #paged').val());
        var this_year = $(lclass + ' #wtl-load-more-hidden #this_year').val();
        var $timeline_year = $(lclass + ' #wtl-load-more-hidden #timeline_previous_year').val();
        paged = paged + 1;
        var max_num_pages = parseInt($(lclass + ' #wtl-load-more-hidden #max_num_pages').val());
        $(lclass + ' .wp-timeline-load-more-btn').addClass('loading');
        $(lclass + ' .wp-timeline-load-more-btn').fadeOut();
        if (paged <= max_num_pages) {
            $(lclass + ' .loading-image').fadeIn();
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: 'action=get_load_onscroll_date&' + $data + '&nonce=' + ajax_object.ajax_nonce,
                cache: false,
                success: function(re) {
                    var jsmasonry = $(lclass + " .wp-timeline-load-more-pre").find("div");
                    $(window).bind('scroll', wtl_animate_elems);
                    $('.section-bullets-right').append(re);
                    $(lclass + ' .wp-timeline-load-more-btn').removeClass('loading');
                    $(lclass + ' .loading-image').fadeOut();
                    $(lclass + ' .wp-timeline-load-more-btn').fadeIn();
                    $(lclass + ' #wtl-load-more-hidden #paged').val(paged);
                    $(lclass + ' .edd-no-js').hide();
                    if (paged == max_num_pages) {
                        $(lclass + ' .wp-timeline-load-more-btn').fadeOut();
                    }
                    setTimeout(
                        function() {
                            AOS.refresh();
                            AOS.refreshHard();
                        },
                        1000
                    );

                }
            });
        }
        return false;
    },
    load_onscroll_ajax: function(layout_id, template) {
        var lclass = ".layout_id_" + layout_id;
        var blmh = '#wtl-load-more-hidden';
        var paged = parseInt($(lclass + ' ' + blmh + ' #paged').val());
        var $timeline_year = $(lclass + ' ' + blmh + ' #timeline_previous_year').val();
        paged = paged + 1;
        var max_num_pages = parseInt($(lclass + ' ' + blmh + ' #max_num_pages').val());
        $(lclass + ' .wtl-load-onscroll-btn').addClass('loading');
        var this_year = $(blmh + ' #this_year').val();
        $(lclass + ' .wtl-load-onscroll-btn').fadeOut();
        if (paged <= max_num_pages) {
            $(lclass + ' .loading-image').fadeIn();
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: 'action=get_load_onscroll_blog&' + $(lclass + ' ' + blmh + '').serialize() + '&nonce=' + ajax_object.ajax_nonce, 
                cache: false,
                success: function(re) {
                    var jm = $(lclass + " .wtl-load-onscroll-pre").find("div");
                    $(window).bind('scroll', wtl_animate_elems);
                    $(lclass + ' div.wtl-load-onscroll-pre').append(re);
                    $(lclass + ' .wtl-load-onscroll-btn').removeClass('loading');
                    $(lclass + ' .loading-image').fadeOut();
                    $(lclass + ' .wtl-load-onscroll-btn').fadeIn();
                    $(lclass + ' div.wtl-load-onscroll').show();
                    $(lclass + ' ' + blmh + ' #paged').val(paged);
                    $(lclass + ' .edd-no-js').hide();
                    if (paged == max_num_pages) {
                        $(lclass + ' .wtl-load-onscroll-btn').fadeOut();
                    }
                    setTimeout(
                        function() {
                            AOS.refresh();
                            AOS.refreshHard();
                            if(template == 'business_layout' || template == 'timeline_graph_layout' ) {
                                $('.wtl_blog_template .blog_template:nth-child(odd)').addClass('wtl_left_side');
                                $('.wtl_blog_template .blog_template:nth-child(even)').addClass('wtl_right_side');
                                if (jQuery('.masonry').length > 0) {
                                    jQuery('.masonry').imagesLoaded(
                                        function() {
                                            jQuery('.masonry').masonry('reload');
                                        }
                                    );
                                }
                            }
                        },
                        1000
                    );
                }
            });
        }
        return false;
    },
    post_like: function() {
        $ = jQuery;
        $(document).on('click', '.wtl-wrapper-like .wtl-like-button', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var post_id = $(this).attr('data-post-id');
            var security = $(this).attr('data-nonce');
            var allbuttons;
            allbuttons = $('.bdp-button-' + post_id);
            var loader = allbuttons.next('#bdp-loader');
            if (post_id !== '') {
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'get_wtl_process_posts_like',
                        post_id: post_id,
                        nonce: security
                    },
                    beforeSend: function() {
                        loader.html('<div class="bdp-like-loader"><i class="fas fa-spinner fa-pulse fa-1x fa-fw"></i></div>');
                    },
                    success: function(response) {
                        var icon = response.icon;
                        var count = response.count;
                        allbuttons.html(icon + count);
                        if (response.status === 'unliked') {
                            var like_text = ajax_object.like;
                            allbuttons.prop('title', like_text);
                            allbuttons.removeClass('liked');
                        } else {
                            var unlike_text = ajax_object.unlike;
                            allbuttons.prop('title', unlike_text);
                            allbuttons.addClass('liked');
                        }
                        loader.empty();
                    }
                });

            }
            return false;
        });

    }


};

jQuery(document).ready(
    function() {
        (function($) {
            $(document).on('click', '.wtl-accordion-head-content > h2', (function() {
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

            $(document).on('click', '.wtl-collapsible-head-content > h2', (function() {
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
            wtlajax.post_like();
            jQuery('#wp_timeline_sort_by').on(
                'change',
                function() {
                    var key = encodeURI('sortby');
                    var value = encodeURI(jQuery(this).val());
                    var current_sort_value = document.location.search.substr(1).split('&');
                    var i = current_sort_value.length;
                    var x;
                    while (i--) {
                        x = current_sort_value[i].split('=');
                        if (x[0] == key) {
                            x[1] = value;
                            current_sort_value[i] = x.join('=');
                            break;
                        }
                    }
                    if (i < 0) {
                        current_sort_value[current_sort_value.length] = [key, value].join('=');
                    }
                    document.location.search = current_sort_value.join('&');
                }
            );
            if (jQuery('.chosen-select').length > 0) {
                var config = {
                    '.chosen-select': {},
                    '.chosen-select-deselect': { allow_single_deselect: true },
                    '.chosen-select-no-single': { disable_search_threshold: 10 },
                    '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
                    '.chosen-select-width': { width: "95%" }
                }
                jQuery(".chosen-select").chosen();
            }
            // For Overlay Horizontal Template
            var logbookMaxHeight = Math.max.apply(
                null,
                jQuery('.overlay_horizontal .post_hentry').map(
                    function() {
                        return jQuery(this).height();
                    }
                ).get()
            );
            if (logbookMaxHeight == 0) {
                logbookMaxHeight = '420';
            }
            jQuery('.logbook .lb-item .post-image img').css('min-height', Math.round(logbookMaxHeight));
            jQuery('.logbook .lb-item .post-image').css('min-height', Math.round(logbookMaxHeight));

            // For Cool Horizontal Template
            var maxHeight = Math.max.apply(
                null,
                jQuery('.horizontal .post-title').map(
                    function() {
                        return jQuery(this).height();
                    }
                ).get()
            );
            jQuery('.horizontal .post-title').css('min-height', maxHeight + 70);

            var maxHeight = Math.max.apply(
                null,
                jQuery('.horizontal .post-content-area .post_wrapper').map(
                    function() {
                        return jQuery(this).height();
                    }
                ).get()
            );
            jQuery('.horizontal .post-content-area .post_wrapper').css('min-height', Math.round(maxHeight));

            // For load more functionality
            jQuery(".wp-timeline-load-more-btn").click(
                function() {
                    var layout_id = jQuery(this).closest('.wtl_wrapper').find('#wp_timeline_blog_shortcode_id').val();
                    var $data = jQuery(this).closest('.wtl_wrapper').find('form#wtl-load-more-hidden').serialize();
                    var template = jQuery(this).closest('.wtl_wrapper').find('#wtl_blog_template').val();
                    wtlajax.load_more_ajax($data, template, layout_id);
                    wtlajax.load_more_date_ajax($data, template, layout_id);
                }
            );

            jQuery(".wtl-load-onscroll-btn").click(
                function() {
                    var layout_id = jQuery(this).closest('.wtl_wrapper').find('#wp_timeline_blog_shortcode_id').val();
                    var template = jQuery(this).closest('.wtl_wrapper').find('#wtl_blog_template').val();
                    var $select_value = jQuery('#wp-timeline-filer-change select').val();
                    if ($select_value == null || $select_value == 'undefined') {
                        wtlajax.load_onscroll_ajax(layout_id, template);
                    }
                }
            );

            var ajax_window = jQuery(window);
            ajax_window.bind(
                "scroll touchstart",
                function() {
                    if (jQuery('a.wtl-load-onscroll-btn').length >= 1) {
                        var content_offset = jQuery('a.wtl-load-onscroll-btn').offset();
                        var top = Math.round(content_offset.top - jQuery(window).height());
                        if (jQuery(window).scrollTop() >= top) {
                            if (jQuery('div.wtl-load-onscroll').is(':visible')) {
                                jQuery('div.wtl-load-onscroll').hide();
                                jQuery('.wtl-load-onscroll-btn').trigger('click');
                            }
                        }
                    }
                }
            );
            jQuery(
                function() {
                    var elems = jQuery('.animateblock');
                    var winheight = jQuery(window).height();
                    elems.each(
                        function() {
                            var elm = jQuery(this);
                            var topcoords = elm.offset().top;
                            if (topcoords < winheight) {
                                // animate when top of the window is 3/4 above the element
                                elm.addClass('animated');
                                elm.removeClass('animateblock');
                            }
                        }
                    );

                    jQuery('.timeline').each(
                        function() {
                            if (jQuery(this).offset().top < winheight) {
                                var width = jQuery(this).attr('data-width');
                                jQuery(this).animate({
                                        width: width
                                    },
                                    1000
                                );
                            }
                        }
                    );

                    jQuery(window).scroll(
                        function() {
                            wtl_animate_elems();
                        }
                    );

                }
            );
        }(jQuery))
    }
);

// For load more functionality

jQuery(
    function() {
        easy_timeline_effects();
        steps_effects();
        social_share_div();
    }
);

function social_share_div() {
    var maxWidth = Math.max.apply(
        null,
        jQuery('.post-media').map(
            function() {
                return jQuery(this).width();
            }
        ).get()
    );
    maxWidth = (maxWidth / 2) + 10;
    var cusstyle = '<style> .post-content-area:before { border-left-width: ' + Math.round(maxWidth) + 'px; } .post-media:before { border-right-width: ' + Math.round(maxWidth) + 'px; } .post-media:after { border-left-width: ' + Math.round(maxWidth) + 'px; } </style>'
    jQuery('head').append(cusstyle);
}

function easy_timeline_effects() {
    var effect = jQuery('.easy-timeline').attr('data-effect');
    jQuery('.easy-timeline li').each(
        function() {
            if (jQuery(this).offset().top > jQuery(window).scrollTop() + jQuery(window).height() * 0.75) {
                jQuery(this).addClass('is-hidden');
            } else {
                jQuery(this).addClass(effect);
            }
        }
    );

    jQuery(window).on(
        'scroll',
        function() {
            jQuery('.easy-timeline li').each(
                function() {
                    if ((jQuery(this).offset().top <= (jQuery(window).scrollTop() + jQuery(window).height() * 0.75)) && jQuery(this).hasClass("is-hidden")) {
                        jQuery(this).removeClass("is-hidden").addClass(effect);
                    }
                }
            );
        }
    );
}

function steps_effects() {
    var effect = jQuery('.steps-wrapper .steps').attr('data-effect');
    jQuery('.steps-wrapper .steps li').each(
        function() {
            if (jQuery(this).offset().top > jQuery(window).scrollTop() + jQuery(window).height() * 0.75) {
                jQuery(this).addClass('is-hidden');
            } else {
                jQuery(this).addClass(effect);
            }
        }
    );

    jQuery(window).on(
        'scroll',
        function() {
            jQuery('.steps-wrapper .steps li').each(
                function() {
                    if ((jQuery(this).offset().top <= (jQuery(window).scrollTop() + jQuery(window).height() * 0.75)) && jQuery(this).hasClass("is-hidden")) {
                        jQuery(this).removeClass("is-hidden").addClass(effect);
                    }
                }
            );
        }
    );
}

function wtl_animate_elems() {
    var elems = jQuery('.animateblock');
    var winheight = jQuery(window).height();
    var wintop = jQuery(window).scrollTop(); // calculate distance from top of window

    // loop through each item to check when it animates
    elems.each(
        function() {
            var elm = jQuery(this);
            if (elm.hasClass('animated')) {
                return true;
            } // if already animated skip to the next item
            var topcoords = elm.offset().top; // element's distance from top of page in pixels
            if (wintop > (topcoords - (winheight * 0.6))) {
                // animate when top of the window is 3/4 above the element
                elm.addClass('animated');
                elm.removeClass('animateblock');
            }
        }
    );
    jQuery('.timeline').each(
        function() {
            if (wintop > jQuery(this).offset().top - winheight) {
                var width = jQuery(this).attr('data-width');
                jQuery(this).animate({
                        width: width
                    },
                    500
                );
            }
        }
    );
}



jQuery(window).on(
    'load',
    function() {
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
    }
);