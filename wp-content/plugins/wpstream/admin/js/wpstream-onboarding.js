/*global $, jQuery,wpstream-on-boarding-js-vars */



var BubbleFreeVod = [
    //free live stream
    [
        {id: 1, 
            selector: "#menu-posts-wpstream_product", 
            title: "Hooray, we created a new FTV channel for you!",
            content:"You can see all your FTV channels and create new ones from the left menu. <div class='onboard_line_break'></div>Just look for 'Free-To-View Live Channels'",
            left:"175px",
            right:"-30px",
            top:"-30px",
            arrow:"boarding-left-arrow"},
        {id: 2, 
            selector: "#wpstream-sidebar-meta", 
            title: "Control your channel from here",
            content:"Look for the 'Live Streaming' box on the side bar",
            left:"-430px",
            right:"60px",
            top:"0px",
            arrow:"boarding-right-arrow"},
        {id: 3, 
            selector: ".wpstream_show_settings_wrapper", 
            title: "Channel Settings",
            content:'Clicking on the <div class="wpstream_sample_icon_settings"></div> icon will let you access the channel settings.<div class="onboard_line_break"></div> You can adjust preferences for <strong>recording, autoplay</strong>, etc.',
            left:"-430px",
            right:"0px",
            top:"100px",
            arrow:"boarding-right-arrow"},
        {id: 4, 
            selector: ".wpstream_stream_browser_wrapper", 
            title: "Turn it ON",
            content:"To Go Live, first TURN ON your channel. Go ahead, click the big green button below! <div id=\"wpstream_onboarding_start_chanel\">TURN ON</div> Turning on may take a minute or so. You can wait or move on to the next step.",
            left:"-430px",
            right:"auto",
            top:"0px",
            arrow:"boarding-right-arrow"},  
            
        {id: 5, 
            selector: ".wpstream_show_settings_wrapper", 
            title: "The Channel Page",
            content:"This is the page that your <strong>viewers</strong> see when they <strong>watch</strong> your channel.<div class='onboard_line_break'></div>To see it, click the <div id=\"wpstream_onboarding_open_chanel\" class=\"wpstream_sample_icon_settings wpstream_sample_icon_open_channel\"></div> Page will open in a new tab.",
            left:"-385px",
            right:"auto",
            top:"105px",
            arrow:"boarding-right-arrow"},    
        {id: 6, 
            selector: ".wpstream_stream_browser_wrapper", 
            title: "Go LIVE",
            content:"To Go Live now, click the <div class=\"wpstream_sample_icon_settings wpstream_sample_icon_camera\"></div> icon. The broadcast app will open in a new window.",
            left:"-430px",
            right:"auto",
            top:"50px",
            arrow:"boarding-right-arrow"}
    ]  ,
    // paid live stream
    [
        {id: 1, 
            selector: "#menu-posts-product", 
            title: "Hooray, we created a new PPV channel for you!",
            content:"You can see all your PPV channels and create new ones from the left menu. Just look under 'Products'",
            left:"175px",
            right:"-30px",
            top:"-30px",
            arrow:"boarding-left-arrow"},
        {id: 2, 
            selector: "#normal-sortables", 
            title: "A Pay-Per-View Channel is a Custom Woocommerce Product",
            content:"Note the type of the product: <strong>Live Channel</strong> </br>This sets it apart from other products you may want to sell.",
            left:"345px",
            right:"-30px",
            top:"-35px",
            arrow:"boarding-left-arrow"},
        {id: 3, 
            selector: "#normal-sortables", 
            title: "Set the Pay-Per-View price here",
            content:"Your users will have to purchase the product in order to be allowed to watch the live stream.",
            left:"550px",
            right:"-30px",
            top:"25px",
            arrow:"boarding-left-arrow"},
        {id: 4, 
            selector: "#wpstream-sidebar-meta", 
            title: "Control your channel from here",
            content:"Look for the ‘Live Streaming’ box on the side bar",
            left:"-430px",
            right:"60px",
            top:"0px",
            arrow:"boarding-right-arrow"},
        {id: 5, 
            selector: ".wpstream_show_settings_wrapper", 
            title: "3. Before Turning on your channel you may want to change some of the settings",
            content:'When you click this icon <div class="wpstream_sample_icon_settings"></div> you will open a new window with a bunch of settings and some other extra info that will be changed at a later date!',
            left:"-430px",
            right:"0px",
            top:"100px",
            arrow:"boarding-right-arrow"},
        {id: 6, 
            selector: ".wpstream_stream_browser_wrapper", 
            title: "4. You can start doing a Live Video Stream",
            content:"To start a live stream first you need to Turn On your channel. Let's do that now by clicking this button.<div id=\"wpstream_onboarding_start_chanel\">TURN ON</div> It will take 1 minute until your channel is ready so you could move to next step!.",
            left:"-430px",
            right:"auto",
            top:"0px",
            arrow:"boarding-right-arrow"},  
        {id: 7, 
            selector: ".wpstream_show_settings_wrapper", 
            title: "5. View the channel Page",
            content:"while you are waiting for the channel to turn on the channel you can open the event page. You can do that by pressing the eye button or by clicking this link <div id=\"wpstream_onboarding_open_chanel\" class=\"wpstream_sample_icon_settings wpstream_sample_icon_open_channel\"></div>",
            left:"-385px",
            right:"auto",
            top:"105px",
            arrow:"boarding-right-arrow"},    
        {id: 8, 
            selector: ".wpstream_stream_browser_wrapper", 
            title: "6. Start Streaming",
            content:"Once the channel is on you can start streaming. Use the web camera icon to <div class=\"wpstream_sample_icon_settings wpstream_sample_icon_camera\"></div>stream from browser or camera icon to get the settings for streaming apps. You can now close this this Window.",
            left:"-430px",
            right:"auto",
            top:"50px",
            arrow:"boarding-right-arrow"}
    ] ,
    // free vod
    [
        {id: 1, 
            selector: "#menu-posts-wpstream_product_vod", 
            title: "Congrats for your first FREE video on demamd",
            content:"You can view all your free viod  on the left menu. Click next if you dare",
            left:"175px",
            right:"-30px",
            top:"-30px",
            arrow:"boarding-left-arrow"},
        {id: 2, 
            selector: "#add_wpstream_product_metaboxes-sectionid", 
            title: "The Free VOD can be a Recording or a self hosted video ",
            content:"Note the type of free vod - recording or self hosted",
            left:"245px",
            right:"-30px",
            top:"30px",
            arrow:"boarding-left-arrow"},
        {id: 3, 
            selector: "#add_wpstream_product_metaboxes-sectionid", 
            title: "Here is the video file associalted with your free vod",
            content:"Video File explanations and other inmportant info",
            left:"245px",
            right:"-30px",
            top:"100px",
            arrow:"boarding-left-arrow"},
        {id: 4, 
            selector: "#post-body", 
            title: "View the front page player",
            content:"You can view the free vod page by looking at the front end page <div id=\"wpstream_onboarding_view_vod\">View VOD Page</div>",
            left:"350px",
            right:"0px",
            top:"-10px",
            arrow:"boarding-left-arrow"},

        {id: 5, 
            selector: "#post-body", 
            title: "And Thats it",
            content:"That's it , you users will be free to view this Video on Demand",
            left:"350px",
            right:"0px",
            top:"155px",
            arrow:""},
    ] ,
    //paid vod
    [
        {id: 1, 
            selector: "#menu-posts-product", 
            title: "Congrats for your first video on demamd",
            content:"You can view all your free viod  on the left menu. Click next if you dare",
            left:"175px",
            right:"-30px",
            top:"-30px",
            arrow:"boarding-left-arrow"},
        {id: 2, 
            selector: "#normal-sortables", 
            title: "The Pay per view VOD prodcut is a Custom Woocommerce product",
            content:"Note the type of product: Video on demand for Streaming Products or Video On demand for VOD",
            left:"345px",
            right:"-30px",
            top:"-35px",
            arrow:"boarding-left-arrow"},
        {id: 3, 
            selector: "#normal-sortables", 
            title: "Here is your PPV price",
            content:"A user will need to buy this product at this price in order to watch the live stream",
            left:"550px",
            right:"-30px",
            top:"25px",
            arrow:"boarding-left-arrow"},
        {id: 4, 
            selector: "#normal-sortables", 
            title: "Here is the video file associalted with your product",
            content:"Video File explanations and other inmportant info",
            left:"700px",
            right:"-30px",
            top:"135px",
            arrow:"boarding-left-arrow"},
        {id: 5, 
            selector: "#post-body", 
            title: "View the front page player",
            content:"You can view the free vod page by looking at the front end page <div id=\"wpstream_onboarding_view_vod\">View VOD Page</div>. In this case you will be able to watch the video after you purchase it.",
            left:"350px",
            right:"0px",
            top:"-10px",
            arrow:"boarding-left-arrow"},
        {id: 4, 
            selector: "#post-body", 
            title: "And Thats it",
            content:"That's it , now users need to buy this WOocommerce product and they will be able to view this vod only after the payment is complete.",
            left:"350px",
            right:"-200px",
            top:"25px",
            arrow:""},


        
    ]

];



