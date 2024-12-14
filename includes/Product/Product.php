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

        if( Helper::get_option( 'replace_quantity_steppers', 'trademate_product' ) ) {
            add_action( 'woocommerce_before_quantity_input_field', [ $this, 'quantity_decrease_button' ] );
            add_action( 'woocommerce_after_quantity_input_field', [ $this, 'quantity_increase_button' ] );
            add_action( 'wp_print_styles', [ $this, 'product_quantity_styles' ] );
        }
        
        add_action( 'wp_enqueue_scripts', [ $this, 'product_scripts' ] );
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

    /**
     * Outputs the decrease button HTML for the product quantity.
     *
     * @return void
     * @since 1.0.1
     */
    public function quantity_decrease_button() {
        echo '<button type="button" class="tm-qty-minus">−</button>';
    }

    /**
     * Outputs the increase button HTML for the product quantity.
     *
     * @return void
     * @since 1.0.1
     */
    public function quantity_increase_button() {
        echo '<button type="button" class="tm-qty-plus">+</button>';
    }

    /**
     * Outputs inline CSS to remove spinners from number inputs and style the quantity input.
     *
     * @return void
     * @since 1.0.1
     */
    public function product_quantity_styles() {
        echo "
            <style>
                /* Chrome, Safari, Edge, Opera */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                /* Firefox */
                input[type=number] {
                    -moz-appearance: textfield;
                }
            </style>
        ";
    }

    /**
     * Enqueues custom JavaScript for product quantity functionality.
     * This ensures the script is loaded only on product pages.
     *
     * @return void
     * @since 1.0.1
     */
    public function product_scripts() {
        if( is_product() ) {
            wp_enqueue_script( 'trademate-product-quantity' );
        }
    }
}
