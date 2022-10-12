<?php

/*
 *  Check live streams for this user
 */
//if( !function_exists('wpstream_get_videos') ):
//    function wpstream_get_videos(){
//        $current_user       =   wp_get_current_user();
//        $allowded_html      =   array();
//        $userID             =   $current_user->ID;
//        $return_uri         =   '';
//        if( !current_user_can('administrator') ){
//           exit('okko');
//        }
//        
//  
//        $video_data         =   wpstream_get_videos_from_storage();
//       
//        return $video_data;
//    }
//endif;

if( !function_exists('wpstream_get_pack_details_user') ):
    function wpstream_get_pack_details_user(){
        $current_user       =   wp_get_current_user();
        $allowded_html      =   array();
        $userID             =   $current_user->ID;
        $return_uri         =   '';
        if( !current_user_can('administrator') ){
           exit('okko');
        }
        
  
        $pack_data         =   wpstream_request_pack_data_per_user();
       
        return $pack_data;
    }
endif;


if( !function_exists('wpstream_get_live_event_for_user') ):
    function wpstream_get_live_event_for_user(){
        $current_user       =   wp_get_current_user();
        $allowded_html      =   array();
        $userID             =   $current_user->ID;
        $return_uri         =   '';
        if( !current_user_can('administrator') ){
           exit('okko');
        }
        
  
        $event_data         =   wpstream_request_live_stream_for_user($userID);
        
       
        
        return $event_data;
    }
endif;




/*
 * Mark event as closed
 */
add_action( 'wp_ajax_wpstream_close_event', 'wpstream_close_event' );  

if( !function_exists('wpstream_close_event') ):
    function wpstream_close_event(){
        check_ajax_referer( 'wpstream_start_event_nonce', 'security' );
        $current_user       =   wp_get_current_user();
        $allowded_html      =   array();
        $userID             =   $current_user->ID;
        $return_uri         =   '';
        if( !current_user_can('administrator') ){
           exit('okko');
        }
        
        $show_id            =   intval($_POST['show_id']);
       
        update_post_meta ($show_id,'event_passed',1);
        
        die();
    }
endif;


/*
 * Serve live Stream URL from wpstream
 */



add_action( 'wp_ajax_wpstream_give_me_live_uri', 'wpstream_give_me_live_uri' );  
if( !function_exists('wpstream_give_me_live_uri') ):
    function wpstream_give_me_live_uri(){
    

//        
//        $event_data['live_uri']=' rtmp://28.live.streamer.wpstream.net/wpstream/fmkb71z9yq9r7E2DK8mMlIipHKlz0u8f?auth=RsrZu092riuyXxcH';
//        $explode = explode('wpstream.net/',  $event_data['live_uri']);
//        $uri = $explode[0].'wpstream.net/wpstream/';
//        $stream_key = trim(str_replace('wpstream/',' ',$explode[1]));
//     
//        echo json_encode(   array(
//                            'conected'  =>  true,
//                            'live_uri'  =>  $event_data['live_uri'] ,
//                            'all_data'  =>  $event_data,
//                            'obs_uri'   =>  '<strong>'.__('Url:').'</strong> <div class="wpstream_live_uri_text">'.$uri.'</div><div class="copy_live_uri">'.__('copy to clipboard','wpstream').'</div>',
//                            'obs_stream'=>  '<strong>'.__('Stream Key:').'</strong> <div class="wpstream_live_key_text">'.$stream_key.'</div><div class="copy_live_key">'.__('copy to clipboard','wpstream').'</div>',
//                        )
//                    );
//        die();
//        
        
        
        
        check_ajax_referer( 'wpstream_start_event_nonce', 'security' );
        $current_user       =   wp_get_current_user();
        $allowded_html      =   array();
        $userID             =   $current_user->ID;
        $return_uri         =   '';
        
        if( !current_user_can('administrator') ){
           exit('okko');
        }
        
        $show_id            =   intval($_POST['show_id']);
        $is_record          =   floatval($_POST['is_record']);
        $event_data         =   wpstream_request_live_stream_uri($show_id,$is_record);
        
        if( is_array( $event_data ) ){
            update_post_meta($show_id,'live_event_uri',$event_data);
            update_post_meta($show_id,'live_event_stream_name',$event_data['carnat1']);
        }
        
        
        if(is_array($event_data)){
            $explode = explode('wpstream.net/',  $event_data['live_uri']);
            $uri = $explode[0].'wpstream.net/wpstream/';
            $stream_key = trim(str_replace('wpstream/',' ',$explode[1]));

            echo json_encode(   array(
                                'conected'  =>  true,
                                'live_uri'  =>  $event_data['live_uri'] ,
                                'all_data'  =>  $event_data,
                                'obs_uri'   =>  '<strong>'.__('Url:').'</strong> <div class="wpstream_live_uri_text">'.$uri.'</div><div class="copy_live_uri">'.__('copy to clipboard','wpstream').'</div>',
                                'obs_stream'=>  '<strong>'.__('Stream Key:').'</strong> <div class="wpstream_live_key_text">'.$stream_key.'</div><div class="copy_live_key">'.__('copy to clipboard','wpstream').'</div>',
                            )
                        );
        
//            echo json_encode(   array(
//                                'conected'  =>  true,
//                                'live_uri'  =>  $event_data['live_uri'] ,
//                                'all_data'  =>  $event_data 
//                            )
//                        );
        }else{
            $explode = explode('wpstream.net/',  $event_data);
            $uri = $explode[0].'wpstream.net/wpstream/';
            $stream_key = trim(str_replace('wpstream/',' ',$explode[1]));
            echo json_encode(   array(
                                'conected'  =>  true,
                                'live_uri'  =>  $event_data['live_uri'] ,
                                'all_data'  =>  $event_data,
                                'obs_uri'   =>  '<strong>'.__('Url:').'</strong> <div class="wpstream_live_uri_text">'.$uri.'</div><div class="copy_live_uri">'.__('copy to clipboard','wpstream').'</div>',
                                'obs_stream'=>  '<strong>'.__('Stream Key:').'</strong> <div class="wpstream_live_key_text">'.$stream_key.'</div><div class="copy_live_key">'.__('copy to clipboard','wpstream').'</div>',
                            )
                        );
             
//            echo json_encode(   array(
//                                'conected'  =>  true,
//                                'live_uri'  =>  $event_data ,
//                                'all_data'  =>  $event_data 
//                            )
//                        );
        }
        die();
    }
