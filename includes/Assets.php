<?php
namespace WpIntegrity\TradeMate;

/**
 * Scripts and Styles Class for managing plugin assets.
 */
class Assets {

    /**
     * Constructor. Registers scripts and styles based on context.
     */
    public function __construct() {
        if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ], 5 );
        } else {
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 5 );
        }
    }

    /**
     * Registers scripts and styles.
     *
     * @return void
     */
    public function enqueue_scripts() {
        $this->register_styles( $this->get_styles() );
        $this->register_scripts( $this->get_scripts() );
    }

    /**
     * Registers styles.
     *
     * @param array $styles Array of styles to register.
     * @return void
     */
    public function register_styles( $styles ) {
        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, TRADEMATE_VERSION );
        }
    }

    /**
     * Registers scripts.
     *
     * @param array $scripts Array of scripts to register.
     * @return void
     */
    public function register_scripts( $scripts ) {
        foreach( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : false;
            $version = isset( $script['version'] ) ? $script['version'] : TRADEMATE_VERSION;

            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
        }
    }

    /**
     * Retrieves an array of registered styles.
     *
     * @return array
     */
    public function get_styles() {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        $styles = [
            'trademate-admin'    => [
                'src' => TRADEMATE_ASSETS . 'css/admin' . $suffix . '.css'
            ],
            'trademate-frontend' => [
                'src' => TRADEMATE_ASSETS . 'css/frontend' . $suffix . '.css'
            ],
            'trademate-clear-cart' => [
                'src' => TRADEMATE_ASSETS . 'css/frontend/clear-cart-handler' . $suffix . '.css'
            ]
        ];

        return $styles;
    }

    /**
     * Retrieves an array of registered scripts.
     *
     * @return array
     */
    public function get_scripts() {
        $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        $scripts = [
            'trademate-admin'    => [
                'src'       => TRADEMATE_ASSETS . 'js/admin' . $suffix . '.js',
                'in_footer' => true
            ],
            'trademate-frontend' => [
                'src'       => TRADEMATE_ASSETS . 'js/frontend' . $suffix . '.js',
                'deps'      => [ 'jquery' ],
                'in_footer' => true
            ],
            'trademate-clear-cart' => [
                'src'       => TRADEMATE_ASSETS . 'js/frontend/clear-cart-handler' . $suffix . '.js',
                'deps'      => [ 'jquery' ],
                'in_footer' => true
            ]
        ];

        return $scripts;
    }
}
