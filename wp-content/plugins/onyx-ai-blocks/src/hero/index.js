import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const {
			eyebrow, headline, subheading,
			ctaPrimaryLabel, ctaPrimaryUrl,
			ctaSecondaryLabel, ctaSecondaryUrl,
			variant, backgroundDecoration,
		} = attributes;

		const blockProps = useBlockProps( {
			className: `onyx-hero onyx-hero--${ variant }${ backgroundDecoration ? ' onyx-hero--decorated' : '' }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Hero Settings', 'onyx-ai-blocks' ) }>
						<SelectControl
							label={ __( 'Variant', 'onyx-ai-blocks' ) }
							value={ variant }
							options={ [
								{ label: 'Homepage', value: 'homepage' },
								{ label: 'Audience',  value: 'audience' },
							] }
							onChange={ ( val ) => setAttributes( { variant: val } ) }
						/>
						<ToggleControl
							label={ __( 'Background decoration', 'onyx-ai-blocks' ) }
							checked={ backgroundDecoration }
							onChange={ ( val ) => setAttributes( { backgroundDecoration: val } ) }
						/>
					</PanelBody>
					<PanelBody title={ __( 'CTAs', 'onyx-ai-blocks' ) } initialOpen={ false }>
						<TextControl label={ __( 'Primary label', 'onyx-ai-blocks' ) } value={ ctaPrimaryLabel } onChange={ ( v ) => setAttributes( { ctaPrimaryLabel: v } ) } />
						<TextControl label={ __( 'Primary URL', 'onyx-ai-blocks' ) } value={ ctaPrimaryUrl } onChange={ ( v ) => setAttributes( { ctaPrimaryUrl: v } ) } />
						{ 'homepage' === variant && (
							<>
								<TextControl label={ __( 'Secondary label', 'onyx-ai-blocks' ) } value={ ctaSecondaryLabel } onChange={ ( v ) => setAttributes( { ctaSecondaryLabel: v } ) } />
								<TextControl label={ __( 'Secondary URL', 'onyx-ai-blocks' ) } value={ ctaSecondaryUrl } onChange={ ( v ) => setAttributes( { ctaSecondaryUrl: v } ) } />
							</>
						) }
					</PanelBody>
				</InspectorControls>

				<section { ...blockProps }>
					{ backgroundDecoration && <div className="onyx-hero__orb" aria-hidden="true" /> }
					<div className="onyx-hero__inner">
						<p className="onyx-hero__eyebrow">{ eyebrow || __( 'Eyebrow text', 'onyx-ai-blocks' ) }</p>
						<RichText
							tagName="h1"
							className="onyx-hero__headline"
							value={ headline }
							onChange={ ( val ) => setAttributes( { headline: val } ) }
							placeholder={ __( 'Hero headline…', 'onyx-ai-blocks' ) }
						/>
						<RichText
							tagName="p"
							className="onyx-hero__subheading"
							value={ subheading }
							onChange={ ( val ) => setAttributes( { subheading: val } ) }
							placeholder={ __( 'Subheading…', 'onyx-ai-blocks' ) }
						/>
						<div className="onyx-hero__ctas">
							<a className="onyx-cta-button onyx-cta-button--primary" href={ ctaPrimaryUrl } onClick={ ( e ) => e.preventDefault() }>
								{ ctaPrimaryLabel || __( 'Primary CTA', 'onyx-ai-blocks' ) }
							</a>
							{ 'homepage' === variant && ctaSecondaryLabel && (
								<a className="onyx-cta-button onyx-cta-button--secondary" href={ ctaSecondaryUrl } onClick={ ( e ) => e.preventDefault() }>
									{ ctaSecondaryLabel }
								</a>
							) }
						</div>
					</div>
				</section>
			</>
		);
	},

	save( { attributes } ) {
		const {
			eyebrow, headline, subheading,
			ctaPrimaryLabel, ctaPrimaryUrl,
			ctaSecondaryLabel, ctaSecondaryUrl,
			variant, backgroundDecoration,
		} = attributes;

		const blockProps = useBlockProps.save( {
			className: `onyx-hero onyx-hero--${ variant }${ backgroundDecoration ? ' onyx-hero--decorated' : '' }`,
		} );

		return (
			<section { ...blockProps }>
				{ backgroundDecoration && <div className="onyx-hero__orb" aria-hidden="true" /> }
				<div className="onyx-hero__inner">
					<p className="onyx-hero__eyebrow">{ eyebrow }</p>
					<RichText.Content tagName="h1" className="onyx-hero__headline" value={ headline } />
					<RichText.Content tagName="p" className="onyx-hero__subheading" value={ subheading } />
					<div className="onyx-hero__ctas">
						<a className="onyx-cta-button onyx-cta-button--primary" href={ ctaPrimaryUrl }>
							{ ctaPrimaryLabel }
						</a>
						{ 'homepage' === variant && ctaSecondaryLabel && (
							<a className="onyx-cta-button onyx-cta-button--secondary" href={ ctaSecondaryUrl }>
								{ ctaSecondaryLabel }
							</a>
						) }
					</div>
				</div>
			</section>
		);
	},
} );
