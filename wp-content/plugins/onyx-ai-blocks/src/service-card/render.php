<?php
/**
 * Service Card — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$icon         = isset( $attributes['icon'] )        ? $attributes['icon']        : 'zap';
$title        = isset( $attributes['title'] )       ? $attributes['title']       : '';
$tagline      = isset( $attributes['tagline'] )     ? $attributes['tagline']     : '';
$description  = isset( $attributes['description'] ) ? $attributes['description'] : '';
$audience_tag = isset( $attributes['audienceTag'] ) ? $attributes['audienceTag'] : '';
$service_type = isset( $attributes['serviceType'] ) ? $attributes['serviceType'] : 'group';
$format       = isset( $attributes['format'] )      ? $attributes['format']      : '';
$next_date    = isset( $attributes['nextDate'] )    ? $attributes['nextDate']    : '';
$price        = isset( $attributes['price'] )       ? $attributes['price']       : '';
$cta_label    = isset( $attributes['ctaLabel'] )    ? $attributes['ctaLabel']    : 'לפרטים';
$cta_url      = isset( $attributes['ctaUrl'] )      ? $attributes['ctaUrl']      : '';
$featured     = ! empty( $attributes['featured'] );

require_once ONYX_AI_BLOCKS_DIR . 'includes/icon-helper.php';

$wrapper_class = 'onyx-service-card onyx-service-card--' . sanitize_html_class( $service_type ) . ( $featured ? ' onyx-service-card--featured' : '' );
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => $wrapper_class ] ); ?>>
	<div class="onyx-service-card__header">
		<span class="onyx-service-card__icon" aria-hidden="true"><?php echo onyx_get_icon_svg( $icon, 20 ); ?></span>
		<?php if ( $audience_tag ) : ?>
			<span class="onyx-tag-badge onyx-tag-badge--mustard"><?php echo esc_html( $audience_tag ); ?></span>
		<?php endif; ?>
	</div>
	<h3 class="onyx-service-card__title"><?php echo esc_html( $title ); ?></h3>
	<?php if ( $tagline ) : ?>
		<p class="onyx-service-card__tagline"><?php echo esc_html( $tagline ); ?></p>
	<?php endif; ?>
	<p class="onyx-service-card__description"><?php echo esc_html( $description ); ?></p>
	<?php if ( $format ) : ?>
		<span class="onyx-service-card__format"><?php echo esc_html( $format ); ?></span>
	<?php endif; ?>
	<?php if ( 'group' === $service_type && $next_date ) : ?>
		<span class="onyx-service-card__next-date"><?php echo esc_html( $next_date ); ?></span>
	<?php endif; ?>
	<?php if ( $price ) : ?>
		<span class="onyx-service-card__price"><?php echo esc_html( $price ); ?></span>
	<?php endif; ?>
	<a class="onyx-service-card__cta" href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_label ); ?></a>
</div>
