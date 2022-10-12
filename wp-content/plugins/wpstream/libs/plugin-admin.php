<?php
if( !function_exists('wpstream_new_general_set') ):
function wpstream_new_general_set() {  
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){	
        $allowed_html   =   array();
        $exclude_array  =   array();
        
        foreach($_POST as $variable=>$value){	

            if ($variable!='submit'){
                if (!in_array($variable, $exclude_array) ){
                    update_option( 'wpstream_'.$variable, $value );
                }	
            }	
        }
        
   
        update_option('wp_estate_token_expire',0);
        update_option('wp_estate_curent_token',' ');
        
        
    }


    
    $allowed_html   =   array();
    $api_key        =   esc_html( get_option('wpstream_api_key','') );
   

    $wpstream_options_array =array(
        0   =>  array(
                    'label' =>  'api key',
                    'name'  =>  'api_key',
                    'type'  =>  'text',
                ),
        1   =>  array(
                    'label' =>  'api secret key',
                    'name'  =>  'api_secret_key',
                    'type'  =>  'text',
                ),
        2   =>  array(
                    'label' =>  'api username',
                    'name'  =>  'api_username',
                    'type'  =>  'text',
                ),
        3   =>  array(
                    'label' =>  'api password',
                    'name'  =>  'api_password',
                    'type'  =>  'password',
                )
    );

    
 
 
  
    
    print   '<form method="post" action="" >';
                print '<div  class="theme_options_tab" >
                        <h1>'.__('General Settings','wpstream').'</h1>';
                   
                        if( wpstream_client_check_api_status() ){
                            echo '<div class="api_conected">'.__('Conected to WP Stream API!','wpstream').'</div>';
                        }else{
                            echo '<div class="api_not_conected">'.__('No Connection to WP Stream API. Go ','wpstream').'<a href="https://wpstream.net/my-account" target="_blank">here</a>'.__(' to get your API credentials','wpstream').'</div>';
                        }
                        print '<div class="wpstream_option_wrapper">';
                            foreach ($wpstream_options_array as $key=>$option){
                                print '<div class="wpstream_option">';
                            
                                    $options_value =  esc_html( get_option('wpstream_'.$option['name'],'') );
                                    print '<label for="'.$option['name'].'">'.$option['label'].'</label>';
                                    print '<input id="'.$option['name'].'" type="'.$option['type'].'" size="36"  name="'.$option['name'].'" value="'.$options_value.'" />';
                                
                                print '</div>';
                            }
                        print '</div>';

               
                    print '<input type="submit" name="submit"  class="wpstream_button" value="'.__('Save Changes','wpstream').'" />';
                    
                print '</div>';
    print   '</form>';
  
    
    $no_channel=1;
    
    if(class_exists ('WC_Subscription')){
      
    }
    
    //event_passed
    $args = array(
        'posts_per_page'    => -1,
        'post_type'         => 'product',
        'post_status'       => 'publish',
        'meta_query'        =>      array(
                                        array(
                                                'key'     => 'event_passed',
                                                'value'   => 1,
                                                'compare' => '!=',
                                        )
                                    ),
        
        'tax_query'         => array(
                                'relation'  => 'AND',
                                array(
                                    'taxonomy'  =>  'product_type',
                                    'field'     =>  'slug',
                                    'terms'     => array('live_stream','subscription')
                                )
                            ),
    );
    

   
    $event_list = new WP_Query($args);
    global $live_event_for_user;
    
    $live_event_for_user    =   wpstream_get_live_event_for_user();
  
    $pack_details           =   wpstream_get_pack_details_user();
   
    if( isset($pack_details['band']) && isset( $pack_details['storage']) ){
        print '<div class="pack_details_wrapper"><strong>'.__('Your account information: ','wpstream').'</strong> '.__('You have','wpstream').'<strong> '.wpstream_convert_band($pack_details['band']).' Gb</strong> '.__('available streaming bandwidth and','wpstream').' <strong>'.wpstream_convert_band($pack_details['storage']).' Gb</strong> '.__('available media storage','wpstream').'.</div>';
    }

    
    print '<div class="pack_details_wrapper">
    <h3>'.__('How to Broadcast','wpestate').'</h3>     
    <ul>
        <li>1. Click on the "Give me the live uri " button and wait for your streaming url to become available(about 1 min.)</li>
        <li>2. Copy paste it and use it with <a href="https://obsproject.com/download" target="_blank">"Open Brodcaster Software"</a>. </li>
        <li>3. If you did not use OBS until now please see this tutorial.</li>
        
    <ul>
    <img class="how_to" src="'.plugins_url().'/wpstream/img/how_to_obs.jpg" alt="show_imagge">
    </div>';

    if($event_list->have_posts()){
        print '<div class="pack_details_wrapper_transparent">
        <h3>'.__('Your Paid Channel List','wpestate').'</h3>     
        </div>';

        print '<div style="clear: both;"></div><div class="event_list_wrapper">';
       
            while ($event_list->have_posts()): $event_list->the_post();
                
                $the_id =   get_the_ID();
                $is_subscription_live_event =   esc_html(get_post_meta($the_id,'_subscript_live_event',true));
                $term_list                  =   wp_get_post_terms($the_id, 'product_type');
    
                if( $term_list[0]->name=='subscription' && $is_subscription_live_event=='no'){
                    continue;
                }
                
                wpstream_live_stream_unit($the_id);

            endwhile;
            
        print'</div>'; 
        $no_channel=1;
    }else{
        $no_channel=0;
    }
 
    
    $ajax_nonce = wp_create_nonce( "wpstream_start_event_nonce" );
    print '<input type="hidden" id="wpstream_start_event_nonce" value="'.$ajax_nonce.'">';
    $current_user       =   wp_get_current_user();
    $allowded_html      =   array();
    $userID             =   $current_user->ID;
    $user_live_streams  =   get_user_meta($userID,'live_shows');

    
    wp_reset_postdata();
    
    
    
    
    
    
    
    
    // free 
    
    $args_free = array(
        'posts_per_page'    => -1,
        'post_type'         => 'wpstream_product',
        'post_status'       => 'publish',
        'meta_query'        =>      array(
                                        array(
                                                'key'     => 'wpstream_product_type',
                                                'value'   => 1,
                                                'compare' => '==',
                                        )
                                    ),
        
       
    );
    $event_list_free = new WP_Query($args_free);
    
    
    if($event_list_free->have_posts()){
        print '<div class="pack_details_wrapper_transparent">
        <h3>'.__('Your Free Channel List','wpestate').'</h3>     
        </div>';

        print '<div style="clear: both;"></div><div class="event_list_wrapper">';
       
            while ($event_list_free->have_posts()): $event_list_free->the_post();
                
                $the_id =   get_the_ID();
                wpstream_live_stream_unit($the_id);

            endwhile;
            
        print'</div>';    
        $no_channel=1;
    }else{
        $no_channel=0;
    }
    
    
    
    if($no_channel==0){
        print '<div class="no_events_warning"> '.__('* You don\'t have live chanels.Please add on in your Free Products /Woocomerce Products menu!','wpstream').'</div>';
    }
    
    
    
    
}
endif; // end   wpstream_new_general_set  







