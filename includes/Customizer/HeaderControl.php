<?php

namespace WpIntegrity\TradeMate\Customizer;

/**
 * The radio image class.
 */
class HeaderControl extends \WP_Customize_Control {

    /**
     * Declare the control type.
     *
     * @var string
     */
    public $type = 'trademate-header';

    /**
     * Render the control's content.
     *
     * @see WP_Customize_Control::render_content()
     */
    protected function render_content() {
        ?>
        <?php if ( ! empty( $this->label ) ) { ?>
            <hr>
            <h2><?php echo esc_html( $this->label ); ?></h2>
        <?php } ?>

        <?php if ( ! empty( $this->description ) ) { ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post( $this->description ); ?>
            </span>
            <hr>
        <?php } ?>
        <?php
    }
}
