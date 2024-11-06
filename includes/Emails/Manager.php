<?php
namespace WpIntegrity\TradeMate\Emails;

use WP_User;
use WpIntegrity\TradeMate\Helper;

/**
 * Handles email sending for TradeMate.
 * 
 * @since 1.0.0
 */
class Manager {

    /**
     * Constructor sets up actions.
     * 
     * @since 1.0.0
     */
    public function __construct() {
        $new_customer_registration_email = Helper::get_option( 'new_customer_registration_email', 'trademate_emails' );

        if ( $new_customer_registration_email === true ) {
            add_filter( 'woocommerce_email_classes', [ $this, 'register_trademate_emails_classes' ] );
        }
        
        add_filter( 'woocommerce_generate_trademate_email_wysiwyg_html', [ $this, 'render_email_wysiwyg_html' ], 10, 4 );
        add_filter( 'woocommerce_email_format_string', [ $this, 'trademate_woocommerce_email_format_string' ], 10, 2 );
        add_filter( 'woocommerce_template_directory', [ $this, 'set_email_template_directory' ], 10, 2 );
        add_filter( 'woocommerce_email_actions', [ $this, 'register_email_actions' ] );
        add_action( 'admin_footer', [ $this, 'trademate_email_settings_js' ] );
    }

    /**
     * Add TradeMate email classes to WooCommerce email classes.
     * 
     * @since 1.0.0
     *
     * @param array $email_classes Existing WooCommerce email classes.
     * @return array Modified WooCommerce email classes.
     */
    public function register_trademate_emails_classes( $email_classes ) {
        require_once TRADEMATE_INC . '/Emails/NewCustomer.php';

        $email_classes['TradeMate_New_Customer'] = new NewCustomer();

        return $email_classes;
    }

    /**
     * Get the "from" name for the email.
     * 
     * @since 1.0.0
     *
     * @return string The name used in the "from" field of the email.
     */
    public function get_from_name() {
        return wp_specialchars_decode( esc_html( get_option( 'woocommerce_email_from_name' ) ), ENT_QUOTES );
    }

    /**
     * Render whysiwyg editor for TradeMate email content.
     * 
     * @since 1.0.0
     *
     * @param string $field_html
     * @param string $key
     * @param array $data
     * @param object $wc_settings
     * 
     * @return string
     */
    public function render_email_wysiwyg_html( $field_html, $key, $data, $wc_settings ) {
        ob_start();
        ?>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="<?php echo esc_attr( $key ); ?>">
                    <?php echo wp_kses_post( $data['title'] ); ?>
                    <?php echo wp_kses_post( $wc_settings->get_tooltip_html( $data ) ); ?>
                </label>
            </th>
            <td class="forminp forminp-<?php echo esc_attr( sanitize_title( $data['type'] ) ); ?>">
                <fieldset>
                    <?php
                        wp_editor(
                            html_entity_decode( $wc_settings->get_option( $key, $data['default'] ) ),
                            $wc_settings->id,
                            [
                                'wpautop'       => false,
                                'textarea_name' => 'woocommerce_' . $wc_settings->id . '_' . $key,
                                'textarea_rows' => 12,
                                'editor_css'    => '<style type="text/css">div#wp-' . $wc_settings->id . '-wrap{width: 600px;}</style>',
                            ]
                        );
                    ?>
                </fieldset>
                <div class="trademate-email-wysiwyg-desc">
                    <?php echo wp_kses_post( $wc_settings->get_description_html( $data ) ); ?>
                </div>
            </td>
        </tr>
        <?php

        return ob_get_clean();
    }

    /**
     * Format email strings, replace email content placeholders with proper values
     * 
     * @since 1.0.0
     *
     * @param string $find_replace
     * @param Object $wc_email
     * @return array
     */
    public function trademate_woocommerce_email_format_string( $find_replace, $wc_email ) {
        $trademate_email_ids = [
            'trademate_new_customer_registration'
        ];

        if( in_array( $wc_email->id, $trademate_email_ids, true ) ) {
            $find    = array_keys( $wc_email->trademate_placeholders );
            $replace = array();

            if ( in_array( '{username}', $find, true ) ) {
                $replace[ array_search( '{username}', $find, true ) ] = $wc_email->object->data->user_login;
            }

            if ( in_array( '{email}', $find, true ) ) {
                $replace[ array_search( '{email}', $find, true ) ] = $wc_email->object->data->user_email;
            }

            if ( in_array( '{user_edit_url}', $find, true ) ) {
                $replace[ array_search( '{user_edit_url}', $find, true ) ] = admin_url( 'user-edit.php?user_id=' . $wc_email->object->data->ID );
            }

            return str_replace( $find, $replace, $find_replace );
        }

        return $find_replace;
    }

    /**
     * Set the template override directory for TradeMate emails.
     * 
     * @since 1.0.0
     *
     * @param string $template_dir The existing template directory.
     * @param string $template The template name.
     * @return string The modified template directory.
     */
    public function set_email_template_directory( $template_dir, $template ) {
        $trademate_emails = [
            'new-customer-registration.php'
        ];

        $template_name = basename( $template );

        if ( in_array($template_name, $trademate_emails, true) ) {
            return 'trademate';
        }

        return $template_dir;
    }

    /**
     * Register TradeMate email actions for WooCommerce.
     * 
     * @since 1.0.0
     *
     * @param array $actions Existing WooCommerce email actions.
     * @return array Modified WooCommerce email actions.
     */
    public function register_email_actions( $actions ) {
        $trademate_email_actions = [
            'trademate_new_customer_registration'
        ];

        foreach ($trademate_email_actions as $action) {
            $actions[] = $action;
        }

        return $actions;
    }

    /**
     * Remove disable props of WPEdtior on Change
     *
     * @return void
     */
    public function trademate_email_settings_js() {
        // phpcs:disable WordPress.Security.NonceVerification.Recommended
        if ( 
            isset( $_GET['tab'], $_GET['section'] )
            &&$_GET['tab'] === 'email' 
            && $_GET['section'] === 'trademate_new_customer'
        ) { ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    if (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor) {
                        tinyMCE.activeEditor.on('change keyup', function() {
                            $('.woocommerce-save-button').prop('disabled', false); // Enable Save button
                        });
                    }
                });
            </script>
        <?php }
        // phpcs:enable
    }
}