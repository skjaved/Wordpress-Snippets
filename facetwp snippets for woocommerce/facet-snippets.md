# FacetWp snippets for Woocommerce

This file containe FacetWp snippets to enhance Woocommerce theme

- [Add mobile filters with FacetWp plugin](#add-mobile-filters-with-facetwp-plugin)
- [Show product filter lables](#show-product-filter-lables)

## Add mobile filters with FacetWp plugin
Refer below link to add filters on mobile
[facetwp flyout](https://facetwp.com/add-ons/flyout/)

## Show product filter lables

```javascript
/**
 * Show Product Filter Lables
 */
(function($) {
    $(document).on('facetwp-loaded', function() {
        $('.facetwp-facet').each(function() {
            var $facet = $(this);
            var facet_name = $facet.attr('data-name');
            var facet_label = FWP.settings.labels[facet_name];

            // if ($facet.children().length > 0) {
            //     $facet.wrap('<div class="facet-wrap"></div>');
            //     $facet.before('<h3 class="facet-label widget-title">Filter By ' + facet_label + '</h3>');
            // }

            if ($facet.closest('.facet-wrap').length < 1 && $facet.closest('.facetwp-flyout').length < 1) {
                $facet.wrap('<div class="facet-wrap"></div>');
                $facet.before('<h3 class="facet-label widget-title">' + facet_label + '</h3>');
            }

            if( $facet.attr('data-type') === "pager" ) {
            	$facet.parent(".facet-wrap").find(".widget-title").hide();
            }
        });
    });
})(jQuery);
```