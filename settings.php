<?php

// register settings
function http_to_https_init() {
    // instructions section
    add_settings_section(
        'http_to_https_instructions', // id
        __( 'Instructions', 'http-to-https' ), // section title
        'http_to_https_instructions_cb', // callback
        'http_to_https_settings_page' // slug-name of the settings page
    );
    // settings section
    add_settings_section(
        'http_to_https_details', // id
        __( 'Site details', 'http-to-https' ), // section title
        'http_to_https_details_cb', // callback
        'http_to_https_settings_page' // slug-name of the settings page
    );
    // settings section
    add_settings_section(
        'http_to_https_settings', // id
        __( 'Settings', 'http-to-https' ), // section title
        'http_to_https_settings_cb', // callback
        'http_to_https_settings_page' // slug-name of the settings page
    );

    // src field
    add_settings_field(
        'http_to_https_src', // id
        __( 'Replace images and attachments URLs', 'http-to-https' ), // field title
        'http_to_https_src_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // href field
    add_settings_field(
        'http_to_https_href', // id
        __( 'Replace links URLs', 'http-to-https' ), // field title
        'http_to_https_href_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // pingbacks field
    add_settings_field(
        'http_to_https_pingbacks', // id
        __( 'Replace pingbacks URLs', 'http-to-https' ), // field title
        'http_to_https_pingbacks_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // comments field
    add_settings_field(
        'http_to_https_comments', // id
        __( 'Replace URLs in comments', 'http-to-https' ), // field title
        'http_to_https_comments_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // postmeta field
    add_settings_field(
        'http_to_https_postmeta', // id
        __( 'Replace postmeta URLs', 'http-to-https' ), // field title
        'http_to_https_postmeta_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // site URL
    add_settings_field(
        'http_to_https_siteurl', // id
        __( 'Replace site URL', 'http-to-https' ), // field title
        'http_to_https_siteurl_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // home URL
    add_settings_field(
        'http_to_https_home', // id
        __( 'Replace home URL', 'http-to-https' ), // field title
        'http_to_https_home_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );
    // simulate field
    add_settings_field(
        'http_to_https_simulate', // id
        __( 'Simulate replacement', 'http-to-https' ), // field title
        'http_to_https_simulate_cb', // callback
        'http_to_https_settings_page', // slug-name of the settings page on which to show the field
        'http_to_https_settings' // slug-name of the section of the settings page in which to show the box
    );

    $args = array(
        'sanitize_callback' => 'http_to_https_setting_errors',
        );
    register_setting(
        'http_to_https_settings_page', // group name
        'http_to_https', // option name
        $args
    );
}
add_action( 'admin_init', 'http_to_https_init' );
