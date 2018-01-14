<?php
/**
 * Team Member Biographies Plugin
 *
 * @package     ChristophHerr\TeamMemberBiographies
 * @author      christophherr
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Team Member Biographies
 * Plugin URI:  https://github.com/christophherr/team-member-biographies
 * Description: Team Member Biographies custom post type, custom taxonomy and functionality
 * Version:     1.0.0
 * Author:      christophherr
 * Author URI:  https://www.christophherr.com
 * Text Domain: team-member-biographies
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace ChristophHerr\TeamMemberBiographies;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217; uh?' );
}

/**
 * Setup the plugin's constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}

	define( 'TEAM_MEMBER_BIOGRAPHIES_URL', $plugin_url );
	define( 'TEAM_MEMBER_BIOGRAPHIES_DIR', plugin_dir_path( __DIR__ ) );
}

/**
 * Initialize the plugin hooks
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_hooks() {
	register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_plugin' );
	register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_uninstall_plugin' );
	register_uninstall_hook( __FILE__, __NAMESPACE__ . '\deactivate_uninstall_plugin' );
}

/**
 * Plugin activation handler.
 *
 * @since 1.0.0
 *
 * @return void
 */
function activate_plugin() {
	init_autoloader();

	Custom\register_custom_post_type();
	Custom\register_custom_taxonomy();

	flush_rewrite_rules();
}

/**
 * When the plugin is deactivated or uninstalled, delete the rewrite rules option.
 *
 * @since 1.0.0
 *
 * @return void
 */
function deactivate_uninstall_plugin() {
	delete_option( 'rewrite_rules' );
}

/**
 * Load the plugin files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_autoloader() {
	require_once 'src/support/autoloader.php';

	Support\autoload_files( __DIR__ . '/src/' );
}

/**
 * Launch the plugin
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	init_autoloader();
}

init_constants();
init_hooks();
launch();
