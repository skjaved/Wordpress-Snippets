<?php
/**
 * This will remove page titles from woocommerce pages
 */
add_filter( 'woocommerce_show_page_title', '__return_null' );