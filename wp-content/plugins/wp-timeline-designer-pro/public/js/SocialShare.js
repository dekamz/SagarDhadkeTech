/*
 SocialShare - jQuery plugin
 */
(function($){
    "use strict";
    function get_class_list(elem){
        if(elem.classList){
            return elem.classList;
        } else {
            return $(elem).attr('class').match(/\S+/gi);
        }
    }
    $.fn.ShareLink = function(options){
        var defaults={title:'',text:'',image:'',url:window.location.href,class_prefix:'s_'};
        var options=$.extend({},defaults,options);
        var cpl=options.class_prefix.length;
        var templates={
            facebook:'https://www.facebook.com/sharer.php?s=100&p[title]={title}&u={url}&t={title}&p[summary]={text}&p[url]={url}',
            plus:'https://plus.google.com/share?url={url}',
            linkedin:'https://www.linkedin.com/shareArticle?mini=true&url={url}&title={title}&summary={text}&source={url}',
            pinterest:'https://www.pinterest.com/pin/create/button/?media={image}&url={url}&description={text}',
            twitter:'https://twitter.com/intent/tweet?url={url}&text={text}',
            gmail:'http://mail.google.com/mail/?view=cm&fs=1&to=&su={title}&body={text}&ui=1',
            whatsapp:'whatsapp://send?text={url} {title}',
            pocket:'https://getpocket.com/edit?url={url}&title={title}',
            tumblr:'https://tumblr.com/share?s=&v=3&t={title}&u={url}',
            google:'http://www.google.com/bookmarks/mark?op=add&bkmk={url}&title={title}&annotation={text}',
            webnews:'http://www.webnews.de/einstellen?url={url}&title={title}',
            wordpress:'http://wordpress.com/wp-admin/press-this.php?u={url}&t={title}&s={text}&v=2',
            telegram:'https://telegram.me/share/url?url={url}'
        }
        function link(network){var url=templates[network];url=url.replace(/{url}/g,encodeURIComponent(options.url));url=url.replace(/{title}/g,encodeURIComponent(options.title));url=url.replace(/{text}/g,encodeURIComponent(options.text));url=url.replace(/{image}/g,encodeURIComponent(options.image));return url}

        return this.each(function(i, elem){
            var cl = get_class_list(elem);
            for (var i = 0; i < cl.length; i++){
                var cls = cl[i];
                if(cls.substr(0, cpl) == options.class_prefix && templates[cls.substr(cpl)]){
                    var final_link = link(cls.substr(cpl));
                    $(elem).attr('href', final_link).click(function(){
                        if($(this).attr('href').indexOf('http://')===-1&&$(this).attr('href').indexOf('https://')===-1){
                            return window.open($(this).attr('href')) && false;
                        }
                        var sw=screen.width;
                        var sh=screen.height;
                        var pw=options.width?options.width:(sw-(sw*0.2));
                        var ph=options.height?options.height:(sh-(sh*0.2));
                        var lt=(sw/2)-(pw/2);
                        var tp=(sh/2)-(ph/2);
                        var pr='toolbar=0,status=0,width='+pw+',height='+ph+',top='+tp+',left='+lt;
                        return window.open($(this).attr('href'),'',pr)&&false;
                    });
                }
            }
        });
    }
    $.fn.ShareCounter = function(options){
        var defaults = {url:window.location.href,class_prefix:'c_',display_counter_from:0,increment:false};
        var options = $.extend({},defaults,options);
        var cpl = options.class_prefix.length
        var social={'vk':vk,'myworld':myworld,'linkedin':linkedin,'odnoklassniki':odnoklassniki,'pinterest':pinterest,'plus':plus,'facebook':facebook}
        return this.each(function(i, elem){
            var cl = get_class_list(elem);
            for (var i = 0; i < cl.length; i++){
                var cls = cl[i];
                if(cls.substr(0, cpl) == options.class_prefix && social[cls.substr(cpl)]){
                    social[cls.substr(cpl)](options.url, function(count){
                        count = parseInt(count);
                        if(count >= options.display_counter_from){
                            var current_value = parseInt($(elem).text());
                            if(options.increment && !isNaN(current_value)){
                                count += current_value;
                            }
                            $(elem).text(count);
                        }
                    })
                }
            }
        });
        function vk(url,callback){if(window.VK===undefined){VK={CallbackList:[],Share:{count:function(idx,value){VK.CallbackList[idx](value)}}}}var current_callback_index=VK.CallbackList.length;VK.CallbackList.push(callback);$.ajax({type:'GET',dataType:'jsonp',url:'https://vk.com/share.php',data:{'act':'count','index':current_callback_index,'url':url}}).fail(function(data,status){if(status!='parsererror'){for(i in VK.CallbackList){VK.CallbackList[i](0)}}})};
        function myworld(url,callback){var results=[];$.ajax({type:'GET',dataType:'jsonp',url:'https://connect.mail.ru/share_count',jsonp:'func',data:{'url_list':url,'callback':'1'}}).done(function(data){callback(data[url].shares)}).fail(function(data){callback(0)})};
        function linkedin(url,callback){$.ajax({type:'GET',dataType:'jsonp',url:'https://www.linkedin.com/countserv/count/share',data:{'url':url,'format':'jsonp'}}).done(function(data){callback(data.count)}).fail(function(){callback(0)})};
        function odnoklassniki(url,callback){if(window.ODKL===undefined){ODKL={CallbackList:[],updateCount:function(uid,value){ODKL.CallbackList[parseInt(uid)](value)}}}var current_callback_index = ODKL.CallbackList.length;ODKL.CallbackList.push(callback);$.ajax({type:'GET',dataType:'jsonp',url:'https://ok.ru/dk',data:{'st.cmd':'extLike','ref':url,'uid':current_callback_index}}).fail(function(data, status){if(status!='parsererror'){for (i in ODKL.CallbackList){ODKL.CallbackList[i](0)}}})};
        function pinterest(url,callback){$.ajax({type:'GET',dataType:'jsonp',url:'https://api.pinterest.com/v1/urls/count.json',data:{'url':url}}).done(function(data){callback(data.count)}).fail(function(){callback(0)})};
        function plus(url,callback){$.ajax({type:'POST',url:'https://clients6.google.com/rpc',processData:true,contentType:'application/json',data:JSON.stringify({'method':'pos.plusones.get','id':location.href,'params':{'nolog':true,'id':url,'source':'widget','userId':'@viewer','groupId':'@self'},'jsonrpc':'2.0','key':'p','apiVersion':'v1'})}).done(function(data){callback(data.result.metadata.globalCounts.count)}).fail(function(){callback(0)})};
        function facebook(url,callback){var token = $('#fb_token').val();$.ajax({type:'GET',dataType:'jsonp',url:'https://graph.facebook.com/v2.2/',data:{'access_token':token, 'id':url,'fields':'engagement'}}).done(function(data){if(data.engagement!=undefined && data.engagement.share_count!=undefined){callback(data.engagement.share_count)}}).fail(function(){callback(0)})};
    }
})(jQuery);

