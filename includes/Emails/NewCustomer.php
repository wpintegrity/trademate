<?php
namespace WpIntegrity\TradeMate\Emails;

use WC_Email;
/**
 * New Customer Email.
 *
 * Handles the email notifications sent when a new customer registers in the store.
 */
class NewCustomer extends WC_Email {

    /**
     * TradeMate Placeholders
     *
     * @var array
     */
    public $trademate_placeholders;

    /**
     * Default template path
     *
     * @var string
     */
    public $template_base;

    /**
     * Constructor.
     *
     * Initializes the email by setting up its properties and hooks.
     */
    public function __construct() {
        $this->id               = 'trademate_new_customer_registration';
        $this->title            = __( 'New Customer Registration', 'trademate' );
        $this->description      = __( 'This email will be sent to chosen recipient(s) when a new customer registers on the site.', 'trademate' );
        $this->template_html    = 'emails/new-customer-registration.php';
        $this->template_plain   = 'emails/plain/new-customer-registration.php';
        $this->template_base    = TRADEMATE_PATH . '/templates/';
        $this->trademate_placeholders = [
            '{username}'      => '',
            '{email}'         => '',
            '{user_edit_url}' => '',
        ];

        // Triggers for this email.
        add_action( 'woocommerce_created_customer', [ $this, 'trigger' ], 20 );

        // Call parent constructor.
        parent::__construct();

        // Other settings.
        $this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );
    }

    /**
     * Get email subject.
     *
     * @since 1.0.0
     * @return string Email subject.
     */
    public function get_default_subject() {
        return __( '[{site_title}] A new customer has been registered', 'trademate' );
    }

    /**
     * Get email heading.
     *
     * @since 1.0.0
     * @return string Email heading.
     */
    public function get_default_heading() {
        return __( 'New Customer Registered - {username}', 'trademate' );
    }

    /**
     * Get default message content
     *
     * @since 1.0.0
     * 
     * @return string
     */
    public function get_default_message() {
        // Start output buffering
        ob_start();
        ?>
        <p>
            <?php echo esc_html__( 'Hello there,', 'trademate' ); ?>
            <br>
            <?php 
                echo wp_kses_post( sprintf(
                    __( 'A new customer has been registered on your %s store.', 'trademate' ),
                    '{site_title}'
                ) );
            ?>
        </p>
        <p>
            <strong><?php echo esc_html__( 'Customer Details:', 'trademate' ); ?></strong>
        </p>
        <ul>
            <li>
                <?php 
                    echo wp_kses_post( sprintf(
                        '<strong>%1$s</strong> %2$s',
                        __( 'Customer:', 'trademate' ),
                        '{username}'
                    ) );
                ?>
            </li>
            <li>
                <?php 
                    echo wp_kses_post( sprintf(
                        '<strong>%1$s</strong> %2$s',
                        __( 'Email:', 'trademate' ),
                        '{email}'
                    ) );
                ?>
            </li>
        </ul>
        <p>
            <?php
                echo wp_kses_post( sprintf(
                    __( 'Click here to <a href="%s">edit customer details</a>.', 'trademate' ),
                    '{user_edit_url}'
                ) );
            ?>
        </p>
        <?php
        // Get the content from the buffer and store it in a variable
        $default_message = ob_get_clean();
    
        return $default_message;
    }

    /**
     * Trigger the sending of this email.
     * 
     * @since 1.0.0
     *
     * @param int $customer_id The ID of the newly registered customer.
     */
    public function trigger( $user_id ) {
        $this->setup_locale();

        $user         = get_user_by( 'id', $user_id );
        $this->object = $user;

        if ( $this->is_enabled() && $this->get_recipient() ) {
			$this->send(
                $this->get_recipient(),
                $this->get_subject(),
                $this->get_content(),
                $this->get_headers(),
                $this->get_attachments()
            );
		}

        $this->restore_locale();
    }

    /**
     * Get email content
     * 
     * @since 1.0.0
     *
     * @return string
     */
    public function get_message() {
		return $this->format_string( $this->get_option( 'message', $this->get_default_message() ) );
	}

    /**
     * Get the HTML content for the email.
     *
     * @access public
     * @return string HTML content.
     */
    public function get_content_html() {
        return wc_get_template_html(
            $this->template_html, 
            [
                'email_heading' => $this->get_heading(),
                'message'       => $this->get_message(),
                'sent_to_admin' => true,
                'plain_text'    => false,
                'email'         => $this,
            ],
            '',
            $this->template_base
        );
    }

    /**
     * Get the plain text content for the email.
     *
     * @access public
     * @return string Plain text content.
     */
    public function get_content_plain() {
        return wc_get_template_html(
            $this->template_plain, 
            [
                'email_heading' => $this->get_heading(),
                'message'       => $this->get_message(),
                'sent_to_admin' => true,
                'plain_text'    => true,
                'email'         => $this,
            ], 
            '',
            $this->template_base
        );
    }

    /**
     * Initialize settings form fields.
     *
     * Defines the settings form fields for the email configuration.
     */
    public function init_form_fields() {
        $placeholder_text = sprintf(
            /* Translators: %s: list of available placeholder tags */
            __( 'Available placeholders: %s', 'trademate' ),
            '<br/><code>' . implode( '</code>, <code>', array_keys( $this->placeholders ) ) . '</code><code>' . implode( '</code>, <code>', array_keys( $this->trademate_placeholders ) ) . '</code>'
        );

        $this->form_fields = array(
            'enabled' => array(
                'title'       => __( 'Enable/Disable', 'trademate' ),
                'type'        => 'checkbox',
                'label'       => __( 'Enable this email notification', 'trademate' ),
                'default'     => 'yes',
            ),
            'recipient' => array(
                'title'       => __( 'Recipient(s)', 'trademate' ),
                'type'        => 'text',
                /* translators: %s: admin email */
                'description' => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to %s.', 'trademate' ), '<code>' . esc_attr( get_option( 'admin_email' ) ) . '</code>' ),
                'placeholder' => '',
                'default'     => '',
                'desc_tip'    => true,
            ),
            'subject' => array(
                'title'       => __( 'Subject', 'trademate' ),
                'type'        => 'text',
                'desc_tip'    => false,
                'default'     => $this->get_default_subject(),
            ),
            'heading' => array(
                'title'       => __( 'Email heading', 'trademate' ),
                'type'        => 'text',
                'desc_tip'    => false,
                'default'     => $this->get_default_heading(),
            ),
            'message' => array(
                'title'       => __( 'Message', 'trademate' ),
                'type'        => 'trademate_email_wysiwyg',
                'desc_tip'    => false,
                'description' => $placeholder_text,
                'default'     => $this->get_default_message(),
            ),
            'email_type' => array(
                'title'       => __( 'Email type', 'trademate' ),
                'type'        => 'select',
                'description' => __( 'Choose which format of email to send.', 'trademate' ),
                'default'     => 'html',
                'class'       => 'email_type wc-enhanced-select',
                'options'     => $this->get_email_type_options(),
                'desc_tip'    => true,
            ),
        );
    }
}
