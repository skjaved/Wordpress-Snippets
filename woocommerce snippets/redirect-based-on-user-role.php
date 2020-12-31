<?php
/**
 * Redirect users to custom URL based on their role after login and restore the cart
 *
 * @param string $redirect
 * @param object $user
 * @return string
 */
function wp_custom_user_redirect( $redirect, $user ) {

	// Get the first of all the roles assigned to the user
	$role = $user->roles[0];
    $dashboard = admin_url();
    
    global $woocommerce;
    
	$checkout_url = $woocommerce->cart->get_checkout_url();
  $homepage = home_url();
    
	// redirect users based on cart count
  $url = ( WC()->cart->get_cart_contents_count() !== 0 ) ? $checkout_url : $homepage;
    
	$user_id = $user->ID;
  $meta_key = 'cart-'.$user_id;
    
	//$cart_content=get_user_meta($user_id, $meta_key, true);
  $cart_content = get_option( $meta_key );
    
	// add cart contents
	foreach ( $cart_content as $cart_item_key => $values ) {

		$id =$values['product_id'];
		$quant=$values['quantity'];
		$woocommerce->cart->add_to_cart( $id, $quant);
	
	}
    
	if( $role == 'administrator' ||  $role == 'shop-manager' ||  $role == 'author' ||  $role == 'editor' ) {
		//Redirect administrator, shop-manager, author and editor to the "Dashboard" page
		$redirect = $url;
	} elseif ( $role == 'customer' || $role == 'subscriber' ) {
		//Redirect customers and subscribers to the "My Account" page
		$redirect = $url;
	} else {
		//Redirect any other role to the previous visited page or, if not available, to the home
		$redirect = wp_get_referer() ? wp_get_referer() : home_url();
	}
	return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'wp_custom_user_redirect', 10, 2 );

// Save the cart for the current user, empty cart and redirect user to home page
function logout_redirect() {
	if( function_exists('WC') ){

		global $woocommerce;
          
    // get user details
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$cart_contents = $woocommerce->cart->get_cart();
		$meta_key = 'cart-'.$user_id;
		$meta_value = $cart_contents;
		//update_user_meta( $user_id, $meta_key, $meta_value);
		update_option( $meta_key, $meta_value );
        WC()->cart->empty_cart();
    }
    wp_safe_redirect( home_url() );
    exit();
}
add_action('wp_logout','logout_redirect');