jQuery(document).ready(function ($) {
    "use strict";
    console.log(BubbleFreeVod)
    console.log('we can start');
    
    wpstream_by_pass_login();
    wpstream_onboard_login();
    wpstream_onboard_register();
    wpstream_main_on_boarding_function();
    wpstream_on_boarding_click_actions();
    wpstream_create_free_channel_action();
    wpstream_create_ppv_channel_action();
    wpstream_create_free_vod_action();
    wpstream_create_ppv_vod_action();
    wpstream_free_channel_onboarding();
    wpstream_on_boarding_initial_close();
    wpstream_onboard_initial_bubble_prev_action();
})


/*
*
*
*/
function wpstream_onboard_register(){
    console.log('on register');
    jQuery('.wpstream_onboard_register').on('click',function(){

        console.log('click register');
        var wpstream_register_email         =   jQuery('#wpstream_register_email').val();
        var wpstream_register_password      =   jQuery('#wpstream_register_password').val();
        var ajaxurl                         =   wpstream_admin_control_vars.admin_url + 'admin-ajax.php';
        var nonce                           =   jQuery('#wpstream_onboarding_nonce').val();

        jQuery('.wpstream_onboarding_notification').removeClass('onboarding_error').text('Sending data. Please Stand by...');
     
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'                    :   'wpstream_on_board_register',
                'wpstream_register_email'   :   wpstream_register_email,
                'wpstream_register_password':   wpstream_register_password,
                'security'                  :   nonce
            },
            success: function (data) {     
                console.log(data);

                if(data.success){
                    if(data.token==='false' || data.token===false){
                        jQuery('.wpstream_onboarding_notification').addClass('onboarding_error').text('We couldn\'t authenticate with your new credentials').show();
                    }else{
                        jQuery('.wpstream_onboarding_notification').text('Register successful, please stand by...').show();
                        setTimeout(function() {

                            var nextThing = 'wpstream_step_2';
                            jQuery('.wpstream_step_wrapper').hide();
                            jQuery('#'+nextThing).show();    
                           
                        }, 2500);
                    }
                }else{
                    jQuery('.wpstream_onboarding_notification').addClass('onboarding_error').text(data.message).show();
                }
            
            
            },
            error: function (errorThrown) { 
            
            }
        });
        
    });
}
/*
*
*
*/

