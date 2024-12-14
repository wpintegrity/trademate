<?php
namespace WpIntegrity\TradeMate\Product;

use WpIntegrity\TradeMate\Helper;

/**
 * Products Functions Manager Class.
 *
 * Manages product-related functionalities, such as handling external products.
 * 
 * @since 1.0.1
 */
class Product {

    /**
     * Constructor function.
     *
     * Initializes actions based on plugin options.
     */
    public function __construct() {
        if ( Helper::get_option( 'external_product_new_tab', 'trademate_product' ) ) {
            add_filter( 'woocommerce_loop_add_to_cart_args', [ $this, 'open_external_products_in_new_tab'], 10, 2 );
            remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
            add_action( 'woocommerce_external_add_to_cart', [ $this, 'external_add_to_cart'] );
        }
    }

    /**
     * Open external products in a new tab.
     *
     * @param array $args The product link attributes.
     * @param \WC_Product $product The product object.
     * @return array The modified product link attributes.
     * @since 1.0.1
     */
    public function open_external_products_in_new_tab( $args, $product ) {
        if ( $product->is_type('external') ) {
            $args['attributes']['target'] = '_blank';
        }

        return $args;
    }

    /**
     * Output the external product add to cart button.
     *
     * @since 1.0.1
     */
    public function external_add_to_cart() {
        global $product;

        if ( ! $product->add_to_cart_url() ) {
            return;
        }

        Helper::get_templates(
            'add-to-cart/woo-external.php',
            [
                'product_url' => $product->add_to_cart_url(),
                'button_text' => $product->single_add_to_cart_text(),
            ]
        );
    }
}
