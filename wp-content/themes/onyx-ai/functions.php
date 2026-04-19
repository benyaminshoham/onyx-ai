<?php
/**
 * Onyx AI theme bootstrap.
 *
 * @package onyx-ai
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ONYX_AI_THEME_VERSION', '1.0.0' );

/**
 * Theme setup — declare supported features.
 *
 * @since 1.0.0
 */
function onyx_ai_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	load_theme_textdomain( 'onyx-ai', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'onyx_ai_setup' );

/**
 * Register block pattern categories.
 *
 * @since 1.0.0
 */
function onyx_ai_register_pattern_categories() {
	register_block_pattern_category(
		'onyx-ai',
		[ 'label' => __( 'Onyx AI', 'onyx-ai' ) ]
	);
}
add_action( 'init', 'onyx_ai_register_pattern_categories' );

/**
 * Apply RTL body class when WordPress language is Hebrew.
 *
 * @since 1.0.0
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function onyx_ai_body_class( array $classes ): array {
	if ( is_rtl() ) {
		$classes[] = 'onyx-rtl';
	}
	return $classes;
}
add_filter( 'body_class', 'onyx_ai_body_class' );
