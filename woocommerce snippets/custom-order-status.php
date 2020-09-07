<?php
/**
 * The function will add the custom order status in woocommerce orders
 * e.g. Add 'dispatch' order status in product order status option
 */
// Add/Register custom order status in woocommerce
function custom_wc_register_dispatch_status() {

	register_post_status( 'wc-dispatch', array(
		'label' 					=> _x( 'Dispatch', 'WooCommerce Order status', 'text-domain' ),
		'public' 					=> true,
		'exclude_from_search' 		=> false,
		'show_in_admin_all_list' 	=> true,
		'show_in_admin_status_list' => true,
		'label_count' 				=> _n_noop( 'Dispatch (%s)', 'Dispatch (%s)', 'text-domain' )
	) );

}
add_action( 'init', 'custom_wc_register_dispatch_status' );

// Display in admin dashboard
function custom_wc_add_order_statuses( $order_statuses ) {

	$order_statuses['wc-dispatch'] = _x( 'Dispatched', 'WooCommerce Order status', 'text_domain' );
	return $order_statuses;

}
add_filter( 'wc_order_statuses', 'custom_wc_add_order_statuses' );