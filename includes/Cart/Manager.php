<?php
namespace WpIntegrity\TradeMate\Cart;

/**
 * Features Manager Class.
 *
 * Initializes and manages various StoreKit features.
 *
 * @since 1.0.0
 */
class Manager {
    /**
     * Class constructor.
     *
     * Instantiates various feature classes.
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Initialize Cart functionality classes
        new ClassicCart();
        new BlockCart();
    }
}
