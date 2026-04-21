<?php
/**
 * Section Label — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$number = isset( $attributes['number'] ) ? $attributes['number'] : '01';
$label  = isset( $attributes['label'] )  ? $attributes['label']  : '';
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'onyx-section-label' ] ); ?>>
	<span class="onyx-section-label__number"><?php echo esc_html( $number ); ?></span>
	<span class="onyx-section-label__sep"> — </span>
	<span class="onyx-section-label__text"><?php echo esc_html( $label ); ?></span>
</div>
