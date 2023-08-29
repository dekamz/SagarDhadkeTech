;
'use strict';
var wptlpublic = {
    init: function() {
        $ = jQuery;
        this.do_height();
        this.run_flexslider();
    },
    do_height: function() {
        a = this;
        a.set_height();
        $('.wtl-schedule-wrap').bind(
            'DOMSubtreeModified',
            function() {
                a.set_height();
            }
        );
    },
    set_height: function() {
        $('.wtl-schedule-meta-content').each(
            function() {
                h = $(this).height();
                h = h + 'px';
                $(this).parents('.wtl-schedule-post-content').css('min-height', h);
                $('.wtl_template_hire_layout .wtl-schedule-wrap:before').css('float', 'inherit');
            }
        );
    },
    auto_height: function(target) {
        var maxHeight = 0;
        $ = jQuery;
        $(target).each(function() {
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight() - 100;
            }
        }).height(maxHeight);
    },
    run_flexslider: function() {
        if ($('.wtl-flexslider.flexslider').length > 0) {
            $('.wtl-flexslider.flexslider').flexslider({ animation: "slide", controlNav: false, prevText: "", nextText: "", rtl: ajax_object.is_rtl });
        }
    },

};;
(function($) {
    $(window).load(
        function() {
            wptlpublic.init();
            if (typeof AOS != "undefined") {
                AOS.init({ startEvent: 'DOMContentLoaded' });
            }
        }
    );

})(jQuery);

jQuery(document).ready(
    function() {
        (function($) {
            if (typeof AOS != "undefined") {
                AOS.init();
            }
            // wptlpublic.auto_height('#wtl_boxy_layout .wtl_blog_template.media-grid');
            //wptlpublic.auto_height('.blog_template.wise_block_blog');
        }(jQuery))
    }
);

jQuery(document).ready(
    function() {
        (function($) {
            if ($(window).width() > 767) {
                var parent_element = $('.wp_timeline_post_list.zigzag_layout .wtl-schedule-all-post-content .content-main');
                parent_element.each(function() {
                    var post = $(this),
                        postScroll = post.height();
                    postScroll = postScroll + 20;
                });
                var t_parent_element = $('.wp_timeline_post_list.top_divide_layout .wtl-main-social-cat-content');
                t_parent_element.each(function() {
                    var post = $(this),
                        postScroll = post.height();

                    postScroll = postScroll;

                    post.parents('.wtl-post-content').find('.wtl-head-post').css('margin-bottom', postScroll);
                });
            }

        }(jQuery))
    }
);
jQuery(document).ready(
    function() {
        (function($) {
        jQuery('.sportking_layout .wtl_al_slider .wtl-schedule-post-content:nth-child(3n-2)').addClass('wtl-boxOne-sl');

		jQuery('.sportking_layout .wtl_al_slider .wtl-schedule-post-content:nth-child(3n-1)').addClass('wtl-boxTwo-sl');

		jQuery('.sportking_layout .wtl_al_slider .wtl-schedule-post-content:nth-child(3n)').addClass('wtl-boxThree-sl');

		jQuery('.sportking_layout .wtl_al_slider .wtl-schedule-post-content:nth-child(3n-1)').addClass('wtl-grid-sl-2');

		jQuery('.sportking_layout .wtl_al_slider .wtl-schedule-post-content:nth-child(3n)').addClass('wtl-grid-sl');

        }(jQuery))
    }
);

jQuery(document).ready(
    function() {
        (function($) {
            $('.leafty_layout .leftmdate').click(function(e) {
                e.preventDefault();
            });
        }(jQuery))
    }
);

jQuery(document).ready(
    function() {
        (function($) {
            $('.sportking_layout .leftmdate').click(function(e) {
                e.preventDefault();
            });
        }(jQuery))
    }
);


