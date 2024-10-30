<?php

// display settings page
function http_to_https_settings_page_html() {
    ?>
	<div class="wrap">

        <h2><?php _e( 'HTTP to HTTPS' ); ?></h2>

        <?php settings_errors(); ?>

		<form method="post" action="options.php">

            <?php settings_fields( 'http_to_https_settings_page' ); ?>
			<?php do_settings_sections( 'http_to_https_settings_page' ); ?>

            <?php $submit_text = __( 'Replace URLs', 'http-to-https' ); ?>

            <p class="submit">
                <input type="submit" class="button button-secondary" value="<?php echo $submit_text; ?>">
            </p>

        </form>

        <?php
        if ( ! get_option( 'http_to_https' ) ) {

            add_option( 'http_to_https' );
        }
        ?>

    </div>
    <?php
}

// setting errors
function http_to_https_setting_errors( $setting ) {

    $message = null;
    $type = null;

    if ( $setting != null ) {

        $cells = http_to_https_cells( $setting );
        $cells_updated = 0; // default

        if ( $setting['simulate'] != 'true' ) {

            http_to_https_replace( $setting );
            $cells_after_replace = http_to_https_cells( $setting );

            $cells_updated = ( $cells - $cells_after_replace );
        }

        $type = 'updated';
        $message .= sprintf( __( 'Cells found: %s', 'http-to-https' ), $cells );
        $message .= '<br />';
        $message .= sprintf( __( 'Cells updated: %s', 'http-to-https' ), $cells_updated );

    } else {

        $type = 'error';
        $message = __( 'Select at least one option', 'http-to-https' );

    }

    add_settings_error(
        'http_to_https_setting_errors',
        esc_attr( 'settings-updated' ),
        $message,
        $type
    );

    return $setting;
}

// submenu page
function http_to_https_settings_page() {

    add_submenu_page(
        'tools.php', // slug name for the parent menu
        __( 'HTTP to HTTPS', 'http-to-https' ), // page title
        __( 'HTTP to HTTPS', 'http-to-https' ), // menu title
        'manage_options', // capability
        'http_to_https_settings_page', // slug name to refer to this menu
        'http_to_https_settings_page_html' // function to be called to output the content for this page
    );
}
add_action( 'admin_menu', 'http_to_https_settings_page' );
