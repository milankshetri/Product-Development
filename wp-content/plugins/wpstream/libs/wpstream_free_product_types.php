<?php
// register the custom post type
add_action( 'init', 'wpstream_create_free_products',1 );

function wpstream_create_free_products() {
    
    register_post_type( 'wpstream_product',
            array(
            'labels' => array(
                    'name'          => __( 'Free Live Channels / Free Videos on Demand','wpstream'),
                    'singular_name' => __( 'Free Live Channel / Free Video on Demand','wpstream'),
                    'add_new'       => __('Add New Free Live Channel / Free Video on Demand','wpstream'),
            'add_new_item'          =>  __('Add Free Free Live Channel / Free Video on Demand','wpstream'),
            'edit'                  =>  __('Edit' ,'wpstream'),
            'edit_item'             =>  __('Edit Free Live Channel / Free Video on Demand','wpstream'),
            'new_item'              =>  __('New Free Live Channel / Free Video on Demand','wpstream'),
            'view'                  =>  __('View','wpstream'),
            'view_item'             =>  __('View Free Live Channel / Free Video on Demand','wpstream'),
            'search_items'          =>  __('Search Free Live Channel / Free Video on Demand','wpstream'),
            'not_found'             =>  __('No Free Free Live Channel / Free Video on Demand','wpstream'),
            'not_found_in_trash'    =>  __('No Free Free Live Channel / Free Video on Demand','wpstream'),
            'parent'                =>  __('Parent Free Live Channel / Free Video on Demand','wpstream')
                    ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'wpstream'),
            'supports' => array('title', 'editor', 'thumbnail','comments','excerpt'),
            'can_export' => true,
            'register_meta_box_cb' => 'wpstream_add_product_metaboxes',
            'taxonomies'          => array( 'category','post_tag' ),
            

            )
    );
   
    
        
    register_taxonomy('wpstream_actors', array('wpstream_product','product'), array(
        'labels' => array(
            'name'              => esc_html__('Actors','wpstream'),
            'add_new_item'      => esc_html__('Add New Actor','wpstream'),
            'new_item_name'     => esc_html__('New actors','wpstream')
        ),
        'hierarchical'  => true,
        'query_var'     => true,
        'rewrite'       => array( 'slug' => 'actors' )
        )
    );

    register_taxonomy('wpstream_category', array('wpstream_product','product'), array(
        'labels' => array(
            'name'              => esc_html__('Media Category','wpstream'),
            'add_new_item'      => esc_html__('Add New Category','wpstream'),
            'new_item_name'     => esc_html__('New Category','wpstream')
        ),
        'hierarchical'  => true,
        'query_var'     => true,
        'rewrite'       => array( 'slug' => 'media_category' )
        )
    );
    
    register_taxonomy('wpstream_movie_rating', array('wpstream_product','product'), array(
        'labels' => array(
            'name'              => esc_html__('Movie Rating','wpstream'),
            'add_new_item'      => esc_html__('Add New Rating','wpstream'),
            'new_item_name'     => esc_html__('New Rating','wpstream')
        ),
        'hierarchical'  => true,
        'query_var'     => true,
        'rewrite'       => array( 'slug' => 'rating' )
        )
    );


}



 
function wpstream_add_product_metaboxes() {	
    add_meta_box(  'wpstream_add_product_metaboxes-sectionid',
            __( 'Live Channel/Video Settings', 'wpstream' ),'wpstream_free_product','wpstream_product' ,'normal','default'
    );
}




