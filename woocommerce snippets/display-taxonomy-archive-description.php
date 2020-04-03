<?php
/**
 * This snippet will display product taxonomy desctiption above products on archive pages
 */
if( ! function_exists( 'display_taxonomy_archive_description' ) ) {
	/**
	 * Display category Title and Description on
	 * product archive pages
	 * 
	 * @return void
	 */
	function display_taxonomy_archive_description() {
		if ( is_product_category() ) {
			$term_object = get_queried_object();
		?>
			<div class="product_tax-description">
				<h3 class="title"><?php echo $term_object->name; ?></h3>
				<p class="description"><?php echo $term_object->description; ?></p>
			</div>
		<?php
		}
	}
}
add_action( 'woocommerce_after_shop_loop', 'display_taxonomy_archive_description', 15 );