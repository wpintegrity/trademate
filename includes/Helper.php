<?php
namespace WpIntegrity\TradeMate;

class Helper {
    
    /**
     * Get the value of a settings field
     *
     * @param string $option settings field name
     * @param string $section the section name this field belongs to
     * @param mixed $default default value if the option is not found
     *
     * @return mixed
     */
    public static function get_option( $option, $section, $default = '' ) {
        // Define the option name in the database
        $option_name = 'trademate_settings';
    
        // Get the serialized option value from the database
        $serialized_options = get_option( $option_name );
    
        // Unserialize the option value
        $options = maybe_unserialize( $serialized_options );
    
        // Check if the section exists in the options array
        if ( isset( $options[ $section ] ) && is_array( $options[ $section ] ) ) {
            // Return the specific option value from the section or default if not set
            return $options[ $section ][ $option ] ?? $default;
        }
    
        // Return default if section or option is not set
        return $default;
    }

    /**
     * Get the template file from the templates directory.
     *
     * @param string $template_name The name of the template file.
     * @param array  $args          Optional. An array of arguments to pass to the template file.
     * @param string $template_path Optional. The path to the templates directory.
     * @param string $default_path  Optional. The default path to the templates directory.
     */
    public static function get_templates( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
        if ( ! empty( $args ) && is_array( $args ) ) {
            extract( $args );
        }

        $template_path  = $template_path ? $template_path : 'trademate/templates/';
        $default_path   = $default_path ? $default_path : TRADEMATE_PATH . '/templates/';

        // Look within the passed path within the theme - this allows overriding.
        $template = locate_template( array( trailingslashit( $template_path ) . $template_name ) );

        // Get default template.
        if ( ! $template ) {
            $template = $default_path . $template_name;
        }

        // Allow 3rd party plugins to filter template file from their plugin.
        $template = apply_filters( 'trademate_get_templates', $template, $template_name, $args, $template_path, $default_path );

        if ( file_exists( $template ) ) {
            include $template;
        } else {
            // Translators: %s is the HTML code element representing the template name.
            _doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'trademate' ), '<code>' . $template . '</code>' ), '1.0' );
        }
    }
}