function wpstream_free_product( $post ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'estate_agent_noncename' );
    global $post;
  
    $is_live               =    '';
    $is_video              =    '';
    $is_video_external     =    '';
    if( isset( $_GET['new_video_name']) && $_GET['new_video_name']!=''  ){
        $is_video = ' selected ';
        $wpstream_free_video=esc_html( $_GET['new_video_name']);
    }else{
        $wpstream_product_type =    esc_html(get_post_meta($post->ID, 'wpstream_product_type', true));
        $wpstream_free_video =    esc_html(get_post_meta($post->ID, 'wpstream_free_video', true));
        if($wpstream_product_type==1){
            $is_live = ' selected ';
        }
        if($wpstream_product_type==2){
            $is_video = ' selected ';
        }

        if($wpstream_product_type==3){
            $is_video_external = ' selected ';
        }
    }
     
    print'
    <p class="meta-options">
        <label for="wpstream_product_type">'.__('Media Type:','wpstream').' </label><br />
        <select id="wpstream_product_type" name="wpstream_product_type">
            <option value="1" '.$is_live.'>'.__('Free Live Channel - encrypted streaming & copy protection','wpstream').'</option>
            <option value="2" '.$is_video.'>'.__('Free Video - encrypted streaming & copy protection','wpstream').'</option>
            <option value="3" '.$is_video_external.'>'.__('Free Video - unprotected','wpstream').'</option>
        </select>
    </p>        
    ';           
    
    

    print '
    <p class="meta-options video_free">
        <label for="wpstream_free_video">'.__('Chose video:','wpstream').' </label><br />
        <select id="wpstream_free_video" name="wpstream_free_video">';
            $video_list = wpstream_get_videos();
          
            if(is_array($video_list)){
                foreach ($video_list as $key=>$value){
                    print '<option value="'.$key.'"'; 
                    if($wpstream_free_video === $key){
                       print ' selected ';
                    }
                    print '>'.$value.'</option>';
                }
            }
     print'
        </select>
    </p>        
    ';  
     
    $wpstream_free_video_external=    esc_html(get_post_meta($post->ID, 'wpstream_free_video_external', true));
    print '<p class="meta-options1 video_free_external">
            <label for="wpstream_free_video_external">'.__('Chose video:','wpstream').' </label><br />
        
            <input id="wpstream_free_video_external" type="text" size="36" name="wpstream_free_video_external" value="'.$wpstream_free_video_external.'" />
            <input id="wpstream_free_video_external_button" type="button"   size="40" class="upload_button button" value="'.esc_html__('Select Video','wpstream').'" />
       
            <p>'.esc_html__('You can chose a video from your computer, use the url from external source, use the url of a YouTube Video or use the url from a Vimeo video.','wpstream').'</p>

    </p> ';
     
     
}


//
//add_action('save_post', 'wpstream_free_product_update_post', 1, 2);
//function wpstream_free_product_update_post($post_id,$post){
//    
//    if(!is_object($post) || !isset($post->post_type)) {
//        return;
//    }
//    
//    if($post->post_type!='wpstream_product'){
//        return;    
//    }
//    
//     
//    $allowed_keys=array(
//        'wpstream_product_type',
//        'wpstream_free_video',
//        'wpstream_free_video_external'
//     );
//    
//    $allowed_html=array();
//    
//    foreach ($_POST as $key => $value) {
//        if( !is_array ($value) ){
//            if (in_array ($key, $allowed_keys)) {
//                $postmeta = wp_kses ( $value,$allowed_html ); 
//                update_post_meta($post_id, sanitize_key($key), $postmeta );
//            }
//        }       
//    }
//}
//




     

add_action( 'category_edit_form_fields',   'wpstream_category_callback_function', 10, 2);
add_action( 'category_add_form_fields',    'wpstream_category_callback_add_function', 10, 2 );  
add_action( 'created_category',            'wpstream_category_save_extra_fields_callback', 10, 2);
add_action( 'edited_category',             'wpstream_category_save_extra_fields_callback', 10, 2);

add_action( 'product_cat_edit_form_fields',   'wpstream_category_callback_function', 10, 2);
add_action( 'product_cat_add_form_fields',    'wpstream_category_callback_add_function', 10, 2 );  
add_action( 'created_product_cat',            'wpstream_category_save_extra_fields_callback', 10, 2);
add_action( 'edited_product_cat',             'wpstream_category_save_extra_fields_callback', 10, 2);
    

