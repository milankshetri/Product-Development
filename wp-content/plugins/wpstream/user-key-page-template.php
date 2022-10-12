<?php
//this is for vod - do not edit
global $wp_query;
$current_user   =   wp_get_current_user();
$folder         =   sanitize_text_field( $wp_query->query_vars['streamname'] );
$movie          =   sanitize_text_field ( $wp_query->query_vars['streamname2'] );   

$free_args = array(
    'posts_per_page'    => -1,
    'post_type'         => 'wpstream_product',
    'meta_query' => array(
        array(
            'key'     => 'wpstream_free_video',
            'value'   => $movie,
            'compare' => '=',
        ),
    )
);


$free_video_list = new WP_Query($free_args);

if ($free_video_list->have_posts() ){
    $get_key = wpstream_get_vod_key($folder.'/'.$movie);
    echo ($get_key);
}else{




    if ( is_user_logged_in() && intval($current_user->ID)!=0 
      // 1==1
       ) {  




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
                            'terms'     =>  array('video_on_demand','subscription')
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
            
            $is_valid_subscription=0;
            if(class_exists ('WC_Subscription')){
                $is_valid_subscription = wcs_user_has_subscription( $current_user->ID, $show_id ,'active');
            }


            if( wc_customer_bought_product( $current_user->email, $current_user->ID, $video_id) || $is_valid_subscription==1 ){     
                $get_key = wpstream_get_vod_key($folder.'/'.$movie);
                echo ($get_key);
            }else{
                exit('no ticket');
            }

        }else{
            exit('not query x');
        }

    }else{
        exit('not log');
    }

}
  
function strToBin3($input)
{
    if (!is_string($input))
        return false;
    $input = unpack('H*', $input);
    $chunks = str_split($input[1], 2);
    $ret = '';
    foreach ($chunks as $chunk)
    {
        $temp = base_convert($chunk, 16, 2);
        $ret .= str_repeat("0", 8 - strlen($temp)) . $temp;
    }
    return $ret;
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



function wpstream_get_vod_key($filename){    
    $token  = rcapi_retrive_token();
    $domain = parse_url ( get_site_url() );
    
    $values_array=array(
        "filename"           =>  $filename,
      
    );
   // print_r($values_array);
    $url            =   CLUBLINKSSL."://www.".CLUBLINK."/wp-json/rcapi/v1/uservodkey/get/?access_token=".$token;


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

