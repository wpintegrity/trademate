<?php
/**
 * New Customer Email ( plain text )
 *
 * An email sent to the admin when a new customer is registered.
 *
 */

 defined( 'ABSPATH' ) || exit;

 echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n";
 echo esc_html( wp_strip_all_tags( $email_heading ) );
 echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo esc_html( wp_strip_all_tags( wptexturize( preg_replace( '/\<br(\s*)?\/?\>/i', "\n", $email->get_message() ) ) ) ) . "\n\n";

echo "\n\n----------------------------------------\n\n";

echo esc_html( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) );
