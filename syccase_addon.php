<?php
/*
Plugin Name: SYC case addon
Plugin URI: https://syccase.co.uk/plugin
Description: constol with version control
Version: 1.0
Author: Your Name
Author URI: https://twindai.com
License: GPL2
*/


// Enqueue a custom script
function my_custom_plugin_scripts() {
    wp_enqueue_script('my-custom-script', plugins_url('js/custom-script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'my_custom_plugin_scripts');
