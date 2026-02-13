<?php
/*
Plugin Name: Custom Footer Message
Description: Adds a custom message in the website footer.
Version: 1.0
Author: Shubham Chendake
*/

function add_custom_footer_message() {
    echo '<p style="text-align:center; padding:15px; background:#f4f4f4;">
    © ' . date("Y") . ' | Designed & Developed by Shubham Chendake <br> (added via Custom Footer plugin ;-))
    </p>';
}

add_action('wp_footer', 'add_custom_footer_message');
