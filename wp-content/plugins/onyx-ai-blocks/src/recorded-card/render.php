<?php
/**
 * Recorded Card — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array  $attributes Block attributes.
 * @var string $content    Inner block content (unused).
 * @var WP_Block $block    Block instance.
 */

$title        = isset( $attributes['title'] )        ? $attributes['title']        : '';
$audience_tag_raw = isset( $attributes['audienceTag'] ) ? $attributes['audienceTag'] : '';
$audience_tag_labels = [ 'dev' => 'מפתחים', 'biz' => 'בעלי עסקים', 'org' => 'ארגונים' ];
$audience_tag = $audience_tag_labels[ $audience_tag_raw ] ?? $audience_tag_raw;
$description  = isset( $attributes['description'] )  ? $attributes['description']  : '';
$price        = isset( $attributes['price'] )        ? $attributes['price']        : '';
$duration     = isset( $attributes['duration'] )     ? $attributes['duration']     : '';
$module_count = isset( $attributes['moduleCount'] )  ? $attributes['moduleCount']  : '';
$thumbnail_url = isset( $attributes['thumbnailUrl'] ) ? $attributes['thumbnailUrl'] : '';
$thumbnail_alt = isset( $attributes['thumbnailAlt'] ) ? $attributes['thumbnailAlt'] : '';
$cta_label    = isset( $attributes['ctaLabel'] )     ? $attributes['ctaLabel']     : __( 'לרכישה', 'onyx-ai-blocks' );
$cta_url      = isset( $attributes['ctaUrl'] )       ? $attributes['ctaUrl']       : '';
$featured     = ! empty( $attributes['featured'] );

$wrapper_class = 'onyx-recorded-card' . ( $featured ? ' onyx-recorded-card--featured' : '' );
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => $wrapper_class ] ); ?>>

	<?php if ( $thumbnail_url ) : ?>
		<img
			class="onyx-recorded-card__thumbnail"
			src="<?php echo esc_url( $thumbnail_url ); ?>"
			alt="<?php echo esc_attr( $thumbnail_alt ); ?>"
			loading="lazy"
			width="640"
			height="360"
		/>
	<?php endif; ?>

	<div class="onyx-recorded-card__body">
		<?php if ( $audience_tag ) : ?>
			<span class="onyx-tag-badge onyx-tag-badge--teal"><?php echo esc_html( $audience_tag ); ?></span>
		<?php endif; ?>

		<?php if ( $title ) : ?>
			<h3 class="onyx-recorded-card__title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>

		<?php if ( $module_count || $duration ) : ?>
			<div class="onyx-recorded-card__meta">
				<?php if ( $module_count ) : ?>
					<span><?php echo esc_html( $module_count ); ?></span>
				<?php endif; ?>
				<?php if ( $duration ) : ?>
					<span><?php echo esc_html( $duration ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $description ) : ?>
			<p class="onyx-recorded-card__description"><?php echo esc_html( $description ); ?></p>
		<?php endif; ?>

		<?php if ( $price ) : ?>
			<span class="onyx-recorded-card__price"><?php echo esc_html( $price ); ?></span>
		<?php endif; ?>

		<?php if ( $cta_label && $cta_url ) : ?>
			<a class="onyx-recorded-card__cta" href="<?php echo esc_url( $cta_url ); ?>">
				<?php echo esc_html( $cta_label ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>