function wpstream_onboard_login(){
    jQuery('.wpstream_onboard_login').on('click',function(){

        var api_username    =   jQuery('#api_username').val();
        var api_password    =   jQuery('#api_password').val();
        var ajaxurl         =   wpstream_admin_control_vars.admin_url + 'admin-ajax.php';
        var nonce           =   jQuery('#wpstream_onboarding_nonce').val();
        jQuery('.wpstream_onboarding_notification').removeClass('onboarding_error');
     
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'                    :   'wpstream_on_board_login',
                'api_username'              :   api_username,
                'api_password'              :   api_password,
                'security'                  :   nonce
            },
            success: function (data) {     
                console.log(data);

                if(data.success){
                    if(data.token==='false' || data.token===false){
                        jQuery('.wpstream_onboarding_notification').addClass('onboarding_error').text('Wrong username or password!').show();
                    }else{
                        jQuery('.wpstream_onboarding_notification').text('Login successful, please stand by...').show();
                        setTimeout(function() {

                            var nextThing = 'wpstream_step_2';
                            jQuery('.wpstream_step_wrapper').hide();
                            jQuery('#'+nextThing).show();    
                           
                        }, 2500);
                    }
                }
            
            },
            error: function (errorThrown) { 
            
            }
        });
        
    });
}


