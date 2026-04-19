import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { photoUrl, photoAlt, bio, credibilityLine, linkLabel, linkUrl } = attributes;
		const blockProps = useBlockProps( { className: 'onyx-about-teaser' } );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'About Teaser', 'onyx-ai-blocks' ) }>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={ ( media ) => setAttributes( { photoUrl: media.url } ) }
								allowedTypes={ [ 'image' ] }
								render={ ( { open } ) => (
									<Button onClick={ open } variant="secondary">
										{ photoUrl ? __( 'Change photo', 'onyx-ai-blocks' ) : __( 'Set photo', 'onyx-ai-blocks' ) }
									</Button>
								) }
							/>
						</MediaUploadCheck>
						<TextControl label={ __( 'Photo alt text', 'onyx-ai-blocks' ) } value={ photoAlt } onChange={ ( v ) => setAttributes( { photoAlt: v } ) } />
						<TextareaControl label={ __( 'Bio', 'onyx-ai-blocks' ) } value={ bio } onChange={ ( v ) => setAttributes( { bio: v } ) } />
						<TextControl label={ __( 'Credibility line', 'onyx-ai-blocks' ) } value={ credibilityLine } onChange={ ( v ) => setAttributes( { credibilityLine: v } ) } />
						<TextControl label={ __( 'Link label', 'onyx-ai-blocks' ) } value={ linkLabel } onChange={ ( v ) => setAttributes( { linkLabel: v } ) } />
						<TextControl label={ __( 'Link URL', 'onyx-ai-blocks' ) } value={ linkUrl } onChange={ ( v ) => setAttributes( { linkUrl: v } ) } />
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					{ photoUrl && (
						<div className="onyx-about-teaser__photo-wrap">
							<img className="onyx-about-teaser__photo" src={ photoUrl } alt={ photoAlt } />
						</div>
					) }
					<div className="onyx-about-teaser__content">
						<p className="onyx-about-teaser__bio">{ bio }</p>
						{ credibilityLine && (
							<p className="onyx-about-teaser__credibility">{ credibilityLine }</p>
						) }
						<a className="onyx-about-teaser__link" href={ linkUrl } onClick={ ( e ) => e.preventDefault() }>{ linkLabel }</a>
					</div>
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { photoUrl, photoAlt, bio, credibilityLine, linkLabel, linkUrl } = attributes;
		const blockProps = useBlockProps.save( { className: 'onyx-about-teaser' } );
		return (
			<div { ...blockProps }>
				{ photoUrl && (
					<div className="onyx-about-teaser__photo-wrap">
						<img className="onyx-about-teaser__photo" src={ photoUrl } alt={ photoAlt } loading="lazy" />
					</div>
				) }
				<div className="onyx-about-teaser__content">
					<p className="onyx-about-teaser__bio">{ bio }</p>
					{ credibilityLine && (
						<p className="onyx-about-teaser__credibility">{ credibilityLine }</p>
					) }
					<a className="onyx-about-teaser__link" href={ linkUrl }>{ linkLabel }</a>
				</div>
			</div>
		);
	},
} );
