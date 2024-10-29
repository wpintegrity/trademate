<?php
namespace WpIntegrity\TradeMate;

/**
 * Features Manager Class.
 *
 * Initializes and manages various StoreKit features.
 *
 * @since 1.0.0
 */
class Features {
    /**
     * Class constructor.
     *
     * Instantiates various feature classes.
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Initialize features classes
        new \WpIntegrity\TradeMate\Cart\Manager();
    }
}
