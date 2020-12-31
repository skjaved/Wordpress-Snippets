<?php
/**
 * Add a custom product data tab on single product page
 */
if( ! function_exists( 'themename_custom_product_data_tabs' ) ) {
	/**
	 * Add the custom product tab
	 *
	 * @param $tabs
	 * @return $tabs
	 */
	function themename_custom_product_data_tabs( $tabs ) {

    // Adds the new tab
    // In case of adding multiple data tabs the $tabs param can be passed as array like
    // $tabs = array() and  the below code can be repeated for the other tabs with resp entries like
    // slug, title, priority and callback

		$tabs['tab_slug'] = array(
			'title' 	=> __( 'Tab title', 'text-domain' ),
			'priority' 	=> 15,
			'callback' 	=> 'custom_product_data_tab_content'
    );

    // $tabs['tab_slug'] = array(
    //   'title'   => __('Tab title', 'text-domain'),
    //   'priority'   => 15,
    //   'callback'   => 'custom_product_data_tab_content'
    // );

		return $tabs;

	}
}
add_filter( 'woocommerce_product_tabs', 'themename_custom_product_data_tabs' );

// Product tab content Callback
// This callback renders the content of the tab
function custom_product_data_tab_content() {
	// e.g content-post, content-single
	get_template_part( '/template-parts/content', 'tab_slug' );
}