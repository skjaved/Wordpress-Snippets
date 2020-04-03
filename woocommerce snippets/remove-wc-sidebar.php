<?php
/**
 * 
 * This snippet will remove sidebar from all woocommerce pages
 */
function remove_sidebar($false) {
	if( ! is_shop() ) {
		$false = false;
	}
	return $false;
}
add_filter( 'is_active_sidebar', 'remove_sidebar', 10, 2 );


/**
 * Below snippet will remove sidebar from cart, checkout and product page only
 */
if ( ! function_exists( 'remove_woocommerce_sidebar' ) ) {
	/**
	 * Remove Sidebar from Cart, Checkout and Product page
	 *
	 * @param  $is_active_sidebar, $index
	 */
	function remove_woocommerce_sidebar( $is_active_sidebar, $index ) {
		if( $index !== "sidebar-1" ) {
			return $is_active_sidebar;
		}

		if( ! is_cart() ) {
			return $is_active_sidebar;
		}

		return false;
	}
}
add_filter( 'is_active_sidebar', 'remove_woocommerce_sidebar', 10, 2 );

/**
 * Below snippet will remove sidebar from single page only
 */
if ( ! function_exists( 'remove_sidebar_product_pages' ) ) {
	/**
	 * Remove sidebar form single product page
	 *
	 * @return void
	 */
	function remove_sidebar_product_pages() {
		if( is_product() ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

		if( is_single() ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}
	}
}
add_action( 'wp_head', 'remove_sidebar_product_pages' );