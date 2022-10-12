/*global $, jQuery, */

jQuery(document).ready(function ($) {
    "use strict";
    jQuery('#_subscript_live_event').change(function(){
            var value= jQuery(this).val();
            if(value==="no"){
                jQuery(".show_if_video_on_demand").removeClass("hide_movieon");
            }else{
                jQuery(".show_if_video_on_demand").addClass("hide_movieon");
            }

    });
   jQuery('#_subscript_live_event').trigger('change');
   
   
    $('#wpstream_product_type').change(function(){
        $('.video_free').hide();
        console.log('hide');
        if( $('#wpstream_product_type').val()=== "2"){
            $('.video_free').show();
        }
    });
    $('#wpstream_product_type').trigger('change');
    
 

    
    $('.close_event').click(function(event){
        event.preventDefault();
        var ajaxurl             =   admin_control_vars.admin_url + 'admin-ajax.php';
        var acesta              =   $(this);
        var parent              =   $(this).parent();
        var notification_area   =   $(this).parent().find('.event_list_unit_notificationx');
        var show_id             =   parseFloat( $(this).attr('data-show-id') );
        var nonce               =   $('#wpstream_start_event_nonce').val();
        $(this).unbind();
        notification_area.text('Closing Event');
    
        
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'            :   'wpstream_close_event',
                'security'          :   nonce,
                'show_id'           :   show_id
            },
            success: function (data) {
                console.log(data);
                parent.remove();
                
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
        
    });
    
    
    $('.start_event').click(function(event){
        event.preventDefault();
        var ajaxurl             =   admin_control_vars.admin_url + 'admin-ajax.php';
        var acesta              =   $(this);
        var notification_area   =   $(this).parent().find('.event_list_unit_notification');
        var curent_content      =   $(this).parent().find('.server_notification');
        var is_record           =   0;
        var show_id             =   parseFloat( $(this).attr('data-show-id') );
        var nonce               =   $('#wpstream_start_event_nonce').val();
        var parent= $(this).parent();
        
        if( $(this).parent().find('.record_event').is(":checked") ){
            is_record   =   1;
        }
        
        $(this).unbind();
        curent_content.text('waking up the streaming demons......');
        var loader =  jQuery(this).parent().find('.server_loading');
        loader.show();
        
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'json',
            data: {
                'action'            :   'wpstream_give_me_live_uri',
                'security'          :   nonce,
                'show_id'           :   show_id,
                'is_record'         :   is_record
            },
            success: function (data) {
                console.log(data);
                curent_content.empty();
                if(data.conected===true){
                    curent_content.empty().html('<div class="wpstream_live_uri">'+data.obs_uri+'</div><div class="wpstream_live_key">'+data.obs_stream+'</div>');
                    loader.hide();
                    parent.find('.record_wrapper').hide();
                    parent.find('.start_event').hide();
                    parent.find('.close_event ').hide();
                    wpstream_enable_cliboard(parent);
                }else{
                    notification_area.empty().text('not conected');
                }
                
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
        
    });
    

});


function wpstream_enable_cliboard(parent){
    jQuery(parent).find('.copy_live_uri').click(function(){
        var value_uri = jQuery(parent).find('.wpstream_live_uri_text').text();
        var temp = jQuery("<input>");
        jQuery("body").append(temp);
        jQuery(temp).val(value_uri).select();
        document.execCommand("copy");
        jQuery(temp).remove();
        
    });
    
    jQuery(parent).find('.copy_live_key').click(function(){
        var value_uri = jQuery(parent).find('.wpstream_live_key_text').text();
        var temp = jQuery("<input>");
        jQuery("body").append(temp);
        jQuery(temp).val(value_uri).select();
        document.execCommand("copy");
        jQuery(temp).remove();
        
    });
}