endif;

//
//function wpstream_get_videos_from_storage(){
//    
//    if( !current_user_can('administrator') ){
//        exit('okko');
//    }
//    $token          =   rcapi_retrive_token();
//    $values_array   =   array();
//    $url            =   CLUBLINKSSL."://www.".CLUBLINK."/wp-json/rcapi/v1/videos/get_list/?access_token=".$token;
//
//    
//    $arguments = array(
//	'method'        => 'GET',
////	'timeout'       => 45,
//	'redirection'   => 5,
//	'httpversion'   => '1.0',
//	'blocking'      => true,
//	'headers'       => array(),
//	'body'          => $values_array,
//	'cookies'       => array()
//    );
//    $response       = wp_remote_post($url,$arguments);
//    $received_data  = json_decode( wp_remote_retrieve_body($response) ,true);
//
//  
//    
//    if( isset($response['response']['code']) && $response['response']['code']=='200'){
//        $video_options=array();
//        foreach ($received_data as $key=>$videos){
//           $video_options[$videos['storage_name']]=$videos['name'];
//        }
//        return $video_options;
//    }else{     
//        return 'failed connection';
//    }
// 
//}


/*
 * 
 */
function wpstream_request_pack_data_per_user(){
    
    if( !current_user_can('administrator') ){
        exit('okko');
    }
    $token          =   rcapi_retrive_token();
    $values_array   =   array();
    $url            =   CLUBLINKSSL."://www.".CLUBLINK."/wp-json/rcapi/v1/status/packdetails/?access_token=".$token;

    
    $arguments = array(
	'method'        => 'GET',
	'timeout'       => 45,
	'redirection'   => 5,
	'httpversion'   => '1.0',
	'blocking'      => true,
	'headers'       => array(),
	'body'          => $values_array,
	'cookies'       => array()
    );
    $response       = wp_remote_post($url,$arguments);
    $received_data  = json_decode( wp_remote_retrieve_body($response) ,true);

  
    
    if( isset($response['response']['code']) && $response['response']['code']=='200'){
       return ($received_data);
    }else{     
        return 'failed connection';
    }
 
}


/*
 * 
 */
