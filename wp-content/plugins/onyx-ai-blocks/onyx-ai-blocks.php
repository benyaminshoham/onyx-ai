<?php
/**
 * Plugin Name:  Onyx AI Blocks
 * Plugin URI:   https://onyx-ai.com
 * Description:  Custom Gutenberg blocks, fonts, and icons for the Onyx AI website.
 * Version:      1.0.0
 * Author:       Benyamin Shoham
 * Author URI:   https://onyx-ai.com
 * License:      GPL-2.0-or-later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  onyx-ai-blocks
 * Domain Path:  /languages
 *
 * @package onyx-ai-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ONYX_AI_BLOCKS_VERSION', '1.0.0' );
define( 'ONYX_AI_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'ONYX_AI_BLOCKS_URL', plugin_dir_url( __FILE__ ) );

require_once ONYX_AI_BLOCKS_DIR . 'includes/class-onyx-ai-blocks.php';

/**
 * Initialise the plugin.
 *
 * @since 1.0.0
 */
function onyx_ai_blocks_init(): void {
	Onyx_AI_Blocks::get_instance();
}
add_action( 'plugins_loaded', 'onyx_ai_blocks_init' );