/*
*
*
*/

function wpstream_by_pass_login(){
    if(jQuery('#wpstream_have_token').length >0 ){
        
        var nextThing = 'wpstream_step_2';
        jQuery('.wpstream_step_wrapper').hide();
        jQuery('#'+nextThing).show();    
       

    }else{
        jQuery('.wpstream_on_board_register_wrapper').show();
        jQuery('#wpstream_onboarding_action_login').show();
    }
    jQuery('.wpstream_check_account_status').hide();
}
/*
*
*
*/


function wpstream_on_boarding_click_actions(){
    jQuery('#wpstream_onboarding_action_login').on('click',function(){
        jQuery(this).hide();
        jQuery('.wpstream_on_board_register_wrapper').hide();
        jQuery('.wpstream_on_board_login_wrapper').show();
        jQuery('#wpstream_onboarding_action_register').show();     
    });

    jQuery('#wpstream_onboarding_action_register').on('click',function(){
        jQuery(this).hide();
        jQuery('.wpstream_on_board_login_wrapper').hide();
        jQuery('.wpstream_on_board_register_wrapper').show();
        jQuery('#wpstream_onboarding_action_login').show();     
    });


    jQuery('.wpstream_action_next_step').on('click',function(){
        var nextThing = jQuery(this).attr('data-nextthing');
        jQuery('.wpstream_step_wrapper').hide();
        jQuery('#'+nextThing).show();       
    });
}
/*
*
*
*/


function wpstream_main_on_boarding_function(){
    let params = (new URL(document.location)).searchParams;
    let onboard = params.get('onboard_start');
  
    if(onboard!=='yes'){
        return;
    }

    jQuery('.wpstream_on_boarding_wrapper').show();
    jQuery('.wpstream_modal_background_onboard').show();

}
/*
* Create PPV Channel action
*
*/

function wpstream_create_ppv_channel_action(){
    jQuery('#wpstream_onboard_live_ppv_action').on('click',function(){

        var channel_name    =   jQuery('#wpstream_onboarding_channel_name_ppv').val();
        var channel_price   =   jQuery('#wpstream_onboarding_event_price_ppv').val();
        var ajaxurl         =   wpstream_admin_control_vars.admin_url + 'admin-ajax.php';
        var nonce           =   'xxx';
        
        console.log(channel_name);
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'                    :   'wpstream_on_board_create_channel_ppv',
                'channel_name'              :   channel_name,
                'channel_price'             :   channel_price,
                'security'                  :   nonce
            },
            success: function (data) {     
                console.log(data);

                if(data.success){
                    console.log('redirect ppv');
                    var new_link = data.link;
                    var decoded = new_link.replace(/&amp;/g, '&');
                    console.log(decoded);
                    window.location.href=decodeURI(decoded);
                }
            
            },
            error: function (errorThrown) { 
            
            }
        });
        
    });
}

/*
* Create free Channel action
*
*/

function wpstream_create_free_channel_action(){
    jQuery('#wpstream_on_board_create_channel').on('click',function(){

        var channel_name    =   jQuery('#wpstream_onboarding_channel_name').val();
        var ajaxurl         =   wpstream_admin_control_vars.admin_url + 'admin-ajax.php';
        var nonce           =   'xxx';
        
        console.log(channel_name);
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'                    :   'wpstream_on_board_create_channel',
                'channel_name'              :   channel_name,
                'security'                  :   nonce
            },
            success: function (data) {     
                console.log(data);

                if(data.success){
                    console.log('redirect');
                    var new_link = data.link;
                    var decoded = new_link.replace(/&amp;/g, '&');
                    console.log(decoded);
                    window.location.href=decodeURI(decoded);
                }
            
            },
            error: function (errorThrown) { 
            
            }
        });
        
    });
}


