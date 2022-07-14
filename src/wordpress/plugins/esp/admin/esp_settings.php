<?php

/*
 * ESP Plugin Setting Function
 */
function esp_register_settings() {
    add_option( 'esp_host', '');
    add_option( 'esp_env', '');
    add_option( 'esp_final', '');
    add_option( 'esp_apikey', '');
    add_option( 'esp_level', '1');
    add_option( 'esp_attributes', 'Base');
    add_option( 'esp_spidtype', null);
    register_setting( 'esp_options_group', 'esp_host', 'esp_callback' );
    register_setting( 'esp_options_group', 'esp_env', 'esp_callback' );
    register_setting( 'esp_options_group', 'esp_final', 'esp_callback' );
    register_setting( 'esp_options_group', 'esp_apikey', 'esp_callback' );
    register_setting( 'esp_options_group', 'esp_level', 'esp_callback' );
    register_setting( 'esp_options_group', 'esp_attributes', 'esp_callback' );
    register_setting( 'esp_options_group', 'esp_spidtype', 'esp_callback' );
}
add_action( 'admin_init', 'esp_register_settings' );

function esp_register_options_page() {
    add_menu_page(
        'Esp',
        'Esp Options',
        'manage_options',
        'esp',
        'esp_options_page'
    );
}

add_action( 'admin_menu', 'esp_register_options_page' );