"use strict";
var wtlcpt = {
    init: function() {
        $ = jQuery;
        this.thumbnail_type();
        this.gallery_select();
        this.gallery_remove();
        this.video_change();
        this.set_icon();
        this.set_color();
        this.upload_image();
        this.remove_image();
    },
    thumbnail_type: function() {
        var aw = $('.wtl-single-audio-type-wrap');
        var af = $('.wtl_single_audio_format');
        var sv = $('.wtl_single_video_format');
        var sw = $('.wtl-single-video-type-wrap');
        var pf = $('#wtl_thumbnail_type');
        $('.buttonset').buttonset();
        af.hide();
        aw.hide();
        sv.hide();
        sw.hide();
        if (pf.val() == 'video') {
            sv.show();
            sw.show()
        } else if (pf.val() == 'audio') {
            af.show();
            aw.show();
        }
        pf.change(function() {
            var value = $(this).val();
            af.hide();
            aw.hide();
            sv.hide();
            sw.hide();
            if (value == 'video') {
                sw.show();
                sv.show();
                video_types();
            } else if (pf.val() == 'audio') {
                af.show();
                aw.show();
                audio_types();
            }
        });

        function audio_types() {
            var audio_type = jQuery('.wtl_single_audio_type').val();
            if (audio_type == 'soundcloud') {
                jQuery('.wtl-single-audio-type-wrap .wtl-single-audio-description').text('Enter track ID of the Soundcloud audio.');
                jQuery('.wtl-single-audio-type-wrap .wtl-single-label').text('Soundcloud track ID');
            }
            if (audio_type == 'mixcloud') {
                jQuery('.wtl-single-audio-type-wrap .wtl-single-audio-description').text('Enter URL of the Mixcloud audio.');
                jQuery('.wtl-single-audio-type-wrap .wtl-single-label').text('Mixcloud track URL');
            }
            if (audio_type == 'beatport') {
                jQuery('.wtl-single-audio-type-wrap .wtl-single-audio-description').text('Enter ID of the Beatport audio.');
                jQuery('.wtl-single-audio-type-wrap .wtl-single-label').text('Beatport track ID');
            }
            jQuery('input[name="wtl_single_audio_id"]').val('');
        }

        function video_types() {
            var video_type = jQuery('.wtl_single_video_type').val();
            if (video_type == 'youtube') {
                jQuery('.wtl-single-video-type-wrap .wtl-single-video-description').text('Enter the ID of the Youtube video.');
                jQuery('.wtl-single-video-type-wrap .wtl-single-label').text('Youtube video ID');
            }
            if (video_type == 'vimeo') {
                jQuery('.wtl-single-video-type-wrap .wtl-single-video-description').text('Enter the ID of the Vimeo video.');
                jQuery('.wtl-single-video-type-wrap .wtl-single-label').text('Vimeo video ID');
            }
            if (video_type == 'screenr') {
                jQuery('.wtl-single-video-type-wrap .wtl-single-video-description').text('Enter the ID of the Screenr video.');
                jQuery('.wtl-single-video-type-wrap .wtl-single-label').text('Screenr video ID');
            }
            if (video_type == 'dailymotion') {
                jQuery('.wtl-single-video-type-wrap .wtl-single-video-description').text('Enter the ID of the Dailymotion video.');
                jQuery('.wtl-single-video-type-wrap .wtl-single-label').text('Dailymotion video ID');
            }
            if (video_type == 'metacafe') {
                jQuery('.wtl-single-video-type-wrap .wtl-single-video-description').text('Enter the ID and slug of the Metacafe video.');
                jQuery('.wtl-single-video-type-wrap .wtl-single-label').text('Metacafe video ID');
            }
            if (video_type == 'html5') {
                jQuery('.wtl-single-video-type-wrap .wtl-single-video-description').text('Enter the URL of the Html5 video.');
                jQuery('.wtl-single-video-type-wrap .wtl-single-label').text('Html5 video url');
            }
            jQuery('input[name="wtl_single_video_id"]').val('');
        }

        $('.wtl_single_audio_type').change(function() {
            audio_types();
        });
        $('.wtl_single_video_type').change(function() {
            video_types();
        });
        var of = $('.wtl-option-timeline-icon-fontawesome');
        var oi = $('.wtl-option-timeline-icon-image');
        var oc = $('.wtl_single_display_timeline_icon');
        of.hide();
        oi.hide();
        if (oc.val() == 'fontawesome') { of.show() } else if (oc.val() == 'image') { oi.show() }
        oc.change(function() {
            var vl = $(this).val();
            of.hide();
            oi.hide();
            if (vl == 'fontawesome') { of.show() } else if (vl == 'image') { oi.show() }
        });
    },
    gallery_select: function() {
        $('#wtl_gallery_select').on('click', function(e) {
            e.preventDefault();
            if (file_frame) { file_frame.open(); return }
            var file_frame = wp.media.frame = wp.media({ frame: "post", state: "wtl-gallery", library: { type: 'image' }, button: { text: 'Edit Image Order' }, multiple: true });
            file_frame.states.add([new wp.media.controller.Library({ id: 'wtl-gallery', title: wtl_admin_cpts_translations.select_gallery, priority: 20, toolbar: 'main-gallery', filterable: 'uploaded', library: wp.media.query(file_frame.options.library), multiple: file_frame.options.multiple ? 'reset' : false, editable: true, allowLocalEdits: true, displaySettings: true, displayUserSettings: true })]);
            file_frame.on('open', function() {
                var sl = file_frame.state().get('selection');
                var lb = file_frame.state('gallery-edit').get('library');
                var ids = $('#wtl_gallery_images').val();
                if (ids) {
                    idsArray = ids.split(',');
                    idsArray.forEach(function(id) {
                        at = wp.media.attachment(id);
                        at.fetch();
                        sl.add(at ? [at] : [])
                    });
                    file_frame.setState('gallery-edit');
                    idsArray.forEach(function(id) {
                        at = wp.media.attachment(id);
                        at.fetch();
                        lb.add(at ? [at] : [])
                    })
                }
            });
            file_frame.on('update', function() {
                var ir = [];
                var imageHTML = '';
                var metadataString = '';
                ig = file_frame.state().get('library');
                ig.each(function(attachment) {
                    ir.push(attachment.attributes.id);
                    imageHTML += '<li>' + '<button></button>' + '<img id="' + attachment.attributes.id + '" src="' + attachment.attributes.url + '"></li>';
                });
                metadataString = ir.join(",");
                if (metadataString) {
                    $("#wtl_gallery_images").val(metadataString);
                    $(".gallery_image_wrap ul").html(imageHTML);
                    $('#wtl_gallery_select').text('Edit Selection');
                    $('#wtl_gallery_removeall').removeClass('hidden')
                }
            });
            file_frame.open();
            e.stopImmediatePropagation();

        });

    },
    gallery_remove: function() {
        $('#wtl_gallery_removeall').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove all images?')) {
                $(".gallery_image_wrap ul").html("");
                $("#wtl_gallery_images").val("");
                $('#wtl_gallery_removeall').addClass('hidden');
                $('#wtl_gallery_select').text('Select Image');
            }
            e.stopImmediatePropagation();
        });
        $(document).on('click', '.gallery_image_wrap ul li button', function(e) {
            e.preventDefault();
            if (confirm(wtl_admin_cpts_translations.conformation)) {
                var ri = $(this).parent().children('img').attr('id');
                var og = $("#wtl_gallery_images").val();
                var ng = og.replace(',' + ri, '').replace(ri + ',', '').replace(ri, '');
                $(this).parent('li').remove();
                $("#wtl_gallery_images").val(ng);
                if (ng == "") {
                    $('#wtl_gallery_select').text('Select Image');
                    $('#wtl_gallery_removeall').removeClass('visible')
                }
            }
        });
    },
    video_change: function() {
        var pl = $('.wtl-post-link');
        $('.wtl-single-video-type').on('change', function() {
            wtlcpt.video_thumbnail_type();
            $('input[name="wtl-single-video-id"]').val('');
        });
        if ($('input[name="wtl_display_post_custom_link"]:checked').val() == 0) { pl.hide() } else { pl.show() }
        $('input[name="wtl_display_post_custom_link"]').on('click', function() {
            if ($('input[name="wtl_display_post_custom_link"]:checked').val() == 0) { pl.hide() } else { pl.show() }
            wp_timelineAltBackground();
        });
    },
    set_icon: function() {
        var ww = '.wtl_single_icon_wrap ';
        $(ww + " div.dialogbox").dialog({ autoOpen: false, maxWidth: 600, maxHeight: 500, width: 600, height: 500 });
        $("#icon_search").on('keyup', function() {
            var mc = new RegExp($(this).val(), 'gi');
            $('.as-element-icon').show().not(function() { return mc.test($(this).find('span').text()) }).hide();
        });
        $(ww + " .open").on('click', function(e) {
            e.preventDefault();
            var hide = $(this).prev().attr('id');
            $('.hidden_input_val').val(hide);
            var cid = '.dialogbox';
            wtlcpt.getIconSet(cid);
            $(cid).dialog("open");
            $('body').prepend("<div id='pageflip'> </div>");
        });
        $(document).on('click', '.wtl_single_icon_div .as-element-icon', function(e) {
            e.preventDefault();
            var iconclass = $(this).find('i').attr('class');
            var hide_div = $('.hidden_input_val').val();
            window.top.$(ww + ' #' + hide_div).val(iconclass);
            $('.ui-dialog-titlebar-close').trigger('click');
            $('#pageflip').remove();
        });
        $(".ui-dialog-titlebar-close").on('click', function(e) {
            e.preventDefault();
            $('#pageflip').remove();
        });
    },
    set_color: function() {
        $('.wp-timeline-color-picker input,#wp_timeline_content_border_color').wpColorPicker();
    },
    upload_image: function() {
        $(document).on('click', '.wtl_single_upload_image_button', function(e) {
            e.preventDefault();
            var frame;
            var el = $(this);
            var pr = el.closest('div');
            if (frame) { frame.open(); return }
            frame = wp.media({ title: el.data('choose'), button: { text: el.data('update'), close: false, }, multiple: false, library: { type: 'image' } });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first();
                frame.close(attachment);
                pr.find('span.wtl_default_image_holder').empty().hide().append('<img src="' + attachment.attributes.url + '">').slideDown('fast');
                var ii = '#wtl_icon_image_id',
                    im = '#wtl_icon_image_src';
                if (el.hasClass("wtl_icon_image")) {
                    pr.find(ii).val(attachment.attributes.id);
                    pr.find(im).val(attachment.attributes.url);
                } else {
                    pr.find(ii).val(attachment.attributes.id);
                    pr.find(im).val(attachment.attributes.url);
                }
                el.removeClass('wtl_single_upload_image_button');
                el.addClass('wtl_remove_image_button');
                el.val('');
                el.val('Remove Image');
            });
            frame.open();
        });
    },
    remove_image: function() {
        $(document).on('click', '.wtl_remove_image_button', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove images?')) {
                var el = $(this);
                if (el.hasClass("wtl_icon_image")) {
                    $('.wtl_icon_image.wtl_default_image_holder > img').slideDown().remove();
                    $('#wtl_icon_image_id').val('');
                    $('#wtl_icon_image_src').val('');
                    el.addClass('wtl_single_upload_image_button');
                    el.removeClass('wtl_remove_image_button');
                    el.val('');
                    el.val('Upload Image');
                } else {
                    $('.wtl_default_image_holder > img').slideDown().remove();
                    $('#wtl_icon_image_id').val('');
                    $('#wtl_icon_image_src').val('');
                    el.addClass('wtl_single_upload_image_button');
                    el.removeClass('wtl_remove_image_button');
                    el.val('');
                    el.val('Upload Image');
                }
            }
        });
    },
    video_thumbnail_type: function() {
        $ = jQuery;
        var vt = $('.wtl-single-video-type').val();
        ws = '.wtl-single-video-type-wrap ';
        wd = ws + '.wtl-single-video-description';
        wl = ws + '.wtl-single-label';
        if (vt == 'youtube') {
            $(wd).text('Enter the ID of the Youtube video.');
            $(wl).text('Youtube video ID')
        }
        if (vt == 'vimeo') {
            $(wd).text('Enter the ID of the Vimeo video.');
            $(wl).text('Vimeo video ID')
        }
        if (vt == 'screenr') {
            $(wd).text('Enter the ID of the Screenr video.');
            $(wl).text('Screenr video ID')
        }
        if (vt == 'dailymotion') {
            $(wd).text('Enter the ID of the Dailymotion video.');
            $(wl).text('Dailymotion video ID')
        }
        if (vt == 'metacafe') {
            $(wd).text('Enter the ID and slug of the Metacafe video.');
            $(wl).text('Metacafe video ID')
        }
        if (vt == 'html5') {
            $(wd).text('Enter the URL of the Html5 video.');
            $(wl).text('Html5 video url')
        }
    },
    getIconSet: function(e) {
        $ = jQuery
        var fb = ["fa-500px", "fa-accessible-icon", "fa-accusoft", "fa-adn", "fa-adversal", "fa-affiliatetheme", "fa-algolia", "fa-amazon", "fa-amazon-pay", "fa-amilia", "fa-android", "fa-angellist", "fa-angrycreative", "fa-angular", "fa-app-store", "fa-app-store-ios", "fa-apper", "fa-apple", "fa-apple-pay", "fa-asymmetrik", "fa-audible", "fa-autoprefixer", "fa-avianex", "fa-aviato", "fa-aws", "fa-bandcamp", "fa-behance", "fa-behance-square", "fa-bimobject", "fa-bitbucket", "fa-bitcoin", "fa-bity", "fa-black-tie", "fa-blackberry", "fa-blogger", "fa-blogger-b", "fa-bluetooth", "fa-bluetooth-b", "fa-btc", "fa-buromobelexperte", "fa-buysellads", "fa-cc-amazon-pay", "fa-cc-amex", "fa-cc-apple-pay", "fa-cc-diners-club", "fa-cc-discover", "fa-cc-jcb", "fa-cc-mastercard", "fa-cc-paypal", "fa-cc-stripe", "fa-cc-visa", "fa-centercode", "fa-chrome", "fa-cloudscale", "fa-cloudsmith", "fa-cloudversify", "fa-codepen", "fa-codiepie", "fa-connectdevelop", "fa-contao", "fa-cpanel", "fa-creative-commons", "fa-css3", "fa-css3-alt", "fa-cuttlefish", "fa-d-and-d", "fa-dashcube", "fa-delicious", "fa-deploydog", "fa-deskpro", "fa-deviantart", "fa-digg", "fa-digital-ocean", "fa-discord", "fa-discourse", "fa-dochub", "fa-docker", "fa-draft2digital", "fa-dribbble", "fa-dribbble-square", "fa-dropbox", "fa-drupal", "fa-dyalog", "fa-earlybirds", "fa-edge", "fa-elementor", "fa-ember", "fa-empire", "fa-envira", "fa-erlang", "fa-ethereum", "fa-etsy", "fa-expeditedssl", "fa-facebook", "fa-facebook-f", "fa-facebook-messenger", "fa-facebook-square", "fa-firefox", "fa-first-order", "fa-firstdraft", "fa-flickr", "fa-flipboard", "fa-fly", "fa-font-awesome", "fa-font-awesome-alt", "fa-font-awesome-flag", "fa-fonticons", "fa-fonticons-fi", "fa-fort-awesome", "fa-fort-awesome-alt", "fa-forumbee", "fa-foursquare", "fa-free-code-camp", "fa-freebsd", "fa-get-pocket", "fa-gg", "fa-gg-circle", "fa-git", "fa-git-square", "fa-github", "fa-github-alt", "fa-github-square", "fa-gitkraken", "fa-gitlab", "fa-gitter", "fa-glide", "fa-glide-g", "fa-gofore", "fa-goodreads", "fa-goodreads-g", "fa-google", "fa-google-drive", "fa-google-play", "fa-google-plus", "fa-google-plus-g", "fa-google-plus-square", "fa-google-wallet", "fa-gratipay", "fa-grav", "fa-gripfire", "fa-grunt", "fa-gulp", "fa-hacker-news", "fa-hacker-news-square", "fa-hips", "fa-hire-a-helper", "fa-hooli", "fa-hotjar", "fa-houzz", "fa-html5", "fa-hubspot", "fa-imdb", "fa-instagram", "fa-internet-explorer", "fa-ioxhost", "fa-itunes", "fa-itunes-note", "fa-jenkins", "fa-joget", "fa-joomla", "fa-js", "fa-js-square", "fa-jsfiddle", "fa-keycdn", "fa-kickstarter", "fa-kickstarter-k", "fa-korvue", "fa-laravel", "fa-lastfm", "fa-lastfm-square", "fa-leanpub", "fa-less", "fa-line", "fa-linkedin", "fa-linkedin-in", "fa-linode", "fa-linux", "fa-lyft", "fa-magento", "fa-maxcdn", "fa-medapps", "fa-medium", "fa-medium-m", "fa-medrt", "fa-meetup", "fa-microsoft", "fa-mix", "fa-mixcloud", "fa-mizuni", "fa-modx", "fa-monero", "fa-napster", "fa-nintendo-switch", "fa-node", "fa-node-js", "fa-npm", "fa-ns8", "fa-nutritionix", "fa-odnoklassniki", "fa-odnoklassniki-square", "fa-opencart", "fa-openid", "fa-opera", "fa-optin-monster", "fa-osi", "fa-page4", "fa-pagelines", "fa-palfed", "fa-patreon", "fa-paypal", "fa-periscope", "fa-phabricator", "fa-phoenix-framework", "fa-php", "fa-pied-piper", "fa-pied-piper-alt", "fa-pied-piper-pp", "fa-pinterest", "fa-pinterest-p", "fa-pinterest-square", "fa-playstation", "fa-product-hunt", "fa-pushed", "fa-python", "fa-qq", "fa-quinscape", "fa-quora", "fa-ravelry", "fa-react", "fa-rebel", "fa-red-river", "fa-reddit", "fa-reddit-alien", "fa-reddit-square", "fa-rendact", "fa-renren", "fa-replyd", "fa-resolving", "fa-rocketchat", "fa-rockrms", "fa-safari", "fa-sass", "fa-schlix", "fa-scribd", "fa-searchengin", "fa-sellcast", "fa-sellsy", "fa-servicestack", "fa-shirtsinbulk", "fa-simplybuilt", "fa-sistrix", "fa-skyatlas", "fa-skype", "fa-slack", "fa-slack-hash", "fa-slideshare", "fa-snapchat", "fa-snapchat-ghost", "fa-snapchat-square", "fa-soundcloud", "fa-speakap", "fa-spotify", "fa-stack-exchange", "fa-stack-overflow", "fa-staylinked", "fa-steam", "fa-steam-square", "fa-steam-symbol", "fa-sticker-mule", "fa-strava", "fa-stripe", "fa-stripe-s", "fa-studiovinari", "fa-stumbleupon", "fa-stumbleupon-circle", "fa-superpowers", "fa-supple", "fa-telegram", "fa-telegram-plane", "fa-tencent-weibo", "fa-themeisle", "fa-trello", "fa-tripadvisor", "fa-tumblr", "fa-tumblr-square", "fa-twitch", "fa-twitter", "fa-twitter-square", "fa-typo3", "fa-uber", "fa-uikit", "fa-uniregistry", "fa-untappd", "fa-usb", "fa-ussunnah", "fa-vaadin", "fa-viacoin", "fa-viadeo", "fa-viadeo-square", "fa-viber", "fa-vimeo", "fa-vimeo-square", "fa-vimeo-v", "fa-vine", "fa-vk", "fa-vnv", "fa-vuejs", "fa-weibo", "fa-weixin", "fa-whatsapp", "fa-whatsapp-square", "fa-whmcs", "fa-wikipedia-w", "fa-windows", "fa-wordpress", "fa-wordpress-simple", "fa-wpbeginner", "fa-wpexplorer", "fa-wpforms", "fa-xbox", "fa-xing", "fa-xing-square", "fa-y-combinator", "fa-yahoo", "fa-yandex", "fa-yandex-international", "fa-yelp", "fa-yoast", "fa-youtube", "fa-youtube-square"];
        var fr = ["fa-address-book", "fa-address-card", "fa-arrow-alt-circle-down", "fa-arrow-alt-circle-left", "fa-arrow-alt-circle-right", "fa-arrow-alt-circle-up", "fa-bell", "fa-bell-slash", "fa-bookmark", "fa-building", "fa-calendar", "fa-calendar-alt", "fa-calendar-check", "fa-calendar-minus", "fa-calendar-plus", "fa-calendar-times", "fa-caret-square-down", "fa-caret-square-left", "fa-caret-square-right", "fa-caret-square-up", "fa-chart-bar", "fa-check-circle", "fa-check-square", "fa-circle", "fa-clipboard", "fa-clock", "fa-clone", "fa-closed-captioning", "fa-comment", "fa-comment-alt", "fa-comments", "fa-compass", "fa-copy", "fa-copyright", "fa-credit-card", "fa-dot-circle", "fa-edit", "fa-envelope", "fa-envelope-open", "fa-eye-slash", "fa-file", "fa-file-alt", "fa-file-archive", "fa-file-audio", "fa-file-code", "fa-file-excel", "fa-file-image", "fa-file-pdf", "fa-file-powerpoint", "fa-file-video", "fa-file-word", "fa-flag", "fa-folder", "fa-folder-open", "fa-frown", "fa-futbol", "fa-gem", "fa-hand-lizard", "fa-hand-paper", "fa-hand-peace", "fa-hand-point-down", "fa-hand-point-left", "fa-hand-point-right", "fa-hand-point-up", "fa-hand-pointer", "fa-hand-rock", "fa-hand-scissors", "fa-hand-spock", "fa-handshake", "fa-hdd", "fa-heart", "fa-hospital", "fa-hourglass", "fa-id-badge", "fa-id-card", "fa-image", "fa-images", "fa-keyboard", "fa-lemon", "fa-life-ring", "fa-lightbulb", "fa-list-alt", "fa-map", "fa-meh", "fa-minus-square", "fa-money-bill-alt", "fa-moon", "fa-newspaper", "fa-object-group", "fa-object-ungroup", "fa-paper-plane", "fa-pause-circle", "fa-play-circle", "fa-plus-square", "fa-question-circle", "fa-registered", "fa-save", "fa-share-square", "fa-smile", "fa-snowflake", "fa-square", "fa-star", "fa-star-half", "fa-sticky-note", "fa-stop-circle", "fa-sun", "fa-thumbs-down", "fa-thumbs-up", "fa-times-circle", "fa-trash-alt", "fa-user", "fa-user-circle", "fa-window-close", "fa-window-maximize", "fa-window-minimize", "fa-window-restore"];
        var fs = ["fa-address-book", "fa-address-card", "fa-adjust", "fa-align-center", "fa-align-justify", "fa-align-left", "fa-align-right", "fa-ambulance", "fa-american-sign-language-interpreting", "fa-anchor", "fa-angle-double-down", "fa-angle-double-left", "fa-angle-double-right", "fa-angle-double-up", "fa-angle-down", "fa-angle-left", "fa-angle-right", "fa-angle-up", "fa-archive", "fa-arrow-alt-circle-down", "fa-arrow-alt-circle-left", "fa-arrow-alt-circle-right", "fa-arrow-alt-circle-up", "fa-arrow-circle-down", "fa-arrow-circle-left", "fa-arrow-circle-right", "fa-arrow-circle-up", "fa-arrow-down", "fa-arrow-left", "fa-arrow-right", "fa-arrow-up", "fa-arrows-alt", "fa-arrows-alt-h", "fa-arrows-alt-v", "fa-assistive-listening-systems", "fa-asterisk", "fa-at", "fa-audio-description", "fa-backward", "fa-balance-scale", "fa-ban", "fa-band-aid", "fa-barcode", "fa-bars", "fa-baseball-ball", "fa-basketball-ball", "fa-bath", "fa-battery-empty", "fa-battery-full", "fa-battery-half", "fa-battery-quarter", "fa-battery-three-quarters", "fa-bed", "fa-beer", "fa-bell", "fa-bell-slash", "fa-bicycle", "fa-binoculars", "fa-birthday-cake", "fa-blind", "fa-bold", "fa-bolt", "fa-bomb", "fa-book", "fa-bookmark", "fa-bowling-ball", "fa-box", "fa-boxes", "fa-braille", "fa-briefcase", "fa-bug", "fa-building", "fa-bullhorn", "fa-bullseye", "fa-bus", "fa-calculator", "fa-calendar", "fa-calendar-alt", "fa-calendar-check", "fa-calendar-minus", "fa-calendar-plus", "fa-calendar-times", "fa-camera", "fa-camera-retro", "fa-car", "fa-caret-down", "fa-caret-left", "fa-caret-right", "fa-caret-square-down", "fa-caret-square-left", "fa-caret-square-right", "fa-caret-square-up", "fa-caret-up", "fa-cart-arrow-down", "fa-cart-plus", "fa-certificate", "fa-chart-area", "fa-chart-bar", "fa-chart-line", "fa-chart-pie", "fa-check", "fa-check-circle", "fa-check-square", "fa-chess", "fa-chess-bishop", "fa-chess-board", "fa-chess-king", "fa-chess-knight", "fa-chess-pawn", "fa-chess-queen", "fa-chess-rook", "fa-chevron-circle-down", "fa-chevron-circle-left", "fa-chevron-circle-right", "fa-chevron-circle-up", "fa-chevron-down", "fa-chevron-left", "fa-chevron-right", "fa-chevron-up", "fa-child", "fa-circle", "fa-circle-notch", "fa-clipboard", "fa-clipboard-check", "fa-clipboard-list", "fa-clock", "fa-clone", "fa-closed-captioning", "fa-cloud", "fa-cloud-download-alt", "fa-cloud-upload-alt", "fa-code", "fa-code-branch", "fa-coffee", "fa-cog", "fa-cogs", "fa-columns", "fa-comment", "fa-comment-alt", "fa-comments", "fa-compass", "fa-compress", "fa-copy", "fa-copyright", "fa-credit-card", "fa-crop", "fa-crosshairs", "fa-cube", "fa-cubes", "fa-cut", "fa-database", "fa-deaf", "fa-desktop", "fa-dna", "fa-dollar-sign", "fa-dolly", "fa-dolly-flatbed", "fa-dot-circle", "fa-download", "fa-edit", "fa-eject", "fa-ellipsis-h", "fa-ellipsis-v", "fa-envelope", "fa-envelope-open", "fa-envelope-square", "fa-eraser", "fa-euro-sign", "fa-exchange-alt", "fa-exclamation", "fa-exclamation-circle", "fa-exclamation-triangle", "fa-expand", "fa-expand-arrows-alt", "fa-external-link-alt", "fa-external-link-square-alt", "fa-eye", "fa-eye-dropper", "fa-eye-slash", "fa-fast-backward", "fa-fast-forward", "fa-fax", "fa-female", "fa-fighter-jet", "fa-file", "fa-file-alt", "fa-file-archive", "fa-file-audio", "fa-file-code", "fa-file-excel", "fa-file-image", "fa-file-pdf", "fa-file-powerpoint", "fa-file-video", "fa-file-word", "fa-film", "fa-filter", "fa-fire", "fa-fire-extinguisher", "fa-first-aid", "fa-flag", "fa-flag-checkered", "fa-flask", "fa-folder", "fa-folder-open", "fa-font", "fa-football-ball", "fa-forward", "fa-frown", "fa-futbol", "fa-gamepad", "fa-gavel", "fa-gem", "fa-genderless", "fa-gift", "fa-glass-martini", "fa-globe", "fa-golf-ball", "fa-graduation-cap", "fa-h-square", "fa-hand-lizard", "fa-hand-paper", "fa-hand-peace", "fa-hand-point-down", "fa-hand-point-left", "fa-hand-point-right", "fa-hand-point-up", "fa-hand-pointer", "fa-hand-rock", "fa-hand-scissors", "fa-hand-spock", "fa-handshake", "fa-hashtag", "fa-hdd", "fa-heading", "fa-headphones", "fa-heart", "fa-heartbeat", "fa-history", "fa-hockey-puck", "fa-home", "fa-hospital", "fa-hospital-symbol", "fa-hourglass", "fa-hourglass-end", "fa-hourglass-half", "fa-hourglass-start", "fa-i-cursor", "fa-id-badge", "fa-id-card", "fa-image", "fa-images", "fa-inbox", "fa-indent", "fa-industry", "fa-info", "fa-info-circle", "fa-italic", "fa-key", "fa-keyboard", "fa-language", "fa-laptop", "fa-leaf", "fa-lemon", "fa-level-down-alt", "fa-level-up-alt", "fa-life-ring", "fa-lightbulb", "fa-link", "fa-lira-sign", "fa-list", "fa-list-alt", "fa-list-ol", "fa-list-ul", "fa-location-arrow", "fa-lock", "fa-lock-open", "fa-long-arrow-alt-down", "fa-long-arrow-alt-left", "fa-long-arrow-alt-right", "fa-long-arrow-alt-up", "fa-low-vision", "fa-magic", "fa-magnet", "fa-male", "fa-map", "fa-map-marker", "fa-map-marker-alt", "fa-map-pin", "fa-map-signs", "fa-mars", "fa-mars-double", "fa-mars-stroke", "fa-mars-stroke-h", "fa-mars-stroke-v", "fa-medkit", "fa-meh", "fa-mercury", "fa-microchip", "fa-microphone", "fa-microphone-slash", "fa-minus", "fa-minus-circle", "fa-minus-square", "fa-mobile", "fa-mobile-alt", "fa-money-bill-alt", "fa-moon", "fa-motorcycle", "fa-mouse-pointer", "fa-music", "fa-neuter", "fa-newspaper", "fa-object-group", "fa-object-ungroup", "fa-outdent", "fa-paint-brush", "fa-pallet", "fa-paper-plane", "fa-paperclip", "fa-paragraph", "fa-paste", "fa-pause", "fa-pause-circle", "fa-paw", "fa-pen-square", "fa-pencil-alt", "fa-percent", "fa-phone", "fa-phone-square", "fa-phone-volume", "fa-pills", "fa-plane", "fa-play", "fa-play-circle", "fa-plug", "fa-plus", "fa-plus-circle", "fa-plus-square", "fa-podcast", "fa-pound-sign", "fa-power-off", "fa-print", "fa-puzzle-piece", "fa-qrcode", "fa-question", "fa-question-circle", "fa-quidditch", "fa-quote-left", "fa-quote-right", "fa-random", "fa-recycle", "fa-redo", "fa-redo-alt", "fa-registered", "fa-reply", "fa-reply-all", "fa-retweet", "fa-road", "fa-rocket", "fa-rss", "fa-rss-square", "fa-ruble-sign", "fa-rupee-sign", "fa-save", "fa-search", "fa-search-minus", "fa-search-plus", "fa-server", "fa-share", "fa-share-alt", "fa-share-alt-square", "fa-share-square", "fa-shekel-sign", "fa-shield-alt", "fa-ship", "fa-shipping-fast", "fa-shopping-bag", "fa-shopping-basket", "fa-shopping-cart", "fa-shower", "fa-sign-in-alt", "fa-sign-language", "fa-sign-out-alt", "fa-signal", "fa-sitemap", "fa-sliders-h", "fa-smile", "fa-snowflake", "fa-sort", "fa-sort-alpha-down", "fa-sort-alpha-up", "fa-sort-amount-down", "fa-sort-amount-up", "fa-sort-down", "fa-sort-numeric-down", "fa-sort-numeric-up", "fa-sort-up", "fa-space-shuttle", "fa-spinner", "fa-square", "fa-square-full", "fa-star", "fa-star-half", "fa-step-backward", "fa-step-forward", "fa-stethoscope", "fa-sticky-note", "fa-stop", "fa-stop-circle", "fa-stopwatch", "fa-street-view", "fa-strikethrough", "fa-subscript", "fa-subway", "fa-suitcase", "fa-sun", "fa-superscript", "fa-sync", "fa-sync-alt", "fa-syringe", "fa-table", "fa-table-tennis", "fa-tablet", "fa-tablet-alt", "fa-tachometer-alt", "fa-tag", "fa-tags", "fa-tasks", "fa-taxi", "fa-terminal", "fa-text-height", "fa-text-width", "fa-th", "fa-th-large", "fa-th-list", "fa-thermometer", "fa-thermometer-empty", "fa-thermometer-full", "fa-thermometer-half", "fa-thermometer-quarter", "fa-thermometer-three-quarters", "fa-thumbs-down", "fa-thumbs-up", "fa-thumbtack", "fa-ticket-alt", "fa-times", "fa-times-circle", "fa-tint", "fa-toggle-off", "fa-toggle-on", "fa-trademark", "fa-train", "fa-transgender", "fa-transgender-alt", "fa-trash", "fa-trash-alt", "fa-tree", "fa-trophy", "fa-truck", "fa-tty", "fa-tv", "fa-umbrella", "fa-underline", "fa-undo", "fa-undo-alt", "fa-universal-access", "fa-university", "fa-unlink", "fa-unlock", "fa-unlock-alt", "fa-upload", "fa-user", "fa-user-circle", "fa-user-md", "fa-user-plus", "fa-user-secret", "fa-user-times", "fa-users", "fa-utensil-spoon", "fa-utensils", "fa-venus", "fa-venus-double", "fa-venus-mars", "fa-video", "fa-volleyball-ball", "fa-volume-down", "fa-volume-off", "fa-volume-up", "fa-warehouse", "fa-weight", "fa-wheelchair", "fa-wifi", "fa-window-close", "fa-window-maximize", "fa-window-minimize", "fa-window-restore", "fa-won-sign", "fa-wrench", "fa-yen-sign"];
        var gi = false,
            is = "",
            h1 = '<div class="as-element-icon" title="',
            h2 = '"></i><span style="display:none">',
            h3 = '</span></div>',
            h4 = '"><i class="';
        $.each(fb, function(i, v) {
            gi = true;
            is = is + h1 + v + h4 + 'fab ' + v + h2 + v + h3
        });
        $.each(fr, function(i, v) {
            gi = true;
            is = is + h1 + v + h4 + 'far ' + v + h2 + v + h3
        });
        $.each(fs, function(i, v) {
            gi = true;
            is = is + h1 + v + h4 + 'fas ' + v + h2 + v + h3
        });
        if (gi) { $(e).find('.wtl_single_icon_div').html(is) }
    }
};
jQuery(document).ready(function() {
    (function($) {
        wtlcpt.init();
    }(jQuery))
});