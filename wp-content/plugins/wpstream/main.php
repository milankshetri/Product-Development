<?php

function wpstream_main_start(){
    
    add_action( 'wp_enqueue_scripts', 'wpstream_enqueue_styles' );
    add_action( 'admin_enqueue_scripts', 'wpstream_enqueue_styles_admin'); 
    add_action( 'init', 'wpstream_my_custom_endpoints' );
    add_filter( 'query_vars', 'wpstream_my_custom_query_vars', 0 );
    add_filter( 'woocommerce_account_menu_items', 'wpstream_custom_my_account_menu_items' );
    add_action( 'woocommerce_account_event-list_endpoint', 'wpstream_custom_endpoint_content_event_list' );
    add_action( 'woocommerce_account_video-list_endpoint', 'wpstream_custom_endpoint_video_list' );
    add_action( 'woocommerce_before_single_product', 'user_logged_in_product_already_bought', 10 );
    add_action( 'after_switch_theme', 'wpstream_custom_flush_rewrite_rules' );
    
    //add_action('widgets_init', 'register_wpstream_widgets');
    add_action('init', 'wpstream_shortcodes');
    
    if (is_admin()) {
        add_action('admin_menu', 'wpstream_manage_admin_menu',999);
        
    }
    
    $page_check = get_page_by_title('wpstream');
    if (!isset($page_check->ID)) {
        $my_post = array(
            'post_title'    => 'wpstream',
            'post_type'     => 'page',
            'post_status'   => 'publish',
        );
        $new_id = wp_insert_post($my_post);

    }
    
    $page_check = get_page_by_title('vodkey');
    if (!isset($page_check->ID)) {
        $my_post = array(
            'post_title'    => 'vodkey',
            'post_type'     => 'page',
            'post_status'   => 'publish',
        );
        $new_id = wp_insert_post($my_post);

    }
    
    $page_check = get_page_by_title('Userkey');
    if (!isset($page_check->ID)) {
        $my_post = array(
            'post_title'    => 'Userkey',
            'post_type'     => 'page',
            'post_status'   => 'publish',
        );
        $new_id = wp_insert_post($my_post);

    }
        
        
}



if (!function_exists('wpstream_manage_admin_menu')):
    function wpstream_manage_admin_menu() {
        add_menu_page( __('WpStream Options','wpestream'), __('WpStream','wpstream'), 'administrator', 'wpstream options', 'wpstream_new_general_set');
    }
endif; // end   wpstream_manage_admin_menu 



// attach my open 'section' function to the before product summary action
add_action( 'woocommerce_before_single_product', 'my_non_image_content_wrapper_start', 20 );
// attach my close 'section' function to the after product summary action
add_action( 'woocommerce_after_single_product', 'my_non_image_content_wrapper_end', 20 );
 
//This function opens a new css section tag called "no-image-wrap" to the page HTML before all of the woocommerce "stuff" except images
function my_non_image_content_wrapper_start() {
    if ( is_user_logged_in() ) {
        global $product;
        $current_user   =   wp_get_current_user();
        $product_id     =   get_the_ID();



        if ( wc_customer_bought_product( $current_user->user_email, $current_user->ID, $product->id ) ){
            echo '<div id="wpstream_product_wrap">';
        }else{
            echo '<div id="wpstream_product_wrap_no_buy">';
        }
    }

}
//This line adds the HTML to the page to end the new "no-image-wrap" section
function my_non_image_content_wrapper_end() { echo '</div>'; }