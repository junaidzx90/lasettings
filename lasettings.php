<?php
ob_start();
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           LASettings
 *
 * @wordpress-plugin
 * Plugin Name:       Login API Settings
 * Plugin URI:        https://github.com/junaidzx90/lasettings
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Md Junayed
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       LASettings
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// LASettings
// lasettings
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LASETTINGS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lasettings-activator.php
 */
function activate_lasettings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lasettings-activator.php';
	LASettings_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lasettings-deactivator.php
 */
function deactivate_lasettings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lasettings-deactivator.php';
	LASettings_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lasettings' );
register_deactivation_hook( __FILE__, 'deactivate_lasettings' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lasettings.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lasettings() {

	$plugin = new LASettings();
	$plugin->run();

}
run_lasettings();
