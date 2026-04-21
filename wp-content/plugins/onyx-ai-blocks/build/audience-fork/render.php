<?php
/**
 * Audience Fork Card — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$headline    = isset( $attributes['headline'] )    ? $attributes['headline']    : '';
$description = isset( $attributes['description'] ) ? $attributes['description'] : '';
$link_label  = isset( $attributes['linkLabel'] )   ? $attributes['linkLabel']   : '';
$link_url    = isset( $attributes['linkUrl'] )     ? $attributes['linkUrl']     : '';
$audience    = isset( $attributes['audience'] )    ? $attributes['audience']    : 'dev';
$icon        = isset( $attributes['icon'] )        ? $attributes['icon']        : 'code';

$wrapper_class = 'onyx-audience-fork onyx-audience-fork--' . sanitize_html_class( $audience );
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => $wrapper_class ] ); ?>>
	<div class="onyx-audience-fork__icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></div>
	<h3 class="onyx-audience-fork__headline"><?php echo esc_html( $headline ); ?></h3>
	<p class="onyx-audience-fork__description"><?php echo esc_html( $description ); ?></p>
	<a class="onyx-audience-fork__link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?></a>
</div>
