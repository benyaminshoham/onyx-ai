import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { headline, subtext, hook, buttonLabel, formProvider, layout } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-newsletter-optin onyx-newsletter-optin--${ layout }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Newsletter Opt-in', 'onyx-ai-blocks' ) }>
						<TextControl label={ __( 'Headline', 'onyx-ai-blocks' ) } value={ headline } onChange={ ( v ) => setAttributes( { headline: v } ) } />
						<TextControl label={ __( 'Subtext', 'onyx-ai-blocks' ) } value={ subtext } onChange={ ( v ) => setAttributes( { subtext: v } ) } />
						<TextControl label={ __( 'Hook (social proof line)', 'onyx-ai-blocks' ) } value={ hook } onChange={ ( v ) => setAttributes( { hook: v } ) } />
						<TextControl label={ __( 'Button label', 'onyx-ai-blocks' ) } value={ buttonLabel } onChange={ ( v ) => setAttributes( { buttonLabel: v } ) } />
						<SelectControl label={ __( 'Form provider', 'onyx-ai-blocks' ) } value={ formProvider }
							options={ [ { label: 'Mailchimp', value: 'mailchimp' }, { label: 'ConvertKit', value: 'convertkit' }, { label: 'Custom', value: 'custom' } ] }
							onChange={ ( v ) => setAttributes( { formProvider: v } ) } />
						<SelectControl label={ __( 'Layout', 'onyx-ai-blocks' ) } value={ layout }
							options={ [ { label: 'Full-width', value: 'full-width' }, { label: 'Inline', value: 'inline' }, { label: 'Sidebar', value: 'sidebar' } ] }
							onChange={ ( v ) => setAttributes( { layout: v } ) } />
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					<div className="onyx-newsletter-optin__content">
						<h2 className="onyx-newsletter-optin__headline">{ headline }</h2>
						<p className="onyx-newsletter-optin__subtext">{ subtext }</p>
					</div>
					<div className="onyx-newsletter-optin__form">
						<div className="onyx-newsletter-optin__field-row">
							<input className="onyx-newsletter-optin__input" type="email" placeholder={ __( 'כתובת המייל שלך', 'onyx-ai-blocks' ) } disabled />
							<button className="onyx-newsletter-optin__button" type="button">{ buttonLabel }</button>
						</div>
						{ hook && <p className="onyx-newsletter-optin__hook">{ hook }</p> }
					</div>
					<p className="onyx-newsletter-optin__provider-note">{ __( 'Provider:', 'onyx-ai-blocks' ) } { formProvider }</p>
				</div>
			</>
		);
	},

	// Dynamic block — render.php handles the actual form HTML.
	save: () => null,
} );
