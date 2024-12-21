import '../styles/admin/customizer-preview.scss';

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

    wp.customize.section('trademate_sales_countdown', function (section) {
        section.expanded.bind(function (isExpanded) {
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

    $(document).ready(function () {
        // Initialize range sliders
        $('input[type="range"]').each(function () {
            const $slider = $(this);
            const min = $slider.attr('min') || 10;
            const max = $slider.attr('max') || 50;

            // Create tooltip element
            const $tooltip = $('<div class="range-slider-tooltip"></div>');
            $tooltip.text($slider.val()); // Set initial value
            $slider.after($tooltip);

            // Function to update tooltip position and value
            function updateTooltip() {
                const value = $slider.val();
                const percentage = ((value - min) / (max - min)) * 100;

                // Update tooltip position and text
                $tooltip.css({
                    left: `calc(${percentage}% + (${20 - percentage * 0.4}px))`, // Dynamic adjustment
                });
                $tooltip.text(value);
            }

            // Bind input and change events
            $slider.on('input change', function () {
                updateTooltip();
            });

            // Initialize tooltip on page load
            updateTooltip();
        });
    });
})(jQuery);