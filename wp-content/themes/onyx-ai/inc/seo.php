<?php
/**
 * SEO & structured data: meta tags, Open Graph, and JSON-LD schema.
 *
 * Service and FAQ schema are generated automatically from the
 * onyx-ai/service-card and onyx-ai/faq-accordion blocks already present
 * in page content, so they stay in sync with what's on the page.
 *
 * @package onyx-ai
 * @since   1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Recursively collect all blocks of a given name from a parsed block tree.
 *
 * @param array  $blocks Parsed blocks (from parse_blocks()).
 * @param string $name   Block name, e.g. 'onyx-ai/service-card'.
 * @return array[]
 */
function onyx_ai_seo_find_blocks( array $blocks, string $name ): array {
	$found = [];
	foreach ( $blocks as $block ) {
		if ( ( $block['blockName'] ?? '' ) === $name ) {
			$found[] = $block;
		}
		if ( ! empty( $block['innerBlocks'] ) ) {
			$found = array_merge( $found, onyx_ai_seo_find_blocks( $block['innerBlocks'], $name ) );
		}
	}
	return $found;
}

/**
 * Parsed blocks for the current singular post/page, or an empty array.
 *
 * @return array[]
 */
function onyx_ai_seo_current_blocks(): array {
	if ( ! is_singular() ) {
		return [];
	}
	$content = get_post_field( 'post_content', get_the_ID() );
	return $content ? parse_blocks( $content ) : [];
}

/**
 * Default social-preview image: theme OG asset, falling back to the site icon.
 *
 * @return string
 */
function onyx_ai_seo_default_image(): string {
	$og_asset = get_template_directory() . '/assets/og-image.png';
	if ( file_exists( $og_asset ) ) {
		return get_template_directory_uri() . '/assets/og-image.png';
	}
	$icon = get_site_icon_url( 512 );
	return $icon ?: '';
}

/**
 * Meta description for the current request.
 *
 * @return string
 */
function onyx_ai_seo_description(): string {
	if ( is_front_page() ) {
		return 'קורסים, ייעוץ ואוטומציות AI לעסקים קטנים, ארגונים ומפתחים בישראל — עם בנימין, מפתח ומדריך עם 15+ שנות ניסיון. חוסכים 10+ שעות בשבוע עם AI, בלי לגייס ובלי ידע בתכנות.';
	}

	if ( is_singular() ) {
		$excerpt = wp_strip_all_tags( get_the_excerpt() );
		if ( $excerpt ) {
			return mb_substr( trim( $excerpt ), 0, 160 );
		}
	}

	if ( is_post_type_archive( 'post' ) || is_home() ) {
		return 'מאמרים ומדריכים מעשיים על AI לעסקים ולמפתחים — Claude, אוטומציה, ופיתוח עם בינה מלאכותית.';
	}

	return 'Onyx AI — קורסים, ייעוץ ואוטומציות AI לעסקים ומפתחים בישראל.';
}

/**
 * Output <meta description>, canonical-adjacent Open Graph, and Twitter Card tags.
 */
