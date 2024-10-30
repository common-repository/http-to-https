<?php

// returns site name without http:// or https://
function http_to_https_siteurl() {

    $siteurl = get_option( 'siteurl' );

    if ( preg_match('/https/', $siteurl ) ) {

        $site = substr($siteurl, 8);

    } else {

        $site = substr($siteurl, 7);
    }

    return $site;
}

// Return number of cells with http URLs
function http_to_https_cells( $setting ) {

    global $wpdb; // https://codex.wordpress.org/Class_Reference/wpdb

    $cells = 0;

    $site = http_to_https_siteurl();

    // src URLs
    if ( $setting['src'] == 'true' ) {

        $src_double_quotes_cells = $wpdb->get_var(
            "
            SELECT COUNT(*)
            FROM $wpdb->posts
            WHERE `post_content` LIKE '%src=\"http://$site%'
            "
        );

        $src_single_quotes_cells = $wpdb->get_var(
            '
            SELECT COUNT(*)
            FROM ' . $wpdb->posts .
            ' WHERE `post_content` LIKE "%src=\'http://' . $site . '%"
            '
        );

        $cells += $src_double_quotes_cells + $src_single_quotes_cells;
    }

    // href URLs
    if ( $setting['href'] == 'true' ) {

        $href_double_quotes_cells = $wpdb->get_var(
            "
            SELECT COUNT(*)
            FROM $wpdb->posts
            WHERE `post_content` LIKE '%href=\"http://$site%'
            "
        );

        $href_single_quotes_cells = $wpdb->get_var(
            '
            SELECT COUNT(*)
            FROM ' . $wpdb->posts .
            ' WHERE `post_content` LIKE "%href=\'http://' . $site . '%"
            '
        );

        $cells += $href_single_quotes_cells + $href_double_quotes_cells;
    }

    // pingbacks URLs
    if ( $setting['pingbacks'] == 'true' ) {

        $pingbacks_cells = $wpdb->get_var(
            "
            SELECT COUNT(*)
            FROM $wpdb->posts
            WHERE `pinged` LIKE '%http://$site%'
            "
        );

        $cells += $pingbacks_cells;
    }

    // comments URLs
    if ( $setting['comments'] == 'true' ) {

        $comment_author_url_cells = $wpdb->get_var(
            "
            SELECT COUNT(*)
            FROM $wpdb->comments
            WHERE `comment_author_url` LIKE '%http://$site%'
            "
        );

        $comment_content_cells = $wpdb->get_var(
            "
            SELECT COUNT(*)
            FROM $wpdb->comments
            WHERE `comment_content` LIKE '%http://$site%'
            "
        );

        $cells += $comment_author_url_cells + $comment_content_cells;
    }

    // postmeta URLs
    if ( $setting['postmeta'] == 'true' ) {

        $postmeta_cells = $wpdb->get_var(
            "
            SELECT COUNT(*)
            FROM $wpdb->postmeta
            WHERE `meta_value` LIKE '%http://$site%'
            "
        );

        $cells += $postmeta_cells;
    }

    // site URL
    if ( $setting['siteurl'] == 'true' ) {

        $siteurl = get_option( 'siteurl' );

        if ( $siteurl === 'http://' . $site ) {

            $cells += 1;
        }
    }

    // home URL
    if ( $setting['home'] == 'true' ) {

        $home = get_option( 'home' );

        if ( $home === 'http://' . $site ) {

            $cells += 1;
        }
    }

    return $cells;
}

// replace URLs
function http_to_https_replace( $setting ) {

    global $wpdb; // https://codex.wordpress.org/Class_Reference/wpdb

    $site = http_to_https_siteurl();

    // src URLs
    if ( $setting['src'] == 'true' ) {

        $wpdb->query(
          $wpdb->prepare(
            "
            UPDATE $wpdb->posts
            SET `post_content` = REPLACE(`post_content`, %s, %s)
            WHERE `post_content` LIKE %s
            ",
            "src=\"http://" . $site,
            "src=\"https://" . $site,
            "%src=\"http://" . $site . "%"
            )
        );

        $wpdb->query(
          $wpdb->prepare(
            '
            UPDATE ' . $wpdb->posts .
            ' SET `post_content` = REPLACE(`post_content`, %s, %s)
            WHERE `post_content` LIKE %s
            ',
            'src=\'http://' . $site,
            'src=\'https://' . $site,
            '%src=\'http://' . $site . '%'
            )
        );
    }

    // href URLs
    if ( $setting['href'] == 'true' ) {

        $wpdb->query(
          $wpdb->prepare(
            "
            UPDATE $wpdb->posts
            SET `post_content` = REPLACE(`post_content`, %s, %s)
            WHERE `post_content` LIKE %s
            ",
            "href=\"http://" . $site,
            "href=\"https://" . $site,
            "%href=\"http://" . $site . "%"
            )
        );

        $wpdb->query(
          $wpdb->prepare(
            '
            UPDATE ' . $wpdb->posts .
            ' SET `post_content` = REPLACE(`post_content`, %s, %s)
            WHERE `post_content` LIKE %s
            ',
            'href=\'http://' . $site,
            'href=\'https://' . $site,
            '%href=\'http://' . $site . '%'
            )
        );
    }

    // pingbacks URLs
    if ( $setting['pingbacks'] == 'true' ) {

        $wpdb->query(
          $wpdb->prepare(
            "
            UPDATE $wpdb->posts
            SET `pinged` = REPLACE(`pinged`, %s, %s)
            WHERE `pinged` LIKE %s
            ",
            "http://" . $site,
            "https://" . $site,
            "%http://" . $site . "%"
            )
        );
    }

    // comments URLs
    if ( $setting['comments'] == 'true' ) {

        $wpdb->query(
          $wpdb->prepare(
            "
            UPDATE $wpdb->comments
            SET `comment_author_url` = REPLACE(`comment_author_url`, %s, %s)
            WHERE `comment_author_url` LIKE %s
            ",
            "http://" . $site,
            "https://" . $site,
            "%http://" . $site . "%"
            )
        );

        $wpdb->query(
          $wpdb->prepare(
            "
            UPDATE $wpdb->comments
            SET `comment_content` = REPLACE(`comment_content`, %s, %s)
            WHERE `comment_content` LIKE %s
            ",
            "http://" . $site,
            "https://" . $site,
            "%http://" . $site . "%"
            )
        );
    }

    // postmeta URLs
    if ( $setting['postmeta'] == 'true' ) {

        $wpdb->query(
          $wpdb->prepare(
            "
            UPDATE $wpdb->postmeta
            SET `meta_value` = REPLACE(`meta_value`, %s, %s)
            WHERE `meta_value` LIKE %s
            ",
            "http://" . $site,
            "https://" . $site,
            "%http://" . $site . "%"
            )
        );
    }

    // site URL
    if ( $setting['siteurl'] == 'true' ) {

        update_option( 'siteurl', 'https://' . $site );
    }

    // home URL
    if ( $setting['home'] == 'true' ) {

        update_option( 'home', 'https://' . $site );
    }

}
