<?php


    global $wp_query;
    $current_user   =   wp_get_current_user();
    $stream_key     =   $wp_query->query_vars['streamname'];
    
  
    $stream_key_array= explode('-', $stream_key);
    
    $real_stream_key = $stream_key_array[0];
   
    
    if ( is_user_logged_in() && intval($current_user->ID)!=0 ) {  
       
        $args = array(
            'posts_per_page'    => -1,
            'post_type'         => 'product',
            'meta_query' => array(
		array(
			'key'     => 'live_event_stream_name',
			'value'   => $real_stream_key,
			'compare' => '=',
		),
            ),
            'tax_query'         => array(
                        'relation'  => 'AND',
                        array(
                            'taxonomy'  =>  'product_type',
                            'field'     =>  'slug',
                            'terms'     =>  'live_stream'
                        )
                    ),
        );
    

        $event_list = new WP_Query($args);
        
        if ($event_list->have_posts() ){
            while ( $event_list->have_posts() ): 
                $event_list->the_post(); 
                $the_id     =   get_the_ID();
                $event_data =   get_post_meta($the_id,'live_event_uri',true);
                $show_id    =   $event_data['show_id'];
                
            endwhile;
            
           
           

               
            if( wc_customer_bought_product( $current_user->email, $current_user->ID, $show_id) ){     

                if ( false === ( $get_key = get_transient( $show_id.'_carnatus1x' ) ) ) {
                    $get_key = wpstream_get_encryption_key($stream_key,$event_data['ip']);
                    //set_transient(  $show_id.'_carnatus1', $get_key, 3600 );
                    set_transient(  $show_id.'_carnatus1x', $get_key, 30 );
                }
                
                //$get_key = wpstream_get_encryption_key($stream_key,$event_data['ip']);
                print $get_key;

            }else{
                exit('no ticket');
            }
            
        } else{
            exit('not query x');
        }
        
    }else{
        exit('not log');
    }
    
    
function wpstream_get_encryption_key($stream_key,$server_ip){
   
    $url= 'http://'.$server_ip.':8080/keys/'.$stream_key;
    $get= wp_remote_get( $url );
    if(is_array($get)){
        $body = $get['body'];
        return($body);
    }else{
        return  'cuc'.generateRandomString(32);
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

