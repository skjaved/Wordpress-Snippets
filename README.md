# Wordpress-Snippets

This repository contains useful snippets for WordPress and Woocommerce theme development

- [Get theme directory](#get-theme-directory)
- [Add svg support to theme](#add-svg-support-to-theme)
- [Custom nav walker class for custom menu](#custom-nav-walker-class-for-custom-menu)
- [Custom post excerpt length](#custom-post-excerpt-length)
- [Get readmore link with excerpt](#get-readmore-link-with-excerpt)
- [Display featured posts](#display-featured-posts)

## Get theme directory

```php
/**
 * Get template directory uri
 */
function medura_directory() {
    $themeuri = get_template_directory_uri();
    return $themeuri;
}
```

## Add svg support to theme
```php
/**
 * Add svg MIME upload support
 */
function medura_mime_types($mime_types) {
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'medura_mime_types', 1, 1);
```

## Custom nav walker class for custom menu
```php
/**
 * Custom walker class.
 */
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {
 
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );
 
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
 
    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
 
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

        if( 0 == $depth ):
        $output .=  '<span class="menu-icon hide-960">';
        $output .=  '<svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0.234845 0.240318C0.160403 0.315989 0.10134 0.405884 0.0610417 0.504852C0.020743 0.60382 -2.74948e-07 0.709919 -2.70264e-07 0.81707C-2.65581e-07 0.924221 0.0207431 1.03032 0.0610417 1.12929C0.10134 1.22826 0.160403 1.31815 0.234845 1.39382L5.54907 6.80941C5.60823 6.86983 5.6785 6.91776 5.75587 6.95046C5.83323 6.98317 5.91616 7 5.99991 7C6.08367 7 6.1666 6.98317 6.24396 6.95046C6.32132 6.91776 6.3916 6.86983 6.45076 6.80941L11.765 1.39382C12.0783 1.07449 12.0783 0.559648 11.765 0.240318C11.4516 -0.0790134 10.9464 -0.0790133 10.6331 0.240318L5.99672 4.9586L1.36036 0.233802C1.0534 -0.079012 0.541804 -0.0790129 0.234845 0.240318Z" fill="white"/>
        </svg>';
        $output .=  '</span>';
        endif;
    }
}
```

## Custom post excerpt length
```php
/**
 * Filter the except length to 13 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wp_custom_excerpt_length($length) {
    return 13;
}
add_filter('excerpt_length', 'wp_custom_excerpt_length', 999);
```

## Get readmore link with excerpt
```php
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wp_excerpt_more($more) {

    return '<a class="moretag" href="' . get_permalink($post->ID) . '">  Read More</a>';
}
add_filter('excerpt_more', 'wp_excerpt_more');
```

## Display featured posts
```php
/**
 * Create checkbox to make the blog post featured
 *
 */

function show_custom_meta() {
    add_meta_box( 'custom_meta', __( 'Featured Posts', 'text-domain' ), 'custom_meta_callback', 'post' );
}

function custom_meta_callback( $post ) {
        $featured = get_post_meta( $post->ID );
    ?>
	<p>
        <div class="row-content">
            <label for="meta-checkbox">
                <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
                <?php _e( 'Check to feature this post', 'textdomain' )?>
            </label>
        </div>
    </p>

<?php
}
add_action( 'add_meta_boxes', 'show_custom_meta' );

/**
 * Saves the custom meta input
 * Saves meta box value(yes or no)
 */
function custom_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}

}
add_action( 'save_post', 'custom_meta_save' );

// WP_Query args to display fetured post
$args = array(
    'post_type'     => 'post',
    'meta_key' => 'meta-checkbox',
    'meta_value' => 'yes',
    'posts_per_page' => 1,
);
$query = new WP_Query( $args );
```