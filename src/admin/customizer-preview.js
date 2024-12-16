(function($) {
    wp.customize.section('trademate_out_of_stock', function(section) {
        section.expanded.bind(function(isExpanded) {
            if (isExpanded) {
                // Replace with the actual Shop page URL dynamically passed from PHP
                var shopPageUrl = tm_wp_customizer_settings.shopPageUrl;

                // Redirect the Customizer preview to the Shop page
                if (shopPageUrl) {
                    wp.customize.previewer.previewUrl.set(shopPageUrl);
                }
            }
        });
    });
})(jQuery);