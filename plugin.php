<?php
/**
 * Plugin Name:       Shalomarts Shortcode | 青山家族專用 shortcode
 * Plugin URI:        https://github.com/j7-dev/wp-shalomarts-shortcode
 * Description:       青山家族專用 shortcode
 * Version:           0.0.5
 * Requires at least: 5.7
 * Requires PHP:      8.1
 * Author:            J7
 * Author URI:        https://github.com/j7-dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       shalomarts_shortcode
 * Domain Path:       /languages
 * Tags: your tags
 */

declare ( strict_types=1 );

namespace J7\ShalomartsShortcode;

if ( \class_exists( 'J7\ShalomartsShortcode\Plugin' ) ) {
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Class Plugin
 */
final class Plugin {
	use \J7\WpUtils\Traits\PluginTrait;
	use \J7\WpUtils\Traits\SingletonTrait;

	/**
	 * Constructor
	 */
	public function __construct() {
		// if your plugin depends on other plugins, you can add them here
		// $this->required_plugins = [
		// [
		// 'name'     => 'WooCommerce',
		// 'slug'     => 'woocommerce',
		// 'required' => true,
		// 'version'  => '7.6.0',
		// ],
		// [
		// 'name'     => 'Powerhouse',
		// 'slug'     => 'powerhouse',
		// 'source'   => '[YOUR GITHUB URL]/wp-powerhouse/releases/latest/download/powerhouse.zip',
		// 'version'  => '1.0.14',
		// 'required' => true,
		// ],
		// ];

		$this->init(
			[
				'app_name'    => 'Shalomarts Shortcode',
				'github_repo' => 'https://github.com/j7-dev/wp-shalomarts-shortcode',
				'callback'    => [ Bootstrap::class, 'register_hooks' ],
				'lc' => false
			]
		);
	}
}

Plugin::instance();
