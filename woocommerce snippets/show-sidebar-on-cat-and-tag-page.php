<?php
/**
 * Show sidebar on product category page and attribute archive page
 * 
 * To show content of product custom taxonomy on archive pages
 * add file in yourtheme/woocommerce/taxonomy-product_cat.php.
 */
function add_sidebar_on_product_category($true) {

	if( is_product_category() || is_tax( 'pa_brands' ) ) {
		$true = true;
	}
	return $true;
}
add_filter( 'is_active_sidebar', 'add_sidebar_on_product_category', 10, 2 );