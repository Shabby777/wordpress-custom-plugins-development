<?php
/**
 * Plugin Name: Advanced Settings Hub
 * Description: A complete example of a Top-Level Menu, Sub-menus, and automated Settings API forms.
 * Version: 1.0
 * Author: WP Developer
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 1. REGISTER MENUS & SUB-MENUS
 */
add_action( 'admin_menu', 'ash_register_menus' );

function ash_register_menus() {
    // Main Parent Menu
    add_menu_page(
        'Plugin Hub',           // Page Title
        'Plugin Hub',           // Menu Title
        'manage_options',       // Capability
        'ash_main_menu',        // Slug
        'ash_main_page_html',   // Callback
        'dashicons-superhero',  // Icon
        30                      // Position
    );

    // Sub-menu: Settings (Uses the same slug as parent to appear as the first item)
    add_submenu_page(
        'ash_main_menu',
        'Settings',
        'Settings',
        'manage_options',
        'ash_main_menu', 
        'ash_main_page_html'
    );

    // Sub-menu: Help/Documentation
    add_submenu_page(
        'ash_main_menu',
        'Help Guide',
        'Help Guide',
        'manage_options',
        'ash_help_page',
        'ash_help_page_html'
    );
}

/**
 * 2. INITIALIZE SETTINGS API
 */
add_action( 'admin_init', 'ash_settings_init' );

function ash_settings_init() {
    // Register the setting to the 'options' database table
    register_setting( 'ash_settings_group', 'ash_options' );

    // Add a Section
    add_settings_section(
        'ash_section_general',
        'General Configuration',
        'ash_section_text',
        'ash_main_menu'
    );

    // Add Fields
    add_settings_field(
        'ash_field_name',
        'Company Name',
        'ash_render_text_field',
        'ash_main_menu',
        'ash_section_general'
    );

    add_settings_field(
        'ash_field_toggle',
        'Maintenance Mode',
        'ash_render_checkbox',
        'ash_main_menu',
        'ash_section_general'
    );
}

/**
 * 3. CALLBACK FUNCTIONS FOR FIELDS
 */
function ash_section_text() {
    echo '<p>Update your global plugin preferences below.</p>';
}

function ash_render_text_field() {
    $options = get_option( 'ash_options' );
    $val = $options['ash_field_name'] ?? '';
    echo '<input type="text" name="ash_options[ash_field_name]" value="' . esc_attr($val) . '" class="regular-text" placeholder="e.g. Acme Corp">';
}

function ash_render_checkbox() {
    $options = get_option( 'ash_options' );
    $checked = isset($options['ash_field_toggle']) ? checked(1, $options['ash_field_toggle'], false) : '';
    echo '<input type="checkbox" name="ash_options[ash_field_toggle]" value="1" ' . $checked . '> <label>Enable site-wide maintenance notice</label>';
}

/**
 * 4. PAGE HTML RENDERING
 */
function ash_main_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'ash_settings_group' );
            do_settings_sections( 'ash_main_menu' );
            submit_button( 'Save All Changes' );
            ?>
        </form>
    </div>
    <?php
}

function ash_help_page_html() {
    ?>
    <div class="wrap">
        <h1>Documentation & Help</h1>
        <div class="card">
            <h2>Need Support?</h2>
            <p>To use the data saved in the settings page elsewhere in your theme or plugin, use this code:</p>
            <code>$data = get_option('ash_options');</code>
        </div>
    </div>
    <?php
}
