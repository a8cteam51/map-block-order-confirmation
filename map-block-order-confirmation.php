<?php
/**
 * Plugin Name: Map Block for Order Confirmation
 * Description: Displays a map showing the shipping address on WooCommerce order confirmation pages.
 * Requires at least: 6.0
 * Requires PHP: 7.0
 * Version: 0.1.0
 * Author: Your Name
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: map-block-order-confirmation
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 */
function create_block_map_block_init() {
	if ( class_exists( 'WooCommerce' ) ) {
		register_block_type( __DIR__ . '/build/blocks/map' );

		// Add script data
		wp_localize_script(
			'wc-order-map-map-editor-script', // This should match the handle in block.json
			'wf_map_block',
			array(
				'api_key'            => get_option( 'wcmap-block-key', '' ),
				'nonce_save_api_key' => wp_create_nonce( 'map-block-order-confirmation_save_api_key' ),
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}
add_action( 'init', 'create_block_map_block_init' );

/**
 * Save Google Maps API key
 */
function save_maps_api_key() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_send_json_error( 'Permission denied' );
		die();
	}

	if ( ! check_ajax_referer( 'map-block-order-confirmation_save_api_key', false, false ) ) {
		wp_send_json_error( 'Invalid nonce' );
		die();
	}

	$key   = isset( $_POST['api_key'] ) ? sanitize_text_field( $_POST['api_key'] ) : '';
	$saved = update_option( 'wcmap-block-key', $key );

	wp_send_json_success(
		array(
			'key'   => $key,
			'saved' => $saved,
		)
	);
	die();
}
add_action( 'wp_ajax_wcmap_block_save_key', 'save_maps_api_key' );
