<?php
// Remove Woocommerce archive description from top
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );