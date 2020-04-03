<?php

if ( ! function_exists( 'header_login' ) ) {
    /**
     * This function outputs the login and register option on the front-end
     * Hook this function at the where you want to output the login and register option
     * @since  1.0.0
     */
    function header_login() {
        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            ?>
                <a class="header-login" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','uiworld'); ?>"><?php echo 'Welcome ' . $user->display_name; ?></a>
            <?php
        } else {
            ?>
                <a class="header-login" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','uiworld'); ?>"><?php _e('Login / Register','uiworld'); ?></a>
            <?php
        }
    }
}