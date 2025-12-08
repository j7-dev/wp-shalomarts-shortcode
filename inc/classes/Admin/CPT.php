<?php
/**
 * Custom Post Type: Shalomarts Shortcode
 */

declare(strict_types=1);

namespace J7\ShalomartsShortcode\Admin;

use J7\ShalomartsShortcode\Plugin;

if (class_exists('J7\ShalomartsShortcode\Admin\CPT')) {
	return;
}
/**
 * Class CPT
 */
final class CPT {
	use \J7\WpUtils\Traits\SingletonTrait;

	/**
	 * Constructor
	 */
	public function __construct() {
		\add_action( 'init', [ __CLASS__, 'register_cpt' ] );
		\add_action( 'load-post.php', [ __CLASS__, 'init_metabox' ] );
		\add_action( 'load-post-new.php', [ __CLASS__, 'init_metabox' ] );
	}

	/**
	 * Register shalomarts-shortcode custom post type
	 */
	public static function register_cpt(): void {

		$labels = [
			'name'                     => \esc_html__( 'shalomarts-shortcode', 'shalomarts_shortcode' ),
			'singular_name'            => \esc_html__( 'shalomarts-shortcode', 'shalomarts_shortcode' ),
			'add_new'                  => \esc_html__( 'Add new', 'shalomarts_shortcode' ),
			'add_new_item'             => \esc_html__( 'Add new item', 'shalomarts_shortcode' ),
			'edit_item'                => \esc_html__( 'Edit', 'shalomarts_shortcode' ),
			'new_item'                 => \esc_html__( 'New', 'shalomarts_shortcode' ),
			'view_item'                => \esc_html__( 'View', 'shalomarts_shortcode' ),
			'view_items'               => \esc_html__( 'View', 'shalomarts_shortcode' ),
			'search_items'             => \esc_html__( 'Search shalomarts-shortcode', 'shalomarts_shortcode' ),
			'not_found'                => \esc_html__( 'Not Found', 'shalomarts_shortcode' ),
			'not_found_in_trash'       => \esc_html__( 'Not found in trash', 'shalomarts_shortcode' ),
			'parent_item_colon'        => \esc_html__( 'Parent item', 'shalomarts_shortcode' ),
			'all_items'                => \esc_html__( 'All', 'shalomarts_shortcode' ),
			'archives'                 => \esc_html__( 'shalomarts-shortcode archives', 'shalomarts_shortcode' ),
			'attributes'               => \esc_html__( 'shalomarts-shortcode attributes', 'shalomarts_shortcode' ),
			'insert_into_item'         => \esc_html__( 'Insert to this shalomarts-shortcode', 'shalomarts_shortcode' ),
			'uploaded_to_this_item'    => \esc_html__( 'Uploaded to this shalomarts-shortcode', 'shalomarts_shortcode' ),
			'featured_image'           => \esc_html__( 'Featured image', 'shalomarts_shortcode' ),
			'set_featured_image'       => \esc_html__( 'Set featured image', 'shalomarts_shortcode' ),
			'remove_featured_image'    => \esc_html__( 'Remove featured image', 'shalomarts_shortcode' ),
			'use_featured_image'       => \esc_html__( 'Use featured image', 'shalomarts_shortcode' ),
			'menu_name'                => \esc_html__( 'shalomarts-shortcode', 'shalomarts_shortcode' ),
			'filter_items_list'        => \esc_html__( 'Filter shalomarts-shortcode list', 'shalomarts_shortcode' ),
			'filter_by_date'           => \esc_html__( 'Filter by date', 'shalomarts_shortcode' ),
			'items_list_navigation'    => \esc_html__( 'shalomarts-shortcode list navigation', 'shalomarts_shortcode' ),
			'items_list'               => \esc_html__( 'shalomarts-shortcode list', 'shalomarts_shortcode' ),
			'item_published'           => \esc_html__( 'shalomarts-shortcode published', 'shalomarts_shortcode' ),
			'item_published_privately' => \esc_html__( 'shalomarts-shortcode published privately', 'shalomarts_shortcode' ),
			'item_reverted_to_draft'   => \esc_html__( 'shalomarts-shortcode reverted to draft', 'shalomarts_shortcode' ),
			'item_scheduled'           => \esc_html__( 'shalomarts-shortcode scheduled', 'shalomarts_shortcode' ),
			'item_updated'             => \esc_html__( 'shalomarts-shortcode updated', 'shalomarts_shortcode' ),
		];
		$args   = [
			'label'                 => \esc_html__( 'shalomarts-shortcode', 'shalomarts_shortcode' ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => true,
			'hierarchical'          => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_nav_menus'     => false,
			'show_in_admin_bar'     => false,
			'show_in_rest'          => true,
			'query_var'             => false,
			'can_export'            => true,
			'delete_with_user'      => true,
			'has_archive'           => false,
			'rest_base'             => '',
			'show_in_menu'          => true,
			'menu_position'         => 6,
			'menu_icon'             => 'dashicons-store',
			'capability_type'       => 'post',
			'supports'              => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'author' ],
			'taxonomies'            => [],
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'rewrite'               => [
				'with_front' => true,
			],
		];

		\register_post_type( 'shalomarts-shortcode', $args );
	}


	/**
	 * Meta box initialization.
	 */
	public static function init_metabox(): void {
		\add_action( 'add_meta_boxes', [ __CLASS__, 'add_metabox' ] );
	}

	/**
	 * Adds the meta box.
	 *
	 * @param string $post_type Post type.
	 */
	public static function add_metabox( string $post_type ): void {
		if ( in_array( $post_type, [ Plugin::$kebab ], true ) ) {
			\add_meta_box(
				Plugin::$kebab . '-metabox',
				__( 'Shalomarts Shortcode', 'shalomarts_shortcode' ),
				[ __CLASS__, 'render_meta_box' ],
				$post_type,
				'advanced',
				'high'
			);
		}
	}

	/**
	 * Render meta box.
	 */
	public static function render_meta_box(): void {
		echo '<div id="shalomarts_shortcode_metabox"></div>';
	}
}
