<?php
/**
 * WooCommerce status page extension
 *
 * @class    KCO_Status
 * @version  0.8.0
 * @package  KCO/Classes
 * @category Class
 * @author   Krokedil
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Class for WooCommerce status page.
 */
class KCO_Status {
	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'woocommerce_system_status_report', array( $this, 'add_status_page_box' ) );
	}

	/**
	 * Adds status page box for KCO.
	 *
	 * @return void
	 */
	public function add_status_page_box() {
	}
}
$wc_collector_checkout_status = new KCO_Status();
