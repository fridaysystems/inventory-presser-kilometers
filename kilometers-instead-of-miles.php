<?php
/**
 * Plugin Name: Kilometers Instead of Miles
 * Plugin URI: https://inventorypresser.com/
 * Description: Uses kilometers as the units for vehicle odometer values in themes designed for Inventory Presser
 * Version: 1.1.0
 * Author: Corey Salzano
 * Author URI: https://profiles.wordpress.org/salzano
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

class Kilometers_Instead_of_Miles {

	function hooks() {
		add_filter( 'invp_odometer_word', array( &$this, 'replace_miles_with_kilometers' ) );
		add_filter( '_dealer_odometer_word', array( &$this, 'replace_miles_with_kilometers' ) );
	}

	function replace_miles_with_kilometers( $word ) {
		switch( $word ) {
			case 'Mileage':
				return 'Kilometrage';
			case 'mileage':
				return 'kilometrage';
			case 'Miles':
				return 'Kilometers';
			case 'miles':
				return 'kilometers';
		}
		return $word;
	}
}
$kilometers2384907234 = new Kilometers_Instead_of_Miles();
$kilometers2384907234->hooks();
