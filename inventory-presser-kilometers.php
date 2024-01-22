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

	/**
	 * Loads translated strings.
	 *
	 * @return void
	 */
	public function replace_miles_with_kilometers( $word ) {
		$middle_pieces = array(
			'ileage' => 'ilometrage',
			'ILEAGE' => 'ILOMETRAGE',
			'iles'   => 'ilometers',
			'ILES'   => 'ILOMETERS',
			'i'      => 'm',
			'I'      => 'M',
		);
		foreach ( array_keys( $middle_pieces ) as $middle_piece ) {
			// If the last character is maybe ,:.
			$pattern = "/([Mm])($middle_piece)([\.,:])?/";
			if ( preg_match( $pattern, $word, $matches ) ) {
				$k = 'M' === $matches[1] ? 'K' : 'k';
				return $k . $middle_pieces[ $middle_piece ] . ( isset( $matches[3] ) ? $matches[3] : '' );
			}
		}
		return $word;
	}
}
$invp_kilometers_9000 = new Kilometers_Instead_Of_Miles();
$invp_kilometers_9000->add_hooks();
