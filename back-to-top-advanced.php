<?php
/*
Plugin Name: Back to top advanced
Plugin URI:  http://arturssmirnovs.com/blog/back-to-top-advanced-wordpress/
Description: Back to top advanced scroll icon that does alot more than scroll. Be original and add it to your website to share your social media profiles, allow users to simply access important features and edit content real time.
Version:     1.1
Author:      arturssmirnovs
Author URI:  http://arturssmirnovs.com/
License:     GPLv2 or later.
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'BTTA_DIR', plugin_dir_path(__FILE__) );
define( 'BTTA_DIR_CLASSES', BTTA_DIR."classes/" );

require_once BTTA_DIR_CLASSES."class_Admin.php";
require_once BTTA_DIR_CLASSES."class_User.php";

register_activation_hook( __FILE__, array( 'BackToTopAdvnacedAdmin', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'BackToTopAdvnacedAdmin', 'plugin_deactivation' ) );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( 'BackToTopAdvnacedAdmin', 'btta_settings_link' ) );

if( is_admin() ) {
	new BackToTopAdvnacedAdmin();
}

new BackToTopAdvnaced();