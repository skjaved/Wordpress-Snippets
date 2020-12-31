<?php
/**
 * This file contains all the code required to customize the woocommerce default
 * functionality like removing sidebars, altering the no. of products
 * display on shop page etc..
 * 
 * Note: This file is extended from underscores theme with woocommerce support enable
 */
if (!function_exists('themeslug_woocommerce_product_columns_wrapper')) {
    /**
     * Product columns wrapper.
     * this function wrap div around products columns
     *
     * @return  void
     */
    function themeslug_woocommerce_product_columns_wrapper()
    {
        $columns = themeslug_woocommerce_loop_columns();
        echo '<div class="columns-' . absint($columns) . ' themeslug_products_grid_wrapper">';
    }
}
add_action('woocommerce_before_shop_loop', 'themeslug_woocommerce_product_columns_wrapper', 40);

if ( ! function_exists( 'themeslug_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function themeslug_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'themeslug_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'themeslug_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function themeslug_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area themeslug_products_area">
			<main id="main" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'themeslug_woocommerce_wrapper_before' );

if ( ! function_exists( 'themeslug_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function themeslug_woocommerce_wrapper_after() {
		?>
				</main><!-- #main -->
			</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'themeslug_woocommerce_wrapper_after' );

/**
 * Remvoe sidebar from single product pages
 */
if (!function_exists('themeslug_remove_single_page_sidebar')) {
    /**
     * Remove sidebar form single product page
     *
     * @return void
     */
    function themeslug_remove_single_page_sidebar()
    {
        if (is_product()) {
            remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        }

        if (is_single()) {
            remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        }
    }
}
add_action('wp_head', 'themeslug_remove_single_page_sidebar');

/**
 * Remove woocommerce breadcrumbs
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**
 * Hide SKU, Cats, Tags @ Single Product Page - WooCommerce
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/**
 * Customize no of Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function themeslug_woocommerce_thumbnail_columns()
{
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'themeslug_woocommerce_thumbnail_columns');

/**
 * Truncate Short Description @ WooCommerce Single product page
 */
function themeslug_woocommerce_short_description_truncate_read_more()
{
    wc_enqueue_js('
      var show_char = 250;
      var ellipses = "... ";
      var content = $(".woocommerce-product-details__short-description").html();
      if (content.length > show_char) {
         var a = content.substr(0, show_char);
         var b = content.substr(show_char - content.length);
         var html = a + "<span class=\'truncated\'>" + ellipses + "<a class=\'read-more\'>Read more</a></span><span class=\'truncated\' style=\'display:none\'>" + b + "</span>";
         $(".woocommerce-product-details__short-description").html(html);
      }
      $(".read-more").click(function(e) {
         e.preventDefault();
         $(".woocommerce-product-details__short-description .truncated").toggle();
      });
   ');
}
add_action('woocommerce_after_single_product', 'themeslug_woocommerce_short_description_truncate_read_more');

/**
 * Replace single product price priority
 * put price after product short desctiption
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 21 );

/**
 * Remove product raing from single product summary box and shop page loop
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

/**
 * Always show product rating with 0 reviews
 * below product name on single product page
 */
function change_single_product_ratings(){
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10 );
    add_action('woocommerce_single_product_summary','wc_single_product_ratings', 10 );
}
add_action('woocommerce_single_product_summary', 'change_single_product_ratings', 2 );

function wc_single_product_ratings(){
    global $product;

    $rating_count = $product->get_rating_count();

    if ( $rating_count >= 0 ) {
        $review_count = $product->get_review_count();
        $average      = $product->get_average_rating();
        $count_html   = '<div class="count-rating">' . array_sum($product->get_rating_counts()) . '</div>';
        ?>
        <div class="woocommerce-product-rating">
            <div class="container-rating">
            	<div class="star-rating">
	            	<?php echo wc_get_rating_html( $average, $rating_count ); ?>
	            </div>
            	<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a><?php endif ?>
        	</div>
        </div>
        <?php
    }
}

/**
 * Place Wishlist button below the title
 * 
 * Only when using YITH wishlist plugin
 */
function themeslug_add_wc_wishlist_button() {
	echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
}
add_action( 'woocommerce_single_product_summary', 'themeslug_add_wc_wishlist_button', 11 );

/**
 * Add Trust icon on product page
 */
function themeslug_add_trust_icon() {
	?>
	<div class="trust-icon-wrapper">
		<img src="" alt="themeslug-trust-icon">
	</div>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'themeslug_add_trust_icon', 31 );

/**
 * Remove description tab content heading
 */
add_filter('woocommerce_product_description_heading', '__return_null');

/**
 * Add a custom product tabs in single function
 */
if (!function_exists('themeslug_product_custom_tabs')) {
	/**
	 * Add the custom product tabs on single product page
	 *
	 * @param $tabs
	 * @return $tabs
	 */
	function themeslug_product_custom_tabs( $tabs = array() ) {

		// Adds product specification tab
		if( get_field('product_specifications') ) {
			$tabs['products_specifications'] = array(
				'title' 	=> __('Specifications', 'themeslug'),
				'priority' 	=> 15,
				'callback' 	=> 'themeslug_product_specifications_tab_content'
			);
		}

		// Add product faq tab
		if( get_field('faqs') ) {
			$tabs['products_faqs'] = array(
				'title' 	=> __('FAQ\'s', 'themeslug'),
				'priority' 	=> 25,
				'callback' 	=> 'themeslug_product_faq_tab_content' 
			);
		}

		return $tabs;
	}
}
add_filter('woocommerce_product_tabs', 'themeslug_product_custom_tabs');

/**
 * Remove add to cart button from shop page
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Remove WooCommerce store notice from footer and
 * display before header
 */
remove_action('wp_footer', 'woocommerce_demo_store');
add_action( 'themeslug_wc_before_header', 'woocommerce_demo_store', 10 );

// Display percentage discount badge on products
if ( ! function_exists( 'themeslug_display_sale_percentage_loop' ) ) {
    /**
     * Display percentage discount badge on products
     * 
     * @since 1.0.0
     */
    function themeslug_display_sale_percentage_loop() {
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
        if ( $max_percentage > 0 ) echo "<span class='onsale'> " . round($max_percentage) . "% off</span>"; 
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'themeslug_display_sale_percentage_loop', 25 );
add_action( 'woocommerce_before_single_product_summary', 'themeslug_display_sale_percentage_loop', 25 );