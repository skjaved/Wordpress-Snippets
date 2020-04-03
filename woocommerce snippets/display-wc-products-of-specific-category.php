<?php
/**
 * This snippet displays products from specific category
 */
$args = array(
    'orderby' => 'rand',
    'post_type' => 'product',
    'post_status' => 'publish',
    'product_cat' => 'toys',
    'ignore_sticky_posts' => 1,
    'posts_per_page' => '12'
);

$query = new WP_Query( $args );

if( $query->have_posts() ) :
while ( $query->have_posts() ) : $query->the_post();  ?>

<div class="featured-product">

    <a href="<?php the_permalink(); ?>">
        <?php echo woocommerce_get_product_thumbnail(); ?>
    </a>
    <a class="featured-product-name" href="<?php the_permalink(); ?>">
        <p><?php the_title(); ?></p>
    </a>
    <small class="featured-product-price">
        <?php
            $featured_product = wc_get_product( $query->post->ID );
            echo wp_kses_post( $featured_product->get_price_html() );
        ?>
    </small>
    <button>
        <?php woocommerce_template_loop_add_to_cart(); ?>
    </button>
    
</div>
<?php
endwhile;
    wp_reset_postdata();
else :
    get_template_part( 'template-parts/content', 'none' );
endif;