add_action( 'wpstream_category_edit_form_fields',   'wpstream_category_callback_function', 10, 2);
add_action( 'wpstream_category_add_form_fields',    'wpstream_category_callback_add_function', 10, 2 );  
add_action( 'created_wpstream_category',            'wpstream_category_save_extra_fields_callback', 10, 2);
add_action( 'edited_wpstream_category',             'wpstream_category_save_extra_fields_callback', 10, 2);


add_action( 'wpstream_actors_edit_form_fields',     'wpstream_category_callback_function', 10, 2);
add_action( 'wpstream_actors_add_form_fields',    'wpstream_category_callback_add_function', 10, 2 );  
add_action( 'created_wpstream_actors',            'wpstream_category_save_extra_fields_callback', 10, 2);
add_action( 'edited_wpstream_actors',             'wpstream_category_save_extra_fields_callback', 10, 2);

add_action( 'wpstream_movie_rating_edit_form_fields',     'wpstream_category_callback_function', 10, 2);
add_action( 'wpstream_movie_rating_add_form_fields',    'wpstream_category_callback_add_function', 10, 2 );  
add_action( 'created_wpstream_movie_rating',            'wpstream_category_save_extra_fields_callback', 10, 2);
add_action( 'edited_wpstream_movie_rating',             'wpstream_category_save_extra_fields_callback', 10, 2);






if( !function_exists('wpstream_category_callback_function') ):
    function wpstream_category_callback_function($tag){

        if(is_object ($tag)){
            $t_id                       =   $tag->term_id;
            $term_meta                  =   get_option( "taxonomy_$t_id");
            $pagetax                    =   $term_meta['pagetax'] ? $term_meta['pagetax'] : '';
            $category_featured_image    =   $term_meta['category_featured_image'] ? $term_meta['category_featured_image'] : '';
            $category_tagline           =   $term_meta['category_tagline'] ? $term_meta['category_tagline'] : '';
            $category_tagline           =   stripslashes($category_tagline);
            $category_attach_id         =   $term_meta['category_attach_id'] ? $term_meta['category_attach_id'] : '';
        }else{
            $pagetax                    =   '';
            $category_featured_image    =   '';
            $category_tagline           =   '';
            $category_attach_id         =   '';
        }

        print'
        <table class="form-table">
        <tbody>    
            <tr class="form-field">
                <th scope="row" valign="top"><label for="term_meta[pagetax]">'.esc_html__( 'Page id for this term','wpstream').'</label></th>
                <td> 
                    <input type="text" name="term_meta[pagetax]" class="postform" value="'.$pagetax.'">  
                    <p class="description">'.esc_html__( 'Page id for this term','wpstream').'</p>
                </td>

                <tr valign="top">
                    <th scope="row"><label for="category_featured_image">'.esc_html__( 'Featured Image','wpstream').'</label></th>
                    <td>
                        <input id="category_featured_image" type="text" class="postform" size="36" name="term_meta[category_featured_image]" value="'.$category_featured_image.'" />
                        <input id="category_featured_image_button" type="button"  class="upload_button button category_featured_image_button" value="'.esc_html__( 'Upload Image','wpstream').'" />
                        <input id="category_attach_id" type="hidden" size="36" name="term_meta[category_attach_id]" value="'.$category_attach_id.'" />
                    </td>
                </tr> 

                <tr valign="top">
                    <th scope="row"><label for="term_meta[category_tagline]">'. esc_html__( 'Category Tagline','wpstream').'</label></th>
                    <td>
                        <input id="category_tagline" type="text" size="36" name="term_meta[category_tagline]" value="'.$category_tagline.'" />
                    </td>
                </tr> 



                <input id="category_tax" type="hidden" size="36" name="term_meta[category_tax]" value="'.$tag->taxonomy.'" />


            </tr>
        </tbody>
        </table>';
    }
endif;








