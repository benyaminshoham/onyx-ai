<?php
/**
 * Hero block — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$eyebrow             = isset( $attributes['eyebrow'] )             ? $attributes['eyebrow']            : '';
$headline            = isset( $attributes['headline'] )            ? $attributes['headline']           : '';
$sign                = isset( $attributes['sign'] )                ? $attributes['sign']               : '';
$subheading          = isset( $attributes['subheading'] )          ? $attributes['subheading']         : '';
$tagline             = isset( $attributes['tagline'] )             ? $attributes['tagline']            : '';
$cta_primary_label   = isset( $attributes['ctaPrimaryLabel'] )     ? $attributes['ctaPrimaryLabel']    : '';
$cta_primary_url     = isset( $attributes['ctaPrimaryUrl'] )       ? $attributes['ctaPrimaryUrl']      : '';
$cta_secondary_label = isset( $attributes['ctaSecondaryLabel'] )   ? $attributes['ctaSecondaryLabel']  : '';
$cta_secondary_url   = isset( $attributes['ctaSecondaryUrl'] )     ? $attributes['ctaSecondaryUrl']    : '';
$variant             = isset( $attributes['variant'] )             ? $attributes['variant']            : 'homepage';
$decoration          = ! empty( $attributes['backgroundDecoration'] );

$section_class = 'onyx-hero onyx-hero--' . sanitize_html_class( $variant );
if ( $decoration ) {
	$section_class .= ' onyx-hero--decorated';
}
?>
<section <?php echo get_block_wrapper_attributes( [ 'class' => $section_class ] ); ?>>
	<?php if ( $decoration ) : ?>
		<div class="onyx-hero__orb" aria-hidden="true"></div>
	<?php endif; ?>
	<div class="onyx-hero__inner">
		<?php if ( $eyebrow ) : ?>
			<p class="onyx-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<?php if ( $headline ) : ?>
			<h1 class="onyx-hero__headline"><?php echo wp_kses_post( $headline ); ?></h1>
		<?php endif; ?>
		<?php if ( $sign ) : ?>
			<p class="onyx-hero__sign"><?php echo esc_html( $sign ); ?></p>
		<?php endif; ?>
		<?php if ( $subheading ) : ?>
			<p class="onyx-hero__subheading"><?php echo esc_html( $subheading ); ?></p>
		<?php endif; ?>
		<div class="onyx-hero__ctas">
			<?php if ( $cta_primary_label ) : ?>
				<a class="onyx-cta-button onyx-cta-button--primary" href="<?php echo esc_url( $cta_primary_url ); ?>">
					<?php echo esc_html( $cta_primary_label ); ?>
				</a>
			<?php endif; ?>
			<?php if ( 'homepage' === $variant && $cta_secondary_label ) : ?>
				<a class="onyx-cta-button onyx-cta-button--secondary" href="<?php echo esc_url( $cta_secondary_url ); ?>">
					<?php echo esc_html( $cta_secondary_label ); ?>
				</a>
			<?php endif; ?>
		</div>
		<?php if ( $tagline ) : ?>
			<p class="onyx-hero__tagline"><?php echo esc_html( $tagline ); ?></p>
		<?php endif; ?>
	</div>
</section>
