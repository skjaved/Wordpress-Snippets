<?php
/**
 * Snippet to add snackbar to website
 */
function display_snackbar()
{
    if( is_page('home') ) :
    ?>
    <div id="snackbar">
        <p>Snackbar title | <a class="snackbar_link" href="" target="_blank">Know More</a> <span id="snackbar_dismiss">Dismiss</span></p>
    </div>
    <?php
    endif;
}