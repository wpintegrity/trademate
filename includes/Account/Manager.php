<?php
namespace WpIntegrity\TradeMate\Account;

/**
 * Account feature Manager Class.
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
        // Initialize Account functionality classes
        new Registration();
    }
}