/*
* Create Free VOD Action
*
*/


function wpstream_create_free_vod_action(){
    jQuery('#wpstream_onboard_vod_free_action').on('click',function(){

        var channel_name    =   jQuery('#wpstream_onboarding_vod_name').val();
        var file_name       =   jQuery('#wpstream_free_vod_file_name').val();
        var ajaxurl         =   wpstream_admin_control_vars.admin_url + 'admin-ajax.php';
        var nonce           =   jQuery('#wpstream_onboarding_nonce').val();
        
        console.log(channel_name);
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'                    :   'wpstream_on_board_create_free_vod',
                'channel_name'              :   channel_name,
                'file_name'                 :   file_name,
                'security'                  :   nonce
            },
            success: function (data) {     
                console.log(data);

                if(data.success){
                    console.log('redirect');
                    var new_link = data.link;
                    var decoded = new_link.replace(/&amp;/g, '&');
                    console.log(decoded);
                    window.location.href=decodeURI(decoded);
                }
            
            },
            error: function (errorThrown) { 
            
            }
        });
        
    });
}





/*
* Create PPV VOD Action
*
*/


function wpstream_create_ppv_vod_action(){
    jQuery('#wpstream_onboard_vod_ppv_action').on('click',function(){

        var channel_name    =   jQuery('#wpstream_onboarding_ppv_vod_name').val();
        var file_name       =   jQuery('#wpstream_free_vod_file_name_for_ppv').val();
        var vod_price       =   jQuery('#wpstream_onboarding_vod_price').val()
        var ajaxurl         =   wpstream_admin_control_vars.admin_url + 'admin-ajax.php';
        var nonce           =   jQuery('#wpstream_onboarding_nonce').val();
        
        console.log(channel_name);
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'                    :   'wpstream_on_board_create_ppv_vod',
                'channel_name'              :   channel_name,
                'file_name'                 :   file_name,
                'vod_price'                 :   vod_price,
                'security'                  :   nonce
            },
            success: function (data) {     
                console.log(data);

                if(data.success){
                    console.log('redirect');
                    var new_link = data.link;
                    var decoded = new_link.replace(/&amp;/g, '&');
                    console.log(decoded);
                    window.location.href=decodeURI(decoded);
                }
            
            },
            error: function (errorThrown) { 
            
            }
        });
        
    });
}












/*
*
*
*/

function wpstream_free_channel_onboarding(){
    let params = (new URL(document.location)).searchParams;
    let onboard = params.get('onboard');
  
    if(onboard!=='yes'){
        return;
    } 

    let branch= params.get('branch');
    branch=parseInt(branch);
    
    if(isNaN(branch)){
        return;
    }
    
    branch=branch-1;
    

 
    var bubble_round_items='<ul class="wpstream_round_bubble">';
    for (let step = 0; step < BubbleFreeVod[branch].length ; step++) {
        bubble_round_items=bubble_round_items+'<li></li>';    
    }
    bubble_round_items=bubble_round_items+'</ul>';

    console.log(bubble_round_items);


    var help_bubble_to_insert='<div id="wpstream_onboard_bubble" data-bubble-step="0"><div class="wpstream_close_onboarding"></div>'+
    '<h2 id="wpstream_onboard_bubble_tile"></h2>'+ 
    '<p id="wpstream_onboard_bubble_content"></p>'+
    '<span class="wpstream_onboard_bubble_prev">Prev</span>'+
    '<span class="wpstream_onboard_bubble_next">Next</span>'+
    '<span class="wpstream_onboard_bubble_finish">Finish</span>'+
    '<ul class="wpstream_round_bubble">';
    for (let step = 0; step < BubbleFreeVod[branch].length ; step++) {
        help_bubble_to_insert=help_bubble_to_insert+'<li></li>';    
    }

    help_bubble_to_insert=help_bubble_to_insert+'</ul>'+
    '</div><div class="wpstream_modal_background_onboard2"></div>';

    jQuery('#wpcontent').append(help_bubble_to_insert);

    wpstream_show_bubble(0,branch);
    jQuery('.woocommerce-layout__header').hide();
    jQuery('.wpstream_modal_background_onboard2,#wpstream_onboard_bubble').show();

    wpstream_on_boarding_close();

    wpstream_bubble_controls(branch);

}

