<?php
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
                <?php _e( 'Check to feature this post', 'sm-textdomain' )?>
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