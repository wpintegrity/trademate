<?php
namespace WpIntegrity\TradeMate\Product;

use WpIntegrity\TradeMate\Helper;

/**
 * Stock Functions Manager Class.
 *
 * Manages default product stock and sold individually settings.
 * 
 * @since 1.0.0
 */
class Stock {

    /**
     * @var bool Whether the product is sold individually.
     * 
     * @since 1.0.0
     */
    private $is_sold_individually = false;

    /**
     * Constructor function.
     *
     */
    public function __construct() {
        add_action( 'save_post_product', [ $this, 'default_product_stock' ] );
        add_action( 'woocommerce_is_sold_individually', [ $this, 'product_sold_individually' ] );
        add_filter( 'woocommerce_cart_item_quantity', [ $this, 'cart_product_quantity' ] );
    }

    /**
     * Set default product stock.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID of the product being saved.
     */
    public function default_product_stock( $post_id ) {
        $product_stock = Helper::get_option( 'default_product_stock', 'trademate_product' );

        $post_author   = get_post_field( 'post_author', $post_id );
        $user          = get_userdata( $post_author );
        $user_roles    = $user->roles;

        if ( $product_stock > 0 && in_array( 'administrator', $user_roles ) ) {
            update_post_meta( $post_id, '_manage_stock', 'yes' );
            update_post_meta( $post_id, '_stock', $product_stock );
        }
    }

    /**
     * Filter whether a product is sold individually.
     *
     * @since 1.0.0
     *
     * @param bool   $individually Whether the product is sold individually.
     * @return bool  Whether the product is sold individually.
     */
    public function product_sold_individually( $individually ) {
        $woo_sold_individually   = Helper::get_option( 'product_individual_sale', 'trademate_product' );
    
        if ( 'yes' === $woo_sold_individually ) {
            $this->is_sold_individually = true; // Set the class property to true if sold individually
            $individually = true;
        }
    
        return $individually;
    }
    
    /**
     * Return cart quantity based on the product_sold_individually function
     * 
     * @since 1.0.0
     *
     * @param int $product_quantity
     * @return void
     */
    public function cart_product_quantity( $product_quantity ) {
        if( $this->is_sold_individually === true ) {
            $product_quantity = 1;
        }
        
        return $product_quantity;
    }
}