function wpstream_request_live_stream_for_user($user_id){
    if( !current_user_can('administrator') ){
        exit('okko');
    }
    $domain = parse_url ( get_site_url() );
    $token= rcapi_retrive_token();
    
    $values_array=array(
        "show_id"           =>  $user_id,
        "scheme"            =>  $domain['scheme'],
        "domain"            =>  $domain['host'],
        "domain_ip"         =>  $_SERVER['SERVER_ADDR']
    );
   
  
    
    $url=CLUBLINKSSL."://www.".CLUBLINK."/wp-json/rcapi/v1/livestrem/peruser/?access_token=".$token;

    
    $arguments = array(
	'method'        => 'GET',
	'timeout'       => 45,
	'redirection'   => 5,
	'httpversion'   => '1.0',
	'blocking'      => true,
	'headers'       => array(),
	'body'          => $values_array,
	'cookies'       => array()
    );
    $response       = wp_remote_post($url,$arguments);
    $received_data  = json_decode( wp_remote_retrieve_body($response) ,true);
   // print_r($response);
  
    if(is_wp_error($response)){
        return 'failed connection';
    }
    if( isset($response['response']['code']) && $response['response']['code']=='200'){
       return ($received_data);
    }else{     
        return 'failed connection';
    }
 
}



function wpstream_request_live_stream_uri($show_id,$is_record){    
    $token  = rcapi_retrive_token();
    $domain = parse_url ( get_site_url() );
    
    $values_array=array(
        "show_id"           =>  $show_id,
        "scheme"            =>  $domain['scheme'],
        "domain"            =>  $domain['host'],
        "domain_ip"         =>  $_SERVER['SERVER_ADDR'],
        "is_record"         =>  $is_record,
    );
   
    $url=CLUBLINKSSL."://www.".CLUBLINK."/wp-json/rcapi/v1/livestrem/new/?access_token=".$token;

    
    $arguments = array(
	'method'        => 'GET',
	'timeout'       => 45,
	'redirection'   => 5,
	'httpversion'   => '1.0',
	'blocking'      => true,
	'headers'       => array(),
	'body'          => $values_array,
	'cookies'       => array()
    );
    $response       = wp_remote_post($url,$arguments);
    $received_data  = json_decode( wp_remote_retrieve_body($response) ,true);
  // print_r($response);
  
    
    if( isset($response['response']['code']) && $response['response']['code']=='200'){
       return ($received_data);
    }else{     
        return 'failed connection';
    }
 
}



function rcapi_retrive_token(){
    $token_expiration = floatval( esc_html ( get_option('wp_estate_token_expire','') ) );
    $time= time();
    
    //print 'check ';
     $check= $token_expiration - $time + 3600;
    //print '</br>';
    
    
    if ( $check <= 0 || $token_expiration==0){
      //  print'regenerate 1';
        $token = rentals_club_get_token();
        update_option('wp_estate_token_expire',time());
        update_option('wp_estate_curent_token',$token);
    }else{
    //    print 'from db</br>';
        $token = esc_html ( get_option('wp_estate_curent_token','') );
    }
    
    if($token==''){
        //print'regenerate 2';
        $token = rentals_club_get_token();
        update_option('wp_estate_token_expire',time());
        update_option('wp_estate_curent_token',$token);
    }
  //  print 'we use '.$token.'</br>';
    
    return $token;
    
}

function rentals_club_get_token(){
    
    $client_id      = esc_html ( get_option('wpstream_api_key','') );
    $client_secret  = esc_html ( get_option('wpstream_api_secret_key','') );
    $username       = esc_html ( get_option('wpstream_api_username','') );
    $password       = esc_html ( get_option('wpstream_api_password','') );



    if ($client_id=='' || $client_secret=='' || $username=='' || $password==''){
        return;
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => CLUBLINKSSL."://www.".CLUBLINK."/?oauth=token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "grant_type=password&username=".$username."&password=".$password,
    CURLOPT_HTTPHEADER => array(
        "authorization: Basic ". base64_encode( $client_id . ':' . $client_secret ),
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
        "postman-token: 3d65984a-9f80-a881-5fe9-59717126687e"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
   /*
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    } */
    $response= json_decode($response);
 
    if(isset($response->access_token)){
        return $response->access_token;
    }else{
        return;
    }
  
    //print_r($response);
}
        


function wpstream_client_check_api_status(){
    
    $token= rcapi_retrive_token();
    // save sms functions 
    $url=CLUBLINKSSL."://www.".CLUBLINK."/wp-json/rcapi/v1/status/?access_token=".$token;
    $arguments = array(
	'method' => 'GET',
	'timeout' => 45,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking' => true,
	'headers' => array(),
	'cookies' => array()
    );
    $response   =   wp_remote_post($url,$arguments);
    $body       =   wp_remote_retrieve_body($response);
    


    
    if ( $body === true || $body ==='true'){
        return true;
    }else{
        return false;
    }
    
//    return $body;
 
}