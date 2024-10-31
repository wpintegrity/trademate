<?php
/**
 * Plugin Name:       TradeMate
 * Plugin URI:        https://wordpress.org/plugins/trademate
 * Description:       An Essential Plugin for WooCommerce to Extend its functionalities
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            WPIntegrity
 * Author URI:        https://wpintegrity.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       trademate
 * Domain Path:       /languages
 */

// Prevent direct access to this file.
if( ! defined( 'ABSPATH' ) ){
    exit;
}

/**
 * Main class of the plugin
 */
final class TradeMate {
    /**
     * Plugin version declaration
     * 
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Class holder container
     *
     * @var array
     */
    private $container = [];

    /**
     * Constructor class that contains all essential hooks/actions
     */
    public function __construct() {
        require_once __DIR__ . '/vendor/autoload.php';
        $this->define_constants();

        // Hooks for initializing the plugin
        add_action( 'before_woocommerce_init', [ $this, 'declare_woocommerce_hpos_compatibility' ] );
        add_action( 'woocommerce_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Initializes the TradeMate() class
     *
     * Checks for an existing TradeMate() instance and if it doesn't find one, creates it.
     *
     * @return TradeMate
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define all necessary constant
     *
     * @return void
     */
    private function define_constants() {
        define( 'TRADEMATE_VERSION', self::VERSION );
        define( 'TRADEMATE_FILE', __FILE__ );
        define( 'TRADEMATE_PATH', __DIR__ );
        define( 'TRADEMATE_INC', TRADEMATE_PATH . '/includes' );
        define( 'TRADEMATE_URL', plugins_url( '', TRADEMATE_FILE ) );
        define( 'TRADEMATE_ASSETS', TRADEMATE_URL . '/assets' );
    }

    /**
     * Initialize the plugin after all plugins are loaded
     *
     * @return void
     */
    public function init_plugin() {
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     *
     * @return void
     */
    public function init_hooks() {
        add_action( 'init', [ $this, 'init_classes' ] );

        // Set up localization
        add_action( 'init', [ $this, 'localization_setup' ] );

        // Add action links on the plugin screen
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'trademate_action_links' ] );
    }

    /**
     * Initialize required classes
     *
     * @return void
     */
    public function init_classes() {
        $this->container[ 'assets' ] = new \WpIntegrity\TradeMate\Assets();

        if( is_admin() ) {
            $this->container[ 'admin_settings' ] = new \WpIntegrity\TradeMate\Admin\Manager();
        }

        $this->container['features'] = new \WpIntegrity\TradeMate\Features();
    }
    
    /**
     * Initialize plugin localization
     *
     * @return void
     */
    public function localization_setup() {
        $locale = determine_locale();

        /**
		 * Filter to adjust the TradeMate locale to use for translations.
		 */
        $locale = apply_filters( 'plugin_locale', $locale, 'trademate' );

        unload_textdomain( 'trademate' );
        load_textdomain( 'trademate', WP_LANG_DIR . '/trademate/trademate-' . $locale . '.mo' );
        load_plugin_textdomain( 'trademate', false, dirname( plugin_basename( TRADEMATE_FILE ) ) . '/languages/' );
    }

    /**
     * Show action links on the plugin screen.
     *
     * @since 1.0.0
     * @param array $links Plugin action links.
     * @return array
     */
    public function trademate_action_links( $links ) {
        $action_links = [
            'settings' => '<a href="' . admin_url( 'admin.php?page=trademate' ) . '" aria-label="' . esc_attr__( 'View TradeMate settings', 'trademate' ) . '">' . esc_html__( 'Settings', 'trademate' ) . '</a>',
        ];

        return array_merge( $action_links, $links );
    }

    /**
     * Add High Performance Order Storage Support for WooCommerce.
     *
     * @since 1.0.0
     * @return void
     */
    public function declare_woocommerce_hpos_compatibility() {
        if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
        }
    }
}

/**
 * Load TradeMate Plugin when all plugins are loaded.
 *
 * @return TradeMate
 */
function trademate() {
    return TradeMate::init();
}

// Initialize TradeMate plugin
trademate();