(function($) {

    $(document).ready(function() {
        setupFade();
        setupClickToScroll();
        setupPostAnimation();
        setupScrollToTop();
        enableScrollAbortion();

        // Trigger window.scroll, this will initiate some of the scripts
        $(window).scroll();
    });


    // Allow user to cancel scroll animation by manually scrolling
    function enableScrollAbortion() {
        var $viewport = $('html, body');
        $viewport.on('scroll mousedown DOMMouseScroll mousewheel keyup', function(e) {
            if (e.which > 0 || e.type === 'mousedown' || e.type === 'mousewheel') {
                $viewport.stop();
            }
        });
    }

    function setupScrollToTop() {
        var scrollSpeed = 750;
        $('.trigger-scroll-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, scrollSpeed);
        });
    }


    function setupPostAnimation() {
        var posts = $('.filledtimeline .wtl-schedule-wrap .wtl-schedule-post-content');
        $(window).on('scroll resize', function() {

            var currScroll = $(window).scrollTop() > $(document).scrollTop() ? $(window).scrollTop() : $(document).scrollTop(),
                windowHeight = $(window).height(), // Needs to be here because window can resize
                overScroll = Math.ceil(windowHeight * .20),
                treshhold = (currScroll + windowHeight) - overScroll;

            posts.each(function() {

                var post = $(this),
                    postScroll = post.offset().top

                if (postScroll > treshhold) {
                    post.addClass('hiddentext');
                } else {
                    post.removeClass('hiddentext');
                }

            });

        });
    }

    function setupFade() {

        var posts = $('.filledtimeline .wtl-schedule-wrap .wtl-schedule-post-content').reverse(),
            stemWrapper = $('.stem-wrapper'),
            stemWrappericon = $('.stem-wrappericon'),
            halfScreen = $(window).height() / 2;

        $(window).on('scroll resize', function() {

            delay(function() {

                var currScroll = $(window).scrollTop() > $(document).scrollTop() ? $(window).scrollTop() : $(document).scrollTop(),
                    scrollSplit = currScroll + halfScreen;

                posts.removeClass('topactive').each(function() {
                    var post = $(this),
                        postOffset = post.offset().top;

                    if (scrollSplit > postOffset) {
                        post.addClass('topactive');
                    }
                });

                posts.removeClass('active').each(function() {

                    var post = $(this),
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

        });

    }


    function setupClickToScroll(post) {

        var scrollSpeed = 750;

        $('.filledtimeline .wtl-schedule-wrap .wtl-schedule-post-content .wtl-post-center-image').click(function(e) {
            e.preventDefault();

            var icon = $(this),
                post = icon.closest('.wtl-schedule-post-content'),
                postTopOffset = post.offset().top,
                postHeight = post.height(),
                halfScreen = $(window).height() / 2,
                scrollTo = postTopOffset - halfScreen + (postHeight / 2);

            $('html, body').animate({
                scrollTop: scrollTo
            }, scrollSpeed);
        });

    }

})(jQuery);

jQuery(document).ready(
    function() {
        (function($) {
            var parent_element = $('#wtl_classictimeline_layout').find('.wtl-blog-image');
            parent_element.each(function() {
                if ($(this).find('.schedule-image-wrapper.wtl-post-thumbnail').length == 0) {
                    $(this).css('border', 'none');
                }
            });
            var parent_element_hire = $('.wtl_template_hire_layout');
            parent_element_hire.each(function() {
                if ($(this).find('.schedule-image-wrapper.wtl-post-thumbnail')) {
                    $('.wtl-post-content').css('margin-top', '30px');
                }
                if ($(window).width() < 768) {
                    if ($(this).find('.schedule-image-wrapper.wtl-post-thumbnail')) {
                        $('.wtl-post-title').css('margin-top', '30px');
                        $('.wtl-post-content').css('margin-top', '0');
                    }
                }
            });
            var parent_element_divide = $('.divide_layout');
            parent_element_divide.each(function() {
                if ($(window).width() < 768) {
                    if ($(this).find('.schedule-image-wrapper.wtl-post-thumbnail')) {
                        $('.divide_layout span.wtl-post-content-ss-left i').css('top', '90%');
                    } else {
                        $('.divide_layout span.wtl-post-content-ss-left i').css('top', '75%');
                    }
                }
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
            $(".blog_template.timeline_graph").each(function() {
                if( $(this).find('.schedule-image-wrapper.wtl-post-thumbnail').length == 0 ) {
                    $(this).find('.horizantal-line').hide();
                } else {
                    $(this).find('.horizantal-line').show();
                }
            });
            if( $(".wtl-read-more-div").length == 0 ) {
                $(".popup_story").css("margin-left", "0");
            } else {
                $(".popup_story").css("margin-left", "10px");
            }
        }(jQuery))
    }
);

var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

jQuery.fn.reverse = function() {
    return this.pushStack(this.get().reverse(), arguments);
};

jQuery(document).ready(function() {
    jQuery('.wp-timeline-post-image.post-image figure .img-overlay a[rel^=lightcase], .post-image .img-overlay a[rel^=lightcase], .wtl-post-thumbnail .img-overlay a[rel^=lightcase]').lightcase({
        transition: "elastic",
        // speedIn: 250,
        // speedOut: 250,
        showTitle: true,
        slideshow: true,
        // timeout: 2000,
        useKeys: true,
        navigateEndless: true,
        showSequenceInfo: true,
        maxWidth: 500,
        maxHeight: 500,
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

    jQuery(function () {
        jQuery(window).on('scroll', function () {
            addClassOnScroll();
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