/*
*
*
*/

function wpstream_on_boarding_trigger_event_start_channel(){
    jQuery('#wpstream_onboarding_start_chanel').on('click',function(){
        console.log('trigger click start event');
        jQuery('.start_event.wpstream_button').trigger('click');
        jQuery('#wpstream_onboarding_start_chanel').unbind('click');
    })
    
}


/*
*
*
*/

function wpstream_on_boarding_trigger_event_open_channel(){
    jQuery('#wpstream_onboarding_open_chanel').on('click',function(){
        console.log('trigger click open page');
        var link = jQuery('.wpstream_view_channel').attr('href');
        window.open(link, '_blank');
    })
}
/*
*
*
*/

function wpstream_on_boarding_open_vod_page(){
    jQuery('#wpstream_onboarding_view_vod').on('click',function(event){
        event.stopPropagation();
        var link = jQuery('#sample-permalink a').attr('href');
        window.open(link, '_blank');

    });
}


/*
*
*
*/

function wpstream_show_bubble(current_bubble_step,branch){
    console.log('in bubble next or prev with ');
    var current_bubble      =   jQuery('#wpstream_onboard_bubble');

    console.log("branch "+branch+" / current_bubble_step "+current_bubble_step)

    current_bubble.detach();

  



    var new_info        =   BubbleFreeVod[branch][current_bubble_step];
    var new_title       =   new_info.title;
    var new_selector    =   new_info.selector;
    var new_content     =   new_info.content;
    var new_css         =   new_info.css;
    var new_left        =   new_info.left;
    var new_top         =   new_info.top;
    var new_right       =   new_info.right;
    var new_arrow       =   new_info.arrow;

    console.log(new_title);
    console.log(new_selector);
    console.log(new_content);
    console.log(new_css)

    current_bubble.find('#wpstream_onboard_bubble_tile').html(new_title);
    current_bubble.find('#wpstream_onboard_bubble_content').html(new_content);
    current_bubble.attr('data-bubble-step',current_bubble_step);
    current_bubble.removeClass('boarding-left-arrow boarding-right-arrow');
    current_bubble.addClass(new_arrow);
    current_bubble.css({
        'left':new_left,
        'right':new_right,
        'top':new_top
    });


    if( BubbleFreeVod[branch].hasOwnProperty(parseInt(current_bubble_step+1)) ){
        current_bubble.find('.wpstream_onboard_bubble_next').show();
        current_bubble.find('.wpstream_onboard_bubble_finish').hide();
    }else{
        current_bubble.find('.wpstream_onboard_bubble_next').hide();
        console.log('show finish');
        console.log(   current_bubble.find('.wpstream_onboard_bubble_finish') );
        current_bubble.find('.wpstream_onboard_bubble_finish').show().css('display','inline-block');
    }



    jQuery(new_selector).append(current_bubble);

    jQuery('html, body').animate({
        scrollTop: jQuery(new_selector).offset().top-200
    }, 1000);

    wpstream_on_boarding_trigger_event_start_channel();
    wpstream_on_boarding_trigger_event_open_channel();
    wpstream_on_boarding_open_vod_page();
        
}


/*
*
*
*/


