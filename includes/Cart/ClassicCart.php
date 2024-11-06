<?php
namespace WpIntegrity\TradeMate\Cart;

use WpIntegrity\TradeMate\Helper;

/**
 * Cart functions Manager Class.
 *
 * Handles cart-related functionalities for TradeMate.
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
        if ( Helper::get_option( 'clear_cart_button', 'trademate_cart' ) === true ) :
        ?>
            <button type="submit" class="button" name="clear_cart" value="<?php esc_attr_e( 'Clear cart', 'trademate' ); ?>" style="background-color: #cf2e2e; color: #fff;"><?php esc_html_e( 'Clear cart', 'trademate' ); ?></button>
            <?php wp_nonce_field( 'tm_clear_cart_action', 'tm_clear_cart_nonce' ); ?>
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
        if ( isset( $_REQUEST['clear_cart'] ) 
        && isset( $_REQUEST['tm_clear_cart_nonce'] ) 
        && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['tm_clear_cart_nonce'] ) ), 'tm_clear_cart_action' ) 
        ) {
            WC()->cart->empty_cart();
        }
    }
}
