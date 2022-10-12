<?php
global $wp_query;
$current_user   =   wp_get_current_user();

if ( // is_user_logged_in() && intval($current_user->ID)!=0
    1==1
        ) {  

    $folder         =   sanitize_text_field( $wp_query->query_vars['streamname'] );
    $movie          =   sanitize_text_field ( $wp_query->query_vars['streamname2'] );


    $args = array(
        'posts_per_page'    => -1,
        'post_type'         => 'product',
        'meta_query' => array(
            array(
                    'key'     => '_movie_url',
                    'value'   => $movie,
                    'compare' => '=',
            ),
        ),
        'tax_query'         => array(
                    'relation'  => 'AND',
                    array(
                        'taxonomy'  =>  'product_type',
                        'field'     =>  'slug',
                        'terms'     =>  'video_on_demand'
                    )
            ),

    );
    

    $video_list = new WP_Query($args);
       
    $video_id=0;
    if ($video_list->have_posts() ){
        while ( $video_list->have_posts() ): 
            $video_list->the_post(); 
            $video_id     =   get_the_ID();
        endwhile;
            
       
        if(  //wc_customer_bought_product( $current_user->email, $current_user->ID, $video_id) 
              1==1 
              ){     
            
                $get_key = get_post_meta( $video_id,'_keynew',true );
                if ( $get_key == '' ) {
                    $get_key =  generateRandomString(16);
                    update_post_meta( $video_id,'_keynew', $get_key );
                }
                
                
              
                $return_array=array(
                    "key" => base64_encode($get_key),
                    "key_id"=> base64_encode($get_key)
                );
          
                
                $new_array=array();
                $new_array[]=$return_array;
                header('Content-Type: application/json');
                print json_encode($new_array);
       
                
                
        }else{
            exit('no ticket');
        }
            
    }else{
        exit('not query vod');
    }
        
}else{
    exit('not log');
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

