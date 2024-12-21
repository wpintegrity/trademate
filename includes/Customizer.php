<?php
namespace WpIntegrity\TradeMate;

/**
 * Dokan Customizer Class
 * 
 * @since 1.0.1
 */
class Customizer {

    /**
     * Settings capability
     *
     * @var string
     * @since 1.0.1
     */
    private $capability = 'manage_options';

    /**
     * Class Constructor
     */
    public function __construct() {
        add_action( 'customize_register', [ $this, 'customizer_section' ] );
        add_action( 'customize_controls_enqueue_scripts', [ $this, 'customizer_scripts' ] );
    }

    /**
     * Add TradeMate panel to the customizer.
     *
     * @param object $wp_customize WordPress Customizer object
     * @return void
     * @since 1.0.1
     */
    public function customizer_section( $wp_customize ) {
        $wp_customize->add_panel(
            'trademate',
            [
                'priority'   => 200,
                'capability' => $this->capability,
                'title'      => __( 'TradeMate', 'trademate' ),
            ]
        );

        $this->add_customizer_section( $wp_customize );
    }

    /**
     * Add Sections to TradeMate Panel
     *
     * @param object $wp_customize WordPress Customizer object.
     * @return void
     * @since 1.0.1
     */
    protected function add_customizer_section( $wp_customize ) {
        /**
         * Hook to add custom sections and controls to the Trademate customizer.
         *
         * This action allows developers to register additional sections and controls
         * in the WordPress Customizer for the Trademate.
         *
         * @param $wp_customize WordPress Customizer object.
         * @since 1.0.1
         */

        do_action( 'trademate_customize_register', $wp_customize );
    }    

    /**
     * Customer Preview Scripts
     *
     * @return void
     * @since 1.0.1
     */
    public function customizer_scripts() {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        if( is_customize_preview() ) {
            wp_enqueue_style(
                'trademate-customizer', 
                TRADEMATE_ASSETS . 'css/customizer-preview' . $suffix . '.css',
            );

            wp_enqueue_script( 
                'trademate-customizer-preview',
                TRADEMATE_ASSETS . 'js/customizer-preview' . $suffix . '.js',
                [ 'jquery', 'customize-controls' ],
                TRADEMATE_VERSION,
                true
            );

            wp_localize_script(
                'trademate-customizer-preview', 
                'tm_wp_customizer_settings', 
                [
                    'shopPageUrl'    => esc_url( get_permalink( wc_get_page_id('shop') ) )
                ]
            );
        }
    }
}