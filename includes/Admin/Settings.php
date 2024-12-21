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
     * Get Post Type array
     *
     * @since 1.0.1
     *
     * @param string $post_type
     *
     * @return array
     */
    public function get_post_type( $post_type ) {
        $pages_array = [];
        $pages       = get_posts(
            [
                'post_type'   => $post_type,
                'numberposts' => - 1,
            ]
        );

        if ( $pages ) {
            foreach ( $pages as $page ) {
                $pages_array[ $page->ID ] = $page->post_title;
            }
        }

        return $pages_array;
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
            [
                'id'    => 'trademate_account',
                'title' => __( 'Account', 'trademate' ),
                'icon'  => 'pi-user'
            ],
            [
                'id'    => 'trademate_shipping',
                'title' => __( 'Shipping', 'trademate' ),
                'icon'  => 'pi-truck'
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
        $pages_array = $this->get_post_type( 'page' );

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
            'external_product_new_tab' => [
                'name'        => 'external_product_new_tab',
                'label'       => __( 'External Product New Tab', 'trademate' ),
                'description' => __( 'Open External/Affiliate Type Products in a new tab', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
            ],
            'replace_quantity_steppers' => [
                'name'        => 'replace_quantity_steppers',
                'label'       => __( 'Replace Quantity Steppers', 'trademate' ),
                'description' => __( 'Add Plus/Minus Button to increase or decrease quantity field value', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
            ],
            'change_cart_button_text' => [
                'name'        => 'change_cart_button_text',
                'label'       => __( 'Change Cart Button Text', 'trademate' ),
                'description' => __( 'Add/Change your own Add to Cart button text', 'trademate' ),
                'type'        => 'text',
                'default'     => ''
            ],
            'out_of_stock_badge' => [
                'name'        => 'out_of_stock_badge',
                'label'       => __( 'Out of Stock Badge', 'trademate' ),
                'description' => __( 'Show "Out of Stock" badge on the Shop and Single Product pages', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
            ],
            'product_sales_countdown' => [
                'name'        => 'product_sales_countdown',
                'label'       => __( 'Product Sales Countdown Timer', 'trademate' ),
                'description' => __( 'Add a sales countdown timer on the Shop and Single Product pages', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
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

        $account_options = [
            'my_account_reg_tnc' => [
                'name'        => 'my_account_reg_tnc',
                'label'       => __( 'Terms & Conditions', 'trademate' ),
                'description' => __( 'Add Terms & Condition checkbox on the My Account registration form', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off',
                'children'    => 'my_account_reg_tnc_page'
            ],
            'my_account_reg_tnc_page' => [
                'name'        => 'my_account_reg_tnc_page',
                'label'       => __( 'Terms & Conditions Page', 'trademate' ),
                'description' => __( 'Select the Terms & Conditions Page', 'trademate' ),
                'type'        => 'dropdown',
                'options'     => $pages_array,
                'default'     => ''
            ],
        ];

        $shipping_options = [
            'hide_shipping_methods' => [
                'name'        => 'hide_shipping_methods',
                'label'       => __( 'Hide Shipping Methods', 'trademate' ),
                'description' => __( 'Hide other shipping methods when Free Shipping is available on the cart', 'trademate' ),
                'type'        => 'switch',
                'default'     => 'off'
            ],
        ];

        $settings_fields = [
            'trademate_product' => apply_filters( 'trademate_product_options', $product_options ),
            'trademate_cart'    => apply_filters( 'trademate_cart_options', $cart_options ),
            'trademate_emails'  => apply_filters( 'trademate_email_options', $email_options ),
            'trademate_account' => apply_filters( 'trademate_account_options', $account_options ),
            'trademate_shipping'=> apply_filters( 'trademate_shipping_options', $shipping_options ),
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
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_send_json_error( __( 'You do not have permission to save these settings', 'trademate' ) );
            return;
        }
    
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['nonce'] ) ), 'trademate_admin' ) ) {
            wp_send_json_error( __( 'Invalid nonce', 'trademate' ) );
            return;
        }
    
        if ( empty( $_POST['section'] ) || ! isset( $_POST['settingsData'] ) ) {
            wp_send_json_error( __( 'Missing section or settings data', 'trademate' ) );
            return;
        }
    
        $section = sanitize_text_field( wp_unslash( $_POST['section'] ) );
        $settings_data = json_decode( sanitize_text_field( wp_unslash( $_POST['settingsData'] ) ), true );
    
        if ( is_null( $settings_data ) ) {
            wp_send_json_error( __( 'Invalid settings data format', 'trademate' ) );
            return;
        }
    
        foreach ( $settings_data as $key => $value ) {
            foreach ( $this->get_settings_fields() as $section_id => $section_fields ) {
                if ( isset( $section_fields[ $key ] ) ) {
                    if ( $section_fields[ $key ]['type'] === 'dropdown' ) {
                        $settings_data[$key] = sanitize_text_field( $value );
                    } else {
                        $settings_data[$key] = sanitize_text_field( $value );
                    }
                }
            }
        }
    
        $existing_settings = get_option( 'trademate_settings', [] );
        $existing_settings[$section] = $settings_data;
    
        update_option( 'trademate_settings', $existing_settings );
    
        wp_send_json_success( __( 'Settings saved successfully', 'trademate' ) );
    }
}