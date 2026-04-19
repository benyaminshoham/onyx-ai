<?php
/**
 * Newsletter Opt-in — server-side render.
 *
 * Outputs a provider-agnostic form shell. Wire up form action/method
 * when the email provider is connected.
 *
 * @package onyx-ai-blocks
 * @since   1.0.0
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Unused.
 * @var WP_Block $block      Block instance.
 */

$headline     = isset( $attributes['headline'] )    ? $attributes['headline']    : '';
$subtext      = isset( $attributes['subtext'] )     ? $attributes['subtext']     : '';
$hook         = isset( $attributes['hook'] )        ? $attributes['hook']        : '';
$button_label = isset( $attributes['buttonLabel'] ) ? $attributes['buttonLabel'] : __( 'הרשמה', 'onyx-ai-blocks' );
$layout       = isset( $attributes['layout'] )      ? $attributes['layout']      : 'full-width';

$wrapper_class = 'onyx-newsletter-optin onyx-newsletter-optin--' . sanitize_html_class( $layout );
?>
<div <?php echo get_block_wrapper_attributes( [ 'class' => $wrapper_class ] ); ?>>

	<div class="onyx-newsletter-optin__content">
		<?php if ( $headline ) : ?>
			<h2 class="onyx-newsletter-optin__headline"><?php echo esc_html( $headline ); ?></h2>
		<?php endif; ?>
		<?php if ( $subtext ) : ?>
			<p class="onyx-newsletter-optin__subtext"><?php echo esc_html( $subtext ); ?></p>
		<?php endif; ?>
	</div>

	<div class="onyx-newsletter-optin__form">
		<form class="onyx-newsletter-optin__field-row" method="post" action="#">
			<?php wp_nonce_field( 'onyx_newsletter_subscribe', 'onyx_newsletter_nonce' ); ?>
			<label for="onyx-newsletter-email" class="screen-reader-text">
				<?php esc_html_e( 'כתובת המייל שלך', 'onyx-ai-blocks' ); ?>
			</label>
			<input
				id="onyx-newsletter-email"
				class="onyx-newsletter-optin__input"
				type="email"
				name="onyx_email"
				placeholder="<?php esc_attr_e( 'כתובת המייל שלך', 'onyx-ai-blocks' ); ?>"
				required
			/>
			<button class="onyx-newsletter-optin__button" type="submit">
				<?php echo esc_html( $button_label ); ?>
			</button>
		</form>
		<?php if ( $hook ) : ?>
			<p class="onyx-newsletter-optin__hook"><?php echo esc_html( $hook ); ?></p>
		<?php endif; ?>
	</div>

</div>
