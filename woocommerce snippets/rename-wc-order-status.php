<?php
/**
 * This snippet will rename the woocommerce default Procssing order status to Order Confirmed
 */
// Remaning order status 'Processing' to 'Order Confirmed'
function wc_renaming_order_status( $order_statuses ) {
    foreach ( $order_statuses as $key => $status ) {
        if ( 'wc-processing' === $key ) 
            $order_statuses['wc-processing'] = _x( 'Confirmed', 'Order status', 'woocommerce' );
    }
    return $order_statuses;
}
add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );