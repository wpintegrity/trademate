<?php
namespace WpIntegrity\TradeMate\Product;

use WP_Customize_Color_Control;
use WpIntegrity\TradeMate\Customizer\HeaderControl;
use WpIntegrity\TradeMate\Customizer\RadioIconControl;
use WpIntegrity\TradeMate\Helper;

use function HFG\setting;

/**
 * Products Functions Manager Class.
 *
 * Manages product-related functionalities, such as handling external products.
 * 
 * @since 1.0.1
 */
class Countdown {

    /**
     * Constructor function.
     *
     * Initializes actions based on plugin options.
     */
    public function __construct() {
        if( Helper::get_option( 'product_sales_countdown', 'trademate_product' ) ) {
            $this->add_hooks_for_placement();
            add_action( 'trademate_customize_register', [ $this, 'sale_countdown_customizer_options' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'countdown_script' ] );
        }
    }

    /**
     * Countdown Timer Placement
     *
     * @return void
     */
    private function add_hooks_for_placement() {
        // Placement for shop/archive pages
        $placement_shop = get_theme_mod('countdown_timer_placement_shop', 'after_image'); // Default: after image
        switch ($placement_shop) {
            case 'after_image':
                add_action('woocommerce_before_shop_loop_item_title', [$this, 'sale_countdown_timer_archive']);
                break;
            case 'after_title':
                add_action('woocommerce_shop_loop_item_title', [$this, 'sale_countdown_timer_archive'], 15);
                break;
            case 'after_price':
                add_action('woocommerce_after_shop_loop_item', [$this, 'sale_countdown_timer_archive'], 15);
                break;
        }
    
        // Placement for single product pages
        $placement_spp = get_theme_mod('countdown_timer_placement_spp', 'after_price'); // Default: after cart
        switch ($placement_spp) {
            case 'after_price':
                add_action('woocommerce_single_product_summary', [$this, 'sale_countdown_timer_single']);
                break;
            case 'after_short_desc':
                add_action('woocommerce_before_add_to_cart_form', [$this, 'sale_countdown_timer_single'], 15);
                break;
            case 'after_cart_btn':
                add_action('woocommerce_after_add_to_cart_form', [$this, 'sale_countdown_timer_single'], 15);
                break;
            case 'after_meta':
                add_action('woocommerce_product_meta_end', [$this, 'sale_countdown_timer_single'], 15);
                break;
        }
    }

    /**
     * Add countdown timer to the Shop/Product Archive Page
     *
     * @return void
     */
    public function sale_countdown_timer_archive() {
        global $product;
    
        if ($product->is_on_sale()) {
            $sale_end = $product->get_date_on_sale_to();
    
            if ($sale_end) {
                // Convert to WordPress Timezone
                $wp_timezone = wp_timezone();
                $sale_end_wp_time = $sale_end->date('U', $wp_timezone);
    
                echo '<div class="sale-countdown-timer" data-sale-end="' . esc_attr($sale_end_wp_time) . '"></div>';
            }
        }
    }

    /**
     * Add countdown timer to the Single Product Page
     *
     * @return void
     * @since 1.0.1
     */
    public function sale_countdown_timer_single() {
        global $product;

        if ($product->is_on_sale()) {
            $sale_end = $product->get_date_on_sale_to();

            if ($sale_end) {
                // Convert to WordPress Timezone
                $wp_timezone = wp_timezone();
                $sale_end_wp_time = $sale_end->date('U', $wp_timezone);

                echo '<div class="sale-countdown-timer" data-sale-end="' . esc_attr($sale_end_wp_time) . '"></div>';
            }
        }
    }

