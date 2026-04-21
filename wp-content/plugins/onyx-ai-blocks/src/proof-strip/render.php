<?php
/**
 * Proof Strip — server-side render.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Inner block content (unused).
 * @var WP_Block $block      Block instance.
 */

$stats  = isset( $attributes['stats'] )  ? $attributes['stats']  : [];
$quotes = isset( $attributes['quotes'] ) ? $attributes['quotes'] : [];
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => 'onyx-proof-strip' ] ); ?>>
	<div class="onyx-proof-strip__stats">
		<?php foreach ( $stats as $stat ) : ?>
			<div class="onyx-proof-strip__stat">
				<span class="onyx-proof-strip__number"><?php echo esc_html( $stat['number'] ?? '' ); ?></span>
				<span class="onyx-proof-strip__label"><?php echo esc_html( $stat['label'] ?? '' ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
	<?php if ( ! empty( $quotes ) ) : ?>
		<div class="onyx-proof-strip__quotes">
			<?php foreach ( $quotes as $quote ) : ?>
				<p class="onyx-proof-strip__quote">
					"<?php echo esc_html( $quote['quote'] ?? '' ); ?>" — <strong><?php echo esc_html( $quote['author'] ?? '' ); ?></strong><?php if ( ! empty( $quote['role'] ) ) : ?>, <?php echo esc_html( $quote['role'] ); ?><?php endif; ?>
				</p>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
