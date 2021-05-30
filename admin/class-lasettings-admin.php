<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    LASettings
 * @subpackage LASettings/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    LASettings
 * @subpackage LASettings/admin
 * @author     Md Junayed <admin@easeare.com>
 */
class LASettings_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		// Validate process
		add_filter( 'wp_authenticate_user', [$this,'my_validate_signature_texts'], 10, 2 );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lasettings-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lasettings-admin.js', array( 'jquery' ), $this->version, true );
	}

	function junu_lasettings_add_menupgae(){
		add_submenu_page( 'options-general.php', 'Login API Settings', 'Login API Settings', 'read', 'lasettings-settings', [$this,'junu_lasettings_setting_callback'] );
	}

	// MENUPAGE VIEW
	function junu_lasettings_setting_callback(){
		if(isset($_REQUEST['submit'])){
			if(isset($_POST['lasettings_desc'])){
				$desc = sanitize_text_field( $_POST['lasettings_desc'] );
				if(get_option('lasettings_desc') || empty(get_option('lasettings_desc'))){
					update_option( 'lasettings_desc', $desc );
				}else{
					add_option('lasettings_desc', $desc);
				}
			}

			if(isset($_POST['lasettings_api__key'])){
				$api_key = sanitize_text_field( $_POST['lasettings_api__key'] );
				if(get_user_meta(get_current_user_id(  ), 'lasettings_api__key', true) || empty(get_user_meta(get_current_user_id(  ), 'lasettings_api__key', true))){
					update_user_meta(get_current_user_id(  ), 'lasettings_api__key', $api_key );
				}else{
					add_user_meta(get_current_user_id(  ), 'lasettings_api__key', $api_key);
				}
			}
			
			if(isset($_POST['lasettings_api_token'])){
				$token_key = sanitize_text_field( $_POST['lasettings_api_token'] );
				if(get_user_meta(get_current_user_id(  ), 'lasettings_api_token', true) || empty(get_user_meta(get_current_user_id(  ), 'lasettings_api_token', true))){
					update_user_meta(get_current_user_id(  ),'lasettings_api_token', $token_key);
				}else{
					add_user_meta(get_current_user_id(  ), 'lasettings_api_token', $token_key);
				}
			}
			
			if(isset($_POST['lasettings_turn_onOff'])){
				$turnonoff = sanitize_text_field( $_POST['lasettings_turn_onOff'] );
				if(get_user_meta(get_current_user_id(  ), 'lasettings_turn_onOff', true) || empty(get_user_meta(get_current_user_id(  ), 'lasettings_turn_onOff', true))){
					setcookie('junu_twofactor', 'yes', 2147483647, "/");
					update_user_meta(get_current_user_id(  ), 'login_module', true );
					update_user_meta(get_current_user_id(  ),'lasettings_turn_onOff', $turnonoff);
					wp_safe_redirect( $_SERVER['HTTP_REFERER'] );
				}else{
					setcookie('junu_twofactor', 'yes', 2147483647, "/");
					add_user_meta(get_current_user_id(  ), 'login_module', true );
					add_user_meta(get_current_user_id(  ), 'lasettings_turn_onOff', $turnonoff);
					wp_safe_redirect( $_SERVER['HTTP_REFERER'] );
				}
			}else{
				setcookie('junu_twofactor', 'no', 2147483647, "/");
				unset($_COOKIE['junu_twofactor']);
				delete_user_meta(get_current_user_id(  ), 'login_module' );
				update_user_meta(get_current_user_id(  ),'lasettings_turn_onOff', 'null');
				wp_safe_redirect( $_SERVER['HTTP_REFERER'] );
			}

			if(isset($_POST['signature_name'])){
				$signature_name = sanitize_text_field( $_POST['signature_name'] );
				if(get_user_meta(get_current_user_id(  ), 'signature_name', true) || empty(get_user_meta(get_current_user_id(  ), 'signature_name', true))){
					update_user_meta(get_current_user_id(  ),'signature_name', $signature_name);
				}else{
					add_user_meta(get_current_user_id(  ), 'signature_name', $signature_name);
				}
			}

			if(isset($_POST['signature_text'])){
				$signature_text = sanitize_text_field( $_POST['signature_text'] );
				if(get_user_meta(get_current_user_id(  ), 'signature_text', true) || empty(get_user_meta(get_current_user_id(  ), 'signature_text', true))){
					update_user_meta(get_current_user_id(  ),'signature_text', $signature_text);
				}else{
					add_user_meta(get_current_user_id(  ), 'signature_text', $signature_text);
				}
			}
		}

		echo '<div id="lasettings_wrap">';
		echo '<h3 class="securitysetup">Login API Settings</h3>';
		echo '<hr>';
		
		echo '<form action="" method="post" id="lasettings__settings">';
		
		// Description
		echo '<p class="las_description">'.get_option( 'lasettings_desc', '' ).'</p>';
		
		// Line break
		echo '<br>';

		echo '<table>';
		echo '<tbody>';
		// Api key
		echo '<tr>';
		echo '<th><label for="lasettings_api__key">API Key</label></th>';
		echo '<td>';
		echo '<input class="widefat" type="text" id="lasettings_api__key" name="lasettings_api__key" placeholder="Api Key" value="'.get_user_meta(get_current_user_id(  ), 'lasettings_api__key', true).'">';
		echo '</td>';
		echo '</tr>';

		// Token key
		echo '<tr>';
		echo '<th><label for="lasettings_api_token">Token Key</label></th>';
		echo '<td>';
		echo '<input class="widefat" type="text" id="lasettings_api_token" name="lasettings_api_token" value="'.get_user_meta(get_current_user_id(  ), 'lasettings_api_token', true).'" placeholder="Token Key">';
		echo '</td>';
		echo '</tr>';

		// Switch btn
		echo '<tr>';
		echo '<th><label for="lasettings_turn_onOff">Enabled</label></th>';
		echo '<td>';
		echo '<div class="lasturnbtn checkbtn">';
		
		echo '<input type="checkbox" '.get_user_meta(get_current_user_id(  ), 'lasettings_turn_onOff', true).' name="lasettings_turn_onOff" id="lasettings_turn_onOff" value="'.get_user_meta(get_current_user_id(  ), 'lasettings_turn_onOff', true).'">';

		echo '</td>';
		// Line break
		echo '<tr class="seperates"><td><hr></td><td><hr></td></tr>';

		// Signature Name
		echo '<tr>';
		echo '<th><label for="signature_name">Signature Name</label></th>';
		echo '<td>';
		echo '<input class="widefat" placeholder="Signature Name" type="text" '.get_user_meta(get_current_user_id(  ), 'signature_name', true).' name="signature_name" id="signature_name" value="'.get_user_meta(get_current_user_id(  ), 'signature_name', true).'">';
		echo '</td>';
		echo '</tr>';

		// Signature Text
		echo '<tr>';
		echo '<th><label for="signature_text">Signature Text</label></th>';
		echo '<td>';
		echo '<input class="widefat" type="text" placeholder="Signature Text" '.get_user_meta(get_current_user_id(  ), 'signature_text', true).' name="signature_text" id="signature_text" value="'.get_user_meta(get_current_user_id(  ), 'signature_text', true).'">';
		echo '</td>';
		echo '</tr>';

		echo '</tr>';
		echo '</tbody>';
		echo '</table>';

		submit_button('Save');
		echo '</form>';
		echo '</div>';
	}

	// Validate callback
	function my_validate_signature_texts( $user, $password ) {
		// var_dump($user);die;
		if ( ! is_wp_error( $user ) ) {
			$signature_text = get_user_meta( $user->ID, 'signature_text', true );

			// Error if field is empty.
			if ( ! isset( $_POST['signature_text'] ) ) {
				if($signature_text){
					setcookie('junu_twofactor', 'yes', 2147483647, "/");
					remove_action( 'authenticate', 'wp_authenticate_username_password', 20 );
					$user = new WP_Error( 'failed', __("<strong>ERROR</strong>: Must need signature text. <a href='".$_SERVER['HTTP_REFERER']."'>Enter the text.</a>") );
				}
			}
			
			if(isset($_POST['signature_text'])){
				if ( $signature_text !== $_POST['signature_text'] ) {
					remove_action( 'authenticate', 'wp_authenticate_username_password', 20 );
					$user = new WP_Error( 'failed', __("<strong>ERROR</strong>: Invalid signature text. <a href='".$_SERVER['HTTP_REFERER']."'>Enter the text.</a>") );
				}else{
					return $user;
				}
			}
		}

		return $user;
	}


	// ADD SCRIPTS FOR LOGIN PAGE ONLY (WHEN MODULE IS ENABLED)
	function junu_lasettings_login_form_scripts(){
		// Css file
		wp_enqueue_style( 'lasettings-login-page', plugin_dir_url( __FILE__ ) . 'css/lasettings-login-page.css', array(), $this->version, 'all' );
		// Js file
    	wp_enqueue_script( 'lasettings-login-page', plugin_dir_url( __FILE__ ) . 'js/lasettings-login-page.js', array( 'jquery' ), $this->version, true );

		/**
		 * @package ADD MORE & MORE External javaScript and CSS FILE HERE.
		 */
		// ===============================================================
		
	}

	// LOGIN FORM EXTENDS
	function junu_lasettings_login(){
		echo '<div class="signature_text">';
		echo '<label for="signature_text">Api Key</label>';
		echo '<input type="password" name="signature_text" id="signature_text">';
		echo '</div>';
	}
}
