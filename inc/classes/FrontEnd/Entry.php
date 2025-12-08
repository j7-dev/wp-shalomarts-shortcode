<?php
/**
 * Front-end Entry
 */

declare(strict_types=1);

namespace J7\ShalomartsShortcode\FrontEnd;

if (class_exists('J7\ShalomartsShortcode\FrontEnd\Entry')) {
	return;
}
/**
 * Class Entry
 */
final class Entry {
	use \J7\WpUtils\Traits\SingletonTrait;

	/**
	 * Constructor
	 */
	public function __construct() {
		\add_action( 'wp_footer', [ __CLASS__, 'render_app' ] );
	}

	/**
	 * Render application's markup
	 */
	public static function render_app(): void {
		// phpcs:ignore
		echo '<div id="shalomarts_shortcode"></div>';
	}
}
