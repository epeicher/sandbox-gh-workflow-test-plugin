<?php
/**
 * Plugin Name: Test Plugin
 * Plugin URI: https://example.com/test-plugin
 * Description: A simple WordPress plugin for testing purposes.
 * Version: 1.0.0
 * Author: Test Author
 * Author URI: https://example.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: test-plugin
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add a simple admin notice to verify the plugin is active
 */
function test_plugin_admin_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e( 'Test Plugin is active and working!', 'test-plugin' ); ?></p>
    </div>
    <?php
}
add_action( 'admin_notices', 'test_plugin_admin_notice' );

/**
 * Register a simple shortcode [test_plugin]
 */
function test_plugin_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'message' => 'Hello from Test Plugin!',
        ),
        $atts,
        'test_plugin'
    );

    return '<div class="test-plugin-output">' . esc_html( $atts['message'] ) . '</div>';
}
add_shortcode( 'test_plugin', 'test_plugin_shortcode' );