function wpstream_bubble_controls(branch){
    console.log('in bubble controls');
    jQuery('.wpstream_onboard_bubble_next,.wpstream_onboard_bubble_prev').on('click',function(){
   
        var current_bubble_step =   jQuery('#wpstream_onboard_bubble').attr('data-bubble-step');
        
        current_bubble_step     =   parseInt(current_bubble_step,10);
        if( jQuery(this).hasClass('wpstream_onboard_bubble_next')){
            current_bubble_step++;
        }else{
            current_bubble_step--;
        }
       
        if( current_bubble_step<0){ 
            current_bubble_step=0;
            var url      = window.location.href;  
            jQuery('#wpstream_onboard_bubble,.wpstream_modal_background_onboard2').hide();
            
            jQuery('.wpstream_on_boarding_wrapper').show();
            jQuery('.wpstream_modal_background_onboard').show();
          
        }

        console.log("lenght "+ BubbleFreeVod[branch].length )

        var max_length = BubbleFreeVod[branch].length-1;

        if( current_bubble_step>max_length){ 
            current_bubble_step=max_length;
        }
        
        console.log("current_bubble_step "+current_bubble_step)
        wpstream_show_bubble(current_bubble_step,branch)

     

    })
}


/*
*
*
*/
function wpstream_on_boarding_close(){
    jQuery('.wpstream_close_onboarding,.wpstream_onboard_bubble_finish').on('click',function(){

        jQuery('.wpstream_onboard_bubble_finish').hide();
        var parent_modal=jQuery(this).parent();
        
        parent_modal.find('.wpstream_close_onboarding').hide();
        parent_modal.find('#wpstream_onboard_bubble_tile').html('Happy Streaming!');
        parent_modal.find('.wpstream_onboard_bubble_prev,.wpstream_onboard_bubble_next').hide();
   
        parent_modal.find('#wpstream_onboard_bubble_content').html('You can run the wizard again at any time. </br>In the left menu navigate to WpStream -> Streaming Wizard <div id="wpstrean_close_modal_ack">Okay, Close it now!</div>');
       // parent_modal.find('#wpstream_onboard_bubble_content').after('<div id="wpstrean_close_modal_ack">Okay, Close it now!</div>');
        
        wpstrean_close_modal_ack_function();
    });
}

/*
* Close initial on boarding
*
*/

function wpstream_on_boarding_initial_close(){
    jQuery('.wpstream_close_initial_onboarding').on('click',function(){

        var parent_modal=jQuery(this).parent();
        
        parent_modal.find('.wpstream_close_initial_onboarding,.wpstream_step_wrapper').hide();
     //   parent_modal.find('#wpstream_onboarding_action_login,#wpstream_onboarding_action_register').hide();
      //  parent_modal.find('.wpstream_on_board_login_wrapper,.wpstream_on_board_register_wrapper').hide();
   
        parent_modal.find('.wpstream_close_onboarding_warning').html('You can run the wizard again at any time.</br> In the left menu navigate to WpStream -> Streaming Wizard <div id="wpstrean_close_modal_ack">Okay, Close it now!</div>');
       // parent_modal.find('.wpstream_close_onboarding_warning').after('<div id="wpstrean_close_modal_ack">Okay, Close it now!</div>');
        
        wpstrean_close_modal_ack_function();
    });
}
/*
*
*
*/
function wpstrean_close_modal_ack_function(){
    jQuery('#wpstrean_close_modal_ack').on('click',function(){

        var parent_modal=jQuery(this).parent();
        parent_modal.remove();
        jQuery('.wpstream_modal_background_onboard2,.wpstream_modal_background_onboard').remove();
        jQuery('.wpstream_on_boarding_wrapper').remove();
        jQuery('#wpstream_onboard_bubble').remove();
    });
}



/*
*
*
*/

function wpstream_onboard_initial_bubble_prev_action(){
    jQuery('.wpstream_onboard_initial_bubble_prev').on('click',function(){
        var prev_step = jQuery(this).attr('data-step');
        jQuery('.wpstream_step_wrapper').hide();
        jQuery("#"+prev_step).show();
    });


    jQuery('.wpstream_onboarding_tryagain').on('click',function(){
        location.reload();
    });

    jQuery('.wpstream_install_plugin').on('click',function(){
        var url = wpstreamonboarding_js_vars.plugin_url;
        window.open(url, '_blank'); 
    });

    jQuery('.wpstream_upload_video').on('click',function(){
        var url = wpstreamonboarding_js_vars.upload_url;
        window.open(url, '_blank'); 
    });

}