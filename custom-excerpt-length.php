<?php
/**
 * Filter the except length to 12 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wp_custom_excerpt_length($length) {
    return 13;
}
add_filter('excerpt_length', 'wp_custom_excerpt_length', 999);

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wp_excerpt_more($more) {
    global $post;
    return '<a class="moretag" href="' . get_permalink($post->ID) . '">  Read More</a>';
}
add_filter('excerpt_more', 'wp_excerpt_more');