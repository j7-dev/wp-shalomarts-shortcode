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
		$permalink = $post_id ? ( \get_permalink( $post_id ) ?: '' ) : '';

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
			'CARD_DATA'         => self::get_card_data(),
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

	/** @return array<int, array{
	 * 'postId': int,
	 * 'building': string,
	 * 'top': int,
	 * 'left': int
	 * }>
	 */
	private static function get_map_data(): array {

		return [
			[
				'postId'   => 32090,
				'building' => 'building1',
				'top'      => 61,
				'left'     => 23,
			],
			[
				'postId'   => 32084,
				'building' => 'building1',
				'top'      => 64,
				'left'     => 22,
			],
			[
				'postId'   => 32087,
				'building' => 'building1',
				'top'      => 69,
				'left'     => 17,
			],
			[
				'postId'   => 31564,
				'building' => 'building2',
				'top'      => 52,
				'left'     => 50,
			],
			[
				'postId'   => 32072,
				'building' => 'building2',
				'top'      => 47,
				'left'     => 53,
			],
			[
				'postId'   => 32069,
				'building' => 'building2',
				'top'      => 50,
				'left'     => 56,
			],
			[
				'postId'   => 32069,
				'building' => 'building3',
				'top'      => 51,
				'left'     => 66,
			],
			[
				'postId'   => 31874,
				'building' => 'building3',
				'top'      => 52,
				'left'     => 69,
			],
			[
				'postId'   => 32075,
				'building' => 'building3',
				'top'      => 49,
				'left'     => 71,
			],
			[
				'postId'   => 31874,
				'building' => 'building3',
				'top'      => 52,
				'left'     => 77,
			],
			[
				'postId'   => 32081,
				'building' => 'building3',
				'top'      => 48,
				'left'     => 77,
			],
			[
				'postId'   => 32069,
				'building' => 'building3',
				'top'      => 48,
				'left'     => 81,
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
		$post_ids  = self::get_unique_post_ids();
		$list_data = [];
		foreach ($post_ids as $post_id) {
			$list_data[] = [
				'postId'   => $post_id,
				'title'    => \get_the_title( $post_id ) ?: '文章標題',
				'link'     => \get_permalink( $post_id ) ?: \site_url(),
				'artists'  => (string) \get_post_meta( $post_id, 'artists', true ) ?: 'artists',
				'location' => (string) \get_post_meta( $post_id, 'location', true ) ?: 'location',
			];
		}
		return $list_data;
	}

	/**
	 * @return array<int, array{
	 *  'postId': int,
	 *  'title': string,
	 *  'link': string
	 *  'image': string
	 * 'left': float,
	 * 'top': int
	 * }> */
	private static function get_card_data(): array {
		$map_data  = self::get_map_data();
		$post_ids  = self::get_unique_post_ids();
		$card_data = [];
		foreach ($post_ids as $post_id) {
			$maps     = array_filter($map_data, static fn( $item ) => $item['postId'] === $post_id);
			$avg_left = array_sum(array_column($maps, 'left')) / count($maps);
			$min_top  = min(array_column($maps, 'top'));

			$card_data[] = [
				'postId' => $post_id,
				'title'  => \get_the_title( $post_id ) ?: '文章標題',
				'link'   => \get_permalink( $post_id ) ?: \site_url(),
				'image'  => \get_the_post_thumbnail_url( $post_id ) ?: '',
				'left'   => $avg_left,
				'top'    => $min_top,
			];
		}

		return $card_data;
	}


	/** @return array<int> */
	private static function get_unique_post_ids(): array {
		$map_data = self::get_map_data();
		$post_ids = [];
		foreach ( $map_data as $data ) {
			$post_ids[] = $data['postId'];
		}
		return \array_values( \array_unique( $post_ids ) );
	}
}
