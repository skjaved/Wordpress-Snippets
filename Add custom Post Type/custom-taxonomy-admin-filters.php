<?php
/**
 * Custom taxonomy filter in Wordpress Admin Dashboard
 */
add_action( 'restrict_manage_posts', 'filter_backend_by_taxonomies' , 99, 2);
/* Filter CPT via Custom Taxonomy */
/* https://generatewp.com/filtering-posts-by-taxonomies-in-the-dashboard/ */

function filter_backend_by_taxonomies( $post_type, $which ) {

        // Apply this to a specific CPT
        if ( 'career' !== $post_type )
            return;

        // A list of custom taxonomy slugs to filter by
        $taxonomies = array( 'department' );

        foreach ( $taxonomies as $taxonomy_slug ) {

            // Retrieve taxonomy data
            $taxonomy_obj = get_taxonomy( $taxonomy_slug );
            $taxonomy_name = $taxonomy_obj->labels->name;

            // Retrieve taxonomy terms
            $terms = get_terms( $taxonomy_slug );

            // Display filter HTML
            echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
            echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
            foreach ( $terms as $term ) {
                printf(
                    '<option value="%1$s" %2$s>%3$s (%4$s)</option>',
                    $term->slug,
                    ( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
                    $term->name,
                    $term->count
                );
            }
            echo '</select>';
        }
}
