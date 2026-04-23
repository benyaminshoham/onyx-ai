<?php
/**
 * Pillars Grid — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

require_once ONYX_AI_BLOCKS_DIR . 'includes/icon-helper.php';

$items   = isset( $attributes['items'] )   ? $attributes['items']   : [];
$columns = isset( $attributes['columns'] ) ? (int) $attributes['columns'] : 3;

$wrapper_class = 'onyx-pillars onyx-pillars--cols-' . $columns;
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => $wrapper_class ] ); ?>>
	<?php foreach ( $items as $item ) : ?>
		<div class="onyx-pillars__item">
			<span class="onyx-pillars__icon" aria-hidden="true"><?php echo onyx_get_icon_svg( $item['icon'] ?? '', 28 ); ?></span>
			<h3 class="onyx-pillars__label"><?php echo esc_html( $item['label'] ?? '' ); ?></h3>
			<p class="onyx-pillars__description"><?php echo esc_html( $item['description'] ?? '' ); ?></p>
		</div>
	<?php endforeach; ?>
</div>
