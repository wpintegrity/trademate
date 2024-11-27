<?php
/**
 * Plugin Name:       TradeMate
 * Plugin URI:        https://wpintegrity.com/trademate
 * Requires Plugins:  woocommerce
 * Description:       An Essential Plugin for WooCommerce to Extend its functionalities
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            WPIntegrity
 * Author URI:        https://wpintegrity.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       trademate
 * Domain Path:       /languages
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Autoload Classes via Composer.
require_once __DIR__ . '/vendor/autoload.php';

use WpIntegrity\TradeMate\Plugin;

/**
 * Initialize the TradeMate plugin.
 *
 * @return Plugin
 */
function trademate() {
    return Plugin::init();
}

// Start the plugin.
trademate();