function onyx_ai_seo_meta_tags(): void {
	if ( is_admin() ) {
		return;
	}

	$description = onyx_ai_seo_description();
	$title       = wp_get_document_title();
	$url         = is_singular() ? get_permalink() : home_url( '/' );
	$image       = onyx_ai_seo_default_image();

	if ( is_singular() && has_post_thumbnail() ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		if ( $thumb ) {
			$image = $thumb[0];
		}
	}

	printf( '<meta name="description" content="%s" />' . "\n", esc_attr( $description ) );
	printf( '<meta property="og:site_name" content="Onyx AI" />' . "\n" );
	printf( '<meta property="og:type" content="%s" />' . "\n", esc_attr( is_singular( 'post' ) ? 'article' : 'website' ) );
	printf( '<meta property="og:title" content="%s" />' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s" />' . "\n", esc_attr( $description ) );
	printf( '<meta property="og:url" content="%s" />' . "\n", esc_url( $url ) );
	printf( '<meta property="og:locale" content="he_IL" />' . "\n" );
	if ( $image ) {
		printf( '<meta property="og:image" content="%s" />' . "\n", esc_url( $image ) );
		printf( '<meta name="twitter:card" content="summary_large_image" />' . "\n" );
		printf( '<meta name="twitter:image" content="%s" />' . "\n", esc_url( $image ) );
	} else {
		printf( '<meta name="twitter:card" content="summary" />' . "\n" );
	}
	printf( '<meta name="twitter:title" content="%s" />' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s" />' . "\n", esc_attr( $description ) );
}
add_action( 'wp_head', 'onyx_ai_seo_meta_tags', 1 );

/**
 * Force a keyword-rich, complete title on the front page.
 *
 * The theme relies on core's title-tag support, which on the front page
 * otherwise renders just the bare site name ("Onyx AI").
 *
 * @param string $title Default title.
 * @return string
 */
function onyx_ai_seo_front_page_title( string $title ): string {
	if ( is_front_page() ) {
		return 'בינה מלאכותית לעסקים ולמפתחים | קורסים, ייעוץ ואוטומציה AI — Onyx AI';
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'onyx_ai_seo_front_page_title', 20 );

/**
 * Sitewide Organization/ProfessionalService JSON-LD.
 */
function onyx_ai_seo_organization_schema(): void {
	if ( is_admin() ) {
		return;
	}

	$image = onyx_ai_seo_default_image();

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'ProfessionalService',
		'name'        => 'Onyx AI',
		'url'         => home_url( '/' ),
		'description' => 'קורסים, ייעוץ ואוטומציות AI לעסקים קטנים, ארגונים ומפתחים בישראל.',
		'areaServed'  => 'IL',
		'priceRange'  => '₪₪',
		'founder'     => [
			'@type' => 'Person',
			'name'  => 'Benyamin',
		],
		'sameAs'      => [
			'https://linkedin.com/in/benyamin',
			'https://youtube.com/@benyamin',
		],
	];

	if ( $image ) {
		$schema['logo']  = $image;
		$schema['image'] = $image;
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'onyx_ai_seo_organization_schema', 2 );

/**
 * FAQPage JSON-LD, generated from onyx-ai/faq-accordion blocks on the current page.
 */
function onyx_ai_seo_faq_schema(): void {
	$faq_blocks = onyx_ai_seo_find_blocks( onyx_ai_seo_current_blocks(), 'onyx-ai/faq-accordion' );
	if ( ! $faq_blocks ) {
		return;
	}

	$questions = [];
	foreach ( $faq_blocks as $faq_block ) {
		foreach ( (array) ( $faq_block['attrs']['items'] ?? [] ) as $item ) {
			if ( empty( $item['question'] ) || empty( $item['answer'] ) ) {
				continue;
			}
			$questions[] = [
				'@type'          => 'Question',
				'name'           => wp_strip_all_tags( $item['question'] ),
				'acceptedAnswer' => [
					'@type' => 'Answer',
					'text'  => wp_strip_all_tags( $item['answer'] ),
				],
			];
		}
	}

	if ( ! $questions ) {
		return;
	}

	$schema = [
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $questions,
	];

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'onyx_ai_seo_faq_schema', 3 );

/**
 * Service JSON-LD, generated from onyx-ai/service-card blocks on the current page.
 */
function onyx_ai_seo_service_schema(): void {
	$cards = onyx_ai_seo_find_blocks( onyx_ai_seo_current_blocks(), 'onyx-ai/service-card' );
	if ( ! $cards ) {
		return;
	}

	$services = [];
	foreach ( $cards as $card ) {
		$attrs = $card['attrs'] ?? [];
		if ( empty( $attrs['title'] ) ) {
			continue;
		}

		$service = [
			'@type'       => 'Service',
			'name'        => wp_strip_all_tags( $attrs['title'] ),
			'description' => wp_strip_all_tags( $attrs['description'] ?? $attrs['tagline'] ?? '' ),
			'provider'    => [
				'@type' => 'Organization',
				'name'  => 'Onyx AI',
			],
			'areaServed'  => 'IL',
		];

		if ( ! empty( $attrs['audienceTag'] ) ) {
			$service['audience'] = [
				'@type'        => 'Audience',
				'audienceType' => wp_strip_all_tags( $attrs['audienceTag'] ),
			];
		}

		if ( ! empty( $attrs['price'] ) && preg_match( '/[\d,]+/', $attrs['price'], $m ) ) {
			$service['offers'] = [
				'@type'         => 'Offer',
				'price'         => str_replace( ',', '', $m[0] ),
				'priceCurrency' => 'ILS',
			];
			if ( ! empty( $attrs['ctaUrl'] ) && str_starts_with( $attrs['ctaUrl'], 'http' ) ) {
				$service['offers']['url'] = esc_url_raw( $attrs['ctaUrl'] );
			}
		}

		$services[] = $service;
	}

	if ( ! $services ) {
		return;
	}

	if ( 1 === count( $services ) ) {
		$schema = array_merge( [ '@context' => 'https://schema.org' ], $services[0] );
	} else {
		$schema = [
			'@context' => 'https://schema.org',
			'@graph'   => $services,
		];
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'onyx_ai_seo_service_schema', 4 );

/**
 * Article JSON-LD for single blog posts.
 */
function onyx_ai_seo_article_schema(): void {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$post  = get_post();
	$image = has_post_thumbnail( $post )
		? wp_get_attachment_image_url( get_post_thumbnail_id( $post ), 'large' )
		: onyx_ai_seo_default_image();

	$schema = [
		'@context'         => 'https://schema.org',
		'@type'            => 'Article',
		'headline'         => get_the_title( $post ),
		'description'      => wp_strip_all_tags( get_the_excerpt( $post ) ),
		'datePublished'    => get_the_date( DATE_W3C, $post ),
		'dateModified'     => get_the_modified_date( DATE_W3C, $post ),
		'inLanguage'       => 'he-IL',
		'author'           => [
			'@type' => 'Person',
			'name'  => get_the_author_meta( 'display_name', $post->post_author ) ?: 'Benyamin',
		],
		'publisher'        => [
			'@type' => 'Organization',
			'name'  => 'Onyx AI',
			'logo'  => [
				'@type' => 'ImageObject',
				'url'   => onyx_ai_seo_default_image(),
			],
		],
		'mainEntityOfPage' => [
			'@type' => 'WebPage',
			'@id'   => get_permalink( $post ),
		],
	];

	if ( $image ) {
		$schema['image'] = $image;
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'onyx_ai_seo_article_schema', 5 );
