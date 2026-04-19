<?php
/**
 * Core plugin class.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers all custom blocks and enqueues shared assets.
 *
 * @since 1.0.0
 */
class Onyx_AI_Blocks {

	/**
	 * Singleton instance.
	 *
	 * @since 1.0.0
	 * @var self|null
	 */
	private static ?self $instance = null;

	/**
	 * Block slugs to register (each maps to src/<slug>/block.json).
	 *
	 * @since 1.0.0
	 * @var string[]
	 */
	private array $blocks = [
		'hero',
		'audience-fork',
		'pillars',
		'proof-strip',
		'service-card',
		'recorded-card',
		'section-label',
		'tag-badge',
		'cta-button',
		'testimonial',
		'newsletter-optin',
		'about-teaser',
		'faq-accordion',
	];

	/**
	 * Return or create the singleton.
	 *
	 * @since 1.0.0
	 *
	 * @return self
	 */
	public static function get_instance(): self {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor — wire up WordPress hooks.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action( 'init', [ $this, 'register_taxonomy' ] );
		add_filter( 'block_categories_all', [ $this, 'register_block_category' ], 10, 1 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_fonts' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_fonts' ] );
	}

	/**
	 * Register every custom block from its block.json metadata file.
	 *
	 * @since 1.0.0
	 */
	public function register_blocks(): void {
		foreach ( $this->blocks as $slug ) {
			$block_dir = ONYX_AI_BLOCKS_DIR . 'build/' . $slug;
			if ( file_exists( $block_dir . '/block.json' ) ) {
				register_block_type( $block_dir );
			}
		}
	}

	/**
	 * Register the Onyx AI block category in the block inserter.
	 *
	 * @since 1.0.0
	 *
	 * @param array[] $categories Existing block categories.
	 * @return array[]
	 */
	public function register_block_category( array $categories ): array {
		return array_merge(
			[
				[
					'slug'  => 'onyx-ai',
					'title' => __( 'Onyx AI', 'onyx-ai-blocks' ),
					'icon'  => null,
				],
			],
			$categories
		);
	}

	/**
	 * Register the onyx_content_cluster taxonomy for blog posts.
	 *
	 * @since 1.0.0
	 */
	public function register_taxonomy(): void {
		register_taxonomy(
			'onyx_content_cluster',
			'post',
			[
				'labels'            => [
					'name'              => __( 'Content Clusters', 'onyx-ai-blocks' ),
					'singular_name'     => __( 'Content Cluster', 'onyx-ai-blocks' ),
					'search_items'      => __( 'Search Clusters', 'onyx-ai-blocks' ),
					'all_items'         => __( 'All Clusters', 'onyx-ai-blocks' ),
					'edit_item'         => __( 'Edit Cluster', 'onyx-ai-blocks' ),
					'update_item'       => __( 'Update Cluster', 'onyx-ai-blocks' ),
					'add_new_item'      => __( 'Add New Cluster', 'onyx-ai-blocks' ),
					'new_item_name'     => __( 'New Cluster Name', 'onyx-ai-blocks' ),
					'menu_name'         => __( 'Content Clusters', 'onyx-ai-blocks' ),
				],
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'rewrite'           => [ 'slug' => 'cluster', 'with_front' => false ],
			]
		);

		// Seed default terms on first activation.
		$default_terms = [
			[ 'name' => 'AI לעסקים',        'slug' => 'ai-business' ],
			[ 'name' => 'AI למפתחים',       'slug' => 'ai-developers' ],
			[ 'name' => 'מדריכים מעשיים',   'slug' => 'practical-guides' ],
			[ 'name' => 'דעות ומגמות',      'slug' => 'opinions-trends' ],
		];

		foreach ( $default_terms as $term ) {
			if ( ! term_exists( $term['slug'], 'onyx_content_cluster' ) ) {
				wp_insert_term( $term['name'], 'onyx_content_cluster', [ 'slug' => $term['slug'] ] );
			}
		}
	}

	/**
	 * Enqueue self-hosted variable fonts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_fonts(): void {
		wp_enqueue_style(
			'onyx-ai-fonts',
			ONYX_AI_BLOCKS_URL . 'assets/fonts/fonts.css',
			[],
			ONYX_AI_BLOCKS_VERSION
		);
	}
}
