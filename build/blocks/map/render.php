<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Only show on order confirmation page
if ( ! is_wc_endpoint_url( 'order-received' ) ) {
	return;
}

// Get order ID
$order_id = absint( get_query_var( 'order-received' ) );
if ( ! $order_id ) {
	return;
}

// Get order
$order = wc_get_order( $order_id );
if ( ! $order ) {
	return;
}

// Get shipping address
$address = array(
	$order->get_shipping_address_1(),
	$order->get_shipping_address_2(),
	$order->get_shipping_city(),
	$order->get_shipping_state(),
	$order->get_shipping_postcode(),
	$order->get_shipping_country(),
);

// Filter out empty values and join
$address = implode( ', ', array_filter( $address ) );
if ( empty( $address ) ) {
	return;
}

// Get API key
$api_key = get_option( 'wcmap-block-key', '' );
if ( empty( $api_key ) ) {
	return;
}

// Get block attributes
$wrapper_attributes = get_block_wrapper_attributes();
$height             = isset( $attributes['height'] ) ? absint( $attributes['height'] ) : 300;
$zoom               = isset( $attributes['zoom'] ) ? absint( $attributes['zoom'] ) : 10;

?>
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<iframe 
		title="<?php esc_attr_e( 'Shipping Address Map', 'map-block-order-confirmation' ); ?>"
		width="100%" 
		height="<?php echo esc_attr( $height ); ?>" 
		src="https://www.google.com/maps/embed/v1/place?key=<?php echo esc_attr( $api_key ); ?>&q=<?php echo esc_attr( urlencode( $address ) ); ?>&zoom=<?php echo esc_attr( $zoom ); ?>" 
		frameborder="0"
		style="border:0;"
		loading="lazy"
		referrerpolicy="no-referrer-when-downgrade"
	></iframe>
</div> 
