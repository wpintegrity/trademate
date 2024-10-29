<?php
namespace WpIntegrity\TradeMate\Cart;

use WpIntegrity\TradeMate\Helper;

/**
 * Cart functions Manager Class.
 *
 * Handles cart-related functionalities for StoreKit.
 *
 * @since 1.0.0
 */
class ClassicCart {

    /**
     * Class constructor.
     *
     * Initializes actions and hooks for the cart.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'woocommerce_cart_actions', [ $this, 'clear_cart_button' ] );
        add_action( 'wp_head', [ $this, 'clear_cart_session' ] );
    }

    /**
     * Add a clear cart button to the cart page.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function clear_cart_button() {
        if ( Helper::get_option( 'clear_cart_button', 'trademate_general' ) === true ) :
        ?>
            <button type="submit" class="button" name="clear_cart" value="<?php esc_attr_e( 'Clear cart', 'trademate' ); ?>"><?php esc_html_e( 'Clear cart', 'storekit' ); ?></button>
        <?php
        endif;
    }

    /**
     * Clear cart session when clear cart button is clicked.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function clear_cart_session() {
        if ( isset( $_REQUEST['clear_cart'] ) ) {
            WC()->cart->empty_cart();
        }
    }
}
