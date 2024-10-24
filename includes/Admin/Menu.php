<?php
namespace WpIntegrity\TradeMate\Admin;

/**
 * Admin Menu Handler Class
 *
 * @since 1.0.0
 */
class Menu {

    /**
     * Class constructor
     *
     * Initializes the admin menu action.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
        add_action( 'admin_init', [ $this, 'wc_navigation_bar' ] );
    }

    /**
     * Register our menu page
     *
     * Adds a new submenu page for Trademate in the WooCommerce admin dashboard.
     *
     * @since 1.0.0
     * @return void
     */
    public function admin_menu() {
        add_submenu_page( 
            'woocommerce', 
            __( 'TradeMate', 'trademate' ),
            __( 'TradeMate', 'trademate' ),
            'manage_woocommerce',
            'trademate',
            [ $this, 'render_settings_page' ]
        );

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Render Plugin's Menu Page
     *
     * Outputs the content for the TradeMate settings page.
     *
     * @since 1.0.0
     * @return void
     */
    public function render_settings_page() {
        echo '<div class="wrap"><div id="trademate-admin"></div></div>';
    }

    /**
     * Enqueue scripts and styles
     *
     * Enqueues the necessary scripts and styles for the TradeMate admin page.
     *
     * @since 1.0.0
     * @return void
     */
    public function enqueue_scripts() {
        // Get the current screen
        $screen = get_current_screen();

        // Check if we are on the TradeMate admin page
        if ( $screen && $screen->id === 'woocommerce_page_trademate' ) {
            wp_enqueue_style( 'trademate-admin' );
            wp_enqueue_script( 'trademate-admin' );

            // Localize script to pass nonce to JavaScript
            wp_localize_script( 'trademate-admin', 'trademate_settings', $this->get_settings_localized_scripts() );
        }
    }

    /**
     * Admin localized scripts
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_settings_localized_scripts() {
        $settings_localized = [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'trademate_admin' )
        ];

        return apply_filters( 'trademate_settings_localized_scripts', $settings_localized );
    }

    /**
     * Integration of WC Navigation Bar.
     *
     * @since 1.0.0
     * 
     * @return void
     */
    public function wc_navigation_bar() {
        wc_admin_connect_page(
            array(
                'id'        => 'trademate',
                'screen_id' => 'woocommerce_page_trademate',
                'title'     => __( 'TradeMate', 'trademate' ),
            )
        );
    }
}
