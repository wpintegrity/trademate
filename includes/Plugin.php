<?php

namespace WpIntegrity\TradeMate;

/**
 * Main Plugin Class
 * 
 * This class serves as the core of the TradeMate plugin, handling initialization,
 * constants definition, hooks registration, and containerized instances of plugin components.
 */
final class Plugin {

    /**
     * Plugin version.
     * 
     * @const string
     */
    const VERSION = '1.0.1';

    /**
     * Singleton instance of the plugin.
     * 
     * @var Plugin|null
     */
    private static $instance = null;

    /**
     * Container for managing plugin components.
     * 
     * @var array
     */
    private $container = [];

    /**
     * Private constructor to enforce singleton usage.
     * 
     * Initializes the plugin by defining constants and registering hooks.
     */
    private function __construct() {
        $this->define_constants();
        $this->register_hooks();
    }

    /**
     * Initialize the plugin (Singleton).
     * 
     * Ensures only one instance of the plugin class is created.
     * 
     * @return Plugin Singleton instance.
     */
    public static function init() {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Define plugin constants.
     * 
     * This method sets up essential constants used across the plugin for paths, URLs, and versioning.
     */
    private function define_constants() {
        define( 'TRADEMATE_VERSION', self::VERSION );
        define( 'TRADEMATE_FILE', __FILE__ );
        define( 'TRADEMATE_PATH', plugin_dir_path( dirname( __FILE__ ) ) );
        define( 'TRADEMATE_INC', TRADEMATE_PATH . 'includes/' );
        define( 'TRADEMATE_URL', plugin_dir_url( dirname( __FILE__ ) ) );
        define( 'TRADEMATE_ASSETS', TRADEMATE_URL . 'assets/' );
    }

    /**
     * Register all hooks used by the plugin.
     * 
     * Hooks include actions and filters required for initialization, localization,
     * WooCommerce compatibility, and admin actions.
     */
    private function register_hooks() {
        // Load plugin textdomain for translations.
        add_action( 'init', [ $this, 'load_textdomain' ] );

        // Initialize the plugin components after WooCommerce is fully loaded.
        add_action( 'woocommerce_loaded', [ $this, 'initialize_plugin' ] );

        // Declare High-Performance Order Storage (HPOS) compatibility with WooCommerce.
        add_action( 'before_woocommerce_init', [ $this, 'declare_hpos_compatibility' ] );

        // Add action links for the plugin on the Plugins page.
        add_filter( 'plugin_action_links_' . plugin_basename( TRADEMATE_FILE ), [ $this, 'action_links' ] );
    }

    /**
     * Load the plugin's textdomain for localization.
     * 
     * Ensures that translations are loaded from the appropriate directory.
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'trademate', false, dirname( plugin_basename( TRADEMATE_FILE ) ) . '/languages/' );
    }

    /**
     * Initialize plugin components.
     * 
     * This method creates instances of required plugin components such as assets manager,
     * and admin settings (for backend functionality).
     */
    public function initialize_plugin() {
        // Load frontend assets.
        $this->container['assets'] = new Assets();

        // Load admin-specific functionality if in the admin area.
        if ( is_admin() ) {
            $this->container['admin'] = new Admin\Manager();
        }

        $this->container['features'] = new Features();
        $this->container['customizer'] = new Customizer();
    }

    /**
     * Declare WooCommerce High-Performance Order Storage (HPOS) compatibility.
     * 
     * Ensures the plugin integrates seamlessly with WooCommerce's custom order tables.
     */
    public function declare_hpos_compatibility() {
        if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', TRADEMATE_FILE, true );
        }
    }

    /**
     * Add custom action links for the plugin on the Plugins screen.
     * 
     * Adds links to the plugin's settings page for easier access.
     * 
     * @param array $links Default plugin action links.
     * @return array Modified action links.
     */
    public function action_links( $links ) {
        $action_links = [
            '<a href="' . admin_url( 'admin.php?page=trademate-settings' ) . '">' . __( 'Settings', 'trademate' ) . '</a>',
        ];
        return array_merge( $action_links, $links );
    }
}