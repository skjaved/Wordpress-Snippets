<?php
/**
 * Add a custom product data tab on single product page
 */
if( ! function_exists( 'custom_product_data_tab' ) ) {
	/**
	 * Add the custom product tab
	 *
	 * @param $tabs
	 * @return $tabs
	 */
	function custom_product_data_tab( $tabs ) {

		// Adds the new tab

		$tabs['tab_slug'] = array(
			'title' 	=> __( 'Tab title', 'text-domain' ),
			'priority' 	=> 15,
			'callback' 	=> 'custom_product_data_tab_content'
		);

		return $tabs;

	}
}
add_filter( 'woocommerce_product_tabs', 'custom_product_data_tab' );

// Product Geometry tab content Callback
function custom_product_data_tab_content() {
	get_template_part( '/template-parts/content', 'dir' );
}