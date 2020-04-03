<?php
/**
 * This snippet will display Woocommerce fetured products
 */
$meta_query  = WC()->query->get_meta_query();
$tax_query   = WC()->query->get_tax_query();
$tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => 'featured',
    'operator' => 'IN',
);

$args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'posts_per_page'      => 10,
    'meta_query'          => $meta_query,
    'tax_query'           => $tax_query,
);

$featured_query = new WP_Query( $args );

if ($featured_query->have_posts()) {

    while ($featured_query->have_posts()) :

        $featured_query->the_post();

        $product = wc_get_product( $featured_query->post->ID );

?>
<div class="featured-product">

    <a href="<?php the_permalink(); ?>">
        <?php echo woocommerce_get_product_thumbnail(); ?>
    </a>
    <a class="featured-product-name" href="<?php the_permalink(); ?>">
        <p><?php the_title(); ?></p>
    </a>
    <small class="featured-product-price">
        <?php echo wp_kses_post( $product->get_price_html() ); ?>
    </small>
    <button>
        <?php woocommerce_template_loop_add_to_cart(); ?>
    </button>
    
</div>
<?php
    endwhile;
}