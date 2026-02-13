<?php
/**
 * Plugin Name: Admin Dashboard Quick Note
 * Description: Adds a custom widget to the WordPress Admin Dashboard.
 * Version: 1.0
 * Author: Shubham Chendake
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Function that defines the content of the dashboard widget.
 */
function adn_dashboard_widget_content() {
    echo "<p><strong>Site Status:</strong> All systems operational.</p>";
    echo "<p>Remember to check for pending comments and update your plugins regularly!</p>";
    echo "<a href='" . admin_url('plugins.php') . "' class='button button-primary'>Manage Plugins</a>";
}

/**
 * Registers the widget with WordPress.
 */
function adn_add_dashboard_widgets() {
    wp_add_dashboard_widget(
        'adn_quick_note_widget',         // Widget slug (unique ID)
        'Internal Site Note',            // Widget title
        'adn_dashboard_widget_content'   // Callback function to display content
    );
}

// Hook into 'wp_dashboard_setup' to add the widget
add_action( 'wp_dashboard_setup', 'adn_add_dashboard_widgets' );
