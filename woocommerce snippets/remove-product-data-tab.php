<?php
// Remove the default product description tab
if ( ! function_exists( 'remove_product_description_tab' ) ) {
	/**
	 * This function removes the default product description tab from single
	 * product page
	 * 
	 */
	function remove_product_description_tab($tabs) {
		unset( $tabs['description'] );
		return $tabs;
	}
}
add_filter('woocommerce_product_tabs', 'remove_product_description_tab', 10);

// Use below functionto remove multiple default data tabs
// for e.g. to remove Additional Information and Reviews tab
if( !function_exists( 'themename_remove_products_tabs' ) ) {
	function themename_remove_products_tabs($tabs) {
		unset( $tabs['additional_information'] );
		unset( $tabs['reviews'] );
		return $tabs;
	}
}
add_filter( 'woocommerce_product_tabs', 'themename_remove_product_tabs', 99 );