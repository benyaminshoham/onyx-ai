<?php
/**
 * About Teaser — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$photo_url        = isset( $attributes['photoUrl'] )        ? $attributes['photoUrl']        : '';
$photo_alt        = isset( $attributes['photoAlt'] )        ? $attributes['photoAlt']        : '';
$bio              = isset( $attributes['bio'] )              ? $attributes['bio']              : '';
$credibility_line = isset( $attributes['credibilityLine'] ) ? $attributes['credibilityLine'] : '';
$link_label       = isset( $attributes['linkLabel'] )       ? $attributes['linkLabel']       : 'קראו עוד עליי →';
$link_url         = isset( $attributes['linkUrl'] )         ? $attributes['linkUrl']         : '/about';
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'onyx-about-teaser' ] ); ?>>
	<?php if ( $photo_url ) : ?>
		<div class="onyx-about-teaser__photo-wrap">
			<img
				class="onyx-about-teaser__photo"
				src="<?php echo esc_url( $photo_url ); ?>"
				alt="<?php echo esc_attr( $photo_alt ); ?>"
				loading="lazy"
			/>
		</div>
	<?php endif; ?>
	<div class="onyx-about-teaser__content">
		<p class="onyx-about-teaser__bio"><?php echo esc_html( $bio ); ?></p>
		<?php if ( $credibility_line ) : ?>
			<p class="onyx-about-teaser__credibility"><?php echo esc_html( $credibility_line ); ?></p>
		<?php endif; ?>
		<a class="onyx-about-teaser__link" href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_label ); ?></a>
	</div>
</div>
