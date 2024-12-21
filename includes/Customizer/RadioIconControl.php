<?php
namespace WpIntegrity\TradeMate\Customizer;

/**
 * Radio Icon Control Class
 */
class RadioIconControl extends \WP_Customize_Control {
    /**
     * Declare the control type.
     *
     * @var string
     */
    public $type = 'trademate-radio-icon';

    /**
     * Enqueue scripts and styles for the custom control.
     */
    public function enqueue() {
        // Inline styles for the custom control
        add_action('customize_controls_print_styles', [$this, 'print_radio_style']);
    }

    /**
     * Print inline styles for the custom control.
     */
    public function print_radio_style() {
        ?>
        <style>
            .trademate-radio-buttons label {
                display: inline-block;
                margin-right: 10px;
                cursor: pointer;
            }

            .trademate-radio-buttons label input {
                display: none;
            }

            .trademate-radio-buttons label span.dashicons {
                display: inline-block;
                padding: 5px;
                background: #f1f1f1;
                border: 1px solid #ccc;
                border-radius: 4px;
                color: #555;
                transition: background 0.3s, color 0.3s;
            }

            .trademate-radio-buttons label input:checked + span.dashicons {
                background: #0073aa;
                color: #fff;
                border-color: #0073aa;
            }

            .trademate-radio-buttons label:hover span.dashicons {
                background: #e5e5e5;
            }
        </style>
        <?php
    }

    /**
     * Render the Customizer control.
     */
    public function render_content() {
        if (empty($this->choices)) {
            return;
        }
        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
        </label>
        <div id="input_<?php echo esc_attr($this->id); ?>" class="trademate-radio-buttons">
            <?php foreach ($this->choices as $value => $icon_class) : ?>
                <label>
                    <input
                        type="radio"
                        name="_customize-radio-<?php echo esc_attr($this->id); ?>"
                        value="<?php echo esc_attr($value); ?>"
                        <?php $this->link(); ?>
                        <?php checked($this->value(), $value); ?>
                    />
                    <span class="dashicons <?php echo esc_attr($icon_class); ?>"></span>
                </label>
            <?php endforeach; ?>
        </div>
        <?php
    }
}