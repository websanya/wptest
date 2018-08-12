<?php
/**
 * Plugin Name: test-plugin
 * Plugin URI: https://github.com/websanya/wptest/
 * Author: Alexander Goncharov
 * Author URI: https://websanya.ru/
 * Description: Plugin which shows Hello world!
 * Version: 1.0.0
 */

//* If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define
 * admin-specific hooks, and public-facing site hooks.
 *
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-test_plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_test_plugin() {

	$plugin = new test_plugin();
	$plugin->run();

}
run_test_plugin();