if( !function_exists('wpstream_category_callback_add_function') ):
    function wpstream_category_callback_add_function($tag){
        if(is_object ($tag)){
            $t_id                       =   $tag->term_id;
            $term_meta                  =   get_option( "taxonomy_$t_id");
            $pagetax                    =   $term_meta['pagetax'] ? $term_meta['pagetax'] : '';
            $category_featured_image    =   $term_meta['category_featured_image'] ? $term_meta['category_featured_image'] : '';
            $category_tagline           =   $term_meta['category_tagline'] ? $term_meta['category_tagline'] : '';
            $category_attach_id         =   $term_meta['category_attach_id'] ? $term_meta['category_attach_id'] : '';
        }else{
            $pagetax                    =   '';
            $category_featured_image    =   '';
            $category_tagline           =   '';
            $category_attach_id         =   '';

        }

        print'
        <div class="form-field">
        <label for="term_meta[pagetax]">'. esc_html__( 'Page id for this term','wpstream').'</label>
            <input type="text" name="term_meta[pagetax]" class="postform" value="'.$pagetax.'">  
        </div>

        <div class="form-field">
            <label for="term_meta[pagetax]">'. esc_html__( 'Featured Image','wpstream').'</label>
            <input id="category_featured_image" type="text" size="36" name="term_meta[category_featured_image]" value="'.$category_featured_image.'" />
            <input id="category_featured_image_button" type="button"  class="upload_button button category_featured_image_button" value="'.esc_html__( 'Upload Image','wpstream').'" />
           <input id="category_attach_id" type="hidden" size="36" name="term_meta[category_attach_id]" value="'.$category_attach_id.'" />

        </div>     

        <div class="form-field">
        <label for="term_meta[category_tagline]">'. esc_html__( 'Category Tagline','wpstream').'</label>
            <input id="category_tagline" type="text" size="36" name="term_meta[category_tagline]" value="'.$category_tagline.'" />
        </div> 
        <input id="category_tax" type="hidden" size="36" name="term_meta[category_tax]" value="'.$tag->taxonomy.'" />
        ';
    }
endif;




if( !function_exists('wpstream_category_save_extra_fields_callback') ):
    function wpstream_category_save_extra_fields_callback($term_id ){
        if ( isset( $_POST['term_meta'] ) ) {
            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id");
            $cat_keys = array_keys($_POST['term_meta']);
            $allowed_html   =   array();
                foreach ($cat_keys as $key){
                    $key=sanitize_key($key);
                    if (isset($_POST['term_meta'][$key])){
                        $term_meta[$key] =  wp_kses( $_POST['term_meta'][$key],$allowed_html);
                    }
                }
            //save the option array
             update_option( "taxonomy_$t_id", $term_meta );
        }
    }
endif;



function wpstream_filter_the_title( $content   ) {
    if( is_singular('wpstream_product')){
        global $post;
        $args=array('id'=>$post->ID);
        $custom_content = wpstream_insert_player_inpage($args);
        $content = '<div class="wpestream_inserted_player">'.$custom_content.'</div>'.$content;
        return $content;
    }else{
        return $content;
    }
}
add_filter( 'the_content', 'wpstream_filter_the_title' );






function wpstream_insert_player($content){
    global  $post;

    

    $live_event_stream_name =    esc_html(get_post_meta($post->ID, 'live_event_stream_name', true));

    if ( is_singular('wpstream_product') && in_the_loop() ) {
        $wpstream_product_type =    esc_html(get_post_meta($post->ID, 'wpstream_product_type', true));
        if($wpstream_product_type==1){
            ob_start();
                $player='';
                wpstream_live_event_player($post->ID);
                $player =ob_get_contents();
            ob_end_clean();
            $content = '<div class="free_wpstream_player wpstream_live_stream">'.$player.'</div>'.$content;
        }else if($wpstream_product_type==2){
            ob_start();
                $player='';
                $video_path =    esc_html(get_post_meta($post->ID, 'wpstream_free_video', true));
                wpstream_video_on_demand_player($post->ID);
                $player =ob_get_contents();
            ob_end_clean();
            $content = '<div class="free_wpstream_player wpstream_video_on_demand">'.$player.'</div>'.$content;
        }

    remove_filter( 'the_content', 'wpstream_insert_player');

    }

    return $content;
}


//add_filter( 'the_content', 'wpstream_insert_player' ); 
?>