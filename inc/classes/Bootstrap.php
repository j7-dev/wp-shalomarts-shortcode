<?php

declare (strict_types = 1);

namespace J7\ShalomartsShortcode;

use J7\ShalomartsShortcode\Utils\Base;
use Kucrut\Vite;

if ( class_exists( 'J7\ShalomartsShortcode\Bootstrap' ) ) {
	return;
}
/** Class Bootstrap */
final class Bootstrap {

	/** Register Hooks */
	public static function register_hooks(): void {
		\add_action( 'wp_enqueue_scripts', [ __CLASS__, 'frontend_enqueue_script' ], 99 );
		\add_action( 'init', [ __CLASS__, 'register_shortcodes' ] );
	}

	/**
	 * Front-end Enqueue script
	 * You can load the script on demand
	 *
	 * @return void
	 */
	public static function frontend_enqueue_script(): void {
		self::enqueue_script();
	}

	/**
	 * Enqueue script
	 * You can load the script on demand
	 *
	 * @return void
	 */
	public static function enqueue_script(): void {

		Vite\enqueue_asset(
			Plugin::$dir . '/js/dist',
			'js/src/main.tsx',
			[
				'handle'    => Plugin::$kebab,
				'in-footer' => true,
			]
		);

		$post_id   = \get_the_ID();
		$permalink = $post_id ? \get_permalink( $post_id ) : '';

		/** @var array<string> $active_plugins */
		$active_plugins = \get_option( 'active_plugins', [] );

		$env = [
			'SITE_URL'          => \untrailingslashit( \site_url() ),
			'API_URL'           => \untrailingslashit( \esc_url_raw( rest_url() ) ),
			'CURRENT_USER_ID'   => \get_current_user_id(),
			'CURRENT_POST_ID'   => $post_id,
			'PERMALINK'         => \untrailingslashit( $permalink ),
			'APP_NAME'          => Plugin::$app_name,
			'KEBAB'             => Plugin::$kebab,
			'SNAKE'             => Plugin::$snake,
			'NONCE'             => \wp_create_nonce( 'wp_rest' ),
			'APP1_SELECTOR'     => Base::APP1_SELECTOR,
			'ELEMENTOR_ENABLED' => \in_array( 'elementor/elementor.php', $active_plugins, true ), // 檢查 elementor 是否啟用
			'MAP_DATA'          => self::get_map_data(),
			'LIST_DATA'         => self::get_list_data(),
		];

		\wp_localize_script(
			Plugin::$kebab,
			Plugin::$snake . '_data',
			[
				'env' => $env,
			]
		);
	}

	/** Register Shortcodes */
	public static function register_shortcodes(): void {
		\add_shortcode( 'shalomarts_map', [ __CLASS__, 'render_shalomarts_map' ] );
	}

	/**
	 * Render Shalomarts Map Shortcode
	 *
	 * @param array<string, mixed> $atts    Shortcode attributes.
	 * @param string|null          $content Shortcode content.
	 */
	public static function render_shalomarts_map( $atts = [], $content = null ): string {
		return \sprintf('<div id="%s"></div>', \substr(Base::APP1_SELECTOR, 1) );
	}

	/** @return array<int, array<string, mixed>> */
	private static function get_map_data(): array {

		return [
			[
				'building' => 'building1',
				'maps'     => [
					[
						'postId' => 32090,
						'top'    => 43,
						'left'   => 70,
					],
					[
						'postId' => 32084,
						'top'    => 50,
						'left'   => 67,
					],
					[
						'postId' => 32087,
						'top'    => 60,
						'left'   => 50,
					],
				],
			],
			[
				'building' => 'building2',
				'maps'     => [
					[
						'postId' => 31564,
						'top'    => 72,
						'left'   => 36,
					],
					[
						'postId' => 32072,
						'top'    => 62,
						'left'   => 46,
					],
					[
						'postId' => 32069,
						'top'    => 67,
						'left'   => 57,
					],
				],
			],
			[
				'building' => 'building3',
				'maps'     => [
					[
						'postId' => 32069,
						'top'    => 69,
						'left'   => 23,
					],
					[
						'postId' => 31874,
						'top'    => 70,
						'left'   => 33,
					],
					[
						'postId' => 32075,
						'top'    => 64,
						'left'   => 40,
					],
					[
						'postId' => 31874,
						'top'    => 74,
						'left'   => 49,
					],
					[
						'postId' => 32081,
						'top'    => 62,
						'left'   => 63,
					],
					[
						'postId' => 32069,
						'top'    => 63,
						'left'   => 73,
					],
				],
			],
		];
	}

	/**
	 * @return array<int, array{
	 *  'postId': int,
	 *  'title': string,
	 *  'link': string
	 *  'artists': string,
	 *  'location': string
	 * }> */
	private static function get_list_data(): array {

		$map_data  = self::get_map_data();
		$post_ids  = array_unique(
		array_column(
		array_merge(...array_column($map_data, 'maps')), // phpstan-ignore-line
		'postId'
		)
		);
		$list_data = [];
		foreach ($post_ids as $post_id) {
			$list_data[] = [
				'postId' => $post_id,
				'title'  => \get_the_title( $post_id ) ?: '文章標題',
				'link'   => \get_permalink( $post_id ) ?: \site_url(),
				'artists' => get_post_meta( $post_id, 'artists', true ) ?: 'artists',
				'location' => get_post_meta( $post_id, 'location', true ) ?: 'location',
			];
		}
		return $list_data;
	}
}
