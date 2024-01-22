<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: Inventory Presser - Kilometers Instead of Miles
 * Plugin URI: https://inventorypresser.com/downloads/kilometers-instead-of-miles/
 * Description: Add-on for Inventory Presser. Changes odometer units to kilometers.
 * Version: 1.3.0
 * Author: Corey Salzano
 * Author URI: https://github.com/fridaysystems/inventory-presser-kilometers
 * Text Domain: inventory-presser-kilometers
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Kilometers_Instead_Of_Miles
 */
class Kilometers_Instead_Of_Miles {

	/**
	 * Adds hooks that power the plugin features.
	 *
	 * @return void
	 */
	public function add_hooks() {
		// Allow translations.
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// For units in the core plugin.
		add_filter( 'invp_odometer_word', array( $this, 'replace_miles_with_kilometers' ) );
		// For units in the _dealer theme.
		add_filter( '_dealer_odometer_word', array( $this, 'replace_miles_with_kilometers' ) );
	}

	/**
	 * Loads translated strings.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'inventory-presser-kilometers', false, __DIR__ . '/languages' );
	}

	/**
	 * Replaces strings like mileage and miles to odometer and kilometers.
	 *
	 * @param  string $word The odometer word to be converted.
	 * @return string
	 */
	public function replace_miles_with_kilometers( $word ) {
		$replacements = array(
			'Mileage' => __( 'Odometer', 'inventory-presser-kilometers' ),
			'Miles'   => __( 'Kilometers', 'inventory-presser-kilometers' ),
			'Mi'      => __( 'Km', 'inventory-presser-kilometers' ),
		);
		foreach ( array_keys( $replacements ) as $match ) {
			if ( $word === $match ) {
				return $replacements[ $match ];
			}
			if ( strtolower( $word ) === strtolower( $match ) ) {
				return strtolower( $replacements[ $match ] );
			}
			if ( strtoupper( $word ) === strtoupper( $match ) ) {
				return strtoupper( $replacements[ $match ] );
			}
		}
		return $word;
	}
}
$invp_kilometers_9000 = new Kilometers_Instead_Of_Miles();
$invp_kilometers_9000->add_hooks();