function wpstream_live_stream_unit($the_id){
    global $live_event_for_user;
   
        
  
    print '<div class="event_list_unit">';
        $thumb  =   get_the_post_thumbnail_url($the_id,'thumbnail');
        print '<div class="event_thumb_wrapper"><img class="event_thumb" src="'.$thumb.'" alt="show_imagge"></div>';
        print '<h3 data-prodid="'.$the_id.'">'.get_the_title($the_id).'</h3>';

        $live_event_stream_name =   get_post_meta($the_id,'live_event_stream_name',true);
        $live_event_array       =   get_post_meta($the_id,'live_event_uri',true);
        $live_event_uri         =   '';

        
    
        if( isset($live_event_array['live_uri']) ){
            $live_event_uri     =   $live_event_array['live_uri'];
        }

        print '<div class="event_list_unit_notification"></div>';
        if(isset($live_event_for_user[$the_id])) {
            if($live_event_uri != ''){      
                $stream_name = get_post_meta($the_id,'live_event_stream_name',true);
                print '<div class="event_list_unit_notificationx"><strong>'.__('Url:').' </strong> '.$live_event_uri.' ';
                print '</br><strong>'.__('Stream Key:').'</strong> '. $stream_name .'</br>';
                print '</div>';
            }
        }else{
            print '<div class="event_list_unit_notificationx"><span class="server_notification">'.__('There is no  active streaming server for this event!','wpestream').'</span><img class="server_loading" src="'.plugins_url().'/wpstream/img/loading.gif" alt="loading" /></div>';
            print '<div class="record_wrapper">Record ? <input type="checkbox" name="record_event" class="record_event"/>Yes</div>';
            print '<input class="start_event wpstream_button"  type="button" data-show-id="'.$the_id.'" value="Start Broadcasting">';
            print '<input class="close_event wpstream_button"  type="button" data-show-id="'.$the_id.'" value="Delete Channel">';
        }


        if(isset($live_event_for_user[$the_id])) {
            print '</br>';
            $live_event_host= explode('wpstream/',$live_event_uri);
            print wpstream_check_open_port($live_event_host[0]);
        }
        print '<div> '.__('* You can do multiple live events on a single channel. **Once you delete a channel you will not be able to to a live event on it again.','wpstream').'</div>';
    print '</div>';
}






function wpstream_convert_band($megabits){
    $gigabit    =   $megabits   *   0.001;
    $gigabit    =   number_format($gigabit,2);
    return $gigabit;
}



function wpstream_check_open_port($host){
    $host= str_replace("rtmp://", "",$host);
    $host= str_replace("/", "",$host);
    
    $port='1935';
    $connection = fsockopen($host, $port);
    if (is_resource($connection)){
        print '<div class="server_ready_live">'.__('Ready for Live Streaming','wpstream').'</div>';
        fclose($connection);
    }else{
        print '<div class="server_not_ready_live">'.__('Not Ready Yet!','wpstream').'</div>';
    }
    
}