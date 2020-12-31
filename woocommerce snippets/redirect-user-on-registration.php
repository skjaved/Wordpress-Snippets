<?php
/**
 * This snippet will redirect user on homepage if cart is empty otherwise on checkout page after registration at the time of chechout
 */
function custom_redirection_after_registration(){
    if ( WC()->cart->is_empty() ) {
        wp_redirect( get_home_url() );
    } else {
        wp_redirect( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) );
    }
};
add_filter('woocommerce_registration_redirect', 'custom_redirection_after_registration', 10, 1);