<?php

// instructions section
function http_to_https_instructions_cb() {
    ?>
    <p><?php _e( 'Select one or more of the options below and click the "Replace URLs" button. Only the URLs that point to your own site will be replaced. No URL pointing outside of your site will be replaced.', 'http-to-https' ); ?></p>
    <p><?php _e( '<b>WARNING:</b> Changing the site URL without having an SSL certificate installed will break your site. You can find more information about the site URL', 'http-to-https' ); ?> <a href="https://codex.wordpress.org/Changing_The_Site_URL" target="_blank"><?php _e( 'here', 'http-to-https' ); ?></a>.</p>
    <p><?php _e( '<b>NOTE:</b> This plugin does not change URLs in the', 'http-to-https' )?> <a href="https://codex.wordpress.org/Changing_The_Site_URL#Important_GUID_Note" target="_blank"><?php _e( 'GUID', 'http-to-https' ); ?></a> <?php _e( 'column of the wp_posts table', 'http-to-https' ); ?>.</p>
    <br />
    <?php
}

// details section
function http_to_https_details_cb() {

    global $wpdb;

    $table_prefix = $wpdb->prefix;

    $siteurl = get_option( 'siteurl' );
    $home = get_option( 'home' );

    if ( is_multisite() ) {

        $blogid = $wpdb->blogid;
    }
    ?>

    <style>
        .site-details {
            font-family: monospace;
            width: 750px;
            height: 200px;
            padding: 10px 10px;
            margin-bottom: 30px;
        }
    </style>

    <textarea class="site-details" readonly="readonly"><?php printf( __( 'Site URL:&#9;%s', 'http-to-https' ), $siteurl ); ?>&#13;<?php printf( __( 'Home URL:&#9;%s', 'http-to-https' ), $home ); ?>&#13;&#13;<?php printf( __( 'Table prefix:&#9;%s', 'http-to-https' ), $table_prefix ); ?>&#13;&#13;<?php if ( is_multisite() ) { printf( __( 'Blog ID:&#9;%s', 'http-to-https' ), $blogid ); } ?></textarea>
    <br />
    <?php
}

// settings sections
function http_to_https_settings_cb() {
    // add something here
}

// src field
function http_to_https_src_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['src'] ) ) {

        $setting['src'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[src]" value="true" <?php checked( 'true', $setting['src'] ); ?>>
    <i><?php _e( 'Replace URLs of src attributes in the <b>post_content</b> column of the <b>wp_posts</b> table.', 'http-to-https' ); ?></i>
    <?php
}

// href field
function http_to_https_href_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['href'] ) ) {

        $setting['href'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[href]" value="true" <?php checked( 'true', $setting['href'] ); ?>>
    <i><?php _e( 'Replace URLs of href attributes in the <b>post_content</b> column of the <b>wp_posts</b> table.', 'http-to-https' ); ?></i>
    <?php
}

// pingbacks field
function http_to_https_pingbacks_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['pingbacks'] ) ) {

        $setting['pingbacks'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[pingbacks]" value="true" <?php checked( 'true', $setting['pingbacks'] ); ?>>
    <i><?php _e( 'Replace URLs in the <b>pinged</b> column of the <b>wp_posts</b> table. More information about pingbacks', 'http-to-https' ); ?> <a href="https://codex.wordpress.org/Introduction_to_Blogging#Pingbacks" target="_blank"><?php _e( 'here', 'http-to-https' ); ?>.</a></i>
    <?php
}

// comments field
function http_to_https_comments_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['comments'] ) ) {

        $setting['comments'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[comments]" value="true" <?php checked( 'true', $setting['comments'] ); ?>>
    <i><?php _e( 'Replace URLs in the <b>comment_author_url</b> and the <b>comment_content</b> columns of the <b>wp_comments</b> table.', 'http-to-https' ); ?></i>
    <?php
}

// postmeta field
function http_to_https_postmeta_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['postmeta'] ) ) {

        $setting['postmeta'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[postmeta]" value="true" <?php checked( 'true', $setting['postmeta'] ); ?>>
    <i><?php _e( 'Replace URLs in the <b>meta_value</b> column of the <b>wp_postmeta</b> table.', 'http-to-https' ); ?></i>
    <?php
}

// siteurl field
function http_to_https_siteurl_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['siteurl'] ) ) {

        $setting['siteurl'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[siteurl]" value="true" <?php checked( 'true', $setting['siteurl'] ); ?>>
    <i><?php _e( 'Replace the site URL in the <b>wp_options</b> table. More information about the site URL', 'http-to-https' ); ?> <a href="https://codex.wordpress.org/Changing_The_Site_URL" target="_blank"><?php _e( 'here', 'http-to-https' ); ?>.</a></i>
    <?php
}

// home field
function http_to_https_home_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['home'] ) ) {

        $setting['home'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[home]" value="true" <?php checked( 'true', $setting['home'] ); ?>>
    <i><?php _e( 'Replace the home URL in the <b>wp_options</b> table. More information about the home URL', 'http-to-https' ); ?> <a href="https://codex.wordpress.org/Changing_The_Site_URL" target="_blank"><?php _e( 'here', 'http-to-https' ); ?>.</a></i>
    <?php
}

// simulation field
function http_to_https_simulate_cb() {

    $setting = get_option( 'http_to_https' );

    if ( ! isset( $setting['simulate'] ) ) {

        $setting['simulate'] = '';
    }
    ?>

    <input type="checkbox" name="http_to_https[simulate]" value="true" <?php checked( 'true', $setting['simulate'] ); ?>>
    <i><?php _e( 'Select this option to simulate a replacement of the options you have selected. No URL will be replaced.', 'http-to-https' ); ?></i>
    <?php
}
