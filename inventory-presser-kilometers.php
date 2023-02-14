<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: Inventory Presser - Kilometers Instead of Miles
 * Plugin URI: https://inventorypresser.com/downloads/kilometers-instead-of-miles/
 * Description: Add-on for Inventory Presser. Changes odometer units to kilometers.
 * Version: 1.2.0
 * Author: Corey Salzano
 * Author URI: https://github.com/fridaysystems/inventory-presser-kilometers
 * Text Domain: inventory-presser-kilometers
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Kilometers_Instead_of_Miles
 */
class Kilometers_Instead_of_Miles {

	/**
	 * hooks
	 *
	 * @return void
	 */
	public function add_hooks() {
		// Allow translations.
		add_action(
			'plugins_loaded',
			function() {
				load_plugin_textdomain( 'inventory-presser-kilometers', false, __DIR__ );
			}
		);

		// For units in the core plugin.
		add_filter( 'invp_odometer_word', array( $this, 'replace_miles_with_kilometers' ) );
		// For units in the _dealer theme.
		add_filter( '_dealer_odometer_word', array( $this, 'replace_miles_with_kilometers' ) );
	}

	function replace_miles_with_kilometers( $word ) {
		switch( $word ) {
			case 'Mileage':
				return __( 'Kilometrage', 'inventory-presser-kilometers' );
			case 'mileage':
				return __( 'kilometrage', 'inventory-presser-kilometers' );
			case 'Miles':
				return __( 'Kilometers', 'inventory-presser-kilometers' );
			case 'miles':
				return __( 'kilometers', 'inventory-presser-kilometers' );
		}
		return $word;
	}
}
$kilometers2384907234 = new Kilometers_Instead_of_Miles();
$kilometers2384907234->add_hooks();
