<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://timvaniersel.com/en/
 * @since             1.0.0
 * @package           Websitescanner_Custom_Schema
 *
 * @wordpress-plugin
 * Plugin Name:       Websitescanner Custom Schema
 * Plugin URI:        https://timvaniersel.com/en/plugins/websitescanner-custom-schema/
 * Description:       Adds a field to the editor for custom JSON-ld schema markup.
 * Version:           1.0.0
 * Author:            Tim van Iersel
 * Author URI:        https://timvaniersel.com/en/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       websitescanner-custom-schema
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WEBSITESCANNER_CUSTOM_SCHEMA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-websitescanner-custom-schema-activator.php
 */
function activate_websitescanner_custom_schema() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-websitescanner-custom-schema-activator.php';
	Websitescanner_Custom_Schema_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-websitescanner-custom-schema-deactivator.php
 */
function deactivate_websitescanner_custom_schema() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-websitescanner-custom-schema-deactivator.php';
	Websitescanner_Custom_Schema_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_websitescanner_custom_schema' );
register_deactivation_hook( __FILE__, 'deactivate_websitescanner_custom_schema' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-websitescanner-custom-schema.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_websitescanner_custom_schema() {

	$plugin = new Websitescanner_Custom_Schema();
	$plugin->run();

}
run_websitescanner_custom_schema();
