<?php
/**
 * Testimonial — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$quote      = isset( $attributes['quote'] )     ? $attributes['quote']     : '';
$author     = isset( $attributes['author'] )    ? $attributes['author']    : '';
$role       = isset( $attributes['role'] )      ? $attributes['role']      : '';
$avatar_url = isset( $attributes['avatarUrl'] ) ? $attributes['avatarUrl'] : '';
$layout     = isset( $attributes['layout'] )    ? $attributes['layout']    : 'card';

$wrapper_class = 'onyx-testimonial onyx-testimonial--' . sanitize_html_class( $layout );
?>
<blockquote <?php echo get_block_wrapper_attributes( [ 'class' => $wrapper_class ] ); ?>>
	<p class="onyx-testimonial__quote">"<?php echo esc_html( $quote ); ?>"</p>
	<footer class="onyx-testimonial__footer">
		<?php if ( $avatar_url ) : ?>
			<img
				class="onyx-testimonial__avatar"
				src="<?php echo esc_url( $avatar_url ); ?>"
				alt="<?php echo esc_attr( $author ); ?>"
				width="40"
				height="40"
				loading="lazy"
			/>
		<?php endif; ?>
		<span class="onyx-testimonial__author"><?php echo esc_html( $author ); ?></span>
		<?php if ( $role ) : ?>
			<span class="onyx-testimonial__role"><?php echo esc_html( $role ); ?></span>
		<?php endif; ?>
	</footer>
</blockquote>
