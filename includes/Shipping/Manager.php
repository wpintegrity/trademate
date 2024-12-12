<?php
namespace WpIntegrity\TradeMate\Shipping;

/**
 * Shipping feature Manager Class.
 *
 * @since 1.0.1
 */
class Manager {
    /**
     * Class constructor.
     *
     * Instantiates various feature classes.
     *
     * @since 1.0.1
     */
    public function __construct() {
        // Initialize Shipping functionality classes
        new Shipping();
    }
}
