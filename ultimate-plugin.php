<?php
/*
Plugin Name: Ultimate Plugin
Description: The ultimate WordPress plugin boilerplate
Plugin URI: http://tormorten.no
Author: Tor Morten Jensen
Author URI: http://tormorten.no
Version: 1.0.0
License: GPL2
Text Domain: ultimate-staff
Domain Path: lang/
*/

/*

    Copyright (C) 2015  Tor Morten Jensen  tormorten@tormorten.no

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Lets define some stuff first.
 * This will be used later in the plugin. I promise!
 */
define( 'ULTIMATE_PLUGIN_NAME',     'Ultimate Plugin' );
define( 'ULTIMATE_PLUGIN_DIR',     trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'ULTIMATE_PLUGIN_URL',     trailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'ULTIMATE_PLUGIN_ASSETS',    trailingslashit( ULTIMATE_PLUGIN_DIR ) . 'assets/' );
define( 'ULTIMATE_PLUGIN_ASSETS_URL',   plugins_url( 'assets/', __FILE__ ) );
define( 'ULTIMATE_PLUGIN_CLASSES',    ULTIMATE_PLUGIN_DIR . 'controllers' );
define( 'ULTIMATE_PLUGIN_VIEWS',     ULTIMATE_PLUGIN_DIR . 'views' );
define( 'ULTIMATE_PLUGIN_REQUIRED_PHP_VERSION', '5.3' ); // we might be as crazy as to use closures, so lets make sure we at least have this
define( 'ULTIMATE_PLUGIN_REQUIRED_WP_VERSION', '4.0' ); // lets keep it fresh for now
define( 'ULTIMATE_PLUGIN_REQUIRED_PLUGINS',  serialize( 
	[
		'akismet/akismet.php',
		'foundation-columns/foundation-columns.php',
		'wp-microdata/wp-microdata.php'
	] 
) );

/**
 * Checks if the system requirements are met
 *
 * @return bool True if system requirements are met, false if no
 */
function ultimate_plugin_requirements_met() {

	global $wp_version;

	if ( version_compare( PHP_VERSION, ULTIMATE_PLUGIN_REQUIRED_PHP_VERSION, '<' ) ) {
		return false;
	}
	if ( version_compare( $wp_version, ULTIMATE_PLUGIN_REQUIRED_WP_VERSION, '<' ) ) {
		return false;
	}

	if ( !empty( unserialize( ULTIMATE_PLUGIN_REQUIRED_PLUGINS ) ) ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';

		foreach ( unserialize( ULTIMATE_PLUGIN_REQUIRED_PLUGINS ) as $plugin ) {
			if ( ! is_plugin_active( $plugin ) ) {
				return false;
			}
		}
	}

	return true;
}

add_action( 'plugins_loaded', function() {
	/*
	 * Check requirements and load main class
	 */
	if ( ultimate_plugin_requirements_met() ) {

		/**
		 * Include the composer autoloading class
		 */
		require_once ULTIMATE_PLUGIN_DIR . 'vendor/autoload.php';

		add_action( 'init', function() {
			/**
			 * Start up the post type machine
			 * 
			 * Will be availiable as a global object.
			 */
			global $ultimate_plugin;
			$ultimate_plugin = new Ultimate_Plugin();
			
		} );

	} else {
		add_action( 'admin_notices', function() {
			global $wp_version;
			require_once ULTIMATE_PLUGIN_VIEWS . '/requirements-error.php';
		} );
	}
} );
