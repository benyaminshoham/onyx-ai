<?php
/**
 * FAQ Accordion — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$items = isset( $attributes['items'] ) ? $attributes['items'] : [];
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'onyx-faq-accordion' ] ); ?>>
	<?php foreach ( $items as $item ) : ?>
		<details class="onyx-faq-accordion__item">
			<summary class="onyx-faq-accordion__question"><?php echo esc_html( $item['question'] ?? '' ); ?></summary>
			<div class="onyx-faq-accordion__answer"><?php echo esc_html( $item['answer'] ?? '' ); ?></div>
		</details>
	<?php endforeach; ?>
</div>
