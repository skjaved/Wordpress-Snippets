<?php
// Display percentage discount badge on products
if ( ! function_exists( 'display_sale_percentage_loop' ) ) {
    /**
     * Display percentage discount badge on products
     * 
     * @since 1.0.0
     */
    function display_sale_percentage_loop() {
        global $product;
        if ( ! $product->is_on_sale() ) return;
        if ( $product->is_type( 'simple' ) ) {
            $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
        } elseif ( $product->is_type( 'variable' ) ) {
            $max_percentage = 0;
            $percentage = 0;
            foreach ( $product->get_children() as $child_id ) {
                $variation = wc_get_product( $child_id );
                $price = $variation->get_regular_price();
                $sale = $variation->get_sale_price();
                if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
                if ( $percentage > $max_percentage ) {
                    $max_percentage = $percentage;
                }
            }
        }
        if ( $max_percentage > 0 ) echo "<div class='sale-perc'>- " . round($max_percentage) . "%</div>"; 
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'display_sale_percentage_loop', 25 );