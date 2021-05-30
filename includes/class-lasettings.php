<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    LASettings
 * @subpackage LASettings/includes
 */

class LASettings {
	protected $loader;
	protected $plugin_name;
	protected $version;
	public function __construct() {
		if ( defined( 'LASETTINGS_VERSION' ) ) {
			$this->version = LASETTINGS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'lasettings';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lasettings-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-lasettings-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-lasettings-admin.php';
		$this->loader = new LASettings_Loader();
	}

	
	private function set_locale() {

		$plugin_i18n = new LASettings_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	
	private function define_admin_hooks() {

		$plugin_admin = new LASettings_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'junu_lasettings_add_menupgae' );

		// Only for the plugin menu page
		if(isset($_GET['page']) && $_GET['page'] === 'lasettings-settings'){
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		}
		// Only for the login page when module is enabled
		if(isset($_COOKIE['junu_twofactor']) && $_COOKIE['junu_twofactor'] === 'yes'){
			$this->loader->add_action( 'login_form', $plugin_admin, 'junu_lasettings_login' );
			$this->loader->add_action( 'login_enqueue_scripts', $plugin_admin, 'junu_lasettings_login_form_scripts' );
		}
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
