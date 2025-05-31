<?php
/**
 * Plugin Name:       Ekomart Custom Addons
 * Description:       Custom widgets for Ekomart Ecommerce Theme.
 * Version:           1.0.0
 * Author:            Abdullah Nahian
 * Author URI:        https://devnahian.com/
 * Text Domain:       ekomart-elementor
 * Requires Plugins:  elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'EKA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EKA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'EKA_PLUGIN_VERSION', '1.0.0' );

final class Ekomart_Addon {

	public function __construct() {
		// Check if Elementor is loaded before initializing
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// Check if Elementor is active and loaded
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
			return;
		}

		// Load widget files
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}

	public function admin_notice_missing_elementor() {
		echo '<div class="notice notice-warning is-dismissible"><p>';
		esc_html_e( 'Elementor Addon requires Elementor to be installed and activated.', 'elementor-addon' );
		echo '</p></div>';
	}

	public function register_widgets( $widgets_manager ) {
		require_once EKA_PLUGIN_DIR . 'widgets/breadcumb-widget.php';

		$widgets_manager->register( new \Ekomart_Breadcumb() );
	}
}

add_action( 'elementor/elements/categories_registered', 'register_custom_widget_category' );

function register_custom_widget_category( $elements_manager ) {
    $elements_manager->add_category(
        'ekomart-category',
        [
            'title' => __( 'Ekomart Widgets', 'elementor-addon' ),
            'icon'  => 'fa fa-plug', // Optional: any FontAwesome icon class
        ]
    );
}


// Instantiate the plugin class
new Ekomart_Addon();
