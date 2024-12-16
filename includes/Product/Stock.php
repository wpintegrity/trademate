<?php
namespace WpIntegrity\TradeMate\Product;

use WP_Customize_Color_Control;
use WpIntegrity\TradeMate\Helper;

/**
 * Stock Functions Manager Class.
 *
 * Manages default product stock and sold individually settings.
 * 
 * @since 1.0.0
 */
class Stock {

    /**
     * @var bool Whether the product is sold individually.
     * 
     * @since 1.0.0
     */
    private $is_sold_individually = false;

    /**
     * Constructor function.
     *
     */
    public function __construct() {
        add_action( 'save_post_product', [ $this, 'default_product_stock' ] );
        add_action( 'woocommerce_is_sold_individually', [ $this, 'product_sold_individually' ] );
        add_filter( 'woocommerce_cart_item_quantity', [ $this, 'cart_product_quantity' ] );

        if( 
            Helper::get_option( 'out_of_stock_badge', 'trademate_product' ) 
            && get_option( 'woocommerce_hide_out_of_stock_items' ) === 'no'
        ) {
            add_action( 'trademate_customize_register', [ $this, 'out_of_stock_customizer_options' ] );
            add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'add_out_of_stock_badge' ] );
            add_action( 'woocommerce_before_single_product_summary', [ $this, 'add_out_of_stock_badge' ] );
        }
    }

    /**
     * Set default product stock.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID of the product being saved.
     */
    public function default_product_stock( $post_id ) {
        $product_stock = Helper::get_option( 'default_product_stock', 'trademate_product' );

        $post_author   = get_post_field( 'post_author', $post_id );
        $user          = get_userdata( $post_author );
        $user_roles    = $user->roles;

        if ( $product_stock > 0 && in_array( 'administrator', $user_roles ) ) {
            update_post_meta( $post_id, '_manage_stock', 'yes' );
            update_post_meta( $post_id, '_stock', $product_stock );
        }
    }

    /**
     * Filter whether a product is sold individually.
     *
     * @since 1.0.0
     *
     * @param bool   $individually Whether the product is sold individually.
     * @return bool  Whether the product is sold individually.
     */
    public function product_sold_individually( $individually ) {
        $woo_sold_individually   = Helper::get_option( 'product_individual_sale', 'trademate_product' );
    
        if ( 'yes' === $woo_sold_individually ) {
            $this->is_sold_individually = true; // Set the class property to true if sold individually
            $individually = true;
        }
    
        return $individually;
    }
    
    /**
     * Return cart quantity based on the product_sold_individually function
     * 
     * @since 1.0.0
     *
     * @param int $product_quantity
     * @return void
     */
    public function cart_product_quantity( $product_quantity ) {
        if( $this->is_sold_individually === true ) {
            $product_quantity = 1;
        }
        
        return $product_quantity;
    }

    /**
     * Out of Stock section customizer options 
     *
     * @param object $wp_customize
     * @return void
     * @since 1.0.1
     */
    public function out_of_stock_customizer_options( $wp_customize ) {
        $wp_customize->add_section(
            'trademate_out_of_stock',
            [
                'title'    => __( 'Out of Stock', 'trademate' ),
                'priority' => 10,
                'panel'    => 'trademate',
            ]
        );

        // Add Setting for Badge Text
        $wp_customize->add_setting(
            'out_of_stock_badge_text', 
            [
                'default'   => __( 'Out of Stock', 'trademate' ),
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        // Add Control for Badge Text
        $wp_customize->add_control(
            'out_of_stock_badge_text_control', 
            [
                'label'    => __( 'Badge Text', 'trademate' ),
                'section'  => 'trademate_out_of_stock',
                'settings' => 'out_of_stock_badge_text',
                'type'     => 'text',
            ]
        );

        // Add Setting for Badge Background Color
        $wp_customize->add_setting( 
            'out_of_stock_badge_bg_color', 
            [
                'default'           => '#ff0000',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        // Add Control for Badge Background Color
        $wp_customize->add_control( 
            new WP_Customize_Color_Control( 
                $wp_customize, 
                'out_of_stock_badge_bg_color_control', 
                [
                    'label'    => __( 'Badge Background Color', 'trademate' ),
                    'section'  => 'trademate_out_of_stock',
                    'settings' => 'out_of_stock_badge_bg_color',
                ]
            )
        );

        // Add Setting for Badge Text Color
        $wp_customize->add_setting(
            'out_of_stock_badge_text_color', 
            [
                'default'   => '#ffffff',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        // Add Control for Badge Text Color
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize, 
                'out_of_stock_badge_text_color_control', 
                [
                    'label'    => __('Text Color', 'trademate'),
                    'section'  => 'trademate_out_of_stock',
                    'settings' => 'out_of_stock_badge_text_color',
                ]
            )
        );
    }

    /**
     * Out of Stock Badge Frontend
     *
     * @return void
     * @since 1.0.1
     */
    public function add_out_of_stock_badge() {
        global $product;

        if ( ! $product->is_in_stock() ) {
            // Get customizer settings
            $badge_text = get_theme_mod( 'out_of_stock_badge_text', __('Out of Stock', 'trademate') );
            $bg_color   = get_theme_mod( 'out_of_stock_badge_bg_color', '#ff0000' );
            $text_color = get_theme_mod( 'out_of_stock_badge_text_color', '#ffffff' );

            // Output the badge
            echo '<span class="tm-out-of-stock-badge" style="position: absolute; top: 10px; left: 10px; background: ' . esc_attr($bg_color) . '; color: ' . esc_attr($text_color) . '; padding: 5px 10px; font-size: 12px; z-index: 10;">' . esc_html($badge_text) . '</span>';
        }
    }
}
