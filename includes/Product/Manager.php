<?php
namespace WpIntegrity\TradeMate\Product;

/**
 * Product feature Manager Class.
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
        // Initialize Product functionality classes
        new Stock();
        new Product();
        new Countdown();
    }
}
