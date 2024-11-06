<?php
/**
 * New Customer Email.
 *
 * An email sent to the admin when a new customer is registered.
 * 
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email );

echo $email->get_message();

do_action( 'woocommerce_email_footer', $email );
