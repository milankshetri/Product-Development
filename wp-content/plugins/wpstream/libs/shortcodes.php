<?php
//add_action('init', 'wpstream_shortcodes');
function wpstream_shortcodes(){
    wpstream_register_shortcodes();
    wpstream_tiny_short_codes_register();
}

function wpstream_register_shortcodes() {
    add_shortcode('wpstream_player', 'wpstream_insert_player_inpage');
    add_shortcode('wpstream_list_products', 'wpstream_list_products_function');
}


if( function_exists('vc_map') ):
     vc_map(
    array(
       "name" => esc_html__( "WpStream Player","wpestate"),
       "base" => "wpstream_player",
       "class" => "",
       "category" => esc_html__( 'WpStream','wpestate'),
       'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
       'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
       'weight'=>100,
       'icon'   =>'',
       'description'=>esc_html__( 'Insert WpStream Player','wpestate'),
       "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__( "Content Id","wpestate"),
                "param_name" => "id",
                "value" => "0",
                "description" => esc_html__( "Add here the live stream id or the video id","wpestate")
            ),
          
       )
    )
    );
endif;



function wpstream_tiny_short_codes_register() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    
    if (get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', 'wpstream_add_plugin');
        add_filter('mce_buttons_2', 'wpstream_register_button');    
    }

}


function wpstream_register_button($buttons) {
    array_push($buttons, "|", "wpstream_player");
    array_push($buttons, "|", "wpstream_list_products");    
    return $buttons;
}

function wpstream_add_plugin($plugin_array) {   
    $plugin_array['wpstream_player']        = PLUGIN_DIR_URL. '/js/shortcodes.js';
    $plugin_array['wpstream_list_products']        = PLUGIN_DIR_URL. '/js/shortcodes.js';
    return $plugin_array;
}





function wpstream_insert_player_inpage($attributes, $content = null){
    $product_id     =   '';
    $return_string  =   '';
    $attributes =   shortcode_atts( 
        array(
            'id'                       => 0,
        ), $attributes) ;
       
       
    if ( isset($attributes['id']) ){
        $product_id=$attributes['id'];
    }
    
    ob_start();
    wpstream_video_player_shortcode($product_id);
    $return_string= ob_get_contents();
    ob_end_clean(); 
   
    return $return_string;
}




function wpstream_video_player_shortcode($from_sh_id='') {
 
    if ( is_user_logged_in() ) {
        global $product;
        $current_user   =   wp_get_current_user();
        $product_id     =   intval($from_sh_id);
      
        
        if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $product_id) || get_post_type($product_id)=='wpstream_product' ){
            global $product;
            echo '<div class="wpstream_player_wrapper wpstream_player_shortcode"><div class="wpstream_player_container">';
          
            
            if( get_post_type($product_id) == 'wpstream_product' ){
              
                $wpstream_product_type =    esc_html(get_post_meta($product_id, 'wpstream_product_type', true));
                if($wpstream_product_type==1){
                    wpstream_live_event_player($product_id);
                } else if($wpstream_product_type==2){
                    wpstream_video_on_demand_player($product_id);
                }
                   
            }else{
                $term_list      =   wp_get_post_terms($product_id, 'product_type');
                if( $term_list[0]->name=='live_stream'){
                    wpstream_live_event_player($product_id);
                }else if( $term_list[0]->name=='video_on_demand'){
                    wpstream_video_on_demand_player($product_id);
                }
            }
            
         
           
        }else{
            $thumb_id           =   get_post_thumbnail_id($product_id);
            $thumb              =   wp_get_attachment_image_src($thumb_id,'medium_large');
    
            echo '<div class="wpstream_player_wrapper wpstream_player_shortcode no_buy"><div class="wpstream_player_container">';
            echo '<div class="wpstream_notice">'.__('You did not bought this product!','wpstream').
                  '</div><img src="'.$thumb[0].'" alt="product_thumb">';
        }
        
        echo '</div></div>';
    }
}









function wpestate_stream_validate_keys($attributes, $content = null){
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
            
           
                 $get_key = wpstream_get_encryption_key($stream_key,$event_data['ip']);
//                if ( false === ( $get_key = get_transient( $show_id.'_carnatus1' ) ) ) {
//                    $get_key = wpstream_get_encryption_key($real_stream_key,$event_data['ip']);
//                    set_transient(  $show_id.'_carnatus1', $get_key, 3600 );
//                }
                return $get_key;
//            if( wc_customer_bought_product( $current_user->email, $current_user->ID, $show_id) ){                   
//            }else{
//              
//                exit('no ticket');
//            }
            
        } else{
            exit('not query');
        }
        
    }else{
        exit('not log');
    }
  
}




 
  
  if( function_exists('vc_map') ):
    $product_type=array('1','2');
     vc_map(
    array(
       "name" => esc_html__( "WpStream Products List","wpestate"),
       "base" => "wpstream_list_products",
       "class" => "",
       "category" => esc_html__( 'WpStream','wpestate'),
       'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
       'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
       'weight'=>100,
       'icon'   =>'',
       'description'=>esc_html__( ' List wpstream products','wpestate'),
       "params" => array(
            array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_html__( "Media number","wpestate"),
                 "param_name" => "media_number",
                 "value" => "",
                 "description" => esc_html__( "No of media ","wpestate")
             ),
           
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__( "Product type","wpestate"),
                "param_name" => "product_type",
                "value" => $product_type,
                "description" => esc_html__( "What type of products ","wpestate")
            ),
          
       )
    )
    );
endif;



  function wpstream_list_products_function($atts, $content=null){
   
    $media_number     = "";  
    $product_type     = ""; 
    $attributes = shortcode_atts(
            array(
                    'media_number' => '4',
                    'product_type' => '1',
  
            ), $atts);
    
     if ( isset($attributes['media_number']) ){
            $media_number=$attributes['media_number'];
    	}
    if ( isset($attributes['product_type']) ){
            $product_type=$attributes['product_type'];
    	}
    $return_string=""; 
  
    
    
    $args = array(
        'post_type'      => 'wpstream_product',
        'post_status'    => 'publish',
        'meta_query'     =>array(
                            array(
                            'key'      => 'wpstream_product_type',
                            'value'    => $product_type,
                            'compare'  => '=',
                            ),
            ),
        'post_per_page' =>$media_number 
    );
 
    $media_list= new WP_Query($args);
    
    if($product_type==1){
        $see_product= __('See Free Live Chanel','wpstream');
                
             
    }else{
        $see_product =_('See Free Video','wpstream');
    }
    

    
    while($media_list->have_posts()):$media_list->the_post();
  
    $return_string.='<div class="wpstream_product_unit">'
            .'<div class="product_image" style="background-image:url('.wp_get_attachment_thumb_url(get_post_thumbnail_id()).')"></div>'
            .'<a href="'.get_permalink().'" class="product_title" >'.get_the_title().'</a>'
            .'<a href="'.get_permalink().'"class="see_product">'.$see_product.'</a>'
            .'</div>';
    endwhile;
  
//        wp_reset_data();
        wp_reset_query();
        
       
        return   '<div class="shortcode_list_wrapper">'.$return_string.'</div>';
 
  }
   