    /**
     * Countdown Timer Customizer Options
     *
     * @param Object $wp_customize
     * @return void
     */
    public function sale_countdown_customizer_options( $wp_customize ) {
        // Add Section for Countdown Timer Styles
        $wp_customize->add_section(
            'trademate_sales_countdown', 
            [
                'title'       => __('Countdown Timer', 'trademate'),
                'description' => __('Customize the appearance of the countdown timer.', 'trademate'),
                'panel'       => 'trademate',
                'priority'    => 11,
            ]
        );

        // Countdown Color Setting
        $wp_customize->add_setting(
            'countdown_timer_color', 
            [
                'default'           => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 
                'countdown_timer_color_control', 
                [
                    'label'    => __('Text Color', 'trademate'),
                    'section'  => 'trademate_sales_countdown',
                    'settings' => 'countdown_timer_color',
                ]
            )
        );

        // Countdown Background Color Setting
        $wp_customize->add_setting(
            'countdown_timer_background_color', 
            [
                'default'           => '#000000',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 
                'countdown_timer_background_color_control', 
                [
                    'label'    => __('Background Color', 'trademate'),
                    'section'  => 'trademate_sales_countdown',
                    'settings' => 'countdown_timer_background_color',
                ]
            )
        );

        // Header - Shop Page
        $wp_customize->add_control(
            new HeaderControl(
                $wp_customize,
                'trademate_countdown_timer_shop_page',
                [
                    'section'  => 'trademate_sales_countdown',
                    'label'    => __( 'Shop/Product Archive', 'trademate' ),
                    'settings' => [],
                ]
            )
        );

        // Placement for Shop Page
        $wp_customize->add_setting(
            'countdown_timer_placement_shop',
            [
                'default'           => 'after_image',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );
        $wp_customize->add_control(
            'countdown_timer_placement_control_shop',
            [
                'label'    => __('Placement', 'trademate'),
                'section'  => 'trademate_sales_countdown',
                'settings' => 'countdown_timer_placement_shop',
                'type'     => 'select',
                'choices'  => [
                    'after_image' => __('After Product Image', 'trademate'),
                    'after_title' => __('After Product Title', 'trademate'),
                    'after_price' => __('After Price', 'trademate'),
                ],
            ]
        );

        // Countdown Font Size Setting (Range Slider)
        $wp_customize->add_setting(
            'countdown_timer_font_size_shop', 
            [
                'default'           => 14, // Default to 14px
                'sanitize_callback' => 'absint', // Ensure it's an integer
            ]
        );
        $wp_customize->add_control(
            'countdown_timer_font_size_control_shop', 
            [
                'label'       => __('Font Size (px)', 'trademate'),
                'section'     => 'trademate_sales_countdown',
                'settings'    => 'countdown_timer_font_size_shop',
                'type'        => 'range',
                'input_attrs' => [
                    'min'  => 10,
                    'max'  => 50,
                    'step' => 1,
                ]
            ]
        );

        // Countdown Timer Position (Shop Page)
        $wp_customize->add_setting(
            'countdown_timer_position_shop', 
            [
                'default'           => 'center',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_control(
            new RadioIconControl(
                $wp_customize,
                'countdown_timer_position_control_shop',
                [
                    'label'       => __('Position', 'trademate'),
                    'description' => __('Choose the countdown timer alignment for Shop/Product Archive page.', 'trademate'),
                    'section'     => 'trademate_sales_countdown',
                    'settings'    => 'countdown_timer_position_shop',
                    'choices'     => [
                        'left'   => 'dashicons-editor-alignleft',
                        'center' => 'dashicons-editor-aligncenter',
                        'right'  => 'dashicons-editor-alignright',
                    ],
                ]
            )
        );

        // Header - Single Product Page
        $wp_customize->add_control(
            new HeaderControl(
                $wp_customize,
                'trademate_countdown_timer_single_product_page',
                [
                    'section'  => 'trademate_sales_countdown',
                    'label'    => __( 'Single Product Page', 'trademate' ),
                    'settings' => [],
                ]
            )
        );

        // Placement for Single Product Page
        $wp_customize->add_setting(
            'countdown_timer_placement_spp',
            [
                'default'           => 'after_price',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );
        $wp_customize->add_control(
            'countdown_timer_placement_control_spp',
            [
                'label'    => __('Placement', 'trademate'),
                'section'  => 'trademate_sales_countdown',
                'settings' => 'countdown_timer_placement_spp',
                'type'     => 'select',
                'choices'  => [
                    'after_price'      => __('After Price', 'trademate'),
                    'after_short_desc' => __('After Short Description', 'trademate'),
                    'after_cart_btn'   => __('After "Add to Cart" Button', 'trademate'),
                    'after_meta'       => __('After Product Meta', 'trademate'),
                ],
            ]
        );

        // Countdown Font Size Setting (Range Slider)
        $wp_customize->add_setting(
            'countdown_timer_font_size_spp', 
            [
                'default'           => 14, // Default to 14px
                'sanitize_callback' => 'absint', // Ensure it's an integer
            ]
        );
        $wp_customize->add_control(
            'countdown_timer_font_size_control_spp', 
            [
                'label'       => __('Font Size (px)', 'trademate'),
                'section'     => 'trademate_sales_countdown',
                'settings'    => 'countdown_timer_font_size_spp',
                'type'        => 'range',
                'input_attrs' => [
                    'min'  => 10,
                    'max'  => 50,
                    'step' => 1,
                ],
            ]
        );

        // Countdown Timer Position (Single Product Page)
        $wp_customize->add_setting(
            'countdown_timer_position_spp', 
            [
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        $wp_customize->add_control(
            new RadioIconControl(
                $wp_customize,
                'countdown_timer_position_control_spp',
                [
                    'label'       => __('Position', 'trademate'),
                    'description' => __('Choose the countdown timer alignment for Single Product page.', 'trademate'),
                    'section'     => 'trademate_sales_countdown',
                    'settings'    => 'countdown_timer_position_spp',
                    'choices'     => [
                        'left'   => 'dashicons-editor-alignleft',
                        'center' => 'dashicons-editor-aligncenter',
                        'right'  => 'dashicons-editor-alignright',
                    ]
                ]
            )
        );
    }

    /**
     * Scripts and Dynamic Styles
     *
     * @return void
     */
    public function countdown_script() {
        if ( is_product() || is_shop() ) {
            wp_enqueue_script( 'trademate-sales-countdown' );

            wp_register_style('trademate-sales-countdown', false);
            wp_enqueue_style('trademate-sales-countdown');

            // Retrieve Customizer values
            $color               = get_theme_mod('countdown_timer_color', '#ffffff');
            $background_color    = get_theme_mod('countdown_timer_background_color', '#000000');
            $font_size_shop      = get_theme_mod('countdown_timer_font_size_shop', 14);
            $timer_position_shop = get_theme_mod('countdown_timer_position_shop', 'center');
            $font_size_spp       = get_theme_mod('countdown_timer_font_size_spp', 14);
            $timer_position_spp  = get_theme_mod('countdown_timer_position_spp', 'left');

            // Create inline CSS
            $timer_countdown_css = "
                .sale-countdown-timer {
                    font-weight: bold;
                    margin: 10px 0;
                }
                .sale-countdown-timer .timer {
                    display: flex;
                    justify-content: {$timer_position_shop};
                    gap: 5px;
                }
                .sale-countdown-timer .timer span {
                    color: {$color};
                    background-color: {$background_color};
                    font-size: {$font_size_shop}px;
                    padding: 5px 10px;
                    border-radius: 5px;
                }

                .sale-countdown-timer .expired {
                    color: {$color};
                    font-size: {$font_size_shop};
                }

                .single-product .sale-countdown-timer .timer {
                    justify-content: {$timer_position_spp};
                }
                .single-product .sale-countdown-timer .timer span {
                    color: {$color};
                    background-color: {$background_color};
                    font-size: {$font_size_spp}px;
                }

                .single-product .sale-countdown-timer .expired {
                    color: {$color};
                    font-size: {$font_size_spp};
                }
            ";

            // Inject the inline CSS
            wp_add_inline_style( 'trademate-sales-countdown', $timer_countdown_css );
        }
    }

}
