<?php
/*
Plugin Name: Custom Greeting
Description: Displays a greeting using a shortcode.
Version: 1.0
Author: Shubham
*/

function greeting_shortcode() {
    return "<h3>Hello, welcome to my website!</h3>";
}
add_shortcode('greeting', 'greeting_shortcode');
