<?php

/*
 * Register the custom product type after init
 */
function register_live_stream_product_type() {
    class WC_Product_Live_Stream extends WC_Product_Simple {
        public function __construct( $product ) {
            parent::__construct( $product );
            $this->product_type = 'live_stream';
 
        }
        
        public function get_type() {
            return 'live_stream';
        }
    }

}
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action( 'init', 'register_live_stream_product_type' );
}

function register_video_on_demand_product_type() {
    class WC_Product_Video_On_Demand extends WC_Product_Simple {
        public function __construct( $product ) {
            parent::__construct( $product );
            $this->product_type = 'video_on_demand';
 
        }
        public function get_type() {
            return 'video_on_demand';
        }
    }

}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action( 'init', 'register_video_on_demand_product_type' );
}


function add_wpstream_products( $types ){
    $types[ 'live_stream' ]             = __( 'Live Channel','wpestream' );
    $types[ 'video_on_demand' ]         = __( 'Video On Demand','wpestream' );
    return $types;
}
add_filter( 'product_type_selector', 'add_wpstream_products' );


/**
 * Show pricing fields for simple_rental product.
 */
function wpstream_products_custom_js() {
	if ( 'product' != get_post_type() ) :
            return;
	endif;

	?>
        <script type='text/javascript'>
            jQuery( document ).ready( function() {
                jQuery( '.options_group.pricing' ).addClass ( 'show_if_live_stream show_if_live_stream_recorded show_if_video_on_demand' ).show();
            });

	</script>
        <?php

}
add_action( 'admin_footer', 'wpstream_products_custom_js' );







/*
 *  Hide shiping tab for wpstream products 
 *  
 */
function wpstream_hide_attributes_data_panel( $tabs) {
    $tabs['shipping']['class'][] = 'hide_if_live_stream hide_if_live_stream_recorded hide_if_video_on_demand';
    return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'wpstream_hide_attributes_data_panel' );











/*
 * Add custom fields for wpstream products
 *  
 */
function wpstream_add_custom_general_fields() {

    global $woocommerce, $post;
    echo '<div class="options_group  show_if_subscription">';  
        woocommerce_wp_select( 
            array( 
                    'id'      =>    '_subscript_live_event', 
                    'label'   =>    __( 'Is a subscription based live channel ?', 'woocommerce' ), 
                    'options' =>    array("yes"=>"yes","no"=>"no")
                    )
            );
    echo '</div>';
    
    
    echo '<div class="options_group show_if_video_on_demand show_if_subscription hide_movieon">';  
        woocommerce_wp_select( 
            array( 
                    'id'      =>    '_movie_url', 
                    'label'   =>    __( 'Select the video file. The files are managed in your wpstream.net account ', 'woocommerce' ), 
                    'options' =>    wpstream_get_videos()
                    )
        );
 
    echo '</div>';
	
}
add_filter( 'woocommerce_product_options_general_product_data', 'wpstream_add_custom_general_fields' );


/*
 * Save custom fields for wpstream products
 *  
 */

function wpstream_add_custom_general_fields_save( $post_id ){

    $permited_values = array(
        '_movie_url',
        '_subscript_live_event'
    );

    

    foreach($_POST as $key=>$value){
        update_post_meta( $post_id, 'event_passed', 0 );
        if( in_array($key, $permited_values) ){
            if( !empty( $_POST[$key] ) ){
                update_post_meta( $post_id, $key, esc_html($_POST[$key]) );
            }
        }
    }
	
}
add_filter( 'woocommerce_process_product_meta', 'wpstream_add_custom_general_fields_save' );