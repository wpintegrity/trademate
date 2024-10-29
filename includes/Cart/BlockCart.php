<?php
namespace WpIntegrity\TradeMate\Cart;

/**
 * BlockCart Class
 *
 * Manages cart-related functionalities for TradeMate, including 
 * registering and handling the Clear Cart Gutenberg block.
 *
 * @since 1.0.0
 */
class BlockCart {

    /**
     * Class constructor.
     *
     * Initializes actions and hooks for the cart.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'enqueue_block_editor_assets', [ $this, 'register_scripts' ] );
        add_action( 'init', [ $this, 'register_clear_cart_block' ], 11 );
        add_action( 'enqueue_block_assets', [ $this, 'enqueue_clear_cart_script' ] );
        add_action( 'wp_ajax_clear_cart', [ $this, 'clear_cart' ] );
        add_action( 'wp_ajax_nopriv_clear_cart', [ $this, 'clear_cart' ] );
    }

    /**
     * Register block scripts for editor.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_scripts() {
        wp_register_script(
            'trademate-clear-cart-block',
            TRADEMATE_ASSETS . '/js/blocks/clear-cart-block.js',
            [ 'wp-blocks', 'wp-i18n', 'wp-components', 'wp-block-editor', 'wp-element' ],
            TRADEMATE_VERSION,
            true
        );
    }

    /**
     * Register the Gutenberg block for Clear Cart Button
     * and enqueue necessary script for editor and frontend.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register_clear_cart_block() {
        register_block_type(
            'trademate/clear-cart-button',
            array(
                'editor_script' => 'trademate-clear-cart-block'
            )
        );
    }

    /**
     * Enqueue the script to handle AJAX request for clearing the cart.
     * Loads the script only on the cart page for frontend.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function enqueue_clear_cart_script() {
        // Load only on cart page or frontend usage.
        if ( is_cart() ) {
            wp_enqueue_script( 'trademate-clear-cart' );
            wp_localize_script( 'trademate-clear-cart', 'tm_clear_cart', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'clear_cart_nonce' ),
            ) );
        }
    }

    /**
     * Clear cart session using AJAX.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function clear_cart() {
        check_ajax_referer( 'clear_cart_nonce', 'nonce' );

        if ( WC()->cart ) {
            WC()->cart->empty_cart();
            wp_send_json_success( __( 'Cart has been cleared.', 'trademate' ) );
        } else {
            wp_send_json_error( __( 'Could not clear cart.', 'trademate' ) );
        }
    }
}