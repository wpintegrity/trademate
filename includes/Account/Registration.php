<?php
namespace WpIntegrity\TradeMate\Account;

use WpIntegrity\TradeMate\Helper;
use WP_Error;

/**
 * Registration Functions Manager Class.
 *
 * Manages registration-related functionalities, such as terms and conditions checkbox and validation.
 * 
 * @since 1.0.1
 */
class Registration {

    /**
     * Constructor function.
     *
     * Initializes actions for managing registration form.
     */
    public function __construct() {
        add_action( 'woocommerce_register_form', [ $this, 'terms_conditions' ], 9 );
        add_action( 'woocommerce_process_registration_errors', [ $this, 'terms_and_conditions_validation' ], 10, 3 );
    }
    
    /**
     * Add a checkbox to the registration form that the user must check to register.
     *
     * @since 1.0.1
     */
    public function terms_conditions() {
        $terms_conditions      = Helper::get_option( 'my_account_reg_tnc', 'trademate_account' );
        $terms_conditions_page = Helper::get_option( 'my_account_reg_tnc_page', 'trademate_account' );

        if ( $terms_conditions ): ?>
            <div class="trademate_wc_tnc">
                <input type="checkbox" id="trademate_terms_conditions" name="trademate_terms_conditions" required> 
                <label for="trademate_terms_conditions">
                    <?php 
                        /* translators: %s: terms & condition permalink url */
                        echo wp_kses_post( sprintf( __( 'I have read and agree to the <a target="_blank" href="%s">Terms &amp; Conditions</a>.', 'trademate' ), get_permalink( $terms_conditions_page ) ) );
                    ?>
                </label>
            </div>
        <?php endif;
    }

    /**
     * Validate the terms and conditions checkbox during registration.
     *
     * @since 1.0.1
     *
     * @param WP_Error $errors Registration errors object.
     * @return WP_Error Modified registration errors object.
     */
    public function terms_and_conditions_validation( $errors ) {
        $nonce_value = isset( $_POST['_wpnonce'] ) ? wp_unslash( $_POST['_wpnonce'] ) : '';
        $nonce_value = isset( $_POST['woocommerce-register-nonce'] ) ? wp_unslash( $_POST['woocommerce-register-nonce'] ) : $nonce_value;

        // Only perform validation for 'customer' role and valid nonce.
        if ( ! isset( $_POST['role'] ) || 'customer' !== $_POST['role'] || ! wp_verify_nonce( $nonce_value, 'woocommerce-register' ) ) {
            return $errors;
        }

        if ( Helper::get_option( 'my_account_reg_tnc', 'trademate_account' ) ) {
            if ( empty( $_POST['trademate_terms_conditions'] ) ) {
                error_log( 'Terms and conditions not accepted.' );
                $errors->add( 'terms_error', __( 'Please read and accept the terms and conditions before registration', 'trademate' ) );
            } else {
                error_log( 'Terms and conditions accepted.' );
            }
        }

        return $errors;
    }
    
}
