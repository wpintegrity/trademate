<?php
namespace WpIntegrity\TradeMate\Admin;

/**
 * Settings handler class
 * 
 * @since 1.0.0
 */
class Settings {
    /**
     * Class Constructor
     */
    public function __construct() {
        add_filter( 'trademate_settings_localized_scripts', [ $this, 'settings_localize_data' ] );
        add_action( 'wp_ajax_get_trademate_settings', [ $this, 'get_settings_values' ] );
        add_action( 'wp_ajax_save_trademate_settings', [ $this, 'save_settings_values' ] );
    }

    /**
     * Load settings sections and fields
     *
     * @since 1.0.0
     *
     * @param $data
     * 
     * @return mixed
     */
    public function settings_localize_data( $data ) {
        $data[ 'settings_sections' ] = $this->get_settings_sections();

        // Load all settings from a single option
        $stored_settings = get_option( 'trademate_settings', [] );

        $settings_fields = [];

        foreach( $this->get_settings_fields() as $key => $section_fields ) {
            foreach( $section_fields as $settings_key => $value ) {
                $value['value'] = isset( $stored_settings[$key][$value['name']] ) ? $stored_settings[$key][$value['name']] : $value['default'];
                $settings_fields[$key][$value['name']] = $value;
            }
        }

        $data[ 'settings_fields' ] = $settings_fields;

        return $data;
    }

    /**
     * Get all settings Sections
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_settings_sections() {
        $sections = [
            [
                'id'    => 'trademate_product',
                'title' => __( 'Product', 'trademate' ),
                'icon'  => 'pi-box'
            ],
            [
                'id'    => 'trademate_cart',
                'title' => __( 'Cart', 'trademate' ),
                'icon'  => 'pi-shopping-cart'
            ],
            [
                'id'    => 'trademate_emails',
                'title' => __( 'Emails', 'trademate' ),
                'icon'  => 'pi-envelope'
            ],
        ];

        return apply_filters( 'trademate_settings_sections', $sections );
    }

    /**
     * Returns all the settings fields
     *
     * @since 1.0.0
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $product_options = [
            'default_product_stock' => [
                'name'        => 'default_product_stock',
                'label'       => __( 'Default Product Stock', 'trademate' ),
                'description' => __( 'Insert default product stock amount', 'trademate' ),
                'type'        => 'number',
                'default'     => ''
            ],
            'product_individual_sale' => [
                'name'        => 'product_individual_sale',
                'label'       => __( 'Product Individual Sale', 'trademate' ),
                'description' => __( 'Allow only one item to be bought in a single order', 'trademate' ),
                'type'        => 'select',
                'placeholder' => __( 'Choose one...', 'trademate' ),
                'default'     => 'no',
                'options'     => [
                    [
                        'value' => 'no',
                        'label' => __( 'No', 'trademate' )
                    ],
                    [
                        'value' => 'yes',
                        'label' => __( 'Yes', 'trademate' )
                    ]
                ]
            ],
        ];

        $cart_options = [
            'clear_cart_button' => [
                'name'        => 'clear_cart_button',
                'label'       => __( 'Clear Cart Button', 'trademate' ),
                'description' => __( 'Add a clear cart button on the cart page to empty the entire cart with one click', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
            ]
        ];

        $email_options = [
            'new_customer_registration_email' => [
                'name'        => 'new_customer_registration_email',
                'label'       => __( 'New Customer Registration Email', 'trademate' ),
                'description' => __( 'Get new customers registration email to the admin email', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
            ],
        ];

        $settings_fields = [
            'trademate_product' => apply_filters( 'trademate_product_options', $product_options ),
            'trademate_cart'    => apply_filters( 'trademate_cart_options', $cart_options ),
            'trademate_emails'  => apply_filters( 'trademate_email_options', $email_options ),
        ];

        return apply_filters( 'trademate_settings_fields', $settings_fields );
    }

    /**
     * Get settings value
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get_settings_values() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_send_json_error( __( 'You have no permission to get settings value', 'trademate' ) );
        }

        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'trademate_admin' ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'trademate' ) );
        }
        // Initialize an empty array to store settings
        $settings = [];

        // Fetch the main option that holds all settings
        $stored_settings = get_option( 'trademate_settings', [] ); // Fetch the full 'trademate_settings' option

        // Loop through each section and fetch its settings from the stored array
        foreach ( $this->get_settings_sections() as $key => $section ) {
            $section_id = $section['id'];

            // Check if settings for this section exist in the stored settings array
            $section_settings = isset( $stored_settings[ $section_id ] ) ? $stored_settings[ $section_id ] : [];

            // Apply filters (if needed) and store the settings for the section
            $settings[ $section_id ] = apply_filters( 'trademate_get_settings_values', $section_settings );
        }

        wp_send_json_success( $settings );
    }

    /**
     * Save settings value
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function save_settings_values() {
        // Check user capability
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_send_json_error( __( 'You do not have permission to save these settings', 'trademate' ) );
            return;
        }

        // Verify nonce
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'trademate_admin' ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'trademate' ) );
            return;
        }

        // Ensure the section and settings data are present
        if ( empty( $_POST['section'] ) || ! isset( $_POST['settingsData'] ) ) {
            wp_send_json_error( __( 'Missing section or settings data', 'trademate' ) );
            return;
        }

        // Get and sanitize the submitted data
        $section = sanitize_text_field( wp_unslash( $_POST['section'] ) );
        $settings_data = json_decode( sanitize_text_field( wp_unslash( $_POST['settingsData'] ) ), true );

        if ( is_null( $settings_data ) ) {
            wp_send_json_error( __( 'Invalid settings data format', 'trademate' ) );
            return;
        }

        // Save the settings in the database (using 'trademate_settings' option)
        $existing_settings = get_option( 'trademate_settings', [] );
        $existing_settings[$section] = $settings_data;

        // Update the option with the new settings
        update_option( 'trademate_settings', $existing_settings );

        // Return a success response
        wp_send_json_success( __( 'Settings saved successfully', 'trademate' ) );
    }
}