var wtlsocialshare = {
    init:function(){
        $=jQuery;
        this.ssclick();
        this.emshare();
        this.ssclose();
        this.ssubmit();
    },    
    ssclick:function(){
        $(document).on('click','.wp-timeline-social-share',function(e){           
        e.preventDefault();
        ss='share',tw='targetWindow',wh='width=800,height=400';tn='toolbar=no';lc='location=0';sn='status=no';mb='menubar=no';sy='scrollbars=yes';ry='resizable=yes';
        if($(this).data(ss)=='facebook'){
            var h=$(this).data('href'),u=$(this).data('url'),l=h+'?u='+u;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        if($(this).data(ss)=='google'||$(this).data(ss)=='linkedin'){
            var h=$(this).data('href'),u=$(this).data('url'),l=h+'?url='+u;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        if($(this).data(ss)=='twitter'||$(this).data(ss)=='skype'||$(this).data(ss)=='telegram'){
            var h=$(this).data('href'),t=$(this).data('text'),u=$(this).data('url'),l=h+'?text='+t+'&url='+u;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        if($(this).data(ss)=='pinterest'){
            var h=$(this).data('href'),u=$(this).data('url'),m=$(this).data('media'),d=$(this).data('description'),l=h+'?url='+u+'&media='+m+'&description='+d;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }        
        if($(this).data(ss)=='pocket'||$(this).data(ss)=='reddit'||$(this).data(ss)=='digg'||$(this).data(ss)=='tumblr'){
            var h=$(this).data('href'),s=$(this).data('title'),u=$(this).data('url'),l=h+'?url='+u+'&title='+s;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        if($(this).data(ss)=='tumblr'){
            var h=$(this).data('href'),s=$(this).data('title'),u=$(this).data('url'),l=h+'?canonicalUrl='+u+'&title='+s;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        if($(this).data(ss)=='wordpress'){
            var h=$(this).data('href'),s=$(this).data('title'),u=$(this).data('url'),i=$(this).data('image'),l=h+'?u='+u+'&t='+s+'&i='+i;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        if($(this).data(ss)=='whatsapp'){
            var h=$(this).data('href'),t=$(this).data('text'),u=$(this).data('url'),l=h+'?text='+t+'&url='+u;
            window.open(l,tw,wh,tn,lc,sn,mb,sy,ry);
        }
        });    
    },
    emshare:function(){
      $(document).on('click', '.wtl-email-share',function(e){
        e.preventDefault();
        $('.wtl_email_form').show();
        var a=$(this),b=a.offset().left,c=a.offset().top,d=$('.wtl_email_share'),f=$('.wtl_email_sucess');
        d.show(500);d.css('left',b);d.css('top',c);
        $('#txtPostId').val(a.attr('data-id'));
        $('#txtShortcodeId').val(a.attr('data-shortcode-id'));f.html('');f.hide();
        });
    },
    ssclose:function(){
        $(document).on('click','.wtl-close_button,.wtl-close',function(){$('#txtToEmail').val('');$('#txtYourName').val('');$('#txtYourEmail').val('');$(this).closest('.wtl_email_share').hide(500)});     
    },
    ssubmit:function(){
        $(document).on('submit', '#frmEmailShare',function(e){e.preventDefault();var a=page_object.current_page,b=page_object.current_id,c=$(this).serialize()+"&cur_page="+a+"&cur_id="+b;$.ajax({type:'post',url:ajaxurl,data:c,success:function(data){$('.wtl_email_sucess').show();if(data=='sent'){$('#txtToEmail').val('');$('#txtYourName').val('');$('#txtYourEmail').val('');$('.wtl_email_form').hide();$('.wtl_email_sucess').html('This post has been shared!')}else{$('.wtl_email_sucess').html('<font color="#ff0000">Error in sharing post</font>')}}})});
    }
};

jQuery(document).ready(function(){(function($){
    wtlsocialshare.init();
}(jQuery))});