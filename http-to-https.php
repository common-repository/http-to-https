<?php
/*
Plugin Name: HTTP to HTTPS
Version: 2.0
Author: Ambrogio Piredda
Author URI: https://profiles.wordpress.org/orbam7819
Description: Change links, images and attachments URLs from 'http' to 'https' in posts, pages and comments after installing an SSL certificate on your site.
Text Domain: http-to-https
Domain Path: /languages
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2018 Ambrogio Piredda
*/

define( 'HTTP_TO_HTTPS', plugin_dir_path( __FILE__ ) );

require HTTP_TO_HTTPS . 'functions.php';
require HTTP_TO_HTTPS . 'settings-fields.php';
require HTTP_TO_HTTPS . 'settings-page.php';
require HTTP_TO_HTTPS . 'settings.php';

// load textdomain
function http_to_https_load_textdomain() {
  $plugin_dir = basename( dirname(__FILE__) ) . '/languages';
  load_plugin_textdomain( 'http-to-https', false, $plugin_dir );
}
add_action( 'plugins_loaded', 'http_to_https_load_textdomain' );
