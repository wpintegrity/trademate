<?php
namespace WpIntegrity\TradeMate;

/**
 * Features Manager Class.
 *
 * Initializes and manages various TradeMate features.
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
        new \WpIntegrity\TradeMate\Product\Manager();
        new \WpIntegrity\TradeMate\Emails\Manager();
        new \WpIntegrity\TradeMate\Account\Manager();
        new \WpIntegrity\TradeMate\Shipping\Manager();
    }
}
