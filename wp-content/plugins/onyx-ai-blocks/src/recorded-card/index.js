import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, ToggleControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { title, audienceTag, description, price, duration, moduleCount, thumbnailUrl, thumbnailAlt, ctaLabel, ctaUrl, featured } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-recorded-card${ featured ? ' onyx-recorded-card--featured' : '' }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Recorded Card', 'onyx-ai-blocks' ) }>
						<SelectControl label={ __( 'Audience tag', 'onyx-ai-blocks' ) } value={ audienceTag }
							options={ [ { label: 'Dev', value: 'dev' }, { label: 'Biz', value: 'biz' }, { label: 'Org', value: 'org' } ] }
							onChange={ ( v ) => setAttributes( { audienceTag: v } ) } />
						<TextControl label={ __( 'Title', 'onyx-ai-blocks' ) } value={ title } onChange={ ( v ) => setAttributes( { title: v } ) } />
						<TextControl label={ __( 'Description', 'onyx-ai-blocks' ) } value={ description } onChange={ ( v ) => setAttributes( { description: v } ) } />
						<TextControl label={ __( 'Price (e.g. ₪890)', 'onyx-ai-blocks' ) } value={ price } onChange={ ( v ) => setAttributes( { price: v } ) } />
						<TextControl label={ __( 'Duration', 'onyx-ai-blocks' ) } value={ duration } onChange={ ( v ) => setAttributes( { duration: v } ) } />
						<TextControl label={ __( 'Module count', 'onyx-ai-blocks' ) } value={ moduleCount } onChange={ ( v ) => setAttributes( { moduleCount: v } ) } />
						<TextControl label={ __( 'Thumbnail alt text', 'onyx-ai-blocks' ) } value={ thumbnailAlt } onChange={ ( v ) => setAttributes( { thumbnailAlt: v } ) } />
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { thumbnailUrl: media.url } ) }
								allowedTypes={ [ 'image' ] }
								render={ ( { open } ) => (
									<Button onClick={ open } variant="secondary">
										{ thumbnailUrl ? __( 'Change thumbnail', 'onyx-ai-blocks' ) : __( 'Set thumbnail', 'onyx-ai-blocks' ) }
									</Button>
								) }
							/>
						</MediaUploadCheck>
						<TextControl label={ __( 'CTA label', 'onyx-ai-blocks' ) } value={ ctaLabel } onChange={ ( v ) => setAttributes( { ctaLabel: v } ) } />
						<TextControl label={ __( 'CTA URL', 'onyx-ai-blocks' ) } value={ ctaUrl } onChange={ ( v ) => setAttributes( { ctaUrl: v } ) } />
						<ToggleControl label={ __( 'Featured', 'onyx-ai-blocks' ) } checked={ featured } onChange={ ( v ) => setAttributes( { featured: v } ) } />
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					{ thumbnailUrl && <img className="onyx-recorded-card__thumbnail" src={ thumbnailUrl } alt={ thumbnailAlt } loading="lazy" /> }
					<div className="onyx-recorded-card__body">
						<span className="onyx-tag-badge onyx-tag-badge--teal">{ audienceTag }</span>
						<h3 className="onyx-recorded-card__title">{ title }</h3>
						<div className="onyx-recorded-card__meta">
							{ moduleCount && <span>{ moduleCount }</span> }
							{ duration && <span>{ duration }</span> }
						</div>
						<p className="onyx-recorded-card__description">{ description }</p>
						{ price && <span className="onyx-recorded-card__price">{ price }</span> }
						<a className="onyx-recorded-card__cta" href={ ctaUrl } onClick={ ( e ) => e.preventDefault() }>{ ctaLabel }</a>
					</div>
				</div>
			</>
		);
	},

	// Dynamic block — rendered via render.php on the frontend.
	save: () => null,
} );
