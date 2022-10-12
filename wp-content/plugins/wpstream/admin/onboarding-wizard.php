<?php
/**
 * WpStream Onboarding Wizard
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 * Class WpStream_Dashboard_Widget
 
 */

class WpStream_Onboarding_Wizard {


	/**
     * 
	 * WpStream_Onboarding_Wizard constructor.
	 *
     */

     public function __construct() {

		add_action( 'admin_init', array( $this, 'wpstream_load_onboarding_wizard' ) );

		add_action( 'admin_menu', array( $this, 'add_dashboard_page' ) );
		add_action( 'network_admin_menu', array( $this, 'add_dashboard_page' ) );


		add_action( 'wp_ajax_WpStream_onboarding_get_errors', array(
			$this,
			'get_install_errors',
		) );

		// This will only be called in the Onboarding Wizard context because of previous checks.
		add_filter( 'WpStream_maybe_authenticate_siteurl', array( $this, 'change_return_url' ) );
		add_filter( 'WpStream_auth_success_redirect_url', array( $this, 'change_success_url' ) );
		add_filter( 'WpStream_reauth_success_redirect_url', array( $this, 'change_success_url' ) );

	}






    /**
     * 
	 * Checks if the Wizard should be loaded in current context.
     * 
	 */
	public function wpstream_load_onboarding_wizard() {

		// Check for wizard-specific parameter
		// Allow plugins to disable the onboarding wizard
		// Check if current user is allowed to save settings.
		
        if ( ! (    isset( $_GET['page'] ) 
                    || 'WpStream-onboarding' !== $_GET['page'] 
                   // || apply_filters( 'WpStream_enable_onboarding_wizard', true ) 
                    //|| ! current_user_can( 'WpStream_save_settings' ) 
                    ) ) { 
			return;
		}

		// Don't load the interface if doing an ajax call.
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		set_current_screen();

		// Remove an action in the Gutenberg plugin ( not core Gutenberg ) which throws an error.
		remove_action( 'admin_print_styles', 'gutenberg_block_editor_admin_print_styles' );

		$this->actual_load_onboarding_wizard();

	}




	/**
     * 
	 * Register page through WordPress's hooks.
     * 
	 */
	public function add_dashboard_page() {
		add_dashboard_page( 'Wpstream x', 'WpStream Menu x', 'administrator', 'wpstream-onboarding', '' );
    }
  



	/*
     * Load the Onboarding Wizard file
     * 
	 */
	
    private function actual_load_onboarding_wizard() {

        $this->wpstream_load_css_js();
		$this->onboarding_wizard_header();
		$this->onboarding_wizard_content();
		$this->onboarding_wizard_footer();

		exit;

	}


    private function wpstream_load_css_js(){
        wp_enqueue_style( 'wptream-on-boarding-css', plugin_dir_url( __FILE__ ) . 'css/wpstream-admin-onboarding.css', array(), WPSTREAM_PLUGIN_VERSION, 'all' );
    
        wp_enqueue_script('wpstream-on-boarding-js',   plugin_dir_url( __DIR__  ) .'/admin/js/wpstream-onboarding.js?v='.time(),array(),  WPSTREAM_PLUGIN_VERSION, true); 
              
    }





	/*
    *
    * Outputs the simplified header used for the Onboarding Wizard.
    *
    */
	public function onboarding_wizard_header() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width"/>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title><?php esc_html_e( 'WpStream &rsaquo; Onboarding Wizard', 'wpstream' ); ?></title>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_print_scripts' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="WpStream-onboarding">
		<?php
	}



    

	/*
    *
    * Outputs the content of the current step.
    *
    */
	public function onboarding_wizard_content() {
		$admin_url = is_network_admin() ? network_admin_url() : admin_url();

		WpStream_settings_error_page( 'WpStream-onboarding-wizard', '<a href="' . $admin_url . '">' . esc_html__( 'Return to Dashboard', 'wpstream') . '</a>' );
	}

	/*
    *
	* Wizzard Footer
    *
	*/
	public function onboarding_wizard_footer() {
		?>

		</body>
		</html>
		<?php
	}



	/**
	 * Update the redirect url so the user returns to the Onboarding Wizard after auth.
	 *
	 * @param string $siteurl The url to which the user is redirected for auth.
	 *
	 * 
	 */

    public function change_return_url( $siteurl ) {

		$url       = wp_parse_url( $siteurl );
		$admin_url = is_network_admin() ? network_admin_url() : admin_url();

		if ( isset( $url['query'] ) ) {

			parse_str( $url['query'], $parameters );

			$parameters['return'] = rawurlencode( add_query_arg( array(
				'page' => 'WpStream-onboarding',
			), $admin_url ) );

			$siteurl = str_replace( $url['query'], '', $siteurl );

			$siteurl = add_query_arg( $parameters, $siteurl );

			$siteurl .= '#/authenticate';

		}

		return $siteurl;

	}

	/**
	 * Update the success redirect URL so if all is well we get to the next step.
	 *
	 * @param string $siteurl The url to which the user is redirected after a successful auth.
	 *
	 * @return mixed
	 */
	public function change_success_url( $siteurl ) {

		$admin_url   = is_network_admin() ? network_admin_url() : admin_url();
		$return_step = is_network_admin() ? 'recommended_addons' : 'recommended_settings';

		$siteurl = add_query_arg( array(
			'page' => 'WpStream-onboarding',
		), $admin_url );

		$siteurl .= '#/' . $return_step;

		return $siteurl;

	}


	/**
	 * Ajax handler for grabbing the installed code status.
	 */
	public function get_install_errors() {

		wp_send_json( WpStream_is_code_installed_frontend() );

	}

	


}

//new WpStream_Onboarding_Wizard();
